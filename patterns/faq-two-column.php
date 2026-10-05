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
<section class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--colossal);padding-bottom:var(--wp--preset--spacing--colossal)"><!-- wp:columns {"align":"wide","className":"origin-canvas-faq-sticky","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|extra-large","left":"var:preset|spacing|jumbo"}}}} -->
<div class="wp-block-columns alignwide origin-canvas-faq-sticky"><!-- wp:column {"width":"34%"} -->
<div class="wp-block-column" style="flex-basis:34%"><!-- wp:heading {"level":2,"style":{"typography":{"lineHeight":"1.1"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|medium"}}},"textColor":"text-heading","fontSize":"huge"} -->
<h2 class="wp-block-heading has-text-heading-color has-text-color has-huge-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--medium);line-height:1.1"><?php echo esc_html__( 'How the money works', 'origin-canvas' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-body","fontSize":"regular-plus"} -->
<p class="has-text-body-color has-text-color has-regular-plus-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'If something here is not covered, write to us and we will answer it properly.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"66%","style":{"spacing":{"blockGap":"0"}}} -->
<div class="wp-block-column" style="flex-basis:66%">
<!-- wp:accordion {"className":"is-style-origin-canvas-accordion-minimal","style":{"border":{"top":{"color":"var:preset|color|border","style":"solid","width":"1px"}}}} -->
<div role="group" class="wp-block-accordion is-style-origin-canvas-accordion-minimal" style="border-top-color:var(--wp--preset--color--border);border-top-style:solid;border-top-width:1px"><!-- wp:accordion-item {"openByDefault":true} -->
<div class="wp-block-accordion-item is-open"><!-- wp:accordion-heading {"level":3,"style":{"typography":{"lineHeight":"1.4"}},"textColor":"text-heading","fontSize":"regular-plus"} -->
<h3 class="wp-block-accordion-heading has-icon has-icon-right has-text-heading-color has-text-color has-regular-plus-font-size" style="line-height:1.4"><button type="button" class="wp-block-accordion-heading__toggle"><span class="wp-block-accordion-heading__toggle-title"><?php echo esc_html__( 'How do you take payment?', 'origin-canvas' ); ?></span><span class="wp-block-accordion-heading__toggle-icon" aria-hidden="true">+</span></button></h3>
<!-- /wp:accordion-heading -->

<!-- wp:accordion-panel -->
<div role="region" class="wp-block-accordion-panel"><!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-body","fontSize":"regular-plus"} -->
<p class="has-text-body-color has-text-color has-regular-plus-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Half when we start and half at launch. Retained work is invoiced at the start of each month.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:accordion-panel --></div>
<!-- /wp:accordion-item -->

<!-- wp:accordion-item -->
<div class="wp-block-accordion-item"><!-- wp:accordion-heading {"level":3,"style":{"typography":{"lineHeight":"1.4"}},"textColor":"text-heading","fontSize":"regular-plus"} -->
<h3 class="wp-block-accordion-heading has-icon has-icon-right has-text-heading-color has-text-color has-regular-plus-font-size" style="line-height:1.4"><button type="button" class="wp-block-accordion-heading__toggle"><span class="wp-block-accordion-heading__toggle-title"><?php echo esc_html__( 'What does the fixed price cover?', 'origin-canvas' ); ?></span><span class="wp-block-accordion-heading__toggle-icon" aria-hidden="true">+</span></button></h3>
<!-- /wp:accordion-heading -->

<!-- wp:accordion-panel -->
<div role="region" class="wp-block-accordion-panel"><!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-body","fontSize":"regular-plus"} -->
<p class="has-text-body-color has-text-color has-regular-plus-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Everything in the written scope: the pages, the design work, two rounds of revisions and the launch. We don&#8217;t add hours on top.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:accordion-panel --></div>
<!-- /wp:accordion-item -->

<!-- wp:accordion-item -->
<div class="wp-block-accordion-item"><!-- wp:accordion-heading {"level":3,"style":{"typography":{"lineHeight":"1.4"}},"textColor":"text-heading","fontSize":"regular-plus"} -->
<h3 class="wp-block-accordion-heading has-icon has-icon-right has-text-heading-color has-text-color has-regular-plus-font-size" style="line-height:1.4"><button type="button" class="wp-block-accordion-heading__toggle"><span class="wp-block-accordion-heading__toggle-title"><?php echo esc_html__( 'What if we want something outside the scope?', 'origin-canvas' ); ?></span><span class="wp-block-accordion-heading__toggle-icon" aria-hidden="true">+</span></button></h3>
<!-- /wp:accordion-heading -->

<!-- wp:accordion-panel -->
<div role="region" class="wp-block-accordion-panel"><!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-body","fontSize":"regular-plus"} -->
<p class="has-text-body-color has-text-color has-regular-plus-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'We quote it in writing before we start, and you decide. Nothing goes on an invoice that you haven&#8217;t agreed to first.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:accordion-panel --></div>
<!-- /wp:accordion-item -->

<!-- wp:accordion-item -->
<div class="wp-block-accordion-item"><!-- wp:accordion-heading {"level":3,"style":{"typography":{"lineHeight":"1.4"}},"textColor":"text-heading","fontSize":"regular-plus"} -->
<h3 class="wp-block-accordion-heading has-icon has-icon-right has-text-heading-color has-text-color has-regular-plus-font-size" style="line-height:1.4"><button type="button" class="wp-block-accordion-heading__toggle"><span class="wp-block-accordion-heading__toggle-title"><?php echo esc_html__( 'Are hosting and the domain included?', 'origin-canvas' ); ?></span><span class="wp-block-accordion-heading__toggle-icon" aria-hidden="true">+</span></button></h3>
<!-- /wp:accordion-heading -->

<!-- wp:accordion-panel -->
<div role="region" class="wp-block-accordion-panel"><!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-body","fontSize":"regular-plus"} -->
<p class="has-text-body-color has-text-color has-regular-plus-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'You buy both in your own name, so you own them outright. We help you choose a host and set everything up during the build.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:accordion-panel --></div>
<!-- /wp:accordion-item -->

<!-- wp:accordion-item -->
<div class="wp-block-accordion-item"><!-- wp:accordion-heading {"level":3,"style":{"typography":{"lineHeight":"1.4"}},"textColor":"text-heading","fontSize":"regular-plus"} -->
<h3 class="wp-block-accordion-heading has-icon has-icon-right has-text-heading-color has-text-color has-regular-plus-font-size" style="line-height:1.4"><button type="button" class="wp-block-accordion-heading__toggle"><span class="wp-block-accordion-heading__toggle-title"><?php echo esc_html__( 'How does the Retained plan work?', 'origin-canvas' ); ?></span><span class="wp-block-accordion-heading__toggle-icon" aria-hidden="true">+</span></button></h3>
<!-- /wp:accordion-heading -->

<!-- wp:accordion-panel -->
<div role="region" class="wp-block-accordion-panel"><!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-body","fontSize":"regular-plus"} -->
<p class="has-text-body-color has-text-color has-regular-plus-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'You get up to eight hours of our time each month for changes, new pages and advice. Unused hours don&#8217;t roll over, and the plan runs for six months at minimum.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:accordion-panel --></div>
<!-- /wp:accordion-item -->

<!-- wp:accordion-item -->
<div class="wp-block-accordion-item"><!-- wp:accordion-heading {"level":3,"style":{"typography":{"lineHeight":"1.4"}},"textColor":"text-heading","fontSize":"regular-plus"} -->
<h3 class="wp-block-accordion-heading has-icon has-icon-right has-text-heading-color has-text-color has-regular-plus-font-size" style="line-height:1.4"><button type="button" class="wp-block-accordion-heading__toggle"><span class="wp-block-accordion-heading__toggle-title"><?php echo esc_html__( 'What if we need to stop partway?', 'origin-canvas' ); ?></span><span class="wp-block-accordion-heading__toggle-icon" aria-hidden="true">+</span></button></h3>
<!-- /wp:accordion-heading -->

<!-- wp:accordion-panel -->
<div role="region" class="wp-block-accordion-panel"><!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-body","fontSize":"regular-plus"} -->
<p class="has-text-body-color has-text-color has-regular-plus-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'You pay for the work done up to that point, and everything we&#8217;ve made is yours to keep.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:accordion-panel --></div>
<!-- /wp:accordion-item -->

<!-- wp:accordion-item -->
<div class="wp-block-accordion-item"><!-- wp:accordion-heading {"level":3,"style":{"typography":{"lineHeight":"1.4"}},"textColor":"text-heading","fontSize":"regular-plus"} -->
<h3 class="wp-block-accordion-heading has-icon has-icon-right has-text-heading-color has-text-color has-regular-plus-font-size" style="line-height:1.4"><button type="button" class="wp-block-accordion-heading__toggle"><span class="wp-block-accordion-heading__toggle-title"><?php echo esc_html__( 'How can we pay?', 'origin-canvas' ); ?></span><span class="wp-block-accordion-heading__toggle-icon" aria-hidden="true">+</span></button></h3>
<!-- /wp:accordion-heading -->

<!-- wp:accordion-panel -->
<div role="region" class="wp-block-accordion-panel"><!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-body","fontSize":"regular-plus"} -->
<p class="has-text-body-color has-text-color has-regular-plus-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'By bank transfer or card. Invoices are in US dollars, and sales tax is added where it applies.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:accordion-panel --></div>
<!-- /wp:accordion-item --></div>
<!-- /wp:accordion -->
</div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->
