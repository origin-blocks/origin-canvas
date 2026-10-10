<?php
/**
 * Title: Contact Routes
 * Slug: origin-canvas/contact-routes
 * Description: A page-top contact section: what the first call covers and how to reach the studio, beside cards that each start an email on a chosen topic.
 * Categories: origin-canvas/hero
 * Keywords: inquiry, hire, reach, subject, masthead
 * Viewport Width: 1500
 * Block Types:
 * Post Types:
 * Inserter: true
 * Note: Each card opens an email with its subject filled in. To use a form plugin, replace the contents of the group named "Form" with the plugin's block.
 *
 * @package Origin
 */

?>
<!-- wp:group {"tagName":"section","align":"full","backgroundColor":"surface-muted","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"var:preset|spacing|colossal","bottom":"var:preset|spacing|colossal"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-surface-muted-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--colossal);padding-bottom:var(--wp--preset--spacing--colossal)"><!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained","contentSize":"720px","justifyContent":"left"}} -->
<div class="wp-block-group alignwide"><!-- wp:paragraph {"className":"origin-canvas-eyebrow","style":{"typography":{"textTransform":"uppercase","fontWeight":"600","letterSpacing":"0.08em"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"primary","fontSize":"small"} -->
<p class="origin-canvas-eyebrow has-primary-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:0;font-weight:600;letter-spacing:0.08em;text-transform:uppercase"><?php echo esc_html__( 'Contact · Reply in two business days', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":1,"className":"origin-canvas-text-balance","style":{"spacing":{"margin":{"top":"var:preset|spacing|medium","bottom":"0"}}},"fontSize":"display"} -->
<h1 class="wp-block-heading origin-canvas-text-balance has-display-font-size" style="margin-top:var(--wp--preset--spacing--medium);margin-bottom:0"><?php echo esc_html__( 'Tell us about your business and what it needs', 'origin-canvas' ); ?></h1>
<!-- /wp:heading -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|medium"}}},"layout":{"type":"constrained","contentSize":"640px","justifyContent":"left"}} -->
<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--medium)"><!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-body","fontSize":"regular-plus"} -->
<p class="has-text-body-color has-text-color has-regular-plus-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Choose a topic and your email opens with the subject filled in. A few lines about the project is enough to start.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:columns {"verticalAlignment":"top","align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|huge"},"blockGap":{"top":"var:preset|spacing|huge","left":"var:preset|spacing|jumbo"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-top" style="margin-top:var(--wp--preset--spacing--huge)"><!-- wp:column {"verticalAlignment":"top","width":"50%","style":{"spacing":{"padding":{"top":"var:preset|spacing|extra-large"}}}} -->
<div class="wp-block-column is-vertically-aligned-top" style="padding-top:var(--wp--preset--spacing--extra-large);flex-basis:50%"><!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","letterSpacing":"0.08em","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|medium"}}},"textColor":"text-heading","fontSize":"extra-small"} -->
<p class="has-text-heading-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--medium);font-weight:600;letter-spacing:0.08em;text-transform:uppercase"><?php echo esc_html__( 'On the first call you get', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:list {"className":"is-style-origin-canvas-list-check-neutral","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-body","fontSize":"regular-plus"} -->
<ul class="wp-block-list is-style-origin-canvas-list-check-neutral has-text-body-color has-text-color has-regular-plus-font-size" style="margin-top:0;margin-bottom:0"><!-- wp:list-item --><li><?php echo esc_html__( 'A plain read on what the project needs', 'origin-canvas' ); ?></li><!-- /wp:list-item -->
<!-- wp:list-item --><li><?php echo esc_html__( 'A price range and a likely start date', 'origin-canvas' ); ?></li><!-- /wp:list-item -->
<!-- wp:list-item --><li><?php echo esc_html__( 'Clear next steps, even if we are not the right fit', 'origin-canvas' ); ?></li><!-- /wp:list-item --></ul>
<!-- /wp:list -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|huge"},"blockGap":"var:preset|spacing|large"}},"layout":{"type":"grid","columnCount":2,"minimumColumnWidth":"12rem"}} -->
<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--huge)"><!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:icon {"icon":"core/envelope","textColor":"primary","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|small"}},"dimensions":{"width":"28px"}}} /-->

<!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","letterSpacing":"0.08em","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|small"}}},"textColor":"text-heading","fontSize":"extra-small"} -->
<p class="has-text-heading-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--small);font-weight:600;letter-spacing:0.08em;text-transform:uppercase"><?php echo esc_html__( 'Email', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"origin-canvas-links-plain","style":{"typography":{"fontWeight":"500"},"elements":{"link":{"color":{"text":"var:preset|color|text-heading"},":hover":{"color":{"text":"var:preset|color|primary"}}}},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading","fontSize":"regular-plus"} -->
<p class="origin-canvas-links-plain has-text-heading-color has-text-color has-link-color has-regular-plus-font-size" style="margin-top:0;margin-bottom:0;font-weight:500"><a href="mailto:hello@example.com"><?php echo esc_html__( 'hello@example.com', 'origin-canvas' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:icon {"icon":"core/mobile","textColor":"primary","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|small"}},"dimensions":{"width":"28px"}}} /-->

<!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","letterSpacing":"0.08em","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|small"}}},"textColor":"text-heading","fontSize":"extra-small"} -->
<p class="has-text-heading-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--small);font-weight:600;letter-spacing:0.08em;text-transform:uppercase"><?php echo esc_html__( 'Phone', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"origin-canvas-links-plain","style":{"typography":{"fontWeight":"500"},"elements":{"link":{"color":{"text":"var:preset|color|text-heading"},":hover":{"color":{"text":"var:preset|color|primary"}}}},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading","fontSize":"regular-plus"} -->
<p class="origin-canvas-links-plain has-text-heading-color has-text-color has-link-color has-regular-plus-font-size" style="margin-top:0;margin-bottom:0;font-weight:500"><a href="tel:+15035550142"><?php echo esc_html__( '(503) 555-0142', 'origin-canvas' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"top","width":"50%"} -->
<div class="wp-block-column is-vertically-aligned-top" style="flex-basis:50%"><!-- wp:group {"metadata":{"name":"Form"},"backgroundColor":"surface-base","style":{"border":{"radius":"var:custom|radius|medium"},"spacing":{"padding":{"top":"var:preset|spacing|extra-large","right":"var:preset|spacing|extra-large","bottom":"var:preset|spacing|extra-large","left":"var:preset|spacing|extra-large"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-surface-base-background-color has-background" style="border-radius:var(--wp--custom--radius--medium);padding-top:var(--wp--preset--spacing--extra-large);padding-right:var(--wp--preset--spacing--extra-large);padding-bottom:var(--wp--preset--spacing--extra-large);padding-left:var(--wp--preset--spacing--extra-large)"><!-- wp:heading {"level":2,"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|large"}}},"fontSize":"large"} -->
<h2 class="wp-block-heading has-large-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--large)"><?php echo esc_html__( 'What is it about?', 'origin-canvas' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|medium"}},"layout":{"type":"grid","columnCount":2,"minimumColumnWidth":"11rem"}} -->
<div class="wp-block-group"><!-- wp:group {"backgroundColor":"surface-muted","style":{"border":{"radius":"var:custom|radius|medium"},"spacing":{"padding":{"top":"var:preset|spacing|medium","right":"var:preset|spacing|medium","bottom":"var:preset|spacing|medium","left":"var:preset|spacing|medium"},"blockGap":"var:preset|spacing|small"}},"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group has-surface-muted-background-color has-background" style="border-radius:var(--wp--custom--radius--medium);padding-top:var(--wp--preset--spacing--medium);padding-right:var(--wp--preset--spacing--medium);padding-bottom:var(--wp--preset--spacing--medium);padding-left:var(--wp--preset--spacing--medium)"><!-- wp:heading {"level":3,"className":"origin-canvas-links-plain","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"fontSize":"regular-plus"} -->
<h3 class="wp-block-heading origin-canvas-links-plain has-regular-plus-font-size" style="margin-top:0;margin-bottom:0"><a href="mailto:hello@example.com?subject=Website%20project"><?php echo esc_html__( 'Website →', 'origin-canvas' ); ?></a></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-body","fontSize":"small"} -->
<p class="has-text-body-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'A new site, or a rebuild of the one you have.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"backgroundColor":"surface-muted","style":{"border":{"radius":"var:custom|radius|medium"},"spacing":{"padding":{"top":"var:preset|spacing|medium","right":"var:preset|spacing|medium","bottom":"var:preset|spacing|medium","left":"var:preset|spacing|medium"},"blockGap":"var:preset|spacing|small"}},"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group has-surface-muted-background-color has-background" style="border-radius:var(--wp--custom--radius--medium);padding-top:var(--wp--preset--spacing--medium);padding-right:var(--wp--preset--spacing--medium);padding-bottom:var(--wp--preset--spacing--medium);padding-left:var(--wp--preset--spacing--medium)"><!-- wp:heading {"level":3,"className":"origin-canvas-links-plain","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"fontSize":"regular-plus"} -->
<h3 class="wp-block-heading origin-canvas-links-plain has-regular-plus-font-size" style="margin-top:0;margin-bottom:0"><a href="mailto:hello@example.com?subject=Brand%20project"><?php echo esc_html__( 'Brand →', 'origin-canvas' ); ?></a></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-body","fontSize":"small"} -->
<p class="has-text-body-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'A logo, colors and type for a new or growing business.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"backgroundColor":"surface-muted","style":{"border":{"radius":"var:custom|radius|medium"},"spacing":{"padding":{"top":"var:preset|spacing|medium","right":"var:preset|spacing|medium","bottom":"var:preset|spacing|medium","left":"var:preset|spacing|medium"},"blockGap":"var:preset|spacing|small"}},"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group has-surface-muted-background-color has-background" style="border-radius:var(--wp--custom--radius--medium);padding-top:var(--wp--preset--spacing--medium);padding-right:var(--wp--preset--spacing--medium);padding-bottom:var(--wp--preset--spacing--medium);padding-left:var(--wp--preset--spacing--medium)"><!-- wp:heading {"level":3,"className":"origin-canvas-links-plain","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"fontSize":"regular-plus"} -->
<h3 class="wp-block-heading origin-canvas-links-plain has-regular-plus-font-size" style="margin-top:0;margin-bottom:0"><a href="mailto:hello@example.com?subject=Brand%20and%20website"><?php echo esc_html__( 'Both →', 'origin-canvas' ); ?></a></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-body","fontSize":"small"} -->
<p class="has-text-body-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'A brand and the website that carries it.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"backgroundColor":"surface-muted","style":{"border":{"radius":"var:custom|radius|medium"},"spacing":{"padding":{"top":"var:preset|spacing|medium","right":"var:preset|spacing|medium","bottom":"var:preset|spacing|medium","left":"var:preset|spacing|medium"},"blockGap":"var:preset|spacing|small"}},"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group has-surface-muted-background-color has-background" style="border-radius:var(--wp--custom--radius--medium);padding-top:var(--wp--preset--spacing--medium);padding-right:var(--wp--preset--spacing--medium);padding-bottom:var(--wp--preset--spacing--medium);padding-left:var(--wp--preset--spacing--medium)"><!-- wp:heading {"level":3,"className":"origin-canvas-links-plain","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"fontSize":"regular-plus"} -->
<h3 class="wp-block-heading origin-canvas-links-plain has-regular-plus-font-size" style="margin-top:0;margin-bottom:0"><a href="mailto:hello@example.com?subject=A%20question"><?php echo esc_html__( 'Something else →', 'origin-canvas' ); ?></a></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-body","fontSize":"small"} -->
<p class="has-text-body-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'A smaller job, a question or an idea to talk through.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->
