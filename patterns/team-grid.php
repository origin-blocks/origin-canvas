<?php
/**
 * Title: Team Grid
 * Slug: origin-canvas/team-grid
 * Description: A three-up arrangement of colleagues with circular photos, roles and short bios.
 * Categories: team
 * Keywords: staff, people, members, about, headshots
 * Viewport Width: 1500
 * Block Types:
 * Post Types:
 * Inserter: true
 *
 * @package Origin
 */

?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"var:preset|spacing|colossal","bottom":"var:preset|spacing|colossal"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--colossal);padding-bottom:var(--wp--preset--spacing--colossal)"><!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|huge","left":"var:preset|spacing|extra-large"}}}} -->
<div class="wp-block-columns alignwide"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:image {"aspectRatio":"1","linkDestination":"none","align":"center","width":"128px","height":"128px","className":"is-style-origin-canvas-rounded-full","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|medium"}}}} -->
<figure class="wp-block-image aligncenter is-resized is-style-origin-canvas-rounded-full" style="margin-bottom:var(--wp--preset--spacing--medium)"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/patterns/images/card-team-1.webp" alt="<?php esc_attr_e( 'Hands reviewing blank paper at a light wooden studio desk.', 'origin-canvas' ); ?>" style="aspect-ratio:1;width:128px;height:128px"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"textAlign":"center","level":3,"style":{"typography":{"fontWeight":"700","letterSpacing":"-0.02em"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|extra-small"}}},"textColor":"text-heading","fontSize":"regular-plus"} -->
<h3 class="wp-block-heading has-text-align-center has-text-heading-color has-text-color has-regular-plus-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--extra-small);font-weight:700;letter-spacing:-0.02em"><?php echo esc_html__( 'Claire Bennett', 'origin-canvas' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|small"}}},"textColor":"text-body","fontSize":"regular"} -->
<p class="has-text-align-center has-text-body-color has-text-color has-regular-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--small)"><?php echo esc_html__( 'Founder', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|small"}}},"textColor":"text-body","fontSize":"small"} -->
<p class="has-text-align-center has-text-body-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--small)"><?php echo esc_html__( 'Twelve years in agencies before going small. Most days she&#8217;s in a discovery call or pushing back on a brief.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","className":"origin-canvas-links-plain","style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|text-heading"},":hover":{"color":{"text":"var:preset|color|primary"}}}}},"textColor":"text-muted","fontSize":"small"} -->
<p class="origin-canvas-links-plain has-text-align-center has-text-muted-color has-text-color has-link-color has-small-font-size" style="margin-top:0;margin-bottom:0"><a href="#"><?php echo esc_html__( 'LinkedIn', 'origin-canvas' ); ?></a> &middot; <a href="#"><?php echo esc_html__( 'Twitter', 'origin-canvas' ); ?></a> &middot; <a href="#"><?php echo esc_html__( 'Email', 'origin-canvas' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:image {"aspectRatio":"1","linkDestination":"none","align":"center","width":"128px","height":"128px","className":"is-style-origin-canvas-rounded-full","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|medium"}}}} -->
<figure class="wp-block-image aligncenter is-resized is-style-origin-canvas-rounded-full" style="margin-bottom:var(--wp--preset--spacing--medium)"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/patterns/images/avatar-marcus-reed.webp" alt="<?php esc_attr_e( 'Portrait of Marcus Reed.', 'origin-canvas' ); ?>" style="aspect-ratio:1;width:128px;height:128px"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"textAlign":"center","level":3,"style":{"typography":{"fontWeight":"700","letterSpacing":"-0.02em"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|extra-small"}}},"textColor":"text-heading","fontSize":"regular-plus"} -->
<h3 class="wp-block-heading has-text-align-center has-text-heading-color has-text-color has-regular-plus-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--extra-small);font-weight:700;letter-spacing:-0.02em"><?php echo esc_html__( 'Marcus Reed', 'origin-canvas' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|small"}}},"textColor":"text-body","fontSize":"regular"} -->
<p class="has-text-align-center has-text-body-color has-text-color has-regular-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--small)"><?php echo esc_html__( 'Design Lead', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|small"}}},"textColor":"text-body","fontSize":"small"} -->
<p class="has-text-align-center has-text-body-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--small)"><?php echo esc_html__( 'Draws the pages and keeps the type honest. Came from print and still sets everything twice.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","className":"origin-canvas-links-plain","style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|text-heading"},":hover":{"color":{"text":"var:preset|color|primary"}}}}},"textColor":"text-muted","fontSize":"small"} -->
<p class="origin-canvas-links-plain has-text-align-center has-text-muted-color has-text-color has-link-color has-small-font-size" style="margin-top:0;margin-bottom:0"><a href="#"><?php echo esc_html__( 'LinkedIn', 'origin-canvas' ); ?></a> &middot; <a href="#"><?php echo esc_html__( 'Twitter', 'origin-canvas' ); ?></a> &middot; <a href="#"><?php echo esc_html__( 'Email', 'origin-canvas' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:image {"aspectRatio":"1","linkDestination":"none","align":"center","width":"128px","height":"128px","className":"is-style-origin-canvas-rounded-full","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|medium"}}}} -->
<figure class="wp-block-image aligncenter is-resized is-style-origin-canvas-rounded-full" style="margin-bottom:var(--wp--preset--spacing--medium)"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/patterns/images/avatar-grace-whitfield.webp" alt="<?php esc_attr_e( 'Portrait of Grace Whitfield.', 'origin-canvas' ); ?>" style="aspect-ratio:1;width:128px;height:128px"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"textAlign":"center","level":3,"style":{"typography":{"fontWeight":"700","letterSpacing":"-0.02em"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|extra-small"}}},"textColor":"text-heading","fontSize":"regular-plus"} -->
<h3 class="wp-block-heading has-text-align-center has-text-heading-color has-text-color has-regular-plus-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--extra-small);font-weight:700;letter-spacing:-0.02em"><?php echo esc_html__( 'Grace Whitfield', 'origin-canvas' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|small"}}},"textColor":"text-body","fontSize":"regular"} -->
<p class="has-text-align-center has-text-body-color has-text-color has-regular-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--small)"><?php echo esc_html__( 'Producer', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|small"}}},"textColor":"text-body","fontSize":"small"} -->
<p class="has-text-align-center has-text-body-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--small)"><?php echo esc_html__( 'Keeps the schedule and the client conversation in one place, so nothing arrives as a surprise.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","className":"origin-canvas-links-plain","style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|text-heading"},":hover":{"color":{"text":"var:preset|color|primary"}}}}},"textColor":"text-muted","fontSize":"small"} -->
<p class="origin-canvas-links-plain has-text-align-center has-text-muted-color has-text-color has-link-color has-small-font-size" style="margin-top:0;margin-bottom:0"><a href="#"><?php echo esc_html__( 'LinkedIn', 'origin-canvas' ); ?></a> &middot; <a href="#"><?php echo esc_html__( 'Twitter', 'origin-canvas' ); ?></a> &middot; <a href="#"><?php echo esc_html__( 'Email', 'origin-canvas' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->
