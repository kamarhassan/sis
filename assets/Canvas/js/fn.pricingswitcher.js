const CanvasPricingSwitcher = (checkbox, parent, pricing, defClass, actClass) => {
	parent.querySelectorAll('.pts-left,.pts-right').forEach(el => {
		actClass.split(" ").forEach(_class => el.classList.remove(_class));
		defClass.split(" ").forEach(_class => el.classList.add(_class));
	});

	pricing.querySelectorAll('.pts-switch-content-left,.pts-switch-content-right').forEach(el => el.classList.add('d-none'));

	if( checkbox.checked == true ) {
		defClass.split(" ").forEach(_class => parent.querySelector('.pts-right').classList.remove(_class));
		actClass.split(" ").forEach(_class => parent.querySelector('.pts-right').classList.add(_class));
		pricing.querySelectorAll('.pts-switch-content-right').forEach(el => el.classList.remove('d-none'));
	} else {
		defClass.split(" ").forEach(_class => parent.querySelector('.pts-left').classList.remove(_class));
		actClass.split(" ").forEach(_class => parent.querySelector('.pts-left').classList.add(_class));
		pricing.querySelectorAll('.pts-switch-content-left').forEach(el => el.classList.remove('d-none'));
	}
};

SEMICOLON.Core.getVars.fn.pricingswitcher = selector => {
	const core = SEMICOLON.Core;
	core.initFunction({ class: 'has-plugin-pricing-switcher', event: 'pluginPricingSwitcherReady' });

	selector = core.getSelector( selector, false );
	if( selector.length < 1 ){
		return true;
	}

	selector.forEach( element => {
		let elCheck = element.querySelector('[type="checkbox"]'),
			elParent = element.closest('.pricing-tenure-switcher'),
			elDefClass = element.getAttribute('data-default-class') || 'text-muted op-05',
			elActClass = element.getAttribute('data-active-class') || 'fw-bold',
			elPricing = document.querySelector( elParent.getAttribute('data-container') );

		CanvasPricingSwitcher(elCheck, elParent, elPricing, elDefClass, elActClass);

		elCheck.addEventListener( 'change', () => {
			CanvasPricingSwitcher(elCheck, elParent, elPricing, elDefClass, elActClass);
		});
	});
};

