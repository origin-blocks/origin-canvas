<?php
/**
 * Title: Team Cards
 * Slug: origin-canvas/team-cards
 * Description: Four colleagues on cards, each with a square photo, name, role and one line on what to ask them about.
 * Categories: team
 * Keywords: staff, people, members, headshots, about
 * Viewport Width: 1500
 * Block Types:
 * Post Types:
 * Inserter: true
 *
 * @package Origin
 */

?>
<!-- wp:group {"tagName":"section","align":"full","backgroundColor":"surface-muted","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"var:preset|spacing|colossal","bottom":"var:preset|spacing|colossal"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-surface-muted-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--colossal);padding-bottom:var(--wp--preset--spacing--colossal)"><!-- wp:heading {"level":2,"align":"wide","style":{"typography":{"lineHeight":"1.1"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|extra-large"}}},"textColor":"text-heading","fontSize":"display"} -->
<h2 class="wp-block-heading alignwide has-text-heading-color has-text-color has-display-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--extra-large);line-height:1.1"><?php echo esc_html__( 'The four of us', 'origin-canvas' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|large"}},"layout":{"type":"grid","columnCount":4,"minimumColumnWidth":"14rem"}} -->
<div class="wp-block-group alignwide"><!-- wp:group {"backgroundColor":"surface-base","style":{"border":{"radius":"var:custom|radius|medium"},"spacing":{"padding":{"top":"var:preset|spacing|large","right":"var:preset|spacing|large","bottom":"var:preset|spacing|large","left":"var:preset|spacing|large"},"blockGap":"0"}},"layout":{"type":"default"}} -->
<div class="wp-block-group has-surface-base-background-color has-background" style="border-radius:var(--wp--custom--radius--medium);padding-top:var(--wp--preset--spacing--large);padding-right:var(--wp--preset--spacing--large);padding-bottom:var(--wp--preset--spacing--large);padding-left:var(--wp--preset--spacing--large)"><!-- wp:image {"aspectRatio":"1","scale":"cover","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"var:custom|radius|medium"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<figure class="wp-block-image size-full has-custom-border" style="margin-top:0;margin-bottom:0"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/patterns/images/avatar-claire-bennett.webp" alt="<?php esc_attr_e( 'Portrait of Claire Bennett, Co-founder.', 'origin-canvas' ); ?>" style="border-radius:var(--wp--custom--radius--medium);aspect-ratio:1;object-fit:cover"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"top":"var:preset|spacing|medium","bottom":"0"}}},"textColor":"text-heading","fontSize":"medium"} -->
<h3 class="wp-block-heading has-text-heading-color has-text-color has-medium-font-size" style="margin-top:var(--wp--preset--spacing--medium);margin-bottom:0"><?php echo esc_html__( 'Claire Bennett', 'origin-canvas' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|extra-small","bottom":"0"}}},"textColor":"text-muted","fontSize":"small"} -->
<p class="has-text-muted-color has-text-color has-small-font-size" style="margin-top:var(--wp--preset--spacing--extra-small);margin-bottom:0"><?php echo esc_html__( 'Co-founder', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|compact","bottom":"0"}}},"textColor":"text-body","fontSize":"regular"} -->
<p class="has-text-body-color has-text-color has-regular-font-size" style="margin-top:var(--wp--preset--spacing--compact);margin-bottom:0"><?php echo esc_html__( 'New projects, budgets and timing.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"backgroundColor":"surface-base","style":{"border":{"radius":"var:custom|radius|medium"},"spacing":{"padding":{"top":"var:preset|spacing|large","right":"var:preset|spacing|large","bottom":"var:preset|spacing|large","left":"var:preset|spacing|large"},"blockGap":"0"}},"layout":{"type":"default"}} -->
<div class="wp-block-group has-surface-base-background-color has-background" style="border-radius:var(--wp--custom--radius--medium);padding-top:var(--wp--preset--spacing--large);padding-right:var(--wp--preset--spacing--large);padding-bottom:var(--wp--preset--spacing--large);padding-left:var(--wp--preset--spacing--large)"><!-- wp:image {"aspectRatio":"1","scale":"cover","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"var:custom|radius|medium"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<figure class="wp-block-image size-full has-custom-border" style="margin-top:0;margin-bottom:0"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/patterns/images/avatar-marcus-holloway.webp" alt="<?php esc_attr_e( 'Portrait of Marcus Holloway.', 'origin-canvas' ); ?>" style="border-radius:var(--wp--custom--radius--medium);aspect-ratio:1;object-fit:cover"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"top":"var:preset|spacing|medium","bottom":"0"}}},"textColor":"text-heading","fontSize":"medium"} -->
<h3 class="wp-block-heading has-text-heading-color has-text-color has-medium-font-size" style="margin-top:var(--wp--preset--spacing--medium);margin-bottom:0"><?php echo esc_html__( 'Marcus Holloway', 'origin-canvas' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|extra-small","bottom":"0"}}},"textColor":"text-muted","fontSize":"small"} -->
<p class="has-text-muted-color has-text-color has-small-font-size" style="margin-top:var(--wp--preset--spacing--extra-small);margin-bottom:0"><?php echo esc_html__( 'Co-founder and Designer', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|compact","bottom":"0"}}},"textColor":"text-body","fontSize":"regular"} -->
<p class="has-text-body-color has-text-color has-regular-font-size" style="margin-top:var(--wp--preset--spacing--compact);margin-bottom:0"><?php echo esc_html__( 'Design, from the first sketch to the last check.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"backgroundColor":"surface-base","style":{"border":{"radius":"var:custom|radius|medium"},"spacing":{"padding":{"top":"var:preset|spacing|large","right":"var:preset|spacing|large","bottom":"var:preset|spacing|large","left":"var:preset|spacing|large"},"blockGap":"0"}},"layout":{"type":"default"}} -->
<div class="wp-block-group has-surface-base-background-color has-background" style="border-radius:var(--wp--custom--radius--medium);padding-top:var(--wp--preset--spacing--large);padding-right:var(--wp--preset--spacing--large);padding-bottom:var(--wp--preset--spacing--large);padding-left:var(--wp--preset--spacing--large)"><!-- wp:image {"aspectRatio":"1","scale":"cover","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"var:custom|radius|medium"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<figure class="wp-block-image size-full has-custom-border" style="margin-top:0;margin-bottom:0"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/patterns/images/avatar-hannah-wright.webp" alt="<?php esc_attr_e( 'Portrait of Hannah Wright.', 'origin-canvas' ); ?>" style="border-radius:var(--wp--custom--radius--medium);aspect-ratio:1;object-fit:cover"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"top":"var:preset|spacing|medium","bottom":"0"}}},"textColor":"text-heading","fontSize":"medium"} -->
<h3 class="wp-block-heading has-text-heading-color has-text-color has-medium-font-size" style="margin-top:var(--wp--preset--spacing--medium);margin-bottom:0"><?php echo esc_html__( 'Hannah Wright', 'origin-canvas' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|extra-small","bottom":"0"}}},"textColor":"text-muted","fontSize":"small"} -->
<p class="has-text-muted-color has-text-color has-small-font-size" style="margin-top:var(--wp--preset--spacing--extra-small);margin-bottom:0"><?php echo esc_html__( 'Brand Strategist', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|compact","bottom":"0"}}},"textColor":"text-body","fontSize":"regular"} -->
<p class="has-text-body-color has-text-color has-regular-font-size" style="margin-top:var(--wp--preset--spacing--compact);margin-bottom:0"><?php echo esc_html__( 'What your business says, and how it says it.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"backgroundColor":"surface-base","style":{"border":{"radius":"var:custom|radius|medium"},"spacing":{"padding":{"top":"var:preset|spacing|large","right":"var:preset|spacing|large","bottom":"var:preset|spacing|large","left":"var:preset|spacing|large"},"blockGap":"0"}},"layout":{"type":"default"}} -->
<div class="wp-block-group has-surface-base-background-color has-background" style="border-radius:var(--wp--custom--radius--medium);padding-top:var(--wp--preset--spacing--large);padding-right:var(--wp--preset--spacing--large);padding-bottom:var(--wp--preset--spacing--large);padding-left:var(--wp--preset--spacing--large)"><!-- wp:image {"aspectRatio":"1","scale":"cover","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"var:custom|radius|medium"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<figure class="wp-block-image size-full has-custom-border" style="margin-top:0;margin-bottom:0"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/patterns/images/avatar-ben-carter.webp" alt="<?php esc_attr_e( 'Portrait of Ben Carter.', 'origin-canvas' ); ?>" style="border-radius:var(--wp--custom--radius--medium);aspect-ratio:1;object-fit:cover"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"top":"var:preset|spacing|medium","bottom":"0"}}},"textColor":"text-heading","fontSize":"medium"} -->
<h3 class="wp-block-heading has-text-heading-color has-text-color has-medium-font-size" style="margin-top:var(--wp--preset--spacing--medium);margin-bottom:0"><?php echo esc_html__( 'Ben Carter', 'origin-canvas' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|extra-small","bottom":"0"}}},"textColor":"text-muted","fontSize":"small"} -->
<p class="has-text-muted-color has-text-color has-small-font-size" style="margin-top:var(--wp--preset--spacing--extra-small);margin-bottom:0"><?php echo esc_html__( 'Developer', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|compact","bottom":"0"}}},"textColor":"text-body","fontSize":"regular"} -->
<p class="has-text-body-color has-text-color has-regular-font-size" style="margin-top:var(--wp--preset--spacing--compact);margin-bottom:0"><?php echo esc_html__( 'Building your site and getting it live.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
