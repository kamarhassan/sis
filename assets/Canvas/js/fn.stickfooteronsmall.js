SEMICOLON.Core.getVars.fn.stickfooteronsmall = selector => {
	const core = SEMICOLON.Core;
	selector = core.getSelector( selector, false );
	if( selector.length < 1 ){
		return true;
	}

	core.getVars.elFooter.style.marginTop = '';

	const windowH = core.viewport().height,
		wrapperH = core.getVars.elWrapper.offsetHeight;

	if( !core.getVars.elBody.classList.contains('sticky-footer') && core.getVars.elFooter !== 'undefined' && core.getVars.elWrapper.contains( core.getVars.elFooter ) ) {
		if( windowH > wrapperH ) {
			core.getVars.elFooter.style.marginTop = (windowH - wrapperH)+'px';
		}
	}

	core.getVars.resizers.stickfooter = () => SEMICOLON.Base.stickFooterOnSmall();
};
