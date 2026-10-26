/**
 * Origin Canvas: the Update colours page loop and the notice dismiss (#116).
 */
( function ( config ) {
	if ( ! config ) {
		return;
	}
	const { __, _n, sprintf } = window.wp.i18n;
	const s = {
		working: __( 'Updating colours…', 'origin-canvas' ),
		gsFailed: __( 'Your saved styles could not be updated. Run this again.', 'origin-canvas' ),
		cssFailed: __( 'Your Additional CSS could not be updated. Run this again.', 'origin-canvas' ),
		gsCssFailed: __( 'The custom CSS in your saved styles could not be updated. Run this again.', 'origin-canvas' ),
		nothing: __( 'Done. Your content uses the new colour names.', 'origin-canvas' ),
		stopped: __( 'The update stopped. Run it again to continue.', 'origin-canvas' ),
	};
	// Counts take the plural form of the site's language.
	const count = {
		/* translators: %d: number of items. */
		updated: ( n ) => sprintf( _n( 'Updated %d item.', 'Updated %d items.', n, 'origin-canvas' ), n ),
		/* translators: %d: number of items. */
		locked: ( n ) => sprintf( _n( '%d item was open in an editor. Close it and run this again.', '%d items were open in an editor. Close them and run this again.', n, 'origin-canvas' ), n ),
		/* translators: %d: number of items. */
		changed: ( n ) => sprintf( _n( '%d item changed while this ran. Run this again.', '%d items changed while this ran. Run this again.', n, 'origin-canvas' ), n ),
		/* translators: %d: number of items. */
		failed: ( n ) => sprintf( _n( '%d item could not be saved. Run this again.', '%d items could not be saved. Run this again.', n, 'origin-canvas' ), n ),
		/* translators: %d: number of items. */
		progress: ( n ) => sprintf( _n( 'Updating colours… %d item left.', 'Updating colours… %d items left.', n, 'origin-canvas' ), n ),
	};
	const RANK = { none: 0, updated: 1, failed: 2 };
	const worst = ( a, b ) => ( ( RANK[ b ] || 0 ) > ( RANK[ a ] || 0 ) ? b : a );

	function post( data ) {
		const body = new window.URLSearchParams( data );
		return window.fetch( config.ajaxUrl, { method: 'POST', credentials: 'same-origin', body } ).then( ( res ) => {
			if ( ! res.ok ) {
				throw new Error( `HTTP ${ res.status }` );
			}
			return res.json();
		} );
	}

	function run( button, status, report ) {
		const total = { updated: 0, locked: new Set(), changed: new Set(), failed: new Set(), gs: 'none', additionalCss: 'none', gsCss: 'none', remaining: 0 };
		button.disabled = true;
		status.setAttribute( 'data-done', '0' );
		report.innerHTML = '';
		// Two live regions, each line shown once: the status carries the progress while the run is
		// in flight, and the report list carries the outcome, one announced item per line.
		status.textContent = s.working;
		const line = ( text ) => {
			const li = document.createElement( 'li' );
			li.textContent = text;
			report.appendChild( li );
		};
		const finish = () => {
			status.setAttribute( 'data-done', '1' );
			if ( total.updated > 0 ) {
				line( count.updated( total.updated ) );
			}
			if ( total.locked.size ) {
				line( count.locked( total.locked.size ) );
			}
			if ( total.changed.size ) {
				line( count.changed( total.changed.size ) );
			}
			if ( total.failed.size ) {
				line( count.failed( total.failed.size ) );
			}
			if ( total.gs === 'failed' ) {
				line( s.gsFailed );
			}
			if ( total.additionalCss === 'failed' ) {
				line( s.cssFailed );
			}
			if ( total.gsCss === 'failed' ) {
				line( s.gsCssFailed );
			}
			// Done only when nothing is left and every store moved.
			if ( total.remaining === 0 && ! [ total.gs, total.additionalCss, total.gsCss ].includes( 'failed' ) ) {
				line( s.nothing );
			} else if ( total.remaining > 0 && ! total.locked.size && ! total.changed.size && ! total.failed.size ) {
				// Content is left and no line above says why: never a blank report.
				line( s.stopped );
			}
			status.textContent = '';
			button.disabled = false;
		};
		const step = () => {
			post( { action: 'origin_canvas_update_colours', _wpnonce: config.nonce } )
				.then( ( r ) => {
					if ( ! r || typeof r !== 'object' || r.error ) {
						throw new Error( 'bad response' );
					}
					total.remaining = Number( r.remaining ) || 0;
					status.setAttribute( 'data-remaining', String( total.remaining ) );
					total.updated += Number( r.updated ) || 0;
					( r.locked || [] ).forEach( ( id ) => total.locked.add( id ) );
					( r.changed || [] ).forEach( ( id ) => total.changed.add( id ) );
					( r.failed || [] ).forEach( ( id ) => total.failed.add( id ) );
					total.gs = worst( total.gs, r.global_styles );
					total.additionalCss = worst( total.additionalCss, r.additional_css );
					total.gsCss = worst( total.gsCss, r.global_styles_css );
					if ( r.done ) {
						finish();
					} else {
						status.textContent = count.progress( total.remaining );
						step();
					}
				} )
				.catch( () => {
					line( s.stopped );
					status.textContent = '';
					button.disabled = false;
				} );
		};
		step();
	}

	const init = () => {
		const button = document.getElementById( 'origin-canvas-update-colours-run' );
		const status = document.getElementById( 'origin-canvas-update-colours-status' );
		const report = document.getElementById( 'origin-canvas-update-colours-report' );
		if ( button && status && report ) {
			button.addEventListener( 'click', () => run( button, status, report ) );
		}
	};
	if ( document.readyState === 'loading' ) {
		document.addEventListener( 'DOMContentLoaded', init );
	} else {
		init();
	}

	// Core adds the dismiss button to .is-dismissible notices; a click records the dismissal. The
	// request is synchronous: the next page load must already find the notice dismissed, and an
	// asynchronous request can still be in flight when the user moves on. A beacon is the
	// fallback where a synchronous request is refused.
	document.addEventListener( 'click', ( event ) => {
		const target = event.target && event.target.closest ? event.target.closest( '#origin-canvas-update-colours-notice .notice-dismiss' ) : null;
		if ( ! target ) {
			return;
		}
		const data = { action: 'origin_canvas_dismiss_update_colours_notice', _ajax_nonce: config.dismissNonce };
		try {
			const xhr = new window.XMLHttpRequest();
			xhr.open( 'POST', config.ajaxUrl, false );
			xhr.setRequestHeader( 'Content-Type', 'application/x-www-form-urlencoded' );
			xhr.send( new window.URLSearchParams( data ).toString() );
		} catch ( e ) {
			const body = new window.FormData();
			Object.keys( data ).forEach( ( k ) => body.append( k, data[ k ] ) );
			window.navigator.sendBeacon( config.ajaxUrl, body );
		}
	} );
}( window.originCanvasUpdateColours ) );
