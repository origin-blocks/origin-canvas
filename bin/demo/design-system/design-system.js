/**
 * Design system page: fills each specimen's hex and contrast caption from the colors the
 * browser paints. A sample's text color is composited over its own background, then its
 * ancestors' until an opaque layer, over white. Ratios use the WCAG 2 relative-luminance
 * formula, rounded to two decimals. Method from the Puro design system page.
 */
( function () {
	'use strict';

	const WHITE = [ 255, 255, 255, 1 ];

	// rgb()/rgba() and color(srgb …), the two forms browsers serialize to.
	function parse( value ) {
		let m = /rgba?\(([^)]+)\)/.exec( value );
		let p;
		if ( m ) {
			p = m[ 1 ].split( /[\s,\/]+/ ).filter( Boolean ).map( Number );
			return [ p[ 0 ], p[ 1 ], p[ 2 ], p.length > 3 ? p[ 3 ] : 1 ];
		}
		m = /color\(srgb ([^)]+)\)/.exec( value );
		if ( m ) {
			p = m[ 1 ].split( /[\s\/]+/ ).filter( Boolean ).map( Number );
			return [
				p[ 0 ] * 255,
				p[ 1 ] * 255,
				p[ 2 ] * 255,
				p.length > 3 ? p[ 3 ] : 1,
			];
		}
		return null;
	}

	function over( top, bottom ) {
		const a = top[ 3 ];
		return [ 0, 1, 2 ]
			.map( ( i ) => top[ i ] * a + bottom[ i ] * ( 1 - a ) )
			.concat( 1 );
	}

	// What paints behind an element: its own background and its ancestors', stacked from
	// the first opaque layer up, over white.
	function backdrop( el ) {
		const layers = [];
		let base = WHITE;
		for ( ; el && el.nodeType === 1; el = el.parentElement ) {
			const c = parse( getComputedStyle( el ).backgroundColor );
			if ( ! c ) {
				return null;
			}
			if ( c[ 3 ] > 0 ) {
				layers.push( c );
				if ( c[ 3 ] >= 1 ) {
					break;
				}
			}
		}
		for ( let i = layers.length - 1; i >= 0; i-- ) {
			base = over( layers[ i ], base );
		}
		return base;
	}

	function luminance( c ) {
		const v = c.slice( 0, 3 ).map( ( x ) => {
			x /= 255;
			return x <= 0.03928 ? x / 12.92 : Math.pow( ( x + 0.055 ) / 1.055, 2.4 );
		} );
		return 0.2126 * v[ 0 ] + 0.7152 * v[ 1 ] + 0.0722 * v[ 2 ];
	}

	function ratio( a, b ) {
		const la = luminance( a );
		const lb = luminance( b );
		return ( Math.max( la, lb ) + 0.05 ) / ( Math.min( la, lb ) + 0.05 );
	}

	function hex( c ) {
		return (
			'#' +
			c
				.slice( 0, 3 )
				.map( ( x ) => ( '0' + Math.round( x ).toString( 16 ) ).slice( -2 ) )
				.join( '' )
				.toUpperCase()
		);
	}

	// Text faded with opacity, on the element or a parent inside the specimen, is blended
	// over the ground by the product of those opacities.
	function measure( el, frame ) {
		const fg = parse( getComputedStyle( el ).color );
		const bg = backdrop( el );
		let opacity = 1;
		for ( let n = el; n && n !== frame; n = n.parentElement ) {
			opacity *= parseFloat( getComputedStyle( n ).opacity );
		}
		if ( ! fg || ! bg ) {
			return null;
		}
		const paint = over( [ fg[ 0 ], fg[ 1 ], fg[ 2 ], fg[ 3 ] * opacity ], bg );
		return {
			hex: hex( paint ),
			blended: fg[ 3 ] * opacity < 1,
			ground: hex( bg ),
			ratio: ratio( paint, bg ),
		};
	}

	document.querySelectorAll( '[data-ocds-sample]' ).forEach( ( sample ) => {
		const tile = sample.closest( '[data-ocds-tile]' );
		const selector = sample.getAttribute( 'data-ocds-sample' );
		const target =
			( selector && sample.querySelector( selector ) ) ||
			sample.firstElementChild ||
			sample;
		const m = measure( target, sample.parentElement );
		const hexEl = tile && tile.querySelector( '[data-ocds-hex]' );
		const ratioEl = tile && tile.querySelector( '[data-ocds-ratio]' );
		if ( hexEl ) {
			hexEl.textContent = m
				? m.hex + ( m.blended ? ' as painted' : '' ) + ' on ' + m.ground
				: 'n/a';
		}
		if ( ratioEl ) {
			ratioEl.textContent = m ? m.ratio.toFixed( 2 ) + ':1' : 'n/a';
			// AA binds the neutral text roles only; primary is exempt by rule.
			if ( m && tile.hasAttribute( 'data-ocds-aa' ) && m.ratio < 4.5 ) {
				ratioEl.textContent += ' · under AA';
			}
		}
	} );
}() );
