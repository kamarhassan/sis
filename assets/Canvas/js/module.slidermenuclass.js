export default function( selector ) {
	const core = SEMICOLON.Core;
	selector = core.getSelector( selector, false );
	if( selector.length < 1 ){
		return true;
	}

	CanvasSwiperSliderMenu();
	CanvasRevolutionSliderMenu();
	SEMICOLON.Base.setBSTheme();

	core.getVars.resizers.slidermenuclass = () => SEMICOLON.Base.sliderMenuClass();
};

const CanvasSwiperSliderMenu = () => {
	const core = SEMICOLON.Core;
	// onWinLoad = typeof onWinLoad !== 'undefined' ? onWinLoad : false;
	if( core.getVars.elBody.classList.contains('is-expanded-menu') || ( core.getVars.elHeader.classList.contains('transparent-header-responsive') && !core.getVars.elBody.classList.contains('primary-menu-open') ) ) {
		let activeSlide = core.getVars.elSlider.querySelector('.swiper-slide-active');
		CanvasHeaderSchemeChanger(activeSlide);
	}
};

const CanvasRevolutionSliderMenu = () => {
	const core = SEMICOLON.Core;
	// onWinLoad = typeof onWinLoad !== 'undefined' ? onWinLoad : false;
	if( core.getVars.elBody.classList.contains('is-expanded-menu') || ( core.getVars.elHeader.classList.contains('transparent-header-responsive') && !core.getVars.elBody.classList.contains('primary-menu-open') ) ) {
		let activeSlide = core.getVars.elSlider.querySelector('.active-revslide');
		CanvasHeaderSchemeChanger(activeSlide);
	}
};

const CanvasHeaderSchemeChanger = activeSlide => {
	const core = SEMICOLON.Core;

	if( !activeSlide ) {
		return;
	}

	let darkExists = false,
		oldClassesArray, noOfOldClasses;
	if( activeSlide.classList.contains('dark') ){
		if( core.getVars.headerClasses ) {
			oldClassesArray = core.getVars.headerClasses;
		} else {
			oldClassesArray = '';
		}

		noOfOldClasses = oldClassesArray.length;

		if( noOfOldClasses > 0 ) {
			for( let i=0; i<noOfOldClasses; i++ ) {
				if( oldClassesArray[i] == 'dark' ) {
					darkExists = true;
					break;
				}
			}
		}

		let headerToChange = document.querySelector('#header.transparent-header:not(.sticky-header,.semi-transparent,.floating-header)');
		if( headerToChange ) {
			headerToChange.classList.add('dark');
		}

		if( !darkExists ) {
			let headerToChange = document.querySelector('#header.transparent-header.sticky-header,#header.transparent-header.semi-transparent.sticky-header,#header.transparent-header.floating-header.sticky-header');
			if( headerToChange ) {
				headerToChange.classList.remove('dark');
			}
		}
		core.getVars.elHeaderWrap.classList.remove('not-dark');
	} else {
		if( core.getVars.elBody.classList.contains('dark') ) {
			activeSlide.classList.add('not-dark');
			document.querySelector('#header.transparent-header:not(.semi-transparent,.floating-header)').classList.remove('dark');
			document.querySelector('#header.transparent-header:not(.sticky-header,.semi-transparent,.floating-header)').querySelector('#header-wrap').classList.add('not-dark');
		} else {
			document.querySelector('#header.transparent-header:not(.semi-transparent,.floating-header)').classList.remove('dark');
			core.getVars.elHeaderWrap.classList.remove('not-dark');
		}
	}

	if( core.getVars.elHeader.classList.contains('sticky-header') ) {
		SEMICOLON.Base.headers();
	}
};
