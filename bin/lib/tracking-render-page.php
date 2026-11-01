<?php
/**
 * Make the page bin/check-tracking-render.sh measures. Run with WP-CLI:
 *
 *   wp eval-file bin/lib/tracking-render-page.php <slug-list-file>
 *
 * The page holds every listed pattern once, each by its wp:pattern reference inside a Group
 * whose class names the pattern (`octr octr--<slug>`), so the measure can say which pattern
 * a text element belongs to. The references render at request time, so the page shows the
 * theme the request asks for (?octheme= on the demo site), not the active one. Prints the
 * page ID and its URL, tab separated. The check moves the page to the Trash when it ends.
 *
 * @package Origin
 */

if ( ! defined( 'ABSPATH' ) || empty( $args[0] ) || ! is_readable( $args[0] ) ) {
	fwrite( STDERR, "tracking-render-page.php: give the slug list file.\n" );
	exit( 1 );
}

$oc_tr_content = '';
foreach ( file( $args[0], FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES ) as $oc_tr_slug ) {
	$oc_tr_slug = preg_replace( '/[^a-z0-9-]/', '', $oc_tr_slug );
	if ( '' === $oc_tr_slug ) {
		continue;
	}
	$oc_tr_class    = 'octr octr--' . $oc_tr_slug;
	$oc_tr_content .= '<!-- wp:group {"className":"' . $oc_tr_class . '","layout":{"type":"default"}} -->' . "\n"
		. '<div class="wp-block-group ' . $oc_tr_class . '"><!-- wp:pattern {"slug":"origin-canvas/' . $oc_tr_slug . '"} /--></div>' . "\n"
		. "<!-- /wp:group -->\n\n";
}

$oc_tr_id = wp_insert_post(
	array(
		'post_type'     => 'page',
		'post_status'   => 'publish',
		'post_title'    => 'Tracking render check (temporary)',
		'post_name'     => 'tracking-render-check-' . time(),
		'post_content'  => wp_slash( $oc_tr_content ),
		'page_template' => 'page-no-title',
	),
	true
);

if ( is_wp_error( $oc_tr_id ) ) {
	fwrite( STDERR, 'tracking-render-page.php: ' . $oc_tr_id->get_error_message() . "\n" );
	exit( 1 );
}

echo (int) $oc_tr_id . "\t" . esc_url_raw( get_permalink( $oc_tr_id ) ) . "\n";
