<?php
/**
 * Title: Card Team Member
 * Slug: origin-canvas/card-team-member
 * Description: A single team member card with portrait, name, role, and social links. Insert inside a Columns block for a team grid layout.
 * Categories: origin-canvas/team
 * Keywords: card, team, member, profile, person, staff
 * Block Types: core/post-content
 * Inserter: true
 *
 * @package Origin
 */

?>
<!-- wp:group {"style":{"spacing":{"blockGap":"0","padding":{"top":"0","right":"0","bottom":"0","left":"0"}}},"layout":{"type":"constrained","justifyContent":"center"}} -->
<div class="wp-block-group" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:image {"aspectRatio":"1","linkDestination":"none","align":"center","width":"128px","height":"128px","className":"is-style-rounded-full","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|medium"}}}} -->
<figure class="wp-block-image aligncenter is-resized is-style-rounded-full" style="margin-bottom:var(--wp--preset--spacing--medium)"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/cards/card-team-1.webp" alt="<?php esc_attr_e( 'Hands reviewing blank paper at a light wooden studio desk.', 'origin-canvas' ); ?>" style="aspect-ratio:1;width:128px;height:128px"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"textAlign":"center","level":3,"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|extra-small"}}},"textColor":"text-heading","fontSize":"regular-plus"} -->
<h3 class="wp-block-heading has-text-align-center has-text-heading-color has-text-color has-regular-plus-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--extra-small)"><?php echo esc_html__( 'Claire Bennett', 'origin-canvas' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|small"}}},"textColor":"text-body","fontSize":"regular"} -->
<p class="has-text-align-center has-text-body-color has-text-color has-regular-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--small)"><?php echo esc_html__( 'Founder', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|small"}}},"textColor":"text-body","fontSize":"small"} -->
<p class="has-text-align-center has-text-body-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--small)"><?php echo esc_html__( 'Twelve years in agencies before going small. Most days she&#8217;s in a discovery call or pushing back on a brief.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-muted","fontSize":"small"} -->
<p class="has-text-align-center has-text-muted-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:0"><a href="#"><?php echo esc_html__( 'LinkedIn', 'origin-canvas' ); ?></a> &middot; <a href="#"><?php echo esc_html__( 'Twitter', 'origin-canvas' ); ?></a> &middot; <a href="#"><?php echo esc_html__( 'Email', 'origin-canvas' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
