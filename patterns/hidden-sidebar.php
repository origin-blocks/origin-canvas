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
<div class="wp-block-group origin-canvas-sidebar has-small-font-size"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|compact"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:heading {"style":{"typography":{"textTransform":"uppercase"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading","fontSize":"extra-small"} -->
<h2 class="wp-block-heading has-text-heading-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:0;text-transform:uppercase"><?php echo esc_html__( 'Search', 'origin-canvas' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:search {"label":"Search","showLabel":false,"width":100,"widthUnit":"%","buttonText":"Search","className":"origin-canvas-search-compact","fontSize":"small","style":{"spacing":{"blockGap":"var:preset|spacing|small"}}} /--></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|compact"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:heading {"style":{"typography":{"textTransform":"uppercase"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading","fontSize":"extra-small"} -->
<h2 class="wp-block-heading has-text-heading-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:0;text-transform:uppercase"><?php echo esc_html__( 'Recent posts', 'origin-canvas' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:latest-posts {"postsToShow":3,"displayPostDate":true,"className":"origin-canvas-sidebar-posts","fontSize":"small","style":{"typography":{"fontWeight":"500","lineHeight":"1.4"},"spacing":{"margin":{"top":"var:preset|spacing|compact"}},"elements":{"link":{"color":{"text":"var:preset|color|text-body"},":hover":{"color":{"text":"var:preset|color|primary"}}}}}} /--></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|compact"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:heading {"style":{"typography":{"textTransform":"uppercase"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading","fontSize":"extra-small"} -->
<h2 class="wp-block-heading has-text-heading-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:0;text-transform:uppercase"><?php echo esc_html__( 'Categories', 'origin-canvas' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:terms-query {"termQuery":{"perPage":10,"taxonomy":"category","order":"desc","orderBy":"count","hideEmpty":true},"className":"origin-canvas-sidebar-categories"} -->
<div class="wp-block-terms-query origin-canvas-sidebar-categories"><!-- wp:term-template {"style":{"spacing":{"blockGap":"var:preset|spacing|small"}}} -->
<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|small"}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
<div class="wp-block-group"><!-- wp:term-name {"isLink":true,"fontSize":"small","style":{"typography":{"fontWeight":"500"},"elements":{"link":{"color":{"text":"var:preset|color|text-body"},":hover":{"color":{"text":"var:preset|color|primary"}}}}},"textColor":"text-body"} /-->

<!-- wp:term-count {"bracketType":"none","className":"origin-canvas-no-shrink","fontSize":"extra-small","textColor":"text-muted"} /--></div>
<!-- /wp:group -->
<!-- /wp:term-template --></div>
<!-- /wp:terms-query --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-sidebar-tags","style":{"spacing":{"blockGap":"var:preset|spacing|compact"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group origin-canvas-sidebar-tags"><!-- wp:heading {"style":{"typography":{"textTransform":"uppercase"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading","fontSize":"extra-small"} -->
<h2 class="wp-block-heading has-text-heading-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:0;text-transform:uppercase"><?php echo esc_html__( 'Tags', 'origin-canvas' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:tag-cloud {"numberOfTags":10,"showTagCounts":false,"className":"is-style-origin-canvas-tag-chip","style":{"elements":{"link":{"color":{"text":"var:preset|color|text-heading"}}}},"textColor":"text-heading"} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
