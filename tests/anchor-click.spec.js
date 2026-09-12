const { test, expect } = require( '@playwright/test' );
const { ORIGIN, PAGE_URL, renderPage, servePage, serveElsewhere, recordClickOutcome } = require( './fixture' );

const HEADER_NAV = 'nav > .wp-block-navigation__responsive-container > ul ';

function link( href ) {
	return HEADER_NAV + 'a[href="' + ORIGIN + href + '"]';
}

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
	await servePage( page, renderPage() );
	await ready( page );
	const before = await readState( page );

	await page.click( link( '/page/#two' ) );

	await expect.poll( () => targetTop( page, 'two' ) ).toBeCloseTo( 80, 0 );
	const after = await readState( page );
	expect( after.hash ).toBe( '#two' );
	expect( after.historyLength ).toBe( before.historyLength + 1 );
	expect( after.scrolls ).toEqual( [ { id: 'two', behavior: 'smooth', modalOpen: false } ] );
	expect( after.activeId ).toBe( 'two' );
	expect( await page.getAttribute( '#two', 'tabindex' ) ).toBe( '-1' );

	await page.evaluate( () => document.getElementById( 'two' ).blur() );
	expect( await page.getAttribute( '#two', 'tabindex' ) ).toBeNull();
} );

test( 'a focusable target borrows no tabindex', async ( { page } ) => {
	await servePage( page, renderPage( { sections: [ { id: 'one' }, { id: 'two', focusable: true }, { id: 'three' } ] } ) );
	await ready( page );

	await page.click( link( '/page/#two' ) );

	await expect.poll( () => readState( page ).then( ( s ) => s.activeId ) ).toBe( 'two' );
	expect( await page.getAttribute( '#two', 'tabindex' ) ).toBeNull();
} );

test( 'a re-click on the current fragment adds no history entry', async ( { page } ) => {
	await servePage( page, renderPage() );
	await ready( page );

	await page.click( link( '/page/#two' ) );
	await expect.poll( () => targetTop( page, 'two' ) ).toBeCloseTo( 80, 0 );
	const first = await readState( page );

	await page.click( link( '/page/#two' ) );
	await expect.poll( () => readState( page ).then( ( s ) => s.scrolls.length ) ).toBe( 2 );
	const second = await readState( page );
	expect( second.hash ).toBe( '#two' );
	expect( second.historyLength ).toBe( first.historyLength );
} );

test( 'reduced motion scrolls without animation', async ( { page } ) => {
	await page.emulateMedia( { reducedMotion: 'reduce' } );
	await servePage( page, renderPage() );
	await ready( page );

	await page.click( link( '/page/#two' ) );

	await expect.poll( () => targetTop( page, 'two' ) ).toBeCloseTo( 80, 0 );
	const state = await readState( page );
	expect( state.scrolls ).toEqual( [ { id: 'two', behavior: 'auto', modalOpen: false } ] );
} );

test.describe( 'clicks the script leaves to the browser', () => {
	const guardRows = [
		{ name: 'a click with the meta key', init: { metaKey: true } },
		{ name: 'a click with the control key', init: { ctrlKey: true } },
		{ name: 'a middle-button click', init: { button: 1 } },
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
			}, [ link( '/page/#two' ), row.init ] );

			// What the browser does with the click varies by platform (a new tab, a
			// same-tab jump, nothing); the script staying out of it does not.
			const state = await readState( page );
			expect( state.lastClick ).toEqual( { defaultPrevented: false } );
			expect( state.scrolls ).toEqual( [] );
		} );
	}

	test( 'a link with target="_blank"', async ( { page, context } ) => {
		await servePage( page, renderPage( { links: [ { href: '/page/', current: true }, { href: '/page/#two', target: '_blank' } ] } ) );
		await ready( page );
		await recordClickOutcome( page );

		const [ tab ] = await Promise.all( [
			context.waitForEvent( 'page' ),
			page.click( link( '/page/#two' ) ),
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
		await servePage( page, renderPage( { links: [ { href: '/page/', current: true }, { href: '/file.txt', download: true } ] } ) );
		await ready( page );
		await recordClickOutcome( page );

		const [ download ] = await Promise.all( [
			page.waitForEvent( 'download' ),
			page.click( link( '/file.txt' ) ),
		] );
		expect( download.url() ).toBe( ORIGIN + '/file.txt' );

		const state = await readState( page );
		expect( state.lastClick ).toEqual( { defaultPrevented: false } );
		expect( state.scrolls ).toEqual( [] );
		expect( page.url() ).toBe( PAGE_URL );
	} );

	const navigationRows = [
		{ name: 'a cross-origin link', href: 'http://other.test/', selector: HEADER_NAV + 'a[href="http://other.test/"]' },
		{ name: 'a link to another path on this origin', href: '/other/', selector: link( '/other/' ) },
		{ name: 'a link to this path with a different query', href: '/page/?q=1', selector: link( '/page/?q=1' ) },
	];

	for ( const row of navigationRows ) {
		test( row.name, async ( { page, context } ) => {
			await serveElsewhere( context );
			await servePage( page, renderPage( { links: [ { href: '/page/', current: true }, { href: row.href, text: 'Away' } ] } ) );
			await ready( page );

			await Promise.all( [
				page.waitForURL( /^http:\/\/(other\.test\/|fixture\.test\/(other\/|page\/\?q=1))$/ ),
				page.click( row.selector ),
			] );
			await expect( page ).toHaveTitle( 'elsewhere' );
		} );
	}

	// `hash` is what location.hash reads after the native jump; a bare "#" leaves it
	// empty while the URL itself ends in "#".
	const nativeRows = [
		{ name: 'a bare "#"', href: '/page/#', hash: '' },
		{ name: 'a fragment with no matching element', href: '/page/#nope', hash: '#nope' },
		{ name: 'a fragment with a malformed percent escape', href: '/page/#%E0%A4%A', hash: '#%E0%A4%A' },
	];

	for ( const row of nativeRows ) {
		test( row.name, async ( { page } ) => {
			const errors = [];
			page.on( 'pageerror', ( error ) => errors.push( error ) );
			await servePage( page, renderPage( { links: [ { href: '/page/', current: true }, { href: row.href, text: 'Away' } ] } ) );
			await ready( page );
			await recordClickOutcome( page );
			const before = await readState( page );

			await page.click( link( row.href ) );

			await expect.poll( () => page.url() ).toBe( ORIGIN + row.href );
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
		links: [ { href: '/page/', current: true }, { href: '/page/#zwei%20%C3%BC', text: 'Zwei' } ],
	} ) );
	await ready( page );

	await page.click( link( '/page/#zwei%20%C3%BC' ) );

	await expect.poll( () => targetTop( page, 'zwei ü' ) ).toBeCloseTo( 80, 0 );
	const state = await readState( page );
	expect( state.scrolls ).toEqual( [ { id: 'zwei ü', behavior: 'smooth', modalOpen: false } ] );
	expect( state.hash ).toBe( '#zwei%20%C3%BC' );
} );

test( 'a click on the label inside the anchor is handled', async ( { page } ) => {
	await servePage( page, renderPage() );
	await ready( page );

	await page.click( link( '/page/#two' ) + ' span' );

	await expect.poll( () => targetTop( page, 'two' ) ).toBeCloseTo( 80, 0 );
	expect( ( await readState( page ) ).hash ).toBe( '#two' );
} );

test( 'a click an earlier handler prevented is left alone', async ( { page } ) => {
	await servePage( page, renderPage( {
		extraHead: '<script>document.addEventListener( "click", function ( event ) { event.preventDefault(); } );</script>',
	} ) );
	await ready( page );
	await recordClickOutcome( page );

	await page.click( link( '/page/#two' ) );

	await page.evaluate( () => new Promise( requestAnimationFrame ) );
	const state = await readState( page );
	expect( state.lastClick ).toEqual( { defaultPrevented: true } );
	expect( state.scrolls ).toEqual( [] );
	expect( state.hash ).toBe( '' );
} );

test( 'a click inside the open overlay closes it before scrolling', async ( { page } ) => {
	await servePage( page, renderPage( { overlay: 'open' } ) );
	await ready( page );

	await page.click( link( '/page/#two' ) );

	await expect.poll( () => readState( page ).then( ( s ) => s.scrolls.length ) ).toBe( 1 );
	const state = await readState( page );
	expect( state.closeClicks ).toBe( 1 );
	expect( state.scrolls ).toEqual( [ { id: 'two', behavior: 'smooth', modalOpen: false } ] );
	expect( state.hash ).toBe( '#two' );
	expect( await page.evaluate( () => document.querySelector( '.wp-block-navigation__responsive-container' ).classList.contains( 'is-menu-open' ) ) ).toBe( false );
} );

test( 'an overlay whose modal marker never clears gets the scroll after ten frames', async ( { page } ) => {
	await servePage( page, renderPage( { overlay: 'stuck' } ) );
	await ready( page );

	await page.click( link( '/page/#two' ) );

	await expect.poll( () => readState( page ).then( ( s ) => s.scrolls.length ) ).toBe( 1 );
	const state = await readState( page );
	expect( state.closeClicks ).toBe( 1 );
	expect( state.scrolls ).toEqual( [ { id: 'two', behavior: 'smooth', modalOpen: true } ] );
	expect( state.hash ).toBe( '#two' );
} );
