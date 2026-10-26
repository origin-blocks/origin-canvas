<?php
/**
 * The palette rename (#116): the Global Styles transform. Pure but for the cached read of the
 * parent theme.json palette.
 *
 * The transform works on the json_decode( $json ) object graph: objects as stdClass, lists as
 * arrays. Every walker tests is_object() before it reads an object's keys and is_array() before
 * it treats a node as a list, so a stored {} stays {} and a stored [] stays [].
 *
 * @package Origin_Canvas
 */

if ( ! function_exists( 'origin_canvas_palette_parent_palette' ) ) {
	/**
	 * The parent theme.json palette: slug => colour.
	 *
	 * @return array<string, string>
	 */
	function origin_canvas_palette_parent_palette() {
		static $palette = null;
		if ( null !== $palette ) {
			return $palette;
		}
		$key    = 'palette-' . ORIGIN_CANVAS_VERSION;
		$cached = wp_cache_get( $key, 'origin-canvas' );
		if ( is_array( $cached ) ) {
			$palette = $cached;
			return $palette;
		}
		$palette = array();
		$file    = get_template_directory() . '/theme.json';
		$data    = is_readable( $file ) ? json_decode( (string) file_get_contents( $file ), true ) : null; // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents -- a local theme file.
		if ( is_array( $data ) && isset( $data['settings']['color']['palette'] ) && is_array( $data['settings']['color']['palette'] ) ) {
			foreach ( $data['settings']['color']['palette'] as $entry ) {
				if ( is_array( $entry ) && isset( $entry['slug'], $entry['color'] ) ) {
					$palette[ (string) $entry['slug'] ] = (string) $entry['color'];
				}
			}
		}
		wp_cache_set( $key, $palette, 'origin-canvas' );
		return $palette;
	}
}

if ( ! function_exists( 'origin_canvas_palette_obj' ) ) {
	/**
	 * A child object of an object, or null.
	 *
	 * @param mixed  $o   Object.
	 * @param string $key Key.
	 * @return stdClass|null
	 */
	function origin_canvas_palette_obj( $o, $key ) {
		return ( is_object( $o ) && isset( $o->$key ) && is_object( $o->$key ) ) ? $o->$key : null;
	}
}

if ( ! function_exists( 'origin_canvas_palette_levels' ) ) {
	/**
	 * The settings levels of a record: '' => settings, '<block>' => settings.blocks.<block>.
	 *
	 * @param stdClass $data Record.
	 * @return array<string, stdClass>
	 */
	function origin_canvas_palette_levels( $data ) {
		$levels   = array();
		$settings = origin_canvas_palette_obj( $data, 'settings' );
		if ( ! $settings ) {
			return $levels;
		}
		$levels[''] = $settings;
		$blocks     = origin_canvas_palette_obj( $settings, 'blocks' );
		if ( $blocks ) {
			foreach ( get_object_vars( $blocks ) as $name => $b ) {
				if ( is_object( $b ) ) {
					$levels[ (string) $name ] = $b;
				}
			}
		}
		return $levels;
	}
}

if ( ! function_exists( 'origin_canvas_palette_entry_slug' ) ) {
	/**
	 * A list entry's slug, or null.
	 *
	 * @param mixed $e Entry.
	 * @return string|null
	 */
	function origin_canvas_palette_entry_slug( $e ) {
		return ( is_object( $e ) && isset( $e->slug ) && is_string( $e->slug ) ) ? $e->slug : null;
	}
}

if ( ! function_exists( 'origin_canvas_palette_level_collisions' ) ) {
	/**
	 * Collisions of one settings level, per list: a palette entry on a destination D collides only
	 * when the same theme list holds an entry whose old slug maps to D; small-medium only when that
	 * spacingSizes list holds compact; the key normal only when that lineHeight object holds body.
	 * Each moves to the first of <slug>-legacy, <slug>-legacy-2, … that no entry of that level uses
	 * and that is not a destination.
	 *
	 * The rewrite of one list is atomic: a list that still holds an old slug was never rewritten,
	 * so a destination entry in it is the user's own. A list with no old slug may be a rewritten
	 * one, and nothing in it moves.
	 *
	 * @param stdClass|null $s Settings level.
	 * @return array{color: array<string, string>, spacing: array<string, string>, lineHeight: array<string, string>}
	 */
	function origin_canvas_palette_level_collisions( $s ) {
		$map   = origin_canvas_palette_map();
		$dest  = origin_canvas_palette_rules()['destinations'];
		$out   = array(
			'color'      => array(),
			'spacing'    => array(),
			'lineHeight' => array(),
		);
		$free  = static function ( $base, &$used, $kind ) use ( $dest ) {
			for ( $n = 1; ; $n++ ) {
				$slug = 1 === $n ? $base . '-legacy' : $base . '-legacy-' . $n;
				if ( ! isset( $used[ $slug ] ) && ! in_array( $slug, $dest[ $kind ], true ) ) {
					$used[ $slug ] = true;
					return $slug;
				}
			}
		};
		$color = origin_canvas_palette_obj( $s, 'color' );
		$pal   = origin_canvas_palette_obj( $color, 'palette' );
		$theme = ( $pal && isset( $pal->theme ) && is_array( $pal->theme ) ) ? $pal->theme : array();
		$used  = array();
		foreach ( array( 'theme', 'custom', 'default' ) as $origin ) {
			if ( $pal && isset( $pal->$origin ) && is_array( $pal->$origin ) ) {
				foreach ( $pal->$origin as $e ) {
					$slug = origin_canvas_palette_entry_slug( $e );
					if ( null !== $slug ) {
						$used[ $slug ] = true;
					}
				}
			}
		}
		$theme_slugs = array();
		foreach ( $theme as $e ) {
			$slug = origin_canvas_palette_entry_slug( $e );
			if ( null !== $slug ) {
				$theme_slugs[] = $slug;
			}
		}
		foreach ( $theme_slugs as $d ) {
			if ( ! in_array( $d, $dest['color'], true ) || isset( $out['color'][ $d ] ) ) {
				continue;
			}
			foreach ( $theme_slugs as $o ) {
				if ( isset( $map['color'][ $o ] ) && $map['color'][ $o ] === $d ) {
					$out['color'][ $d ] = $free( $d, $used, 'color' );
					break;
				}
			}
		}

		$spacing = origin_canvas_palette_obj( $s, 'spacing' );
		$sizes   = origin_canvas_palette_obj( $spacing, 'spacingSizes' );
		$slist   = ( $sizes && isset( $sizes->theme ) && is_array( $sizes->theme ) ) ? $sizes->theme : array();
		$sslugs  = array();
		foreach ( $slist as $e ) {
			$slug = origin_canvas_palette_entry_slug( $e );
			if ( null !== $slug ) {
				$sslugs[] = $slug;
			}
		}
		$sused = array_fill_keys( $sslugs, true );
		foreach ( $sslugs as $d ) {
			if ( ! in_array( $d, $dest['spacing'], true ) || isset( $out['spacing'][ $d ] ) ) {
				continue;
			}
			foreach ( $sslugs as $o ) {
				if ( isset( $map['spacing'][ $o ] ) && $map['spacing'][ $o ] === $d ) {
					$out['spacing'][ $d ] = $free( $d, $sused, 'spacing' );
					break;
				}
			}
		}

		$custom = origin_canvas_palette_obj( $s, 'custom' );
		$lh     = origin_canvas_palette_obj( $custom, 'lineHeight' );
		$keys   = $lh ? array_map( 'strval', array_keys( get_object_vars( $lh ) ) ) : array();
		$kused  = array_fill_keys( $keys, true );
		foreach ( $keys as $d ) {
			if ( ! in_array( $d, $dest['lineHeight'], true ) || isset( $out['lineHeight'][ $d ] ) ) {
				continue;
			}
			foreach ( $keys as $o ) {
				if ( isset( $map['lineHeight'][ $o ] ) && $map['lineHeight'][ $o ] === $d ) {
					$out['lineHeight'][ $d ] = $free( $d, $kused, 'lineHeight' );
					break;
				}
			}
		}
		return $out;
	}
}

if ( ! function_exists( 'origin_canvas_palette_collisions' ) ) {
	/**
	 * The collisions of a record, per list: array( 'root' => kind => dest => legacy, 'blocks' =>
	 * block => kind => dest => legacy ), blocks listed only when they have one.
	 *
	 * @param stdClass $data Record.
	 * @return array
	 */
	function origin_canvas_palette_collisions( $data ) {
		$out    = array(
			'root'   => origin_canvas_palette_level_collisions( origin_canvas_palette_obj( $data, 'settings' ) ),
			'blocks' => array(),
		);
		$levels = origin_canvas_palette_levels( $data );
		foreach ( $levels as $name => $level ) {
			if ( '' === $name ) {
				continue;
			}
			$c = origin_canvas_palette_level_collisions( $level );
			if ( $c['color'] || $c['spacing'] || $c['lineHeight'] ) {
				$out['blocks'][ $name ] = $c;
			}
		}
		return $out;
	}
}

if ( ! function_exists( 'origin_canvas_palette_over' ) ) {
	/**
	 * A block's collision map over the root one.
	 *
	 * @param array      $root  Root collisions.
	 * @param array|null $block Block collisions.
	 * @return array
	 */
	function origin_canvas_palette_over( $root, $block ) {
		$out = array();
		foreach ( array( 'color', 'spacing', 'lineHeight' ) as $kind ) {
			$out[ $kind ] = array_merge( isset( $root[ $kind ] ) ? $root[ $kind ] : array(), isset( $block[ $kind ] ) ? $block[ $kind ] : array() );
		}
		return $out;
	}
}

if ( ! function_exists( 'origin_canvas_palette_deep_rename' ) ) {
	/**
	 * Rename references in every string of a node; a string under a key named css goes through
	 * the CSS rule (declaration values only), every other through rename_refs(). With $block, a
	 * css string is a block's custom CSS (every css below styles.css's own level), read as core
	 * prints it.
	 *
	 * @param mixed  $v     Node.
	 * @param array  $extra Collision map.
	 * @param string $key   The node's key.
	 * @param bool   $block A css string here is block CSS.
	 * @return mixed
	 */
	function origin_canvas_palette_deep_rename( $v, $extra, $key = '', $block = false ) {
		if ( is_string( $v ) ) {
			if ( 'css' === $key ) {
				return $block ? origin_canvas_palette_rewrite_block_css( $v, array(), true, $extra, false ) : origin_canvas_palette_css_rename_vars( $v, $extra );
			}
			return origin_canvas_palette_rename_refs( $v, $extra );
		}
		if ( is_array( $v ) ) {
			foreach ( $v as $i => $x ) {
				$v[ $i ] = origin_canvas_palette_deep_rename( $x, $extra, '', $block );
			}
			return $v;
		}
		if ( is_object( $v ) ) {
			foreach ( get_object_vars( $v ) as $k => $x ) {
				$v->$k = origin_canvas_palette_deep_rename( $x, $extra, (string) $k, $block );
			}
			return $v;
		}
		return $v;
	}
}

if ( ! function_exists( 'origin_canvas_palette_hex' ) ) {
	/**
	 * Channels of a #RRGGBB colour, or null.
	 *
	 * @param mixed $c Colour.
	 * @return int[]|null
	 */
	function origin_canvas_palette_hex( $c ) {
		if ( ! is_string( $c ) || ! preg_match( '/^#([0-9a-fA-F]{2})([0-9a-fA-F]{2})([0-9a-fA-F]{2})$/D', $c, $m ) ) {
			return null;
		}
		return array( hexdec( $m[1] ), hexdec( $m[2] ), hexdec( $m[3] ) );
	}
}

if ( ! function_exists( 'origin_canvas_palette_mix' ) ) {
	/**
	 * round( p% × a + (100 − p)% × b ) per channel, as #RRGGBB.
	 *
	 * @param int[] $a First colour.
	 * @param int[] $b Second colour.
	 * @param int   $p Percent of the first.
	 * @return string
	 */
	function origin_canvas_palette_mix( $a, $b, $p ) {
		$out = '#';
		for ( $i = 0; $i < 3; $i++ ) {
			$out .= sprintf( '%02X', (int) round( ( $p * $a[ $i ] + ( 100 - $p ) * $b[ $i ] ) / 100 ) );
		}
		return $out;
	}
}

if ( ! function_exists( 'origin_canvas_palette_colour_key' ) ) {
	/**
	 * A palette entry's colour as the merge compares it: a hex colour in upper case, any other
	 * value trimmed.
	 *
	 * @param object $e Palette entry.
	 * @return string
	 */
	function origin_canvas_palette_colour_key( $e ) {
		$c = isset( $e->color ) && is_string( $e->color ) ? trim( $e->color ) : '';
		return null === origin_canvas_palette_hex( $c ) ? $c : strtoupper( $c );
	}
}

if ( ! function_exists( 'origin_canvas_palette_merge_changed' ) ) {
	/**
	 * Whether a merge dropped an entry whose colour differed from the Base 2 entry it merged into
	 * (a customised On Dark), since the last reset. The first admin load reads it per record.
	 *
	 * @param bool|null $set True to record a change, false to reset, null to read.
	 * @return bool
	 */
	function origin_canvas_palette_merge_changed( $set = null ) {
		static $changed = false;
		if ( null !== $set ) {
			$changed = $set;
		}
		return $changed;
	}
}

if ( ! function_exists( 'origin_canvas_palette_transform_palette_list' ) ) {
	/**
	 * Rewrite one palette.theme list that holds an old slug: collisions, renames, the Base 2
	 * merge and, at the root only, the missing slugs.
	 *
	 * @param array $list       The list.
	 * @param array $collisions Colour collisions of this level (dest => legacy).
	 * @param bool  $root       Whether this is the root list.
	 * @return array
	 */
	function origin_canvas_palette_transform_palette_list( $list, $collisions, $root ) {
		$map   = origin_canvas_palette_map()['color'];
		$rules = origin_canvas_palette_rules();

		$origins = array(); // Index => the old slug the entry came from, or ''.
		foreach ( $list as $i => $e ) {
			$slug = origin_canvas_palette_entry_slug( $e );
			if ( null === $slug ) {
				$origins[ $i ] = '';
				continue;
			}
			// (i) Collisions: the user's own entry on a destination keeps its value under its
			// legacy slug, in its position. (ii) Renames, one lookup per slug.
			if ( isset( $collisions[ $slug ] ) ) {
				$e       = clone $e;
				$e->slug = $collisions[ $slug ];
				if ( isset( $e->name ) && is_string( $e->name ) ) {
					$e->name .= $rules['legacy_suffix']['name'];
				}
				$list[ $i ]    = $e;
				$origins[ $i ] = '';
				continue;
			}
			if ( isset( $map[ $slug ] ) ) {
				$e       = clone $e;
				$new     = $map[ $slug ];
				$e->slug = $new;
				if ( isset( $e->color ) && isset( $e->name ) && $e->name === $rules['shipped_names'][ $slug ] ) {
					$e->name = $rules['names'][ $new ];
				}
				$list[ $i ]    = $e;
				$origins[ $i ] = $slug;
				continue;
			}
			$origins[ $i ] = '';
		}

		// (iii) The merge: of the entries now on base-2, keep the one from surface-muted (else the
		// first) and drop the on-dark entry. A slug the saved list held twice stays as saved.
		// No On Dark legacy swatch, in any case (owner ruling, Oct 24): every on-dark reference
		// reads Base 2, whatever its saved value was. The collision legacy slugs of (i) stay, since
		// there a user swatch would be lost outright.
		foreach ( $rules['merge'] as $target => $from ) {
			$on = array();
			foreach ( $list as $i => $e ) {
				if ( origin_canvas_palette_entry_slug( $e ) === $target ) {
					$on[] = $i;
				}
			}
			if ( count( $on ) < 2 ) {
				continue;
			}
			$kept = $on[0];
			foreach ( $on as $i ) {
				if ( $origins[ $i ] === $from[0] ) {
					$kept = $i;
					break;
				}
			}
			foreach ( $on as $i ) {
				if ( $i !== $kept && in_array( $origins[ $i ], array_slice( $from, 1 ), true ) ) {
					if ( origin_canvas_palette_colour_key( $list[ $i ] ) !== origin_canvas_palette_colour_key( $list[ $kept ] ) ) {
						origin_canvas_palette_merge_changed( true );
					}
					unset( $list[ $i ] );
				}
			}
		}
		$list = array_values( $list );

		// (v) The root list only, when not empty: every slug of the new palette still missing goes
		// in after the nearest earlier slug present. A block-level list keeps inheriting the rest.
		if ( $root && $list ) {
			$parent = origin_canvas_palette_parent_palette();
			foreach ( $rules['order'] as $k => $slug ) {
				$at = -1;
				foreach ( $list as $i => $e ) {
					if ( origin_canvas_palette_entry_slug( $e ) === $slug ) {
						$at = -2;
						break;
					}
				}
				if ( -2 === $at ) {
					continue;
				}
				for ( $j = $k - 1; $j >= 0 && -1 === $at; $j-- ) {
					foreach ( $list as $i => $e ) {
						if ( origin_canvas_palette_entry_slug( $e ) === $rules['order'][ $j ] ) {
							$at = $i + 1;
							break;
						}
					}
				}
				$colour = isset( $parent[ $slug ] ) ? $parent[ $slug ] : '';
				if ( isset( $rules['mix'][ $slug ] ) ) {
					list( $a_slug, $b_slug, $p ) = $rules['mix'][ $slug ];
					$a                           = null;
					$b                           = null;
					foreach ( $list as $e ) {
						$s = origin_canvas_palette_entry_slug( $e );
						if ( $s === $a_slug && null === $a ) {
							$a = origin_canvas_palette_hex( isset( $e->color ) ? $e->color : null );
						} elseif ( $s === $b_slug && null === $b ) {
							$b = origin_canvas_palette_hex( isset( $e->color ) ? $e->color : null );
						}
					}
					if ( $a && $b ) {
						$colour = origin_canvas_palette_mix( $a, $b, $p );
					}
				}
				if ( '' === $colour ) {
					continue;
				}
				array_splice(
					$list,
					max( 0, $at ),
					0,
					array(
						(object) array(
							'slug'  => $slug,
							'name'  => $rules['names'][ $slug ],
							'color' => $colour,
						),
					)
				);
			}
		}
		return $list;
	}
}

if ( ! function_exists( 'origin_canvas_palette_transform_level' ) ) {
	/**
	 * Rewrite one settings level's lists: the theme palette (when it holds an old slug), the
	 * theme spacing sizes and the custom line heights.
	 *
	 * @param stdClass $level      Settings level.
	 * @param array    $collisions This level's collisions.
	 * @param bool     $root       Whether this is the root level.
	 * @return void
	 */
	function origin_canvas_palette_transform_level( $level, $collisions, $root ) {
		$map   = origin_canvas_palette_map();
		$rules = origin_canvas_palette_rules();

		$color = origin_canvas_palette_obj( $level, 'color' );
		$pal   = origin_canvas_palette_obj( $color, 'palette' );
		if ( $pal && isset( $pal->theme ) && is_array( $pal->theme ) ) {
			$holds = false;
			foreach ( $pal->theme as $e ) {
				$slug = origin_canvas_palette_entry_slug( $e );
				if ( null !== $slug && isset( $map['color'][ $slug ] ) ) {
					$holds = true;
					break;
				}
			}
			if ( $holds ) {
				$pal->theme = origin_canvas_palette_transform_palette_list( $pal->theme, $collisions['color'], $root );
			}
		}

		$spacing = origin_canvas_palette_obj( $level, 'spacing' );
		$sizes   = origin_canvas_palette_obj( $spacing, 'spacingSizes' );
		if ( $sizes && isset( $sizes->theme ) && is_array( $sizes->theme ) ) {
			foreach ( $sizes->theme as $i => $e ) {
				$slug = origin_canvas_palette_entry_slug( $e );
				if ( null === $slug ) {
					continue;
				}
				if ( isset( $collisions['spacing'][ $slug ] ) ) {
					$e       = clone $e;
					$e->slug = $collisions['spacing'][ $slug ];
					if ( isset( $e->name ) && is_string( $e->name ) ) {
						$e->name .= $rules['legacy_suffix']['name'];
					}
					$sizes->theme[ $i ] = $e;
				} elseif ( isset( $map['spacing'][ $slug ] ) ) {
					$e       = clone $e;
					$e->slug = $map['spacing'][ $slug ];
					if ( isset( $e->name ) && isset( $rules['spacing_names'][ $slug ] ) && $e->name === $rules['spacing_names'][ $slug ][0] ) {
						$e->name = $rules['spacing_names'][ $slug ][1];
					}
					$sizes->theme[ $i ] = $e;
				}
			}
		}

		$custom = origin_canvas_palette_obj( $level, 'custom' );
		$lh     = origin_canvas_palette_obj( $custom, 'lineHeight' );
		if ( $lh ) {
			$vars    = get_object_vars( $lh );
			$touched = false;
			$next    = new stdClass();
			foreach ( $vars as $k => $v ) {
				$k = (string) $k;
				if ( isset( $collisions['lineHeight'][ $k ] ) ) {
					$k       = $collisions['lineHeight'][ $k ];
					$touched = true;
				} elseif ( isset( $map['lineHeight'][ $k ] ) ) {
					$k       = $map['lineHeight'][ $k ];
					$touched = true;
				}
				$next->$k = $v;
			}
			if ( $touched ) {
				$custom->lineHeight = $next; // phpcs:ignore WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase -- theme.json key.
			}
		}
	}
}

if ( ! function_exists( 'origin_canvas_palette_rename_settings_strings' ) ) {
	/**
	 * Rename references in the strings of a settings level's gradients, typography, spacing and
	 * custom settings.
	 *
	 * @param stdClass $level Settings level.
	 * @param array    $extra Collision map.
	 * @return void
	 */
	function origin_canvas_palette_rename_settings_strings( $level, $extra ) {
		$color = origin_canvas_palette_obj( $level, 'color' );
		if ( $color && isset( $color->gradients ) ) {
			$color->gradients = origin_canvas_palette_deep_rename( $color->gradients, $extra, 'gradients' );
		}
		foreach ( array( 'typography', 'spacing', 'custom' ) as $key ) {
			if ( isset( $level->$key ) ) {
				$level->$key = origin_canvas_palette_deep_rename( $level->$key, $extra, $key );
			}
		}
	}
}

if ( ! function_exists( 'origin_canvas_palette_transform_global_styles' ) ) {
	/**
	 * Rewrite one Global Styles record in place: collisions first, then the map, one lookup per
	 * captured slug. Custom and default palettes are never touched; class selectors in css strings
	 * are left (Update colours twins them). No isGlobalStylesUserThemeJSON check here: core strips
	 * that flag before the read filter sees the data.
	 *
	 * @param stdClass   $data       Record, mutated.
	 * @param array|null $collisions Set to the collisions applied.
	 * @return bool Whether anything changed.
	 */
	function origin_canvas_palette_transform_global_styles( $data, &$collisions = null ) {
		if ( ! is_object( $data ) ) {
			$collisions = null;
			return false;
		}
		$before     = wp_json_encode( $data );
		$collisions = origin_canvas_palette_collisions( $data );
		$root       = $collisions['root'];

		// Strings: styles at every depth, each styles.blocks.<block> with its block's map.
		if ( isset( $data->styles ) ) {
			$styles = $data->styles;
			if ( is_object( $styles ) ) {
				foreach ( get_object_vars( $styles ) as $k => $v ) {
					if ( 'blocks' === $k && is_object( $v ) ) {
						foreach ( get_object_vars( $v ) as $name => $b ) {
							$block_map = origin_canvas_palette_over( $root, isset( $collisions['blocks'][ $name ] ) ? $collisions['blocks'][ $name ] : null );
							$v->$name  = origin_canvas_palette_deep_rename( $b, $block_map, '', true );
						}
						continue;
					}
					// styles.css is the site's stylesheet; a css below another key is block CSS.
					$styles->$k = 'css' === $k ? origin_canvas_palette_deep_rename( $v, $root, 'css' ) : origin_canvas_palette_deep_rename( $v, $root, (string) $k, true );
				}
			} else {
				$data->styles = origin_canvas_palette_deep_rename( $styles, $root, 'styles' );
			}
		}

		foreach ( origin_canvas_palette_levels( $data ) as $name => $level ) {
			$level_map = '' === $name ? $root : origin_canvas_palette_over( $root, isset( $collisions['blocks'][ $name ] ) ? $collisions['blocks'][ $name ] : null );
			origin_canvas_palette_rename_settings_strings( $level, $level_map );
			$own = '' === $name ? $root : ( isset( $collisions['blocks'][ $name ] ) ? $collisions['blocks'][ $name ] : array(
				'color'      => array(),
				'spacing'    => array(),
				'lineHeight' => array(),
			) );
			origin_canvas_palette_transform_level( $level, $own, '' === $name );
		}

		return wp_json_encode( $data ) !== $before;
	}
}

if ( ! function_exists( 'origin_canvas_palette_rewrite_global_styles_json' ) ) {
	/**
	 * The rewrite of one stored Global Styles post_content.
	 *
	 * @param string     $json       Stored content.
	 * @param array|null $collisions Set to the collisions applied.
	 * @return string|null null when the content is not a user Global Styles record; the same
	 *                     string when nothing changed; else the rewritten JSON, encoded as the
	 *                     REST controller saves it.
	 */
	function origin_canvas_palette_rewrite_global_styles_json( $json, &$collisions = null ) {
		$data = json_decode( (string) $json );
		if ( ! is_object( $data ) || empty( $data->isGlobalStylesUserThemeJSON ) ) { // phpcs:ignore WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase -- core's key.
			$collisions = null;
			return null;
		}
		if ( ! origin_canvas_palette_transform_global_styles( $data, $collisions ) ) {
			return $json;
		}
		return wp_json_encode( $data, JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP );
	}
}

if ( ! function_exists( 'origin_canvas_palette_settings_hits' ) ) {
	/**
	 * Old slugs and keys in the settings of a decoded theme.json-shaped object: every
	 * color.palette list (plain, or keyed by origin), every spacing.spacingSizes list and the keys
	 * of every custom.lineHeight, at settings and at each settings.blocks.<block>.
	 *
	 * @param mixed $data Decoded object.
	 * @param bool  $theme_only Only the theme origin of a keyed palette.
	 * @return string[]
	 */
	function origin_canvas_palette_settings_hits( $data, $theme_only = false ) {
		if ( is_array( $data ) ) {
			$data = json_decode( wp_json_encode( $data ) );
		}
		$map  = origin_canvas_palette_map();
		$hits = array();
		foreach ( origin_canvas_palette_levels( $data ) as $name => $level ) {
			$at    = '' === $name ? 'settings' : 'settings.blocks.' . $name;
			$lists = array(
				'color.palette'        => array( origin_canvas_palette_obj( $level, 'color' ), 'palette', 'color' ),
				'spacing.spacingSizes' => array( origin_canvas_palette_obj( $level, 'spacing' ), 'spacingSizes', 'spacing' ),
			);
			foreach ( $lists as $path => $spec ) {
				list( $parent, $key, $kind ) = $spec;
				if ( ! is_object( $parent ) || ! isset( $parent->$key ) ) {
					continue;
				}
				$node   = $parent->$key;
				$groups = array();
				if ( is_array( $node ) ) {
					$groups['list'] = $node;
				} elseif ( is_object( $node ) ) {
					foreach ( get_object_vars( $node ) as $origin => $list ) {
						if ( is_array( $list ) && ( ! $theme_only || 'theme' === $origin ) ) {
							$groups[ $origin ] = $list;
						}
					}
				}
				foreach ( $groups as $origin => $list ) {
					foreach ( $list as $e ) {
						$slug = origin_canvas_palette_entry_slug( $e );
						if ( null !== $slug && isset( $map[ $kind ][ $slug ] ) ) {
							$hits[] = $at . '.' . $path . '.' . $origin . '=' . $slug;
						}
					}
				}
			}
			$lh = origin_canvas_palette_obj( origin_canvas_palette_obj( $level, 'custom' ), 'lineHeight' );
			if ( $lh ) {
				foreach ( array_keys( get_object_vars( $lh ) ) as $k ) {
					if ( isset( $map['lineHeight'][ (string) $k ] ) ) {
						$hits[] = $at . '.custom.lineHeight.' . $k;
					}
				}
			}
		}
		return $hits;
	}
}

if ( ! function_exists( 'origin_canvas_palette_string_hits' ) ) {
	/**
	 * Paths of the strings in a node that the transform would rename.
	 *
	 * @param mixed  $v    Node.
	 * @param string $path Path.
	 * @param string $key  Key.
	 * @param array  $hits Collected hits.
	 * @return void
	 */
	function origin_canvas_palette_string_hits( $v, $path, $key, &$hits ) {
		if ( is_string( $v ) ) {
			if ( 'css' !== $key ) {
				$next = origin_canvas_palette_rename_refs( $v );
			} elseif ( 'styles.css' === $path ) {
				$next = origin_canvas_palette_css_rename_vars( $v );
			} else {
				$next = origin_canvas_palette_rewrite_block_css( $v, array(), true, array(), false );
			}
			if ( $next !== $v ) {
				$hits[] = $path;
			}
			return;
		}
		if ( is_array( $v ) || is_object( $v ) ) {
			foreach ( ( is_object( $v ) ? get_object_vars( $v ) : $v ) as $k => $x ) {
				origin_canvas_palette_string_hits( $x, $path . '.' . $k, is_object( $v ) ? (string) $k : '', $hits );
			}
		}
	}
}

if ( ! function_exists( 'origin_canvas_palette_global_styles_hits' ) ) {
	/**
	 * Old codes in a stored Global Styles record: fixable (what the transform changes) and alias
	 * (class selectors in css strings, which Update colours twins). A record the rewrite cannot
	 * change (no isGlobalStylesUserThemeJSON marker, or a plain palette list) has nothing fixable:
	 * its old codes count as alias only, so the aliases load and Update colours is not offered
	 * for a record it would leave as it is.
	 *
	 * @param string $json Stored content.
	 * @return array{fixable: string[], alias: string[]}
	 */
	function origin_canvas_palette_global_styles_hits( $json ) {
		$out  = array(
			'fixable' => array(),
			'alias'   => array(),
		);
		$data = json_decode( (string) $json );
		if ( ! is_object( $data ) ) {
			return $out;
		}
		$out['fixable'] = origin_canvas_palette_settings_hits( $data, true );
		if ( isset( $data->styles ) ) {
			origin_canvas_palette_string_hits( $data->styles, 'styles', 'styles', $out['fixable'] );
		}
		foreach ( origin_canvas_palette_levels( $data ) as $name => $level ) {
			$at    = '' === $name ? 'settings' : 'settings.blocks.' . $name;
			$color = origin_canvas_palette_obj( $level, 'color' );
			if ( $color && isset( $color->gradients ) ) {
				origin_canvas_palette_string_hits( $color->gradients, $at . '.color.gradients', 'gradients', $out['fixable'] );
			}
			foreach ( array( 'typography', 'spacing', 'custom' ) as $key ) {
				if ( isset( $level->$key ) ) {
					origin_canvas_palette_string_hits( $level->$key, $at . '.' . $key, $key, $out['fixable'] );
				}
			}
		}
		$classes = origin_canvas_palette_old_classes();
		$css     = array();
		$block   = array();
		$collect = static function ( $v, $key, $path ) use ( &$collect, &$css, &$block ) {
			if ( is_string( $v ) ) {
				if ( 'css' === $key && 'styles.css' === $path ) {
					$css[] = $v;
				} elseif ( 'css' === $key ) {
					$block[] = $v; // Block CSS, read as core prints it.
				}
				return;
			}
			if ( is_array( $v ) || is_object( $v ) ) {
				foreach ( ( is_object( $v ) ? get_object_vars( $v ) : $v ) as $k => $x ) {
					$collect( $x, is_object( $v ) ? (string) $k : '', $path . '.' . $k );
				}
			}
		};
		if ( isset( $data->styles ) ) {
			$collect( $data->styles, 'styles', 'styles' );
		}
		foreach ( $block as $text ) {
			foreach ( origin_canvas_palette_block_css_hits( $text ) as $h ) {
				if ( 0 === strpos( $h, 'class=' ) ) {
					$out['alias'][] = 'styles.css=' . substr( $h, 6 );
				}
			}
		}
		foreach ( $css as $text ) {
			origin_canvas_palette_css_scan(
				$text,
				static function ( $prelude ) use ( $classes, &$out ) {
					foreach ( origin_canvas_palette_css_tokens( $prelude, $classes ) as $t ) {
						$out['alias'][] = 'styles.css=' . $t['cls'];
					}
					return null;
				},
				true
			);
		}
		if ( $out['fixable'] ) {
			$merged = origin_canvas_palette_merge_changed(); // The report's per-record flag, kept.
			$next   = origin_canvas_palette_rewrite_global_styles_json( (string) $json );
			origin_canvas_palette_merge_changed( $merged );
			if ( null === $next || (string) $json === $next ) {
				$out['alias']   = array_merge( $out['alias'], $out['fixable'] );
				$out['fixable'] = array();
			}
		}
		return $out;
	}
}
