<?php
/**
 * Title: Gallery List
 * Slug: origin-canvas/gallery-image-text
 * Description: A heading with a link beside it, over photos the width of the content, one under another, each with a short title beside a description.
 * Categories: gallery
 * Keywords: story, studio, process, showcase
 * Viewport Width: 1500
 * Block Types:
 * Post Types:
 * Inserter: true
 *
 * @package Origin
 */
?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"var:preset|spacing|colossal","bottom":"var:preset|spacing|colossal"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--colossal);padding-bottom:var(--wp--preset--spacing--colossal)"><!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|jumbo"}},"layout":{"type":"default"}} -->
<div class="wp-block-group alignwide"><!-- wp:group {"className":"origin-canvas-align-baseline","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|small","left":"var:preset|spacing|extra-large"}}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
<div class="wp-block-group origin-canvas-align-baseline"><!-- wp:heading {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"fontSize":"huge"} -->
<h2 class="wp-block-heading has-huge-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Inside the studio', 'origin-canvas' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"origin-canvas-no-shrink","style":{"typography":{"fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading","fontSize":"small"} -->
<p class="origin-canvas-no-shrink has-text-heading-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:0;font-weight:600"><a href="#" style="text-decoration:none"><?php echo esc_html__( 'About the studio', 'origin-canvas' ); ?> <span aria-hidden="true">&rarr;</span></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|large"},"blockGap":"0"}},"layout":{"type":"default"}} -->
<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--large)"><!-- wp:image {"width":"100%","height":"auto","aspectRatio":"16/9","scale":"cover","sizeSlug":"large","linkDestination":"none","className":"is-style-rounded"} -->
<figure class="wp-block-image size-large is-resized is-style-rounded"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/patterns/images/studio-type-proofs.webp" alt="<?php esc_attr_e( 'Three printed type specimens and a marked-up page of copy with a red pen, beside a dark stone bowl on a pale worktable.', 'origin-canvas' ); ?>" style="aspect-ratio:16/9;object-fit:cover;width:100%;height:auto"/></figure>
<!-- /wp:image -->

<!-- wp:columns {"style":{"spacing":{"margin":{"top":"var:preset|spacing|large"},"blockGap":{"top":"var:preset|spacing|compact","left":"var:preset|spacing|jumbo"}}}} -->
<div class="wp-block-columns" style="margin-top:var(--wp--preset--spacing--large)"><!-- wp:column {"width":"50%"} -->
<div class="wp-block-column" style="flex-basis:50%"><!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"fontSize":"large"} -->
<h3 class="wp-block-heading has-large-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Type, printed and pinned up', 'origin-canvas' ); ?></h3>
<!-- /wp:heading --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"50%"} -->
<div class="wp-block-column" style="flex-basis:50%"><!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-body","fontSize":"regular-plus"} -->
<p class="has-text-body-color has-text-color has-regular-plus-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Every identity starts as printed specimens on the wall. We live with them for a week before anyone picks one.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:image {"width":"100%","height":"auto","aspectRatio":"16/9","scale":"cover","sizeSlug":"large","linkDestination":"none","className":"is-style-rounded"} -->
<figure class="wp-block-image size-large is-resized is-style-rounded"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/patterns/images/studio-worktable.webp" alt="<?php esc_attr_e( 'A closed laptop, a black notebook and a fan of paint swatches on a wooden desk.', 'origin-canvas' ); ?>" style="aspect-ratio:16/9;object-fit:cover;width:100%;height:auto"/></figure>
<!-- /wp:image -->

<!-- wp:columns {"style":{"spacing":{"margin":{"top":"var:preset|spacing|large"},"blockGap":{"top":"var:preset|spacing|compact","left":"var:preset|spacing|jumbo"}}}} -->
<div class="wp-block-columns" style="margin-top:var(--wp--preset--spacing--large)"><!-- wp:column {"width":"50%"} -->
<div class="wp-block-column" style="flex-basis:50%"><!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"fontSize":"large"} -->
<h3 class="wp-block-heading has-large-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Color, chosen in daylight', 'origin-canvas' ); ?></h3>
<!-- /wp:heading --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"50%"} -->
<div class="wp-block-column" style="flex-basis:50%"><!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-body","fontSize":"regular-plus"} -->
<p class="has-text-body-color has-text-color has-regular-plus-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Swatches go on the table by the window. A palette that works on a screen at night can still fail on a business card in the morning.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:image {"width":"100%","height":"auto","aspectRatio":"16/9","scale":"cover","sizeSlug":"large","linkDestination":"none","className":"is-style-rounded"} -->
<figure class="wp-block-image size-large is-resized is-style-rounded"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/patterns/images/desk-notebook-overhead.webp" alt="<?php esc_attr_e( 'An open sketchbook with pencil drawings of a room and a floor plan, beside a pencil, a steel ruler and a black mug.', 'origin-canvas' ); ?>" style="aspect-ratio:16/9;object-fit:cover;width:100%;height:auto"/></figure>
<!-- /wp:image -->

<!-- wp:columns {"style":{"spacing":{"margin":{"top":"var:preset|spacing|large"},"blockGap":{"top":"var:preset|spacing|compact","left":"var:preset|spacing|jumbo"}}}} -->
<div class="wp-block-columns" style="margin-top:var(--wp--preset--spacing--large)"><!-- wp:column {"width":"50%"} -->
<div class="wp-block-column" style="flex-basis:50%"><!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"fontSize":"large"} -->
<h3 class="wp-block-heading has-large-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Every page sketched first', 'origin-canvas' ); ?></h3>
<!-- /wp:heading --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"50%"} -->
<div class="wp-block-column" style="flex-basis:50%"><!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-body","fontSize":"regular-plus"} -->
<p class="has-text-body-color has-text-color has-regular-plus-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'We sketch every page at full size first, so the first thing built in the browser has already been agreed.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
