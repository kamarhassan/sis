SEMICOLON.Core.getVars.fn.fitvids = selector => {
	const core = SEMICOLON.Core;
	core.loadJS({ file: 'plugins.fitvids.js', id: 'canvas-fitvids-js', jsFolder: true });
	core.isFuncTrue( () => jQuery().fitVids ).then( cond => {
		if( !cond ) {
			return false;
		}

		core.initFunction({ class: 'has-plugin-fitvids', event: 'pluginFitVidsReady' });

		selector = core.getSelector( selector );
		if( selector.length < 1 ){
			return true;
		}

		selector.parent().fitVids({
			customSelector: 'iframe[src*="youtube"],iframe[src*="vimeo"],iframe[src*="dailymotion"],iframe[src*="maps.google.com"],iframe[src*="google.com/maps"]',
			ignore: '.no-fv'
		});
	});
};
