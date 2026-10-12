<?php
/**
 * Text color: every text role the theme ships, on every ground it sits on, in the type it is
 * set in. Specimens are blocks taken from the registered patterns; sources are found as the
 * page renders. Ends with "Rules vs runtime": where ODS RULES.md or the private Canvas notes
 * (docs/design.md) disagree with the shipped theme. Listed, not fixed.
 *
 * @package Origin
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$oc_ds_c      = static fn( $slug ) => 'var(--wp--preset--color--' . $slug . ')';
$oc_ds_token  = static fn( $slug ) => oc_demo_ds_src( 'theme.json', '"slug": "' . $slug . '"' );
$oc_ds_dark   = 'var(--wp--custom--dark--bg)';
$oc_ds_tint   = 'color-mix(in srgb, var(--wp--preset--color--primary) 7%, var(--wp--preset--color--surface-base))';
$oc_ds_on_src = oc_demo_ds_src( 'theme.json', '"text": "var(--wp--preset--color--on-dark)"', '"dark": {' );

// A shipped block, as a tile on the ground it sits on: $b is oc_demo_ds_block( slug, want ).
$oc_ds_from = static function ( $b, $t ) {
	$t['html']   = $b['html'];
	$t['ground'] = $b['ground'];
	$t['color']  = $b['color'];
	$t['src']    = $t['src'] . ' · ' . $b['src'];
	return $t;
};

/* Reading text on light grounds. */

$oc_ds_reading = array(
	$oc_ds_from(
		oc_demo_ds_block( 'features-grid', array( 'name' => 'core/heading' ) ),
		array(
			'name'   => 'text-heading',
			'fg'     => $oc_ds_c( 'text-heading' ),
			'use'    => 'Headings, through elements.heading. Section heading at display.',
			'src'    => $oc_ds_token( 'text-heading' ) . ' · ' . oc_demo_ds_src( 'theme.json', '"text": "var(--wp--preset--color--text-heading)"', '"heading": {' ),
			'aa'     => true,
			'wide'   => true,
		)
	),
	$oc_ds_from(
		oc_demo_ds_block( 'features-grid', array( 'textColor' => 'text-body' ) ),
		array(
			'name'   => 'text-body',
			'fg'     => $oc_ds_c( 'text-body' ),
			'use'    => 'Body copy and section descriptions. Also the default text color.',
			'src'    => $oc_ds_token( 'text-body' ) . ' · ' . oc_demo_ds_src( 'theme.json', '"text": "var(--wp--preset--color--text-body)"', '"styles": {' ),
			'aa'     => true,
		)
	),
	$oc_ds_from(
		oc_demo_ds_block( 'card-team-member', array( 'textColor' => 'text-muted' ) ),
		array(
			'name'   => 'text-muted',
			'fg'     => $oc_ds_c( 'text-muted' ),
			'use'    => 'Secondary and meta text: a role line, a date, a caption.',
			'src'    => $oc_ds_token( 'text-muted' ),
			'aa'     => true,
		)
	),
	$oc_ds_from(
		oc_demo_ds_block( 'card-blog-post', array( 'textColor' => 'text-muted' ) ),
		array(
			'name'   => 'text-muted',
			'fg'     => $oc_ds_c( 'text-muted' ),
			'use'    => 'Card kicker on a surface-muted card.',
			'src'    => $oc_ds_token( 'text-muted' ),
			'aa'     => true,
		)
	),
	$oc_ds_from(
		oc_demo_ds_block( 'style-variations', array( 'textColor' => 'text-body' ) ),
		array(
			'name'   => 'text-body',
			'fg'     => $oc_ds_c( 'text-body' ),
			'use'    => 'Body copy on surface-subtle, the darkest tinted ground.',
			'src'    => $oc_ds_token( 'text-body' ),
			'aa'     => true,
		)
	),
	$oc_ds_from(
		oc_demo_ds_block( 'breath-statement', array( 'contains' => 'has-inline-color' ) ),
		array(
			'name'   => 'text-muted · statement',
			'target' => '.has-inline-color',
			'use'    => 'The quieter second half of a two-tone statement, an inline text color.',
			'src'    => $oc_ds_token( 'text-muted' ),
			'aa'     => true,
			'wide'   => true,
		)
	),
	$oc_ds_from(
		oc_demo_ds_block( 'logos-row', array( 'textColor' => 'text-body' ) ),
		array(
			'name'   => 'text-body',
			'fg'     => $oc_ds_c( 'text-body' ),
			'use'    => 'A label that names a logo group. Not an eyebrow: no role class.',
			'src'    => $oc_ds_token( 'text-body' ),
			'aa'     => true,
		)
	),
);

/* On the dark band. */

$oc_ds_on_dark = array(
	$oc_ds_from(
		oc_demo_ds_block( 'cta-closing', array( 'name' => 'core/heading' ) ),
		array(
			'name'   => 'on-dark',
			'fg'     => $oc_ds_c( 'on-dark' ),
			'use'    => 'Headings and text on a dark band, through custom.dark.text.',
			'src'    => $oc_ds_token( 'on-dark' ) . ' · ' . $oc_ds_on_src,
			'aa'     => true,
			'wide'   => true,
		)
	),
	$oc_ds_from(
		oc_demo_ds_block( 'cta-closing', array( 'color' => '72%' ) ),
		array(
			'name'   => 'on-dark 72%',
			'use'    => 'Secondary text on a dark band, at the value the notes set.',
			'src'    => $oc_ds_on_src,
			'aa'     => true,
		)
	),
	$oc_ds_from(
		oc_demo_ds_block( 'stat-band-dark', array( 'color' => '65%' ) ),
		array(
			'name'   => 'on-dark 65%',
			'use'    => 'Stat labels on the dark stat band.',
			'src'    => $oc_ds_on_src,
			'aa'     => true,
		)
	),
	$oc_ds_from(
		oc_demo_ds_block( 'footer-dark', array( 'color' => '62%' ) ),
		array(
			'name'   => 'on-dark 62%',
			'use'    => 'Footer description and column links.',
			'src'    => $oc_ds_on_src,
			'aa'     => true,
		)
	),
	$oc_ds_from(
		oc_demo_ds_block( 'footer-dark', array( 'color' => '50%' ) ),
		array(
			'name'   => 'on-dark 50%',
			'use'    => 'Footer small print.',
			'src'    => $oc_ds_on_src,
			'aa'     => true,
		)
	),
	$oc_ds_from(
		oc_demo_ds_block( 'stat-band-dark', array( 'contains' => 'opacity:' ) ),
		array(
			'name'   => 'on-dark · opacity 0.72',
			'target' => 'span',
			'use'    => 'The second half of the dark stat band statement, faded with inline opacity.',
			'src'    => $oc_ds_on_src,
			'aa'     => true,
			'note'   => 'Rules vs runtime 2',
			'wide'   => true,
		)
	),
	$oc_ds_from(
		oc_demo_ds_block( 'stat-band', array( 'color' => 'rgba(' ) ),
		array(
			'name'   => 'rgba(243,244,246,0.72)',
			'use'    => 'Stat labels on the stat band. A literal, not the on-dark token.',
			'src'    => 'no token',
			'aa'     => true,
			'note'   => 'Rules vs runtime 3',
		)
	),
	$oc_ds_from(
		oc_demo_ds_block( 'product-grid', array( 'textColor' => 'text-muted', 'ground' => $oc_ds_dark ) ),
		array(
			'name'   => 'text-muted on dark',
			'use'    => 'Price suffix on the dark product card.',
			'src'    => $oc_ds_token( 'text-muted' ),
			'aa'     => true,
			'note'   => 'Rules vs runtime 4',
		)
	),
);

/* Primary as text: the three role classes, and the state label. */

$oc_ds_primary = array(
	$oc_ds_from(
		oc_demo_ds_block( 'features-grid', array( 'class' => 'origin-canvas-eyebrow' ) ),
		array(
			'name'   => 'primary · eyebrow',
			'fg'     => $oc_ds_c( 'primary' ),
			'use'    => 'Section eyebrow on white. Contrast is not a gate for primary.',
			'src'    => $oc_ds_token( 'primary' ),
		)
	),
	$oc_ds_from(
		oc_demo_ds_block( 'testimonial-single', array( 'class' => 'origin-canvas-eyebrow' ) ),
		array(
			'name'   => 'primary · eyebrow',
			'fg'     => $oc_ds_c( 'primary' ),
			'use'    => 'Eyebrow on a surface-muted section.',
			'src'    => $oc_ds_token( 'primary' ),
		)
	),
	$oc_ds_from(
		oc_demo_ds_block( 'stat-band-dark', array( 'class' => 'origin-canvas-eyebrow' ) ),
		array(
			'name'   => 'primary · eyebrow',
			'fg'     => $oc_ds_c( 'primary' ),
			'use'    => 'Eyebrow on a dark band, 14 / 0.12em.',
			'src'    => $oc_ds_token( 'primary' ),
		)
	),
	$oc_ds_from(
		oc_demo_ds_block( 'stat-band-dark', array( 'class' => 'origin-canvas-figure' ) ),
		array(
			'name'   => 'primary · figure',
			'use'    => 'Stat figure on a dark band.',
			'src'    => $oc_ds_token( 'primary' ),
		)
	),
	$oc_ds_from(
		oc_demo_ds_block( 'card-stat', array( 'class' => 'origin-canvas-figure' ) ),
		array(
			'name' => 'text-heading · figure on light',
			'fg'   => $oc_ds_c( 'text-heading' ),
			'use'  => 'Stat figure on a light ground: heading ink, not primary.',
			'src'  => $oc_ds_token( 'text-heading' ),
			'aa'   => true,
		)
	),
	$oc_ds_from(
		oc_demo_ds_block( 'process-cards', array( 'class' => 'origin-canvas-ordinal' ) ),
		array(
			'name'   => 'primary · step number',
			'fg'     => $oc_ds_c( 'primary' ),
			'use'    => 'Step number below the display preset, on a surface-muted card.',
			'src'    => $oc_ds_token( 'primary' ),
		)
	),
	$oc_ds_from(
		oc_demo_ds_block( 'features-numbered', array( 'class' => 'origin-canvas-ordinal' ) ),
		array(
			'name'   => 'input-border · step number',
			'use'    => 'Step number at display or larger. The one use of a border color as text.',
			'src'    => $oc_ds_token( 'input-border' ),
		)
	),
	$oc_ds_from(
		oc_demo_ds_block( 'pricing-hero', array( 'textColor' => 'primary', 'plain' => true ) ),
		array(
			'name'   => 'primary · state label',
			'fg'     => $oc_ds_c( 'primary' ),
			'use'    => 'The featured tier\'s state label. An indicator, not resting text.',
			'src'    => $oc_ds_token( 'primary' ),
		)
	),
);

/* Links. Content links are core paragraphs; the hover tile shows the hover color at rest. */

$oc_ds_link_src = oc_demo_ds_src( 'theme.json', '"text": "var(--wp--preset--color--text-heading)"', '"link": {' );
$oc_ds_links    = array(
	array(
		'name'   => 'a · text-heading',
		'ground' => $oc_ds_c( 'surface-base' ),
		'html'   => do_blocks( "<!-- wp:paragraph -->\n<p>Read <a href=\"#text-color\">the project brief</a> before the first call.</p>\n<!-- /wp:paragraph -->" ),
		'target' => 'a',
		'use'    => 'Content link at rest: heading ink, underlined.',
		'src'    => $oc_ds_link_src . ' · ' . oc_demo_ds_src( 'theme.json', '"textDecoration": "underline"', '"core/paragraph": {' ),
		'aa'     => true,
	),
	array(
		'name'   => 'a:hover · primary',
		'ground' => $oc_ds_c( 'surface-base' ),
		'html'   => do_blocks( "<!-- wp:paragraph -->\n<p>Read <a href=\"#text-color\" style=\"color:var(--wp--preset--color--primary)\">the project brief</a> before the first call.</p>\n<!-- /wp:paragraph -->" ),
		'target' => 'a',
		'use'    => 'Hover and focus. Shown here at rest.',
		'src'    => oc_demo_ds_src( 'theme.json', '"text": "var(--wp--preset--color--primary)"', '":hover": {' ),
	),
	$oc_ds_from(
		oc_demo_ds_block( 'contact-details', array( 'class' => 'origin-canvas-links-plain' ) ),
		array(
			'name'   => 'a · text-heading, plain',
			'target' => 'a',
			'use'    => 'Chrome link with no underline, on a surface-muted card.',
			'src'    => $oc_ds_link_src,
			'aa'     => true,
		)
	),
	array(
		'name'   => 'a · on-dark',
		'ground' => $oc_ds_dark,
		'html'   => do_blocks( "<!-- wp:group {\"style\":{\"color\":{\"text\":\"var(--wp--custom--dark--text)\"},\"elements\":{\"link\":{\"color\":{\"text\":\"var:preset|color|on-dark\"},\":hover\":{\"color\":{\"text\":\"var:preset|color|primary\"}}}}},\"layout\":{\"type\":\"default\"}} -->\n<div class=\"wp-block-group has-text-color has-link-color\" style=\"color:var(--wp--custom--dark--text)\"><!-- wp:paragraph -->\n<p>Read <a href=\"#text-color\">the project brief</a> first.</p>\n<!-- /wp:paragraph --></div>\n<!-- /wp:group -->" ),
		'target' => 'a',
		'use'    => 'Link on a dark band: on-dark at rest, primary on hover. Set as header-dark sets it.',
		'src'    => $oc_ds_token( 'on-dark' ) . ' · ' . oc_demo_ds_src( 'patterns/header-dark.php', '"link":{"color":{"text":"var:preset|color|on-dark"},":hover"' ),
		'aa'     => true,
	),
);

/* Every role on every ground. A cell is empty where the rules do not put that role. */

$oc_ds_grounds = array(
	array( 'surface-base', $oc_ds_c( 'surface-base' ), 'light' ),
	array( 'surface-muted', $oc_ds_c( 'surface-muted' ), 'light' ),
	array( 'surface-subtle', $oc_ds_c( 'surface-subtle' ), 'light' ),
	array( 'primary 7% tint', $oc_ds_tint, 'tint' ),
	array( 'dark band', $oc_ds_dark, 'dark' ),
);
$oc_ds_roles   = array(
	array( 'text-heading', $oc_ds_c( 'text-heading' ), array( 'light', 'tint' ), true ),
	array( 'text-body', $oc_ds_c( 'text-body' ), array( 'light', 'tint' ), true ),
	array( 'text-muted', $oc_ds_c( 'text-muted' ), array( 'light', 'tint' ), true ),
	array( 'primary', $oc_ds_c( 'primary' ), array( 'light', 'dark' ), false ),
	array( 'input-border', $oc_ds_c( 'input-border' ), array( 'light', 'tint' ), false ),
	array( 'on-dark', $oc_ds_c( 'on-dark' ), array( 'dark' ), true ),
	array( 'on-dark 72%', 'color-mix(in srgb, var(--wp--custom--dark--text) 72%, transparent)', array( 'dark' ), true ),
);

?>
<section class="ocds-section" id="text-color" aria-labelledby="text-color-title">
	<h2 id="text-color-title" class="has-huge-font-size">Text color</h2>
	<p class="ocds-intent has-text-body-color has-text-color">Each text role on the grounds it sits on: white, the two tints and the dark band. Captions give the role, the painted hex, its contrast with the ground, what it is for and where it comes from. Primary is exempt from contrast checks by rule; the neutral roles show "under AA" below 4.5:1.</p>

	<h3 class="has-large-font-size">Reading text on light grounds</h3>
	<div class="ocds-tiles">
		<?php array_map( 'oc_demo_ds_tile', $oc_ds_reading ); ?>
	</div>

	<h3 class="has-large-font-size">On the dark band</h3>
	<p class="ocds-intent has-text-body-color has-text-color">The band is custom.dark.bg (text-heading) and its text is custom.dark.text (on-dark), so a style variation's ink reaches every dark pattern. Secondary text is on-dark mixed toward the ground.</p>
	<div class="ocds-tiles">
		<?php array_map( 'oc_demo_ds_tile', $oc_ds_on_dark ); ?>
	</div>

	<h3 class="has-large-font-size">Primary as text</h3>
	<p class="ocds-intent has-text-body-color has-text-color">Primary colors text only in three roles, each marked by a class: eyebrows, stat figures on dark bands and step numbers. A state label is an indicator. Reading text and links at rest are never primary.</p>
	<div class="ocds-tiles">
		<?php array_map( 'oc_demo_ds_tile', $oc_ds_primary ); ?>
	</div>

	<h3 class="has-large-font-size">Links</h3>
	<div class="ocds-tiles">
		<?php array_map( 'oc_demo_ds_tile', $oc_ds_links ); ?>
	</div>

	<h3 class="has-large-font-size">Every role on every ground</h3>
	<p class="ocds-intent has-text-body-color has-text-color">A dash marks a pair the rules do not use. The 7% primary tint is a section surface the rules allow; no shipped pattern uses it yet.</p>
	<div class="ocds-matrix-wrap">
		<table class="ocds-matrix has-small-font-size">
			<thead>
				<tr>
					<th scope="col">Ground</th>
					<?php foreach ( $oc_ds_roles as $oc_ds_role ) : ?>
						<th scope="col"><code><?php echo esc_html( $oc_ds_role[0] ); ?></code></th>
					<?php endforeach; ?>
				</tr>
			</thead>
			<tbody>
				<?php foreach ( $oc_ds_grounds as $oc_ds_ground ) : ?>
					<tr style="<?php echo esc_attr( '--ocds-ground:' . $oc_ds_ground[1] ); ?>">
						<th scope="row"><code><?php echo esc_html( $oc_ds_ground[0] ); ?></code></th>
						<?php
						foreach ( $oc_ds_roles as $oc_ds_role ) :
							$oc_ds_on   = in_array( $oc_ds_ground[2], $oc_ds_role[2], true );
							$oc_ds_cell = 'tint' === $oc_ds_ground[2] && 'primary' === $oc_ds_role[0] ? 'Never on a primary tint' : '';
							?>
							<td>
								<?php if ( $oc_ds_on ) : ?>
									<div class="ocds-cell" data-ocds-tile<?php echo $oc_ds_role[3] ? ' data-ocds-aa' : ''; ?>>
										<span class="ocds-cell-aa has-large-font-size" data-ocds-sample style="<?php echo esc_attr( 'color:' . $oc_ds_role[1] ); ?>">Aa</span>
										<span class="ocds-num<?php echo 'dark' === $oc_ds_ground[2] ? ' has-on-dark-color has-text-color' : ''; ?>" data-ocds-ratio></span>
									</div>
								<?php else : ?>
									<span class="<?php echo 'dark' === $oc_ds_ground[2] ? 'has-on-dark-color' : 'has-text-muted-color'; ?> has-text-color"><?php echo esc_html( $oc_ds_cell ? $oc_ds_cell : '—' ); ?></span>
								<?php endif; ?>
							</td>
						<?php endforeach; ?>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>

	<h3 class="has-large-font-size">In context</h3>
	<p class="ocds-intent has-text-body-color has-text-color">Three shipped patterns as they render: a white section, a section with surface-muted cards, and the dark stat band.</p>
	<div class="ocds-context">
		<?php
		foreach ( array(
			'features-grid'  => 'Eyebrow primary, heading text-heading, descriptions text-body.',
			'process-cards'  => 'Step numbers primary on surface-muted cards, titles text-heading, copy text-body.',
			'stat-band-dark' => 'Eyebrow and figures primary, heading on-dark, labels on-dark 65%.',
		) as $oc_ds_slug => $oc_ds_roles_text ) :
			?>
			<figure class="ocds-frame">
				<div class="ocds-frame-body">
					<?php echo do_blocks( '<!-- wp:pattern {"slug":"origin-canvas/' . $oc_ds_slug . '"} /-->' ); // phpcs:ignore WordPress.Security.EscapeOutput -- rendered theme pattern. ?>
				</div>
				<figcaption class="has-text-body-color has-text-color has-small-font-size"><code><?php echo esc_html( $oc_ds_slug ); ?></code> · <?php echo esc_html( $oc_ds_roles_text ); ?> <span class="has-text-muted-color has-text-color">patterns/<?php echo esc_html( $oc_ds_slug ); ?>.php</span></figcaption>
			</figure>
		<?php endforeach; ?>
	</div>

	<h3 class="has-large-font-size">Rules vs runtime</h3>
	<p class="ocds-intent has-text-body-color has-text-color">Where ODS <code>RULES.md</code> or the Canvas notes (<code>docs/design.md</code>, private) disagree with the shipped theme. Listed for a decision; nothing here changes the theme. File and line numbers are read from the active theme as the page renders.</p>
	<ol class="ocds-rvr has-text-body-color has-text-color">
		<li><strong>Secondary text on dark bands.</strong> The notes set it at on-dark 72%. Shipped: 72% in <?php echo esc_html( oc_demo_ds_uses_text( oc_demo_ds_uses( 'dark--text) 72%' ) ) ); ?>; 65% in <?php echo esc_html( oc_demo_ds_uses_text( oc_demo_ds_uses( 'dark--text) 65%' ) ) ); ?>; 62% in <?php echo esc_html( oc_demo_ds_uses_text( oc_demo_ds_uses( 'dark--text) 62%' ) ) ); ?>; 50% in <?php echo esc_html( oc_demo_ds_uses_text( oc_demo_ds_uses( 'dark--text) 50%' ) ) ); ?>.</li>
		<li><strong>The faded half of the dark stat band statement.</strong> RULES, "Light and dark" (Ruled, Oct 8): that faint second half is a defect, and each product fixes it with an existing token. Shipped: an inline <code>opacity:0.72</code> span in <?php echo esc_html( oc_demo_ds_block( 'stat-band-dark', array( 'contains' => 'opacity:' ) )['src'] ); ?>. It paints close to on-dark 72%, but by opacity, not a token; see its tile for the measured ratio.</li>
		<li><strong>A literal on-dark.</strong> RULES, "Roles, not values" (Provisional): components use tokens, never literal colors. Shipped: <code>rgba(243,244,246,0.72)</code> in <?php echo esc_html( oc_demo_ds_uses_text( oc_demo_ds_uses( 'rgba(243,244,246' ) ) ); ?>. Every palette's on-dark is #F3F4F6 today, so it paints the same; a variation that changes on-dark would leave these labels behind.</li>
		<li><strong>text-muted on a dark card.</strong> RULES, "Light and dark" (Ruled): a dark section's text is on-dark. Shipped: text-muted on the dark product card in <?php echo esc_html( oc_demo_ds_block( 'product-grid', array( 'textColor' => 'text-muted', 'ground' => $oc_ds_dark ) )['src'] ); ?>; see its tile under "On the dark band" for the measured ratio.</li>
		<li><strong>Sidebar links.</strong> RULES, "Links" (Ruled): all links rest at text-heading. Shipped: the sidebar's links rest at text-body (<?php echo esc_html( oc_demo_ds_src( 'patterns/hidden-sidebar.php', '"text":"var:preset|color|text-body"},":hover"' ) ); ?>). The notes record text-body for rail links, so the two documents disagree and the theme follows the notes.</li>
		<li><strong>The 7% primary tint.</strong> RULES, "Two primary tints are allowed" (Ruled): a 7% flat tint is a section surface on up to two sections per page. No shipped pattern uses it: pattern blocks that mix primary at 7%, <?php echo esc_html( oc_demo_ds_uses_text( oc_demo_ds_uses( 'primary) 7%' ) ) ); ?>. The matrix above paints it so the roles can be judged on it.</li>
	</ol>
</section>
