export default function( selector ) {
	const core = SEMICOLON.Core;
	core.initFunction({ class: 'has-plugin-onepage', event: 'pluginOnePageReady' });

	selector = core.getSelector( selector, false );
	if( selector.length < 1 ){
		return true;
	}

	let scrollToLinks = core.filtered( selector, '[data-scrollto]' ),
		onePageLinks = core.filtered( selector, '.one-page-menu' );

	if( scrollToLinks.length > 0 ) {
		core.getVars.elLinkScrolls = scrollToLinks;
	}

	if( onePageLinks.length > 0 ) {
		core.getVars.elOnePageMenus = onePageLinks;
	}

	CanvasOnePageModuleInit(selector);
	CanvasPageScrollPosition();

	window.addEventListener('scroll', () => {
		CanvasPageScrollPosition();
	},{passive: true});

	core.getVars.resizers.onepage = () => SEMICOLON.Modules.onePage();
}

const CanvasOnePageModuleInit = selector => {
	const core = SEMICOLON.Core;

	CanvasOnePageScrollerHash();

	if( core.getVars.elLinkScrolls ) {
		core.getVars.elLinkScrolls.forEach( el => {
			CanvasPageScrollerGetSettings( el, 'scrollTo' );

			el.onclick = e => {
				e.preventDefault();
				CanvasPageScroller( el, 'scrollTo' );
			};
		});
	}

	if( core.getVars.elOnePageMenus ) {
		core.getVars.elOnePageMenus.forEach( onePageMenu => {
			core.getVars.elOnePageActiveClass = onePageMenu.getAttribute('data-active-class') || 'current';
			core.getVars.elOnePageParentSelector = onePageMenu.getAttribute('data-parent') || 'li';
			core.getVars.elOnePageActiveOnClick = onePageMenu.getAttribute('data-onclick-active') || 'false';

			onePageMenu.querySelectorAll('[data-href]').forEach( el => {
				CanvasPageScrollerGetSettings( el, 'onePage' );

				el.onclick = e => {
					e.preventDefault();
					CanvasPageScroller( el, 'onePage' );
				};
			});
		});
	}
};

const CanvasOnePageScrollerHash = () => {
	const core = SEMICOLON.Core;

	if( core.getOptions.scrollExternalLinks != true ) {
		return false;
	}

	if( document.querySelector('a[data-href="'+ core.getVars.hash +'"]') || document.querySelector('a[data-scrollto="'+ core.getVars.hash +'"]') ) {
		window.onbeforeunload = () =>  {
			window.scrollTo({
				top: 0,
				behavior: 'auto'
			});
		};

		window.scrollTo({
			top: 0,
			behavior: 'auto'
		});

		let section = document.querySelector(core.getVars.hash);

		if( section ) {
			let int = setInterval( () => {
				let settings = section.getAttribute('data-onepage-settings') && JSON.parse( section.getAttribute('data-onepage-settings') );

				if( settings ) {
					CanvasPageScrollAnimation(section, settings, 0);
					clearInterval(int);
				}
			}, 250);
		}
	}
};

const CanvasPageScrollerSection = (el, type) => {
	const core = SEMICOLON.Core;
	let anchor;

	if( type == 'scrollTo' ) {
		anchor = el.getAttribute('data-scrollto');
	} else {
		anchor = el.getAttribute('data-href');
	}

	let section = document.querySelector( anchor );

	return section;
};

const CanvasPageScrollerGetSettings = (el, type) => {
	const core = SEMICOLON.Core;
	let section = CanvasPageScrollerSection(el, type);

	if( !section ) {
		return false;
	}

	section.removeAttribute('data-onepage-settings');

	let settings = CanvasPageScrollerSettings( section, el );

	setTimeout( () => {
		if( !section.hasAttribute('data-onepage-settings') ) {
			section.setAttribute( 'data-onepage-settings', JSON.stringify( settings ) );
		}
		core.getVars.pageSectionEls = document.querySelectorAll('[data-onepage-settings]');
	}, 1000);
};

const CanvasPageScroller = (el, type) => {
	const core = SEMICOLON.Core;
	let section = CanvasPageScrollerSection(el, type),
		sectionId = section.getAttribute('id');

	if( !section ) {
		return false;
	}

	let settings = JSON.parse( section.getAttribute('data-onepage-settings') );

	if( type != 'scrollTo' && core.getVars.elOnePageActiveOnClick == 'true' ) {
		parent = el.closest('.one-page-menu');
		parent.querySelectorAll(core.getVars.elOnePageParentSelector).forEach( el => el.classList.remove( core.getVars.elOnePageActiveClass ) );
		parent.querySelector('a[data-href="#' + sectionId + '"]').closest(core.getVars.elOnePageParentSelector).classList.add( core.getVars.elOnePageActiveClass );
	}

	if( !core.getVars.elBody.classList.contains('is-expanded-menu') || core.getVars.elBody.classList.contains('overlay-menu') ) {
		core.getVars.recalls.menureset();
	}

	CanvasPageScrollAnimation(section, settings, 250);
};

const CanvasPageScrollAnimation = (section, settings, timeout) => {
	const core = SEMICOLON.Core;

	setTimeout( () => {
		let sectionOffset = core.offset(section).top;

		if( !settings ) {
			return false;
		}

		if( settings.easing ) {
			jQuery('html,body').stop(true, true).animate({
				'scrollTop': sectionOffset - Number( settings.offset )
			}, Number(settings.speed), settings.easing);
		} else {
			window.scrollTo({
				top: sectionOffset - Number( settings.offset ),
				behavior: 'smooth'
			});
		}
	}, Number(timeout));
};

const CanvasPageScrollPosition = () => {
	const core = SEMICOLON.Core;
	core.getVars.elOnePageMenus && core.getVars.elOnePageMenus.forEach( el => el.querySelectorAll('[data-href]').forEach( item => item.closest(core.getVars.elOnePageParentSelector).classList.remove( core.getVars.elOnePageActiveClass )));
	core.getVars.elOnePageMenus && core.getVars.elOnePageMenus.forEach( el => el.querySelector('[data-href="#' + CanvasOnePageCurrentSection() + '"]')?.closest(core.getVars.elOnePageParentSelector).classList.add( core.getVars.elOnePageActiveClass ));
};

const CanvasOnePageCurrentSection = () => {
	const core = SEMICOLON.Core;
	let currentOnePageSection;

	if( typeof core.getVars.pageSectionEls === 'undefined' ) {
		return true;
	}

	core.getVars.pageSectionEls.forEach( el => {
		let settings = el.getAttribute('data-onepage-settings') && JSON.parse( el.getAttribute('data-onepage-settings') );

		if( settings ) {
			let h = core.offset(el).top - settings.offset - 5,
				y = window.pageYOffset;

			if( ( y >= h ) && ( y < h + el.offsetHeight ) && el.getAttribute('id') != currentOnePageSection && el.getAttribute('id') ) {
				currentOnePageSection = el.getAttribute('id');
			}
		}
	});

	return currentOnePageSection;
};

const CanvasPageScrollerSettings = (section, element) => {
	const core = SEMICOLON.Core;
	let body = core.getVars.elBody.classList;

	if( typeof section === 'undefined' || element.length < 1 ) {
		return true;
	}

	if( section.hasAttribute('data-onepage-settings') ) {
		return true;
	}

	const options = {
		offset: core.getVars.topScrollOffset,
		speed: 1250,
		easing: false
	};

	let settings = {},
		parentSettings = {},
		parent = element.closest( '.one-page-menu' );

	parentSettings.offset = parent?.getAttribute( 'data-offset' ) || options.offset;
	parentSettings.speed = parent?.getAttribute( 'data-speed' ) || options.speed;
	parentSettings.easing = parent?.getAttribute( 'data-easing' ) || options.easing;

	let elementSettings = {
		offset: element.getAttribute( 'data-offset' ) || parentSettings.offset,
		speed: element.getAttribute( 'data-speed' ) || parentSettings.speed,
		easing: element.getAttribute( 'data-easing' ) || parentSettings.easing,
	};

	let elOffsetXXL = element.getAttribute( 'data-offset-xxl' ),
		elOffsetXL = element.getAttribute( 'data-offset-xl' ),
		elOffsetLG = element.getAttribute( 'data-offset-lg' ),
		elOffsetMD = element.getAttribute( 'data-offset-md' ),
		elOffsetSM = element.getAttribute( 'data-offset-sm' ),
		elOffsetXS = element.getAttribute( 'data-offset-xs' );

	if( !elOffsetXS ) {
		elOffsetXS = Number(elementSettings.offset);
	}

	if( !elOffsetSM ) {
		elOffsetSM = Number(elOffsetXS);
	}

	if( !elOffsetMD ) {
		elOffsetMD = Number(elOffsetSM);
	}

	if( !elOffsetLG ) {
		elOffsetLG = Number(elOffsetMD);
	}

	if( !elOffsetXL ) {
		elOffsetXL = Number(elOffsetLG);
	}

	if( !elOffsetXXL ) {
		elOffsetXXL = Number(elOffsetXL);
	}

	if( body.contains('device-xs') ) {
		elementSettings.offset = elOffsetXS;
	} else if( body.contains('device-sm') ) {
		elementSettings.offset = elOffsetSM;
	} else if( body.contains('device-md') ) {
		elementSettings.offset = elOffsetMD;
	} else if( body.contains('device-lg') ) {
		elementSettings.offset = elOffsetLG;
	} else if( body.contains('device-xl') ) {
		elementSettings.offset = elOffsetXL;
	} else if( body.contains('device-xxl') ) {
		elementSettings.offset = elOffsetXXL;
	}

	settings.offset = elementSettings.offset;
	settings.speed = elementSettings.speed;
	settings.easing = elementSettings.easing;

	return settings;
};
