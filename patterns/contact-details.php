<?php
/**
 * Title: Contact Details
 * Slug: origin-canvas/contact-details
 * Description: A card with the business name, address, phone, email and opening hours.
 * Categories: contact
 * Keywords: location, visit, office, directions, reach
 * Viewport Width: 1500
 * Block Types:
 * Post Types:
 * Inserter: true
 *
 * @package Origin
 */
?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"var:preset|spacing|colossal","bottom":"var:preset|spacing|colossal"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--colossal);padding-bottom:var(--wp--preset--spacing--colossal)"><!-- wp:group {"backgroundColor":"surface-muted","style":{"border":{"radius":"var:custom|radius|large"},"spacing":{"padding":{"top":"var:preset|spacing|extra-large","right":"var:preset|spacing|extra-large","bottom":"var:preset|spacing|extra-large","left":"var:preset|spacing|extra-large"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-surface-muted-background-color has-background" style="border-radius:var(--wp--custom--radius--large);padding-top:var(--wp--preset--spacing--extra-large);padding-right:var(--wp--preset--spacing--extra-large);padding-bottom:var(--wp--preset--spacing--extra-large);padding-left:var(--wp--preset--spacing--extra-large)"><!-- wp:site-title {"level":0,"isLink":false,"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|extra-large"}}},"fontSize":"large"} /-->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|large"}},"layout":{"type":"grid","columnCount":2,"minimumColumnWidth":"12rem"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","letterSpacing":"0.08em","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|small"}}},"textColor":"text-heading","fontSize":"extra-small"} -->
<p class="has-text-heading-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--small);font-weight:600;letter-spacing:0.08em;text-transform:uppercase"><?php echo esc_html__( 'Address', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-body","fontSize":"regular-plus"} -->
<p class="has-text-body-color has-text-color has-regular-plus-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( '214 Alder Street', 'origin-canvas' ); ?><br><?php echo esc_html__( 'Portland, OR 97204', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","letterSpacing":"0.08em","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|small"}}},"textColor":"text-heading","fontSize":"extra-small"} -->
<p class="has-text-heading-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--small);font-weight:600;letter-spacing:0.08em;text-transform:uppercase"><?php echo esc_html__( 'Phone', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"origin-canvas-links-plain","style":{"typography":{"fontWeight":"500"},"elements":{"link":{"color":{"text":"var:preset|color|text-heading"},":hover":{"color":{"text":"var:preset|color|primary"}}}},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading","fontSize":"regular-plus"} -->
<p class="origin-canvas-links-plain has-text-heading-color has-text-color has-link-color has-regular-plus-font-size" style="margin-top:0;margin-bottom:0;font-weight:500"><a href="tel:+15035550142"><?php echo esc_html__( '(503) 555-0142', 'origin-canvas' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","letterSpacing":"0.08em","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|small"}}},"textColor":"text-heading","fontSize":"extra-small"} -->
<p class="has-text-heading-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--small);font-weight:600;letter-spacing:0.08em;text-transform:uppercase"><?php echo esc_html__( 'Email', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"origin-canvas-links-plain","style":{"typography":{"fontWeight":"500"},"elements":{"link":{"color":{"text":"var:preset|color|text-heading"},":hover":{"color":{"text":"var:preset|color|primary"}}}},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading","fontSize":"regular-plus"} -->
<p class="origin-canvas-links-plain has-text-heading-color has-text-color has-link-color has-regular-plus-font-size" style="margin-top:0;margin-bottom:0;font-weight:500"><a href="mailto:hello@example.com"><?php echo esc_html__( 'hello@example.com', 'origin-canvas' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","letterSpacing":"0.08em","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|small"}}},"textColor":"text-heading","fontSize":"extra-small"} -->
<p class="has-text-heading-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--small);font-weight:600;letter-spacing:0.08em;text-transform:uppercase"><?php echo esc_html__( 'Hours', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-body","fontSize":"regular-plus"} -->
<p class="has-text-body-color has-text-color has-regular-plus-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Monday to Friday', 'origin-canvas' ); ?><br><?php echo esc_html__( '9am to 5:30pm', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
