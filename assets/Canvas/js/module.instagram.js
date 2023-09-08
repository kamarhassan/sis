const CanvasGetInstagramPhotos = ( element, loader, limit, fetchAlert ) => {
	let newimages = '';
	let alert = element.closest('.instagram-widget-alert');

	if( !alert ) {
		alert = document.createElement('div');
		alert.classList.add( 'alert', 'alert-warning', 'instagram-widget-alert', 'text-center' );
		element.insertAdjacentElement( 'beforebegin', alert );
		alert.innerHTML = '<div class="spinner-grow spinner-grow-sm me-2" role="status"><span class="visually-hidden">Loading...</span></div> ' + fetchAlert;
	}

	fetch( loader ).then( response => response.json() ).then( images => {
		if( images.length > 0 ) {
			alert.remove();
			let html = '';
			for (let i = 0; i < limit; i++) {
				if ( i === limit )
					continue;

				let photo = images[i],
					thumb = photo.media_url;
				if( photo.media_type === 'VIDEO' ) {
					thumb = photo.thumbnail_url;
				}

				element.innerHTML += '<a class="grid-item" href="'+ photo.permalink +'" target="_blank"><img src="'+ thumb +'" alt="Image"></a>';
			}
		}

		// SEMICOLON.Modules.lazyLoad();
		SEMICOLON.Core.imagesLoaded(element);

		element.addEventListener( 'CanvasImagesLoaded', function() {
			element.classList.remove('customjs');
			SEMICOLON.Modules.masonryThumbs();
			SEMICOLON.Modules.lightbox();
		});
	}).catch( err => {
		console.log(err);
		alert.classList.remove( 'alert-warning' );
		alert.classList.add( 'alert-danger' );
		alert.innerHTML = 'Could not fetch Photos from Instagram API. Please try again later.';
	});
};

export default function( selector ) {
	const core = SEMICOLON.Core;
	core.initFunction({ class: 'has-plugin-instagram', event: 'pluginInstagramReady' });

	selector = core.getSelector( selector, false, false );
	if( selector.length < 1 ){
		return true;
	}

	selector.forEach( element => {
		let elLimit = element.getAttribute('data-count') || 12,
			elLoader = element.getAttribute('data-loader') || 'include/instagram/instagram.php',
			elFetch = element.getAttribute('data-fetch-message') || 'Fetching Photos from Instagram...';

		if( Number( elLimit ) > 12 ) {
			elLimit = 12;
		}

		CanvasGetInstagramPhotos( element, elLoader, elLimit, elFetch );
	});
};
