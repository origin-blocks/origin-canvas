/**
 * A button's hover, keyboard focus and press are its own label color laid over its own
 * fill (#146): 12% and 20% for a filled button, 6% and 10% for an outline one, with no
 * lift and no hover shadow. The page is served from memory with the real style.css and
 * core-button.css; the rest values come from theme.json at run time, written against the
 * selectors WordPress generates (the variation on the wrapper) plus core's own rule for the
 * style class saved on the link, so there is no WordPress in the loop. The painted result is read
 * from screenshots at text-free points, so the test proves the tint and not only the
 * numbers. The theme.json removals are bin/check-button-hover.sh's job.
 */
const { test, expect } = require( '@playwright/test' );
const fs = require( 'fs' );
const path = require( 'path' );
const { PNG } = require( 'playwright-core/lib/utilsBundle' );
const { ORIGIN, PAGE_URL, servePage } = require( './fixture' );

const THEME_ROOT = path.join( __dirname, '..' );
const theme = JSON.parse( fs.readFileSync( path.join( THEME_ROOT, 'theme.json' ), 'utf8' ) );
const button = theme.styles.blocks[ 'core/button' ];

function presetVars() {
	const lines = [];
	for ( const p of theme.settings.color.palette ) lines.push( `--wp--preset--color--${ p.slug }: ${ p.color };` );
	for ( const p of theme.settings.spacing.spacingSizes ) lines.push( `--wp--preset--spacing--${ p.slug }: ${ p.size };` );
	for ( const p of theme.settings.typography.fontSizes ) lines.push( `--wp--preset--font-size--${ p.slug }: ${ p.size };` );
	for ( const p of theme.settings.shadow.presets ) lines.push( `--wp--preset--shadow--${ p.slug }: ${ p.shadow };` );
	for ( const [ k, v ] of Object.entries( theme.settings.custom.radius || {} ) ) lines.push( `--wp--custom--radius--${ k }: ${ v };` );
	return `:root { ${ lines.join( ' ' ) } }`;
}

// The rest declarations for one node of theme.json (core/button or a variation), as the
// generated stylesheet would write them, with no state.
function restRule( selector, node ) {
	const d = [];
	if ( node.color?.background ) d.push( `background-color: ${ node.color.background }` );
	if ( node.color?.text ) d.push( `color: ${ node.color.text }` );
	if ( node.border?.color ) d.push( `border-color: ${ node.border.color }` );
	if ( node.border?.style ) d.push( `border-style: ${ node.border.style }` );
	if ( node.border?.width ) d.push( `border-width: ${ node.border.width }` );
	if ( node.border?.radius ) d.push( `border-radius: ${ node.border.radius }` );
	if ( node.spacing?.padding ) for ( const [ side, v ] of Object.entries( node.spacing.padding ) ) d.push( `padding-${ side }: ${ v }` );
	if ( node.typography?.fontSize ) d.push( `font-size: ${ node.typography.fontSize }` );
	if ( node.typography?.fontWeight ) d.push( `font-weight: ${ node.typography.fontWeight }` );
	return `${ selector } { ${ d.join( '; ' ) }; }`;
}

function restStyles() {
	const rules = [ restRule( '.wp-block-button .wp-block-button__link', button ) ];
	for ( const [ name, node ] of Object.entries( button.variations ) ) {
		rules.push( restRule( `.wp-block-button.is-style-${ name } .wp-block-button__link`, node ) );
	}
	rules.push( '.wp-block-button .wp-block-button__link { display: inline-block; text-decoration: none; line-height: 1.2; }' );
	// Core's own rules for the style class saved on the link (wp-block-library style.css);
	// WordPress generates the theme.json variation selector on the wrapper only, and the
	// wrapper form takes those rest values above.
	rules.push( '.wp-block-button__link.is-style-outline:not(.has-text-color) { color: currentColor; }' );
	rules.push( '.wp-block-button__link.is-style-outline:not(.has-background) { background-color: transparent; background-image: none; }' );
	rules.push( '.wp-block-button__link.is-style-outline { border: 2px solid currentColor; padding: .667em 1.333em; }' );
	rules.push( `body { color: ${ theme.styles.color.text }; }` );
	rules.push( '.wp-block-button .wp-block-button__link.has-base-2-background-color { background-color: var(--wp--preset--color--base-2); }' );
	rules.push( '.wp-block-button .wp-block-button__link.has-contrast-color { color: var(--wp--preset--color--contrast); }' );
	rules.push( '.dark { background: var(--wp--preset--color--contrast); padding: 24px; }' );
	rules.push( 'body { margin: 0; padding: 40px; background: #fff; } .row { display: flex; gap: 24px; align-items: center; margin-bottom: 24px; }' );
	return rules.join( '\n' );
}

const hex = ( c ) => c.replace( '#', '' ).match( /../g ).map( ( h ) => parseInt( h, 16 ) );
const palette = Object.fromEntries( theme.settings.color.palette.map( ( p ) => [ p.slug, p.color ] ) );
const slug = ( v ) => v.match( /--wp--preset--color--([a-z0-9-]+)/ )?.[ 1 ];

// Each kind: its markup, its expected rest fill and label, and its overlay shares. The
// white-on-dark kind is the issue's case: the demo's dark band button, a default button with
// preset classes for a light fill and a dark label. Outline Strong is the retired style whose
// rest rule and states live in core-button.css for buttons saved with it.
const KINDS = [
	{ id: 'default', wrap: '', link: '', fill: palette[ slug( button.color.background ) ], text: palette[ slug( button.color.text ) ], shares: [ 0.12, 0.2 ] },
	{ id: 'fill-primary', wrap: 'is-style-origin-canvas-fill-primary', link: '', fill: palette[ slug( button.variations[ 'origin-canvas-fill-primary' ].color.background ) ], text: palette[ slug( button.variations[ 'origin-canvas-fill-primary' ].color.text ) ], shares: [ 0.12, 0.2 ] },
	{ id: 'outline', wrap: 'is-style-outline', link: '', fill: null, ground: '#FFFFFF', text: palette[ slug( button.variations.outline.color.text ) ], shares: [ 0.06, 0.1 ] },
	{ id: 'outline-strong', wrap: 'is-style-origin-canvas-outline-strong', link: '', fill: null, ground: '#FFFFFF', text: palette.contrast, shares: [ 0.06, 0.1 ] },
	{ id: 'outline-on-link', wrap: '', link: 'is-style-outline', fill: null, ground: '#FFFFFF', text: palette[ slug( theme.styles.color.text ) ], shares: [ 0.06, 0.1 ] },
	{ id: 'white-on-dark', wrap: '', link: 'has-base-2-background-color has-contrast-color has-text-color has-background', fill: palette[ 'base-2' ], text: palette.contrast, ground: palette.contrast, shares: [ 0.12, 0.2 ], dark: true },
	{ id: 'outline-light', wrap: 'is-style-origin-canvas-outline-light', link: '', fill: null, ground: palette.contrast, text: palette[ slug( button.variations[ 'origin-canvas-outline-light' ].color.text ) ], shares: [ 0.06, 0.1 ], dark: true },
	{ id: 'custom', wrap: '', link: '', style: 'background-color:#FFD400;color:#1A1A1A', fill: '#FFD400', text: '#1A1A1A', shares: [ 0.12, 0.2 ] },
	{ id: 'gradient', wrap: '', link: '', style: 'background:linear-gradient(90deg,#0044AA 0 50%,#AA2200 50% 100%);color:#FFFFFF', fillLeft: '#0044AA', fillRight: '#AA2200', text: '#FFFFFF', shares: [ 0.12, 0.2 ] },
];

function renderButtons() {
	const light = KINDS.filter( ( k ) => ! k.dark ).map( ( k ) => `<div class="wp-block-button ${ k.wrap }"><a id="${ k.id }" class="wp-block-button__link wp-element-button ${ k.link }" href="#"${ k.style ? ` style="${ k.style }"` : '' }>Button label</a></div>` ).join( '' );
	const dark = KINDS.filter( ( k ) => k.dark ).map( ( k ) => `<div class="wp-block-button ${ k.wrap }"><a id="${ k.id }" class="wp-block-button__link wp-element-button ${ k.link }" href="#">Button label</a></div>` ).join( '' );
	return `<!doctype html><html><head><meta charset="utf-8"><link rel="stylesheet" href="${ ORIGIN }/style.css"><link rel="stylesheet" href="${ ORIGIN }/core-button.css"><style>${ presetVars() }\n${ restStyles() }</style></head><body><div class="row">${ light }</div><div class="row dark">${ dark }</div><div id="park" style="height:200px"></div></body></html>`;
}

async function state( page, id ) {
	return page.evaluate( ( id ) => {
		const el = document.getElementById( id );
		const cs = getComputedStyle( el );
		const after = getComputedStyle( el, '::after' );
		return {
			transform: cs.transform, translate: cs.translate, shadow: cs.boxShadow, background: cs.backgroundColor, backgroundImage: cs.backgroundImage, color: cs.color, border: cs.borderColor,
			afterContent: after.content, afterBackground: after.backgroundColor, afterOpacity: Number( after.opacity ),
			transition: cs.transitionDuration, afterTransition: after.transitionDuration, transitionProperty: cs.transitionProperty, afterTransitionProperty: after.transitionProperty,
			hover: el.matches( ':hover' ), focusVisible: el.matches( ':focus-visible' ),
		};
	}, id );
}

async function samples( page, id ) {
	const box = await page.locator( '#' + id ).boundingBox();
	const png = PNG.sync.read( await page.screenshot( { clip: box } ) );
	const read = ( x, y ) => { const i = ( Math.round( y ) * png.width + Math.round( x ) ) * 4; return [ png.data[ i ], png.data[ i + 1 ], png.data[ i + 2 ] ]; };
	return { left: read( 6, box.height / 2 ), right: read( box.width - 7, box.height / 2 ) };
}

const mix = ( fill, text, share ) => fill.map( ( f, i ) => Math.round( f * ( 1 - share ) + text[ i ] * share ) );
const near = ( a, b, tol = 3 ) => a.every( ( v, i ) => Math.abs( v - b[ i ] ) <= tol );
const settle = ( page ) => page.waitForTimeout( 350 );
// A computed duration in milliseconds: '0.2s' is 200, '0.01ms' is 0.01.
const ms = ( d ) => { const t = d.trim(); const n = parseFloat( t ); return t.endsWith( 'ms' ) ? n : n * 1000; };

for ( const reduced of [ false, true ] ) {
	test.describe( reduced ? 'with reduced motion' : 'with motion', () => {
		test.use( { hasTouch: false } );

		test( 'every kind: no lift, no shadow, the label color over the fill by state', async ( { page } ) => {
			await page.emulateMedia( { reducedMotion: reduced ? 'reduce' : 'no-preference' } );
			await servePage( page, renderButtons(), PAGE_URL );
			await page.goto( PAGE_URL );
			expect( await page.evaluate( () => matchMedia( '(prefers-reduced-motion: reduce)' ).matches ), 'reduced-motion emulation' ).toBe( reduced );
			for ( const kind of KINDS ) {
				const rest = await state( page, kind.id );
				expect( rest.afterContent, `${ kind.id }: core-button.css loaded` ).toBe( '""' );
				const fillLeft = kind.fillLeft || kind.fill || kind.ground;
				const fillRight = kind.fillRight || kind.fill || kind.ground;
				if ( kind.fill ) expect( rest.background, `${ kind.id }: rest fill` ).toBe( `rgb(${ hex( kind.fill ).join( ', ' ) })` );
				else if ( ! kind.fillLeft ) expect( rest.background, `${ kind.id }: outline is transparent` ).toBe( 'rgba(0, 0, 0, 0)' );
				else expect( rest.backgroundImage, `${ kind.id }: gradient` ).toContain( 'linear-gradient' );
				expect( rest.color, `${ kind.id }: rest label` ).toBe( `rgb(${ hex( kind.text ).join( ', ' ) })` );
				expect( rest.afterOpacity, `${ kind.id}: no overlay at rest` ).toBe( 0 );
				const restPx = await samples( page, kind.id );
				expect( near( restPx.left, hex( fillLeft ) ), `${ kind.id }: rest paints the fill (left)` ).toBe( true );
				expect( near( restPx.right, hex( fillRight ) ), `${ kind.id }: rest paints the fill (right)` ).toBe( true );

				const check = async ( label, share ) => {
					const s = await state( page, kind.id );
					expect( s.transform, `${ kind.id } ${ label }: no lift` ).toBe( 'none' );
					expect( s.translate, `${ kind.id } ${ label }: no translate` ).toBe( 'none' );
					expect( s.border, `${ kind.id } ${ label }: border unchanged` ).toBe( rest.border );
					expect( s.shadow, `${ kind.id } ${ label }: no shadow` ).toBe( 'none' );
					expect( s.background, `${ kind.id } ${ label }: fill unchanged` ).toBe( rest.background );
					expect( s.color, `${ kind.id } ${ label }: label unchanged` ).toBe( rest.color );
					expect( s.afterBackground, `${ kind.id } ${ label }: overlay is the label color` ).toBe( rest.color );
					expect( s.afterOpacity, `${ kind.id } ${ label }: overlay share` ).toBeCloseTo( share, 2 );
					if ( reduced ) {
						for ( const d of [ s.transition, s.afterTransition ] ) for ( const part of d.split( ',' ) ) expect( ms( part ), `${ kind.id } ${ label }: reduced motion (${ part.trim() })` ).toBeLessThanOrEqual( 0.01 );
					} else {
						// The 200ms fade: color, background and border on the link, opacity on the layer.
						expect( s.transition.split( ',' ).map( ms ), `${ kind.id } ${ label }: the link fades in 200ms` ).toEqual( [ 200, 200, 200 ] );
						expect( s.transitionProperty, `${ kind.id } ${ label }: the link fades color, background and border` ).toBe( 'color, background-color, border-color' );
						expect( ms( s.afterTransition ), `${ kind.id } ${ label }: the layer fades in 200ms` ).toBe( 200 );
						expect( s.afterTransitionProperty, `${ kind.id } ${ label }: the layer fades its opacity` ).toBe( 'opacity' );
					}
					const px = await samples( page, kind.id );
					expect( near( px.left, mix( hex( fillLeft ), hex( kind.text ), share ) ), `${ kind.id } ${ label }: painted mix (left) ${ px.left } vs ${ mix( hex( fillLeft ), hex( kind.text ), share ) }` ).toBe( true );
					expect( near( px.right, mix( hex( fillRight ), hex( kind.text ), share ) ), `${ kind.id } ${ label }: painted mix (right)` ).toBe( true );
					expect( near( px.left, restPx.left, 0 ), `${ kind.id } ${ label }: differs from rest` ).toBe( false );
				};

				await page.hover( '#' + kind.id );
				await settle( page );
				expect( ( await state( page, kind.id ) ).hover ).toBe( true );
				await check( 'hover', kind.shares[ 0 ] );

				await page.mouse.down();
				await settle( page );
				await check( 'press', kind.shares[ 1 ] );
				await page.mouse.up();

				await page.mouse.move( 5, 5 );
				await page.locator( '#park' ).click( { position: { x: 5, y: 5 } } );
				await page.evaluate( ( id ) => { const el = document.getElementById( id ); el.focus(); }, kind.id );
				await page.keyboard.press( 'Shift+Tab' );
				await page.keyboard.press( 'Tab' );
				await settle( page );
				const f = await state( page, kind.id );
				expect( f.focusVisible, `${ kind.id }: keyboard focus` ).toBe( true );
				expect( f.hover, `${ kind.id }: pointer parked` ).toBe( false );
				await check( 'focus', kind.shares[ 0 ] );
				await page.evaluate( () => document.activeElement.blur() );
				await settle( page );
			}
		} );
	} );
}
