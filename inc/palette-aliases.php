<?php
/**
 * The palette rename (#116): generated alias CSS and the twin rules, and their delivery.
 *
 * Aliases keep old variables and classes rendering, in the front end and both editors, on any
 * site ever detected as upgraded: until Update colours moves the site's content, and for good for
 * what it cannot reach (child themes, Additional CSS, third-party markup). They fill only names the
 * effective palette lacks: forward (an old name reads its new one) or reverse (a new name reads
 * the old one a child theme still defines).
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
	 * @return string
	 */
	function origin_canvas_palette_alias_css() {
		static $css = null;
		if ( null !== $css ) {
			return $css;
		}
		$levels = origin_canvas_palette_alias_levels();
		$key    = md5( ORIGIN_CANVAS_VERSION . '|' . get_stylesheet() . '|' . wp_json_encode( $levels ) );
		$cached = get_transient( 'origin_canvas_palette_aliases' );
		if ( is_array( $cached ) && isset( $cached['key'], $cached['css'] ) && $cached['key'] === $key ) {
			$css = (string) $cached['css'];
			return $css;
		}

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
		set_transient(
			'origin_canvas_palette_aliases',
			array(
				'key' => $key,
				'css' => $css,
			)
		);
		return $css;
	}
}

if ( ! function_exists( 'origin_canvas_palette_twins_for' ) ) {
	/**
	 * Twin CSS of one stylesheet file, cached per file and direction.
	 *
	 * @param string $file      Absolute path.
	 * @param string $direction 'theme' (new => old classes) or 'child' (old => new, declaration twins).
	 * @return string
	 */
	function origin_canvas_palette_twins_for( $file, $direction ) {
		static $memo = array();
		$real = realpath( $file );
		if ( ! $real || ! is_readable( $real ) ) {
			return '';
		}
		// One transient per file and direction, so an edited file or a theme update replaces its
		// row instead of adding one; the file's state is kept inside the value.
		$key   = md5( $real . '|' . $direction );
		$stamp = filemtime( $real ) . '|' . filesize( $real ) . '|' . ORIGIN_CANVAS_VERSION;
		if ( isset( $memo[ $key ] ) ) {
			return $memo[ $key ];
		}
		$cached = get_transient( 'origin_canvas_palette_twins_' . $key );
		if ( is_array( $cached ) && isset( $cached['stamp'], $cached['css'] ) && $cached['stamp'] === $stamp && is_string( $cached['css'] ) ) {
			$memo[ $key ] = $cached['css'];
			return $cached['css'];
		}
		$text = (string) file_get_contents( $real ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents -- a local theme file.
		if ( 'theme' === $direction ) {
			$css = origin_canvas_palette_css_twins( $text, origin_canvas_palette_rules()['twins']['classes'] );
		} else {
			$css = origin_canvas_palette_css_twins( $text, origin_canvas_palette_old_classes(), true );
		}
		set_transient(
			'origin_canvas_palette_twins_' . $key,
			array(
				'stamp' => $stamp,
				'css'   => $css,
			)
		);
		$memo[ $key ] = $css;
		return $css;
	}
}

if ( ! function_exists( 'origin_canvas_palette_editor_twin_css' ) ) {
	/**
	 * Child twins as the editors take them: each selector item one class stronger, through a
	 * :not() of a class no element holds, so what it matches is unchanged. The editors print
	 * core's global styles after every theme style and canvas asset (editor.js
	 * useGlobalStylesRenderer: [ ...nonGlobalStyles, ...styles ]), so core's colour class (0-1-0,
	 * !important) and its :root variables would win over a twin that wins by order on the front
	 * end, where the child sheet prints after global-styles.
	 *
	 * @param string $css Child twin CSS.
	 * @return string
	 */
	function origin_canvas_palette_editor_twin_css( $css ) {
		return origin_canvas_palette_css_scan(
			(string) $css,
			static function ( $prelude, $body ) {
				$items = array();
				foreach ( origin_canvas_palette_css_split_items( $prelude ) as $item ) {
					// Before a pseudo-element, which must end the selector; before a trailing comment.
					$at      = origin_canvas_palette_css_append_at( $item );
					$items[] = substr( $item, 0, $at ) . ':not(.origin-canvas-editor-twin)' . substr( $item, $at );
				}
				return array(
					'prelude' => implode( ',', $items ),
					'body'    => $body,
				);
			},
			true
		);
	}
}

if ( ! function_exists( 'origin_canvas_palette_twin_css' ) ) {
	/**
	 * The theme's twins of one of its own files: its rules keyed on a new class, for content that
	 * still holds the old class.
	 *
	 * @param string $file Absolute path.
	 * @return string
	 */
	function origin_canvas_palette_twin_css( $file ) {
		return origin_canvas_palette_twins_for( $file, 'theme' );
	}
}

if ( ! function_exists( 'origin_canvas_palette_served_file' ) ) {
	/**
	 * The file a queued style handle serves: its src, else its path data, else its inlined_src
	 * data (core sets src false when it inlines a sheet, script-loader.php:3192-3195). '' unless it
	 * is a .css file of at most 1 MB inside the theme or child theme directory.
	 *
	 * @param string $handle Style handle.
	 * @return string Real path, or ''.
	 */
	function origin_canvas_palette_served_file( $handle ) {
		$styles = wp_styles();
		if ( ! isset( $styles->registered[ $handle ] ) ) {
			return '';
		}
		$src       = $styles->registered[ $handle ]->src;
		$candidate = '';
		if ( is_string( $src ) && '' !== $src ) {
			$url  = strtok( $src, '?' );
			$dirs = array(
				trailingslashit( get_stylesheet_directory_uri() ) => trailingslashit( get_stylesheet_directory() ),
				trailingslashit( get_template_directory_uri() )   => trailingslashit( get_template_directory() ),
			);
			foreach ( $dirs as $uri => $dir ) {
				if ( 0 === strpos( (string) $url, $uri ) ) {
					$candidate = $dir . substr( (string) $url, strlen( $uri ) );
					break;
				}
			}
		} else {
			$path = $styles->get_data( $handle, 'path' );
			if ( ! is_string( $path ) || '' === $path ) {
				$path = $styles->get_data( $handle, 'inlined_src' );
			}
			$candidate = is_string( $path ) ? $path : '';
		}
		if ( '' === $candidate ) {
			return '';
		}
		$real = realpath( $candidate );
		if ( ! $real || '.css' !== substr( $real, -4 ) || ! is_file( $real ) || filesize( $real ) > MB_IN_BYTES ) {
			return '';
		}
		foreach ( array( get_stylesheet_directory(), get_template_directory() ) as $dir ) {
			$root = realpath( $dir );
			if ( $root && 0 === strpos( $real, trailingslashit( $root ) ) ) {
				return $real;
			}
		}
		return '';
	}
}

if ( ! function_exists( 'origin_canvas_palette_attach_handle_twins' ) ) {
	/**
	 * Attach the twins of the file one handle serves, inline after it, once per handle in each
	 * WP_Styles instance: the theme's twins for its style.css and core-navigation.css, the child
	 * twins for a child file. Core prints the editor canvas assets from a WP_Styles of its own
	 * (_wp_get_iframed_editor_assets()), so a handle done there is done again in the page's own
	 * instance, where a non-iframed editor prints it. The instances are held, so an ID is never
	 * reused; twins a shared registration already holds are not added twice.
	 *
	 * @param string $handle     Style handle.
	 * @param bool   $child_only Only a child file's twins (the editors get the theme's own twins
	 *                           through their settings).
	 * @return void
	 */
	function origin_canvas_palette_attach_handle_twins( $handle, $child_only = false ) {
		static $done = null;
		if ( null === $done ) {
			$done = new SplObjectStorage();
		}
		$styles  = wp_styles();
		$handles = $done->contains( $styles ) ? $done[ $styles ] : array();
		if ( isset( $handles[ $handle ] ) ) {
			return;
		}
		$handles[ $handle ] = true;
		$done[ $styles ]    = $handles;
		$file               = origin_canvas_palette_served_file( $handle );
		if ( '' === $file ) {
			return;
		}
		$css = '';
		foreach ( $child_only ? array() : array_keys( origin_canvas_palette_rules()['twins']['files'] ) as $relative ) {
			$own = realpath( get_template_directory() . '/' . $relative );
			if ( $own && $own === $file ) {
				$css = origin_canvas_palette_twin_css( $file );
				break;
			}
		}
		if ( '' === $css && is_child_theme() ) {
			$child = realpath( get_stylesheet_directory() );
			if ( $child && 0 === strpos( $file, trailingslashit( $child ) ) ) {
				$css = origin_canvas_palette_twins_for( $file, 'child' );
				if ( $child_only && '' !== $css ) {
					$css = origin_canvas_palette_editor_twin_css( $css );
				}
			}
		}
		if ( '' !== $css && ! in_array( $css, (array) $styles->get_data( $handle, 'after' ), true ) ) {
			wp_add_inline_style( $handle, $css );
		}
	}
}

if ( ! function_exists( 'origin_canvas_palette_aliases_on' ) ) {
	/**
	 * Whether this site loads the aliases: from its first detection of an old code on, for good.
	 *
	 * @return bool
	 */
	function origin_canvas_palette_aliases_on() {
		return (bool) origin_canvas_palette_state()['palette_detected'];
	}
}

if ( ! function_exists( 'origin_canvas_palette_attach_twins' ) ) {
	/**
	 * The twins of every queued style handle, by the file it serves. Runs inside wp_print_styles(),
	 * after core has inlined small sheets: on the front end, and in the admin where core prints the
	 * editor canvas assets enqueued on enqueue_block_assets (block-editor.php:342-369). There a
	 * child theme's sheet gets its child twins; the theme's own twins reach the editors through
	 * their settings.
	 *
	 * @return void
	 */
	function origin_canvas_palette_attach_twins() {
		if ( ! origin_canvas_palette_aliases_on() ) {
			return;
		}
		foreach ( (array) wp_styles()->queue as $handle ) {
			origin_canvas_palette_attach_handle_twins( $handle, is_admin() );
		}
	}
}
add_action( 'wp_print_styles', 'origin_canvas_palette_attach_twins', 10 );

if ( ! function_exists( 'origin_canvas_palette_navigation_twins' ) ) {
	/**
	 * The navigation block's stylesheet is enqueued when the block renders; attach its twins then.
	 *
	 * @param string $content Block content.
	 * @param array  $block   Parsed block.
	 * @return string
	 */
	function origin_canvas_palette_navigation_twins( $content, $block ) {
		if ( ! is_admin() && isset( $block['blockName'] ) && 'core/navigation' === $block['blockName'] && origin_canvas_palette_aliases_on() ) {
			$handle = origin_canvas_palette_rules()['twins']['files']['assets/styles/core-navigation.css'];
			if ( wp_style_is( $handle, 'enqueued' ) ) {
				origin_canvas_palette_attach_handle_twins( $handle );
			}
		}
		return $content;
	}
}
add_filter( 'render_block', 'origin_canvas_palette_navigation_twins', 11, 2 );

if ( ! function_exists( 'origin_canvas_palette_enqueue_aliases' ) ) {
	/**
	 * Print the aliases in their own handle: on the front end before core's global-styles (so a
	 * user's Additional CSS, printed inside global-styles, still wins at equal specificity), and
	 * in both editor canvases through enqueue_block_assets.
	 *
	 * @return void
	 */
	function origin_canvas_palette_enqueue_aliases() {
		if ( ! origin_canvas_palette_aliases_on() ) {
			return;
		}
		if ( 'enqueue_block_assets' === current_filter() && ! is_admin() ) {
			return;
		}
		if ( ! wp_style_is( 'origin-canvas-palette-aliases', 'registered' ) ) {
			wp_register_style( 'origin-canvas-palette-aliases', false, array(), ORIGIN_CANVAS_VERSION );
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

if ( ! function_exists( 'origin_canvas_palette_editor_twins' ) ) {
	/**
	 * Both editors: the theme's twins, and the child twins of every child theme file the editors
	 * load as an editor style, as one theme style of the canvas, beside the child's own file. The
	 * child twins take the editor form (origin_canvas_palette_editor_twin_css()).
	 *
	 * @param array $settings Editor settings.
	 * @return array
	 */
	function origin_canvas_palette_editor_twins( $settings ) {
		global $editor_styles;
		if ( ! origin_canvas_palette_aliases_on() ) {
			return $settings;
		}
		$css = '';
		foreach ( array_keys( origin_canvas_palette_rules()['twins']['files'] ) as $relative ) {
			$css .= origin_canvas_palette_twin_css( get_template_directory() . '/' . $relative );
		}
		$child = is_child_theme() ? realpath( get_stylesheet_directory() ) : false;
		if ( $child && is_array( $editor_styles ) && current_theme_supports( 'editor-styles' ) ) {
			$seen = array();
			// Resolved as core does (get_block_editor_theme_styles()): the child's file when it has one.
			foreach ( $editor_styles as $style ) {
				if ( ! is_string( $style ) || preg_match( '~^(https?:)?//~', $style ) ) {
					continue;
				}
				$file = realpath( get_theme_file_path( $style ) );
				if ( $file && ! isset( $seen[ $file ] ) && 0 === strpos( $file, trailingslashit( $child ) ) ) {
					$seen[ $file ] = true;
					$css          .= origin_canvas_palette_editor_twin_css( origin_canvas_palette_twins_for( $file, 'child' ) );
				}
			}
		}
		if ( '' !== $css ) {
			$settings['styles']   = isset( $settings['styles'] ) && is_array( $settings['styles'] ) ? $settings['styles'] : array();
			$settings['styles'][] = array(
				'css'            => $css,
				'__unstableType' => 'theme',
				'isGlobalStyles' => false,
			);
		}
		return $settings;
	}
}
add_filter( 'block_editor_settings_all', 'origin_canvas_palette_editor_twins' );

if ( ! function_exists( 'origin_canvas_palette_enqueue_editor_names' ) ) {
	/**
	 * Both editors: edit components that look a colour slug up in the palette get the new slug
	 * for an old one the palette lacks (assets/js/editor-palette.js). Stored attributes stay.
	 *
	 * @return void
	 */
	function origin_canvas_palette_enqueue_editor_names() {
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
