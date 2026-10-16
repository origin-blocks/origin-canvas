<?php
/**
 * Pattern library page for the local demo site. Loaded by bin/demo/oc-demo-switches.php from
 * the active theme; never shipped in the theme zip (bin/ is distignored).
 *
 * /pattern-library/ is a route, not a page: nothing is stored in the database. It renders every
 * registered origin-canvas pattern at request time, by its wp:pattern reference, grouped by
 * category, each under a label with its title and slug. Hidden patterns (Inserter: false) come
 * last, in their own group. Because the references render per request, ?octheme= and
 * ?ocvariation= apply as on any other page.
 *
 * Administrators only. For everyone else the route is not there, so WordPress gives its 404.
 *
 * @package Origin
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Whether this request is the pattern library. Set once, in parse_request.
 *
 * @param bool|null $set True to mark the request.
 */
function oc_demo_pl_is_route( $set = null ) {
	static $is_route = false;
	if ( null !== $set ) {
		$is_route = (bool) $set;
	}
	return $is_route;
}

/**
 * Category order: the fixed role list in CLAUDE.md (rule 2), then header and footer. Any other
 * category follows alphabetically.
 */
function oc_demo_pl_category_order() {
	return array(
		'origin-canvas/hero',
		'testimonials',
		'origin-canvas/pricing',
		'origin-canvas/stats',
		'team',
		'origin-canvas/features',
		'origin-canvas/faq',
		'contact',
		'gallery',
		'origin-canvas/logos',
		'origin-canvas/author',
		'origin-canvas/card',
		'posts',
		'call-to-action',
		'text',
		'origin-canvas/page',
		'header',
		'footer',
	);
}

/**
 * Registered origin-canvas patterns as label => patterns, in display order. Patterns in a
 * group are sorted by title. Hidden patterns form the last group.
 *
 * @return array<string, array{id: string, patterns: array[]}>
 */
function oc_demo_pl_groups() {
	$categories = WP_Block_Pattern_Categories_Registry::get_instance();
	$shown      = array();
	$hidden     = array();
	foreach ( WP_Block_Patterns_Registry::get_instance()->get_all_registered() as $pattern ) {
		if ( 0 !== strpos( $pattern['name'], 'origin-canvas/' ) ) {
			continue;
		}
		if ( isset( $pattern['inserter'] ) && false === $pattern['inserter'] ) {
			$hidden[] = $pattern;
			continue;
		}
		$category             = $pattern['categories'][0] ?? 'uncategorized';
		$shown[ $category ][] = $pattern;
	}

	$order = array_flip( oc_demo_pl_category_order() );
	uksort(
		$shown,
		static function ( $a, $b ) use ( $order ) {
			$rank_a = $order[ $a ] ?? PHP_INT_MAX;
			$rank_b = $order[ $b ] ?? PHP_INT_MAX;
			return $rank_a === $rank_b ? strcmp( $a, $b ) : $rank_a <=> $rank_b;
		}
	);

	$by_title = static fn( $a, $b ) => strcasecmp( $a['title'], $b['title'] );
	$groups   = array();
	foreach ( $shown as $category => $patterns ) {
		usort( $patterns, $by_title );
		$registered = $categories->get_registered( $category );
		$groups[ $registered['label'] ?? $category ] = array(
			'id'       => 'ocpl-' . sanitize_title( $category ),
			'patterns' => $patterns,
		);
	}
	if ( $hidden ) {
		usort( $hidden, $by_title );
		$groups['Hidden (Inserter: false)'] = array(
			'id'       => 'ocpl-hidden',
			'patterns' => $hidden,
			'hidden'   => true,
		);
	}
	return $groups;
}

/**
 * The block template the route renders: the theme's header and footer parts around the library.
 * Labels are plain HTML between blocks. A shown pattern sits in a constrained Group, as page
 * content does in the theme's page templates; a hidden pattern is a template scaffold, so it
 * renders at the top level, as a template would.
 */
function oc_demo_pl_template() {
	$groups = oc_demo_pl_groups();
	$total  = array_sum( array_map( static fn( $group ) => count( $group['patterns'] ), $groups ) );

	$variation = empty( $_GET['ocvariation'] ) ? 'default' : preg_replace( '/[^a-z0-9-]/', '', strtolower( (string) wp_unslash( $_GET['ocvariation'] ) ) ); // phpcs:ignore WordPress.Security.NonceVerification -- read-only view switch.

	$nav = '';
	foreach ( $groups as $label => $group ) {
		$nav .= '<li><a href="#' . esc_attr( $group['id'] ) . '">' . esc_html( $label ) . '</a> <span class="has-text-muted-color has-text-color">' . count( $group['patterns'] ) . '</span></li>';
	}

	$html  = '<!-- wp:template-part {"slug":"header","area":"header"} /-->' . "\n";
	$html .= '<!-- wp:group {"className":"ocpl","style":{"spacing":{"blockGap":"0","margin":{"top":"0","bottom":"0"}}},"layout":{"type":"default"}} -->' . "\n";
	$html .= '<div class="wp-block-group ocpl" style="margin-top:0;margin-bottom:0">';
	$html .= '<header class="ocpl-head has-global-padding">'
		. '<p class="ocpl-kicker has-text-heading-color has-text-color has-extra-small-font-size">Pattern library · private</p>'
		. '<h1 class="has-display-font-size">Patterns</h1>'
		. '<p class="has-text-body-color has-text-color has-regular-font-size">' . (int) $total . ' registered patterns from <code>' . esc_html( get_stylesheet() ) . '</code>, style <code>' . esc_html( $variation ) . '</code>, rendered as this request has them.</p>'
		. '<nav aria-label="Categories"><ul class="ocpl-nav has-small-font-size">' . $nav . '</ul></nav>'
		. '</header>';

	foreach ( $groups as $label => $group ) {
		$html .= '<h2 id="' . esc_attr( $group['id'] ) . '" class="ocpl-cat has-global-padding has-large-font-size">' . esc_html( $label ) . ' <span class="has-text-muted-color has-text-color">' . count( $group['patterns'] ) . '</span></h2>';
		foreach ( $group['patterns'] as $pattern ) {
			$ref   = '<!-- wp:pattern ' . wp_json_encode( array( 'slug' => $pattern['name'] ) ) . ' /-->';
			$html .= '<p id="' . esc_attr( 'ocpl-' . substr( $pattern['name'], strlen( 'origin-canvas/' ) ) ) . '" class="ocpl-label has-global-padding has-small-font-size">'
				. '<strong class="has-text-heading-color has-text-color">' . esc_html( $pattern['title'] ) . '</strong> '
				. '<code class="has-text-muted-color has-text-color">' . esc_html( $pattern['name'] ) . '</code></p>' . "\n";
			$html .= empty( $group['hidden'] )
				? '<!-- wp:group {"layout":{"type":"constrained"}} -->' . "\n" . '<div class="wp-block-group">' . $ref . '</div>' . "\n" . '<!-- /wp:group -->' . "\n"
				: $ref . "\n";
		}
	}

	$html .= '</div>' . "\n" . '<!-- /wp:group -->' . "\n";
	$html .= '<!-- wp:template-part {"slug":"footer","area":"footer"} /-->';
	return $html;
}

// Claim /pattern-library/ before WordPress looks it up. The main query asks for no posts, so a
// scaffold's Post Content renders empty and its Query Loop shows "no results".
add_action(
	'parse_request',
	static function ( $wp ) {
		if ( 'pattern-library' !== $wp->request || ! current_user_can( 'manage_options' ) ) {
			return;
		}
		oc_demo_pl_is_route( true );
		$wp->query_vars = array( 'post__in' => array( 0 ) );
		remove_action( 'template_redirect', 'redirect_canonical' );
	}
);

add_filter( 'pre_handle_404', static fn( $handled ) => oc_demo_pl_is_route() ? true : $handled );

add_action(
	'template_redirect',
	static function () {
		if ( oc_demo_pl_is_route() ) {
			nocache_headers();
			status_header( 200 );
		}
	},
	0
);

add_filter( 'pre_get_document_title', static fn( $title ) => oc_demo_pl_is_route() ? 'Pattern library' : $title );

// Render through core's block template canvas, so the page gets the theme's global styles, block
// assets and parts, exactly as a template would.
add_filter(
	'template_include',
	static function ( $template ) {
		if ( ! oc_demo_pl_is_route() ) {
			return $template;
		}
		global $_wp_current_template_content;
		$_wp_current_template_content = oc_demo_pl_template();
		return ABSPATH . WPINC . '/template-canvas.php';
	},
	PHP_INT_MAX
);

add_action(
	'wp_enqueue_scripts',
	static function () {
		if ( oc_demo_pl_is_route() ) {
			wp_enqueue_style(
				'oc-demo-pattern-library',
				get_stylesheet_directory_uri() . '/bin/demo/pattern-library/pattern-library.css',
				array(),
				(string) filemtime( __DIR__ . '/pattern-library.css' )
			);
		}
	}
);
