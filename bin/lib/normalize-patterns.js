/**
 * Runs every pattern body through the editor's own parse and serialize, in a real editor page
 * (the block-validity draft's session), so the file holds what the editor saves (#111).
 * Usage: node bin/lib/normalize-patterns.js <state.json> <bodies.json> <out.json>
 * bodies.json: { "<file>": "<markup with placeholders>" }. out.json: the same keys with the
 * serialized markup. The page is never saved; the editor only runs the block code.
 */
const fs = require( 'fs' );
const { chromium } = require( '@playwright/test' );
const [ , , statePath, bodiesPath, outPath ] = process.argv;
const state = JSON.parse( fs.readFileSync( statePath, 'utf8' ) );
const bodies = JSON.parse( fs.readFileSync( bodiesPath, 'utf8' ) );
( async () => {
	const browser = await chromium.launch();
	const context = await browser.newContext();
	const host = new URL( state.url ).hostname;
	await context.addCookies( state.cookies.map( ( c ) => ( { ...c, domain: host, path: '/', httpOnly: true } ) ) );
	const page = await context.newPage();
	await page.goto( state.url, { waitUntil: 'domcontentloaded', timeout: 300000 } );
	await page.waitForFunction( () => window.wp?.blocks?.serialize && window.wp?.data?.select( 'core/block-editor' )?.getBlockCount() >= 0, null, { timeout: 300000 } );
	const out = await page.evaluate( ( bodies ) => {
		const result = {};
		const quiet = [ 'groupCollapsed', 'groupEnd', 'info', 'warn', 'error', 'log' ];
		const saved = Object.fromEntries( quiet.map( ( k ) => [ k, console[ k ] ] ) );
		try {
			quiet.forEach( ( k ) => ( console[ k ] = () => {} ) );
			for ( const [ file, markup ] of Object.entries( bodies ) ) {
				result[ file ] = window.wp.blocks.serialize( window.wp.blocks.parse( markup ) );
			}
		} finally {
			Object.assign( console, saved );
		}
		return result;
	}, bodies );
	fs.writeFileSync( outPath, JSON.stringify( out ) );
	await browser.close();
} )().catch( ( e ) => { console.error( e.message ); process.exit( 1 ); } );
