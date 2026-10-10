<?php
/**
 * Design system page for the local demo site. Loaded by bin/demo/oc-demo-switches.php from the
 * active theme; never shipped in the theme zip (bin/ is distignored).
 *
 * The Private page /design-system/ holds one block, origin-canvas-demo/design-system, which
 * renders page.php inside the theme's own template, so the real header, footer and global
 * styles apply. Administrators only: the mu-plugin 404s everyone else, and the render checks
 * again before printing anything.
 *
 * @package Origin
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * The anchor row. Each group lists its built sections (id => label); a group with none shows
 * as "Next". A section's markup is sections/<id>.php; an item without its file is left out.
 */
function oc_demo_ds_groups() {
	$groups = array(
		'Brand'   => array(),
		'Color'   => array(
			'text-color' => 'Text color',
			'surfaces'   => 'Surfaces',
		),
		'Type'    => array(),
		'Spacing' => array(),
		'Radius'  => array(),
		'Shadows' => array(),
		'Buttons' => array(),
		'Focus'   => array(),
		'Badges'  => array(),
		'Cards'   => array(),
		'Icons'   => array(),
	);
	foreach ( $groups as $group => $items ) {
		$groups[ $group ] = array_filter(
			$items,
			static fn( $id ) => is_readable( __DIR__ . '/sections/' . $id . '.php' ),
			ARRAY_FILTER_USE_KEY
		);
	}
	return $groups;
}

/**
 * Where a value comes from, as "file:line" in the active theme. The line is found as the page
 * renders, so it follows the file. A needle that is no longer there shows as "file:?".
 *
 * @param string $file   Path relative to the theme root.
 * @param string $needle Text on the line to cite. With $after, the first match after it.
 * @param string $after  Optional text that comes before the line, such as a block name.
 */
function oc_demo_ds_src( $file, $needle, $after = '' ) {
	$path  = get_stylesheet_directory() . '/' . $file;
	$lines = is_readable( $path ) ? file( $path ) : array();
	$seen  = '' === $after;
	foreach ( $lines as $i => $line ) {
		if ( ! $seen && false !== strpos( $line, $after ) ) {
			$seen = true;
		}
		if ( $seen && false !== strpos( $line, $needle ) ) {
			return basename( $file ) . ':' . ( $i + 1 );
		}
	}
	return basename( $file ) . ':?';
}

/**
 * The first block in a registered theme pattern that matches $want, rendered as the theme
 * renders it, with the ground it sits on and the line of its block comment in the pattern
 * file. Specimens are real shipped blocks, so a pattern change shows here.
 *
 * The ground is the nearest fill among the block and its ancestors: a palette slug as its
 * preset variable, a raw value as written, or surface-base (the page) when nothing sets one.
 * The text color the block inherits from its ancestors is found the same way, so a block
 * shown alone keeps the color its section gives it.
 *
 * @param string $slug Pattern slug without the origin-canvas/ prefix.
 * @param array  $want Any of: name (block name), class (in className), plain (true: no
 *                     className), textColor (slug), color (text in style.color.text),
 *                     fill (the block's own backgroundColor slug or style.color.background),
 *                     contains (text in the block's own markup), ground (as returned here).
 * @return array{html: string, ground: string, outer: string, color: string, src: string}
 *         Empty html when nothing matches. outer is the ground around the block, before its
 *         own fill. color is empty when no ancestor sets one.
 */
function oc_demo_ds_block( $slug, $want ) {
	$file    = 'patterns/' . $slug . '.php';
	$pattern = WP_Block_Patterns_Registry::get_instance()->get_registered( 'origin-canvas/' . $slug );
	$page    = 'var(--wp--preset--color--surface-base)';
	$stack   = array();
	foreach ( $pattern ? parse_blocks( $pattern['content'] ) : array() as $block ) {
		$stack[] = array( $block, $page, '' );
	}
	$seen = array();
	while ( $stack ) {
		list( $block, $ground, $color ) = array_shift( $stack );
		if ( empty( $block['blockName'] ) ) {
			continue;
		}
		$attrs  = $block['attrs'];
		$outer  = $ground;
		$ground = isset( $attrs['backgroundColor'] ) ? 'var(--wp--preset--color--' . $attrs['backgroundColor'] . ')' : ( $attrs['style']['color']['background'] ?? $ground );
		$key    = $block['blockName'] . wp_json_encode( $attrs );
		$nth    = $seen[ $key ] ?? 0;
		if ( oc_demo_ds_matches( $block, $want ) && ( ! isset( $want['ground'] ) || $want['ground'] === $ground ) ) {
			return array(
				'html'   => render_block( $block ),
				'ground' => $ground,
				'outer'  => $outer,
				'color'  => $color,
				'src'    => oc_demo_ds_comment_line( $file, $block['blockName'], $attrs, $nth ),
			);
		}
		$seen[ $key ] = $nth + 1;
		$color        = isset( $attrs['textColor'] ) ? 'var(--wp--preset--color--' . $attrs['textColor'] . ')' : ( $attrs['style']['color']['text'] ?? $color );
		$inner        = array();
		foreach ( $block['innerBlocks'] as $child ) {
			$inner[] = array( $child, $ground, $color );
		}
		$stack = array_merge( $inner, $stack );
	}
	return array(
		'html'   => '',
		'ground' => $page,
		'outer'  => $page,
		'color'  => '',
		'src'    => basename( $file ) . ': no match',
	);
}

/**
 * "file:line" of the $nth block comment (from 0) with this name and these attributes.
 *
 * @param string $file  Path relative to the theme root.
 * @param string $name  Block name.
 * @param array  $attrs Parsed attributes.
 * @param int    $nth   How many identical blocks come before it.
 */
function oc_demo_ds_comment_line( $file, $name, $attrs, $nth ) {
	$path = get_stylesheet_directory() . '/' . $file;
	$name = preg_replace( '#^core/#', '', $name );
	foreach ( is_readable( $path ) ? file( $path ) : array() as $i => $line ) {
		preg_match_all( '#<!--\s+wp:([a-z0-9/-]+)(\s+(\{.*?\}))?\s*/?-->#', $line, $found, PREG_SET_ORDER );
		foreach ( $found as $m ) {
			$json = isset( $m[3] ) ? json_decode( $m[3], true ) : array();
			if ( $m[1] === $name && $json === $attrs && 0 === $nth-- ) {
				return basename( $file ) . ':' . ( $i + 1 );
			}
		}
	}
	return basename( $file ) . ':?';
}

/**
 * Whether a parsed block matches every key in $want (see oc_demo_ds_block).
 *
 * @param array $block Parsed block.
 * @param array $want  Keys to match.
 */
function oc_demo_ds_matches( $block, $want ) {
	$attrs = $block['attrs'];
	if ( isset( $want['name'] ) && $want['name'] !== $block['blockName'] ) {
		return false;
	}
	if ( isset( $want['class'] ) && ! in_array( $want['class'], explode( ' ', $attrs['className'] ?? '' ), true ) ) {
		return false;
	}
	if ( isset( $want['textColor'] ) && ( $attrs['textColor'] ?? '' ) !== $want['textColor'] ) {
		return false;
	}
	if ( ! empty( $want['plain'] ) && ! empty( $attrs['className'] ) ) {
		return false;
	}
	if ( isset( $want['fill'] ) && ( $attrs['backgroundColor'] ?? ( $attrs['style']['color']['background'] ?? '' ) ) !== $want['fill'] ) {
		return false;
	}
	if ( isset( $want['contains'] ) && false === strpos( $block['innerHTML'], $want['contains'] ) ) {
		return false;
	}
	return ! isset( $want['color'] ) || false !== strpos( $attrs['style']['color']['text'] ?? '', $want['color'] );
}

add_action(
	'init',
	static function () {
		register_block_type(
			'origin-canvas-demo/design-system',
			array(
				'render_callback' => static function () {
					if ( ! current_user_can( 'manage_options' ) ) {
						return '';
					}
					ob_start();
					require __DIR__ . '/page.php';
					return ob_get_clean();
				},
			)
		);
	}
);

add_action(
	'wp_enqueue_scripts',
	static function () {
		if ( ! is_page( 'design-system' ) || ! current_user_can( 'manage_options' ) ) {
			return;
		}
		$base = get_stylesheet_directory_uri() . '/bin/demo/design-system/';
		$ver  = (string) filemtime( __DIR__ . '/design-system.css' );
		wp_enqueue_style( 'oc-demo-design-system', $base . 'design-system.css', array(), $ver );
		wp_enqueue_script(
			'oc-demo-design-system',
			$base . 'design-system.js',
			array(),
			(string) filemtime( __DIR__ . '/design-system.js' ),
			array(
				'strategy'  => 'defer',
				'in_footer' => true,
			)
		);
	}
);

/**
 * Pattern block comments whose line holds every needle, as file => line numbers. Lets a
 * "Rules vs runtime" item count its uses as the page renders.
 *
 * @param string|string[] $needles Text that must all be on the line.
 */
function oc_demo_ds_uses( $needles ) {
	$uses = array();
	foreach ( glob( get_stylesheet_directory() . '/patterns/*.php' ) as $path ) {
		foreach ( file( $path ) as $i => $line ) {
			if ( false === strpos( $line, '<!-- wp:' ) ) {
				continue;
			}
			foreach ( (array) $needles as $needle ) {
				if ( false === strpos( $line, $needle ) ) {
					continue 2;
				}
			}
			$uses[ basename( $path ) ][] = $i + 1;
		}
	}
	return $uses;
}

/**
 * Uses as "file.php:line ×count", one per file.
 *
 * @param array $uses From oc_demo_ds_uses().
 */
function oc_demo_ds_uses_text( $uses ) {
	if ( ! $uses ) {
		return 'no uses';
	}
	$parts = array();
	foreach ( $uses as $file => $lines ) {
		$parts[] = $file . ':' . $lines[0] . ( count( $lines ) > 1 ? ' ×' . count( $lines ) : '' );
	}
	return implode( ', ', $parts );
}

/**
 * One specimen tile: a sample on its ground, then the captions. The hex and ratio captions are
 * filled in by design-system.js.
 *
 * @param array $t name, ground, html, use, src; optional fg (paints an "Aa" in that color),
 *                 color (the text color the block inherits), target (selector of the
 *                 measured element), aa (true for the neutral text
 *                 roles, which AA binds), note, wide, fill (selector, from the tile, of an
 *                 element whose fill is measured against what is behind it), roles (text
 *                 roles painted on the ground: label, color, aa), text (false: no text caption,
 *                 for a sample with no text).
 */
function oc_demo_ds_tile( $t ) {
	$style = '--ocds-ground:' . $t['ground'] . ( isset( $t['fg'] ) ? ';--ocds-fg:' . $t['fg'] : '' );
	?>
	<figure class="ocds-tile<?php echo empty( $t['wide'] ) ? '' : ' is-wide'; ?>" data-ocds-tile<?php echo empty( $t['aa'] ) ? '' : ' data-ocds-aa'; ?><?php echo empty( $t['fill'] ) ? '' : ' data-ocds-fill="' . esc_attr( $t['fill'] ) . '"'; ?> style="<?php echo esc_attr( $style ); ?>">
		<div class="ocds-ground">
			<?php if ( isset( $t['fg'] ) ) : ?>
				<span class="ocds-aa has-huge-font-size" aria-hidden="true">Aa</span>
			<?php endif; ?>
			<div class="ocds-sample" data-ocds-sample="<?php echo esc_attr( $t['target'] ?? '' ); ?>"<?php echo empty( $t['color'] ) ? '' : ' style="' . esc_attr( 'color:' . $t['color'] ) . '"'; ?>>
				<?php echo $t['html']; // phpcs:ignore WordPress.Security.EscapeOutput -- rendered theme blocks. ?>
			</div>
			<?php if ( ! empty( $t['roles'] ) ) : ?>
				<ul class="ocds-roles has-small-font-size">
					<?php foreach ( $t['roles'] as $oc_demo_ds_role ) : ?>
						<li data-ocds-tile<?php echo empty( $oc_demo_ds_role[2] ) ? '' : ' data-ocds-aa'; ?> style="<?php echo esc_attr( 'color:' . $oc_demo_ds_role[1] ); ?>">
							<span class="ocds-cell-aa has-large-font-size" data-ocds-sample>Aa</span>
							<span><?php echo esc_html( $oc_demo_ds_role[0] ); ?><br><span class="ocds-num" data-ocds-ratio></span></span>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</div>
		<figcaption class="ocds-cap">
			<code class="has-text-heading-color has-text-color"><?php echo esc_html( $t['name'] ); ?></code>
			<?php if ( ! isset( $t['text'] ) || $t['text'] ) : ?>
				<span class="ocds-num has-text-body-color has-text-color has-small-font-size"><span data-ocds-hex></span><br><span data-ocds-ratio></span></span>
			<?php endif; ?>
			<?php if ( ! empty( $t['fill'] ) ) : ?>
				<span class="ocds-num has-text-body-color has-text-color has-small-font-size" data-ocds-sep></span>
			<?php endif; ?>
			<span class="has-text-body-color has-text-color has-small-font-size"><?php echo esc_html( $t['use'] ); ?></span>
			<?php if ( ! empty( $t['note'] ) ) : ?>
				<span class="has-text-heading-color has-text-color has-small-font-size"><strong><?php echo esc_html( $t['note'] ); ?></strong></span>
			<?php endif; ?>
			<span class="has-text-muted-color has-text-color has-extra-small-font-size"><?php echo esc_html( $t['src'] ); ?></span>
		</figcaption>
	</figure>
	<?php
}
