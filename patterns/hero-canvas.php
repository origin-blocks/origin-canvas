<?php
/**
 * Title: Hero Canvas
 * Slug: origin-canvas/hero-canvas
 * Description: A hero on a faint grid backdrop with a soft corner glow, two calls to action and a meta line.
 * Categories: origin-canvas/hero
 * Keywords: landing page, introduction, centered, gradient, theme
 * Viewport Width: 1500
 * Block Types:
 * Post Types:
 * Inserter: true
 *
 * @package Origin
 */

?>
<!-- wp:group {"tagName":"section","align":"full","className":"origin-canvas-canvas-grid","style":{"spacing":{"padding":{"top":"var:preset|spacing|massive","bottom":"var:preset|spacing|massive"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull origin-canvas-canvas-grid" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--massive);padding-bottom:var(--wp--preset--spacing--massive)"><!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|large"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide"><!-- wp:paragraph {"className":"origin-canvas-eyebrow","style":{"typography":{"textTransform":"uppercase","fontWeight":"600","letterSpacing":"0.06em","textAlign":"center"},"spacing":{"margin":{"bottom":"var:preset|spacing|small"}}},"textColor":"primary","fontSize":"small"} -->
<p class="origin-canvas-eyebrow has-text-align-center has-primary-color has-text-color has-small-font-size" style="margin-bottom:var(--wp--preset--spacing--small);font-weight:600;letter-spacing:0.06em;text-transform:uppercase"><?php echo esc_html__( 'The Origin Canvas block theme', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":1,"align":"wide","className":"origin-canvas-text-balance","style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"typography":{"lineHeight":"1.02","textAlign":"center"}},"fontSize":"display-2xl"} -->
<h1 class="wp-block-heading has-text-align-center alignwide origin-canvas-text-balance has-display-2-xl-font-size" style="margin-top:0;margin-bottom:0;line-height:1.02"><?php echo esc_html__( 'Sites that look designed, not assembled.', 'origin-canvas' ); ?></h1>
<!-- /wp:heading -->

<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"textAlign":"center"}},"textColor":"text-body","fontSize":"medium"} -->
<p class="has-text-align-center has-text-body-color has-text-color has-medium-font-size"><?php echo esc_html__( 'A Full Site Editing theme where templates, patterns, typography, and color work as one system, so every build starts closer to finished.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|medium","margin":{"top":"var:preset|spacing|extra-large"}}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--extra-large)"><!-- wp:buttons {"layout":{"type":"flex"}} -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button"><?php echo esc_html__( 'Download free', 'origin-canvas' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->

<!-- wp:paragraph {"style":{"typography":{"fontWeight":"500"},"elements":{"link":{"typography":{"textDecoration":"none"}}}},"textColor":"text-heading","fontSize":"regular"} -->
<p class="has-text-heading-color has-text-color has-regular-font-size" style="font-weight:500"><a href="#" style="text-decoration:none"><?php echo esc_html__( 'Explore patterns', 'origin-canvas' ); ?> <span aria-hidden="true">&rarr;</span></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"textColor":"text-muted","fontSize":"small","style":{"spacing":{"margin":{"top":"var:preset|spacing|large","bottom":"0"}},"typography":{"textAlign":"center"}}} -->
<p class="has-text-align-center has-text-muted-color has-text-color has-small-font-size" style="margin-top:var(--wp--preset--spacing--large);margin-bottom:0"><?php echo esc_html__( 'GPL licensed &middot; WordPress 7.0+ &middot; No page builder required', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
