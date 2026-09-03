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
	var CURRENT_CLASS = 'origin-canvas-current';
	// Core puts `wp-block-navigation` on the block root and on its inner `ul`, and a
	// custom overlay part renders a second Navigation block inside the first.
	var NAV_ROOT = '.wp-block-navigation:not(.wp-block-navigation__container)';
	var NAV_ITEM = 'li.wp-block-navigation-item';
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
		// A re-click on the current fragment scrolls without adding a history entry,
		// as native fragment navigation does.
		if ( window.location.hash !== hash ) {
			try {
				window.history.pushState( null, '', hash );
				window.dispatchEvent(
					new HashChangeEvent( 'hashchange', { oldURL: oldURL, newURL: window.location.href } )
				);
			} catch ( e ) {
				// A history that refuses the entry still gets the scroll below.
			}
		}
		target.scrollIntoView( {
			behavior: reducedMotion.matches ? 'auto' : 'smooth',
			block: 'start',
		} );
		// Move sequential focus to the target so keyboard users continue from the
		// section, as they would after a native fragment jump. A target that is not
		// focusable borrows tabindex="-1" until it loses focus.
		target.focus( { preventScroll: true } );
		if ( document.activeElement !== target ) {
			target.setAttribute( 'tabindex', '-1' );
			target.addEventListener( 'blur', function () {
				target.removeAttribute( 'tabindex' );
			}, { once: true } );
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
			event.metaKey || event.ctrlKey || event.shiftKey || event.altKey ||
			! ( event.target instanceof Element )
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
	 * Current-section marker.
	 *
	 * Each Navigation block keeps its own record: the same-page links it owns, grouped
	 * by target, and the items core marked as the current page at load. Every link to
	 * the current section (a submenu parent and its child can share one) is marked;
	 * the nav's current-page marker and its `aria-current="page"` are set aside while a
	 * section is current and restored when none is, so page and section never show
	 * together.
	 */
	var navs = [];

	function ownedBy( nav ) {
		return function ( element ) {
			return element.closest( NAV_ROOT ) === nav;
		};
	}

	function documentOrder( a, b ) {
		return a.target.compareDocumentPosition( b.target ) & Node.DOCUMENT_POSITION_FOLLOWING ? -1 : 1;
	}

	document.querySelectorAll( NAV_ROOT ).forEach( function ( nav ) {
		var owns = ownedBy( nav );
		var byTarget = new Map();

		nav.querySelectorAll( NAV_ITEM + ' > a[href]' ).forEach( function ( link ) {
			if ( ! owns( link ) ) {
				return;
			}
			var target = resolveSamePageTarget( link );
			if ( ! target ) {
				return;
			}
			var entry = byTarget.get( target );
			if ( ! entry ) {
				entry = {
					target: target,
					// The region a link stands for: a section, else its Group, else
					// the element itself, so an anchor on a heading keeps its item
					// current while the surrounding section is on screen.
					extent: target.closest( 'section' ) || target.closest( '.wp-block-group' ) || target,
					links: [],
					items: [],
				};
				byTarget.set( target, entry );
			}
			entry.links.push( link );
			var item = link.parentElement;
			while ( item && owns( item ) ) {
				if ( entry.items.indexOf( item ) === -1 ) {
					entry.items.push( item );
				}
				item = item.parentElement.closest( NAV_ITEM + '.has-child' );
			}
		} );

		if ( ! byTarget.size ) {
			return;
		}

		var pageMarked = [];
		nav.querySelectorAll( NAV_ITEM + '.current-menu-item, ' + NAV_ITEM + '.current-menu-ancestor' ).forEach( function ( item ) {
			if ( ! owns( item ) ) {
				return;
			}
			var link = item.querySelector( ':scope > a' );
			pageMarked.push( {
				item: item,
				classes: [ 'current-menu-item', 'current-menu-ancestor' ].filter( function ( name ) {
					return item.classList.contains( name );
				} ),
				link: link,
				ariaCurrent: link ? link.getAttribute( 'aria-current' ) : null,
			} );
		} );

		navs.push( {
			entries: Array.from( byTarget.values() ).sort( documentOrder ),
			pageMarked: pageMarked,
			active: null,
		} );
	} );

	function applyCurrent( nav, active ) {
		nav.entries.forEach( function ( entry ) {
			entry.items.forEach( function ( item ) {
				item.classList.remove( CURRENT_CLASS );
			} );
			entry.links.forEach( function ( link ) {
				link.removeAttribute( 'aria-current' );
			} );
		} );
		if ( active ) {
			active.items.forEach( function ( item ) {
				item.classList.add( CURRENT_CLASS );
			} );
			active.links.forEach( function ( link ) {
				link.setAttribute( 'aria-current', 'location' );
			} );
		}
		nav.pageMarked.forEach( function ( marked ) {
			marked.classes.forEach( function ( name ) {
				marked.item.classList[ active ? 'remove' : 'add' ]( name );
			} );
			if ( marked.link && marked.ariaCurrent !== null ) {
				if ( active ) {
					marked.link.removeAttribute( 'aria-current' );
				} else {
					marked.link.setAttribute( 'aria-current', marked.ariaCurrent );
				}
			}
		} );
		nav.active = active;
	}

	function updateCurrent() {
		var offset = parseFloat( window.getComputedStyle( root ).scrollPaddingTop ) || 0;
		var viewport = window.innerHeight;
		// A section is current once its top is a quarter of the way into the visible
		// area, and stays current while its region still reaches below the chrome.
		var line = offset + 0.25 * ( viewport - offset );
		var scrollHeight = document.scrollingElement.scrollHeight;
		// Only a page that scrolls has an end; a page that fits the viewport uses the
		// line alone, so nothing is current before the reader has moved.
		var atEnd = scrollHeight - viewport > 1 && window.scrollY + viewport >= scrollHeight - 1;

		navs.forEach( function ( nav ) {
			var candidate = null;
			var lastVisible = null;
			nav.entries.forEach( function ( entry ) {
				var top = entry.target.getBoundingClientRect().top;
				var visible = top < viewport && entry.extent.getBoundingClientRect().bottom > offset;
				if ( top <= line ) {
					candidate = visible ? entry : null;
				}
				if ( visible ) {
					lastVisible = entry;
				}
			} );
			// At the end of the document a short last section never reaches the line,
			// so the last region on screen wins there.
			var active = atEnd && lastVisible ? lastVisible : candidate;
			if ( active !== nav.active ) {
				applyCurrent( nav, active );
			}
		} );
	}

	var updateScheduled = false;
	function scheduleUpdate() {
		if ( updateScheduled || ! navs.length ) {
			return;
		}
		updateScheduled = true;
		window.requestAnimationFrame( function () {
			updateScheduled = false;
			updateCurrent();
		} );
	}

	if ( navs.length ) {
		window.addEventListener( 'scroll', scheduleUpdate, { passive: true } );
		window.addEventListener( 'resize', scheduleUpdate );
		scheduleUpdate();
	}

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
		scheduleUpdate();
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
