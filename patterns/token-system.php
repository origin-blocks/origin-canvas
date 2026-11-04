<?php
/**
 * Title: Token System Panel
 * Slug: origin-canvas/token-system
 * Description: A tinted band with an eyebrow, heading, lead and three short points beside a panel of the color, spacing and type settings.
 * Categories: origin-canvas/features
 * Keywords: tokens, variables, marketing, scale
 * Viewport Width: 1500
 * Block Types:
 * Post Types:
 * Inserter: false
 *
 * @package Origin
 */

?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"var:preset|spacing|colossal","bottom":"var:preset|spacing|colossal"}}},"backgroundColor":"base-3","layout":{"type":"constrained"},"anchor":"features"} -->
<section class="wp-block-group alignfull has-base-3-background-color has-background" id="features" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--colossal);padding-bottom:var(--wp--preset--spacing--colossal)"><!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|huge","left":"var:preset|spacing|huge"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center","width":"50%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:50%"><!-- wp:paragraph {"className":"origin-canvas-eyebrow","style":{"typography":{"textTransform":"uppercase","fontWeight":"600","letterSpacing":"0.06em"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|medium"}}},"textColor":"primary","fontSize":"small"} -->
<p class="origin-canvas-eyebrow has-primary-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--medium);font-weight:600;letter-spacing:0.06em;text-transform:uppercase"><?php echo esc_html__( 'Built on the system', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"fontSize":"display"} -->
<h2 class="wp-block-heading has-display-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Theme owns the presets. Everything else follows.', 'origin-canvas' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|small-medium","bottom":"var:preset|spacing|large"}}},"textColor":"contrast-2","fontSize":"regular-plus"} -->
<p class="has-contrast-2-color has-text-color has-regular-plus-font-size" style="margin-top:var(--wp--preset--spacing--small-medium);margin-bottom:var(--wp--preset--spacing--large)"><?php echo esc_html__( 'Colors, spacing, type sizes, and radii live in one theme.json. Patterns and templates reference them, not scattered hex values.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|small-medium"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|small-medium"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top"}} -->
<div class="wp-block-group"><!-- wp:group {"className":"origin-canvas-bullet-mark","style":{"dimensions":{"minHeight":"6px"},"spacing":{"margin":{"top":"8px"}}}} -->
<div class="wp-block-group origin-canvas-bullet-mark" style="min-height:6px;margin-top:8px"></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"contrast-2","fontSize":"small"} -->
<p class="has-contrast-2-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:0"><?php echo wp_kses_post( __( 'Thirteen named colors, from <strong>primary</strong> to <strong>contrast</strong>, used everywhere.', 'origin-canvas' ) ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|small-medium"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top"}} -->
<div class="wp-block-group"><!-- wp:group {"className":"origin-canvas-bullet-mark","style":{"dimensions":{"minHeight":"6px"},"spacing":{"margin":{"top":"8px"}}}} -->
<div class="wp-block-group origin-canvas-bullet-mark" style="min-height:6px;margin-top:8px"></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"contrast-2","fontSize":"small"} -->
<p class="has-contrast-2-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:0"><?php echo wp_kses_post( __( 'A <strong>twelve-step spacing scale</strong> with fluid clamps on the larger steps.', 'origin-canvas' ) ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|small-medium"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top"}} -->
<div class="wp-block-group"><!-- wp:group {"className":"origin-canvas-bullet-mark","style":{"dimensions":{"minHeight":"6px"},"spacing":{"margin":{"top":"8px"}}}} -->
<div class="wp-block-group origin-canvas-bullet-mark" style="min-height:6px;margin-top:8px"></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"contrast-2","fontSize":"small"} -->
<p class="has-contrast-2-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:0"><?php echo wp_kses_post( __( 'One pink accent, reserved as a <strong>signal</strong>, never a background wash.', 'origin-canvas' ) ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"50%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:50%"><!-- wp:group {"className":"origin-canvas-tokens-panel","style":{"border":{"radius":"var:custom|radius|medium"},"spacing":{"blockGap":"0"}},"backgroundColor":"base","layout":{"type":"default"}} -->
<div class="wp-block-group origin-canvas-tokens-panel has-base-background-color has-background" style="border-radius:var(--wp--custom--radius--medium)"><!-- wp:group {"style":{"border":{"bottom":{"color":"var:preset|color|base-5","width":"1px"}},"spacing":{"padding":{"top":"var:preset|spacing|small-medium","right":"var:preset|spacing|medium","bottom":"var:preset|spacing|small-medium","left":"var:preset|spacing|medium"}}},"backgroundColor":"base-2","layout":{"type":"flex","justifyContent":"space-between","verticalAlignment":"center"}} -->
<div class="wp-block-group has-base-2-background-color has-background" style="border-bottom-color:var(--wp--preset--color--base-5);border-bottom-width:1px;padding-top:var(--wp--preset--spacing--small-medium);padding-right:var(--wp--preset--spacing--medium);padding-bottom:var(--wp--preset--spacing--small-medium);padding-left:var(--wp--preset--spacing--medium)"><!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"contrast","fontSize":"extra-small"} -->
<p class="has-contrast-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:0;font-weight:600"><?php echo esc_html__( 'Settings', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"origin-canvas-mono","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"contrast-3","fontSize":"extra-small"} -->
<p class="origin-canvas-mono has-contrast-3-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'theme.json &middot; settings', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"18px","right":"18px","bottom":"18px","left":"18px"},"blockGap":"14px"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-top:18px;padding-right:18px;padding-bottom:18px;padding-left:18px"><!-- wp:paragraph {"style":{"typography":{"fontWeight":"600","letterSpacing":"0.06em","textTransform":"uppercase"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"contrast","fontSize":"extra-small"} -->
<p class="has-contrast-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:0;font-weight:600;letter-spacing:0.06em;text-transform:uppercase"><?php echo esc_html__( 'Color &middot; palette', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:group {"className":"origin-canvas-token-palrow","style":{"spacing":{"blockGap":"0"}},"layout":{"type":"default"}} -->
<div class="wp-block-group origin-canvas-token-palrow"><!-- wp:group {"style":{"spacing":{"blockGap":"6px"}},"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:group {"className":"origin-canvas-token-sw","style":{"color":{"background":"var(\u002d\u002dwp\u002d\u002dpreset\u002d\u002dcolor\u002d\u002dprimary)"},"dimensions":{"minHeight":"20px"}}} -->
<div class="wp-block-group origin-canvas-token-sw has-background" style="background-color:var(--wp--preset--color--primary);min-height:20px"></div>
<!-- /wp:group -->

<!-- wp:paragraph {"className":"origin-canvas-mono","style":{"typography":{"fontSize":"0.625rem","textAlign":"center"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"contrast-3"} -->
<p class="has-text-align-center origin-canvas-mono has-contrast-3-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:0.625rem"><?php echo esc_html__( 'primary', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"6px"}},"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:group {"className":"origin-canvas-token-sw","style":{"color":{"background":"var(\u002d\u002dwp\u002d\u002dpreset\u002d\u002dcolor\u002d\u002dcontrast)"},"dimensions":{"minHeight":"20px"}}} -->
<div class="wp-block-group origin-canvas-token-sw has-background" style="background-color:var(--wp--preset--color--contrast);min-height:20px"></div>
<!-- /wp:group -->

<!-- wp:paragraph {"className":"origin-canvas-mono","style":{"typography":{"fontSize":"0.625rem","textAlign":"center"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"contrast-3"} -->
<p class="has-text-align-center origin-canvas-mono has-contrast-3-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:0.625rem"><?php echo esc_html__( 'heading', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"6px"}},"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:group {"className":"origin-canvas-token-sw","style":{"color":{"background":"var(\u002d\u002dwp\u002d\u002dpreset\u002d\u002dcolor\u002d\u002dcontrast-2)"},"dimensions":{"minHeight":"20px"}}} -->
<div class="wp-block-group origin-canvas-token-sw has-background" style="background-color:var(--wp--preset--color--contrast-2);min-height:20px"></div>
<!-- /wp:group -->

<!-- wp:paragraph {"className":"origin-canvas-mono","style":{"typography":{"fontSize":"0.625rem","textAlign":"center"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"contrast-3"} -->
<p class="has-text-align-center origin-canvas-mono has-contrast-3-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:0.625rem"><?php echo esc_html__( 'body', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"6px"}},"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:group {"className":"origin-canvas-token-sw","style":{"color":{"background":"var(\u002d\u002dwp\u002d\u002dpreset\u002d\u002dcolor\u002d\u002dbase-3)"},"dimensions":{"minHeight":"20px"}}} -->
<div class="wp-block-group origin-canvas-token-sw has-background" style="background-color:var(--wp--preset--color--base-3);min-height:20px"></div>
<!-- /wp:group -->

<!-- wp:paragraph {"className":"origin-canvas-mono","style":{"typography":{"fontSize":"0.625rem","textAlign":"center"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"contrast-3"} -->
<p class="has-text-align-center origin-canvas-mono has-contrast-3-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:0.625rem"><?php echo esc_html__( 'subtle', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"6px"}},"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:group {"className":"origin-canvas-token-sw","style":{"color":{"background":"var(\u002d\u002dwp\u002d\u002dpreset\u002d\u002dcolor\u002d\u002dbase-5)"},"dimensions":{"minHeight":"20px"}}} -->
<div class="wp-block-group origin-canvas-token-sw has-background" style="background-color:var(--wp--preset--color--base-5);min-height:20px"></div>
<!-- /wp:group -->

<!-- wp:paragraph {"className":"origin-canvas-mono","style":{"typography":{"fontSize":"0.625rem","textAlign":"center"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"contrast-3"} -->
<p class="has-text-align-center origin-canvas-mono has-contrast-3-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:0.625rem"><?php echo esc_html__( 'border', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"border":{"top":{"color":"var:preset|color|base-5","width":"1px"}},"spacing":{"padding":{"top":"18px","right":"18px","bottom":"18px","left":"18px"},"blockGap":"14px"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="border-top-color:var(--wp--preset--color--base-5);border-top-width:1px;padding-top:18px;padding-right:18px;padding-bottom:18px;padding-left:18px"><!-- wp:paragraph {"style":{"typography":{"fontWeight":"600","letterSpacing":"0.06em","textTransform":"uppercase"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"contrast","fontSize":"extra-small"} -->
<p class="has-contrast-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:0;font-weight:600;letter-spacing:0.06em;text-transform:uppercase"><?php echo esc_html__( 'Spacing &middot; scale', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:group {"className":"origin-canvas-token-scale","style":{"spacing":{"blockGap":"0"}},"layout":{"type":"default"}} -->
<div class="wp-block-group origin-canvas-token-scale"><!-- wp:group {"className":"origin-canvas-token-bar origin-canvas-token-bar\u002d\u002d1","style":{"dimensions":{"minHeight":"14px"}}} -->
<div class="wp-block-group origin-canvas-token-bar origin-canvas-token-bar--1" style="min-height:14px"></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-token-bar origin-canvas-token-bar\u002d\u002d2","style":{"dimensions":{"minHeight":"22px"}}} -->
<div class="wp-block-group origin-canvas-token-bar origin-canvas-token-bar--2" style="min-height:22px"></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-token-bar origin-canvas-token-bar\u002d\u002d3","style":{"dimensions":{"minHeight":"32px"}}} -->
<div class="wp-block-group origin-canvas-token-bar origin-canvas-token-bar--3" style="min-height:32px"></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-token-bar origin-canvas-token-bar\u002d\u002d4","style":{"dimensions":{"minHeight":"44px"}}} -->
<div class="wp-block-group origin-canvas-token-bar origin-canvas-token-bar--4" style="min-height:44px"></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-token-bar origin-canvas-token-bar\u002d\u002d5","style":{"dimensions":{"minHeight":"58px"}}} -->
<div class="wp-block-group origin-canvas-token-bar origin-canvas-token-bar--5" style="min-height:58px"></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-token-bar origin-canvas-token-bar\u002d\u002d6","style":{"dimensions":{"minHeight":"74px"}}} -->
<div class="wp-block-group origin-canvas-token-bar origin-canvas-token-bar--6" style="min-height:74px"></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-token-bar origin-canvas-token-bar\u002d\u002d7","style":{"dimensions":{"minHeight":"92px"}}} -->
<div class="wp-block-group origin-canvas-token-bar origin-canvas-token-bar--7" style="min-height:92px"></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"border":{"top":{"color":"var:preset|color|base-5","width":"1px"}},"spacing":{"padding":{"top":"18px","right":"18px","bottom":"18px","left":"18px"},"blockGap":"14px"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="border-top-color:var(--wp--preset--color--base-5);border-top-width:1px;padding-top:18px;padding-right:18px;padding-bottom:18px;padding-left:18px"><!-- wp:paragraph {"style":{"typography":{"fontWeight":"600","letterSpacing":"0.06em","textTransform":"uppercase"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"contrast","fontSize":"extra-small"} -->
<p class="has-contrast-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:0;font-weight:600;letter-spacing:0.06em;text-transform:uppercase"><?php echo esc_html__( 'Typography &middot; sizes', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:group {"className":"origin-canvas-align-baseline","style":{"spacing":{"blockGap":"16px"}},"layout":{"type":"flex","flexWrap":"wrap"}} -->
<div class="wp-block-group origin-canvas-align-baseline"><!-- wp:paragraph {"style":{"typography":{"fontSize":"1.875rem","fontWeight":"700","letterSpacing":"-0.02em"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"contrast"} -->
<p class="has-contrast-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:1.875rem;font-weight:700;letter-spacing:-0.02em"><?php echo esc_html__( 'Aa', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"1.375rem","fontWeight":"700","letterSpacing":"-0.02em"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"contrast"} -->
<p class="has-contrast-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:1.375rem;font-weight:700;letter-spacing:-0.02em"><?php echo esc_html__( 'Aa', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"1.0625rem","fontWeight":"700","letterSpacing":"-0.02em"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"contrast"} -->
<p class="has-contrast-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:1.0625rem;font-weight:700;letter-spacing:-0.02em"><?php echo esc_html__( 'Aa', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"0.875rem","fontWeight":"700","letterSpacing":"-0.02em"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"contrast"} -->
<p class="has-contrast-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:0.875rem;font-weight:700;letter-spacing:-0.02em"><?php echo esc_html__( 'Aa', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"origin-canvas-mono","style":{"typography":{"fontSize":"0.8125rem"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"contrast-3"} -->
<p class="origin-canvas-mono has-contrast-3-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:0.8125rem"><?php echo esc_html__( 'display-xl &rarr; small', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->
