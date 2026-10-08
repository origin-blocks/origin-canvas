<?php
/**
 * Plugin Name: Origin Canvas demo switches
 * Description: Local demo only. Two front-end switches that save nothing:
 *   ?octheme=<worktree-folder>  shows a branch from themes/origin-canvas-worktrees.
 *   ?ocvariation=<slug>         shows a style variation, such as editorial or blue.
 * The switches combine. Copied into mu-plugins by bin/demo/reset.sh.
 */

if ( is_admin() || wp_doing_ajax() || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) ) {
	return;
}

if ( ! empty( $_GET['octheme'] ) ) {
	$oc_demo_theme = 'origin-canvas-worktrees/' . preg_replace( '/[^a-z0-9-]/', '', strtolower( (string) $_GET['octheme'] ) );
	if ( is_dir( WP_CONTENT_DIR . '/themes/' . $oc_demo_theme ) ) {
		add_filter( 'stylesheet', static fn() => $oc_demo_theme );
		add_filter( 'template', static fn() => $oc_demo_theme );

		// The theme's template scaffolds name their parts with "theme":"origin-canvas". A template
		// part renders only when that attribute equals the active stylesheet, so under a worktree
		// the header and footer came out empty. Point those references at the worktree.
		add_filter(
			'render_block_data',
			static function ( $block ) use ( $oc_demo_theme ) {
				if ( 'core/template-part' === $block['blockName'] && 'origin-canvas' === ( $block['attrs']['theme'] ?? '' ) ) {
					$block['attrs']['theme'] = $oc_demo_theme;
				}
				return $block;
			}
		);
	}
}

if ( ! empty( $_GET['ocvariation'] ) ) {
	$oc_demo_variation = preg_replace( '/[^a-z0-9-]/', '', strtolower( (string) $_GET['ocvariation'] ) );

	// Variations sit in styles/ or one level below it (styles/colors, styles/typography).
	add_filter(
		'wp_theme_json_data_theme',
		static function ( $theme_json ) use ( $oc_demo_variation ) {
			$dir   = get_stylesheet_directory() . '/styles';
			$files = array_merge( glob( "$dir/$oc_demo_variation.json" ) ?: array(), glob( "$dir/*/$oc_demo_variation.json" ) ?: array() );
			if ( ! $files ) {
				return $theme_json;
			}
			$data = wp_json_file_decode( $files[0], array( 'associative' => true ) );
			if ( is_array( $data ) ) {
				unset( $data['title'], $data['slug'] );
				$theme_json->update_with( $data );
			}
			return $theme_json;
		}
	);
}
