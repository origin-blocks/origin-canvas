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
<!-- wp:group {"className":"origin-canvas-sidebar","style":{"spacing":{"blockGap":"var:preset|spacing|extra-large","padding":{"left":"var:preset|spacing|extra-large"}},"border":{"left":{"color":"var:preset|color|border","width":"1px"}}},"fontSize":"small","layout":{"type":"constrained","justifyContent":"left"}} -->
<div class="wp-block-group origin-canvas-sidebar has-small-font-size" style="border-left-color:var(--wp--preset--color--border);border-left-width:1px;padding-left:var(--wp--preset--spacing--extra-large)"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|compact"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"fontSize":"extra-small","textColor":"text-heading","style":{"typography":{"textTransform":"uppercase","letterSpacing":"0.08em","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="has-text-heading-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:0;font-weight:600;letter-spacing:0.08em;text-transform:uppercase"><?php echo esc_html__( 'Search', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:search {"label":"Search","showLabel":false,"width":100,"widthUnit":"%","buttonText":"Search","className":"origin-canvas-search-compact","style":{"spacing":{"blockGap":"var:preset|spacing|small"}}} /--></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|compact"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"fontSize":"extra-small","textColor":"text-heading","style":{"typography":{"textTransform":"uppercase","letterSpacing":"0.08em","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="has-text-heading-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:0;font-weight:600;letter-spacing:0.08em;text-transform:uppercase"><?php echo esc_html__( 'Recent posts', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:latest-posts {"postsToShow":3,"displayPostDate":true,"className":"origin-canvas-sidebar-posts","style":{"spacing":{"margin":{"top":"var:preset|spacing|compact"}}}} /--></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|compact"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"fontSize":"extra-small","textColor":"text-heading","style":{"typography":{"textTransform":"uppercase","letterSpacing":"0.08em","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="has-text-heading-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:0;font-weight:600;letter-spacing:0.08em;text-transform:uppercase"><?php echo esc_html__( 'Browse', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:tag-cloud {"numberOfTags":10,"showTagCounts":false,"className":"is-style-origin-canvas-tag-chip","style":{"elements":{"link":{"color":{"text":"var:preset|color|text-heading"}}}},"textColor":"text-heading"} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
