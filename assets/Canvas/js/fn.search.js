SEMICOLON.Core.getVars.fn.search = selector => {
	const core = SEMICOLON.Core;
	selector = core.getSelector( selector, false );
	if( selector.length < 1 ){
		return true;
	}

	// let x = document.querySelectorAll("div, p");
	// let divs = [...x].filter(elem => elem.matches(":not(#primary-menu-trigger)"));
	// console.log( divs );

	let searchForm = document.querySelector('.top-search-form');

	if( !searchForm ) {
		return true;
	}

	searchForm.closest('.header-row').classList.add( 'top-search-parent' );

	let topSearchParent = document.querySelector('.top-search-parent'),
		timeout;

	selector[0].onclick = e => {
		clearTimeout( timeout );

		core.getVars.elBody.classList.toggle('top-search-open');
		document.getElementById('top-cart')?.classList.remove('top-cart-open');

		core.getVars.recalls.menureset();

		if( core.getVars.elBody.classList.contains('top-search-open') ) {
			topSearchParent.classList.add('position-relative');
		} else {
			timeout = setTimeout( () => {
				topSearchParent.classList.remove('position-relative');
			}, 500);
		}

		core.getVars.elBody.classList.remove("primary-menu-open");
		core.getVars.elPageMenu && core.getVars.elPageMenu.classList.remove('page-menu-open');

		if (core.getVars.elBody.classList.contains('top-search-open')){
			searchForm.querySelector('input').focus();
		}

		e.stopPropagation();
		e.preventDefault();
	};

	document.addEventListener( 'click', e => {
		if (!e.target.closest('.top-search-form')) {
			core.getVars.elBody.classList.remove('top-search-open');
			timeout = setTimeout( () => {
				topSearchParent.classList.remove('position-relative');
			}, 500);
		}
	}, false);
};
