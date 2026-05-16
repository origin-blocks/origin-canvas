<?php
/**
 * Title: Hero Split
 * Slug: origin-canvas/hero-split
 * Categories: origin-canvas/hero
 * Keywords: hero, landing, intro, split, image, full-bleed
 * Block Types: core/post-content
 * Inserter: true
 *
 * @package Origin
 */

?>
<!-- wp:group {"tagName":"section","align":"full","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull"><!-- wp:columns {"align":"full","verticalAlignment":"stretch","style":{"spacing":{"blockGap":"0"}}} -->
<div class="wp-block-columns alignfull are-vertically-aligned-stretch"><!-- wp:column {"verticalAlignment":"stretch","width":"50%"} -->
<div class="wp-block-column is-vertically-aligned-stretch" style="flex-basis:50%"><!-- wp:cover {"url":"<?php echo esc_url( get_template_directory_uri() ); ?>/patterns/images/architecture-interior.webp","alt":"A bright studio interior with an arched window, plants, and papers on a wooden worktable.","dimRatio":0,"isUserOverlayColor":false,"minHeight":100,"minHeightUnit":"%","isDark":false,"style":{"spacing":{"padding":{"top":"0","right":"0","bottom":"0","left":"0"}}},"layout":{"type":"default"}} -->
<div class="wp-block-cover is-light" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;min-height:100%"><img class="wp-block-cover__image-background" alt="<?php esc_attr_e( 'A bright studio interior with an arched window, plants, and papers on a wooden worktable.', 'origin-canvas' ); ?>" src="<?php echo esc_url( get_template_directory_uri() ); ?>/patterns/images/architecture-interior.webp" data-object-fit="cover"/><span aria-hidden="true" class="wp-block-cover__background has-background-dim-0 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"align":"center","placeholder":"Write title...","fontSize":"large"} -->
<p class="has-text-align-center has-large-font-size"></p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:cover --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"50%","backgroundColor":"surface-muted","style":{"spacing":{"padding":{"top":"var:preset|spacing|colossal","bottom":"var:preset|spacing|colossal","left":"var:preset|spacing|jumbo","right":"var:preset|spacing|jumbo"}}}} -->
<div class="wp-block-column is-vertically-aligned-center has-surface-muted-background-color has-background" style="padding-top:var(--wp--preset--spacing--colossal);padding-right:var(--wp--preset--spacing--jumbo);padding-bottom:var(--wp--preset--spacing--colossal);padding-left:var(--wp--preset--spacing--jumbo);flex-basis:50%"><!-- wp:paragraph {"align":"left","style":{"typography":{"textTransform":"uppercase","fontWeight":"500","letterSpacing":"0.08em"},"spacing":{"margin":{"bottom":"var:preset|spacing|small"}}},"textColor":"primary","fontSize":"small"} -->
<p class="has-text-align-left has-primary-color has-text-color has-small-font-size" style="margin-bottom:var(--wp--preset--spacing--small);font-weight:500;letter-spacing:0.08em;text-transform:uppercase"><?php echo esc_html__( 'WHAT WE DO', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"left","level":1,"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<h1 class="wp-block-heading has-text-align-left" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Brand identity and websites for small businesses.', 'origin-canvas' ); ?></h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"left","textColor":"text-body","fontSize":"regular-plus"} -->
<p class="has-text-align-left has-text-body-color has-text-color has-regular-plus-font-size"><?php echo esc_html__( 'Roughly twelve projects a year. Each one starts with a conversation, ends with a launch checklist, and lives somewhere we&#8217;re proud to send people.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"blockGap":"var:preset|spacing|compact","margin":{"top":"var:preset|spacing|extra-large"}}},"layout":{"type":"flex","justifyContent":"left","orientation":"horizontal"}} -->
<div class="wp-block-buttons is-content-justification-flex-start is-layout-flex" style="margin-top:var(--wp--preset--spacing--extra-large)"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button"><?php echo esc_html__( 'Recent work', 'origin-canvas' ); ?></a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-outline-strong"} -->
<div class="wp-block-button is-style-outline-strong"><a class="wp-block-button__link wp-element-button"><?php echo esc_html__( 'Our process', 'origin-canvas' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->
