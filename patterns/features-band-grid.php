<?php
/**
 * Title: Features Band Grid
 * Slug: origin-canvas/features-band-grid
 * Description: A tinted band with an eyebrow, a centered heading, a short lead and three columns, each with a title and a sentence under a thin line.
 * Categories: origin-canvas/features
 * Keywords: services, capabilities, offerings, what we do, home page
 * Viewport Width: 1500
 * Block Types:
 * Post Types:
 * Inserter: true
 *
 * @package Origin
 */

?>
<!-- wp:group {"tagName":"section","align":"full","backgroundColor":"surface-muted","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"var:preset|spacing|colossal","bottom":"var:preset|spacing|colossal"},"blockGap":"var:preset|spacing|extra-large"}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-surface-muted-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--colossal);padding-bottom:var(--wp--preset--spacing--colossal)"><!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|medium","margin":{"bottom":"var:preset|spacing|huge"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide" style="margin-bottom:var(--wp--preset--spacing--huge)"><!-- wp:paragraph {"className":"origin-canvas-eyebrow","align":"center","style":{"typography":{"textTransform":"uppercase","fontWeight":"600","letterSpacing":"0.06em"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|medium"}}},"textColor":"primary","fontSize":"extra-small"} -->
<p class="origin-canvas-eyebrow has-text-align-center has-primary-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--medium);font-weight:600;letter-spacing:0.06em;text-transform:uppercase"><?php echo esc_html__( 'What we do', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","level":2,"align":"wide","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"fontSize":"display"} -->
<h2 class="wp-block-heading has-text-align-center alignwide has-display-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Brands and websites that fit', 'origin-canvas' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"var:preset|spacing|compact"}}},"textColor":"text-body","fontSize":"regular-plus"} -->
<p class="has-text-align-center has-text-body-color has-text-color has-regular-plus-font-size" style="margin-top:var(--wp--preset--spacing--compact)"><?php echo esc_html__( 'We design the identity, build the site and write the copy for it, all in one studio.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:columns {"align":"wide","verticalAlignment":"stretch","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|large","left":"var:preset|spacing|large"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-stretch"><!-- wp:column {"verticalAlignment":"stretch"} -->
<div class="wp-block-column is-vertically-aligned-stretch"><!-- wp:group {"style":{"border":{"top":{"color":"var:preset|color|input-border","width":"1px"}},"spacing":{"padding":{"top":"var:preset|spacing|large"},"blockGap":"var:preset|spacing|small"}},"layout":{"type":"constrained","justifyContent":"left"}} -->
<div class="wp-block-group" style="border-top-color:var(--wp--preset--color--input-border);border-top-width:1px;padding-top:var(--wp--preset--spacing--large)"><!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"bottom":"0"}}},"fontSize":"medium"} -->
<h3 class="wp-block-heading has-medium-font-size" style="margin-bottom:0"><?php echo esc_html__( 'Brand identity', 'origin-canvas' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"text-body","fontSize":"regular"} -->
<p class="has-text-body-color has-text-color has-regular-font-size"><?php echo esc_html__( 'A mark, palette, and type choices your team can keep using long after handover.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"stretch"} -->
<div class="wp-block-column is-vertically-aligned-stretch"><!-- wp:group {"style":{"border":{"top":{"color":"var:preset|color|input-border","width":"1px"}},"spacing":{"padding":{"top":"var:preset|spacing|large"},"blockGap":"var:preset|spacing|small"}},"layout":{"type":"constrained","justifyContent":"left"}} -->
<div class="wp-block-group" style="border-top-color:var(--wp--preset--color--input-border);border-top-width:1px;padding-top:var(--wp--preset--spacing--large)"><!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"bottom":"0"}}},"fontSize":"medium"} -->
<h3 class="wp-block-heading has-medium-font-size" style="margin-bottom:0"><?php echo esc_html__( 'Websites', 'origin-canvas' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"text-body","fontSize":"regular"} -->
<p class="has-text-body-color has-text-color has-regular-font-size"><?php echo esc_html__( 'A site you can edit on a quiet Tuesday afternoon, with clear pages and no needless moving parts.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"stretch"} -->
<div class="wp-block-column is-vertically-aligned-stretch"><!-- wp:group {"style":{"border":{"top":{"color":"var:preset|color|input-border","width":"1px"}},"spacing":{"padding":{"top":"var:preset|spacing|large"},"blockGap":"var:preset|spacing|small"}},"layout":{"type":"constrained","justifyContent":"left"}} -->
<div class="wp-block-group" style="border-top-color:var(--wp--preset--color--input-border);border-top-width:1px;padding-top:var(--wp--preset--spacing--large)"><!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"bottom":"0"}}},"fontSize":"medium"} -->
<h3 class="wp-block-heading has-medium-font-size" style="margin-bottom:0"><?php echo esc_html__( 'Copywriting', 'origin-canvas' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"text-body","fontSize":"regular"} -->
<p class="has-text-body-color has-text-color has-regular-font-size"><?php echo esc_html__( 'Plain, considered copy written alongside the design, so every page sounds like it belongs to you.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->
