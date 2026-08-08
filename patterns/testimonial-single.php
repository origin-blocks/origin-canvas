<?php
/**
 * Title: Testimonial Single
 * Slug: origin-canvas/testimonial-single
 * Description: A single centered testimonial quote with author attribution.
 * Categories: testimonials
 * Keywords: client, review, praise, solo
 * Viewport Width: 1500
 * Block Types:
 * Post Types:
 * Inserter: true
 *
 * @package Origin
 */

?>
<!-- wp:group {"tagName":"section","align":"full","backgroundColor":"surface-muted","style":{"spacing":{"padding":{"top":"var:preset|spacing|jumbo","bottom":"var:preset|spacing|jumbo"}}},"layout":{"type":"constrained","contentSize":"1200px"}} -->
<section class="wp-block-group alignfull has-surface-muted-background-color has-background" style="padding-top:var(--wp--preset--spacing--jumbo);padding-bottom:var(--wp--preset--spacing--jumbo)"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|large"}},"layout":{"type":"constrained","contentSize":"880px"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","fontWeight":"600","letterSpacing":"0.08em"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|medium"}}},"textColor":"primary","fontSize":"extra-small"} -->
<p class="has-text-align-center has-primary-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--medium);font-weight:600;letter-spacing:0.08em;text-transform:uppercase"><?php echo esc_html__( 'In their words', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:group {"style":{"dimensions":{"minHeight":"27px"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|medium"}}},"className":"origin-canvas-quote-mark origin-canvas-quote-mark--center"} -->
<div class="wp-block-group origin-canvas-quote-mark origin-canvas-quote-mark--center" style="min-height:27px;margin-top:0;margin-bottom:var(--wp--preset--spacing--medium)"></div>
<!-- /wp:group -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"lineHeight":"1.35","fontWeight":"500","letterSpacing":"-0.01em"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading","fontSize":"huge"} -->
<p class="has-text-align-center has-text-heading-color has-text-color has-huge-font-size" style="margin-top:0;margin-bottom:0;font-weight:500;letter-spacing:-0.01em;line-height:1.35"><?php echo esc_html__( 'They asked the questions our last designer didn\'t. The site finally feels like ours, not a template we tried to make fit.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|medium","margin":{"top":"var:preset|spacing|extra-large"}}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--extra-large)"><!-- wp:image {"aspectRatio":"1","scale":"cover","width":"64px","height":"64px","sizeSlug":"full","linkDestination":"none","className":"is-style-origin-canvas-rounded-full"} -->
<figure class="wp-block-image size-full is-resized is-style-origin-canvas-rounded-full"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/patterns/images/avatar-sarah-jenkins.webp" alt="<?php esc_attr_e( 'Portrait of Sarah Jenkins, Founder of Hartwell Tea Co.', 'origin-canvas' ); ?>" style="aspect-ratio:1;object-fit:cover;width:64px;height:64px"/></figure>
<!-- /wp:image -->

<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"align":"center","style":{"typography":{"fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading","fontSize":"regular"} -->
<p class="has-text-align-center has-text-heading-color has-text-color has-regular-font-size" style="margin-top:0;margin-bottom:0;font-weight:600"><?php echo esc_html__( 'Sarah Jenkins', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"var:preset|spacing|extra-small","bottom":"0"}}},"textColor":"text-body","fontSize":"small"} -->
<p class="has-text-align-center has-text-body-color has-text-color has-small-font-size" style="margin-top:var(--wp--preset--spacing--extra-small);margin-bottom:0"><?php echo esc_html__( 'Founder, Hartwell Tea Co.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
