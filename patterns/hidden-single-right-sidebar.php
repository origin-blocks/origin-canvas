<?php
/**
 * Title: Hidden: Single Right Sidebar
 * Slug: origin/hidden-single-right-sidebar
 * Categories: hidden
 * Inserter: no
 *
 * @package Origin
 */

?>
<!-- wp:template-part {"slug":"header","theme":"origin","area":"header"} /-->

<!-- wp:group {"tagName":"main","style":{"spacing":{"blockGap":"var:preset|spacing|extra-large","margin":{"top":"var:preset|spacing|massive","bottom":"var:preset|spacing|titan"}}},"layout":{"type":"constrained"}} -->
<main class="wp-block-group" style="margin-top:var(--wp--preset--spacing--massive);margin-bottom:var(--wp--preset--spacing--titan)"><!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|extra-large","left":"var:preset|spacing|jumbo"}}}} -->
<div class="wp-block-columns alignwide"><!-- wp:column {"width":"66.66%"} -->
<div class="wp-block-column" style="flex-basis:66.66%"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|extra-large"}},"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|compact"}},"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:post-terms {"term":"category","style":{"elements":{"link":{"color":{"text":"var:preset|color|primary"},":hover":{"color":{"text":"var:preset|color|text-body"}}}},"typography":{"fontStyle":"normal","fontWeight":"500"},"spacing":{"margin":{"bottom":"var:preset|spacing|compact"}}},"textColor":"primary","fontSize":"small"} /-->

<!-- wp:post-title {"textAlign":"left","level":1,"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|compact"}}}} /-->

<!-- wp:group {"style":{"typography":{"fontSize":"var:preset|font-size|small"},"spacing":{"blockGap":"var:preset|spacing|small","margin":{"top":"0","bottom":"var:preset|spacing|huge"}}},"textColor":"text-body","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"left"}} -->
<div class="wp-block-group has-text-body-color has-text-color" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--huge);font-size:var(--wp--preset--font-size--small)"><!-- wp:post-author-name {"isLink":true,"style":{"elements":{"link":{":hover":{"color":{"text":"var:preset|color|primary"}},"color":{"text":"var:preset|color|text-body"}}},"typography":{"fontStyle":"normal","fontWeight":"500"}},"textColor":"text-body","fontSize":"small"} /-->

<!-- wp:paragraph {"style":{"typography":{"fontStyle":"normal","fontWeight":"500"}},"textColor":"text-body","fontSize":"extra-small"} -->
<p class="has-text-body-color has-text-color has-extra-small-font-size" style="font-style:normal;font-weight:500">/</p>
<!-- /wp:paragraph -->

<!-- wp:post-date {"metadata":{"bindings":{"datetime":{"source":"core/post-data","args":{"field":"date"}}}},"style":{"typography":{"fontStyle":"normal","fontWeight":"500"}},"textColor":"text-body","fontSize":"small"} /--></div>
<!-- /wp:group -->

<!-- wp:post-featured-image {"align":"wide","style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|huge"}}}} /-->

<!-- wp:post-content {"layout":{"type":"default"}} /-->

<!-- wp:post-terms {"term":"post_tag","prefix":"Tags: ","style":{"typography":{"fontStyle":"normal","fontWeight":"500"},"elements":{"link":{"color":{"text":"var:preset|color|text-body"},":hover":{"color":{"text":"var:preset|color|primary"}}}},"spacing":{"margin":{"top":"var:preset|spacing|huge","bottom":"var:preset|spacing|extra-large"}}},"textColor":"text-body","fontSize":"small"} /-->

<!-- wp:separator {"className":"is-style-wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|jumbo","bottom":"var:preset|spacing|jumbo"}}},"backgroundColor":"border"} -->
<hr class="wp-block-separator has-text-color has-border-color has-alpha-channel-opacity has-border-background-color has-background is-style-wide" style="margin-top:var(--wp--preset--spacing--jumbo);margin-bottom:var(--wp--preset--spacing--jumbo)"/>
<!-- /wp:separator -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|extra-large","bottom":"var:preset|spacing|extra-large"}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--extra-large);margin-bottom:var(--wp--preset--spacing--extra-large)"><!-- wp:post-navigation-link {"type":"previous","showTitle":true,"linkLabel":true,"style":{"typography":{"fontStyle":"normal","fontWeight":"500"},"elements":{"link":{"color":{"text":"var:preset|color|text-body"},":hover":{"color":{"text":"var:preset|color|primary"}}}}},"textColor":"text-body","fontSize":"regular"} /-->

<!-- wp:post-navigation-link {"showTitle":true,"linkLabel":true,"style":{"typography":{"fontStyle":"normal","fontWeight":"500"},"elements":{"link":{"color":{"text":"var:preset|color|text-body"},":hover":{"color":{"text":"var:preset|color|primary"}}}}},"textColor":"text-body","fontSize":"regular"} /--></div>
<!-- /wp:group -->

<!-- wp:separator {"className":"is-style-wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|jumbo","bottom":"var:preset|spacing|jumbo"}}},"backgroundColor":"border"} -->
<hr class="wp-block-separator has-text-color has-border-color has-alpha-channel-opacity has-border-background-color has-background is-style-wide" style="margin-top:var(--wp--preset--spacing--jumbo);margin-bottom:var(--wp--preset--spacing--jumbo)"/>
<!-- /wp:separator -->

<!-- wp:post-author {"showBio":true,"isLink":true,"avatarSize":120,"className":"is-style-origin-author"} /-->

<!-- wp:separator {"className":"is-style-wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|jumbo","bottom":"var:preset|spacing|jumbo"}}},"backgroundColor":"border"} -->
<hr class="wp-block-separator has-text-color has-border-color has-alpha-channel-opacity has-border-background-color has-background is-style-wide" style="margin-top:var(--wp--preset--spacing--jumbo);margin-bottom:var(--wp--preset--spacing--jumbo)"/>
<!-- /wp:separator -->

<!-- wp:comments -->
<div class="wp-block-comments"><!-- wp:comments-title /-->

<!-- wp:comment-template -->
<!-- wp:columns {"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|huge"}}}} -->
<div class="wp-block-columns" style="margin-bottom:var(--wp--preset--spacing--huge)"><!-- wp:column {"width":"80px"} -->
<div class="wp-block-column" style="flex-basis:80px"><!-- wp:avatar {"size":48,"style":{"border":{"radius":"999px"}}} /--></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:comment-author-name {"fontSize":"regular"} /-->

<!-- wp:comment-date /-->

<!-- wp:comment-content {"fontSize":"regular"} /-->

<!-- wp:comment-reply-link /--></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->
<!-- /wp:comment-template -->

<!-- wp:comments-pagination -->
<!-- wp:comments-pagination-previous /-->

<!-- wp:comments-pagination-numbers /-->

<!-- wp:comments-pagination-next /-->
<!-- /wp:comments-pagination -->

<!-- wp:post-comments-form {"fontSize":"regular"} /--></div>
<!-- /wp:comments --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"33.33%"} -->
<div class="wp-block-column" style="flex-basis:33.33%"><!-- wp:template-part {"slug":"sidebar","theme":"origin","area":"sidebar"} /--></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></main>
<!-- /wp:group -->

<!-- wp:template-part {"slug":"footer","theme":"origin","area":"footer"} /-->
