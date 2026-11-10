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
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"var:preset|spacing|colossal","bottom":"var:preset|spacing|colossal"}}},"backgroundColor":"base-2","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-base-2-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--colossal);padding-bottom:var(--wp--preset--spacing--colossal)"><!-- wp:group {"align":"wide","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide" style="margin-top:0;margin-bottom:0"><!-- wp:heading {"align":"wide","style":{"typography":{"lineHeight":"1.1","textAlign":"center"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"contrast","fontSize":"display"} -->
<h2 class="wp-block-heading has-text-align-center alignwide has-contrast-color has-text-color has-display-font-size" style="margin-top:0;margin-bottom:0;line-height:1.1"><?php echo esc_html__( 'The team that sees it through', 'origin-canvas' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|small-medium","bottom":"0"}},"typography":{"textAlign":"center"}},"textColor":"contrast-2","fontSize":"regular-plus"} -->
<p class="has-text-align-center has-contrast-2-color has-text-color has-regular-plus-font-size" style="margin-top:var(--wp--preset--spacing--small-medium);margin-bottom:0"><?php echo esc_html__( 'Two founders, a strategist and a developer. Whoever you meet on the first call stays on your project until launch day.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:columns {"align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|huge"},"blockGap":{"top":"var:preset|spacing|huge","left":"var:preset|spacing|extra-large"}}}} -->
<div class="wp-block-columns alignwide" style="margin-top:var(--wp--preset--spacing--huge)"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:columns {"verticalAlignment":"top","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|large"}}}} -->
<div class="wp-block-columns are-vertically-aligned-top"><!-- wp:column {"verticalAlignment":"top","width":"128px"} -->
<div class="wp-block-column is-vertically-aligned-top" style="flex-basis:128px"><!-- wp:image {"width":"128px","height":"128px","aspectRatio":"1","linkDestination":"none","className":"is-style-origin-canvas-rounded-full"} -->
<figure class="wp-block-image is-resized is-style-origin-canvas-rounded-full"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/patterns/images/avatar-claire-bennett.webp" alt="<?php esc_attr_e( 'Portrait of Claire Bennett, Co-founder.', 'origin-canvas' ); ?>" style="aspect-ratio:1;width:128px;height:128px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"top"} -->
<div class="wp-block-column is-vertically-aligned-top"><!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|extra-small"}}},"textColor":"contrast","fontSize":"regular-plus"} -->
<h3 class="wp-block-heading has-contrast-color has-text-color has-regular-plus-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--extra-small)"><?php echo esc_html__( 'Claire Bennett', 'origin-canvas' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"fontWeight":"500"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|small"}}},"textColor":"contrast-3","fontSize":"small"} -->
<p class="has-contrast-3-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--small);font-weight:500"><?php echo esc_html__( 'Co-founder', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|small"}}},"textColor":"contrast-2","fontSize":"small"} -->
<p class="has-contrast-2-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--small)"><?php echo esc_html__( 'Twelve years in agencies before going small. She writes about type, color, and the craft of making sites that look designed rather than assembled.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"origin-canvas-links-plain","style":{"typography":{"fontWeight":"500"},"spacing":{"margin":{"top":"0","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|contrast"},":hover":{"color":{"text":"var:preset|color|primary"}}}}},"textColor":"contrast-3","fontSize":"small"} -->
<p class="origin-canvas-links-plain has-contrast-3-color has-text-color has-link-color has-small-font-size" style="margin-top:0;margin-bottom:0;font-weight:500"><a href="#"><?php echo esc_html__( 'LinkedIn', 'origin-canvas' ); ?></a> · <a href="#"><?php echo esc_html__( 'Twitter', 'origin-canvas' ); ?></a> · <a href="#"><?php echo esc_html__( 'Email', 'origin-canvas' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:columns {"verticalAlignment":"top","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|large"}}}} -->
<div class="wp-block-columns are-vertically-aligned-top"><!-- wp:column {"verticalAlignment":"top","width":"128px"} -->
<div class="wp-block-column is-vertically-aligned-top" style="flex-basis:128px"><!-- wp:image {"width":"128px","height":"128px","aspectRatio":"1","linkDestination":"none","className":"is-style-origin-canvas-rounded-full"} -->
<figure class="wp-block-image is-resized is-style-origin-canvas-rounded-full"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/patterns/images/avatar-marcus-holloway.webp" alt="<?php esc_attr_e( 'Portrait of Marcus Holloway.', 'origin-canvas' ); ?>" style="aspect-ratio:1;width:128px;height:128px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"top"} -->
<div class="wp-block-column is-vertically-aligned-top"><!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|extra-small"}}},"textColor":"contrast","fontSize":"regular-plus"} -->
<h3 class="wp-block-heading has-contrast-color has-text-color has-regular-plus-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--extra-small)"><?php echo esc_html__( 'Marcus Holloway', 'origin-canvas' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"fontWeight":"500"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|small"}}},"textColor":"contrast-3","fontSize":"small"} -->
<p class="has-contrast-3-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--small);font-weight:500"><?php echo esc_html__( 'Co-founder and Designer', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|small"}}},"textColor":"contrast-2","fontSize":"small"} -->
<p class="has-contrast-2-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--small)"><?php echo esc_html__( 'Started the studio with Claire after ten years in print. Still checks every page twice before it goes out.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"origin-canvas-links-plain","style":{"typography":{"fontWeight":"500"},"spacing":{"margin":{"top":"0","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|contrast"},":hover":{"color":{"text":"var:preset|color|primary"}}}}},"textColor":"contrast-3","fontSize":"small"} -->
<p class="origin-canvas-links-plain has-contrast-3-color has-text-color has-link-color has-small-font-size" style="margin-top:0;margin-bottom:0;font-weight:500"><a href="#"><?php echo esc_html__( 'LinkedIn', 'origin-canvas' ); ?></a> · <a href="#"><?php echo esc_html__( 'Twitter', 'origin-canvas' ); ?></a> · <a href="#"><?php echo esc_html__( 'Email', 'origin-canvas' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|huge","left":"var:preset|spacing|extra-large"},"margin":{"top":"var:preset|spacing|huge"}}}} -->
<div class="wp-block-columns alignwide" style="margin-top:var(--wp--preset--spacing--huge)"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:columns {"verticalAlignment":"top","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|large"}}}} -->
<div class="wp-block-columns are-vertically-aligned-top"><!-- wp:column {"verticalAlignment":"top","width":"128px"} -->
<div class="wp-block-column is-vertically-aligned-top" style="flex-basis:128px"><!-- wp:image {"width":"128px","height":"128px","aspectRatio":"1","linkDestination":"none","className":"is-style-origin-canvas-rounded-full"} -->
<figure class="wp-block-image is-resized is-style-origin-canvas-rounded-full"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/patterns/images/avatar-hannah-wright.webp" alt="<?php esc_attr_e( 'Portrait of Hannah Wright.', 'origin-canvas' ); ?>" style="aspect-ratio:1;width:128px;height:128px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"top"} -->
<div class="wp-block-column is-vertically-aligned-top"><!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|extra-small"}}},"textColor":"contrast","fontSize":"regular-plus"} -->
<h3 class="wp-block-heading has-contrast-color has-text-color has-regular-plus-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--extra-small)"><?php echo esc_html__( 'Hannah Wright', 'origin-canvas' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"fontWeight":"500"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|small"}}},"textColor":"contrast-3","fontSize":"small"} -->
<p class="has-contrast-3-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--small);font-weight:500"><?php echo esc_html__( 'Brand Strategist', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|small"}}},"textColor":"contrast-2","fontSize":"small"} -->
<p class="has-contrast-2-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--small)"><?php echo esc_html__( 'Works out what a business is actually saying before anyone draws a page. Runs the first week of every project.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"origin-canvas-links-plain","style":{"typography":{"fontWeight":"500"},"spacing":{"margin":{"top":"0","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|contrast"},":hover":{"color":{"text":"var:preset|color|primary"}}}}},"textColor":"contrast-3","fontSize":"small"} -->
<p class="origin-canvas-links-plain has-contrast-3-color has-text-color has-link-color has-small-font-size" style="margin-top:0;margin-bottom:0;font-weight:500"><a href="#"><?php echo esc_html__( 'LinkedIn', 'origin-canvas' ); ?></a> · <a href="#"><?php echo esc_html__( 'Twitter', 'origin-canvas' ); ?></a> · <a href="#"><?php echo esc_html__( 'Email', 'origin-canvas' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:columns {"verticalAlignment":"top","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|large"}}}} -->
<div class="wp-block-columns are-vertically-aligned-top"><!-- wp:column {"verticalAlignment":"top","width":"128px"} -->
<div class="wp-block-column is-vertically-aligned-top" style="flex-basis:128px"><!-- wp:image {"width":"128px","height":"128px","aspectRatio":"1","linkDestination":"none","className":"is-style-origin-canvas-rounded-full"} -->
<figure class="wp-block-image is-resized is-style-origin-canvas-rounded-full"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/patterns/images/avatar-ben-carter.webp" alt="<?php esc_attr_e( 'Portrait of Ben Carter.', 'origin-canvas' ); ?>" style="aspect-ratio:1;width:128px;height:128px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"top"} -->
<div class="wp-block-column is-vertically-aligned-top"><!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|extra-small"}}},"textColor":"contrast","fontSize":"regular-plus"} -->
<h3 class="wp-block-heading has-contrast-color has-text-color has-regular-plus-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--extra-small)"><?php echo esc_html__( 'Ben Carter', 'origin-canvas' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"fontWeight":"500"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|small"}}},"textColor":"contrast-3","fontSize":"small"} -->
<p class="has-contrast-3-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--small);font-weight:500"><?php echo esc_html__( 'Developer', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|small"}}},"textColor":"contrast-2","fontSize":"small"} -->
<p class="has-contrast-2-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--small)"><?php echo esc_html__( 'Builds every site and runs the launch. Tests it all on the oldest phone in the office.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"origin-canvas-links-plain","style":{"typography":{"fontWeight":"500"},"spacing":{"margin":{"top":"0","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|contrast"},":hover":{"color":{"text":"var:preset|color|primary"}}}}},"textColor":"contrast-3","fontSize":"small"} -->
<p class="origin-canvas-links-plain has-contrast-3-color has-text-color has-link-color has-small-font-size" style="margin-top:0;margin-bottom:0;font-weight:500"><a href="#"><?php echo esc_html__( 'LinkedIn', 'origin-canvas' ); ?></a> · <a href="#"><?php echo esc_html__( 'Twitter', 'origin-canvas' ); ?></a> · <a href="#"><?php echo esc_html__( 'Email', 'origin-canvas' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->
