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
<figure class="wp-block-gallery alignwide has-nested-images columns-3 is-cropped"><!-- wp:image {"aspectRatio":"3/2","scale":"cover","sizeSlug":"large","linkDestination":"none","style":{"border":{"radius":"var:custom|radius|medium"}}} -->
<figure class="wp-block-image size-large has-custom-border"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/patterns/images/gallery-proof-wall.webp" alt="<?php esc_attr_e( 'Printed website page layouts pinned in a grid on a white studio wall.', 'origin-canvas' ); ?>" style="border-radius:var(--wp--custom--radius--medium);aspect-ratio:3/2;object-fit:cover"/></figure>
<!-- /wp:image -->

<!-- wp:image {"aspectRatio":"3/2","scale":"cover","sizeSlug":"large","linkDestination":"none","style":{"border":{"radius":"var:custom|radius|medium"}}} -->
<figure class="wp-block-image size-large has-custom-border"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/patterns/images/gallery-paper-stock.webp" alt="<?php esc_attr_e( 'Business card and letterhead paper samples fanned out beside a steel ruler.', 'origin-canvas' ); ?>" style="border-radius:var(--wp--custom--radius--medium);aspect-ratio:3/2;object-fit:cover"/></figure>
<!-- /wp:image -->

<!-- wp:image {"aspectRatio":"3/2","scale":"cover","sizeSlug":"large","linkDestination":"none","style":{"border":{"radius":"var:custom|radius|medium"}}} -->
<figure class="wp-block-image size-large has-custom-border"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/patterns/images/gallery-guidelines.webp" alt="<?php esc_attr_e( 'A printed brand guidelines booklet open at a page of color swatches.', 'origin-canvas' ); ?>" style="border-radius:var(--wp--custom--radius--medium);aspect-ratio:3/2;object-fit:cover"/></figure>
<!-- /wp:image -->

<!-- wp:image {"aspectRatio":"3/2","scale":"cover","sizeSlug":"large","linkDestination":"none","style":{"border":{"radius":"var:custom|radius|medium"}}} -->
<figure class="wp-block-image size-large has-custom-border"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/patterns/images/gallery-screen-review.webp" alt="<?php esc_attr_e( 'A website homepage on a large monitor above a keyboard and a black notebook.', 'origin-canvas' ); ?>" style="border-radius:var(--wp--custom--radius--medium);aspect-ratio:3/2;object-fit:cover"/></figure>
<!-- /wp:image -->

<!-- wp:image {"aspectRatio":"3/2","scale":"cover","sizeSlug":"large","linkDestination":"none","style":{"border":{"radius":"var:custom|radius|medium"}}} -->
<figure class="wp-block-image size-large has-custom-border"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/patterns/images/gallery-studio-shelf.webp" alt="<?php esc_attr_e( 'Steel shelving with archive boxes, rolled prints and plain hardback books.', 'origin-canvas' ); ?>" style="border-radius:var(--wp--custom--radius--medium);aspect-ratio:3/2;object-fit:cover"/></figure>
<!-- /wp:image -->

<!-- wp:image {"aspectRatio":"3/2","scale":"cover","sizeSlug":"large","linkDestination":"none","style":{"border":{"radius":"var:custom|radius|medium"}}} -->
<figure class="wp-block-image size-large has-custom-border"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/patterns/images/gallery-meeting-table.webp" alt="<?php esc_attr_e( 'Page proofs laid out in rows on an oak meeting table by a tall window.', 'origin-canvas' ); ?>" style="border-radius:var(--wp--custom--radius--medium);aspect-ratio:3/2;object-fit:cover"/></figure>
<!-- /wp:image --></figure>
<!-- /wp:gallery --></section>
<!-- /wp:group -->
