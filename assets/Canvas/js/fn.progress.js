SEMICOLON.Core.getVars.fn.progress = selector => {
    const core = SEMICOLON.Core;
    core.initFunction({ class: 'has-plugin-progress', event: 'pluginProgressReady' });

	selector = core.getSelector( selector, false );
	if( selector.length < 1 ){
		return true;
	}

	selector.forEach( element => {
		let elValue	= element.getAttribute('data-percent') || 90,
			elSpeed	= element.getAttribute('data-speed') || 1200,
			elBar = element.querySelector('.skill-progress-percent');

		elSpeed = Number(elSpeed) + 'ms';

		elBar.style.setProperty( '--cnvs-progress-speed', elSpeed );

		let observer = new IntersectionObserver( function(entries, observer){
			entries.forEach( entry => {
				if (entry.isIntersecting) {
					if (!elBar.classList.contains('skill-animated')) {
						SEMICOLON.Modules.counter(element.querySelector('.counter'));

						if ( element.classList.contains('skill-progress-vertical') ) {
							elBar.style.height = elValue + "%";
							elBar.classList.add('skill-animated');
						} else {
							elBar.style.width = elValue + "%";
							elBar.classList.add('skill-animated');
						}
					}
					observer.unobserve( entry.target );
				}
			});
		});

		observer.observe( elBar );
	});
};
