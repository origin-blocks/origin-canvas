<?php
/**
 * Title: Contact Split
 * Slug: origin-canvas/contact-split
 * Description: Contact details beside a panel that starts an email about a project.
 * Categories: contact
 * Keywords: inquiry, office, reach, hire
 * Viewport Width: 1500
 * Block Types:
 * Post Types:
 * Inserter: true
 * Note: The right column is a working email link. To use a form plugin, replace the contents of the group named "Form" with the plugin's block.
 *
 * @package Origin
 */
?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"var:preset|spacing|colossal","bottom":"var:preset|spacing|colossal"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--colossal);padding-bottom:var(--wp--preset--spacing--colossal)"><!-- wp:columns {"verticalAlignment":"top","align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|huge","left":"var:preset|spacing|jumbo"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-top"><!-- wp:column {"verticalAlignment":"top","width":"50%","style":{"spacing":{"padding":{"top":"var:preset|spacing|extra-large"}}}} -->
<div class="wp-block-column is-vertically-aligned-top" style="padding-top:var(--wp--preset--spacing--extra-large);flex-basis:50%"><!-- wp:heading {"level":2,"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|medium"}}},"fontSize":"extra-large"} -->
<h2 class="wp-block-heading has-extra-large-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--medium)"><?php echo esc_html__( 'Ready when you are', 'origin-canvas' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|extra-large"}}},"textColor":"text-body","fontSize":"regular-plus"} -->
<p class="has-text-body-color has-text-color has-regular-plus-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--extra-large)"><?php echo esc_html__( 'The first conversation is free and has no pitch attached.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:group {"style":{"border":{"bottom":{"color":"var:preset|color|border","style":"solid","width":"1px"}},"spacing":{"blockGap":"0"}},"layout":{"type":"default"}} -->
<div class="wp-block-group" style="border-bottom-color:var(--wp--preset--color--border);border-bottom-style:solid;border-bottom-width:1px"><!-- wp:group {"className":"origin-canvas-align-baseline","style":{"border":{"top":{"color":"var:preset|color|border","style":"solid","width":"1px"}},"spacing":{"padding":{"top":"var:preset|spacing|medium","bottom":"var:preset|spacing|medium"},"blockGap":"var:preset|spacing|medium"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group origin-canvas-align-baseline" style="border-top-color:var(--wp--preset--color--border);border-top-style:solid;border-top-width:1px;padding-top:var(--wp--preset--spacing--medium);padding-bottom:var(--wp--preset--spacing--medium)"><!-- wp:paragraph {"className":"origin-canvas-no-shrink","style":{"layout":{"selfStretch":"fixed","flexSize":"6rem"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-muted","fontSize":"small"} -->
<p class="origin-canvas-no-shrink has-text-muted-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Address', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-body","fontSize":"regular"} -->
<p class="has-text-body-color has-text-color has-regular-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( '214 Cedar Street, Nashville,&nbsp;TN&nbsp;37203', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-align-baseline","style":{"border":{"top":{"color":"var:preset|color|border","style":"solid","width":"1px"}},"spacing":{"padding":{"top":"var:preset|spacing|medium","bottom":"var:preset|spacing|medium"},"blockGap":"var:preset|spacing|medium"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group origin-canvas-align-baseline" style="border-top-color:var(--wp--preset--color--border);border-top-style:solid;border-top-width:1px;padding-top:var(--wp--preset--spacing--medium);padding-bottom:var(--wp--preset--spacing--medium)"><!-- wp:paragraph {"className":"origin-canvas-no-shrink","style":{"layout":{"selfStretch":"fixed","flexSize":"6rem"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-muted","fontSize":"small"} -->
<p class="origin-canvas-no-shrink has-text-muted-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Phone', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"origin-canvas-links-plain","style":{"typography":{"fontWeight":"500"},"elements":{"link":{"color":{"text":"var:preset|color|text-body"},":hover":{"color":{"text":"var:preset|color|primary"}}}},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-body","fontSize":"regular"} -->
<p class="origin-canvas-links-plain has-text-body-color has-text-color has-link-color has-regular-font-size" style="margin-top:0;margin-bottom:0;font-weight:500"><a href="tel:+16155550142"><?php echo esc_html__( '(615) 555-0142', 'origin-canvas' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-align-baseline","style":{"border":{"top":{"color":"var:preset|color|border","style":"solid","width":"1px"}},"spacing":{"padding":{"top":"var:preset|spacing|medium","bottom":"var:preset|spacing|medium"},"blockGap":"var:preset|spacing|medium"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group origin-canvas-align-baseline" style="border-top-color:var(--wp--preset--color--border);border-top-style:solid;border-top-width:1px;padding-top:var(--wp--preset--spacing--medium);padding-bottom:var(--wp--preset--spacing--medium)"><!-- wp:paragraph {"className":"origin-canvas-no-shrink","style":{"layout":{"selfStretch":"fixed","flexSize":"6rem"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-muted","fontSize":"small"} -->
<p class="origin-canvas-no-shrink has-text-muted-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Hours', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-body","fontSize":"regular"} -->
<p class="has-text-body-color has-text-color has-regular-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Monday to Friday, 9am&nbsp;to&nbsp;5:30pm', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"top","width":"50%"} -->
<div class="wp-block-column is-vertically-aligned-top" style="flex-basis:50%"><!-- wp:group {"metadata":{"name":"Form"},"backgroundColor":"surface-muted","style":{"border":{"radius":"var:custom|radius|medium"},"spacing":{"padding":{"top":"var:preset|spacing|extra-large","right":"var:preset|spacing|extra-large","bottom":"var:preset|spacing|extra-large","left":"var:preset|spacing|extra-large"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-surface-muted-background-color has-background" style="border-radius:var(--wp--custom--radius--medium);padding-top:var(--wp--preset--spacing--extra-large);padding-right:var(--wp--preset--spacing--extra-large);padding-bottom:var(--wp--preset--spacing--extra-large);padding-left:var(--wp--preset--spacing--extra-large)"><!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|medium"}}},"fontSize":"large"} -->
<h3 class="wp-block-heading has-large-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--medium)"><?php echo esc_html__( 'Start with an email', 'origin-canvas' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-body","fontSize":"regular-plus"} -->
<p class="has-text-body-color has-text-color has-regular-plus-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'A few lines is enough: what the business does, what the site has to do, and roughly when. We read every one ourselves.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|large"}}}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--large)"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="mailto:hello@example.com"><?php echo esc_html__( 'Email us', 'origin-canvas' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|medium","bottom":"0"}}},"textColor":"text-muted","fontSize":"extra-small"} -->
<p class="has-text-muted-color has-text-color has-extra-small-font-size" style="margin-top:var(--wp--preset--spacing--medium);margin-bottom:0"><?php echo esc_html__( 'We reply within two business days.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->
