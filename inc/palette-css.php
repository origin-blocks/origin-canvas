<?php
/**
 * The palette rename (#116): one CSS scanner and one twin rule. Pure.
 *
 * The twin rule serves every stylesheet the theme rewrites in place (Additional CSS, the Global
 * Styles css strings) or shadows (each child theme stylesheet, and the theme's own rules keyed on
 * a new class, for content that still holds the old one):
 *
 * - Scanner: comments, quoted strings and url() arguments are skipped and kept byte for byte;
 *   @media, @supports, @container, @layer, @scope, @document and @starting-style are descended
 *   into, at the top level and nested in a style rule; every other at-rule is kept whole. <!--
 *   and --> between top-level rules are read as whitespace, as CSS reads them, and kept. A style
 *   rule whose selector does not balance is one a browser drops: it is kept whole and read as
 *   nothing. So is a top-level rule whose prelude holds a stray }, as CSS reads one, and a rule
 *   whose prelude holds a stray ; (only an at-rule ends at ;); the rules after it are read.
 * - Token: a class .c with c in the class map, in a style rule's prelude, outside strings,
 *   comments, escapes and attribute selectors; or the value c of a class attribute selector
 *   with = or ~= and that one class ([class~=c], [class="c" i]). Substring forms (*=, ^=, $=)
 *   are no token: a documented limit.
 * - Items: the prelude split on commas at parenthesis and bracket depth 0, outside strings,
 *   comments and escapes.
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
	 * Rename preset references in one style value (a string not under a css key): var:preset refs,
	 * CSS variables and the custom line height. The value is walked as CSS, so a quoted string
	 * (a fontFamily "var(…)"), a url() argument or a comment in it keeps its bytes. One lookup per
	 * captured slug, the collision map first.
	 *
	 * @param string $s     The string.
	 * @param array  $extra Collision map of the map's shape.
	 * @return string
	 */
	function origin_canvas_palette_rename_refs( $s, $extra = array() ) {
		$end      = origin_canvas_palette_ident_end();
		$patterns = array(
			array( '/var:preset\|color\|([a-z0-9-]+)' . $end . '/', 'color', 'var:preset|color|' ),
			array( '/var:preset\|spacing\|([a-z0-9-]+)' . $end . '/', 'spacing', 'var:preset|spacing|' ),
			array( '/var:custom\|line-height\|([a-z0-9-]+)' . $end . '/', 'lineHeight', 'var:custom|line-height|' ),
		);
		$s = origin_canvas_palette_css_map_outside(
			(string) $s,
			static function ( $plain ) use ( $patterns, $extra ) {
				foreach ( $patterns as $p ) {
					$plain = preg_replace_callback(
						$p[0],
						static function ( $m ) use ( $p, $extra ) {
							$to = origin_canvas_palette_lookup( $p[1], $m[1], $extra );
							if ( '' === $to ) {
								return $m[0];
							}
							$pos = strpos( $m[0], $p[2] . $m[1] );
							return substr( $m[0], 0, $pos ) . $p[2] . $to . substr( $m[0], $pos + strlen( $p[2] . $m[1] ) );
						},
						$plain
					);
				}
				return $plain;
			}
		);
		// CSS variables, read as CSS reads them: var( and the name decoded, comments between skipped.
		return origin_canvas_palette_css_rename_var_refs( $s, $extra );
	}
}

if ( ! function_exists( 'origin_canvas_palette_css_var_refs' ) ) {
	/**
	 * The var() references in a CSS text, read as CSS reads them: comments, strings and url()
	 * arguments are skipped, the function name and the variable name are compared decoded
	 * (v\61r( is var(, --wp--preset--color--text-mute\64 is --wp--preset--color--text-muted), any
	 * case for var. Whitespace and comments may stand between var( and the name and after it (CSS
	 * drops comments before it reads tokens, so a comment right after var( counts as nothing);
	 * after them a comma, ) or the end of the text must follow. List of array( name start, name end, decoded name ).
	 *
	 * @param string $text CSS.
	 * @return array
	 */
	function origin_canvas_palette_css_var_refs( $text ) {
		$out = array();
		$len = strlen( $text );
		$gap = static function ( $k ) use ( $text, $len ) {
			for ( ;; ) {
				while ( $k < $len && origin_canvas_palette_css_is_space( $text[ $k ] ) ) {
					++$k;
				}
				if ( '/*' !== substr( $text, $k, 2 ) ) {
					return $k;
				}
				$k += origin_canvas_palette_css_protected_at( $text, $k );
			}
		};
		for ( $i = 0; $i < $len; ) {
			$u = origin_canvas_palette_css_url_at( $text, $i );
			if ( ! $u && ( '/*' === substr( $text, $i, 2 ) || '"' === $text[ $i ] || "'" === $text[ $i ] ) ) {
				$u = origin_canvas_palette_css_protected_at( $text, $i );
			}
			if ( $u ) {
				$i += $u;
				continue;
			}
			list( $name, $end ) = origin_canvas_palette_css_ident_at( $text, $i );
			if ( $end === $i ) {
				++$i;
				continue;
			}
			$i = $end;
			if ( 'var' !== strtolower( $name ) || '(' !== substr( $text, $end, 1 ) ) {
				continue;
			}
			$s               = $gap( $end + 1 );
			list( $var, $e ) = origin_canvas_palette_css_ident_at( $text, $s );
			$k               = $gap( $e );
			if ( $e > $s && ( $k >= $len || ',' === $text[ $k ] || ')' === $text[ $k ] ) ) {
				$out[] = array( $s, $e, $var );
			}
			$i = $end + 1; // A fallback may hold another var().
		}
		return $out;
	}
}

if ( ! function_exists( 'origin_canvas_palette_css_var_kind' ) ) {
	/**
	 * The kind and slug of a decoded preset variable name: array( kind, prefix, slug ), or null.
	 *
	 * @param string $name Variable name, decoded.
	 * @return array|null
	 */
	function origin_canvas_palette_css_var_kind( $name ) {
		$forms = array(
			'color'      => '--wp--preset--color--',
			'spacing'    => '--wp--preset--spacing--',
			'lineHeight' => '--wp--custom--line-height--',
		);
		foreach ( $forms as $kind => $prefix ) {
			if ( 0 === strpos( $name, $prefix ) ) {
				$slug = (string) substr( $name, strlen( $prefix ) );
				return '' !== $slug && strlen( $slug ) === strspn( $slug, 'abcdefghijklmnopqrstuvwxyz0123456789-' ) ? array( $kind, $prefix, $slug ) : null;
			}
		}
		return null;
	}
}

if ( ! function_exists( 'origin_canvas_palette_css_rename_var_refs' ) ) {
	/**
	 * Rename the old preset variables that var() references name in a CSS text, read as
	 * origin_canvas_palette_css_var_refs() reads them. The renamed name is written plain; every
	 * other byte stays.
	 *
	 * @param string $plain Text.
	 * @param array  $extra Collision map.
	 * @return string
	 */
	function origin_canvas_palette_css_rename_var_refs( $plain, $extra = array() ) {
		$plain = (string) $plain;
		foreach ( array_reverse( origin_canvas_palette_css_var_refs( $plain ) ) as $r ) {
			$v = origin_canvas_palette_css_var_kind( $r[2] );
			$to = $v ? origin_canvas_palette_lookup( $v[0], $v[2], $extra ) : '';
			if ( '' !== $to ) {
				$plain = substr( $plain, 0, $r[0] ) . $v[1] . $to . substr( $plain, $r[1] );
			}
		}
		return $plain;
	}
}

if ( ! function_exists( 'origin_canvas_palette_css_var_slugs' ) ) {
	/**
	 * The preset variables that var() references in a CSS text name, outside comments, strings
	 * and url() arguments, read as origin_canvas_palette_css_var_refs() reads them: list of
	 * array( kind, slug ).
	 *
	 * @param string $text CSS.
	 * @return array
	 */
	function origin_canvas_palette_css_var_slugs( $text ) {
		$out = array();
		foreach ( origin_canvas_palette_css_var_refs( (string) $text ) as $r ) {
			$v = origin_canvas_palette_css_var_kind( $r[2] );
			if ( $v ) {
				$out[] = array( $v[0], $v[2] );
			}
		}
		return $out;
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
	 * Length of a protected run (comment, quoted string, url() argument, escape) starting at $i,
	 * or 0. An escape is a backslash and the byte after it: CSS reads \' or \{ as part of an
	 * identifier, never as the start of a string or a block. A url() is read by
	 * origin_canvas_palette_css_url_at(), its name decoded, so a run that starts with a backslash
	 * and is longer than 2 bytes is an escaped url( name.
	 *
	 * @param string $text CSS.
	 * @param int    $i    Offset.
	 * @return int
	 */
	function origin_canvas_palette_css_protected_at( $text, $i ) {
		$len = strlen( $text );
		$url = origin_canvas_palette_css_url_at( $text, $i );
		if ( $url ) {
			return $url;
		}
		if ( '\\' === $text[ $i ] ) {
			return min( 2, $len - $i );
		}
		if ( '/' === $text[ $i ] && $i + 1 < $len && '*' === $text[ $i + 1 ] ) {
			$e = strpos( $text, '*/', $i + 2 );
			return ( false === $e ? $len : $e + 2 ) - $i;
		}
		$ch = $text[ $i ];
		if ( '"' === $ch || "'" === $ch ) {
			$j = $i + 1;
			while ( $j < $len && $text[ $j ] !== $ch ) {
				if ( '\\' === $text[ $j ] ) {
					$j += "\r\n" === substr( $text, $j + 1, 2 ) ? 2 : 1; // CSS reads CRLF as one newline.
				} elseif ( "\n" === $text[ $j ] ) {
					break;
				}
				++$j;
			}
			return min( $j + 1, $len ) - $i;
		}
		return 0;
	}
}

if ( ! function_exists( 'origin_canvas_palette_css_url_at' ) ) {
	/**
	 * Length of an unquoted url() starting at $i, function name included, or 0. The name is
	 * compared decoded, as CSS reads it: u\72l( and \75rl( are url(. A name byte before it
	 * (a letter, digit, _, -, a non-ASCII byte or a hex escape with its whitespace) makes it
	 * another function.
	 *
	 * @param string $text CSS.
	 * @param int    $i    Offset.
	 * @return int
	 */
	function origin_canvas_palette_css_url_at( $text, $i ) {
		$ch = $text[ $i ];
		if ( 'u' !== $ch && 'U' !== $ch && '\\' !== $ch ) {
			return 0;
		}
		list( $name, $j ) = origin_canvas_palette_css_ident_at( $text, $i );
		if ( 'url' !== strtolower( $name ) || '(' !== substr( $text, $j, 1 ) ) {
			return 0;
		}
		$prev = $i > 0 ? $text[ $i - 1 ] : '';
		if ( '' !== $prev && ( ord( $prev ) >= 0x80 || 1 === strspn( $prev, 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789_-' ) ) ) {
			return 0;
		}
		if ( '' !== $prev && origin_canvas_palette_css_is_space( $prev ) && preg_match( '/\\\\[0-9a-fA-F]{1,6}(?:\r\n|\s)$/', substr( $text, max( 0, $i - 9 ), $i - max( 0, $i - 9 ) ) ) ) {
			return 0;
		}
		$len = strlen( $text );
		++$j;
		while ( $j < $len && origin_canvas_palette_css_is_space( $text[ $j ] ) ) {
			++$j;
		}
		if ( $j < $len && ( '"' === $text[ $j ] || "'" === $text[ $j ] ) ) {
			return 0; // A quoted argument is a string, skipped as one.
		}
		// The first ) that is not escaped ends it: url(x\)'y) is one argument.
		for ( $e = $j; $e < $len && ')' !== $text[ $e ]; $e++ ) {
			if ( '\\' === $text[ $e ] ) {
				++$e;
			}
		}
		return min( $e + 1, $len ) - $i;
	}
}

if ( ! function_exists( 'origin_canvas_palette_css_selector_protected_at' ) ) {
	/**
	 * Length of a comment, quoted string or escape starting at $i in a selector, or 0. A selector
	 * reads none of them as code: a class or a parenthesis inside one is left as it is, and an
	 * escaped quote, bracket, comma or parenthesis is part of an identifier. An escape is whole:
	 * up to six hex digits take one whitespace after them (\31 , \ ), so no item ends inside one.
	 *
	 * @param string $text Selector text.
	 * @param int    $i    Offset.
	 * @return int
	 */
	function origin_canvas_palette_css_selector_protected_at( $text, $i ) {
		$ch = $text[ $i ];
		if ( '\\' === $ch ) {
			// An escape, never the start of a url() here. A backslash and a newline is no escape.
			if ( false !== strpos( "\n\r\f", (string) substr( $text, $i + 1, 1 ) ) ) {
				return min( 2, strlen( $text ) - $i );
			}
			return origin_canvas_palette_css_escape_at( $text, $i )[1] - $i;
		}
		if ( '"' === $ch || "'" === $ch || ( '/' === $ch && '*' === substr( $text, $i + 1, 1 ) ) ) {
			return origin_canvas_palette_css_protected_at( $text, $i );
		}
		return 0;
	}
}

if ( ! function_exists( 'origin_canvas_palette_css_map_outside' ) ) {
	/**
	 * Apply $fn to the text outside comments, strings and url() arguments. An escape is skipped
	 * as one unit but stays in the plain text, so a name followed by an escape
	 * (--wp--preset--color--text-muted\@x) is still read as one name, not cut before it.
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
			if ( $n && '\\' === $text[ $i ] && $n <= 2 ) { // An escape; a longer run is an escaped url( name.
				$i += $n;
			} elseif ( $n ) {
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
	 * Offset of the brace that closes the block opening at $open, or the text's length when none
	 * does: CSS closes a block left open at the end of the text there, with no byte of its own.
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
		return $len;
	}
}

if ( ! function_exists( 'origin_canvas_palette_css_closed' ) ) {
	/**
	 * The text with what CSS closes at its end written out: an open comment, quoted string or
	 * url(), then each open (, [ and { in turn. For shadow output, where text follows: a body left
	 * open at the end of a stylesheet would otherwise take in the rules after it. A backslash at
	 * the end, outside a comment, is dropped first: CSS reads it as nothing, and kept it would
	 * escape the closer.
	 *
	 * @param string $text CSS.
	 * @return string
	 */
	function origin_canvas_palette_css_closed( $text ) {
		$text  = (string) $text;
		$len   = strlen( $text );
		$open  = array();
		$pairs = array(
			'{' => '}',
			'(' => ')',
			'[' => ']',
		);
		$tail  = '';
		for ( $i = 0; $i < $len; ) {
			$n = origin_canvas_palette_css_protected_at( $text, $i );
			if ( $n ) {
				if ( $i + $n >= $len ) {
					$run = substr( $text, $i );
					if ( '/' !== $run[0] && origin_canvas_palette_css_lone_backslash( $run ) ) {
						// CSS reads a backslash at the end of the text as nothing; kept, it would
						// escape the closer written after it.
						$text = substr( $text, 0, -1 );
						$run  = substr( $run, 0, -1 );
					}
					$tail = '' === $run ? '' : origin_canvas_palette_css_run_closer( $run );
				}
				$i += $n;
				continue;
			}
			$ch = $text[ $i ];
			if ( isset( $pairs[ $ch ] ) ) {
				$open[] = $pairs[ $ch ];
			} elseif ( $open && end( $open ) === $ch ) {
				array_pop( $open );
			}
			++$i;
		}
		return $text . $tail . implode( '', array_reverse( $open ) );
	}
}

if ( ! function_exists( 'origin_canvas_palette_css_open_at_end' ) ) {
	/**
	 * Whether a text runs into an open comment, quoted string or url() at its end. Text printed
	 * after such a text sits inside the construct (core joins a block's CSS parts with nothing
	 * between them), so nothing may be written after it.
	 *
	 * @param string $text CSS.
	 * @return bool
	 */
	function origin_canvas_palette_css_open_at_end( $text ) {
		$text = (string) $text;
		$len  = strlen( $text );
		for ( $i = 0; $i < $len; ) {
			$n = origin_canvas_palette_css_protected_at( $text, $i );
			if ( ! $n ) {
				++$i;
				continue;
			}
			if ( $i + $n >= $len && '' !== origin_canvas_palette_css_run_closer( substr( $text, $i ) ) ) {
				return true;
			}
			$i += $n;
		}
		return false;
	}
}

if ( ! function_exists( 'origin_canvas_palette_css_lone_backslash' ) ) {
	/**
	 * Whether a run that reaches the end of the text (an escape, a quoted string or a url()) ends
	 * in a backslash that no other backslash escapes.
	 *
	 * @param string $run The run, from its first byte to the end of the text.
	 * @return bool
	 */
	function origin_canvas_palette_css_lone_backslash( $run ) {
		$m = strlen( $run );
		for ( $j = 0; $j < $m; ) {
			if ( '\\' !== $run[ $j ] ) {
				++$j;
			} elseif ( $j === $m - 1 ) {
				return true;
			} else {
				$j += "\r\n" === substr( $run, $j + 1, 2 ) ? 3 : 2;
			}
		}
		return false;
	}
}

if ( ! function_exists( 'origin_canvas_palette_css_run_closer' ) ) {
	/**
	 * What closes a protected run that reaches the end of the text: '*' . '/' for an open comment,
	 * the quote for an open string, ) for an open url(; '' when it is closed or an escape.
	 *
	 * @param string $run The run, from its first byte to the end of the text.
	 * @return string
	 */
	function origin_canvas_palette_css_run_closer( $run ) {
		$ch = $run[0];
		$m  = strlen( $run );
		if ( '/' === $ch ) {
			return $m >= 4 && '*/' === substr( $run, -2 ) ? '' : '*/';
		}
		if ( '"' === $ch || "'" === $ch ) {
			for ( $j = 1; $j < $m; $j++ ) {
				if ( '\\' === $run[ $j ] ) {
					++$j;
				} elseif ( $ch === $run[ $j ] || "\n" === $run[ $j ] ) {
					return '';
				}
			}
			return $ch;
		}
		if ( '\\' === $ch && $m <= 2 ) {
			return '';
		}
		return ')' === substr( $run, -1 ) && '\\' !== substr( $run, -2, 1 ) ? '' : ')'; // An unquoted url( argument.
	}
}

if ( ! function_exists( 'origin_canvas_palette_css_descends' ) ) {
	/**
	 * Whether an at-rule prelude opens a block the scanner walks: a conditional or grouping rule
	 * whose block holds style rules (at the top level) or a rule body (nested in a style rule).
	 * The name is compared decoded, as CSS reads it: @m\65 dia is @media.
	 *
	 * @param string $prelude Prelude, from its first byte of code.
	 * @return bool
	 */
	function origin_canvas_palette_css_descends( $prelude ) {
		if ( '@' !== substr( $prelude, 0, 1 ) ) {
			return false;
		}
		list( $name ) = origin_canvas_palette_css_ident_at( $prelude, 1 );
		return in_array( strtolower( $name ), array( 'media', 'supports', 'container', 'layer', 'scope', 'document', 'starting-style' ), true );
	}
}

if ( ! function_exists( 'origin_canvas_palette_css_balanced' ) ) {
	/**
	 * Whether a selector's parentheses and brackets balance: each ( closed by a ) and each [ by a ],
	 * in order, outside comments, quoted strings and escapes; and no pseudo-class name that decodes
	 * to hold a bracket (:not\28 is no :not( but an invalid name). A browser drops a rule whose
	 * selector does not balance (.a), .b), and the items of one cannot be told apart, so a twin of
	 * it would hold the whole prelude again and grow on every pass.
	 *
	 * @param string $text Selector text.
	 * @return bool
	 */
	function origin_canvas_palette_css_balanced( $text ) {
		$open = array();
		$len  = strlen( $text );
		for ( $i = 0; $i < $len; ) {
			$n = origin_canvas_palette_css_selector_protected_at( $text, $i );
			if ( $n ) {
				$i += $n;
				continue;
			}
			$ch = $text[ $i ];
			if ( ';' === $ch ) {
				return false; // A stray ; joined to a prelude.
			}
			if ( ':' === $ch ) {
				list( $name ) = origin_canvas_palette_css_ident_at( $text, ':' === substr( $text, $i + 1, 1 ) ? $i + 2 : $i + 1 );
				if ( strpbrk( $name, '()[]' ) ) {
					return false;
				}
			}
			if ( '(' === $ch || '[' === $ch ) {
				$open[] = $ch;
			} elseif ( ')' === $ch && '(' !== array_pop( $open ) ) {
				return false;
			} elseif ( ']' === $ch && '[' !== array_pop( $open ) ) {
				return false;
			}
			++$i;
		}
		return ! $open;
	}
}

if ( ! function_exists( 'origin_canvas_palette_css_scan' ) ) {
	/**
	 * Walk the style rules. $on_rule( $prelude, $body, $nested ) returns null (unchanged) or
	 * array( 'prelude' => …, 'body' => …, 'shadow' => … ), where body includes its braces.
	 * In place: the stylesheet with each changed rule put back, every other byte kept. Shadow:
	 * only the changed rules' shadow text, inside their descended at-rule preludes.
	 *
	 * A style rule whose prelude does not balance (origin_canvas_palette_css_balanced()) is one a
	 * browser drops: it never reaches $on_rule, its nested rules are not walked, it is kept byte for
	 * byte in place (left out when $keep_dropped is false) and has no shadow. So the rewrite, the
	 * shadows and every read of old codes pass it by alike.
	 *
	 * Nested style rules (CSS nesting) are walked too: inside a style rule's body, a prelude that
	 * ends at { and is neither an at-rule nor a custom property is a style rule. It goes through
	 * $on_rule with $nested true, & kept, and its own body is walked the same way; declarations
	 * stay as they are. A descended at-rule nested in a style rule (.card{@media …{…}}) holds a
	 * rule body: its declarations go through $on_rule as the rule &, nested true, and its nested
	 * rules and at-rules are walked the same way; its prelude is kept. Other nested at-rules stay
	 * whole. In shadow output a nested rule's shadow sits inside its parent's prelude (and a
	 * nested at-rule's inside its own prelude), as the callback returned it, so it keeps its
	 * nested context. In place, a callback that walks the nested rules itself returns
	 * 'flat' => true, and its body is kept.
	 *
	 * @param string   $css          CSS.
	 * @param callable $on_rule      Rule callback.
	 * @param bool     $in_place     In-place or shadow output.
	 * @param bool     $keep_dropped In place, keep the rules a browser drops.
	 * @return string
	 */
	function origin_canvas_palette_css_scan( $css, $on_rule, $in_place, $keep_dropped = true ) {
		$nest = static function ( $body ) use ( &$nest, $on_rule, $in_place, $keep_dropped ) {
			$parts = origin_canvas_palette_css_body_parts( $body );
			if ( null === $parts ) {
				return $in_place ? $body : '';
			}
			$shut = origin_canvas_palette_css_close_brace( $body, 0 ) < strlen( $body ); // Not left open at the end.
			$out = '';
			foreach ( $parts as $p ) {
				if ( isset( $p['text'] ) ) {
					$out .= $in_place ? $p['text'] : '';
					continue;
				}
				if ( isset( $p['at'] ) ) {
					// Its declarations belong to the parent rule, read here as the rule &.
					$r = $on_rule( '&', $p['body'], true );
					if ( $in_place ) {
						$out .= $p['lead'] . $p['at'] . ( $r ? ( empty( $r['flat'] ) ? $nest( $r['body'] ) : $r['body'] ) : $nest( $p['body'] ) );
						continue;
					}
					$inner = ( $r && isset( $r['shadow'] ) ? $r['shadow'] : '' ) . $nest( $p['body'] );
					if ( '' !== $inner ) {
						$out .= origin_canvas_palette_css_trim( $p['at'] ) . '{' . $inner . '}';
					}
					continue;
				}
				if ( ! origin_canvas_palette_css_balanced( $p['sel'] ) ) {
					$out .= $in_place && $keep_dropped ? $p['lead'] . $p['sel'] . $p['body'] : '';
					continue;
				}
				$r = $on_rule( $p['sel'], $p['body'], true );
				if ( $in_place ) {
					$out .= $p['lead'] . ( $r ? $r['prelude'] . ( empty( $r['flat'] ) ? $nest( $r['body'] ) : $r['body'] ) : $p['sel'] . $nest( $p['body'] ) );
					continue;
				}
				if ( $r && isset( $r['shadow'] ) ) {
					$out .= $r['shadow'];
				}
				$deep = $nest( $p['body'] );
				if ( '' !== $deep ) {
					$out .= origin_canvas_palette_css_trim( $r ? $r['prelude'] : $p['sel'] ) . '{' . $deep . '}';
				}
			}
			return $in_place ? '{' . $out . ( $shut ? '}' : '' ) : $out;
		};
		$walk = static function ( $text, $top = false ) use ( &$walk, $nest, $on_rule, $in_place, $keep_dropped ) {
			$out = '';
			$len = strlen( $text );
			$i   = 0;
			while ( $i < $len ) {
				// Leading whitespace and comments between rules; between top-level rules also <!--
				// and -->, which CSS skips there (and only there), so they never join a prelude.
				$j = $i;
				while ( true ) {
					while ( $j < $len && origin_canvas_palette_css_is_space( $text[ $j ] ) ) {
						++$j;
					}
					if ( $j + 1 < $len && '/' === $text[ $j ] && '*' === $text[ $j + 1 ] ) {
						$j += origin_canvas_palette_css_protected_at( $text, $j );
						continue;
					}
					if ( $top && ( '<!--' === substr( $text, $j, 4 ) || '-->' === substr( $text, $j, 3 ) ) ) {
						$j += '<' === $text[ $j ] ? 4 : 3;
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
				$k     = $i;
				$end   = -1;
				$semi  = false;
				$stray = false;
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
					// Only an at-rule ends at ;. Before a style rule CSS reads a stray ; as part of its
					// prelude, which is then invalid (origin_canvas_palette_css_balanced()) and dropped.
					if ( ';' === $text[ $k ] && '@' === $text[ $i ] ) {
						$end  = $k;
						$semi = true;
						break;
					}
					if ( '}' === $text[ $k ] ) {
						if ( ! $top ) {
							break; // A stray closer: keep the rest as it is.
						}
						// At the top level CSS reads a stray } as part of the next rule's prelude, which
						// is then invalid and dropped; the rules after it still apply.
						$stray = true;
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
				if ( '@' === substr( $prelude, 0, 1 ) ) {
					if ( origin_canvas_palette_css_descends( $prelude ) ) {
						$inner = $walk( (string) substr( $text, $end + 1, $close - $end - 1 ) );
						if ( $in_place ) {
							$out .= $prelude . '{' . $inner . ( $close < $len ? '}' : '' );
						} elseif ( '' !== $inner ) {
							$out .= origin_canvas_palette_css_trim( $prelude ) . '{' . $inner . '}';
						}
					} elseif ( $in_place ) {
						$out .= $prelude . $body;
					}
				} elseif ( $stray || ! origin_canvas_palette_css_balanced( $prelude ) ) {
					if ( $in_place && $keep_dropped ) {
						$out .= $prelude . $body;
					}
				} else {
					$r = $on_rule( $prelude, $body, false );
					if ( $in_place ) {
						$out .= $r ? $r['prelude'] . ( empty( $r['flat'] ) ? $nest( $r['body'] ) : $r['body'] ) : $prelude . $nest( $body );
					} else {
						if ( $r && isset( $r['shadow'] ) ) {
							$out .= $r['shadow'];
						}
						$deep = $nest( $body );
						if ( '' !== $deep ) {
							$out .= origin_canvas_palette_css_trim( $r ? $r['prelude'] : $prelude ) . '{' . $deep . '}';
						}
					}
				}
				$i = $close + 1;
			}
			return $out;
		};
		return $walk( (string) $css, true );
	}
}

if ( ! function_exists( 'origin_canvas_palette_css_body_parts' ) ) {
	/**
	 * A style rule's body (braces included) cut into its parts, in order: array( 'text' => … ) for
	 * declarations, comments, custom properties and at-rules the scanner keeps whole, kept as they
	 * are; array( 'lead' => …, 'sel' => …, 'body' => … ) for each nested style rule, where lead is
	 * the whitespace and comments before its prelude; and array( 'lead' => …, 'at' => …,
	 * 'body' => … ) for each nested at-rule the scanner descends into, whose body is a rule body.
	 * Null when the body is not one whole block.
	 *
	 * @param string $body Rule body.
	 * @return array|null
	 */
	function origin_canvas_palette_css_body_parts( $body ) {
		$len = strlen( $body );
		if ( $len < 1 || '{' !== $body[0] ) {
			return null;
		}
		// Closed by its last byte, or left open at the end of the stylesheet.
		$close = origin_canvas_palette_css_close_brace( $body, 0 );
		if ( $close < $len - 1 ) {
			return null;
		}
		$inner = $close < $len ? substr( $body, 1, -1 ) : substr( $body, 1 );
		$len   = strlen( $inner );
		$parts = array();
		$i     = 0;
		while ( $i < $len ) {
			$k    = $i;
			$stop = -1;
			while ( $k < $len ) {
				$n = origin_canvas_palette_css_protected_at( $inner, $k );
				if ( $n ) {
					$k += $n;
					continue;
				}
				if ( ';' === $inner[ $k ] || '{' === $inner[ $k ] ) {
					$stop = $k;
					break;
				}
				if ( '}' === $inner[ $k ] ) {
					break; // A stray closer: keep the rest as it is.
				}
				++$k;
			}
			if ( -1 === $stop ) {
				$parts[] = array( 'text' => substr( $inner, $i ) );
				break;
			}
			if ( ';' === $inner[ $stop ] ) {
				$parts[] = array( 'text' => substr( $inner, $i, $stop + 1 - $i ) );
				$i       = $stop + 1;
				continue;
			}
			$lead  = origin_canvas_palette_css_skip_blank( $inner, $i );
			$sel   = substr( $inner, $lead, $stop - $lead );
			$close = origin_canvas_palette_css_close_brace( $inner, $stop );
			if ( origin_canvas_palette_css_descends( $sel ) ) {
				$parts[] = array(
					'lead' => substr( $inner, $i, $lead - $i ),
					'at'   => $sel,
					'body' => substr( $inner, $stop, $close + 1 - $stop ),
				);
			} elseif ( '@' === substr( $sel, 0, 1 ) || '--' === substr( $sel, 0, 2 ) ) {
				$parts[] = array( 'text' => substr( $inner, $i, $close + 1 - $i ) );
			} else {
				$parts[] = array(
					'lead' => substr( $inner, $i, $lead - $i ),
					'sel'  => $sel,
					'body' => substr( $inner, $stop, $close + 1 - $stop ),
				);
			}
			$i = $close + 1;
		}
		return $parts;
	}
}

if ( ! function_exists( 'origin_canvas_palette_css_escape_at' ) ) {
	/**
	 * The escape at $i (a backslash not followed by a newline) as CSS decodes it: array( byte,
	 * end ). Up to six hex digits and one whitespace after them are one code point; any other byte
	 * stands for itself. A code point outside ASCII, and 0, which CSS reads as U+FFFD, is the one
	 * placeholder byte 0x80: every name this is compared with is ASCII.
	 *
	 * @param string $text Text.
	 * @param int    $i    Offset of the backslash.
	 * @return array{0: string, 1: int}
	 */
	function origin_canvas_palette_css_escape_at( $text, $i ) {
		$len = strlen( $text );
		$j   = $i + 1;
		if ( $j >= $len ) {
			return array( "\x80", $len );
		}
		$hex = strspn( $text, '0123456789abcdefABCDEF', $j, 6 );
		if ( $hex ) {
			$cp = hexdec( substr( $text, $j, $hex ) );
			$j += $hex;
			if ( "\r\n" === substr( $text, $j, 2 ) ) {
				$j += 2;
			} elseif ( $j < $len && origin_canvas_palette_css_is_space( $text[ $j ] ) ) {
				++$j;
			}
			return array( $cp > 0 && $cp < 0x80 ? chr( $cp ) : "\x80", $j );
		}
		return array( ord( $text[ $j ] ) < 0x80 ? $text[ $j ] : "\x80", $j + 1 );
	}
}

if ( ! function_exists( 'origin_canvas_palette_css_ident_at' ) ) {
	/**
	 * The name that starts at $i, decoded as CSS reads it, for comparison only: array( name, end ).
	 * Name bytes are letters, digits, _ and -, any non-ASCII byte (read as 0x80) and escapes, so
	 * n\6ft is not and has-text-muted-colo\72 is has-text-muted-color; end includes the
	 * whitespace a hex escape takes. The bytes in the text are never changed.
	 *
	 * @param string $text Text.
	 * @param int    $i    Offset.
	 * @return array{0: string, 1: int}
	 */
	function origin_canvas_palette_css_ident_at( $text, $i ) {
		$len  = strlen( $text );
		$name = '';
		while ( $i < $len ) {
			$c = $text[ $i ];
			if ( '\\' === $c ) {
				if ( $i + 1 < $len && false !== strpos( "\n\r\f", $text[ $i + 1 ] ) ) {
					break;
				}
				list( $b, $i ) = origin_canvas_palette_css_escape_at( $text, $i );
				$name         .= $b;
			} elseif ( ord( $c ) >= 0x80 ) {
				$name .= "\x80";
				++$i;
			} elseif ( 1 === strspn( $c, 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789_-' ) ) {
				$name .= $c;
				++$i;
			} else {
				break;
			}
		}
		return array( $name, $i );
	}
}

if ( ! function_exists( 'origin_canvas_palette_css_class_attr' ) ) {
	/**
	 * The class a class attribute selector holds, from the text between its brackets: array(
	 * value start, value end, class ), or null. The form is class, = or ~=, one class unquoted or
	 * quoted, and an optional i or s flag, with whitespace and comments between the parts
	 * (a comment between class and ~= is kept and read as nothing); names, the value and the flag are
	 * compared decoded ([cl\61ss~=…] is a class selector, [class\~=…] is not). For a quoted value
	 * the range is the text inside the quotes.
	 *
	 * @param string $inner Text between [ and ].
	 * @return array|null
	 */
	function origin_canvas_palette_css_class_attr( $inner ) {
		$len = strlen( $inner );
		list( $name, $p ) = origin_canvas_palette_css_ident_at( $inner, origin_canvas_palette_css_skip_blank( $inner, 0 ) );
		if ( 'class' !== $name ) {
			return null;
		}
		$p = origin_canvas_palette_css_skip_blank( $inner, $p );
		if ( '~=' === substr( $inner, $p, 2 ) ) {
			$p += 2;
		} elseif ( '=' === substr( $inner, $p, 1 ) ) {
			++$p;
		} else {
			return null;
		}
		$p = origin_canvas_palette_css_skip_blank( $inner, $p );
		$q = substr( $inner, $p, 1 );
		if ( '"' === $q || "'" === $q ) {
			$start = $p + 1;
			$value = '';
			for ( $p = $start; $p < $len && $q !== $inner[ $p ]; ) {
				if ( '\\' === $inner[ $p ] && 1 === preg_match( '/\G\\\\(?:\r\n|[\n\r\f])/', $inner, $nl, 0, $p ) ) {
					$p += strlen( $nl[0] ); // A backslash and a newline inside a string are removed.
				} elseif ( '\\' === $inner[ $p ] ) {
					list( $b, $p ) = origin_canvas_palette_css_escape_at( $inner, $p );
					$value        .= $b;
				} else {
					$value .= $inner[ $p ];
					++$p;
				}
			}
			if ( $p >= $len ) {
				return null;
			}
			$end = $p;
			++$p;
		} else {
			$start               = $p;
			list( $value, $end ) = origin_canvas_palette_css_ident_at( $inner, $p );
			$p                   = $end;
		}
		$p                = origin_canvas_palette_css_skip_blank( $inner, $p );
		list( $flag, $f ) = origin_canvas_palette_css_ident_at( $inner, $p );
		if ( '' !== $flag ) {
			if ( ! in_array( strtolower( $flag ), array( 'i', 's' ), true ) ) {
				return null;
			}
			$p = origin_canvas_palette_css_skip_blank( $inner, $f );
		}
		return $p === $len && '' !== $value ? array( $start, $end, $value ) : null;
	}
}

if ( ! function_exists( 'origin_canvas_palette_css_skip_comments' ) ) {
	/**
	 * The offset past any comments that start at $i, whitespace not included. Inside a selector
	 * token a comment counts as nothing (CSS drops comments before it reads tokens), so .x, a
	 * colon before not( and a colon before a pseudo-element are read across one.
	 *
	 * @param string $text Selector text.
	 * @param int    $i    Offset.
	 * @return int
	 */
	function origin_canvas_palette_css_skip_comments( $text, $i ) {
		$len = strlen( $text );
		while ( $i + 1 < $len && '/' === $text[ $i ] && '*' === $text[ $i + 1 ] ) {
			$i += origin_canvas_palette_css_protected_at( $text, $i );
		}
		return $i;
	}
}

if ( ! function_exists( 'origin_canvas_palette_css_not_at' ) ) {
	/**
	 * Where the argument of a :not( at $i starts, or -1. A colon, any comments and not( (any case,
	 * escapes decoded: n\6ft) open one; the comment bytes stay where they are.
	 *
	 * @param string $text Selector text.
	 * @param int    $i    Offset.
	 * @return int
	 */
	function origin_canvas_palette_css_not_at( $text, $i ) {
		if ( ':' !== $text[ $i ] ) {
			return -1;
		}
		list( $name, $j ) = origin_canvas_palette_css_ident_at( $text, origin_canvas_palette_css_skip_comments( $text, $i + 1 ) );
		return 'not' === strtolower( $name ) && '(' === substr( $text, $j, 1 ) ? $j + 1 : -1;
	}
}

if ( ! function_exists( 'origin_canvas_palette_css_bracket_end' ) ) {
	/**
	 * Offset just past the ] that closes the attribute selector opening at $i, comments and
	 * quoted strings skipped, so a ] inside one does not close it; the text's length when none does.
	 *
	 * @param string $text Selector text.
	 * @param int    $i    Offset of '['.
	 * @return int
	 */
	function origin_canvas_palette_css_bracket_end( $text, $i ) {
		$len = strlen( $text );
		for ( $j = $i + 1; $j < $len; ) {
			$n = origin_canvas_palette_css_selector_protected_at( $text, $j );
			if ( $n ) {
				$j += $n;
				continue;
			}
			if ( ']' === $text[ $j ] ) {
				return $j + 1;
			}
			++$j;
		}
		return $len;
	}
}

if ( ! function_exists( 'origin_canvas_palette_css_append_at' ) ) {
	/**
	 * Where a simple selector joins the end of an item's last compound: before its first
	 * pseudo-element (::x, or :before, :after, :first-line, :first-letter) outside parentheses and
	 * attribute selectors, else just past its last byte of code. Comments, quoted strings and
	 * escaped characters are opaque, so a comment after the selector keeps its place and a
	 * pseudo-element named in one is not read.
	 *
	 * @param string $item Selector item.
	 * @return int
	 */
	function origin_canvas_palette_css_append_at( $item ) {
		$len   = strlen( $item );
		$depth = 0;
		$end   = 0;
		for ( $i = 0; $i < $len; ) {
			$n = origin_canvas_palette_css_selector_protected_at( $item, $i );
			if ( $n ) {
				if ( '/' !== $item[ $i ] ) {
					$end = $i + $n;
				}
				$i += $n;
				continue;
			}
			$ch = $item[ $i ];
			if ( '[' === $ch ) {
				$i   = origin_canvas_palette_css_bracket_end( $item, $i );
				$end = $i;
				continue;
			}
			if ( '(' === $ch ) {
				++$depth;
			} elseif ( ')' === $ch ) {
				--$depth;
			} elseif ( ':' === $ch && 0 === $depth ) {
				// A comment after the colon counts as nothing: a colon, a comment and before is :before.
				// Its name is compared decoded: :\62 efore is :before.
				$k            = origin_canvas_palette_css_skip_comments( $item, $i + 1 );
				list( $name ) = origin_canvas_palette_css_ident_at( $item, $k );
				if ( ':' === substr( $item, $k, 1 ) || in_array( strtolower( $name ), array( 'before', 'after', 'first-line', 'first-letter' ), true ) ) {
					return $i;
				}
			}
			if ( ! origin_canvas_palette_css_is_space( $ch ) ) {
				$end = $i + 1;
			}
			++$i;
		}
		return $end;
	}
}

if ( ! function_exists( 'origin_canvas_palette_css_split_items' ) ) {
	/**
	 * Split on commas at parenthesis and bracket depth 0, outside comments, quoted strings and
	 * escapes.
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
			$n = origin_canvas_palette_css_selector_protected_at( $text, $i );
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

if ( ! function_exists( 'origin_canvas_palette_css_code_end' ) ) {
	/**
	 * Offset just past a selector text's last byte that is not whitespace, an escape counted
	 * whole: the space in #x\  or \31  belongs to its escape, so it stays with the item.
	 *
	 * @param string $text Selector text.
	 * @return int
	 */
	function origin_canvas_palette_css_code_end( $text ) {
		$len = strlen( $text );
		$end = 0;
		for ( $i = 0; $i < $len; ) {
			$n = origin_canvas_palette_css_selector_protected_at( $text, $i );
			if ( $n ) {
				$i  += $n;
				$end = $i;
				continue;
			}
			if ( ! origin_canvas_palette_css_is_space( $text[ $i ] ) ) {
				$end = $i + 1;
			}
			++$i;
		}
		return $end;
	}
}

if ( ! function_exists( 'origin_canvas_palette_css_trim' ) ) {
	/**
	 * A selector item without the whitespace around it; the whitespace an escape takes stays.
	 *
	 * @param string $text Selector text.
	 * @return string
	 */
	function origin_canvas_palette_css_trim( $text ) {
		$text = ltrim( (string) $text, " \t\n\r\f\v" );
		return (string) substr( $text, 0, origin_canvas_palette_css_code_end( $text ) );
	}
}

if ( ! function_exists( 'origin_canvas_palette_css_tokens' ) ) {
	/**
	 * Class tokens in a selector text that are keys of $map, outside comments, strings, escapes
	 * and attribute selectors, plus the one-class value of a [class=…] or [class~=…] selector:
	 * list of array( start, end, cls, negated ). A class name is compared decoded: it goes on past
	 * an escape or a non-ASCII byte (.has-text-muted-color\:hover is another class), and an old
	 * class written with an escape (.has-text-muted-colo\72) is that class. A twin writes the new
	 * class plain over the token's bytes.
	 *
	 * @param string $text Selector text.
	 * @param array  $map  Class map.
	 * @return array
	 */
	function origin_canvas_palette_css_tokens( $text, $map ) {
		$out   = array();
		$nots  = array();
		$depth = 0;
		$len   = strlen( $text );
		for ( $i = 0; $i < $len; ) {
			$ch = $text[ $i ];
			$n  = origin_canvas_palette_css_selector_protected_at( $text, $i );
			if ( $n ) {
				$i += $n;
				continue;
			}
			if ( '[' === $ch ) {
				// A class attribute selector with = or ~= and one class as its value, unquoted or
				// quoted, with an optional i or s flag, is a class token: its twin carries the new
				// class in the same form. *=, ^= and $= forms are not (a documented limit).
				$stop = origin_canvas_palette_css_bracket_end( $text, $i );
				$attr = ']' === substr( $text, $stop - 1, 1 ) ? origin_canvas_palette_css_class_attr( substr( $text, $i + 1, $stop - $i - 2 ) ) : null;
				if ( $attr && array_key_exists( $attr[2], $map ) ) {
					$out[] = array(
						'start'   => $i + 1 + $attr[0],
						'end'     => $i + 1 + $attr[1],
						'cls'     => $attr[2],
						'negated' => count( $nots ) > 0,
					);
				}
				$i = $stop;
				continue;
			}
			$na = origin_canvas_palette_css_not_at( $text, $i );
			if ( -1 !== $na ) {
				++$depth;
				$nots[] = $depth;
				$i      = $na;
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
				$s                 = origin_canvas_palette_css_skip_comments( $text, $i + 1 );
				list( $cls, $end ) = origin_canvas_palette_css_ident_at( $text, $s );
				if ( $end > $s ) {
					if ( array_key_exists( $cls, $map ) ) {
						$out[] = array(
							'start'   => $s,
							'end'     => $end,
							'cls'     => $cls,
							'negated' => count( $nots ) > 0,
						);
					}
					$i = $end;
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
			return origin_canvas_palette_css_trim( $out );
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
			$n  = origin_canvas_palette_css_selector_protected_at( $text, $i );
			if ( $n ) {
				$out .= substr( $text, $i, $n );
				$i   += $n;
				continue;
			}
			if ( '[' === $ch ) {
				$stop = origin_canvas_palette_css_bracket_end( $text, $i );
				$out .= substr( $text, $i, $stop - $i );
				$i    = $stop;
				continue;
			}
			$na = origin_canvas_palette_css_not_at( $text, $i );
			if ( -1 !== $na ) {
				// Find the matching parenthesis.
				$depth = 0;
				for ( $j = $na - 1; $j < $len; $j++ ) {
					$c = $text[ $j ];
					$m = origin_canvas_palette_css_selector_protected_at( $text, $j );
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
				if ( $j >= $len ) {
					// No ) closes it: the rest is kept as it is, so a selector a browser drops stays dropped.
					$out .= substr( $text, $i );
					break;
				}
				$arg     = (string) substr( $text, $na, $j - $na );
				$args    = array();
				$present = array();
				foreach ( origin_canvas_palette_css_split_items( $arg ) as $a ) {
					$a                    = origin_canvas_palette_css_expand_negations( $a, $map );
					$args[]               = $a;
					$present[ origin_canvas_palette_css_trim( $a ) ] = true;
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
				$out .= substr( $text, $i, $na - $i ) . implode( ',', $args ) . $added . ')';
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
		// The whitespace before {, not the one an escape takes: #x\  ends in an escaped space.
		$cut      = origin_canvas_palette_css_code_end( $prelude );
		$lead     = (string) substr( $prelude, $cut );
		$body     = substr( $prelude, 0, $cut );
		$raw      = origin_canvas_palette_css_split_items( $body );
		$expanded = array();
		$changed  = array();
		$present  = array();
		foreach ( $raw as $i => $item ) {
			$e              = origin_canvas_palette_css_expand_negations( $item, $classes );
			$expanded[ $i ] = $e;
			if ( $e !== $item ) {
				$changed[] = origin_canvas_palette_css_trim( $e );
			}
			$present[ origin_canvas_palette_css_trim( $e ) ] = true;
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
				if ( $j !== $i && isset( $base_variants[ $j ][ origin_canvas_palette_css_trim( $e ) ] ) ) {
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

if ( ! function_exists( 'origin_canvas_palette_css_skip_blank' ) ) {
	/**
	 * The offset of the first byte at or after $i that is not whitespace or inside a comment.
	 *
	 * @param string $text Text.
	 * @param int    $i    Start offset.
	 * @return int
	 */
	function origin_canvas_palette_css_skip_blank( $text, $i ) {
		$len = strlen( $text );
		while ( $i < $len ) {
			if ( origin_canvas_palette_css_is_space( $text[ $i ] ) ) {
				++$i;
			} elseif ( '/' === $text[ $i ] && $i + 1 < $len && '*' === $text[ $i + 1 ] ) {
				$i += origin_canvas_palette_css_protected_at( $text, $i );
			} else {
				break;
			}
		}
		return $i;
	}
}

if ( ! function_exists( 'origin_canvas_palette_css_prop_name' ) ) {
	/**
	 * A declaration's property name from the text before its colon. Comments and whitespace before
	 * and after the name are skipped, as CSS reads them (a comment, then --x:red, declares --x);
	 * text with anything else beside the name is returned trimmed, so it matches no property. The
	 * name is returned decoded, as CSS compares it (--wp--preset--color--text-mute\64 declares
	 * --wp--preset--color--text-muted); it is only compared, never written back.
	 *
	 * @param string $text Text before the colon.
	 * @return string
	 */
	function origin_canvas_palette_css_prop_name( $text ) {
		$start = origin_canvas_palette_css_skip_blank( $text, 0 );
		$end   = $start;
		$len   = strlen( $text );
		while ( $end < $len && ! origin_canvas_palette_css_is_space( $text[ $end ] ) && ! ( '/' === $text[ $end ] && $end + 1 < $len && '*' === $text[ $end + 1 ] ) ) {
			// An escape is one unit, with the whitespace a hex escape takes (comp\61 ct).
			$end = '\\' === $text[ $end ] ? origin_canvas_palette_css_escape_at( $text, $end )[1] : $end + 1;
		}
		if ( origin_canvas_palette_css_skip_blank( $text, $end ) < $len ) {
			return trim( $text );
		}
		$name              = substr( $text, $start, $end - $start );
		list( $plain, $at ) = origin_canvas_palette_css_ident_at( $name, 0 );
		return strlen( $name ) === $at ? $plain : $name;
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
						'prop'        => origin_canvas_palette_css_prop_name( substr( $body, $start, $colon - $start ) ),
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
	 * 'text' => '<new name>:<value bytes>', 'open' => bool ), in order. An open one's value runs
	 * into a construct left open at the end of the text; the in-place rewrite writes no twin for it.
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
				// A value that runs into an open comment, string, url( or bracket, or a backslash, at
				// the end of the text: a twin written after it would land inside it.
				'open' => origin_canvas_palette_css_closed( $value ) !== $value,
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
		return origin_canvas_palette_css_rename_var_refs( $text, $extra );
	}
}

if ( ! function_exists( 'origin_canvas_palette_css_rename_body' ) ) {
	/**
	 * One rule body with declaration twins inserted and, with $vars, var() references renamed. A
	 * nested rule's body takes its twins only: its parent's rename already reached its values, and
	 * a second rename could take a renamed value on to a collided name.
	 *
	 * @param string $body  Rule body.
	 * @param array  $extra Collision map.
	 * @param bool   $vars  Rename var() references too.
	 * @return string
	 */
	function origin_canvas_palette_css_rename_body( $body, $extra = array(), $vars = true ) {
		$twins = origin_canvas_palette_css_decl_twins( $body, $extra );
		$next  = $body;
		foreach ( array_reverse( $twins ) as $t ) {
			if ( $t['open'] ) {
				continue; // Unterminated: its bytes stay, with no twin in place.
			}
			$next = substr( $next, 0, $t['at'] ) . ';' . $t['text'] . substr( $next, $t['at'] );
		}
		return $vars ? origin_canvas_palette_css_rename_vars_in( $next, $extra ) : $next;
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
			static function ( $prelude, $body, $nested = false ) use ( $extra ) {
				$next = origin_canvas_palette_css_rename_body( $body, $extra, ! $nested );
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
	 * and the rule's body; with $props, also a rule of the declaration twins. A nested rule's
	 * shadow sits inside its parent's expanded prelude, so it reaches the parent's old and new
	 * forms.
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
				// Closed: a body left open at the end of the sheet would take in the shadow after it.
				$shadow = $r['changed'] ? implode( ', ', $r['changed'] ) . origin_canvas_palette_css_closed( $body ) : '';
				if ( $props ) {
					$twins = origin_canvas_palette_css_decl_twins( $body );
					if ( $twins ) {
						$shadow .= origin_canvas_palette_css_trim( $r['prelude'] ) . origin_canvas_palette_css_closed( '{' . implode( ';', wp_list_pluck( $twins, 'text' ) ) );
					}
				}
				return '' === $shadow ? null : array(
					'prelude' => $r['prelude'],
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
				foreach ( origin_canvas_palette_css_var_refs( $body ) as $r ) {
					$v = origin_canvas_palette_css_var_kind( $r[2] );
					if ( $v && isset( $want[ $v[0] ][ $v[2] ] ) ) {
						$refs[ $v[0] ][ $v[2] ] = true;
					}
				}
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

if ( ! function_exists( 'origin_canvas_palette_block_css_parts' ) ) {
	/**
	 * A block's custom CSS (a css string under styles.blocks.<block>, its variations or elements,
	 * or a block's style.css attribute) as core prints it (WP_Theme_JSON::process_blocks_custom_css()):
	 * the text split on every &; a part with no { is declarations of the block; any other part is
	 * one nested rule, its selector before the {, its declarations after it with every } dropped,
	 * joined to the block selector (scoped when it starts with a space, otherwise appended as
	 * written, so a leading tab or newline is a descendant too); a part that does
	 * not split in two at { is not printed. List of array( 'text' => part, 'kind' =>
	 * 'decls'|'rule'|'skip', 'brace' => offset of { in a rule ).
	 *
	 * @param string $css Block CSS.
	 * @return array
	 */
	function origin_canvas_palette_block_css_parts( $css ) {
		$out = array();
		foreach ( explode( '&', (string) $css ) as $text ) {
			$p = array(
				'text'  => $text,
				'kind'  => 'skip',
				'brace' => -1,
			);
			if ( '' !== $text && false === strpos( $text, '{' ) ) {
				$p['kind'] = 'decls';
			} elseif ( '' !== $text && 2 === count( explode( '{', str_replace( '}', '', $text ) ) ) ) {
				$p['kind']  = 'rule';
				$p['brace'] = strpos( $text, '{' );
			}
			$out[] = $p;
		}
		return $out;
	}
}

if ( ! function_exists( 'origin_canvas_palette_block_css_decls' ) ) {
	/**
	 * The declarations of one part of a block's CSS, as core prints them: a declarations part
	 * whole; for a rule, all the text after its { with every } dropped, so text after a } is
	 * declarations of the same rule (`.x{color:red;} font-weight:700` prints as
	 * `{color:red; font-weight:700}`).
	 *
	 * @param array $p A part from origin_canvas_palette_block_css_parts().
	 * @return string
	 */
	function origin_canvas_palette_block_css_decls( $p ) {
		if ( 'decls' === $p['kind'] ) {
			return $p['text'];
		}
		return str_replace( '}', '', (string) substr( $p['text'], $p['brace'] + 1 ) );
	}
}

if ( ! function_exists( 'origin_canvas_palette_block_css_rename_decls' ) ) {
	/**
	 * Declarations of a block's CSS part with old preset variables renamed and old preset
	 * properties twinned, as in a rule body. Text holding a brace is left as it is: core drops
	 * every } of a part, so it is not one body.
	 *
	 * @param string $decls Declarations.
	 * @param array  $extra Collision map.
	 * @return string
	 */
	function origin_canvas_palette_block_css_rename_decls( $decls, $extra = array() ) {
		if ( false !== strpbrk( $decls, '{}' ) ) {
			return $decls;
		}
		return (string) substr( origin_canvas_palette_css_rename_body( '{' . $decls . '}', $extra ), 1, -1 );
	}
}

if ( ! function_exists( 'origin_canvas_palette_block_css_chunk' ) ) {
	/**
	 * What core prints for one part of a block's CSS under the selector .x: core's own
	 * WP_Theme_JSON::process_blocks_custom_css() when it is loaded (it prints each part on its own
	 * and joins them with nothing between), else the same form written here. '' for a part core
	 * does not print.
	 *
	 * @param string $text One part, with no &.
	 * @return string
	 */
	function origin_canvas_palette_block_css_chunk( $text ) {
		if ( class_exists( 'WP_Theme_JSON' ) && is_callable( array( 'WP_Theme_JSON', 'process_blocks_custom_css' ) ) ) {
			return (string) WP_Theme_JSON::process_blocks_custom_css( $text, '.x' );
		}
		if ( empty( $text ) ) {
			return '';
		}
		if ( false === strpos( $text, '{' ) ) {
			return ':root :where(.x){' . trim( $text ) . '}';
		}
		$part = explode( '{', str_replace( '}', '', $text ) );
		return 2 === count( $part ) ? ':root :where(.x' . $part[0] . '){' . trim( $part[1] ) . '}' : '';
	}
}

if ( ! function_exists( 'origin_canvas_palette_css_block_close' ) ) {
	/**
	 * Offset of the } that closes the block opening at $open, as CSS reads it, or -1 when the text
	 * ends first: comments, strings, url() arguments and escapes are skipped, and a } inside an
	 * open ( or [ closes nothing (the reading of origin_canvas_palette_css_closed()).
	 *
	 * @param string $text CSS.
	 * @param int    $open Offset of '{'.
	 * @return int
	 */
	function origin_canvas_palette_css_block_close( $text, $open ) {
		$stack = array();
		$pairs = array(
			'{' => '}',
			'(' => ')',
			'[' => ']',
		);
		$len   = strlen( $text );
		for ( $i = $open; $i < $len; ) {
			$n = origin_canvas_palette_css_protected_at( $text, $i );
			if ( $n ) {
				$i += $n;
				continue;
			}
			$ch = $text[ $i ];
			if ( isset( $pairs[ $ch ] ) ) {
				$stack[] = $pairs[ $ch ];
			} elseif ( $stack && end( $stack ) === $ch ) {
				array_pop( $stack );
				if ( ! $stack ) {
					return $i;
				}
			}
			++$i;
		}
		return -1;
	}
}

if ( ! function_exists( 'origin_canvas_palette_block_css_reading' ) ) {
	/**
	 * How CSS reads core's print of a block's CSS: a comment or string left open in one part runs
	 * on into the parts printed after it, since core splits on every &, an & in a comment or a
	 * string too. Per part, array( 'chunk' => printed text, 'start' => its offset in the print,
	 * 'live' => it starts a rule of its own (its print begins at the top level and its own { opens
	 * the rule), 'close' => for a live part, the offset of the } that closes its rule, -1 at the end
	 * of the text ). A part printed inside an earlier part's rule is not live; neither is one core
	 * does not print. Also 'print' => the whole print.
	 *
	 * @param array $parts From origin_canvas_palette_block_css_parts().
	 * @return array
	 */
	function origin_canvas_palette_block_css_reading( $parts ) {
		$out   = array();
		$print = '';
		foreach ( $parts as $i => $p ) {
			$chunk     = origin_canvas_palette_block_css_chunk( $p['text'] );
			$out[ $i ] = array(
				'chunk' => $chunk,
				'start' => '' === $chunk ? -1 : strlen( $print ),
				'live'  => false,
				'close' => -1,
			);
			$print    .= $chunk;
		}
		$len = strlen( $print );
		for ( $pos = 0; $pos < $len; ) {
			// Whitespace and comments before a prelude; then the prelude, to its {.
			$q = $pos;
			while ( $q < $len && ( origin_canvas_palette_css_is_space( $print[ $q ] ) || '/*' === substr( $print, $q, 2 ) ) ) {
				$q += origin_canvas_palette_css_is_space( $print[ $q ] ) ? 1 : origin_canvas_palette_css_protected_at( $print, $q );
			}
			$b = -1;
			for ( $j = $q; $j < $len; ) {
				$n = origin_canvas_palette_css_protected_at( $print, $j );
				if ( $n ) {
					$j += $n;
					continue;
				}
				if ( '{' === $print[ $j ] ) {
					$b = $j;
					break;
				}
				++$j;
			}
			$close = -1 === $b ? -1 : origin_canvas_palette_css_block_close( $print, $b );
			foreach ( $out as $i => $r ) {
				if ( $r['start'] === $q && $b === $q + strpos( $r['chunk'], '{' ) ) {
					$out[ $i ]['live']  = true;
					$out[ $i ]['close'] = $close;
				}
			}
			if ( -1 === $b || -1 === $close ) {
				break;
			}
			$pos = $close + 1;
		}
		$out['print'] = $print;
		return $out;
	}
}

if ( ! function_exists( 'origin_canvas_palette_block_css_copy' ) ) {
	/**
	 * The parts that give a variant of live rule part $i the declarations CSS reads for the part
	 * when its rule runs on past its own print (a comment or string holding an &): the parts from
	 * $i to the one whose print closes the rule, the first one's selector swapped for the variant.
	 * Printed, they read the same as the original but for the selector, so they go right before
	 * part $i, at its place in the cascade. A rule closed by a } inside a later declarations part
	 * takes that part up to the }; one left open at the end of the text in a comment only takes
	 * the parts to the last one printed, with the comment closed. null when the rule closes in its
	 * own print (the variant goes after the part, as for any rule), and false when it cannot be
	 * copied: a string, url( or bracket left open at the end, or a close core's print cannot
	 * reproduce.
	 *
	 * @param array  $parts   Parts.
	 * @param array  $texts   The parts' rewritten texts.
	 * @param string $own     Part $i's rewritten text after its {.
	 * @param array  $reading From origin_canvas_palette_block_css_reading().
	 * @param int    $i       Part index.
	 * @param string $variant The variant's selector, its leading whitespace included.
	 * @return array|null|false List of part texts.
	 */
	function origin_canvas_palette_block_css_copy( $parts, $texts, $own, $reading, $i, $variant ) {
		$close = $reading[ $i ]['close'];
		$end   = $reading[ $i ]['start'] + strlen( $reading[ $i ]['chunk'] ) - 1;
		if ( $close === $end ) {
			return null;
		}
		$copy = array( $variant . '{' . $own );
		$n    = count( $parts );
		if ( -1 === $close ) {
			// Open at the end of the text: only a comment can be closed here and read the same.
			$rest = (string) substr( $reading['print'], $reading[ $i ]['start'] + strpos( $reading[ $i ]['chunk'], '{' ) + 1 );
			if ( origin_canvas_palette_css_closed( $rest ) !== $rest . '*/' ) {
				return false;
			}
			$last = $i;
			for ( $k = $i + 1; $k < $n; $k++ ) {
				if ( '' !== $reading[ $k ]['chunk'] ) {
					$last = $k;
				}
			}
			for ( $k = $i + 1; $k <= $last; $k++ ) {
				$copy[] = $texts[ $k ];
			}
			$copy[ count( $copy ) - 1 ] .= '*/';
			return $copy;
		}
		for ( $k = $i + 1; $k < $n; $k++ ) {
			$copy[] = $texts[ $k ];
			$r      = $reading[ $k ];
			if ( '' === $r['chunk'] || $close >= $r['start'] + strlen( $r['chunk'] ) ) {
				continue;
			}
			if ( $close === $r['start'] + strlen( $r['chunk'] ) - 1 ) {
				return $copy;
			}
			// A } inside a declarations part (a rule part's are dropped): the copy ends before it,
			// and core's own } closes the rule. Core prints the part trimmed.
			$at = $close - $r['start'] - strpos( $r['chunk'], '{' ) - 1;
			if ( 'decls' !== $parts[ $k ]['kind'] || $texts[ $k ] !== $parts[ $k ]['text'] || $at < 0 ) {
				return false;
			}
			$copy[ count( $copy ) - 1 ] = substr( $texts[ $k ], 0, strlen( $texts[ $k ] ) - strlen( ltrim( $texts[ $k ] ) ) + $at );
			return $copy;
		}
		return false;
	}
}

if ( ! function_exists( 'origin_canvas_palette_rewrite_block_css' ) ) {
	/**
	 * The in-place rewrite of a block's custom CSS, in core's reading of it: with $vars, variables
	 * renamed and old preset declarations twinned, in the block's own declarations and in each
	 * nested rule; with $classes_on, negations expanded in place (core reads :not(a, b) as one
	 * selector) and each new variant of a nested rule written as a rule of its own after it,
	 * &<selector>{<declarations>}, so the old-class rule stays as it was and the new one is scoped
	 * to the block as the old one is. A comma between & parts would be read by core as
	 * declarations, so variants are never joined to a selector. Each part gets its own variants,
	 * nothing is merged across parts, so a later repeat of a selector still wins for the new class.
	 * Core splits on every &, one in a comment or a string too, so a rule can run on past its own
	 * part in core's print (origin_canvas_palette_block_css_reading()): its variants are copies of
	 * the parts it spans, written before it (origin_canvas_palette_block_css_copy()), and a part
	 * printed inside it gets none. A second run changes nothing.
	 *
	 * @param string $css        Block CSS.
	 * @param array  $collisions Collision map (dest => legacy), for classes.
	 * @param bool   $vars       Rename variables too.
	 * @param array  $var_extra  The gated collision map for variables.
	 * @param bool   $classes_on Add the class variants.
	 * @param array  $limits     Set to the selectors (trimmed) of old-class rules that get no
	 *                           variant: a rule core's print leaves open at the end of the text in
	 *                           a string, url( or bracket, so no copy reads the same.
	 * @return string
	 */
	function origin_canvas_palette_rewrite_block_css( $css, $collisions = array(), $vars = true, $var_extra = array(), $classes_on = true, &$limits = null ) {
		$limits    = array();
		$parts     = origin_canvas_palette_block_css_parts( $css );
		$classes   = origin_canvas_palette_old_classes();
		$collision = origin_canvas_palette_css_collision_classes( $collisions );
		// Core joins a selector to the block's as written: any leading whitespace (a space, a tab,
		// a newline) makes it a descendant, so a variant keeps the same whitespace bytes.
		$lead_of   = static function ( $sel ) {
			return (string) substr( $sel, 0, strspn( $sel, " \t\n\r\f" ) );
		};
		$key       = static function ( $sel ) use ( $lead_of ) {
			return $lead_of( $sel ) . origin_canvas_palette_css_trim( $sel );
		};
		$sels      = array();
		foreach ( $parts as $i => $p ) {
			if ( 'rule' === $p['kind'] ) {
				$sel        = substr( $p['text'], 0, $p['brace'] );
				$sels[ $i ] = $classes_on && origin_canvas_palette_css_balanced( $sel ) ? origin_canvas_palette_css_expand_negations( $sel, $classes ) : $sel;
			}
		}
		$base = array();
		foreach ( $sels as $i => $sel ) {
			$base[ $i ] = $classes_on && origin_canvas_palette_css_balanced( $sel ) ? array_flip( origin_canvas_palette_css_variants( $sel, $classes ) ) : array();
		}
		// First every part's own text; then the variants, which copy rewritten parts.
		$reading = origin_canvas_palette_block_css_reading( $parts );
		$texts   = array();
		$owns    = array();
		foreach ( $parts as $i => $p ) {
			if ( 'skip' === $p['kind'] ) {
				$texts[ $i ] = $p['text'];
				continue;
			}
			if ( 'decls' === $p['kind'] ) {
				$texts[ $i ] = $vars ? origin_canvas_palette_block_css_rename_decls( $p['text'], $var_extra ) : $p['text'];
				continue;
			}
			// The part keeps its own bytes with its variables renamed; when it is one plain body (its
			// only } at the end) its declarations are twinned as in a rule body too.
			$after = (string) substr( $p['text'], $p['brace'] + 1 );
			if ( ! $vars ) {
				$own = $after;
			} elseif ( strpos( $after, '}' ) === strlen( $after ) - 1 ) {
				$own = origin_canvas_palette_block_css_rename_decls( substr( $after, 0, -1 ), $var_extra ) . '}';
			} else {
				$own = origin_canvas_palette_css_rename_vars_in( $after, $var_extra );
			}
			$owns[ $i ]  = $own;
			$texts[ $i ] = $sels[ $i ] . '{' . $own;
		}
		$out = array();
		$n   = count( $parts );
		foreach ( $parts as $i => $p ) {
			$text = $texts[ $i ];
			// Only a part whose print starts a rule of its own gets variants: one printed inside an
			// earlier part's comment or string is that rule's text.
			if ( 'rule' !== $p['kind'] || ! $reading[ $i ]['live'] || ! $classes_on || ! origin_canvas_palette_css_balanced( $sels[ $i ] ) ) {
				$out[] = $text;
				continue;
			}
			$sel        = $sels[ $i ];
			$lead       = $lead_of( $sel );
			$is_variant = false;
			foreach ( $base as $j => $vs ) {
				if ( $j !== $i && isset( $vs[ origin_canvas_palette_css_trim( $sel ) ] ) ) {
					$is_variant = true;
					break;
				}
			}
			$map  = ( $is_variant || ! $collision ) ? $classes : array_merge( $classes, $collision );
			$want = array();
			foreach ( origin_canvas_palette_css_variants( $sel, $map ) as $v ) {
				$want[ $lead . $v ] = true;
			}
			if ( ! $want ) {
				$out[] = $text;
				continue;
			}
			$copies = array();
			$after  = false;
			foreach ( $want as $v => $unused ) {
				$copy = origin_canvas_palette_block_css_copy( $parts, $texts, $owns[ $i ], $reading, $i, $v );
				if ( null === $copy ) {
					$after = true;
				} elseif ( false === $copy ) {
					$limits[] = origin_canvas_palette_css_trim( $sel );
				} else {
					$copies[] = implode( '&', $copy );
				}
			}
			if ( $copies ) {
				// A rule that runs on past its own print: each variant is a copy of the parts its rule
				// spans, right before the part. A copy already there (a second pass) is not added again.
				$block  = implode( '&', $copies );
				$so_far = implode( '&', $out );
				if ( ! ( substr( $so_far, -strlen( $block ) ) === $block && ( strlen( $so_far ) === strlen( $block ) || '&' === $so_far[ strlen( $so_far ) - strlen( $block ) - 1 ] ) ) ) {
					$out[] = $block;
				}
			}
			if ( $after ) {
				// The rule closes in its own print: each variant goes right after the part, with the
				// declarations as core prints them (every } dropped, a tail after a } included). One
				// already right after its own part (a second pass) is not added again; a repeated
				// selector later in the text gets its own variants after it, in cascade order.
				$next      = str_replace( '}', '', $owns[ $i ] );
				$following = array();
				for ( $j = $i + 1; $j < $n && 'rule' === $parts[ $j ]['kind'] && isset( $want[ $key( $sels[ $j ] ) ] ); $j++ ) {
					$following[ $key( $sels[ $j ] ) ] = true;
				}
				foreach ( $want as $v => $unused ) {
					if ( ! isset( $following[ $v ] ) ) {
						$text .= '&' . $v . '{' . $next . '}';
					}
				}
			}
			$out[] = $text;
		}
		$limits = array_values( array_unique( $limits ) );
		return implode( '&', $out );
	}
}

if ( ! function_exists( 'origin_canvas_palette_block_css_hits' ) ) {
	/**
	 * Old codes in a block's custom CSS, in core's reading of it: old classes in the selector of
	 * each nested rule whose print starts a rule of its own (one printed inside an earlier part's
	 * comment or string is text) and old variables in the declarations, read as code.
	 *
	 * @param string $css Block CSS.
	 * @return string[]
	 */
	function origin_canvas_palette_block_css_hits( $css ) {
		$hits    = array();
		$classes = origin_canvas_palette_old_classes();
		$parts   = origin_canvas_palette_block_css_parts( $css );
		$reading = origin_canvas_palette_block_css_reading( $parts );
		foreach ( $parts as $i => $p ) {
			if ( 'skip' === $p['kind'] ) {
				continue;
			}
			if ( 'rule' === $p['kind'] && $reading[ $i ]['live'] ) {
				$sel = substr( $p['text'], 0, $p['brace'] );
				if ( origin_canvas_palette_css_balanced( $sel ) ) {
					foreach ( origin_canvas_palette_css_tokens( $sel, $classes ) as $t ) {
						$hits[] = 'class=' . $t['cls'];
					}
				}
			}
			$decls = origin_canvas_palette_block_css_decls( $p );
			foreach ( origin_canvas_palette_css_code_hits( 'x{' . str_replace( '{', '', $decls ) . '}' ) as $h ) {
				if ( 0 !== strpos( $h, 'class=' ) ) {
					$hits[] = $h;
				}
			}
		}
		return array_values( array_unique( $hits ) );
	}
}
