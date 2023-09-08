SEMICOLON.Core.getVars.fn.bootstrap = selector => {
	const core = SEMICOLON.Core;
    core.loadJS({ file: 'plugins.bootstrap.js', id: 'canvas-bootstrap-js', jsFolder: true });
    core.isFuncTrue( () => typeof bootstrap !== 'undefined' ).then( cond => {
        if( !cond ) {
            return false;
        }

        SEMICOLON.Core.initFunction({ class: 'has-plugin-bootstrap', event: 'pluginBootstrapReady' });
    });
};
