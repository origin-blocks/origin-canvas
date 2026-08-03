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
<p class="has-text-heading-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:0;font-weight:600;letter-spacing:0.08em;text-transform:uppercase"><?php echo esc_html__( 'The author', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:group {"backgroundColor":"surface-muted","style":{"border":{"radius":"var:custom|radius|medium"},"spacing":{"padding":{"top":"var:preset|spacing|medium","right":"var:preset|spacing|medium","bottom":"var:preset|spacing|medium","left":"var:preset|spacing|medium"},"blockGap":"var:preset|spacing|compact"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-surface-muted-background-color has-background" style="border-radius:var(--wp--custom--radius--medium);padding-top:var(--wp--preset--spacing--medium);padding-right:var(--wp--preset--spacing--medium);padding-bottom:var(--wp--preset--spacing--medium);padding-left:var(--wp--preset--spacing--medium)"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|compact"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group"><!-- wp:avatar {"size":40,"style":{"border":{"radius":"50%"}}} /-->

<!-- wp:post-author-name {"isLink":false,"fontSize":"regular","textColor":"text-heading","style":{"typography":{"fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} /--></div>
<!-- /wp:group -->

<!-- wp:post-author-biography {"fontSize":"small","textColor":"text-body","style":{"typography":{"lineHeight":"1.55"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|compact"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"fontSize":"extra-small","textColor":"text-heading","style":{"typography":{"textTransform":"uppercase","letterSpacing":"0.08em","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="has-text-heading-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:0;font-weight:600;letter-spacing:0.08em;text-transform:uppercase"><?php echo esc_html__( 'Recent posts', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:latest-posts {"postsToShow":3,"displayPostDate":true,"className":"origin-canvas-sidebar-posts","style":{"spacing":{"blockGap":"var:preset|spacing|medium","margin":{"top":"var:preset|spacing|compact"}},"elements":{"link":{"color":{"text":"var:preset|color|text-heading"},":hover":{"color":{"text":"var:preset|color|primary"}}}},"typography":{"fontStyle":"normal","fontWeight":"500","lineHeight":"1.4"}},"fontSize":"small","textColor":"text-heading"} /--></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|compact"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"fontSize":"extra-small","textColor":"text-heading","style":{"typography":{"textTransform":"uppercase","letterSpacing":"0.08em","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="has-text-heading-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:0;font-weight:600;letter-spacing:0.08em;text-transform:uppercase"><?php echo esc_html__( 'Browse', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:tag-cloud {"numberOfTags":10,"showTagCounts":false,"className":"is-style-origin-canvas-tag-chip","style":{"elements":{"link":{"color":{"text":"var:preset|color|text-heading"}}}},"textColor":"text-heading"} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
