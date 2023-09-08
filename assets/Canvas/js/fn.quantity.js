SEMICOLON.Core.getVars.fn.quantity = selector => {
	const core = SEMICOLON.Core;
	core.initFunction({ class: 'has-plugin-quantity', event: 'pluginQuantityReady' });

	selector = core.getSelector( selector, false );
	if( selector.length < 1 ){
		return true;
	}

	selector.forEach( element => {
		let plus = element.querySelector('.plus'),
			minus = element.querySelector('.minus'),
			input = element.querySelector('.qty');

		const eChange = new Event("change");

		plus.onclick = e => {
			let value = input.value,
				step = input.getAttribute('step') || 1,
				max = input.getAttribute('max'),
				intRegex = /^\d+$/;

			if( max && ( Number(elValue) >= Number( max ) ) ) {
				return false;
			}

			if( intRegex.test( value ) ) {
				let valuePlus = Number(value) + Number(step);
				input.value = valuePlus;
			} else {
				input.value = Number(step);
			}

			input.dispatchEvent(eChange);

			e.preventDefault();
		};

		minus.onclick = e => {
			let value = input.value,
				step = input.getAttribute('step') || 1,
				min = input.getAttribute('min'),
				intRegex = /^\d+$/;

			if( !min || min < 0 ) {
				min = 1;
			}

			if( intRegex.test( value ) ) {
				if( Number(value) > Number(min) ) {
					let valueMinus = Number(value) - Number(step);
					input.value = valueMinus;
				}
			} else {
				input.value = Number(step);
			}

			input.dispatchEvent(eChange);

			e.preventDefault();
		};
	});
};
