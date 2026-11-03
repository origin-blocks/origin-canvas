<?php
/**
 * Title: CTA Hiring Card Tinted
 * Slug: origin-canvas/cta-hiring-card
 * Description: A tinted rounded closing section for open applications: a centered heading, a short lead on what to send and one button.
 * Categories: call-to-action
 * Keywords: careers, jobs, recruit, join, write in
 * Viewport Width: 1500
 * Block Types:
 * Post Types:
 * Inserter: true
 *
 * @package Origin
 */

?>
<!-- wp:group {"tagName":"section","align":"full","anchor":"open-application","style":{"spacing":{"padding":{"top":"var:preset|spacing|colossal","bottom":"var:preset|spacing|colossal"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" id="open-application" style="padding-top:var(--wp--preset--spacing--colossal);padding-bottom:var(--wp--preset--spacing--colossal)"><!-- wp:group {"backgroundColor":"base-2","style":{"border":{"radius":"var:custom|radius|medium"},"spacing":{"padding":{"top":"var:preset|spacing|jumbo","right":"var:preset|spacing|jumbo","bottom":"var:preset|spacing|jumbo","left":"var:preset|spacing|jumbo"},"blockGap":"var:preset|spacing|large"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-base-2-background-color has-background" style="border-radius:var(--wp--custom--radius--medium);padding-top:var(--wp--preset--spacing--jumbo);padding-right:var(--wp--preset--spacing--jumbo);padding-bottom:var(--wp--preset--spacing--jumbo);padding-left:var(--wp--preset--spacing--jumbo)"><!-- wp:heading {"level":2,"style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"typography":{"textAlign":"center"}},"fontSize":"huge"} -->
<h2 class="wp-block-heading has-huge-font-size has-text-align-center" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'No role that fits? Write to us anyway.', 'origin-canvas' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"textAlign":"center"}},"textColor":"contrast-2","fontSize":"regular-plus"} -->
<p class="has-text-align-center has-contrast-2-color has-text-color has-regular-plus-font-size"><?php echo esc_html__( 'Tell us what you do, link to your work and say what you would like to work on. We read every email and reply within two business days.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|medium"}}},"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--medium)"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#"><?php echo esc_html__( 'Write to the studio', 'origin-canvas' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
