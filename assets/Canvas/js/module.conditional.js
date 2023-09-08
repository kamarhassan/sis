export default function( selector ) {
	const core = SEMICOLON.Core;
	core.initFunction({ class: 'has-plugin-conditional', event: 'pluginConditionalReady' });

	selector = core.getSelector( selector, false );
	if( selector.length < 1 ){
		return true;
	}

	selector.forEach( el => {
		let field = el,
			condition = field.getAttribute( 'data-condition' ) || '==',
			conditionTarget = field.getAttribute( 'data-condition-target' ),
			conditionValue = field.getAttribute( 'data-condition-value' ),
			conditionCheck = field.getAttribute( 'data-condition-check' ) || 'value',
			target = document.querySelector('[id*="'+conditionTarget+'"]'),
			value = target.value,
			targetType = target.type,
			eventType;

		let conditions = {
			operator: condition,
			field: conditionTarget,
			value: conditionValue
		}

		let targetTag = target.tagName.toLowerCase();

		// if( targetTag === 'input' || targetTag === 'textarea' || targetTag === 'select' ) {
		// 	targetType = target.type || targetTag;
		// }

		if( targetType == 'checkbox' || targetTag == 'select' || targetType == 'radio' ) {
			eventType = 'change';
		} else {
			eventType = 'input';
		}

		if( targetType == 'checkbox' ) {
			value = target.checked ? target.value : 0;
		}

		if( targetType == 'radio' ) {
			value = target.checked ? target.value : '';
		}

		CanvasConditionsEval( field, value, conditions, conditionCheck, target );

		target.addEventListener( eventType, () => {
			if( targetType == 'checkbox' ) {
				value = target.checked ? target.value : 0;
			} else if( targetType == 'radio' ) {
				value = target.checked ? target.value : '';
			} else {
				value = target.value;
			}

			CanvasConditionsEval( field, value, conditions, conditionCheck, target );
		});

		if( conditionCheck == 'validate' ) {
			let mutationObserver = new MutationObserver(mutations => {
				mutations.forEach(mutation => {
					CanvasConditionsEval( field, value, conditions, conditionCheck, target );
				});
			});

			mutationObserver.observe( target, {
				attributes: true,
				characterData: true,
				childList: true,
				subtree: true,
				attributeOldValue: true,
				characterDataOldValue: true
			});
		}
	});
};

const CanvasConditionsEval = ( field, value, conditions, check, target ) => {
	if( ! field || ! conditions ) {
		return false;
	}

	let fulfilled = false;

	if( check == 'validate' ) {
		if( value ) {
			if ( target.getAttribute('aria-invalid') == 'false' ) {
				fulfilled = true;
			} else {
				fulfilled = false;
			}
		}
	} else {
		switch( conditions.operator ) {
			case '==':
				if( value == conditions.value ) {
					fulfilled = true;
				}
				break;

			case '!=':
				if( value != conditions.value ) {
					fulfilled = true;
				}
				break;

			case '>':
				if( value > conditions.value ) {
					fulfilled = true;
				}
				break;

			case '<':
				if( value < conditions.value ) {
					fulfilled = true;
				}
				break;

			case '<=':
				if( value <= conditions.value ) {
					fulfilled = true;
				}
				break;

			case '>=':
				if( value >= conditions.value ) {
					fulfilled = true;
				}
				break;

			case 'in':
				if( conditions.value.includes( value ) ) {
					fulfilled = true;
				}
				break;

			default:
				fulfilled = false;
				break;
		}
	}

	if( fulfilled ) {
		field.classList.add('condition-fulfilled');
		field.querySelectorAll('input,select,textarea,button').forEach(el => el.disabled = false);
	} else {
		field.classList.remove('condition-fulfilled');
		field.querySelectorAll('input,select,textarea,button').forEach(el => el.disabled = true);
	}
};
