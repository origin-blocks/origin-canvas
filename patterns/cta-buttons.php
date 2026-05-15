<?php
/**
 * Title: CTA Buttons
 * Slug: origin-canvas/cta-buttons
 * Categories: call-to-action
 * Keywords: cta, call to action, buttons, centered, conversion
 * Block Types: core/post-content
 * Inserter: true
 *
 * @package Origin
 */

?>
<!-- wp:group {"tagName":"section","align":"full","backgroundColor":"surface-muted","style":{"spacing":{"padding":{"top":"var:preset|spacing|jumbo","bottom":"var:preset|spacing|jumbo"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-surface-muted-background-color has-background" style="padding-top:var(--wp--preset--spacing--jumbo);padding-bottom:var(--wp--preset--spacing--jumbo)"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|large"}},"layout":{"type":"constrained","contentSize":"720px"}} -->
<div class="wp-block-group"><!-- wp:heading {"textAlign":"center","level":2,"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<h2 class="wp-block-heading has-text-align-center" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Ready when you are', 'origin-canvas' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","textColor":"text-body","fontSize":"regular-plus"} -->
<p class="has-text-align-center has-text-body-color has-text-color has-regular-plus-font-size"><?php echo esc_html__( 'A short conversation tells us most of what we need to know. No pitch decks, no fee until we agree on scope.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"blockGap":"var:preset|spacing|compact","margin":{"top":"var:preset|spacing|extra-large"}}},"layout":{"type":"flex","justifyContent":"center","orientation":"horizontal"}} -->
<div class="wp-block-buttons is-content-justification-center is-layout-flex" style="margin-top:var(--wp--preset--spacing--extra-large)"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button"><?php echo esc_html__( 'Email us', 'origin-canvas' ); ?></a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-outline-strong"} -->
<div class="wp-block-button is-style-outline-strong"><a class="wp-block-button__link wp-element-button"><?php echo esc_html__( 'Book a call', 'origin-canvas' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
