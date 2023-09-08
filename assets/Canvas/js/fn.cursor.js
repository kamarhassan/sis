SEMICOLON.Core.getVars.fn.cursor = selector => {
	const core = SEMICOLON.Core;
	core.initFunction({ class: 'has-plugin-cursor', event: 'pluginCursorReady' });

	let cursor = document.querySelector('.cnvs-cursor');
	let cursorFollower = document.querySelector('.cnvs-cursor-follower');
	let cursorDot = document.querySelector('.cnvs-cursor-dot');

	const addCursorEl = (selector, parent) => {
		let el = document.createElement('div');
		el.classList.add(selector.split('.')[1]);

		parent.prepend( el );
		return document.querySelector(selector);
	};

	if( !cursor ) {
		cursor = addCursorEl('.cnvs-cursor', core.getVars.elWrapper);
	}

	if( !cursorFollower ) {
		cursorFollower = addCursorEl('.cnvs-cursor-follower', cursor);
	}

	if( !cursorDot ) {
		cursorDot = addCursorEl('.cnvs-cursor-dot', cursor);
	}

	const onMouseMove = event => {
		cursor.style.transform = "translate3d("+ event.clientX + 'px'+","+event.clientY+'px'+",0px)";
	}

	document.addEventListener('mousemove', onMouseMove);

	document.querySelectorAll('a,button').forEach( el => {
		el.addEventListener('mouseenter', () => {
			cursor.classList.add('cnvs-cursor-action');
		});

		el.addEventListener('mouseleave', () => {
			cursor.classList.remove('cnvs-cursor-action');
		});
	});
};
