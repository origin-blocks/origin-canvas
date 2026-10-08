<?php
/**
 * Title: Pricing Hero
 * Slug: origin-canvas/pricing-hero
 * Description: A page-top pricing section with three tier cards, a currency and tax note, and a row of client logos in gray.
 * Categories: origin-canvas/hero
 * Keywords: plans, rates, packages, cost, masthead, brands
 * Viewport Width: 1500
 * Block Types:
 * Post Types:
 * Inserter: true
 *
 * @package Origin
 */

?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"var:preset|spacing|colossal","bottom":"var:preset|spacing|colossal"}}},"layout":{"type":"constrained","contentSize":"960px","wideSize":"1200px"}} -->
<section class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--colossal);padding-bottom:var(--wp--preset--spacing--colossal)"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|medium"}},"layout":{"type":"constrained","contentSize":"960px"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","fontWeight":"600","letterSpacing":"0.08em"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-muted","fontSize":"small"} -->
<p class="has-text-align-center has-text-muted-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:0;font-weight:600;letter-spacing:0.08em;text-transform:uppercase"><?php echo esc_html__( 'Pricing', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","level":1,"className":"origin-canvas-text-balance","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"fontSize":"display"} -->
<h1 class="wp-block-heading has-text-align-center origin-canvas-text-balance has-display-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Fixed prices, agreed up front', 'origin-canvas' ); ?></h1>
<!-- /wp:heading -->

<!-- wp:group {"layout":{"type":"constrained","contentSize":"640px"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"align":"center","textColor":"text-body","fontSize":"regular-plus"} -->
<p class="has-text-align-center has-text-body-color has-text-color has-regular-plus-font-size"><?php echo esc_html__( 'Every engagement is scoped in writing before we begin, so the invoice never surprises you.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:columns {"align":"wide","verticalAlignment":"stretch","style":{"spacing":{"margin":{"top":"var:preset|spacing|huge"},"blockGap":{"top":"var:preset|spacing|large","left":"var:preset|spacing|large"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-stretch" style="margin-top:var(--wp--preset--spacing--huge)"><!-- wp:column {"verticalAlignment":"stretch","backgroundColor":"surface-base","borderColor":"input-border","style":{"border":{"radius":"var:custom|radius|large","style":"solid","width":"1px"},"spacing":{"padding":{"top":"var:preset|spacing|extra-large","right":"var:preset|spacing|extra-large","bottom":"var:preset|spacing|extra-large","left":"var:preset|spacing|extra-large"}}}} -->
<div class="wp-block-column is-vertically-aligned-stretch has-border-color has-input-border-border-color has-surface-base-background-color has-background" style="border-style:solid;border-width:1px;border-radius:var(--wp--custom--radius--large);padding-top:var(--wp--preset--spacing--extra-large);padding-right:var(--wp--preset--spacing--extra-large);padding-bottom:var(--wp--preset--spacing--extra-large);padding-left:var(--wp--preset--spacing--extra-large)"><!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:heading {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"fontSize":"large"} -->
<h2 class="wp-block-heading has-large-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Starter', 'origin-canvas' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:group {"style":{"dimensions":{"minHeight":"4.8rem"},"spacing":{"margin":{"top":"var:preset|spacing|compact","bottom":"0"}},"@tablet":{"dimensions":{"minHeight":"0"}},"@mobile":{"dimensions":{"minHeight":"0"}}},"layout":{"type":"default"}} -->
<div class="wp-block-group" style="min-height:4.8rem;margin-top:var(--wp--preset--spacing--compact);margin-bottom:0"><!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-body","fontSize":"regular"} -->
<p class="has-text-body-color has-text-color has-regular-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'A focused site for a small business that knows what it wants to say.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|large","bottom":"0"}},"typography":{"fontWeight":"700","lineHeight":"1"}},"textColor":"text-heading","fontSize":"huge"} -->
<p class="has-text-heading-color has-text-color has-huge-font-size" style="margin-top:var(--wp--preset--spacing--large);margin-bottom:0;font-weight:700;line-height:1"><?php echo wp_kses_post( __( '$2,400 <span style="font-size:var(--wp--preset--font-size--regular);font-weight:400;letter-spacing:normal;color:var(--wp--preset--color--text-muted);">one-time</span>', 'origin-canvas' ) ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|large","bottom":"0"}}}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--large);margin-bottom:0"><!-- wp:button {"width":100,"className":"is-style-outline"} -->
<div class="wp-block-button has-custom-width wp-block-button__width-100 is-style-outline"><a class="wp-block-button__link wp-element-button"><?php echo esc_html__( 'Get started', 'origin-canvas' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|large","bottom":"0"}},"typography":{"fontWeight":"600"}},"textColor":"text-heading","fontSize":"small"} -->
<p class="has-text-heading-color has-text-color has-small-font-size" style="margin-top:var(--wp--preset--spacing--large);margin-bottom:0;font-weight:600"><?php echo esc_html__( 'Includes', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:list {"className":"is-style-origin-canvas-list-check","style":{"spacing":{"margin":{"top":"var:preset|spacing|compact","bottom":"0"}}},"textColor":"text-body","fontSize":"regular"} -->
<ul class="wp-block-list is-style-origin-canvas-list-check has-text-body-color has-text-color has-regular-font-size" style="margin-top:var(--wp--preset--spacing--compact);margin-bottom:0"><!-- wp:list-item --><li><?php echo esc_html__( 'Up to five pages', 'origin-canvas' ); ?></li><!-- /wp:list-item -->
<!-- wp:list-item --><li><?php echo esc_html__( 'Logo refresh', 'origin-canvas' ); ?></li><!-- /wp:list-item -->
<!-- wp:list-item --><li><?php echo esc_html__( 'Two rounds of revisions', 'origin-canvas' ); ?></li><!-- /wp:list-item -->
<!-- wp:list-item --><li><?php echo esc_html__( 'Two-week delivery', 'origin-canvas' ); ?></li><!-- /wp:list-item --></ul>
<!-- /wp:list --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"stretch","backgroundColor":"surface-base","borderColor":"border-strong","style":{"border":{"radius":"var:custom|radius|large","style":"solid","width":"2px"},"spacing":{"padding":{"top":"var:preset|spacing|extra-large","right":"var:preset|spacing|extra-large","bottom":"var:preset|spacing|extra-large","left":"var:preset|spacing|extra-large"}}}} -->
<div class="wp-block-column is-vertically-aligned-stretch has-border-color has-border-strong-border-color has-surface-base-background-color has-background" style="border-style:solid;border-width:2px;border-radius:var(--wp--custom--radius--large);padding-top:var(--wp--preset--spacing--extra-large);padding-right:var(--wp--preset--spacing--extra-large);padding-bottom:var(--wp--preset--spacing--extra-large);padding-left:var(--wp--preset--spacing--extra-large)"><!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:group {"className":"origin-canvas-align-baseline","style":{"spacing":{"blockGap":"var:preset|spacing|compact"}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
<div class="wp-block-group origin-canvas-align-baseline"><!-- wp:heading {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"fontSize":"large"} -->
<h2 class="wp-block-heading has-large-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Studio', 'origin-canvas' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","fontWeight":"600","letterSpacing":"0.08em"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"primary","fontSize":"extra-small"} -->
<p class="has-primary-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:0;font-weight:600;letter-spacing:0.08em;text-transform:uppercase"><?php echo esc_html__( 'Most chosen', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"dimensions":{"minHeight":"4.8rem"},"spacing":{"margin":{"top":"var:preset|spacing|compact","bottom":"0"}},"@tablet":{"dimensions":{"minHeight":"0"}},"@mobile":{"dimensions":{"minHeight":"0"}}},"layout":{"type":"default"}} -->
<div class="wp-block-group" style="min-height:4.8rem;margin-top:var(--wp--preset--spacing--compact);margin-bottom:0"><!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-body","fontSize":"regular"} -->
<p class="has-text-body-color has-text-color has-regular-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Our standard engagement: brand work, site, and a hand-written launch checklist.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|large","bottom":"0"}},"typography":{"fontWeight":"700","lineHeight":"1"}},"textColor":"text-heading","fontSize":"huge"} -->
<p class="has-text-heading-color has-text-color has-huge-font-size" style="margin-top:var(--wp--preset--spacing--large);margin-bottom:0;font-weight:700;line-height:1"><?php echo wp_kses_post( __( '$6,000 <span style="font-size:var(--wp--preset--font-size--regular);font-weight:400;letter-spacing:normal;color:var(--wp--preset--color--text-muted);">one-time</span>', 'origin-canvas' ) ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|large","bottom":"0"}}}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--large);margin-bottom:0"><!-- wp:button {"width":100,"className":"is-style-origin-canvas-fill-primary"} -->
<div class="wp-block-button has-custom-width wp-block-button__width-100 is-style-origin-canvas-fill-primary"><a class="wp-block-button__link wp-element-button"><?php echo esc_html__( 'Talk to us', 'origin-canvas' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|large","bottom":"0"}},"typography":{"fontWeight":"600"}},"textColor":"text-heading","fontSize":"small"} -->
<p class="has-text-heading-color has-text-color has-small-font-size" style="margin-top:var(--wp--preset--spacing--large);margin-bottom:0;font-weight:600"><?php echo esc_html__( 'Everything in Starter, plus', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:list {"className":"is-style-origin-canvas-list-check","style":{"spacing":{"margin":{"top":"var:preset|spacing|compact","bottom":"0"}}},"textColor":"text-body","fontSize":"regular"} -->
<ul class="wp-block-list is-style-origin-canvas-list-check has-text-body-color has-text-color has-regular-font-size" style="margin-top:var(--wp--preset--spacing--compact);margin-bottom:0"><!-- wp:list-item --><li><?php echo esc_html__( 'Up to twelve pages', 'origin-canvas' ); ?></li><!-- /wp:list-item -->
<!-- wp:list-item --><li><?php echo esc_html__( 'Full identity (mark, color, type)', 'origin-canvas' ); ?></li><!-- /wp:list-item -->
<!-- wp:list-item --><li><?php echo esc_html__( 'Photography direction', 'origin-canvas' ); ?></li><!-- /wp:list-item -->
<!-- wp:list-item --><li><?php echo esc_html__( 'Four-week delivery', 'origin-canvas' ); ?></li><!-- /wp:list-item --></ul>
<!-- /wp:list --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"stretch","backgroundColor":"surface-base","borderColor":"input-border","style":{"border":{"radius":"var:custom|radius|large","style":"solid","width":"1px"},"spacing":{"padding":{"top":"var:preset|spacing|extra-large","right":"var:preset|spacing|extra-large","bottom":"var:preset|spacing|extra-large","left":"var:preset|spacing|extra-large"}}}} -->
<div class="wp-block-column is-vertically-aligned-stretch has-border-color has-input-border-border-color has-surface-base-background-color has-background" style="border-style:solid;border-width:1px;border-radius:var(--wp--custom--radius--large);padding-top:var(--wp--preset--spacing--extra-large);padding-right:var(--wp--preset--spacing--extra-large);padding-bottom:var(--wp--preset--spacing--extra-large);padding-left:var(--wp--preset--spacing--extra-large)"><!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:heading {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"fontSize":"large"} -->
<h2 class="wp-block-heading has-large-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Retained', 'origin-canvas' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:group {"style":{"dimensions":{"minHeight":"4.8rem"},"spacing":{"margin":{"top":"var:preset|spacing|compact","bottom":"0"}},"@tablet":{"dimensions":{"minHeight":"0"}},"@mobile":{"dimensions":{"minHeight":"0"}}},"layout":{"type":"default"}} -->
<div class="wp-block-group" style="min-height:4.8rem;margin-top:var(--wp--preset--spacing--compact);margin-bottom:0"><!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-body","fontSize":"regular"} -->
<p class="has-text-body-color has-text-color has-regular-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'For clients who treat their site like a living thing, not a one-time project.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|large","bottom":"0"}},"typography":{"fontWeight":"700","lineHeight":"1"}},"textColor":"text-heading","fontSize":"huge"} -->
<p class="has-text-heading-color has-text-color has-huge-font-size" style="margin-top:var(--wp--preset--spacing--large);margin-bottom:0;font-weight:700;line-height:1"><?php echo wp_kses_post( __( '$1,800 <span style="font-size:var(--wp--preset--font-size--regular);font-weight:400;letter-spacing:normal;color:var(--wp--preset--color--text-muted);">per month</span>', 'origin-canvas' ) ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|large","bottom":"0"}}}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--large);margin-bottom:0"><!-- wp:button {"width":100,"className":"is-style-outline"} -->
<div class="wp-block-button has-custom-width wp-block-button__width-100 is-style-outline"><a class="wp-block-button__link wp-element-button"><?php echo esc_html__( 'Inquire', 'origin-canvas' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|large","bottom":"0"}},"typography":{"fontWeight":"600"}},"textColor":"text-heading","fontSize":"small"} -->
<p class="has-text-heading-color has-text-color has-small-font-size" style="margin-top:var(--wp--preset--spacing--large);margin-bottom:0;font-weight:600"><?php echo esc_html__( 'Each month', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:list {"className":"is-style-origin-canvas-list-check","style":{"spacing":{"margin":{"top":"var:preset|spacing|compact","bottom":"0"}}},"textColor":"text-body","fontSize":"regular"} -->
<ul class="wp-block-list is-style-origin-canvas-list-check has-text-body-color has-text-color has-regular-font-size" style="margin-top:var(--wp--preset--spacing--compact);margin-bottom:0"><!-- wp:list-item --><li><?php echo esc_html__( 'Up to two days of work', 'origin-canvas' ); ?></li><!-- /wp:list-item -->
<!-- wp:list-item --><li><?php echo esc_html__( 'A quarterly review call', 'origin-canvas' ); ?></li><!-- /wp:list-item -->
<!-- wp:list-item --><li><?php echo esc_html__( 'A reply within a business day', 'origin-canvas' ); ?></li><!-- /wp:list-item -->
<!-- wp:list-item --><li><?php echo esc_html__( 'Six-month minimum', 'origin-canvas' ); ?></li><!-- /wp:list-item --></ul>
<!-- /wp:list --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:group {"align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|large"},"blockGap":{"top":"var:preset|spacing|small","left":"var:preset|spacing|large"}}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"center"}} -->
<div class="wp-block-group alignwide" style="margin-top:var(--wp--preset--spacing--large)"><!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-muted","fontSize":"regular"} -->
<p class="has-text-muted-color has-text-color has-regular-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'All prices in USD, before tax.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading","fontSize":"regular"} -->
<p class="has-text-heading-color has-text-color has-regular-font-size" style="margin-top:0;margin-bottom:0;font-weight:600"><a href="mailto:hello@example.com" style="text-decoration:none"><?php echo esc_html__( 'Something bigger? Let&#8217;s talk', 'origin-canvas' ); ?> <span aria-hidden="true">&rarr;</span></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|jumbo"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide" style="margin-top:var(--wp--preset--spacing--jumbo)"><!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","letterSpacing":"0.08em","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|extra-large"}}},"textColor":"text-heading","fontSize":"extra-small"} -->
<p class="has-text-align-center has-text-heading-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--extra-large);font-weight:600;letter-spacing:0.08em;text-transform:uppercase"><?php echo esc_html__( 'Trusted by', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|large"}},"layout":{"type":"grid","columnCount":6,"minimumColumnWidth":"8rem"}} -->
<div class="wp-block-group alignwide"><!-- wp:group {"layout":{"type":"flex","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group"><!-- wp:image {"width":"137px","sizeSlug":"full","linkDestination":"none","style":{"color":{"duotone":"var:preset|duotone|logo-gray"}}} -->
<figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/patterns/images/logo-westmount.png" alt="<?php esc_attr_e( 'Westmount Realty', 'origin-canvas' ); ?>" style="width:137px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<!-- wp:group {"layout":{"type":"flex","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group"><!-- wp:image {"width":"149px","sizeSlug":"full","linkDestination":"none","style":{"color":{"duotone":"var:preset|duotone|logo-gray"}}} -->
<figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/patterns/images/logo-ashby-rowe.png" alt="<?php esc_attr_e( 'Ashby &amp; Rowe Law', 'origin-canvas' ); ?>" style="width:149px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<!-- wp:group {"layout":{"type":"flex","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group"><!-- wp:image {"width":"119px","sizeSlug":"full","linkDestination":"none","style":{"color":{"duotone":"var:preset|duotone|logo-gray"}}} -->
<figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/patterns/images/logo-kestrel.png" alt="<?php esc_attr_e( 'Kestrel Physical Therapy', 'origin-canvas' ); ?>" style="width:119px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<!-- wp:group {"layout":{"type":"flex","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group"><!-- wp:image {"width":"122px","sizeSlug":"full","linkDestination":"none","style":{"color":{"duotone":"var:preset|duotone|logo-gray"}}} -->
<figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/patterns/images/logo-northgate.png" alt="<?php esc_attr_e( 'Northgate Cycle Works', 'origin-canvas' ); ?>" style="width:122px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"blockVisibility":{"viewport":{"mobile":false}}},"layout":{"type":"flex","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group"><!-- wp:image {"width":"162px","sizeSlug":"full","linkDestination":"none","style":{"color":{"duotone":"var:preset|duotone|logo-gray"}}} -->
<figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/patterns/images/logo-clearwater.png" alt="<?php esc_attr_e( 'Clearwater Accounting', 'origin-canvas' ); ?>" style="width:162px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"blockVisibility":{"viewport":{"mobile":false}}},"layout":{"type":"flex","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group"><!-- wp:image {"width":"91px","sizeSlug":"full","linkDestination":"none","style":{"color":{"duotone":"var:preset|duotone|logo-gray"}}} -->
<figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/patterns/images/logo-fairview.png" alt="<?php esc_attr_e( 'Fairview Architects', 'origin-canvas' ); ?>" style="width:91px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->
