export default function() {
	CanvasAnimationFrame();

	window.addEventListener( 'scroll', () => {
		CanvasSliderParallax();
		CanvasSliderElementsFade();
	}, { passive: true });

	SEMICOLON.Core.getVars.resizers.sliderparallax = () => SEMICOLON.Modules.sliderParallax();
}

const CanvasAnimationFrame = () => {
	let lastTime = 0;
	let vendors = ['ms', 'moz', 'webkit', 'o'];
	for(let x = 0; x < vendors.length && !window.requestAnimationFrame; ++x) {
		window.requestAnimationFrame = window[vendors[x]+'RequestAnimationFrame'];
		window.cancelAnimationFrame = window[vendors[x]+'CancelAnimationFrame']
									|| window[vendors[x]+'CancelRequestAnimationFrame'];
	}

	if (!window.requestAnimationFrame)
		window.requestAnimationFrame = function(callback, element) {
			let currTime = new Date().getTime();
			let timeToCall = Math.max(0, 16 - (currTime - lastTime));
			let id = window.setTimeout(function() { callback(currTime + timeToCall); },
			  timeToCall);
			lastTime = currTime + timeToCall;
			return id;
		};

	if (!window.cancelAnimationFrame)
		window.cancelAnimationFrame = function(id) {
			clearTimeout(id);
		};
};

const CanvasSliderParallax = () => {
	let vars = SEMICOLON.Core.getVars,
		sliderPx = vars.sliderParallax;

	if( typeof sliderPx.el !== 'object' ) {
		return true;
	}

	let el = sliderPx.el,
		elHeight = el.offsetHeight,
		elClasses = el.classList,
		transform, transform2;

	vars.scrollPos.y = window.pageYOffset;

	if( vars.elBody.classList.contains('device-up-lg') && !SEMICOLON.Mobile.any() ) {
		if( ( elHeight + sliderPx.offset + 50 ) > vars.scrollPos.y ){
			elClasses.add('slider-parallax-visible');
			elClasses.remove('slider-parallax-invisible');
			if ( vars.scrollPos.y > sliderPx.offset ) {
				if( typeof el.querySelector('.slider-inner') === 'object' ) {

					transform = ((vars.scrollPos.y-sliderPx.offset) * -.4 );
					transform2 = ((vars.scrollPos.y-sliderPx.offset) * -.15 );

					CanvasSliderParallaxSet( 0, transform, sliderPx.inner );
					CanvasSliderParallaxSet( 0, transform2, sliderPx.caption );
				} else {
					transform = ((vars.scrollPos.y-sliderPx.offset) / 1.5 );
					transform2 = ((vars.scrollPos.y-sliderPx.offset) / 7 );

					CanvasSliderParallaxSet( 0, transform, el );
					CanvasSliderParallaxSet( 0, transform2, sliderPx.caption );
				}
			} else {
				if( typeof el.querySelector('.slider-inner') === 'object' ) {
					CanvasSliderParallaxSet( 0, 0, sliderPx.inner );
					CanvasSliderParallaxSet( 0, 0, sliderPx.caption );
				} else {
					CanvasSliderParallaxSet( 0, 0, el );
					CanvasSliderParallaxSet( 0, 0, sliderPx.caption );
				}
			}
		} else {
			elClasses.add('slider-parallax-invisible');
			elClasses.remove('slider-parallax-visible');
		}

		requestAnimationFrame(function(){
			CanvasSliderParallax();
			CanvasSliderElementsFade();
		});
	} else {
		if( typeof el.querySelector('.slider-inner') === 'object' ) {
			CanvasSliderParallaxSet( 0, 0, sliderPx.inner );
			CanvasSliderParallaxSet( 0, 0, sliderPx.caption );
		} else {
			CanvasSliderParallaxSet( 0, 0, el );
			CanvasSliderParallaxSet( 0, 0, sliderPx.caption );
		}
		elClasses.add('slider-parallax-visible');
		elClasses.remove('slider-parallax-invisible');
	}
};

const CanvasSliderParallaxOffset = () => {
	let core = SEMICOLON.Core,
		sliderPx = core.getVars.sliderParallax;

	let sliderParallaxOffsetTop = 0,
		headerHeight = core.getVars.elHeader?.offsetHeight || 0;

	if( core.getVars.elBody.classList.contains('side-header') || (core.getVars.elHeader && core.getNext(core.getVars.elHeader, '.include-header').length > 0) ) {
		headerHeight = 0;
	}

	// if( $pageTitle.length > 0 ) {
	// 	sliderParallaxOffsetTop = $pageTitle.outerHeight() + headerHeight - 20;
	// } else {
	// 	sliderParallaxOffsetTop = headerHeight - 20;
	// }

	if( core.getNext(core.getVars.elSlider, '#header').length > 0 ) {
		sliderParallaxOffsetTop = 0;
	}

	sliderPx.offset = sliderParallaxOffsetTop;
};

const CanvasSliderParallaxSet = ( xPos, yPos, el ) => {
	if( el ) {
		el.style.transform = "translate3d(" + xPos + ", " + yPos + "px, 0)";
	}
};

const CanvasSliderElementsFade = () => {
	let core = SEMICOLON.Core,
		sliderPx = core.getVars.sliderParallax;

	if( sliderPx.el.length < 1 ) {
		return true;
	}

	if( core.getVars.elBody.classList.contains('device-up-lg') && !SEMICOLON.Mobile.any() ) {
		let elHeight = sliderPx.el.offsetHeight,
			tHeaderOffset;

		if( (core.getVars.elHeader && core.getVars.elHeader.classList.contains('transparent-header')) || core.getVars.elBody.classList.contains('side-header') ) {
			tHeaderOffset = 100;
		} else {
			tHeaderOffset = 0;
		}

		if( sliderPx.el.classList.contains('slider-parallax-visible') ) {
			sliderPx.el.querySelectorAll('.slider-arrow-left,.slider-arrow-right,.slider-caption,.slider-element-fade').forEach( el => {
				el.style.opacity = 1 - ( ( ( core.getVars.scrollPos.y - tHeaderOffset ) * 1.85 ) / elHeight )
			});
		}
	} else {
		sliderPx.el.querySelectorAll('.slider-arrow-left,.slider-arrow-right,.slider-caption,.slider-element-fade').forEach(
			el => el.style.opacity = 1
		);
	}
};
