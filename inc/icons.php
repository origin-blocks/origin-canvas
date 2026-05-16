<?php
/**
 * Inline Lucide SVG icon helper, exposed via a render_block filter on
 * core/paragraph blocks bearing the `is-style-origin-canvas-icon-<slug>` className.
 *
 * Icons are sourced from Lucide (https://lucide.dev), ISC License.
 * See readme.txt for attribution.
 *
 * @package Origin_Canvas
 */

if ( ! function_exists( 'origin_canvas_icon' ) ) {
	/**
	 * Return an inline Lucide SVG icon by name, or empty string if unknown.
	 *
	 * @param string $name Lucide icon slug.
	 * @return string Inline <svg>...</svg> markup, or empty string if unknown.
	 */
	function origin_canvas_icon( $name ) {
		$icons = array(
			'zap'                => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 14a1 1 0 0 1-.78-1.63l9.9-10.2a.5.5 0 0 1 .86.46l-1.92 6.02A1 1 0 0 0 13 10h7a1 1 0 0 1 .78 1.63l-9.9 10.2a.5.5 0 0 1-.86-.46l1.92-6.02A1 1 0 0 0 11 14z"/></svg>',
			'compass'            => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m16.24 7.76-1.804 5.411a2 2 0 0 1-1.265 1.265L7.76 16.24l1.804-5.411a2 2 0 0 1 1.265-1.265z"/><circle cx="12" cy="12" r="10"/></svg>',
			'contrast'           => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 18a6 6 0 0 0 0-12v12z"/></svg>',
			'monitor-smartphone' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2h2"/><path d="M10 19v-3.96 3.15"/><path d="M7 19h5"/><rect width="6" height="10" x="16" y="12" rx="2"/></svg>',
			'palette'            => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="13.5" cy="6.5" r=".5" fill="currentColor"/><circle cx="17.5" cy="10.5" r=".5" fill="currentColor"/><circle cx="8.5" cy="7.5" r=".5" fill="currentColor"/><circle cx="6.5" cy="12.5" r=".5" fill="currentColor"/><path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10c.926 0 1.648-.746 1.648-1.688 0-.437-.18-.835-.437-1.125-.29-.289-.438-.652-.438-1.125a1.64 1.64 0 0 1 1.668-1.668h1.996c3.051 0 5.555-2.503 5.555-5.554C21.965 6.012 17.461 2 12 2z"/></svg>',
			'accessibility'      => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="16" cy="4" r="1"/><path d="m18 19 1-7-6 1"/><path d="m5 8 3-3 5.5 3-2.36 3.5"/><path d="M4.24 14.5a5 5 0 0 0 6.88 6"/><path d="M13.76 17.5a5 5 0 0 0-6.88-6"/></svg>',
			'ruler'              => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21.3 15.3a2.4 2.4 0 0 1 0 3.4l-2.6 2.6a2.4 2.4 0 0 1-3.4 0L2.7 8.7a2.41 2.41 0 0 1 0-3.4l2.6-2.6a2.41 2.41 0 0 1 3.4 0Z"/><path d="m14.5 12.5 2-2"/><path d="m11.5 9.5 2-2"/><path d="m8.5 6.5 2-2"/><path d="m17.5 15.5 2-2"/></svg>',
			'type'               => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="4 7 4 4 20 4 20 7"/><line x1="9" x2="15" y1="20" y2="20"/><line x1="12" x2="12" y1="4" y2="20"/></svg>',
			'layers'             => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12.83 2.18a2 2 0 0 0-1.66 0L2.6 6.08a1 1 0 0 0 0 1.83l8.58 3.91a2 2 0 0 0 1.66 0l8.58-3.9a1 1 0 0 0 0-1.83Z"/><path d="m22 17.65-9.17 4.16a2 2 0 0 1-1.66 0L2 17.65"/><path d="m22 12.65-9.17 4.16a2 2 0 0 1-1.66 0L2 12.65"/></svg>',
			'layout-dashboard'   => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/></svg>',
		);

		return isset( $icons[ $name ] ) ? $icons[ $name ] : '';
	}
}

if ( ! function_exists( 'origin_canvas_icon_render_marker' ) ) {
	/**
	 * Replace marker core/paragraph blocks with inline Lucide SVG.
	 *
	 * A marker is any core/paragraph whose className starts with
	 * `is-style-origin-canvas-icon-`. The slug after the prefix names the icon.
	 * Non-marker paragraphs pass through unchanged.
	 *
	 * @param string $block_content Rendered HTML for the paragraph.
	 * @param array  $block         Parsed block data.
	 * @return string
	 */
	function origin_canvas_icon_render_marker( $block_content, $block ) {
		if ( empty( $block['attrs']['className'] ) ) {
			return $block_content;
		}
		$class_name = $block['attrs']['className'];
		if ( strpos( $class_name, 'is-style-origin-canvas-icon-' ) !== 0 ) {
			return $block_content;
		}
		$slug = substr( $class_name, strlen( 'is-style-origin-canvas-icon-' ) );
		$svg  = origin_canvas_icon( $slug );
		if ( '' === $svg ) {
			return $block_content;
		}

		// Pass through any inline style="..." the block-supports JSON produced
		// on the rendered <p> so per-instance spacing/border/typography survives
		// the wrapper rebuild. Without this, JSON edits in the block inspector
		// (e.g. style.spacing.margin.bottom) render correctly in the editor
		// canvas but no-op on the front-end.
		$style_attr = '';
		if ( preg_match( '/<p\b[^>]*\sstyle="([^"]*)"/i', $block_content, $style_match ) ) {
			$style_attr = sprintf( ' style="%s"', esc_attr( $style_match[1] ) );
		}

		return sprintf(
			'<span class="%s"%s aria-hidden="true">%s</span>',
			esc_attr( $class_name ),
			$style_attr,
			$svg
		);
	}
}
add_filter( 'render_block_core/paragraph', 'origin_canvas_icon_render_marker', 10, 2 );
