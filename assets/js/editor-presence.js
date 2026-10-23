/**
 * Origin Canvas: editor presence for Update colours (#116).
 *
 * Each open post editor or Site Editor tab reports, on every heartbeat, every entity it has
 * loaded: the post or template being edited, any edited record, and every template part,
 * navigation menu and synced pattern in the canvas. The theme keeps one post meta row per tab,
 * so Update colours skips what is open in any tab of any user.
 */
( function ( $, wp, config ) {
	if ( ! $ || ! wp || ! wp.data || ! config ) {
		return;
	}

	// A version 4 UUID from crypto.getRandomValues(), which every context has.
	// crypto.randomUUID() exists only in secure contexts, and an http:// admin is not one.
	const tab = ( () => {
		const b = window.crypto.getRandomValues( new Uint8Array( 16 ) );
		b[ 6 ] = ( b[ 6 ] & 0x0f ) | 0x40;
		b[ 8 ] = ( b[ 8 ] & 0x3f ) | 0x80;
		const h = Array.from( b, ( x ) => x.toString( 16 ).padStart( 2, '0' ) ).join( '' );
		return `${ h.slice( 0, 8 ) }-${ h.slice( 8, 12 ) }-${ h.slice( 12, 16 ) }-${ h.slice( 16, 20 ) }-${ h.slice( 20 ) }`;
	} )();

	const types = config.types || [];

	/**
	 * Every unique entity this tab has loaded, no cap. core-data has no public selector for loaded
	 * records, so the blocks are read from the block editor: getBlocksByName() walks the
	 * controlled inner blocks of template parts and synced patterns too, and returns client IDs.
	 */
	function collect() {
		const editor = wp.data.select( 'core/editor' );
		if ( ! editor ) {
			return [];
		}
		const out = [];
		const seen = new Set();
		const add = ( type, id ) => {
			if ( ! type || id === undefined || id === null || id === '' || ! types.includes( type ) ) {
				return;
			}
			const key = `${ type }|${ id }`;
			if ( ! seen.has( key ) ) {
				seen.add( key );
				out.push( { type, id } );
			}
		};
		add( editor.getCurrentPostType(), editor.getCurrentPostId() );
		const core = wp.data.select( 'core' );
		if ( core && core.__experimentalGetDirtyEntityRecords ) {
			for ( const r of core.__experimentalGetDirtyEntityRecords() ) {
				if ( r && r.kind === 'postType' ) {
					add( r.name, r.key );
				}
			}
		}
		const be = wp.data.select( 'core/block-editor' );
		if ( be && be.getBlocksByName && be.getBlocksByClientId ) {
			const ids = be.getBlocksByName( [ 'core/template-part', 'core/navigation', 'core/block' ] );
			const theme = core && core.getCurrentTheme ? ( core.getCurrentTheme() || {} ).stylesheet : undefined;
			for ( const block of be.getBlocksByClientId( ids ) ) {
				if ( ! block || ! block.attributes ) {
					continue;
				}
				const a = block.attributes;
				if ( block.name === 'core/template-part' && a.slug ) {
					add( 'wp_template_part', `${ a.theme || theme }//${ a.slug }` );
				} else if ( block.name === 'core/navigation' && a.ref ) {
					add( 'wp_navigation', a.ref );
				} else if ( block.name === 'core/block' && a.ref ) {
					add( 'wp_block', a.ref );
				}
			}
		}
		return out;
	}

	$( document ).on( 'heartbeat-send', ( event, data ) => {
		data.origin_canvas_editing = { tab, entities: collect() };
	} );

	// Report a newly loaded entity at once, at most once per 10 s; a later one waits for the end
	// of the window.
	let lastConnect = 0;
	let pending = null;
	function connect() {
		const wait = lastConnect + 10000 - Date.now();
		if ( wait > 0 ) {
			if ( ! pending ) {
				pending = window.setTimeout( () => {
					pending = null;
					connect();
				}, wait );
			}
			return;
		}
		lastConnect = Date.now();
		if ( wp.heartbeat && wp.heartbeat.connectNow ) {
			wp.heartbeat.connectNow();
		}
	}

	const known = new Set();
	let check = null;
	function scheduleCheck() {
		if ( check ) {
			return;
		}
		check = window.setTimeout( () => {
			check = null;
			let grew = false;
			for ( const e of collect() ) {
				const key = `${ e.type }|${ e.id }`;
				if ( ! known.has( key ) ) {
					known.add( key );
					grew = true;
				}
			}
			if ( grew ) {
				connect();
			}
		}, 500 );
	}
	wp.data.subscribe( scheduleCheck );
	scheduleCheck();

	// Leaving the editor drops this tab's rows at once.
	window.addEventListener( 'pagehide', () => {
		const body = new window.FormData();
		body.append( 'action', 'origin_canvas_editor_left' );
		body.append( '_ajax_nonce', config.nonce );
		body.append( 'tab', tab );
		window.navigator.sendBeacon( config.ajaxUrl, body );
	} );
} )( window.jQuery, window.wp, window.originCanvasPresence );
