<?php
/**
 * Title: Team Grid
 * Slug: origin-canvas/team-grid
 * Description: A two-by-two arrangement of colleagues with circular photos, roles and short bios.
 * Categories: team
 * Keywords: staff, people, members, about page, headshots
 * Viewport Width: 1500
 * Block Types:
 * Post Types:
 * Inserter: true
 *
 * @package Origin
 */

?>
<!-- wp:group {"tagName":"section","align":"full","backgroundColor":"surface-muted","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"var:preset|spacing|colossal","bottom":"var:preset|spacing|colossal"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-surface-muted-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--colossal);padding-bottom:var(--wp--preset--spacing--colossal)"><!-- wp:group {"align":"wide","style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|huge"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--huge)"><!-- wp:heading {"level":2,"align":"wide","style":{"typography":{"lineHeight":"1.1","textAlign":"center"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading","fontSize":"display"} -->
<h2 class="wp-block-heading has-text-align-center alignwide has-text-heading-color has-text-color has-display-font-size" style="margin-top:0;margin-bottom:0;line-height:1.1"><?php echo esc_html__( 'The people you&#8217;ll work with', 'origin-canvas' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|compact","bottom":"0"}},"typography":{"textAlign":"center"}},"textColor":"text-body","fontSize":"regular-plus"} -->
<p class="has-text-align-center has-text-body-color has-text-color has-regular-plus-font-size" style="margin-top:var(--wp--preset--spacing--compact);margin-bottom:0"><?php echo esc_html__( 'Two founders, a strategist and a developer. Whoever you meet on the first call stays on your project until launch day.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|huge","left":"var:preset|spacing|extra-large"}}}} -->
<div class="wp-block-columns alignwide"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:columns {"verticalAlignment":"top","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|large"}}}} -->
<div class="wp-block-columns are-vertically-aligned-top"><!-- wp:column {"verticalAlignment":"top","width":"128px"} -->
<div class="wp-block-column is-vertically-aligned-top" style="flex-basis:128px"><!-- wp:image {"aspectRatio":"1","linkDestination":"none","width":"128px","height":"128px","className":"is-style-origin-canvas-rounded-full"} -->
<figure class="wp-block-image is-resized is-style-origin-canvas-rounded-full"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/patterns/images/avatar-claire-bennett.webp" alt="<?php esc_attr_e( 'Portrait of Claire Bennett, Co-founder.', 'origin-canvas' ); ?>" style="aspect-ratio:1;width:128px;height:128px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"top"} -->
<div class="wp-block-column is-vertically-aligned-top"><!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|extra-small"}}},"textColor":"text-heading","fontSize":"regular-plus"} -->
<h3 class="wp-block-heading has-text-heading-color has-text-color has-regular-plus-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--extra-small)"><?php echo esc_html__( 'Claire Bennett', 'origin-canvas' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"fontWeight":"500"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|small"}}},"textColor":"text-muted","fontSize":"small"} -->
<p class="has-text-muted-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--small);font-weight:500"><?php echo esc_html__( 'Co-founder', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|small"}}},"textColor":"text-body","fontSize":"small"} -->
<p class="has-text-body-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--small)"><?php echo esc_html__( 'Twelve years in agencies before going small. Most days she&#8217;s in a discovery call or pushing back on a brief.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"origin-canvas-links-plain","style":{"typography":{"fontWeight":"500"},"spacing":{"margin":{"top":"0","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|text-heading"},":hover":{"color":{"text":"var:preset|color|primary"}}}}},"textColor":"text-muted","fontSize":"small"} -->
<p class="origin-canvas-links-plain has-text-muted-color has-text-color has-link-color has-small-font-size" style="margin-top:0;margin-bottom:0;font-weight:500"><a href="#"><?php echo esc_html__( 'LinkedIn', 'origin-canvas' ); ?></a> &middot; <a href="#"><?php echo esc_html__( 'Twitter', 'origin-canvas' ); ?></a> &middot; <a href="#"><?php echo esc_html__( 'Email', 'origin-canvas' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:columns {"verticalAlignment":"top","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|large"}}}} -->
<div class="wp-block-columns are-vertically-aligned-top"><!-- wp:column {"verticalAlignment":"top","width":"128px"} -->
<div class="wp-block-column is-vertically-aligned-top" style="flex-basis:128px"><!-- wp:image {"aspectRatio":"1","linkDestination":"none","width":"128px","height":"128px","className":"is-style-origin-canvas-rounded-full"} -->
<figure class="wp-block-image is-resized is-style-origin-canvas-rounded-full"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/patterns/images/avatar-marcus-holloway.webp" alt="<?php esc_attr_e( 'Portrait of Marcus Holloway.', 'origin-canvas' ); ?>" style="aspect-ratio:1;width:128px;height:128px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"top"} -->
<div class="wp-block-column is-vertically-aligned-top"><!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|extra-small"}}},"textColor":"text-heading","fontSize":"regular-plus"} -->
<h3 class="wp-block-heading has-text-heading-color has-text-color has-regular-plus-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--extra-small)"><?php echo esc_html__( 'Marcus Holloway', 'origin-canvas' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"fontWeight":"500"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|small"}}},"textColor":"text-muted","fontSize":"small"} -->
<p class="has-text-muted-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--small);font-weight:500"><?php echo esc_html__( 'Co-founder and Designer', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|small"}}},"textColor":"text-body","fontSize":"small"} -->
<p class="has-text-body-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--small)"><?php echo esc_html__( 'Started the studio with Claire after ten years in print. Still checks every page twice before it goes out.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"origin-canvas-links-plain","style":{"typography":{"fontWeight":"500"},"spacing":{"margin":{"top":"0","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|text-heading"},":hover":{"color":{"text":"var:preset|color|primary"}}}}},"textColor":"text-muted","fontSize":"small"} -->
<p class="origin-canvas-links-plain has-text-muted-color has-text-color has-link-color has-small-font-size" style="margin-top:0;margin-bottom:0;font-weight:500"><a href="#"><?php echo esc_html__( 'LinkedIn', 'origin-canvas' ); ?></a> &middot; <a href="#"><?php echo esc_html__( 'Twitter', 'origin-canvas' ); ?></a> &middot; <a href="#"><?php echo esc_html__( 'Email', 'origin-canvas' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|huge","left":"var:preset|spacing|extra-large"},"margin":{"top":"var:preset|spacing|huge"}}}} -->
<div class="wp-block-columns alignwide" style="margin-top:var(--wp--preset--spacing--huge)"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:columns {"verticalAlignment":"top","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|large"}}}} -->
<div class="wp-block-columns are-vertically-aligned-top"><!-- wp:column {"verticalAlignment":"top","width":"128px"} -->
<div class="wp-block-column is-vertically-aligned-top" style="flex-basis:128px"><!-- wp:image {"aspectRatio":"1","linkDestination":"none","width":"128px","height":"128px","className":"is-style-origin-canvas-rounded-full"} -->
<figure class="wp-block-image is-resized is-style-origin-canvas-rounded-full"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/patterns/images/avatar-hannah-wright.webp" alt="<?php esc_attr_e( 'Portrait of Hannah Wright.', 'origin-canvas' ); ?>" style="aspect-ratio:1;width:128px;height:128px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"top"} -->
<div class="wp-block-column is-vertically-aligned-top"><!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|extra-small"}}},"textColor":"text-heading","fontSize":"regular-plus"} -->
<h3 class="wp-block-heading has-text-heading-color has-text-color has-regular-plus-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--extra-small)"><?php echo esc_html__( 'Hannah Wright', 'origin-canvas' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"fontWeight":"500"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|small"}}},"textColor":"text-muted","fontSize":"small"} -->
<p class="has-text-muted-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--small);font-weight:500"><?php echo esc_html__( 'Brand Strategist', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|small"}}},"textColor":"text-body","fontSize":"small"} -->
<p class="has-text-body-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--small)"><?php echo esc_html__( 'Works out what a business is actually saying before anyone draws a page. Runs the first week of every project.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"origin-canvas-links-plain","style":{"typography":{"fontWeight":"500"},"spacing":{"margin":{"top":"0","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|text-heading"},":hover":{"color":{"text":"var:preset|color|primary"}}}}},"textColor":"text-muted","fontSize":"small"} -->
<p class="origin-canvas-links-plain has-text-muted-color has-text-color has-link-color has-small-font-size" style="margin-top:0;margin-bottom:0;font-weight:500"><a href="#"><?php echo esc_html__( 'LinkedIn', 'origin-canvas' ); ?></a> &middot; <a href="#"><?php echo esc_html__( 'Twitter', 'origin-canvas' ); ?></a> &middot; <a href="#"><?php echo esc_html__( 'Email', 'origin-canvas' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:columns {"verticalAlignment":"top","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|large"}}}} -->
<div class="wp-block-columns are-vertically-aligned-top"><!-- wp:column {"verticalAlignment":"top","width":"128px"} -->
<div class="wp-block-column is-vertically-aligned-top" style="flex-basis:128px"><!-- wp:image {"aspectRatio":"1","linkDestination":"none","width":"128px","height":"128px","className":"is-style-origin-canvas-rounded-full"} -->
<figure class="wp-block-image is-resized is-style-origin-canvas-rounded-full"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/patterns/images/avatar-ben-carter.webp" alt="<?php esc_attr_e( 'Portrait of Ben Carter.', 'origin-canvas' ); ?>" style="aspect-ratio:1;width:128px;height:128px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"top"} -->
<div class="wp-block-column is-vertically-aligned-top"><!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|extra-small"}}},"textColor":"text-heading","fontSize":"regular-plus"} -->
<h3 class="wp-block-heading has-text-heading-color has-text-color has-regular-plus-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--extra-small)"><?php echo esc_html__( 'Ben Carter', 'origin-canvas' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"fontWeight":"500"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|small"}}},"textColor":"text-muted","fontSize":"small"} -->
<p class="has-text-muted-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--small);font-weight:500"><?php echo esc_html__( 'Developer', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|small"}}},"textColor":"text-body","fontSize":"small"} -->
<p class="has-text-body-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--small)"><?php echo esc_html__( 'Builds every site and runs the launch. Tests it all on the oldest phone in the office.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"origin-canvas-links-plain","style":{"typography":{"fontWeight":"500"},"spacing":{"margin":{"top":"0","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|text-heading"},":hover":{"color":{"text":"var:preset|color|primary"}}}}},"textColor":"text-muted","fontSize":"small"} -->
<p class="origin-canvas-links-plain has-text-muted-color has-text-color has-link-color has-small-font-size" style="margin-top:0;margin-bottom:0;font-weight:500"><a href="#"><?php echo esc_html__( 'LinkedIn', 'origin-canvas' ); ?></a> &middot; <a href="#"><?php echo esc_html__( 'Twitter', 'origin-canvas' ); ?></a> &middot; <a href="#"><?php echo esc_html__( 'Email', 'origin-canvas' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->
