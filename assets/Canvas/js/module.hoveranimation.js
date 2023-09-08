export default function( selector ) {
	const core = SEMICOLON.Core;
	core.initFunction({ class: 'has-plugin-hoveranimation', event: 'pluginHoverAnimationReady' });

	selector = core.getSelector( selector, false );
	if( selector.length < 1 ){
		return true;
	}

	selector.forEach( element => {
		let elAnimate = element.getAttribute( 'data-hover-animate' ),
			elAnimateOut = element.getAttribute( 'data-hover-animate-out' ) || 'fadeOut',
			elSpeed = element.getAttribute( 'data-hover-speed' ) || 600,
			elDelay = element.getAttribute( 'data-hover-delay' ),
			elParent = element.getAttribute( 'data-hover-parent' ),
			elReset = element.getAttribute( 'data-hover-reset' ) || 'false',
			elMobile = element.getAttribute( 'data-hover-mobile' ) || 'true';

		if( elMobile != 'true' ) {
			if( elMobile == 'false' ) {
				if( !core.getVars.elBody.classList.contains('device-up-lg') ) {
					return true;
				}
			} else {
				if( !core.getVars.elBody.classList.contains('device-up-' + elMobile) ) {
					return true;
				}
			}
		}

		element.classList.add( 'not-animated' );

		if( !elParent ) {
			if( element.closest( '.bg-overlay' ) ) {
				elParent = element.closest( '.bg-overlay' );
			} else {
				elParent = element;
			}
		} else {
			if( elParent == 'self' ) {
				elParent = element;
			} else {
				elParent = element.closest( elParent );
			}
		}

		let elDelayT = 0;

		if( elDelay ) {
			elDelayT = Number( elDelay );
		}

		if( elSpeed ) {
			element.style.animationDuration = Number( elSpeed ) + 'ms';
		}

		let t, x;

		elParent.addEventListener( 'mouseover', e => {
			clearTimeout( x );

			t = setTimeout(() => {
					element.classList.add( 'not-animated' );
					(elAnimateOut + ' not-animated').split(" ").forEach(_class => element.classList.remove(_class));
					(elAnimate + ' animated').split(" ").forEach(_class => element.classList.add(_class));
				}, elDelayT );
		}, false);

		elParent.addEventListener( 'mouseleave', e => {
			element.classList.add( 'not-animated' );
			(elAnimate + ' not-animated').split(" ").forEach(_class => element.classList.remove(_class));
			(elAnimateOut + ' animated').split(" ").forEach(_class => element.classList.add(_class));

			if( elReset == 'true' ) {
				x = setTimeout(() => {
					(elAnimateOut + ' animated').split(" ").forEach(_class => element.classList.remove(_class));
					element.classList.add( 'not-animated' );
				}, Number( elSpeed ) );
			}

			clearTimeout( t );
		}, false);
	});
};
