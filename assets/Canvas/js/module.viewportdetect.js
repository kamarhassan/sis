export default function( selector ) {
	const core = SEMICOLON.Core;
	core.initFunction({ class: 'has-plugin-viewportdetect', event: 'pluginViewportDetectReady' });

	selector = core.getSelector( selector, false );
	if( selector.length < 1 ){
		return true;
	}

	const observer = new window.IntersectionObserver(([entry]) => {
		entry.isIntersecting ? entry.target.classList.add('is-in-viewport') : entry.target.classList.remove('is-in-viewport');
	}, { root: null, threshold: 0, });

	selector.forEach(el => {
		observer.observe(el);
	});
};
