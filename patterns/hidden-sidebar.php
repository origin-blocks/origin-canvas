<?php
/**
 * Title: Hidden: Sidebar
 * Slug: origin/hidden-sidebar
 * Categories: hidden
 * Inserter: no
 *
 * @package Origin
 */

?>
<!-- wp:group {"className":"origin-sidebar","style":{"spacing":{"blockGap":"var:preset|spacing|large"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group origin-sidebar"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|medium"}},"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group"><!-- wp:heading {"level":3,"style":{"typography":{"fontWeight":"500"},"spacing":{"margin":{"bottom":"var:preset|spacing|small"}}},"textColor":"text-heading","fontSize":"small"} -->
<h3 class="wp-block-heading has-text-heading-color has-text-color has-small-font-size" style="margin-bottom:var(--wp--preset--spacing--small);font-weight:500"><?php esc_html_e( 'Recent Posts', 'origin' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:latest-posts {"postsToShow":3,"displayPostDate":true,"displayFeaturedImage":true,"addLinkToFeaturedImage":true,"featuredImageAlign":"left","featuredImageSizeSlug":"thumbnail","style":{"elements":{"link":{"color":{"text":"var:preset|color|text-heading"},":hover":{"color":{"text":"var:preset|color|primary"}}}}},"textColor":"text-heading"} /--></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|medium"}},"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group"><!-- wp:heading {"level":3,"style":{"typography":{"fontWeight":"500"},"spacing":{"margin":{"bottom":"var:preset|spacing|small"}}},"textColor":"text-heading","fontSize":"small"} -->
<h3 class="wp-block-heading has-text-heading-color has-text-color has-small-font-size" style="margin-bottom:var(--wp--preset--spacing--small);font-weight:500"><?php esc_html_e( 'Categories', 'origin' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:categories {"showEmpty":true,"style":{"elements":{"link":{"color":{"text":"var:preset|color|text-heading"},":hover":{"color":{"text":"var:preset|color|primary"}}}}},"textColor":"text-heading"} /--></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|medium"}},"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group"><!-- wp:heading {"level":3,"style":{"typography":{"fontWeight":"500"},"spacing":{"margin":{"bottom":"var:preset|spacing|small"}}},"textColor":"text-heading","fontSize":"small"} -->
<h3 class="wp-block-heading has-text-heading-color has-text-color has-small-font-size" style="margin-bottom:var(--wp--preset--spacing--small);font-weight:500"><?php esc_html_e( 'Tags', 'origin' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:tag-cloud {"numberOfTags":10,"smallestFontSize":"var:preset|font-size|extra-small","largestFontSize":"var:preset|font-size|extra-small","style":{"elements":{"link":{"color":{"text":"var:preset|color|text-heading"},":hover":{"color":{"text":"var:preset|color|primary"}}}}},"textColor":"text-heading"} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
