<?php
/**
 * Title: Landing Page
 * Slug: origin-canvas/page-landing-01
 * Description: The theme&#8217;s own marketing landing page: hero, pattern library, style variations, stats, templates, ecosystem, and closing call to action.
 * Categories: origin-canvas/page
 * Keywords: page, landing, marketing, theme, home
 * Viewport Width: 1500
 * Block Types:
 * Post Types:
 * Inserter: true
 *
 * @package Origin
 */

?>
<!-- wp:pattern {"slug":"origin-canvas/hero-canvas"} /-->
<!-- wp:group {"tagName":"section","align":"full","backgroundColor":"surface-subtle","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"var:preset|spacing|colossal","bottom":"var:preset|spacing|colossal"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-surface-subtle-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--colossal);padding-bottom:var(--wp--preset--spacing--colossal)"><!-- wp:group {"layout":{"type":"constrained","contentSize":"780px"}} -->
<div class="wp-block-group"><!-- wp:heading {"level":2,"style":{"typography":{"fontSize":"clamp(2rem, 3.8vw, 3rem)","fontWeight":"600","lineHeight":"1.2","letterSpacing":"-0.03em"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<h2 class="wp-block-heading" style="margin-top:0;margin-bottom:0;font-size:clamp(2rem, 3.8vw, 3rem);font-weight:600;letter-spacing:-0.03em;line-height:1.2"><?php echo wp_kses_post( __( 'Balanced type, deliberate spacing, flexible templates. <span class="has-inline-color has-text-muted-color">A clear design foundation from the first page, so the structure is already right before you write a word.</span>', 'origin-canvas' ) ); ?></h2>
<!-- /wp:heading --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"var:preset|spacing|colossal","bottom":"var:preset|spacing|colossal"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--colossal);padding-bottom:var(--wp--preset--spacing--colossal)"><!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","fontWeight":"600","letterSpacing":"0.08em"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|medium"}}},"textColor":"primary","fontSize":"extra-small"} -->
<p class="has-text-align-center has-primary-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--medium);font-weight:600;letter-spacing:0.08em;text-transform:uppercase"><?php echo esc_html__( 'Pattern library', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","level":2,"style":{"typography":{"fontSize":"clamp(2rem, 4vw, 2.75rem)"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|medium"}}}} -->
<h2 class="wp-block-heading has-text-align-center" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--medium);font-size:clamp(2rem, 4vw, 2.75rem)"><?php echo esc_html__( '62 patterns. 18 categories. One design language.', 'origin-canvas' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:group {"layout":{"type":"constrained","contentSize":"520px"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"align":"center","textColor":"text-body","fontSize":"regular-plus"} -->
<p class="has-text-align-center has-text-body-color has-text-color has-regular-plus-font-size"><?php echo esc_html__( 'Every pattern is built from core blocks and bound to the theme presets, so it drops in editable and on-brand. Assemble a full page in an afternoon, or start from a single section and grow.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"full","className":"origin-canvas-pattern-board","layout":{"type":"default"}} -->
<div class="wp-block-group alignfull origin-canvas-pattern-board"><!-- wp:group {"className":"origin-canvas-wash-tile origin-canvas-wash-hero"} -->
<div class="wp-block-group origin-canvas-wash-tile origin-canvas-wash-hero"></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-wash-tile origin-canvas-wash-features"} -->
<div class="wp-block-group origin-canvas-wash-tile origin-canvas-wash-features"></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-wash-tile origin-canvas-wash-testimonial"} -->
<div class="wp-block-group origin-canvas-wash-tile origin-canvas-wash-testimonial"></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-wash-tile origin-canvas-wash-pricing"} -->
<div class="wp-block-group origin-canvas-wash-tile origin-canvas-wash-pricing"></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-wash-tile origin-canvas-wash-cta"} -->
<div class="wp-block-group origin-canvas-wash-tile origin-canvas-wash-cta"></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-wash-tile origin-canvas-wash-editor"} -->
<div class="wp-block-group origin-canvas-wash-tile origin-canvas-wash-editor"></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontWeight":"500"},"spacing":{"margin":{"top":"var:preset|spacing|extra-large","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|text-heading"},"typography":{"textDecoration":"none"}}}},"textColor":"text-heading","fontSize":"regular"} -->
<p class="has-text-align-center has-text-heading-color has-text-color has-link-color has-regular-font-size" style="margin-top:var(--wp--preset--spacing--extra-large);margin-bottom:0;font-weight:500"><a href="#" style="text-decoration:none"><?php echo esc_html__( 'Explore all patterns', 'origin-canvas' ); ?></a> <span class="has-primary-color has-text-color" style="color:var(--wp--preset--color--primary)" aria-hidden="true">&rarr;</span></p>
<!-- /wp:paragraph --></section>
<!-- /wp:group -->
