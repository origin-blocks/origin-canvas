/**
 * Origin Canvas: old colour names in the editors until Update colours moves them (#116).
 *
 * A block's edit component looks a colour slug up in the palette (core's withColors), so an old
 * slug the palette no longer holds renders with no colour: a Cover's overlay, for one. Edit
 * components get the new slug instead, only where the palette lacks the old slug and holds the
 * new one, read from the same three origins core reads. The stored attributes stay as saved, so
 * nothing the editor saves changes.
 */
( function ( wp, config ) {
	if ( ! wp || ! wp.hooks || ! wp.compose || ! wp.element || ! wp.blockEditor || ! wp.blockEditor.useSettings || ! config ) {
		return;
	}
	const { createElement, useMemo } = wp.element;
	const map = config.map || {};
	const attrs = config.attrs || [];

	const withNewNames = wp.compose.createHigherOrderComponent(
		( BlockEdit ) => ( props ) => {
			const [ custom, theme, defaults ] = wp.blockEditor.useSettings( 'color.palette.custom', 'color.palette.theme', 'color.palette.default' );
			const attributes = useMemo( () => {
				const slugs = new Set( [ ...( custom || [] ), ...( theme || [] ), ...( defaults || [] ) ].map( ( c ) => c && c.slug ) );
				let next = null;
				for ( const a of attrs ) {
					const v = props.attributes ? props.attributes[ a ] : undefined;
					if ( typeof v === 'string' && map[ v ] && ! slugs.has( v ) && slugs.has( map[ v ] ) ) {
						next = next || { ...props.attributes };
						next[ a ] = map[ v ];
					}
				}
				return next || props.attributes;
			}, [ props.attributes, custom, theme, defaults ] );
			return createElement( BlockEdit, attributes === props.attributes ? props : { ...props, attributes } );
		},
		'withOriginCanvasPaletteNames'
	);

	wp.hooks.addFilter( 'editor.BlockEdit', 'origin-canvas/palette-names', withNewNames );
} )( window.wp, window.originCanvasEditorPalette );
