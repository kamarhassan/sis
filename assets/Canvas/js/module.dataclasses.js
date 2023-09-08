export default function( selector ) {
	const core = SEMICOLON.Core;
	core.initFunction({ class: 'has-plugin-dataclasses', event: 'pluginDataClassesReady' });

	selector = core.getSelector( selector, false, false );
	if( selector.length < 1 ){
		return true;
	}

	selector.forEach(el => {
		let classes = el.getAttribute('data-class');

		classes = classes.split(/ +/);
		if( classes.length > 0 ) {
			classes.forEach(_class => {
				let deviceClass = _class.split(":");
				if( core.getVars.elBody.classList.contains(deviceClass[0] == 'dark' ? deviceClass[0] : 'device-' + deviceClass[0]) ) {
					el.classList.add(deviceClass[1]);
				} else {
					el.classList.remove(deviceClass[1]);
				}
			});
		}
	});

	core.getVars.resizers.dataClasses = () => {
		setTimeout(() => {
			SEMICOLON.Modules.dataClasses();
		}, 333);
	};
};
