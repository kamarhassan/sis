SEMICOLON.Core.getVars.fn.parallax = selector => {
	const core = SEMICOLON.Core;
	core.loadJS({ file: 'plugins.parallax.js', id: 'canvas-parallax-js', jsFolder: true });
	core.isFuncTrue( () => typeof simpleParallax !== "undefined" ).then( cond => {
		if( !cond ) {
			return false;
		}

		core.initFunction({ class: 'has-plugin-parallax', event: 'pluginParallaxReady' });

		selector = core.getSelector( selector, false );
		if( selector.length < 1 ){
			return true;
		}

		let instances = [],
			i = 0;

		selector.forEach( el => {
			let speed = el.getAttribute('data-parallax-speed') || 0.4,
				scale = el.getAttribute('data-parallax-scale') || 1.25,
				overflow = el.getAttribute('data-parallax-overflow') || false,
				maxTrans = el.getAttribute('data-parallax-max-transition') || 0,
				mobile = el.getAttribute('data-mobile') || 'false',
				direction = el.getAttribute('data-direction') || 'up';

			if( overflow == "true" ) {
				overflow = true;
			}

			if( SEMICOLON.Mobile.any() && mobile == 'false' ) {
				el.classList.add('mobile-parallax');
			} else {
				instances[i] = new simpleParallax(el, {
					orientation: direction,
					scale: Number(scale),
					overflow: overflow,
					delay: Number(speed),
					maxTransition: Number(maxTrans)
				});
			}

			i++;
		});

		core.getVars.resizers.parallax = () => SEMICOLON.Modules.parallax();
	});
};
