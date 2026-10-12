<?php
/**
 * Surfaces: every ground the theme ships, as real pattern blocks on it, with the text roles
 * painted on each and their contrast; card next tones as real cards on their section; the
 * grounds of each page pattern in order. Use counts and sources are read from the registered
 * patterns as the page renders. Ends with "Rules vs runtime": where ODS RULES.md or the private
 * Canvas notes (docs/design.md) disagree with the shipped theme. Listed, not fixed.
 *
 * @package Origin
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$oc_ds_c     = static fn( $slug ) => 'var(--wp--preset--color--' . $slug . ')';
$oc_ds_token = static fn( $slug ) => oc_demo_ds_src( 'theme.json', '"slug": "' . $slug . '"' );
$oc_ds_dark  = 'var(--wp--custom--dark--bg)';
$oc_ds_tint  = 'color-mix(in srgb, var(--wp--preset--color--primary) 7%, var(--wp--preset--color--surface-base))';
$oc_ds_page  = $oc_ds_c( 'surface-base' );

// A shipped block, as a tile: $b is oc_demo_ds_block( slug, want ). A section sample sits on
// its own ground; a card sits on the ground around it.
$oc_ds_from = static function ( $b, $t, $card = false ) {
	$t['html']   = $b['html'];
	$t['ground'] = $card ? $b['outer'] : $b['ground'];
	$t['color']  = $b['color'];
	$t['src']    = $t['src'] . ' · ' . $b['src'];
	return $t;
};

// Every fill in the registered theme patterns: the pattern, how deep the block sits (0 is the
// section), its fill and the ground around it. Palette slugs become their preset variable.
$oc_ds_fills = array();
$oc_ds_walk  = static function ( $blocks, $outer, $depth, $slug ) use ( &$oc_ds_walk, &$oc_ds_fills ) {
	foreach ( $blocks as $block ) {
		if ( empty( $block['blockName'] ) ) {
			continue;
		}
		$attrs = $block['attrs'];
		$fill  = isset( $attrs['backgroundColor'] ) ? 'var(--wp--preset--color--' . $attrs['backgroundColor'] . ')' : ( $attrs['style']['color']['background'] ?? '' );
		if ( $fill ) {
			$oc_ds_fills[] = array( $slug, $depth, $fill, $outer, $attrs['className'] ?? '' );
		}
		$oc_ds_walk( $block['innerBlocks'], $fill ? $fill : $outer, $depth + 1, $slug );
	}
};
foreach ( WP_Block_Patterns_Registry::get_instance()->get_all_registered() as $oc_ds_pattern ) {
	if ( 0 === strpos( $oc_ds_pattern['name'], 'origin-canvas/' ) ) {
		$oc_ds_walk( parse_blocks( $oc_ds_pattern['content'] ), $oc_ds_page, 0, substr( $oc_ds_pattern['name'], 14 ) );
	}
}

// "As a section in N patterns, inside one in M": distinct patterns per depth. The palette
// showcases (style-variations, token-system) paint swatches, not surfaces, so their inner
// fills do not count.
$oc_ds_count = static function ( $values ) use ( &$oc_ds_fills ) {
	$top   = array();
	$inner = array();
	foreach ( $oc_ds_fills as $f ) {
		if ( ! in_array( $f[2], (array) $values, true ) ) {
			continue;
		}
		if ( 0 === $f[1] ) {
			$top[ $f[0] ] = true;
		} elseif ( ! in_array( $f[0], array( 'style-variations', 'token-system' ), true ) ) {
			$inner[ $f[0] ] = true;
		}
	}
	return sprintf( 'As a section in %d patterns; inside a section (card, panel, disc) in %d.', count( $top ), count( $inner ) );
};

$oc_ds_light_roles = array(
	array( 'text-heading', $oc_ds_c( 'text-heading' ), true ),
	array( 'text-body', $oc_ds_c( 'text-body' ), true ),
	array( 'text-muted', $oc_ds_c( 'text-muted' ), true ),
	array( 'primary', $oc_ds_c( 'primary' ), false ),
);
$oc_ds_tint_roles  = array_slice( $oc_ds_light_roles, 0, 3 );
$oc_ds_dark_roles  = array(
	array( 'on-dark', $oc_ds_c( 'on-dark' ), true ),
	array( 'on-dark 72%', 'color-mix(in srgb, var(--wp--custom--dark--text) 72%, transparent)', true ),
	array( 'primary', $oc_ds_c( 'primary' ), false ),
);
$oc_ds_dark_preset = array( $oc_ds_dark, $oc_ds_c( 'text-heading' ) );

/* Section grounds. */

$oc_ds_sections = array(
	$oc_ds_from(
		oc_demo_ds_block( 'process-cards', array( 'name' => 'core/heading' ) ),
		array(
			'name'  => 'surface-base',
			'use'   => 'The page, and any section with no fill. Set as a fill: ' . lcfirst( $oc_ds_count( $oc_ds_page ) ),
			'src'   => $oc_ds_token( 'surface-base' ) . ' · ' . oc_demo_ds_src( 'theme.json', '"background": "var(--wp--preset--color--surface-base)"', '"styles": {' ),
			'aa'    => true,
			'wide'  => true,
			'fill'  => '.ocds-ground',
			'roles' => $oc_ds_light_roles,
		)
	),
	$oc_ds_from(
		oc_demo_ds_block( 'features-checklist', array( 'name' => 'core/heading' ) ),
		array(
			'name'  => 'surface-muted',
			'use'   => 'The alternate section tone, and the card on white. ' . $oc_ds_count( $oc_ds_c( 'surface-muted' ) ),
			'src'   => $oc_ds_token( 'surface-muted' ),
			'aa'    => true,
			'wide'  => true,
			'fill'  => '.ocds-ground',
			'roles' => $oc_ds_light_roles,
		)
	),
	$oc_ds_from(
		oc_demo_ds_block( 'lead-statement', array( 'name' => 'core/heading' ) ),
		array(
			'name'  => 'surface-subtle',
			'use'   => 'The third section tone, the darkest tinted ground. ' . $oc_ds_count( $oc_ds_c( 'surface-subtle' ) ),
			'src'   => $oc_ds_token( 'surface-subtle' ),
			'aa'    => true,
			'wide'  => true,
			'fill'  => '.ocds-ground',
			'roles' => $oc_ds_light_roles,
		)
	),
	$oc_ds_from(
		oc_demo_ds_block( 'hero-dark', array( 'name' => 'core/paragraph', 'plain' => true ) ),
		array(
			'name'  => 'dark band · custom.dark.bg',
			'use'   => 'A dark section: text-heading as the ground, on-dark as the text. custom.dark.bg ' . lcfirst( $oc_ds_count( $oc_ds_dark ) ) . ' The text-heading preset directly: ' . lcfirst( $oc_ds_count( $oc_ds_c( 'text-heading' ) ) ),
			'src'   => oc_demo_ds_src( 'theme.json', '"bg": "var(--wp--preset--color--text-heading)"', '"dark": {' ) . ' · ' . $oc_ds_token( 'text-heading' ),
			'aa'    => true,
			'wide'  => true,
			'fill'  => '.ocds-ground',
			'roles' => $oc_ds_dark_roles,
		)
	),
	array(
		'name'   => 'primary 7% tint',
		'ground' => $oc_ds_tint,
		'color'  => $oc_ds_c( 'text-heading' ),
		'html'   => do_blocks( "<!-- wp:paragraph -->\n<p>A flat section tint, on up to two sections per page.</p>\n<!-- /wp:paragraph -->" ),
		'use'    => 'Painted from the rule: primary mixed 7% into surface-base. No shipped pattern uses it. Primary text never sits on it.',
		'src'    => $oc_ds_token( 'primary' ) . ' · ' . $oc_ds_token( 'surface-base' ),
		'aa'     => true,
		'wide'   => true,
		'fill'   => '.ocds-ground',
		'roles'  => $oc_ds_tint_roles,
		'note'   => 'Text color, Rules vs runtime 6',
	),
	array(
		'name'   => 'surface-subtle-hover',
		'ground' => $oc_ds_c( 'surface-subtle-hover' ),
		'color'  => $oc_ds_c( 'text-heading' ),
		'html'   => do_blocks( "<!-- wp:paragraph -->\n<p>One step darker than surface-subtle.</p>\n<!-- /wp:paragraph -->" ),
		'use'    => 'Hover and press fills: a pagination link on hover, an Outline button on press. Shown here at rest.',
		'src'    => $oc_ds_token( 'surface-subtle-hover' ) . ' · ' . oc_demo_ds_src( 'theme.json', '"background": "var(--wp--preset--color--surface-subtle-hover)"', '"core/query-pagination": {' ) . ' · ' . oc_demo_ds_src( 'theme.json', '"background": "var(--wp--preset--color--surface-subtle-hover)"', '":active": {' ),
		'aa'     => true,
		'wide'   => true,
		'fill'   => '.ocds-ground',
		'roles'  => $oc_ds_tint_roles,
	),
);

/* Card next tones: real cards on the section ground around them. */

$oc_ds_card_tone = '.ocds-sample > *';
$oc_ds_cards     = array(
	$oc_ds_from(
		oc_demo_ds_block( 'process-cards', array( 'name' => 'core/group', 'fill' => 'surface-muted' ) ),
		array(
			'name'   => 'surface-muted card on surface-base',
			'target' => 'h2, h3, h4',
			'use'    => 'A card on white takes surface-muted.',
			'src'    => $oc_ds_token( 'surface-muted' ),
			'aa'     => true,
			'fill'   => $oc_ds_card_tone,
		),
		true
	),
	$oc_ds_from(
		oc_demo_ds_block( 'card-pricing', array( 'name' => 'core/column', 'fill' => 'surface-base' ) ),
		array(
			'name'   => 'surface-base card on surface-muted',
			'target' => 'h2, h3, h4',
			'use'    => 'A card on a tint takes surface-base.',
			'src'    => $oc_ds_token( 'surface-base' ),
			'aa'     => true,
			'fill'   => $oc_ds_card_tone,
		),
		true
	),
	$oc_ds_from(
		oc_demo_ds_block( 'product-grid', array( 'name' => 'core/column', 'fill' => 'surface-base' ) ),
		array(
			'name'   => 'surface-base card on surface-subtle',
			'target' => 'h2, h3, h4',
			'use'    => 'The same step from the darkest tint.',
			'src'    => $oc_ds_token( 'surface-base' ),
			'aa'     => true,
			'fill'   => $oc_ds_card_tone,
		),
		true
	),
	$oc_ds_from(
		oc_demo_ds_block( 'pricing-hero', array( 'name' => 'core/column', 'fill' => 'surface-base' ) ),
		array(
			'name'   => 'surface-base card on surface-base, bordered',
			'target' => 'h2, h3, h4, p',
			'use'    => 'No next tone: an input-border hairline is the one means of separation.',
			'src'    => $oc_ds_token( 'input-border' ),
			'aa'     => true,
			'fill'   => $oc_ds_card_tone,
		),
		true
	),
	$oc_ds_from(
		oc_demo_ds_block( 'features-grid', array( 'class' => 'is-style-origin-canvas-icon-bubble' ) ),
		array(
			'name' => 'surface-base disc on a surface-muted card',
			'use'  => 'An icon disc takes the next tone from its card.',
			'src'  => $oc_ds_token( 'surface-base' ),
			'text' => false,
			'fill' => $oc_ds_card_tone,
		),
		true
	),
	$oc_ds_from(
		oc_demo_ds_block( 'features-with-image', array( 'class' => 'is-style-origin-canvas-icon-bubble' ) ),
		array(
			'name' => 'surface-muted disc on surface-base',
			'use'  => 'A disc with no card takes the next tone from the section.',
			'src'  => $oc_ds_token( 'surface-muted' ),
			'text' => false,
			'fill' => $oc_ds_card_tone,
		),
		true
	),
	$oc_ds_from(
		oc_demo_ds_block( 'product-grid', array( 'name' => 'core/column', 'ground' => $oc_ds_dark ) ),
		array(
			'name'   => 'custom.dark.bg card on surface-subtle',
			'target' => 'h2, h3, h4',
			'use'    => 'The coming-soon product card: a dark card on a light section.',
			'src'    => oc_demo_ds_src( 'theme.json', '"bg": "var(--wp--preset--color--text-heading)"', '"dark": {' ),
			'aa'     => true,
			'fill'   => $oc_ds_card_tone,
			'note'   => 'Rules vs runtime 2',
		),
		true
	),
);

/* Page grounds: each page pattern's sections in order. A section with no fill is the page;
   a wide panel inside it shows inset. Tones: the dark alias and the text-heading preset are
   one tone. */

$oc_ds_registry = WP_Block_Patterns_Registry::get_instance();
$oc_ds_fill_of  = static function ( $attrs ) {
	return isset( $attrs['backgroundColor'] ) ? 'var(--wp--preset--color--' . $attrs['backgroundColor'] . ')' : ( $attrs['style']['color']['background'] ?? '' );
};
$oc_ds_name_of  = static function ( $value ) use ( $oc_ds_dark ) {
	if ( $oc_ds_dark === $value ) {
		return 'custom.dark.bg';
	}
	return preg_match( '#^var\(--wp--preset--color--([a-z0-9-]+)\)$#', $value, $m ) ? $m[1] : $value;
};
$oc_ds_pages    = array();
$oc_ds_clashes  = array();
foreach ( $oc_ds_registry->get_all_registered() as $oc_ds_pattern ) {
	if ( 0 !== strpos( $oc_ds_pattern['name'], 'origin-canvas/page-' ) ) {
		continue;
	}
	$oc_ds_file = 'patterns/' . substr( $oc_ds_pattern['name'], 14 ) . '.php';
	$oc_ds_seq  = array();
	foreach ( parse_blocks( $oc_ds_pattern['content'] ) as $oc_ds_ref ) {
		if ( 'core/pattern' !== $oc_ds_ref['blockName'] ) {
			continue;
		}
		$oc_ds_section = $oc_ds_registry->get_registered( $oc_ds_ref['attrs']['slug'] );
		$oc_ds_top     = array_values( array_filter( parse_blocks( $oc_ds_section ? $oc_ds_section['content'] : '' ), static fn( $b ) => ! empty( $b['blockName'] ) ) );
		$oc_ds_fill    = $oc_ds_top ? $oc_ds_fill_of( $oc_ds_top[0]['attrs'] ) : '';
		$oc_ds_panel   = '';
		foreach ( $oc_ds_fill || ! $oc_ds_top ? array() : $oc_ds_top[0]['innerBlocks'] as $oc_ds_child ) {
			if ( in_array( $oc_ds_child['attrs']['align'] ?? '', array( 'wide', 'full' ), true ) && $oc_ds_fill_of( $oc_ds_child['attrs'] ) ) {
				$oc_ds_panel = $oc_ds_fill_of( $oc_ds_child['attrs'] );
				break;
			}
		}
		$oc_ds_ground = $oc_ds_fill ? $oc_ds_fill : $oc_ds_page;
		$oc_ds_tone   = in_array( $oc_ds_ground, $oc_ds_dark_preset, true ) ? 'dark' : $oc_ds_ground;
		$oc_ds_slug   = substr( $oc_ds_ref['attrs']['slug'], 14 );
		$oc_ds_prev   = end( $oc_ds_seq );
		if ( $oc_ds_prev && $oc_ds_prev['tone'] === $oc_ds_tone ) {
			$oc_ds_clashes[] = array( $oc_ds_file, $oc_ds_prev['slug'], $oc_ds_slug, 'same tone' );
		} elseif ( $oc_ds_prev && $oc_ds_page !== $oc_ds_prev['ground'] && $oc_ds_page !== $oc_ds_ground ) {
			$oc_ds_clashes[] = array( $oc_ds_file, $oc_ds_prev['slug'], $oc_ds_slug, 'two fills touch' );
		}
		$oc_ds_seq[] = array(
			'slug'   => $oc_ds_slug,
			'ground' => $oc_ds_ground,
			'panel'  => $oc_ds_panel,
			'tone'   => $oc_ds_tone,
		);
	}
	$oc_ds_pages[ $oc_ds_file ] = $oc_ds_seq;
}
ksort( $oc_ds_pages );

// Fills inside a dark section, other than state dots.
$oc_ds_on_dark = array();
foreach ( $oc_ds_fills as $oc_ds_f ) {
	if ( $oc_ds_f[1] > 0 && in_array( $oc_ds_f[3], $oc_ds_dark_preset, true ) && false === strpos( $oc_ds_f[4], 'status-dot' ) && ! in_array( $oc_ds_f[0], array( 'style-variations', 'token-system' ), true ) ) {
		$oc_ds_on_dark[ $oc_ds_f[0] ] = true;
	}
}

?>
<section class="ocds-section" id="surfaces" aria-labelledby="surfaces-title">
	<h2 id="surfaces-title" class="has-huge-font-size">Surfaces</h2>
	<p class="ocds-intent has-text-body-color has-text-color">Each ground the theme ships, with a real block from a pattern that uses it and every text role the rules put on it. The fill line gives the ground against what is behind it: a section against the page, a card against its section. Use counts are read from the registered patterns.</p>

	<h3 class="has-large-font-size">Section grounds</h3>
	<div class="ocds-tiles">
		<?php array_map( 'oc_demo_ds_tile', $oc_ds_sections ); ?>
	</div>

	<h3 class="has-large-font-size">Card next tones</h3>
	<p class="ocds-intent has-text-body-color has-text-color">A card takes the next tone from its ground: surface-muted on white, surface-base on a tint. An icon disc takes its tone from the card. Each card is shown on the section ground around it in its pattern.</p>
	<div class="ocds-tiles">
		<?php array_map( 'oc_demo_ds_tile', $oc_ds_cards ); ?>
	</div>

	<h3 class="has-large-font-size">Page grounds</h3>
	<p class="ocds-intent has-text-body-color has-text-color">The sections of each page pattern in order, as each section's own fill. The template's header and footer are not counted.</p>
	<div class="ocds-pages">
		<?php foreach ( $oc_ds_pages as $oc_ds_file => $oc_ds_seq ) : ?>
			<div>
				<code class="has-text-heading-color has-text-color"><?php echo esc_html( basename( $oc_ds_file ) ); ?></code>
				<ol class="ocds-strip has-extra-small-font-size">
					<?php foreach ( $oc_ds_seq as $oc_ds_item ) : ?>
						<li>
							<span class="ocds-swatch" style="<?php echo esc_attr( '--ocds-ground:' . $oc_ds_item['ground'] . ( $oc_ds_item['panel'] ? ';--ocds-panel:' . $oc_ds_item['panel'] : '' ) ); ?>" aria-hidden="true"><?php echo $oc_ds_item['panel'] ? '<span></span>' : ''; ?></span>
							<span class="has-text-heading-color has-text-color"><?php echo esc_html( $oc_ds_item['slug'] ); ?></span>
							<span class="has-text-muted-color has-text-color"><?php echo esc_html( $oc_ds_name_of( $oc_ds_item['ground'] ) . ( $oc_ds_item['panel'] ? ', panel ' . $oc_ds_name_of( $oc_ds_item['panel'] ) : '' ) ); ?></span>
						</li>
					<?php endforeach; ?>
				</ol>
			</div>
		<?php endforeach; ?>
	</div>

	<h3 class="has-large-font-size">In context</h3>
	<p class="ocds-intent has-text-body-color has-text-color">Three shipped patterns as they render: cards on a tint, cards and discs on white, and both card tones on the darkest tint.</p>
	<div class="ocds-context">
		<?php
		foreach ( array(
			'card-pricing'         => 'surface-base cards on a surface-muted section.',
			'features-3-col-icons' => 'surface-muted cards on white, each with a surface-base disc.',
			'product-grid'         => 'surface-base cards and one custom.dark.bg card on surface-subtle.',
		) as $oc_ds_slug => $oc_ds_text ) :
			?>
			<figure class="ocds-frame">
				<div class="ocds-frame-body">
					<?php echo do_blocks( '<!-- wp:pattern {"slug":"origin-canvas/' . $oc_ds_slug . '"} /-->' ); // phpcs:ignore WordPress.Security.EscapeOutput -- rendered theme pattern. ?>
				</div>
				<figcaption class="has-text-body-color has-text-color has-small-font-size"><code><?php echo esc_html( $oc_ds_slug ); ?></code> · <?php echo esc_html( $oc_ds_text ); ?> <span class="has-text-muted-color has-text-color">patterns/<?php echo esc_html( $oc_ds_slug ); ?>.php</span></figcaption>
			</figure>
		<?php endforeach; ?>
	</div>

	<h3 class="has-large-font-size">Rules vs runtime</h3>
	<p class="ocds-intent has-text-body-color has-text-color">Where ODS <code>RULES.md</code> or the Canvas notes (<code>docs/design.md</code>, private) disagree with the shipped theme. Listed for a decision; nothing here changes the theme. The Text color items stay open there and are not repeated.</p>
	<ol class="ocds-rvr has-text-body-color has-text-color">
		<li><strong>A card on a dark band.</strong> RULES, "Cards and separation" (Ruled): on dark, a card takes "a lighter dark tone". No token holds one: <code>custom.dark</code> has <code>bg</code> and <code>text</code> only (<?php echo esc_html( oc_demo_ds_src( 'theme.json', '"dark": {' ) ); ?>). <?php echo esc_html( $oc_ds_on_dark ? 'Fills inside a dark section today: ' . implode( ', ', array_keys( $oc_ds_on_dark ) ) . '.' : 'No shipped pattern puts a card on a dark section yet.' ); ?></li>
		<li><strong>A dark card on a light section.</strong> RULES, "Cards and separation" (Ruled): a card takes the next tone from its ground. Shipped: the coming-soon card in <?php echo esc_html( oc_demo_ds_block( 'product-grid', array( 'name' => 'core/column', 'ground' => $oc_ds_dark ) )['src'] ); ?> is custom.dark.bg on surface-subtle, not surface-base. See its tile for the fill step.</li>
		<li><strong>surface-subtle-hover off its role.</strong> RULES, "Surfaces" (Provisional): one step darker than surface-subtle, for hover and active fills. Shipped as a hover or press fill in <?php echo esc_html( oc_demo_ds_src( 'theme.json', '"background": "var(--wp--preset--color--surface-subtle-hover)"', '"core/query-pagination": {' ) ); ?> and <?php echo esc_html( oc_demo_ds_src( 'theme.json', '"background": "var(--wp--preset--color--surface-subtle-hover)"', '":active": {' ) ); ?>, and also as the end of the testimonial wash gradient (<?php echo esc_html( oc_demo_ds_src( 'style.css', 'surface-subtle-hover) 100%' ) ); ?>), a resting ground.</li>
		<li><strong>Adjacent sections on one tone.</strong> RULES, "Surfaces" (Ruled): adjacent sections differ in tone, and two filled sections never touch. The notes' page rules name only the second. Shipped: <?php echo esc_html( $oc_ds_clashes ? implode( '; ', array_map( static fn( $c ) => $c[1] . ' then ' . $c[2] . ', ' . $c[3] . ' (' . oc_demo_ds_src( $c[0], 'origin-canvas/' . $c[2] . '"' ) . ')', $oc_ds_clashes ) ) : 'none in the page patterns' ); ?>. See Page grounds.</li>
	</ol>
</section>
