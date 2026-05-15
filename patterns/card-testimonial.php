<?php
/**
 * Title: Card Testimonial
 * Slug: origin-canvas/card-testimonial
 * Description: A single testimonial card with quote, avatar, name, and role. Insert inside a Columns block for a multi-testimonial layout.
 * Categories: testimonials
 * Keywords: card, testimonial, quote, social proof
 * Block Types: core/post-content
 * Inserter: true
 *
 * @package Origin
 */

?>
<!-- wp:group {"backgroundColor":"surface-muted","style":{"border":{"radius":"var:custom|radius|medium"},"spacing":{"padding":{"top":"var:preset|spacing|large","right":"var:preset|spacing|large","bottom":"var:preset|spacing|large","left":"var:preset|spacing|large"},"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-surface-muted-background-color has-background" style="border-radius:var(--wp--custom--radius--medium);padding-top:var(--wp--preset--spacing--large);padding-right:var(--wp--preset--spacing--large);padding-bottom:var(--wp--preset--spacing--large);padding-left:var(--wp--preset--spacing--large)"><!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|extra-large"}}},"textColor":"text-body","fontSize":"regular-plus"} -->
<p class="has-text-body-color has-text-color has-regular-plus-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--extra-large)"><?php echo esc_html__( '&#8220;They asked the questions our last designer didn&#8217;t. The site finally feels like ours, not a template we tried to make fit.&#8221;', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|compact"}},"layout":{"type":"flex","verticalAlignment":"center"}} -->
<div class="wp-block-group"><!-- wp:image {"aspectRatio":"1","linkDestination":"none","width":"48px","height":"48px","className":"is-style-rounded-full"} -->
<figure class="wp-block-image is-resized is-style-rounded-full"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/cards/card-testimonial-1.webp" alt="<?php esc_attr_e( 'Hands holding a cup of tea beside simple tea packaging and loose leaves.', 'origin-canvas' ); ?>" style="aspect-ratio:1;width:48px;height:48px"/></figure>
<!-- /wp:image -->

<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading","fontSize":"regular"} -->
<p class="has-text-heading-color has-text-color has-regular-font-size" style="margin-top:0;margin-bottom:0;font-weight:600"><?php echo esc_html__( 'Sarah Jenkins', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-body","fontSize":"small"} -->
<p class="has-text-body-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Founder, Hartwell Tea Co.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
