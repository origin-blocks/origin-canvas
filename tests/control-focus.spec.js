/**
 * Keyboard focus on a checkbox or radio (#119, #138). Unchecked, focus is the field's primary
 * border and 25% ring. Checked, the border is already primary, so focus adds a 2px outline in
 * the text color, offset from the ring: dark on a light ground, light on a dark band, and it
 * clears 3:1 against the ground either way. The page is served from memory with the real
 * style.css and core-comments.css (the comment form's consent checkbox has its own rules) and
 * the palette from theme.json, so there is no WordPress in the loop. Set
 * CONTROL_FOCUS_SHOTS to a folder to save crops at 1440 and 390 for a review.
 */
const { test, expect } = require( '@playwright/test' );
const fs = require( 'fs' );
const path = require( 'path' );
const { ORIGIN, PAGE_URL, servePage } = require( './fixture' );

const theme = JSON.parse( fs.readFileSync( path.join( __dirname, '..', 'theme.json' ), 'utf8' ) );
const vars = theme.settings.color.palette.map( ( p ) => `--wp--preset--color--${ p.slug }: ${ p.color };` ).join( ' ' )
	+ theme.settings.spacing.spacingSizes.map( ( p ) => `--wp--preset--spacing--${ p.slug }: ${ p.size };` ).join( ' ' )
	+ Object.entries( theme.settings.custom.radius ).map( ( [ k, v ] ) => `--wp--custom--radius--${ k }: ${ v };` ).join( ' ' );

const CONTROLS = [ 'checkbox', 'radio' ];
const PRIMARY = 'rgb(' + theme.settings.color.palette.find( ( p ) => p.slug === 'primary' ).color.replace( '#', '' ).match( /../g ).map( ( h ) => parseInt( h, 16 ) ).join( ', ' ) + ')';
const page_html = () => {
	const group = ( ground ) => CONTROLS.map( ( t ) => [ false, true ].map( ( checked ) => `<label><input type="${ t }" id="${ ground }-${ t }-${ checked ? 'checked' : 'unchecked' }"${ checked ? ' checked' : '' }${ t === 'radio' ? ` name="${ ground }-${ checked }"` : '' }> ${ t }${ checked ? ', checked' : '' }</label>` ).join( '' ) ).join( '' );
	return `<!doctype html><html><head><meta charset="utf-8"><link rel="stylesheet" href="${ ORIGIN }/style.css"><link rel="stylesheet" href="${ ORIGIN }/core-comments.css"><style>:root { ${ vars } } body { margin: 0; padding: 32px; color: ${ theme.styles.color.text }; background: #fff; font: 16px/1.5 sans-serif; } .ground { display: flex; flex-wrap: wrap; gap: 24px 32px; padding: 32px; } .dark { background: var(--wp--preset--color--contrast); color: var(--wp--preset--color--base-2); } label { display: flex; align-items: center; gap: 12px; }</style></head><body><a id="start" href="#">start</a><div class="ground light">${ group( 'light' ) }</div><div class="ground dark">${ group( 'dark' ) }</div><div class="ground light wp-block-comments"><form class="wp-block-post-comments-form"><p class="comment-form-cookies-consent"><input type="checkbox" id="wp-comment-cookies-consent" checked><label for="wp-comment-cookies-consent">consent, checked (the comment form)</label></p></form></div></body></html>`;
};

const rgb = ( s ) => s.match( /\d+(\.\d+)?/g ).slice( 0, 3 ).map( Number );
const lum = ( [ r, g, b ] ) => { const f = ( c ) => { c /= 255; return c <= 0.03928 ? c / 12.92 : ( ( c + 0.055 ) / 1.055 ) ** 2.4; }; return 0.2126 * f( r ) + 0.7152 * f( g ) + 0.0722 * f( b ); };
const contrast = ( a, b ) => { const [ x, y ] = [ lum( a ), lum( b ) ]; return ( Math.max( x, y ) + 0.05 ) / ( Math.min( x, y ) + 0.05 ); };

for ( const width of [ 1440, 390 ] ) {
	test( `checked controls get a 3:1 focus cue, unchecked keep the ring (${ width })`, async ( { page } ) => {
		await page.setViewportSize( { width, height: 700 } );
		await servePage( page, page_html(), PAGE_URL );
		await page.goto( PAGE_URL );
		await page.focus( '#start' );
		const shots = process.env.CONTROL_FOCUS_SHOTS;
		for ( const ground of [ 'light', 'dark' ] ) {
			for ( const type of CONTROLS ) {
				for ( const checked of [ false, true ] ) {
					const id = `${ ground }-${ type }-${ checked ? 'checked' : 'unchecked' }`;
					await page.keyboard.press( 'Tab' );
					await page.waitForTimeout( 250 ); // the 120ms border and ring fade
					const s = await page.evaluate( ( id ) => {
						const el = document.getElementById( id );
						const cs = getComputedStyle( el );
						// The ground behind the control: the nearest ancestor that paints a background.
						let node = el.parentElement, ground = 'rgba(0, 0, 0, 0)';
						while ( node && ground === 'rgba(0, 0, 0, 0)' ) { ground = getComputedStyle( node ).backgroundColor; node = node.parentElement; }
						const g = el.closest( '.ground' ).getBoundingClientRect(); const r = el.getBoundingClientRect();
						const inside = r.left - 4 >= g.left && r.right + 4 <= g.right && r.top - 4 >= g.top && r.bottom + 4 <= g.bottom;
						return { focused: el.matches( ':focus-visible' ), outlineStyle: cs.outlineStyle, outlineWidth: cs.outlineWidth, outlineColor: cs.outlineColor, offset: cs.outlineOffset, color: cs.color, border: cs.borderColor, shadow: cs.boxShadow, ground, background: cs.backgroundColor, inside };
					}, id );
					if ( shots ) {
						const box = await page.locator( '#' + id ).boundingBox();
						await page.screenshot( { path: path.join( shots, `${ id }-${ width }.png` ), clip: { x: box.x - 12, y: box.y - 12, width: box.width + 24, height: box.height + 24 } } );
					}
					expect( s.focused, `${ id }: Tab reaches it` ).toBe( true );
					expect( s.inside, `${ id }: the control and its outline sit inside the painted ground` ).toBe( true );
					expect( s.border, `${ id }: primary border on focus` ).toBe( PRIMARY );
					expect( s.shadow, `${ id }: the ring` ).not.toBe( 'none' );
					if ( checked ) {
						expect( s.outlineStyle, `${ id }: outline` ).toBe( 'solid' );
						expect( s.outlineWidth, `${ id }: 2px` ).toBe( '2px' );
						expect( s.offset, `${ id }: offset 2px` ).toBe( '2px' );
						expect( s.outlineColor, `${ id }: the text color` ).toBe( s.color );
						expect( contrast( rgb( s.outlineColor ), rgb( s.ground ) ), `${ id }: 3:1 against the ground` ).toBeGreaterThanOrEqual( 3 );
					} else {
						expect( s.outlineStyle, `${ id }: no outline` ).toBe( 'none' );
					}
				}
			}
		}
		// The comment form's consent checkbox has its own, more specific rules in core-comments.css.
		await page.keyboard.press( 'Tab' );
		await page.waitForTimeout( 250 );
		const c = await page.evaluate( () => {
			const el = document.getElementById( 'wp-comment-cookies-consent' );
			const cs = getComputedStyle( el );
			return { focused: el.matches( ':focus-visible' ), outlineStyle: cs.outlineStyle, outlineWidth: cs.outlineWidth, outlineColor: cs.outlineColor, color: cs.color, border: cs.borderColor };
		} );
		if ( shots ) {
			const box = await page.locator( '#wp-comment-cookies-consent' ).boundingBox();
			await page.screenshot( { path: path.join( shots, `consent-checked-${ width }.png` ), clip: { x: box.x - 12, y: box.y - 12, width: box.width + 24, height: box.height + 24 } } );
		}
		expect( c.focused, 'consent: Tab reaches it' ).toBe( true );
		expect( c.border, 'consent: primary border' ).toBe( PRIMARY );
		expect( c.outlineStyle, 'consent: outline' ).toBe( 'solid' );
		expect( c.outlineWidth, 'consent: 2px' ).toBe( '2px' );
		expect( c.outlineColor, 'consent: the text color' ).toBe( c.color );
	} );
}
