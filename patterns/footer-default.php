<?php
/**
 * Title: Footer
 * Slug: origin-canvas/footer-default
 * Description: A footer with the site title and a short line, three groups of links spread across the width, and a copyright line with social icons.
 * Categories: footer
 * Keywords:
 * Viewport Width: 1500
 * Block Types: core/template-part/footer
 * Post Types:
 * Inserter: true
 *
 * @package Origin
 */
?>
<!-- wp:group {"tagName":"footer","metadata":{"name":"Footer"},"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|colossal","bottom":"var:preset|spacing|colossal"}},"border":{"top":{"color":"var:preset|color|border","width":"1px"}}},"backgroundColor":"surface-base","layout":{"inherit":true,"type":"constrained"}} -->
<footer class="wp-block-group alignfull has-surface-base-background-color has-background" style="border-top-color:var(--wp--preset--color--border);border-top-width:1px;padding-top:var(--wp--preset--spacing--colossal);padding-bottom:var(--wp--preset--spacing--colossal)"><!-- wp:group {"align":"wide","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"top"}} -->
<div class="wp-block-group alignwide"><!-- wp:group {"className":"stack-16","layout":{"type":"default"}} -->
<div class="wp-block-group stack-16"><!-- wp:site-title {"level":0,"style":{"spacing":{"margin":{"bottom":"0px","top":"0px"}},"elements":{"link":{"color":{"text":"var:preset|color|text-heading"},":hover":{"color":{"text":"var:preset|color|primary"}}}}},"textColor":"text-heading"} /-->
<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|small"}}},"textColor":"text-body","fontSize":"small"} -->
<p class="has-text-body-color has-text-color has-small-font-size" style="margin-top:var(--wp--preset--spacing--small)"><?php echo esc_html__( 'Brand and web work that brings in customers.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --><!-- wp:group {"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"className":"has-text-heading-color","style":{"typography":{"fontStyle":"normal","fontWeight":"600"},"spacing":{"margin":{"bottom":"var:preset|spacing|small"}}},"textColor":"text-heading","fontSize":"regular"} -->
<p class="has-text-heading-color has-text-color has-regular-font-size" style="margin-bottom:var(--wp--preset--spacing--small);font-style:normal;font-weight:600"><?php echo esc_html__( 'Studio', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->
<!-- wp:group {"className":"has-small-font-size","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-small-font-size"><!-- wp:paragraph {"textColor":"text-body","style":{"elements":{"link":{"color":{"text":"var:preset|color|text-body"},"typography":{"textDecoration":"none"},":hover":{"color":{"text":"var:preset|color|primary"}}}}}} -->
<p class="has-text-body-color has-text-color has-link-color"><a href="#"><?php echo esc_html__( 'Work', 'origin-canvas' ); ?></a></p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"textColor":"text-body","style":{"elements":{"link":{"color":{"text":"var:preset|color|text-body"},"typography":{"textDecoration":"none"},":hover":{"color":{"text":"var:preset|color|primary"}}}}}} -->
<p class="has-text-body-color has-text-color has-link-color"><a href="#"><?php echo esc_html__( 'Process', 'origin-canvas' ); ?></a></p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"textColor":"text-body","style":{"elements":{"link":{"color":{"text":"var:preset|color|text-body"},"typography":{"textDecoration":"none"},":hover":{"color":{"text":"var:preset|color|primary"}}}}}} -->
<p class="has-text-body-color has-text-color has-link-color"><a href="#"><?php echo esc_html__( 'Pricing', 'origin-canvas' ); ?></a></p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"textColor":"text-body","style":{"elements":{"link":{"color":{"text":"var:preset|color|text-body"},"typography":{"textDecoration":"none"},":hover":{"color":{"text":"var:preset|color|primary"}}}}}} -->
<p class="has-text-body-color has-text-color has-link-color"><a href="#"><?php echo esc_html__( 'Get in touch', 'origin-canvas' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --><!-- wp:group {"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"className":"has-text-heading-color","style":{"typography":{"fontStyle":"normal","fontWeight":"600"},"spacing":{"margin":{"bottom":"var:preset|spacing|small"}}},"textColor":"text-heading","fontSize":"regular"} -->
<p class="has-text-heading-color has-text-color has-regular-font-size" style="margin-bottom:var(--wp--preset--spacing--small);font-style:normal;font-weight:600"><?php echo esc_html__( 'Services', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->
<!-- wp:group {"className":"has-small-font-size","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-small-font-size"><!-- wp:paragraph {"textColor":"text-body","style":{"elements":{"link":{"color":{"text":"var:preset|color|text-body"},"typography":{"textDecoration":"none"},":hover":{"color":{"text":"var:preset|color|primary"}}}}}} -->
<p class="has-text-body-color has-text-color has-link-color"><a href="#"><?php echo esc_html__( 'Brand identity', 'origin-canvas' ); ?></a></p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"textColor":"text-body","style":{"elements":{"link":{"color":{"text":"var:preset|color|text-body"},"typography":{"textDecoration":"none"},":hover":{"color":{"text":"var:preset|color|primary"}}}}}} -->
<p class="has-text-body-color has-text-color has-link-color"><a href="#"><?php echo esc_html__( 'Websites', 'origin-canvas' ); ?></a></p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"textColor":"text-body","style":{"elements":{"link":{"color":{"text":"var:preset|color|text-body"},"typography":{"textDecoration":"none"},":hover":{"color":{"text":"var:preset|color|primary"}}}}}} -->
<p class="has-text-body-color has-text-color has-link-color"><a href="#"><?php echo esc_html__( 'Copywriting', 'origin-canvas' ); ?></a></p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"textColor":"text-body","style":{"elements":{"link":{"color":{"text":"var:preset|color|text-body"},"typography":{"textDecoration":"none"},":hover":{"color":{"text":"var:preset|color|primary"}}}}}} -->
<p class="has-text-body-color has-text-color has-link-color"><a href="#"><?php echo esc_html__( 'Site refreshes', 'origin-canvas' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --><!-- wp:group {"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"className":"has-text-heading-color","style":{"typography":{"fontStyle":"normal","fontWeight":"600"},"spacing":{"margin":{"bottom":"var:preset|spacing|small"}}},"textColor":"text-heading","fontSize":"regular"} -->
<p class="has-text-heading-color has-text-color has-regular-font-size" style="margin-bottom:var(--wp--preset--spacing--small);font-style:normal;font-weight:600"><?php echo esc_html__( 'Company', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->
<!-- wp:group {"className":"has-small-font-size","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-small-font-size"><!-- wp:paragraph {"textColor":"text-body","style":{"elements":{"link":{"color":{"text":"var:preset|color|text-body"},"typography":{"textDecoration":"none"},":hover":{"color":{"text":"var:preset|color|primary"}}}}}} -->
<p class="has-text-body-color has-text-color has-link-color"><a href="#"><?php echo esc_html__( 'About', 'origin-canvas' ); ?></a></p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"textColor":"text-body","style":{"elements":{"link":{"color":{"text":"var:preset|color|text-body"},"typography":{"textDecoration":"none"},":hover":{"color":{"text":"var:preset|color|primary"}}}}}} -->
<p class="has-text-body-color has-text-color has-link-color"><a href="#"><?php echo esc_html__( 'Journal', 'origin-canvas' ); ?></a></p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"textColor":"text-body","style":{"elements":{"link":{"color":{"text":"var:preset|color|text-body"},"typography":{"textDecoration":"none"},":hover":{"color":{"text":"var:preset|color|primary"}}}}}} -->
<p class="has-text-body-color has-text-color has-link-color"><a href="#"><?php echo esc_html__( 'Careers', 'origin-canvas' ); ?></a></p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"textColor":"text-body","style":{"elements":{"link":{"color":{"text":"var:preset|color|text-body"},"typography":{"textDecoration":"none"},":hover":{"color":{"text":"var:preset|color|primary"}}}}}} -->
<p class="has-text-body-color has-text-color has-link-color"><a href="#"><?php echo esc_html__( 'Privacy policy', 'origin-canvas' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
<!-- wp:spacer {"height":"var:preset|spacing|jumbo","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<div style="margin-top:0;margin-bottom:0;height:var(--wp--preset--spacing--jumbo)" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->
<!-- wp:group {"align":"wide","className":"has-text-body-color has-text-color","style":{"spacing":{"padding":{"top":"0"}}}} -->
<div class="wp-block-group alignwide has-text-body-color has-text-color" style="padding-top:0"><!-- wp:group {"layout":{"type":"flex","justifyContent":"space-between","verticalAlignment":"center"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"textColor":"text-body","fontSize":"small"} -->
<p class="has-text-body-color has-text-color has-small-font-size"><?php echo esc_html__( '&copy; 2026 Origin. All rights reserved.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->
<!-- wp:social-links {"iconColor":"text-body","size":"has-normal-icon-size","className":"has-icon-color is-style-logos-only","style":{"spacing":{"margin":{"right":"0","left":"0"}}},"layout":{"type":"flex","justifyContent":"right"}} -->
<ul class="wp-block-social-links has-normal-icon-size has-icon-color is-style-logos-only" style="margin-right:0;margin-left:0"><!-- wp:social-link {"url":"#","service":"x"} /-->
<!-- wp:social-link {"url":"#","service":"github"} /-->
<!-- wp:social-link {"url":"#","service":"linkedin"} /--></ul>
<!-- /wp:social-links --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></footer>
<!-- /wp:group -->
