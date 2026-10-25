<?php
/**
 * The palette rename (#116): one CSS scanner and one twin rule. Pure.
 *
 * The twin rule serves every stylesheet the theme rewrites in place (Additional CSS, the Global
 * Styles css strings) or shadows (each child theme stylesheet, and the theme's own rules keyed on
 * a new class, for content that still holds the old one):
 *
 * - Scanner: comments, quoted strings and url() arguments are skipped and kept byte for byte;
 *   @media, @supports, @container, @layer, @scope and @document are descended into; every other
 *   at-rule is kept whole.
 * - Token: a class .c with c in the class map, in a style rule's prelude, outside strings and
 *   attribute selectors.
 * - Items: the prelude split on commas at parenthesis and bracket depth 0, outside strings.
 * - Negation: inside :not(…), each argument item holding a token gets its variants added as
 *   further arguments, so the selector excludes both names and keeps its specificity.
 * - Variants: every old/new combination of an item's positive tokens except all-old; more than
 *   four tokens: one variant, every token mapped. The original selector always stays.
 * - Declarations: old preset variables take the new names in declaration values only; a
 *   declaration of an old preset property keeps its line and gains the new name beside it.
 * - Idempotent: a second run gives the same bytes.
 *
 * @package Origin_Canvas
 */

if ( ! function_exists( 'origin_canvas_palette_old_classes' ) ) {
	/**
	 * Old => new class names, three per old colour slug, never core's generic has-border-color.
	 *
	 * @return array<string, string>
	 */
	function origin_canvas_palette_old_classes() {
		static $classes = null;
		if ( null !== $classes ) {
			return $classes;
		}
		$classes = array();
		foreach ( origin_canvas_palette_map()['color'] as $old => $new ) {
			foreach ( array( 'color', 'background-color', 'border-color' ) as $kind ) {
				$cls = 'has-' . $old . '-' . $kind;
				if ( 'has-border-color' !== $cls ) {
					$classes[ $cls ] = 'has-' . $new . '-' . $kind;
				}
			}
		}
		return $classes;
	}
}

if ( ! function_exists( 'origin_canvas_palette_rename_refs' ) ) {
	/**
	 * Rename preset references in one string that is not CSS: var:preset refs, CSS variables and
	 * the custom line height. One lookup per captured slug, the collision map first.
	 *
	 * @param string $s     The string.
	 * @param array  $extra Collision map of the map's shape.
	 * @return string
	 */
	function origin_canvas_palette_rename_refs( $s, $extra = array() ) {
		$end      = origin_canvas_palette_ident_end();
		$patterns = array(
			array( '/var:preset\|color\|([a-z0-9-]+)' . $end . '/', 'color', 'var:preset|color|' ),
			array( '/var\(--wp--preset--color--([a-z0-9-]+)\)/', 'color', 'var(--wp--preset--color--' ),
			array( '/var:preset\|spacing\|([a-z0-9-]+)' . $end . '/', 'spacing', 'var:preset|spacing|' ),
			array( '/var\(--wp--preset--spacing--([a-z0-9-]+)\)/', 'spacing', 'var(--wp--preset--spacing--' ),
			array( '/var:custom\|line-height\|([a-z0-9-]+)' . $end . '/', 'lineHeight', 'var:custom|line-height|' ),
			array( '/var\(--wp--custom--line-height--([a-z0-9-]+)\)/', 'lineHeight', 'var(--wp--custom--line-height--' ),
		);
		foreach ( $patterns as $p ) {
			$s = preg_replace_callback(
				$p[0],
				static function ( $m ) use ( $p, $extra ) {
					$to = origin_canvas_palette_lookup( $p[1], $m[1], $extra );
					if ( '' === $to ) {
						return $m[0];
					}
					return $p[2] . $to . ( ')' === substr( $m[0], -1 ) ? ')' : '' );
				},
				$s
			);
		}
		return $s;
	}
}

if ( ! function_exists( 'origin_canvas_palette_css_is_space' ) ) {
	/**
	 * Whether a byte is CSS whitespace.
	 *
	 * @param string $c One byte.
	 * @return bool
	 */
	function origin_canvas_palette_css_is_space( $c ) {
		return ' ' === $c || "\t" === $c || "\n" === $c || "\r" === $c || "\f" === $c || "\v" === $c;
	}
}

if ( ! function_exists( 'origin_canvas_palette_css_protected_at' ) ) {
	/**
	 * Length of a protected run (comment, quoted string, url() argument) starting at $i, or 0.
	 *
	 * @param string $text CSS.
	 * @param int    $i    Offset.
	 * @return int
	 */
	function origin_canvas_palette_css_protected_at( $text, $i ) {
		$len = strlen( $text );
		if ( '/' === $text[ $i ] && $i + 1 < $len && '*' === $text[ $i + 1 ] ) {
			$e = strpos( $text, '*/', $i + 2 );
			return ( false === $e ? $len : $e + 2 ) - $i;
		}
		$ch = $text[ $i ];
		if ( '"' === $ch || "'" === $ch ) {
			$j = $i + 1;
			while ( $j < $len && $text[ $j ] !== $ch ) {
				if ( '\\' === $text[ $j ] ) {
					++$j;
				} elseif ( "\n" === $text[ $j ] ) {
					break;
				}
				++$j;
			}
			return min( $j + 1, $len ) - $i;
		}
		if ( ( 'u' === $ch || 'U' === $ch ) && 0 === strncasecmp( substr( $text, $i, 4 ), 'url(', 4 ) ) {
			$prev = $i > 0 ? $text[ $i - 1 ] : '';
			if ( '' !== $prev && 1 === strspn( $prev, 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789_-' ) ) {
				return 0;
			}
			$j = $i + 4;
			while ( $j < $len && origin_canvas_palette_css_is_space( $text[ $j ] ) ) {
				++$j;
			}
			if ( $j < $len && ( '"' === $text[ $j ] || "'" === $text[ $j ] ) ) {
				return 0; // A quoted argument is a string, skipped as one.
			}
			$e = strpos( $text, ')', $j );
			return ( false === $e ? $len : $e + 1 ) - $i;
		}
		return 0;
	}
}

if ( ! function_exists( 'origin_canvas_palette_css_map_outside' ) ) {
	/**
	 * Apply $fn to the text outside comments, strings and url() arguments.
	 *
	 * @param string   $text CSS.
	 * @param callable $fn   string => string.
	 * @return string
	 */
	function origin_canvas_palette_css_map_outside( $text, $fn ) {
		$out   = '';
		$start = 0;
		$len   = strlen( $text );
		for ( $i = 0; $i < $len; ) {
			$n = origin_canvas_palette_css_protected_at( $text, $i );
			if ( $n ) {
				$out  .= $fn( substr( $text, $start, $i - $start ) ) . substr( $text, $i, $n );
				$i    += $n;
				$start = $i;
			} else {
				++$i;
			}
		}
		return $out . $fn( (string) substr( $text, $start ) );
	}
}

if ( ! function_exists( 'origin_canvas_palette_css_close_brace' ) ) {
	/**
	 * Offset of the brace that closes the block opening at $open.
	 *
	 * @param string $text CSS.
	 * @param int    $open Offset of '{'.
	 * @return int
	 */
	function origin_canvas_palette_css_close_brace( $text, $open ) {
		$depth = 0;
		$len   = strlen( $text );
		for ( $i = $open; $i < $len; ) {
			$n = origin_canvas_palette_css_protected_at( $text, $i );
			if ( $n ) {
				$i += $n;
				continue;
			}
			if ( '{' === $text[ $i ] ) {
				++$depth;
			} elseif ( '}' === $text[ $i ] ) {
				--$depth;
				if ( 0 === $depth ) {
					return $i;
				}
			}
			++$i;
		}
		return $len - 1;
	}
}

if ( ! function_exists( 'origin_canvas_palette_css_scan' ) ) {
	/**
	 * Walk the style rules. $on_rule( $prelude, $body ) returns null (unchanged) or
	 * array( 'prelude' => …, 'body' => …, 'shadow' => … ), where body includes its braces.
	 * In place: the stylesheet with each changed rule put back, every other byte kept. Shadow:
	 * only the changed rules' shadow text, inside their descended at-rule preludes.
	 *
	 * @param string   $css      CSS.
	 * @param callable $on_rule  Rule callback.
	 * @param bool     $in_place In-place or shadow output.
	 * @return string
	 */
	function origin_canvas_palette_css_scan( $css, $on_rule, $in_place ) {
		$descend = array( 'media', 'supports', 'container', 'layer', 'scope', 'document' );
		$walk    = static function ( $text ) use ( &$walk, $on_rule, $in_place, $descend ) {
			$out = '';
			$len = strlen( $text );
			$i   = 0;
			while ( $i < $len ) {
				// Leading whitespace and comments between rules.
				$j = $i;
				while ( true ) {
					while ( $j < $len && origin_canvas_palette_css_is_space( $text[ $j ] ) ) {
						++$j;
					}
					if ( $j + 1 < $len && '/' === $text[ $j ] && '*' === $text[ $j + 1 ] ) {
						$j += origin_canvas_palette_css_protected_at( $text, $j );
						continue;
					}
					break;
				}
				if ( $in_place ) {
					$out .= substr( $text, $i, $j - $i );
				}
				$i = $j;
				if ( $i >= $len ) {
					break;
				}
				// The prelude: up to { or ; at depth 0, outside protected runs.
				$k    = $i;
				$end  = -1;
				$semi = false;
				while ( $k < $len ) {
					$n = origin_canvas_palette_css_protected_at( $text, $k );
					if ( $n ) {
						$k += $n;
						continue;
					}
					if ( '{' === $text[ $k ] ) {
						$end = $k;
						break;
					}
					if ( ';' === $text[ $k ] ) {
						$end  = $k;
						$semi = true;
						break;
					}
					if ( '}' === $text[ $k ] ) {
						break; // A stray closer: keep the rest as it is.
					}
					++$k;
				}
				if ( -1 === $end ) {
					if ( $in_place ) {
						$out .= substr( $text, $i );
					}
					break;
				}
				$prelude = substr( $text, $i, $end - $i );
				if ( $semi ) {
					if ( $in_place ) {
						$out .= substr( $text, $i, $end + 1 - $i );
					}
					$i = $end + 1;
					continue;
				}
				$close = origin_canvas_palette_css_close_brace( $text, $end );
				$body  = substr( $text, $end, $close + 1 - $end );
				if ( preg_match( '/^@([a-zA-Z-]+)/', $prelude, $at ) ) {
					if ( in_array( strtolower( $at[1] ), $descend, true ) ) {
						$inner = $walk( (string) substr( $text, $end + 1, $close - $end - 1 ) );
						if ( $in_place ) {
							$out .= $prelude . '{' . $inner . '}';
						} elseif ( '' !== $inner ) {
							$out .= trim( $prelude ) . '{' . $inner . '}';
						}
					} elseif ( $in_place ) {
						$out .= $prelude . $body;
					}
				} else {
					$r = $on_rule( $prelude, $body );
					if ( $in_place ) {
						$out .= $r ? $r['prelude'] . $r['body'] : $prelude . $body;
					} elseif ( $r && isset( $r['shadow'] ) && '' !== $r['shadow'] ) {
						$out .= $r['shadow'];
					}
				}
				$i = $close + 1;
			}
			return $out;
		};
		return $walk( (string) $css );
	}
}

if ( ! function_exists( 'origin_canvas_palette_css_split_items' ) ) {
	/**
	 * Split on commas at parenthesis and bracket depth 0, outside protected runs.
	 *
	 * @param string $text Selector text.
	 * @return string[]
	 */
	function origin_canvas_palette_css_split_items( $text ) {
		$items = array();
		$depth = 0;
		$start = 0;
		$len   = strlen( $text );
		for ( $i = 0; $i < $len; ) {
			$n = origin_canvas_palette_css_protected_at( $text, $i );
			if ( $n ) {
				$i += $n;
				continue;
			}
			$ch = $text[ $i ];
			if ( '(' === $ch || '[' === $ch ) {
				++$depth;
			} elseif ( ')' === $ch || ']' === $ch ) {
				--$depth;
			} elseif ( ',' === $ch && 0 === $depth ) {
				$items[] = substr( $text, $start, $i - $start );
				$start   = $i + 1;
			}
			++$i;
		}
		$items[] = (string) substr( $text, $start );
		return $items;
	}
}

if ( ! function_exists( 'origin_canvas_palette_css_tokens' ) ) {
	/**
	 * Class tokens in a selector text that are keys of $map, outside strings and attribute
	 * selectors: list of array( start, end, cls, negated ).
	 *
	 * @param string $text Selector text.
	 * @param array  $map  Class map.
	 * @return array
	 */
	function origin_canvas_palette_css_tokens( $text, $map ) {
		$out     = array();
		$nots    = array();
		$depth   = 0;
		$bracket = 0;
		$len     = strlen( $text );
		for ( $i = 0; $i < $len; ) {
			$ch = $text[ $i ];
			$n  = ( '"' === $ch || "'" === $ch ) ? origin_canvas_palette_css_protected_at( $text, $i ) : 0;
			if ( $n ) {
				$i += $n;
				continue;
			}
			if ( '[' === $ch ) {
				++$bracket;
				++$i;
				continue;
			}
			if ( ']' === $ch ) {
				--$bracket;
				++$i;
				continue;
			}
			if ( $bracket > 0 ) {
				++$i;
				continue;
			}
			if ( ':' === $ch && 0 === strncasecmp( substr( $text, $i, 5 ), ':not(', 5 ) ) {
				++$depth;
				$nots[] = $depth;
				$i     += 5;
				continue;
			}
			if ( '(' === $ch ) {
				++$depth;
				++$i;
				continue;
			}
			if ( ')' === $ch ) {
				if ( $nots && end( $nots ) === $depth ) {
					array_pop( $nots );
				}
				--$depth;
				++$i;
				continue;
			}
			if ( '.' === $ch ) {
				$l = strspn( $text, 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789_-', $i + 1 );
				if ( $l > 0 ) {
					$cls = substr( $text, $i + 1, $l );
					if ( array_key_exists( $cls, $map ) ) {
						$out[] = array(
							'start'   => $i + 1,
							'end'     => $i + 1 + $l,
							'cls'     => $cls,
							'negated' => count( $nots ) > 0,
						);
					}
					$i += 1 + $l;
					continue;
				}
			}
			++$i;
		}
		return $out;
	}
}

if ( ! function_exists( 'origin_canvas_palette_css_variants' ) ) {
	/**
	 * Variants of an item over its positive tokens, trimmed: every old/new combination except
	 * all-old, k = 1 … 2^n − 1, token i mapped when bit i of k is set; n > 4: one, all mapped.
	 *
	 * @param string $text Item text.
	 * @param array  $map  Class map.
	 * @return string[]
	 */
	function origin_canvas_palette_css_variants( $text, $map ) {
		$pos = array();
		foreach ( origin_canvas_palette_css_tokens( $text, $map ) as $t ) {
			if ( ! $t['negated'] ) {
				$pos[] = $t;
			}
		}
		$n = count( $pos );
		if ( ! $n ) {
			return array();
		}
		$build = static function ( $mask ) use ( $text, $pos, $n, $map ) {
			$out = $text;
			for ( $i = $n - 1; $i >= 0; $i-- ) {
				if ( $mask & ( 1 << $i ) ) {
					$out = substr( $out, 0, $pos[ $i ]['start'] ) . $map[ $pos[ $i ]['cls'] ] . substr( $out, $pos[ $i ]['end'] );
				}
			}
			return trim( $out );
		};
		if ( $n > 4 ) {
			return array( $build( ( 1 << $n ) - 1 ) );
		}
		$list = array();
		for ( $k = 1; $k < ( 1 << $n ); $k++ ) {
			$list[] = $build( $k );
		}
		return $list;
	}
}

if ( ! function_exists( 'origin_canvas_palette_css_expand_negations' ) ) {
	/**
	 * Expand every :not(…) in a selector text, at any depth, with its arguments' variants.
	 *
	 * @param string $text Selector text.
	 * @param array  $map  Class map.
	 * @return string
	 */
	function origin_canvas_palette_css_expand_negations( $text, $map ) {
		$out = '';
		$i   = 0;
		$len = strlen( $text );
		while ( $i < $len ) {
			$ch = $text[ $i ];
			$n  = ( '"' === $ch || "'" === $ch ) ? origin_canvas_palette_css_protected_at( $text, $i ) : 0;
			if ( $n ) {
				$out .= substr( $text, $i, $n );
				$i   += $n;
				continue;
			}
			if ( '[' === $ch ) {
				$e    = strpos( $text, ']', $i );
				$stop = false === $e ? $len : $e + 1;
				$out .= substr( $text, $i, $stop - $i );
				$i    = $stop;
				continue;
			}
			if ( ':' === $ch && 0 === strncasecmp( substr( $text, $i, 5 ), ':not(', 5 ) ) {
				// Find the matching parenthesis.
				$depth = 0;
				for ( $j = $i + 4; $j < $len; $j++ ) {
					$c = $text[ $j ];
					$m = ( '"' === $c || "'" === $c ) ? origin_canvas_palette_css_protected_at( $text, $j ) : 0;
					if ( $m ) {
						$j += $m - 1;
						continue;
					}
					if ( '(' === $c ) {
						++$depth;
					} elseif ( ')' === $c ) {
						--$depth;
						if ( 0 === $depth ) {
							break;
						}
					}
				}
				$arg     = (string) substr( $text, $i + 5, max( 0, $j - $i - 5 ) );
				$args    = array();
				$present = array();
				foreach ( origin_canvas_palette_css_split_items( $arg ) as $a ) {
					$a                    = origin_canvas_palette_css_expand_negations( $a, $map );
					$args[]               = $a;
					$present[ trim( $a ) ] = true;
				}
				$added = '';
				foreach ( $args as $a ) {
					foreach ( origin_canvas_palette_css_variants( $a, $map ) as $v ) {
						if ( ! isset( $present[ $v ] ) ) {
							$present[ $v ] = true;
							$added        .= ', ' . $v;
						}
					}
				}
				$out .= substr( $text, $i, 5 ) . implode( ',', $args ) . $added . ')';
				$i    = $j + 1;
				continue;
			}
			$out .= $ch;
			++$i;
		}
		return $out;
	}
}

if ( ! function_exists( 'origin_canvas_palette_css_expand_prelude_parts' ) ) {
	/**
	 * Expand one prelude: array( 'prelude' => string, 'changed' => string[] ), where changed lists
	 * the changed items, trimmed (expanded negations, then new variants), for shadow output.
	 *
	 * @param string $prelude           Prelude.
	 * @param array  $classes           Class map.
	 * @param array  $collision_classes Collision class map (user CSS only).
	 * @return array
	 */
	function origin_canvas_palette_css_expand_prelude_parts( $prelude, $classes, $collision_classes = array() ) {
		preg_match( '/\s*$/D', $prelude, $lm );
		$lead     = $lm[0];
		$body     = substr( $prelude, 0, strlen( $prelude ) - strlen( $lead ) );
		$raw      = origin_canvas_palette_css_split_items( $body );
		$expanded = array();
		$changed  = array();
		$present  = array();
		foreach ( $raw as $i => $item ) {
			$e              = origin_canvas_palette_css_expand_negations( $item, $classes );
			$expanded[ $i ] = $e;
			if ( $e !== $item ) {
				$changed[] = trim( $e );
			}
			$present[ trim( $e ) ] = true;
		}
		// An item is a variant of another when some other item becomes it by the base map.
		$base_variants = array();
		foreach ( $expanded as $i => $e ) {
			$base_variants[ $i ] = array_flip( origin_canvas_palette_css_variants( $e, $classes ) );
		}
		$added = '';
		foreach ( $expanded as $i => $e ) {
			$is_variant = false;
			foreach ( $expanded as $j => $o ) {
				if ( $j !== $i && isset( $base_variants[ $j ][ trim( $e ) ] ) ) {
					$is_variant = true;
					break;
				}
			}
			$map = ( $is_variant || ! $collision_classes ) ? $classes : array_merge( $classes, $collision_classes );
			foreach ( origin_canvas_palette_css_variants( $e, $map ) as $v ) {
				if ( ! isset( $present[ $v ] ) ) {
					$present[ $v ] = true;
					$added        .= ', ' . $v;
					$changed[]     = $v;
				}
			}
		}
		return array(
			'prelude' => implode( ',', $expanded ) . $added . $lead,
			'changed' => $changed,
		);
	}
}

if ( ! function_exists( 'origin_canvas_palette_css_expand_prelude' ) ) {
	/**
	 * Expand one prelude by the twin rule: negations expanded, variants added after the last item.
	 *
	 * @param string $prelude           Prelude.
	 * @param array  $classes           Class map.
	 * @param array  $collision_classes Collision class map (user CSS only).
	 * @return string
	 */
	function origin_canvas_palette_css_expand_prelude( $prelude, $classes, $collision_classes = array() ) {
		return origin_canvas_palette_css_expand_prelude_parts( $prelude, $classes, $collision_classes )['prelude'];
	}
}

if ( ! function_exists( 'origin_canvas_palette_css_declarations' ) ) {
	/**
	 * The declarations of one rule body (braces included): list of array( 'prop' => string,
	 * 'value_start' => int, 'value_end' => int ), offsets into the body. Nested rules are skipped.
	 *
	 * @param string $body Rule body.
	 * @return array
	 */
	function origin_canvas_palette_css_declarations( $body ) {
		$out   = array();
		$len   = strlen( $body );
		$start = 1;
		$colon = -1;
		$depth = 0;
		$brace = 0;
		$end   = $len - 1; // The closing brace, when there is one.
		if ( $len < 2 || '}' !== $body[ $len - 1 ] ) {
			$end = $len;
		}
		for ( $i = 1; $i <= $end; ) {
			if ( $i < $end ) {
				$n = origin_canvas_palette_css_protected_at( $body, $i );
				if ( $n ) {
					$i += $n;
					continue;
				}
			}
			$ch = $i < $end ? $body[ $i ] : ';';
			if ( '(' === $ch || '[' === $ch ) {
				++$depth;
			} elseif ( ')' === $ch || ']' === $ch ) {
				--$depth;
			} elseif ( '{' === $ch ) {
				++$brace;
			} elseif ( '}' === $ch ) {
				--$brace;
				if ( 0 === $brace ) {
					// A nested rule ends: what follows starts a new declaration.
					$start = $i + 1;
					$colon = -1;
				}
			} elseif ( ':' === $ch && -1 === $colon && 0 === $depth && 0 === $brace ) {
				$colon = $i;
			} elseif ( ';' === $ch && 0 === $depth && 0 === $brace ) {
				if ( -1 !== $colon ) {
					$out[] = array(
						'prop'        => trim( substr( $body, $start, $colon - $start ) ),
						'value_start' => $colon + 1,
						'value_end'   => $i,
					);
				}
				$start = $i + 1;
				$colon = -1;
			}
			++$i;
		}
		return $out;
	}
}

if ( ! function_exists( 'origin_canvas_palette_css_prop_twin' ) ) {
	/**
	 * The new name for a declared old preset property, or ''.
	 *
	 * @param string $prop  Property name.
	 * @param array  $extra Collision map.
	 * @return string
	 */
	function origin_canvas_palette_css_prop_twin( $prop, $extra = array() ) {
		$forms = array(
			'color'      => '--wp--preset--color--',
			'spacing'    => '--wp--preset--spacing--',
			'lineHeight' => '--wp--custom--line-height--',
		);
		foreach ( $forms as $kind => $prefix ) {
			if ( 0 === strpos( $prop, $prefix ) ) {
				$slug = substr( $prop, strlen( $prefix ) );
				if ( '' === $slug || strlen( $slug ) !== strspn( $slug, 'abcdefghijklmnopqrstuvwxyz0123456789-' ) ) {
					return '';
				}
				$to = origin_canvas_palette_lookup( $kind, $slug, $extra );
				return '' === $to ? '' : $prefix . $to;
			}
		}
		return '';
	}
}

if ( ! function_exists( 'origin_canvas_palette_css_value_key' ) ) {
	/**
	 * A declaration value as the twin rule compares it: its trimmed text and its !important.
	 *
	 * @param string $value Value bytes.
	 * @return string
	 */
	function origin_canvas_palette_css_value_key( $value ) {
		$important = (bool) preg_match( '/!\s*important\s*$/i', $value );
		$text      = trim( preg_replace( '/!\s*important\s*$/i', '', $value ) );
		return $text . '|' . ( $important ? 'important' : '' );
	}
}

if ( ! function_exists( 'origin_canvas_palette_css_decl_twins' ) ) {
	/**
	 * The declaration twins of one rule body: list of array( 'at' => value end offset,
	 * 'text' => '<new name>:<value bytes>' ), in order.
	 *
	 * A twin is skipped only when the declaration right after the old one already is its twin: the
	 * new name with the same value and the same !important, so a second run changes nothing. Every
	 * other old declaration gets its twin, so repeated declarations (red, then blue) keep their
	 * order and the last one still wins.
	 *
	 * @param string $body  Rule body.
	 * @param array  $extra Collision map.
	 * @return array
	 */
	function origin_canvas_palette_css_decl_twins( $body, $extra = array() ) {
		$decls = origin_canvas_palette_css_declarations( $body );
		$out   = array();
		foreach ( $decls as $k => $d ) {
			$new = origin_canvas_palette_css_prop_twin( $d['prop'], $extra );
			if ( '' === $new ) {
				continue;
			}
			$value = substr( $body, $d['value_start'], $d['value_end'] - $d['value_start'] );
			if ( isset( $decls[ $k + 1 ] ) && $new === $decls[ $k + 1 ]['prop'] ) {
				$next = $decls[ $k + 1 ];
				$next = substr( $body, $next['value_start'], $next['value_end'] - $next['value_start'] );
				if ( origin_canvas_palette_css_value_key( $next ) === origin_canvas_palette_css_value_key( $value ) ) {
					continue;
				}
			}
			$out[] = array(
				'at'   => $d['value_end'],
				'text' => $new . ':' . $value,
			);
		}
		return $out;
	}
}

if ( ! function_exists( 'origin_canvas_palette_css_rename_vars_in' ) ) {
	/**
	 * Rename var() references to old presets in a declaration text, outside protected runs.
	 *
	 * @param string $text  Body text.
	 * @param array  $extra Collision map.
	 * @return string
	 */
	function origin_canvas_palette_css_rename_vars_in( $text, $extra = array() ) {
		$forms = array(
			'color'      => '--wp--preset--color--',
			'spacing'    => '--wp--preset--spacing--',
			'lineHeight' => '--wp--custom--line-height--',
		);
		return origin_canvas_palette_css_map_outside(
			$text,
			static function ( $plain ) use ( $forms, $extra ) {
				foreach ( $forms as $kind => $prefix ) {
					$plain = preg_replace_callback(
						'/var\(\s*' . preg_quote( $prefix, '/' ) . '([a-z0-9-]+)' . origin_canvas_palette_ident_end() . '/',
						static function ( $m ) use ( $kind, $prefix, $extra ) {
							$to = origin_canvas_palette_lookup( $kind, $m[1], $extra );
							if ( '' === $to ) {
								return $m[0];
							}
							$pos = strpos( $m[0], $prefix . $m[1] );
							return substr( $m[0], 0, $pos ) . $prefix . $to . substr( $m[0], $pos + strlen( $prefix . $m[1] ) );
						},
						$plain
					);
				}
				return $plain;
			}
		);
	}
}

if ( ! function_exists( 'origin_canvas_palette_css_rename_body' ) ) {
	/**
	 * One rule body with declaration twins inserted and var() references renamed.
	 *
	 * @param string $body  Rule body.
	 * @param array  $extra Collision map.
	 * @return string
	 */
	function origin_canvas_palette_css_rename_body( $body, $extra = array() ) {
		$twins = origin_canvas_palette_css_decl_twins( $body, $extra );
		$next  = $body;
		foreach ( array_reverse( $twins ) as $t ) {
			$next = substr( $next, 0, $t['at'] ) . ';' . $t['text'] . substr( $next, $t['at'] );
		}
		return origin_canvas_palette_css_rename_vars_in( $next, $extra );
	}
}

if ( ! function_exists( 'origin_canvas_palette_css_rename_vars' ) ) {
	/**
	 * Variables renamed in declaration values only, and a twin beside each declaration of an old
	 * preset property; selectors, strings, url() arguments and comments stay.
	 *
	 * @param string $css   CSS.
	 * @param array  $extra Collision map.
	 * @return string
	 */
	function origin_canvas_palette_css_rename_vars( $css, $extra = array() ) {
		return origin_canvas_palette_css_scan(
			(string) $css,
			static function ( $prelude, $body ) use ( $extra ) {
				$next = origin_canvas_palette_css_rename_body( $body, $extra );
				return $next === $body ? null : array(
					'prelude' => $prelude,
					'body'    => $next,
				);
			},
			true
		);
	}
}

if ( ! function_exists( 'origin_canvas_palette_css_twins' ) ) {
	/**
	 * Shadow output for a stylesheet the theme cannot edit: per changed rule, the changed items
	 * and the rule's body; with $props, also a rule of the declaration twins.
	 *
	 * @param string $css     CSS.
	 * @param array  $classes Class map (new => old for the theme, old => new for a child theme).
	 * @param bool   $props   Declaration twins on.
	 * @return string
	 */
	function origin_canvas_palette_css_twins( $css, $classes, $props = false ) {
		return origin_canvas_palette_css_scan(
			(string) $css,
			static function ( $prelude, $body ) use ( $classes, $props ) {
				$r      = origin_canvas_palette_css_expand_prelude_parts( $prelude, $classes );
				$shadow = $r['changed'] ? implode( ', ', $r['changed'] ) . $body : '';
				if ( $props ) {
					$twins = origin_canvas_palette_css_decl_twins( $body );
					if ( $twins ) {
						$shadow .= trim( $r['prelude'] ) . '{' . implode( ';', wp_list_pluck( $twins, 'text' ) ) . '}';
					}
				}
				return '' === $shadow ? null : array(
					'prelude' => $prelude,
					'body'    => $body,
					'shadow'  => $shadow,
				);
			},
			false
		);
	}
}

if ( ! function_exists( 'origin_canvas_palette_css_collision_classes' ) ) {
	/**
	 * The class map of the collided colour destinations: has-D-… => has-<legacy>-….
	 *
	 * @param array $collisions Collision map of the map's shape.
	 * @return array<string, string>
	 */
	function origin_canvas_palette_css_collision_classes( $collisions ) {
		$out = array();
		if ( empty( $collisions['color'] ) || ! is_array( $collisions['color'] ) ) {
			return $out;
		}
		foreach ( $collisions['color'] as $d => $legacy ) {
			foreach ( array( 'color', 'background-color', 'border-color' ) as $kind ) {
				$out[ 'has-' . $d . '-' . $kind ] = 'has-' . $legacy . '-' . $kind;
			}
		}
		return $out;
	}
}

if ( ! function_exists( 'origin_canvas_palette_rewrite_user_css' ) ) {
	/**
	 * The in-place rewrite of a user stylesheet (Additional CSS, a Global Styles css string): the
	 * twin rule with the old => new classes and the collided destination classes; with $vars,
	 * variables renamed and old preset declarations twinned, collided destinations by $var_extra.
	 *
	 * @param string $css        CSS.
	 * @param array  $collisions Collision map (dest => legacy), for classes.
	 * @param bool   $vars       Rename variables too.
	 * @param array  $var_extra  The gated collision map for variables.
	 * @return string
	 */
	function origin_canvas_palette_rewrite_user_css( $css, $collisions = array(), $vars = true, $var_extra = array() ) {
		$classes   = origin_canvas_palette_old_classes();
		$collision = origin_canvas_palette_css_collision_classes( $collisions );
		$out       = origin_canvas_palette_css_scan(
			(string) $css,
			static function ( $prelude, $body ) use ( $classes, $collision ) {
				$next = origin_canvas_palette_css_expand_prelude( $prelude, $classes, $collision );
				return $next === $prelude ? null : array(
					'prelude' => $next,
					'body'    => $body,
				);
			},
			true
		);
		if ( $vars ) {
			$out = origin_canvas_palette_css_rename_vars( $out, is_array( $var_extra ) ? $var_extra : array() );
		}
		return $out;
	}
}

if ( ! function_exists( 'origin_canvas_palette_css_refs' ) ) {
	/**
	 * Of the given slugs per kind, those a var() reference in a declaration value or a declared
	 * property name uses, outside strings, url() arguments and comments.
	 *
	 * @param string $css   CSS.
	 * @param array  $slugs array( 'color' => string[], 'spacing' => string[], 'lineHeight' => string[] ).
	 * @return array{color: string[], spacing: string[], lineHeight: string[]}
	 */
	function origin_canvas_palette_css_refs( $css, $slugs ) {
		$forms = array(
			'color'      => '--wp--preset--color--',
			'spacing'    => '--wp--preset--spacing--',
			'lineHeight' => '--wp--custom--line-height--',
		);
		$want  = array();
		$refs  = array();
		foreach ( $forms as $kind => $prefix ) {
			$want[ $kind ] = isset( $slugs[ $kind ] ) ? array_flip( (array) $slugs[ $kind ] ) : array();
			$refs[ $kind ] = array();
		}
		origin_canvas_palette_css_scan(
			(string) $css,
			static function ( $prelude, $body ) use ( $forms, $want, &$refs ) {
				foreach ( origin_canvas_palette_css_declarations( $body ) as $d ) {
					foreach ( $forms as $kind => $prefix ) {
						if ( 0 === strpos( $d['prop'], $prefix ) && isset( $want[ $kind ][ substr( $d['prop'], strlen( $prefix ) ) ] ) ) {
							$refs[ $kind ][ substr( $d['prop'], strlen( $prefix ) ) ] = true;
						}
					}
				}
				origin_canvas_palette_css_map_outside(
					$body,
					static function ( $plain ) use ( $forms, $want, &$refs ) {
						foreach ( $forms as $kind => $prefix ) {
							if ( preg_match_all( '/var\(\s*' . preg_quote( $prefix, '/' ) . '([a-z0-9-]+)' . origin_canvas_palette_ident_end() . '/', $plain, $all ) ) {
								foreach ( $all[1] as $s ) {
									if ( isset( $want[ $kind ][ $s ] ) ) {
										$refs[ $kind ][ $s ] = true;
									}
								}
							}
						}
						return $plain;
					}
				);
				return null;
			},
			true
		);
		foreach ( $refs as $kind => $set ) {
			$list = array_map( 'strval', array_keys( $set ) );
			sort( $list, SORT_STRING );
			$refs[ $kind ] = $list;
		}
		return $refs;
	}
}

if ( ! function_exists( 'origin_canvas_palette_css_collision_extra' ) ) {
	/**
	 * The collision map a stylesheet's variables take: for each kind, D => legacy for each D in
	 * $refs whose legacy name the CSS does not use yet; array() when $refs is null.
	 *
	 * @param string     $css  CSS.
	 * @param array      $map  Collision map (dest => legacy per kind).
	 * @param array|null $refs The snapshot's references (kind => dest[]).
	 * @return array
	 */
	function origin_canvas_palette_css_collision_extra( $css, $map, $refs ) {
		$out = array();
		if ( null === $refs ) {
			return $out;
		}
		foreach ( array( 'color', 'spacing', 'lineHeight' ) as $kind ) {
			foreach ( isset( $refs[ $kind ] ) ? (array) $refs[ $kind ] : array() as $d ) {
				if ( ! isset( $map[ $kind ][ $d ] ) ) {
					continue;
				}
				$legacy = $map[ $kind ][ $d ];
				$found  = origin_canvas_palette_css_refs( $css, array( $kind => array( $legacy ) ) );
				if ( ! $found[ $kind ] ) {
					$out[ $kind ][ $d ] = $legacy;
				}
			}
		}
		return $out;
	}
}
