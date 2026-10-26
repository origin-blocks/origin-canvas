<?php
/**
 * The palette rename (#116): content recognisers and the byte-exact content rewrite. Pure.
 *
 * - The block attribute decides, never a class alone. Core emits a generic has-border-color on
 *   every block with any border colour, which is also the text class of the old slug "border".
 * - Recognised fields: the slug attributes, and string values under style.color,
 *   style.elements.*(.:state).color and style.border(.side).color holding var:preset|color|<old>
 *   or var(--wp--preset--color--<old>); var:preset|spacing|compact under style.spacing;
 *   var(--wp--custom--line-height--body) under style.typography.
 * - Where an attribute is renamed, the matching class and inline-style reference in the block's
 *   own tags are renamed with it. Text is never touched.
 * - core/html, core/freeform and text outside any block are unreachable: never rewritten.
 * - The parser mirrors core's WP_Block_Parser. A post whose blocks do not close cleanly is
 *   malformed: never rewritten.
 *
 * @package Origin_Canvas
 */

if ( ! function_exists( 'origin_canvas_palette_encode_attr_string' ) ) {
	/**
	 * Encode one changed attribute string exactly as core serialises block attributes: JSON, then
	 * the six replacements of wp-includes/blocks.php:1708-1717 (serialize_block_attributes), the
	 * same as the editor's serializeAttributes (js/dist/blocks.js:3684). The editor's
	 * JSON.stringify leaves U+2028 and U+2029 unescaped, hence JSON_UNESCAPED_LINE_TERMINATORS.
	 *
	 * @param string $s The attribute value.
	 * @return string The JSON string token, quotes included.
	 */
	function origin_canvas_palette_encode_attr_string( $s ) {
		$json = wp_json_encode( (string) $s, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_LINE_TERMINATORS );

		return strtr(
			$json,
			array(
				'\\\\' => '\\u005c',
				'--'   => '\\u002d\\u002d',
				'<'    => '\\u003c',
				'>'    => '\\u003e',
				'&'    => '\\u0026',
				'\\"'  => '\\u0022',
			)
		);
	}
}

if ( ! function_exists( 'origin_canvas_palette_parse' ) ) {
	/**
	 * Parse block markup as WP_Block_Parser does, keeping byte offsets.
	 *
	 * Each block node: name, start, open_end, attrs_start, attrs_text, segments (its innerContent:
	 * array( 'text' => array( start, end ) ) or array( 'child' => node )), close_start, end.
	 * Freeform text is a node with a null name.
	 *
	 * @param string $content Block markup.
	 * @return array{children: array, malformed: bool}
	 */
	function origin_canvas_palette_parse( $content ) {
		$output    = array();
		$stack     = array();
		$offset    = 0;
		$malformed = false;
		$length    = strlen( $content );
		$token     = '/<!--\s+(\/)?wp:([a-z][a-z0-9_-]*\/)?([a-z][a-z0-9_-]*)\s+(\{.*?\}\s+)?(\/)?-->/s';

		// PHP empty(): '' and '0' are empty.
		$non_empty = static function ( $s, $e ) use ( $content ) {
			return $e > $s && '0' !== substr( $content, $s, $e - $s );
		};

		$add_block_from_stack = static function ( $end_offset = null, $closer_end = null ) use ( &$stack, &$output, $content, $length, $non_empty ) {
			$top = array_pop( $stack );
			$end = null === $end_offset ? $length : $end_offset;
			if ( $non_empty( $top['prev'], $end ) ) {
				$top['node']['segments'][] = array( 'text' => array( $top['prev'], $end ) );
			}
			$top['node']['close_start'] = $end;
			$top['node']['end']         = null === $closer_end ? $length : $closer_end;
			if ( null !== $top['leading'] ) {
				$output[] = array(
					'name'  => null,
					'start' => $top['leading'],
					'end'   => $top['node']['start'],
				);
			}
			$output[] = $top['node'];
		};

		$add_inner = static function ( $child, $token_start, $token_length, $last_offset = null ) use ( &$stack, $non_empty ) {
			$i = count( $stack ) - 1;
			if ( $non_empty( $stack[ $i ]['prev'], $token_start ) ) {
				$stack[ $i ]['node']['segments'][] = array( 'text' => array( $stack[ $i ]['prev'], $token_start ) );
			}
			$stack[ $i ]['node']['segments'][] = array( 'child' => $child );
			$stack[ $i ]['prev']                = null === $last_offset ? $token_start + $token_length : $last_offset;
		};

		while ( true ) {
			if ( ! preg_match( $token, $content, $m, PREG_OFFSET_CAPTURE, $offset ) ) {
				if ( ! $stack ) {
					if ( $length > $offset ) {
						$output[] = array(
							'name'  => null,
							'start' => $offset,
							'end'   => $length,
						);
					}
					break;
				}
				if ( count( $stack ) > 1 ) {
					$malformed = true;
				}
				while ( $stack ) {
					$add_block_from_stack();
				}
				break;
			}

			$whole     = $m[0][0];
			$start     = $m[0][1];
			$tok_len   = strlen( $whole );
			$closer    = isset( $m[1] ) && -1 !== $m[1][1] && '' !== $m[1][0];
			$ns        = isset( $m[2] ) && -1 !== $m[2][1] ? $m[2][0] : '';
			$attrs_raw = isset( $m[4] ) && -1 !== $m[4][1] ? $m[4][0] : '';
			$void      = isset( $m[5] ) && -1 !== $m[5][1] && '' !== $m[5][0];
			$leading   = $start > $offset ? $offset : null;
			$node      = array(
				'name'        => ( '' !== $ns ? substr( $ns, 0, -1 ) : 'core' ) . '/' . $m[3][0],
				'start'       => $start,
				'open_end'    => $start + $tok_len,
				'attrs_start' => '' !== $attrs_raw ? $m[4][1] : -1,
				'attrs_text'  => '' !== $attrs_raw ? rtrim( $attrs_raw ) : '',
				'segments'    => array(),
			);

			if ( $void ) {
				$node['close_start'] = $start + $tok_len;
				$node['end']         = $start + $tok_len;
				if ( ! $stack ) {
					if ( null !== $leading && $start > $leading ) {
						$output[] = array(
							'name'  => null,
							'start' => $leading,
							'end'   => $start,
						);
					}
					$output[] = $node;
				} else {
					$add_inner( $node, $start, $tok_len );
				}
				$offset = $start + $tok_len;
				continue;
			}

			if ( ! $closer ) {
				$stack[] = array(
					'node'    => $node,
					'prev'    => $start + $tok_len,
					'leading' => $leading,
				);
				$offset  = $start + $tok_len;
				continue;
			}

			// A closer pops the open block whatever its name, as core does.
			if ( ! $stack ) {
				$malformed = true;
				if ( $length > $offset ) {
					$output[] = array(
						'name'  => null,
						'start' => $offset,
						'end'   => $length,
					);
				}
				break;
			}
			if ( 1 === count( $stack ) ) {
				$add_block_from_stack( $start, $start + $tok_len );
				$offset = $start + $tok_len;
				continue;
			}
			$top = array_pop( $stack );
			if ( $non_empty( $top['prev'], $start ) ) {
				$top['node']['segments'][] = array( 'text' => array( $top['prev'], $start ) );
			}
			$top['node']['close_start'] = $start;
			$top['node']['end']         = $start + $tok_len;
			$add_inner( $top['node'], $top['node']['start'], $top['node']['open_end'] - $top['node']['start'], $start + $tok_len );
			$offset = $start + $tok_len;
		}

		return array(
			'children'  => $output,
			'malformed' => $malformed,
		);
	}
}

if ( ! function_exists( 'origin_canvas_palette_children_of' ) ) {
	/**
	 * A block node's inner blocks.
	 *
	 * @param array $node Block node.
	 * @return array
	 */
	function origin_canvas_palette_children_of( $node ) {
		$out = array();
		foreach ( $node['segments'] as $seg ) {
			if ( isset( $seg['child'] ) ) {
				$out[] = $seg['child'];
			}
		}
		return $out;
	}
}

if ( ! function_exists( 'origin_canvas_palette_edit_json_strings' ) ) {
	/**
	 * Walk the string values of a JSON text with their paths. $visit( $path, $value ) returns a new
	 * value or null. Returns the text with only the changed string tokens replaced, each encoded
	 * the way core serialises block attributes.
	 *
	 * @param string   $text  JSON text.
	 * @param callable $visit Visitor.
	 * @return string
	 */
	function origin_canvas_palette_edit_json_strings( $text, $visit ) {
		$edits  = array();
		$stack  = array();
		$len    = strlen( $text );
		$i      = 0;
		$path   = static function () use ( &$stack ) {
			$p = array();
			foreach ( $stack as $f ) {
				$p[] = 'o' === $f['type'] ? $f['key'] : $f['index'];
			}
			return $p;
		};
		while ( $i < $len ) {
			$ch = $text[ $i ];
			if ( '{' === $ch ) {
				$stack[] = array(
					'type'       => 'o',
					'key'        => null,
					'expect_key' => true,
				);
				++$i;
				continue;
			}
			if ( '[' === $ch ) {
				$stack[] = array(
					'type'  => 'a',
					'index' => 0,
				);
				++$i;
				continue;
			}
			if ( '}' === $ch || ']' === $ch ) {
				array_pop( $stack );
				++$i;
				continue;
			}
			if ( ',' === $ch ) {
				$top = count( $stack ) - 1;
				if ( $top >= 0 && 'o' === $stack[ $top ]['type'] ) {
					$stack[ $top ]['expect_key'] = true;
				}
				if ( $top >= 0 && 'a' === $stack[ $top ]['type'] ) {
					++$stack[ $top ]['index'];
				}
				++$i;
				continue;
			}
			if ( '"' === $ch ) {
				$j = $i + 1;
				while ( $j < $len && '"' !== $text[ $j ] ) {
					$j += '\\' === $text[ $j ] ? 2 : 1;
				}
				$raw   = substr( $text, $i, $j + 1 - $i );
				$value = json_decode( $raw );
				$top   = count( $stack ) - 1;
				if ( $top >= 0 && 'o' === $stack[ $top ]['type'] && $stack[ $top ]['expect_key'] ) {
					$stack[ $top ]['key']        = $value;
					$stack[ $top ]['expect_key'] = false;
				} elseif ( is_string( $value ) ) {
					$next = $visit( $path(), $value );
					if ( null !== $next && $next !== $value ) {
						$edits[] = array( $i, $j + 1, origin_canvas_palette_encode_attr_string( $next ) );
					}
				}
				$i = $j + 1;
				continue;
			}
			++$i;
		}
		$out = $text;
		foreach ( array_reverse( $edits ) as $e ) {
			$out = substr( $out, 0, $e[0] ) . $e[2] . substr( $out, $e[1] );
		}
		return $out;
	}
}

if ( ! function_exists( 'origin_canvas_palette_lookup' ) ) {
	/**
	 * One lookup per captured slug: the collision map first, then the map. Nothing chains.
	 *
	 * @param string $kind  color, spacing or lineHeight.
	 * @param string $slug  The captured slug.
	 * @param array  $extra Collision map of the map's shape.
	 * @return string The new slug, or '' when the slug is not mapped.
	 */
	function origin_canvas_palette_lookup( $kind, $slug, $extra = array() ) {
		if ( isset( $extra[ $kind ][ $slug ] ) && '' !== $extra[ $kind ][ $slug ] ) {
			return (string) $extra[ $kind ][ $slug ];
		}
		$map = origin_canvas_palette_map();
		return isset( $map[ $kind ][ $slug ] ) ? $map[ $kind ][ $slug ] : '';
	}
}

if ( ! function_exists( 'origin_canvas_palette_path_kind' ) ) {
	/**
	 * Which recognised field an attribute path is: 'slug', 'color', 'spacing', 'lineHeight' or ''.
	 * A colour path can also be '' for kinds below; callers test each kind.
	 *
	 * @param array $p Path.
	 * @return array<string, bool>
	 */
	function origin_canvas_palette_path_kinds( $p ) {
		$rules = origin_canvas_palette_rules();
		$kinds = array(
			'slug'       => 1 === count( $p ) && is_string( $p[0] ) && array_key_exists( $p[0], $rules['slug_attrs'] ),
			'color'      => false,
			'spacing'    => false,
			'lineHeight' => false,
		);
		if ( isset( $p[0] ) && 'style' === $p[0] ) {
			$second          = isset( $p[1] ) ? $p[1] : null;
			$kinds['color']  = 'color' === $second
				|| ( 'elements' === $second && in_array( 'color', array_slice( $p, 2 ), true ) )
				|| ( 'border' === $second && ( ( isset( $p[2] ) && 'color' === $p[2] ) || ( isset( $p[3] ) && 'color' === $p[3] ) ) );
			$kinds['spacing']    = 'spacing' === $second;
			$kinds['lineHeight'] = 'typography' === $second;
		}
		return $kinds;
	}
}

if ( ! function_exists( 'origin_canvas_palette_rename_value' ) ) {
	/**
	 * Rename old references in one attribute string value; notes what it renamed in $seen.
	 *
	 * @param array  $p     Path.
	 * @param string $v     Value.
	 * @param array  $seen  slugs (list of [attr, old]), vars, spacing, lineHeight (ordered sets).
	 * @param array  $extra Collision map.
	 * @return string|null The new value, or null when unchanged.
	 */
	function origin_canvas_palette_rename_value( $p, $v, &$seen, $extra ) {
		$kinds = origin_canvas_palette_path_kinds( $p );
		if ( $kinds['slug'] ) {
			$to = origin_canvas_palette_lookup( 'color', $v, $extra );
			if ( '' !== $to ) {
				$seen['slugs'][] = array( $p[0], $v );
				return $to;
			}
			return null;
		}
		$out = $v;
		if ( $kinds['color'] ) {
			$out = preg_replace_callback(
				'/^var:preset\|color\|([a-z0-9-]+)$/D',
				static function ( $m ) use ( &$seen, $extra ) {
					$to = origin_canvas_palette_lookup( 'color', $m[1], $extra );
					if ( '' === $to ) {
						return $m[0];
					}
					$seen['vars'][ $m[1] ] = true;
					return 'var:preset|color|' . $to;
				},
				$out
			);
			$out = preg_replace_callback(
				'/var\(--wp--preset--color--([a-z0-9-]+)\)/',
				static function ( $m ) use ( &$seen, $extra ) {
					$to = origin_canvas_palette_lookup( 'color', $m[1], $extra );
					if ( '' === $to ) {
						return $m[0];
					}
					$seen['vars'][ $m[1] ] = true;
					return 'var(--wp--preset--color--' . $to . ')';
				},
				$out
			);
		}
		if ( $kinds['spacing'] ) {
			$out = preg_replace_callback(
				'/^var:preset\|spacing\|([a-z0-9-]+)$/D',
				static function ( $m ) use ( &$seen, $extra ) {
					$to = origin_canvas_palette_lookup( 'spacing', $m[1], $extra );
					if ( '' === $to ) {
						return $m[0];
					}
					$seen['spacing'][ $m[1] ] = true;
					return 'var:preset|spacing|' . $to;
				},
				$out
			);
		}
		if ( $kinds['lineHeight'] ) {
			$out = preg_replace_callback(
				'/var\(--wp--custom--line-height--([a-z0-9-]+)\)/',
				static function ( $m ) use ( &$seen, $extra ) {
					$to = origin_canvas_palette_lookup( 'lineHeight', $m[1], $extra );
					if ( '' === $to ) {
						return $m[0];
					}
					$seen['lineHeight'][ $m[1] ] = true;
					return 'var(--wp--custom--line-height--' . $to . ')';
				},
				$out
			);
		}
		return $out === $v ? null : $out;
	}
}

if ( ! function_exists( 'origin_canvas_palette_has_border_colour' ) ) {
	/**
	 * Whether a block's attributes set a border colour (core then adds has-border-color).
	 *
	 * @param mixed $attrs Decoded attributes.
	 * @return bool
	 */
	function origin_canvas_palette_has_border_colour( $attrs ) {
		if ( ! is_array( $attrs ) ) {
			return false;
		}
		if ( ! empty( $attrs['borderColor'] ) && origin_canvas_palette_truthy( $attrs['borderColor'] ) ) {
			return true;
		}
		$b = isset( $attrs['style']['border'] ) ? $attrs['style']['border'] : null;
		if ( ! is_array( $b ) || ! $b ) {
			return false;
		}
		if ( isset( $b['color'] ) && origin_canvas_palette_truthy( $b['color'] ) ) {
			return true;
		}
		foreach ( array( 'top', 'right', 'bottom', 'left' ) as $side ) {
			if ( isset( $b[ $side ] ) && is_array( $b[ $side ] ) && isset( $b[ $side ]['color'] ) && origin_canvas_palette_truthy( $b[ $side ]['color'] ) ) {
				return true;
			}
		}
		return false;
	}
}

if ( ! function_exists( 'origin_canvas_palette_truthy' ) ) {
	/**
	 * JavaScript truthiness of a decoded JSON value (an empty array or object is truthy there).
	 *
	 * @param mixed $v Value.
	 * @return bool
	 */
	function origin_canvas_palette_truthy( $v ) {
		if ( is_array( $v ) || is_object( $v ) ) {
			return true;
		}
		if ( is_string( $v ) ) {
			return '' !== $v;
		}
		return (bool) $v;
	}
}

if ( ! class_exists( 'Origin_Canvas_Palette_Tag_Scanner' ) ) {
	/**
	 * Core's tag processor, used only to find where each opening tag starts and ends: it walks
	 * comments, raw text and quoted attribute values as a browser does, so a "<" or ">" inside an
	 * attribute value never starts or ends a tag.
	 */
	class Origin_Canvas_Palette_Tag_Scanner extends WP_HTML_Tag_Processor {
		/**
		 * The opening tags of a markup string.
		 *
		 * @param string $html Markup.
		 * @return array List of array( offset, tag text ).
		 */
		public static function openers( $html ) {
			$html = (string) $html;
			$out  = array();
			if ( false === strpos( $html, '<' ) ) {
				return $out;
			}
			$p = new self( $html );
			while ( $p->next_tag() ) {
				if ( $p->set_bookmark( 'tag' ) ) {
					$span  = $p->bookmarks['tag'];
					$out[] = array( $span->start, substr( $html, $span->start, $span->length ) );
				}
			}
			return $out;
		}
	}
}

if ( ! function_exists( 'origin_canvas_palette_tag_attribute' ) ) {
	/**
	 * Where the value of a tag's attribute is: the first attribute of that name, as a browser
	 * reads it (later duplicates are ignored), parsed by the rules of core's tag processor
	 * (class-wp-html-tag-processor.php parse_next_attribute()). Text inside another attribute's
	 * value is never taken for an attribute.
	 *
	 * @param string $tag  One opening tag, "<" to ">".
	 * @param string $name Attribute name, lower case.
	 * @return array|null array( value offset, value length ) in $tag, or null when absent or empty.
	 */
	function origin_canvas_palette_tag_attribute( $tag, $name ) {
		$len = strlen( $tag );
		$i   = 1 + strcspn( $tag, " \t\f\r\n/>", 1 );
		while ( $i < $len ) {
			$i += strspn( $tag, " \t\f\r\n/", $i );
			if ( $i >= $len || '>' === $tag[ $i ] ) {
				return null;
			}
			$n    = '=' === $tag[ $i ] ? 1 + strcspn( $tag, "=/> \t\f\r\n", $i + 1 ) : strcspn( $tag, "=/> \t\f\r\n", $i );
			$attr = substr( $tag, $i, $n );
			$i   += $n;
			$i   += strspn( $tag, " \t\f\r\n", $i );
			$val  = null;
			if ( $i < $len && '=' === $tag[ $i ] ) {
				++$i;
				$i += strspn( $tag, " \t\f\r\n", $i );
				if ( $i < $len && ( '"' === $tag[ $i ] || "'" === $tag[ $i ] ) ) {
					$end = strpos( $tag, $tag[ $i ], $i + 1 );
					if ( false === $end ) {
						return null;
					}
					$val = array( $i + 1, $end - $i - 1 );
					$i   = $end + 1;
				} else {
					$n   = strcspn( $tag, "> \t\f\r\n", $i );
					$val = array( $i, $n );
					$i  += $n;
				}
			}
			if ( strtolower( $attr ) === $name ) {
				return ( null === $val || 0 === $val[1] ) ? null : $val;
			}
		}
		return null;
	}
}

if ( ! function_exists( 'origin_canvas_palette_tag_value' ) ) {
	/**
	 * The raw value of a tag's attribute, or ''.
	 *
	 * @param string $tag  One opening tag.
	 * @param string $name Attribute name, lower case.
	 * @return string
	 */
	function origin_canvas_palette_tag_value( $tag, $name ) {
		$span = origin_canvas_palette_tag_attribute( $tag, $name );
		return null === $span ? '' : substr( $tag, $span[0], $span[1] );
	}
}

if ( ! function_exists( 'origin_canvas_palette_tag_quote' ) ) {
	/**
	 * A rewritten attribute value as it goes into the tag. An unquoted value that gains whitespace
	 * (has-border-color becoming "has-base-5-color has-border-color") is written in double quotes,
	 * or a browser reads its second token as a separate attribute; a value that stays one token,
	 * or was quoted, keeps its bytes.
	 *
	 * @param string $tag    The opening tag the value sits in.
	 * @param array  $change array( value offset, value length, new value ).
	 * @return string
	 */
	function origin_canvas_palette_tag_quote( $tag, $change ) {
		list( $at, $len, $value ) = $change;
		$quoted                   = $at > 0 && ( '"' === $tag[ $at - 1 ] || "'" === $tag[ $at - 1 ] );
		if ( $quoted || substr( $tag, $at, $len ) === $value || strlen( $value ) === strcspn( $value, " \t\f\r\n" ) ) {
			return $value;
		}
		return '"' . str_replace( '"', '&quot;', $value ) . '"';
	}
}

if ( ! function_exists( 'origin_canvas_palette_attr_map_outside' ) ) {
	/**
	 * As origin_canvas_palette_css_map_outside(), for the raw value of a style attribute. Strings,
	 * comments, url() arguments and escapes are found in the decoded CSS, as core's tag processor
	 * gives it (in a double-quoted attribute a CSS string is written &quot;…&quot;), and $fn runs
	 * on the raw bytes outside them, so every byte $fn does not change, character references
	 * included, is kept.
	 *
	 * @param string   $raw Raw attribute value.
	 * @param callable $fn  string => string.
	 * @return string
	 */
	function origin_canvas_palette_attr_map_outside( $raw, $fn ) {
		$raw  = (string) $raw;
		$len  = strlen( $raw );
		$text = '';
		$at   = array(); // The raw offset of each decoded byte.
		for ( $i = 0; $i < $len; ) {
			$n = 0;
			$c = '&' === $raw[ $i ] ? WP_HTML_Decoder::read_character_reference( 'attribute', $raw, $i, $n ) : null;
			if ( null === $c ) {
				$c = $raw[ $i ];
				$n = 1;
			}
			$text .= $c;
			for ( $k = strlen( $c ); $k > 0; $k-- ) {
				$at[] = $i;
			}
			$i += $n;
		}
		$at[]  = $len;
		$out   = '';
		$start = 0;
		$tlen  = strlen( $text );
		for ( $i = 0; $i < $tlen; ) {
			$n = origin_canvas_palette_css_protected_at( $text, $i );
			if ( $n && '\\' === $text[ $i ] && $n <= 2 ) { // An escape; a longer run is an escaped url( name.
				$i += $n;
			} elseif ( $n ) {
				$out  .= $fn( substr( $raw, $at[ $start ], $at[ $i ] - $at[ $start ] ) ) . substr( $raw, $at[ $i ], $at[ $i + $n ] - $at[ $i ] );
				$i    += $n;
				$start = $i;
			} else {
				++$i;
			}
		}
		return $out . $fn( (string) substr( $raw, $at[ $start ] ) );
	}
}

if ( ! function_exists( 'origin_canvas_palette_tag_edits' ) ) {
	/**
	 * Edits for one block's own tags, from what its attributes renamed.
	 *
	 * @param string $content Markup.
	 * @param array  $node    Block node.
	 * @param mixed  $attrs   Decoded attributes.
	 * @param array  $seen    What the attributes renamed.
	 * @param array  $extra   Collision map.
	 * @return array List of array( start, end, replacement ).
	 */
	function origin_canvas_palette_tag_edits( $content, $node, $attrs, $seen, $extra ) {
		$rules         = origin_canvas_palette_rules();
		$class_renames = array();
		$border_text   = null;
		foreach ( $seen['slugs'] as $pair ) {
			list( $attr, $old ) = $pair;
			$kind               = $rules['slug_attrs'][ $attr ];
			if ( null === $kind ) {
				continue;
			}
			if ( 'textColor' === $attr && 'border' === $old ) {
				$border_text = 'has-' . origin_canvas_palette_lookup( 'color', 'border', $extra ) . '-color';
				continue;
			}
			$class_renames[] = array( 'has-' . $old . '-' . $kind, 'has-' . origin_canvas_palette_lookup( 'color', $old, $extra ) . '-' . $kind );
		}
		foreach ( $seen['slugs'] as $pair ) {
			list( $attr, $old ) = $pair;
			if ( isset( $rules['derived'][ $node['name'] ][ $attr ] ) ) {
				$derived         = $rules['derived'][ $node['name'] ][ $attr ];
				$class_renames[] = array( 'has-' . $old . '-' . $derived, 'has-' . origin_canvas_palette_lookup( 'color', $old, $extra ) . '-' . $derived );
			}
		}
		$style_re = array();
		foreach ( array_keys( $seen['vars'] ) as $s ) {
			$style_re[] = array( '/var\(--wp--preset--color--' . preg_quote( $s, '/' ) . '\)/', 'var(--wp--preset--color--' . origin_canvas_palette_lookup( 'color', $s, $extra ) . ')' );
		}
		foreach ( array_keys( $seen['spacing'] ) as $s ) {
			$style_re[] = array( '/var\(--wp--preset--spacing--' . preg_quote( $s, '/' ) . '\)/', 'var(--wp--preset--spacing--' . origin_canvas_palette_lookup( 'spacing', $s, $extra ) . ')' );
		}
		foreach ( array_keys( $seen['lineHeight'] ) as $s ) {
			$style_re[] = array( '/var\(--wp--custom--line-height--' . preg_quote( $s, '/' ) . '\)/', 'var(--wp--custom--line-height--' . origin_canvas_palette_lookup( 'lineHeight', $s, $extra ) . ')' );
		}

		$ranges = array();
		foreach ( $node['segments'] as $seg ) {
			if ( isset( $seg['text'] ) ) {
				$ranges[] = $seg['text'];
			}
		}

		// Old slug "border" as text colour: its class is has-border-color, the same token core adds
		// for any border colour. With no border colour the token is the text class: rename it. With
		// a border colour, a second token is the text class (rename the first); a single token
		// serves both (keep it and add the new text class before it).
		$border_tokens = 0;
		$needs_generic = origin_canvas_palette_has_border_colour( $attrs );
		if ( null !== $border_text ) {
			foreach ( $ranges as $r ) {
				foreach ( Origin_Canvas_Palette_Tag_Scanner::openers( substr( $content, $r[0], $r[1] - $r[0] ) ) as $t ) {
					foreach ( preg_split( '/\s+/', origin_canvas_palette_tag_value( $t[1], 'class' ) ) as $x ) {
						if ( 'has-border-color' === $x ) {
							++$border_tokens;
						}
					}
				}
			}
		}

		// Only the class and style attributes of the block's own tags change, found by an
		// attribute-aware scan: a class-like string inside another attribute (a link title) stays.
		$edits       = array();
		$border_done = false;
		foreach ( $ranges as $r ) {
			foreach ( Origin_Canvas_Palette_Tag_Scanner::openers( substr( $content, $r[0], $r[1] - $r[0] ) ) as $t ) {
				$tag_start = $r[0] + $t[0];
				$tag       = $t[1];
				$changes   = array();
				$class     = origin_canvas_palette_tag_attribute( $tag, 'class' );
				if ( null !== $class ) {
					$parts = preg_split( '/(\s+)/', substr( $tag, $class[0], $class[1] ), -1, PREG_SPLIT_DELIM_CAPTURE );
					foreach ( $parts as $k => $tok ) {
						foreach ( $class_renames as $rename ) {
							if ( $rename[0] === $tok ) {
								$parts[ $k ] = $rename[1];
								break;
							}
						}
					}
					if ( null !== $border_text && ! $border_done ) {
						$idx = array_search( 'has-border-color', $parts, true );
						if ( false !== $idx ) {
							$parts[ $idx ] = ( ! $needs_generic || $border_tokens >= 2 ) ? $border_text : $border_text . ' has-border-color';
							$border_done   = true;
						}
					}
					$changes[] = array( $class[0], $class[1], implode( '', $parts ) );
				}
				$style = origin_canvas_palette_tag_attribute( $tag, 'style' );
				if ( null !== $style ) {
					// Declaration values only: a quoted string (--caption:'var(…)', or &quot;…&quot;) or a
					// comment in the style attribute is text, not a colour reference, and keeps its bytes.
					$v         = origin_canvas_palette_attr_map_outside(
						substr( $tag, $style[0], $style[1] ),
						static function ( $plain ) use ( $style_re ) {
							foreach ( $style_re as $re ) {
								$plain = preg_replace( $re[0], str_replace( array( '\\', '$' ), array( '\\\\', '\\$' ), $re[1] ), $plain );
							}
							return $plain;
						}
					);
					$changes[] = array( $style[0], $style[1], $v );
				}
				// Right to left, so each offset still holds.
				usort(
					$changes,
					static function ( $a, $b ) {
						return $b[0] - $a[0];
					}
				);
				$next = $tag;
				foreach ( $changes as $c ) {
					$next = substr( $next, 0, $c[0] ) . origin_canvas_palette_tag_quote( $tag, $c ) . substr( $next, $c[0] + $c[1] );
				}
				if ( $next !== $tag ) {
					$edits[] = array( $tag_start, $tag_start + strlen( $tag ), $next );
				}
			}
		}
		return $edits;
	}
}

if ( ! function_exists( 'origin_canvas_palette_decode_attrs' ) ) {
	/**
	 * Decode a block's attribute JSON; null when it does not parse.
	 *
	 * @param string $text Attribute JSON.
	 * @return array|null
	 */
	function origin_canvas_palette_decode_attrs( $text ) {
		if ( '' === $text ) {
			return null;
		}
		$attrs = json_decode( $text, true );
		return is_array( $attrs ) ? $attrs : null;
	}
}

if ( ! function_exists( 'origin_canvas_palette_new_seen' ) ) {
	/**
	 * An empty record of what one block's attributes renamed.
	 *
	 * @return array
	 */
	function origin_canvas_palette_new_seen() {
		return array(
			'slugs'      => array(),
			'vars'       => array(),
			'spacing'    => array(),
			'lineHeight' => array(),
		);
	}
}

if ( ! function_exists( 'origin_canvas_palette_rewrite_content' ) ) {
	/**
	 * The rewrite of one post's block markup: old colour, spacing and line height codes in
	 * reachable blocks take their new names, and every other byte stays. A malformed post is
	 * returned as it is. The reference is the private tests' blocks.js rewrite().
	 *
	 * @param string $content Block markup.
	 * @param array  $extra   Collision map of the map's shape: array( 'color' => array( D => legacy ), … ).
	 * @return string
	 */
	function origin_canvas_palette_rewrite_content( $content, $extra = array() ) {
		$content = (string) $content;
		$tree    = origin_canvas_palette_parse( $content );
		if ( $tree['malformed'] ) {
			return $content;
		}
		$rules       = origin_canvas_palette_rules();
		$unreachable = $rules['unreachable'];
		$edits       = array();
		$walk        = static function ( $nodes ) use ( &$walk, &$edits, $content, $unreachable, $extra ) {
			foreach ( $nodes as $child ) {
				if ( null === $child['name'] || in_array( $child['name'], $unreachable, true ) ) {
					continue;
				}
				if ( '' !== $child['attrs_text'] ) {
					$attrs = origin_canvas_palette_decode_attrs( $child['attrs_text'] );
					if ( null !== $attrs ) {
						$seen = origin_canvas_palette_new_seen();
						$next = origin_canvas_palette_edit_json_strings(
							$child['attrs_text'],
							static function ( $p, $v ) use ( &$seen, $extra ) {
								return origin_canvas_palette_rename_value( $p, $v, $seen, $extra );
							}
						);
						if ( $next !== $child['attrs_text'] ) {
							$edits[] = array( $child['attrs_start'], $child['attrs_start'] + strlen( $child['attrs_text'] ), $next );
							foreach ( origin_canvas_palette_tag_edits( $content, $child, $attrs, $seen, $extra ) as $e ) {
								$edits[] = $e;
							}
						}
					}
				}
				$walk( origin_canvas_palette_children_of( $child ) );
			}
		};
		$walk( $tree['children'] );
		usort(
			$edits,
			static function ( $a, $b ) {
				return $b[0] - $a[0];
			}
		);
		$out = $content;
		foreach ( $edits as $e ) {
			$out = substr( $out, 0, $e[0] ) . $e[2] . substr( $out, $e[1] );
		}
		return $out;
	}
}

if ( ! function_exists( 'origin_canvas_palette_markup_hits' ) ) {
	/**
	 * Old references in tag class and style attributes of a markup string (not text): old colour
	 * classes, and old colour, spacing and line height variables outside the style attribute's
	 * strings and comments.
	 *
	 * @param string $markup Markup.
	 * @return string[]
	 */
	function origin_canvas_palette_markup_hits( $markup ) {
		$map  = origin_canvas_palette_map();
		$hits = array();
		foreach ( Origin_Canvas_Palette_Tag_Scanner::openers( $markup ) as $t ) {
			foreach ( preg_split( '/\s+/', origin_canvas_palette_tag_value( $t[1], 'class' ) ) as $tok ) {
				// has-border-color alone is core's generic class: not evidence.
				if ( 'has-border-color' !== $tok && preg_match( '/^has-([a-z0-9-]+?)-(background-color|border-color|color)$/D', $tok, $m ) && isset( $map['color'][ $m[1] ] ) ) {
					$hits[] = 'class=' . $tok;
				}
			}
			// Every old preset variable, outside the style attribute's strings and comments.
			origin_canvas_palette_attr_map_outside(
				origin_canvas_palette_tag_value( $t[1], 'style' ),
				static function ( $plain ) use ( $map, &$hits ) {
					foreach ( array( 'color' => '--wp--preset--color--', 'spacing' => '--wp--preset--spacing--', 'lineHeight' => '--wp--custom--line-height--' ) as $kind => $prefix ) {
						if ( preg_match_all( '/var\(' . preg_quote( $prefix, '/' ) . '([a-z0-9-]+)\)/', $plain, $vars ) ) {
							foreach ( $vars[1] as $v ) {
								if ( isset( $map[ $kind ][ $v ] ) ) {
									$hits[] = 'style~' . ( 'color' === $kind ? '' : $kind . '-' ) . $v;
								}
							}
						}
					}
					return $plain;
				}
			);
		}
		return $hits;
	}
}

if ( ! function_exists( 'origin_canvas_palette_content_hits' ) ) {
	/**
	 * Where a post's old codes are: reachable hits (recognised fields of reachable blocks, what
	 * Update colours rewrites) and alias-only hits (unreachable blocks, text outside blocks,
	 * custom class names), which only the aliases carry.
	 *
	 * @param string $content Block markup.
	 * @param array  $extra   Collision map.
	 * @return array{reachable: string[], alias: string[], malformed: bool}
	 */
	function origin_canvas_palette_content_hits( $content, $extra = array() ) {
		$content     = (string) $content;
		$map         = origin_canvas_palette_map();
		$rules       = origin_canvas_palette_rules();
		$reachable   = array();
		$alias       = array();
		$tree        = origin_canvas_palette_parse( $content );
		$malformed   = $tree['malformed'];
		$scan        = static function ( $attrs_text, $p, &$into ) use ( $extra ) {
			$attrs = origin_canvas_palette_decode_attrs( $attrs_text );
			if ( null === $attrs ) {
				return null;
			}
			origin_canvas_palette_edit_json_strings(
				$attrs_text,
				static function ( $q, $v ) use ( &$into, $p, $extra ) {
					$s = origin_canvas_palette_new_seen();
					if ( null !== origin_canvas_palette_rename_value( $q, $v, $s, $extra ) ) {
						$into[] = $p . '.' . implode( '.', $q ) . '=' . $v;
					}
					return null;
				}
			);
			return $attrs;
		};
		$walk        = static function ( $nodes, $path ) use ( &$walk, &$reachable, &$alias, $scan, $content, $map, $rules, $malformed ) {
			foreach ( $nodes as $i => $child ) {
				$p = $path . '/' . ( null === $child['name'] ? 'raw' : $child['name'] ) . '[' . $i . ']';
				if ( null === $child['name'] ) {
					foreach ( origin_canvas_palette_markup_hits( substr( $content, $child['start'], $child['end'] - $child['start'] ) ) as $h ) {
						$alias[] = $p . '.' . $h;
					}
					continue;
				}
				if ( in_array( $child['name'], $rules['unreachable'], true ) ) {
					foreach ( origin_canvas_palette_markup_hits( substr( $content, $child['open_end'], $child['close_start'] - $child['open_end'] ) ) as $h ) {
						$alias[] = $p . '.' . $h;
					}
					$scan( $child['attrs_text'], $p, $alias );
					continue;
				}
				if ( $malformed ) {
					$attrs = $scan( $child['attrs_text'], $p, $alias );
				} else {
					$attrs = $scan( $child['attrs_text'], $p, $reachable );
				}
				if ( is_array( $attrs ) && isset( $attrs['className'] ) && is_string( $attrs['className'] ) ) {
					foreach ( preg_split( '/\s+/', $attrs['className'] ) as $tok ) {
						if ( 'has-border-color' !== $tok && preg_match( '/^has-([a-z0-9-]+?)-(background-color|border-color|color)$/D', $tok, $m ) && isset( $map['color'][ $m[1] ] ) ) {
							$alias[] = $p . '.className=' . $tok;
						}
					}
				}
				$walk( origin_canvas_palette_children_of( $child ), $p );
			}
		};
		$walk( $tree['children'], $malformed ? '/malformed' : '' );
		return array(
			'reachable' => $reachable,
			'alias'     => $alias,
			'malformed' => $malformed,
		);
	}
}

if ( ! function_exists( 'origin_canvas_palette_content_slug_refs' ) ) {
	/**
	 * Of the given slugs per kind, those a reachable block references in the fields the rewrite
	 * reads: slug attributes, colour, spacing and line height paths. A malformed post references
	 * none.
	 *
	 * @param string $content Block markup.
	 * @param array  $slugs   array( 'color' => string[], 'spacing' => string[], 'lineHeight' => string[] ).
	 * @return array{color: string[], spacing: string[], lineHeight: string[]}
	 */
	function origin_canvas_palette_content_slug_refs( $content, $slugs ) {
		$content = (string) $content;
		$want    = array(
			'color'      => isset( $slugs['color'] ) ? array_flip( (array) $slugs['color'] ) : array(),
			'spacing'    => isset( $slugs['spacing'] ) ? array_flip( (array) $slugs['spacing'] ) : array(),
			'lineHeight' => isset( $slugs['lineHeight'] ) ? array_flip( (array) $slugs['lineHeight'] ) : array(),
		);
		$refs    = array(
			'color'      => array(),
			'spacing'    => array(),
			'lineHeight' => array(),
		);
		$tree    = origin_canvas_palette_parse( $content );
		if ( $tree['malformed'] || ( ! $want['color'] && ! $want['spacing'] && ! $want['lineHeight'] ) ) {
			return $refs;
		}
		$rules = origin_canvas_palette_rules();
		$note  = static function ( $p, $v ) use ( &$refs, $want ) {
			$kinds = origin_canvas_palette_path_kinds( $p );
			if ( $kinds['slug'] ) {
				if ( isset( $want['color'][ $v ] ) ) {
					$refs['color'][ $v ] = true;
				}
				return null;
			}
			if ( $kinds['color'] ) {
				if ( preg_match( '/^var:preset\|color\|([a-z0-9-]+)$/D', $v, $m ) && isset( $want['color'][ $m[1] ] ) ) {
					$refs['color'][ $m[1] ] = true;
				}
				if ( preg_match_all( '/var\(--wp--preset--color--([a-z0-9-]+)\)/', $v, $all ) ) {
					foreach ( $all[1] as $s ) {
						if ( isset( $want['color'][ $s ] ) ) {
							$refs['color'][ $s ] = true;
						}
					}
				}
			}
			if ( $kinds['spacing'] && preg_match( '/^var:preset\|spacing\|([a-z0-9-]+)$/D', $v, $m ) && isset( $want['spacing'][ $m[1] ] ) ) {
				$refs['spacing'][ $m[1] ] = true;
			}
			if ( $kinds['lineHeight'] && preg_match_all( '/var\(--wp--custom--line-height--([a-z0-9-]+)\)/', $v, $all ) ) {
				foreach ( $all[1] as $s ) {
					if ( isset( $want['lineHeight'][ $s ] ) ) {
						$refs['lineHeight'][ $s ] = true;
					}
				}
			}
			return null;
		};
		$walk  = static function ( $nodes ) use ( &$walk, $note, $rules ) {
			foreach ( $nodes as $child ) {
				if ( null === $child['name'] || in_array( $child['name'], $rules['unreachable'], true ) ) {
					continue;
				}
				if ( '' !== $child['attrs_text'] && null !== origin_canvas_palette_decode_attrs( $child['attrs_text'] ) ) {
					origin_canvas_palette_edit_json_strings( $child['attrs_text'], $note );
				}
				$walk( origin_canvas_palette_children_of( $child ) );
			}
		};
		$walk( $tree['children'] );
		foreach ( $refs as $kind => $set ) {
			$list = array_keys( $set );
			sort( $list, SORT_STRING );
			$refs[ $kind ] = $list;
		}
		return $refs;
	}
}

if ( ! function_exists( 'origin_canvas_palette_css_hits' ) ) {
	/**
	 * Old codes in a CSS or markup text: old variables, var:preset and var:custom references, and
	 * old class names (never core's generic has-border-color).
	 *
	 * @param string $css Text.
	 * @return string[]
	 */
	function origin_canvas_palette_css_hits( $css ) {
		$css  = (string) $css;
		$map  = origin_canvas_palette_map();
		$hits = array();
		$end   = origin_canvas_palette_ident_end();
		$lead  = '(?<![-A-Za-z0-9_])'; // --my--wp--preset--color--… is another variable.
		$forms = array(
			'color'      => array( '/' . $lead . '--wp--preset--color--([a-z0-9-]+)' . $end . '/', '/' . $lead . 'var:preset\|color\|([a-z0-9-]+)' . $end . '/' ),
			'spacing'    => array( '/' . $lead . '--wp--preset--spacing--([a-z0-9-]+)' . $end . '/', '/' . $lead . 'var:preset\|spacing\|([a-z0-9-]+)' . $end . '/' ),
			'lineHeight' => array( '/' . $lead . '--wp--custom--line-height--([a-z0-9-]+)' . $end . '/', '/' . $lead . 'var:custom\|line-height\|([a-z0-9-]+)' . $end . '/' ),
		);
		foreach ( $forms as $kind => $patterns ) {
			foreach ( $patterns as $re ) {
				if ( preg_match_all( $re, $css, $m ) ) {
					foreach ( $m[1] as $slug ) {
						if ( isset( $map[ $kind ][ $slug ] ) ) {
							$hits[] = 'var~' . $kind . '-' . $slug;
						}
					}
				}
			}
		}
		if ( preg_match_all( '/(?<![a-zA-Z0-9_-])has-([a-z0-9-]+?)-(background-color|border-color|color)(?![a-zA-Z0-9_-])/', $css, $m, PREG_SET_ORDER ) ) {
			foreach ( $m as $x ) {
				if ( 'has-border-color' !== $x[0] && isset( $map['color'][ $x[1] ] ) ) {
					$hits[] = 'class=' . $x[0];
				}
			}
		}
		return array_values( array_unique( $hits ) );
	}
}

if ( ! function_exists( 'origin_canvas_palette_css_code_hits' ) ) {
	/**
	 * Old codes in a stylesheet's code: as origin_canvas_palette_css_hits(), outside comments,
	 * quoted strings and url() arguments, which the rewrite also leaves. A comment that names an
	 * old variable is not an old code in use. An escape or a non-ASCII byte is read as a name
	 * byte, as CSS reads it.
	 *
	 * An old class counts only where the rewrite reads one: a class token in a style rule's
	 * selector (.has-text-muted-color, or the one-class value of [class~=…] or [class=…]), nested
	 * or inside a descended at-rule. An old class name in any other attribute's value or in a
	 * declaration value is text, not a recognised colour field, so it does not mark a site. A rule
	 * a browser drops (a selector that does not balance) is read as nothing, as the rewrite leaves it.
	 *
	 * @param string $css CSS.
	 * @return string[]
	 */
	function origin_canvas_palette_css_code_hits( $css ) {
		$code = array();
		origin_canvas_palette_css_map_outside(
			origin_canvas_palette_css_scan(
				(string) $css,
				static function () {
					return null;
				},
				true,
				false
			),
			static function ( $plain ) use ( &$code ) {
				$code[] = preg_replace( '/\\\\.?|[\x80-\xff]/s', '_', $plain );
				return $plain;
			}
		);
		$hits = array();
		foreach ( origin_canvas_palette_css_hits( implode( ' ', $code ) ) as $h ) {
			if ( 0 !== strpos( $h, 'class=' ) ) {
				$hits[] = $h;
			}
		}
		$classes = origin_canvas_palette_old_classes();
		origin_canvas_palette_css_scan(
			(string) $css,
			static function ( $prelude ) use ( &$hits, $classes ) {
				foreach ( origin_canvas_palette_css_tokens( $prelude, $classes ) as $t ) {
					$hits[] = 'class=' . $t['cls'];
				}
				return null;
			},
			true
		);
		return array_values( array_unique( $hits ) );
	}
}

if ( ! function_exists( 'origin_canvas_palette_json_hits' ) ) {
	/**
	 * Old codes in the strings of a decoded JSON value (a child theme.json, a Customizer
	 * changeset): a CSS string (under a key named css, or a custom_css setting's value) is read as
	 * code, every other string as a value: only its old variables and var:preset or var:custom
	 * references count. An old class name in a value (a tagline, a description) is text, not a
	 * recognised colour field, so it does not mark a site.
	 *
	 * @param mixed  $v   Decoded value.
	 * @param string $key Its key.
	 * @return bool
	 */
	function origin_canvas_palette_json_hits( $v, $key = '' ) {
		if ( is_string( $v ) ) {
			if ( 'css' === $key ) {
				return (bool) origin_canvas_palette_css_code_hits( $v );
			}
			foreach ( origin_canvas_palette_css_hits( $v ) as $h ) {
				if ( 0 !== strpos( $h, 'class=' ) ) {
					return true;
				}
			}
			return false;
		}
		if ( is_object( $v ) ) {
			$v = get_object_vars( $v );
		}
		if ( ! is_array( $v ) ) {
			return false;
		}
		foreach ( $v as $k => $x ) {
			// A changeset holds Additional CSS as custom_css[<stylesheet>] => { value: <css> }.
			if ( 0 === strpos( (string) $k, 'custom_css[' ) && ( is_array( $x ) || is_object( $x ) ) ) {
				$x = (array) $x;
				if ( isset( $x['value'] ) && is_string( $x['value'] ) && origin_canvas_palette_css_code_hits( $x['value'] ) ) {
					return true;
				}
				continue;
			}
			if ( origin_canvas_palette_json_hits( $x, (string) $k ) ) {
				return true;
			}
		}
		return false;
	}
}
