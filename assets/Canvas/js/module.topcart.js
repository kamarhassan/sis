export default function( selector ) {
	const core = SEMICOLON.Core;
	selector = core.getSelector( selector, false );
	if( selector.length < 1 ){
		return true;
	}

	if( !document.getElementById('top-cart-trigger') ) {
		return false;
	}

	let body = core.getVars.elBody.classList;

	document.getElementById('top-cart-trigger').onclick = e => {
		selector[0].classList.toggle('top-cart-open');

		// if( ( body.contains('device-md') || body.contains('device-sm') || body.contains('device-xs') ) && selector[0].classList.contains('top-cart-open') ) {
		// 	body.add('overflow-hidden');
		// } else {
		// 	body.remove('overflow-hidden');
		// }
		// jQuery('#page-menu').toggleClass('page-menu-open', false);

		e.stopPropagation();
		e.preventDefault();
	};

	document.addEventListener('click', e => {
		if( !e.target.closest('#top-cart') ) {
			selector[0].classList.remove('top-cart-open');
			// body.remove('overflow-hidden');
		}
	}, false);
};

