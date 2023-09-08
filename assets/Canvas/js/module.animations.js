export default function( selector ) {
	const core = SEMICOLON.Core;
	core.initFunction({ class: 'has-plugin-animations', event: 'pluginAnimationsReady' });

	selector = core.getSelector( selector, false );
	if( selector.length < 1 ){
		return true;
	}

	let SELECTOR = '[data-animate]',
		ANIMATE_CLASS_NAME = 'animated';

	let isAnimated = function(element) {
		element.classList.contains(ANIMATE_CLASS_NAME)
	};

	let intersectionObserver = new IntersectionObserver(
		function(entries, observer) {
			entries.forEach( entry => {
				let element = entry.target,
					elAnimation = element.getAttribute('data-animate'),
					elAnimOut = element.getAttribute('data-animate-out'),
					elAnimDelay = element.getAttribute('data-delay'),
					elAnimDelayOut = element.getAttribute('data-delay-out'),
					elAnimDelayTime = 0,
					elAnimDelayOutTime = 3000,
					elAnimations = elAnimation.split(' ');

				if( element.closest('.fslider.no-thumbs-animate') ) {
					return true;
				}

				if( element.closest('.swiper-slide') ) {
					return true;
				}

				if( elAnimDelay ) {
					elAnimDelayTime = Number( elAnimDelay ) + 500;
				} else {
					elAnimDelayTime = 500;
				}

				if( elAnimOut && elAnimDelayOut ) {
					elAnimDelayOutTime = Number( elAnimDelayOut ) + elAnimDelayTime;
				}

				if( !element.classList.contains('animated') ) {
					element.classList.add('not-animated');
					if( entry.intersectionRatio > 0 ) {
						setTimeout(() => {
							element.classList.remove('not-animated');
							elAnimations.forEach(item => element.classList.add(item));
							element.classList.add('animated');
						}, elAnimDelayTime);

						if( elAnimOut ) {
							setTimeout(() => {
								elAnimations.forEach(item => element.classList.remove(item));
								elAnimOut.split(' ').forEach(item => element.classList.add(item));
							}, elAnimDelayOutTime);
						}
					}
				}

				if( !element.classList.contains('not-animated') ) {
					observer.unobserve(element);
				}
			});
		}
	);

	let elements = [].filter.call(
		document.querySelectorAll(SELECTOR), element => {
			return !isAnimated(element, ANIMATE_CLASS_NAME);
		});

	elements.forEach( element => {
		return intersectionObserver.observe(element)
	});
};
