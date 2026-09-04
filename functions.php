<?php
/**
 * Origin theme bootstrap file. Keeps the PHP layer lean so block templates
 * remain the source of truth for layout decisions.
 *
 * @package Origin_Canvas
 */

if ( ! defined( 'ORIGIN_CANVAS_VERSION' ) ) {
	$origin_canvas_theme = wp_get_theme();
	define( 'ORIGIN_CANVAS_VERSION', $origin_canvas_theme->get( 'Version' ) );
}

if ( ! function_exists( 'origin_canvas_setup' ) ) {
	/**
	 * Register core theme supports.
	 */
	function origin_canvas_setup() {
		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'editor-styles' );
		add_editor_style( 'style.css' );
	}
}
add_action( 'after_setup_theme', 'origin_canvas_setup' );

if ( ! function_exists( 'origin_canvas_enqueue_styles' ) ) {
	/**
	 * Enqueue the base stylesheet so classic scripts inherit typography defaults.
	 */
	function origin_canvas_enqueue_styles() {
		wp_enqueue_style( 'origin-canvas-style', get_stylesheet_uri(), array(), ORIGIN_CANVAS_VERSION );
	}
}
add_action( 'wp_enqueue_scripts', 'origin_canvas_enqueue_styles' );

if ( ! function_exists( 'origin_canvas_enqueue_scripts' ) ) {
	/**
	 * Enqueue the anchor-navigation script: smooth same-page scrolling below the
	 * sticky chrome and the current-section navigation marker. Front end only.
	 *
	 * The `origin_canvas_enqueue_anchor_navigation` filter switches the script off.
	 * The `scroll-padding-top` rules in style.css stay in place either way, like the
	 * sticky-header rule they accompany.
	 */
	function origin_canvas_enqueue_scripts() {
		if ( ! apply_filters( 'origin_canvas_enqueue_anchor_navigation', true ) ) {
			return;
		}

		$path  = get_theme_file_path( 'assets/js/anchor-navigation.js' );
		$mtime = file_exists( $path ) ? filemtime( $path ) : false;

		wp_enqueue_script(
			'origin-canvas-anchor-navigation',
			get_theme_file_uri( 'assets/js/anchor-navigation.js' ),
			array(),
			$mtime ? $mtime : ORIGIN_CANVAS_VERSION,
			array( 'strategy' => 'defer' )
		);
	}
}
add_action( 'wp_enqueue_scripts', 'origin_canvas_enqueue_scripts' );

if ( ! function_exists( 'origin_canvas_register_custom_patterns' ) ) {
	/**
	 * Ensure custom patterns are available when the editor cache lags behind.
	 */
	function origin_canvas_register_custom_patterns() {
		if ( ! function_exists( 'register_block_pattern' ) ) {
			return;
		}

		if ( ! class_exists( 'WP_Block_Patterns_Registry' ) ) {
			return;
		}

		$registry = WP_Block_Patterns_Registry::get_instance();
		$patterns = array(
			'origin-canvas/hidden-single-right-sidebar' => array(
				'title' => __( 'Hidden: Single Right Sidebar', 'origin-canvas' ),
				'inserter' => false,
				'categories' => array( 'hidden' ),
				'file' => 'patterns/hidden-single-right-sidebar.php',
			),
			'origin-canvas/process-numbered' => array(
				'title' => __( 'Process Numbered', 'origin-canvas' ),
				'inserter' => true,
				'categories' => array( 'origin-canvas/features' ),
				'file' => 'patterns/process-numbered.php',
			),
			'origin-canvas/cta-band' => array(
				'title' => __( 'CTA Band', 'origin-canvas' ),
				'inserter' => true,
				'categories' => array( 'call-to-action' ),
				'file' => 'patterns/cta-band.php',
			),
		);

		foreach ( $patterns as $pattern_slug => $pattern ) {
			if ( $registry->is_registered( $pattern_slug ) ) {
				continue;
			}

			$pattern_file = get_theme_file_path( $pattern['file'] );
			if ( ! file_exists( $pattern_file ) ) {
				continue;
			}

			ob_start();
			include $pattern_file;
			$pattern_contents = ob_get_clean();

			if ( empty( $pattern_contents ) ) {
				continue;
			}

			register_block_pattern(
				$pattern_slug,
				array(
					'title' => $pattern['title'],
					'inserter' => $pattern['inserter'],
					'categories' => $pattern['categories'],
					'content' => trim( $pattern_contents ),
				)
			);
		}
	}
}
add_action( 'init', 'origin_canvas_register_custom_patterns' );

if ( ! function_exists( 'origin_canvas_register_pattern_categories' ) ) {
	/**
	 * Register Origin-namespaced block pattern categories.
	 */
	function origin_canvas_register_pattern_categories() {
		// Only categories WordPress does not already provide. Core supplies text,
		// testimonials, team, posts, contact and gallery — using ours alongside them
		// would show the editor two near-identical entries for the same thing.
		$categories = array(
			'origin-canvas/hero'     => array( 'label' => __( 'Hero', 'origin-canvas' ) ),
			'origin-canvas/page'     => array( 'label' => __( 'Pages', 'origin-canvas' ) ),
			'origin-canvas/features' => array( 'label' => __( 'Features', 'origin-canvas' ) ),
			'origin-canvas/stats'    => array( 'label' => __( 'Stats', 'origin-canvas' ) ),
			'origin-canvas/pricing'  => array( 'label' => __( 'Pricing', 'origin-canvas' ) ),
			'origin-canvas/card'     => array( 'label' => __( 'Cards', 'origin-canvas' ) ),
			'origin-canvas/faq'      => array( 'label' => __( 'FAQ', 'origin-canvas' ) ),
		);

		foreach ( $categories as $slug => $props ) {
			register_block_pattern_category( $slug, $props );
		}
	}
}
add_action( 'init', 'origin_canvas_register_pattern_categories', 9 );

if ( ! function_exists( 'origin_canvas_featured_image_fallback' ) ) {
	/**
	 * Render a placeholder when a featured image is missing in curated loops.
	 *
	 * @param string $block_content Rendered block HTML.
	 * @param array  $block         Block data.
	 * @return string
	 */
	function origin_canvas_featured_image_fallback( $block_content, $block ) {
		$attrs = $block['attrs'] ?? array();
		$class_name = $attrs['className'] ?? '';

		if ( strpos( $class_name, 'origin-canvas-featured-fallback' ) === false ) {
			return $block_content;
		}

		$post = get_post();
		if ( $post && has_post_thumbnail( $post ) ) {
			return $block_content;
		}

		$classes = preg_split( '/\s+/', $class_name, -1, PREG_SPLIT_NO_EMPTY );
		$classes[] = 'origin-canvas-featured-fallback';
		$class_string = implode( ' ', array_unique( $classes ) );

		$classes = array( 'wp-block-post-featured-image', $class_string );
		if ( ! empty( $attrs['align'] ) ) {
			$classes[] = 'align' . $attrs['align'];
		}

		$style_output = array();
		if ( ! empty( $attrs['style'] ) ) {
			$style_output = wp_style_engine_get_styles( $attrs['style'] );
		}

		if ( ! empty( $style_output['classnames'] ) ) {
			$classes[] = $style_output['classnames'];
		}

		$wrapper_styles = $style_output['css'] ?? '';
		if ( ! empty( $attrs['aspectRatio'] ) ) {
			$wrapper_styles .= 'aspect-ratio:' . $attrs['aspectRatio'] . ';';
		}
		if ( ! empty( $attrs['width'] ) ) {
			$wrapper_styles .= 'width:' . $attrs['width'] . ';';
		}
		if ( ! empty( $attrs['height'] ) ) {
			$height = trim( (string) $attrs['height'] );
			if ( is_numeric( $height ) ) {
				$height .= 'px';
			}
			$wrapper_styles .= 'height:' . $height . ';';
		}

		$wrapper_attributes = sprintf(
			'class="%s"%s',
			esc_attr( trim( implode( ' ', array_filter( $classes ) ) ) ),
			'' !== $wrapper_styles ? ' style="' . esc_attr( safecss_filter_attr( $wrapper_styles ) ) . '"' : ''
		);
		$link_open = '';
		$link_close = '';

		if ( ! empty( $attrs['isLink'] ) && $post ) {
			$link_open = sprintf(
				'<a class="origin-canvas-featured-fallback__link" href="%s" aria-label="%s">',
				esc_url( get_permalink( $post ) ),
				esc_attr( get_the_title( $post ) )
			);
			$link_close = '</a>';
		}

		return sprintf(
			'<figure %1$s>%2$s<span class="origin-canvas-featured-fallback__media" aria-hidden="true"></span>%3$s</figure>',
			$wrapper_attributes,
			$link_open,
			$link_close
		);
	}
}
add_filter( 'render_block_core/post-featured-image', 'origin_canvas_featured_image_fallback', 10, 2 );

if ( ! function_exists( 'origin_canvas_register_block_styles' ) ) {
	/**
	 * Register block style variations.
	 *
	 * @return void
	 */
	function origin_canvas_register_block_styles() {
		$block_styles = array(
			'core/accordion'     => array(
				array( 'name' => 'origin-canvas-accordion-minimal', 'label' => __( 'Minimal', 'origin-canvas' ) ),
			),
			'core/button'        => array(
				array( 'name' => 'origin-canvas-outline-strong', 'label' => __( 'Outline Strong', 'origin-canvas' ) ),
				array( 'name' => 'origin-canvas-outline-light', 'label' => __( 'Outline Light', 'origin-canvas' ) ),
				array( 'name' => 'origin-canvas-fill-primary', 'label' => __( 'Fill Primary', 'origin-canvas' ) ),
			),
			'core/list'          => array(
				array( 'name' => 'origin-canvas-list-check', 'label' => __( 'Check', 'origin-canvas' ) ),
				array( 'name' => 'origin-canvas-list-check-circle', 'label' => __( 'Check Circle', 'origin-canvas' ) ),
			),
			'core/navigation'    => array(
				array( 'name' => 'origin-canvas-hover-accent', 'label' => __( 'Hover Accent', 'origin-canvas' ) ),
				array( 'name' => 'origin-canvas-hover-pill', 'label' => __( 'Hover Pill', 'origin-canvas' ) ),
			),
			'core/separator'     => array(
				array( 'name' => 'origin-canvas-separator-dotted', 'label' => __( 'Dotted', 'origin-canvas' ) ),
				array( 'name' => 'origin-canvas-separator-thin', 'label' => __( 'Thin', 'origin-canvas' ) ),
			),
			'core/image'         => array(
				array( 'name' => 'origin-canvas-rounded-full', 'label' => __( 'Rounded Full', 'origin-canvas' ) ),
				array( 'name' => 'origin-canvas-media-boxed', 'label' => __( 'Boxed', 'origin-canvas' ) ),
			),
			'core/post-terms'    => array(
				array(
					'name'       => 'origin-canvas-term-chip',
					'label'      => __( 'Chip', 'origin-canvas' ),
					'style_data' => array(
						'elements' => array(
							'link' => array(
								'color'      => array(
									'text'       => 'var:preset|color|text-heading',
									'background' => 'var:preset|color|surface-muted',
								),
								'border'     => array(
									'radius' => 'var:custom|radius|medium',
								),
								'spacing'    => array(
									'padding' => array(
										'top'    => '6px',
										'right'  => '8px',
										'bottom' => '6px',
										'left'   => '8px',
									),
								),
								'typography' => array(
									'fontSize' => 'var:preset|font-size|extra-small',
								),
								':hover'     => array(
									'color' => array(
										'background' => 'var:preset|color|border',
									),
								),
							),
						),
					),
				),
				array(
					'name'       => 'origin-canvas-term-inline',
					'label'      => __( 'Inline', 'origin-canvas' ),
					'style_data' => array(
						'color'    => array(
							'text' => 'var:preset|color|text-body',
						),
						'elements' => array(
							'link' => array(
								'color'      => array(
									'text' => 'var:preset|color|text-heading',
								),
								'typography' => array(
									'textDecoration' => 'none',
								),
								':hover'     => array(
									'color' => array(
										'text' => 'var:preset|color|primary',
									),
								),
							),
						),
					),
				),
			),
			'core/post-navigation-link' => array(
				array( 'name' => 'origin-canvas-postnav-stacked', 'label' => __( 'Stacked', 'origin-canvas' ) ),
			),
			'core/tag-cloud'     => array(
				array( 'name' => 'origin-canvas-tag-chip', 'label' => __( 'Chip', 'origin-canvas' ) ),
			),
			'core/post-excerpt'  => array(
				array( 'name' => 'origin-canvas-excerpt-truncate-2', 'label' => __( 'Truncate 2 Lines', 'origin-canvas' ) ),
				array( 'name' => 'origin-canvas-excerpt-truncate-3', 'label' => __( 'Truncate 3 Lines', 'origin-canvas' ) ),
			),
			'core/code'          => array(
				array( 'name' => 'origin-canvas-dark-code', 'label' => __( 'Dark', 'origin-canvas' ) ),
			),
			'core/preformatted'  => array(
				array( 'name' => 'origin-canvas-preformatted-dark', 'label' => __( 'Dark', 'origin-canvas' ) ),
			),
			'core/cover'         => array(
				array( 'name' => 'origin-canvas-blur-image-less', 'label' => __( 'Blur Image Less', 'origin-canvas' ) ),
				array( 'name' => 'origin-canvas-blur-image-more', 'label' => __( 'Blur Image More', 'origin-canvas' ) ),
			),
			'core/video'         => array(
				array( 'name' => 'origin-canvas-media-boxed', 'label' => __( 'Boxed', 'origin-canvas' ) ),
			),
		);

		foreach ( $block_styles as $block_name => $styles ) {
			foreach ( $styles as $style ) {
				register_block_style( $block_name, $style );
			}
		}
	}
}
add_action( 'init', 'origin_canvas_register_block_styles' );

if ( ! function_exists( 'origin_canvas_enqueue_block_styles' ) ) {
	/**
	 * Enqueue per-block CSS only when the block is used on the page.
	 *
	 * Scans assets/styles/ for CSS files named {namespace}-{block}.css
	 * (e.g. core-list.css) and registers them via wp_enqueue_block_style().
	 */
	function origin_canvas_enqueue_block_styles() {
		$files = glob( get_template_directory() . '/assets/styles/*.css' );

		if ( empty( $files ) ) {
			return;
		}

		foreach ( $files as $file ) {
			$filename   = basename( $file, '.css' );
			$block_name = str_replace( 'core-', 'core/', $filename );

			// Version each stylesheet by its on-disk mtime so any change gets a fresh
			// URL; browsers otherwise cache the file under the fixed theme version and
			// serve stale CSS across edits. Fall back to the theme version if the file
			// cannot be stat-ed.
			$mtime = file_exists( $file ) ? filemtime( $file ) : false;
			$ver   = $mtime ? $mtime : ORIGIN_CANVAS_VERSION;

			wp_enqueue_block_style(
				$block_name,
				array(
					'handle' => "origin-canvas-block-{$filename}",
					'src'    => get_theme_file_uri( "assets/styles/{$filename}.css" ),
					'path'   => get_theme_file_path( "assets/styles/{$filename}.css" ),
					'ver'    => $ver,
				)
			);
		}
	}
}
add_action( 'init', 'origin_canvas_enqueue_block_styles' );

if ( ! function_exists( 'origin_canvas_add_block_editor_styles' ) ) {
	/**
	 * Inject every per-block stylesheet into the block editor canvas.
	 *
	 * The front-end loader (origin_canvas_enqueue_block_styles) registers per-block
	 * CSS on-demand via wp_enqueue_block_style(), which does not reach the iframed
	 * editor canvas. add_editor_style() is the block-theme-idiomatic way to get CSS
	 * into that iframe, so the editor previews every block style variation.
	 *
	 * Paths must be theme-relative (not absolute URIs); strip the template-dir
	 * prefix from each globbed file before handing it to add_editor_style().
	 */
	function origin_canvas_add_block_editor_styles() {
		$files = glob( get_template_directory() . '/assets/styles/*.css' );

		if ( empty( $files ) ) {
			return;
		}

		$prefix = trailingslashit( get_template_directory() );
		$paths  = array();

		foreach ( $files as $file ) {
			$paths[] = str_replace( $prefix, '', $file );
		}

		add_editor_style( $paths );
	}
}
add_action( 'after_setup_theme', 'origin_canvas_add_block_editor_styles' );

if ( ! function_exists( 'origin_canvas_rewrite_legacy_card_image_paths' ) ) {
	/**
	 * TRANSITIONAL back-compat shim — REMOVE IN 1.3.0.
	 *
	 * Card pattern images moved from /assets/images/cards/ to /patterns/images/
	 * (commit 1de024e). core/image and core/cover are static blocks, so sites that
	 * inserted these patterns under the previously-published 1.0.4 have the OLD
	 * absolute URL frozen in their post content and would show broken images after
	 * the move ships.
	 *
	 * Rewrites the legacy path to the new one at RENDER time only. It does NOT touch
	 * the database / user content (non-destructive, reversible) and does NOT
	 * resurrect the old directory. Scoped to the only two block types that carry
	 * these URLs (image + cover) — not a generic render_block filter — to stay well
	 * inside theme territory. Sunset: delete this function + the two add_filter calls
	 * below in 1.3.0, by which point affected content will have re-saved or moved on.
	 *
	 * @param string $block_content Rendered block HTML.
	 * @return string Block HTML with the legacy card-image path rewritten.
	 */
	function origin_canvas_rewrite_legacy_card_image_paths( $block_content ) {
		if ( false === strpos( $block_content, '/assets/images/cards/' ) ) {
			return $block_content;
		}

		return str_replace(
			'/assets/images/cards/',
			'/patterns/images/',
			$block_content
		);
	}
}
add_filter( 'render_block_core/image', 'origin_canvas_rewrite_legacy_card_image_paths' );
add_filter( 'render_block_core/cover', 'origin_canvas_rewrite_legacy_card_image_paths' );

if ( ! function_exists( 'origin_canvas_swap_nav_chevron' ) ) {
	/**
	 * Replace core's submenu caret SVG with the Lucide `chevron-down` glyph.
	 *
	 * Core renders its caret on a 12-unit viewBox (path "M1.50002 4L6.00002 8L10.5 4"),
	 * whose geometry CSS cannot reshape into Lucide's. We swap the whole SVG at render
	 * time for the Lucide chevron-down (path "m6 9 6 6 6-6"). The swap is UNGATED so
	 * the desktop dropdown AND the mobile overlay share one identical glyph.
	 *
	 * The Lucide arrow occupies only the middle band of its native 0 0 24 24 viewBox
	 * (x 6→18, y 9→15), so at the small display sizes here (11px desktop / 20px mobile)
	 * a full-viewBox glyph reads tiny and appears off-centre against the close ✕. We
	 * therefore emit the SAME path in a TIGHT viewBox cropped to the arrow ("5 8 14 8")
	 * so it fills the icon box at both sizes; per-surface box size stays in CSS.
	 *
	 * @param string $block_content Rendered navigation block HTML.
	 * @param array  $block         Parsed block (unused; kept for the filter signature).
	 * @return string Navigation HTML with the caret swapped for Lucide chevron-down.
	 */
	function origin_canvas_swap_nav_chevron( $block_content, $block = array() ) {
		if ( false === strpos( $block_content, 'M1.50002 4L6.00002 8L10.5 4' ) ) {
			return $block_content;
		}

		$lucide_chevron = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="5 8 14 8" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="m6 9 6 6 6-6"></path></svg>';

		return preg_replace(
			'#<svg[^>]*viewBox="0 0 12 12"[^>]*>\s*<path d="M1\.50002 4L6\.00002 8L10\.5 4"[^>]*>\s*</path>\s*</svg>#',
			$lucide_chevron,
			$block_content
		);
	}
}
add_filter( 'render_block_core/navigation', 'origin_canvas_swap_nav_chevron', 10, 2 );

if ( ! function_exists( 'origin_canvas_comment_author_badge' ) ) {
	/**
	 * Append an "Author" pill badge to the comment author name when the
	 * commenter is the post author — the same relationship core marks with
	 * the .bypostauthor class. Text is ink on a primary-tracking tint per
	 * the badges/pills design rule.
	 *
	 * Disable via: add_filter( 'origin_canvas_render_author_badge', '__return_false' );
	 *
	 * @param string   $block_content Rendered block HTML.
	 * @param array    $parsed_block  Parsed block array (unused).
	 * @param WP_Block $block         Block instance carrying commentId context.
	 * @return string Filtered block HTML.
	 */
	function origin_canvas_comment_author_badge( $block_content, $parsed_block, $block ) {
		if ( '' === $block_content || empty( $block->context['commentId'] ) ) {
			return $block_content;
		}

		if ( false !== strpos( $block_content, 'origin-canvas-author-badge' ) ) {
			return $block_content;
		}

		$comment = get_comment( $block->context['commentId'] );
		if ( ! $comment || ! $comment->user_id ) {
			return $block_content;
		}

		$post = get_post( $comment->comment_post_ID );
		if ( ! $post || (int) $comment->user_id !== (int) $post->post_author ) {
			return $block_content;
		}

		if ( ! apply_filters( 'origin_canvas_render_author_badge', true, $comment ) ) {
			return $block_content;
		}

		$badge = '<span class="origin-canvas-author-badge">' . esc_html__( 'Author', 'origin-canvas' ) . '</span>';

		$closing = strrpos( $block_content, '</div>' );
		if ( false === $closing ) {
			return $block_content;
		}

		return substr_replace( $block_content, $badge, $closing, 0 );
	}
}
add_filter( 'render_block_core/comment-author-name', 'origin_canvas_comment_author_badge', 10, 3 );
