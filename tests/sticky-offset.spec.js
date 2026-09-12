const { test, expect } = require( '@playwright/test' );
const { PAGE_URL, renderPage, servePage } = require( './fixture' );

const PROPERTY = '--origin-canvas-sticky-header-height';

function readProperty( page ) {
	return page.evaluate( ( name ) => document.documentElement.style.getPropertyValue( name ), PROPERTY );
}

function readScrolls( page ) {
	return page.evaluate( () => window.__scrolls );
}

test( 'no sticky header sets no offset property', async ( { page } ) => {
	await servePage( page, renderPage( { sticky: false } ) );

	await page.evaluate( () => new Promise( requestAnimationFrame ) );
	expect( await readProperty( page ) ).toBe( '' );
	expect( await page.evaluate( () => getComputedStyle( document.documentElement ).scrollPaddingTop ) ).toBe( '0px' );
} );

test( 'the offset property carries the sticky header height', async ( { page } ) => {
	await servePage( page, renderPage( { sticky: 80 } ) );

	await expect.poll( () => readProperty( page ) ).toBe( '80px' );
	expect( await page.evaluate( () => getComputedStyle( document.documentElement ).scrollPaddingTop ) ).toBe( '80px' );
} );

test( 'the offset property follows the header when it grows', async ( { page } ) => {
	await servePage( page, renderPage( { sticky: 80 } ) );
	await expect.poll( () => readProperty( page ) ).toBe( '80px' );

	await page.evaluate( () => {
		document.querySelector( '.is-position-sticky' ).style.height = '120px';
	} );

	await expect.poll( () => readProperty( page ) ).toBe( '120px' );
} );

test( 'arriving with a hash realigns the target below the sticky header', async ( { page } ) => {
	await servePage( page, renderPage( { sticky: 80 } ), PAGE_URL + '#two' );

	await expect.poll( () => readScrolls( page ) ).toEqual( [ { id: 'two', behavior: 'auto', modalOpen: false } ] );
	await expect.poll( () => page.evaluate( () => document.getElementById( 'two' ).getBoundingClientRect().top ) ).toBeCloseTo( 80, 0 );
} );

test( 'arriving without a hash scrolls nothing', async ( { page } ) => {
	await servePage( page, renderPage( { sticky: 80 } ) );
	await expect.poll( () => readProperty( page ) ).toBe( '80px' );

	await page.evaluate( () => new Promise( requestAnimationFrame ) );
	expect( await readScrolls( page ) ).toEqual( [] );
	expect( await page.evaluate( () => window.scrollY ) ).toBe( 0 );
} );
