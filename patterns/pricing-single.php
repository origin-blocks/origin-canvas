<?php
/**
 * Title: Pricing Single
 * Slug: origin-canvas/pricing-single
 * Description: One centered card for a single fixed-price offer, with a two-column feature list and a reassurance line.
 * Categories: origin-canvas/pricing
 * Keywords: package, sprint, quote, deal
 * Viewport Width: 1500
 * Block Types:
 * Post Types:
 * Inserter: true
 *
 * @package Origin
 */

?>
<!-- wp:group {"tagName":"section","align":"full","backgroundColor":"surface-muted","style":{"spacing":{"padding":{"top":"var:preset|spacing|colossal","bottom":"var:preset|spacing|colossal"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-surface-muted-background-color has-background" style="padding-top:var(--wp--preset--spacing--colossal);padding-bottom:var(--wp--preset--spacing--colossal)"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|small","margin":{"bottom":"var:preset|spacing|extra-large"}}},"layout":{"type":"constrained","contentSize":"720px"}} -->
<div class="wp-block-group" style="margin-bottom:var(--wp--preset--spacing--extra-large)"><!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"fontSize":"display"} -->
<h2 class="wp-block-heading has-text-align-center has-display-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'A whole site, in two weeks', 'origin-canvas' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","textColor":"text-body","fontSize":"regular-plus"} -->
<p class="has-text-align-center has-text-body-color has-text-color has-regular-plus-font-size"><?php echo esc_html__( 'The Site Sprint: one fixed price, one focused fortnight &#8212; for businesses that already know who they are.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"backgroundColor":"surface-base","style":{"border":{"radius":"var:custom|radius|medium","top":{"color":"var:preset|color|primary","width":"4px"}},"spacing":{"padding":{"top":"var:preset|spacing|extra-large","right":"var:preset|spacing|large","bottom":"var:preset|spacing|extra-large","left":"var:preset|spacing|large"},"blockGap":"var:preset|spacing|small"}},"layout":{"type":"constrained","contentSize":"720px"}} -->
<div class="wp-block-group has-surface-base-background-color has-background" style="border-top-color:var(--wp--preset--color--primary);border-top-width:4px;border-radius:var(--wp--custom--radius--medium);padding-top:var(--wp--preset--spacing--extra-large);padding-right:var(--wp--preset--spacing--large);padding-bottom:var(--wp--preset--spacing--extra-large);padding-left:var(--wp--preset--spacing--large)"><!-- wp:paragraph {"align":"center","textColor":"primary","fontSize":"extra-small","style":{"typography":{"textTransform":"uppercase","letterSpacing":"0.08em","fontWeight":"500"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="has-text-align-center has-primary-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:0;font-weight:500;letter-spacing:0.08em;text-transform:uppercase"><?php echo esc_html__( 'The Site Sprint', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","textColor":"text-heading","fontSize":"display","style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"typography":{"fontWeight":"700","lineHeight":"1"}}} -->
<p class="has-text-align-center has-text-heading-color has-text-color has-display-font-size" style="margin-top:0;margin-bottom:0;font-weight:700;line-height:1"><?php echo wp_kses_post( __( '&pound;4,800 <span style="font-size:var(--wp--preset--font-size--regular);font-weight:400;color:var(--wp--preset--color--text-body);">one-off</span>', 'origin-canvas' ) ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained","contentSize":"480px"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"align":"center","textColor":"text-body","fontSize":"regular"} -->
<p class="has-text-align-center has-text-body-color has-text-color has-regular-font-size"><?php echo esc_html__( 'Five pages on the brand you already have &#8212; designed, built, and live in two weeks, scoped in writing before we begin.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|large"}}},"layout":{"type":"constrained","contentSize":"560px"}} -->
<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--large)"><!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|small","left":"var:preset|spacing|large"}}}} -->
<div class="wp-block-columns"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:list {"className":"is-style-origin-canvas-list-check","style":{"spacing":{"blockGap":"var:preset|spacing|small","margin":{"top":"0","bottom":"0"}}},"fontSize":"small"} -->
<ul class="wp-block-list is-style-origin-canvas-list-check has-small-font-size" style="margin-top:0;margin-bottom:0"><!-- wp:list-item --><li><?php echo esc_html__( 'Five pages, one clear story', 'origin-canvas' ); ?></li><!-- /wp:list-item -->
<!-- wp:list-item --><li><?php echo esc_html__( 'Works with your existing brand', 'origin-canvas' ); ?></li><!-- /wp:list-item -->
<!-- wp:list-item --><li><?php echo esc_html__( 'Copy polish on every page', 'origin-canvas' ); ?></li><!-- /wp:list-item --></ul>
<!-- /wp:list --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:list {"className":"is-style-origin-canvas-list-check","style":{"spacing":{"blockGap":"var:preset|spacing|small","margin":{"top":"0","bottom":"0"}}},"fontSize":"small"} -->
<ul class="wp-block-list is-style-origin-canvas-list-check has-small-font-size" style="margin-top:0;margin-bottom:0"><!-- wp:list-item --><li><?php echo esc_html__( 'One round of revisions', 'origin-canvas' ); ?></li><!-- /wp:list-item -->
<!-- wp:list-item --><li><?php echo esc_html__( 'Hand-written launch checklist', 'origin-canvas' ); ?></li><!-- /wp:list-item -->
<!-- wp:list-item --><li><?php echo esc_html__( 'Launch-day support on call', 'origin-canvas' ); ?></li><!-- /wp:list-item --></ul>
<!-- /wp:list --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|large"}}},"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--large)"><!-- wp:button {"className":"is-style-origin-canvas-fill-primary"} -->
<div class="wp-block-button is-style-origin-canvas-fill-primary"><a class="wp-block-button__link wp-element-button"><?php echo esc_html__( 'Book a sprint', 'origin-canvas' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->

<!-- wp:paragraph {"align":"center","textColor":"text-muted","fontSize":"small","style":{"spacing":{"margin":{"top":"var:preset|spacing|compact","bottom":"0"}}}} -->
<p class="has-text-align-center has-text-muted-color has-text-color has-small-font-size" style="margin-top:var(--wp--preset--spacing--compact);margin-bottom:0"><?php echo esc_html__( 'Most projects start with a single email.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
