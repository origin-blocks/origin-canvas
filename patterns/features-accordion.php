<?php
/**
 * Title: Features List
 * Slug: origin-canvas/features-accordion
 * Description: A centered heading over a stacked list of services that expand to reveal a short description, a list of what is included, the time and price, and a text link.
 * Categories: origin-canvas/features
 * Keywords: expandable, collapsible, offerings, capabilities, toggle
 * Block Types:
 * Post Types:
 * Inserter: true
 *
 * @package Origin
 */

?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"var:preset|spacing|colossal","bottom":"var:preset|spacing|colossal"},"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--colossal);padding-bottom:var(--wp--preset--spacing--colossal)"><!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|medium","margin":{"bottom":"var:preset|spacing|huge"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide" style="margin-bottom:var(--wp--preset--spacing--huge)"><!-- wp:paragraph {"className":"origin-canvas-eyebrow","style":{"typography":{"textTransform":"uppercase","fontWeight":"600","letterSpacing":"0.06em","textAlign":"center"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|medium"}}},"textColor":"primary","fontSize":"extra-small"} -->
<p class="origin-canvas-eyebrow has-text-align-center has-primary-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--medium);font-weight:600;letter-spacing:0.06em;text-transform:uppercase"><?php echo esc_html__( 'What we do', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2,"align":"wide","style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"typography":{"textAlign":"center"}},"fontSize":"display"} -->
<h2 class="wp-block-heading has-text-align-center alignwide has-display-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'We make brands and websites that fit', 'origin-canvas' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|compact"}},"typography":{"textAlign":"center"}},"textColor":"text-body","fontSize":"regular-plus"} -->
<p class="has-text-align-center has-text-body-color has-text-color has-regular-plus-font-size" style="margin-top:var(--wp--preset--spacing--compact)"><?php echo esc_html__( 'We design the identity, build the site and write the copy for it, all in one studio.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:accordion {"className":"is-style-origin-canvas-accordion-minimal","align":"wide"} -->
<div role="group" class="wp-block-accordion alignwide is-style-origin-canvas-accordion-minimal"><!-- wp:accordion-item -->
<div class="wp-block-accordion-item"><!-- wp:accordion-heading {"level":3,"style":{"typography":{"lineHeight":"1.4"}},"textColor":"text-heading","fontSize":"medium"} -->
<h3 class="wp-block-accordion-heading has-icon has-icon-right has-text-heading-color has-text-color has-medium-font-size" style="line-height:1.4"><button type="button" class="wp-block-accordion-heading__toggle"><span class="wp-block-accordion-heading__toggle-title"><?php echo esc_html__( 'Brand identity', 'origin-canvas' ); ?> <mark style="background-color:rgba(0, 0, 0, 0)" class="has-inline-color has-text-muted-color"><?php echo esc_html__( '(mark, color and type)', 'origin-canvas' ); ?></mark></span><span class="wp-block-accordion-heading__toggle-icon" aria-hidden="true">+</span></button></h3>
<!-- /wp:accordion-heading -->

<!-- wp:accordion-panel -->
<div role="region" class="wp-block-accordion-panel"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|medium"}},"layout":{"type":"constrained","justifyContent":"left"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"textColor":"text-body","fontSize":"regular-plus"} -->
<p class="has-text-body-color has-text-color has-regular-plus-font-size"><?php echo esc_html__( 'A mark, colors and type that hold together on a sign, a card and a screen. You comment on each draft before it is final. It suits a business whose look no longer matches its work.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:list {"className":"is-style-origin-canvas-list-check-neutral","textColor":"text-body","fontSize":"regular"} -->
<ul class="wp-block-list is-style-origin-canvas-list-check-neutral has-text-body-color has-text-color has-regular-font-size"><!-- wp:list-item -->
<li><?php echo esc_html__( 'A mark and a wordmark', 'origin-canvas' ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php echo esc_html__( 'Colors and type for print and screen', 'origin-canvas' ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php echo esc_html__( 'A one-page guide your team can follow', 'origin-canvas' ); ?></li>
<!-- /wp:list-item --></ul>
<!-- /wp:list -->

<!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"}},"textColor":"text-heading","fontSize":"regular-plus"} -->
<p class="has-text-heading-color has-text-color has-regular-plus-font-size" style="font-weight:600"><?php echo esc_html__( '$3,500 &middot; four weeks', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"}},"textColor":"text-heading","fontSize":"regular"} -->
<p class="has-text-heading-color has-text-color has-regular-font-size" style="font-weight:600"><a href="#" style="text-decoration:none"><?php echo esc_html__( 'See identity work', 'origin-canvas' ); ?> <span aria-hidden="true">&rarr;</span></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:accordion-panel --></div>
<!-- /wp:accordion-item -->

<!-- wp:accordion-item -->
<div class="wp-block-accordion-item"><!-- wp:accordion-heading {"level":3,"style":{"typography":{"lineHeight":"1.4"}},"textColor":"text-heading","fontSize":"medium"} -->
<h3 class="wp-block-accordion-heading has-icon has-icon-right has-text-heading-color has-text-color has-medium-font-size" style="line-height:1.4"><button type="button" class="wp-block-accordion-heading__toggle"><span class="wp-block-accordion-heading__toggle-title"><?php echo esc_html__( 'Websites', 'origin-canvas' ); ?> <mark style="background-color:rgba(0, 0, 0, 0)" class="has-inline-color has-text-muted-color"><?php echo esc_html__( '(design and build)', 'origin-canvas' ); ?></mark></span><span class="wp-block-accordion-heading__toggle-icon" aria-hidden="true">+</span></button></h3>
<!-- /wp:accordion-heading -->

<!-- wp:accordion-panel -->
<div role="region" class="wp-block-accordion-panel"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|medium"}},"layout":{"type":"constrained","justifyContent":"left"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"textColor":"text-body","fontSize":"regular-plus"} -->
<p class="has-text-body-color has-text-color has-regular-plus-font-size"><?php echo esc_html__( 'A site with the pages you need and a clear way for customers to reach you. We design around your copy and check every page on phones and desktops. It suits a business that has outgrown its site.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:list {"className":"is-style-origin-canvas-list-check-neutral","textColor":"text-body","fontSize":"regular"} -->
<ul class="wp-block-list is-style-origin-canvas-list-check-neutral has-text-body-color has-text-color has-regular-font-size"><!-- wp:list-item -->
<li><?php echo esc_html__( 'An hour of training for your team', 'origin-canvas' ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php echo esc_html__( 'Domains and accounts in your name', 'origin-canvas' ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php echo esc_html__( 'Thirty days of fixes after launch', 'origin-canvas' ); ?></li>
<!-- /wp:list-item --></ul>
<!-- /wp:list -->

<!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"}},"textColor":"text-heading","fontSize":"regular-plus"} -->
<p class="has-text-heading-color has-text-color has-regular-plus-font-size" style="font-weight:600"><?php echo esc_html__( '$4,500 &middot; six weeks', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"}},"textColor":"text-heading","fontSize":"regular"} -->
<p class="has-text-heading-color has-text-color has-regular-font-size" style="font-weight:600"><a href="#" style="text-decoration:none"><?php echo esc_html__( 'See website work', 'origin-canvas' ); ?> <span aria-hidden="true">&rarr;</span></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:accordion-panel --></div>
<!-- /wp:accordion-item -->

<!-- wp:accordion-item -->
<div class="wp-block-accordion-item"><!-- wp:accordion-heading {"level":3,"style":{"typography":{"lineHeight":"1.4"}},"textColor":"text-heading","fontSize":"medium"} -->
<h3 class="wp-block-accordion-heading has-icon has-icon-right has-text-heading-color has-text-color has-medium-font-size" style="line-height:1.4"><button type="button" class="wp-block-accordion-heading__toggle"><span class="wp-block-accordion-heading__toggle-title"><?php echo esc_html__( 'Copywriting', 'origin-canvas' ); ?> <mark style="background-color:rgba(0, 0, 0, 0)" class="has-inline-color has-text-muted-color"><?php echo esc_html__( '(words for every page)', 'origin-canvas' ); ?></mark></span><span class="wp-block-accordion-heading__toggle-icon" aria-hidden="true">+</span></button></h3>
<!-- /wp:accordion-heading -->

<!-- wp:accordion-panel -->
<div role="region" class="wp-block-accordion-panel"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|medium"}},"layout":{"type":"constrained","justifyContent":"left"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"textColor":"text-body","fontSize":"regular-plus"} -->
<p class="has-text-body-color has-text-color has-regular-plus-font-size"><?php echo esc_html__( 'Copy that sounds like you, for a new site or the one you have. We start with a call, then send each page for your comments. It suits owners who know their trade but not how to write about it.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:list {"className":"is-style-origin-canvas-list-check-neutral","textColor":"text-body","fontSize":"regular"} -->
<ul class="wp-block-list is-style-origin-canvas-list-check-neutral has-text-body-color has-text-color has-regular-font-size"><!-- wp:list-item -->
<li><?php echo esc_html__( 'Headlines, page copy and button labels', 'origin-canvas' ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php echo esc_html__( 'Copy shaped for your site', 'origin-canvas' ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php echo esc_html__( 'Copy ready to paste into your site', 'origin-canvas' ); ?></li>
<!-- /wp:list-item --></ul>
<!-- /wp:list -->

<!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"}},"textColor":"text-heading","fontSize":"regular-plus"} -->
<p class="has-text-heading-color has-text-color has-regular-plus-font-size" style="font-weight:600"><?php echo esc_html__( 'Quoted per job', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"}},"textColor":"text-heading","fontSize":"regular"} -->
<p class="has-text-heading-color has-text-color has-regular-font-size" style="font-weight:600"><a href="#" style="text-decoration:none"><?php echo esc_html__( 'See copy samples', 'origin-canvas' ); ?> <span aria-hidden="true">&rarr;</span></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:accordion-panel --></div>
<!-- /wp:accordion-item -->

<!-- wp:accordion-item -->
<div class="wp-block-accordion-item"><!-- wp:accordion-heading {"level":3,"style":{"typography":{"lineHeight":"1.4"}},"textColor":"text-heading","fontSize":"medium"} -->
<h3 class="wp-block-accordion-heading has-icon has-icon-right has-text-heading-color has-text-color has-medium-font-size" style="line-height:1.4"><button type="button" class="wp-block-accordion-heading__toggle"><span class="wp-block-accordion-heading__toggle-title"><?php echo esc_html__( 'Care after launch', 'origin-canvas' ); ?> <mark style="background-color:rgba(0, 0, 0, 0)" class="has-inline-color has-text-muted-color"><?php echo esc_html__( '(updates and fixes)', 'origin-canvas' ); ?></mark></span><span class="wp-block-accordion-heading__toggle-icon" aria-hidden="true">+</span></button></h3>
<!-- /wp:accordion-heading -->

<!-- wp:accordion-panel -->
<div role="region" class="wp-block-accordion-panel"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|medium"}},"layout":{"type":"constrained","justifyContent":"left"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"textColor":"text-body","fontSize":"regular-plus"} -->
<p class="has-text-body-color has-text-color has-regular-plus-font-size"><?php echo esc_html__( 'We look after the site once it is live, so small jobs never pile up. Send us a request when you need an update or fix. It suits a business whose site changes often.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:list {"className":"is-style-origin-canvas-list-check-neutral","textColor":"text-body","fontSize":"regular"} -->
<ul class="wp-block-list is-style-origin-canvas-list-check-neutral has-text-body-color has-text-color has-regular-font-size"><!-- wp:list-item -->
<li><?php echo esc_html__( 'Updates, fixes and new pages', 'origin-canvas' ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php echo esc_html__( 'Up to two days of work a month', 'origin-canvas' ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php echo esc_html__( 'Priority response', 'origin-canvas' ); ?></li>
<!-- /wp:list-item --></ul>
<!-- /wp:list -->

<!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"}},"textColor":"text-heading","fontSize":"regular-plus"} -->
<p class="has-text-heading-color has-text-color has-regular-plus-font-size" style="font-weight:600"><?php echo esc_html__( '$1,800 a month', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"}},"textColor":"text-heading","fontSize":"regular"} -->
<p class="has-text-heading-color has-text-color has-regular-font-size" style="font-weight:600"><a href="#" style="text-decoration:none"><?php echo esc_html__( 'See care plans', 'origin-canvas' ); ?> <span aria-hidden="true">&rarr;</span></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:accordion-panel --></div>
<!-- /wp:accordion-item --></div>
<!-- /wp:accordion --></section>
<!-- /wp:group -->
