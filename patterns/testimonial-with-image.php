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
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|massive","bottom":"var:preset|spacing|massive"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--massive);padding-bottom:var(--wp--preset--spacing--massive)"><!-- wp:columns {"align":"wide","verticalAlignment":"center","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|huge","left":"var:preset|spacing|colossal"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center","width":"38%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:38%"><!-- wp:image {"aspectRatio":"1","scale":"cover","width":"280px","height":"280px","sizeSlug":"full","linkDestination":"none","align":"center","className":"is-style-origin-canvas-rounded-full"} -->
<figure class="wp-block-image aligncenter size-full is-resized is-style-origin-canvas-rounded-full"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/patterns/images/card-team-1.webp" alt="<?php esc_attr_e( 'Hands reviewing blank paper at a light wooden studio desk.', 'origin-canvas' ); ?>" style="aspect-ratio:1;object-fit:cover;width:280px;height:280px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"62%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:62%"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|medium"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"dimensions":{"minHeight":"26px"}},"layout":{"type":"constrained","contentSize":"32px"},"className":"origin-canvas-quote-mark"} -->
<div class="wp-block-group origin-canvas-quote-mark" style="min-height:26px;width:32px"></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"typography":{"lineHeight":"1.28","fontWeight":"500"},"spacing":{"margin":{"top":"16px","bottom":"22px"}}},"textColor":"text-heading","fontSize":"huge"} -->
<p class="has-text-heading-color has-text-color has-huge-font-size" style="margin-top:16px;margin-bottom:22px;font-weight:500;line-height:1.28"><?php echo esc_html__( 'They sent invoices in plain English and launched on the day they said they would. That alone made the project feel calm.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading","fontSize":"regular"} -->
<p class="has-text-heading-color has-text-color has-regular-font-size" style="margin-top:0;margin-bottom:0;font-weight:600"><?php echo esc_html__( 'Rachel Lark', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-body","fontSize":"regular"} -->
<p class="has-text-body-color has-text-color has-regular-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Owner, Linden & Lark Florist', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"},"spacing":{"margin":{"top":"20px","bottom":"0"}}},"textColor":"text-heading","fontSize":"regular"} -->
<p class="has-text-heading-color has-text-color has-regular-font-size" style="margin-top:20px;margin-bottom:0;font-weight:600"><?php echo esc_html__( 'Read the case study', 'origin-canvas' ); ?> <mark style="background-color:rgba(0, 0, 0, 0)" class="has-inline-color has-primary-color">&rarr;</mark></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->
