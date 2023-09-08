export default function( selector ) {
	const core = SEMICOLON.Core;
	core.loadJS({ file: 'plugins.easing.js', id: 'canvas-easing-js', jsFolder: true });
	core.isFuncTrue( () => typeof jQuery !== 'undefined' && typeof jQuery.easing["easeOutQuad"] !== 'undefined' ).then( cond => {
		if( !cond ) {
			return false;
		}

		SEMICOLON.Core.initFunction({ class: 'has-plugin-easing', event: 'pluginEasingReady' });
	});
};
