SEMICOLON.Core.getVars.fn.menus = selector => {
	const core = SEMICOLON.Core;
	selector = core.getSelector( selector, false );
	if( selector.length < 1 ){
		return true;
	}

	CanvasMenuInit();
	CanvasMenuReset();
	CanvasMenuArrows();
	CanvasMenuInvert();
	CanvasMenuFunctions();
	CanvasMenuTrigger();
	CanvasMenuFullWidth();

	let windowWidth = core.viewport().width;
	core.getVars.resizers.menus = () => {
		if( windowWidth != core.viewport().width ) {
			SEMICOLON.Base.menus();
		}
	};

	core.getVars.recalls.menureset = () => {
		CanvasMenuReset();
		CanvasMenuFunctions();
	};
};

const CanvasMenuInit = () => {
	const core = SEMICOLON.Core;
	core.getVars.headerWrapHeight = core.getVars.elHeaderWrap?.offsetHeight;

	document.addEventListener('click', e => {
		if( !e.target.closest('.primary-menu-trigger') && !e.target.closest('.primary-menu') ) {
			CanvasMenuReset();
			CanvasMenuFunctions();
		}

		if ( !e.target.closest('.top-links.on-click') ) {
			document.querySelectorAll('.top-links.on-click').forEach(item => item.querySelectorAll('.top-links-sub-menu,.top-links-section').forEach(el => el.classList.remove('d-block')));
			document.querySelectorAll('.top-links.on-click').forEach(item => item.querySelectorAll('.top-links-item').forEach(el => el.classList.remove('current')));
		}
	}, false);

	document.querySelectorAll( '.menu-item' ).forEach( el => {
		if( el.querySelectorAll('.sub-menu-container').length > 0 ) {
			el.classList.add('sub-menu');
		}

		if( !el.classList.contains('mega-menu-title') && el.querySelectorAll('.sub-menu-container').length > 0 && el.querySelectorAll('.sub-menu-trigger').length < 1 ) {
			let subMenuTrigger = document.createElement('button');
			subMenuTrigger.classList = 'sub-menu-trigger fa-solid fa-chevron-right';
			subMenuTrigger.innerHTML = '<span class="visually-hidden">Open Sub-Menu</span>';
			el.append( subMenuTrigger );
		}
	});
};

const CanvasMenuReset = () => {
	const core = SEMICOLON.Core;
	let body = core.getVars.elBody,
		subMenusSel = '.mega-menu-content, .sub-menu-container',
		menuItemSel = '.menu-item';

	document.querySelectorAll('.primary-menu-trigger').forEach(el => el.classList.remove('primary-menu-trigger-active'));

	core.getVars.elPrimaryMenus.forEach(el => {
		if( !body.classList.contains('is-expanded-menu') ) {
			el.querySelector('.menu-container').classList.remove('d-block');
		} else {
			el.querySelector('.menu-container').classList.remove('d-block', 'd-none');
			el.querySelectorAll(subMenusSel)?.forEach(item => item.classList.remove('d-none'));
			document.querySelectorAll('.menu-container:not(.mobile-primary-menu)').forEach(el => el.style.display = '');
			core.getVars.elPrimaryMenus.forEach(el => el.querySelectorAll('.mobile-primary-menu')?.forEach(elem => elem.classList.remove('d-block')));
		}

		el.querySelectorAll(subMenusSel)?.forEach(item => item.classList.remove('d-block'));
		// el.querySelectorAll(menuItemSel).forEach(item => item.classList.remove('current'));

		el.classList.remove('primary-menu-active');

		const classes = body.className.split(" ").filter(c => !c.startsWith('primary-menu-open'));
		body.className = classes.join(" ").trim();
	});
};

const CanvasMenuArrows = () => {
	const addArrow = menuItemDiv => {
		if( !menuItemDiv.querySelector('.sub-menu-indicator') ) {
			let arrow = document.createElement("i");
			arrow.classList.add('sub-menu-indicator');

			let customArrow = menuItemDiv.closest('.primary-menu')?.getAttribute('data-arrow-class') || 'fa-solid fa-caret-down';
			customArrow && customArrow.split(" ").forEach(className => arrow.classList.add(className));

			menuItemDiv.append(arrow);
		}
	};

	// Arrows for Top Links Items
	document.querySelectorAll( '.top-links-item' ).forEach( menuItem => {
		let menuItemDiv = menuItem.querySelector(':scope > a');
		menuItem.querySelector(':scope > .top-links-sub-menu, :scope > .top-links-section') && addArrow( menuItemDiv );
	});

	// Arrows for Primary Menu Items
	document.querySelectorAll( '.menu-item' ).forEach( menuItem => {
		let menuItemDiv = menuItem.querySelector(':scope > .menu-link > div');
		( !menuItem.classList.contains('mega-menu-title') && menuItem.querySelector(':scope > .sub-menu-container, :scope > .mega-menu-content') ) && addArrow( menuItemDiv );
	});

	// Arrows for Page Menu Items
	document.querySelectorAll( '.page-menu-item' ).forEach( menuItem => {
		let menuItemDiv = menuItem.querySelector(':scope > a > div');
		menuItem.querySelector(':scope > .page-menu-sub-menu') && addArrow( menuItemDiv );
	});
};

const CanvasMenuInvert = subMenuEl => {
	const core = SEMICOLON.Core;
	let subMenus = subMenuEl || document.querySelectorAll( '.mega-menu-content, .sub-menu-container, .top-links-section' );

	if( !core.getVars.elBody.classList.contains('is-expanded-menu') ) {
		return false;
	}

	subMenus.forEach( el => {
		el.classList.remove('menu-pos-invert');
		let elChildren = el.querySelectorAll(':scope > *');

		elChildren.forEach( elChild => elChild.style.display = 'block' );
		el.style.display = 'block';

		let viewportOffset = el.getBoundingClientRect();

		if( el.closest('.mega-menu-small') ) {
			let outside = core.viewport().width - (viewportOffset.left + viewportOffset.width);
			if( outside < 0 ) {
				el.style.left = outside + 'px';
			}
		}

		if( core.getVars.elBody.classList.contains('rtl') ) {
			if( viewportOffset.left < 0 ) {
				el.classList.add('menu-pos-invert');
			}
		}

		if( core.viewport().width - (viewportOffset.left + viewportOffset.width) < 0 ) {
			el.classList.add('menu-pos-invert');
		}
	});

	subMenus.forEach( el => {
		let elChildren = el.querySelectorAll(':scope > *');
		elChildren.forEach(elChild => elChild.style.display = '');
		el.style.display = '';
	});
};

const CanvasMenuFunctions = () => {
	const core = SEMICOLON.Core;

	let subMenusSel = '.mega-menu-content, .sub-menu-container',
		menuItemSel = '.menu-item',
		subMenuSel = '.sub-menu',
		subMenuTriggerSel = '.sub-menu-trigger',
		body = core.getVars.elBody.classList;

	let triggersBtn = document.querySelectorAll( subMenuTriggerSel );
	let triggerLinks = new Array;

	triggersBtn.forEach( el => {
		let triggerLink = el.closest('.menu-item').querySelector('.menu-link[href^="#"]');
		if( triggerLink ) {
			triggerLinks.push(triggerLink);
		}
	});

	let triggers = [...triggersBtn, ...triggerLinks];

	document.querySelectorAll(subMenuTriggerSel).forEach(el => el.classList.remove('icon-rotate-90'));

	/**
	 * Mobile Menu Functionality
	 */
	if( !body.contains('is-expanded-menu') ) {
		// Reset Menus to their Closed State
		core.getVars.elPrimaryMenus.forEach(el => el.querySelectorAll(subMenusSel).forEach(elem => {
			elem.classList.add('d-none');
			body.remove("primary-menu-open");
		}));

		triggers.forEach( trigger => {
			trigger.onclick = e => {
				e.preventDefault();

				let triggerEl = trigger;

				if( !trigger.classList.contains('sub-menu-trigger') ) {
					triggerEl = trigger.closest(menuItemSel).querySelector(':scope > ' + subMenuTriggerSel);
				}

				core.siblings(triggerEl.closest(menuItemSel)).forEach(item => item.querySelectorAll(subMenusSel).forEach(item => item.classList.add('d-none')));

				if( triggerEl.closest('.mega-menu-content') ) {
					let parentSubMenuContainers = [];
					core.parents(triggerEl, menuItemSel).forEach(item => parentSubMenuContainers.push(item.querySelector(':scope > ' + subMenusSel)));
					[...triggerEl.closest('.mega-menu-content').querySelectorAll(subMenusSel)].filter(item => !parentSubMenuContainers.includes(item)).forEach(item => item.classList.add('d-none'));
				}

				CanvasMenuTriggerState(triggerEl, menuItemSel, subMenusSel, subMenuTriggerSel, 'd-none');
			};
		});
	}

	/**
	 * On-Click Menu Functionality
	 */
	if( body.contains('is-expanded-menu') ) {
		if( body.contains('side-header') || body.contains('overlay-menu') ) {
			core.getVars.elPrimaryMenus.forEach(pMenu => {
				pMenu.classList.add('on-click');
				pMenu.querySelectorAll(subMenuTriggerSel).forEach(item => item.style.zIndex = '-1');
			});
		}

		[...core.getVars.elPrimaryMenus].filter(elem => elem.matches('.on-click')).forEach(pMenu => {
			let menuItemSubs = core.has( pMenu.querySelectorAll(menuItemSel), subMenuTriggerSel );

			menuItemSubs.forEach(el => {
				let triggerEl = el.querySelector(':scope > .menu-link');

				triggerEl.onclick = e => {
					e.preventDefault();

					core.siblings(triggerEl.closest(menuItemSel)).forEach(item => item.querySelectorAll(subMenusSel).forEach(item => item.classList.remove('d-block')));

					if( triggerEl.closest('.mega-menu-content') ) {
						let parentSubMenuContainers = [];
						core.parents(triggerEl, menuItemSel).forEach(item => parentSubMenuContainers.push(item.querySelector(':scope > ' + subMenusSel)));
						[...triggerEl.closest('.mega-menu-content').querySelectorAll(subMenusSel)].filter(item => !parentSubMenuContainers.includes(item)).forEach(item => item.classList.remove('d-block'));
					}

					CanvasMenuTriggerState(triggerEl, menuItemSel, subMenusSel, subMenuTriggerSel, 'd-block');
				};
			});
		});
	}

	/**
	 * Top-Links On-Click Functionality
	 */
	document.querySelectorAll('.top-links').forEach(item => {
		if( item.classList.contains('on-click') || !body.contains('device-up-lg') ) {
			item.querySelectorAll('.top-links-item').forEach(menuItem => {
				if( menuItem.querySelectorAll('.top-links-sub-menu,.top-links-section').length > 0 ) {
					let triggerEl = menuItem.querySelector(':scope > a');

					triggerEl.onclick = e => {
						e.preventDefault();

						core.siblings(menuItem).forEach(item => item.querySelectorAll('.top-links-sub-menu, .top-links-section').forEach(item => item.classList.remove('d-block')));
						menuItem.querySelector(':scope > .top-links-sub-menu, :scope > .top-links-section').classList.toggle('d-block');
						core.siblings(menuItem).forEach(item => item.classList.remove('current'));
						menuItem.classList.toggle('current');
					};
				}
			})
		}
	});

	CanvasMenuInvert( document.querySelectorAll('.top-links-section') );

};

const CanvasMenuTriggerState = (triggerEl, menuItemSel, subMenusSel, subMenuTriggerSel, classCheck) => {
	const core = SEMICOLON.Core;

	triggerEl.closest('.menu-container').querySelectorAll(subMenuTriggerSel).forEach(el => el.classList.remove('icon-rotate-90'));

	let triggerredSubMenus = triggerEl.closest(menuItemSel).querySelector( ':scope > ' + subMenusSel );
	let childSubMenus = triggerEl.closest(menuItemSel).querySelectorAll( subMenusSel );

	if( classCheck == 'd-none' ) {
		if( triggerredSubMenus.classList.contains('d-none') ) {
			triggerredSubMenus.classList.remove('d-none');
		} else {
			childSubMenus.forEach(item => item.classList.add('d-none'));
		}
	} else {
		if( triggerredSubMenus.classList.contains('d-block') ) {
			childSubMenus.forEach(item => item.classList.remove('d-block'));
		} else {
			triggerredSubMenus.classList.add('d-block');
		}
	}

	CanvasMenuCurrent(triggerEl, menuItemSel, subMenusSel, subMenuTriggerSel);
}

const CanvasMenuCurrent = (triggerEl, menuItemSel, subMenusSel, subMenuTriggerSel) => {
	const core = SEMICOLON.Core;

	[...triggerEl.closest('.menu-container').querySelectorAll(menuItemSel)].forEach(item => item.classList.remove('current'));

	const setCurrent = (item, menuItemSel, subMenusSel) => {
		if( !core.isHidden(item.closest(menuItemSel).querySelector(':scope > ' + subMenusSel)) ) {
			item.closest(menuItemSel).classList.add('current');
			item.closest(menuItemSel).querySelector(':scope > ' + subMenuTriggerSel)?.classList.add('icon-rotate-90');
		} else {
			item.closest(menuItemSel).classList.remove('current');
			item.closest(menuItemSel).querySelector(':scope > ' + subMenuTriggerSel)?.classList.remove('icon-rotate-90');
		}
	};

	setCurrent(triggerEl, menuItemSel, subMenusSel, subMenuTriggerSel);
	core.parents(triggerEl, menuItemSel).forEach(item => setCurrent(item, menuItemSel, subMenusSel, subMenuTriggerSel));
};

const CanvasMenuTrigger = () => {
	const core = SEMICOLON.Core;
	let body = core.getVars.elBody.classList;

	document.querySelectorAll('.primary-menu-trigger').forEach( menuTrigger => {
		menuTrigger.onclick = e => {
			var elTarget = menuTrigger.getAttribute( 'data-target' ) || '*';

			if( core.filtered( core.getVars.elPrimaryMenus, elTarget ).length < 1 ) {
				return;
			}

			if( !body.contains('is-expanded-menu') ) {
				core.getVars.elPrimaryMenus.forEach( el => {
					if( el.querySelectorAll('.mobile-primary-menu').length > 0 ) {
						el.matches(elTarget) && el.querySelectorAll('.mobile-primary-menu').forEach( elem => elem.classList.toggle('d-block') );
					} else {
						el.matches(elTarget) && el.querySelectorAll('.menu-container').forEach( elem => elem.classList.toggle('d-block') );
					}
				});
			}

			menuTrigger.classList.toggle('primary-menu-trigger-active');
			core.getVars.elPrimaryMenus.forEach(elem => elem.matches(elTarget) && elem.classList.toggle('primary-menu-active'));

			body.toggle('primary-menu-open');

			if( elTarget != '*' ) {
				body.toggle('primary-menu-open-' + elTarget.replace(/[^a-zA-Z0-9-]/g, ""));
			} else {
				body.toggle('primary-menu-open-all');
			}

			e.preventDefault();
		};
	});
};

const CanvasMenuFullWidth = () => {
	const core = SEMICOLON.Core;
	let body = core.getVars.elBody.classList;

	if( !body.contains('is-expanded-menu') ) {
		document.querySelectorAll('.mega-menu-content, .top-search-form').forEach( el => el.style.width = '' );
		return true;
	}

	let headerWidth = document.querySelector('.mega-menu:not(.mega-menu-full):not(.mega-menu-small) .mega-menu-content')?.closest('.header-row').offsetWidth;

	if( core.getVars.elHeader.querySelectorAll('.container-fullwidth').length > 0 ) {
		document.querySelectorAll('.mega-menu:not(.mega-menu-full):not(.mega-menu-small) .mega-menu-content').forEach( el => el.style.width = headerWidth + 'px' );
	}

	document.querySelectorAll('.mega-menu:not(.mega-menu-full):not(.mega-menu-small) .mega-menu-content, .top-search-form').forEach( el => el.style.width = headerWidth + 'px' );

	if( core.getVars.elHeader.classList.contains('full-header') ) {
		document.querySelectorAll('.mega-menu:not(.mega-menu-full):not(.mega-menu-small) .mega-menu-content').forEach(el => el.style.width = headerWidth + 'px');
	}

	if( core.getVars.elHeader.classList.contains('floating-header') ) {
		let floatingHeaderPadding = getComputedStyle(document.querySelector('#header')).getPropertyValue('--cnvs-header-floating-padding');
		document.querySelectorAll('.mega-menu:not(.mega-menu-full):not(.mega-menu-small) .mega-menu-content').forEach(el => el.style.width = (headerWidth + (Number(floatingHeaderPadding.split('px')[0]) *2)) + 'px');
	}
};
