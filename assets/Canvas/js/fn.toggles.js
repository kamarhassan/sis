SEMICOLON.Core.getVars.fn.toggles = selector => {
	const core = SEMICOLON.Core;
	core.initFunction({ class: 'has-plugin-toggles', event: 'pluginTogglesReady' });

	selector = core.getSelector( selector, false );
	if( selector.length < 1 ){
		return true;
	}

	selector.forEach( element => {
		let elSpeed = element.getAttribute('data-speed') || 300,
			elState = element.getAttribute('data-state');

		if( elState != 'open' ){
			element.querySelector('.toggle-content').classList.add('d-none');
		} else {
			element.classList.add('toggle-active');
			CanvasAnimSlideDown( element.querySelector('.toggle-content'), Number(elSpeed) );
		}

		element.querySelector('.toggle-header').onclick = e => {
			if( element.classList.contains('toggle-active') ) {
				element.classList.remove('toggle-active');
				CanvasAnimSlideUp( element.querySelector('.toggle-content'), Number(elSpeed), () => {
					element.querySelector('.toggle-content').classList.add('d-none');
				});
			} else {
				element.classList.add('toggle-active');
				element.querySelector('.toggle-content').classList.remove('d-none');
				CanvasAnimSlideDown( element.querySelector('.toggle-content'), Number(elSpeed) );
			}
			e.preventDefault();
		};
	});
};

const CanvasAnimSlideUp = (target, duration=500, callback=false) => {
	target.style.transitionProperty = 'height, margin, padding';
	target.style.transitionDuration = duration + 'ms';
	target.style.boxSizing = 'border-box';
	target.style.height = target.offsetHeight + 'px';
	target.offsetHeight;
	target.style.overflow = 'hidden';
	target.style.height = 0;
	target.style.paddingTop = 0;
	target.style.paddingBottom = 0;
	target.style.marginTop = 0;
	target.style.marginBottom = 0;
	window.setTimeout( () => {
		target.style.display = 'none';
		target.style.removeProperty('height');
		target.style.removeProperty('padding-top');
		target.style.removeProperty('padding-bottom');
		target.style.removeProperty('margin-top');
		target.style.removeProperty('margin-bottom');
		target.style.removeProperty('overflow');
		target.style.removeProperty('transition-duration');
		target.style.removeProperty('transition-property');
		typeof callback === 'function' && callback();
	}, duration);
};

const CanvasAnimSlideDown = (target, duration=500, callback=false) => {
	target.style.removeProperty('display');
	let display = window.getComputedStyle(target).display;

	if (display === 'none') {
		display = 'block';
	}

	target.style.display = display;
	let height = target.offsetHeight;
	target.style.overflow = 'hidden';
	target.style.height = 0;
	target.style.paddingTop = 0;
	target.style.paddingBottom = 0;
	target.style.marginTop = 0;
	target.style.marginBottom = 0;
	target.offsetHeight;
	target.style.boxSizing = 'border-box';
	target.style.transitionProperty = "height, margin, padding";
	target.style.transitionDuration = duration + 'ms';
	target.style.height = height + 'px';
	target.style.removeProperty('padding-top');
	target.style.removeProperty('padding-bottom');
	target.style.removeProperty('margin-top');
	target.style.removeProperty('margin-bottom');
	window.setTimeout( () => {
		target.style.removeProperty('height');
		target.style.removeProperty('overflow');
		target.style.removeProperty('transition-duration');
		target.style.removeProperty('transition-property');
		typeof callback === 'function' && callback();
	}, duration);
};

const CanvasAnimSlideToggle = (target, duration = 500, callback=false) => {
	if (window.getComputedStyle(target).display === 'none') {
		return CanvasAnimSlideDown(target, duration, callback);
	} else {
		return CanvasAnimSlideUp(target, duration, callback);
	}
};
