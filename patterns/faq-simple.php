<?php
/**
 * Title: FAQ Simple
 * Slug: origin-canvas/faq-simple
 * Description: A stacked list of questions that expand to reveal their answers.
 * Categories: origin-canvas/faq
 * Keywords: accordion, disclosure, support, help, toggle
 * Block Types:
 * Post Types:
 * Inserter: true
 *
 * @package Origin
 */

?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"var:preset|spacing|colossal","bottom":"var:preset|spacing|colossal"},"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--colossal);padding-bottom:var(--wp--preset--spacing--colossal)"><!-- wp:heading {"level":2,"style":{"typography":{"fontWeight":"700","letterSpacing":"-0.02em","lineHeight":"1.1"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|extra-large"}}},"textColor":"text-heading","fontSize":"huge"} -->
<h2 class="wp-block-heading has-text-heading-color has-text-color has-huge-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--extra-large);font-weight:700;letter-spacing:-0.02em;line-height:1.1"><?php echo esc_html__( 'Questions we get asked', 'origin-canvas' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:details {"summary":"<?php echo esc_attr__( 'How long does a project take?', 'origin-canvas' ); ?>"} -->
<details class="wp-block-details"><summary><?php echo esc_html__( 'How long does a project take?', 'origin-canvas' ); ?></summary><!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-body","fontSize":"regular-plus"} -->
<p class="has-text-body-color has-text-color has-regular-plus-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Four weeks from kickoff to launch on most projects, and longer if we are writing the copy with you.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></details>
<!-- /wp:details -->

<!-- wp:details {"summary":"<?php echo esc_attr__( 'What do you need from us to start?', 'origin-canvas' ); ?>"} -->
<details class="wp-block-details"><summary><?php echo esc_html__( 'What do you need from us to start?', 'origin-canvas' ); ?></summary><!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-body","fontSize":"regular-plus"} -->
<p class="has-text-body-color has-text-color has-regular-plus-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'A conversation, whatever brand material already exists, and one person who can approve work. Copy can come later &#8212; we will tell you what we need and when.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></details>
<!-- /wp:details -->

<!-- wp:details {"summary":"<?php echo esc_attr__( 'Do you work with our developer?', 'origin-canvas' ); ?>"} -->
<details class="wp-block-details"><summary><?php echo esc_html__( 'Do you work with our developer?', 'origin-canvas' ); ?></summary><!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-body","fontSize":"regular-plus"} -->
<p class="has-text-body-color has-text-color has-regular-plus-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Often. We hand over structured files and stay available through the build, and we will say early if something in the design is going to be expensive to make.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></details>
<!-- /wp:details -->

<!-- wp:details {"summary":"<?php echo esc_attr__( 'What happens after launch?', 'origin-canvas' ); ?>"} -->
<details class="wp-block-details"><summary><?php echo esc_html__( 'What happens after launch?', 'origin-canvas' ); ?></summary><!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-body","fontSize":"regular-plus"} -->
<p class="has-text-body-color has-text-color has-regular-plus-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Thirty days of fixes are included. After that we keep a small retained slot open for changes, at a monthly rate agreed up front.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></details>
<!-- /wp:details --></section>
<!-- /wp:group -->
