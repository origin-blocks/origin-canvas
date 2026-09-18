<?php
/**
 * Title: Header Dark
 * Slug: origin-canvas/header-dark
 * Description: A dark site header with the site title, primary navigation, and a matching dark mobile overlay menu.
 * Categories: header
 * Keywords: masthead, topbar, inverted, night, black
 * Viewport Width: 1500
 * Block Types: core/template-part/header
 * Post Types:
 * Inserter: true
 *
 * @package Origin
 */

?>
<!-- wp:group {"metadata":{"name":"Header Dark"},"align":"full","className":"origin-canvas-header origin-canvas-header-dark","style":{"spacing":{"padding":{"top":"var:preset|spacing|large","bottom":"var:preset|spacing|large"}},"elements":{"link":{"color":{"text":"var:preset|color|on-dark"},":hover":{"color":{"text":"var:preset|color|primary"}}}}},"backgroundColor":"text-heading","textColor":"on-dark","layout":{"type":"constrained","inherit":true}} -->
<div class="wp-block-group alignfull origin-canvas-header origin-canvas-header-dark has-on-dark-color has-text-heading-background-color has-text-color has-background has-link-color" style="padding-top:var(--wp--preset--spacing--large);padding-bottom:var(--wp--preset--spacing--large)"><!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|medium"}},"layout":{"type":"flex","justifyContent":"space-between","flexWrap":"wrap","verticalAlignment":"center"}} -->
<div class="wp-block-group alignwide"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|compact"}},"layout":{"type":"flex","flexWrap":"wrap","verticalAlignment":"center"}} -->
<div class="wp-block-group"><!-- wp:site-title {"level":0,"style":{"spacing":{"margin":{"bottom":"0px","top":"0px"}},"elements":{"link":{"color":{"text":"var:preset|color|on-dark"},":hover":{"color":{"text":"var:preset|color|primary"}}}}},"textColor":"on-dark"} /--></div>
<!-- /wp:group -->

<!-- wp:navigation {"overlay":"mobile-menu-dark","textColor":"on-dark","className":"origin-canvas-main-nav is-style-origin-canvas-hover-accent","style":{"spacing":{"blockGap":"var:preset|spacing|extra-large"},"typography":{"fontWeight":"500","fontStyle":"normal"}},"fontSize":"small","layout":{"type":"flex","justifyContent":"center","flexWrap":"wrap"}} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
