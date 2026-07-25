<?php
/**
 * Title: Testimonial Highlight
 * Slug: origin-canvas/testimonial-highlight
 * Description: A single highlighted testimonial quote with author attribution.
 * Categories: origin-canvas/testimonial
 * Keywords: quote, review, highlight, author
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

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"clamp(1.7rem, 3.1vw, 2.4rem)","fontWeight":"500","lineHeight":"1.3","letterSpacing":"-0.02em"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading"} -->
<p class="has-text-align-center has-text-heading-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:clamp(1.7rem, 3.1vw, 2.4rem);font-weight:500;letter-spacing:-0.02em;line-height:1.3"><?php echo esc_html__( 'Origin Canvas is the first theme where the patterns actually match the templates out of the box. We ship a new marketing site about every two weeks.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|compact","margin":{"top":"var:preset|spacing|extra-large"}}},"layout":{"type":"flex","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--extra-large)"><!-- wp:image {"aspectRatio":"1","linkDestination":"none","width":"52px","height":"52px","className":"is-style-origin-canvas-rounded-full"} -->
<figure class="wp-block-image is-resized is-style-origin-canvas-rounded-full"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/patterns/images/testimonial-highlight-1.webp" alt="<?php esc_attr_e( 'Portrait of Tom Bradshaw, studio lead at Northbank.', 'origin-canvas' ); ?>" style="aspect-ratio:1;width:52px;height:52px"/></figure>
<!-- /wp:image -->

<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontSize":"0.9375rem","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading"} -->
<p class="has-text-heading-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:0.9375rem;font-weight:600"><?php echo esc_html__( 'Tom Bradshaw', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-muted","fontSize":"small"} -->
<p class="has-text-muted-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Studio lead, Northbank', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
