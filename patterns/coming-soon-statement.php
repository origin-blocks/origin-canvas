<?php
/**
 * Title: Coming Soon Statement
 * Slug: origin-canvas/coming-soon-statement
 * Description: A full-screen dark coming-soon page with one large statement.
 * Categories: origin-canvas/hero
 * Keywords: launch, placeholder, holding, maintenance, offline
 * Viewport Width: 1500
 * Block Types:
 * Post Types:
 * Inserter: true
 *
 * @package Origin
 */
?>
<!-- wp:group {"tagName":"section","align":"full","style":{"color":{"background":"var(--wp--custom--dark--bg)","text":"var(--wp--custom--dark--text)"},"dimensions":{"minHeight":"100vh"},"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"var:preset|spacing|extra-large","bottom":"var:preset|spacing|huge","left":"var:preset|spacing|jumbo","right":"var:preset|spacing|jumbo"}}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"stretch","verticalAlignment":"space-between"}} -->
<section class="wp-block-group alignfull has-text-color has-background" style="color:var(--wp--custom--dark--text);background-color:var(--wp--custom--dark--bg);min-height:100vh;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--extra-large);padding-right:var(--wp--preset--spacing--jumbo);padding-bottom:var(--wp--preset--spacing--huge);padding-left:var(--wp--preset--spacing--jumbo)"><!-- wp:site-title {"level":0,"isLink":false,"style":{"color":{"text":"var(--wp--custom--dark--text)"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"fontSize":"medium"} /-->

<!-- wp:group {"layout":{"type":"constrained","contentSize":"960px","justifyContent":"left"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","letterSpacing":"0.08em","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|small"}}},"textColor":"on-dark","fontSize":"small"} -->
<p class="has-on-dark-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--small);font-weight:600;letter-spacing:0.08em;text-transform:uppercase"><span aria-hidden="true" style="background-color:var(--wp--preset--color--primary);border-radius:999px;display:inline-block;height:6px;margin-right:8px;vertical-align:middle;width:6px"></span><?php echo esc_html__( 'Coming soon', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":1,"style":{"color":{"text":"var(--wp--custom--dark--text)"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"fontSize":"display-2xl"} -->
<h1 class="wp-block-heading has-text-color has-display-2-xl-font-size" style="color:var(--wp--custom--dark--text);margin-top:0;margin-bottom:0"><?php echo esc_html__( 'A new site is on its way.', 'origin-canvas' ); ?></h1>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"border":{"top":{"color":"color-mix(in srgb, var(--wp--custom--dark--text) 12%, transparent)","width":"1px"}},"elements":{"link":{"color":{"text":"var(--wp--custom--dark--text)"},":hover":{"color":{"text":"var:preset|color|primary"}}}},"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"var:preset|spacing|medium"}}},"fontSize":"regular"} -->
<p class="has-link-color has-regular-font-size" style="border-top-color:color-mix(in srgb, var(--wp--custom--dark--text) 12%, transparent);border-top-width:1px;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--medium)"><?php echo esc_html__( 'Until then, write to us at', 'origin-canvas' ); ?> <a href="mailto:hello@example.com"><?php echo esc_html__( 'hello@example.com', 'origin-canvas' ); ?></a>.</p>
<!-- /wp:paragraph --></section>
<!-- /wp:group -->
