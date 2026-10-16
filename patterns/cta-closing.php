<?php
/**
 * Title: CTA Card Dark
 * Slug: origin-canvas/cta-closing
 * Description: A dark rounded card the width of the content, with an eyebrow, a large centered heading, a short lead and two buttons.
 * Categories: call-to-action
 * Keywords: conversion, download, inverted
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
<div class="wp-block-group alignwide has-text-color has-background" style="border-radius:var(--wp--custom--radius--large);color:var(--wp--custom--dark--text);background-color:var(--wp--custom--dark--bg);padding-top:var(--wp--preset--spacing--colossal);padding-right:var(--wp--preset--spacing--huge);padding-bottom:var(--wp--preset--spacing--colossal);padding-left:var(--wp--preset--spacing--huge)"><!-- wp:paragraph {"className":"origin-canvas-eyebrow","style":{"typography":{"textTransform":"uppercase","fontWeight":"600","letterSpacing":"0.06em","textAlign":"center"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|small"}}},"textColor":"primary","fontSize":"small"} -->
<p class="origin-canvas-eyebrow has-text-align-center has-primary-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--small);font-weight:600;letter-spacing:0.06em;text-transform:uppercase"><?php echo esc_html__( 'Ready when you are', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2,"align":"wide","style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"var(--wp--custom--dark--text)"},"typography":{"textAlign":"center"}},"fontSize":"display-xl"} -->
<h2 class="wp-block-heading has-text-align-center alignwide has-text-color has-display-xl-font-size" style="color:var(--wp--custom--dark--text);margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Start closer to finished.', 'origin-canvas' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|compact"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--compact)"><!-- wp:paragraph {"style":{"color":{"text":"color-mix(in srgb, var(--wp--custom--dark--text) 72%, transparent)"},"spacing":{"margin":{"top":"0","bottom":"0"}},"typography":{"textAlign":"center"}},"fontSize":"regular-plus"} -->
<p class="has-text-align-center has-text-color has-regular-plus-font-size" style="color:color-mix(in srgb, var(--wp--custom--dark--text) 72%, transparent);margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Install Origin Canvas, pick a style variation, drop in patterns. You will have a real site before you have second-guessed the font.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:buttons {"style":{"spacing":{"blockGap":"var:preset|spacing|medium","margin":{"top":"var:preset|spacing|extra-large"}}},"layout":{"type":"flex","justifyContent":"center","orientation":"horizontal"}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--extra-large)"><!-- wp:button {"className":"is-style-origin-canvas-fill-primary"} -->
<div class="wp-block-button is-style-origin-canvas-fill-primary"><a class="wp-block-button__link wp-element-button"><?php echo esc_html__( 'Download free', 'origin-canvas' ); ?></a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-origin-canvas-outline-light"} -->
<div class="wp-block-button is-style-origin-canvas-outline-light"><a class="wp-block-button__link wp-element-button"><?php echo esc_html__( 'View the live demo', 'origin-canvas' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
