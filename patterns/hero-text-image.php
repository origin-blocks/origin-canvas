<?php
/**
 * Title: Hero Split With Image
 * Slug: origin-canvas/hero-text-image
 * Description: An eyebrow, large heading, lead and two buttons beside a photo.
 * Categories: origin-canvas/hero
 * Keywords: landing page, introduction, masthead, media
 * Block Types: core/post-content
 * Inserter: true
 *
 * @package Origin
 */

?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|colossal","bottom":"var:preset|spacing|colossal"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--colossal);padding-bottom:var(--wp--preset--spacing--colossal)"><!-- wp:columns {"align":"wide","verticalAlignment":"center"} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center","width":"50%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:50%"><!-- wp:paragraph {"className":"origin-canvas-eyebrow","style":{"typography":{"textTransform":"uppercase","fontWeight":"600","letterSpacing":"0.06em","textAlign":"left"},"spacing":{"margin":{"bottom":"var:preset|spacing|small"}}},"textColor":"primary","fontSize":"small"} -->
<p class="origin-canvas-eyebrow has-text-align-left has-primary-color has-text-color has-small-font-size" style="margin-bottom:var(--wp--preset--spacing--small);font-weight:600;letter-spacing:0.06em;text-transform:uppercase"><?php echo esc_html__( 'BRAND & WEB', 'origin-canvas' ); ?> &middot; <?php echo esc_html__( 'SINCE 2018', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":1,"style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"typography":{"textAlign":"left"}},"fontSize":"display-xl"} -->
<h1 class="wp-block-heading has-display-xl-font-size has-text-align-left" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Sites and identities that earn a second look.', 'origin-canvas' ); ?></h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"textAlign":"left"}},"textColor":"text-body","fontSize":"regular-plus"} -->
<p class="has-text-align-left has-text-body-color has-text-color has-regular-plus-font-size"><?php echo esc_html__( 'We work with founders who want their website to feel as considered as the rest of what they make.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"blockGap":"var:preset|spacing|compact","margin":{"top":"var:preset|spacing|extra-large"}}},"layout":{"type":"flex","justifyContent":"left","orientation":"horizontal"}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--extra-large)"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button"><?php echo esc_html__( 'View our work', 'origin-canvas' ); ?></a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button"><?php echo esc_html__( 'Talk to us', 'origin-canvas' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"50%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:50%"><!-- wp:image {"aspectRatio":"4/3","scale":"cover","sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/patterns/images/workspace-laptop.webp" alt="<?php esc_attr_e( 'A closed laptop, two printed page layouts, an open notebook, paper samples and a stack of books on a light wooden table, with a black desk lamp behind.', 'origin-canvas' ); ?>" style="aspect-ratio:4/3;object-fit:cover"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->
