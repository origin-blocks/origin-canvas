#!/usr/bin/env bash
#
# assets/css/palette-aliases.css is built from the map and the theme's stylesheets, so it holds
# the twin of every rule that names a renamed class only while it matches them (#116). This
# rebuilds it into a temp file and fails on any difference, with the diff printed.
#
# The build reads only the files in the twin list (rules['twins']['files'], inc/palette-map.php),
# so this also reads every shipped stylesheet, the ones both editors load included, and fails with
# the file and line on:
#   a selector on an old class or a use of an old variable, in any of them, since nothing renames
#   a stylesheet and the aliases are for saved content;
#   a selector on a renamed class outside the twin list: the rule gets no twin, so saved content
#   on the old class misses it. Add the file to the twin list and rebuild.
# It reads every `css` string in theme.json and styles/**/*.json the same way. Core prints those in
# global-styles and the build reads none of them, so a renamed class there has no twin and fails too.
# Comments are skipped. The built file is the one stylesheet that names the old classes.
#
# Run from the theme root:  bash bin/check-palette-aliases.sh

set -euo pipefail
cd "$(dirname "$0")/.."

built=$(mktemp)
trap 'rm -f "$built"' EXIT

php bin/build-palette-aliases.php "$built"

if ! diff -u assets/css/palette-aliases.css "$built"; then
	echo 'Palette aliases (#116):'
	echo '  ✗  assets/css/palette-aliases.css does not match its sources; run php bin/build-palette-aliases.php'
	exit 1
fi

php -- <<'PHP'
<?php
require 'inc/palette-map.php';
require 'bin/lib/palette/palette-css.php';

$map     = origin_canvas_palette_map();
$end     = origin_canvas_palette_ident_end();
$classes = origin_canvas_palette_old_classes();
$twins   = origin_canvas_palette_rules()['twins']['files'];

$quote = static function ( $names ) {
	return implode( '|', array_map( 'preg_quote', $names ) );
};
$old   = '/\.(?:' . $quote( array_keys( $classes ) ) . ')' . $end
	. '|--wp--preset--color--(?:' . $quote( array_keys( $map['color'] ) ) . ')' . $end
	. '|--wp--preset--spacing--(?:' . $quote( array_keys( $map['spacing'] ) ) . ')' . $end
	. '|--wp--custom--line-height--(?:' . $quote( array_keys( $map['lineHeight'] ) ) . ')' . $end . '/';
$new   = '/\.(?:' . $quote( array_unique( array_values( $classes ) ) ) . ')' . $end . '/';

$files = glob( '*.css' );
foreach ( new RecursiveIteratorIterator( new RecursiveDirectoryIterator( 'assets', FilesystemIterator::SKIP_DOTS ) ) as $file ) {
	if ( 'css' === $file->getExtension() && 'assets/css/palette-aliases.css' !== $file->getPathname() ) {
		$files[] = $file->getPathname();
	}
}
sort( $files );

$hits = array();
// $fix says what to do about a renamed class here; null on the twin list, where the build covers it.
$scan = static function ( $where, $css, $fix ) use ( $old, $new, &$hits ) {
	// A comment becomes spaces and keeps its newlines, so each line number stays true.
	$css = preg_replace_callback(
		'~/\*.*?(?:\*/|$)~s',
		static function ( $m ) {
			return preg_replace( '/[^\n]/', ' ', $m[0] );
		},
		$css
	);
	foreach ( explode( "\n", $css ) as $i => $line ) {
		if ( preg_match_all( $old, $line, $m ) ) {
			foreach ( $m[0] as $name ) {
				$hits[] = sprintf( '%s:%d: %s is an old name; use the new one', $where, $i + 1, $name );
			}
		}
		if ( null !== $fix && preg_match_all( $new, $line, $m ) ) {
			foreach ( $m[0] as $name ) {
				$hits[] = sprintf( '%s:%d: %s gets no twin; %s', $where, $i + 1, $name, $fix );
			}
		}
	}
};
foreach ( $files as $file ) {
	$scan( $file, file_get_contents( $file ), isset( $twins[ $file ] ) ? null : 'add the file to the twin list in inc/palette-map.php' );
}

// Every css string in theme.json and the style variations, named by its path in the file.
$walk = static function ( $node, $where ) use ( &$walk, $scan ) {
	foreach ( $node as $key => $value ) {
		if ( is_array( $value ) ) {
			$walk( $value, $where . '.' . $key );
		} elseif ( 'css' === $key && is_string( $value ) ) {
			$scan( $where . '.css', $value, 'move the rule to a stylesheet on the twin list' );
		}
	}
};
$json = array( 'theme.json' );
foreach ( new RecursiveIteratorIterator( new RecursiveDirectoryIterator( 'styles', FilesystemIterator::SKIP_DOTS ) ) as $file ) {
	if ( 'json' === $file->getExtension() ) {
		$json[] = $file->getPathname();
	}
}
sort( $json );
foreach ( $json as $file ) {
	$data = json_decode( file_get_contents( $file ), true );
	if ( ! is_array( $data ) ) {
		$hits[] = sprintf( '%s: not valid JSON, so its css strings cannot be read', $file );
		continue;
	}
	$walk( $data, $file );
}

if ( $hits ) {
	echo "Palette aliases (#116):\n";
	foreach ( $hits as $hit ) {
		echo "  ✗  {$hit}\n";
	}
	exit( 1 );
}
PHP

echo 'Palette aliases (#116):'
echo '  ✓  assets/css/palette-aliases.css matches the map and the theme stylesheets'
echo '  ✓  no old class or variable in a stylesheet or a css string, and no renamed class outside the twin list'
