export default function( selector ) {
	const core = SEMICOLON.Core;

	core.initFunction({ class: 'has-plugin-schemetoggler', event: 'pluginSchemeTogglerReady' });

	selector = core.getSelector( selector, false );
	if( selector.length < 1 ) {
		return false;
	}

	selector.forEach(element => {
		const bodyClassToggle = element.getAttribute('data-bodyclass-toggle') || 'dark';
		const toggleType = element.getAttribute('data-type') || 'trigger';
		CanvasBodyToggle(element);

		if( 'checkbox' == toggleType ) {
			let elementCheck = element.querySelector('input[type=checkbox]');

			elementCheck.addEventListener( 'change', () => {
				core.classesFn( 'toggle', bodyClassToggle, core.getVars.elBody );
				CanvasBodyToggle(element, false, true);
				core.siblings(element, selector).forEach(el => CanvasBodyToggle(el, true));
			});
		} else {
			element.onclick = e => {
				e.preventDefault();

				core.classesFn( 'toggle', bodyClassToggle, core.getVars.elBody );
				CanvasBodyToggle(element, false, true);
				core.siblings(element, selector).forEach(el => CanvasBodyToggle(el, true));
			};
		}
	});
};

const CanvasBodyToggle = (element, sibling=false, action=false) => {
	const core = SEMICOLON.Core;

	const bodyClassToggle = element.getAttribute('data-bodyclass-toggle') || 'dark';
	const classAdd = element.getAttribute('data-add-class') || 'scheme-toggler-active';
	const classRemove = element.getAttribute('data-remove-class') || 'scheme-toggler-active';
	const htmlAdd = element.getAttribute('data-add-html');
	const htmlRemove = element.getAttribute('data-remove-html');
	const toggleType = element.getAttribute('data-type') || 'trigger';
	const remember = element.getAttribute('data-remember') || 'false';

	if( core.contains( bodyClassToggle, core.getVars.elBody ) ) {
		core.classesFn( 'add', classAdd, element );
		core.classesFn( 'remove', classRemove, element );
		element.classList.add('body-state-toggled');

		// Set Storage
		if( remember == "true" && action ) {
			localStorage.setItem('cnvsBodyColorScheme', 'dark');
		}

		if( 'checkbox' == toggleType && sibling ) {
			element.querySelector('input[type=checkbox]').checked = true;
		} else {
			if( htmlAdd ) {
				element.innerHTML = htmlAdd;
			}
		}
	} else {
		core.classesFn( 'add', classRemove, element );
		core.classesFn( 'remove', classAdd, element );
		element.classList.remove('body-state-toggled');

		// Remove Storage
		if( remember == "true" && action ) {
			localStorage.removeItem('cnvsBodyColorScheme');
		}

		if( 'checkbox' == toggleType && sibling ) {
			element.querySelector('input[type=checkbox]').checked = false;
		} else {
			if( htmlRemove ) {
				element.innerHTML = htmlRemove;
			}
		}
	}

	SEMICOLON.Base.setBSTheme();
	SEMICOLON.Modules.dataClasses();
};
