/**
 * Every pattern loads in the block editor with no invalid block and no rewritten block.
 *
 * bin/check-block-validity.sh makes a draft, the markup of every registered pattern (each
 * inside a Group classed `ocbv--<slug>`) and a login session of its own; this spec opens the
 * draft in a fresh Chromium profile, loads every pattern into it and reads, per pattern:
 *   - invalid: blocks the editor marks invalid (isValid false), from the editor's store;
 *   - prompts: "Attempt recovery" warnings drawn in the editor canvas;
 *   - rewritten: blocks the editor changes on its own as it loads them, with no prompt, so it
 *     would save markup that differs from the pattern: a block whose saved HTML is not what
 *     its own settings give, or whose settings change on load (a deprecation migrates them,
 *     or the parser copies unknown classes into the class name). Tidying that keeps the block
 *     the same, such as dropping a setting equal to its default, is not counted.
 * Any of the three fails the pattern. On its own the spec is skipped, so `npm test` stays a
 * WordPress-free suite.
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

// WordPress 7.1 moves these settings on load. 7.0, the theme's minimum, reads only the old
// form, so the patterns keep it until the minimum is 7.1. Each entry: the old attribute, the
// style group and key it moves to, the unit 7.1 adds, and the classes 7.1 then stops saving
// (a pattern, removed from the markup before its HTML is checked).
const MOVED_IN_71 = {
	'core/button': [ 'width', 'dimensions', 'width', '%', ' has-custom-width wp-block-button__width-\\d+' ],
	'core/post-title': [ 'textAlign', 'typography', 'textAlign', '', '' ],
	'core/query-title': [ 'textAlign', 'typography', 'textAlign', '', '' ],
	'core/site-title': [ 'textAlign', 'typography', 'textAlign', '', '' ],
};

// Load every pattern into the draft, as the inserter does: parse each pattern's markup on its
// own and compare every block the editor made with the markup it came from, then put all the
// blocks in the editor. Saving is locked, so the draft keeps its one paragraph.
function load( { patterns, moves } ) {
	const blocksApi = window.wp.blocks;
	const editor = window.wp.data.dispatch( 'core/editor' );
	editor.lockPostSaving( 'ocbv' );
	editor.lockPostAutosaving( 'ocbv' );

	// A setting as the editor sees it: unset means the default, rich text means its HTML.
	function value( type, key, v ) {
		if ( v === undefined ) {
			v = type.attributes[ key ]?.default;
		}
		return v && typeof v.toHTMLString === 'function' ? v.toHTMLString() : v;
	}
	function same( a, b ) {
		if ( a === b ) {
			return true;
		}
		if ( ! a || ! b || typeof a !== 'object' || typeof b !== 'object' ) {
			return false;
		}
		const keys = ( o ) => Object.keys( o ).filter( ( k ) => o[ k ] !== undefined );
		return (
			keys( a ).length === keys( b ).length && keys( a ).every( ( k ) => same( a[ k ], b[ k ] ) )
		);
	}
	function changed( type, before, after ) {
		return [ ...new Set( [ ...Object.keys( before ), ...Object.keys( after ) ] ) ].filter(
			( k ) => ! same( value( type, k, before[ k ] ), value( type, k, after[ k ] ) )
		);
	}

	// Why the editor would save this block differently from its markup, or null.
	function rewrite( raw, block ) {
		if ( block.name !== raw.blockName ) {
			return 'becomes ' + block.name;
		}
		const type = blocksApi.getBlockType( block.name );
		const before = blocksApi.getBlockAttributes( type, raw.innerHTML, raw.attrs || {} );
		let keys = changed( type, before, block.attributes );
		let html = raw.innerHTML;
		const [ key, group, to, unit, drops ] = moves[ block.name ] || [];
		// 7.1 no longer declares the old attribute, so its value comes from the markup.
		const old = key ? raw.attrs?.[ key ] : undefined;
		if ( keys.length && old !== undefined ) {
			const now = {
				...before,
				style: { ...before.style, [ group ]: { ...before.style?.[ group ], [ to ]: old + unit } },
			};
			delete now[ key ];
			if ( ! changed( type, now, block.attributes ).length ) {
				keys = [];
				html = drops ? html.replace( new RegExp( drops ), '' ) : html;
			}
		}
		if ( keys.length ) {
			return keys.join( ', ' );
		}
		const [ valid ] = blocksApi.validateBlock( { ...block, originalContent: html } );
		return valid ? null : 'saved HTML';
	}

	const blocks = [];
	const rewritten = {};
	let kept = 0;
	const quiet = [ 'groupCollapsed', 'groupEnd', 'info', 'warn', 'error', 'log' ];
	const saved = Object.fromEntries( quiet.map( ( k ) => [ k, console[ k ] ] ) );
	try {
		quiet.forEach( ( k ) => ( console[ k ] = () => {} ) );
		for ( const markup of patterns ) {
			const slug = /ocbv--([a-z0-9-]+)/.exec( markup )[ 1 ];
			const parsed = blocksApi.parse( markup );
			const found = [];
			( function walk( raws, made ) {
				raws = raws.filter( ( r ) => r.blockName );
				if ( raws.length !== made.length ) {
					found.push( `${ raws.length } blocks in the markup become ${ made.length }` );
					return;
				}
				raws.forEach( ( raw, i ) => {
					const why = rewrite( raw, made[ i ] );
					if ( why ) {
						found.push( `${ raw.blockName }: ${ why }` );
					} else if ( moves[ raw.blockName ] && raw.attrs?.[ moves[ raw.blockName ][ 0 ] ] !== undefined ) {
						kept++;
					}
					walk( raw.innerBlocks, made[ i ].innerBlocks );
				} );
			} )( window.wp.blockSerializationDefaultParser.parse( markup ), parsed );
			blocks.push( ...parsed );
			rewritten[ slug ] = found;
		}
	} finally {
		Object.assign( console, saved );
	}
	editor.resetEditorBlocks( blocks );
	return { rewritten, kept };
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
		const { rewritten, kept } = await page.evaluate( load, {
			patterns: CONFIG.patterns,
			moves: MOVED_IN_71,
		} );

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
			const changes = rewritten[ row.slug ] || [];
			if ( row.invalid.length || row.prompts || changes.length ) {
				failed++;
				lines.push(
					`  ✗  ${ row.slug }: ${ row.invalid.length } invalid, ${ prompts } recovery prompts, ${ changes.length } rewritten on load`
				);
				row.invalid.slice( 0, 3 ).forEach( ( text ) => lines.push( `       ${ text }` ) );
				changes.slice( 0, 3 ).forEach( ( text ) => lines.push( `       rewritten ${ text }` ) );
			} else if ( row.prompts === null ) {
				failed++;
				lines.push( `  ✗  ${ row.slug }: not drawn in the canvas, so prompts were not counted` );
			}
		}
		if ( kept ) {
			lines.push(
				`  i  ${ kept } blocks keep a setting that WordPress 7.1 moves on load and 7.0 cannot read (${ Object.keys(
					MOVED_IN_71
				).join( ', ' ) }); allowed while the minimum is 7.0`
			);
		}

		console.log( 'Block validity:' );
		console.log( lines.join( '\n' ) || '' );
		console.log(
			failed
				? `FAIL: ${ failed } of ${ CONFIG.slugs.length } patterns`
				: `  ✓  ${ CONFIG.slugs.length } patterns: 0 invalid blocks, 0 recovery prompts, 0 rewritten blocks\nPASS`
		);
		expect( failed, 'patterns with invalid, prompted or rewritten blocks' ).toBe( 0 );
	} );
} );
