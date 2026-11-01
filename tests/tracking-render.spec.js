/**
 * Tracking follows size, as rendered (CLAUDE.md rule 7; ODS "Tracking follows size").
 *
 * bin/check-tracking-tokens.sh reads the block markup. This spec reads the page: an
 * inherited value, a CSS rule or a size class that loses to an inline pin only shows here.
 * bin/check-tracking-render.sh makes the page and runs the spec; on its own it is skipped,
 * so `npm test` stays a WordPress-free suite.
 *
 * For every element with visible text of its own (and every ::before / ::after that holds
 * a letter or digit) inside each root, at 1440 and 390, under the default style and each
 * style variation, the letter spacing must be:
 *   - 0.06em on uppercase text, and on a run of digits that tracks at all (numbers set as
 *     labels);
 *   - the size band's token at 19px and up: 27px and up display, above 22px large, 19px and
 *     up medium (a 22px size takes either neighbour);
 *   - the base token on a heading below 19px (h1-h6, or a site title);
 *   - normal on any other text below 19px.
 * The band is read from the 1440 size, where the fluid sizes are at their scale steps; at
 * 390 the same element must keep the same em value. The token values are read from the
 * page's own :root, so a variation that retunes them is checked against its own values.
 * Tolerance ±0.0015em. Type specimens are exempt by pattern, text and value.
 */
const fs = require( 'fs' );
const { test, expect } = require( '@playwright/test' );

const CONFIG = process.env.TRACKING_RENDER
	? JSON.parse( fs.readFileSync( process.env.TRACKING_RENDER, 'utf8' ) )
	: null;

const WIDTHS = [ 1440, 390 ];
const TOLERANCE = 0.0015;
const LABEL = 0.06;

// The value IS the content: each specimen shows a face at its own tracking.
const SPECIMENS = [
	{ pattern: 'style-variations', text: 'Ag', values: [ -0.02, -0.015, 0 ] },
	{ pattern: 'token-system', text: 'Aa', values: [ -0.02 ] },
];

function measure( roots ) {
	const TOKENS = [ 'display', 'large', 'medium', 'base' ];
	const rootStyle = getComputedStyle( document.documentElement );
	const tokens = {};
	for ( const name of TOKENS ) {
		const raw = rootStyle
			.getPropertyValue( '--wp--custom--letter-spacing--' + name )
			.trim();
		tokens[ name ] = /em$/.test( raw ) ? parseFloat( raw ) : null;
	}

	function label( node ) {
		const cls = ( node.getAttribute( 'class' ) || '' )
			.split( /\s+/ )
			.filter( Boolean )
			.slice( 0, 3 )
			.join( '.' );
		return node.tagName.toLowerCase() + ( cls ? '.' + cls : '' );
	}

	// Where the value comes from: the nearest inline pin, or a stylesheet rule.
	function source( el ) {
		for ( let n = el; n && n.nodeType === 1; n = n.parentElement ) {
			if ( n.style && n.style.getPropertyValue( 'letter-spacing' ) ) {
				return (
					'inline ' +
					n.style.getPropertyValue( 'letter-spacing' ) +
					( n === el ? '' : ' on ' + label( n ) )
				);
			}
		}
		return 'stylesheet';
	}

	function visible( el, root ) {
		for ( let p = el; p; p = p.parentElement ) {
			const cs = getComputedStyle( p );
			if ( cs.display === 'none' || cs.visibility === 'hidden' ) {
				return false;
			}
			if ( p === root ) {
				break;
			}
		}
		const rect = el.getBoundingClientRect();
		return rect.width >= 2 && rect.height >= 2;
	}

	const rows = [];
	const scope = {};
	for ( const { selector, pattern } of roots ) {
		scope[ pattern || selector ] = 0;
		document.querySelectorAll( selector ).forEach( ( root, r ) => {
			scope[ pattern || selector ]++;
			root.querySelectorAll( '*' ).forEach( ( el, i ) => {
				if ( el.closest( 'svg, script, style, noscript, template' ) ) {
					return;
				}
				const owner = pattern || ( ( el.closest( '.octr' ) || {} ).className || '' ).replace( /.*octr--([a-z0-9-]+).*/, '$1' );
				const heading = !! el.closest( 'h1, h2, h3, h4, h5, h6, .wp-block-site-title' );
				let text = '';
				for ( const c of el.childNodes ) {
					if ( c.nodeType === 3 ) {
						text += c.textContent;
					}
				}
				text = text.replace( /\s+/g, ' ' ).trim();
				const items = [];
				if ( text ) {
					items.push( [ '', getComputedStyle( el ), text ] );
				}
				for ( const ps of [ '::before', '::after' ] ) {
					const cs = getComputedStyle( el, ps );
					const content = ( cs.content || '' ).replace( /^"|"$/g, '' );
					if ( cs.display !== 'none' && /[\p{L}\p{N}]/u.test( content ) && content !== 'none' && content !== 'normal' ) {
						items.push( [ ps, cs, content ] );
					}
				}
				if ( ! items.length || ! visible( el, root ) ) {
					return;
				}
				for ( const [ ps, cs, t ] of items ) {
					const size = parseFloat( cs.fontSize );
					if ( ! size || parseFloat( cs.opacity ) === 0 ) {
						continue;
					}
					const px = cs.letterSpacing === 'normal' ? 0 : parseFloat( cs.letterSpacing );
					rows.push( {
						key: selector + '|' + r + '|' + i + ps,
						pattern: owner,
						element: label( el ) + ps,
						text: t.slice( 0, 50 ),
						size: Math.round( size * 100 ) / 100,
						em: Math.round( ( px / size ) * 10000 ) / 10000,
						upper: cs.textTransform === 'uppercase',
						heading,
						source: source( el ),
					} );
				}
			} );
		} );
	}
	return { tokens, rows, scope };
}

function expected( row, tokens ) {
	const digits = /^[\d%.,:/ ]+$/.test( row.text );
	if ( row.upper || ( digits && row.em > 0 && row.size < 19 ) ) {
		return [ { value: LABEL, why: 'label 0.06em' } ];
	}
	if ( row.size >= 19 ) {
		let bands = [ 'medium' ];
		if ( row.size >= 27 ) {
			bands = [ 'display' ];
		} else if ( row.size > 22 ) {
			bands = [ 'large' ];
		} else if ( row.size === 22 ) {
			bands = [ 'medium', 'large' ];
		}
		return bands.map( ( b ) => ( { value: tokens[ b ], why: b + ' token' } ) );
	}
	if ( row.heading ) {
		return [ { value: tokens.base, why: 'base token (heading)' } ];
	}
	return [ { value: 0, why: 'normal' } ];
}

function specimen( row ) {
	return SPECIMENS.some(
		( s ) =>
			s.pattern === row.pattern &&
			s.text === row.text &&
			s.values.some( ( v ) => Math.abs( v - row.em ) <= TOLERANCE )
	);
}

test.describe( 'tracking follows size, as rendered', () => {
	test.skip( ! CONFIG, 'Run by bin/check-tracking-render.sh, which makes the page.' );
	test.describe.configure( { mode: 'parallel' } );

	for ( const variation of CONFIG ? CONFIG.variations : [] ) {
		test( `variation: ${ variation || 'default' }`, async ( { browser } ) => {
			const failures = [];
			let base = null;
			for ( const width of WIDTHS ) {
				const context = await browser.newContext( { viewport: { width, height: 900 } } );
				const page = await context.newPage();
				let counted = 0;
				for ( const target of CONFIG.targets ) {
					const url = new URL( target.url );
					if ( CONFIG.octheme ) {
						url.searchParams.set( 'octheme', CONFIG.octheme );
					}
					if ( variation ) {
						url.searchParams.set( 'ocvariation', variation );
					}
					await page.goto( url.toString(), { waitUntil: 'load', timeout: 120000 } );
					await page.evaluate( () => document.fonts.ready );
					const { tokens, rows, scope } = await page.evaluate( measure, target.roots );
					for ( const [ name, found ] of Object.entries( scope ) ) {
						expect( found, `no ${ name } root on ${ url }` ).toBeGreaterThan( 0 );
					}
					for ( const name of Object.keys( tokens ) ) {
						expect( tokens[ name ], `--wp--custom--letter-spacing--${ name } is not in em on ${ url }` ).not.toBeNull();
					}
					base = base || {};
					for ( const row of rows ) {
						counted++;
						if ( specimen( row ) ) {
							continue;
						}
						let want;
						if ( width === WIDTHS[ 0 ] ) {
							want = expected( row, tokens );
							base[ target.url + row.key ] = want;
						} else {
							want = base[ target.url + row.key ];
							if ( ! want ) {
								continue; // Shown only on phones; its band is unknown at this size.
							}
						}
						if ( ! want.some( ( w ) => Math.abs( w.value - row.em ) <= TOLERANCE ) ) {
							failures.push(
								`${ width }  ${ row.pattern || '(page)' }  ${ row.element }  "${ row.text }"  ` +
									`${ row.size }px  ${ row.em }em, expected ${ want.map( ( w ) => `${ w.value }em (${ w.why })` ).join( ' or ' ) }  [${ row.source }]`
							);
						}
					}
				}
				// eslint-disable-next-line no-console
				console.log( `  ${ variation || 'default' } at ${ width }: ${ counted } text elements` );
				await context.close();
			}
			expect( failures, failures.join( '\n' ) ).toEqual( [] );
		} );
	}
} );
