<?php
/**
 * Title: Post Loop List
 * Slug: origin/post-loop-list
 * Categories: posts
 * Keywords: loop, blog, posts, list, query
 * Block Types: core/query
 *
 * @package Origin
 */

?>
<!-- wp:query {"queryId":1,"query":{"perPage":10,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","inherit":true},"metadata":{"categories":["posts"],"patternName":"origin/post-loop-list","name":"Post Loop List"},"align":"wide","className":"origin-post-loop-list","layout":{"type":"default"}} -->
<div class="wp-block-query alignwide origin-post-loop-list"><!-- wp:post-template {"style":{"spacing":{"blockGap":"var:preset|spacing|extra-large","margin":{"bottom":"var:preset|spacing|huge"}}},"layout":{"type":"constrained"}} -->
<!-- wp:columns {"className":"origin-post-list-card","style":{"spacing":{"blockGap":{"top":"0","left":"var:preset|spacing|none"}},"border":{"radius":{"topLeft":"20px","topRight":"20px","bottomLeft":"20px","bottomRight":"20px"}}}} -->
<div class="wp-block-columns origin-post-list-card" style="border-top-left-radius:20px;border-top-right-radius:20px;border-bottom-left-radius:20px;border-bottom-right-radius:20px"><!-- wp:column {"verticalAlignment":"center","width":"40%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:40%"><!-- wp:post-featured-image {"isLink":true,"aspectRatio":"4/3","sizeSlug":"full","className":"origin-featured-fallback origin-featured-fallback\u002d\u002dlist"} /--></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"stretch","width":"60%","style":{"spacing":{"padding":{"top":"var:preset|spacing|large","bottom":"var:preset|spacing|large","left":"var:preset|spacing|large","right":"var:preset|spacing|large"}}},"backgroundColor":"surface-muted"} -->
<div class="wp-block-column is-vertically-aligned-stretch has-surface-muted-background-color has-background" style="padding-top:var(--wp--preset--spacing--large);padding-right:var(--wp--preset--spacing--large);padding-bottom:var(--wp--preset--spacing--large);padding-left:var(--wp--preset--spacing--large);flex-basis:60%"><!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
<div class="wp-block-group"><!-- wp:post-terms {"term":"category","style":{"typography":{"fontStyle":"normal","fontWeight":"500","textTransform":"uppercase","fontSize":"var:preset|font-size|extra-small"},"elements":{"link":{":hover":{"color":{"text":"var:preset|color|text-body"}},"color":{"text":"var:preset|color|primary"}}}},"textColor":"primary"} /-->

<!-- wp:post-date {"format":"M j","isLink":true,"metadata":{"bindings":{"datetime":{"source":"core/post-data","args":{"field":"date"}}}},"style":{"elements":{"link":{"color":{"text":"var:preset|color|text-body"},":hover":{"color":{"text":"var:preset|color|primary"}}}},"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"400"}},"textColor":"text-body","fontSize":"extra-small"} /--></div>
<!-- /wp:group -->

<!-- wp:post-title {"level":3,"isLink":true,"style":{"typography":{"fontWeight":"700","fontStyle":"normal"},"spacing":{"margin":{"top":"var:preset|spacing|small","bottom":"var:preset|spacing|medium"}},"elements":{"link":{"color":{"text":"var:preset|color|text-heading"},":hover":{"color":{"text":"var:preset|color|primary"}}}}},"fontSize":"medium"} /-->

<!-- wp:post-excerpt {"moreText":"Read more","className":"origin-post-excerpt","style":{"spacing":{"margin":{"top":"0px","bottom":"0px"}},"elements":{"link":{"color":{"text":"var:preset|color|text-heading"},":hover":{"color":{"text":"var:preset|color|primary"}}}}},"textColor":"text-heading","fontSize":"regular"} /--></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->
<!-- /wp:post-template -->

<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:query-no-results -->
<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">No posts were found.</p>
<!-- /wp:paragraph -->
<!-- /wp:query-no-results --></div>
<!-- /wp:group -->

<!-- wp:query-pagination {"layout":{"type":"flex","justifyContent":"center"}} -->
<!-- wp:query-pagination-previous /-->

<!-- wp:query-pagination-numbers {"midSize":1} /-->

<!-- wp:query-pagination-next /-->
<!-- /wp:query-pagination --></div>
<!-- /wp:query -->
