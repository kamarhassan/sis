SEMICOLON.Core.getVars.fn.textrotator = selector => {
    const core = SEMICOLON.Core;
	core.loadJS({ file: 'plugins.textrotator.js', id: 'canvas-textrotator-js', jsFolder: true });
	core.isFuncTrue( () => jQuery().Morphext && typeof Typed !== 'undefined' ).then( cond => {
		if( !cond ) {
			return false;
		}

		core.initFunction({ class: 'has-plugin-textrotator', event: 'pluginTextRotatorReady' });

		selector = core.getSelector( selector );
		if( selector.length < 1 ){
			return true;
		}

		selector.each(function(){
			let element = jQuery(this),
				elTyped = element.attr('data-typed') || 'false',
				elRotator = element.find('.t-rotate'),
				elAnimation = element.attr('data-rotate') || 'fade',
				elSpeed = element.attr('data-speed') || 1200,
				elSep = element.attr('data-separator') || ',';

			if( elTyped == 'true' ) {
				let elTexts = elRotator.html().split( elSep ),
					elLoop = element.attr('data-loop') || 'true',
					elShuffle = element.attr('data-shuffle'),
					elCur = element.attr('data-cursor') || 'true',
					elSpeed = element.attr('data-speed') || 50,
					elBackSpeed = element.attr('data-backspeed') || 30,
					elBackDelay = element.attr('data-backdelay');

				if( elLoop == 'true' ) { elLoop = true; } else { elLoop = false; }
				if( elShuffle == 'true' ) { elShuffle = true; } else { elShuffle = false; }
				if( elCur == 'true' ) { elCur = true; } else { elCur = false; }

				elRotator.html( '' ).addClass('plugin-typed-init');

				let typed = new Typed( elRotator.get(0) , {
					strings: elTexts,
					typeSpeed: Number( elSpeed ),
					loop: elLoop,
					shuffle: elShuffle,
					showCursor: elCur,
					backSpeed: Number( elBackSpeed ),
					backDelay: Number( elBackDelay )
				});
			} else {
				let pluginData = elRotator.Morphext({
					animation: elAnimation,
					separator: elSep,
					speed: Number(elSpeed)
				});
			}
		});
	});
};
