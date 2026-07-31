<?php
/**
 * Title: Testimonial With Image
 * Slug: origin-canvas/testimonial-with-image
 * Description: A testimonial quote paired with an author photo in a two-column layout.
 * Categories: origin-canvas/testimonial
 * Keywords: quote, two column, review, portrait
 * Viewport Width: 1500
 * Block Types:
 * Post Types:
 * Inserter: true
 *
 * @package Origin
 */

?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|huge","bottom":"var:preset|spacing|huge"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--huge);padding-bottom:var(--wp--preset--spacing--huge)"><!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|extra-large","left":"var:preset|spacing|extra-large"}}}} -->
<div class="wp-block-columns are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center","width":"180px"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:180px"><!-- wp:image {"aspectRatio":"1","scale":"cover","width":"180px","height":"180px","sizeSlug":"full","linkDestination":"none","className":"is-style-origin-canvas-rounded-full"} -->
<figure class="wp-block-image size-full is-resized is-style-origin-canvas-rounded-full"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/patterns/images/card-team-1.webp" alt="" style="aspect-ratio:1;object-fit:cover;width:180px;height:180px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|medium"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:group {"className":"origin-canvas-quote-mark origin-canvas-quote-mark--sm"} -->
<div class="wp-block-group origin-canvas-quote-mark origin-canvas-quote-mark--sm"></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"typography":{"lineHeight":"1.4","fontWeight":"500","letterSpacing":"-0.01em"},"spacing":{"margin":{"top":"var:preset|spacing|medium","bottom":"var:preset|spacing|medium"}}},"textColor":"text-heading","fontSize":"large"} -->
<p class="has-text-heading-color has-text-color has-large-font-size" style="margin-top:var(--wp--preset--spacing--medium);margin-bottom:var(--wp--preset--spacing--medium);font-weight:500;letter-spacing:-0.01em;line-height:1.4"><?php echo esc_html__( 'They sent invoices in plain English and launched on the day they said they would. That alone made the project feel calm.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading","fontSize":"regular"} -->
<p class="has-text-heading-color has-text-color has-regular-font-size" style="margin-top:0;margin-bottom:0;font-weight:600"><?php echo esc_html__( 'Rachel Lark', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|extra-small","bottom":"0"}}},"textColor":"text-body","fontSize":"small"} -->
<p class="has-text-body-color has-text-color has-small-font-size" style="margin-top:var(--wp--preset--spacing--extra-small);margin-bottom:0"><?php echo esc_html__( 'Owner, Linden & Lark Florist', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"},"spacing":{"margin":{"top":"var:preset|spacing|medium","bottom":"0"}}},"textColor":"text-heading","fontSize":"regular"} -->
<p class="has-text-heading-color has-text-color has-regular-font-size" style="margin-top:var(--wp--preset--spacing--medium);margin-bottom:0;font-weight:600"><?php echo esc_html__( 'Read the case study', 'origin-canvas' ); ?> <mark style="background-color:rgba(0, 0, 0, 0)" class="has-inline-color has-primary-color">&rarr;</mark></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->
