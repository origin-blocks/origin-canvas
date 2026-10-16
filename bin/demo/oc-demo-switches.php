<?php
/**
 * Plugin Name: Origin Canvas demo switches
 * Description: Local demo only. Two front-end switches that save nothing:
 *   ?octheme=<worktree-folder>  shows a branch from themes/origin-canvas-worktrees.
 *   ?ocvariation=<slug>         shows a style variation, such as editorial or blue.
 * The switches combine. Copied into mu-plugins by bin/demo/reset.sh.
 * It also loads the design system page (bin/demo/design-system) and the pattern library
 * (bin/demo/pattern-library) from the active theme, and keeps /design-system/ and
 * /pattern-library/ to administrators: everyone else gets a 404.
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

// The design system page is a staff reference. It is Private, which hides it from visitors;
// this also gives a 404 to logged-in users who can read private pages but are not administrators.
add_action(
	'template_redirect',
	static function () {
		if ( ! is_page( 'design-system' ) ) {
			return;
		}
		nocache_headers();
		if ( current_user_can( 'manage_options' ) ) {
			return;
		}
		global $wp_query;
		$wp_query->set_404();
		status_header( 404 );
	},
	0
);

// The pages ship with the demo tool, not the theme. Load them from the active theme, so a
// worktree preview (?octheme=) shows that branch's pages.
add_action(
	'after_setup_theme',
	static function () {
		foreach ( array( 'design-system/design-system.php', 'pattern-library/pattern-library.php' ) as $file ) {
			$file = get_stylesheet_directory() . '/bin/demo/' . $file;
			if ( is_readable( $file ) ) {
				require_once $file;
			}
		}
	}
);
