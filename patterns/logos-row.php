<?php
/**
 * Title: Logos Row
 * Slug: origin-canvas/logos-row
 * Description: A "Trusted by" label above one row of client logos in gray.
 * Categories: origin-canvas/logos
 * Keywords: brands, customers, partners, strip, endorsement
 * Viewport Width: 1500
 * Block Types:
 * Post Types:
 * Inserter: true
 *
 * @package Origin
 */
?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"var:preset|spacing|huge","bottom":"var:preset|spacing|huge"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--huge);padding-bottom:var(--wp--preset--spacing--huge)"><!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","letterSpacing":"0.08em","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|extra-large"}}},"textColor":"text-heading","fontSize":"extra-small"} -->
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

<!-- wp:group {"layout":{"type":"flex","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group"><!-- wp:image {"width":"162px","sizeSlug":"full","linkDestination":"none","style":{"color":{"duotone":"var:preset|duotone|logo-gray"}}} -->
<figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/patterns/images/logo-clearwater.png" alt="<?php esc_attr_e( 'Clearwater Accounting', 'origin-canvas' ); ?>" style="width:162px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<!-- wp:group {"layout":{"type":"flex","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group"><!-- wp:image {"width":"91px","sizeSlug":"full","linkDestination":"none","style":{"color":{"duotone":"var:preset|duotone|logo-gray"}}} -->
<figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/patterns/images/logo-fairview.png" alt="<?php esc_attr_e( 'Fairview Architects', 'origin-canvas' ); ?>" style="width:91px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
