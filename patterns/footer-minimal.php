<?php
/**
 * Title: Footer Minimal
 * Slug: origin-canvas/footer-minimal
 * Description: A compact site footer with the site title, a navigation menu, and a legal row with copyright and social links.
 * Categories: footer
 * Keywords: simple, small, colophon, bottom, credits
 * Viewport Width: 1500
 * Block Types: core/template-part/footer
 * Post Types:
 * Inserter: true
 *
 * @package Origin
 */
?>
<!-- wp:group {"tagName":"footer","metadata":{"name":"Footer Minimal"},"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|huge","bottom":"var:preset|spacing|extra-large"},"blockGap":"var:preset|spacing|large"},"border":{"top":{"color":"var:preset|color|border","width":"1px"}}},"backgroundColor":"surface-muted","layout":{"inherit":true,"type":"constrained"}} -->
<footer class="wp-block-group alignfull has-surface-muted-background-color has-background" style="border-top-color:var(--wp--preset--color--border);border-top-width:1px;padding-top:var(--wp--preset--spacing--huge);padding-bottom:var(--wp--preset--spacing--extra-large)"><!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|extra-large","padding":{"bottom":"var:preset|spacing|large"}},"border":{"bottom":{"color":"var:preset|color|border","width":"1px"}}},"layout":{"type":"flex","justifyContent":"space-between","flexWrap":"wrap","verticalAlignment":"center"}} -->
<div class="wp-block-group alignwide" style="border-bottom-color:var(--wp--preset--color--border);border-bottom-width:1px;padding-bottom:var(--wp--preset--spacing--large)"><!-- wp:site-title {"level":0,"style":{"spacing":{"margin":{"bottom":"0px","top":"0px"}},"elements":{"link":{"color":{"text":"var:preset|color|text-heading"},":hover":{"color":{"text":"var:preset|color|primary"}}}}},"textColor":"text-heading"} /-->

<!-- wp:navigation {"overlayMenu":"never","textColor":"text-body","className":"is-style-origin-canvas-hover-accent","style":{"spacing":{"blockGap":"var:preset|spacing|large"},"typography":{"fontWeight":"500","fontStyle":"normal"}},"fontSize":"small","layout":{"type":"flex","justifyContent":"right","flexWrap":"wrap"}} /--></div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","className":"has-text-body-color has-text-color","style":{"spacing":{"padding":{"top":"0"}}}} -->
<div class="wp-block-group alignwide has-text-body-color has-text-color" style="padding-top:0"><!-- wp:group {"layout":{"type":"flex","justifyContent":"space-between","verticalAlignment":"center"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"textColor":"text-body","fontSize":"small"} -->
<p class="has-text-body-color has-text-color has-small-font-size"><?php echo esc_html__( '&copy; 2026. Built with care.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->
<!-- wp:social-links {"iconColor":"text-body","size":"has-normal-icon-size","className":"has-icon-color is-style-logos-only","style":{"spacing":{"margin":{"right":"0","left":"0"}}},"layout":{"type":"flex","justifyContent":"right"}} -->
<ul class="wp-block-social-links has-normal-icon-size has-icon-color is-style-logos-only" style="margin-right:0;margin-left:0"><!-- wp:social-link {"url":"#","service":"x"} /-->
<!-- wp:social-link {"url":"#","service":"github"} /-->
<!-- wp:social-link {"url":"#","service":"linkedin"} /--></ul>
<!-- /wp:social-links --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></footer>
<!-- /wp:group -->
