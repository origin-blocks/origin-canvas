<?php
/**
 * The palette rename (#116): the one map every palette unit reads.
 *
 * @package Origin_Canvas
 */

if ( ! function_exists( 'origin_canvas_palette_map' ) ) {
	/**
	 * Old code => new code, for colour slugs, the spacing slug and the custom line height key.
	 *
	 * The #116 ruling: the codes are renamed, not only the labels; every value stays as it was,
	 * and Primary keeps its slug and name. Surface Muted and On Dark both become Base 2 (the
	 * merge): they held the same value in every release, and Surface Muted's entry wins.
	 *
	 * Collisions: a saved palette entry on a destination slug (base, base-2 … contrast), in a list
	 * that also holds the old slug that maps to it, is the user's own swatch. It keeps its value
	 * under the first free `<slug>-legacy` slug; nothing is dropped but the merged On Dark entry,
	 * which gets no legacy swatch, whatever its saved value (owner ruling, Oct 24).
	 *
	 * border-control and border-strong never shipped (develop only). They are mapped so a site
	 * built from develop, and the checks that read this file, see one complete map.
	 *
	 * One `'old' => 'new',` per line: bin/check-shipped-values.sh and bin/check-palette-names.sh
	 * parse this file.
	 *
	 * @return array{color: array<string, string>, spacing: array<string, string>, lineHeight: array<string, string>}
	 */
	function origin_canvas_palette_map() {
		static $map = null;
		if ( null !== $map ) {
			return $map;
		}

		$map = array(
			'color'      => array(
				'surface-base'         => 'base',
				'surface-muted'        => 'base-2',
				'on-dark'              => 'base-2',
				'surface-subtle'       => 'base-3',
				'surface-subtle-hover' => 'base-4',
				'border'               => 'base-5',
				'input-border'         => 'base-6',
				'border-control'       => 'contrast-5',
				'border-strong'        => 'contrast-4',
				'text-muted'           => 'contrast-3',
				'text-body'            => 'contrast-2',
				'text-heading'         => 'contrast',
			),
			'spacing'    => array(
				'compact' => 'small-medium',
			),
			'lineHeight' => array(
				'body' => 'normal',
			),
		);

		return $map;
	}
}

if ( ! function_exists( 'origin_canvas_palette_ident_end' ) ) {
	/**
	 * The regex lookahead that ends a slug inside a CSS identifier: a rename matches only a whole
	 * name, never one followed by a name character, a backslash escape or a non-ASCII byte
	 * (--wp--preset--color--text-muted_custom is another variable). Byte patterns, no /u flag.
	 *
	 * @return string
	 */
	function origin_canvas_palette_ident_end() {
		return '(?![-A-Za-z0-9_\\\\\x80-\xff])';
	}
}

if ( ! function_exists( 'origin_canvas_palette_rules' ) ) {
	/**
	 * The rules the palette units share, beside the map.
	 *
	 * Plain English strings, no __(): the map is read on the render path before `init`.
	 *
	 * @return array<string, mixed>
	 */
	function origin_canvas_palette_rules() {
		static $rules = null;
		if ( null !== $rules ) {
			return $rules;
		}

		$rules = array(
			// The new palette, in its order.
			'order'             => array( 'primary', 'base', 'base-2', 'base-3', 'base-4', 'base-5', 'base-6', 'base-7', 'contrast-5', 'contrast-4', 'contrast-3', 'contrast-2', 'contrast' ),
			'names'             => array(
				'primary'    => 'Primary',
				'base'       => 'Base',
				'base-2'     => 'Base 2',
				'base-3'     => 'Base 3',
				'base-4'     => 'Base 4',
				'base-5'     => 'Base 5',
				'base-6'     => 'Base 6',
				'base-7'     => 'Base 7',
				'contrast-5' => 'Contrast 5',
				'contrast-4' => 'Contrast 4',
				'contrast-3' => 'Contrast 3',
				'contrast-2' => 'Contrast 2',
				'contrast'   => 'Contrast',
			),
			// The name each old slug shipped with in 1.0.4–1.3.1 (develop's two for the unshipped
			// slugs). A saved entry still carrying it takes the new name; a renamed one keeps its own.
			'shipped_names'     => array(
				'surface-base'         => 'Surface Base',
				'surface-muted'        => 'Surface Muted',
				'surface-subtle'       => 'Surface Subtle',
				'surface-subtle-hover' => 'Surface Subtle Hover',
				'border'               => 'Border',
				'input-border'         => 'Input Border',
				'border-control'       => 'Border Control',
				'border-strong'        => 'Border Strong',
				'text-heading'         => 'Text Heading',
				'text-body'            => 'Text Body',
				'text-muted'           => 'Text Muted',
				'on-dark'              => 'On Dark',
			),
			'spacing_names'     => array(
				'compact' => array( 'Compact', 'Small Medium' ),
			),
			// Slugs a saved record may already hold for its own entry, which the rename would claim.
			'destinations'      => array(
				'color'      => array( 'base', 'base-2', 'base-3', 'base-4', 'base-5', 'base-6', 'base-7', 'contrast-5', 'contrast-4', 'contrast-3', 'contrast-2', 'contrast' ),
				'spacing'    => array( 'small-medium' ),
				'lineHeight' => array( 'normal' ),
			),
			// New slug => the old slugs merged into it, the winner first.
			'merge'             => array(
				'base-2' => array( 'surface-muted', 'on-dark' ),
			),
			'legacy_suffix'     => array(
				'slug' => '-legacy',
				'name' => ' (legacy)',
			),
			// Base 7 = round( 0.72 × Base 2 + 0.28 × Contrast ) per channel.
			'mix'               => array(
				'base-7' => array( 'base-2', 'contrast', 72 ),
			),
			// The theme's own rules keyed on a new class, and the old class old content still holds.
			'twins'             => array(
				'files'   => array(
					'style.css'                         => 'origin-canvas-style',
					'assets/styles/core-navigation.css' => 'origin-canvas-block-core-navigation',
				),
				'classes' => array(
					'has-contrast-background-color' => 'has-text-heading-background-color',
					'has-base-2-color'              => 'has-on-dark-color',
				),
			),
			// Slug attribute => the class suffix it puts on the block's own tags (null: no class).
			'slug_attrs'        => array(
				'textColor'              => 'color',
				'backgroundColor'        => 'background-color',
				'borderColor'            => 'border-color',
				'overlayColor'           => 'background-color',
				'iconColor'              => null,
				'iconBackgroundColor'    => null,
				'overlayTextColor'       => null,
				'overlayBackgroundColor' => null,
			),
			// Blocks whose save writes a slug attribute as a second class: the Separator writes its
			// backgroundColor as has-<slug>-color beside has-<slug>-background-color.
			'derived'           => array(
				'core/separator' => array( 'backgroundColor' => 'color' ),
			),
			// Blocks that store rich text in a string attribute core prints as HTML, Highlight marks
			// included (navigation-link.php renders the label through wp_kses_post(), which keeps
			// class and style on mark): attribute names, read and renamed as markup. Each is a
			// dynamic block, so the JSON is its only source. Tags in any other block's attribute
			// string (a third-party label) are read as alias hits only.
			'html_attrs'        => array(
				'core/navigation-link'      => array( 'label' ),
				'core/navigation-submenu'   => array( 'label' ),
				'core/home-link'            => array( 'label' ),
				'core/read-more'            => array( 'content' ),
				'core/post-terms'           => array( 'prefix', 'suffix' ),
				'core/search'               => array( 'label', 'buttonText' ),
				'core/post-excerpt'         => array( 'moreText' ),
				'core/post-navigation-link' => array( 'label' ),
				'core/categories'           => array( 'label' ),
				'core/post-author'          => array( 'byline' ),
			),
			'unreachable'       => array( 'core/html', 'core/freeform' ),
			'types'             => array( 'post', 'page', 'wp_template', 'wp_template_part', 'wp_block', 'wp_navigation' ),
			'recent_save_types' => array( 'wp_template', 'wp_template_part', 'wp_navigation' ),
			'editor_screens'    => array( 'post.php', 'post-new.php', 'site-editor.php' ),
		);

		return $rules;
	}
}
