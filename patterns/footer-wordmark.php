<?php
/**
 * Title: Footer Oversized Title
 * Slug: origin-canvas/footer-wordmark
 * Description: A footer for a business that wants its name to stay with the visitor: a short menu, one large sentence about the business, a copyright line with a privacy policy link, and the site title filling the width on one line in a pale tint, cropped by the footer's edge, on a light background with a thin gray rule.
 * Categories: footer
 * Keywords: brand, logo, watermark, giant, signature, statement
 * Viewport Width: 1500
 * Block Types: core/template-part/footer
 * Post Types:
 * Inserter: true
 *
 * @package Origin
 */
?>
<!-- wp:group {"tagName":"footer","align":"full","className":"origin-canvas-footer-wordmark has-base-background-color","style":{"spacing":{"padding":{"top":"var:preset|spacing|colossal","bottom":"0"},"margin":{"top":"0","bottom":"0"},"blockGap":"0"},"border":{"top":{"color":"var:preset|color|base-5","width":"1px"}},"color":{"gradient":"linear-gradient(180deg, color-mix(in srgb, var(\u002d\u002dwp\u002d\u002dpreset\u002d\u002dcolor\u002d\u002dcontrast) 0%, transparent) 0%, color-mix(in srgb, var(\u002d\u002dwp\u002d\u002dpreset\u002d\u002dcolor\u002d\u002dcontrast) 5%, transparent) 100%)"}},"backgroundColor":"base","textColor":"contrast","layout":{"type":"constrained"}} -->
<footer class="wp-block-group alignfull origin-canvas-footer-wordmark has-base-background-color has-contrast-color has-text-color has-background" style="border-top-color:var(--wp--preset--color--base-5);border-top-width:1px;background:linear-gradient(180deg, color-mix(in srgb, var(--wp--preset--color--contrast) 0%, transparent) 0%, color-mix(in srgb, var(--wp--preset--color--contrast) 5%, transparent) 100%);margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--colossal);padding-bottom:0"><!-- wp:columns {"align":"wide"} -->
<div class="wp-block-columns alignwide"><!-- wp:column {"width":"33.33%"} -->
<div class="wp-block-column" style="flex-basis:33.33%"><!-- wp:navigation {"textColor":"contrast","overlayMenu":"never","className":"is-style-origin-canvas-hover-accent","style":{"spacing":{"blockGap":"var:preset|spacing|small-medium"},"@mobile":{"spacing":{"blockGap":"var:preset|spacing|medium"},"layout":{"orientation":"horizontal"}}},"fontSize":"small","layout":{"type":"flex","orientation":"vertical","flexWrap":"wrap"}} /--></div>
<!-- /wp:column -->

<!-- wp:column {"width":"66.66%"} -->
<div class="wp-block-column" style="flex-basis:66.66%"><!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"typography":{"fontWeight":"600","lineHeight":"var(\u002d\u002dwp\u002d\u002dcustom\u002d\u002dline-height\u002d\u002dsnug)"}},"textColor":"contrast","fontSize":"large"} -->
<p class="has-contrast-color has-text-color has-large-font-size" style="margin-top:0;margin-bottom:0;font-weight:600;line-height:var(--wp--custom--line-height--snug)"><?php echo esc_html__( 'A brand and web studio for small businesses. We design the identity, write the words and build the site ourselves.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:group {"align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|huge","bottom":"var:preset|spacing|huge"},"blockGap":"var:preset|spacing|small"}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"center"}} -->
<div class="wp-block-group alignwide" style="margin-top:var(--wp--preset--spacing--huge);margin-bottom:var(--wp--preset--spacing--huge)"><!-- wp:paragraph {"textColor":"contrast-2","fontSize":"small"} -->
<p class="has-contrast-2-color has-text-color has-small-font-size"><?php echo esc_html__( '&copy; 2026. All rights reserved.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|contrast-2"},"typography":{"textDecoration":"none"},":hover":{"color":{"text":"var:preset|color|contrast"},"typography":{"textDecoration":"none"}}}}},"textColor":"contrast-2","fontSize":"small"} -->
<p class="has-contrast-2-color has-text-color has-link-color has-small-font-size"><a href="#"><?php echo esc_html__( 'Privacy policy', 'origin-canvas' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:site-title {"level":0,"isLink":false,"align":"full","style":{"color":{"text":"color-mix(in srgb, var(\u002d\u002dwp\u002d\u002dpreset\u002d\u002dcolor\u002d\u002dcontrast) 5%, transparent)"},"typography":{"fontWeight":"600","lineHeight":"1","letterSpacing":"var(\u002d\u002dwp\u002d\u002dcustom\u002d\u002dletter-spacing\u002d\u002ddisplay)"},"spacing":{"margin":{"top":"0.12em","bottom":"-0.25em"}}},"fitText":true} /--></footer>
<!-- /wp:group -->
