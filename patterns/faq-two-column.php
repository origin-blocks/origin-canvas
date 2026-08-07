<?php
/**
 * Title: FAQ Two Column
 * Slug: origin-canvas/faq-two-column
 * Description: A heading and intro beside a stacked list of expandable questions.
 * Categories: origin-canvas/faq
 * Keywords: accordion, disclosure, support, help, split
 * Viewport Width: 1500
 * Block Types:
 * Post Types:
 * Inserter: true
 *
 * @package Origin
 */

?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"var:preset|spacing|colossal","bottom":"var:preset|spacing|colossal"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--colossal);padding-bottom:var(--wp--preset--spacing--colossal)"><!-- wp:columns {"align":"wide","className":"origin-canvas-faq-sticky","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|huge","left":"var:preset|spacing|jumbo"}}}} -->
<div class="wp-block-columns alignwide origin-canvas-faq-sticky"><!-- wp:column {"width":"34%"} -->
<div class="wp-block-column" style="flex-basis:34%"><!-- wp:heading {"level":2,"style":{"typography":{"lineHeight":"1.1"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|medium"}}},"textColor":"text-heading","fontSize":"huge"} -->
<h2 class="wp-block-heading has-text-heading-color has-text-color has-huge-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--medium);line-height:1.1"><?php echo esc_html__( 'Questions we get asked', 'origin-canvas' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-body","fontSize":"regular-plus"} -->
<p class="has-text-body-color has-text-color has-regular-plus-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'If something here is not covered, write to us and we will answer it properly rather than sending a brochure.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"66%","style":{"spacing":{"blockGap":"0"}}} -->
<div class="wp-block-column" style="flex-basis:66%">
<!-- wp:accordion {"className":"is-style-origin-canvas-accordion-minimal"} -->
<div role="group" class="wp-block-accordion is-style-origin-canvas-accordion-minimal"><!-- wp:accordion-item -->
<div class="wp-block-accordion-item"><!-- wp:accordion-heading {"level":3,"style":{"typography":{"fontWeight":"600","letterSpacing":"-0.01em","lineHeight":"1.4"}},"textColor":"text-heading","fontSize":"regular-plus"} -->
<h3 class="wp-block-accordion-heading has-icon has-icon-right has-text-heading-color has-text-color has-regular-plus-font-size" style="line-height:1.4"><button type="button" class="wp-block-accordion-heading__toggle"><span class="wp-block-accordion-heading__toggle-title" style="letter-spacing:-0.01em"><?php echo esc_html__( 'How long does a project take?', 'origin-canvas' ); ?></span><span class="wp-block-accordion-heading__toggle-icon" aria-hidden="true">+</span></button></h3>
<!-- /wp:accordion-heading -->

<!-- wp:accordion-panel -->
<div role="region" class="wp-block-accordion-panel"><!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-body","fontSize":"regular-plus"} -->
<p class="has-text-body-color has-text-color has-regular-plus-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Four weeks from kickoff to launch on most projects, and longer if we are writing the copy with you.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:accordion-panel --></div>
<!-- /wp:accordion-item -->

<!-- wp:accordion-item -->
<div class="wp-block-accordion-item"><!-- wp:accordion-heading {"level":3,"style":{"typography":{"fontWeight":"600","letterSpacing":"-0.01em","lineHeight":"1.4"}},"textColor":"text-heading","fontSize":"regular-plus"} -->
<h3 class="wp-block-accordion-heading has-icon has-icon-right has-text-heading-color has-text-color has-regular-plus-font-size" style="line-height:1.4"><button type="button" class="wp-block-accordion-heading__toggle"><span class="wp-block-accordion-heading__toggle-title" style="letter-spacing:-0.01em"><?php echo esc_html__( 'What do you need from us to start?', 'origin-canvas' ); ?></span><span class="wp-block-accordion-heading__toggle-icon" aria-hidden="true">+</span></button></h3>
<!-- /wp:accordion-heading -->

<!-- wp:accordion-panel -->
<div role="region" class="wp-block-accordion-panel"><!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-body","fontSize":"regular-plus"} -->
<p class="has-text-body-color has-text-color has-regular-plus-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'A conversation, whatever brand material already exists, and one person who can approve work. Copy can come later &#8212; we will tell you what we need and when.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:accordion-panel --></div>
<!-- /wp:accordion-item -->

<!-- wp:accordion-item -->
<div class="wp-block-accordion-item"><!-- wp:accordion-heading {"level":3,"style":{"typography":{"fontWeight":"600","letterSpacing":"-0.01em","lineHeight":"1.4"}},"textColor":"text-heading","fontSize":"regular-plus"} -->
<h3 class="wp-block-accordion-heading has-icon has-icon-right has-text-heading-color has-text-color has-regular-plus-font-size" style="line-height:1.4"><button type="button" class="wp-block-accordion-heading__toggle"><span class="wp-block-accordion-heading__toggle-title" style="letter-spacing:-0.01em"><?php echo esc_html__( 'Do you work with our developer?', 'origin-canvas' ); ?></span><span class="wp-block-accordion-heading__toggle-icon" aria-hidden="true">+</span></button></h3>
<!-- /wp:accordion-heading -->

<!-- wp:accordion-panel -->
<div role="region" class="wp-block-accordion-panel"><!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-body","fontSize":"regular-plus"} -->
<p class="has-text-body-color has-text-color has-regular-plus-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Often. We hand over structured files and stay available through the build, and we will say early if something in the design is going to be expensive to make.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:accordion-panel --></div>
<!-- /wp:accordion-item -->

<!-- wp:accordion-item -->
<div class="wp-block-accordion-item"><!-- wp:accordion-heading {"level":3,"style":{"typography":{"fontWeight":"600","letterSpacing":"-0.01em","lineHeight":"1.4"}},"textColor":"text-heading","fontSize":"regular-plus"} -->
<h3 class="wp-block-accordion-heading has-icon has-icon-right has-text-heading-color has-text-color has-regular-plus-font-size" style="line-height:1.4"><button type="button" class="wp-block-accordion-heading__toggle"><span class="wp-block-accordion-heading__toggle-title" style="letter-spacing:-0.01em"><?php echo esc_html__( 'What happens after launch?', 'origin-canvas' ); ?></span><span class="wp-block-accordion-heading__toggle-icon" aria-hidden="true">+</span></button></h3>
<!-- /wp:accordion-heading -->

<!-- wp:accordion-panel -->
<div role="region" class="wp-block-accordion-panel"><!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-body","fontSize":"regular-plus"} -->
<p class="has-text-body-color has-text-color has-regular-plus-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Thirty days of fixes are included. After that we keep a small retained slot open for changes, at a monthly rate agreed up front.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:accordion-panel --></div>
<!-- /wp:accordion-item --></div>
<!-- /wp:accordion -->
</div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->
