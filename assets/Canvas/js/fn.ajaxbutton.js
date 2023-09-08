SEMICOLON.Core.getVars.fn.ajaxbutton = selector => {
	const core = SEMICOLON.Core;
	core.initFunction({ class: 'has-plugin-ajaxbutton', event: 'pluginAjaxButtonReady' });

	selector = core.getSelector( selector, false );
	if( selector.length < 1 ){
		return true;
	}

	selector.forEach( el => {
		el.onclick = e => {
			let trigger = el,
				elLoader = el.getAttribute('data-ajax-loader'),
				elContainer = document.querySelector( el.getAttribute('data-ajax-container') ),
				elContentPlacement = el.getAttribute('data-ajax-insertion') || 'append',
				elTriggerHide = el.getAttribute('data-ajax-trigger-hide') || 'true',
				elTriggerDisable = el.getAttribute('data-ajax-trigger-disable') || 'true';

			fetch( elLoader ).then( response => {
				return response.text();
			}).then( html => {
				let domParser = new DOMParser();
				let parsedHTML = domParser.parseFromString(html, 'text/html');

				if( elContentPlacement == 'append' ) {
					elContainer?.insertAdjacentHTML('beforeend', parsedHTML.body.innerHTML);
				} else {
					elContainer?.insertAdjacentHTML('afterbegin', parsedHTML.body.innerHTML);
				}

				if( elTriggerHide == 'true' ) {
					el.classList.add('d-none');
				}

				core.runContainerModules( elContainer );

				if( elTriggerDisable == 'true' ) {
					setTimeout( () => {
						trigger.onclick = e => {
							e.stopPropagation();
							return false;
						};
					}, 1000);
				}
			}).catch( err => {
				let errorDIV = document.createElement("div");
				errorDIV.classList.add( 'd-inline-block', 'text-danger', 'me-3' );
				errorDIV.innerText = 'Content Cannot be Loaded!';
				elContainer?.prepend( errorDIV, ': ' + err );
			});

			e.preventDefault();
		};
	});
};
