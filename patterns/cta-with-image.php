<?php
/**
 * Title: CTA With Image
 * Slug: origin-canvas/cta-with-image
 * Description: A closing call to action with a photo on the left, two buttons and a note on reply time.
 * Categories: call-to-action
 * Keywords: conversion, contact, email, booking, split, media
 * Viewport Width: 1500
 * Block Types:
 * Post Types:
 * Inserter: true
 *
 * @package Origin
 */

?>
<!-- wp:group {"tagName":"section","align":"full","backgroundColor":"surface-muted","style":{"spacing":{"padding":{"top":"var:preset|spacing|colossal","bottom":"var:preset|spacing|colossal"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-surface-muted-background-color has-background" style="padding-top:var(--wp--preset--spacing--colossal);padding-bottom:var(--wp--preset--spacing--colossal)"><!-- wp:columns {"align":"wide","verticalAlignment":"center","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|extra-large","left":"var:preset|spacing|jumbo"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center","width":"50%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:50%"><!-- wp:image {"aspectRatio":"4/3","scale":"cover","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"var:custom|radius|medium"}}} -->
<figure class="wp-block-image size-full has-custom-border"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/patterns/images/studio-review.webp" alt="<?php esc_attr_e( 'Two members of the studio reviewing printed layouts at a long table.', 'origin-canvas' ); ?>" style="border-radius:var(--wp--custom--radius--medium);aspect-ratio:4/3;object-fit:cover"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"50%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:50%"><!-- wp:heading {"level":2,"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"fontSize":"display"} -->
<h2 class="wp-block-heading has-display-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Tell us what you&#8217;re making', 'origin-canvas' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|medium","bottom":"0"}}},"textColor":"text-body","fontSize":"regular-plus"} -->
<p class="has-text-body-color has-text-color has-regular-plus-font-size" style="margin-top:var(--wp--preset--spacing--medium);margin-bottom:0"><?php echo esc_html__( 'One email is enough to start. No brief needed.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"blockGap":"var:preset|spacing|compact","margin":{"top":"var:preset|spacing|extra-large","bottom":"0"}}},"layout":{"type":"flex"}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--extra-large);margin-bottom:0"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="mailto:hello@example.com"><?php echo esc_html__( 'Email us', 'origin-canvas' ); ?></a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-origin-canvas-outline-strong"} -->
<div class="wp-block-button is-style-origin-canvas-outline-strong"><a class="wp-block-button__link wp-element-button"><?php echo esc_html__( 'Book a call', 'origin-canvas' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|medium","bottom":"0"}}},"textColor":"text-muted","fontSize":"small"} -->
<p class="has-text-muted-color has-text-color has-small-font-size" style="margin-top:var(--wp--preset--spacing--medium);margin-bottom:0"><?php echo esc_html__( 'We reply within two business days.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->
