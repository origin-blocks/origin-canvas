<?php
/**
 * Title: Product Ecosystem Grid
 * Slug: origin-canvas/product-grid
 * Description: A six-card product ecosystem grid with per-product identity dots and pricing.
 * Categories: origin-canvas/pricing
 * Keywords: products, plans, licences, tiers
 * Viewport Width: 1500
 * Block Types:
 * Post Types:
 * Inserter: true
 *
 * @package Origin
 */

?>
<!-- wp:group {"tagName":"section","align":"full","backgroundColor":"surface-subtle","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"var:preset|spacing|colossal","bottom":"var:preset|spacing|colossal"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-surface-subtle-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--colossal);padding-bottom:var(--wp--preset--spacing--colossal)"><!-- wp:group {"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|huge"}}},"layout":{"type":"constrained","contentSize":"720px"}} -->
<div class="wp-block-group" style="margin-bottom:var(--wp--preset--spacing--huge)"><!-- wp:heading {"textAlign":"center","level":2,"style":{"typography":{"fontSize":"clamp(2.1rem, 4.4vw, 3rem)","lineHeight":"1.08"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|medium"}}}} -->
<h2 class="wp-block-heading has-text-align-center" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--medium);font-size:clamp(2.1rem, 4.4vw, 3rem);line-height:1.08"><?php echo wp_kses_post( __( 'Start with the foundation.<br>Add layers as you need them.', 'origin-canvas' ) ); ?></h2>
<!-- /wp:heading -->

<!-- wp:group {"layout":{"type":"constrained","contentSize":"560px"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"0.9375rem","lineHeight":"1.6"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-body"} -->
<p class="has-text-align-center has-text-body-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:0.9375rem;line-height:1.6"><?php echo wp_kses_post( __( 'Origin Theme and Origin Blocks are free and available today. Every advanced layer builds on the same foundation, so nothing you learn is wasted. <span class="has-inline-color has-text-heading-color" style="font-weight:500">Founding access to Patterns Pro is $55/year for the first 500 members.</span>', 'origin-canvas' ) ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"top":"20px","left":"20px"}}}} -->
<div class="wp-block-columns alignwide"><!-- wp:column {"backgroundColor":"surface-base","borderColor":"border","style":{"border":{"radius":"var:custom|radius|large","style":"solid","width":"1px"},"spacing":{"padding":{"top":"var:preset|spacing|large","right":"var:preset|spacing|large","bottom":"var:preset|spacing|large","left":"var:preset|spacing|large"}}}} -->
<div class="wp-block-column has-border-color has-border-border-color has-surface-base-background-color has-background" style="border-style:solid;border-width:1px;border-radius:var(--wp--custom--radius--large);padding-top:var(--wp--preset--spacing--large);padding-right:var(--wp--preset--spacing--large);padding-bottom:var(--wp--preset--spacing--large);padding-left:var(--wp--preset--spacing--large)"><!-- wp:group {"style":{"dimensions":{"minHeight":"258px"},"spacing":{"blockGap":"0"}},"layout":{"type":"flex","orientation":"vertical","verticalAlignment":"space-between"}} -->
<div class="wp-block-group" style="min-height:258px"><!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"spacing":{"blockGap":"9px","margin":{"top":"0","bottom":"22px"}}},"layout":{"type":"flex","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:22px"><!-- wp:group {"className":"origin-canvas-status-dot","style":{"color":{"background":"#FF4387"},"dimensions":{"minHeight":"8px"}}} -->
<div class="wp-block-group origin-canvas-status-dot has-background" style="background-color:#FF4387;min-height:8px"></div>
<!-- /wp:group -->

<!-- wp:paragraph {"className":"origin-canvas-status-chip","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="origin-canvas-status-chip" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Available now', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"top":"0","bottom":"10px"}}},"fontSize":"medium"} -->
<h3 class="wp-block-heading has-medium-font-size" style="margin-top:0;margin-bottom:10px"><?php echo esc_html__( 'Origin Theme', 'origin-canvas' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"0.90625rem","lineHeight":"1.55"},"spacing":{"margin":{"top":"0","bottom":"22px"}}},"textColor":"text-body"} -->
<p class="has-text-body-color has-text-color" style="margin-top:0;margin-bottom:22px;font-size:0.90625rem;line-height:1.55"><?php echo esc_html__( 'A modern, opinionated FSE theme with a finished design baseline, 62 patterns, and 11 style variations, ready on install.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontSize":"1.375rem","fontWeight":"700","letterSpacing":"-0.01em"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading"} -->
<p class="has-text-heading-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:1.375rem;font-weight:700;letter-spacing:-0.01em"><?php echo esc_html__( 'Free', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"},"spacing":{"margin":{"top":"15px","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|text-heading"},"typography":{"textDecoration":"none"}}}},"textColor":"text-heading","fontSize":"small"} -->
<p class="has-text-heading-color has-text-color has-link-color has-small-font-size" style="margin-top:15px;margin-bottom:0;font-weight:600"><a href="#" style="text-decoration:none"><?php echo esc_html__( 'Download free', 'origin-canvas' ); ?></a> <span class="has-primary-color has-text-color" style="color:var(--wp--preset--color--primary)" aria-hidden="true">&rarr;</span></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"backgroundColor":"surface-base","borderColor":"border","style":{"border":{"radius":"var:custom|radius|large","style":"solid","width":"1px"},"spacing":{"padding":{"top":"var:preset|spacing|large","right":"var:preset|spacing|large","bottom":"var:preset|spacing|large","left":"var:preset|spacing|large"}}}} -->
<div class="wp-block-column has-border-color has-border-border-color has-surface-base-background-color has-background" style="border-style:solid;border-width:1px;border-radius:var(--wp--custom--radius--large);padding-top:var(--wp--preset--spacing--large);padding-right:var(--wp--preset--spacing--large);padding-bottom:var(--wp--preset--spacing--large);padding-left:var(--wp--preset--spacing--large)"><!-- wp:group {"style":{"dimensions":{"minHeight":"258px"},"spacing":{"blockGap":"0"}},"layout":{"type":"flex","orientation":"vertical","verticalAlignment":"space-between"}} -->
<div class="wp-block-group" style="min-height:258px"><!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"spacing":{"blockGap":"9px","margin":{"top":"0","bottom":"22px"}}},"layout":{"type":"flex","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:22px"><!-- wp:group {"className":"origin-canvas-status-dot","style":{"color":{"background":"#16A34A"},"dimensions":{"minHeight":"8px"}}} -->
<div class="wp-block-group origin-canvas-status-dot has-background" style="background-color:#16A34A;min-height:8px"></div>
<!-- /wp:group -->

<!-- wp:paragraph {"className":"origin-canvas-status-chip","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="origin-canvas-status-chip" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Available now', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"top":"0","bottom":"10px"}}},"fontSize":"medium"} -->
<h3 class="wp-block-heading has-medium-font-size" style="margin-top:0;margin-bottom:10px"><?php echo esc_html__( 'Origin Blocks', 'origin-canvas' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"0.90625rem","lineHeight":"1.55"},"spacing":{"margin":{"top":"0","bottom":"22px"}}},"textColor":"text-body"} -->
<p class="has-text-body-color has-text-color" style="margin-top:0;margin-bottom:22px;font-size:0.90625rem;line-height:1.55"><?php echo esc_html__( 'Essential blocks that share the theme&#8217;s design system, so sections never clash.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontSize":"1.375rem","fontWeight":"700","letterSpacing":"-0.01em"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading"} -->
<p class="has-text-heading-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:1.375rem;font-weight:700;letter-spacing:-0.01em"><?php echo esc_html__( 'Free', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"},"spacing":{"margin":{"top":"15px","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|text-heading"},"typography":{"textDecoration":"none"}}}},"textColor":"text-heading","fontSize":"small"} -->
<p class="has-text-heading-color has-text-color has-link-color has-small-font-size" style="margin-top:15px;margin-bottom:0;font-weight:600"><a href="#" style="text-decoration:none"><?php echo esc_html__( 'Download free', 'origin-canvas' ); ?></a> <span class="has-primary-color has-text-color" style="color:var(--wp--preset--color--primary)" aria-hidden="true">&rarr;</span></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"backgroundColor":"surface-base","borderColor":"border","style":{"border":{"radius":"var:custom|radius|large","style":"solid","width":"1px"},"spacing":{"padding":{"top":"var:preset|spacing|large","right":"var:preset|spacing|large","bottom":"var:preset|spacing|large","left":"var:preset|spacing|large"}}}} -->
<div class="wp-block-column has-border-color has-border-border-color has-surface-base-background-color has-background" style="border-style:solid;border-width:1px;border-radius:var(--wp--custom--radius--large);padding-top:var(--wp--preset--spacing--large);padding-right:var(--wp--preset--spacing--large);padding-bottom:var(--wp--preset--spacing--large);padding-left:var(--wp--preset--spacing--large)"><!-- wp:group {"style":{"dimensions":{"minHeight":"258px"},"spacing":{"blockGap":"0"}},"layout":{"type":"flex","orientation":"vertical","verticalAlignment":"space-between"}} -->
<div class="wp-block-group" style="min-height:258px"><!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"spacing":{"blockGap":"9px","margin":{"bottom":"22px"}}},"layout":{"type":"flex"}} -->
<div class="wp-block-group" style="margin-bottom:22px"><!-- wp:group {"className":"origin-canvas-status-dot","style":{"color":{"background":"#EA580C"},"dimensions":{"minHeight":"8px"}}} -->
<div class="wp-block-group origin-canvas-status-dot has-background" style="background-color:#EA580C;min-height:8px"></div>
<!-- /wp:group -->
<!-- wp:paragraph {"className":"origin-canvas-status-chip","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="origin-canvas-status-chip" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Coming soon', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"top":"0","bottom":"10px"}}},"fontSize":"medium"} -->
<h3 class="wp-block-heading has-medium-font-size" style="margin-top:0;margin-bottom:10px"><?php echo esc_html__( 'Origin Blocks Pro', 'origin-canvas' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"0.90625rem","lineHeight":"1.55"},"spacing":{"margin":{"top":"0","bottom":"22px"}}},"textColor":"text-body"} -->
<p class="has-text-body-color has-text-color" style="margin-top:0;margin-bottom:22px;font-size:0.90625rem;line-height:1.55"><?php echo esc_html__( 'Advanced blocks for the workflows freelancers charge for: post grids, forms, sliders, galleries, and more.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"6px"}},"layout":{"type":"flex","verticalAlignment":"center"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontSize":"1.375rem","fontWeight":"700","letterSpacing":"-0.01em"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading"} -->
<p class="has-text-heading-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:1.375rem;font-weight:700;letter-spacing:-0.01em"><?php echo esc_html__( '$79', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-muted","fontSize":"extra-small"} -->
<p class="has-text-muted-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( '/ yr', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:columns {"align":"wide","style":{"spacing":{"margin":{"top":"20px"},"blockGap":{"top":"20px","left":"20px"}}}} -->
<div class="wp-block-columns alignwide" style="margin-top:20px"><!-- wp:column {"backgroundColor":"surface-base","borderColor":"border","style":{"border":{"radius":"var:custom|radius|large","style":"solid","width":"1px"},"spacing":{"padding":{"top":"var:preset|spacing|large","right":"var:preset|spacing|large","bottom":"var:preset|spacing|large","left":"var:preset|spacing|large"}}}} -->
<div class="wp-block-column has-border-color has-border-border-color has-surface-base-background-color has-background" style="border-style:solid;border-width:1px;border-radius:var(--wp--custom--radius--large);padding-top:var(--wp--preset--spacing--large);padding-right:var(--wp--preset--spacing--large);padding-bottom:var(--wp--preset--spacing--large);padding-left:var(--wp--preset--spacing--large)"><!-- wp:group {"style":{"dimensions":{"minHeight":"258px"},"spacing":{"blockGap":"0"}},"layout":{"type":"flex","orientation":"vertical","verticalAlignment":"space-between"}} -->
<div class="wp-block-group" style="min-height:258px"><!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"spacing":{"blockGap":"9px","margin":{"bottom":"22px"}}},"layout":{"type":"flex"}} -->
<div class="wp-block-group" style="margin-bottom:22px"><!-- wp:group {"className":"origin-canvas-status-dot","style":{"color":{"background":"#7C3AED"},"dimensions":{"minHeight":"8px"}}} -->
<div class="wp-block-group origin-canvas-status-dot has-background" style="background-color:#7C3AED;min-height:8px"></div>
<!-- /wp:group -->
<!-- wp:paragraph {"className":"origin-canvas-status-chip","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="origin-canvas-status-chip" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Coming soon', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"top":"0","bottom":"10px"}}},"fontSize":"medium"} -->
<h3 class="wp-block-heading has-medium-font-size" style="margin-top:0;margin-bottom:10px"><?php echo esc_html__( 'Origin Patterns Pro', 'origin-canvas' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"0.90625rem","lineHeight":"1.55"},"spacing":{"margin":{"top":"0","bottom":"22px"}}},"textColor":"text-body"} -->
<p class="has-text-body-color has-text-color" style="margin-top:0;margin-bottom:22px;font-size:0.90625rem;line-height:1.55"><?php echo esc_html__( 'A growing pattern library built on one token system, so layouts stay coherent across every project.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"spacing":{"blockGap":"6px"}},"layout":{"type":"flex","verticalAlignment":"center"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontSize":"1.375rem","fontWeight":"700","letterSpacing":"-0.01em"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading"} -->
<p class="has-text-heading-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:1.375rem;font-weight:700;letter-spacing:-0.01em"><?php echo esc_html__( '$79', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-muted","fontSize":"extra-small"} -->
<p class="has-text-muted-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( '/ yr', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"5px","bottom":"0"}}},"textColor":"text-muted","fontSize":"extra-small"} -->
<p class="has-text-muted-color has-text-color has-extra-small-font-size" style="margin-top:5px;margin-bottom:0"><?php echo esc_html__( 'Founding $55/yr, first 500 members', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"},"spacing":{"margin":{"top":"15px","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|text-heading"},"typography":{"textDecoration":"none"}}}},"textColor":"text-heading","fontSize":"small"} -->
<p class="has-text-heading-color has-text-color has-link-color has-small-font-size" style="margin-top:15px;margin-bottom:0;font-weight:600"><a href="#" style="text-decoration:none"><?php echo esc_html__( 'Join the founding list', 'origin-canvas' ); ?></a> <span class="has-primary-color has-text-color" style="color:var(--wp--preset--color--primary)" aria-hidden="true">&rarr;</span></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"backgroundColor":"surface-base","borderColor":"border","style":{"border":{"radius":"var:custom|radius|large","style":"solid","width":"1px"},"spacing":{"padding":{"top":"var:preset|spacing|large","right":"var:preset|spacing|large","bottom":"var:preset|spacing|large","left":"var:preset|spacing|large"}}}} -->
<div class="wp-block-column has-border-color has-border-border-color has-surface-base-background-color has-background" style="border-style:solid;border-width:1px;border-radius:var(--wp--custom--radius--large);padding-top:var(--wp--preset--spacing--large);padding-right:var(--wp--preset--spacing--large);padding-bottom:var(--wp--preset--spacing--large);padding-left:var(--wp--preset--spacing--large)"><!-- wp:group {"style":{"dimensions":{"minHeight":"258px"},"spacing":{"blockGap":"0"}},"layout":{"type":"flex","orientation":"vertical","verticalAlignment":"space-between"}} -->
<div class="wp-block-group" style="min-height:258px"><!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"spacing":{"blockGap":"9px","margin":{"bottom":"22px"}}},"layout":{"type":"flex"}} -->
<div class="wp-block-group" style="margin-bottom:22px"><!-- wp:group {"className":"origin-canvas-status-dot","style":{"color":{"background":"#2563EB"},"dimensions":{"minHeight":"8px"}}} -->
<div class="wp-block-group origin-canvas-status-dot has-background" style="background-color:#2563EB;min-height:8px"></div>
<!-- /wp:group -->
<!-- wp:paragraph {"className":"origin-canvas-status-chip","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="origin-canvas-status-chip" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Coming soon', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"top":"0","bottom":"10px"}}},"fontSize":"medium"} -->
<h3 class="wp-block-heading has-medium-font-size" style="margin-top:0;margin-bottom:10px"><?php echo esc_html__( 'Origin Starter Sites', 'origin-canvas' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"0.90625rem","lineHeight":"1.55"},"spacing":{"margin":{"top":"0","bottom":"22px"}}},"textColor":"text-body"} -->
<p class="has-text-body-color has-text-color" style="margin-top:0;margin-bottom:22px;font-size:0.90625rem;line-height:1.55"><?php echo esc_html__( 'A one-click installer that brings the theme, blocks, and patterns together as a ready-to-edit starting point.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"6px"}},"layout":{"type":"flex","verticalAlignment":"center"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontSize":"1.375rem","fontWeight":"700","letterSpacing":"-0.01em"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading"} -->
<p class="has-text-heading-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:1.375rem;font-weight:700;letter-spacing:-0.01em"><?php echo esc_html__( '$99', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-muted","fontSize":"extra-small"} -->
<p class="has-text-muted-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( '/ yr', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"style":{"border":{"radius":"var:custom|radius|large"},"color":{"background":"var(--wp--custom--dark--bg)","text":"var(--wp--custom--dark--text)"},"spacing":{"padding":{"top":"var:preset|spacing|large","right":"var:preset|spacing|large","bottom":"var:preset|spacing|large","left":"var:preset|spacing|large"}}}} -->
<div class="wp-block-column has-text-color has-background" style="border-radius:var(--wp--custom--radius--large);color:var(--wp--custom--dark--text);background-color:var(--wp--custom--dark--bg);padding-top:var(--wp--preset--spacing--large);padding-right:var(--wp--preset--spacing--large);padding-bottom:var(--wp--preset--spacing--large);padding-left:var(--wp--preset--spacing--large)"><!-- wp:group {"style":{"dimensions":{"minHeight":"258px"},"spacing":{"blockGap":"0"}},"layout":{"type":"flex","orientation":"vertical","verticalAlignment":"space-between"}} -->
<div class="wp-block-group" style="min-height:258px"><!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"spacing":{"blockGap":"9px","margin":{"bottom":"22px"}}},"layout":{"type":"flex"}} -->
<div class="wp-block-group" style="margin-bottom:22px"><!-- wp:group {"className":"origin-canvas-status-dot","style":{"color":{"background":"#9AA2B1"},"dimensions":{"minHeight":"8px"}}} -->
<div class="wp-block-group origin-canvas-status-dot has-background" style="background-color:#9AA2B1;min-height:8px"></div>
<!-- /wp:group -->
<!-- wp:paragraph {"className":"origin-canvas-status-chip origin-canvas-status-chip--dark","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="origin-canvas-status-chip origin-canvas-status-chip--dark" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Coming soon', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"top":"0","bottom":"10px"}},"color":{"text":"var(--wp--custom--dark--text)"}},"fontSize":"medium"} -->
<h3 class="wp-block-heading has-text-color has-medium-font-size" style="color:var(--wp--custom--dark--text);margin-top:0;margin-bottom:10px"><?php echo esc_html__( 'Agency License', 'origin-canvas' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"0.90625rem","lineHeight":"1.55"},"spacing":{"margin":{"top":"0","bottom":"22px"}},"color":{"text":"color-mix(in srgb, var(--wp--custom--dark--text) 72%, transparent)"}}} -->
<p class="has-text-color" style="color:color-mix(in srgb, var(--wp--custom--dark--text) 72%, transparent);margin-top:0;margin-bottom:22px;font-size:0.90625rem;line-height:1.55"><?php echo esc_html__( 'Everything above under one plan, for studios and small teams running many sites at once.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"spacing":{"blockGap":"6px"}},"layout":{"type":"flex","verticalAlignment":"center"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontSize":"1.375rem","fontWeight":"700","letterSpacing":"-0.01em"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"var(--wp--custom--dark--text)"}}} -->
<p class="has-text-color" style="color:var(--wp--custom--dark--text);margin-top:0;margin-bottom:0;font-size:1.375rem;font-weight:700;letter-spacing:-0.01em"><?php echo esc_html__( '$499', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-muted","fontSize":"extra-small"} -->
<p class="has-text-muted-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( '/ yr', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"},"spacing":{"margin":{"top":"15px","bottom":"0"}},"color":{"text":"var(--wp--custom--dark--text)"},"elements":{"link":{"color":{"text":"var(--wp--custom--dark--text)"},"typography":{"textDecoration":"none"}}}},"fontSize":"small"} -->
<p class="has-text-color has-link-color has-small-font-size" style="color:var(--wp--custom--dark--text);margin-top:15px;margin-bottom:0;font-weight:600"><a href="#" style="text-decoration:none"><?php echo esc_html__( 'Contact sales', 'origin-canvas' ); ?></a> <span style="color:var(--wp--custom--dark--text)" aria-hidden="true">&rarr;</span></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"0.9375rem"},"spacing":{"margin":{"top":"var:preset|spacing|extra-large","bottom":"0"}}},"textColor":"text-muted"} -->
<p class="has-text-align-center has-text-muted-color has-text-color" style="margin-top:var(--wp--preset--spacing--extra-large);margin-bottom:0;font-size:0.9375rem"><?php echo esc_html__( 'The theme is free forever. No account, no trial, no upgrade wall. Pro plugins are optional.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></section>
<!-- /wp:group -->
