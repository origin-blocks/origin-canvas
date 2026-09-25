<?php
/**
 * Title: Divider With Text
 * Slug: origin-canvas/divider-with-text
 * Description: A horizontal line with a short uppercase label set into it, naming the run of content that follows. Keep the label to one to three words.
 * Categories: text
 * Keywords: rule, separator, hr, section break, caption
 * Viewport Width: 1500
 * Block Types:
 * Post Types:
 * Inserter: true
 *
 * @package Origin
 */

/*
 * Core styles a column carrying a vertical alignment `width: 100%`, and writes
 * a column width to `flex-basis` only for a length or a percentage. The label
 * column can hold neither, so `origin-canvas-divider-label` sizes it instead.
 */

?>
<!-- wp:columns {"verticalAlignment":"center","isStackedOnMobile":false,"style":{"spacing":{"blockGap":"var:preset|spacing|medium","margin":{"top":"var:preset|spacing|extra-large","bottom":"var:preset|spacing|extra-large"}}}} -->
<div class="wp-block-columns are-vertically-aligned-center is-not-stacked-on-mobile" style="margin-top:var(--wp--preset--spacing--extra-large);margin-bottom:var(--wp--preset--spacing--extra-large)"><!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:separator {"tagName":"div","className":"is-style-origin-canvas-separator-thin","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<div class="wp-block-separator has-alpha-channel-opacity is-style-origin-canvas-separator-thin" style="margin-top:0;margin-bottom:0"></div>
<!-- /wp:separator --></div>
<!-- /wp:column -->

<!-- wp:column {"className":"origin-canvas-divider-label"} -->
<div class="wp-block-column origin-canvas-divider-label"><!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","fontWeight":"600","letterSpacing":"0.08em","lineHeight":"1.5"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading","fontSize":"extra-small"} -->
<p class="has-text-heading-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:0;font-weight:600;letter-spacing:0.08em;line-height:1.5;text-transform:uppercase"><?php echo esc_html__( 'The process', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:separator {"tagName":"div","className":"is-style-origin-canvas-separator-thin","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<div class="wp-block-separator has-alpha-channel-opacity is-style-origin-canvas-separator-thin" style="margin-top:0;margin-bottom:0"></div>
<!-- /wp:separator --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->
