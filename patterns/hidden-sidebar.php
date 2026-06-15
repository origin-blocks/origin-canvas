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
<!-- wp:group {"className":"origin-canvas-sidebar","style":{"spacing":{"blockGap":"var:preset|spacing|extra-large"}},"fontSize":"small","layout":{"type":"constrained","justifyContent":"left"}} -->
<div class="wp-block-group origin-canvas-sidebar has-small-font-size"><!-- wp:heading {"level":3,"style":{"typography":{"fontWeight":"600"},"spacing":{"margin":{"bottom":"var:preset|spacing|small"}}},"textColor":"text-heading","fontSize":"regular"} -->
<h3 class="wp-block-heading has-text-heading-color has-text-color has-regular-font-size" style="margin-bottom:var(--wp--preset--spacing--small);font-weight:600"><?php esc_html_e( 'Recent Posts', 'origin-canvas' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:latest-posts {"postsToShow":5,"displayPostDate":true,"displayFeaturedImage":true,"addLinkToFeaturedImage":true,"featuredImageAlign":"left","featuredImageSizeSlug":"thumbnail","featuredImageSizeWidth":75,"featuredImageSizeHeight":75,"style":{"spacing":{"blockGap":"var:preset|spacing|medium"},"elements":{"link":{"color":{"text":"var:preset|color|text-heading"},":hover":{"color":{"text":"var:preset|color|primary"}}}},"typography":{"fontStyle":"normal","fontWeight":"600"}},"textColor":"text-heading"} /-->

<!-- wp:heading {"level":3,"style":{"typography":{"fontWeight":"600"},"spacing":{"margin":{"bottom":"var:preset|spacing|small"}}},"textColor":"text-heading","fontSize":"regular"} -->
<h3 class="wp-block-heading has-text-heading-color has-text-color has-regular-font-size" style="margin-bottom:var(--wp--preset--spacing--small);font-weight:600"><?php esc_html_e( 'Categories', 'origin-canvas' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:categories {"showEmpty":true,"style":{"elements":{"link":{"color":{"text":"var:preset|color|text-heading"},":hover":{"color":{"text":"var:preset|color|primary"}}}}},"textColor":"text-heading"} /-->

<!-- wp:heading {"level":3,"style":{"typography":{"fontWeight":"600"},"spacing":{"margin":{"bottom":"var:preset|spacing|small"}}},"textColor":"text-heading","fontSize":"regular"} -->
<h3 class="wp-block-heading has-text-heading-color has-text-color has-regular-font-size" style="margin-bottom:var(--wp--preset--spacing--small);font-weight:600"><?php esc_html_e( 'Tags', 'origin-canvas' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:tag-cloud {"numberOfTags":10,"className":"is-style-origin-canvas-tag-chip","style":{"elements":{"link":{"color":{"text":"var:preset|color|text-heading"}}},"spacing":{"margin":{"top":"var:preset|spacing|compact"}}},"textColor":"text-heading"} /--></div>
<!-- /wp:group -->
