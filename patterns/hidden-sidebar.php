<?php
/**
 * Title: Hidden: Sidebar
 * Slug: origin-canvas/hidden-sidebar
 * Categories: hidden
 * Inserter: no
 *
 * @package Origin
 */

?>
<!-- wp:group {"className":"origin-canvas-sidebar","style":{"spacing":{"blockGap":"var:preset|spacing|large"}},"fontSize":"regular","layout":{"type":"constrained"}} -->
<div class="wp-block-group origin-canvas-sidebar has-regular-font-size"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|medium"}},"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:heading {"level":3,"style":{"typography":{"fontWeight":"600"},"spacing":{"margin":{"bottom":"var:preset|spacing|small"}}},"textColor":"text-heading","fontSize":"regular"} -->
<h3 class="wp-block-heading has-text-heading-color has-text-color has-regular-font-size" style="margin-bottom:var(--wp--preset--spacing--small);font-weight:600"><?php esc_html_e( 'Recent Posts', 'origin-canvas' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:latest-posts {"postsToShow":3,"displayPostDate":true,"displayFeaturedImage":true,"addLinkToFeaturedImage":true,"featuredImageAlign":"left","featuredImageSizeSlug":"thumbnail","style":{"elements":{"link":{"color":{"text":"var:preset|color|text-heading"},":hover":{"color":{"text":"var:preset|color|primary"}}}}},"textColor":"text-heading"} /--></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|medium"}},"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:heading {"level":3,"style":{"typography":{"fontWeight":"600"},"spacing":{"margin":{"bottom":"var:preset|spacing|small"}}},"textColor":"text-heading","fontSize":"regular"} -->
<h3 class="wp-block-heading has-text-heading-color has-text-color has-regular-font-size" style="margin-bottom:var(--wp--preset--spacing--small);font-weight:600"><?php esc_html_e( 'Categories', 'origin-canvas' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:categories {"showEmpty":true,"style":{"elements":{"link":{"color":{"text":"var:preset|color|text-heading"},":hover":{"color":{"text":"var:preset|color|primary"}}}}},"textColor":"text-heading"} /--></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|medium"}},"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:heading {"level":3,"style":{"typography":{"fontWeight":"600"},"spacing":{"margin":{"bottom":"var:preset|spacing|small"}}},"textColor":"text-heading","fontSize":"regular"} -->
<h3 class="wp-block-heading has-text-heading-color has-text-color has-regular-font-size" style="margin-bottom:var(--wp--preset--spacing--small);font-weight:600"><?php esc_html_e( 'Tags', 'origin-canvas' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:tag-cloud {"numberOfTags":10,"className":"is-style-origin-canvas-tag-chip","style":{"elements":{"link":{"color":{"text":"var:preset|color|text-heading"}}}},"textColor":"text-heading"} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
