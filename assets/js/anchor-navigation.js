/**
 * Anchor navigation.
 *
 * Same-page anchor links scroll smoothly and land below the sticky chrome, and the
 * navigation item whose link points at the section in view carries
 * `origin-canvas-current`. Front end only: the script is enqueued on
 * `wp_enqueue_scripts`, which never runs inside the editor canvas.
 *
 * The scroll offset is CSS: `html { scroll-padding-top }` in style.css adds the admin
 * bar and `--origin-canvas-sticky-header-height`, which this script measures from the
 * sticky header because its height is fluid. Native fragment jumps, scrollIntoView and
 * find-in-page all honour scroll-padding, so no scroll arithmetic happens here.
 */
( function () {
	'use strict';

	var root = document.documentElement;
	var STICKY_PROPERTY = '--origin-canvas-sticky-header-height';
	var reducedMotion = window.matchMedia( '(prefers-reduced-motion: reduce)' );

	/**
	 * Resolve a link to the element it points at on this page, or null.
	 *
	 * Same origin, pathname and search, a non-empty fragment, and an element with that
	 * id. A malformed percent escape returns null rather than throwing.
	 */
	function resolveSamePageTarget( anchor ) {
		var url, fragment;
		try {
			url = new URL( anchor.href, window.location.href );
		} catch ( e ) {
			return null;
		}
		if (
			url.origin !== window.location.origin ||
			url.pathname !== window.location.pathname ||
			url.search !== window.location.search ||
			url.hash.length < 2
		) {
			return null;
		}
		try {
			fragment = decodeURIComponent( url.hash.slice( 1 ) );
		} catch ( e ) {
			return null;
		}
		return document.getElementById( fragment );
	}

	function scrollToTarget( target, hash ) {
		var oldURL = window.location.href;
		window.history.pushState( null, '', hash );
		window.dispatchEvent(
			new HashChangeEvent( 'hashchange', { oldURL: oldURL, newURL: window.location.href } )
		);
		target.scrollIntoView( {
			behavior: reducedMotion.matches ? 'auto' : 'smooth',
			block: 'start',
		} );
		// Move sequential focus to the target so keyboard users continue from the
		// section, as they would after a native fragment jump.
		target.focus( { preventScroll: true } );
		if ( document.activeElement !== target ) {
			target.setAttribute( 'tabindex', '-1' );
			target.focus( { preventScroll: true } );
		}
	}

	/**
	 * The core navigation overlay locks page scrolling while open and does not close
	 * on a link click, so an anchor click inside it closes it first and waits, up to
	 * ten frames, for core's `has-modal-open` marker to clear.
	 */
	function afterOverlayClosed( frames, done ) {
		if ( frames <= 0 || ! root.classList.contains( 'has-modal-open' ) ) {
			done();
			return;
		}
		window.requestAnimationFrame( function () {
			afterOverlayClosed( frames - 1, done );
		} );
	}

	document.addEventListener( 'click', function ( event ) {
		if (
			event.defaultPrevented ||
			event.button !== 0 ||
			event.metaKey || event.ctrlKey || event.shiftKey || event.altKey
		) {
			return;
		}
		var anchor = event.target.closest( 'a[href]' );
		if (
			! anchor ||
			( anchor.target && anchor.target !== '_self' ) ||
			anchor.hasAttribute( 'download' )
		) {
			return;
		}
		var target = resolveSamePageTarget( anchor );
		if ( ! target ) {
			return;
		}
		event.preventDefault();
		var hash = new URL( anchor.href, window.location.href ).hash;
		var overlay = anchor.closest( '.wp-block-navigation__responsive-container.is-menu-open' );
		var close = overlay && overlay.querySelector(
			'.wp-block-navigation-overlay-close, .wp-block-navigation__responsive-container-close'
		);
		if ( close ) {
			close.click();
			afterOverlayClosed( 10, function () {
				scrollToTarget( target, hash );
			} );
			return;
		}
		scrollToTarget( target, hash );
	} );

	/**
	 * Sticky header offset. style.css makes the `header` wrapper itself sticky when it
	 * holds a sticky child, so the wrapper's height is the chrome height. Sticky-ness
	 * is rendered markup and cannot change without a page load, so it is read once.
	 */
	var stickyHeader = null;
	try {
		stickyHeader = document.querySelector( 'header:has(> .is-position-sticky)' );
	} catch ( e ) {
		// A browser without :has() gets no sticky offset rather than a broken script.
	}
	var startedAt = Date.now();

	function realignInitialHash() {
		// The browser performed its fragment jump before the property existed, so
		// re-align while the layout is still settling; after that the user owns the
		// scroll position.
		if ( Date.now() - startedAt > 1000 || ! window.location.hash ) {
			return;
		}
		var target = resolveSamePageTarget( { href: window.location.href } );
		if ( target ) {
			target.scrollIntoView( { behavior: 'auto', block: 'start' } );
		}
	}

	function syncStickyOffset() {
		root.style.setProperty( STICKY_PROPERTY, stickyHeader.offsetHeight + 'px' );
		realignInitialHash();
	}

	if ( stickyHeader ) {
		if ( 'ResizeObserver' in window ) {
			new ResizeObserver( syncStickyOffset ).observe( stickyHeader );
		} else {
			syncStickyOffset();
		}
		window.addEventListener( 'resize', syncStickyOffset );
	}
} )();
