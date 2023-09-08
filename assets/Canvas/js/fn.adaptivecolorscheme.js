SEMICOLON.Core.getVars.fn.adaptivecolorscheme = selector => {
	const core = SEMICOLON.Core;
	core.initFunction({ class: 'has-plugin-adaptivecolorscheme', event: 'pluginAdaptiveColorSchemeReady' });

	selector = core.getSelector( selector, false );
	if( selector.length < 1 ){
		return true;
	}

	const adaptiveEl = document.querySelector('[data-adaptive-light-class],[data-adaptive-dark-class]');
	let adaptLightClass;
	let adaptDarkClass;

	if( core.getVars.elBody.contains(adaptiveEl) ) {
		adaptLightClass = adaptiveEl.getAttribute( 'data-adaptive-light-class' );
		adaptDarkClass = adaptiveEl.getAttribute( 'data-adaptive-dark-class' );
	}

	const adaptClasses = dark => {
		if( dark ) {
			core.getVars.elBody.classList.add( 'dark' );
		} else {
			core.getVars.elBody.classList.remove('dark');
		}

		if( core.getVars.elBody.contains(adaptiveEl) ) {
			if( dark ) {
				adaptiveEl.classList.remove( adaptLightClass );
				adaptiveEl.classList.add( adaptDarkClass );
			} else {
				adaptiveEl.classList.remove( adaptDarkClass );
				adaptiveEl.classList.add( adaptLightClass );
			}
		}

		SEMICOLON.Base.setBSTheme();
	};

	if( window.matchMedia ) {
		adaptClasses( window.matchMedia('(prefers-color-scheme: dark)').matches );

		window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
			adaptClasses( e.matches );
		});
	}
};
