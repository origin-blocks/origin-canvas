<?php
/**
 * Title: Contact Routes
 * Slug: origin-canvas/contact-routes
 * Description: A contact section with a panel of three routes, each with a link: email to start a project, book a call, or get help as a client; a form plugin's block can replace the contents of the group named Contact panel.
 * Categories: contact
 * Keywords: inquiry, hire, reach, mailto, support
 * Viewport Width: 1500
 * Block Types:
 * Post Types:
 * Inserter: true
 *
 * @package Origin
 */

?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"var:preset|spacing|colossal","bottom":"var:preset|spacing|colossal"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--colossal);padding-bottom:var(--wp--preset--spacing--colossal)"><!-- wp:columns {"verticalAlignment":"top","align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|huge","left":"var:preset|spacing|huge"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-top"><!-- wp:column {"verticalAlignment":"top","width":"41.67%"} -->
<div class="wp-block-column is-vertically-aligned-top" style="flex-basis:41.67%"><!-- wp:heading {"level":2,"className":"origin-canvas-text-balance","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"fontSize":"huge"} -->
<h2 class="wp-block-heading origin-canvas-text-balance has-huge-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Write to the studio', 'origin-canvas' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|compact","bottom":"0"}}},"textColor":"text-body","fontSize":"regular-plus"} -->
<p class="has-text-body-color has-text-color has-regular-plus-font-size" style="margin-top:var(--wp--preset--spacing--compact);margin-bottom:0"><?php echo esc_html__( 'Pick what you need, and we will take it from there.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|large","bottom":"0"}}},"textColor":"text-muted","fontSize":"small"} -->
<p class="has-text-muted-color has-text-color has-small-font-size" style="margin-top:var(--wp--preset--spacing--large);margin-bottom:0"><?php echo esc_html__( 'Rather talk? Call', 'origin-canvas' ); ?> <a href="tel:+16155550142"><?php echo esc_html__( '(615) 555-0142', 'origin-canvas' ); ?></a>, <?php echo esc_html__( 'Monday to Friday, 9am to 5:30pm Central.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"top","width":"58.33%"} -->
<div class="wp-block-column is-vertically-aligned-top" style="flex-basis:58.33%"><!-- wp:group {"metadata":{"name":"Contact panel"},"anchor":"write-to-the-studio","backgroundColor":"surface-muted","style":{"border":{"radius":"var:custom|radius|medium"},"spacing":{"padding":{"top":"var:preset|spacing|large","right":"var:preset|spacing|large","bottom":"var:preset|spacing|large","left":"var:preset|spacing|large"},"blockGap":"0"}},"layout":{"type":"default"}} -->
<div id="write-to-the-studio" class="wp-block-group has-surface-muted-background-color has-background" style="border-radius:var(--wp--custom--radius--medium);padding-top:var(--wp--preset--spacing--large);padding-right:var(--wp--preset--spacing--large);padding-bottom:var(--wp--preset--spacing--large);padding-left:var(--wp--preset--spacing--large)"><!-- wp:group {"style":{"spacing":{"padding":{"top":"0","bottom":"var:preset|spacing|medium"},"blockGap":{"top":"var:preset|spacing|small","left":"var:preset|spacing|large"}}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
<div class="wp-block-group" style="padding-top:0;padding-bottom:var(--wp--preset--spacing--medium)"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|extra-small"},"layout":{"selfStretch":"fixed","flexSize":"24rem"}},"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group"><!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"fontSize":"regular-plus"} -->
<h3 class="wp-block-heading has-regular-plus-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'New client', 'origin-canvas' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-muted","fontSize":"small"} -->
<p class="has-text-muted-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Tell us about your business and what it needs, from a site refresh to a whole new identity and site.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"className":"origin-canvas-no-shrink","style":{"typography":{"fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading","fontSize":"small"} -->
<p class="origin-canvas-no-shrink has-text-heading-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:0;font-weight:600"><a href="mailto:hello@example.com" style="text-decoration:none"><?php echo esc_html__( 'Email us', 'origin-canvas' ); ?> <span aria-hidden="true">&rarr;</span></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"border":{"top":{"color":"var:preset|color|border","style":"solid","width":"1px"}},"spacing":{"padding":{"top":"var:preset|spacing|medium","bottom":"var:preset|spacing|medium"},"blockGap":{"top":"var:preset|spacing|small","left":"var:preset|spacing|large"}}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
<div class="wp-block-group" style="border-top-color:var(--wp--preset--color--border);border-top-style:solid;border-top-width:1px;padding-top:var(--wp--preset--spacing--medium);padding-bottom:var(--wp--preset--spacing--medium)"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|extra-small"},"layout":{"selfStretch":"fixed","flexSize":"24rem"}},"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group"><!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"fontSize":"regular-plus"} -->
<h3 class="wp-block-heading has-regular-plus-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Book a 20-minute call', 'origin-canvas' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-muted","fontSize":"small"} -->
<p class="has-text-muted-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Pick a time that suits you. No need to prepare.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"className":"origin-canvas-no-shrink","style":{"typography":{"fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading","fontSize":"small"} -->
<p class="origin-canvas-no-shrink has-text-heading-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:0;font-weight:600"><a href="#" style="text-decoration:none"><?php echo esc_html__( 'Book a call', 'origin-canvas' ); ?> <span aria-hidden="true">&rarr;</span></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"border":{"top":{"color":"var:preset|color|border","style":"solid","width":"1px"}},"spacing":{"padding":{"top":"var:preset|spacing|medium","bottom":"0"},"blockGap":{"top":"var:preset|spacing|small","left":"var:preset|spacing|large"}}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
<div class="wp-block-group" style="border-top-color:var(--wp--preset--color--border);border-top-style:solid;border-top-width:1px;padding-top:var(--wp--preset--spacing--medium);padding-bottom:0"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|extra-small"},"layout":{"selfStretch":"fixed","flexSize":"24rem"}},"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group"><!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"fontSize":"regular-plus"} -->
<h3 class="wp-block-heading has-regular-plus-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Existing client', 'origin-canvas' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-muted","fontSize":"small"} -->
<p class="has-text-muted-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Already working with us? Get help with your site.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"className":"origin-canvas-no-shrink","style":{"typography":{"fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading","fontSize":"small"} -->
<p class="origin-canvas-no-shrink has-text-heading-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:0;font-weight:600"><a href="#" style="text-decoration:none"><?php echo esc_html__( 'Get help', 'origin-canvas' ); ?> <span aria-hidden="true">&rarr;</span></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->
