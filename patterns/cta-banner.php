<?php
/**
 * Title: CTA Banner
 * Slug: origin-canvas/cta-banner
 * Categories: call-to-action
 * Keywords: cta, call to action, banner, dark, single row, conversion
 * Block Types: core/post-content
 * Inserter: true
 *
 * @package Origin
 */

?>
<!-- wp:group {"tagName":"section","align":"full","style":{"color":{"background":"#111827","text":"#F3F4F6"},"spacing":{"padding":{"top":"var:preset|spacing|colossal","bottom":"var:preset|spacing|colossal"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-text-color has-background" style="color:#F3F4F6;background-color:#111827;padding-top:var(--wp--preset--spacing--colossal);padding-bottom:var(--wp--preset--spacing--colossal)"><!-- wp:group {"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"center"}} -->
<div class="wp-block-group"><!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#F3F4F6"}}} -->
<h3 class="wp-block-heading has-text-color" style="margin-top:0;margin-bottom:0;color:#F3F4F6"><?php echo esc_html__( 'Have a project in mind?', 'origin-canvas' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:buttons {"layout":{"type":"flex"}} -->
<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-origin-canvas-fill-primary"} -->
<div class="wp-block-button is-style-origin-canvas-fill-primary"><a class="wp-block-button__link wp-element-button"><?php echo esc_html__( 'Start a conversation', 'origin-canvas' ); ?> <span aria-hidden="true">&rarr;</span></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
