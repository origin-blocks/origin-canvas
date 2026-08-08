<?php
/**
 * Title: Team List
 * Slug: origin-canvas/team-list
 * Description: A vertical run of colleagues, each with a circular photo beside their role and bio.
 * Categories: team
 * Keywords: staff, people, members, about, headshots
 * Block Types:
 * Post Types:
 * Inserter: true
 *
 * @package Origin
 */

?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"var:preset|spacing|colossal","bottom":"var:preset|spacing|colossal"},"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--colossal);padding-bottom:var(--wp--preset--spacing--colossal)">
<!-- wp:heading {"level":2,"style":{"typography":{"lineHeight":"1.1"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|extra-large"}}},"textColor":"text-heading","fontSize":"huge"} -->
<h2 class="wp-block-heading has-text-heading-color has-text-color has-huge-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--extra-large);line-height:1.1"><?php echo esc_html__( 'The three of us', 'origin-canvas' ); ?></h2>
<!-- /wp:heading --><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|large","padding":{"top":"var:preset|spacing|large","bottom":"var:preset|spacing|large"}},"border":{"bottom":{"color":"var:preset|color|border","style":"solid","width":"1px"}}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top"}} -->
<div class="wp-block-group" style="border-bottom-color:var(--wp--preset--color--border);border-bottom-style:solid;border-bottom-width:1px;padding-top:var(--wp--preset--spacing--large);padding-bottom:var(--wp--preset--spacing--large)"><!-- wp:image {"aspectRatio":"1","linkDestination":"none","width":"128px","height":"128px","className":"is-style-origin-canvas-rounded-full","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<figure class="wp-block-image is-resized is-style-origin-canvas-rounded-full" style="margin-top:0;margin-bottom:0"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/patterns/images/avatar-claire-bennett.webp" alt="<?php esc_attr_e( 'Portrait of Claire Bennett, Founder.', 'origin-canvas' ); ?>" style="aspect-ratio:1;width:128px;height:128px"/></figure>
<!-- /wp:image -->

<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained","justifyContent":"left"}} -->
<div class="wp-block-group"><!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|extra-small"}}},"textColor":"text-heading","fontSize":"regular-plus"} -->
<h3 class="wp-block-heading has-text-heading-color has-text-color has-regular-plus-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--extra-small)"><?php echo esc_html__( 'Claire Bennett', 'origin-canvas' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|small"}}},"textColor":"text-body","fontSize":"regular"} -->
<p class="has-text-body-color has-text-color has-regular-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--small)"><?php echo esc_html__( 'Founder', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|small"}}},"textColor":"text-body","fontSize":"small"} -->
<p class="has-text-body-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--small)"><?php echo esc_html__( 'Twelve years in agencies before going small. Most days she&#8217;s in a discovery call or pushing back on a brief.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"origin-canvas-links-plain","style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|text-heading"},":hover":{"color":{"text":"var:preset|color|primary"}}}}},"textColor":"text-muted","fontSize":"small"} -->
<p class="origin-canvas-links-plain has-text-muted-color has-text-color has-link-color has-small-font-size" style="margin-top:0;margin-bottom:0"><a href="#"><?php echo esc_html__( 'LinkedIn', 'origin-canvas' ); ?></a> &middot; <a href="#"><?php echo esc_html__( 'Twitter', 'origin-canvas' ); ?></a> &middot; <a href="#"><?php echo esc_html__( 'Email', 'origin-canvas' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|large","padding":{"top":"var:preset|spacing|large","bottom":"var:preset|spacing|large"}},"border":{"bottom":{"color":"var:preset|color|border","style":"solid","width":"1px"}}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top"}} -->
<div class="wp-block-group" style="border-bottom-color:var(--wp--preset--color--border);border-bottom-style:solid;border-bottom-width:1px;padding-top:var(--wp--preset--spacing--large);padding-bottom:var(--wp--preset--spacing--large)"><!-- wp:image {"aspectRatio":"1","linkDestination":"none","width":"128px","height":"128px","className":"is-style-origin-canvas-rounded-full","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<figure class="wp-block-image is-resized is-style-origin-canvas-rounded-full" style="margin-top:0;margin-bottom:0"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/patterns/images/avatar-marcus-holloway.webp" alt="<?php esc_attr_e( 'Portrait of Marcus Holloway.', 'origin-canvas' ); ?>" style="aspect-ratio:1;width:128px;height:128px"/></figure>
<!-- /wp:image -->

<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained","justifyContent":"left"}} -->
<div class="wp-block-group"><!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|extra-small"}}},"textColor":"text-heading","fontSize":"regular-plus"} -->
<h3 class="wp-block-heading has-text-heading-color has-text-color has-regular-plus-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--extra-small)"><?php echo esc_html__( 'Marcus Holloway', 'origin-canvas' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|small"}}},"textColor":"text-body","fontSize":"regular"} -->
<p class="has-text-body-color has-text-color has-regular-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--small)"><?php echo esc_html__( 'Senior Designer', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|small"}}},"textColor":"text-body","fontSize":"small"} -->
<p class="has-text-body-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--small)"><?php echo esc_html__( 'Draws the pages and keeps the type honest. Came from print and still sets everything twice.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"origin-canvas-links-plain","style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|text-heading"},":hover":{"color":{"text":"var:preset|color|primary"}}}}},"textColor":"text-muted","fontSize":"small"} -->
<p class="origin-canvas-links-plain has-text-muted-color has-text-color has-link-color has-small-font-size" style="margin-top:0;margin-bottom:0"><a href="#"><?php echo esc_html__( 'LinkedIn', 'origin-canvas' ); ?></a> &middot; <a href="#"><?php echo esc_html__( 'Twitter', 'origin-canvas' ); ?></a> &middot; <a href="#"><?php echo esc_html__( 'Email', 'origin-canvas' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|large","padding":{"top":"var:preset|spacing|large","bottom":"var:preset|spacing|large"}}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top"}} -->
<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--large);padding-bottom:var(--wp--preset--spacing--large)"><!-- wp:image {"aspectRatio":"1","linkDestination":"none","width":"128px","height":"128px","className":"is-style-origin-canvas-rounded-full","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<figure class="wp-block-image is-resized is-style-origin-canvas-rounded-full" style="margin-top:0;margin-bottom:0"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/patterns/images/avatar-hannah-wright.webp" alt="<?php esc_attr_e( 'Portrait of Hannah Wright.', 'origin-canvas' ); ?>" style="aspect-ratio:1;width:128px;height:128px"/></figure>
<!-- /wp:image -->

<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained","justifyContent":"left"}} -->
<div class="wp-block-group"><!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|extra-small"}}},"textColor":"text-heading","fontSize":"regular-plus"} -->
<h3 class="wp-block-heading has-text-heading-color has-text-color has-regular-plus-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--extra-small)"><?php echo esc_html__( 'Hannah Wright', 'origin-canvas' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|small"}}},"textColor":"text-body","fontSize":"regular"} -->
<p class="has-text-body-color has-text-color has-regular-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--small)"><?php echo esc_html__( 'Brand Strategist', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|small"}}},"textColor":"text-body","fontSize":"small"} -->
<p class="has-text-body-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--small)"><?php echo esc_html__( 'Works out what a business is actually saying before anyone draws a page. Runs the first week of every project.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"origin-canvas-links-plain","style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|text-heading"},":hover":{"color":{"text":"var:preset|color|primary"}}}}},"textColor":"text-muted","fontSize":"small"} -->
<p class="origin-canvas-links-plain has-text-muted-color has-text-color has-link-color has-small-font-size" style="margin-top:0;margin-bottom:0"><a href="#"><?php echo esc_html__( 'LinkedIn', 'origin-canvas' ); ?></a> &middot; <a href="#"><?php echo esc_html__( 'Twitter', 'origin-canvas' ); ?></a> &middot; <a href="#"><?php echo esc_html__( 'Email', 'origin-canvas' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
