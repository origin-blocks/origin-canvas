<?php
/**
 * Title: Features With Image
 * Slug: origin-canvas/features-with-image
 * Description: A media-and-text feature section with a stacked list of steps beside an image.
 * Categories: origin-canvas/features
 * Keywords: services, journey, workflow, stages
 * Viewport Width: 1500
 * Block Types:
 * Post Types:
 * Inserter: true
 *
 * @package Origin
 */

?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|massive","bottom":"var:preset|spacing|massive"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--massive);padding-bottom:var(--wp--preset--spacing--massive)"><!-- wp:columns {"align":"wide","verticalAlignment":"center","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|huge","left":"var:preset|spacing|colossal"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center","width":"46%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:46%"><!-- wp:image {"aspectRatio":"4/5","scale":"cover","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"var:custom|radius|large"}}} -->
<figure class="wp-block-image size-full has-custom-border"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/patterns/images/card-image-text-3.webp" alt="<?php esc_attr_e( 'A florist worktable with wrapped flowers, paper tags, ribbon, and shears.', 'origin-canvas' ); ?>" style="border-radius:var(--wp--custom--radius--large);aspect-ratio:4/5;object-fit:cover"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"54%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:54%"><!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|medium","margin":{"bottom":"var:preset|spacing|extra-large"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="margin-bottom:var(--wp--preset--spacing--extra-large)"><!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","fontWeight":"600","letterSpacing":"0.08em"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|medium"}}},"textColor":"primary","fontSize":"extra-small"} -->
<p class="has-primary-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--medium);font-weight:600;letter-spacing:0.08em;text-transform:uppercase"><?php echo esc_html__( 'End to end', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2,"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"fontSize":"display"} -->
<h2 class="wp-block-heading has-display-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'A small studio, the whole way through', 'origin-canvas' ); ?></h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|medium","bottom":"var:preset|spacing|medium"},"blockGap":"var:preset|spacing|medium"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top"}} -->
<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--medium);padding-bottom:var(--wp--preset--spacing--medium)"><!-- wp:group {"className":"is-style-origin-canvas-icon-bubble","backgroundColor":"surface-muted","layout":{"type":"flex","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group is-style-origin-canvas-icon-bubble has-surface-muted-background-color has-background"><!-- wp:icon {"icon":"core/search","textColor":"primary","style":{"dimensions":{"width":"28px"}}} /--></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|small"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"fontSize":"medium"} -->
<h3 class="wp-block-heading has-medium-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Strategy and scope', 'origin-canvas' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"text-body","fontSize":"regular"} -->
<p class="has-text-body-color has-text-color has-regular-font-size"><?php echo esc_html__( 'We start with the awkward questions, then write the scope down in plain English.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"border":{"top":{"color":"var:preset|color|border","style":"solid","width":"1px"}},"spacing":{"padding":{"top":"var:preset|spacing|medium","bottom":"var:preset|spacing|medium"},"blockGap":"var:preset|spacing|medium"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top"}} -->
<div class="wp-block-group" style="border-top-color:var(--wp--preset--color--border);border-top-style:solid;border-top-width:1px;padding-top:var(--wp--preset--spacing--medium);padding-bottom:var(--wp--preset--spacing--medium)"><!-- wp:group {"className":"is-style-origin-canvas-icon-bubble","backgroundColor":"surface-muted","layout":{"type":"flex","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group is-style-origin-canvas-icon-bubble has-surface-muted-background-color has-background"><!-- wp:icon {"icon":"core/group","textColor":"primary","style":{"dimensions":{"width":"28px"}}} /--></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|small"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"fontSize":"medium"} -->
<h3 class="wp-block-heading has-medium-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Design and build', 'origin-canvas' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"text-body","fontSize":"regular"} -->
<p class="has-text-body-color has-text-color has-regular-font-size"><?php echo esc_html__( 'Identity, type, and a site made by the same three people throughout.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"border":{"top":{"color":"var:preset|color|border","style":"solid","width":"1px"}},"spacing":{"padding":{"top":"var:preset|spacing|medium","bottom":"var:preset|spacing|medium"},"blockGap":"var:preset|spacing|medium"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top"}} -->
<div class="wp-block-group" style="border-top-color:var(--wp--preset--color--border);border-top-style:solid;border-top-width:1px;padding-top:var(--wp--preset--spacing--medium);padding-bottom:var(--wp--preset--spacing--medium)"><!-- wp:group {"className":"is-style-origin-canvas-icon-bubble","backgroundColor":"surface-muted","layout":{"type":"flex","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group is-style-origin-canvas-icon-bubble has-surface-muted-background-color has-background"><!-- wp:icon {"icon":"core/check","textColor":"primary","style":{"dimensions":{"width":"28px"}}} /--></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|small"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"fontSize":"medium"} -->
<h3 class="wp-block-heading has-medium-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Launch and handover', 'origin-canvas' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"text-body","fontSize":"regular"} -->
<p class="has-text-body-color has-text-color has-regular-font-size"><?php echo esc_html__( 'A calm launch, a written guide, and a site you can keep running yourself.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|medium"}}},"layout":{"type":"flex","justifyContent":"left"}} -->
<div class="wp-block-buttons is-content-justification-flex-start is-layout-flex" style="margin-top:var(--wp--preset--spacing--medium)"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button"><?php echo esc_html__( 'Talk to us', 'origin-canvas' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->
