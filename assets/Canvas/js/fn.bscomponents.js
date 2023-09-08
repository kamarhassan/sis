SEMICOLON.Core.getVars.fn.bscomponents = selector => {
	const core = SEMICOLON.Core;
	core.loadJS({ file: 'plugins.bootstrap.js', id: 'canvas-bootstrap-js', jsFolder: true });
	core.isFuncTrue( () => typeof bootstrap !== 'undefined' ).then( cond => {
		if( !cond ) {
			return false;
		}

		core.initFunction({ class: 'has-plugin-bscomponents', event: 'pluginBsComponentsReady' });

		selector = core.getSelector( selector, false );
		if( selector.length < 1 ){
			return true;
		}

		let tooltips = [].slice.call(core.getVars.baseEl.querySelectorAll('[data-bs-toggle="tooltip"]'));
		let tooltipList = tooltips.map( tooltipEl => {
			return new bootstrap.Tooltip(tooltipEl, { container: 'body' });
		});

		let popovers = [].slice.call(core.getVars.baseEl.querySelectorAll('[data-bs-toggle="popover"]'));
		let popoverList = popovers.map( popoverEl => {
			return new bootstrap.Popover(popoverEl, { container: 'body' });
		});

		let tabs = document.querySelectorAll('[data-bs-toggle="tab"],[data-bs-toggle="pill"]');

		const tabTargetShow = target => {
			const tabTrigger = new bootstrap.Tab(target);
			tabTrigger.show();
		};

		document.querySelectorAll('.canvas-tabs').forEach(el => {
			let activeTab = el.getAttribute('data-active');

			if( activeTab ) {
				activeTab = Number(activeTab) - 1;
				tabTargetShow(el.querySelectorAll('[data-bs-target]')[activeTab]);
			}
		});

		document.querySelectorAll('.tab-hover').forEach(el => {
			el.querySelectorAll('[data-bs-target]').forEach(tab => {
				tab.addEventListener( 'mouseover', () => {
					tabTargetShow(tab);
				});
			});
		});

		if( core.getVars.hash && document.querySelector('[data-bs-target="'+core.getVars.hash+'"]') ) {
			tabTargetShow(document.querySelector('[data-bs-target="'+core.getVars.hash+'"]'));
		}

		tabs.forEach(el => {
			el.addEventListener('shown.bs.tab', e => {
				if( !el.classList.contains('container-modules-loaded') ) {
					let tabContent = el.getAttribute('data-bs-target') ? el.getAttribute('data-bs-target') : el.getAttribute('href');
					core.runContainerModules( document.querySelector(tabContent) );
					document.querySelector(tabContent).querySelectorAll('.flexslider').forEach(flex => {
						setTimeout(() => {
							jQuery(flex).find('.slide').resize();
						}, 500 );
					});
					el.classList.add('container-modules-loaded');
				}
			});
		});

		document.querySelectorAll('.style-msg .btn-close').forEach( el => {
			el.onclick = e => {
				el.closest( '.style-msg' ).classList.add('d-none');
				e.preventDefault();
			};
		});
	});
};
