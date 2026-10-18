<?php
/**
 * Title: Features List
 * Slug: origin-canvas/features-accordion
 * Description: A centered heading over a stacked list of services that expand to reveal a short description and a text link.
 * Categories: origin-canvas/features
 * Keywords: expandable, collapsible, offerings, capabilities, toggle
 * Block Types:
 * Post Types:
 * Inserter: true
 *
 * @package Origin
 */

?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"var:preset|spacing|colossal","bottom":"var:preset|spacing|colossal"},"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--colossal);padding-bottom:var(--wp--preset--spacing--colossal)"><!-- wp:heading {"level":2,"style":{"typography":{"lineHeight":"1.1","textAlign":"center"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|extra-large"}}},"textColor":"text-heading","fontSize":"huge"} -->
<h2 class="wp-block-heading has-text-align-center has-text-heading-color has-text-color has-huge-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--extra-large);line-height:1.1"><?php echo esc_html__( 'We make brands, websites and copy', 'origin-canvas' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:accordion {"className":"is-style-origin-canvas-accordion-minimal"} -->
<div role="group" class="wp-block-accordion is-style-origin-canvas-accordion-minimal"><!-- wp:accordion-item -->
<div class="wp-block-accordion-item"><!-- wp:accordion-heading {"level":3,"style":{"typography":{"lineHeight":"1.4"}},"textColor":"text-heading","fontSize":"regular-plus"} -->
<h3 class="wp-block-accordion-heading has-icon has-icon-right has-text-heading-color has-text-color has-regular-plus-font-size" style="line-height:1.4"><button type="button" class="wp-block-accordion-heading__toggle"><span class="wp-block-accordion-heading__toggle-title"><?php echo esc_html__( 'Brand identity', 'origin-canvas' ); ?></span><span class="wp-block-accordion-heading__toggle-icon" aria-hidden="true">+</span></button></h3>
<!-- /wp:accordion-heading -->

<!-- wp:accordion-panel -->
<div role="region" class="wp-block-accordion-panel"><!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-body","fontSize":"regular-plus"} -->
<p class="has-text-body-color has-text-color has-regular-plus-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'A mark, a color palette and type, set out in a short guide you can hand to a printer or a developer. Four weeks, $3,500.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading","fontSize":"regular"} -->
<p class="has-text-heading-color has-text-color has-regular-font-size" style="margin-top:0;margin-bottom:0;font-weight:600"><a href="#" style="text-decoration:none"><?php echo esc_html__( 'See identity work', 'origin-canvas' ); ?> <span aria-hidden="true">&rarr;</span></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:accordion-panel --></div>
<!-- /wp:accordion-item -->

<!-- wp:accordion-item -->
<div class="wp-block-accordion-item"><!-- wp:accordion-heading {"level":3,"style":{"typography":{"lineHeight":"1.4"}},"textColor":"text-heading","fontSize":"regular-plus"} -->
<h3 class="wp-block-accordion-heading has-icon has-icon-right has-text-heading-color has-text-color has-regular-plus-font-size" style="line-height:1.4"><button type="button" class="wp-block-accordion-heading__toggle"><span class="wp-block-accordion-heading__toggle-title"><?php echo esc_html__( 'Websites', 'origin-canvas' ); ?></span><span class="wp-block-accordion-heading__toggle-icon" aria-hidden="true">+</span></button></h3>
<!-- /wp:accordion-heading -->

<!-- wp:accordion-panel -->
<div role="region" class="wp-block-accordion-panel"><!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-body","fontSize":"regular-plus"} -->
<p class="has-text-body-color has-text-color has-regular-plus-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'A site that looks right on a phone and a desktop, with the pages you need and a clear way for customers to reach you. Six weeks, $4,500.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading","fontSize":"regular"} -->
<p class="has-text-heading-color has-text-color has-regular-font-size" style="margin-top:0;margin-bottom:0;font-weight:600"><a href="#" style="text-decoration:none"><?php echo esc_html__( 'See website work', 'origin-canvas' ); ?> <span aria-hidden="true">&rarr;</span></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:accordion-panel --></div>
<!-- /wp:accordion-item -->

<!-- wp:accordion-item -->
<div class="wp-block-accordion-item"><!-- wp:accordion-heading {"level":3,"style":{"typography":{"lineHeight":"1.4"}},"textColor":"text-heading","fontSize":"regular-plus"} -->
<h3 class="wp-block-accordion-heading has-icon has-icon-right has-text-heading-color has-text-color has-regular-plus-font-size" style="line-height:1.4"><button type="button" class="wp-block-accordion-heading__toggle"><span class="wp-block-accordion-heading__toggle-title"><?php echo esc_html__( 'Copywriting', 'origin-canvas' ); ?></span><span class="wp-block-accordion-heading__toggle-icon" aria-hidden="true">+</span></button></h3>
<!-- /wp:accordion-heading -->

<!-- wp:accordion-panel -->
<div role="region" class="wp-block-accordion-panel"><!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-body","fontSize":"regular-plus"} -->
<p class="has-text-body-color has-text-color has-regular-plus-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Copy that sounds like you, for a new site or the one you have. We quote each job once we know the pages.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading","fontSize":"regular"} -->
<p class="has-text-heading-color has-text-color has-regular-font-size" style="margin-top:0;margin-bottom:0;font-weight:600"><a href="#" style="text-decoration:none"><?php echo esc_html__( 'See copy samples', 'origin-canvas' ); ?> <span aria-hidden="true">&rarr;</span></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:accordion-panel --></div>
<!-- /wp:accordion-item -->

<!-- wp:accordion-item -->
<div class="wp-block-accordion-item"><!-- wp:accordion-heading {"level":3,"style":{"typography":{"lineHeight":"1.4"}},"textColor":"text-heading","fontSize":"regular-plus"} -->
<h3 class="wp-block-accordion-heading has-icon has-icon-right has-text-heading-color has-text-color has-regular-plus-font-size" style="line-height:1.4"><button type="button" class="wp-block-accordion-heading__toggle"><span class="wp-block-accordion-heading__toggle-title"><?php echo esc_html__( 'Care after launch', 'origin-canvas' ); ?></span><span class="wp-block-accordion-heading__toggle-icon" aria-hidden="true">+</span></button></h3>
<!-- /wp:accordion-heading -->

<!-- wp:accordion-panel -->
<div role="region" class="wp-block-accordion-panel"><!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-body","fontSize":"regular-plus"} -->
<p class="has-text-body-color has-text-color has-regular-plus-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Fixes, updates and new pages once the site is live. Ongoing care costs $1,800 a month.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading","fontSize":"regular"} -->
<p class="has-text-heading-color has-text-color has-regular-font-size" style="margin-top:0;margin-bottom:0;font-weight:600"><a href="#" style="text-decoration:none"><?php echo esc_html__( 'See care plans', 'origin-canvas' ); ?> <span aria-hidden="true">&rarr;</span></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:accordion-panel --></div>
<!-- /wp:accordion-item --></div>
<!-- /wp:accordion --></section>
<!-- /wp:group -->
