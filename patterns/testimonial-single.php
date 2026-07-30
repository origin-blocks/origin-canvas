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
<div class="wp-block-group"><!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","fontWeight":"600","letterSpacing":"0.08em"},"spacing":{"margin":{"top":"0","bottom":"26px"}}},"textColor":"primary","fontSize":"extra-small"} -->
<p class="has-text-align-center has-primary-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:26px;font-weight:600;letter-spacing:0.08em;text-transform:uppercase"><?php echo esc_html__( 'In their words', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:group {"style":{"dimensions":{"minHeight":"27px"},"spacing":{"margin":{"top":"0","bottom":"22px"}}},"layout":{"type":"constrained","contentSize":"34px","justifyContent":"center"},"className":"origin-canvas-quote-mark"} -->
<div class="wp-block-group origin-canvas-quote-mark" style="min-height:27px;margin-top:0;margin-bottom:22px;width:34px;margin-inline:auto"></div>
<!-- /wp:group -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"lineHeight":"1.25","fontWeight":"500"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading","fontSize":"huge"} -->
<p class="has-text-align-center has-text-heading-color has-text-color has-huge-font-size" style="margin-top:0;margin-bottom:0;font-weight:500;line-height:1.25"><?php echo esc_html__( 'They asked the questions our last designer didn\'t. The site finally feels like ours, not a template we tried to make fit.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|medium","margin":{"top":"var:preset|spacing|extra-large"}}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--extra-large)"><!-- wp:image {"aspectRatio":"1","scale":"cover","width":"64px","height":"64px","sizeSlug":"full","linkDestination":"none","className":"is-style-origin-canvas-rounded-full"} -->
<figure class="wp-block-image size-full is-resized is-style-origin-canvas-rounded-full"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/patterns/images/card-testimonial-1.webp" alt="<?php esc_attr_e( 'Hands holding a cup of tea beside simple tea packaging and loose leaves.', 'origin-canvas' ); ?>" style="aspect-ratio:1;object-fit:cover;width:64px;height:64px"/></figure>
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
