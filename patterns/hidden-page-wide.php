<?php
/**
 * Title: Hidden: Page (Wide)
 * Slug: origin/hidden-page-wide
 * Categories: hidden
 * Inserter: no
 *
 * @package Origin
 */

?>
<!-- wp:pattern {"slug":"origin/header-default"} /-->

<!-- wp:group {"tagName":"main","style":{"spacing":{"blockGap":"var:preset|spacing|extra-large","margin":{"top":"var:preset|spacing|massive","bottom":"var:preset|spacing|titan"}}},"layout":{"type":"default"}} -->
<main class="wp-block-group" style="margin-top:var(--wp--preset--spacing--massive);margin-bottom:var(--wp--preset--spacing--titan)"><!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|medium"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide"><!-- wp:post-title {"level":1,"align":"wide"} /-->

<!-- wp:post-featured-image {"align":"wide","style":{"border":{"radius":"var:preset|border-radius|medium"},"spacing":{"margin":{"bottom":"var:preset|spacing|huge","top":"0"}}}} /--></div>
<!-- /wp:group -->

<!-- wp:post-content {"style":{"spacing":{"margin":{"top":"var:preset|spacing|extra-large"}}},"layout":{"type":"constrained","contentSize":"1200px"}} /--></main>
<!-- /wp:group -->

<!-- wp:template-part {"slug":"footer","theme":"origin","area":"footer"} /-->
