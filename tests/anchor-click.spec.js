const { test, expect } = require( '@playwright/test' );
const { ORIGIN, PAGE_URL, renderPage, servePage, serveElsewhere, recordClickOutcome } = require( './fixture' );

const HEADER_NAV = 'nav > .wp-block-navigation__responsive-container > ul ';

function link( href, nav ) {
	return ( nav || HEADER_NAV ) + 'a[href="' + href + '"]';
}
const OVERLAY_NAV = '.wp-block-navigation__overlay-container .wp-block-navigation ';
const P = PAGE_URL;

function targetTop( page, id ) {
	return page.evaluate( function ( id ) {
		return document.getElementById( id ).getBoundingClientRect().top;
	}, id );
}

function readState( page ) {
	return page.evaluate( function () {
		return {
			hash: window.location.hash,
			historyLength: window.history.length,
			scrolls: window.__scrolls,
			closeClicks: window.__closeClicks,
			activeId: document.activeElement && document.activeElement.id,
			lastClick: window.__lastClick,
		};
	} );
}

async function ready( page ) {
	await expect.poll( function () {
		return page.evaluate( function () {
			return document.documentElement.style.getPropertyValue( '--origin-canvas-sticky-header-height' );
		} );
	} ).toBe( '80px' );
}

test( 'a same-page anchor click updates the hash, scrolls below the sticky header and moves focus', async ( { page } ) => {
	await servePage( page, renderPage( {
		extraHead: '<script>window.__hashchanges = []; window.addEventListener( "hashchange", function ( event ) {' +
			'window.__hashchanges.push( { oldURL: event.oldURL, newURL: event.newURL } ); } );</script>',
	} ) );
	await ready( page );
	const before = await readState( page );

	await page.click( link( P + '#two' ) );

	await expect.poll( () => targetTop( page, 'two' ) ).toBeCloseTo( 80, 0 );
	const after = await readState( page );
	expect( after.hash ).toBe( '#two' );
	expect( after.historyLength ).toBe( before.historyLength + 1 );
	// pushState fires no hashchange of its own; the script dispatches one so listeners
	// see the same event a native fragment navigation would give them.
	expect( await page.evaluate( () => window.__hashchanges ) ).toEqual( [ { oldURL: PAGE_URL, newURL: PAGE_URL + '#two' } ] );
	expect( after.scrolls ).toEqual( [ { id: 'two', behavior: 'smooth', modalOpen: false } ] );
	expect( after.activeId ).toBe( 'two' );
	expect( await page.getAttribute( '#two', 'tabindex' ) ).toBe( '-1' );

	await page.evaluate( () => document.getElementById( 'two' ).blur() );
	expect( await page.getAttribute( '#two', 'tabindex' ) ).toBeNull();
} );

test( 'a focusable target borrows no tabindex', async ( { page } ) => {
	await servePage( page, renderPage( { sections: [ { id: 'one' }, { id: 'two', focusable: true }, { id: 'three' } ] } ) );
	await ready( page );

	await page.click( link( P + '#two' ) );

	await expect.poll( () => readState( page ).then( ( s ) => s.activeId ) ).toBe( 'two' );
	expect( await page.getAttribute( '#two', 'tabindex' ) ).toBeNull();
} );

test( 'a re-click on the current fragment adds no history entry', async ( { page } ) => {
	await servePage( page, renderPage() );
	await ready( page );

	await page.click( link( P + '#two' ) );
	await expect.poll( () => targetTop( page, 'two' ) ).toBeCloseTo( 80, 0 );
	const first = await readState( page );

	await page.click( link( P + '#two' ) );
	await expect.poll( () => readState( page ).then( ( s ) => s.scrolls.length ) ).toBe( 2 );
	const second = await readState( page );
	expect( second.hash ).toBe( '#two' );
	expect( second.historyLength ).toBe( first.historyLength );
} );

test( 'reduced motion scrolls without animation', async ( { page } ) => {
	await page.emulateMedia( { reducedMotion: 'reduce' } );
	await servePage( page, renderPage() );
	await ready( page );

	await page.click( link( P + '#two' ) );

	await expect.poll( () => targetTop( page, 'two' ) ).toBeCloseTo( 80, 0 );
	const state = await readState( page );
	expect( state.scrolls ).toEqual( [ { id: 'two', behavior: 'auto', modalOpen: false } ] );
} );

test.describe( 'clicks the script leaves to the browser', () => {
	// These exercise the script's own checks on the event, with a synthetic click
	// event. They say nothing about what a real modifier or middle click does in a
	// browser: a real middle click raises auxclick, which the script never sees.
	const guardRows = [
		{ name: 'a click event with the meta key set', init: { metaKey: true } },
		{ name: 'a click event with the control key set', init: { ctrlKey: true } },
		{ name: 'a click event with the shift key set', init: { shiftKey: true } },
		{ name: 'a click event with the alt key set', init: { altKey: true } },
		{ name: 'a click event with button 1', init: { button: 1 } },
	];

	for ( const row of guardRows ) {
		test( row.name, async ( { page, context } ) => {
			context.on( 'page', ( opened ) => opened.close() );
			await servePage( page, renderPage() );
			await ready( page );
			await recordClickOutcome( page );

			await page.evaluate( ( [ selector, init ] ) => {
				document.querySelector( selector ).dispatchEvent(
					new MouseEvent( 'click', Object.assign( { bubbles: true, cancelable: true }, init ) )
				);
			}, [ link( P + '#two' ), row.init ] );

			// What the browser does with the event varies by platform (a new tab, a
			// same-tab jump, nothing); the script staying out of it does not.
			const state = await readState( page );
			expect( state.lastClick ).toEqual( { defaultPrevented: false } );
			expect( state.scrolls ).toEqual( [] );
		} );
	}

	test( 'a link with target="_blank"', async ( { page, context } ) => {
		await servePage( page, renderPage( { links: [ { href: P, current: true }, { href: P + '#two', target: '_blank' } ] } ) );
		await ready( page );
		await recordClickOutcome( page );

		const [ tab ] = await Promise.all( [
			context.waitForEvent( 'page' ),
			page.click( link( P + '#two' ) ),
		] );
		expect( tab.url() ).toBe( PAGE_URL + '#two' );
		await tab.close();

		const state = await readState( page );
		expect( state.lastClick ).toEqual( { defaultPrevented: false } );
		expect( state.scrolls ).toEqual( [] );
		expect( state.hash ).toBe( '' );
	} );

	test( 'a download link', async ( { page, context } ) => {
		await serveElsewhere( context );
		await servePage( page, renderPage( { links: [ { href: P, current: true }, { href: ORIGIN + '/file.txt', download: true } ] } ) );
		await ready( page );
		await recordClickOutcome( page );

		const [ download ] = await Promise.all( [
			page.waitForEvent( 'download' ),
			page.click( link( ORIGIN + '/file.txt' ) ),
		] );
		expect( download.url() ).toBe( ORIGIN + '/file.txt' );

		const state = await readState( page );
		expect( state.lastClick ).toEqual( { defaultPrevented: false } );
		expect( state.scrolls ).toEqual( [] );
		expect( page.url() ).toBe( PAGE_URL );
	} );

	// Each carries a fragment that does exist on this page, so the only reason to leave
	// the click alone is the part of the URL that differs.
	const navigationRows = [
		{ name: 'a cross-origin link', href: 'http://other.test/#two', selector: link( 'http://other.test/#two' ) },
		{ name: 'a link to another path on this origin', href: ORIGIN + '/other/#two', selector: link( ORIGIN + '/other/#two' ) },
		{ name: 'a link to this path with a different query', href: P + '?q=1#two', selector: link( P + '?q=1#two' ) },
	];

	for ( const row of navigationRows ) {
		test( row.name, async ( { page, context } ) => {
			await serveElsewhere( context );
			await servePage( page, renderPage( { links: [ { href: P, current: true }, { href: row.href, text: 'Away' } ] } ) );
			await ready( page );

			await Promise.all( [
				page.waitForURL( /^http:\/\/(other\.test\/|fixture\.test\/(other\/|page\/\?q=1))#two$/ ),
				page.click( row.selector ),
			] );
			await expect( page ).toHaveTitle( 'elsewhere' );
		} );
	}

	// `hash` is what location.hash reads after the native jump; a bare "#" leaves it
	// empty while the URL itself ends in "#".
	const nativeRows = [
		{ name: 'a bare "#"', href: P + '#', hash: '' },
		{ name: 'a fragment with no matching element', href: P + '#nope', hash: '#nope' },
		{ name: 'a fragment with a malformed percent escape', href: P + '#%E0%A4%A', hash: '#%E0%A4%A' },
	];

	for ( const row of nativeRows ) {
		test( row.name, async ( { page } ) => {
			const errors = [];
			page.on( 'pageerror', ( error ) => errors.push( error ) );
			await servePage( page, renderPage( { links: [ { href: P, current: true }, { href: row.href, text: 'Away' } ] } ) );
			await ready( page );
			await recordClickOutcome( page );
			const before = await readState( page );

			await page.click( link( row.href ) );

			await expect.poll( () => page.url() ).toBe( row.href );
			const state = await readState( page );
			expect( state.hash ).toBe( row.hash );
			expect( state.lastClick ).toEqual( { defaultPrevented: false } );
			expect( state.scrolls ).toEqual( [] );
			expect( state.historyLength ).toBe( before.historyLength + 1 );
			expect( errors ).toEqual( [] );
		} );
	}
} );

test( 'a percent-encoded fragment that decodes to an id is handled', async ( { page } ) => {
	await servePage( page, renderPage( {
		sections: [ { id: 'one' }, { id: 'zwei ü' }, { id: 'three' } ],
		links: [ { href: P, current: true }, { href: P + '#zwei%20%C3%BC', text: 'Zwei' } ],
	} ) );
	await ready( page );

	await page.click( link( P + '#zwei%20%C3%BC' ) );

	await expect.poll( () => targetTop( page, 'zwei ü' ) ).toBeCloseTo( 80, 0 );
	const state = await readState( page );
	expect( state.scrolls ).toEqual( [ { id: 'zwei ü', behavior: 'smooth', modalOpen: false } ] );
	expect( state.hash ).toBe( '#zwei%20%C3%BC' );
} );

test( 'a relative href is handled', async ( { page } ) => {
	await servePage( page, renderPage( { links: [ { href: P, current: true }, { href: '#two', text: 'Two' } ] } ) );
	await ready( page );

	await page.click( link( '#two' ) );

	await expect.poll( () => targetTop( page, 'two' ) ).toBeCloseTo( 80, 0 );
	expect( ( await readState( page ) ).hash ).toBe( '#two' );
} );

test( 'a click on the label inside the anchor is handled', async ( { page } ) => {
	await servePage( page, renderPage() );
	await ready( page );

	await page.click( link( P + '#two' ) + ' span' );

	await expect.poll( () => targetTop( page, 'two' ) ).toBeCloseTo( 80, 0 );
	expect( ( await readState( page ) ).hash ).toBe( '#two' );
} );

test( 'a click an earlier handler prevented is left alone', async ( { page } ) => {
	await servePage( page, renderPage( {
		extraHead: '<script>document.addEventListener( "click", function ( event ) { event.preventDefault(); } );</script>',
	} ) );
	await ready( page );
	await recordClickOutcome( page );

	await page.click( link( P + '#two' ) );

	await page.evaluate( () => new Promise( requestAnimationFrame ) );
	const state = await readState( page );
	expect( state.lastClick ).toEqual( { defaultPrevented: true } );
	expect( state.scrolls ).toEqual( [] );
	expect( state.hash ).toBe( '' );
} );

test( 'a click inside the open overlay closes it before scrolling', async ( { page } ) => {
	// The link lives in the overlay's own Navigation block, as in parts/mobile-menu.html.
	await servePage( page, renderPage( { overlay: 'open', overlayNav: true } ) );
	await ready( page );

	await page.click( link( P + '#two', OVERLAY_NAV ) );

	await expect.poll( () => readState( page ).then( ( s ) => s.scrolls.length ) ).toBe( 1 );
	const state = await readState( page );
	expect( state.closeClicks ).toBe( 1 );
	expect( state.scrolls ).toEqual( [ { id: 'two', behavior: 'smooth', modalOpen: false } ] );
	expect( state.hash ).toBe( '#two' );
	expect( await page.evaluate( () => document.querySelector( '.wp-block-navigation__responsive-container' ).classList.contains( 'is-menu-open' ) ) ).toBe( false );
} );

test( 'a click inside core\'s default overlay closes it through core\'s close button', async ( { page } ) => {
	await servePage( page, renderPage( { overlay: 'open', closeButton: 'core', overlayNav: true } ) );
	await ready( page );

	await page.click( link( P + '#two', OVERLAY_NAV ) );

	await expect.poll( () => readState( page ).then( ( s ) => s.scrolls.length ) ).toBe( 1 );
	const state = await readState( page );
	expect( state.closeClicks ).toBe( 1 );
	expect( state.scrolls ).toEqual( [ { id: 'two', behavior: 'smooth', modalOpen: false } ] );
	expect( state.hash ).toBe( '#two' );
} );

test( 'an overlay whose modal marker never clears gets the scroll after ten frames', async ( { page } ) => {
	await servePage( page, renderPage( { overlay: 'stuck' } ) );
	await ready( page );

	await page.click( link( P + '#two' ) );

	await expect.poll( () => readState( page ).then( ( s ) => s.scrolls.length ) ).toBe( 1 );
	const state = await readState( page );
	expect( state.closeClicks ).toBe( 1 );
	expect( state.scrolls ).toEqual( [ { id: 'two', behavior: 'smooth', modalOpen: true } ] );
	expect( state.hash ).toBe( '#two' );
} );
