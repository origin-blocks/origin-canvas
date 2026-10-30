<?php
/**
 * Build assets/css/palette-aliases.css: the theme's rules keyed on a renamed class, written again
 * for content that still holds the old class (#116). Each rule stays as the theme wrote it, with
 * the old class in the selector. No WordPress.
 *
 * Reads the colour map and the stylesheets the twin list names, in inc/palette-map.php. Each pair
 * comes from the map, so a change to the map changes the file. A destination two old slugs merge
 * into has two old classes; the twin list says which one the rule was written for, and with no
 * entry the first in the map's order holds. The front end and both editors read those same files,
 * and the navigation CSS loads on demand, so the one built file serves them all. The class rules
 * and the variable aliases depend on the site's own palette, so they stay run-time, in
 * inc/palette-aliases.php.
 *
 * Run from anywhere:  php bin/build-palette-aliases.php [output file]
 *
 * @package Origin_Canvas
 */

$origin_canvas_root = dirname( __DIR__ );

require $origin_canvas_root . '/inc/palette-map.php';
require __DIR__ . '/lib/palette/palette-css.php';

$origin_canvas_out   = isset( $argv[1] ) ? $argv[1] : $origin_canvas_root . '/assets/css/palette-aliases.css';
$origin_canvas_twins = origin_canvas_palette_rules()['twins'];

$origin_canvas_classes = array();
foreach ( origin_canvas_palette_old_classes() as $origin_canvas_old => $origin_canvas_new ) {
	$origin_canvas_named = isset( $origin_canvas_twins['classes'][ $origin_canvas_new ] ) ? $origin_canvas_twins['classes'][ $origin_canvas_new ] : '';
	if ( ! isset( $origin_canvas_classes[ $origin_canvas_new ] ) || $origin_canvas_named === $origin_canvas_old ) {
		$origin_canvas_classes[ $origin_canvas_new ] = $origin_canvas_old;
	}
}

$origin_canvas_css = "/* Origin Canvas palette aliases. Built by bin/build-palette-aliases.php; do not edit. */\n";

foreach ( array_keys( $origin_canvas_twins['files'] ) as $origin_canvas_file ) {
	$origin_canvas_text = file_get_contents( $origin_canvas_root . '/' . $origin_canvas_file );
	if ( false === $origin_canvas_text ) {
		fwrite( STDERR, "build-palette-aliases.php: cannot read {$origin_canvas_file}.\n" );
		exit( 1 );
	}
	$origin_canvas_css .= "\n/* {$origin_canvas_file} */\n" . trim( origin_canvas_palette_css_twins( $origin_canvas_text, $origin_canvas_classes ) ) . "\n";
}

if ( ! is_dir( dirname( $origin_canvas_out ) ) ) {
	mkdir( dirname( $origin_canvas_out ), 0755, true );
}
if ( false === file_put_contents( $origin_canvas_out, $origin_canvas_css ) ) {
	fwrite( STDERR, "build-palette-aliases.php: cannot write {$origin_canvas_out}.\n" );
	exit( 1 );
}
