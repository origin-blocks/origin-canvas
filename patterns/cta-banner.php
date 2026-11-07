<?php
/**
 * Title: CTA Band Inline
 * Slug: origin-canvas/cta-banner
 * Description: A dark band with a large heading beside one button.
 * Categories: call-to-action
 * Keywords: conversion, prompt, strip
 * Viewport Width: 1500
 * Block Types:
 * Inserter: true
 *
 * @package Origin
 */

?>
<!-- wp:group {"tagName":"section","align":"full","style":{"color":{"background":"var(\u002d\u002dwp\u002d\u002dcustom\u002d\u002ddark\u002d\u002dbg)","text":"var(\u002d\u002dwp\u002d\u002dcustom\u002d\u002ddark\u002d\u002dtext)"},"spacing":{"padding":{"top":"var:preset|spacing|colossal","bottom":"var:preset|spacing|colossal"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-text-color has-background" style="color:var(--wp--custom--dark--text);background-color:var(--wp--custom--dark--bg);padding-top:var(--wp--preset--spacing--colossal);padding-bottom:var(--wp--preset--spacing--colossal)"><!-- wp:group {"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"center"}} -->
<div class="wp-block-group"><!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"var(\u002d\u002dwp\u002d\u002dcustom\u002d\u002ddark\u002d\u002dtext)"}},"fontSize":"huge"} -->
<h3 class="wp-block-heading has-text-color has-huge-font-size" style="color:var(--wp--custom--dark--text);margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Ready when you are', 'origin-canvas' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:buttons {"layout":{"type":"flex"}} -->
<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-origin-canvas-fill-primary"} -->
<div class="wp-block-button is-style-origin-canvas-fill-primary"><a class="wp-block-button__link wp-element-button"><?php echo esc_html__( 'Start a conversation', 'origin-canvas' ); ?> <span aria-hidden="true">→</span></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
