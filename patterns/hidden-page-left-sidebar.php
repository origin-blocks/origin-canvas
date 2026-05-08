<?php
/**
 * Title: Hidden: Page (Left Sidebar)
 * Slug: origin/hidden-page-left-sidebar
 * Categories: hidden
 * Inserter: no
 *
 * @package Origin
 */

?>
<!-- wp:template-part {"slug":"header","theme":"origin","area":"header"} /-->

<!-- wp:group {"tagName":"main","style":{"spacing":{"blockGap":"var:preset|spacing|extra-large","margin":{"top":"var:preset|spacing|massive","bottom":"var:preset|spacing|titan"}}},"layout":{"type":"constrained"}} -->
<main class="wp-block-group" style="margin-top:var(--wp--preset--spacing--massive);margin-bottom:var(--wp--preset--spacing--titan)"><!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|extra-large","left":"var:preset|spacing|jumbo"},"padding":{"top":"0","right":"0","bottom":"0","left":"0"}}}} -->
<div class="wp-block-columns alignwide" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:column {"width":"33.33%"} -->
<div class="wp-block-column" style="flex-basis:33.33%"><!-- wp:template-part {"slug":"sidebar","theme":"origin","area":"sidebar"} /--></div>
<!-- /wp:column -->

<!-- wp:column {"width":"66.66%"} -->
<div class="wp-block-column" style="flex-basis:66.66%"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|medium"}},"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:post-title {"level":1} /-->

<!-- wp:post-featured-image {"style":{"border":{"radius":"var:preset|border-radius|medium"},"spacing":{"margin":{"bottom":"var:preset|spacing|huge","top":"0"}}}} /-->

<!-- wp:post-content {"style":{"spacing":{"margin":{"top":"var:preset|spacing|extra-large"}}},"layout":{"type":"default"}} /--></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></main>
<!-- /wp:group -->

<!-- wp:template-part {"slug":"footer","theme":"origin","area":"footer"} /-->
