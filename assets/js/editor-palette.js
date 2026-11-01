/**
 * Origin Canvas: hands a block's edit component the colour slug the palette holds, old or new, on
 * a pre-rename site (#116). A tool that moves saved content is separate.
 *
 * A block's edit component looks a colour slug up in the palette (core's withColors), so a slug
 * the palette lacks renders with no colour: a Cover's overlay, for one. Edit components get the
 * other name instead, read from the same three origins core reads: the new slug for an old one
 * the palette lacks and holds the new one for, and the first of its old slugs in the map's order
 * for a new one the palette lacks, as a saved palette that lists only old slugs does. The stored
 * attributes stay as saved, so nothing the editor saves changes.
 */
( function ( wp, config ) {
	if ( ! wp || ! wp.hooks || ! wp.compose || ! wp.element || ! wp.blockEditor || ! wp.blockEditor.useSettings || ! config ) {
		return;
	}
	const { createElement, useMemo } = wp.element;
	const map = config.map || {};
	const attrs = config.attrs || [];

	const has = ( object, key ) => Object.prototype.hasOwnProperty.call( object, key );
	const olds = {};
	for ( const old of Object.keys( map ) ) {
		olds[ map[ old ] ] = [ ...( has( olds, map[ old ] ) ? olds[ map[ old ] ] : [] ), old ];
	}

	const nameIn = ( v, slugs ) => {
		if ( typeof v !== 'string' || slugs.has( v ) ) {
			return v;
		}
		if ( has( map, v ) ) {
			return slugs.has( map[ v ] ) ? map[ v ] : v;
		}
		return ( has( olds, v ) && olds[ v ].find( ( old ) => slugs.has( old ) ) ) || v;
	};

	// Every block takes this path: a wrapper that came and went with the slug would mount the edit
	// component and core's colour controls again at a first pick, closing the open dropdown. Core
	// makes the same palette read for every block (the color support's useBlockProps).
	const withNames = wp.compose.createHigherOrderComponent(
		( BlockEdit ) => ( props ) => {
			const [ custom, theme, defaults ] = wp.blockEditor.useSettings( 'color.palette.custom', 'color.palette.theme', 'color.palette.default' );
			const attributes = useMemo( () => {
				const slugs = new Set( [ ...( custom || [] ), ...( theme || [] ), ...( defaults || [] ) ].map( ( c ) => c && c.slug ) );
				let next = null;
				for ( const a of attrs ) {
					const v = props.attributes[ a ];
					const name = nameIn( v, slugs );
					if ( name !== v ) {
						next = next || { ...props.attributes };
						next[ a ] = name;
					}
				}
				return next || props.attributes;
			}, [ props.attributes, custom, theme, defaults ] );
			return createElement( BlockEdit, attributes === props.attributes ? props : { ...props, attributes } );
		},
		'withOriginCanvasPaletteNames'
	);

	wp.hooks.addFilter( 'editor.BlockEdit', 'origin-canvas/palette-names', withNames );
} )( window.wp, window.originCanvasEditorPalette );
