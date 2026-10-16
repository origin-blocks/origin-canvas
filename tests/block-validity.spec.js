/**
 * Every pattern loads in the block editor with no invalid block.
 *
 * bin/check-block-validity.sh makes a draft, the markup of every registered pattern (each
 * inside a Group classed `ocbv--<slug>`) and a login session of its own; this spec opens the
 * draft in a fresh Chromium profile, loads every pattern into it and reads, per pattern:
 *   - invalid: blocks the editor marks invalid (isValid false), from the editor's store;
 *   - prompts: "Attempt recovery" warnings drawn in the editor canvas;
 *   - rewritten: blocks the parser fixed on its own as it loaded them, so the editor would
 *     save different markup with no prompt. Reported, not failed.
 * On its own it is skipped, so `npm test` stays a WordPress-free suite.
 */
const fs = require( 'fs' );
const { test, expect } = require( '@playwright/test' );

const CONFIG = process.env.BLOCK_VALIDITY
	? JSON.parse( fs.readFileSync( process.env.BLOCK_VALIDITY, 'utf8' ) )
	: null;

function measure() {
	const editor = window.wp.data.select( 'core/block-editor' );
	const frame = document.querySelector( 'iframe[name="editor-canvas"]' );
	const doc = frame ? frame.contentDocument : document;

	function issue( block ) {
		const first = ( block.validationIssues || [] )[ 0 ];
		if ( ! first ) {
			return block.name;
		}
		let i = 0;
		const text = String( first.args[ 0 ] ).replace( /%[so]/g, () => {
			const arg = first.args[ ++i ];
			return typeof arg === 'string' ? arg : JSON.stringify( arg );
		} );
		return block.name + ': ' + text.replace( /\s+/g, ' ' ).slice( 0, 240 );
	}

	return editor.getBlocks().map( ( wrapper ) => {
		const match = /(?:^|\s)ocbv--(\S+)/.exec( wrapper.attributes.className || '' );
		const invalid = [];
		( function walk( block ) {
			if ( block.isValid === false ) {
				invalid.push( issue( block ) );
			}
			block.innerBlocks.forEach( walk );
		} )( wrapper );
		const el = doc.querySelector( '[data-block="' + wrapper.clientId + '"]' );
		const prompts = el
			? [ ...el.querySelectorAll( '.block-editor-warning' ) ].filter( ( w ) =>
					/attempt recovery/i.test( w.textContent )
			  ).length
			: null;
		return { slug: match ? match[ 1 ] : '', name: wrapper.name, invalid, prompts };
	} );
}

// Load every pattern into the draft, as the inserter does: parse each pattern's markup on its
// own, counting the parser's "Updated Block" logs (blocks it changed while loading, with no
// prompt), then put all the blocks in the editor. Saving is locked, so the draft keeps its one
// paragraph.
function load( patterns ) {
	const editor = window.wp.data.dispatch( 'core/editor' );
	editor.lockPostSaving( 'ocbv' );
	editor.lockPostAutosaving( 'ocbv' );
	const quiet = [ 'groupCollapsed', 'groupEnd', 'info', 'warn', 'error', 'log' ];
	const saved = Object.fromEntries( quiet.map( ( k ) => [ k, console[ k ] ] ) );
	const blocks = [];
	const rewritten = {};
	try {
		for ( const markup of patterns ) {
			const slug = /ocbv--([a-z0-9-]+)/.exec( markup )[ 1 ];
			const names = [];
			quiet.forEach( ( k ) => ( console[ k ] = () => {} ) );
			console.groupCollapsed = ( format, name ) => {
				if ( /^Updated Block/.test( format ) ) {
					names.push( name );
				}
			};
			blocks.push( ...window.wp.blocks.parse( markup ) );
			rewritten[ slug ] = names;
		}
	} finally {
		Object.assign( console, saved );
	}
	editor.resetEditorBlocks( blocks );
	return rewritten;
}

test.describe( 'every pattern loads in the editor without invalid blocks', () => {
	test.skip( ! CONFIG, 'Run by bin/check-block-validity.sh, which makes the draft.' );

	test( 'patterns in one editor draft', async ( { browser } ) => {
		test.setTimeout( 15 * 60 * 1000 );
		const host = new URL( CONFIG.url ).hostname;
		const context = await browser.newContext( { viewport: { width: 1440, height: 900 } } );
		await context.addCookies(
			CONFIG.cookies.map( ( c ) => ( { ...c, domain: host, path: '/', httpOnly: true } ) )
		);
		const page = await context.newPage();
		await page.goto( CONFIG.url, { waitUntil: 'domcontentloaded', timeout: 300000 } );
		expect( page.url(), 'the editor opened (not the login screen)' ).toContain( 'post.php' );

		await page.waitForFunction(
			() =>
				window.wp?.data?.select( 'core/editor' )?.__unstableIsEditorReady?.() &&
				window.wp.data.select( 'core/block-editor' ).getBlockCount() > 0,
			null,
			{ timeout: 300000, polling: 1000 }
		);
		const fixed = await page.evaluate( load, CONFIG.patterns );

		// The canvas draws blocks over a few frames. Read until two reads two seconds apart
		// agree and every wrapper is drawn.
		let rows = [];
		let last = '';
		for ( let i = 0; i < 60; i++ ) {
			rows = await page.evaluate( measure );
			const now = JSON.stringify( rows );
			if ( now === last && rows.every( ( r ) => r.prompts !== null ) ) {
				break;
			}
			last = now;
			await page.waitForTimeout( 2000 );
		}
		await context.close();

		const lines = [];
		let failed = 0;
		if ( ! CONFIG.slugs.length ) {
			lines.push( '  ✗  no patterns to check' );
			failed++;
		}
		const seen = new Set( rows.map( ( r ) => r.slug ) );
		for ( const slug of CONFIG.slugs ) {
			if ( ! seen.has( slug ) ) {
				lines.push( `  ✗  ${ slug }: not found in the editor` );
				failed++;
			}
		}
		for ( const row of rows ) {
			if ( ! row.slug ) {
				lines.push( `  ✗  a ${ row.name } block sits outside every pattern wrapper` );
				failed++;
				continue;
			}
			const prompts = row.prompts === null ? 'not drawn' : row.prompts;
			if ( row.invalid.length || row.prompts ) {
				failed++;
				lines.push(
					`  ✗  ${ row.slug }: ${ row.invalid.length } invalid, ${ prompts } recovery prompts`
				);
				row.invalid.slice( 0, 3 ).forEach( ( text ) => lines.push( `       ${ text }` ) );
			} else if ( row.prompts === null ) {
				failed++;
				lines.push( `  ✗  ${ row.slug }: not drawn in the canvas, so prompts were not counted` );
			}
			const names = fixed[ row.slug ] || [];
			if ( names.length ) {
				lines.push(
					`  !  ${ row.slug }: ${ names.length } blocks rewritten on load, no prompt (${ [
						...new Set( names ),
					].join( ', ' ) })`
				);
			}
		}

		console.log( 'Block validity:' );
		console.log( lines.join( '\n' ) || '' );
		console.log(
			failed
				? `FAIL: ${ failed } of ${ CONFIG.slugs.length } patterns`
				: `  ✓  ${ CONFIG.slugs.length } patterns: 0 invalid blocks, 0 recovery prompts\nPASS`
		);
		expect( failed, 'patterns with invalid blocks or recovery prompts' ).toBe( 0 );
	} );
} );
