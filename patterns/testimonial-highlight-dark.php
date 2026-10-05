<?php
/**
 * Title: Testimonial Highlight Dark
 * Slug: origin-canvas/testimonial-highlight-dark
 * Description: A single testimonial quote on a dark band, with the client photo and role beneath.
 * Categories: testimonials
 * Keywords: review, featured, endorsement, pullquote, inverted
 * Viewport Width: 1500
 * Block Types:
 * Post Types:
 * Inserter: true
 *
 * @package Origin
 */

?>
<!-- wp:group {"tagName":"section","align":"full","style":{"color":{"background":"var(--wp--custom--dark--bg)","text":"var(--wp--custom--dark--text)"},"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"var:preset|spacing|colossal","bottom":"var:preset|spacing|colossal"}}},"layout":{"type":"constrained","contentSize":"880px"}} -->
<section class="wp-block-group alignfull has-text-color has-background" style="color:var(--wp--custom--dark--text);background-color:var(--wp--custom--dark--bg);margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--colossal);padding-bottom:var(--wp--preset--spacing--colossal)"><!-- wp:group {"layout":{"type":"constrained","contentSize":"880px"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","fontWeight":"600","letterSpacing":"0.08em"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|medium"}}},"textColor":"primary","fontSize":"small"} -->
<p class="has-text-align-center has-primary-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--medium);font-weight:600;letter-spacing:0.08em;text-transform:uppercase"><?php echo esc_html__( 'Client note', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontWeight":"500","lineHeight":"1.4"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"fontSize":"huge"} -->
<p class="has-text-align-center has-huge-font-size" style="margin-top:0;margin-bottom:0;font-weight:500;line-height:1.4"><?php echo esc_html__( 'We have worked with bigger studios. None of them made the work feel this calm, or this much like ours.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|medium","margin":{"top":"var:preset|spacing|extra-large"}}},"layout":{"type":"flex","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--extra-large)"><!-- wp:image {"aspectRatio":"1","linkDestination":"none","width":"48px","height":"48px","className":"is-style-origin-canvas-rounded-full"} -->
<figure class="wp-block-image is-resized is-style-origin-canvas-rounded-full"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/patterns/images/avatar-michael-hughes.webp" alt="<?php esc_attr_e( 'Portrait of Michael Hughes, Broker at Westmount Realty.', 'origin-canvas' ); ?>" style="aspect-ratio:1;width:48px;height:48px"/></figure>
<!-- /wp:image -->

<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontWeight":"600","letterSpacing":"var(--wp--custom--letter-spacing--base)"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"fontSize":"regular"} -->
<p class="has-regular-font-size" style="margin-top:0;margin-bottom:0;font-weight:600;letter-spacing:var(--wp--custom--letter-spacing--base)"><?php echo esc_html__( 'Michael Hughes', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"fontSize":"small"} -->
<p class="has-small-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Broker, Westmount Realty', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
