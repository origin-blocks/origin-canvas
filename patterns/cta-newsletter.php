<?php
/**
 * Title: CTA Newsletter
 * Slug: origin/cta-newsletter
 * Categories: call-to-action
 * Keywords: cta, call to action, newsletter, email, subscribe, signup, conversion
 * Block Types: core/post-content
 * Inserter: true
 *
 * Note: The "email input" is a styled paragraph placeholder for visual layout only.
 * Hook in a real form plugin (e.g. MailPoet, ConvertKit, Newsletter Glue) for actual
 * subscription handling.
 *
 * @package Origin
 */

?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|jumbo","bottom":"var:preset|spacing|jumbo"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--jumbo);padding-bottom:var(--wp--preset--spacing--jumbo)"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|large"}},"layout":{"type":"constrained","contentSize":"640px"}} -->
<div class="wp-block-group"><!-- wp:heading {"textAlign":"center","level":2,"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<h2 class="wp-block-heading has-text-align-center" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Studio notes, four times a year', 'origin' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","textColor":"text-body","fontSize":"regular-plus"} -->
<p class="has-text-align-center has-text-body-color has-text-color has-regular-plus-font-size"><?php echo esc_html__( 'One letter at the end of every quarter. Honest write-ups of what we made, what we learned, and what we&#8217;d change. No spam, no upsells.', 'origin' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"margin":{"top":"var:preset|spacing|medium"}}}} -->
<div class="wp-block-columns are-vertically-aligned-center" style="margin-top:var(--wp--preset--spacing--medium)"><!-- wp:column {"verticalAlignment":"center","width":"66.66%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:66.66%"><!-- wp:paragraph {"style":{"border":{"radius":"999px","style":"solid","width":"2px"},"spacing":{"padding":{"top":"var:preset|spacing|compact","bottom":"var:preset|spacing|compact","left":"var:preset|spacing|extra-large","right":"var:preset|spacing|extra-large"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"surface-base","borderColor":"input-border","textColor":"text-muted","fontSize":"regular"} -->
<p class="has-border-color has-input-border-border-color has-text-muted-color has-surface-base-background-color has-text-color has-background has-regular-font-size" style="border-style:solid;border-width:2px;border-radius:999px;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--compact);padding-right:var(--wp--preset--spacing--extra-large);padding-bottom:var(--wp--preset--spacing--compact);padding-left:var(--wp--preset--spacing--extra-large)"><?php echo esc_html__( 'you@yourbusiness.com', 'origin' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"33.33%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:33.33%"><!-- wp:buttons {"layout":{"type":"flex","justifyContent":"left"}} -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button"><?php echo esc_html__( 'Subscribe', 'origin' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:paragraph {"align":"center","textColor":"text-muted","fontSize":"small"} -->
<p class="has-text-align-center has-text-muted-color has-text-color has-small-font-size"><?php printf(
	/* translators: %s: link to the privacy policy */
	esc_html__( 'We care about your data. Read our %s.', 'origin' ),
	'<a href="#">' . esc_html__( 'Privacy Policy', 'origin' ) . '</a>'
); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
