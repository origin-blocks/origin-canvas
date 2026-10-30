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

	const isOld = ( v ) => typeof v === 'string' && Object.prototype.hasOwnProperty.call( map, v );
	const hasOld = ( attributes ) => !! attributes && attrs.some( ( a ) => isOld( attributes[ a ] ) );

	// The palette hooks run only for a block that holds an old slug. Once its last old slug is
	// replaced, the block's edit component mounts again without this wrapper, once.
	const WithNames = ( { BlockEdit, props } ) => {
		const [ custom, theme, defaults ] = wp.blockEditor.useSettings( 'color.palette.custom', 'color.palette.theme', 'color.palette.default' );
		const attributes = useMemo( () => {
			const slugs = new Set( [ ...( custom || [] ), ...( theme || [] ), ...( defaults || [] ) ].map( ( c ) => c && c.slug ) );
			let next = null;
			for ( const a of attrs ) {
				const v = props.attributes[ a ];
				if ( isOld( v ) && ! slugs.has( v ) && slugs.has( map[ v ] ) ) {
					next = next || { ...props.attributes };
					next[ a ] = map[ v ];
				}
			}
			return next || props.attributes;
		}, [ props.attributes, custom, theme, defaults ] );
		return createElement( BlockEdit, attributes === props.attributes ? props : { ...props, attributes } );
	};

	const withNewNames = wp.compose.createHigherOrderComponent(
		( BlockEdit ) => ( props ) => ( hasOld( props.attributes ) ? createElement( WithNames, { BlockEdit, props } ) : createElement( BlockEdit, props ) ),
		'withOriginCanvasPaletteNames'
	);

	wp.hooks.addFilter( 'editor.BlockEdit', 'origin-canvas/palette-names', withNewNames );
} )( window.wp, window.originCanvasEditorPalette );
