export default function( selector ) {
	const core = SEMICOLON.Core;
	core.initFunction({ class: 'has-plugin-html5video', event: 'pluginHtml5VideoReady' });

	selector = core.getSelector( selector, false, false );
	if( selector.length < 1 ){
		return true;
	}

	selector.forEach( element => {
		let elVideo = element.querySelector('video'),
			elRatio = element.getAttribute('data-ratio') || '16/9';

		if( !elVideo ) {
			return true;
		}

		elRatio = elRatio.split('/');

		elVideo.style.left = '';
		elVideo.style.top = '';

		let divWidth = element.offsetWidth,
			divHeight = element.offsetHeight,
			elWidth = ( Number(elRatio[0])*divHeight)/Number(elRatio[1]),
			elHeight = divHeight;

		if( elWidth < divWidth ) {
			elWidth = divWidth;
			elHeight = (Number(elRatio[1])*divWidth)/Number(elRatio[0]);
		}

		elVideo.style.width = elWidth + 'px';
		elVideo.style.height = elHeight + 'px';

		if( elHeight > divHeight ) {
			elVideo.style.left = '';
			elVideo.style.top = -( ( elHeight - divHeight )/2 ) + 'px';
		}

		if( elWidth > divWidth ) {
			elVideo.style.left = -( ( elWidth - divWidth )/2 ) + 'px';
			elVideo.style.top = '';
		}

		if( SEMICOLON.Mobile.any() && !element.classList.contains('no-placeholder') ) {
			let placeholderImg = elVideo.getAttribute('poster');

			if( placeholderImg != '' ) {
				element.innerHTML += '<div class="video-placeholder" style="background-image: url('+ placeholderImg +');"></div>';
			}

			elVideo.classList.add('d-none');
		}
	});

	core.getVars.resizers.html5video = () => SEMICOLON.Modules.html5Video();
};
