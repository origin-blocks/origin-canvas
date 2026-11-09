<?php
/**
 * WP-CLI hooks for the checks that load WordPress (check-block-validity.sh and
 * normalize-patterns.sh). They pass this file with --require, so it runs before WordPress loads.
 *
 * OC_CHECK_THEME, when set, names the theme folder to load in place of the active theme: a
 * worktree, so the check reads that branch's files.
 *
 * Core keeps a theme's list of pattern files in a transient for 30 minutes per theme version, and
 * skips it only in 'theme' development mode, so a pattern file added or changed since then is
 * missing or stale in the registry. The cache is deleted before core registers patterns, on
 * init at 10 (wp-includes/block-patterns.php), and $GLOBALS['oc_check_fresh_patterns'] says so
 * to block-validity-draft.php.
 *
 * @package Origin
 */

$oc_check_theme = getenv( 'OC_CHECK_THEME' );
if ( $oc_check_theme ) {
	WP_CLI::add_wp_hook( 'pre_option_stylesheet', static fn() => $oc_check_theme );
	WP_CLI::add_wp_hook( 'pre_option_template', static fn() => $oc_check_theme );
}

/**
 * Every pattern file of the loaded theme, found as core finds them (WP_Theme::scandir: any
 * depth, no dot files, no excluded folders), with its Slug and Title headers.
 *
 * @return array<string, array{slug: string, title: string}> Headers by file path.
 */
function oc_check_pattern_files() {
	$exclusions = (array) apply_filters( 'theme_scandir_exclusions', array( 'CVS', 'node_modules', 'vendor', 'bower_components' ) );
	$files      = array();
	$dirs       = array( wp_get_theme()->get_stylesheet_directory() . '/patterns' );
	while ( $dirs ) {
		$dir = array_shift( $dirs );
		foreach ( is_dir( $dir ) ? (array) scandir( $dir ) : array() as $name ) {
			if ( '.' === $name[0] || in_array( $name, $exclusions, true ) ) {
				continue;
			}
			if ( is_dir( "$dir/$name" ) ) {
				$dirs[] = "$dir/$name";
			} elseif ( str_ends_with( $name, '.php' ) ) {
				$files[ "$dir/$name" ] = get_file_data(
					"$dir/$name",
					array(
						'slug'  => 'Slug',
						'title' => 'Title',
					)
				);
			}
		}
	}
	ksort( $files );
	return $files;
}

WP_CLI::add_wp_hook(
	'init',
	static function () {
		wp_get_theme()->delete_pattern_cache();
		$GLOBALS['oc_check_fresh_patterns'] = true;
	},
	1
);
