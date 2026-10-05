<?php
/**
 * Title: Features Checklist
 * Slug: origin-canvas/features-checklist
 * Description: A heading beside a two-column check list of what comes with every project, on a muted band.
 * Categories: origin-canvas/features
 * Keywords: deliverables, included, inclusions, scope, ticks, split
 * Viewport Width: 1500
 * Block Types:
 * Post Types:
 * Inserter: true
 *
 * @package Origin
 */

?>
<!-- wp:group {"tagName":"section","align":"full","backgroundColor":"surface-muted","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"var:preset|spacing|colossal","bottom":"var:preset|spacing|colossal"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-surface-muted-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--colossal);padding-bottom:var(--wp--preset--spacing--colossal)"><!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|extra-large","left":"var:preset|spacing|jumbo"}}}} -->
<div class="wp-block-columns alignwide"><!-- wp:column {"width":"34%"} -->
<div class="wp-block-column" style="flex-basis:34%"><!-- wp:heading {"style":{"typography":{"lineHeight":"1.1"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading","fontSize":"huge"} -->
<h2 class="wp-block-heading has-text-heading-color has-text-color has-huge-font-size" style="margin-top:0;margin-bottom:0;line-height:1.1"><?php echo esc_html__( 'Every project includes', 'origin-canvas' ); ?></h2>
<!-- /wp:heading --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"66%"} -->
<div class="wp-block-column" style="flex-basis:66%"><!-- wp:group {"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|small","left":"var:preset|spacing|extra-large"}}},"layout":{"type":"grid","columnCount":2,"minimumColumnWidth":"16rem"}} -->
<div class="wp-block-group"><!-- wp:list {"className":"is-style-origin-canvas-list-check origin-canvas-check-heading-color","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-body","fontSize":"regular"} -->
<ul class="wp-block-list is-style-origin-canvas-list-check origin-canvas-check-heading-color has-text-body-color has-text-color has-regular-font-size" style="margin-top:0;margin-bottom:0"><!-- wp:list-item --><li><?php echo esc_html__( 'Your existing content moved across', 'origin-canvas' ); ?></li><!-- /wp:list-item -->
<!-- wp:list-item --><li><?php echo esc_html__( 'A kickoff call with the three of us', 'origin-canvas' ); ?></li><!-- /wp:list-item -->
<!-- wp:list-item --><li><?php echo esc_html__( 'Pages that work on a phone and a desktop', 'origin-canvas' ); ?></li><!-- /wp:list-item -->
<!-- wp:list-item --><li><?php echo esc_html__( 'Page titles and descriptions for search', 'origin-canvas' ); ?></li><!-- /wp:list-item --></ul>
<!-- /wp:list -->

<!-- wp:list {"className":"is-style-origin-canvas-list-check origin-canvas-check-heading-color","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-body","fontSize":"regular"} -->
<ul class="wp-block-list is-style-origin-canvas-list-check origin-canvas-check-heading-color has-text-body-color has-text-color has-regular-font-size" style="margin-top:0;margin-bottom:0"><!-- wp:list-item --><li><?php echo esc_html__( 'Color and text checked for contrast', 'origin-canvas' ); ?></li><!-- /wp:list-item -->
<!-- wp:list-item --><li><?php echo esc_html__( 'A training call at handover', 'origin-canvas' ); ?></li><!-- /wp:list-item -->
<!-- wp:list-item --><li><?php echo esc_html__( 'Fixes for 30 days after launch', 'origin-canvas' ); ?></li><!-- /wp:list-item -->
<!-- wp:list-item --><li><?php echo esc_html__( 'Your domain and hosting in your name', 'origin-canvas' ); ?></li><!-- /wp:list-item --></ul>
<!-- /wp:list --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->
