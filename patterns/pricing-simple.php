<?php
/**
 * Title: Pricing Grid
 * Slug: origin-canvas/pricing-simple
 * Description: Three plan columns without cards, each opening on a hairline rule, with a price, feature list, and button.
 * Categories: origin-canvas/pricing
 * Keywords: plans, tiers, rates, packages
 * Viewport Width: 1500
 * Block Types:
 * Post Types:
 * Inserter: true
 *
 * @package Origin
 */

?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|colossal","bottom":"var:preset|spacing|colossal"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--colossal);padding-bottom:var(--wp--preset--spacing--colossal)"><!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|small","margin":{"bottom":"var:preset|spacing|extra-large"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide" style="margin-bottom:var(--wp--preset--spacing--extra-large)"><!-- wp:heading {"align":"wide","style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"typography":{"textAlign":"center"}},"fontSize":"display"} -->
<h2 class="wp-block-heading has-text-align-center alignwide has-display-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Three ways to start', 'origin-canvas' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"textAlign":"center"}},"textColor":"contrast-2","fontSize":"regular-plus"} -->
<p class="has-text-align-center has-contrast-2-color has-text-color has-regular-plus-font-size"><?php echo esc_html__( 'Every engagement is scoped in writing before we begin, so the invoice never surprises you.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:columns {"verticalAlignment":"stretch","align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|large","left":"var:preset|spacing|large"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-stretch"><!-- wp:column {"verticalAlignment":"stretch","style":{"border":{"top":{"color":"var:preset|color|base-5","width":"1px"}},"spacing":{"padding":{"top":"var:preset|spacing|large"}}}} -->
<div class="wp-block-column is-vertically-aligned-stretch" style="border-top-color:var(--wp--preset--color--base-5);border-top-width:1px;padding-top:var(--wp--preset--spacing--large)"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|small"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","letterSpacing":"0.06em","fontWeight":"500"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"contrast","fontSize":"extra-small"} -->
<p class="has-contrast-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:0;font-weight:500;letter-spacing:0.06em;text-transform:uppercase"><?php echo esc_html__( 'Starter', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"typography":{"fontWeight":"700","lineHeight":"1"}},"textColor":"contrast","fontSize":"huge"} -->
<p class="has-contrast-color has-text-color has-huge-font-size" style="margin-top:0;margin-bottom:0;font-weight:700;line-height:1"><?php echo wp_kses_post( __( '$2,500 <span style="font-size:var(--wp--preset--font-size--regular);font-weight:400;letter-spacing:normal;color:var(--wp--preset--color--contrast-2);">one-time</span>', 'origin-canvas' ) ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"textColor":"contrast-2","fontSize":"regular"} -->
<p class="has-contrast-2-color has-text-color has-regular-font-size"><?php echo esc_html__( 'A focused site for a small business that knows what it wants to say.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:list {"className":"is-style-origin-canvas-list-check-neutral","style":{"spacing":{"blockGap":"var:preset|spacing|small","margin":{"top":"var:preset|spacing|large"}}},"fontSize":"small"} -->
<ul style="margin-top:var(--wp--preset--spacing--large)" class="wp-block-list is-style-origin-canvas-list-check-neutral has-small-font-size"><!-- wp:list-item -->
<li><?php echo esc_html__( 'Up to five pages', 'origin-canvas' ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php echo esc_html__( 'Logo refresh', 'origin-canvas' ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php echo esc_html__( 'Two rounds of revisions', 'origin-canvas' ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php echo esc_html__( 'Three-week delivery', 'origin-canvas' ); ?></li>
<!-- /wp:list-item --></ul>
<!-- /wp:list -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|large"}}},"layout":{"type":"flex","justifyContent":"stretch"}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--large)"><!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button"><?php echo esc_html__( 'Get started', 'origin-canvas' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"stretch","className":"origin-canvas-pricing-simple-featured","style":{"border":{"top":{"color":"var:preset|color|contrast","width":"2px"}},"spacing":{"padding":{"top":"var:preset|spacing|large"}}}} -->
<div class="wp-block-column is-vertically-aligned-stretch origin-canvas-pricing-simple-featured" style="border-top-color:var(--wp--preset--color--contrast);border-top-width:2px;padding-top:var(--wp--preset--spacing--large)"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|small"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","letterSpacing":"0.06em","fontWeight":"500"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"contrast","fontSize":"extra-small"} -->
<p class="has-contrast-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:0;font-weight:500;letter-spacing:0.06em;text-transform:uppercase"><?php echo esc_html__( 'Studio', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"typography":{"fontWeight":"700","lineHeight":"1"}},"textColor":"contrast","fontSize":"huge"} -->
<p class="has-contrast-color has-text-color has-huge-font-size" style="margin-top:0;margin-bottom:0;font-weight:700;line-height:1"><?php echo wp_kses_post( __( '$8,000 <span style="font-size:var(--wp--preset--font-size--regular);font-weight:400;letter-spacing:normal;color:var(--wp--preset--color--contrast-2);">one-time</span>', 'origin-canvas' ) ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"textColor":"contrast-2","fontSize":"regular"} -->
<p class="has-contrast-2-color has-text-color has-regular-font-size"><?php echo esc_html__( 'Our standard engagement: brand work, site, and a hand-written launch checklist.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:list {"className":"is-style-origin-canvas-list-check-neutral","style":{"spacing":{"blockGap":"var:preset|spacing|small","margin":{"top":"var:preset|spacing|large"}}},"fontSize":"small"} -->
<ul style="margin-top:var(--wp--preset--spacing--large)" class="wp-block-list is-style-origin-canvas-list-check-neutral has-small-font-size"><!-- wp:list-item -->
<li><?php echo esc_html__( 'Up to eight pages', 'origin-canvas' ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php echo esc_html__( 'Full identity (mark, color, type)', 'origin-canvas' ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php echo esc_html__( 'Photography direction', 'origin-canvas' ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php echo esc_html__( 'Eight-week delivery', 'origin-canvas' ); ?></li>
<!-- /wp:list-item --></ul>
<!-- /wp:list -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|large"}}},"layout":{"type":"flex","justifyContent":"stretch"}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--large)"><!-- wp:button {"className":"is-style-origin-canvas-fill-primary"} -->
<div class="wp-block-button is-style-origin-canvas-fill-primary"><a class="wp-block-button__link wp-element-button"><?php echo esc_html__( 'Talk to us', 'origin-canvas' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"stretch","style":{"border":{"top":{"color":"var:preset|color|base-5","width":"1px"}},"spacing":{"padding":{"top":"var:preset|spacing|large"}}}} -->
<div class="wp-block-column is-vertically-aligned-stretch" style="border-top-color:var(--wp--preset--color--base-5);border-top-width:1px;padding-top:var(--wp--preset--spacing--large)"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|small"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","letterSpacing":"0.06em","fontWeight":"500"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"contrast","fontSize":"extra-small"} -->
<p class="has-contrast-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:0;font-weight:500;letter-spacing:0.06em;text-transform:uppercase"><?php echo esc_html__( 'Retained', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"typography":{"fontWeight":"700","lineHeight":"1"}},"textColor":"contrast","fontSize":"huge"} -->
<p class="has-contrast-color has-text-color has-huge-font-size" style="margin-top:0;margin-bottom:0;font-weight:700;line-height:1"><?php echo wp_kses_post( __( '$1,800 <span style="font-size:var(--wp--preset--font-size--regular);font-weight:400;letter-spacing:normal;color:var(--wp--preset--color--contrast-2);">per month</span>', 'origin-canvas' ) ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"textColor":"contrast-2","fontSize":"regular"} -->
<p class="has-contrast-2-color has-text-color has-regular-font-size"><?php echo esc_html__( 'For clients who treat their site like a living thing, not a one-time project.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:list {"className":"is-style-origin-canvas-list-check-neutral","style":{"spacing":{"blockGap":"var:preset|spacing|small","margin":{"top":"var:preset|spacing|large"}}},"fontSize":"small"} -->
<ul style="margin-top:var(--wp--preset--spacing--large)" class="wp-block-list is-style-origin-canvas-list-check-neutral has-small-font-size"><!-- wp:list-item -->
<li><?php echo esc_html__( 'Up to two days of work a month', 'origin-canvas' ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php echo esc_html__( 'Quarterly review calls', 'origin-canvas' ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php echo esc_html__( 'Priority response', 'origin-canvas' ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php echo esc_html__( 'Six-month minimum', 'origin-canvas' ); ?></li>
<!-- /wp:list-item --></ul>
<!-- /wp:list -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|large"}}},"layout":{"type":"flex","justifyContent":"stretch"}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--large)"><!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button"><?php echo esc_html__( 'Inquire', 'origin-canvas' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->
