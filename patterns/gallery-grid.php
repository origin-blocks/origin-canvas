<?php
/**
 * Title: Gallery Grid
 * Slug: origin-canvas/gallery-grid
 * Description: Six photographs in a three-column grid with rounded corners.
 * Categories: gallery
 * Keywords: photos, images, portfolio, work, pictures
 * Viewport Width: 1500
 * Block Types:
 * Post Types:
 * Inserter: true
 *
 * @package Origin
 */
?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"var:preset|spacing|colossal","bottom":"var:preset|spacing|colossal"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--colossal);padding-bottom:var(--wp--preset--spacing--colossal)"><!-- wp:gallery {"columns":3,"imageCrop":true,"linkTo":"none","align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|large","left":"var:preset|spacing|large"}}}} -->
<figure class="wp-block-gallery alignwide has-nested-images columns-3 is-cropped"><!-- wp:image {"aspectRatio":"3/2","scale":"cover","sizeSlug":"large","linkDestination":"none","className":"is-style-rounded"} -->
<figure class="wp-block-image size-large is-style-rounded"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/patterns/images/gallery-proof-wall.webp" alt="<?php esc_attr_e( 'Kestrel Physical Therapy in orange letters on a clinic wall, above resistance bands, dumbbells and exercise balls.', 'origin-canvas' ); ?>" style="aspect-ratio:3/2;object-fit:cover"/></figure>
<!-- /wp:image -->

<!-- wp:image {"aspectRatio":"3/2","scale":"cover","sizeSlug":"large","linkDestination":"none","className":"is-style-rounded"} -->
<figure class="wp-block-image size-large is-style-rounded"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/patterns/images/gallery-paper-stock.webp" alt="<?php esc_attr_e( 'The oxblood front door of Ashby &amp; Rowe in an old brick wall, with a brass name plaque beside it.', 'origin-canvas' ); ?>" style="aspect-ratio:3/2;object-fit:cover"/></figure>
<!-- /wp:image -->

<!-- wp:image {"aspectRatio":"3/2","scale":"cover","sizeSlug":"large","linkDestination":"none","className":"is-style-rounded"} -->
<figure class="wp-block-image size-large is-style-rounded"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/patterns/images/gallery-guidelines.webp" alt="<?php esc_attr_e( 'A green Clearwater Accounting tax folder on a walnut meeting table, with a legal pad of figures and a clipped stack of papers.', 'origin-canvas' ); ?>" style="aspect-ratio:3/2;object-fit:cover"/></figure>
<!-- /wp:image -->

<!-- wp:image {"aspectRatio":"3/2","scale":"cover","sizeSlug":"large","linkDestination":"none","className":"is-style-rounded"} -->
<figure class="wp-block-image size-large is-style-rounded"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/patterns/images/gallery-screen-review.webp" alt="<?php esc_attr_e( 'A blue Westmount Realty for-sale sign on the lawn of a brick ranch house on a sunny fall day.', 'origin-canvas' ); ?>" style="aspect-ratio:3/2;object-fit:cover"/></figure>
<!-- /wp:image -->

<!-- wp:image {"aspectRatio":"3/2","scale":"cover","sizeSlug":"large","linkDestination":"none","className":"is-style-rounded"} -->
<figure class="wp-block-image size-large is-style-rounded"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/patterns/images/gallery-studio-shelf.webp" alt="<?php esc_attr_e( 'A crowded studio shelf of archive boxes and paper rolls, with a wrapped stack of red Northgate Cycle Works service menus marked for pickup.', 'origin-canvas' ); ?>" style="aspect-ratio:3/2;object-fit:cover"/></figure>
<!-- /wp:image -->

<!-- wp:image {"aspectRatio":"3/2","scale":"cover","sizeSlug":"large","linkDestination":"none","className":"is-style-rounded"} -->
<figure class="wp-block-image size-large is-style-rounded"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/patterns/images/gallery-meeting-table.webp" alt="<?php esc_attr_e( 'A white Fairview Architects hard hat and a roll of drawings on a plywood site table, with a house going up behind.', 'origin-canvas' ); ?>" style="aspect-ratio:3/2;object-fit:cover"/></figure>
<!-- /wp:image --></figure>
<!-- /wp:gallery --></section>
<!-- /wp:group -->
