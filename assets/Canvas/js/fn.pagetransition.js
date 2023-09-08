SEMICOLON.Core.getVars.fn.pagetransition = selector => {
	const core = SEMICOLON.Core,
		elBody = core.getVars.elBody;

	core.initFunction({ class: 'has-plugin-pagetransition', event: 'pluginPageTransitionReady' });

	if( elBody.classList.contains('no-transition') ) {
		return true;
	}

	if( !elBody.classList.contains('page-transition') ) {
		elBody.classList.add('page-transition');
	}

	window.onpageshow = event => {
		if(event.persisted) {
			window.location.reload();
		}
	};

	var pageTransition = document.querySelector('.page-transition-wrap');

	let elAnimIn = elBody.getAttribute('data-animation-in') || 'fadeIn',
		elSpeedIn = elBody.getAttribute('data-speed-in') || 1000,
		elTimeoutActive = false,
		elTimeout = elBody.getAttribute('data-loader-timeout'),
		elLoader = elBody.getAttribute('data-loader'),
		elLoaderColor = elBody.getAttribute('data-loader-color'),
		elLoaderHtml = elBody.getAttribute('data-loader-html'),
		elLoaderAppend = '',
		elLoaderCSSVar = '';

	if( !elTimeout ) {
		elTimeoutActive = false;
		elTimeout = false;
	} else {
		elTimeoutActive = true;
		elTimeout = Number(elTimeout);
	}

	if( elLoaderColor ) {
		if( elLoaderColor == 'theme' ) {
			elLoaderCSSVar = ' style="--cnvs-loader-color:var(--cnvs-themecolor);"';
		} else {
			elLoaderCSSVar = ' style="--cnvs-loader-color:'+elLoaderColor+';"';
		}
	}

	let elLoaderBefore = '<div class="css3-spinner"'+elLoaderCSSVar+'>',
		elLoaderAfter = '</div>';

	if( elLoader == '2' ) {
		elLoaderAppend = '<div class="css3-spinner-flipper"></div>';
	} else if( elLoader == '3' ) {
		elLoaderAppend = '<div class="css3-spinner-double-bounce1"></div><div class="css3-spinner-double-bounce2"></div>';
	} else if( elLoader == '4' ) {
		elLoaderAppend = '<div class="css3-spinner-rect1"></div><div class="css3-spinner-rect2"></div><div class="css3-spinner-rect3"></div><div class="css3-spinner-rect4"></div><div class="css3-spinner-rect5"></div>';
	} else if( elLoader == '5' ) {
		elLoaderAppend = '<div class="css3-spinner-cube1"></div><div class="css3-spinner-cube2"></div>';
	} else if( elLoader == '6' ) {
		elLoaderAppend = '<div class="css3-spinner-scaler"></div>';
	} else if( elLoader == '7' ) {
		elLoaderAppend = '<div class="css3-spinner-grid-pulse"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>';
	} else if( elLoader == '8' ) {
		elLoaderAppend = '<div class="css3-spinner-clip-rotate"><div></div></div>';
	} else if( elLoader == '9' ) {
		elLoaderAppend = '<div class="css3-spinner-ball-rotate"><div></div><div></div><div></div></div>';
	} else if( elLoader == '10' ) {
		elLoaderAppend = '<div class="css3-spinner-zig-zag"><div></div><div></div></div>';
	} else if( elLoader == '11' ) {
		elLoaderAppend = '<div class="css3-spinner-triangle-path"><div></div><div></div><div></div></div>';
	} else if( elLoader == '12' ) {
		elLoaderAppend = '<div class="css3-spinner-ball-scale-multiple"><div></div><div></div><div></div></div>';
	} else if( elLoader == '13' ) {
		elLoaderAppend = '<div class="css3-spinner-ball-pulse-sync"><div></div><div></div><div></div></div>';
	} else if( elLoader == '14' ) {
		elLoaderAppend = '<div class="css3-spinner-scale-ripple"><div></div><div></div><div></div></div>';
	} else {
		elLoaderAppend = '<div class="css3-spinner-bounce1"></div><div class="css3-spinner-bounce2"></div><div class="css3-spinner-bounce3"></div>';
	}

	if( !elLoaderHtml ) {
		elLoaderHtml = elLoaderAppend;
	}

	elLoaderHtml = elLoaderBefore + elLoaderHtml + elLoaderAfter;

	if( elSpeedIn ) {
		core.getVars.elWrapper.style.setProperty('--cnvs-animate-duration', Number(elSpeedIn)+'ms');
	}

	if( elAnimIn == 'fadeIn' ) {
		core.getVars.elWrapper.classList.add('op-1');
	}

	if( !pageTransition ) {
		let divPT = document.createElement('div');
		divPT.classList.add('page-transition-wrap');
		divPT.innerHTML = elLoaderHtml;
		elBody.prepend( divPT );
		pageTransition = document.querySelector('.page-transition-wrap');
	}

	const endPageTransition = () => {
		elAnimIn.split(" ").forEach(className => pageTransition.classList.remove(className));
		pageTransition.classList.add('fadeOut', 'animated');

		const removePageTransition = () => {
			pageTransition.remove();
			(elAnimIn + ' animated').split(" ").forEach(className => core.getVars.elWrapper.classList.add(className));
		};

		const displayContent = () => {
			core.getVars.elBody.classList.remove('page-transition');
			setTimeout(() => {
				(elAnimIn + ' animated').split(" ").forEach(className => core.getVars.elWrapper.classList.remove(className));
			}, 333);
		};

		pageTransition.addEventListener('transitionend', removePageTransition);
		pageTransition.addEventListener('animationend', removePageTransition);
		core.getVars.elWrapper.addEventListener('transitionend', displayContent);
		core.getVars.elWrapper.addEventListener('animationend', displayContent);

		return true;
	};

	if( document.readyState === 'complete' ) {
		endPageTransition();
	}

	if( elTimeoutActive ) {
		setTimeout( endPageTransition, elTimeout );
	}

	window.onload = () => endPageTransition();
};
