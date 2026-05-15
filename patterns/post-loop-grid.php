<?php
/**
 * Title: Post Loop Grid
 * Slug: origin-canvas/post-loop-grid
 * Categories: posts
 * Keywords: loop, blog, posts, grid, query
 * Block Types: core/query
 *
 * @package Origin
 */

?>
<!-- wp:query {"queryId":1,"query":{"perPage":10,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","inherit":true},"align":"wide","className":"origin-canvas-post-loop-grid origin-canvas-posts\u002d\u002dstretch","layout":{"type":"default"}} -->
<div class="wp-block-query alignwide origin-canvas-post-loop-grid origin-canvas-posts--stretch"><!-- wp:post-template {"style":{"spacing":{"blockGap":"var:preset|spacing|extra-large","margin":{"bottom":"var:preset|spacing|jumbo"}}},"layout":{"type":"grid","columnCount":3}} -->
<!-- wp:post-featured-image {"isLink":true,"aspectRatio":"3/2","className":"origin-canvas-featured-fallback","style":{"spacing":{"margin":{"top":"0px","bottom":"0px"}},"border":{"radius":{"topLeft":"8px","topRight":"8px","bottomLeft":"var:preset|border-radius|medium","bottomRight":"var:preset|border-radius|medium"}}}} /-->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|extra-large","right":"var:preset|spacing|extra-large","bottom":"var:preset|spacing|extra-large","left":"var:preset|spacing|extra-large"}},"border":{"radius":{"bottomLeft":"8px","bottomRight":"8px"}}},"backgroundColor":"surface-muted","layout":{"type":"constrained","justifyContent":"center"}} -->
<div class="wp-block-group has-surface-muted-background-color has-background" style="border-bottom-left-radius:8px;border-bottom-right-radius:8px;padding-top:var(--wp--preset--spacing--extra-large);padding-right:var(--wp--preset--spacing--extra-large);padding-bottom:var(--wp--preset--spacing--extra-large);padding-left:var(--wp--preset--spacing--extra-large)"><!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
<div class="wp-block-group"><!-- wp:post-terms {"term":"category","style":{"typography":{"fontStyle":"normal","fontWeight":"500","textTransform":"uppercase"},"elements":{"link":{":hover":{"color":{"text":"var:preset|color|text-body"}},"color":{"text":"var:preset|color|primary"}}}},"textColor":"primary","fontSize":"extra-small"} /-->

<!-- wp:post-date {"format":"M j","isLink":true,"metadata":{"bindings":{"datetime":{"source":"core/post-data","args":{"field":"date"}}}},"style":{"elements":{"link":{"color":{"text":"var:preset|color|text-body"},":hover":{"color":{"text":"var:preset|color|primary"}}}},"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"400"}},"textColor":"text-body","fontSize":"extra-small"} /--></div>
<!-- /wp:group -->

<!-- wp:post-title {"level":3,"isLink":true,"style":{"typography":{"fontWeight":"700","fontStyle":"normal"},"spacing":{"margin":{"top":"var:preset|spacing|small","bottom":"var:preset|spacing|medium"}},"elements":{"link":{"color":{"text":"var:preset|color|text-heading"},":hover":{"color":{"text":"var:preset|color|primary"}}}}},"fontSize":"medium"} /-->

<!-- wp:post-excerpt {"moreText":"Read more","className":"origin-canvas-post-excerpt","style":{"spacing":{"margin":{"top":"0px","bottom":"0px"}},"elements":{"link":{"color":{"text":"var:preset|color|text-heading"},":hover":{"color":{"text":"var:preset|color|primary"}}}}},"textColor":"text-heading","fontSize":"regular"} /--></div>
<!-- /wp:group -->
<!-- /wp:post-template -->

<!-- wp:query-pagination {"layout":{"type":"flex","justifyContent":"center"}} -->
<!-- wp:query-pagination-previous /-->

<!-- wp:query-pagination-numbers /-->

<!-- wp:query-pagination-next /-->
<!-- /wp:query-pagination --></div>
<!-- /wp:query -->
