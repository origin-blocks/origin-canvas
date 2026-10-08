<?php
/**
 * Title: Coming Soon Split
 * Slug: origin-canvas/coming-soon-split
 * Description: A full-screen dark coming-soon page with a studio photo beside the site title.
 * Categories: origin-canvas/hero
 * Keywords: launch, placeholder, holding, maintenance, teaser
 * Viewport Width: 1500
 * Block Types:
 * Post Types:
 * Inserter: true
 *
 * @package Origin
 */
?>
<!-- wp:group {"tagName":"section","align":"full","style":{"color":{"background":"var(--wp--custom--dark--bg)","text":"var(--wp--custom--dark--text)"},"dimensions":{"minHeight":"100vh"},"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"var:preset|spacing|colossal","bottom":"var:preset|spacing|colossal","left":"var:preset|spacing|large","right":"var:preset|spacing|large"}}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"stretch","verticalAlignment":"center"}} -->
<section class="wp-block-group alignfull has-text-color has-background" style="color:var(--wp--custom--dark--text);background-color:var(--wp--custom--dark--bg);min-height:100vh;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--colossal);padding-right:var(--wp--preset--spacing--large);padding-bottom:var(--wp--preset--spacing--colossal);padding-left:var(--wp--preset--spacing--large)"><!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|huge","left":"var:preset|spacing|jumbo"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center","width":"50%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:50%"><!-- wp:paragraph {"style":{"color":{"text":"color-mix(in srgb, var(--wp--custom--dark--text) 72%, transparent)"},"typography":{"textTransform":"uppercase","letterSpacing":"0.08em","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|small"}}},"fontSize":"small"} -->
<p class="has-text-color has-small-font-size" style="color:color-mix(in srgb, var(--wp--custom--dark--text) 72%, transparent);margin-top:0;margin-bottom:var(--wp--preset--spacing--small);font-weight:600;letter-spacing:0.08em;text-transform:uppercase"><?php echo esc_html__( 'Coming soon', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:site-title {"level":1,"isLink":false,"style":{"color":{"text":"var(--wp--custom--dark--text)"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"fontSize":"display-xl"} /-->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|large"}}},"layout":{"type":"constrained","contentSize":"480px","justifyContent":"left"}} -->
<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--large)"><!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var(--wp--custom--dark--text)"},":hover":{"color":{"text":"var:preset|color|primary"}}}},"spacing":{"margin":{"top":"0","bottom":"0"}}},"fontSize":"regular-plus"} -->
<p class="has-link-color has-regular-plus-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'The new site is on its way. Until then, write to us at', 'origin-canvas' ); ?> <a href="mailto:hello@example.com"><?php echo esc_html__( 'hello@example.com', 'origin-canvas' ); ?></a>.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"50%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:50%"><!-- wp:image {"aspectRatio":"4/3","scale":"cover","width":"100%","sizeSlug":"large","linkDestination":"none","style":{"border":{"radius":"var:custom|radius|medium"}}} -->
<figure class="wp-block-image size-large is-resized has-custom-border"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/patterns/images/gallery-proof-wall.webp" alt="<?php esc_attr_e( 'Printed website page layouts pinned in a grid on a white studio wall.', 'origin-canvas' ); ?>" style="border-radius:var(--wp--custom--radius--medium);aspect-ratio:4/3;object-fit:cover;width:100%"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
