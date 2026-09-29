<?php
/**
 * Title: Author Box
 * Slug: origin-canvas/author-box
 * Description: The post author's photo, name and biography in a tinted card.
 * Categories: origin-canvas/author
 * Keywords: bio, byline, writer, profile, contributor
 * Viewport Width: 1500
 * Block Types: core/post-content
 * Post Types:
 * Inserter: true
 *
 * @package Origin
 */
?>
<!-- wp:group {"backgroundColor":"surface-muted","style":{"border":{"radius":"var:custom|radius|large"},"spacing":{"padding":{"top":"var:preset|spacing|medium","right":"var:preset|spacing|medium","bottom":"var:preset|spacing|medium","left":"var:preset|spacing|medium"},"blockGap":"var:preset|spacing|medium"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top"}} -->
<div class="wp-block-group has-surface-muted-background-color has-background" style="border-radius:var(--wp--custom--radius--large);padding-top:var(--wp--preset--spacing--medium);padding-right:var(--wp--preset--spacing--medium);padding-bottom:var(--wp--preset--spacing--medium);padding-left:var(--wp--preset--spacing--medium)"><!-- wp:avatar {"size":76,"isLink":false,"className":"origin-canvas-author-avatar","style":{"border":{"radius":"999px"}}} /-->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|small"}},"layout":{"type":"constrained","justifyContent":"left"}} -->
<div class="wp-block-group"><!-- wp:post-author-name {"isLink":true,"style":{"typography":{"fontStyle":"normal","fontWeight":"600","letterSpacing":"-0.01em"},"elements":{"link":{"color":{"text":"var:preset|color|text-heading"},":hover":{"color":{"text":"var:preset|color|primary"}}}}},"textColor":"text-heading","fontSize":"medium"} /-->

<!-- wp:post-author-biography {"fontSize":"regular"} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
