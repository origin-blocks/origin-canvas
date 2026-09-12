/**
 * Fixture pages for assets/js/anchor-navigation.js.
 *
 * Each test renders a page from the options below and serves it from memory, together
 * with the real script and the real style.css, so the layout the script measures is the
 * shipped one. There is no WordPress in the loop: the markup mirrors what core renders
 * for the Navigation block and the theme's mobile-menu overlay part, captured with
 *
 *   curl -s http://localhost/origin-blocks/ | grep -o '<nav [^>]*wp-block-navigation.*</nav>'
 *
 * on WordPress 7.1.1-RC1 (2026-09-12). The class names the script selects, and where
 * core emits them:
 *
 * - `wp-block-navigation` on the block root and on its inner `ul`
 *   (`wp-block-navigation__container`)          wp-includes/blocks/navigation.php
 * - `li.wp-block-navigation-item`, `.has-child`, `wp-block-navigation__submenu-container`
 * - `current-menu-item` / `current-menu-ancestor` with `aria-current="page"`
 * - `wp-block-navigation__responsive-container` with `is-menu-open`, and
 *   `has-modal-open` on `<html>`, both set at runtime by core's Interactivity store
 *   (navigation.php:799-800, script-modules/block-library/navigation/view.js:139,152)
 * - `wp-block-navigation-overlay-close` (the overlay part's close block) and
 *   `wp-block-navigation__responsive-container-close` (core's default overlay)
 * - `is-position-sticky` on the header's sticky child (set in the editor, not in a
 *   theme file)
 *
 * Core's overlay itself is not exercised here: the close button carries a stand-in for
 * core's `closeMenu`. A rename in core would not fail these tests; the manual check in
 * CONTRIBUTING.md covers that.
 */
const path = require( 'path' );

const ORIGIN = 'http://fixture.test';
const PAGE_URL = ORIGIN + '/page/';
const THEME_ROOT = path.join( __dirname, '..' );

function escapeHtml( value ) {
	return String( value )
		.replace( /&/g, '&amp;' )
		.replace( /</g, '&lt;' )
		.replace( />/g, '&gt;' )
		.replace( /"/g, '&quot;' );
}

function absolute( href ) {
	return /^[a-z]+:/i.test( href ) ? href : ORIGIN + href;
}

function linkText( href ) {
	var hash = href.indexOf( '#' );
	if ( hash !== -1 && hash < href.length - 1 ) {
		var fragment = href.slice( hash + 1 );
		return fragment.charAt( 0 ).toUpperCase() + fragment.slice( 1 );
	}
	var segments = href.replace( /[?#].*$/, '' ).split( '/' ).filter( Boolean );
	return segments.length ? segments[ segments.length - 1 ] : 'Home';
}

function renderLink( link ) {
	var attrs = ' class="wp-block-navigation-item__content" href="' + escapeHtml( absolute( link.href ) ) + '"';
	if ( link.current ) {
		attrs += ' aria-current="page"';
	}
	if ( link.target ) {
		attrs += ' target="' + escapeHtml( link.target ) + '"';
	}
	if ( link.download ) {
		attrs += link.download === true ? ' download' : ' download="' + escapeHtml( link.download ) + '"';
	}
	return '<a' + attrs + '><span class="wp-block-navigation-item__label">' +
		escapeHtml( link.text || linkText( link.href ) ) + '</span></a>';
}

function renderItems( links ) {
	return links.map( function ( link ) {
		var classes = [ 'wp-block-navigation-item' ];
		if ( link.current ) {
			classes.push( 'current-menu-item' );
		}
		var children = link.children || [];
		if ( children.length ) {
			classes.push( 'has-child', 'wp-block-navigation-submenu' );
		} else {
			classes.push( 'wp-block-navigation-link' );
		}
		var html = '<li class="' + classes.join( ' ' ) + '">' + renderLink( link );
		if ( children.length ) {
			html += '<ul class="wp-block-navigation__submenu-container wp-block-navigation-submenu">' +
				renderItems( children ) + '</ul>';
		}
		return html + '</li>';
	} ).join( '' );
}

function renderSection( section ) {
	var height = section.height === undefined ? 1200 : section.height;
	var target = section.focusable ?
		'<button id="' + escapeHtml( section.id ) + '" type="button">' + escapeHtml( section.id ) + '</button>' :
		'<h2 id="' + escapeHtml( section.id ) + '">' + escapeHtml( section.id ) + '</h2>';
	if ( section.wrap === 'section' ) {
		return '<section>' + target + '<div style="height:' + height + 'px"></div></section>';
	}
	if ( section.wrap === 'group' ) {
		return '<div class="wp-block-group">' + target + '<div style="height:' + height + 'px"></div></div>';
	}
	return '<div style="height:' + height + 'px">' + target + '</div>';
}

/**
 * The oracle every fixture installs before the script loads. `window.__scrolls` records
 * each scrollIntoView call with the target id, the requested behavior and whether the
 * overlay's modal marker was still on `<html>` at that moment; `window.__closeClicks`
 * counts clicks on the overlay close button. Only the script under test calls
 * scrollIntoView on these pages.
 */
const ORACLE = '<script>' +
	'window.__scrolls = []; window.__closeClicks = 0;' +
	'(function () {' +
	'var original = Element.prototype.scrollIntoView;' +
	'Element.prototype.scrollIntoView = function ( options ) {' +
	'window.__scrolls.push( { id: this.id, behavior: options && options.behavior,' +
	' modalOpen: document.documentElement.classList.contains( "has-modal-open" ) } );' +
	'return original.apply( this, arguments );' +
	'};' +
	'})();' +
	'</script>';

/**
 * Stand-in for core's closeMenu: the click clears `is-menu-open` on the container and
 * `has-modal-open` on `<html>` a frame later, as the Interactivity store's re-render
 * does. A `stuck` overlay clears the container class only, so the modal marker never
 * goes away and the script's ten-frame wait runs out.
 */
function closeHandler( stuck ) {
	return 'window.__closeClicks++;' +
		'var container = this.closest( ".wp-block-navigation__responsive-container" );' +
		'requestAnimationFrame( function () {' +
		'container.classList.remove( "is-menu-open" );' +
		( stuck ? '' : 'document.documentElement.classList.remove( "has-modal-open" );' ) +
		'} );';
}

/**
 * Build a fixture page.
 *
 * @param {Object}  [options]
 * @param {Array}   [options.sections]   `{ id, height, wrap: 'section'|'group'|null, focusable }`; default three 1200px blocks `one`, `two`, `three`.
 * @param {Array}   [options.links]      `{ href, text, current, children, target, download }`; default the page link (current) plus one link per section.
 * @param {number|false} [options.sticky] Sticky header height in px, or false for no sticky header. Default 80.
 * @param {string}  [options.overlay]    `'closed'` (default), `'open'` or `'stuck'`.
 * @param {boolean} [options.overlayNav] Render the links a second time inside the overlay, as parts/mobile-menu.html does.
 * @param {string}  [options.extraHead]  Markup placed in `<head>` before the script tag.
 * @return {string} HTML.
 */
function renderPage( options ) {
	options = options || {};
	var sections = options.sections || [ { id: 'one' }, { id: 'two' }, { id: 'three' } ];
	var links = options.links || [ { href: '/page/', current: true } ].concat(
		sections.map( function ( section ) {
			return { href: '/page/#' + section.id };
		} )
	);
	var sticky = options.sticky === undefined ? 80 : options.sticky;
	var overlay = options.overlay || 'closed';
	var open = overlay !== 'closed';

	var nav = '<nav class="wp-block-navigation is-responsive">' +
		'<button class="wp-block-navigation__responsive-container-open" aria-label="Open menu"></button>' +
		'<div class="wp-block-navigation__responsive-container' + ( open ? ' is-menu-open' : '' ) + '">' +
		'<ul class="wp-block-navigation__container wp-block-navigation">' + renderItems( links ) + '</ul>' +
		'<div class="wp-block-navigation__overlay-container">' +
		'<button class="wp-block-navigation-overlay-close" type="button" aria-label="Close" onclick=\'' +
		closeHandler( overlay === 'stuck' ) + '\'></button>' +
		( options.overlayNav ?
			'<div class="wp-block-navigation is-vertical">' +
			'<ul class="wp-block-navigation__container wp-block-navigation">' + renderItems( links ) + '</ul></div>' :
			'' ) +
		'</div></div></nav>';

	var header = sticky === false ?
		'<header>' + nav + '</header>' :
		'<header><div class="is-position-sticky" style="height:' + sticky + 'px;background:#eee">' + nav + '</div></header>';

	return '<!doctype html><html' + ( open ? ' class="has-modal-open"' : '' ) + '><head>' +
		'<meta charset="utf-8"><title>fixture</title>' +
		'<link rel="stylesheet" href="' + ORIGIN + '/style.css">' +
		'<style>body{margin:0}</style>' +
		ORACLE +
		( options.extraHead || '' ) +
		'<script src="' + ORIGIN + '/anchor-navigation.js" defer></script>' +
		'</head><body>' +
		header +
		'<main>' + sections.map( renderSection ).join( '' ) + '</main>' +
		'</body></html>';
}

/**
 * Serve a rendered page at `url` and open it. Routes are registered on the context so a
 * tab opened from the page is served too. The script and stylesheet come from the theme
 * files on disk.
 */
async function servePage( page, html, url ) {
	url = url || PAGE_URL;
	var context = page.context();
	await context.route( '**/anchor-navigation.js', function ( route ) {
		return route.fulfill( { path: path.join( THEME_ROOT, 'assets/js/anchor-navigation.js' ), contentType: 'application/javascript' } );
	} );
	await context.route( '**/style.css', function ( route ) {
		return route.fulfill( { path: path.join( THEME_ROOT, 'style.css' ), contentType: 'text/css' } );
	} );
	await context.route( url, function ( route ) {
		return route.fulfill( { contentType: 'text/html', body: html } );
	} );
	await page.goto( url );
}

/**
 * Destinations a link the script must ignore can navigate to.
 */
async function serveElsewhere( context ) {
	var elsewhere = function ( route ) {
		return route.fulfill( { contentType: 'text/html', body: '<!doctype html><title>elsewhere</title>' } );
	};
	await context.route( 'http://other.test/**', elsewhere );
	await context.route( ORIGIN + '/other/', elsewhere );
	await context.route( ORIGIN + '/page/?q=1', elsewhere );
	await context.route( ORIGIN + '/file.txt', function ( route ) {
		return route.fulfill( { contentType: 'text/plain', body: 'file' } );
	} );
}

/**
 * Record whether the last click was default-prevented. The listener sits on `window`
 * in the bubble phase, after the script's `document` listener, and prevents nothing
 * itself, so the browser's own default action stays observable.
 */
async function recordClickOutcome( page ) {
	await page.evaluate( function () {
		window.__lastClick = null;
		window.addEventListener( 'click', function ( event ) {
			window.__lastClick = { defaultPrevented: event.defaultPrevented };
		} );
	} );
}

module.exports = {
	ORIGIN: ORIGIN,
	PAGE_URL: PAGE_URL,
	renderPage: renderPage,
	servePage: servePage,
	serveElsewhere: serveElsewhere,
	recordClickOutcome: recordClickOutcome,
};
