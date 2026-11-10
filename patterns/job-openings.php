<?php
/**
 * Title: Job Openings
 * Slug: origin-canvas/job-openings
 * Description: A heading over a list of open roles in ruled lines, each with what it does, the location, the type and a link to apply, with a line on how to apply and a link for open applications.
 * Categories: text
 * Keywords: careers, hiring, recruitment, positions, staff
 * Viewport Width: 1500
 * Block Types:
 * Post Types:
 * Inserter: true
 *
 * @package Origin
 */

/*
 * Three links reading "Apply" are indistinguishable out of context, so each
 * anchor hides its visible label from assistive technology and gives the whole
 * accessible name, with the role in it, in a screen-reader span. The role is
 * therefore written twice per row: change one and change the other.
 */

?>
<!-- wp:group {"tagName":"section","align":"full","style":{"border":{"top":{"color":"var:preset|color|base-5","width":"1px"}},"spacing":{"blockGap":"0","margin":{"top":"0","bottom":"0"},"padding":{"top":"var:preset|spacing|colossal","bottom":"var:preset|spacing|colossal"}}},"backgroundColor":"base-2","layout":{"type":"constrained"},"anchor":"open-roles"} -->
<section class="wp-block-group alignfull has-base-2-background-color has-background" id="open-roles" style="border-top-color:var(--wp--preset--color--base-5);border-top-width:1px;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--colossal);padding-bottom:var(--wp--preset--spacing--colossal)"><!-- wp:group {"align":"wide","className":"origin-canvas-align-baseline","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|small-medium"},"blockGap":{"top":"var:preset|spacing|small","left":"var:preset|spacing|extra-large"}}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
<div class="wp-block-group alignwide origin-canvas-align-baseline" style="margin-bottom:var(--wp--preset--spacing--small-medium)"><!-- wp:heading {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"fontSize":"huge"} -->
<h2 class="wp-block-heading has-huge-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Open roles', 'origin-canvas' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"origin-canvas-no-shrink","style":{"typography":{"fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"contrast","fontSize":"small"} -->
<p class="origin-canvas-no-shrink has-contrast-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:0;font-weight:600"><a href="#open-application" style="text-decoration:none"><?php echo esc_html__( 'No role that fits? Write to us', 'origin-canvas' ); ?> <span aria-hidden="true">→</span></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|huge"}}},"layout":{"type":"constrained","justifyContent":"left"}} -->
<div class="wp-block-group alignwide" style="margin-bottom:var(--wp--preset--spacing--huge)"><!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"contrast-2","fontSize":"regular-plus"} -->
<p class="has-contrast-2-color has-text-color has-regular-plus-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'To apply, send a short note, a link to your work and the role you mean, through the contact page. We reply within two business days.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"border":{"top":{"color":"var:preset|color|base-5","width":"1px"}},"spacing":{"padding":{"top":"var:preset|spacing|large","bottom":"var:preset|spacing|large"},"blockGap":{"top":"var:preset|spacing|medium","left":"var:preset|spacing|large"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center" style="border-top-color:var(--wp--preset--color--base-5);border-top-width:1px;padding-top:var(--wp--preset--spacing--large);padding-bottom:var(--wp--preset--spacing--large)"><!-- wp:column {"verticalAlignment":"center","width":"40%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:40%"><!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"contrast","fontSize":"large"} -->
<p class="has-contrast-color has-text-color has-large-font-size" style="margin-top:0;margin-bottom:0;font-weight:600"><?php echo esc_html__( 'Web Developer', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|extra-small","bottom":"0"}}},"textColor":"contrast-2","fontSize":"regular"} -->
<p class="has-contrast-2-color has-text-color has-regular-font-size" style="margin-top:var(--wp--preset--spacing--extra-small);margin-bottom:0"><?php echo esc_html__( 'Build and launch client sites with Ben, our developer, and keep them fast after launch.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"40%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:40%"><!-- wp:paragraph {"style":{"typography":{"fontWeight":"500"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"contrast-2","fontSize":"small"} -->
<p class="has-contrast-2-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:0;font-weight:500"><?php echo esc_html__( 'Nashville &middot; Full time', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"20%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:20%"><!-- wp:paragraph {"className":"origin-canvas-links-plain","style":{"typography":{"fontWeight":"600","textAlign":"right"},"elements":{"link":{"color":{"text":"var:preset|color|contrast"},":hover":{"color":{"text":"var:preset|color|primary"}}}},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"contrast","fontSize":"small"} -->
<p class="has-text-align-right origin-canvas-links-plain has-contrast-color has-text-color has-link-color has-small-font-size" style="margin-top:0;margin-bottom:0;font-weight:600"><a href="#"><span aria-hidden="true"><?php echo esc_html__( 'Apply', 'origin-canvas' ); ?></span><span class="screen-reader-text"><?php
printf(
	/* translators: %s: the name of the job role, as shown in the row. */
	esc_html__( 'Apply for the %s role', 'origin-canvas' ),
	esc_html__( 'Web Developer', 'origin-canvas' )
);
?></span> <span aria-hidden="true">→</span></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"border":{"top":{"color":"var:preset|color|base-5","width":"1px"}},"spacing":{"padding":{"top":"var:preset|spacing|large","bottom":"var:preset|spacing|large"},"blockGap":{"top":"var:preset|spacing|medium","left":"var:preset|spacing|large"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center" style="border-top-color:var(--wp--preset--color--base-5);border-top-width:1px;padding-top:var(--wp--preset--spacing--large);padding-bottom:var(--wp--preset--spacing--large)"><!-- wp:column {"verticalAlignment":"center","width":"40%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:40%"><!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"contrast","fontSize":"large"} -->
<p class="has-contrast-color has-text-color has-large-font-size" style="margin-top:0;margin-bottom:0;font-weight:600"><?php echo esc_html__( 'Junior Designer', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|extra-small","bottom":"0"}}},"textColor":"contrast-2","fontSize":"regular"} -->
<p class="has-contrast-2-color has-text-color has-regular-font-size" style="margin-top:var(--wp--preset--spacing--extra-small);margin-bottom:0"><?php echo esc_html__( 'Work with Marcus, our designer, from the first sketch to the last check, on identities and sites.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"40%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:40%"><!-- wp:paragraph {"style":{"typography":{"fontWeight":"500"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"contrast-2","fontSize":"small"} -->
<p class="has-contrast-2-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:0;font-weight:500"><?php echo esc_html__( 'Remote &middot; Full time', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"20%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:20%"><!-- wp:paragraph {"className":"origin-canvas-links-plain","style":{"typography":{"fontWeight":"600","textAlign":"right"},"elements":{"link":{"color":{"text":"var:preset|color|contrast"},":hover":{"color":{"text":"var:preset|color|primary"}}}},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"contrast","fontSize":"small"} -->
<p class="has-text-align-right origin-canvas-links-plain has-contrast-color has-text-color has-link-color has-small-font-size" style="margin-top:0;margin-bottom:0;font-weight:600"><a href="#"><span aria-hidden="true"><?php echo esc_html__( 'Apply', 'origin-canvas' ); ?></span><span class="screen-reader-text"><?php
printf(
	/* translators: %s: the name of the job role, as shown in the row. */
	esc_html__( 'Apply for the %s role', 'origin-canvas' ),
	esc_html__( 'Junior Designer', 'origin-canvas' )
);
?></span> <span aria-hidden="true">→</span></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"border":{"top":{"color":"var:preset|color|base-5","width":"1px"},"bottom":{"color":"var:preset|color|base-5","width":"1px"}},"spacing":{"padding":{"top":"var:preset|spacing|large","bottom":"var:preset|spacing|large"},"blockGap":{"top":"var:preset|spacing|medium","left":"var:preset|spacing|large"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center" style="border-top-color:var(--wp--preset--color--base-5);border-top-width:1px;border-bottom-color:var(--wp--preset--color--base-5);border-bottom-width:1px;padding-top:var(--wp--preset--spacing--large);padding-bottom:var(--wp--preset--spacing--large)"><!-- wp:column {"verticalAlignment":"center","width":"40%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:40%"><!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"contrast","fontSize":"large"} -->
<p class="has-contrast-color has-text-color has-large-font-size" style="margin-top:0;margin-bottom:0;font-weight:600"><?php echo esc_html__( 'Studio Manager', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|extra-small","bottom":"0"}}},"textColor":"contrast-2","fontSize":"regular"} -->
<p class="has-contrast-2-color has-text-color has-regular-font-size" style="margin-top:var(--wp--preset--spacing--extra-small);margin-bottom:0"><?php echo esc_html__( 'Keep the schedule, the scopes and the invoices in order across every project.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"40%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:40%"><!-- wp:paragraph {"style":{"typography":{"fontWeight":"500"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"contrast-2","fontSize":"small"} -->
<p class="has-contrast-2-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:0;font-weight:500"><?php echo esc_html__( 'Remote &middot; Part time', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"20%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:20%"><!-- wp:paragraph {"className":"origin-canvas-links-plain","style":{"typography":{"fontWeight":"600","textAlign":"right"},"elements":{"link":{"color":{"text":"var:preset|color|contrast"},":hover":{"color":{"text":"var:preset|color|primary"}}}},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"contrast","fontSize":"small"} -->
<p class="has-text-align-right origin-canvas-links-plain has-contrast-color has-text-color has-link-color has-small-font-size" style="margin-top:0;margin-bottom:0;font-weight:600"><a href="#"><span aria-hidden="true"><?php echo esc_html__( 'Apply', 'origin-canvas' ); ?></span><span class="screen-reader-text"><?php
printf(
	/* translators: %s: the name of the job role, as shown in the row. */
	esc_html__( 'Apply for the %s role', 'origin-canvas' ),
	esc_html__( 'Studio Manager', 'origin-canvas' )
);
?></span> <span aria-hidden="true">→</span></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->
