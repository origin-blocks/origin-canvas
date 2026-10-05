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
<h3 class="wp-block-accordion-heading has-icon has-icon-right has-text-heading-color has-text-color has-regular-plus-font-size" style="line-height:1.4"><button type="button" class="wp-block-accordion-heading__toggle"><span class="wp-block-accordion-heading__toggle-title"><?php echo esc_html__( 'What if the scope changes?', 'origin-canvas' ); ?></span><span class="wp-block-accordion-heading__toggle-icon" aria-hidden="true">+</span></button></h3>
<!-- /wp:accordion-heading -->

<!-- wp:accordion-panel -->
<div role="region" class="wp-block-accordion-panel"><!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-body","fontSize":"regular-plus"} -->
<p class="has-text-body-color has-text-color has-regular-plus-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'We stop and write it down. Small changes fit inside the price. Anything bigger gets a revised scope and price for you to approve before we start it.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:accordion-panel --></div>
<!-- /wp:accordion-item -->

<!-- wp:accordion-item -->
<div class="wp-block-accordion-item"><!-- wp:accordion-heading {"level":3,"style":{"typography":{"lineHeight":"1.4"}},"textColor":"text-heading","fontSize":"regular-plus"} -->
<h3 class="wp-block-accordion-heading has-icon has-icon-right has-text-heading-color has-text-color has-regular-plus-font-size" style="line-height:1.4"><button type="button" class="wp-block-accordion-heading__toggle"><span class="wp-block-accordion-heading__toggle-title"><?php echo esc_html__( 'Are hosting and domains included?', 'origin-canvas' ); ?></span><span class="wp-block-accordion-heading__toggle-icon" aria-hidden="true">+</span></button></h3>
<!-- /wp:accordion-heading -->

<!-- wp:accordion-panel -->
<div role="region" class="wp-block-accordion-panel"><!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-body","fontSize":"regular-plus"} -->
<p class="has-text-body-color has-text-color has-regular-plus-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'No. Hosting and domains are bought in your name, so you own them from day one. We set them up and recommend a host that fits the site.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:accordion-panel --></div>
<!-- /wp:accordion-item -->

<!-- wp:accordion-item -->
<div class="wp-block-accordion-item"><!-- wp:accordion-heading {"level":3,"style":{"typography":{"lineHeight":"1.4"}},"textColor":"text-heading","fontSize":"regular-plus"} -->
<h3 class="wp-block-accordion-heading has-icon has-icon-right has-text-heading-color has-text-color has-regular-plus-font-size" style="line-height:1.4"><button type="button" class="wp-block-accordion-heading__toggle"><span class="wp-block-accordion-heading__toggle-title"><?php echo esc_html__( 'What does a retained month cover?', 'origin-canvas' ); ?></span><span class="wp-block-accordion-heading__toggle-icon" aria-hidden="true">+</span></button></h3>
<!-- /wp:accordion-heading -->

<!-- wp:accordion-panel -->
<div role="region" class="wp-block-accordion-panel"><!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-body","fontSize":"regular-plus"} -->
<p class="has-text-body-color has-text-color has-regular-plus-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Up to two days of work each month: updates, new pages, fixes and a short check-in call. Unused time doesn&#8217;t roll over.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:accordion-panel --></div>
<!-- /wp:accordion-item -->

<!-- wp:accordion-item -->
<div class="wp-block-accordion-item"><!-- wp:accordion-heading {"level":3,"style":{"typography":{"lineHeight":"1.4"}},"textColor":"text-heading","fontSize":"regular-plus"} -->
<h3 class="wp-block-accordion-heading has-icon has-icon-right has-text-heading-color has-text-color has-regular-plus-font-size" style="line-height:1.4"><button type="button" class="wp-block-accordion-heading__toggle"><span class="wp-block-accordion-heading__toggle-title"><?php echo esc_html__( 'Do prices include tax?', 'origin-canvas' ); ?></span><span class="wp-block-accordion-heading__toggle-icon" aria-hidden="true">+</span></button></h3>
<!-- /wp:accordion-heading -->

<!-- wp:accordion-panel -->
<div role="region" class="wp-block-accordion-panel"><!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-body","fontSize":"regular-plus"} -->
<p class="has-text-body-color has-text-color has-regular-plus-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'No. All prices are in USD, before tax. Sales tax is added where it applies.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:accordion-panel --></div>
<!-- /wp:accordion-item -->

<!-- wp:accordion-item -->
<div class="wp-block-accordion-item"><!-- wp:accordion-heading {"level":3,"style":{"typography":{"lineHeight":"1.4"}},"textColor":"text-heading","fontSize":"regular-plus"} -->
<h3 class="wp-block-accordion-heading has-icon has-icon-right has-text-heading-color has-text-color has-regular-plus-font-size" style="line-height:1.4"><button type="button" class="wp-block-accordion-heading__toggle"><span class="wp-block-accordion-heading__toggle-title"><?php echo esc_html__( 'Can we start with a smaller project?', 'origin-canvas' ); ?></span><span class="wp-block-accordion-heading__toggle-icon" aria-hidden="true">+</span></button></h3>
<!-- /wp:accordion-heading -->

<!-- wp:accordion-panel -->
<div role="region" class="wp-block-accordion-panel"><!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-body","fontSize":"regular-plus"} -->
<p class="has-text-body-color has-text-color has-regular-plus-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Yes. Starter is our smallest fixed-price project. For anything smaller, write to us and we&#8217;ll tell you whether we&#8217;re a good fit.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:accordion-panel --></div>
<!-- /wp:accordion-item -->

<!-- wp:accordion-item -->
<div class="wp-block-accordion-item"><!-- wp:accordion-heading {"level":3,"style":{"typography":{"lineHeight":"1.4"}},"textColor":"text-heading","fontSize":"regular-plus"} -->
<h3 class="wp-block-accordion-heading has-icon has-icon-right has-text-heading-color has-text-color has-regular-plus-font-size" style="line-height:1.4"><button type="button" class="wp-block-accordion-heading__toggle"><span class="wp-block-accordion-heading__toggle-title"><?php echo esc_html__( 'What if we need to pause?', 'origin-canvas' ); ?></span><span class="wp-block-accordion-heading__toggle-icon" aria-hidden="true">+</span></button></h3>
<!-- /wp:accordion-heading -->

<!-- wp:accordion-panel -->
<div role="region" class="wp-block-accordion-panel"><!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-body","fontSize":"regular-plus"} -->
<p class="has-text-body-color has-text-color has-regular-plus-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Fixed-price projects can pause once, for up to a month, at no cost. Retained work can pause with a month&#8217;s notice.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:accordion-panel --></div>
<!-- /wp:accordion-item --></div>
<!-- /wp:accordion -->
</div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->
