SEMICOLON.Core.getVars.fn.videofacade = selector => {
	const core = SEMICOLON.Core;
	core.initFunction({ class: 'has-plugin-videofacade', event: 'pluginVideoFacadeReady' });

	selector = core.getSelector( selector, false );

	selector.forEach( element => {
		element.onclick = e => {
			const videoContent = element.getAttribute('data-video-html');
			element.querySelector('.video-facade-preview').classList.add('d-none');
			element.querySelector('.video-facade-content').innerHTML += videoContent;
			element.querySelector('.video-facade-content').classList += ' ratio ratio-16x9';

			e.preventDefault();
		};
	});
};
