<?php
/**
 * Title: Testimonial Grid
 * Slug: origin-canvas/testimonial-grid
 * Description: A grid of testimonial quotes from multiple clients with author attribution.
 * Categories: origin-canvas/testimonial
 * Keywords: quote, clients, review, social proof
 * Viewport Width: 1500
 * Block Types:
 * Post Types:
 * Inserter: true
 *
 * @package Origin
 */

?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|jumbo","bottom":"var:preset|spacing|jumbo"},"blockGap":"var:preset|spacing|huge"}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--jumbo);padding-bottom:var(--wp--preset--spacing--jumbo)"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|medium","margin":{"bottom":"var:preset|spacing|huge"}}},"layout":{"type":"constrained","contentSize":"720px"}} -->
<div class="wp-block-group" style="margin-bottom:var(--wp--preset--spacing--huge)"><!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","fontWeight":"600","letterSpacing":"0.08em"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|medium"}}},"textColor":"primary","fontSize":"extra-small"} -->
<p class="has-text-align-center has-primary-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--medium);font-weight:600;letter-spacing:0.08em;text-transform:uppercase"><?php echo esc_html__( 'Testimonials', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","level":2,"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"fontSize":"display"} -->
<h2 class="wp-block-heading has-text-align-center has-display-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'What clients say', 'origin-canvas' ); ?></h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:columns {"align":"wide","verticalAlignment":"stretch","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|large","left":"var:preset|spacing|large"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-stretch"><!-- wp:column {"verticalAlignment":"stretch"} -->
<div class="wp-block-column is-vertically-aligned-stretch"><!-- wp:group {"style":{"border":{"color":"var:preset|color|border","radius":"var:custom|radius|medium","width":"1px"},"spacing":{"padding":{"top":"var:preset|spacing|extra-large","right":"var:preset|spacing|extra-large","bottom":"var:preset|spacing|extra-large","left":"var:preset|spacing|extra-large"},"blockGap":"var:preset|spacing|medium"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-border-color" style="border-color:var(--wp--preset--color--border);border-width:1px;border-radius:var(--wp--custom--radius--medium);padding-top:var(--wp--preset--spacing--extra-large);padding-right:var(--wp--preset--spacing--extra-large);padding-bottom:var(--wp--preset--spacing--extra-large);padding-left:var(--wp--preset--spacing--extra-large)"><!-- wp:html -->
<svg width="28" height="22" viewBox="0 0 40 32" fill="var(--wp--preset--color--primary)" aria-hidden="true" focusable="false"><path d="M0 32V18.5C0 8.6 5.7 1.7 15.2 0l2 4.3C11.6 6 8.6 9.4 8.4 14.2H16V32H0zm22 0V18.5C22 8.6 27.7 1.7 37.2 0l2 4.3C33.6 6 30.6 9.4 30.4 14.2H38V32H22z"></path></svg>
<!-- /wp:html -->

<!-- wp:paragraph {"style":{"typography":{"fontWeight":"500","lineHeight":"1.55"},"spacing":{"margin":{"top":"20px","bottom":"0"}}},"textColor":"text-heading","fontSize":"regular-plus"} -->
<p class="has-text-heading-color has-text-color has-regular-plus-font-size" style="margin-top:20px;margin-bottom:0;font-weight:500;line-height:1.55"><?php echo esc_html__( 'Six weeks, three rounds, and a brand we can actually grow into. Easy to brief and easier to live with.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:group {"style":{"border":{"top":{"color":"var:preset|color|border","style":"solid","width":"1px"}},"spacing":{"padding":{"top":"var:preset|spacing|medium"},"margin":{"top":"var:preset|spacing|large"},"blockGap":"var:preset|spacing|compact"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="border-top-color:var(--wp--preset--color--border);border-top-style:solid;border-top-width:1px;margin-top:var(--wp--preset--spacing--large);padding-top:var(--wp--preset--spacing--medium)"><!-- wp:image {"aspectRatio":"1","scale":"cover","width":"48px","height":"48px","sizeSlug":"full","linkDestination":"none","className":"is-style-origin-canvas-rounded-full"} -->
<figure class="wp-block-image size-full is-resized is-style-origin-canvas-rounded-full"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/patterns/images/card-testimonial-1.webp" alt="<?php esc_attr_e( 'Hands holding a cup of tea beside simple tea packaging and loose leaves.', 'origin-canvas' ); ?>" style="aspect-ratio:1;object-fit:cover;width:48px;height:48px"/></figure>
<!-- /wp:image -->

<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading","fontSize":"small"} -->
<p class="has-text-heading-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:0;font-weight:600"><?php echo esc_html__( 'Sarah Jenkins', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-body","fontSize":"small"} -->
<p class="has-text-body-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Founder, Hartwell Tea Co.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"stretch"} -->
<div class="wp-block-column is-vertically-aligned-stretch"><!-- wp:group {"style":{"border":{"color":"var:preset|color|border","radius":"var:custom|radius|medium","width":"1px"},"spacing":{"padding":{"top":"var:preset|spacing|extra-large","right":"var:preset|spacing|extra-large","bottom":"var:preset|spacing|extra-large","left":"var:preset|spacing|extra-large"},"blockGap":"var:preset|spacing|medium"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-border-color" style="border-color:var(--wp--preset--color--border);border-width:1px;border-radius:var(--wp--custom--radius--medium);padding-top:var(--wp--preset--spacing--extra-large);padding-right:var(--wp--preset--spacing--extra-large);padding-bottom:var(--wp--preset--spacing--extra-large);padding-left:var(--wp--preset--spacing--extra-large)"><!-- wp:html -->
<svg width="28" height="22" viewBox="0 0 40 32" fill="var(--wp--preset--color--primary)" aria-hidden="true" focusable="false"><path d="M0 32V18.5C0 8.6 5.7 1.7 15.2 0l2 4.3C11.6 6 8.6 9.4 8.4 14.2H16V32H0zm22 0V18.5C22 8.6 27.7 1.7 37.2 0l2 4.3C33.6 6 30.6 9.4 30.4 14.2H38V32H22z"></path></svg>
<!-- /wp:html -->

<!-- wp:paragraph {"style":{"typography":{"fontWeight":"500","lineHeight":"1.55"},"spacing":{"margin":{"top":"20px","bottom":"0"}}},"textColor":"text-heading","fontSize":"regular-plus"} -->
<p class="has-text-heading-color has-text-color has-regular-plus-font-size" style="margin-top:20px;margin-bottom:0;font-weight:500;line-height:1.55"><?php echo esc_html__( 'The site is fast, it ranks, and our team updates it without calling anyone. Exactly what we asked for.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:group {"style":{"border":{"top":{"color":"var:preset|color|border","style":"solid","width":"1px"}},"spacing":{"padding":{"top":"var:preset|spacing|medium"},"margin":{"top":"var:preset|spacing|large"},"blockGap":"var:preset|spacing|compact"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="border-top-color:var(--wp--preset--color--border);border-top-style:solid;border-top-width:1px;margin-top:var(--wp--preset--spacing--large);padding-top:var(--wp--preset--spacing--medium)"><!-- wp:image {"aspectRatio":"1","scale":"cover","width":"48px","height":"48px","sizeSlug":"full","linkDestination":"none","className":"is-style-origin-canvas-rounded-full"} -->
<figure class="wp-block-image size-full is-resized is-style-origin-canvas-rounded-full"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/patterns/images/card-image-text-2.webp" alt="<?php esc_attr_e( 'A printed house photograph and floor plan on a pale stone work surface.', 'origin-canvas' ); ?>" style="aspect-ratio:1;object-fit:cover;width:48px;height:48px"/></figure>
<!-- /wp:image -->

<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading","fontSize":"small"} -->
<p class="has-text-heading-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:0;font-weight:600"><?php echo esc_html__( 'Michael Hughes', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-body","fontSize":"small"} -->
<p class="has-text-body-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Director, Westmount Property', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"stretch"} -->
<div class="wp-block-column is-vertically-aligned-stretch"><!-- wp:group {"style":{"border":{"color":"var:preset|color|border","radius":"var:custom|radius|medium","width":"1px"},"spacing":{"padding":{"top":"var:preset|spacing|extra-large","right":"var:preset|spacing|extra-large","bottom":"var:preset|spacing|extra-large","left":"var:preset|spacing|extra-large"},"blockGap":"var:preset|spacing|medium"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-border-color" style="border-color:var(--wp--preset--color--border);border-width:1px;border-radius:var(--wp--custom--radius--medium);padding-top:var(--wp--preset--spacing--extra-large);padding-right:var(--wp--preset--spacing--extra-large);padding-bottom:var(--wp--preset--spacing--extra-large);padding-left:var(--wp--preset--spacing--extra-large)"><!-- wp:html -->
<svg width="28" height="22" viewBox="0 0 40 32" fill="var(--wp--preset--color--primary)" aria-hidden="true" focusable="false"><path d="M0 32V18.5C0 8.6 5.7 1.7 15.2 0l2 4.3C11.6 6 8.6 9.4 8.4 14.2H16V32H0zm22 0V18.5C22 8.6 27.7 1.7 37.2 0l2 4.3C33.6 6 30.6 9.4 30.4 14.2H38V32H22z"></path></svg>
<!-- /wp:html -->

<!-- wp:paragraph {"style":{"typography":{"fontWeight":"500","lineHeight":"1.55"},"spacing":{"margin":{"top":"20px","bottom":"0"}}},"textColor":"text-heading","fontSize":"regular-plus"} -->
<p class="has-text-heading-color has-text-color has-regular-plus-font-size" style="margin-top:20px;margin-bottom:0;font-weight:500;line-height:1.55"><?php echo esc_html__( 'A single page that does more work than our old five. They left out everything that was not earning its place.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:group {"style":{"border":{"top":{"color":"var:preset|color|border","style":"solid","width":"1px"}},"spacing":{"padding":{"top":"var:preset|spacing|medium"},"margin":{"top":"var:preset|spacing|large"},"blockGap":"var:preset|spacing|compact"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="border-top-color:var(--wp--preset--color--border);border-top-style:solid;border-top-width:1px;margin-top:var(--wp--preset--spacing--large);padding-top:var(--wp--preset--spacing--medium)"><!-- wp:image {"aspectRatio":"1","scale":"cover","width":"48px","height":"48px","sizeSlug":"full","linkDestination":"none","className":"is-style-origin-canvas-rounded-full"} -->
<figure class="wp-block-image size-full is-resized is-style-origin-canvas-rounded-full"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/patterns/images/card-team-1.webp" alt="<?php esc_attr_e( 'Hands reviewing blank paper at a light wooden studio desk.', 'origin-canvas' ); ?>" style="aspect-ratio:1;object-fit:cover;width:48px;height:48px"/></figure>
<!-- /wp:image -->

<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading","fontSize":"small"} -->
<p class="has-text-heading-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:0;font-weight:600"><?php echo esc_html__( 'Emma Whitaker', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-body","fontSize":"small"} -->
<p class="has-text-body-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Owner, Linden & Lark Florist', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->
