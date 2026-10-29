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
	 * Which recognised field an attribute path is: 'slug', 'color', 'spacing', 'lineHeight', 'css'
	 * or ''. A colour path can also be '' for kinds below; callers test each kind. css is the
	 * block's own Additional CSS (WordPress 7.0, block-supports/custom-css.php: style.css), which
	 * core prints as a block's custom CSS.
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
			'css'        => 2 === count( $p ) && 'style' === $p[0] && 'css' === $p[1],
		);
		if ( isset( $p[0] ) && 'style' === $p[0] ) {
			$second          = isset( $p[1] ) ? $p[1] : null;
			$kinds['color']  = 'color' === $second
				|| ( 'elements' === $second && in_array( 'color', array_slice( $p, 2 ), true ) )
				|| ( 'border' === $second && ( ( isset( $p[2] ) && 'color' === $p[2] ) || ( isset( $p[3] ) && 'color' === $p[3] ) ) );
			$kinds['spacing'] = 'spacing' === $second;
			// The line height field only: a fontFamily or letterSpacing that names the variable is text.
			$kinds['lineHeight'] = 'typography' === $second && 3 === count( $p ) && 'lineHeight' === $p[2];
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
		if ( $kinds['css'] ) {
			// Read as core prints it; it is not in the markup, so the block's tags take no edit for it.
			$out = origin_canvas_palette_rewrite_block_css( $v, $extra, true, $extra );
			return $out === $v ? null : $out;
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
			// Walked as CSS: a quoted string, a url() argument or a comment keeps its bytes.
			$out = origin_canvas_palette_css_map_outside(
				$out,
				static function ( $plain ) use ( &$seen, $extra ) {
					return preg_replace_callback(
						'/var\(--wp--preset--color--([a-z0-9-]+)\)/',
						static function ( $m ) use ( &$seen, $extra ) {
							$to = origin_canvas_palette_lookup( 'color', $m[1], $extra );
							if ( '' === $to ) {
								return $m[0];
							}
							$seen['vars'][ $m[1] ] = true;
							return 'var(--wp--preset--color--' . $to . ')';
						},
						$plain
					);
				}
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
			$out = origin_canvas_palette_css_map_outside(
				$out,
				static function ( $plain ) use ( &$seen, $extra ) {
					return preg_replace_callback(
						'/var\(--wp--custom--line-height--([a-z0-9-]+)\)/',
						static function ( $m ) use ( &$seen, $extra ) {
							$to = origin_canvas_palette_lookup( 'lineHeight', $m[1], $extra );
							if ( '' === $to ) {
								return $m[0];
							}
							$seen['lineHeight'][ $m[1] ] = true;
							return 'var(--wp--custom--line-height--' . $to . ')';
						},
						$plain
					);
				}
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

if ( ! function_exists( 'origin_canvas_palette_attr_decode' ) ) {
	/**
	 * A raw attribute value decoded as core's tag processor reads it, with the raw offset of each
	 * decoded byte and, last, the raw length, so a span of the decoded text maps back to its bytes.
	 *
	 * @param string $raw Raw attribute value.
	 * @return array array( decoded text, int[] raw offsets ).
	 */
	function origin_canvas_palette_attr_decode( $raw ) {
		$raw  = (string) $raw;
		$len  = strlen( $raw );
		$text = '';
		$at   = array();
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
		$at[] = $len;
		return array( $text, $at );
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
		$raw               = (string) $raw;
		list( $text, $at ) = origin_canvas_palette_attr_decode( $raw );
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

if ( ! function_exists( 'origin_canvas_palette_attr_map_decls' ) ) {
	/**
	 * Apply $fn( text, property ) to the value of each declaration of a style attribute's raw
	 * value, outside its strings, comments, url() arguments and escapes; every other byte, character
	 * references included, is kept. Declarations are found in the decoded CSS, as core's tag
	 * processor gives it, so a &quot; in a value does not end it.
	 *
	 * @param string   $raw Raw attribute value.
	 * @param callable $fn  ( string, string ) => string; the property is lower-cased.
	 * @return string
	 */
	function origin_canvas_palette_attr_map_decls( $raw, $fn ) {
		$raw               = (string) $raw;
		list( $text, $at ) = origin_canvas_palette_attr_decode( $raw );
		$out  = $raw;
		foreach ( array_reverse( origin_canvas_palette_css_declarations( '{' . $text . '}' ) ) as $d ) {
			$from = $at[ $d['value_start'] - 1 ];
			$to   = $at[ $d['value_end'] - 1 ];
			$prop = strtolower( $d['prop'] );
			$out  = substr( $out, 0, $from ) . origin_canvas_palette_attr_map_outside(
				substr( $raw, $from, $to - $from ),
				static function ( $plain ) use ( $fn, $prop ) {
					return $fn( $plain, $prop );
				}
			) . substr( $out, $to );
		}
		return $out;
	}
}

if ( ! function_exists( 'origin_canvas_palette_class_split' ) ) {
	/**
	 * A raw class attribute value split as HTML reads it: tokens and the HTML whitespace between
	 * them, written raw or as a character reference (&#32;, &#x9;, &Tab;, &NewLine;), each
	 * separator kept as one element of the list (odd offsets), with its bytes.
	 *
	 * @param string $raw Raw attribute value.
	 * @return string[]
	 */
	function origin_canvas_palette_class_split( $raw ) {
		return preg_split( '/((?:[ \t\n\f\r]|&#0*(?:32|9|10|12|13)(?![0-9]);?|&#[xX]0*(?:20|9|[aAcCdD])(?![0-9a-fA-F]);?|&(?:Tab|NewLine);)+)/', (string) $raw, -1, PREG_SPLIT_DELIM_CAPTURE );
	}
}

if ( ! function_exists( 'origin_canvas_palette_own_codes' ) ) {
	/**
	 * The codes in a block's own tags (its own HTML, not its inner blocks'), read as
	 * origin_canvas_palette_markup_hits() reads raw HTML: colour classes in class attributes and
	 * variables in style attributes that the map, or the collision map, renames. Core's Highlight
	 * format saves <mark class="has-inline-color has-text-muted-color"> in a paragraph's text, which
	 * the block's content attribute is read from, so a rename there keeps the block valid.
	 *
	 * A code the block's attributes still name after their rename (a custom class in className, a
	 * shadow on the variable) is held: save() writes it from them, so it keeps its name and only
	 * the aliases carry it. So is a code whose old slug is, bare, the whole of an attribute string
	 * after the rename: a block's own colour attribute (withColors( { titleColor: 'color' } ), a
	 * deprecated Pullquote's mainColor) holds the slug under a key the map does not know, and
	 * save() writes the class or variable from it. List of array( 'kind', 'slug', 'to', 'class'
	 * (the class token, or '' for a variable), 'held' ). Variables are compared decoded on both
	 * sides, so the attribute and the markup move together or neither moves.
	 *
	 * @param string      $content Markup.
	 * @param array       $node    Block node.
	 * @param string|null $after   The block's attribute JSON after its rename ('' for none), or null
	 *                             when it does not parse: every code is then held.
	 * @param array       $extra   Collision map.
	 * @return array
	 */
	function origin_canvas_palette_own_codes( $content, $node, $after, $extra = array() ) {
		$held = array();
		if ( null !== $after && '' !== $after ) {
			origin_canvas_palette_edit_json_strings(
				$after,
				static function ( $q, $v ) use ( &$held ) {
					$held[] = $v;
					return null;
				}
			);
		}
		// The variables the attributes name, read as CSS reads them, the form the markup's names are
		// compared in: a shadow on text-mute\64 holds --wp--preset--color--text-muted, which save()
		// writes back from it.
		$vars = array();
		foreach ( $held as $v ) {
			foreach ( origin_canvas_palette_css_var_refs( $v ) as $r ) {
				$vars[ $r[2] ] = true;
			}
		}
		$bare  = array_fill_keys( $held, true );
		$held  = implode( "\n", $held );
		$named = static function ( $text, $slug ) use ( $held, $after, $bare, $vars ) {
			return null === $after || isset( $bare[ $slug ] ) || isset( $vars[ $text ] ) || 1 === preg_match( '/(?<![A-Za-z0-9_-])' . preg_quote( $text, '/' ) . '(?![A-Za-z0-9_-])/', $held );
		};
		$pipes = array(
			'color'      => 'var:preset|color|',
			'spacing'    => 'var:preset|spacing|',
			'lineHeight' => 'var:custom|line-height|',
		);
		$out   = array();
		foreach ( $node['segments'] as $seg ) {
			if ( ! isset( $seg['text'] ) ) {
				continue;
			}
			$html = substr( $content, $seg['text'][0], $seg['text'][1] - $seg['text'][0] );
			foreach ( Origin_Canvas_Palette_Tag_Scanner::openers( $html ) as $t ) {
				foreach ( origin_canvas_palette_class_split( origin_canvas_palette_tag_value( $t[1], 'class' ) ) as $k => $raw ) {
					$tok = 1 === $k % 2 ? '' : WP_HTML_Decoder::decode_attribute( $raw );
					// has-border-color alone is core's generic class, never a code.
					if ( 'has-border-color' === $tok || 0 !== strpos( $tok, 'has-' ) ) {
						continue;
					}
					foreach ( array( 'background-color', 'border-color', 'color' ) as $kind ) {
						$slug = substr( $tok, 4, - strlen( '-' . $kind ) );
						if ( '-' . $kind === substr( $tok, - strlen( '-' . $kind ) ) && '' !== (string) $slug && '' !== origin_canvas_palette_lookup( 'color', $slug, $extra ) ) {
							$to    = 'has-' . origin_canvas_palette_lookup( 'color', $slug, $extra ) . '-' . $kind;
							$out[] = array(
								'kind'  => 'color',
								'slug'  => $slug,
								'to'    => $to,
								'class' => $tok,
								'held'  => $named( $tok, $slug ),
							);
							break;
						}
					}
				}
				foreach ( origin_canvas_palette_css_var_refs( WP_HTML_Decoder::decode_attribute( origin_canvas_palette_tag_value( $t[1], 'style' ) ) ) as $r ) {
					$v  = origin_canvas_palette_css_var_kind( $r[2] );
					$to = $v ? origin_canvas_palette_lookup( $v[0], $v[2], $extra ) : '';
					if ( '' !== $to ) {
						$out[] = array(
							'kind'  => $v[0],
							'slug'  => $v[2],
							'to'    => $to,
							'class' => '',
							'held'  => $named( $v[1] . $v[2], $v[2] ) || $named( $pipes[ $v[0] ] . $v[2], $v[2] ),
						);
					}
				}
			}
		}
		return $out;
	}
}

if ( ! function_exists( 'origin_canvas_palette_html_codes' ) ) {
	/**
	 * Rename the codes in the tags of an HTML string that a block stores in its attributes (a
	 * navigation link's label, origin_canvas_palette_rules()['html_attrs']), read as
	 * origin_canvas_palette_own_codes() reads a block's own tags: colour classes in class
	 * attributes and variables in style attributes, decoded. A renamed code is written plain;
	 * every other byte stays. The string is the block's source, so the block stays valid.
	 *
	 * @param string $html  HTML.
	 * @param array  $extra Collision map.
	 * @return array array( the renamed HTML, list of array( 'kind', 'slug', 'to', 'class' ) ).
	 */
	function origin_canvas_palette_html_codes( $html, $extra = array() ) {
		$out   = (string) $html;
		$codes = array();
		foreach ( array_reverse( Origin_Canvas_Palette_Tag_Scanner::openers( $out ) ) as $t ) {
			$tag     = $t[1];
			$changes = array();
			$class   = origin_canvas_palette_tag_attribute( $tag, 'class' );
			if ( null !== $class ) {
				$parts = origin_canvas_palette_class_split( substr( $tag, $class[0], $class[1] ) );
				foreach ( $parts as $k => $raw ) {
					$tok = 1 === $k % 2 ? '' : WP_HTML_Decoder::decode_attribute( $raw );
					if ( 'has-border-color' === $tok || 0 !== strpos( $tok, 'has-' ) ) {
						continue;
					}
					foreach ( array( 'background-color', 'border-color', 'color' ) as $kind ) {
						$slug = substr( $tok, 4, - strlen( '-' . $kind ) );
						$to   = '-' . $kind === substr( $tok, - strlen( '-' . $kind ) ) && '' !== (string) $slug ? origin_canvas_palette_lookup( 'color', $slug, $extra ) : '';
						if ( '' !== $to ) {
							$parts[ $k ] = 'has-' . $to . '-' . $kind;
							$codes[]     = array(
								'kind'  => 'color',
								'slug'  => $slug,
								'to'    => $to,
								'class' => $tok,
							);
							break;
						}
					}
				}
				$changes[] = array( $class[0], $class[1], implode( '', $parts ) );
			}
			$style = origin_canvas_palette_tag_attribute( $tag, 'style' );
			if ( null !== $style ) {
				$v                 = substr( $tag, $style[0], $style[1] );
				list( $text, $at ) = origin_canvas_palette_attr_decode( $v );
				foreach ( array_reverse( origin_canvas_palette_css_var_refs( $text ) ) as $ref ) {
					$kv = origin_canvas_palette_css_var_kind( $ref[2] );
					$to = $kv ? origin_canvas_palette_lookup( $kv[0], $kv[2], $extra ) : '';
					if ( '' !== $to ) {
						$v       = substr( $v, 0, $at[ $ref[0] ] ) . $kv[1] . $to . substr( $v, $at[ $ref[1] ] );
						$codes[] = array(
							'kind'  => $kv[0],
							'slug'  => $kv[2],
							'to'    => $to,
							'class' => '',
						);
					}
				}
				$changes[] = array( $style[0], $style[1], $v );
			}
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
			$out = substr( $out, 0, $t[0] ) . $next . substr( $out, $t[0] + strlen( $tag ) );
		}
		return array( $out, $codes );
	}
}

if ( ! function_exists( 'origin_canvas_palette_is_html_attr' ) ) {
	/**
	 * Whether an attribute path of a named block is one of its HTML attributes
	 * (origin_canvas_palette_rules()['html_attrs']), read and renamed as markup.
	 *
	 * @param string $name Block name.
	 * @param array  $p    Path.
	 * @return bool
	 */
	function origin_canvas_palette_is_html_attr( $name, $p ) {
		$rules = origin_canvas_palette_rules();
		return 1 === count( $p ) && isset( $rules['html_attrs'][ $name ] ) && in_array( $p[0], $rules['html_attrs'][ $name ], true );
	}
}

if ( ! function_exists( 'origin_canvas_palette_rename_attr' ) ) {
	/**
	 * Rename old references in one attribute string value of a named block: an HTML attribute of
	 * the block (origin_canvas_palette_rules()['html_attrs']) as markup, any other value as
	 * origin_canvas_palette_rename_value() reads it.
	 *
	 * @param string $name  Block name.
	 * @param array  $p     Path.
	 * @param string $v     Value.
	 * @param array  $seen  What the attributes renamed.
	 * @param array  $extra Collision map.
	 * @return string|null The new value, or null when unchanged.
	 */
	function origin_canvas_palette_rename_attr( $name, $p, $v, &$seen, $extra ) {
		if ( origin_canvas_palette_is_html_attr( $name, $p ) ) {
			$out = origin_canvas_palette_html_codes( $v, $extra )[0];
			return $out === $v ? null : $out;
		}
		return origin_canvas_palette_rename_value( $p, $v, $seen, $extra );
	}
}

if ( ! function_exists( 'origin_canvas_palette_renamed_attrs' ) ) {
	/**
	 * A block's attribute JSON after the rename, as origin_canvas_palette_rewrite_content() writes
	 * it: '' for none, null when it does not parse.
	 *
	 * @param string $attrs_text Attribute JSON.
	 * @param array  $extra      Collision map.
	 * @param string $name       Block name.
	 * @return string|null
	 */
	function origin_canvas_palette_renamed_attrs( $attrs_text, $extra = array(), $name = '' ) {
		if ( '' === $attrs_text ) {
			return '';
		}
		if ( null === origin_canvas_palette_decode_attrs( $attrs_text ) ) {
			return null;
		}
		$seen = origin_canvas_palette_new_seen();
		return origin_canvas_palette_edit_json_strings(
			$attrs_text,
			static function ( $p, $v ) use ( &$seen, $extra, $name ) {
				return origin_canvas_palette_rename_attr( $name, $p, $v, $seen, $extra );
			}
		);
	}
}

if ( ! function_exists( 'origin_canvas_palette_tag_edits' ) ) {
	/**
	 * Edits for one block's own tags, from what its attributes renamed, and for the codes in them
	 * the attributes do not hold (origin_canvas_palette_own_codes()).
	 *
	 * @param string $content Markup.
	 * @param array  $node    Block node.
	 * @param mixed  $attrs   Decoded attributes.
	 * @param array  $seen    What the attributes renamed.
	 * @param array  $extra   Collision map.
	 * @param string $after   The attribute JSON after the rename ('' for none).
	 * @return array List of array( start, end, replacement ).
	 */
	function origin_canvas_palette_tag_edits( $content, $node, $attrs, $seen, $extra, $after = '' ) {
		$free_class = array();
		$free_var   = array();
		foreach ( origin_canvas_palette_own_codes( $content, $node, $after, $extra ) as $c ) {
			if ( $c['held'] ) {
				continue;
			}
			if ( '' !== $c['class'] ) {
				$free_class[ $c['class'] ] = $c['to'];
			} else {
				$free_var[ $c['kind'] ][ $c['slug'] ] = $c['to'];
			}
		}
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
		// Each rename reaches only the declarations core writes for its kind of field: a shadow or a
		// font family that names the same variable keeps it, as its attribute does.
		$props    = array(
			'color'      => '/^(color|background|background-color|border(-(top|right|bottom|left))?-color)$/D',
			'spacing'    => '/^((padding|margin)(-(top|right|bottom|left))?|gap|row-gap|column-gap)$/D',
			'lineHeight' => '/^line-height$/D',
		);
		$style_re = array();
		foreach ( array_keys( $seen['vars'] ) as $s ) {
			$style_re[] = array( '/var\(--wp--preset--color--' . preg_quote( $s, '/' ) . '\)/', 'var(--wp--preset--color--' . origin_canvas_palette_lookup( 'color', $s, $extra ) . ')', $props['color'] );
		}
		foreach ( array_keys( $seen['spacing'] ) as $s ) {
			$style_re[] = array( '/var\(--wp--preset--spacing--' . preg_quote( $s, '/' ) . '\)/', 'var(--wp--preset--spacing--' . origin_canvas_palette_lookup( 'spacing', $s, $extra ) . ')', $props['spacing'] );
		}
		foreach ( array_keys( $seen['lineHeight'] ) as $s ) {
			$style_re[] = array( '/var\(--wp--custom--line-height--' . preg_quote( $s, '/' ) . '\)/', 'var(--wp--custom--line-height--' . origin_canvas_palette_lookup( 'lineHeight', $s, $extra ) . ')', $props['lineHeight'] );
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
					foreach ( origin_canvas_palette_class_split( origin_canvas_palette_tag_value( $t[1], 'class' ) ) as $x ) {
						if ( 'has-border-color' === WP_HTML_Decoder::decode_attribute( $x ) ) {
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
					// A token is compared by its value, character references decoded as core's tag
					// processor and the editor read it (has-text&#45;muted-color is has-text-muted-color),
					// and tokens are split at HTML whitespace written raw or as a reference (&#32;, &Tab;);
					// a renamed token is written plain, every other token and separator keeps its bytes.
					$parts   = origin_canvas_palette_class_split( substr( $tag, $class[0], $class[1] ) );
					$decoded = array();
					foreach ( $parts as $k => $tok ) {
						$decoded[ $k ] = 1 === $k % 2 ? ' ' : ( false === strpos( $tok, '&' ) ? $tok : WP_HTML_Decoder::decode_attribute( $tok ) );
						foreach ( $class_renames as $rename ) {
							if ( $rename[0] === $decoded[ $k ] ) {
								$parts[ $k ] = $rename[1];
								break;
							}
						}
						if ( 0 === $k % 2 && $parts[ $k ] === $tok && isset( $free_class[ $decoded[ $k ] ] ) ) {
							$parts[ $k ] = $free_class[ $decoded[ $k ] ];
						}
					}
					if ( null !== $border_text && ! $border_done ) {
						$idx = array_search( 'has-border-color', $decoded, true );
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
					$v         = origin_canvas_palette_attr_map_decls(
						substr( $tag, $style[0], $style[1] ),
						static function ( $plain, $prop ) use ( $style_re ) {
							// Every reference is read decoded, as core's tag processor and the editor read
							// it (var&#40;--wp--preset--color--text&#45;muted&#41; is the old variable), and
							// all of them at once, so one written plain and one with references in the same
							// value both move. A renamed reference is written plain; every other byte,
							// character references included, keeps its bytes.
							list( $text, $at ) = origin_canvas_palette_attr_decode( $plain );
							$found             = array();
							foreach ( $style_re as $re ) {
								if ( preg_match( $re[2], $prop ) && preg_match_all( $re[0], $text, $m, PREG_OFFSET_CAPTURE ) ) {
									foreach ( $m[0] as $x ) {
										$found[ $x[1] ] = array( $x[1] + strlen( $x[0] ), $re[1] );
									}
								}
							}
							krsort( $found );
							foreach ( $found as $from => $f ) {
								$plain = substr( $plain, 0, $at[ $from ] ) . $f[1] . substr( $plain, $at[ $f[0] ] );
							}
							return $plain;
						}
					);
					// Then the codes the attributes do not hold, read as markup_hits() reads them
					// (comments around the name, CSS escapes); each name is written plain.
					if ( $free_var ) {
						list( $text, $at ) = origin_canvas_palette_attr_decode( $v );
						foreach ( array_reverse( origin_canvas_palette_css_var_refs( $text ) ) as $ref ) {
							$kv = origin_canvas_palette_css_var_kind( $ref[2] );
							if ( $kv && isset( $free_var[ $kv[0] ][ $kv[2] ] ) ) {
								$v = substr( $v, 0, $at[ $ref[0] ] ) . $kv[1] . $free_var[ $kv[0] ][ $kv[2] ] . substr( $v, $at[ $ref[1] ] );
							}
						}
					}
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
				$attrs = '' === $child['attrs_text'] ? array() : origin_canvas_palette_decode_attrs( $child['attrs_text'] );
				if ( null !== $attrs ) {
					$seen = origin_canvas_palette_new_seen();
					$next = '' === $child['attrs_text'] ? '' : origin_canvas_palette_edit_json_strings(
						$child['attrs_text'],
						static function ( $p, $v ) use ( &$seen, $extra, $child ) {
							return origin_canvas_palette_rename_attr( $child['name'], $p, $v, $seen, $extra );
						}
					);
					if ( $next !== $child['attrs_text'] ) {
						$edits[] = array( $child['attrs_start'], $child['attrs_start'] + strlen( $child['attrs_text'] ), $next );
					}
					// The block's own tags: what the attributes renamed, and the codes they do not hold
					// (an inline Highlight class in the text), with or without an attribute change.
					foreach ( origin_canvas_palette_tag_edits( $content, $child, $attrs, $seen, $extra, $next ) as $e ) {
						$edits[] = $e;
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
	 * strings and comments; and in the text of each <style> element, read as Additional CSS is.
	 *
	 * @param string $markup Markup.
	 * @return string[]
	 */
	function origin_canvas_palette_markup_hits( $markup ) {
		$map  = origin_canvas_palette_map();
		$hits = array();
		foreach ( Origin_Canvas_Palette_Tag_Scanner::openers( $markup ) as $t ) {
			// Tokens split and compared as HTML reads them: has-text&#45;muted-color is the old class.
			foreach ( origin_canvas_palette_class_split( origin_canvas_palette_tag_value( $t[1], 'class' ) ) as $k => $raw ) {
				$tok = 1 === $k % 2 ? '' : WP_HTML_Decoder::decode_attribute( $raw );
				// has-border-color alone is core's generic class: not evidence.
				if ( 'has-border-color' !== $tok && preg_match( '/^has-([a-z0-9-]+?)-(background-color|border-color|color)$/D', $tok, $m ) && isset( $map['color'][ $m[1] ] ) ) {
					$hits[] = 'class=' . $tok;
				}
			}
			// Every old preset variable in the style attribute, decoded as HTML reads it and read as
			// CSS reads var(): outside strings and comments, with comments allowed around the name
			// (var(/**/--wp--preset--color--text-muted)).
			foreach ( origin_canvas_palette_css_var_refs( WP_HTML_Decoder::decode_attribute( origin_canvas_palette_tag_value( $t[1], 'style' ) ) ) as $r ) {
				$v = origin_canvas_palette_css_var_kind( $r[2] );
				if ( $v && isset( $map[ $v[0] ][ $v[2] ] ) ) {
					$hits[] = 'style~' . ( 'color' === $v[0] ? '' : $v[0] . '-' ) . $v[2];
				}
			}
		}
		// A <style> element's text is a stylesheet: its old classes in selectors and its old
		// variables are working references, which only the aliases carry.
		$p = new WP_HTML_Tag_Processor( (string) $markup );
		while ( $p->next_tag( 'STYLE' ) ) {
			foreach ( origin_canvas_palette_css_code_hits( (string) $p->get_modifiable_text() ) as $h ) {
				$hits[] = 'style-element:' . $h;
			}
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
		$scan        = static function ( $attrs_text, $p, &$into, $name = '' ) use ( $extra, $map, &$alias ) {
			$attrs = origin_canvas_palette_decode_attrs( $attrs_text );
			if ( null === $attrs ) {
				return null;
			}
			origin_canvas_palette_edit_json_strings(
				$attrs_text,
				static function ( $q, $v ) use ( &$into, $p, $extra, $map, &$alias, $name ) {
					$s = origin_canvas_palette_new_seen();
					if ( null !== origin_canvas_palette_rename_attr( $name, $q, $v, $s, $extra ) ) {
						$into[] = $p . '.' . implode( '.', $q ) . '=' . $v;
					} elseif ( ! origin_canvas_palette_is_html_attr( $name, $q ) && false !== strpos( $v, '<' ) ) {
						// Tags in any other attribute string (a third-party block's rich-text label), read
						// as the HTML attributes are: the rewrite does not know the block, so only the
						// aliases carry them, as for core/html.
						foreach ( origin_canvas_palette_html_codes( $v, $extra )[1] as $c ) {
							$alias[] = $p . '.' . implode( '.', $q ) . '.html.' . ( '' !== $c['class'] ? 'class=' . $c['class'] : 'style~' . ( 'color' === $c['kind'] ? '' : $c['kind'] . '-' ) . $c['slug'] );
						}
					}
					// An old variable core prints in the block's CSS that the bytes cannot rename (a }
					// inside the reference): only the aliases carry it.
					if ( origin_canvas_palette_path_kinds( $q )['css'] ) {
						foreach ( origin_canvas_palette_block_css_var_reading( $v )['split'] as $split ) {
							foreach ( $split[1] as $r ) {
								if ( isset( $map[ $r[0] ][ $r[1] ] ) ) {
									$alias[] = $p . '.' . implode( '.', $q ) . '~' . $r[1];
								}
							}
						}
					}
					return null;
				}
			);
			return $attrs;
		};
		$walk        = static function ( $nodes, $path ) use ( &$walk, &$reachable, &$alias, $scan, $content, $map, $rules, $malformed, $extra ) {
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
					$attrs = $scan( $child['attrs_text'], $p, $alias, $child['name'] );
				} else {
					$attrs = $scan( $child['attrs_text'], $p, $reachable, $child['name'] );
				}
				// The block's own tags: a code its attributes do not hold is renamed by the rewrite
				// (an inline Highlight class in the text); a held one only the aliases carry.
				foreach ( origin_canvas_palette_own_codes( $content, $child, origin_canvas_palette_renamed_attrs( $child['attrs_text'], $extra, $child['name'] ), $extra ) as $c ) {
					$h = $p . '.html.' . ( '' !== $c['class'] ? 'class=' . $c['class'] : 'style~' . ( 'color' === $c['kind'] ? '' : $c['kind'] . '-' ) . $c['slug'] );
					if ( $malformed || $c['held'] ) {
						$alias[] = $h;
					} else {
						$reachable[] = $h;
					}
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
	 * reads: slug attributes, colour, spacing and line height paths, and the var() references of
	 * a block's own CSS (style.css). A malformed post references none.
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
			// The value's code as the rewrite reads it: quoted strings, url() and comments left out.
			$code = array();
			origin_canvas_palette_css_map_outside(
				$v,
				static function ( $plain ) use ( &$code ) {
					$code[] = $plain;
					return $plain;
				}
			);
			$code = implode( ' ', $code );
			if ( $kinds['css'] ) {
				// A block's own CSS (style.css): its var() references are the block's references, in
				// the text core prints only (a part core does not print references nothing), and only
				// where the bytes name the same ones, so the rewrite can move each one it counts.
				foreach ( origin_canvas_palette_block_css_var_reading( $v )['refs'] as $r ) {
					if ( isset( $want[ $r[0] ][ $r[1] ] ) ) {
						$refs[ $r[0] ][ $r[1] ] = true;
					}
				}
				return null;
			}
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
				if ( preg_match_all( '/var\(--wp--preset--color--([a-z0-9-]+)\)/', $code, $all ) ) {
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
			if ( $kinds['lineHeight'] && preg_match_all( '/var\(--wp--custom--line-height--([a-z0-9-]+)\)/', $code, $all ) ) {
				foreach ( $all[1] as $s ) {
					if ( isset( $want['lineHeight'][ $s ] ) ) {
						$refs['lineHeight'][ $s ] = true;
					}
				}
			}
			return null;
		};
		// The wanted slugs as a collision map's shape, so the own-tags reader finds them.
		$named = array();
		foreach ( $want as $kind => $set ) {
			foreach ( array_keys( $set ) as $s ) {
				$named[ $kind ][ $s ] = (string) $s;
			}
		}
		$walk  = static function ( $nodes ) use ( &$walk, &$refs, $note, $rules, $content, $want, $named ) {
			foreach ( $nodes as $child ) {
				if ( null === $child['name'] || in_array( $child['name'], $rules['unreachable'], true ) ) {
					continue;
				}
				$attrs = '' === $child['attrs_text'] ? null : origin_canvas_palette_decode_attrs( $child['attrs_text'] );
				if ( null !== $attrs ) {
					origin_canvas_palette_edit_json_strings( $child['attrs_text'], $note );
					// The block's HTML attributes (a navigation link's label), as the rewrite reads them.
					foreach ( isset( $rules['html_attrs'][ $child['name'] ] ) ? $rules['html_attrs'][ $child['name'] ] : array() as $key ) {
						if ( is_array( $attrs ) && isset( $attrs[ $key ] ) && is_string( $attrs[ $key ] ) ) {
							foreach ( origin_canvas_palette_html_codes( $attrs[ $key ], $named )[1] as $c ) {
								if ( isset( $want[ $c['kind'] ][ $c['slug'] ] ) ) {
									$refs[ $c['kind'] ][ $c['slug'] ] = true;
								}
							}
						}
					}
				}
				// The block's own tags, as the rewrite moves them: the codes the attributes do not hold.
				foreach ( origin_canvas_palette_own_codes( $content, $child, origin_canvas_palette_renamed_attrs( $child['attrs_text'], array(), $child['name'] ), $named ) as $c ) {
					if ( ! $c['held'] && isset( $want[ $c['kind'] ][ $c['slug'] ] ) ) {
						$refs[ $c['kind'] ][ $c['slug'] ] = true;
					}
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

if ( ! function_exists( 'origin_canvas_palette_css_decode_names' ) ) {
	/**
	 * A CSS text with each escape decoded, as CSS reads a name: an escaped letter, digit or - is
	 * that byte (text-mute\64 is text-muted, v\61r is var); any other escaped byte, a backslash
	 * and a newline, and a non-ASCII byte are _, a name byte that is in no code. For reading only.
	 *
	 * @param string $text CSS.
	 * @return string
	 */
	function origin_canvas_palette_css_decode_names( $text ) {
		$out = '';
		$len = strlen( $text );
		for ( $i = 0; $i < $len; ) {
			$c = $text[ $i ];
			if ( '\\' === $c && $i + 1 < $len && false === strpos( "\n\r\f", $text[ $i + 1 ] ) ) {
				list( $b, $i ) = origin_canvas_palette_css_escape_at( $text, $i );
				$out          .= 1 === strspn( $b, 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-' ) ? $b : '_';
			} elseif ( '\\' === $c ) {
				$out .= '_';
				$i   += min( 2, $len - $i );
			} else {
				$out .= ord( $c ) >= 0x80 ? '_' : $c;
				++$i;
			}
		}
		return $out;
	}
}

if ( ! function_exists( 'origin_canvas_palette_css_code_hits' ) ) {
	/**
	 * Old codes in a stylesheet's code: as origin_canvas_palette_css_hits(), outside comments,
	 * quoted strings and url() arguments, which the rewrite also leaves. A comment that names an
	 * old variable is not an old code in use. Escapes are decoded and a non-ASCII byte is a name
	 * byte, as CSS reads them (--wp--preset--color--text-mute\64 is an old variable).
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
				$code[] = origin_canvas_palette_css_decode_names( $plain );
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

if ( ! function_exists( 'origin_canvas_palette_json_field' ) ) {
	/**
	 * Whether a path in a decoded theme.json (a child theme.json or style variation) is a field
	 * the rewrite reads as a style value: under styles, a value below a color, spacing or shadow
	 * key, a border or dimensions value, or a typography lineHeight (the Global Styles reader
	 * renames every style value, a shadow too); under settings or settings.blocks.<block>, a preset
	 * entry's value as the Global Styles reader reads it (origin_canvas_palette_preset_specs(): a
	 * palette colour, a gradient, a font size and its fluid min and max, a shadow, a radius or
	 * dimension size), and the spacing and custom values. Prose (a title, a description, an entry's
	 * name, outside settings custom) and other style values (a fontFamily) are not.
	 *
	 * @param array $path Keys from the root.
	 * @return bool
	 */
	function origin_canvas_palette_json_field( $path ) {
		$path = array_map( 'strval', $path );
		$n    = count( $path );
		if ( $n < 2 ) {
			return false;
		}
		// A label (an entry's name, a title, a description) is text, as in a Global Styles record
		// (origin_canvas_palette_is_label()); only under settings custom is every key a property's name.
		if ( origin_canvas_palette_is_label( $path[ $n - 1 ] ) && ! ( 'settings' === $path[0] && 'custom' === ( $path[ 'blocks' === $path[1] ? 3 : 1 ] ?? '' ) ) ) {
			return false;
		}
		if ( 'styles' === $path[0] ) {
			for ( $i = 1; $i < $n; $i++ ) {
				if ( in_array( $path[ $i ], array( 'color', 'spacing', 'shadow', 'border', 'dimensions' ), true ) || ( 'typography' === $path[ $i ] && 'lineHeight' === ( $path[ $i + 1 ] ?? '' ) ) ) {
					return true;
				}
			}
			return false;
		}
		if ( 'settings' !== $path[0] ) {
			return false;
		}
		$i = 'blocks' === $path[1] ? 3 : 1;
		$k = $path[ $i ] ?? '';
		if ( 'custom' === $k || 'spacing' === $k ) {
			return true;
		}
		// A preset entry's value: <list path>[.<origin>].<index>.<field>.
		foreach ( origin_canvas_palette_preset_specs() as $spec ) {
			list( $list, $fields ) = $spec;
			if ( array_slice( $path, $i, 2 ) !== $list ) {
				continue;
			}
			$rest = array_slice( $path, $i + 2 );
			if ( $rest && ! ctype_digit( $rest[0] ) ) {
				array_shift( $rest );
			}
			if ( $rest && ctype_digit( $rest[0] ) && in_array( implode( '.', array_slice( $rest, 1 ) ), $fields, true ) ) {
				return true;
			}
		}
		return false;
	}
}

if ( ! function_exists( 'origin_canvas_palette_json_hits' ) ) {
	/**
	 * Old codes in a decoded JSON value (a child theme.json or style variation, a Customizer
	 * changeset), read only where a colour field is: a CSS string (under a key named css, or a
	 * custom_css setting's value) as code; a string at a field origin_canvas_palette_json_field()
	 * names as a style value, its old var:preset, var:custom and var() references read as the
	 * rewrite reads them (code only: a quoted string or a comment in it is text). Any other string
	 * (a tagline, a description, a font family) is text, not a recognised colour field, so it does
	 * not mark a site.
	 *
	 * @param mixed  $v    Decoded value.
	 * @param string $key  Its key.
	 * @param array  $path Keys from the root, its key last.
	 * @return bool
	 */
	function origin_canvas_palette_json_hits( $v, $key = '', $path = array() ) {
		if ( is_string( $v ) ) {
			if ( 'css' === $key ) {
				// styles.css is a stylesheet; a css below it is block CSS, read as core prints it.
				return (bool) ( array( 'styles', 'css' ) === $path ? origin_canvas_palette_css_code_hits( $v ) : origin_canvas_palette_block_css_hits( $v ) );
			}
			return origin_canvas_palette_json_field( $path ) && origin_canvas_palette_rename_refs( $v ) !== $v;
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
			if ( origin_canvas_palette_json_hits( $x, (string) $k, array_merge( $path, array( (string) $k ) ) ) ) {
				return true;
			}
		}
		return false;
	}
}
