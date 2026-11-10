<?php
/**
 * Title: CTA Band Dark
 * Slug: origin-canvas/cta-band-dark
 * Description: A dark band with an availability line, a centered heading, a short lead and two buttons.
 * Categories: call-to-action
 * Keywords: conversion, inverted, booking, slot
 * Viewport Width: 1500
 * Block Types:
 * Post Types:
 * Inserter: true
 *
 * @package Origin
 */

?>
<!-- wp:group {"tagName":"section","align":"full","style":{"color":{"background":"var(\u002d\u002dwp\u002d\u002dcustom\u002d\u002ddark\u002d\u002dbg)","text":"var(\u002d\u002dwp\u002d\u002dcustom\u002d\u002ddark\u002d\u002dtext)"},"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"var:preset|spacing|colossal","bottom":"var:preset|spacing|colossal"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-text-color has-background" style="color:var(--wp--custom--dark--text);background-color:var(--wp--custom--dark--bg);margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--colossal);padding-bottom:var(--wp--preset--spacing--colossal)"><!-- wp:paragraph {"className":"origin-canvas-eyebrow","style":{"typography":{"textTransform":"uppercase","fontWeight":"600","letterSpacing":"0.06em","textAlign":"center"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|medium"}}},"textColor":"primary","fontSize":"extra-small"} -->
<p class="has-text-align-center origin-canvas-eyebrow has-primary-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--medium);font-weight:600;letter-spacing:0.06em;text-transform:uppercase"><?php echo esc_html__( 'One slot open', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"align":"wide","className":"origin-canvas-text-balance","style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"var(\u002d\u002dwp\u002d\u002dcustom\u002d\u002ddark\u002d\u002dtext)"},"typography":{"textAlign":"center"}},"fontSize":"display"} -->
<h2 class="wp-block-heading has-text-align-center alignwide origin-canvas-text-balance has-text-color has-display-font-size" style="color:var(--wp--custom--dark--text);margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Your project could be next on our desk.', 'origin-canvas' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|small-medium"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--small-medium)"><!-- wp:paragraph {"style":{"color":{"text":"color-mix(in srgb, var(\u002d\u002dwp\u002d\u002dcustom\u002d\u002ddark\u002d\u002dtext) 72%, transparent)"},"spacing":{"margin":{"top":"0","bottom":"0"}},"typography":{"textAlign":"center"}},"fontSize":"regular-plus"} -->
<p class="has-text-align-center has-text-color has-regular-plus-font-size" style="color:color-mix(in srgb, var(--wp--custom--dark--text) 72%, transparent);margin-top:0;margin-bottom:0"><?php echo esc_html__( 'A 20-minute call is the fastest way to find out if we fit.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:buttons {"style":{"spacing":{"blockGap":"var:preset|spacing|small-medium","margin":{"top":"var:preset|spacing|large"}}},"layout":{"type":"flex","justifyContent":"center","orientation":"horizontal"}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--large)"><!-- wp:button {"backgroundColor":"base-2","textColor":"contrast"} -->
<div class="wp-block-button"><a class="wp-block-button__link has-contrast-color has-base-2-background-color has-text-color has-background wp-element-button" href="#"><?php echo esc_html__( 'Book a 20-minute call', 'origin-canvas' ); ?></a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-origin-canvas-outline-light"} -->
<div class="wp-block-button is-style-origin-canvas-outline-light"><a class="wp-block-button__link wp-element-button" href="#"><?php echo esc_html__( 'See how we work', 'origin-canvas' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></section>
<!-- /wp:group -->
