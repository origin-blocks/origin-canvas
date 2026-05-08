<?php
/**
 * Title: CTA Card
 * Slug: origin/cta-card
 * Categories: call-to-action
 * Keywords: cta, call to action, card, centered, surface, conversion
 * Block Types: core/post-content
 * Inserter: true
 *
 * @package Origin
 */

?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|jumbo","bottom":"var:preset|spacing|jumbo"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--jumbo);padding-bottom:var(--wp--preset--spacing--jumbo)"><!-- wp:group {"backgroundColor":"surface-muted","style":{"border":{"radius":"var:custom|radius|medium"},"shadow":"var:preset|shadow|small","spacing":{"padding":{"top":"var:preset|spacing|jumbo","right":"var:preset|spacing|jumbo","bottom":"var:preset|spacing|jumbo","left":"var:preset|spacing|jumbo"},"blockGap":"var:preset|spacing|large"}},"layout":{"type":"constrained","contentSize":"640px"}} -->
<div class="wp-block-group has-surface-muted-background-color has-background" style="border-radius:var(--wp--custom--radius--medium);padding-top:var(--wp--preset--spacing--jumbo);padding-right:var(--wp--preset--spacing--jumbo);padding-bottom:var(--wp--preset--spacing--jumbo);padding-left:var(--wp--preset--spacing--jumbo);box-shadow:var(--wp--preset--shadow--small)"><!-- wp:heading {"textAlign":"center","level":2,"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<h2 class="wp-block-heading has-text-align-center" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Built around a single project a month', 'origin' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","textColor":"text-body","fontSize":"regular-plus"} -->
<p class="has-text-align-center has-text-body-color has-text-color has-regular-plus-font-size"><?php echo esc_html__( 'We keep our roster small so the work in front of us gets the attention it needs. If we&#8217;re a fit, we&#8217;ll tell you on the first call.', 'origin' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|medium"}}},"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons is-content-justification-center is-layout-flex" style="margin-top:var(--wp--preset--spacing--medium)"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button"><?php echo esc_html__( 'Start a conversation', 'origin' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
