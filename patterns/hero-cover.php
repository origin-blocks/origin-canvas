<?php
/**
 * Title: Hero Cover
 * Slug: origin-canvas/hero-cover
 * Categories: origin-canvas/hero
 * Keywords: hero, cover, case study, editorial, home
 * Block Types: core/post-content
 * Viewport Width: 1500
 * Inserter: true
 *
 * @package Origin
 */

?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|massive","bottom":"var:preset|spacing|large"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--massive);padding-bottom:var(--wp--preset--spacing--large)"><!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|medium"}},"layout":{"type":"default"}} -->
<div class="wp-block-group alignwide"><!-- wp:cover {"url":"<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/cards/card-image-text-1.webp","alt":"Tea tins, paper pouches, and loose tea arranged on a sunlit counter.","dimRatio":0,"isUserOverlayColor":false,"minHeight":600,"minHeightUnit":"px","isDark":false,"className":"origin-canvas-cover-story__frame","style":{"border":{"radius":"var:custom|radius|large"},"spacing":{"padding":{"top":"var:preset|spacing|large","right":"var:preset|spacing|large","bottom":"var:preset|spacing|large","left":"var:preset|spacing|large"}}},"layout":{"type":"default"}} -->
<div class="wp-block-cover is-light origin-canvas-cover-story__frame" style="border-radius:var(--wp--custom--radius--large);padding-top:var(--wp--preset--spacing--large);padding-right:var(--wp--preset--spacing--large);padding-bottom:var(--wp--preset--spacing--large);padding-left:var(--wp--preset--spacing--large);min-height:600px"><img class="wp-block-cover__image-background" alt="<?php esc_attr_e( 'Tea tins, paper pouches, and loose tea arranged on a sunlit counter.', 'origin-canvas' ); ?>" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/cards/card-image-text-1.webp" data-object-fit="cover"/><span aria-hidden="true" class="wp-block-cover__background has-background-dim-0 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:group {"className":"origin-canvas-cover-story__layout","layout":{"type":"default"}} -->
<div class="wp-block-group origin-canvas-cover-story__layout"><!-- wp:group {"className":"origin-canvas-cover-story__card origin-canvas-cover-story__masthead","backgroundColor":"surface-base","style":{"border":{"radius":"var:custom|radius|medium"},"spacing":{"padding":{"top":"var:preset|spacing|large","right":"var:preset|spacing|large","bottom":"var:preset|spacing|large","left":"var:preset|spacing|large"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group origin-canvas-cover-story__card origin-canvas-cover-story__masthead has-surface-base-background-color has-background" style="border-radius:var(--wp--custom--radius--medium);padding-top:var(--wp--preset--spacing--large);padding-right:var(--wp--preset--spacing--large);padding-bottom:var(--wp--preset--spacing--large);padding-left:var(--wp--preset--spacing--large)"><!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","fontWeight":"600","letterSpacing":"0.1em"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|small"}}},"textColor":"primary","fontSize":"extra-small"} -->
<p class="has-primary-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--small);font-weight:600;letter-spacing:0.1em;text-transform:uppercase"><?php echo esc_html__( 'Featured', 'origin-canvas' ); ?> &middot; <?php echo esc_html__( 'Spring 2026', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2,"style":{"typography":{"lineHeight":"1.1"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"fontSize":"huge"} -->
<h2 class="wp-block-heading has-huge-font-size" style="margin-top:0;margin-bottom:0;line-height:1.1"><?php echo esc_html__( 'Hartwell Tea Co.', 'origin-canvas' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"text-body","fontSize":"regular"} -->
<p class="has-text-body-color has-text-color has-regular-font-size"><?php echo esc_html__( 'Identity, packaging, and a small online shop for a family-run tea brand. Six weeks, three blends, one new wordmark.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"},"spacing":{"margin":{"top":"var:preset|spacing|medium","bottom":"0"}}},"textColor":"text-heading","fontSize":"regular"} -->
<p class="has-text-heading-color has-text-color has-regular-font-size" style="margin-top:var(--wp--preset--spacing--medium);margin-bottom:0;font-weight:600"><?php echo esc_html__( 'Read the case study', 'origin-canvas' ); ?> <mark style="background-color:rgba(0, 0, 0, 0)" class="has-inline-color has-primary-color">&rarr;</mark></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-cover-story__card origin-canvas-cover-story__studio-line","backgroundColor":"surface-base","style":{"border":{"radius":"var:custom|radius|medium"},"spacing":{"padding":{"top":"var:preset|spacing|large","right":"var:preset|spacing|large","bottom":"var:preset|spacing|large","left":"var:preset|spacing|large"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group origin-canvas-cover-story__card origin-canvas-cover-story__studio-line has-surface-base-background-color has-background" style="border-radius:var(--wp--custom--radius--medium);padding-top:var(--wp--preset--spacing--large);padding-right:var(--wp--preset--spacing--large);padding-bottom:var(--wp--preset--spacing--large);padding-left:var(--wp--preset--spacing--large)"><!-- wp:paragraph {"style":{"typography":{"fontWeight":"600","lineHeight":"1.2"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading","fontSize":"regular-plus"} -->
<p class="has-text-heading-color has-text-color has-regular-plus-font-size" style="margin-top:0;margin-bottom:0;font-weight:600;line-height:1.2"><?php echo esc_html__( 'Origin is a three-person studio. Brand identity and websites for small businesses.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|small","bottom":"0"}}},"textColor":"text-muted","fontSize":"small"} -->
<p class="has-text-muted-color has-text-color has-small-font-size" style="margin-top:var(--wp--preset--spacing--small);margin-bottom:0"><?php echo esc_html__( 'One project at a time, since 2018.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div></div>
<!-- /wp:cover -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|medium"}},"textColor":"text-muted","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"center"}} -->
<div class="wp-block-group has-text-muted-color has-text-color"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|medium"}},"layout":{"type":"flex","flexWrap":"wrap","verticalAlignment":"center"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"fontSize":"small"} -->
<p class="has-small-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( '01 / Cover', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:pattern {"slug":"origin-canvas/availability-marker"} /--></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"fontSize":"small"} -->
<p class="has-small-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Scroll for what we do', 'origin-canvas' ); ?> &darr;</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
