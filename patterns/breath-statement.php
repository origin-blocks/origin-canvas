<?php
/**
 * Title: Statement With Eyebrow
 * Slug: origin-canvas/breath-statement
 * Description: One large centered sentence under a short eyebrow, with no fill.
 * Categories: text
 * Keywords: editorial, manifesto, headline
 * Block Types: core/post-content
 * Viewport Width: 1500
 * Inserter: false
 *
 * @package Origin
 */

?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"var:preset|spacing|colossal","bottom":"var:preset|spacing|colossal"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--colossal);padding-bottom:var(--wp--preset--spacing--colossal)"><!-- wp:paragraph {"className":"origin-canvas-eyebrow","style":{"typography":{"textTransform":"uppercase","fontWeight":"600","letterSpacing":"0.06em","textAlign":"center"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|medium"}}},"textColor":"primary","fontSize":"extra-small"} -->
<p class="origin-canvas-eyebrow has-text-align-center has-primary-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--medium);font-weight:600;letter-spacing:0.06em;text-transform:uppercase"><?php echo esc_html__( 'What we do', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2,"align":"wide","className":"origin-canvas-text-balance","style":{"typography":{"fontWeight":"500","lineHeight":"1.15","textAlign":"center"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"fontSize":"display-xl"} -->
<h2 class="wp-block-heading has-text-align-center alignwide origin-canvas-text-balance has-display-xl-font-size" style="margin-top:0;margin-bottom:0;font-weight:500;line-height:1.15"><?php echo wp_kses_post( __( 'We work with founders who care how their work looks and reads.', 'origin-canvas' ) ); ?></h2>
<!-- /wp:heading --></section>
<!-- /wp:group -->
