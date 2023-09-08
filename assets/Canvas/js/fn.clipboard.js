SEMICOLON.Core.getVars.fn.clipboard = selector => {
	const core = SEMICOLON.Core;
	core.loadJS({ file: 'plugins.clipboard.js', id: 'canvas-clipboard-js', jsFolder: true });
    core.isFuncTrue( () => typeof ClipboardJS !== 'undefined' ).then( cond => {
        if( !cond ) {
            return false;
        }

		core.initFunction({ class: 'has-plugin-clipboard', event: 'pluginClipboardReady' });

		selector = core.getSelector( selector, false );
		if( selector.length < 1 ){
			return true;
		}

		let clipboards = [],
			count = 0;

		selector.forEach( el => {
			let trigger = el.querySelector('button'),
				triggerText = trigger.innerHTML,
				copiedtext = trigger.getAttribute('data-copied') || 'Copied',
				copiedTimeout = trigger.getAttribute('data-copied-timeout') || 5000;

			clipboards[count] = new ClipboardJS( trigger, {
				target: function(content) {
					return content.closest('.clipboard-copy').querySelector('code');
				}
			});

			clipboards[count].on('success', function(e) {
				trigger.innerHTML = copiedtext;
				trigger.disabled = true;

				setTimeout(() => {
					trigger.innerHTML = triggerText;
					trigger.disabled = false;
				}, Number(copiedTimeout));
			});

			count++;
		});
	});
};
