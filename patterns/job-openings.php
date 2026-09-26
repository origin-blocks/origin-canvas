<?php
/**
 * Title: Job Openings
 * Slug: origin-canvas/job-openings
 * Description: A list of open roles, each with its location, type, and a link to apply. Built on the Work Index row, so the two share a right edge on one page.
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
<!-- wp:group {"tagName":"section","align":"full","style":{"border":{"top":{"color":"var:preset|color|border","width":"1px"}},"spacing":{"blockGap":"0","margin":{"top":"0","bottom":"0"},"padding":{"top":"var:preset|spacing|colossal","bottom":"var:preset|spacing|colossal"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" style="border-top-color:var(--wp--preset--color--border);border-top-width:1px;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--colossal);padding-bottom:var(--wp--preset--spacing--colossal)"><!-- wp:group {"align":"wide","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|huge"}}},"layout":{"type":"default"}} -->
<div class="wp-block-group alignwide" style="margin-bottom:var(--wp--preset--spacing--huge)"><!-- wp:heading {"level":2,"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"fontSize":"display"} -->
<h2 class="wp-block-heading has-display-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Open roles', 'origin-canvas' ); ?></h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:columns {"align":"wide","verticalAlignment":"center","style":{"border":{"top":{"color":"var:preset|color|border","width":"1px"}},"spacing":{"padding":{"top":"var:preset|spacing|large","bottom":"var:preset|spacing|large"},"blockGap":{"top":"var:preset|spacing|medium","left":"var:preset|spacing|large"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center" style="border-top-color:var(--wp--preset--color--border);border-top-width:1px;padding-top:var(--wp--preset--spacing--large);padding-bottom:var(--wp--preset--spacing--large)"><!-- wp:column {"verticalAlignment":"center","width":"40%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:40%"><!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading","fontSize":"large"} -->
<p class="has-text-heading-color has-text-color has-large-font-size" style="margin-top:0;margin-bottom:0;font-weight:600"><?php echo esc_html__( 'Web Developer', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"40%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:40%"><!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-body","fontSize":"small"} -->
<p class="has-text-body-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'London &middot; Full time', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"20%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:20%"><!-- wp:paragraph {"align":"right","className":"origin-canvas-links-plain","style":{"elements":{"link":{"color":{"text":"var:preset|color|text-muted"},":hover":{"color":{"text":"var:preset|color|primary"}}}},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-muted","fontSize":"small"} -->
<p class="origin-canvas-links-plain has-text-align-right has-text-muted-color has-text-color has-link-color has-small-font-size" style="margin-top:0;margin-bottom:0"><a href="#"><span aria-hidden="true"><?php echo esc_html__( 'Apply', 'origin-canvas' ); ?></span><span class="screen-reader-text"><?php
printf(
	/* translators: %s: the name of the job role, as shown in the row. */
	esc_html__( 'Apply for the %s role', 'origin-canvas' ),
	esc_html__( 'Web Developer', 'origin-canvas' )
);
?></span> <span aria-hidden="true">&rarr;</span></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:columns {"align":"wide","verticalAlignment":"center","style":{"border":{"top":{"color":"var:preset|color|border","width":"1px"}},"spacing":{"padding":{"top":"var:preset|spacing|large","bottom":"var:preset|spacing|large"},"blockGap":{"top":"var:preset|spacing|medium","left":"var:preset|spacing|large"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center" style="border-top-color:var(--wp--preset--color--border);border-top-width:1px;padding-top:var(--wp--preset--spacing--large);padding-bottom:var(--wp--preset--spacing--large)"><!-- wp:column {"verticalAlignment":"center","width":"40%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:40%"><!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading","fontSize":"large"} -->
<p class="has-text-heading-color has-text-color has-large-font-size" style="margin-top:0;margin-bottom:0;font-weight:600"><?php echo esc_html__( 'Junior Designer', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"40%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:40%"><!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-body","fontSize":"small"} -->
<p class="has-text-body-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Bristol &middot; Full time', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"20%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:20%"><!-- wp:paragraph {"align":"right","className":"origin-canvas-links-plain","style":{"elements":{"link":{"color":{"text":"var:preset|color|text-muted"},":hover":{"color":{"text":"var:preset|color|primary"}}}},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-muted","fontSize":"small"} -->
<p class="origin-canvas-links-plain has-text-align-right has-text-muted-color has-text-color has-link-color has-small-font-size" style="margin-top:0;margin-bottom:0"><a href="#"><span aria-hidden="true"><?php echo esc_html__( 'Apply', 'origin-canvas' ); ?></span><span class="screen-reader-text"><?php
printf(
	/* translators: %s: the name of the job role, as shown in the row. */
	esc_html__( 'Apply for the %s role', 'origin-canvas' ),
	esc_html__( 'Junior Designer', 'origin-canvas' )
);
?></span> <span aria-hidden="true">&rarr;</span></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:columns {"align":"wide","verticalAlignment":"center","style":{"border":{"top":{"color":"var:preset|color|border","width":"1px"},"bottom":{"color":"var:preset|color|border","width":"1px"}},"spacing":{"padding":{"top":"var:preset|spacing|large","bottom":"var:preset|spacing|large"},"blockGap":{"top":"var:preset|spacing|medium","left":"var:preset|spacing|large"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center" style="border-top-color:var(--wp--preset--color--border);border-top-width:1px;border-bottom-color:var(--wp--preset--color--border);border-bottom-width:1px;padding-top:var(--wp--preset--spacing--large);padding-bottom:var(--wp--preset--spacing--large)"><!-- wp:column {"verticalAlignment":"center","width":"40%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:40%"><!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading","fontSize":"large"} -->
<p class="has-text-heading-color has-text-color has-large-font-size" style="margin-top:0;margin-bottom:0;font-weight:600"><?php echo esc_html__( 'Studio Manager', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"40%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:40%"><!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-body","fontSize":"small"} -->
<p class="has-text-body-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Remote &middot; Part time', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"20%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:20%"><!-- wp:paragraph {"align":"right","className":"origin-canvas-links-plain","style":{"elements":{"link":{"color":{"text":"var:preset|color|text-muted"},":hover":{"color":{"text":"var:preset|color|primary"}}}},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-muted","fontSize":"small"} -->
<p class="origin-canvas-links-plain has-text-align-right has-text-muted-color has-text-color has-link-color has-small-font-size" style="margin-top:0;margin-bottom:0"><a href="#"><span aria-hidden="true"><?php echo esc_html__( 'Apply', 'origin-canvas' ); ?></span><span class="screen-reader-text"><?php
printf(
	/* translators: %s: the name of the job role, as shown in the row. */
	esc_html__( 'Apply for the %s role', 'origin-canvas' ),
	esc_html__( 'Studio Manager', 'origin-canvas' )
);
?></span> <span aria-hidden="true">&rarr;</span></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->
