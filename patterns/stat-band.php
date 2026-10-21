<?php
/**
 * Title: Stat Band
 * Slug: origin-canvas/stat-band
 * Description: A dark band with a short statement and three figures, each over a label.
 * Categories: origin-canvas/stats
 * Keywords: metrics, numbers, results
 * Block Types: core/post-content
 * Viewport Width: 1500
 * Inserter: true
 *
 * @package Origin
 */

?>
<!-- wp:group {"tagName":"section","align":"full","backgroundColor":"text-heading","textColor":"on-dark","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"var:preset|spacing|colossal","bottom":"var:preset|spacing|colossal"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-on-dark-color has-text-heading-background-color has-text-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--colossal);padding-bottom:var(--wp--preset--spacing--colossal)"><!-- wp:paragraph {"className":"origin-canvas-eyebrow","style":{"typography":{"textTransform":"uppercase","fontWeight":"600","letterSpacing":"0.06em","textAlign":"center"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|medium"}}},"textColor":"primary","fontSize":"extra-small"} -->
<p class="origin-canvas-eyebrow has-text-align-center has-primary-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--medium);font-weight:600;letter-spacing:0.06em;text-transform:uppercase"><?php echo esc_html__( 'By the numbers', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontWeight":"500","lineHeight":"1.25","textAlign":"center"},"spacing":{"margin":{"top":"0","right":"auto","bottom":"var:preset|spacing|colossal","left":"auto"}}},"fontSize":"display"} -->
<p class="has-text-align-center has-display-font-size" style="margin-top:0;margin-right:auto;margin-bottom:var(--wp--preset--spacing--colossal);margin-left:auto;font-weight:500;line-height:1.25"><?php echo wp_kses_post( __( 'A small studio with a long memory. <span style="opacity:0.72">We answer our own emails, write our own contracts, and make work that holds up years after we deliver it.</span>', 'origin-canvas' ) ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:columns {"align":"wide","style":{"border":{"top":{"color":"color-mix(in srgb, var(--wp--custom--dark--text) 12%, transparent)","width":"1px"}},"spacing":{"padding":{"top":"var:preset|spacing|huge"},"blockGap":{"top":"var:preset|spacing|large","left":"var:preset|spacing|large"}}}} -->
<div class="wp-block-columns alignwide" style="border-top-color:color-mix(in srgb, var(--wp--custom--dark--text) 12%, transparent);border-top-width:1px;padding-top:var(--wp--preset--spacing--huge)"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:paragraph {"className":"origin-canvas-figure","style":{"typography":{"fontWeight":"700","lineHeight":"1","textAlign":"center"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|medium"}}},"textColor":"primary","fontSize":"display-2xl"} -->
<p class="origin-canvas-figure has-text-align-center has-primary-color has-text-color has-display-2-xl-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--medium);font-weight:700;line-height:1"><?php echo esc_html__( '38', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"color":{"text":"color-mix(in srgb, var(--wp--custom--dark--text) 72%, transparent)"},"spacing":{"margin":{"top":"0","bottom":"0"}},"typography":{"textAlign":"center"}},"fontSize":"small"} -->
<p class="has-text-align-center has-text-color has-small-font-size" style="color:color-mix(in srgb, var(--wp--custom--dark--text) 72%, transparent);margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Sites launched', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:paragraph {"className":"origin-canvas-figure","style":{"typography":{"fontWeight":"700","lineHeight":"1","textAlign":"center"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|medium"}}},"textColor":"primary","fontSize":"display-2xl"} -->
<p class="origin-canvas-figure has-text-align-center has-primary-color has-text-color has-display-2-xl-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--medium);font-weight:700;line-height:1"><?php echo esc_html__( '8', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"color":{"text":"color-mix(in srgb, var(--wp--custom--dark--text) 72%, transparent)"},"spacing":{"margin":{"top":"0","bottom":"0"}},"typography":{"textAlign":"center"}},"fontSize":"small"} -->
<p class="has-text-align-center has-text-color has-small-font-size" style="color:color-mix(in srgb, var(--wp--custom--dark--text) 72%, transparent);margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Years working together', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:paragraph {"className":"origin-canvas-figure","style":{"typography":{"fontWeight":"700","lineHeight":"1","textAlign":"center"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|medium"}}},"textColor":"primary","fontSize":"display-2xl"} -->
<p class="origin-canvas-figure has-text-align-center has-primary-color has-text-color has-display-2-xl-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--medium);font-weight:700;line-height:1"><?php echo esc_html__( '94%', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"color":{"text":"color-mix(in srgb, var(--wp--custom--dark--text) 72%, transparent)"},"spacing":{"margin":{"top":"0","bottom":"0"}},"typography":{"textAlign":"center"}},"fontSize":"small"} -->
<p class="has-text-align-center has-text-color has-small-font-size" style="color:color-mix(in srgb, var(--wp--custom--dark--text) 72%, transparent);margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Repeat or referral clients', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->
