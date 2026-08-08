<?php
/**
 * Title: Token System Panel
 * Slug: origin-canvas/token-system
 * Description: A built-on-the-system section with a design-token panel for the theme landing page.
 * Categories: origin-canvas/features
 * Keywords: tokens, variables, marketing, scale
 * Viewport Width: 1500
 * Block Types:
 * Post Types:
 * Inserter: true
 *
 * @package Origin
 */

?>
<!-- wp:group {"tagName":"section","align":"full","backgroundColor":"surface-subtle","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"var:preset|spacing|colossal","bottom":"var:preset|spacing|colossal"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-surface-subtle-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--colossal);padding-bottom:var(--wp--preset--spacing--colossal)"><!-- wp:columns {"align":"wide","verticalAlignment":"center","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|huge","left":"var:preset|spacing|huge"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center","width":"47.5%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:47.5%"><!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","fontWeight":"600","letterSpacing":"0.12em"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|medium"}}},"textColor":"primary","fontSize":"small"} -->
<p class="has-primary-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--medium);font-weight:600;letter-spacing:0.12em;text-transform:uppercase"><?php echo esc_html__( 'Built on the system', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2,"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|medium"}}},"fontSize":"display"} -->
<h2 class="wp-block-heading has-display-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--medium)"><?php echo esc_html__( 'Theme owns the presets. Everything else follows.', 'origin-canvas' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|large"}}},"textColor":"text-body","fontSize":"regular-plus"} -->
<p class="has-text-body-color has-text-color has-regular-plus-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--large)"><?php echo esc_html__( 'Colors, spacing, type sizes, and radii live in one theme.json. Patterns and templates reference them, not scattered hex values.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|compact"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|compact"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top"}} -->
<div class="wp-block-group"><!-- wp:group {"className":"origin-canvas-bullet-mark","style":{"dimensions":{"minHeight":"6px"},"spacing":{"margin":{"top":"7.5px"}}}} -->
<div class="wp-block-group origin-canvas-bullet-mark" style="min-height:6px;margin-top:7.5px"></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-body","fontSize":"small"} -->
<p class="has-text-body-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:0"><?php echo wp_kses_post( __( 'Eleven named colors, from <strong>primary</strong> to <strong>on-dark</strong>, used everywhere.', 'origin-canvas' ) ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|compact"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top"}} -->
<div class="wp-block-group"><!-- wp:group {"className":"origin-canvas-bullet-mark","style":{"dimensions":{"minHeight":"6px"},"spacing":{"margin":{"top":"7.5px"}}}} -->
<div class="wp-block-group origin-canvas-bullet-mark" style="min-height:6px;margin-top:7.5px"></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-body","fontSize":"small"} -->
<p class="has-text-body-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:0"><?php echo wp_kses_post( __( 'A <strong>twelve-step spacing scale</strong> with fluid clamps on the larger steps.', 'origin-canvas' ) ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|compact"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top"}} -->
<div class="wp-block-group"><!-- wp:group {"className":"origin-canvas-bullet-mark","style":{"dimensions":{"minHeight":"6px"},"spacing":{"margin":{"top":"7.5px"}}}} -->
<div class="wp-block-group origin-canvas-bullet-mark" style="min-height:6px;margin-top:7.5px"></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-body","fontSize":"small"} -->
<p class="has-text-body-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:0"><?php echo wp_kses_post( __( 'One pink accent, reserved as a <strong>signal</strong>, never a background wash.', 'origin-canvas' ) ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"52.5%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:52.5%"><!-- wp:group {"className":"origin-canvas-tokens-panel","backgroundColor":"surface-base","borderColor":"border","style":{"border":{"radius":"var:custom|radius|large","style":"solid","width":"1px"},"spacing":{"blockGap":"0"}},"layout":{"type":"default"}} -->
<div class="wp-block-group origin-canvas-tokens-panel has-border-color has-border-border-color has-surface-base-background-color has-background" style="border-style:solid;border-width:1px;border-radius:var(--wp--custom--radius--large)"><!-- wp:group {"backgroundColor":"surface-muted","style":{"border":{"bottom":{"color":"var:preset|color|border","width":"1px"}},"spacing":{"padding":{"top":"var:preset|spacing|compact","right":"var:preset|spacing|medium","bottom":"var:preset|spacing|compact","left":"var:preset|spacing|medium"}}},"layout":{"type":"flex","justifyContent":"space-between","verticalAlignment":"center"}} -->
<div class="wp-block-group has-surface-muted-background-color has-background" style="border-bottom-color:var(--wp--preset--color--border);border-bottom-width:1px;padding-top:var(--wp--preset--spacing--compact);padding-right:var(--wp--preset--spacing--medium);padding-bottom:var(--wp--preset--spacing--compact);padding-left:var(--wp--preset--spacing--medium)"><!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading","fontSize":"extra-small"} -->
<p class="has-text-heading-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:0;font-weight:600"><?php echo esc_html__( 'Settings', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"origin-canvas-mono","style":{"typography":{"fontSize":"0.6875rem"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-muted"} -->
<p class="origin-canvas-mono has-text-muted-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:0.6875rem"><?php echo esc_html__( 'theme.json &middot; settings', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"18px","right":"18px","bottom":"18px","left":"18px"},"blockGap":"14px"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-top:18px;padding-right:18px;padding-bottom:18px;padding-left:18px"><!-- wp:paragraph {"style":{"typography":{"fontWeight":"600","letterSpacing":"0.08em","textTransform":"uppercase"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-muted","fontSize":"extra-small"} -->
<p class="has-text-muted-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:0;font-weight:600;letter-spacing:0.08em;text-transform:uppercase"><?php echo esc_html__( 'Color &middot; palette', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:group {"className":"origin-canvas-token-palrow","style":{"spacing":{"blockGap":"0"}},"layout":{"type":"default"}} -->
<div class="wp-block-group origin-canvas-token-palrow"><!-- wp:group {"style":{"spacing":{"blockGap":"6px"}},"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:group {"className":"origin-canvas-token-sw","style":{"color":{"background":"var(--wp--preset--color--primary)"},"dimensions":{"minHeight":"20px"}}} -->
<div class="wp-block-group origin-canvas-token-sw has-background" style="background-color:var(--wp--preset--color--primary);min-height:20px"></div>
<!-- /wp:group -->

<!-- wp:paragraph {"align":"center","className":"origin-canvas-mono","style":{"typography":{"fontSize":"0.625rem"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-muted"} -->
<p class="has-text-align-center origin-canvas-mono has-text-muted-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:0.625rem"><?php echo esc_html__( 'primary', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"6px"}},"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:group {"className":"origin-canvas-token-sw","style":{"color":{"background":"var(--wp--preset--color--text-heading)"},"dimensions":{"minHeight":"20px"}}} -->
<div class="wp-block-group origin-canvas-token-sw has-background" style="background-color:var(--wp--preset--color--text-heading);min-height:20px"></div>
<!-- /wp:group -->

<!-- wp:paragraph {"align":"center","className":"origin-canvas-mono","style":{"typography":{"fontSize":"0.625rem"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-muted"} -->
<p class="has-text-align-center origin-canvas-mono has-text-muted-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:0.625rem"><?php echo esc_html__( 'heading', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"6px"}},"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:group {"className":"origin-canvas-token-sw","style":{"color":{"background":"var(--wp--preset--color--text-body)"},"dimensions":{"minHeight":"20px"}}} -->
<div class="wp-block-group origin-canvas-token-sw has-background" style="background-color:var(--wp--preset--color--text-body);min-height:20px"></div>
<!-- /wp:group -->

<!-- wp:paragraph {"align":"center","className":"origin-canvas-mono","style":{"typography":{"fontSize":"0.625rem"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-muted"} -->
<p class="has-text-align-center origin-canvas-mono has-text-muted-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:0.625rem"><?php echo esc_html__( 'body', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"6px"}},"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:group {"className":"origin-canvas-token-sw","style":{"color":{"background":"var(--wp--preset--color--surface-subtle)"},"dimensions":{"minHeight":"20px"}}} -->
<div class="wp-block-group origin-canvas-token-sw has-background" style="background-color:var(--wp--preset--color--surface-subtle);min-height:20px"></div>
<!-- /wp:group -->

<!-- wp:paragraph {"align":"center","className":"origin-canvas-mono","style":{"typography":{"fontSize":"0.625rem"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-muted"} -->
<p class="has-text-align-center origin-canvas-mono has-text-muted-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:0.625rem"><?php echo esc_html__( 'subtle', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"6px"}},"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:group {"className":"origin-canvas-token-sw","style":{"color":{"background":"var(--wp--preset--color--border)"},"dimensions":{"minHeight":"20px"}}} -->
<div class="wp-block-group origin-canvas-token-sw has-background" style="background-color:var(--wp--preset--color--border);min-height:20px"></div>
<!-- /wp:group -->

<!-- wp:paragraph {"align":"center","className":"origin-canvas-mono","style":{"typography":{"fontSize":"0.625rem"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-muted"} -->
<p class="has-text-align-center origin-canvas-mono has-text-muted-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:0.625rem"><?php echo esc_html__( 'border', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"border":{"top":{"color":"var:preset|color|border","width":"1px"}},"spacing":{"padding":{"top":"18px","right":"18px","bottom":"18px","left":"18px"},"blockGap":"14px"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="border-top-color:var(--wp--preset--color--border);border-top-width:1px;padding-top:18px;padding-right:18px;padding-bottom:18px;padding-left:18px"><!-- wp:paragraph {"style":{"typography":{"fontWeight":"600","letterSpacing":"0.08em","textTransform":"uppercase"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-muted","fontSize":"extra-small"} -->
<p class="has-text-muted-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:0;font-weight:600;letter-spacing:0.08em;text-transform:uppercase"><?php echo esc_html__( 'Spacing &middot; scale', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:group {"className":"origin-canvas-token-scale","style":{"spacing":{"blockGap":"0"}},"layout":{"type":"default"}} -->
<div class="wp-block-group origin-canvas-token-scale"><!-- wp:group {"className":"origin-canvas-token-bar origin-canvas-token-bar--1","style":{"dimensions":{"minHeight":"14px"}}} -->
<div class="wp-block-group origin-canvas-token-bar origin-canvas-token-bar--1" style="min-height:14px"></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-token-bar origin-canvas-token-bar--2","style":{"dimensions":{"minHeight":"22px"}}} -->
<div class="wp-block-group origin-canvas-token-bar origin-canvas-token-bar--2" style="min-height:22px"></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-token-bar origin-canvas-token-bar--3","style":{"dimensions":{"minHeight":"32px"}}} -->
<div class="wp-block-group origin-canvas-token-bar origin-canvas-token-bar--3" style="min-height:32px"></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-token-bar origin-canvas-token-bar--4","style":{"dimensions":{"minHeight":"44px"}}} -->
<div class="wp-block-group origin-canvas-token-bar origin-canvas-token-bar--4" style="min-height:44px"></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-token-bar origin-canvas-token-bar--5","style":{"dimensions":{"minHeight":"58px"}}} -->
<div class="wp-block-group origin-canvas-token-bar origin-canvas-token-bar--5" style="min-height:58px"></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-token-bar origin-canvas-token-bar--6","style":{"dimensions":{"minHeight":"74px"}}} -->
<div class="wp-block-group origin-canvas-token-bar origin-canvas-token-bar--6" style="min-height:74px"></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-token-bar origin-canvas-token-bar--7","style":{"dimensions":{"minHeight":"92px"}}} -->
<div class="wp-block-group origin-canvas-token-bar origin-canvas-token-bar--7" style="min-height:92px"></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"border":{"top":{"color":"var:preset|color|border","width":"1px"}},"spacing":{"padding":{"top":"18px","right":"18px","bottom":"18px","left":"18px"},"blockGap":"14px"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="border-top-color:var(--wp--preset--color--border);border-top-width:1px;padding-top:18px;padding-right:18px;padding-bottom:18px;padding-left:18px"><!-- wp:paragraph {"style":{"typography":{"fontWeight":"600","letterSpacing":"0.08em","textTransform":"uppercase"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-muted","fontSize":"extra-small"} -->
<p class="has-text-muted-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:0;font-weight:600;letter-spacing:0.08em;text-transform:uppercase"><?php echo esc_html__( 'Typography &middot; sizes', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:group {"style":{"spacing":{"blockGap":"16px"}},"layout":{"type":"flex","flexWrap":"wrap","verticalAlignment":"bottom"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontSize":"1.875rem","fontWeight":"700","letterSpacing":"-0.02em"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading"} -->
<p class="has-text-heading-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:1.875rem;font-weight:700;letter-spacing:-0.02em"><?php echo esc_html__( 'Aa', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"1.375rem","fontWeight":"700","letterSpacing":"-0.02em"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading"} -->
<p class="has-text-heading-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:1.375rem;font-weight:700;letter-spacing:-0.02em"><?php echo esc_html__( 'Aa', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"1.0625rem","fontWeight":"700","letterSpacing":"-0.02em"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading"} -->
<p class="has-text-heading-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:1.0625rem;font-weight:700;letter-spacing:-0.02em"><?php echo esc_html__( 'Aa', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"0.875rem","fontWeight":"700","letterSpacing":"-0.02em"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading"} -->
<p class="has-text-heading-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:0.875rem;font-weight:700;letter-spacing:-0.02em"><?php echo esc_html__( 'Aa', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"origin-canvas-mono","style":{"typography":{"fontSize":"0.8125rem"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-muted"} -->
<p class="origin-canvas-mono has-text-muted-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:0.8125rem"><?php echo esc_html__( 'display-xl &rarr; small', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->
