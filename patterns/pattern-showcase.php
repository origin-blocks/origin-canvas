<?php
/**
 * Title: Pattern Showcase
 * Slug: origin-canvas/pattern-showcase
 * Description: A full-bleed gradient tile board showcasing the pattern library on the theme landing page.
 * Categories: origin-canvas/features
 * Keywords: marketing, gallery, preview, catalog
 * Viewport Width: 1500
 * Block Types:
 * Post Types:
 * Inserter: true
 *
 * @package Origin
 */

?>
<!-- wp:group {"anchor":"patterns","tagName":"section","align":"full","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"var:preset|spacing|colossal","bottom":"var:preset|spacing|colossal"}}},"layout":{"type":"constrained"}} -->
<section id="patterns" class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--colossal);padding-bottom:var(--wp--preset--spacing--colossal)"><!-- wp:paragraph {"className":"origin-canvas-eyebrow","align":"center","style":{"typography":{"textTransform":"uppercase","fontWeight":"600","letterSpacing":"0.12em"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|medium"}}},"textColor":"primary","fontSize":"small"} -->
<p class="origin-canvas-eyebrow has-text-align-center has-primary-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--medium);font-weight:600;letter-spacing:0.12em;text-transform:uppercase"><?php echo esc_html__( 'Pattern library', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","level":2,"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"fontSize":"display"} -->
<h2 class="wp-block-heading has-text-align-center has-display-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( '86 patterns. 18 categories. One design language.', 'origin-canvas' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|compact"}}},"layout":{"type":"constrained","contentSize":"640px"}} -->
<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--compact)"><!-- wp:paragraph {"align":"center","textColor":"text-body","fontSize":"regular-plus"} -->
<p class="has-text-align-center has-text-body-color has-text-color has-regular-plus-font-size"><?php echo esc_html__( 'Every pattern is built from core blocks and bound to the theme presets, so it drops in editable and on-brand. Assemble a full page in an afternoon, or start from a single section and grow.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"full","className":"origin-canvas-pattern-board","style":{"spacing":{"blockGap":"0"}},"layout":{"type":"default"}} -->
<div class="wp-block-group alignfull origin-canvas-pattern-board"><!-- wp:group {"className":"origin-canvas-wash-tile origin-canvas-wash-hero","style":{"dimensions":{"minHeight":"240px"}}} -->
<div class="wp-block-group origin-canvas-wash-tile origin-canvas-wash-hero" style="min-height:240px"></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-wash-tile origin-canvas-wash-features","style":{"dimensions":{"minHeight":"240px"}}} -->
<div class="wp-block-group origin-canvas-wash-tile origin-canvas-wash-features" style="min-height:240px"></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-wash-tile origin-canvas-wash-testimonial","style":{"dimensions":{"minHeight":"240px"}}} -->
<div class="wp-block-group origin-canvas-wash-tile origin-canvas-wash-testimonial" style="min-height:240px"></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-wash-tile origin-canvas-wash-pricing","style":{"dimensions":{"minHeight":"240px"}}} -->
<div class="wp-block-group origin-canvas-wash-tile origin-canvas-wash-pricing" style="min-height:240px"></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-wash-tile origin-canvas-wash-cta","style":{"dimensions":{"minHeight":"240px"}}} -->
<div class="wp-block-group origin-canvas-wash-tile origin-canvas-wash-cta" style="min-height:240px"></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-wash-tile origin-canvas-wash-editor","style":{"dimensions":{"minHeight":"240px"}}} -->
<div class="wp-block-group origin-canvas-wash-tile origin-canvas-wash-editor" style="min-height:240px"></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontWeight":"500"},"spacing":{"margin":{"top":"var:preset|spacing|extra-large","bottom":"0"}},"elements":{"link":{"typography":{"textDecoration":"none"}}}},"textColor":"text-heading","fontSize":"regular"} -->
<p class="has-text-align-center has-text-heading-color has-text-color has-regular-font-size" style="margin-top:var(--wp--preset--spacing--extra-large);margin-bottom:0;font-weight:500"><a href="#" style="text-decoration:none"><?php echo esc_html__( 'Explore all patterns', 'origin-canvas' ); ?> <span aria-hidden="true">&rarr;</span></a></p>
<!-- /wp:paragraph --></section>
<!-- /wp:group -->
