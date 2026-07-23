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
<div class="wp-block-group alignfull origin-canvas-pattern-board"><!-- wp:group {"className":"origin-canvas-wash-tile origin-canvas-wash-hero","style":{"dimensions":{"minHeight":"240px"}}} -->
<div class="wp-block-group origin-canvas-wash-tile origin-canvas-wash-hero" style="min-height:240px"></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-wash-tile origin-canvas-wash-features","style":{"dimensions":{"minHeight":"240px"}}} -->
<div class="wp-block-group origin-canvas-wash-tile origin-canvas-wash-features" style="min-height:240px"></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-wash-tile origin-canvas-wash-testimonial","style":{"dimensions":{"minHeight":"240px"}}} -->
<div class="wp-block-group origin-canvas-wash-tile origin-canvas-wash-testimonial" style="min-height:240px"></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-wash-tile origin-canvas-wash-pricing","style":{"dimensions":{"minHeight":"240px"}}} -->
<div class="wp-block-group origin-canvas-wash-tile origin-canvas-wash-pricing" style="min-height:240px"></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-wash-tile origin-canvas-wash-cta","style":{"dimensions":{"minHeight":"240px"}}} -->
<div class="wp-block-group origin-canvas-wash-tile origin-canvas-wash-cta" style="min-height:240px"></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-wash-tile origin-canvas-wash-editor","style":{"dimensions":{"minHeight":"240px"}}} -->
<div class="wp-block-group origin-canvas-wash-tile origin-canvas-wash-editor" style="min-height:240px"></div>
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
<div class="wp-block-group" style="margin-top:16px"><!-- wp:group {"className":"origin-canvas-sw","style":{"color":{"background":"#111827"},"dimensions":{"minHeight":"20px"}}} -->
<div class="wp-block-group origin-canvas-sw has-background" style="background-color:#111827;min-height:20px"></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-sw","style":{"color":{"background":"#FF4387"},"dimensions":{"minHeight":"20px"}}} -->
<div class="wp-block-group origin-canvas-sw has-background" style="background-color:#FF4387;min-height:20px"></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-sw","style":{"color":{"background":"#EEF2F6"},"dimensions":{"minHeight":"20px"}}} -->
<div class="wp-block-group origin-canvas-sw has-background" style="background-color:#EEF2F6;min-height:20px"></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-sw","style":{"color":{"background":"#FFFFFF"},"dimensions":{"minHeight":"20px"}}} -->
<div class="wp-block-group origin-canvas-sw has-background" style="background-color:#FFFFFF;min-height:20px"></div>
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
<div class="wp-block-group" style="margin-top:16px"><!-- wp:group {"className":"origin-canvas-sw","style":{"color":{"background":"#1C1917"},"dimensions":{"minHeight":"20px"}}} -->
<div class="wp-block-group origin-canvas-sw has-background" style="background-color:#1C1917;min-height:20px"></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-sw","style":{"color":{"background":"#E8456B"},"dimensions":{"minHeight":"20px"}}} -->
<div class="wp-block-group origin-canvas-sw has-background" style="background-color:#E8456B;min-height:20px"></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-sw","style":{"color":{"background":"#EFEDE8"},"dimensions":{"minHeight":"20px"}}} -->
<div class="wp-block-group origin-canvas-sw has-background" style="background-color:#EFEDE8;min-height:20px"></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-sw","style":{"color":{"background":"#FAFAF8"},"dimensions":{"minHeight":"20px"}}} -->
<div class="wp-block-group origin-canvas-sw has-background" style="background-color:#FAFAF8;min-height:20px"></div>
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
<div class="wp-block-group" style="margin-top:16px"><!-- wp:group {"className":"origin-canvas-sw","style":{"color":{"background":"#030712"},"dimensions":{"minHeight":"20px"}}} -->
<div class="wp-block-group origin-canvas-sw has-background" style="background-color:#030712;min-height:20px"></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-sw","style":{"color":{"background":"#D040E0"},"dimensions":{"minHeight":"20px"}}} -->
<div class="wp-block-group origin-canvas-sw has-background" style="background-color:#D040E0;min-height:20px"></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-sw","style":{"color":{"background":"#F3F4F6"},"dimensions":{"minHeight":"20px"}}} -->
<div class="wp-block-group origin-canvas-sw has-background" style="background-color:#F3F4F6;min-height:20px"></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-sw","style":{"color":{"background":"#FFFFFF"},"dimensions":{"minHeight":"20px"}}} -->
<div class="wp-block-group origin-canvas-sw has-background" style="background-color:#FFFFFF;min-height:20px"></div>
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
<div class="wp-block-group" style="margin-top:16px"><!-- wp:group {"className":"origin-canvas-sw","style":{"color":{"background":"#0F172A"},"dimensions":{"minHeight":"20px"}}} -->
<div class="wp-block-group origin-canvas-sw has-background" style="background-color:#0F172A;min-height:20px"></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-sw","style":{"color":{"background":"#E8368C"},"dimensions":{"minHeight":"20px"}}} -->
<div class="wp-block-group origin-canvas-sw has-background" style="background-color:#E8368C;min-height:20px"></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-sw","style":{"color":{"background":"#F1F5F9"},"dimensions":{"minHeight":"20px"}}} -->
<div class="wp-block-group origin-canvas-sw has-background" style="background-color:#F1F5F9;min-height:20px"></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-sw","style":{"color":{"background":"#FFFFFF"},"dimensions":{"minHeight":"20px"}}} -->
<div class="wp-block-group origin-canvas-sw has-background" style="background-color:#FFFFFF;min-height:20px"></div>
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
<div class="wp-block-group has-border-color has-border-border-color has-surface-base-background-color has-background" style="border-style:solid;border-width:1px;border-radius:var(--wp--custom--radius--medium);padding-top:15px;padding-right:16px;padding-bottom:15px;padding-left:16px"><!-- wp:group {"className":"origin-canvas-preset-dot","style":{"color":{"background":"#2563EB"},"dimensions":{"minHeight":"38px"}}} -->
<div class="wp-block-group origin-canvas-preset-dot has-background" style="background-color:#2563EB;min-height:38px"></div>
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
<div class="wp-block-group has-border-color has-border-border-color has-surface-base-background-color has-background" style="border-style:solid;border-width:1px;border-radius:var(--wp--custom--radius--medium);padding-top:15px;padding-right:16px;padding-bottom:15px;padding-left:16px"><!-- wp:group {"className":"origin-canvas-preset-dot","style":{"color":{"background":"#16A34A"},"dimensions":{"minHeight":"38px"}}} -->
<div class="wp-block-group origin-canvas-preset-dot has-background" style="background-color:#16A34A;min-height:38px"></div>
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
<div class="wp-block-group has-border-color has-border-border-color has-surface-base-background-color has-background" style="border-style:solid;border-width:1px;border-radius:var(--wp--custom--radius--medium);padding-top:15px;padding-right:16px;padding-bottom:15px;padding-left:16px"><!-- wp:group {"className":"origin-canvas-preset-dot","style":{"color":{"background":"#EA580C"},"dimensions":{"minHeight":"38px"}}} -->
<div class="wp-block-group origin-canvas-preset-dot has-background" style="background-color:#EA580C;min-height:38px"></div>
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
<div class="wp-block-group has-border-color has-border-border-color has-surface-base-background-color has-background" style="border-style:solid;border-width:1px;border-radius:var(--wp--custom--radius--medium);padding-top:15px;padding-right:16px;padding-bottom:15px;padding-left:16px"><!-- wp:group {"className":"origin-canvas-preset-dot","style":{"color":{"background":"#7C3AED"},"dimensions":{"minHeight":"38px"}}} -->
<div class="wp-block-group origin-canvas-preset-dot has-background" style="background-color:#7C3AED;min-height:38px"></div>
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
<div class="wp-block-group has-border-color has-border-border-color has-surface-base-background-color has-background" style="border-style:solid;border-width:1px;border-radius:var(--wp--custom--radius--medium);padding-top:15px;padding-right:16px;padding-bottom:15px;padding-left:16px"><!-- wp:group {"className":"origin-canvas-preset-dot","style":{"color":{"background":"#DC2626"},"dimensions":{"minHeight":"38px"}}} -->
<div class="wp-block-group origin-canvas-preset-dot has-background" style="background-color:#DC2626;min-height:38px"></div>
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
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"var:preset|spacing|colossal","bottom":"var:preset|spacing|colossal"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--colossal);padding-bottom:var(--wp--preset--spacing--colossal)"><!-- wp:group {"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|huge"}}},"layout":{"type":"constrained","contentSize":"680px"}} -->
<div class="wp-block-group" style="margin-bottom:var(--wp--preset--spacing--huge)"><!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","fontWeight":"600","letterSpacing":"0.08em"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|medium"}}},"textColor":"primary","fontSize":"extra-small"} -->
<p class="has-text-align-center has-primary-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--medium);font-weight:600;letter-spacing:0.08em;text-transform:uppercase"><?php echo esc_html__( 'Templates', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","level":2,"style":{"typography":{"fontSize":"clamp(2rem, 4vw, 2.75rem)"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|medium"}}}} -->
<h2 class="wp-block-heading has-text-align-center" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--medium);font-size:clamp(2rem, 4vw, 2.75rem)"><?php echo esc_html__( 'Every template, ready to shape in the editor.', 'origin-canvas' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:group {"layout":{"type":"constrained","contentSize":"520px"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"0.9375rem","lineHeight":"1.55"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|compact"}}},"textColor":"text-body"} -->
<p class="has-text-align-center has-text-body-color has-text-color" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--compact);font-size:0.9375rem;line-height:1.55"><?php echo esc_html__( 'Twelve templates cover the whole site. Open any one in the Site Editor and rearrange it block by block.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"0.9375rem","fontWeight":"500"},"spacing":{"margin":{"top":"0","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|text-heading"},"typography":{"textDecoration":"none"}}}},"textColor":"text-heading"} -->
<p class="has-text-align-center has-text-heading-color has-text-color has-link-color" style="margin-top:0;margin-bottom:0;font-size:0.9375rem;font-weight:500"><a href="#" style="text-decoration:none"><?php echo esc_html__( 'Open the Site Editor tour', 'origin-canvas' ); ?></a> <span class="has-primary-color has-text-color" style="color:var(--wp--preset--color--primary)" aria-hidden="true">&rarr;</span></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"top":"20px","left":"20px"}}}} -->
<div class="wp-block-columns alignwide"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"className":"origin-canvas-wire","style":{"spacing":{"blockGap":"0"}}} -->
<div class="wp-block-group origin-canvas-wire"><!-- wp:group {"className":"origin-canvas-wire-head","style":{"dimensions":{"minHeight":"18px"}}} -->
<div class="wp-block-group origin-canvas-wire-head" style="min-height:18px"></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-wire-body origin-canvas-wire-body--center","style":{"spacing":{"blockGap":"0"}}} -->
<div class="wp-block-group origin-canvas-wire-body origin-canvas-wire-body--center"><!-- wp:group {"className":"origin-canvas-wire-blk origin-canvas-wire-blk--w60","style":{"dimensions":{"minHeight":"18px"}}} -->
<div class="wp-block-group origin-canvas-wire-blk origin-canvas-wire-blk--w60" style="min-height:18px"></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"13px"}}},"layout":{"type":"flex","justifyContent":"space-between","verticalAlignment":"bottom"}} -->
<div class="wp-block-group" style="margin-top:13px"><!-- wp:paragraph {"style":{"typography":{"fontSize":"0.9375rem","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading"} -->
<p class="has-text-heading-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:0.9375rem;font-weight:600"><?php echo esc_html__( 'Single Post', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"origin-canvas-mono","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-muted","fontSize":"extra-small"} -->
<p class="origin-canvas-mono has-text-muted-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'single', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"className":"origin-canvas-wire","style":{"spacing":{"blockGap":"0"}}} -->
<div class="wp-block-group origin-canvas-wire"><!-- wp:group {"className":"origin-canvas-wire-head","style":{"dimensions":{"minHeight":"18px"}}} -->
<div class="wp-block-group origin-canvas-wire-head" style="min-height:18px"></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-wire-body","style":{"spacing":{"blockGap":"0"}}} -->
<div class="wp-block-group origin-canvas-wire-body"><!-- wp:group {"className":"origin-canvas-wire-blk origin-canvas-wire-blk--grow2","style":{"dimensions":{"minHeight":"18px"}}} -->
<div class="wp-block-group origin-canvas-wire-blk origin-canvas-wire-blk--grow2" style="min-height:18px"></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-wire-blk origin-canvas-wire-blk--alt","style":{"dimensions":{"minHeight":"18px"}}} -->
<div class="wp-block-group origin-canvas-wire-blk origin-canvas-wire-blk--alt" style="min-height:18px"></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"13px"}}},"layout":{"type":"flex","justifyContent":"space-between","verticalAlignment":"bottom"}} -->
<div class="wp-block-group" style="margin-top:13px"><!-- wp:paragraph {"style":{"typography":{"fontSize":"0.9375rem","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading"} -->
<p class="has-text-heading-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:0.9375rem;font-weight:600"><?php echo esc_html__( 'Right Sidebar', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"origin-canvas-mono","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-muted","fontSize":"extra-small"} -->
<p class="origin-canvas-mono has-text-muted-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'page-right-sidebar', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"className":"origin-canvas-wire","style":{"spacing":{"blockGap":"0"}}} -->
<div class="wp-block-group origin-canvas-wire"><!-- wp:group {"className":"origin-canvas-wire-head","style":{"dimensions":{"minHeight":"18px"}}} -->
<div class="wp-block-group origin-canvas-wire-head" style="min-height:18px"></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-wire-body","style":{"spacing":{"blockGap":"0"}}} -->
<div class="wp-block-group origin-canvas-wire-body"><!-- wp:group {"className":"origin-canvas-wire-blk origin-canvas-wire-blk--alt","style":{"dimensions":{"minHeight":"18px"}}} -->
<div class="wp-block-group origin-canvas-wire-blk origin-canvas-wire-blk--alt" style="min-height:18px"></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-wire-blk origin-canvas-wire-blk--grow2","style":{"dimensions":{"minHeight":"18px"}}} -->
<div class="wp-block-group origin-canvas-wire-blk origin-canvas-wire-blk--grow2" style="min-height:18px"></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"13px"}}},"layout":{"type":"flex","justifyContent":"space-between","verticalAlignment":"bottom"}} -->
<div class="wp-block-group" style="margin-top:13px"><!-- wp:paragraph {"style":{"typography":{"fontSize":"0.9375rem","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading"} -->
<p class="has-text-heading-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:0.9375rem;font-weight:600"><?php echo esc_html__( 'Left Sidebar', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"origin-canvas-mono","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-muted","fontSize":"extra-small"} -->
<p class="origin-canvas-mono has-text-muted-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'page-left-sidebar', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:columns {"align":"wide","style":{"spacing":{"margin":{"top":"20px"},"blockGap":{"top":"20px","left":"20px"}}}} -->
<div class="wp-block-columns alignwide" style="margin-top:20px"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"className":"origin-canvas-wire","style":{"spacing":{"blockGap":"0"}}} -->
<div class="wp-block-group origin-canvas-wire"><!-- wp:group {"className":"origin-canvas-wire-head","style":{"dimensions":{"minHeight":"18px"}}} -->
<div class="wp-block-group origin-canvas-wire-head" style="min-height:18px"></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-wire-body","style":{"spacing":{"blockGap":"0"}}} -->
<div class="wp-block-group origin-canvas-wire-body"><!-- wp:group {"className":"origin-canvas-wire-blk","style":{"dimensions":{"minHeight":"18px"}}} -->
<div class="wp-block-group origin-canvas-wire-blk" style="min-height:18px"></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"13px"}}},"layout":{"type":"flex","justifyContent":"space-between","verticalAlignment":"bottom"}} -->
<div class="wp-block-group" style="margin-top:13px"><!-- wp:paragraph {"style":{"typography":{"fontSize":"0.9375rem","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading"} -->
<p class="has-text-heading-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:0.9375rem;font-weight:600"><?php echo esc_html__( 'Page, Wide', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"origin-canvas-mono","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-muted","fontSize":"extra-small"} -->
<p class="origin-canvas-mono has-text-muted-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'page-wide', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"className":"origin-canvas-wire","style":{"spacing":{"blockGap":"0"}}} -->
<div class="wp-block-group origin-canvas-wire"><!-- wp:group {"className":"origin-canvas-wire-head","style":{"dimensions":{"minHeight":"18px"}}} -->
<div class="wp-block-group origin-canvas-wire-head" style="min-height:18px"></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-wire-body origin-canvas-wire-body--grid","style":{"spacing":{"blockGap":"0"}}} -->
<div class="wp-block-group origin-canvas-wire-body origin-canvas-wire-body--grid"><!-- wp:group {"className":"origin-canvas-wire-blk","style":{"dimensions":{"minHeight":"18px"}}} -->
<div class="wp-block-group origin-canvas-wire-blk" style="min-height:18px"></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-wire-blk","style":{"dimensions":{"minHeight":"18px"}}} -->
<div class="wp-block-group origin-canvas-wire-blk" style="min-height:18px"></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-wire-blk","style":{"dimensions":{"minHeight":"18px"}}} -->
<div class="wp-block-group origin-canvas-wire-blk" style="min-height:18px"></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-wire-blk","style":{"dimensions":{"minHeight":"18px"}}} -->
<div class="wp-block-group origin-canvas-wire-blk" style="min-height:18px"></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"13px"}}},"layout":{"type":"flex","justifyContent":"space-between","verticalAlignment":"bottom"}} -->
<div class="wp-block-group" style="margin-top:13px"><!-- wp:paragraph {"style":{"typography":{"fontSize":"0.9375rem","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading"} -->
<p class="has-text-heading-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:0.9375rem;font-weight:600"><?php echo esc_html__( 'Archive', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"origin-canvas-mono","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-muted","fontSize":"extra-small"} -->
<p class="origin-canvas-mono has-text-muted-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'archive', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"className":"origin-canvas-wire","style":{"spacing":{"blockGap":"0"}}} -->
<div class="wp-block-group origin-canvas-wire"><!-- wp:group {"className":"origin-canvas-wire-head","style":{"dimensions":{"minHeight":"18px"}}} -->
<div class="wp-block-group origin-canvas-wire-head" style="min-height:18px"></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-wire-body origin-canvas-wire-body--col","style":{"spacing":{"blockGap":"0"}}} -->
<div class="wp-block-group origin-canvas-wire-body origin-canvas-wire-body--col"><!-- wp:group {"className":"origin-canvas-wire-blk","style":{"dimensions":{"minHeight":"18px"}}} -->
<div class="wp-block-group origin-canvas-wire-blk" style="min-height:18px"></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-wire-blk","style":{"dimensions":{"minHeight":"18px"}}} -->
<div class="wp-block-group origin-canvas-wire-blk" style="min-height:18px"></div>
<!-- /wp:group -->

<!-- wp:group {"className":"origin-canvas-wire-blk","style":{"dimensions":{"minHeight":"18px"}}} -->
<div class="wp-block-group origin-canvas-wire-blk" style="min-height:18px"></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"13px"}}},"layout":{"type":"flex","justifyContent":"space-between","verticalAlignment":"bottom"}} -->
<div class="wp-block-group" style="margin-top:13px"><!-- wp:paragraph {"style":{"typography":{"fontSize":"0.9375rem","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading"} -->
<p class="has-text-heading-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:0.9375rem;font-weight:600"><?php echo esc_html__( 'Home / Blog', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"origin-canvas-mono","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-muted","fontSize":"extra-small"} -->
<p class="origin-canvas-mono has-text-muted-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'index', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:group {"align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|large"}}},"layout":{"type":"default"}} -->
<div class="wp-block-group alignwide" style="margin-top:var(--wp--preset--spacing--large)"><!-- wp:paragraph {"className":"origin-canvas-mono","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-muted","fontSize":"extra-small"} -->
<p class="origin-canvas-mono has-text-muted-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( '6 of 12 templates shown', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
<!-- wp:group {"tagName":"section","align":"full","backgroundColor":"surface-subtle","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"var:preset|spacing|colossal","bottom":"var:preset|spacing|colossal"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-surface-subtle-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--colossal);padding-bottom:var(--wp--preset--spacing--colossal)"><!-- wp:columns {"align":"wide","verticalAlignment":"center","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|huge","left":"var:preset|spacing|huge"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center","width":"47.5%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:47.5%"><!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","fontWeight":"600","letterSpacing":"0.08em"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|medium"}}},"textColor":"primary","fontSize":"extra-small"} -->
<p class="has-primary-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--medium);font-weight:600;letter-spacing:0.08em;text-transform:uppercase"><?php echo esc_html__( 'Built on the system', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2,"style":{"typography":{"fontSize":"clamp(2rem, 4vw, 2.6rem)"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|medium"}}}} -->
<h2 class="wp-block-heading" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--medium);font-size:clamp(2rem, 4vw, 2.6rem)"><?php echo esc_html__( 'Theme owns the presets. Everything else follows.', 'origin-canvas' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|large"}}},"textColor":"text-body","fontSize":"regular-plus"} -->
<p class="has-text-body-color has-text-color has-regular-plus-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--large)"><?php echo esc_html__( 'Colors, spacing, type sizes, and radii live in one theme.json. Patterns and templates reference them, not scattered hex values.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|compact"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|compact"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top"}} -->
<div class="wp-block-group"><!-- wp:group {"className":"origin-canvas-bullet-mark","style":{"dimensions":{"minHeight":"6px"}}} -->
<div class="wp-block-group origin-canvas-bullet-mark" style="min-height:6px"></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-body","fontSize":"small"} -->
<p class="has-text-body-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:0"><?php echo wp_kses_post( __( 'Eleven named colors, from <strong>primary</strong> to <strong>on-dark</strong>, used everywhere.', 'origin-canvas' ) ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|compact"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top"}} -->
<div class="wp-block-group"><!-- wp:group {"className":"origin-canvas-bullet-mark","style":{"dimensions":{"minHeight":"6px"}}} -->
<div class="wp-block-group origin-canvas-bullet-mark" style="min-height:6px"></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-body","fontSize":"small"} -->
<p class="has-text-body-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:0"><?php echo wp_kses_post( __( 'A <strong>twelve-step spacing scale</strong> with fluid clamps on the larger steps.', 'origin-canvas' ) ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|compact"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top"}} -->
<div class="wp-block-group"><!-- wp:group {"className":"origin-canvas-bullet-mark","style":{"dimensions":{"minHeight":"6px"}}} -->
<div class="wp-block-group origin-canvas-bullet-mark" style="min-height:6px"></div>
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
<div class="wp-block-group" style="padding-top:18px;padding-right:18px;padding-bottom:18px;padding-left:18px"><!-- wp:paragraph {"style":{"typography":{"fontSize":"0.625rem","fontWeight":"600","letterSpacing":"0.1em","textTransform":"uppercase"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-muted"} -->
<p class="has-text-muted-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:0.625rem;font-weight:600;letter-spacing:0.1em;text-transform:uppercase"><?php echo esc_html__( 'Color &middot; palette', 'origin-canvas' ); ?></p>
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
<div class="wp-block-group" style="border-top-color:var(--wp--preset--color--border);border-top-width:1px;padding-top:18px;padding-right:18px;padding-bottom:18px;padding-left:18px"><!-- wp:paragraph {"style":{"typography":{"fontSize":"0.625rem","fontWeight":"600","letterSpacing":"0.1em","textTransform":"uppercase"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-muted"} -->
<p class="has-text-muted-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:0.625rem;font-weight:600;letter-spacing:0.1em;text-transform:uppercase"><?php echo esc_html__( 'Spacing &middot; scale', 'origin-canvas' ); ?></p>
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
<div class="wp-block-group" style="border-top-color:var(--wp--preset--color--border);border-top-width:1px;padding-top:18px;padding-right:18px;padding-bottom:18px;padding-left:18px"><!-- wp:paragraph {"style":{"typography":{"fontSize":"0.625rem","fontWeight":"600","letterSpacing":"0.1em","textTransform":"uppercase"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-muted"} -->
<p class="has-text-muted-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:0.625rem;font-weight:600;letter-spacing:0.1em;text-transform:uppercase"><?php echo esc_html__( 'Typography &middot; sizes', 'origin-canvas' ); ?></p>
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
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"var:preset|spacing|colossal","bottom":"var:preset|spacing|colossal"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--colossal);padding-bottom:var(--wp--preset--spacing--colossal)"><!-- wp:group {"layout":{"type":"constrained","contentSize":"860px"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","fontWeight":"600","letterSpacing":"0.08em"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|large"}}},"textColor":"primary","fontSize":"extra-small"} -->
<p class="has-text-align-center has-primary-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--large);font-weight:600;letter-spacing:0.08em;text-transform:uppercase"><?php echo esc_html__( 'From the people shipping with it', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"clamp(1.7rem, 3.1vw, 2.4rem)","fontWeight":"500","lineHeight":"1.3","letterSpacing":"-0.02em"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading"} -->
<p class="has-text-align-center has-text-heading-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:clamp(1.7rem, 3.1vw, 2.4rem);font-weight:500;letter-spacing:-0.02em;line-height:1.3"><?php echo esc_html__( 'Origin Canvas is the first theme where the patterns actually match the templates out of the box. We ship a new marketing site about every two weeks.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|compact","margin":{"top":"var:preset|spacing|extra-large"}}},"layout":{"type":"flex","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--extra-large)"><!-- wp:image {"aspectRatio":"1","linkDestination":"none","width":"52px","height":"52px","className":"is-style-origin-canvas-rounded-full"} -->
<figure class="wp-block-image is-resized is-style-origin-canvas-rounded-full"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/patterns/images/testimonial-highlight-1.webp" alt="<?php esc_attr_e( 'Portrait of Tom Bradshaw, studio lead at Northbank.', 'origin-canvas' ); ?>" style="aspect-ratio:1;width:52px;height:52px"/></figure>
<!-- /wp:image -->

<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontSize":"0.9375rem","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading"} -->
<p class="has-text-heading-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:0.9375rem;font-weight:600"><?php echo esc_html__( 'Tom Bradshaw', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-muted","fontSize":"small"} -->
<p class="has-text-muted-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Studio lead, Northbank', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
<!-- wp:group {"tagName":"section","align":"full","backgroundColor":"surface-subtle","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"var:preset|spacing|colossal","bottom":"var:preset|spacing|colossal"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-surface-subtle-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--colossal);padding-bottom:var(--wp--preset--spacing--colossal)"><!-- wp:group {"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|huge"}}},"layout":{"type":"constrained","contentSize":"720px"}} -->
<div class="wp-block-group" style="margin-bottom:var(--wp--preset--spacing--huge)"><!-- wp:heading {"textAlign":"center","level":2,"style":{"typography":{"fontSize":"clamp(2.1rem, 4.4vw, 3rem)","lineHeight":"1.08"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|medium"}}}} -->
<h2 class="wp-block-heading has-text-align-center" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--medium);font-size:clamp(2.1rem, 4.4vw, 3rem);line-height:1.08"><?php echo wp_kses_post( __( 'Start with the foundation.<br>Add layers as you need them.', 'origin-canvas' ) ); ?></h2>
<!-- /wp:heading -->

<!-- wp:group {"layout":{"type":"constrained","contentSize":"560px"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"0.9375rem","lineHeight":"1.6"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-body"} -->
<p class="has-text-align-center has-text-body-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:0.9375rem;line-height:1.6"><?php echo wp_kses_post( __( 'Origin Theme and Origin Blocks are free and available today. Every advanced layer builds on the same foundation, so nothing you learn is wasted. <span class="has-inline-color has-text-heading-color" style="font-weight:500">Founding access to Patterns Pro is $55/year for the first 500 members.</span>', 'origin-canvas' ) ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"top":"20px","left":"20px"}}}} -->
<div class="wp-block-columns alignwide"><!-- wp:column {"backgroundColor":"surface-base","borderColor":"border","style":{"border":{"radius":"var:custom|radius|large","style":"solid","width":"1px"},"spacing":{"padding":{"top":"var:preset|spacing|large","right":"var:preset|spacing|large","bottom":"var:preset|spacing|large","left":"var:preset|spacing|large"}}}} -->
<div class="wp-block-column has-border-color has-border-border-color has-surface-base-background-color has-background" style="border-style:solid;border-width:1px;border-radius:var(--wp--custom--radius--large);padding-top:var(--wp--preset--spacing--large);padding-right:var(--wp--preset--spacing--large);padding-bottom:var(--wp--preset--spacing--large);padding-left:var(--wp--preset--spacing--large)"><!-- wp:group {"style":{"dimensions":{"minHeight":"258px"},"spacing":{"blockGap":"0"}},"layout":{"type":"flex","orientation":"vertical","verticalAlignment":"space-between"}} -->
<div class="wp-block-group" style="min-height:258px"><!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"spacing":{"blockGap":"9px","margin":{"top":"0","bottom":"22px"}}},"layout":{"type":"flex","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:22px"><!-- wp:group {"className":"origin-canvas-status-dot","style":{"color":{"background":"#FF4387"},"dimensions":{"minHeight":"8px"}}} -->
<div class="wp-block-group origin-canvas-status-dot has-background" style="background-color:#FF4387;min-height:8px"></div>
<!-- /wp:group -->

<!-- wp:paragraph {"className":"origin-canvas-status-chip origin-canvas-mono","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="origin-canvas-status-chip origin-canvas-mono" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Available now', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"1.3125rem"},"spacing":{"margin":{"top":"0","bottom":"10px"}}}} -->
<h3 class="wp-block-heading" style="margin-top:0;margin-bottom:10px;font-size:1.3125rem"><?php echo esc_html__( 'Origin Theme', 'origin-canvas' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"0.90625rem","lineHeight":"1.55"},"spacing":{"margin":{"top":"0","bottom":"22px"}}},"textColor":"text-body"} -->
<p class="has-text-body-color has-text-color" style="margin-top:0;margin-bottom:22px;font-size:0.90625rem;line-height:1.55"><?php echo esc_html__( 'A modern, opinionated FSE theme with a finished design baseline, 62 patterns, and 11 style variations, ready on install.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontSize":"1.375rem","fontWeight":"700","letterSpacing":"-0.01em"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading"} -->
<p class="has-text-heading-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:1.375rem;font-weight:700;letter-spacing:-0.01em"><?php echo esc_html__( 'Free', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"},"spacing":{"margin":{"top":"15px","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|text-heading"},"typography":{"textDecoration":"none"}}}},"textColor":"text-heading","fontSize":"small"} -->
<p class="has-text-heading-color has-text-color has-link-color has-small-font-size" style="margin-top:15px;margin-bottom:0;font-weight:600"><a href="#" style="text-decoration:none"><?php echo esc_html__( 'Download free', 'origin-canvas' ); ?></a> <span class="has-primary-color has-text-color" style="color:var(--wp--preset--color--primary)" aria-hidden="true">&rarr;</span></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"backgroundColor":"surface-base","borderColor":"border","style":{"border":{"radius":"var:custom|radius|large","style":"solid","width":"1px"},"spacing":{"padding":{"top":"var:preset|spacing|large","right":"var:preset|spacing|large","bottom":"var:preset|spacing|large","left":"var:preset|spacing|large"}}}} -->
<div class="wp-block-column has-border-color has-border-border-color has-surface-base-background-color has-background" style="border-style:solid;border-width:1px;border-radius:var(--wp--custom--radius--large);padding-top:var(--wp--preset--spacing--large);padding-right:var(--wp--preset--spacing--large);padding-bottom:var(--wp--preset--spacing--large);padding-left:var(--wp--preset--spacing--large)"><!-- wp:group {"style":{"dimensions":{"minHeight":"258px"},"spacing":{"blockGap":"0"}},"layout":{"type":"flex","orientation":"vertical","verticalAlignment":"space-between"}} -->
<div class="wp-block-group" style="min-height:258px"><!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"spacing":{"blockGap":"9px","margin":{"top":"0","bottom":"22px"}}},"layout":{"type":"flex","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:22px"><!-- wp:group {"className":"origin-canvas-status-dot","style":{"color":{"background":"#16A34A"},"dimensions":{"minHeight":"8px"}}} -->
<div class="wp-block-group origin-canvas-status-dot has-background" style="background-color:#16A34A;min-height:8px"></div>
<!-- /wp:group -->

<!-- wp:paragraph {"className":"origin-canvas-status-chip origin-canvas-mono","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="origin-canvas-status-chip origin-canvas-mono" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Available now', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"1.3125rem"},"spacing":{"margin":{"top":"0","bottom":"10px"}}}} -->
<h3 class="wp-block-heading" style="margin-top:0;margin-bottom:10px;font-size:1.3125rem"><?php echo esc_html__( 'Origin Blocks', 'origin-canvas' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"0.90625rem","lineHeight":"1.55"},"spacing":{"margin":{"top":"0","bottom":"22px"}}},"textColor":"text-body"} -->
<p class="has-text-body-color has-text-color" style="margin-top:0;margin-bottom:22px;font-size:0.90625rem;line-height:1.55"><?php echo esc_html__( 'Essential blocks that share the theme&#8217;s design system, so sections never clash.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontSize":"1.375rem","fontWeight":"700","letterSpacing":"-0.01em"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading"} -->
<p class="has-text-heading-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:1.375rem;font-weight:700;letter-spacing:-0.01em"><?php echo esc_html__( 'Free', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"},"spacing":{"margin":{"top":"15px","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|text-heading"},"typography":{"textDecoration":"none"}}}},"textColor":"text-heading","fontSize":"small"} -->
<p class="has-text-heading-color has-text-color has-link-color has-small-font-size" style="margin-top:15px;margin-bottom:0;font-weight:600"><a href="#" style="text-decoration:none"><?php echo esc_html__( 'Download free', 'origin-canvas' ); ?></a> <span class="has-primary-color has-text-color" style="color:var(--wp--preset--color--primary)" aria-hidden="true">&rarr;</span></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"backgroundColor":"surface-base","borderColor":"border","style":{"border":{"radius":"var:custom|radius|large","style":"solid","width":"1px"},"spacing":{"padding":{"top":"var:preset|spacing|large","right":"var:preset|spacing|large","bottom":"var:preset|spacing|large","left":"var:preset|spacing|large"}}}} -->
<div class="wp-block-column has-border-color has-border-border-color has-surface-base-background-color has-background" style="border-style:solid;border-width:1px;border-radius:var(--wp--custom--radius--large);padding-top:var(--wp--preset--spacing--large);padding-right:var(--wp--preset--spacing--large);padding-bottom:var(--wp--preset--spacing--large);padding-left:var(--wp--preset--spacing--large)"><!-- wp:group {"style":{"dimensions":{"minHeight":"258px"},"spacing":{"blockGap":"0"}},"layout":{"type":"flex","orientation":"vertical","verticalAlignment":"space-between"}} -->
<div class="wp-block-group" style="min-height:258px"><!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"spacing":{"blockGap":"9px","margin":{"bottom":"22px"}}},"layout":{"type":"flex"}} -->
<div class="wp-block-group" style="margin-bottom:22px"><!-- wp:group {"className":"origin-canvas-status-dot","style":{"color":{"background":"#EA580C"},"dimensions":{"minHeight":"8px"}}} -->
<div class="wp-block-group origin-canvas-status-dot has-background" style="background-color:#EA580C;min-height:8px"></div>
<!-- /wp:group -->
<!-- wp:paragraph {"className":"origin-canvas-status-chip origin-canvas-mono","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="origin-canvas-status-chip origin-canvas-mono" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Coming soon', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"1.3125rem"},"spacing":{"margin":{"top":"0","bottom":"10px"}}}} -->
<h3 class="wp-block-heading" style="margin-top:0;margin-bottom:10px;font-size:1.3125rem"><?php echo esc_html__( 'Origin Blocks Pro', 'origin-canvas' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"0.90625rem","lineHeight":"1.55"},"spacing":{"margin":{"top":"0","bottom":"22px"}}},"textColor":"text-body"} -->
<p class="has-text-body-color has-text-color" style="margin-top:0;margin-bottom:22px;font-size:0.90625rem;line-height:1.55"><?php echo esc_html__( 'Advanced blocks for the workflows freelancers charge for: post grids, forms, sliders, galleries, and more.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"6px"}},"layout":{"type":"flex","verticalAlignment":"bottom"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontSize":"1.375rem","fontWeight":"700","letterSpacing":"-0.01em"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading"} -->
<p class="has-text-heading-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:1.375rem;font-weight:700;letter-spacing:-0.01em"><?php echo esc_html__( '$79', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-muted","fontSize":"extra-small"} -->
<p class="has-text-muted-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( '/ yr', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:columns {"align":"wide","style":{"spacing":{"margin":{"top":"20px"},"blockGap":{"top":"20px","left":"20px"}}}} -->
<div class="wp-block-columns alignwide" style="margin-top:20px"><!-- wp:column {"backgroundColor":"surface-base","borderColor":"border","style":{"border":{"radius":"var:custom|radius|large","style":"solid","width":"1px"},"spacing":{"padding":{"top":"var:preset|spacing|large","right":"var:preset|spacing|large","bottom":"var:preset|spacing|large","left":"var:preset|spacing|large"}}}} -->
<div class="wp-block-column has-border-color has-border-border-color has-surface-base-background-color has-background" style="border-style:solid;border-width:1px;border-radius:var(--wp--custom--radius--large);padding-top:var(--wp--preset--spacing--large);padding-right:var(--wp--preset--spacing--large);padding-bottom:var(--wp--preset--spacing--large);padding-left:var(--wp--preset--spacing--large)"><!-- wp:group {"style":{"dimensions":{"minHeight":"258px"},"spacing":{"blockGap":"0"}},"layout":{"type":"flex","orientation":"vertical","verticalAlignment":"space-between"}} -->
<div class="wp-block-group" style="min-height:258px"><!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"spacing":{"blockGap":"9px","margin":{"bottom":"22px"}}},"layout":{"type":"flex"}} -->
<div class="wp-block-group" style="margin-bottom:22px"><!-- wp:group {"className":"origin-canvas-status-dot","style":{"color":{"background":"#7C3AED"},"dimensions":{"minHeight":"8px"}}} -->
<div class="wp-block-group origin-canvas-status-dot has-background" style="background-color:#7C3AED;min-height:8px"></div>
<!-- /wp:group -->
<!-- wp:paragraph {"className":"origin-canvas-status-chip origin-canvas-mono","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="origin-canvas-status-chip origin-canvas-mono" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Coming soon', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"1.3125rem"},"spacing":{"margin":{"top":"0","bottom":"10px"}}}} -->
<h3 class="wp-block-heading" style="margin-top:0;margin-bottom:10px;font-size:1.3125rem"><?php echo esc_html__( 'Origin Patterns Pro', 'origin-canvas' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"0.90625rem","lineHeight":"1.55"},"spacing":{"margin":{"top":"0","bottom":"22px"}}},"textColor":"text-body"} -->
<p class="has-text-body-color has-text-color" style="margin-top:0;margin-bottom:22px;font-size:0.90625rem;line-height:1.55"><?php echo esc_html__( 'A growing pattern library built on one token system, so layouts stay coherent across every project.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"spacing":{"blockGap":"6px"}},"layout":{"type":"flex","verticalAlignment":"bottom"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontSize":"1.375rem","fontWeight":"700","letterSpacing":"-0.01em"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading"} -->
<p class="has-text-heading-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:1.375rem;font-weight:700;letter-spacing:-0.01em"><?php echo esc_html__( '$79', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-muted","fontSize":"extra-small"} -->
<p class="has-text-muted-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( '/ yr', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"5px","bottom":"0"}}},"textColor":"text-muted","fontSize":"extra-small"} -->
<p class="has-text-muted-color has-text-color has-extra-small-font-size" style="margin-top:5px;margin-bottom:0"><?php echo esc_html__( 'Founding $55/yr, first 500 members', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"},"spacing":{"margin":{"top":"15px","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|text-heading"},"typography":{"textDecoration":"none"}}}},"textColor":"text-heading","fontSize":"small"} -->
<p class="has-text-heading-color has-text-color has-link-color has-small-font-size" style="margin-top:15px;margin-bottom:0;font-weight:600"><a href="#" style="text-decoration:none"><?php echo esc_html__( 'Join the founding list', 'origin-canvas' ); ?></a> <span class="has-primary-color has-text-color" style="color:var(--wp--preset--color--primary)" aria-hidden="true">&rarr;</span></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"backgroundColor":"surface-base","borderColor":"border","style":{"border":{"radius":"var:custom|radius|large","style":"solid","width":"1px"},"spacing":{"padding":{"top":"var:preset|spacing|large","right":"var:preset|spacing|large","bottom":"var:preset|spacing|large","left":"var:preset|spacing|large"}}}} -->
<div class="wp-block-column has-border-color has-border-border-color has-surface-base-background-color has-background" style="border-style:solid;border-width:1px;border-radius:var(--wp--custom--radius--large);padding-top:var(--wp--preset--spacing--large);padding-right:var(--wp--preset--spacing--large);padding-bottom:var(--wp--preset--spacing--large);padding-left:var(--wp--preset--spacing--large)"><!-- wp:group {"style":{"dimensions":{"minHeight":"258px"},"spacing":{"blockGap":"0"}},"layout":{"type":"flex","orientation":"vertical","verticalAlignment":"space-between"}} -->
<div class="wp-block-group" style="min-height:258px"><!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"spacing":{"blockGap":"9px","margin":{"bottom":"22px"}}},"layout":{"type":"flex"}} -->
<div class="wp-block-group" style="margin-bottom:22px"><!-- wp:group {"className":"origin-canvas-status-dot","style":{"color":{"background":"#2563EB"},"dimensions":{"minHeight":"8px"}}} -->
<div class="wp-block-group origin-canvas-status-dot has-background" style="background-color:#2563EB;min-height:8px"></div>
<!-- /wp:group -->
<!-- wp:paragraph {"className":"origin-canvas-status-chip origin-canvas-mono","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="origin-canvas-status-chip origin-canvas-mono" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Coming soon', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"1.3125rem"},"spacing":{"margin":{"top":"0","bottom":"10px"}}}} -->
<h3 class="wp-block-heading" style="margin-top:0;margin-bottom:10px;font-size:1.3125rem"><?php echo esc_html__( 'Origin Starter Sites', 'origin-canvas' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"0.90625rem","lineHeight":"1.55"},"spacing":{"margin":{"top":"0","bottom":"22px"}}},"textColor":"text-body"} -->
<p class="has-text-body-color has-text-color" style="margin-top:0;margin-bottom:22px;font-size:0.90625rem;line-height:1.55"><?php echo esc_html__( 'A one-click installer that brings the theme, blocks, and patterns together as a ready-to-edit starting point.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"6px"}},"layout":{"type":"flex","verticalAlignment":"bottom"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontSize":"1.375rem","fontWeight":"700","letterSpacing":"-0.01em"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-heading"} -->
<p class="has-text-heading-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:1.375rem;font-weight:700;letter-spacing:-0.01em"><?php echo esc_html__( '$99', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-muted","fontSize":"extra-small"} -->
<p class="has-text-muted-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( '/ yr', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"style":{"border":{"radius":"var:custom|radius|large"},"color":{"background":"var(--wp--custom--dark--bg)","text":"var(--wp--custom--dark--text)"},"spacing":{"padding":{"top":"var:preset|spacing|large","right":"var:preset|spacing|large","bottom":"var:preset|spacing|large","left":"var:preset|spacing|large"}}}} -->
<div class="wp-block-column has-text-color has-background" style="border-radius:var(--wp--custom--radius--large);color:var(--wp--custom--dark--text);background-color:var(--wp--custom--dark--bg);padding-top:var(--wp--preset--spacing--large);padding-right:var(--wp--preset--spacing--large);padding-bottom:var(--wp--preset--spacing--large);padding-left:var(--wp--preset--spacing--large)"><!-- wp:group {"style":{"dimensions":{"minHeight":"258px"},"spacing":{"blockGap":"0"}},"layout":{"type":"flex","orientation":"vertical","verticalAlignment":"space-between"}} -->
<div class="wp-block-group" style="min-height:258px"><!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"spacing":{"blockGap":"9px","margin":{"bottom":"22px"}}},"layout":{"type":"flex"}} -->
<div class="wp-block-group" style="margin-bottom:22px"><!-- wp:group {"className":"origin-canvas-status-dot","style":{"color":{"background":"#9AA2B1"},"dimensions":{"minHeight":"8px"}}} -->
<div class="wp-block-group origin-canvas-status-dot has-background" style="background-color:#9AA2B1;min-height:8px"></div>
<!-- /wp:group -->
<!-- wp:paragraph {"className":"origin-canvas-status-chip origin-canvas-status-chip--dark origin-canvas-mono","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="origin-canvas-status-chip origin-canvas-status-chip--dark origin-canvas-mono" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Coming soon', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"1.3125rem"},"spacing":{"margin":{"top":"0","bottom":"10px"}},"color":{"text":"var(--wp--custom--dark--text)"}}} -->
<h3 class="wp-block-heading has-text-color" style="color:var(--wp--custom--dark--text);margin-top:0;margin-bottom:10px;font-size:1.3125rem"><?php echo esc_html__( 'Agency License', 'origin-canvas' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"0.90625rem","lineHeight":"1.55"},"spacing":{"margin":{"top":"0","bottom":"22px"}},"color":{"text":"color-mix(in srgb, var(--wp--custom--dark--text) 72%, transparent)"}}} -->
<p class="has-text-color" style="color:color-mix(in srgb, var(--wp--custom--dark--text) 72%, transparent);margin-top:0;margin-bottom:22px;font-size:0.90625rem;line-height:1.55"><?php echo esc_html__( 'Everything above under one plan, for studios and small teams running many sites at once.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"spacing":{"blockGap":"6px"}},"layout":{"type":"flex","verticalAlignment":"bottom"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontSize":"1.375rem","fontWeight":"700","letterSpacing":"-0.01em"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"var(--wp--custom--dark--text)"}}} -->
<p class="has-text-color" style="color:var(--wp--custom--dark--text);margin-top:0;margin-bottom:0;font-size:1.375rem;font-weight:700;letter-spacing:-0.01em"><?php echo esc_html__( '$499', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"text-muted","fontSize":"extra-small"} -->
<p class="has-text-muted-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:0"><?php echo esc_html__( '/ yr', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"typography":{"fontWeight":"600"},"spacing":{"margin":{"top":"15px","bottom":"0"}},"color":{"text":"var(--wp--custom--dark--text)"},"elements":{"link":{"color":{"text":"var(--wp--custom--dark--text)"},"typography":{"textDecoration":"none"}}}},"fontSize":"small"} -->
<p class="has-text-color has-link-color has-small-font-size" style="color:var(--wp--custom--dark--text);margin-top:15px;margin-bottom:0;font-weight:600"><a href="#" style="text-decoration:none"><?php echo esc_html__( 'Contact sales', 'origin-canvas' ); ?></a> <span style="color:var(--wp--custom--dark--text)" aria-hidden="true">&rarr;</span></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"0.9375rem"},"spacing":{"margin":{"top":"var:preset|spacing|extra-large","bottom":"0"}}},"textColor":"text-muted"} -->
<p class="has-text-align-center has-text-muted-color has-text-color" style="margin-top:var(--wp--preset--spacing--extra-large);margin-bottom:0;font-size:0.9375rem"><?php echo esc_html__( 'The theme is free forever. No account, no trial, no upgrade wall. Pro plugins are optional.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></section>
<!-- /wp:group -->
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"var:preset|spacing|colossal","bottom":"var:preset|spacing|colossal"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--colossal);padding-bottom:var(--wp--preset--spacing--colossal)"><!-- wp:group {"align":"wide","style":{"border":{"radius":"var:custom|radius|large"},"color":{"background":"var(--wp--custom--dark--bg)","text":"var(--wp--custom--dark--text)"},"spacing":{"padding":{"top":"var:preset|spacing|colossal","right":"var:preset|spacing|huge","bottom":"var:preset|spacing|colossal","left":"var:preset|spacing|huge"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide has-text-color has-background" style="border-radius:var(--wp--custom--radius--large);color:var(--wp--custom--dark--text);background-color:var(--wp--custom--dark--bg);padding-top:var(--wp--preset--spacing--colossal);padding-right:var(--wp--preset--spacing--huge);padding-bottom:var(--wp--preset--spacing--colossal);padding-left:var(--wp--preset--spacing--huge)"><!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","fontWeight":"600","letterSpacing":"0.08em"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|large"}}},"textColor":"primary","fontSize":"extra-small"} -->
<p class="has-text-align-center has-primary-color has-text-color has-extra-small-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--large);font-weight:600;letter-spacing:0.08em;text-transform:uppercase"><?php echo esc_html__( 'Ready when you are', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","level":2,"style":{"typography":{"fontSize":"clamp(2.4rem, 5vw, 3.6rem)","fontWeight":"800","letterSpacing":"-0.035em"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|medium"}},"color":{"text":"var(--wp--custom--dark--text)"}}} -->
<h2 class="wp-block-heading has-text-align-center has-text-color" style="color:var(--wp--custom--dark--text);margin-top:0;margin-bottom:var(--wp--preset--spacing--medium);font-size:clamp(2.4rem, 5vw, 3.6rem);font-weight:800;letter-spacing:-0.035em"><?php echo esc_html__( 'Start closer to finished.', 'origin-canvas' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:group {"layout":{"type":"constrained","contentSize":"540px"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"align":"center","style":{"color":{"text":"color-mix(in srgb, var(--wp--custom--dark--text) 72%, transparent)"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"fontSize":"regular-plus"} -->
<p class="has-text-align-center has-text-color has-regular-plus-font-size" style="color:color-mix(in srgb, var(--wp--custom--dark--text) 72%, transparent);margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Install Origin Canvas, pick a style variation, drop in patterns. You will have a real site before you have second-guessed the font.', 'origin-canvas' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:buttons {"style":{"spacing":{"blockGap":"var:preset|spacing|medium","margin":{"top":"var:preset|spacing|extra-large"}}},"layout":{"type":"flex","justifyContent":"center","orientation":"horizontal"}} -->
<div class="wp-block-buttons is-content-justification-center is-layout-flex" style="margin-top:var(--wp--preset--spacing--extra-large)"><!-- wp:button {"className":"is-style-origin-canvas-fill-primary"} -->
<div class="wp-block-button is-style-origin-canvas-fill-primary"><a class="wp-block-button__link wp-element-button"><?php echo esc_html__( 'Download free', 'origin-canvas' ); ?></a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-origin-canvas-outline-light"} -->
<div class="wp-block-button is-style-origin-canvas-outline-light"><a class="wp-block-button__link wp-element-button"><?php echo esc_html__( 'View the live demo', 'origin-canvas' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
