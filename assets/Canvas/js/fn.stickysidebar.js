SEMICOLON.Core.getVars.fn.stickysidebar = selector => {
	const core = SEMICOLON.Core;
	core.loadJS({ file: 'plugins.stickysidebar.js', id: 'canvas-stickysidebar-js', jsFolder: true });
	core.isFuncTrue( () => jQuery().scwStickySidebar ).then( cond => {
		if( !cond ) {
			return false;
		}

		core.initFunction({ class: 'has-plugin-stickysidebar', event: 'pluginStickySidebarReady' });

		selector = core.getSelector( selector );
		if( selector.length < 1 ){
			return false;
		}

		selector.each( function(){
			let element = jQuery(this),
				elTop = element.attr('data-offset-top') || 110,
				elBottom = element.attr('data-offset-bottom') || 50;

			element.scwStickySidebar({
				additionalMarginTop: Number( elTop ),
				additionalMarginBottom: Number( elBottom )
			});
		});
	});
};
