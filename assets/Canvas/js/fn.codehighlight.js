SEMICOLON.Core.getVars.fn.codehighlight = selector => {
	const core = SEMICOLON.Core;
	core.loadCSS({ file: 'components/prism.css', id: 'canvas-prism-css', cssFolder: true });
	core.loadJS({ file: 'plugins.prism.js', id: 'canvas-prism-js', jsFolder: true });
    core.isFuncTrue( () => typeof Prism !== 'undefined' ).then( cond => {
        if( !cond ) {
            return false;
        }

		core.initFunction({ class: 'has-plugin-codehighlight', event: 'pluginCodeHighlightReady' });

		selector = core.getSelector( selector, false );
		if( selector.length < 1 ){
			return true;
		}

		selector.forEach(el => {
			Prism.highlightElement( el.querySelector('code') );
		});
	});
};
