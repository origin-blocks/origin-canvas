<?php
/**
 * Title: Header With Button
 * Slug: origin-canvas/header-with-button
 * Description: A site header with the site title, primary navigation and one dark call-to-action button, which keeps one row on phones unless the site title is long.
 * Categories: header
 * Keywords: masthead, topbar, cta, action, signup
 * Viewport Width: 1500
 * Block Types: core/template-part/header
 * Post Types:
 * Inserter: true
 *
 * @package Origin
 */

?>
<!-- wp:group {"metadata":{"name":"Header With Button"},"align":"full","className":"origin-canvas-header origin-canvas-header-with-button","style":{"spacing":{"padding":{"top":"var:preset|spacing|large","bottom":"var:preset|spacing|large"}},"border":{"top":{"width":"0px","style":"none"},"right":{"width":"0px","style":"none"},"bottom":{"color":"var:preset|color|border","width":"1px"},"left":{"width":"0px","style":"none"}}},"backgroundColor":"surface-base","layout":{"type":"constrained","inherit":true}} -->
<div class="wp-block-group alignfull origin-canvas-header origin-canvas-header-with-button has-surface-base-background-color has-background" style="border-top-style:none;border-top-width:0px;border-right-style:none;border-right-width:0px;border-bottom-color:var(--wp--preset--color--border);border-bottom-width:1px;border-left-style:none;border-left-width:0px;padding-top:var(--wp--preset--spacing--large);padding-bottom:var(--wp--preset--spacing--large)"><!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|medium"}},"layout":{"type":"flex","justifyContent":"space-between","flexWrap":"wrap","verticalAlignment":"center"}} -->
<div class="wp-block-group alignwide"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|compact"}},"layout":{"type":"flex","flexWrap":"wrap","verticalAlignment":"center"}} -->
<div class="wp-block-group"><!-- wp:site-title {"level":0,"style":{"spacing":{"margin":{"bottom":"0px","top":"0px"}},"elements":{"link":{"color":{"text":"var:preset|color|text-heading"},":hover":{"color":{"text":"var:preset|color|primary"}}}}},"textColor":"text-heading"} /--></div>
<!-- /wp:group -->

<!-- wp:navigation {"overlay":"mobile-menu","textColor":"text-heading","className":"origin-canvas-main-nav is-style-origin-canvas-hover-pill","style":{"spacing":{"blockGap":"var:preset|spacing|extra-large"},"typography":{"fontWeight":"500","fontStyle":"normal"}},"fontSize":"small","layout":{"type":"flex","justifyContent":"center","flexWrap":"wrap"}} /-->

<!-- wp:buttons {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-buttons"><!-- wp:button {"style":{"spacing":{"padding":{"top":"var:preset|spacing|compact","right":"var:preset|spacing|large","bottom":"var:preset|spacing|compact","left":"var:preset|spacing|large"}}},"fontSize":"small"} -->
<div class="wp-block-button"><a class="wp-block-button__link has-small-font-size has-custom-font-size wp-element-button" style="padding-top:var(--wp--preset--spacing--compact);padding-right:var(--wp--preset--spacing--large);padding-bottom:var(--wp--preset--spacing--compact);padding-left:var(--wp--preset--spacing--large)"><?php echo esc_html__( 'Start a project', 'origin-canvas' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
