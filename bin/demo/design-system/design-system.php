<?php
/**
 * Design system page for the local demo site. Loaded by bin/demo/oc-demo-switches.php from the
 * active theme; never shipped in the theme zip (bin/ is distignored).
 *
 * The Private page /design-system/ holds one block, origin-canvas-demo/design-system, which
 * renders page.php inside the theme's own template, so the real header, footer and global
 * styles apply. Administrators only: the mu-plugin 404s everyone else, and the render checks
 * again before printing anything.
 *
 * @package Origin
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * The side menu. Each group lists its built sections (id => label); a group with none shows
 * as "Next". A section's markup is sections/<id>.php; an item without its file is left out.
 */
function oc_demo_ds_groups() {
	$groups = array(
		'Brand'   => array(),
		'Color'   => array( 'text-color' => 'Text color' ),
		'Type'    => array(),
		'Spacing' => array(),
		'Radius'  => array(),
		'Shadows' => array(),
		'Buttons' => array(),
		'Focus'   => array(),
		'Badges'  => array(),
		'Cards'   => array(),
		'Icons'   => array(),
	);
	foreach ( $groups as $group => $items ) {
		$groups[ $group ] = array_filter(
			$items,
			static fn( $id ) => is_readable( __DIR__ . '/sections/' . $id . '.php' ),
			ARRAY_FILTER_USE_KEY
		);
	}
	return $groups;
}

/**
 * Where a value comes from, as "file:line" in the active theme. The line is found as the page
 * renders, so it follows the file. A needle that is no longer there shows as "file:?".
 *
 * @param string $file   Path relative to the theme root.
 * @param string $needle Text on the line to cite. With $after, the first match after it.
 * @param string $after  Optional text that comes before the line, such as a block name.
 */
function oc_demo_ds_src( $file, $needle, $after = '' ) {
	$path  = get_stylesheet_directory() . '/' . $file;
	$lines = is_readable( $path ) ? file( $path ) : array();
	$seen  = '' === $after;
	foreach ( $lines as $i => $line ) {
		if ( ! $seen && false !== strpos( $line, $after ) ) {
			$seen = true;
		}
		if ( $seen && false !== strpos( $line, $needle ) ) {
			return basename( $file ) . ':' . ( $i + 1 );
		}
	}
	return basename( $file ) . ':?';
}

/**
 * The first block in a registered theme pattern that passes $test, rendered as the theme
 * renders it. Specimens are real shipped blocks, so a pattern change shows here.
 *
 * @param string   $slug Pattern slug without the origin-canvas/ prefix.
 * @param callable $test Receives a parsed block; returns true for the one to render.
 * @return string Block HTML, or an empty string when nothing matches.
 */
function oc_demo_ds_block( $slug, $test ) {
	$pattern = WP_Block_Patterns_Registry::get_instance()->get_registered( 'origin-canvas/' . $slug );
	if ( ! $pattern ) {
		return '';
	}
	$stack = parse_blocks( $pattern['content'] );
	while ( $stack ) {
		$block = array_shift( $stack );
		if ( ! empty( $block['blockName'] ) && $test( $block ) ) {
			return render_block( $block );
		}
		$stack = array_merge( $block['innerBlocks'] ?? array(), $stack );
	}
	return '';
}

/**
 * Block test: a class in className, and optionally a textColor slug.
 *
 * @param string $class      Class name.
 * @param string $text_color Optional textColor slug.
 */
function oc_demo_ds_has( $class, $text_color = '' ) {
	return static function ( $block ) use ( $class, $text_color ) {
		$attrs = $block['attrs'];
		if ( '' !== $class && ! in_array( $class, explode( ' ', $attrs['className'] ?? '' ), true ) ) {
			return false;
		}
		return '' === $text_color || ( $attrs['textColor'] ?? '' ) === $text_color;
	};
}

add_action(
	'init',
	static function () {
		register_block_type(
			'origin-canvas-demo/design-system',
			array(
				'render_callback' => static function () {
					if ( ! current_user_can( 'manage_options' ) ) {
						return '';
					}
					ob_start();
					require __DIR__ . '/page.php';
					return ob_get_clean();
				},
			)
		);
	}
);

add_action(
	'wp_enqueue_scripts',
	static function () {
		if ( ! is_page( 'design-system' ) || ! current_user_can( 'manage_options' ) ) {
			return;
		}
		$base = get_stylesheet_directory_uri() . '/bin/demo/design-system/';
		$ver  = (string) filemtime( __DIR__ . '/design-system.css' );
		wp_enqueue_style( 'oc-demo-design-system', $base . 'design-system.css', array(), $ver );
		wp_enqueue_script(
			'oc-demo-design-system',
			$base . 'design-system.js',
			array(),
			(string) filemtime( __DIR__ . '/design-system.js' ),
			array(
				'strategy'  => 'defer',
				'in_footer' => true,
			)
		);
	}
);
