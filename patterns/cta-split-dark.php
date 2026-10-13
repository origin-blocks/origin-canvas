<?php
/**
 * Title: Dark CTA Split
 * Slug: origin-canvas/cta-split-dark
 * Description: A full-width dark section with an availability line, a heading and a short lead beside two buttons; the buttons move under the text on narrower screens.
 * Categories: call-to-action
 * Keywords: conversion, booking, inverted, side by side, two buttons
 * Viewport Width: 1500
 * Block Types:
 * Post Types:
 * Inserter: true
 *
 * @package Origin
 */

?>
<!-- wp:group {"tagName":"section","align":"full","style":{"color":{"background":"var(--wp--custom--dark--bg)","text":"var(--wp--custom--dark--text)"},"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"var:preset|spacing|colossal","bottom":"var:preset|spacing|colossal"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-text-color has-background" style="color:var(--wp--custom--dark--text);background-color:var(--wp--custom--dark--bg);margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--colossal);padding-bottom:var(--wp--preset--spacing--colossal)"><!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|large"}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"center"}} -->
<div class="wp-block-group alignwide"><!-- wp:group {"style":{"layout":{"selfStretch":"fixed","flexSize":"40rem"}},"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"className":"origin-canvas-eyebrow","style":{"typography":{"textTransform":"uppercase","fontWeight":"600","letterSpacing":"0.06em"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|medium"}}},"textColor":"primary","fontSize":"extra-small"} -->
<p class="origin-canvas-eyebrow has-primary-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--medium);font-weight:600;letter-spacing:0.06em;text-transform:uppercase"><?php echo esc_html__( 'One slot open', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2,"className":"origin-canvas-text-balance","style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"var(--wp--custom--dark--text)"}},"fontSize":"display"} -->
<h2 class="wp-block-heading origin-canvas-text-balance has-text-color has-display-font-size" style="color:var(--wp--custom--dark--text);margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Your project could be next on our desk.', 'origin-canvas' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"color":{"text":"color-mix(in srgb, var(--wp--custom--dark--text) 72%, transparent)"},"spacing":{"margin":{"top":"var:preset|spacing|compact","bottom":"0"}}},"fontSize":"regular-plus"} -->
<p class="has-text-color has-regular-plus-font-size" style="color:color-mix(in srgb, var(--wp--custom--dark--text) 72%, transparent);margin-top:var(--wp--preset--spacing--compact);margin-bottom:0"><?php echo esc_html__( 'A 20-minute call is the fastest way to find out if we fit.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:buttons {"style":{"spacing":{"blockGap":"var:preset|spacing|compact"}},"layout":{"type":"flex","orientation":"horizontal"}} -->
<div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"on-dark","textColor":"text-heading","url":"#"} -->
<div class="wp-block-button"><a class="wp-block-button__link has-text-heading-color has-on-dark-background-color has-text-color has-background wp-element-button" href="#"><?php echo esc_html__( 'Book a 20-minute call', 'origin-canvas' ); ?></a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-origin-canvas-outline-light","url":"#"} -->
<div class="wp-block-button is-style-origin-canvas-outline-light"><a class="wp-block-button__link wp-element-button" href="#"><?php echo esc_html__( 'See how we work', 'origin-canvas' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
