SEMICOLON.Core.getVars.fn.sidepanel = selector => {
	const core = SEMICOLON.Core;
	selector = core.getSelector( selector, false );
	if( selector.length < 1 ){
		return true;
	}

	let body = core.getVars.elBody.classList;

	document.addEventListener('click', e => {
		if( !e.target.closest('#side-panel') && !e.target.closest('.side-panel-trigger') ) {
			body.remove('side-panel-open');
		}
	}, false);

	document.querySelectorAll('.side-panel-trigger').forEach( el => {
		el.onclick = e => {
			body.toggle('side-panel-open');
			if( body.contains('device-touch') && body.contains('side-push-panel') ) {
				body.toggle('ohidden');
			}

			e.preventDefault();
		};
	});
};

