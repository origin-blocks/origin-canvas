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
<section class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--colossal);padding-bottom:var(--wp--preset--spacing--colossal)"><!-- wp:group {"style":{"border":{"radius":"var:custom|radius|large"},"spacing":{"padding":{"top":"var:preset|spacing|extra-large","right":"var:preset|spacing|extra-large","bottom":"var:preset|spacing|extra-large","left":"var:preset|spacing|extra-large"}}},"backgroundColor":"base-2","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-base-2-background-color has-background" style="border-radius:var(--wp--custom--radius--large);padding-top:var(--wp--preset--spacing--extra-large);padding-right:var(--wp--preset--spacing--extra-large);padding-bottom:var(--wp--preset--spacing--extra-large);padding-left:var(--wp--preset--spacing--extra-large)"><!-- wp:site-title {"level":0,"isLink":false,"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|large"}}},"textColor":"contrast","fontSize":"medium"} /-->

<!-- wp:group {"style":{"border":{"bottom":{"color":"var:preset|color|base-5","style":"solid","width":"1px"}},"spacing":{"blockGap":"0"}},"layout":{"type":"default"}} -->
<div class="wp-block-group" style="border-bottom-color:var(--wp--preset--color--base-5);border-bottom-style:solid;border-bottom-width:1px"><!-- wp:group {"className":"origin-canvas-align-baseline","style":{"border":{"top":{"color":"var:preset|color|base-5","style":"solid","width":"1px"}},"spacing":{"padding":{"top":"var:preset|spacing|medium","bottom":"var:preset|spacing|medium"},"blockGap":"var:preset|spacing|medium"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group origin-canvas-align-baseline" style="border-top-color:var(--wp--preset--color--base-5);border-top-style:solid;border-top-width:1px;padding-top:var(--wp--preset--spacing--medium);padding-bottom:var(--wp--preset--spacing--medium)"><!-- wp:paragraph {"className":"origin-canvas-no-shrink","style":{"layout":{"selfStretch":"fixed","flexSize":"6rem"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"contrast-3","fontSize":"small"} -->
<p class="origin-canvas-no-shrink has-contrast-3-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Address', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"contrast-2","fontSize":"regular"} -->
<p class="has-contrast-2-color has-text-color has-regular-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( '214 Cedar Street, Nashville,&nbsp;TN&nbsp;37203', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-align-baseline","style":{"border":{"top":{"color":"var:preset|color|base-5","style":"solid","width":"1px"}},"spacing":{"padding":{"top":"var:preset|spacing|medium","bottom":"var:preset|spacing|medium"},"blockGap":"var:preset|spacing|medium"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group origin-canvas-align-baseline" style="border-top-color:var(--wp--preset--color--base-5);border-top-style:solid;border-top-width:1px;padding-top:var(--wp--preset--spacing--medium);padding-bottom:var(--wp--preset--spacing--medium)"><!-- wp:paragraph {"className":"origin-canvas-no-shrink","style":{"layout":{"selfStretch":"fixed","flexSize":"6rem"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"contrast-3","fontSize":"small"} -->
<p class="origin-canvas-no-shrink has-contrast-3-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Phone', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"origin-canvas-links-plain","style":{"typography":{"fontWeight":"500"},"elements":{"link":{"color":{"text":"var:preset|color|contrast-2"},":hover":{"color":{"text":"var:preset|color|primary"}}}},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"contrast-2","fontSize":"regular"} -->
<p class="origin-canvas-links-plain has-contrast-2-color has-text-color has-link-color has-regular-font-size" style="margin-top:0;margin-bottom:0;font-weight:500"><a href="tel:+16155550142"><?php echo esc_html__( '(615) 555-0142', 'origin-canvas' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-align-baseline","style":{"border":{"top":{"color":"var:preset|color|base-5","style":"solid","width":"1px"}},"spacing":{"padding":{"top":"var:preset|spacing|medium","bottom":"var:preset|spacing|medium"},"blockGap":"var:preset|spacing|medium"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group origin-canvas-align-baseline" style="border-top-color:var(--wp--preset--color--base-5);border-top-style:solid;border-top-width:1px;padding-top:var(--wp--preset--spacing--medium);padding-bottom:var(--wp--preset--spacing--medium)"><!-- wp:paragraph {"className":"origin-canvas-no-shrink","style":{"layout":{"selfStretch":"fixed","flexSize":"6rem"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"contrast-3","fontSize":"small"} -->
<p class="origin-canvas-no-shrink has-contrast-3-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Email', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"origin-canvas-links-plain","style":{"typography":{"fontWeight":"500"},"elements":{"link":{"color":{"text":"var:preset|color|contrast-2"},":hover":{"color":{"text":"var:preset|color|primary"}}}},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"contrast-2","fontSize":"regular"} -->
<p class="origin-canvas-links-plain has-contrast-2-color has-text-color has-link-color has-regular-font-size" style="margin-top:0;margin-bottom:0;font-weight:500"><a href="mailto:hello@example.com"><?php echo esc_html__( 'hello@example.com', 'origin-canvas' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-align-baseline","style":{"border":{"top":{"color":"var:preset|color|base-5","style":"solid","width":"1px"}},"spacing":{"padding":{"top":"var:preset|spacing|medium","bottom":"var:preset|spacing|medium"},"blockGap":"var:preset|spacing|medium"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group origin-canvas-align-baseline" style="border-top-color:var(--wp--preset--color--base-5);border-top-style:solid;border-top-width:1px;padding-top:var(--wp--preset--spacing--medium);padding-bottom:var(--wp--preset--spacing--medium)"><!-- wp:paragraph {"className":"origin-canvas-no-shrink","style":{"layout":{"selfStretch":"fixed","flexSize":"6rem"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"contrast-3","fontSize":"small"} -->
<p class="origin-canvas-no-shrink has-contrast-3-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Hours', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"contrast-2","fontSize":"regular"} -->
<p class="has-contrast-2-color has-text-color has-regular-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Monday to Friday, 9am&nbsp;to&nbsp;5:30pm', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
