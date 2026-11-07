<?php
/**
 * Title: Post Loop Text
 * Slug: origin-canvas/post-loop-text
 * Description: The five latest posts in rows pairing linked titles with excerpts and dates, using only text and thin lines.
 * Categories: posts
 * Keywords: blog, journal, articles, about page
 * Viewport Width: 1500
 * Block Types:
 * Post Types:
 * Inserter: true
 *
 * @package Origin
 */

?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"var:preset|spacing|colossal","bottom":"var:preset|spacing|colossal"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--colossal);padding-bottom:var(--wp--preset--spacing--colossal)"><!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|large"}},"layout":{"type":"default"}} -->
<div class="wp-block-group alignwide">
<!-- wp:heading {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"fontSize":"extra-large"} -->
<h2 class="wp-block-heading has-extra-large-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Notes from the studio', 'origin-canvas' ); ?></h2>
<!-- /wp:heading -->
<!-- wp:separator {"className":"is-style-wide","backgroundColor":"base-5"} -->
<hr class="wp-block-separator has-text-color has-base-5-color has-alpha-channel-opacity has-base-5-background-color has-background is-style-wide"/>
<!-- /wp:separator -->
<!-- wp:query {"queryId":1,"query":{"perPage":5,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"layout":{"type":"default"}} -->
<div class="wp-block-query">
<!-- wp:post-template {"style":{"spacing":{"blockGap":"var:preset|spacing|large"}},"layout":{"type":"default"}} -->
<!-- wp:columns {"style":{"border":{"bottom":{"color":"var:preset|color|base-5","width":"1px"}},"spacing":{"padding":{"bottom":"var:preset|spacing|large"},"blockGap":{"top":"var:preset|spacing|small-medium","left":"var:preset|spacing|large"}}}} -->
<div class="wp-block-columns" style="border-bottom-color:var(--wp--preset--color--base-5);border-bottom-width:1px;padding-bottom:var(--wp--preset--spacing--large)">
<!-- wp:column {"width":"33.33%"} -->
<div class="wp-block-column" style="flex-basis:33.33%">
<!-- wp:post-title {"level":3,"isLink":true,"style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|contrast"},":hover":{"color":{"text":"var:preset|color|primary"}}}}},"fontSize":"large"} /-->
</div>
<!-- /wp:column -->
<!-- wp:column {"width":"66.66%"} -->
<div class="wp-block-column" style="flex-basis:66.66%">
<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|small"}},"layout":{"type":"default"}} -->
<div class="wp-block-group">
<!-- wp:post-excerpt {"excerptLength":40,"className":"is-style-origin-canvas-excerpt-truncate-2","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"contrast-2","fontSize":"regular"} /-->
<!-- wp:post-date {"format":"M j, Y","metadata":{"bindings":{"datetime":{"source":"core/post-data","args":{"field":"date"}}}},"style":{"spacing":{"margin":{"top":"var:preset|spacing|small","bottom":"0"}}},"textColor":"contrast-3","fontSize":"small"} /-->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:column -->
</div>
<!-- /wp:columns -->
<!-- /wp:post-template -->
<!-- wp:query-no-results -->
<!-- wp:paragraph {"textColor":"contrast-2","fontSize":"regular"} -->
<p class="has-contrast-2-color has-text-color has-regular-font-size"><?php echo esc_html__( 'No posts were found.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->
<!-- /wp:query-no-results -->
</div>
<!-- /wp:query -->
<?php if ( 'posts' === get_option( 'show_on_front' ) || get_option( 'page_for_posts' ) ) : ?>
<!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"},"spacing":{"margin":{"bottom":"0"}}},"textColor":"contrast","fontSize":"small"} -->
<p class="has-contrast-color has-text-color has-small-font-size" style="margin-bottom:0;font-weight:600"><a href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ); ?>" style="text-decoration:none"><?php echo esc_html__( 'All notes', 'origin-canvas' ); ?> <span aria-hidden="true">→</span></a></p>
<!-- /wp:paragraph -->
<?php endif; ?>
</div>
<!-- /wp:group --></section>
<!-- /wp:group -->
