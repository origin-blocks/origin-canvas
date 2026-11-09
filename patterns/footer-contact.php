<?php
/**
 * Title: Footer With Contact Details
 * Slug: origin-canvas/footer-contact
 * Description: A footer with the site title and social links, then the address, phone, email and opening hours as four labelled cells, and a copyright line with a privacy policy link.
 * Categories: footer
 * Keywords: location, visit, office, directions, reach, local
 * Viewport Width: 1500
 * Block Types: core/template-part/footer
 * Post Types:
 * Inserter: true
 *
 * @package Origin
 */
?>
<!-- wp:group {"tagName":"footer","metadata":{"name":"Footer"},"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|colossal","bottom":"var:preset|spacing|colossal"}},"border":{"top":{"color":"var:preset|color|base-5","width":"1px"}}},"backgroundColor":"base","layout":{"inherit":true,"type":"constrained"}} -->
<footer class="wp-block-group alignfull has-base-background-color has-background" style="border-top-color:var(--wp--preset--color--base-5);border-top-width:1px;padding-top:var(--wp--preset--spacing--colossal);padding-bottom:var(--wp--preset--spacing--colossal)"><!-- wp:group {"align":"wide","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"center"}} -->
<div class="wp-block-group alignwide"><!-- wp:site-title {"level":0,"style":{"spacing":{"margin":{"bottom":"0px","top":"0px"}},"elements":{"link":{"color":{"text":"var:preset|color|contrast"},":hover":{"color":{"text":"var:preset|color|primary"}}}}},"textColor":"contrast"} /-->

<!-- wp:social-links {"iconColor":"contrast-2","size":"has-normal-icon-size","className":"has-icon-color is-style-logos-only","style":{"spacing":{"margin":{"right":"0","left":"0"}}},"layout":{"type":"flex","justifyContent":"right"}} -->
<ul class="wp-block-social-links has-normal-icon-size has-icon-color is-style-logos-only" style="margin-right:0;margin-left:0"><!-- wp:social-link {"url":"#","service":"x"} /-->

<!-- wp:social-link {"url":"#","service":"github"} /-->

<!-- wp:social-link {"url":"#","service":"linkedin"} /--></ul>
<!-- /wp:social-links --></div>
<!-- /wp:group -->

<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|large","left":"var:preset|spacing|large"},"margin":{"top":"var:preset|spacing|huge"}}}} -->
<div class="wp-block-columns alignwide" style="margin-top:var(--wp--preset--spacing--huge)"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","fontWeight":"600","letterSpacing":"0.06em"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|small"}}},"textColor":"contrast-3","fontSize":"extra-small"} -->
<p class="has-contrast-3-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--small);font-weight:600;letter-spacing:0.06em;text-transform:uppercase"><?php echo esc_html__( 'Address', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:separator {"tagName":"div","className":"is-style-wide","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"base-5"} -->
<div class="wp-block-separator has-text-color has-base-5-color has-alpha-channel-opacity has-base-5-background-color has-background is-style-wide" style="margin-top:0;margin-bottom:0"></div>
<!-- /wp:separator -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|medium","bottom":"0"}}},"textColor":"contrast-2","fontSize":"small"} -->
<p class="has-contrast-2-color has-text-color has-small-font-size" style="margin-top:var(--wp--preset--spacing--medium);margin-bottom:0"><?php echo esc_html__( '214 Cedar Street, Nashville,&nbsp;TN&nbsp;37203', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","fontWeight":"600","letterSpacing":"0.06em"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|small"}}},"textColor":"contrast-3","fontSize":"extra-small"} -->
<p class="has-contrast-3-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--small);font-weight:600;letter-spacing:0.06em;text-transform:uppercase"><?php echo esc_html__( 'Phone', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:separator {"tagName":"div","className":"is-style-wide","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"base-5"} -->
<div class="wp-block-separator has-text-color has-base-5-color has-alpha-channel-opacity has-base-5-background-color has-background is-style-wide" style="margin-top:0;margin-bottom:0"></div>
<!-- /wp:separator -->

<!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|contrast-2"},":hover":{"color":{"text":"var:preset|color|primary"}},"typography":{"textDecoration":"none"}}},"spacing":{"margin":{"top":"var:preset|spacing|medium","bottom":"0"}}},"textColor":"contrast-2","fontSize":"small"} -->
<p class="has-contrast-2-color has-text-color has-link-color has-small-font-size" style="margin-top:var(--wp--preset--spacing--medium);margin-bottom:0"><a href="tel:+16155550142"><?php echo esc_html__( '(615) 555-0142', 'origin-canvas' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","fontWeight":"600","letterSpacing":"0.06em"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|small"}}},"textColor":"contrast-3","fontSize":"extra-small"} -->
<p class="has-contrast-3-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--small);font-weight:600;letter-spacing:0.06em;text-transform:uppercase"><?php echo esc_html__( 'Email', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:separator {"tagName":"div","className":"is-style-wide","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"base-5"} -->
<div class="wp-block-separator has-text-color has-base-5-color has-alpha-channel-opacity has-base-5-background-color has-background is-style-wide" style="margin-top:0;margin-bottom:0"></div>
<!-- /wp:separator -->

<!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|contrast-2"},":hover":{"color":{"text":"var:preset|color|primary"}},"typography":{"textDecoration":"none"}}},"spacing":{"margin":{"top":"var:preset|spacing|medium","bottom":"0"}}},"textColor":"contrast-2","fontSize":"small"} -->
<p class="has-contrast-2-color has-text-color has-link-color has-small-font-size" style="margin-top:var(--wp--preset--spacing--medium);margin-bottom:0"><a href="mailto:hello@example.com"><?php echo esc_html__( 'hello@example.com', 'origin-canvas' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","fontWeight":"600","letterSpacing":"0.06em"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|small"}}},"textColor":"contrast-3","fontSize":"extra-small"} -->
<p class="has-contrast-3-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--small);font-weight:600;letter-spacing:0.06em;text-transform:uppercase"><?php echo esc_html__( 'Hours', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:separator {"tagName":"div","className":"is-style-wide","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"base-5"} -->
<div class="wp-block-separator has-text-color has-base-5-color has-alpha-channel-opacity has-base-5-background-color has-background is-style-wide" style="margin-top:0;margin-bottom:0"></div>
<!-- /wp:separator -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|medium","bottom":"0"}}},"textColor":"contrast-2","fontSize":"small"} -->
<p class="has-contrast-2-color has-text-color has-small-font-size" style="margin-top:var(--wp--preset--spacing--medium);margin-bottom:0"><?php echo esc_html__( 'Monday to Friday, 9am&nbsp;to&nbsp;5:30pm', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:group {"align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|colossal"}}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"center"}} -->
<div class="wp-block-group alignwide" style="margin-top:var(--wp--preset--spacing--colossal)"><!-- wp:paragraph {"textColor":"contrast-2","fontSize":"small"} -->
<p class="has-contrast-2-color has-text-color has-small-font-size"><?php echo esc_html__( '&copy; 2026. All rights reserved.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|contrast-2"},"typography":{"textDecoration":"none"},":hover":{"color":{"text":"var:preset|color|contrast"},"typography":{"textDecoration":"none"}}}}},"textColor":"contrast-2","fontSize":"small"} -->
<p class="has-contrast-2-color has-text-color has-link-color has-small-font-size"><a href="#"><?php echo esc_html__( 'Privacy policy', 'origin-canvas' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></footer>
<!-- /wp:group -->
