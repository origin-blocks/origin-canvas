<?php
/**
 * The palette rename (#116): the compatibility aliases and their loader.
 *
 * On a site that existed before the rename (the mark in inc/palette-state.php), old variables and
 * classes keep rendering in the front end and both editors. Two parts load: the twin rules in
 * assets/css/palette-aliases.css, built by bin/build-palette-aliases.php, and the declarations here,
 * which depend on the site's own palette. Those fill only names the effective palette lacks:
 * forward (an old name reads its new one) or reverse (a new name reads the old one a child theme
 * still defines). In the editors, assets/js/editor-palette.js hands edit components the new slug.
 *
 * @package Origin_Canvas
 */

if ( ! function_exists( 'origin_canvas_palette_present' ) ) {
	/**
	 * The slugs and keys a settings level defines: colour and spacing slugs in the theme and custom
	 * origins, and the custom line height keys.
	 *
	 * @param array $settings Settings level (merged global settings).
	 * @return array{color: array<string, true>, spacing: array<string, true>, lineHeight: array<string, true>, has: array<string, bool>}
	 */
	function origin_canvas_palette_present( $settings ) {
		$out = array(
			'color'      => array(),
			'spacing'    => array(),
			'lineHeight' => array(),
			'has'        => array(
				'color'      => false,
				'spacing'    => false,
				'lineHeight' => false,
			),
		);
		$lists = array(
			'color'   => isset( $settings['color']['palette'] ) ? $settings['color']['palette'] : null,
			'spacing' => isset( $settings['spacing']['spacingSizes'] ) ? $settings['spacing']['spacingSizes'] : null,
		);
		foreach ( $lists as $kind => $by_origin ) {
			if ( ! is_array( $by_origin ) ) {
				continue;
			}
			foreach ( array( 'theme', 'custom' ) as $origin ) {
				if ( ! isset( $by_origin[ $origin ] ) || ! is_array( $by_origin[ $origin ] ) ) {
					continue;
				}
				$out['has'][ $kind ] = true;
				foreach ( $by_origin[ $origin ] as $e ) {
					if ( is_array( $e ) && isset( $e['slug'] ) && is_string( $e['slug'] ) ) {
						$out[ $kind ][ $e['slug'] ] = true;
					}
				}
			}
		}
		if ( isset( $settings['custom']['lineHeight'] ) && is_array( $settings['custom']['lineHeight'] ) ) {
			$out['has']['lineHeight'] = true;
			foreach ( array_keys( $settings['custom']['lineHeight'] ) as $k ) {
				$out['lineHeight'][ (string) $k ] = true;
			}
		}
		return $out;
	}
}

if ( ! function_exists( 'origin_canvas_palette_alias_decls' ) ) {
	/**
	 * The alias declarations for one level, decided on that level's own slugs and keys, and the
	 * colour slugs they alias (for the root classes).
	 *
	 * @param array $present From origin_canvas_palette_present().
	 * @param array $kinds   Which kinds to emit.
	 * @return array{decls: string[], aliased: string[]}
	 */
	function origin_canvas_palette_alias_decls( $present, $kinds ) {
		$map     = origin_canvas_palette_map();
		$rules   = origin_canvas_palette_rules();
		$decls   = array();
		$aliased = array();
		if ( in_array( 'color', $kinds, true ) ) {
			// Forward: an old name the palette lacks reads its new name.
			foreach ( $map['color'] as $old => $new ) {
				if ( ! isset( $present['color'][ $old ] ) ) {
					$decls[]   = '--wp--preset--color--' . $old . ': var(--wp--preset--color--' . $new . ');';
					$aliased[] = $old;
				}
			}
			// Reverse: a new name the palette lacks reads the old name it still defines.
			$reverse = array();
			foreach ( $map['color'] as $old => $new ) {
				if ( ! isset( $reverse[ $new ] ) ) {
					$reverse[ $new ] = isset( $rules['merge'][ $new ] ) ? $rules['merge'][ $new ] : array();
				}
				if ( ! in_array( $old, $reverse[ $new ], true ) ) {
					$reverse[ $new ][] = $old;
				}
			}
			foreach ( $reverse as $new => $olds ) {
				if ( isset( $present['color'][ $new ] ) ) {
					continue;
				}
				foreach ( $olds as $old ) {
					if ( isset( $present['color'][ $old ] ) ) {
						$decls[]   = '--wp--preset--color--' . $new . ': var(--wp--preset--color--' . $old . ');';
						$aliased[] = $new;
						break;
					}
				}
			}
		}
		if ( in_array( 'spacing', $kinds, true ) ) {
			foreach ( $map['spacing'] as $old => $new ) {
				if ( ! isset( $present['spacing'][ $old ] ) ) {
					$decls[] = '--wp--preset--spacing--' . $old . ': var(--wp--preset--spacing--' . $new . ');';
				} elseif ( ! isset( $present['spacing'][ $new ] ) ) {
					$decls[] = '--wp--preset--spacing--' . $new . ': var(--wp--preset--spacing--' . $old . ');';
				}
			}
		}
		if ( in_array( 'lineHeight', $kinds, true ) ) {
			foreach ( $map['lineHeight'] as $old => $new ) {
				if ( ! isset( $present['lineHeight'][ $old ] ) ) {
					$decls[] = '--wp--custom--line-height--' . $old . ': var(--wp--custom--line-height--' . $new . ');';
				} elseif ( ! isset( $present['lineHeight'][ $new ] ) ) {
					$decls[] = '--wp--custom--line-height--' . $new . ': var(--wp--custom--line-height--' . $old . ');';
				}
			}
		}
		return array(
			'decls'   => $decls,
			'aliased' => $aliased,
		);
	}
}

if ( ! function_exists( 'origin_canvas_palette_alias_levels' ) ) {
	/**
	 * What the alias CSS depends on: the present slugs at the root and per block, with each
	 * block's selectors.
	 *
	 * @return array{root: array, blocks: array}
	 */
	function origin_canvas_palette_alias_levels() {
		$root   = origin_canvas_palette_present(
			array(
				'color'   => array( 'palette' => wp_get_global_settings( array( 'color', 'palette' ) ) ),
				'spacing' => array( 'spacingSizes' => wp_get_global_settings( array( 'spacing', 'spacingSizes' ) ) ),
				'custom'  => array( 'lineHeight' => wp_get_global_settings( array( 'custom', 'lineHeight' ) ) ),
			)
		);
		$blocks = array();
		$all    = wp_get_global_settings( array( 'blocks' ) );
		if ( is_array( $all ) ) {
			$registry = WP_Block_Type_Registry::get_instance();
			foreach ( $all as $name => $settings ) {
				$type = $registry->get_registered( $name );
				if ( ! $type || ! is_array( $settings ) ) {
					continue;
				}
				$present   = origin_canvas_palette_present( $settings );
				$selectors = array(
					'color'      => $present['has']['color'] ? (string) wp_get_block_css_selector( $type, 'color', true ) : '',
					'spacing'    => $present['has']['spacing'] ? (string) wp_get_block_css_selector( $type, 'spacing', true ) : '',
					'lineHeight' => $present['has']['lineHeight'] ? (string) wp_get_block_css_selector( $type ) : '',
				);
				if ( '' === $selectors['color'] && '' === $selectors['spacing'] && '' === $selectors['lineHeight'] ) {
					continue;
				}
				$blocks[ $name ] = array(
					'present'   => $present,
					'selectors' => $selectors,
				);
			}
		}
		return array(
			'root'   => $root,
			'blocks' => $blocks,
		);
	}
}

if ( ! function_exists( 'origin_canvas_palette_alias_css' ) ) {
	/**
	 * The alias CSS: one :root rule of alias variables, the root classes of every aliased colour
	 * (core's shape, never has-border-color), and per block the alias variables on the selector
	 * core prints that block's own variables on.
	 *
	 * The per-request memo is kept per site and stylesheet: a multisite request that prints styles
	 * for two sites through switch_to_blog() gives each site its own aliases.
	 *
	 * @return string
	 */
	function origin_canvas_palette_alias_css() {
		static $memo = array();
		$site = get_current_blog_id() . '|' . get_stylesheet();
		if ( isset( $memo[ $site ] ) ) {
			return $memo[ $site ];
		}
		$levels = origin_canvas_palette_alias_levels();

		$root = origin_canvas_palette_alias_decls( $levels['root'], array( 'color', 'spacing', 'lineHeight' ) );
		$css  = "/* origin-canvas palette aliases */\n";
		if ( $root['decls'] ) {
			$css .= ':root{' . implode( '', $root['decls'] ) . "}\n";
		}
		foreach ( $root['aliased'] as $slug ) {
			$var = 'var(--wp--preset--color--' . $slug . ')';
			if ( 'has-' . $slug . '-color' !== 'has-border-color' ) {
				$css .= '.has-' . $slug . '-color{color: ' . $var . " !important;}\n";
			}
			$css .= '.has-' . $slug . '-background-color{background-color: ' . $var . " !important;}\n";
			$css .= '.has-' . $slug . '-border-color{border-color: ' . $var . " !important;}\n";
		}
		// Block level: core prints a block's own preset variables on its feature selector and its
		// custom variables on its default selector; an alias declared at the root would read the
		// root value there.
		foreach ( $levels['blocks'] as $block ) {
			$by_selector = array();
			foreach ( array( 'color', 'spacing', 'lineHeight' ) as $kind ) {
				$selector = $block['selectors'][ $kind ];
				if ( '' === $selector ) {
					continue;
				}
				$decls = origin_canvas_palette_alias_decls( $block['present'], array( $kind ) )['decls'];
				if ( $decls ) {
					$by_selector[ $selector ] = array_merge( isset( $by_selector[ $selector ] ) ? $by_selector[ $selector ] : array(), $decls );
				}
			}
			foreach ( $by_selector as $selector => $decls ) {
				$css .= $selector . '{' . implode( '', $decls ) . "}\n";
			}
		}
		$memo[ $site ] = $css;
		return $css;
	}
}

if ( ! function_exists( 'origin_canvas_palette_aliases_on' ) ) {
	/**
	 * Whether this site loads the aliases: the pre-rename mark, unless a plugin decides otherwise.
	 *
	 * @return bool
	 */
	function origin_canvas_palette_aliases_on() {
		$mark = (bool) get_option( 'origin_canvas_palette_legacy', false );

		/**
		 * Filters whether this site loads the palette aliases.
		 *
		 * @param bool $mark The pre-rename mark.
		 */
		return (bool) apply_filters( 'origin_canvas_palette_aliases_on', $mark );
	}
}

if ( ! function_exists( 'origin_canvas_palette_enqueue_aliases' ) ) {
	/**
	 * Load the aliases in their own handle: the built file, then the declarations right after it,
	 * on the front end before core's global-styles (so a colour the site's own palette defines at
	 * any level, and a user's Additional CSS, printed inside global-styles, win by core's own
	 * order), and in both editor canvases through enqueue_block_assets.
	 *
	 * @return void
	 */
	function origin_canvas_palette_enqueue_aliases() {
		if ( 'enqueue_block_assets' === current_filter() && ! is_admin() ) {
			return;
		}
		origin_canvas_palette_mark_legacy();
		if ( ! origin_canvas_palette_aliases_on() ) {
			return;
		}
		if ( ! wp_style_is( 'origin-canvas-palette-aliases', 'registered' ) ) {
			$path  = get_parent_theme_file_path( 'assets/css/palette-aliases.css' );
			$mtime = file_exists( $path ) ? filemtime( $path ) : false;
			wp_register_style( 'origin-canvas-palette-aliases', get_parent_theme_file_uri( 'assets/css/palette-aliases.css' ), array(), $mtime ? $mtime : ORIGIN_CANVAS_VERSION );
			wp_add_inline_style( 'origin-canvas-palette-aliases', origin_canvas_palette_alias_css() );
		}
		wp_enqueue_style( 'origin-canvas-palette-aliases' );
	}
}
add_action( 'wp_enqueue_scripts', 'origin_canvas_palette_enqueue_aliases', 9 );
add_action( 'enqueue_block_assets', 'origin_canvas_palette_enqueue_aliases' );

if ( ! function_exists( 'origin_canvas_palette_aliases_first' ) ) {
	/**
	 * Front end: the aliases print before global-styles on every page. A block theme renders its
	 * template before wp_head, and a block that enqueues global-styles while it renders (a block
	 * style variation does) puts it in the queue ahead of the aliases; a dependency holds the order.
	 *
	 * @return void
	 */
	function origin_canvas_palette_aliases_first() {
		if ( is_admin() || ! wp_style_is( 'origin-canvas-palette-aliases', 'enqueued' ) ) {
			return;
		}
		$styles = wp_styles();
		if ( isset( $styles->registered['global-styles'] ) && ! in_array( 'origin-canvas-palette-aliases', $styles->registered['global-styles']->deps, true ) ) {
			$styles->registered['global-styles']->deps[] = 'origin-canvas-palette-aliases';
		}
	}
}
add_action( 'wp_print_styles', 'origin_canvas_palette_aliases_first', 9 );

if ( ! function_exists( 'origin_canvas_palette_enqueue_editor_names' ) ) {
	/**
	 * Both editors: edit components that look a colour slug up in the palette get the new slug
	 * for an old one the palette lacks (assets/js/editor-palette.js). Stored attributes stay.
	 *
	 * The post editor fires this hook before enqueue_block_assets, so the mark is set here too.
	 *
	 * @return void
	 */
	function origin_canvas_palette_enqueue_editor_names() {
		origin_canvas_palette_mark_legacy();
		if ( ! origin_canvas_palette_aliases_on() ) {
			return;
		}
		$path  = get_theme_file_path( 'assets/js/editor-palette.js' );
		$mtime = file_exists( $path ) ? filemtime( $path ) : false;
		wp_enqueue_script(
			'origin-canvas-editor-palette',
			get_theme_file_uri( 'assets/js/editor-palette.js' ),
			array( 'wp-hooks', 'wp-compose', 'wp-element', 'wp-block-editor' ),
			$mtime ? $mtime : ORIGIN_CANVAS_VERSION,
			false
		);
		wp_localize_script(
			'origin-canvas-editor-palette',
			'originCanvasEditorPalette',
			array(
				'map'   => origin_canvas_palette_map()['color'],
				'attrs' => array_keys( origin_canvas_palette_rules()['slug_attrs'] ),
			)
		);
	}
}
add_action( 'enqueue_block_editor_assets', 'origin_canvas_palette_enqueue_editor_names' );
