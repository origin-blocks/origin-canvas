<?php
/**
 * Make the draft and the login that bin/check-block-validity.sh opens in the editor. Run with
 * WP-CLI:
 *
 *   wp eval-file bin/lib/block-validity-draft.php make <out.json>
 *   wp eval-file bin/lib/block-validity-draft.php end <out.json>
 *
 * make: one draft page, and the markup of every registered origin-canvas pattern, each inside
 * a Group whose class names it (`ocbv ocbv--<slug>`). The spec loads that markup into the
 * draft in the editor, as the inserter does; the saved draft holds one paragraph. Saved with
 * every pattern, the draft took past PHP's time limit to open: the REST API renders it, and each
 * template scaffold's Post Content block renders the whole draft again. A wp:pattern reference
 * is replaced by the markup it points to, as the editor does on insert, so the markup is the
 * theme WP-CLI loaded (a worktree, when the check passes a theme filter). It also opens one
 * login session for the first administrator and writes the draft ID, its editor URL, the
 * markup, the cookies and the session token to <out.json>.
 *
 * end: moves the draft to the Trash and closes that one session. Other sessions are left alone.
 *
 * @package Origin
 */

if ( ! defined( 'ABSPATH' ) || empty( $args[1] ) || ! in_array( $args[0], array( 'make', 'end' ), true ) ) {
	fwrite( STDERR, "block-validity-draft.php: give make|end and the JSON file.\n" );
	exit( 1 );
}

if ( 'end' === $args[0] ) {
	$oc_bv = is_readable( $args[1] ) ? json_decode( file_get_contents( $args[1] ), true ) : null;
	if ( ! $oc_bv ) {
		exit( 0 );
	}
	if ( ! empty( $oc_bv['user'] ) && ! empty( $oc_bv['token'] ) ) {
		WP_Session_Tokens::get_instance( (int) $oc_bv['user'] )->destroy( $oc_bv['token'] );
	}
	if ( ! empty( $oc_bv['id'] ) ) {
		// With the Trash turned off, wp_trash_post() deletes for good. Leave the draft instead.
		if ( ! EMPTY_TRASH_DAYS ) {
			fwrite( STDERR, 'The Trash is off (EMPTY_TRASH_DAYS); the draft ' . (int) $oc_bv['id'] . " stays. Remove it by hand.\n" );
			exit( 1 );
		}
		if ( ! wp_trash_post( (int) $oc_bv['id'] ) ) {
			fwrite( STDERR, 'Could not trash the draft ' . (int) $oc_bv['id'] . "; trash it by hand.\n" );
			exit( 1 );
		}
		echo '  Moved the draft ' . (int) $oc_bv['id'] . " to the Trash.\n";
	}
	exit( 0 );
}

// The draft must be able to go to the Trash: with the Trash off, wp_trash_post() deletes for good.
if ( ! EMPTY_TRASH_DAYS ) {
	fwrite( STDERR, "block-validity-draft.php: the Trash is off (EMPTY_TRASH_DAYS), so the draft could not be trashed. Nothing changed.\n" );
	exit( 1 );
}

$oc_bv_registry = WP_Block_Patterns_Registry::get_instance();

/**
 * Pattern markup with every wp:pattern reference replaced by the markup it points to.
 *
 * @param string $content Block markup.
 * @param int    $depth   Nesting so far; references stop at 5 levels.
 */
function oc_bv_expand( $content, $depth = 0 ) {
	if ( $depth > 5 ) {
		return $content;
	}
	return preg_replace_callback(
		'#<!-- wp:pattern (\{.*?\}) /-->#',
		static function ( $m ) use ( $depth ) {
			$attrs   = json_decode( $m[1], true );
			$pattern = WP_Block_Patterns_Registry::get_instance()->get_registered( $attrs['slug'] ?? '' );
			return $pattern ? oc_bv_expand( $pattern['content'], $depth + 1 ) : $m[0];
		},
		$content
	);
}

$oc_bv_slugs    = array();
$oc_bv_patterns = array();
foreach ( $oc_bv_registry->get_all_registered() as $oc_bv_pattern ) {
	if ( 0 !== strpos( $oc_bv_pattern['name'], 'origin-canvas/' ) ) {
		continue;
	}
	$oc_bv_slugs[] = substr( $oc_bv_pattern['name'], strlen( 'origin-canvas/' ) );
}
sort( $oc_bv_slugs );
foreach ( $oc_bv_slugs as $oc_bv_slug ) {
	$oc_bv_pattern  = $oc_bv_registry->get_registered( 'origin-canvas/' . $oc_bv_slug );
	$oc_bv_class    = 'ocbv ocbv--' . $oc_bv_slug;
	$oc_bv_patterns[] = '<!-- wp:group {"className":"' . $oc_bv_class . '","layout":{"type":"default"}} -->' . "\n"
		. '<div class="wp-block-group ' . $oc_bv_class . '">' . oc_bv_expand( $oc_bv_pattern['content'] ) . '</div>' . "\n"
		. "<!-- /wp:group -->\n\n";
}

if ( ! $oc_bv_patterns ) {
	fwrite( STDERR, "block-validity-draft.php: no origin-canvas pattern is registered. Nothing changed.\n" );
	exit( 1 );
}

$oc_bv_admins = get_users(
	array(
		'role'   => 'administrator',
		'number' => 1,
	)
);
if ( ! $oc_bv_admins ) {
	fwrite( STDERR, "block-validity-draft.php: the site has no administrator.\n" );
	exit( 1 );
}
$oc_bv_user = $oc_bv_admins[0];

$oc_bv_id = wp_insert_post(
	array(
		'post_type'    => 'page',
		'post_status'  => 'draft',
		'post_title'   => 'Block validity check (temporary)',
		'post_content' => "<!-- wp:paragraph -->\n<p>The check loads every pattern here in the editor.</p>\n<!-- /wp:paragraph -->",
		'post_author'  => $oc_bv_user->ID,
	),
	true
);
if ( is_wp_error( $oc_bv_id ) ) {
	fwrite( STDERR, 'block-validity-draft.php: ' . $oc_bv_id->get_error_message() . "\n" );
	exit( 1 );
}

// A session of its own, so the check never reuses or ends anyone else's login.
$oc_bv_expires = time() + HOUR_IN_SECONDS;
$oc_bv_token   = WP_Session_Tokens::get_instance( $oc_bv_user->ID )->create( $oc_bv_expires );
$oc_bv_out     = array(
	'id'       => $oc_bv_id,
	'url'      => admin_url( 'post.php?post=' . $oc_bv_id . '&action=edit' ),
	'slugs'    => $oc_bv_slugs,
	'patterns' => $oc_bv_patterns,
	'user'     => $oc_bv_user->ID,
	'token'    => $oc_bv_token,
	'cookies'  => array(
		array(
			'name'  => AUTH_COOKIE,
			'value' => wp_generate_auth_cookie( $oc_bv_user->ID, $oc_bv_expires, 'auth', $oc_bv_token ),
		),
		array(
			'name'  => LOGGED_IN_COOKIE,
			'value' => wp_generate_auth_cookie( $oc_bv_user->ID, $oc_bv_expires, 'logged_in', $oc_bv_token ),
		),
	),
);

// Without the state file the check cannot clean up, so undo both here if it is not written.
$oc_bv_json  = wp_json_encode( $oc_bv_out );
$oc_bv_fh    = fopen( $args[1], 'x' );
$oc_bv_wrote = $oc_bv_fh && strlen( $oc_bv_json ) === fwrite( $oc_bv_fh, $oc_bv_json );
if ( ! ( $oc_bv_fh && fclose( $oc_bv_fh ) && $oc_bv_wrote ) ) {
	WP_Session_Tokens::get_instance( $oc_bv_user->ID )->destroy( $oc_bv_token );
	wp_trash_post( $oc_bv_id );
	fwrite( STDERR, "block-validity-draft.php: could not write {$args[1]}; the draft {$oc_bv_id} is in the Trash.\n" );
	exit( 1 );
}
echo count( $oc_bv_slugs ) . "\n";
