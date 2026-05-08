<?php
/**
 * Title: Hidden: Page
 * Slug: origin/hidden-page
 * Categories: hidden
 * Inserter: no
 *
 * @package Origin
 */

?>
<!-- wp:template-part {"slug":"header","theme":"origin","area":"header"} /-->

<!-- wp:group {"tagName":"main","style":{"spacing":{"blockGap":"var:preset|spacing|extra-large","margin":{"top":"var:preset|spacing|massive","bottom":"var:preset|spacing|titan"}}},"layout":{"type":"default"}} -->
<main class="wp-block-group" style="margin-top:var(--wp--preset--spacing--massive);margin-bottom:var(--wp--preset--spacing--titan)"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|medium"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:post-title {"level":1} /-->

<!-- wp:post-featured-image {"style":{"border":{"radius":"var:preset|border-radius|medium"},"spacing":{"margin":{"bottom":"var:preset|spacing|huge","top":"0"}}}} /--></div>
<!-- /wp:group -->

<!-- wp:post-content {"style":{"spacing":{"margin":{"top":"var:preset|spacing|extra-large"}}},"layout":{"type":"constrained"}} /--></main>
<!-- /wp:group -->

<!-- wp:template-part {"slug":"footer","theme":"origin","area":"footer"} /-->
