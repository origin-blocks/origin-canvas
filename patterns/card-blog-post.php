<?php
/**
 * Title: Card Blog Post
 * Slug: origin/card-blog-post
 * Description: A single blog post card with image, category, title, excerpt, and meta. Pair with the Blog Post Grid pattern (a dynamic query loop) for multiple posts, or insert manually inside a Columns block.
 * Categories: query
 * Keywords: card, blog, post, article, query
 * Block Types: core/post-content
 * Inserter: true
 *
 * @package Origin
 */

?>
<!-- wp:group {"backgroundColor":"surface-muted","style":{"border":{"radius":"var:custom|radius|medium"},"spacing":{"padding":{"top":"0","right":"0","bottom":"var:preset|spacing|large","left":"0"},"blockGap":"var:preset|spacing|medium"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-surface-muted-background-color has-background" style="border-radius:var(--wp--custom--radius--medium);padding-top:0;padding-right:0;padding-bottom:var(--wp--preset--spacing--large);padding-left:0"><!-- wp:image {"aspectRatio":"3/2","linkDestination":"none","className":"origin-card-blog-image"} -->
<figure class="wp-block-image origin-card-blog-image"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/cards/card-blog-1.webp" alt="<?php esc_attr_e( 'A blank client brief, notebook, pencil, and clipped papers on a pale desk.', 'origin' ); ?>" style="aspect-ratio:3/2"/></figure>
<!-- /wp:image -->

<!-- wp:group {"style":{"spacing":{"padding":{"left":"var:preset|spacing|large","right":"var:preset|spacing|large"},"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-right:var(--wp--preset--spacing--large);padding-left:var(--wp--preset--spacing--large)"><!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","letterSpacing":"0.08em","fontWeight":"500"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|small"}}},"textColor":"primary","fontSize":"extra-small"} -->
<p class="has-primary-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--small);font-weight:500;letter-spacing:0.08em;text-transform:uppercase"><?php echo esc_html__( 'Studio journal', 'origin' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|compact"}}},"textColor":"text-heading","fontSize":"medium"} -->
<h3 class="wp-block-heading has-text-heading-color has-text-color has-medium-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--compact)"><?php echo esc_html__( 'What we send a client in week one', 'origin' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|medium"}}},"textColor":"text-body","fontSize":"regular"} -->
<p class="has-text-body-color has-text-color has-regular-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--medium)"><?php echo esc_html__( 'Before any pixels, we share a single page laying out who the site is for, what it needs to do, and what we&#8217;ll cut from the brief to keep things honest.', 'origin' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-body","fontSize":"small"} -->
<p class="has-text-body-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Claire Bennett · Apr 18, 2026 · 4 min read', 'origin' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
