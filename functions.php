<?php
/**
 * Origin theme bootstrap file. Keeps the PHP layer lean so block templates
 * remain the source of truth for layout decisions.
 *
 * @package Origin
 */

if ( ! defined( 'ORIGIN_VERSION' ) ) {
	$origin_theme = wp_get_theme();
	define( 'ORIGIN_VERSION', $origin_theme->get( 'Version' ) );
}

if ( ! function_exists( 'origin_setup' ) ) {
	/**
	 * Register core theme supports.
	 */
	function origin_setup() {
		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'editor-styles' );
		add_editor_style( 'style.css' );
	}
}
add_action( 'after_setup_theme', 'origin_setup' );

if ( ! function_exists( 'origin_enqueue_styles' ) ) {
	/**
	 * Enqueue the base stylesheet so classic scripts inherit typography defaults.
	 */
	function origin_enqueue_styles() {
		wp_enqueue_style( 'origin-style', get_stylesheet_uri(), array(), ORIGIN_VERSION );
	}
}
add_action( 'wp_enqueue_scripts', 'origin_enqueue_styles' );

if ( ! function_exists( 'origin_register_custom_patterns' ) ) {
	/**
	 * Ensure custom patterns are available when the editor cache lags behind.
	 */
	function origin_register_custom_patterns() {
		if ( ! function_exists( 'register_block_pattern' ) ) {
			return;
		}

		if ( ! class_exists( 'WP_Block_Patterns_Registry' ) ) {
			return;
		}

		$registry = WP_Block_Patterns_Registry::get_instance();
		$patterns = array(
			'origin/hidden-single-right-sidebar' => array(
				'title' => __( 'Hidden: Single Right Sidebar', 'origin' ),
				'inserter' => false,
				'categories' => array( 'hidden' ),
				'file' => 'patterns/hidden-single-right-sidebar.php',
			),
			'origin/process-numbered' => array(
				'title' => __( 'Process Numbered', 'origin' ),
				'inserter' => true,
				'categories' => array( 'origin/features' ),
				'file' => 'patterns/process-numbered.php',
			),
			'origin/cta-band' => array(
				'title' => __( 'CTA Band', 'origin' ),
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
add_action( 'init', 'origin_register_custom_patterns' );

if ( ! function_exists( 'origin_register_pattern_categories' ) ) {
	/**
	 * Register Origin-namespaced block pattern categories.
	 */
	function origin_register_pattern_categories() {
		$categories = array(
			'origin/hero'     => array( 'label' => __( 'Hero', 'origin' ) ),
			'origin/page'     => array( 'label' => __( 'Pages', 'origin' ) ),
			'origin/features' => array( 'label' => __( 'Features', 'origin' ) ),
			'origin/stats'    => array( 'label' => __( 'Stats', 'origin' ) ),
			'origin/text'     => array( 'label' => __( 'Text', 'origin' ) ),
			'origin/team'     => array( 'label' => __( 'Team', 'origin' ) ),
			'origin/pricing'  => array( 'label' => __( 'Pricing', 'origin' ) ),
		);

		foreach ( $categories as $slug => $props ) {
			register_block_pattern_category( $slug, $props );
		}
	}
}
add_action( 'init', 'origin_register_pattern_categories', 9 );

if ( ! function_exists( 'origin_featured_image_fallback' ) ) {
	/**
	 * Render a placeholder when a featured image is missing in curated loops.
	 *
	 * @param string $block_content Rendered block HTML.
	 * @param array  $block         Block data.
	 * @return string
	 */
	function origin_featured_image_fallback( $block_content, $block ) {
		$attrs = $block['attrs'] ?? array();
		$class_name = $attrs['className'] ?? '';

		if ( strpos( $class_name, 'origin-featured-fallback' ) === false ) {
			return $block_content;
		}

		$post = get_post();
		if ( $post && has_post_thumbnail( $post ) ) {
			return $block_content;
		}

		$classes = preg_split( '/\s+/', $class_name, -1, PREG_SPLIT_NO_EMPTY );
		$classes[] = 'origin-featured-fallback';
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
				'<a class="origin-featured-fallback__link" href="%s" aria-label="%s">',
				esc_url( get_permalink( $post ) ),
				esc_attr( get_the_title( $post ) )
			);
			$link_close = '</a>';
		}

		return sprintf(
			'<figure %1$s>%2$s<span class="origin-featured-fallback__media" aria-hidden="true"></span>%3$s</figure>',
			$wrapper_attributes,
			$link_open,
			$link_close
		);
	}
}
add_filter( 'render_block_core/post-featured-image', 'origin_featured_image_fallback', 10, 2 );

if ( ! function_exists( 'origin_adjust_post_author_avatar' ) ) {
	/**
	 * Adjust the Post Author avatar size with high-DPI support.
	 *
	 * @param string $block_content Rendered block HTML.
	 * @param array  $block Block metadata and attributes.
	 * @return string
	 */
	function origin_adjust_post_author_avatar( $block_content, $block ) {
		if ( is_author() ) {
			return $block_content;
		}

		if ( strpos( $block_content, 'wp-block-post-author__avatar' ) === false ) {
			return $block_content;
		}

		$display_size = 120;
		if ( is_array( $block ) && isset( $block['attrs']['avatarSize'] ) && is_numeric( $block['attrs']['avatarSize'] ) ) {
			$display_size = (int) $block['attrs']['avatarSize'];
		}
		$author_id = 0;

		if ( is_array( $block ) && isset( $block['context']['postId'] ) ) {
			$author_id = (int) get_post_field( 'post_author', $block['context']['postId'] );
		}

		if ( ! $author_id ) {
			$author_id = (int) get_the_author_meta( 'ID' );
		}

		if ( ! $author_id ) {
			$author_id = (int) get_query_var( 'author' );
		}

		if ( ! $author_id ) {
			return $block_content;
		}

		$fetch_size = $display_size * 2;

		$avatar_html = get_avatar( $author_id, $fetch_size );
		if ( ! $avatar_html ) {
			return $block_content;
		}

		$avatar_html = preg_replace(
			'/\b(width|height)=([\"\'])\d+\2/',
			'$1=${2}' . $display_size . '${2}',
			$avatar_html
		);
		$avatar_html = preg_replace(
			'/\bavatar-\d+\b/',
			'avatar-' . $display_size,
			$avatar_html
		);

		if ( strpos( $avatar_html, 'wp-content' ) !== false ) {
			preg_match( '/src="([^"]+)"/', $avatar_html, $src_matches );
			if ( ! empty( $src_matches[1] ) ) {
				$current_url = $src_matches[1];
				$url_1x = preg_replace( '/-\d+x\d+(\.[^.]+)$/', '-' . $display_size . 'x' . $display_size . '$1', $current_url );
				$url_2x = $current_url;

				$upload_dir = wp_get_upload_dir();
				$path_1x = str_replace( $upload_dir['baseurl'], $upload_dir['basedir'], $url_1x );
				$path_2x = str_replace( $upload_dir['baseurl'], $upload_dir['basedir'], $url_2x );

				if ( file_exists( $path_1x ) && file_exists( $path_2x ) ) {
					$avatar_html = preg_replace(
						'/(<img[^>]+src="[^"]+")([^>]*>)/',
						'$1 srcset="' . esc_url( $url_1x ) . ' 1x, ' . esc_url( $url_2x ) . ' 2x"$2',
						$avatar_html
					);
				} elseif ( file_exists( $path_1x ) ) {
					$original_url = preg_replace( '/-\d+x\d+(\.[^.]+)$/', '$1', $url_1x );
					$original_path = str_replace( $upload_dir['baseurl'], $upload_dir['basedir'], $original_url );

					if ( file_exists( $original_path ) ) {
						$avatar_html = preg_replace(
							'/(<img[^>]+src="[^"]+")([^>]*>)/',
							'$1 srcset="' . esc_url( $url_1x ) . ' 1x, ' . esc_url( $original_url ) . ' 2x"$2',
							$avatar_html
						);
					}
				}
			}
		}

		return preg_replace(
			'/(<div class="wp-block-post-author__avatar">).*?(<\/div>)/s',
			'$1' . $avatar_html . '$2',
			$block_content
		);
	}
}
add_filter( 'render_block_core/post-author', 'origin_adjust_post_author_avatar', 10, 2 );

if ( ! function_exists( 'origin_register_block_styles' ) ) {
	/**
	 * Register block style variations.
	 *
	 * @return void
	 */
	function origin_register_block_styles() {
		$block_styles = array(
			'core/button'        => array(
				array( 'name' => 'outline-strong', 'label' => __( 'Outline Strong', 'origin' ) ),
			),
			'core/post-author'   => array(
				array( 'name' => 'origin-author', 'label' => __( 'Origin Author', 'origin' ) ),
			),
			'core/list'          => array(
				array( 'name' => 'list-check', 'label' => __( 'Check', 'origin' ) ),
				array( 'name' => 'list-check-circle', 'label' => __( 'Check Circle', 'origin' ) ),
			),
			'core/navigation'    => array(
				array( 'name' => 'origin-hover-accent', 'label' => __( 'Hover Accent', 'origin' ) ),
				array( 'name' => 'origin-hover-pill', 'label' => __( 'Hover Pill', 'origin' ) ),
			),
			'core/separator'     => array(
				array( 'name' => 'separator-dotted', 'label' => __( 'Dotted', 'origin' ) ),
				array( 'name' => 'separator-thin', 'label' => __( 'Thin', 'origin' ) ),
			),
			'core/image'         => array(
				array( 'name' => 'rounded-full', 'label' => __( 'Rounded Full', 'origin' ) ),
				array( 'name' => 'media-boxed', 'label' => __( 'Boxed', 'origin' ) ),
			),
			'core/post-terms'    => array(
				array( 'name' => 'term-button', 'label' => __( 'Pill', 'origin' ) ),
			),
			'core/post-excerpt'  => array(
				array( 'name' => 'excerpt-truncate-2', 'label' => __( 'Truncate 2 Lines', 'origin' ) ),
				array( 'name' => 'excerpt-truncate-3', 'label' => __( 'Truncate 3 Lines', 'origin' ) ),
			),
			'core/code'          => array(
				array( 'name' => 'dark-code', 'label' => __( 'Dark', 'origin' ) ),
			),
			'core/preformatted'  => array(
				array( 'name' => 'preformatted-dark', 'label' => __( 'Dark', 'origin' ) ),
			),
			'core/cover'         => array(
				array( 'name' => 'blur-image-less', 'label' => __( 'Blur Image Less', 'origin' ) ),
				array( 'name' => 'blur-image-more', 'label' => __( 'Blur Image More', 'origin' ) ),
			),
			'core/video'         => array(
				array( 'name' => 'media-boxed', 'label' => __( 'Boxed', 'origin' ) ),
			),
		);

		foreach ( $block_styles as $block_name => $styles ) {
			foreach ( $styles as $style ) {
				register_block_style( $block_name, $style );
			}
		}
	}
}
add_action( 'init', 'origin_register_block_styles' );

if ( ! function_exists( 'origin_enqueue_block_styles' ) ) {
	/**
	 * Enqueue per-block CSS only when the block is used on the page.
	 *
	 * Scans assets/styles/ for CSS files named {namespace}-{block}.css
	 * (e.g. core-list.css) and registers them via wp_enqueue_block_style().
	 */
	function origin_enqueue_block_styles() {
		$files = glob( get_template_directory() . '/assets/styles/*.css' );

		if ( empty( $files ) ) {
			return;
		}

		foreach ( $files as $file ) {
			$filename   = basename( $file, '.css' );
			$block_name = str_replace( 'core-', 'core/', $filename );

			wp_enqueue_block_style(
				$block_name,
				array(
					'handle' => "origin-block-{$filename}",
					'src'    => get_theme_file_uri( "assets/styles/{$filename}.css" ),
					'path'   => get_theme_file_path( "assets/styles/{$filename}.css" ),
				)
			);
		}
	}
}
add_action( 'init', 'origin_enqueue_block_styles' );

require get_template_directory() . '/inc/blocks.php';
require get_template_directory() . '/inc/icons.php';
