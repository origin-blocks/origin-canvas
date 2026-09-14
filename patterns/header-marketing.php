<?php
/**
 * Title: Header Marketing
 * Slug: origin-canvas/header-marketing
 * Description: A marketing header with the site title, primary navigation, a ghost demo link and a dark download button.
 * Categories: header
 * Keywords: landing, cta, promo, saas, launch
 * Viewport Width: 1500
 * Block Types: core/template-part/header
 * Post Types:
 * Inserter: true
 *
 * @package Origin
 */

?>
<!-- wp:group {"metadata":{"name":"Header Marketing"},"align":"full","className":"origin-canvas-header origin-canvas-header-marketing has-surface-base-background-color has-text-primary-color has-background has-link-color","style":{"spacing":{"padding":{"top":"var:preset|spacing|large","bottom":"var:preset|spacing|large"}},"border":{"top":{"width":"0px","style":"none"},"right":{"width":"0px","style":"none"},"bottom":{"color":"var:preset|color|border","width":"1px"},"left":{"width":"0px","style":"none"}}},"layout":{"type":"constrained","inherit":true}} -->
<div class="wp-block-group alignfull origin-canvas-header origin-canvas-header-marketing has-surface-base-background-color has-text-primary-color has-background has-link-color" style="border-top-style:none;border-top-width:0px;border-right-style:none;border-right-width:0px;border-bottom-color:var(--wp--preset--color--border);border-bottom-width:1px;border-left-style:none;border-left-width:0px;padding-top:var(--wp--preset--spacing--large);padding-bottom:var(--wp--preset--spacing--large)"><!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|medium"}},"layout":{"type":"flex","justifyContent":"space-between","flexWrap":"wrap","verticalAlignment":"center"}} -->
<div class="wp-block-group alignwide"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|compact"}},"layout":{"type":"flex","flexWrap":"wrap","verticalAlignment":"center"}} -->
<div class="wp-block-group"><!-- wp:site-logo {"width":24,"shouldSyncIcon":false} /-->

<!-- wp:site-title {"level":0,"style":{"spacing":{"margin":{"bottom":"0px","top":"0px"}},"elements":{"link":{"color":{"text":"var:preset|color|text-heading"},":hover":{"color":{"text":"var:preset|color|primary"}}}}},"textColor":"text-heading"} /--></div>
<!-- /wp:group -->

<!-- wp:navigation {"overlay":"mobile-menu","textColor":"text-heading","className":"origin-canvas-main-nav is-style-origin-canvas-hover-pill","style":{"spacing":{"blockGap":"var:preset|spacing|extra-large"},"typography":{"fontWeight":"500","fontStyle":"normal"}},"fontSize":"small","layout":{"type":"flex","justifyContent":"center","flexWrap":"wrap"}} /-->

<!-- wp:buttons {"style":{"spacing":{"blockGap":"var:preset|spacing|compact"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-outline","style":{"spacing":{"padding":{"top":"calc(var(--wp--preset--spacing--compact) - 2px)","right":"calc(var(--wp--preset--spacing--large) - 2px)","bottom":"calc(var(--wp--preset--spacing--compact) - 2px)","left":"calc(var(--wp--preset--spacing--large) - 2px)"}}},"fontSize":"small"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link has-small-font-size has-custom-font-size wp-element-button" style="padding-top:calc(var(--wp--preset--spacing--compact) - 2px);padding-right:calc(var(--wp--preset--spacing--large) - 2px);padding-bottom:calc(var(--wp--preset--spacing--compact) - 2px);padding-left:calc(var(--wp--preset--spacing--large) - 2px)"><?php echo esc_html__( 'View demo', 'origin-canvas' ); ?></a></div>
<!-- /wp:button -->

<!-- wp:button {"style":{"spacing":{"padding":{"top":"var:preset|spacing|compact","right":"var:preset|spacing|large","bottom":"var:preset|spacing|compact","left":"var:preset|spacing|large"}}},"fontSize":"small"} -->
<div class="wp-block-button"><a class="wp-block-button__link has-small-font-size has-custom-font-size wp-element-button" style="padding-top:var(--wp--preset--spacing--compact);padding-right:var(--wp--preset--spacing--large);padding-bottom:var(--wp--preset--spacing--compact);padding-left:var(--wp--preset--spacing--large)"><?php echo esc_html__( 'Download', 'origin-canvas' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
