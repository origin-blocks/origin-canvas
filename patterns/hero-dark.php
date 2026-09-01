<?php
/**
 * Title: Hero Dark
 * Slug: origin-canvas/hero-dark
 * Categories: origin-canvas/hero
 * Keywords: landing, intro, centered, inverted
 * Block Types: core/post-content
 * Inserter: true
 *
 * @package Origin
 */

?>
<!-- wp:group {"tagName":"section","align":"full","style":{"color":{"background":"var(--wp--custom--dark--bg)","text":"var(--wp--custom--dark--text)"},"spacing":{"padding":{"top":"var:preset|spacing|colossal","bottom":"var:preset|spacing|colossal"}}},"layout":{"type":"constrained","contentSize":"880px"}} -->
<section class="wp-block-group alignfull has-text-color has-background" style="color:var(--wp--custom--dark--text);background-color:var(--wp--custom--dark--bg);padding-top:var(--wp--preset--spacing--colossal);padding-bottom:var(--wp--preset--spacing--colossal)"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|large"}},"layout":{"type":"constrained","contentSize":"880px"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","fontWeight":"600","letterSpacing":"0.08em"},"spacing":{"margin":{"bottom":"var:preset|spacing|small"}}},"textColor":"primary","fontSize":"small"} -->
<p class="has-text-align-center has-primary-color has-text-color has-small-font-size" style="margin-bottom:var(--wp--preset--spacing--small);font-weight:600;letter-spacing:0.08em;text-transform:uppercase"><?php echo esc_html__( 'STUDIO', 'origin-canvas' ); ?> &middot; <?php echo esc_html__( 'EST. 2018', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","level":1,"style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"var(--wp--custom--dark--text)"}},"fontSize":"display-xl"} -->
<h1 class="wp-block-heading has-display-xl-font-size has-text-align-center has-text-color" style="margin-top:0;margin-bottom:0;color:var(--wp--custom--dark--text)"><?php echo esc_html__( 'Quiet, considered work for businesses that have outgrown a templated site.', 'origin-canvas' ); ?></h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","fontSize":"regular-plus"} -->
<p class="has-text-align-center has-regular-plus-font-size"><?php echo esc_html__( 'We make brand identity and websites for small teams that have something to say and don&#8217;t want to shout about it.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"blockGap":"var:preset|spacing|compact","margin":{"top":"var:preset|spacing|extra-large"}}},"layout":{"type":"flex","justifyContent":"center","orientation":"horizontal"}} -->
<div class="wp-block-buttons is-content-justification-center is-layout-flex" style="margin-top:var(--wp--preset--spacing--extra-large)"><!-- wp:button {"className":"is-style-origin-canvas-fill-primary"} -->
<div class="wp-block-button is-style-origin-canvas-fill-primary"><a class="wp-block-button__link wp-element-button"><?php echo esc_html__( 'See recent work', 'origin-canvas' ); ?></a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-origin-canvas-outline-light"} -->
<div class="wp-block-button is-style-origin-canvas-outline-light"><a class="wp-block-button__link wp-element-button"><?php echo esc_html__( 'Email us', 'origin-canvas' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
