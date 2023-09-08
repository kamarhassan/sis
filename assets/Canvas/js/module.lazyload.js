export default function( selector ) {
	const core = SEMICOLON.Core;
	core.loadJS({ file: 'plugins.lazyload.js', id: 'canvas-lazyload-js', jsFolder: true });
	core.isFuncTrue( () => typeof LazyLoad !== "undefined" ).then( cond => {
		if( !cond ) {
			return false;
		}

		core.initFunction({ class: 'has-plugin-lazyload', event: 'pluginlazyLoadReady' });

		window.lazyLoadInstance = new LazyLoad({
			threshold: 150,
			elements_selector: '.lazy:not(.lazy-loaded)',
			class_loading: 'lazy-loading',
			class_loaded: 'lazy-loaded',
			class_error: 'lazy-error',
			callback_loaded: el => {
				core.addEvent( window, 'lazyLoadLoaded' );
				if( el.parentNode.getAttribute('data-lazy-container') == 'true' ) {
					core.runContainerModules( el.parentNode );
				}
				SEMICOLON.Modules.parallax();
			}
		});
	});
};
