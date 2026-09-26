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

?>
<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|medium","margin":{"top":"var:preset|spacing|extra-large","bottom":"var:preset|spacing|extra-large"}}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--extra-large);margin-bottom:var(--wp--preset--spacing--extra-large)"><!-- wp:separator {"tagName":"div","className":"is-style-wide","style":{"layout":{"selfStretch":"fill"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"border"} -->
<div class="wp-block-separator has-text-color has-border-color has-alpha-channel-opacity has-border-background-color has-background is-style-wide" style="margin-top:0;margin-bottom:0"></div>
<!-- /wp:separator -->

<!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","fontWeight":"600","letterSpacing":"0.08em","lineHeight":"1.5"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading","fontSize":"extra-small"} -->
<p class="has-text-heading-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:0;font-weight:600;letter-spacing:0.08em;line-height:1.5;text-transform:uppercase"><?php echo esc_html__( 'The process', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:separator {"tagName":"div","className":"is-style-wide","style":{"layout":{"selfStretch":"fill"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"border"} -->
<div class="wp-block-separator has-text-color has-border-color has-alpha-channel-opacity has-border-background-color has-background is-style-wide" style="margin-top:0;margin-bottom:0"></div>
<!-- /wp:separator --></div>
<!-- /wp:group -->
