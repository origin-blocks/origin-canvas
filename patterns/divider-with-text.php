<?php
/**
 * Title: Divider With Text
 * Slug: origin-canvas/divider-with-text
 * Description: A horizontal line with a short uppercase label set into it, naming the run of content that follows. Keep the label to one to three words; a longer one squeezes the lines to ticks. If you link the label, add the origin-canvas-links-plain class to drop the underline.
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
 * The label column carries no vertical alignment, and that is load-bearing.
 * Core styles an aligned column `width: 100%`, which becomes the flex base size
 * when the width is `auto`, so the label would take the whole row and leave the
 * two rules at zero. The rules keep the alignment, because they are the items
 * that need centring on the label.
 */

?>
<!-- wp:columns {"verticalAlignment":"center","isStackedOnMobile":false,"style":{"spacing":{"blockGap":"var:preset|spacing|medium","margin":{"top":"var:preset|spacing|extra-large","bottom":"var:preset|spacing|extra-large"}}}} -->
<div class="wp-block-columns are-vertically-aligned-center is-not-stacked-on-mobile" style="margin-top:var(--wp--preset--spacing--extra-large);margin-bottom:var(--wp--preset--spacing--extra-large)"><!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:separator {"tagName":"div","className":"is-style-origin-canvas-separator-thin","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<div class="wp-block-separator has-alpha-channel-opacity is-style-origin-canvas-separator-thin" style="margin-top:0;margin-bottom:0"></div>
<!-- /wp:separator --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"auto"} -->
<div class="wp-block-column" style="flex-basis:auto"><!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","fontWeight":"600","letterSpacing":"0.08em","lineHeight":"1.5"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading","fontSize":"extra-small"} -->
<p class="has-text-heading-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:0;font-weight:600;letter-spacing:0.08em;line-height:1.5;text-transform:uppercase"><?php echo esc_html__( 'The process', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:separator {"tagName":"div","className":"is-style-origin-canvas-separator-thin","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<div class="wp-block-separator has-alpha-channel-opacity is-style-origin-canvas-separator-thin" style="margin-top:0;margin-bottom:0"></div>
<!-- /wp:separator --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->
