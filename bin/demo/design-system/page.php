<?php
/**
 * Design system page markup: the head, the side menu and one section per built menu item.
 * Rendered by the origin-canvas-demo/design-system block (design-system.php).
 *
 * Type and color use the theme's preset classes, so the page chrome follows the active style
 * variation. Hex values and contrast ratios are filled in by design-system.js from the colors
 * the browser paints.
 *
 * @package Origin
 */

if ( ! defined( 'ABSPATH' ) || ! current_user_can( 'manage_options' ) ) {
	return;
}

$oc_demo_ds_groups = oc_demo_ds_groups();
?>
<div class="ocds alignfull">

	<header class="ocds-head">
		<p class="ocds-kicker has-text-heading-color has-text-color has-extra-small-font-size">Design system · private</p>
		<h1 class="has-display-font-size">Origin Canvas</h1>
		<p class="ocds-lede has-text-body-color has-text-color has-regular-plus-font-size">Every role the theme ships, painted on the grounds it sits on, in the type it is set in. Specimens are real blocks from the theme's patterns. Hex values and contrast are read from this page as it renders, so the page follows theme.json and any style variation (<code>?ocvariation=</code>). Nothing here changes the theme.</p>
		<noscript><p class="has-text-muted-color has-text-color has-small-font-size">Hex values and ratios are filled in by JavaScript. Names, sources and samples still show without it.</p></noscript>
	</header>

	<div class="ocds-body">

		<nav class="ocds-menu origin-canvas-links-plain" aria-label="Design system">
			<ul class="ocds-menu-groups">
				<?php foreach ( $oc_demo_ds_groups as $oc_demo_ds_group => $oc_demo_ds_items ) : ?>
					<li class="ocds-menu-group">
						<span class="ocds-menu-label has-text-heading-color has-text-color has-extra-small-font-size"><?php echo esc_html( $oc_demo_ds_group ); ?></span>
						<?php if ( $oc_demo_ds_items ) : ?>
							<ul class="ocds-menu-items">
								<?php foreach ( $oc_demo_ds_items as $oc_demo_ds_id => $oc_demo_ds_label ) : ?>
									<li><a class="has-small-font-size" href="#<?php echo esc_attr( $oc_demo_ds_id ); ?>"><?php echo esc_html( $oc_demo_ds_label ); ?></a></li>
								<?php endforeach; ?>
							</ul>
						<?php else : ?>
							<span class="ocds-next has-text-muted-color has-text-color has-extra-small-font-size">Next</span>
						<?php endif; ?>
					</li>
				<?php endforeach; ?>
			</ul>
		</nav>

		<div class="ocds-content">
			<?php
			foreach ( $oc_demo_ds_groups as $oc_demo_ds_items ) {
				foreach ( array_keys( $oc_demo_ds_items ) as $oc_demo_ds_id ) {
					require __DIR__ . '/sections/' . $oc_demo_ds_id . '.php';
				}
			}
			?>
		</div>

	</div>
</div>
