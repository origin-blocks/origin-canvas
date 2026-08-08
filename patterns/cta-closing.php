<?php
/**
 * Title: Closing CTA
 * Slug: origin-canvas/cta-closing
 * Description: A dark closing call-to-action band for the end of the theme landing page.
 * Categories: call-to-action
 * Keywords: conversion, download, footer, final
 * Viewport Width: 1500
 * Block Types:
 * Post Types:
 * Inserter: true
 *
 * @package Origin
 */

?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"var:preset|spacing|colossal","bottom":"var:preset|spacing|colossal"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--colossal);padding-bottom:var(--wp--preset--spacing--colossal)"><!-- wp:group {"align":"wide","style":{"border":{"radius":"var:custom|radius|large"},"color":{"background":"var(--wp--custom--dark--bg)","text":"var(--wp--custom--dark--text)"},"spacing":{"padding":{"top":"var:preset|spacing|colossal","right":"var:preset|spacing|huge","bottom":"var:preset|spacing|colossal","left":"var:preset|spacing|huge"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide has-text-color has-background" style="border-radius:var(--wp--custom--radius--large);color:var(--wp--custom--dark--text);background-color:var(--wp--custom--dark--bg);padding-top:var(--wp--preset--spacing--colossal);padding-right:var(--wp--preset--spacing--huge);padding-bottom:var(--wp--preset--spacing--colossal);padding-left:var(--wp--preset--spacing--huge)"><!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","fontWeight":"600","letterSpacing":"0.08em"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|medium"}}},"textColor":"primary","fontSize":"small"} -->
<p class="has-text-align-center has-primary-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--medium);font-weight:600;letter-spacing:0.08em;text-transform:uppercase"><?php echo esc_html__( 'Ready when you are', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","level":2,"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|medium"}},"color":{"text":"var(--wp--custom--dark--text)"}},"fontSize":"display-xl"} -->
<h2 class="wp-block-heading has-text-align-center has-text-color has-display-xl-font-size" style="color:var(--wp--custom--dark--text);margin-top:0;margin-bottom:var(--wp--preset--spacing--medium)"><?php echo esc_html__( 'Start closer to finished.', 'origin-canvas' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:group {"layout":{"type":"constrained","contentSize":"640px"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"align":"center","style":{"color":{"text":"color-mix(in srgb, var(--wp--custom--dark--text) 72%, transparent)"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"fontSize":"regular-plus"} -->
<p class="has-text-align-center has-text-color has-regular-plus-font-size" style="color:color-mix(in srgb, var(--wp--custom--dark--text) 72%, transparent);margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Install Origin Canvas, pick a style variation, drop in patterns. You will have a real site before you have second-guessed the font.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:buttons {"style":{"spacing":{"blockGap":"var:preset|spacing|medium","margin":{"top":"var:preset|spacing|extra-large"}}},"layout":{"type":"flex","justifyContent":"center","orientation":"horizontal"}} -->
<div class="wp-block-buttons is-content-justification-center is-layout-flex" style="margin-top:var(--wp--preset--spacing--extra-large)"><!-- wp:button {"className":"is-style-origin-canvas-fill-primary"} -->
<div class="wp-block-button is-style-origin-canvas-fill-primary"><a class="wp-block-button__link wp-element-button"><?php echo esc_html__( 'Download free', 'origin-canvas' ); ?></a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-origin-canvas-outline-light"} -->
<div class="wp-block-button is-style-origin-canvas-outline-light"><a class="wp-block-button__link wp-element-button"><?php echo esc_html__( 'View the live demo', 'origin-canvas' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
