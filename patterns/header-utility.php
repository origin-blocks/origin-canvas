<?php
/**
 * Title: Header Utility
 * Slug: origin-canvas/header-utility
 * Description: A site header with a thin gray bar above it for a phone number, an email address and the opening hours, then the site title, primary navigation and one dark button; on phones only the number stays, so a visitor can tap to call.
 * Categories: header
 * Keywords: masthead, contact, local business, clinic, trades, telephone
 * Viewport Width: 1500
 * Block Types: core/template-part/header
 * Post Types:
 * Inserter: true
 *
 * @package Origin
 */

?>
<!-- wp:group {"metadata":{"name":"Utility Bar"},"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|small-medium","bottom":"var:preset|spacing|small-medium"}}},"backgroundColor":"base-2","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-base-2-background-color has-background" style="padding-top:var(--wp--preset--spacing--small-medium);padding-bottom:var(--wp--preset--spacing--small-medium)"><!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|large"}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"center"}} -->
<div class="wp-block-group alignwide"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|large"}},"layout":{"type":"flex","flexWrap":"wrap"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|contrast-2"},":hover":{"color":{"text":"var:preset|color|primary"}},"typography":{"textDecoration":"none"}}},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"contrast-2","fontSize":"extra-small"} -->
<p class="has-contrast-2-color has-text-color has-link-color has-extra-small-font-size" style="margin-top:0;margin-bottom:0"><a href="tel:+16155550142"><?php echo esc_html__( '(615) 555-0142', 'origin-canvas' ); ?></a></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"metadata":{"blockVisibility":{"viewport":{"mobile":false,"tablet":false}}},"style":{"elements":{"link":{"color":{"text":"var:preset|color|contrast-2"},":hover":{"color":{"text":"var:preset|color|primary"}},"typography":{"textDecoration":"none"}}},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"contrast-2","fontSize":"extra-small"} -->
<p class="has-contrast-2-color has-text-color has-link-color has-extra-small-font-size" style="margin-top:0;margin-bottom:0"><a href="mailto:hello@example.com"><?php echo esc_html__( 'hello@example.com', 'origin-canvas' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"metadata":{"blockVisibility":{"viewport":{"mobile":false,"tablet":false}}},"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"contrast-2","fontSize":"extra-small"} -->
<p class="has-contrast-2-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Monday to Friday, 9am&nbsp;to&nbsp;5:30pm', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:pattern {"slug":"origin-canvas/header-with-button"} /-->
