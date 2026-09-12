const { test, expect } = require( '@playwright/test' );
const { renderPage, servePage } = require( './fixture' );

const HEADER_NAV = 'nav > .wp-block-navigation__responsive-container > ul';
const OVERLAY_NAV = '.wp-block-navigation__overlay-container .wp-block-navigation';

/**
 * A lead block above the first linked section keeps every linked target below the
 * reading line at load, so nothing is current until the reader scrolls. The last
 * section is short so that its top never reaches the line, even at the document end.
 */
const TALL = [
	{ id: 'intro', height: 300 },
	{ id: 'one', height: 1200, wrap: 'section' },
	{ id: 'two', height: 1200, wrap: 'section' },
	{ id: 'three', height: 200, wrap: 'section' },
];
const SHORT = [
	{ id: 'intro', height: 200 },
	{ id: 'one', height: 60, wrap: 'section' },
	{ id: 'two', height: 60, wrap: 'section' },
];

function sectionLinks( sections, extra ) {
	return [ { href: '/page/', current: true } ].concat(
		sections.filter( ( s ) => s.id !== 'intro' ).map( ( s ) => ( { href: '/page/#' + s.id } ) ),
		extra || []
	);
}

/**
 * The marker state of one nav: which item hrefs carry the section class, the
 * aria-current value of every link, and which items still carry a page marker
 * (`current-menu-item` or `current-menu-ancestor`).
 */
function markers( page, navSelector ) {
	return page.evaluate( ( selector ) => {
		const nav = document.querySelector( selector );
		const fragment = ( a ) => a.getAttribute( 'href' ).replace( 'http://fixture.test/page/', '' ).replace( 'http://fixture.test', '' );
		return {
			current: Array.from( nav.querySelectorAll( 'li.origin-canvas-current > a' ) ).map( fragment ),
			aria: Array.from( nav.querySelectorAll( 'a[aria-current]' ) ).map( ( a ) => fragment( a ) + '=' + a.getAttribute( 'aria-current' ) ),
			pageMarked: Array.from( nav.querySelectorAll( 'li.current-menu-item > a, li.current-menu-ancestor > a' ) ).map( fragment ),
		};
	}, navSelector );
}

function scrollTo( page, y ) {
	return page.evaluate( ( y ) => window.scrollTo( 0, y ), y );
}

/** Document-space top of the element, and the reading line the script uses. */
function geometry( page, id ) {
	return page.evaluate( ( id ) => {
		const offset = parseFloat( getComputedStyle( document.documentElement ).scrollPaddingTop ) || 0;
		return {
			top: document.getElementById( id ).getBoundingClientRect().top + window.scrollY,
			line: offset + 0.25 * ( window.innerHeight - offset ),
			offset,
		};
	}, id );
}

async function ready( page ) {
	await expect.poll( () => page.evaluate( () => document.documentElement.style.getPropertyValue( '--origin-canvas-sticky-header-height' ) ) ).toBe( '80px' );
	await page.evaluate( () => new Promise( requestAnimationFrame ) );
}

test( 'a page that fits the viewport marks nothing at load', async ( { page } ) => {
	await servePage( page, renderPage( { sections: SHORT, links: sectionLinks( SHORT ) } ) );
	await ready( page );

	expect( await page.evaluate( () => document.scrollingElement.scrollHeight <= window.innerHeight ) ).toBe( true );
	expect( await markers( page, HEADER_NAV ) ).toEqual( { current: [], aria: [ '=page' ], pageMarked: [ '' ] } );
} );

test( 'a section becomes current when its top crosses the reading line', async ( { page } ) => {
	await servePage( page, renderPage( { sections: TALL, links: sectionLinks( TALL ) } ) );
	await ready( page );
	expect( await markers( page, HEADER_NAV ) ).toEqual( { current: [], aria: [ '=page' ], pageMarked: [ '' ] } );

	const two = await geometry( page, 'two' );
	await scrollTo( page, two.top - two.line - 5 );
	await expect.poll( () => markers( page, HEADER_NAV ) ).toEqual( { current: [ '#one' ], aria: [ '#one=location' ], pageMarked: [] } );

	await scrollTo( page, two.top - two.line + 5 );
	await expect.poll( () => markers( page, HEADER_NAV ) ).toEqual( { current: [ '#two' ], aria: [ '#two=location' ], pageMarked: [] } );
} );

test( 'at the end of the document the last section on screen is current', async ( { page } ) => {
	await servePage( page, renderPage( { sections: TALL, links: sectionLinks( TALL ) } ) );
	await ready( page );

	await scrollTo( page, 1e6 );

	const three = await geometry( page, 'three' );
	expect( three.top - await page.evaluate( () => window.scrollY ) ).toBeGreaterThan( three.line );
	await expect.poll( () => markers( page, HEADER_NAV ) ).toEqual( { current: [ '#three' ], aria: [ '#three=location' ], pageMarked: [] } );
} );

test( 'scrolling back to the top restores the page marker', async ( { page } ) => {
	await servePage( page, renderPage( { sections: TALL, links: sectionLinks( TALL ) } ) );
	await ready( page );

	await scrollTo( page, 1e6 );
	await expect.poll( () => markers( page, HEADER_NAV ) ).toEqual( { current: [ '#three' ], aria: [ '#three=location' ], pageMarked: [] } );

	await scrollTo( page, 0 );
	await expect.poll( () => markers( page, HEADER_NAV ) ).toEqual( { current: [], aria: [ '=page' ], pageMarked: [ '' ] } );
} );

test( 'a link that is both the current page and a section carries one aria-current', async ( { page } ) => {
	const links = [ { href: '/page/#one' }, { href: '/page/#two', current: true }, { href: '/page/#three' } ];
	await servePage( page, renderPage( { sections: TALL, links } ) );
	await ready( page );
	expect( await markers( page, HEADER_NAV ) ).toEqual( { current: [], aria: [ '#two=page' ], pageMarked: [ '#two' ] } );

	const two = await geometry( page, 'two' );
	await scrollTo( page, two.top - two.line + 5 );
	await expect.poll( () => markers( page, HEADER_NAV ) ).toEqual( { current: [ '#two' ], aria: [ '#two=location' ], pageMarked: [] } );

	await scrollTo( page, 0 );
	await expect.poll( () => markers( page, HEADER_NAV ) ).toEqual( { current: [], aria: [ '#two=page' ], pageMarked: [ '#two' ] } );
} );

test( 'the ancestor marker of the current page is set aside and restored with it', async ( { page } ) => {
	const links = [
		{ href: '/parent/', text: 'Parent', ancestor: true, children: [ { href: '/page/', current: true } ] },
		{ href: '/page/#one' },
		{ href: '/page/#two' },
	];
	await servePage( page, renderPage( { sections: TALL, links } ) );
	await ready( page );
	expect( await markers( page, HEADER_NAV ) ).toEqual( { current: [], aria: [ '=page' ], pageMarked: [ '/parent/', '' ] } );

	const two = await geometry( page, 'two' );
	await scrollTo( page, two.top - two.line + 5 );
	await expect.poll( () => markers( page, HEADER_NAV ) ).toEqual( { current: [ '#two' ], aria: [ '#two=location' ], pageMarked: [] } );

	await scrollTo( page, 0 );
	await expect.poll( () => markers( page, HEADER_NAV ) ).toEqual( { current: [], aria: [ '=page' ], pageMarked: [ '/parent/', '' ] } );
} );

test( 'every link to the current section is marked, submenu parent and child alike', async ( { page } ) => {
	const links = [
		{ href: '/page/', current: true },
		{ href: '/page/#one' },
		{ href: '/page/#two', children: [ { href: '/page/#two', text: 'Two again' } ] },
	];
	await servePage( page, renderPage( { sections: TALL, links } ) );
	await ready( page );

	const two = await geometry( page, 'two' );
	await scrollTo( page, two.top - two.line + 5 );
	await expect.poll( () => markers( page, HEADER_NAV ) ).toEqual( {
		current: [ '#two', '#two' ],
		aria: [ '#two=location', '#two=location' ],
		pageMarked: [],
	} );
} );

test( 'a submenu parent is marked for a section link among its children', async ( { page } ) => {
	const links = [
		{ href: '/page/', current: true },
		{ href: '/other/', text: 'Other', children: [ { href: '/page/#two' } ] },
	];
	await servePage( page, renderPage( { sections: TALL, links } ) );
	await ready( page );

	const two = await geometry( page, 'two' );
	await scrollTo( page, two.top - two.line + 5 );
	// The parent item carries the class; only the section link carries aria-current.
	await expect.poll( () => markers( page, HEADER_NAV ) ).toEqual( {
		current: [ '/other/', '#two' ],
		aria: [ '#two=location' ],
		pageMarked: [],
	} );
} );

test( 'the header nav and the overlay copy each mark their own item', async ( { page } ) => {
	await servePage( page, renderPage( { sections: TALL, links: sectionLinks( TALL ), overlayNav: true } ) );
	await ready( page );

	const two = await geometry( page, 'two' );
	await scrollTo( page, two.top - two.line + 5 );
	const expected = { current: [ '#two' ], aria: [ '#two=location' ], pageMarked: [] };
	await expect.poll( () => markers( page, HEADER_NAV ) ).toEqual( expected );
	await expect.poll( () => markers( page, OVERLAY_NAV ) ).toEqual( expected );
	expect( await page.evaluate( () => document.querySelectorAll( '.origin-canvas-current' ).length ) ).toBe( 2 );
} );

test( 'a target inside a section stays current while the section is on screen', async ( { page } ) => {
	const sections = [ { id: 'intro', height: 300 }, { id: 'one', height: 1200, wrap: 'section' }, { id: 'two', height: 1200, wrap: 'section' } ];
	await servePage( page, renderPage( { sections, links: sectionLinks( sections ) } ) );
	await ready( page );

	// Scroll the heading itself above the sticky chrome while most of its section is
	// still in view.
	const one = await geometry( page, 'one' );
	await scrollTo( page, one.top - one.offset + 100 );
	await expect.poll( () => markers( page, HEADER_NAV ) ).toEqual( { current: [ '#one' ], aria: [ '#one=location' ], pageMarked: [] } );

	// Without the section, the heading is the whole region and it has left the screen.
	const bare = sections.map( ( s ) => ( { ...s, wrap: null } ) );
	await servePage( page, renderPage( { sections: bare, links: sectionLinks( bare ) } ) );
	await ready( page );
	await scrollTo( page, one.top - one.offset + 100 );
	await expect.poll( () => markers( page, HEADER_NAV ) ).toEqual( { current: [], aria: [ '=page' ], pageMarked: [ '' ] } );
} );

test( 'a nav with no same-page links is left alone', async ( { page } ) => {
	const links = [ { href: '/page/', current: true }, { href: '/other/', text: 'Other' }, { href: 'http://other.test/', text: 'Away' } ];
	await servePage( page, renderPage( { sections: TALL, links } ) );
	await ready( page );

	await scrollTo( page, 1e6 );
	await page.evaluate( () => new Promise( requestAnimationFrame ) );
	await page.evaluate( () => new Promise( requestAnimationFrame ) );
	expect( await markers( page, HEADER_NAV ) ).toEqual( { current: [], aria: [ '=page' ], pageMarked: [ '' ] } );
} );
