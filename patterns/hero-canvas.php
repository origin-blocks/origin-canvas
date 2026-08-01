<?php
/**
 * Title: Hero Canvas
 * Slug: origin-canvas/hero-canvas
 * Categories: origin-canvas/hero
 * Keywords: hero, landing, intro, centered, theme, gradient
 * Block Types: core/post-content
 * Inserter: true
 *
 * @package Origin
 */

?>
<!-- wp:group {"tagName":"section","align":"full","className":"origin-canvas-canvas-grid","style":{"spacing":{"padding":{"top":"var:preset|spacing|massive","bottom":"var:preset|spacing|massive"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained","contentSize":"880px","wideSize":"1200px"}} -->
<section class="wp-block-group alignfull origin-canvas-canvas-grid" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--massive);padding-bottom:var(--wp--preset--spacing--massive)"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|large"}},"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","fontWeight":"600","letterSpacing":"0.08em"},"spacing":{"margin":{"bottom":"var:preset|spacing|small"}}},"textColor":"primary","fontSize":"small"} -->
<p class="has-text-align-center has-primary-color has-text-color has-small-font-size" style="margin-bottom:var(--wp--preset--spacing--small);font-weight:600;letter-spacing:0.08em;text-transform:uppercase"><?php echo esc_html__( 'The Origin Canvas block theme', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","level":1,"style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"typography":{"letterSpacing":"-0.035em","lineHeight":"1.02","fontWeight":"800"}},"fontSize":"display-2xl"} -->
<h1 class="wp-block-heading has-text-align-center has-display-2-xl-font-size" style="margin-top:0;margin-bottom:0;font-weight:800;letter-spacing:-0.035em;line-height:1.02"><?php echo esc_html__( 'Sites that look designed, not assembled.', 'origin-canvas' ); ?></h1>
<!-- /wp:heading -->

<!-- wp:group {"layout":{"type":"constrained","contentSize":"600px"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"align":"center","textColor":"text-body","fontSize":"medium"} -->
<p class="has-text-align-center has-text-body-color has-text-color has-medium-font-size"><?php echo esc_html__( 'A Full Site Editing theme where templates, patterns, typography, and color work as one system, so every build starts closer to finished.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|medium","margin":{"top":"var:preset|spacing|extra-large"}}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--extra-large)"><!-- wp:buttons {"layout":{"type":"flex"}} -->
<div class="wp-block-buttons is-layout-flex"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button"><?php echo esc_html__( 'Download free', 'origin-canvas' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->

<!-- wp:paragraph {"style":{"typography":{"fontWeight":"500"},"elements":{"link":{"color":{"text":"var:preset|color|text-heading"},"typography":{"textDecoration":"none"}}}},"textColor":"text-heading","fontSize":"regular"} -->
<p class="has-text-heading-color has-text-color has-link-color has-regular-font-size" style="font-weight:500"><a href="#" style="text-decoration:none"><?php echo esc_html__( 'Explore patterns', 'origin-canvas' ); ?></a> <span class="has-primary-color has-text-color" style="color:var(--wp--preset--color--primary)" aria-hidden="true">&rarr;</span></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"align":"center","textColor":"text-muted","fontSize":"small","style":{"spacing":{"margin":{"top":"var:preset|spacing|large","bottom":"0"}}}} -->
<p class="has-text-align-center has-text-muted-color has-text-color has-small-font-size" style="margin-top:var(--wp--preset--spacing--large);margin-bottom:0"><span aria-hidden="true" style="background-color:var(--wp--preset--color--primary);border-radius:999px;display:inline-block;height:7px;margin-right:10px;vertical-align:middle;width:7px"></span><?php echo esc_html__( 'GPL licensed &middot; WordPress 6.5+ &middot; No page builder required', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
