SEMICOLON.Core.getVars.fn.flickrfeed = selector => {
	const core = SEMICOLON.Core;
	core.loadJS({ file: 'plugins.flickrfeed.js', id: 'canvas-flickrfeed-js', jsFolder: true });
	core.isFuncTrue( () => jQuery().jflickrfeed ).then( cond => {
		if( !cond ) {
			return false;
		}

		core.initFunction({ class: 'has-plugin-flickr', event: 'pluginFlickrFeedReady' });

		selector = core.getSelector( selector, true, false );
		if( selector.length < 1 ){
			return true;
		}

		selector.each(function() {
			let element = jQuery(this),
				elID = element.attr('data-id'),
				elCount = element.attr('data-count') || 9,
				elType = element.attr('data-type'),
				elTypeGet = 'photos_public.gne';

			if( elType == 'group' ) { elTypeGet = 'groups_pool.gne'; }

			element.jflickrfeed({
				feedapi: elTypeGet,
				limit: Number(elCount),
				qstrings: {
					id: elID
				},
				itemTemplate: '<a class="grid-item" href="{{image_b}}" title="{{title}}" data-lightbox="gallery-item">' +
									'<img src="{{image_s}}" alt="{{title}}" />' +
							  '</a>'
			}, function(data) {
				SEMICOLON.Core.imagesLoaded(element[0]);
				SEMICOLON.Modules.lightbox();

				element[0].addEventListener( 'CanvasImagesLoaded', function() {
					element.removeClass('customjs');
					SEMICOLON.Modules.gridInit();
					SEMICOLON.Modules.masonryThumbs();
				});
			});
		});
	});
};
