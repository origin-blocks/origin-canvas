<?php
/**
 * Title: Testimonial Highlight
 * Slug: origin-canvas/testimonial-highlight
 * Description: A single highlighted testimonial quote with author attribution.
 * Categories: testimonials
 * Keywords: review, featured, endorsement, pullquote
 * Viewport Width: 1500
 * Block Types:
 * Post Types:
 * Inserter: true
 *
 * @package Origin
 */

?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"var:preset|spacing|colossal","bottom":"var:preset|spacing|colossal"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--colossal);padding-bottom:var(--wp--preset--spacing--colossal)"><!-- wp:group {"layout":{"type":"constrained","contentSize":"860px"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","fontWeight":"600","letterSpacing":"0.08em"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|large"}}},"textColor":"primary","fontSize":"small"} -->
<p class="has-text-align-center has-primary-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--large);font-weight:600;letter-spacing:0.08em;text-transform:uppercase"><?php echo esc_html__( 'From the people shipping with it', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontWeight":"500","lineHeight":"1.4","letterSpacing":"-0.01em"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading","fontSize":"huge"} -->
<p class="has-text-align-center has-text-heading-color has-text-color has-huge-font-size" style="margin-top:0;margin-bottom:0;font-weight:500;letter-spacing:-0.01em;line-height:1.4"><?php echo esc_html__( 'We have worked with bigger studios. None of them made the work feel this calm, or this much like ours.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|compact","margin":{"top":"var:preset|spacing|extra-large"}}},"layout":{"type":"flex","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--extra-large)"><!-- wp:image {"aspectRatio":"1","linkDestination":"none","width":"52px","height":"52px","className":"is-style-origin-canvas-rounded-full"} -->
<figure class="wp-block-image is-resized is-style-origin-canvas-rounded-full"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/patterns/images/avatar-daniel-cross.webp" alt="<?php esc_attr_e( 'Portrait of Daniel Cross, Director of Westmount Property.', 'origin-canvas' ); ?>" style="aspect-ratio:1;width:52px;height:52px"/></figure>
<!-- /wp:image -->

<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading","fontSize":"small"} -->
<p class="has-text-heading-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:0;font-weight:600"><?php echo esc_html__( 'Daniel Cross', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-muted","fontSize":"small"} -->
<p class="has-text-muted-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Director, Westmount Property', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
