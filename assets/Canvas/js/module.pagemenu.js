export default function( selector ) {
	const core = SEMICOLON.Core;
	selector = core.getSelector( selector, false );
	if( selector.length < 1 ){
		return true;
	}

	let pageMenu = core.getVars.elPageMenu,
		pageMenuWrap = pageMenu.querySelector('#page-menu-wrap'),
		pageMenuClone = pageMenu.querySelector('.page-menu-wrap-clone');

	if( !pageMenuClone ) {
		pageMenuClone = document.createElement('div');
		pageMenuClone.classList = 'page-menu-wrap-clone';

		pageMenuWrap.parentNode.insertBefore( pageMenuClone, pageMenuWrap.nextSibling);
		pageMenuClone = pageMenu.querySelector('.page-menu-wrap-clone');
	}

	pageMenuClone.style.height = pageMenu.querySelector('#page-menu-wrap').offsetHeight + 'px';

	pageMenu.querySelector('#page-menu-trigger').onclick = e => {
		core.getVars.elBody.classList.remove('top-search-open');
		pageMenu.classList.toggle('page-menu-open');

		e.preventDefault();
	};

	pageMenu.querySelector('nav').onclick = e => {
		core.getVars.elBody.classList.remove('top-search-open');
		document.getElementById('top-cart').classList.remove('top-cart-open');
	};

	document.addEventListener('click', e => {
		if( !e.target.closest('#page-menu') ) {
			pageMenu.classList.remove('page-menu-open');
		}
	}, false);

	if( pageMenu.classList.contains('no-sticky') || pageMenu.classList.contains('dots-menu') ) {
		return true;
	}

	let headerHeight;

	if( core.getVars.elHeader.classList.contains('no-sticky') || core.getVars.elHeader.getAttribute('data-sticky-shrink') == 'false' ) {
		headerHeight = getComputedStyle(core.getVars.elHeader).getPropertyValue('--cnvs-header-height').split('px')[0];
	} else {
		headerHeight = getComputedStyle(core.getVars.elHeader).getPropertyValue('--cnvs-header-height-shrink').split('px')[0];
	}

	if( core.getVars.elHeader.getAttribute('data-sticky-shrink') == 'false' ) {
		pageMenu.style.setProperty("--cnvs-page-submenu-sticky-offset", headerHeight+'px');
	}

	setTimeout( () => {
		core.getVars.pageMenuOffset = core.offset(pageMenu).top - headerHeight;
		CanvasStickyPageMenu( core.getVars.pageMenuOffset );
	}, 500);

	window.addEventListener( 'scroll', function(){
		CanvasStickyPageMenu( core.getVars.pageMenuOffset );
	}, { passive: true });

	core.getVars.resizers.pagemenu = () => {
		setTimeout( () => {
			core.getVars.pageMenuOffset = core.offset(pageMenu).top - headerHeight;
			CanvasStickyPageMenu( core.getVars.pageMenuOffset );
		}, 250);
	};
};

const CanvasStickyPageMenu = stickyOffset => {
	const core = SEMICOLON.Core;
	const pageMenu = core.getVars.elPageMenu;

	if( window.pageYOffset > stickyOffset ) {
		if( core.getVars.elBody.classList.contains('device-up-lg') ) {
			pageMenu.classList.add('sticky-page-menu');
		} else {
			if( pageMenu.getAttribute('data-mobile-sticky') == 'true' ) {
				pageMenu.classList.add('sticky-page-menu');
			}
		}
	} else {
		pageMenu.classList.remove('sticky-page-menu');
	}
};
