<?php
/**
 * Title: Testimonial Single
 * Slug: origin-canvas/testimonial-single
 * Description: A single centered testimonial quote with author attribution.
 * Categories: origin-canvas/testimonial
 * Keywords: quote, client, centered, review
 * Viewport Width: 1500
 * Block Types:
 * Post Types:
 * Inserter: true
 *
 * @package Origin
 */

?>
<!-- wp:group {"tagName":"section","align":"full","backgroundColor":"surface-muted","style":{"spacing":{"padding":{"top":"var:preset|spacing|massive","bottom":"var:preset|spacing|massive"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-surface-muted-background-color has-background" style="padding-top:var(--wp--preset--spacing--massive);padding-bottom:var(--wp--preset--spacing--massive)"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|large"}},"layout":{"type":"constrained","contentSize":"840px"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","fontWeight":"600","letterSpacing":"0.08em"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|large"}}},"textColor":"primary","fontSize":"extra-small"} -->
<p class="has-text-align-center has-primary-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--large);font-weight:600;letter-spacing:0.08em;text-transform:uppercase"><?php echo esc_html__( 'In their words', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:html -->
<div style="margin-bottom:var(--wp--preset--spacing--medium)"><svg style="display:block;margin-inline:auto" width="34" height="27" viewBox="0 0 40 32" fill="var(--wp--preset--color--primary)" aria-hidden="true" focusable="false"><path d="M0 32V18.5C0 8.6 5.7 1.7 15.2 0l2 4.3C11.6 6 8.6 9.4 8.4 14.2H16V32H0zm22 0V18.5C22 8.6 27.7 1.7 37.2 0l2 4.3C33.6 6 30.6 9.4 30.4 14.2H38V32H22z"></path></svg></div>
<!-- /wp:html -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"lineHeight":"1.35","fontWeight":"500","letterSpacing":"-0.01em"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading","fontSize":"huge"} -->
<p class="has-text-align-center has-text-heading-color has-text-color has-huge-font-size" style="margin-top:0;margin-bottom:0;font-weight:500;letter-spacing:-0.01em;line-height:1.35"><?php echo esc_html__( 'They asked the questions our last designer didn\'t. The site finally feels like ours, not a template we tried to make fit.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|medium","margin":{"top":"var:preset|spacing|extra-large"}}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--extra-large)"><!-- wp:image {"aspectRatio":"1","scale":"cover","width":"64px","height":"64px","sizeSlug":"full","linkDestination":"none","className":"is-style-origin-canvas-rounded-full"} -->
<figure class="wp-block-image size-full is-resized is-style-origin-canvas-rounded-full"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/patterns/images/card-testimonial-1.webp" alt="" style="aspect-ratio:1;object-fit:cover;width:64px;height:64px"/></figure>
<!-- /wp:image -->

<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"align":"center","style":{"typography":{"fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading","fontSize":"regular"} -->
<p class="has-text-align-center has-text-heading-color has-text-color has-regular-font-size" style="margin-top:0;margin-bottom:0;font-weight:600"><?php echo esc_html__( 'Sarah Jenkins', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-body","fontSize":"small"} -->
<p class="has-text-align-center has-text-body-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Founder, Hartwell Tea Co.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
