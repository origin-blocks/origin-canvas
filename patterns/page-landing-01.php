<?php
/**
 * Title: Landing Page
 * Slug: origin-canvas/page-landing-01
 * Description: The theme&#8217;s own marketing landing page: hero, pattern library, style variations, stats, templates, ecosystem, and closing call to action.
 * Categories: origin-canvas/page
 * Keywords: page, landing, marketing, theme, home
 * Viewport Width: 1500
 * Block Types:
 * Post Types:
 * Inserter: true
 *
 * @package Origin
 */

?>
<!-- wp:pattern {"slug":"origin-canvas/hero-canvas"} /-->
<!-- wp:group {"tagName":"section","align":"full","backgroundColor":"surface-subtle","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"var:preset|spacing|colossal","bottom":"var:preset|spacing|colossal"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-surface-subtle-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--colossal);padding-bottom:var(--wp--preset--spacing--colossal)"><!-- wp:group {"layout":{"type":"constrained","contentSize":"780px"}} -->
<div class="wp-block-group"><!-- wp:heading {"level":2,"style":{"typography":{"fontSize":"clamp(2rem, 3.8vw, 3rem)","fontWeight":"600","lineHeight":"1.2","letterSpacing":"-0.03em"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<h2 class="wp-block-heading" style="margin-top:0;margin-bottom:0;font-size:clamp(2rem, 3.8vw, 3rem);font-weight:600;letter-spacing:-0.03em;line-height:1.2"><?php echo wp_kses_post( __( 'Balanced type, deliberate spacing, flexible templates. <span class="has-inline-color has-text-muted-color">A clear design foundation from the first page, so the structure is already right before you write a word.</span>', 'origin-canvas' ) ); ?></h2>
<!-- /wp:heading --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"var:preset|spacing|colossal","bottom":"var:preset|spacing|colossal"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--colossal);padding-bottom:var(--wp--preset--spacing--colossal)"><!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","fontWeight":"600","letterSpacing":"0.08em"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|medium"}}},"textColor":"primary","fontSize":"extra-small"} -->
<p class="has-text-align-center has-primary-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--medium);font-weight:600;letter-spacing:0.08em;text-transform:uppercase"><?php echo esc_html__( 'Pattern library', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","level":2,"style":{"typography":{"fontSize":"clamp(2rem, 4vw, 2.75rem)"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|medium"}}}} -->
<h2 class="wp-block-heading has-text-align-center" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--medium);font-size:clamp(2rem, 4vw, 2.75rem)"><?php echo esc_html__( '62 patterns. 18 categories. One design language.', 'origin-canvas' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:group {"layout":{"type":"constrained","contentSize":"520px"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"align":"center","textColor":"text-body","fontSize":"regular-plus"} -->
<p class="has-text-align-center has-text-body-color has-text-color has-regular-plus-font-size"><?php echo esc_html__( 'Every pattern is built from core blocks and bound to the theme presets, so it drops in editable and on-brand. Assemble a full page in an afternoon, or start from a single section and grow.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"full","className":"origin-canvas-pattern-board","style":{"spacing":{"blockGap":"0"}},"layout":{"type":"default"}} -->
<div class="wp-block-group alignfull origin-canvas-pattern-board"><!-- wp:group {"className":"origin-canvas-wash-tile origin-canvas-wash-hero"} -->
<div class="wp-block-group origin-canvas-wash-tile origin-canvas-wash-hero"></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-wash-tile origin-canvas-wash-features"} -->
<div class="wp-block-group origin-canvas-wash-tile origin-canvas-wash-features"></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-wash-tile origin-canvas-wash-testimonial"} -->
<div class="wp-block-group origin-canvas-wash-tile origin-canvas-wash-testimonial"></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-wash-tile origin-canvas-wash-pricing"} -->
<div class="wp-block-group origin-canvas-wash-tile origin-canvas-wash-pricing"></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-wash-tile origin-canvas-wash-cta"} -->
<div class="wp-block-group origin-canvas-wash-tile origin-canvas-wash-cta"></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-wash-tile origin-canvas-wash-editor"} -->
<div class="wp-block-group origin-canvas-wash-tile origin-canvas-wash-editor"></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontWeight":"500"},"spacing":{"margin":{"top":"var:preset|spacing|extra-large","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|text-heading"},"typography":{"textDecoration":"none"}}}},"textColor":"text-heading","fontSize":"regular"} -->
<p class="has-text-align-center has-text-heading-color has-text-color has-link-color has-regular-font-size" style="margin-top:var(--wp--preset--spacing--extra-large);margin-bottom:0;font-weight:500"><a href="#" style="text-decoration:none"><?php echo esc_html__( 'Explore all patterns', 'origin-canvas' ); ?></a> <span class="has-primary-color has-text-color" style="color:var(--wp--preset--color--primary)" aria-hidden="true">&rarr;</span></p>
<!-- /wp:paragraph --></section>
<!-- /wp:group -->
<!-- wp:group {"tagName":"section","align":"full","backgroundColor":"surface-subtle","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"var:preset|spacing|colossal","bottom":"var:preset|spacing|colossal"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-surface-subtle-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--colossal);padding-bottom:var(--wp--preset--spacing--colossal)"><!-- wp:group {"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|huge"}}},"layout":{"type":"constrained","contentSize":"640px"}} -->
<div class="wp-block-group" style="margin-bottom:var(--wp--preset--spacing--huge)"><!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","fontWeight":"600","letterSpacing":"0.08em"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|medium"}}},"textColor":"primary","fontSize":"extra-small"} -->
<p class="has-text-align-center has-primary-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--medium);font-weight:600;letter-spacing:0.08em;text-transform:uppercase"><?php echo esc_html__( 'Style variations', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","level":2,"style":{"typography":{"fontSize":"clamp(2rem, 4vw, 2.75rem)"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|medium"}}}} -->
<h2 class="wp-block-heading has-text-align-center" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--medium);font-size:clamp(2rem, 4vw, 2.75rem)"><?php echo wp_kses_post( __( 'Eleven style variations.<br>One click to reskin.', 'origin-canvas' ) ); ?></h2>
<!-- /wp:heading -->

<!-- wp:group {"layout":{"type":"constrained","contentSize":"340px"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"1.0625rem"}},"textColor":"text-body"} -->
<p class="has-text-align-center has-text-body-color has-text-color" style="font-size:1.0625rem"><?php echo esc_html__( 'Swap the entire palette and type system from the editor. Patterns and templates follow automatically.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","layout":{"type":"default"}} -->
<div class="wp-block-group alignwide"><!-- wp:group {"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|medium"}}},"layout":{"type":"flex","justifyContent":"space-between","verticalAlignment":"bottom"}} -->
<div class="wp-block-group" style="margin-bottom:var(--wp--preset--spacing--medium)"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|compact"}},"layout":{"type":"flex","verticalAlignment":"bottom"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontSize":"0.75rem","fontWeight":"700","letterSpacing":"0.08em","textTransform":"uppercase"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading"} -->
<p class="has-text-heading-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:0.75rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase"><?php echo esc_html__( 'Full variations', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-muted","fontSize":"extra-small"} -->
<p class="has-text-muted-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Palette & type together', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"className":"origin-canvas-mono","style":{"typography":{"fontSize":"0.75rem"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-muted"} -->
<p class="origin-canvas-mono has-text-muted-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:0.75rem"><?php echo esc_html__( '3 variations', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"18px","left":"18px"}}}} -->
<div class="wp-block-columns"><!-- wp:column {"backgroundColor":"surface-base","borderColor":"border","style":{"border":{"radius":"var:custom|radius|medium","style":"solid","width":"1px"}}} -->
<div class="wp-block-column has-border-color has-border-border-color has-surface-base-background-color has-background" style="border-style:solid;border-width:1px;border-radius:var(--wp--custom--radius--medium)"><!-- wp:group {"style":{"border":{"bottom":{"color":"var:preset|color|border","width":"1px"}},"spacing":{"padding":{"top":"22px","right":"20px","bottom":"18px","left":"20px"},"blockGap":"10px"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="border-bottom-color:var(--wp--preset--color--border);border-bottom-width:1px;padding-top:22px;padding-right:20px;padding-bottom:18px;padding-left:20px"><!-- wp:paragraph {"style":{"color":{"text":"#111827"},"typography":{"fontSize":"2.625rem","fontWeight":"700","letterSpacing":"-0.02em","lineHeight":"1"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="has-text-color" style="color:#111827;margin-top:0;margin-bottom:0;font-size:2.625rem;font-weight:700;letter-spacing:-0.02em;line-height:1"><?php echo esc_html__( 'Ag', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"color":{"text":"#4B5563"},"typography":{"fontSize":"0.75rem"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="has-text-color" style="color:#4B5563;margin-top:0;margin-bottom:0;font-size:0.75rem"><?php echo esc_html__( 'Inter &middot; the default canvas', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"16px"},"blockGap":"7px"}},"layout":{"type":"flex"}} -->
<div class="wp-block-group" style="margin-top:16px"><!-- wp:group {"className":"origin-canvas-sw","style":{"color":{"background":"#111827"}}} -->
<div class="wp-block-group origin-canvas-sw has-background" style="background-color:#111827"></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-sw","style":{"color":{"background":"#FF4387"}}} -->
<div class="wp-block-group origin-canvas-sw has-background" style="background-color:#FF4387"></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-sw","style":{"color":{"background":"#EEF2F6"}}} -->
<div class="wp-block-group origin-canvas-sw has-background" style="background-color:#EEF2F6"></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-sw","style":{"color":{"background":"#FFFFFF"}}} -->
<div class="wp-block-group origin-canvas-sw has-background" style="background-color:#FFFFFF"></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"13px","right":"16px","bottom":"13px","left":"16px"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-top:13px;padding-right:16px;padding-bottom:13px;padding-left:16px"><!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading","fontSize":"extra-small"} -->
<p class="has-text-heading-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:0;font-weight:600"><?php echo esc_html__( 'Default', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"backgroundColor":"surface-base","borderColor":"border","style":{"border":{"radius":"var:custom|radius|medium","style":"solid","width":"1px"}}} -->
<div class="wp-block-column has-border-color has-border-border-color has-surface-base-background-color has-background" style="border-style:solid;border-width:1px;border-radius:var(--wp--custom--radius--medium)"><!-- wp:group {"style":{"border":{"bottom":{"color":"var:preset|color|border","width":"1px"}},"spacing":{"padding":{"top":"22px","right":"20px","bottom":"18px","left":"20px"},"blockGap":"10px"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="border-bottom-color:var(--wp--preset--color--border);border-bottom-width:1px;padding-top:22px;padding-right:20px;padding-bottom:18px;padding-left:20px"><!-- wp:paragraph {"className":"origin-canvas-specimen-serif","style":{"color":{"text":"#1C1917"},"typography":{"fontSize":"2.625rem","fontWeight":"700","letterSpacing":"-0.02em","lineHeight":"1"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="origin-canvas-specimen-serif has-text-color" style="color:#1C1917;margin-top:0;margin-bottom:0;font-size:2.625rem;font-weight:700;letter-spacing:-0.02em;line-height:1"><?php echo esc_html__( 'Ag', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"color":{"text":"#44403C"},"typography":{"fontSize":"0.75rem"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="has-text-color" style="color:#44403C;margin-top:0;margin-bottom:0;font-size:0.75rem"><?php echo esc_html__( 'Source Serif 4 &middot; warm paper & stone', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"16px"},"blockGap":"7px"}},"layout":{"type":"flex"}} -->
<div class="wp-block-group" style="margin-top:16px"><!-- wp:group {"className":"origin-canvas-sw","style":{"color":{"background":"#1C1917"}}} -->
<div class="wp-block-group origin-canvas-sw has-background" style="background-color:#1C1917"></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-sw","style":{"color":{"background":"#E8456B"}}} -->
<div class="wp-block-group origin-canvas-sw has-background" style="background-color:#E8456B"></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-sw","style":{"color":{"background":"#EFEDE8"}}} -->
<div class="wp-block-group origin-canvas-sw has-background" style="background-color:#EFEDE8"></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-sw","style":{"color":{"background":"#FAFAF8"}}} -->
<div class="wp-block-group origin-canvas-sw has-background" style="background-color:#FAFAF8"></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"13px","right":"16px","bottom":"13px","left":"16px"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-top:13px;padding-right:16px;padding-bottom:13px;padding-left:16px"><!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading","fontSize":"extra-small"} -->
<p class="has-text-heading-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:0;font-weight:600"><?php echo esc_html__( 'Editorial', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"backgroundColor":"surface-base","borderColor":"border","style":{"border":{"radius":"var:custom|radius|medium","style":"solid","width":"1px"}}} -->
<div class="wp-block-column has-border-color has-border-border-color has-surface-base-background-color has-background" style="border-style:solid;border-width:1px;border-radius:var(--wp--custom--radius--medium)"><!-- wp:group {"style":{"border":{"bottom":{"color":"var:preset|color|border","width":"1px"}},"spacing":{"padding":{"top":"22px","right":"20px","bottom":"18px","left":"20px"},"blockGap":"10px"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="border-bottom-color:var(--wp--preset--color--border);border-bottom-width:1px;padding-top:22px;padding-right:20px;padding-bottom:18px;padding-left:20px"><!-- wp:paragraph {"className":"origin-canvas-specimen-grotesk","style":{"color":{"text":"#030712"},"typography":{"fontSize":"2.625rem","fontWeight":"700","letterSpacing":"-0.02em","lineHeight":"1"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="origin-canvas-specimen-grotesk has-text-color" style="color:#030712;margin-top:0;margin-bottom:0;font-size:2.625rem;font-weight:700;letter-spacing:-0.02em;line-height:1"><?php echo esc_html__( 'Ag', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"color":{"text":"#374151"},"typography":{"fontSize":"0.75rem"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="has-text-color" style="color:#374151;margin-top:0;margin-bottom:0;font-size:0.75rem"><?php echo esc_html__( 'Space Grotesk &middot; orchid on cool gray', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"16px"},"blockGap":"7px"}},"layout":{"type":"flex"}} -->
<div class="wp-block-group" style="margin-top:16px"><!-- wp:group {"className":"origin-canvas-sw","style":{"color":{"background":"#030712"}}} -->
<div class="wp-block-group origin-canvas-sw has-background" style="background-color:#030712"></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-sw","style":{"color":{"background":"#D040E0"}}} -->
<div class="wp-block-group origin-canvas-sw has-background" style="background-color:#D040E0"></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-sw","style":{"color":{"background":"#F3F4F6"}}} -->
<div class="wp-block-group origin-canvas-sw has-background" style="background-color:#F3F4F6"></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-sw","style":{"color":{"background":"#FFFFFF"}}} -->
<div class="wp-block-group origin-canvas-sw has-background" style="background-color:#FFFFFF"></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"13px","right":"16px","bottom":"13px","left":"16px"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-top:13px;padding-right:16px;padding-bottom:13px;padding-left:16px"><!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading","fontSize":"extra-small"} -->
<p class="has-text-heading-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:0;font-weight:600"><?php echo esc_html__( 'Expressive', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"backgroundColor":"surface-base","borderColor":"border","style":{"border":{"radius":"var:custom|radius|medium","style":"solid","width":"1px"}}} -->
<div class="wp-block-column has-border-color has-border-border-color has-surface-base-background-color has-background" style="border-style:solid;border-width:1px;border-radius:var(--wp--custom--radius--medium)"><!-- wp:group {"style":{"border":{"bottom":{"color":"var:preset|color|border","width":"1px"}},"spacing":{"padding":{"top":"22px","right":"20px","bottom":"18px","left":"20px"},"blockGap":"10px"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="border-bottom-color:var(--wp--preset--color--border);border-bottom-width:1px;padding-top:22px;padding-right:20px;padding-bottom:18px;padding-left:20px"><!-- wp:paragraph {"className":"origin-canvas-specimen-dmsans","style":{"color":{"text":"#0F172A"},"typography":{"fontSize":"2.625rem","fontWeight":"700","letterSpacing":"-0.02em","lineHeight":"1"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="origin-canvas-specimen-dmsans has-text-color" style="color:#0F172A;margin-top:0;margin-bottom:0;font-size:2.625rem;font-weight:700;letter-spacing:-0.02em;line-height:1"><?php echo esc_html__( 'Ag', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"color":{"text":"#475569"},"typography":{"fontSize":"0.75rem"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="has-text-color" style="color:#475569;margin-top:0;margin-bottom:0;font-size:0.75rem"><?php echo esc_html__( 'DM Sans &middot; cool slate', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"16px"},"blockGap":"7px"}},"layout":{"type":"flex"}} -->
<div class="wp-block-group" style="margin-top:16px"><!-- wp:group {"className":"origin-canvas-sw","style":{"color":{"background":"#0F172A"}}} -->
<div class="wp-block-group origin-canvas-sw has-background" style="background-color:#0F172A"></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-sw","style":{"color":{"background":"#E8368C"}}} -->
<div class="wp-block-group origin-canvas-sw has-background" style="background-color:#E8368C"></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-sw","style":{"color":{"background":"#F1F5F9"}}} -->
<div class="wp-block-group origin-canvas-sw has-background" style="background-color:#F1F5F9"></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-sw","style":{"color":{"background":"#FFFFFF"}}} -->
<div class="wp-block-group origin-canvas-sw has-background" style="background-color:#FFFFFF"></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"13px","right":"16px","bottom":"13px","left":"16px"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-top:13px;padding-right:16px;padding-bottom:13px;padding-left:16px"><!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading","fontSize":"extra-small"} -->
<p class="has-text-heading-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:0;font-weight:600"><?php echo esc_html__( 'Refined Sans', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|extra-large"}}},"layout":{"type":"default"}} -->
<div class="wp-block-group alignwide" style="margin-top:var(--wp--preset--spacing--extra-large)"><!-- wp:group {"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|medium"}}},"layout":{"type":"flex","justifyContent":"space-between","verticalAlignment":"bottom"}} -->
<div class="wp-block-group" style="margin-bottom:var(--wp--preset--spacing--medium)"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|compact"}},"layout":{"type":"flex","verticalAlignment":"bottom"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontSize":"0.75rem","fontWeight":"700","letterSpacing":"0.08em","textTransform":"uppercase"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading"} -->
<p class="has-text-heading-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:0.75rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase"><?php echo esc_html__( 'Color presets', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-muted","fontSize":"extra-small"} -->
<p class="has-text-muted-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Default palette and type, primary only', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"className":"origin-canvas-mono","style":{"typography":{"fontSize":"0.75rem"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-muted"} -->
<p class="origin-canvas-mono has-text-muted-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:0.75rem"><?php echo esc_html__( '5 presets', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"16px","left":"16px"}}}} -->
<div class="wp-block-columns"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"backgroundColor":"surface-base","borderColor":"border","style":{"border":{"radius":"var:custom|radius|medium","style":"solid","width":"1px"},"spacing":{"padding":{"top":"15px","right":"16px","bottom":"15px","left":"16px"},"blockGap":"13px"}},"layout":{"type":"flex","verticalAlignment":"center"}} -->
<div class="wp-block-group has-border-color has-border-border-color has-surface-base-background-color has-background" style="border-style:solid;border-width:1px;border-radius:var(--wp--custom--radius--medium);padding-top:15px;padding-right:16px;padding-bottom:15px;padding-left:16px"><!-- wp:group {"className":"origin-canvas-preset-dot","style":{"color":{"background":"#2563EB"}}} -->
<div class="wp-block-group origin-canvas-preset-dot has-background" style="background-color:#2563EB"></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"2px"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading","fontSize":"small"} -->
<p class="has-text-heading-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:0;font-weight:600"><?php echo esc_html__( 'Blue', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"origin-canvas-mono","style":{"typography":{"fontSize":"0.75rem"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-muted"} -->
<p class="origin-canvas-mono has-text-muted-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:0.75rem"><?php echo esc_html__( '#2563EB', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"backgroundColor":"surface-base","borderColor":"border","style":{"border":{"radius":"var:custom|radius|medium","style":"solid","width":"1px"},"spacing":{"padding":{"top":"15px","right":"16px","bottom":"15px","left":"16px"},"blockGap":"13px"}},"layout":{"type":"flex","verticalAlignment":"center"}} -->
<div class="wp-block-group has-border-color has-border-border-color has-surface-base-background-color has-background" style="border-style:solid;border-width:1px;border-radius:var(--wp--custom--radius--medium);padding-top:15px;padding-right:16px;padding-bottom:15px;padding-left:16px"><!-- wp:group {"className":"origin-canvas-preset-dot","style":{"color":{"background":"#16A34A"}}} -->
<div class="wp-block-group origin-canvas-preset-dot has-background" style="background-color:#16A34A"></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"2px"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading","fontSize":"small"} -->
<p class="has-text-heading-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:0;font-weight:600"><?php echo esc_html__( 'Green', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"origin-canvas-mono","style":{"typography":{"fontSize":"0.75rem"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-muted"} -->
<p class="origin-canvas-mono has-text-muted-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:0.75rem"><?php echo esc_html__( '#16A34A', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"backgroundColor":"surface-base","borderColor":"border","style":{"border":{"radius":"var:custom|radius|medium","style":"solid","width":"1px"},"spacing":{"padding":{"top":"15px","right":"16px","bottom":"15px","left":"16px"},"blockGap":"13px"}},"layout":{"type":"flex","verticalAlignment":"center"}} -->
<div class="wp-block-group has-border-color has-border-border-color has-surface-base-background-color has-background" style="border-style:solid;border-width:1px;border-radius:var(--wp--custom--radius--medium);padding-top:15px;padding-right:16px;padding-bottom:15px;padding-left:16px"><!-- wp:group {"className":"origin-canvas-preset-dot","style":{"color":{"background":"#EA580C"}}} -->
<div class="wp-block-group origin-canvas-preset-dot has-background" style="background-color:#EA580C"></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"2px"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading","fontSize":"small"} -->
<p class="has-text-heading-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:0;font-weight:600"><?php echo esc_html__( 'Orange', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"origin-canvas-mono","style":{"typography":{"fontSize":"0.75rem"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-muted"} -->
<p class="origin-canvas-mono has-text-muted-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:0.75rem"><?php echo esc_html__( '#EA580C', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"backgroundColor":"surface-base","borderColor":"border","style":{"border":{"radius":"var:custom|radius|medium","style":"solid","width":"1px"},"spacing":{"padding":{"top":"15px","right":"16px","bottom":"15px","left":"16px"},"blockGap":"13px"}},"layout":{"type":"flex","verticalAlignment":"center"}} -->
<div class="wp-block-group has-border-color has-border-border-color has-surface-base-background-color has-background" style="border-style:solid;border-width:1px;border-radius:var(--wp--custom--radius--medium);padding-top:15px;padding-right:16px;padding-bottom:15px;padding-left:16px"><!-- wp:group {"className":"origin-canvas-preset-dot","style":{"color":{"background":"#7C3AED"}}} -->
<div class="wp-block-group origin-canvas-preset-dot has-background" style="background-color:#7C3AED"></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"2px"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading","fontSize":"small"} -->
<p class="has-text-heading-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:0;font-weight:600"><?php echo esc_html__( 'Purple', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"origin-canvas-mono","style":{"typography":{"fontSize":"0.75rem"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-muted"} -->
<p class="origin-canvas-mono has-text-muted-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:0.75rem"><?php echo esc_html__( '#7C3AED', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"backgroundColor":"surface-base","borderColor":"border","style":{"border":{"radius":"var:custom|radius|medium","style":"solid","width":"1px"},"spacing":{"padding":{"top":"15px","right":"16px","bottom":"15px","left":"16px"},"blockGap":"13px"}},"layout":{"type":"flex","verticalAlignment":"center"}} -->
<div class="wp-block-group has-border-color has-border-border-color has-surface-base-background-color has-background" style="border-style:solid;border-width:1px;border-radius:var(--wp--custom--radius--medium);padding-top:15px;padding-right:16px;padding-bottom:15px;padding-left:16px"><!-- wp:group {"className":"origin-canvas-preset-dot","style":{"color":{"background":"#DC2626"}}} -->
<div class="wp-block-group origin-canvas-preset-dot has-background" style="background-color:#DC2626"></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"2px"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading","fontSize":"small"} -->
<p class="has-text-heading-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:0;font-weight:600"><?php echo esc_html__( 'Red', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"origin-canvas-mono","style":{"typography":{"fontSize":"0.75rem"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-muted"} -->
<p class="origin-canvas-mono has-text-muted-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:0.75rem"><?php echo esc_html__( '#DC2626', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|extra-large"}}},"layout":{"type":"default"}} -->
<div class="wp-block-group alignwide" style="margin-top:var(--wp--preset--spacing--extra-large)"><!-- wp:group {"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|medium"}}},"layout":{"type":"flex","justifyContent":"space-between","verticalAlignment":"bottom"}} -->
<div class="wp-block-group" style="margin-bottom:var(--wp--preset--spacing--medium)"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|compact"}},"layout":{"type":"flex","verticalAlignment":"bottom"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontSize":"0.75rem","fontWeight":"700","letterSpacing":"0.08em","textTransform":"uppercase"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading"} -->
<p class="has-text-heading-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:0.75rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase"><?php echo esc_html__( 'Typography presets', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-muted","fontSize":"extra-small"} -->
<p class="has-text-muted-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Default palette kept, type only', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"className":"origin-canvas-mono","style":{"typography":{"fontSize":"0.75rem"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-muted"} -->
<p class="origin-canvas-mono has-text-muted-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:0.75rem"><?php echo esc_html__( '3 presets', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"18px","left":"18px"}}}} -->
<div class="wp-block-columns"><!-- wp:column {"backgroundColor":"surface-base","borderColor":"border","style":{"border":{"radius":"var:custom|radius|medium","style":"solid","width":"1px"},"spacing":{"padding":{"top":"22px","right":"22px","bottom":"20px","left":"22px"}}}} -->
<div class="wp-block-column has-border-color has-border-border-color has-surface-base-background-color has-background" style="border-style:solid;border-width:1px;border-radius:var(--wp--custom--radius--medium);padding-top:22px;padding-right:22px;padding-bottom:20px;padding-left:22px"><!-- wp:paragraph {"className":"origin-canvas-specimen-dmsans","style":{"typography":{"fontSize":"3rem","fontWeight":"700","letterSpacing":"-0.015em","lineHeight":"1"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading"} -->
<p class="origin-canvas-specimen-dmsans has-text-heading-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:3rem;font-weight:700;letter-spacing:-0.015em;line-height:1"><?php echo esc_html__( 'Ag', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"},"spacing":{"margin":{"top":"18px","bottom":"0"}}},"textColor":"text-heading","fontSize":"small"} -->
<p class="has-text-heading-color has-text-color has-small-font-size" style="margin-top:18px;margin-bottom:0;font-weight:600"><?php echo esc_html__( 'DM Sans', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"lineHeight":"1.5"},"spacing":{"margin":{"top":"5px","bottom":"0"}}},"textColor":"text-body","fontSize":"extra-small"} -->
<p class="has-text-body-color has-text-color has-extra-small-font-size" style="margin-top:5px;margin-bottom:0;line-height:1.5"><?php echo esc_html__( 'DM Sans body & headings &middot; 700 headings, tight tracking', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"backgroundColor":"surface-base","borderColor":"border","style":{"border":{"radius":"var:custom|radius|medium","style":"solid","width":"1px"},"spacing":{"padding":{"top":"22px","right":"22px","bottom":"20px","left":"22px"}}}} -->
<div class="wp-block-column has-border-color has-border-border-color has-surface-base-background-color has-background" style="border-style:solid;border-width:1px;border-radius:var(--wp--custom--radius--medium);padding-top:22px;padding-right:22px;padding-bottom:20px;padding-left:22px"><!-- wp:paragraph {"className":"origin-canvas-specimen-serif","style":{"typography":{"fontSize":"3rem","fontWeight":"700","lineHeight":"1"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading"} -->
<p class="origin-canvas-specimen-serif has-text-heading-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:3rem;font-weight:700;line-height:1"><?php echo esc_html__( 'Ag', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"},"spacing":{"margin":{"top":"18px","bottom":"0"}}},"textColor":"text-heading","fontSize":"small"} -->
<p class="has-text-heading-color has-text-color has-small-font-size" style="margin-top:18px;margin-bottom:0;font-weight:600"><?php echo esc_html__( 'Serif Headings', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"lineHeight":"1.5"},"spacing":{"margin":{"top":"5px","bottom":"0"}}},"textColor":"text-body","fontSize":"extra-small"} -->
<p class="has-text-body-color has-text-color has-extra-small-font-size" style="margin-top:5px;margin-bottom:0;line-height:1.5"><?php echo esc_html__( 'Source Serif 4 headings over Inter &middot; looser body leading', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"backgroundColor":"surface-base","borderColor":"border","style":{"border":{"radius":"var:custom|radius|medium","style":"solid","width":"1px"},"spacing":{"padding":{"top":"22px","right":"22px","bottom":"20px","left":"22px"}}}} -->
<div class="wp-block-column has-border-color has-border-border-color has-surface-base-background-color has-background" style="border-style:solid;border-width:1px;border-radius:var(--wp--custom--radius--medium);padding-top:22px;padding-right:22px;padding-bottom:20px;padding-left:22px"><!-- wp:paragraph {"className":"origin-canvas-specimen-grotesk","style":{"typography":{"fontSize":"3rem","fontWeight":"700","lineHeight":"1"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading"} -->
<p class="origin-canvas-specimen-grotesk has-text-heading-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:3rem;font-weight:700;line-height:1"><?php echo esc_html__( 'Ag', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"},"spacing":{"margin":{"top":"18px","bottom":"0"}}},"textColor":"text-heading","fontSize":"small"} -->
<p class="has-text-heading-color has-text-color has-small-font-size" style="margin-top:18px;margin-bottom:0;font-weight:600"><?php echo esc_html__( 'Space Grotesk', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"lineHeight":"1.5"},"spacing":{"margin":{"top":"5px","bottom":"0"}}},"textColor":"text-body","fontSize":"extra-small"} -->
<p class="has-text-body-color has-text-color has-extra-small-font-size" style="margin-top:5px;margin-bottom:0;line-height:1.5"><?php echo esc_html__( 'Space Grotesk headings &middot; bumped display scale', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|extra-large"}}},"layout":{"type":"default"}} -->
<div class="wp-block-group alignwide" style="margin-top:var(--wp--preset--spacing--extra-large)"><!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-muted","fontSize":"small"} -->
<p class="has-text-muted-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Color and typography presets mix and match in the editor&#8217;s Styles panel. Combine any color preset with any type preset, or apply a full variation in one click.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
<!-- wp:group {"tagName":"section","align":"full","style":{"color":{"background":"var(--wp--custom--dark--bg)","text":"var(--wp--custom--dark--text)"},"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"var:preset|spacing|colossal","bottom":"var:preset|spacing|colossal"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-text-color has-background" style="color:var(--wp--custom--dark--text);background-color:var(--wp--custom--dark--bg);margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--colossal);padding-bottom:var(--wp--preset--spacing--colossal)"><!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","fontWeight":"600","letterSpacing":"0.08em"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|large"}},"color":{"text":"color-mix(in srgb, var(--wp--custom--dark--text) 50%, transparent)"}},"fontSize":"extra-small"} -->
<p class="has-text-align-center has-text-color has-extra-small-font-size" style="color:color-mix(in srgb, var(--wp--custom--dark--text) 50%, transparent);margin-top:0;margin-bottom:var(--wp--preset--spacing--large);font-weight:600;letter-spacing:0.08em;text-transform:uppercase"><?php echo esc_html__( 'One coherent system', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"clamp(1.8rem, 3.6vw, 2.6rem)","fontWeight":"600","lineHeight":"1.25","letterSpacing":"-0.02em"},"spacing":{"margin":{"top":"0","right":"auto","bottom":"var:preset|spacing|colossal","left":"auto"}}}} -->
<p class="has-text-align-center" style="margin-top:0;margin-right:auto;margin-bottom:var(--wp--preset--spacing--colossal);margin-left:auto;font-size:clamp(1.8rem, 3.6vw, 2.6rem);font-weight:600;letter-spacing:-0.02em;line-height:1.25"><?php echo wp_kses_post( __( 'Everything in Origin Canvas references the same presets. <span style="color:color-mix(in srgb, var(--wp--custom--dark--text) 50%, transparent)">Change one token and the whole site moves with it.</span>', 'origin-canvas' ) ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:columns {"align":"wide","style":{"border":{"top":{"color":"color-mix(in srgb, var(--wp--custom--dark--text) 14%, transparent)","width":"1px"}},"spacing":{"padding":{"top":"var:preset|spacing|huge"},"blockGap":{"top":"var:preset|spacing|large","left":"var:preset|spacing|large"}}}} -->
<div class="wp-block-columns alignwide" style="border-top-color:color-mix(in srgb, var(--wp--custom--dark--text) 14%, transparent);border-top-width:1px;padding-top:var(--wp--preset--spacing--huge)"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:paragraph {"align":"center","style":{"typography":{"fontWeight":"600","lineHeight":"1","letterSpacing":"0"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|medium"}}},"textColor":"primary","fontSize":"display-2xl"} -->
<p class="has-text-align-center has-primary-color has-text-color has-display-2-xl-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--medium);font-weight:600;letter-spacing:0;line-height:1"><?php echo esc_html__( '62', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","style":{"color":{"text":"color-mix(in srgb, var(--wp--custom--dark--text) 65%, transparent)"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"fontSize":"small"} -->
<p class="has-text-align-center has-text-color has-small-font-size" style="color:color-mix(in srgb, var(--wp--custom--dark--text) 65%, transparent);margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Block patterns', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:paragraph {"align":"center","style":{"typography":{"fontWeight":"600","lineHeight":"1","letterSpacing":"0"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|medium"}}},"textColor":"primary","fontSize":"display-2xl"} -->
<p class="has-text-align-center has-primary-color has-text-color has-display-2-xl-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--medium);font-weight:600;letter-spacing:0;line-height:1"><?php echo esc_html__( '11', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","style":{"color":{"text":"color-mix(in srgb, var(--wp--custom--dark--text) 65%, transparent)"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"fontSize":"small"} -->
<p class="has-text-align-center has-text-color has-small-font-size" style="color:color-mix(in srgb, var(--wp--custom--dark--text) 65%, transparent);margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Style variations', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:paragraph {"align":"center","style":{"typography":{"fontWeight":"600","lineHeight":"1","letterSpacing":"0"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|medium"}}},"textColor":"primary","fontSize":"display-2xl"} -->
<p class="has-text-align-center has-primary-color has-text-color has-display-2-xl-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--medium);font-weight:600;letter-spacing:0;line-height:1"><?php echo esc_html__( '12', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","style":{"color":{"text":"color-mix(in srgb, var(--wp--custom--dark--text) 65%, transparent)"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"fontSize":"small"} -->
<p class="has-text-align-center has-text-color has-small-font-size" style="color:color-mix(in srgb, var(--wp--custom--dark--text) 65%, transparent);margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Templates', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:paragraph {"align":"center","style":{"typography":{"fontWeight":"600","lineHeight":"1","letterSpacing":"0"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|medium"}}},"textColor":"primary","fontSize":"display-2xl"} -->
<p class="has-text-align-center has-primary-color has-text-color has-display-2-xl-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--medium);font-weight:600;letter-spacing:0;line-height:1"><?php echo esc_html__( '1', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","style":{"color":{"text":"color-mix(in srgb, var(--wp--custom--dark--text) 65%, transparent)"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"fontSize":"small"} -->
<p class="has-text-align-center has-text-color has-small-font-size" style="color:color-mix(in srgb, var(--wp--custom--dark--text) 65%, transparent);margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Coherent system', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->
