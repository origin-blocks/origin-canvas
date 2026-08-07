<?php
/**
 * Title: Footer Dark
 * Slug: origin-canvas/footer-dark
 * Description: A dark site footer with a short studio note, link columns, and a legal row.
 * Categories: footer
 * Keywords:
 * Viewport Width: 1500
 * Block Types: core/template-part/footer
 * Post Types:
 * Inserter: true
 *
 * @package Origin
 */
?>
<!-- wp:group {"tagName":"footer","metadata":{"name":"Footer Dark"},"align":"full","style":{"color":{"background":"var(--wp--custom--dark--bg)","text":"var(--wp--custom--dark--text)"},"spacing":{"padding":{"top":"var:preset|spacing|colossal","bottom":"var:preset|spacing|extra-large"}}},"layout":{"inherit":true,"type":"constrained"}} -->
<footer class="wp-block-group alignfull has-text-color has-background" style="color:var(--wp--custom--dark--text);background-color:var(--wp--custom--dark--bg);padding-top:var(--wp--preset--spacing--colossal);padding-bottom:var(--wp--preset--spacing--extra-large)"><!-- wp:columns {"align":"wide","style":{"border":{"bottom":{"color":"color-mix(in srgb, var(--wp--custom--dark--text) 12%, transparent)","width":"1px"}},"spacing":{"padding":{"bottom":"var:preset|spacing|huge"}}}} -->
<div class="wp-block-columns alignwide" style="border-bottom-color:color-mix(in srgb, var(--wp--custom--dark--text) 12%, transparent);border-bottom-width:1px;padding-bottom:var(--wp--preset--spacing--huge)"><!-- wp:column {"width":"35%","className":"stack-16"} -->
<div class="wp-block-column stack-16" style="flex-basis:35%"><!-- wp:site-title {"textColor":"on-dark","style":{"elements":{"link":{"color":{"text":"var:preset|color|on-dark"}}}}} /-->
<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|small"}},"color":{"text":"color-mix(in srgb, var(--wp--custom--dark--text) 62%, transparent)"}},"fontSize":"small"} -->
<p class="has-text-color has-small-font-size" style="margin-top:var(--wp--preset--spacing--small);color:color-mix(in srgb, var(--wp--custom--dark--text) 62%, transparent)"><?php echo esc_html__( 'A Full Site Editing block theme for WordPress. Templates, patterns, and styles that work as one system.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->
<!-- wp:column {"width":"65%"} -->
<div class="wp-block-column" style="flex-basis:65%"><!-- wp:columns -->
<div class="wp-block-columns"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:paragraph {"textColor":"on-dark","fontSize":"extra-small","style":{"typography":{"fontStyle":"normal","fontWeight":"600","letterSpacing":"0.02em"},"spacing":{"margin":{"bottom":"var:preset|spacing|small"}}}} -->
<p class="has-on-dark-color has-text-color has-extra-small-font-size" style="margin-bottom:var(--wp--preset--spacing--small);font-style:normal;font-weight:600;letter-spacing:0.02em"><?php echo esc_html__( 'Theme', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->
<!-- wp:group {"className":"has-small-font-size","style":{"spacing":{"blockGap":"var:preset|spacing|compact"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-small-font-size"><!-- wp:paragraph {"style":{"color":{"text":"color-mix(in srgb, var(--wp--custom--dark--text) 62%, transparent)"}}} -->
<p class="has-text-color" style="color:color-mix(in srgb, var(--wp--custom--dark--text) 62%, transparent)"><?php echo esc_html__( 'Features', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"style":{"color":{"text":"color-mix(in srgb, var(--wp--custom--dark--text) 62%, transparent)"}}} -->
<p class="has-text-color" style="color:color-mix(in srgb, var(--wp--custom--dark--text) 62%, transparent)"><?php echo esc_html__( 'Patterns', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"style":{"color":{"text":"color-mix(in srgb, var(--wp--custom--dark--text) 62%, transparent)"}}} -->
<p class="has-text-color" style="color:color-mix(in srgb, var(--wp--custom--dark--text) 62%, transparent)"><?php echo esc_html__( 'Style variations', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"style":{"color":{"text":"color-mix(in srgb, var(--wp--custom--dark--text) 62%, transparent)"}}} -->
<p class="has-text-color" style="color:color-mix(in srgb, var(--wp--custom--dark--text) 62%, transparent)"><?php echo esc_html__( 'Templates', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"style":{"color":{"text":"color-mix(in srgb, var(--wp--custom--dark--text) 62%, transparent)"}}} -->
<p class="has-text-color" style="color:color-mix(in srgb, var(--wp--custom--dark--text) 62%, transparent)"><?php echo esc_html__( 'Changelog', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->
<!-- wp:column -->
<div class="wp-block-column"><!-- wp:paragraph {"textColor":"on-dark","fontSize":"extra-small","style":{"typography":{"fontStyle":"normal","fontWeight":"600","letterSpacing":"0.02em"},"spacing":{"margin":{"bottom":"var:preset|spacing|small"}}}} -->
<p class="has-on-dark-color has-text-color has-extra-small-font-size" style="margin-bottom:var(--wp--preset--spacing--small);font-style:normal;font-weight:600;letter-spacing:0.02em"><?php echo esc_html__( 'Resources', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->
<!-- wp:group {"className":"has-small-font-size","style":{"spacing":{"blockGap":"var:preset|spacing|compact"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-small-font-size"><!-- wp:paragraph {"style":{"color":{"text":"color-mix(in srgb, var(--wp--custom--dark--text) 62%, transparent)"}}} -->
<p class="has-text-color" style="color:color-mix(in srgb, var(--wp--custom--dark--text) 62%, transparent)"><?php echo esc_html__( 'Documentation', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"style":{"color":{"text":"color-mix(in srgb, var(--wp--custom--dark--text) 62%, transparent)"}}} -->
<p class="has-text-color" style="color:color-mix(in srgb, var(--wp--custom--dark--text) 62%, transparent)"><?php echo esc_html__( 'Live demo', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"style":{"color":{"text":"color-mix(in srgb, var(--wp--custom--dark--text) 62%, transparent)"}}} -->
<p class="has-text-color" style="color:color-mix(in srgb, var(--wp--custom--dark--text) 62%, transparent)"><?php echo esc_html__( 'Starter content', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"style":{"color":{"text":"color-mix(in srgb, var(--wp--custom--dark--text) 62%, transparent)"}}} -->
<p class="has-text-color" style="color:color-mix(in srgb, var(--wp--custom--dark--text) 62%, transparent)"><?php echo esc_html__( 'Support', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->
<!-- wp:column -->
<div class="wp-block-column"><!-- wp:paragraph {"textColor":"on-dark","fontSize":"extra-small","style":{"typography":{"fontStyle":"normal","fontWeight":"600","letterSpacing":"0.02em"},"spacing":{"margin":{"bottom":"var:preset|spacing|small"}}}} -->
<p class="has-on-dark-color has-text-color has-extra-small-font-size" style="margin-bottom:var(--wp--preset--spacing--small);font-style:normal;font-weight:600;letter-spacing:0.02em"><?php echo esc_html__( 'Project', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->
<!-- wp:group {"className":"has-small-font-size","style":{"spacing":{"blockGap":"var:preset|spacing|compact"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-small-font-size"><!-- wp:paragraph {"style":{"color":{"text":"color-mix(in srgb, var(--wp--custom--dark--text) 62%, transparent)"}}} -->
<p class="has-text-color" style="color:color-mix(in srgb, var(--wp--custom--dark--text) 62%, transparent)"><?php echo esc_html__( 'GitHub', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"style":{"color":{"text":"color-mix(in srgb, var(--wp--custom--dark--text) 62%, transparent)"}}} -->
<p class="has-text-color" style="color:color-mix(in srgb, var(--wp--custom--dark--text) 62%, transparent)"><?php echo esc_html__( 'WordPress.org', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"style":{"color":{"text":"color-mix(in srgb, var(--wp--custom--dark--text) 62%, transparent)"}}} -->
<p class="has-text-color" style="color:color-mix(in srgb, var(--wp--custom--dark--text) 62%, transparent)"><?php echo esc_html__( 'License (GPL)', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"style":{"color":{"text":"color-mix(in srgb, var(--wp--custom--dark--text) 62%, transparent)"}}} -->
<p class="has-text-color" style="color:color-mix(in srgb, var(--wp--custom--dark--text) 62%, transparent)"><?php echo esc_html__( 'Contributing', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->
<!-- wp:spacer {"height":"var:preset|spacing|large","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<div style="margin-top:0;margin-bottom:0;height:var(--wp--preset--spacing--large)" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->
<!-- wp:group {"align":"wide","layout":{"type":"flex","justifyContent":"space-between","verticalAlignment":"center"}} -->
<div class="wp-block-group alignwide"><!-- wp:paragraph {"style":{"color":{"text":"color-mix(in srgb, var(--wp--custom--dark--text) 50%, transparent)"}},"fontSize":"extra-small"} -->
<p class="has-text-color has-extra-small-font-size" style="color:color-mix(in srgb, var(--wp--custom--dark--text) 50%, transparent)"><?php echo esc_html__( '&copy; 2026 Origin Canvas. Released under the GPL.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"style":{"color":{"text":"color-mix(in srgb, var(--wp--custom--dark--text) 50%, transparent)"}},"fontSize":"extra-small"} -->
<p class="has-text-color has-extra-small-font-size" style="color:color-mix(in srgb, var(--wp--custom--dark--text) 50%, transparent)"><?php echo esc_html__( 'v1.0 · WordPress 6.5+ · theme.json v3', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></footer>
<!-- /wp:group -->
