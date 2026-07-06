<?php
/**
 * Title: Hidden: Single Right Sidebar
 * Slug: origin-canvas/hidden-single-right-sidebar
 * Categories: hidden
 * Inserter: no
 *
 * @package Origin
 */

?>
<!-- wp:template-part {"slug":"header","theme":"origin-canvas","area":"header"} /-->

<!-- wp:group {"tagName":"main","style":{"spacing":{"blockGap":"var:preset|spacing|extra-large","margin":{"top":"var:preset|spacing|colossal","bottom":"var:preset|spacing|massive"}}},"layout":{"type":"constrained"}} -->
<main class="wp-block-group" style="margin-top:var(--wp--preset--spacing--colossal);margin-bottom:var(--wp--preset--spacing--massive)"><!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|extra-large","left":"var:preset|spacing|jumbo"}}}} -->
<div class="wp-block-columns alignwide"><!-- wp:column {"width":"66.66%"} -->
<div class="wp-block-column" style="flex-basis:66.66%"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|extra-large"}},"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|compact"}},"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:post-terms {"term":"category","style":{"elements":{"link":{"color":{"text":"var:preset|color|primary"},":hover":{"color":{"text":"var:preset|color|text-body"}}}},"typography":{"fontStyle":"normal","fontWeight":"500"},"spacing":{"margin":{"bottom":"var:preset|spacing|compact"}}},"textColor":"primary","fontSize":"small"} /-->

<!-- wp:post-title {"textAlign":"left","level":1,"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|compact"}}}} /-->

<!-- wp:group {"style":{"typography":{"fontSize":"var:preset|font-size|small"},"spacing":{"blockGap":"var:preset|spacing|small","margin":{"top":"0","bottom":"var:preset|spacing|huge"}}},"textColor":"text-body","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"left"}} -->
<div class="wp-block-group has-text-body-color has-text-color" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--huge);font-size:var(--wp--preset--font-size--small)"><!-- wp:post-author-name {"isLink":true,"style":{"elements":{"link":{":hover":{"color":{"text":"var:preset|color|primary"}},"color":{"text":"var:preset|color|text-heading"}}},"typography":{"fontStyle":"normal","fontWeight":"600"}},"textColor":"text-heading","fontSize":"small"} /-->

<!-- wp:paragraph {"style":{"typography":{"fontStyle":"normal","fontWeight":"500"}},"textColor":"text-body","fontSize":"extra-small"} -->
<p class="has-text-body-color has-text-color has-extra-small-font-size" style="font-style:normal;font-weight:500">/</p>
<!-- /wp:paragraph -->

<!-- wp:post-date {"metadata":{"bindings":{"datetime":{"source":"core/post-data","args":{"field":"date"}}}},"style":{"typography":{"fontStyle":"normal","fontWeight":"500"}},"textColor":"text-body","fontSize":"small"} /--></div>
<!-- /wp:group -->

<!-- wp:post-featured-image {"align":"wide","style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|huge"}}}} /-->

<!-- wp:post-content {"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|huge"}}},"layout":{"type":"default"}} /-->

<!-- wp:post-terms {"term":"post_tag","prefix":"Tags: ","className":"is-style-origin-canvas-term-inline","style":{"typography":{"fontStyle":"normal","fontWeight":"500"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|large"}}},"fontSize":"small"} /-->

<!-- wp:separator {"className":"is-style-wide","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"border"} -->
<hr class="wp-block-separator has-text-color has-border-color has-alpha-channel-opacity has-border-background-color has-background is-style-wide" style="margin-top:0;margin-bottom:0"/>
<!-- /wp:separator -->

<!-- wp:group {"className":"oc-postnav-section","style":{"spacing":{"margin":{"top":"var:preset|spacing|large","bottom":"var:preset|spacing|large"}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
<div class="wp-block-group oc-postnav-section" style="margin-top:var(--wp--preset--spacing--large);margin-bottom:var(--wp--preset--spacing--large)"><!-- wp:post-navigation-link {"type":"previous","showTitle":true,"linkLabel":true,"className":"is-style-origin-canvas-postnav-stacked oc-postnav--caps oc-postnav--muted-label","style":{"typography":{"fontStyle":"normal","fontWeight":"500"}},"fontSize":"regular"} /-->

<!-- wp:post-navigation-link {"showTitle":true,"linkLabel":true,"className":"is-style-origin-canvas-postnav-stacked oc-postnav--caps oc-postnav--muted-label","style":{"typography":{"fontStyle":"normal","fontWeight":"500"}},"fontSize":"regular"} /--></div>
<!-- /wp:group -->

<!-- wp:separator {"className":"is-style-wide","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"border"} -->
<hr class="wp-block-separator has-text-color has-border-color has-alpha-channel-opacity has-border-background-color has-background is-style-wide" style="margin-top:0;margin-bottom:0"/>
<!-- /wp:separator -->

<!-- wp:columns {"verticalAlignment":"top","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|medium","left":"var:preset|spacing|medium"},"margin":{"top":"var:preset|spacing|large","bottom":"var:preset|spacing|large"}}}} -->
<div class="wp-block-columns are-vertically-aligned-top" style="margin-top:var(--wp--preset--spacing--large);margin-bottom:var(--wp--preset--spacing--large)"><!-- wp:column {"verticalAlignment":"top","width":"76px"} -->
<div class="wp-block-column is-vertically-aligned-top" style="flex-basis:76px"><!-- wp:avatar {"size":76,"isLink":true,"style":{"border":{"radius":"38px"}}} /--></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"top","style":{"spacing":{"blockGap":"var:preset|spacing|small"}}} -->
<div class="wp-block-column is-vertically-aligned-top"><!-- wp:post-author-name {"isLink":true,"style":{"typography":{"fontStyle":"normal","fontWeight":"600","letterSpacing":"-0.01em"},"elements":{"link":{"color":{"text":"var:preset|color|text-heading"},":hover":{"color":{"text":"var:preset|color|primary"}}}}},"textColor":"text-heading","fontSize":"medium"} /-->

<!-- wp:post-author-biography {"fontSize":"regular"} /--></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:separator {"className":"is-style-wide","style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|huge"}}},"backgroundColor":"border"} -->
<hr class="wp-block-separator has-text-color has-border-color has-alpha-channel-opacity has-border-background-color has-background is-style-wide" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--huge)"/>
<!-- /wp:separator -->

<!-- wp:pattern {"slug":"origin-canvas/hidden-comments"} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"33.33%"} -->
<div class="wp-block-column" style="flex-basis:33.33%"><!-- wp:template-part {"slug":"sidebar","theme":"origin-canvas","area":"sidebar"} /--></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></main>
<!-- /wp:group -->

<!-- wp:template-part {"slug":"footer","theme":"origin-canvas","area":"footer"} /-->
