<?php
/**
 * Create or update the Private page /design-system/ on the demo site. Required by
 * bin/demo/seed.php, and safe to run on its own on a seeded site (it changes nothing else):
 *   wp eval-file bin/demo/design-system/seed.php
 *
 * The page holds one block; the page itself lives in bin/demo/design-system. Administrators
 * only: see bin/demo/oc-demo-switches.php.
 */

if ( ! defined( 'WP_CLI' ) ) {
	return;
}

$oc_demo_ds_admins = get_users(
	array(
		'role'   => 'administrator',
		'number' => 1,
		'fields' => 'ID',
	)
);
$oc_demo_ds_page   = array(
	'post_type'     => 'page',
	'post_status'   => 'private',
	'post_title'    => 'Design System',
	'post_name'     => 'design-system',
	'post_content'  => '<!-- wp:origin-canvas-demo/design-system /-->',
	'post_author'   => $oc_demo_ds_admins ? (int) $oc_demo_ds_admins[0] : 1,
	'page_template' => 'page-no-title',
);

$oc_demo_ds_existing = get_page_by_path( 'design-system', OBJECT, 'page' );
if ( $oc_demo_ds_existing ) {
	$oc_demo_ds_page['ID'] = $oc_demo_ds_existing->ID;
}

$oc_demo_ds_id = wp_insert_post( wp_slash( $oc_demo_ds_page ), true );
if ( is_wp_error( $oc_demo_ds_id ) ) {
	WP_CLI::error( $oc_demo_ds_id->get_error_message() );
}
if ( 'design-system' !== get_post_field( 'post_name', $oc_demo_ds_id ) ) {
	WP_CLI::error( 'The slug design-system is taken; page #' . $oc_demo_ds_id . ' got another one.' );
}

WP_CLI::success( 'Design system page #' . $oc_demo_ds_id . ' (private, administrators only): ' . home_url( '/design-system/' ) );
