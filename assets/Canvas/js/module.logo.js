export default function( selector ) {
	const core = SEMICOLON.Core;

	selector = core.getSelector( selector, false );
	if( selector.length < 1 ){
		return true;
	}

	let head = core.getVars.elHead;

	if( selector[0].querySelector('.logo-dark') ) {
		let style = document.createElement('style');
		head.appendChild(style);
		let css = '.dark #header-wrap:not(.not-dark) #logo [class^="logo-"], .dark .header-row:not(.not-dark) #logo [class^="logo-"] { display: none; } .dark #header-wrap:not(.not-dark) #logo .logo-dark, .dark .header-row:not(.not-dark) #logo .logo-dark { display: flex; }';
		style.appendChild(document.createTextNode(css));
	}

	if( selector[0].querySelector('.logo-sticky') ) {
		let style = document.createElement('style');
		head.appendChild(style);
		let css = '.sticky-header #logo [class^="logo-"] { display: none; } .sticky-header #logo .logo-sticky { display: flex; }';
		style.appendChild(document.createTextNode(css));
	}

	if( selector[0].querySelector('.logo-sticky-shrink') ) {
		let style = document.createElement('style');
		head.appendChild(style);
		let css = '.sticky-header-shrink #logo [class^="logo-"] { display: none; } .sticky-header-shrink #logo .logo-sticky-shrink { display: flex; }';
		style.appendChild(document.createTextNode(css));
	}

	if( selector[0].querySelector('.logo-mobile') ) {
		let style = document.createElement('style');
		head.appendChild(style);
		let css = 'body:not(.is-expanded-menu) #logo [class^="logo-"] { display: none; } body:not(.is-expanded-menu) #logo .logo-mobile { display: flex; }';
		style.appendChild(document.createTextNode(css));
	}
};
