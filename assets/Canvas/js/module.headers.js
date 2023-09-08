export default function( selector ) {
	const core = SEMICOLON.Core;
	selector = core.getSelector( selector, false );
	if( selector.length < 1 ){
		return true;
	}

	let elHeader = core.getVars.elHeader;
	let isSticky = elHeader.classList.contains('no-sticky') ? false : true;
	let headerWrapClone = elHeader.querySelector('.header-wrap-clone');

	core.getVars.stickyHeaderClasses = elHeader.getAttribute('data-sticky-class');
	core.getVars.mobileHeaderClasses = elHeader.getAttribute('data-responsive-class');
	core.getVars.stickyShrink = elHeader.getAttribute('data-sticky-shrink') || 'true';
	core.getVars.stickyShrinkOffset = elHeader.getAttribute('data-sticky-shrink-offset') || 300;
	core.getVars.mobileSticky = elHeader.getAttribute('data-mobile-sticky') || 'false';
	core.getVars.headerHeight = elHeader.offsetHeight;

	if( !headerWrapClone ) {
		headerWrapClone = document.createElement('div');
		headerWrapClone.classList = 'header-wrap-clone';

		core.getVars.elHeaderWrap?.parentNode.insertBefore( headerWrapClone, core.getVars.elHeaderWrap?.nextSibling);
		headerWrapClone = elHeader.querySelector('.header-wrap-clone');
	}

	if( isSticky ) {
		setTimeout(() => {
			CanvasHeaderOffset();
			CanvasStickyMenu( core.getVars.headerWrapOffset );
			CanvasChangeMenuClass('sticky');
		}, 500);

		window.addEventListener( 'scroll', function(){
			CanvasStickyMenu( core.getVars.headerWrapOffset );
		}, { passive: true });
	}

	CanvasChangeMenuClass('responsive');
	CanvasIncludeHeader();
	CanvasSideHeader();

	core.getVars.resizers.headers = () => {
		setTimeout( () => {
			CanvasRemoveStickyness();
			if( isSticky ) {
				CanvasHeaderOffset();
				CanvasStickyMenu( core.getVars.headerWrapOffset );
				CanvasChangeMenuClass('sticky');
			}
			CanvasChangeMenuClass('responsive');
			CanvasIncludeHeader();
		}, 250);
	};
};

const CanvasHeaderOffset = () => {
	const core = SEMICOLON.Core;
	let elHeader = core.getVars.elHeader;
	let elHeaderInc = document.querySelector('.include-header');

	core.getVars.headerOffset = elHeader.offsetTop;
	if( core.getVars.elHeader?.classList.contains('floating-header') || elHeaderInc?.classList.contains('include-topbar') ) {
		core.getVars.headerOffset = core.offset(elHeader).top;
	}
	core.getVars.elHeaderWrap?.classList.add('position-absolute');
	core.getVars.headerWrapOffset = core.getVars.headerOffset + core.getVars.elHeaderWrap?.offsetTop;
	core.getVars.elHeaderWrap?.classList.remove('position-absolute');

	if( elHeader.hasAttribute('data-sticky-offset') ) {
		let headerDefinedOffset = elHeader.getAttribute('data-sticky-offset');
		if( headerDefinedOffset == 'full' ) {
			core.getVars.headerWrapOffset = core.viewport().height;
			let headerOffsetNegative = elHeader.getAttribute('data-sticky-offset-negative');
			if( typeof headerOffsetNegative !== 'undefined' ) {
				if( headerOffsetNegative == 'auto' ) {
					core.getVars.headerWrapOffset = core.getVars.headerWrapOffset - elHeader.offsetHeight - 1;
				} else {
					core.getVars.headerWrapOffset = core.getVars.headerWrapOffset - Number(headerOffsetNegative) - 1;
				}
			}
		} else {
			core.getVars.headerWrapOffset = Number(headerDefinedOffset);
		}
	}
};

const CanvasStickyMenu = stickyOffset => {
	const core = SEMICOLON.Core;

	if( !core.getVars.elBody.classList.contains('is-expanded-menu') && core.getVars.mobileSticky != 'true' ) {
		return true;
	}

	if( window.pageYOffset > stickyOffset ) {
		if( !core.getVars.elBody.classList.contains('side-header') ) {
			core.getVars.elHeader.classList.add('sticky-header');
			CanvasChangeMenuClass('sticky');

			if( core.getVars.elBody.classList.contains('is-expanded-menu') && core.getVars.stickyShrink == 'true' && !core.getVars.elHeader.classList.contains('no-sticky') ) {
				if( ( window.pageYOffset - stickyOffset ) > Number( core.getVars.stickyShrinkOffset ) ) {
					core.getVars.elHeader.classList.add('sticky-header-shrink');
				} else {
					core.getVars.elHeader.classList.remove('sticky-header-shrink');
				}
			}
		}
	} else {
		CanvasRemoveStickyness();
		if( core.getVars.mobileSticky == 'true' ) {
			CanvasChangeMenuClass('responsive');
		}
	}
};

const CanvasRemoveStickyness = () => {
	const core = SEMICOLON.Core;

	core.getVars.elHeader.className = core.getVars.headerClasses;
	core.getVars.elHeader.classList.remove('sticky-header', 'sticky-header-shrink');

	if( core.getVars.elHeaderWrap ) {
		core.getVars.elHeaderWrap.className = core.getVars.headerWrapClasses;
	}
	if( !core.getVars.elHeaderWrap?.classList.contains('force-not-dark') ) {
		core.getVars.elHeaderWrap?.classList.remove('not-dark');
	}

	SEMICOLON.Base.sliderMenuClass();
};

const CanvasChangeMenuClass = type => {
	const core = SEMICOLON.Core;
	let newClassesArray = '';

	if( 'responsive' == type ) {
		if( core.getVars.elBody.classList.contains('device-up-lg') ){
			return true;
		}

		if( core.getVars.mobileHeaderClasses ) {
			newClassesArray = core.getVars.mobileHeaderClasses.split(/ +/);
		}
	} else {
		if( !core.getVars.elHeader.classList.contains('sticky-header') ){
			return true;
		}

		if( core.getVars.stickyHeaderClasses ) {
			newClassesArray = core.getVars.stickyHeaderClasses.split(/ +/);
		}
	}

	let noOfNewClasses = newClassesArray.length;

	if( noOfNewClasses > 0 ) {
		let i = 0;
		for( i=0; i<noOfNewClasses; i++ ) {
			if( newClassesArray[i] == 'not-dark' ) {
				core.getVars.elHeader.classList.remove('dark');
				if( !core.getVars.elHeaderWrap?.classList.contains('.not-dark') ) {
					core.getVars.elHeaderWrap?.classList.add('not-dark');
				}
			} else if( newClassesArray[i] == 'dark' ) {
				core.getVars.elHeaderWrap?.classList.remove('not-dark force-not-dark');
				if( !core.getVars.elHeader.classList.contains( newClassesArray[i] ) ) {
					core.getVars.elHeader.classList.add( newClassesArray[i] );
				}
			} else if( !core.getVars.elHeader.classList.contains( newClassesArray[i] ) ) {
				core.getVars.elHeader.classList.add( newClassesArray[i] );
			}
		}
	}

	SEMICOLON.Base.setBSTheme();
};

const CanvasIncludeHeader = () => {
	const core = SEMICOLON.Core;
	let elHeaderInc = document.querySelector('.include-header');

	if( !elHeaderInc ) {
		return true;
	}

	elHeaderInc.style.marginTop = '';

	if( !core.getVars.elBody.classList.contains('is-expanded-menu') ) {
		return true;
	}

	if( core.getVars.elHeader.classList.contains('floating-header') || elHeaderInc.classList.contains('include-topbar') ) {
		core.getVars.headerHeight = core.getVars.elHeader.offsetHeight + core.offset(core.getVars.elHeader).top;
	}

	elHeaderInc.style.marginTop = (core.getVars.headerHeight * -1) + 'px';
	SEMICOLON.Modules.sliderParallax();
}

const CanvasSideHeader = () => {
	let headerTrigger = document.getElementById("header-trigger");
	if( headerTrigger ) {
		headerTrigger.onclick = e => {
			SEMICOLON.Core.getVars.elBody.classList.contains('open-header') && SEMICOLON.Core.getVars.elBody.classList.toggle("side-header-open");
			e.preventDefault();
		};
	}
};
