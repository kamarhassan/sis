SEMICOLON.Core.getVars.fn.gototop = selector => {
	const core = SEMICOLON.Core;
	selector = core.getSelector( selector, false );
	if( selector.length < 1 ){
		return true;
	}

	CanvasGoToTop( selector[0] );
	CanvasGoToTopScroll( selector[0] );

	window.addEventListener( 'scroll', () =>  {
		CanvasGoToTopScroll( selector[0] );
	}, { passive: true });
};

const CanvasGoToTop = element => {
	const core = SEMICOLON.Core;

	let elSpeed = element.getAttribute('data-speed') || 700,
		elEasing = element.getAttribute('data-easing');

	element.onclick = e => {
		if( elEasing ) {
			jQuery('body,html').stop(true).animate({
				'scrollTop': 0
			}, Number( elSpeed ), elEasing );
		} else {
			window.scrollTo({
				top: 0,
				behavior: 'smooth'
			});
		}

		e.preventDefault();
	};
};

const CanvasGoToTopScroll = element => {
	const core = SEMICOLON.Core;
	let body = core.getVars.elBody.classList;

	let elMobile = element.getAttribute('data-mobile') || 'false',
		elOffset = element.getAttribute('data-offset') || 450;

	if( elMobile == 'false' && ( body.contains('device-xs') || body.contains('device-sm') || body.contains('device-md') ) ) {
		return true;
	}

	if( window.scrollY > Number(elOffset) ) {
		body.add('gototop-active');
	} else {
		body.remove('gototop-active');
	}
};

