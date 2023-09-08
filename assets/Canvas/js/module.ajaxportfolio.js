export default function( selector ) {
	const core = SEMICOLON.Core;
	core.initFunction({ class: 'has-plugin-ajaxportfolio', event: 'pluginAjaxPortfolioReady' });

	selector = core.getSelector( selector, false );
	if( selector.length < 1 ){
		return true;
	}

	core.getVars.portfolioAjax.items = selector[0].querySelectorAll('.portfolio-item');
	core.getVars.portfolioAjax.wrapper = document.getElementById('portfolio-ajax-wrap');
	core.getVars.portfolioAjax.wrapperOffset = core.offset(core.getVars.portfolioAjax.wrapper).top;
	core.getVars.portfolioAjax.container = document.getElementById('portfolio-ajax-container');
	core.getVars.portfolioAjax.loader = document.getElementById('portfolio-ajax-loader');
	core.getVars.portfolioAjax.prevItem = '';

	selector[0].querySelectorAll('.portfolio-ajax-trigger').forEach( el => {
		if( !el.querySelector('i:nth-child(2)') ) {
			el.innerHTML += '<i class="bi-arrow-repeat icon-spin"></i>';
		}

		el.onclick = e => {
			let portPostId = e.target.closest('.portfolio-item').getAttribute('id');

			if( !e.target.closest('.portfolio-item').classList.contains('portfolio-active') ) {
				CanvasPortfolioLoadItem(portPostId, core.getVars.portfolioAjax.prevItem);
			}

			e.preventDefault();
		};
	});
};

const CanvasPortfolioNewNextPrev = portPostId => {
	let portNext = CanvasPortfolioGetNextItem(portPostId);
	let portPrev = CanvasPortfolioGetPrevItem(portPostId);
	let portNav = document.getElementById('portfolio-navigation');

	if( !document.getElementById('prev-portfolio') && portPrev ) {
		var prevPortItem = document.createElement('a');
		prevPortItem.setAttribute('href', '#');
		prevPortItem.setAttribute('id', 'prev-portfolio');
		prevPortItem.setAttribute('data-id', portPrev);
		prevPortItem.innerHTML = '<i class="bi-arrow-left"></i>';
		portNav.insertBefore( prevPortItem, document.getElementById('close-portfolio'));
	}

	if( !document.getElementById('next-portfolio') && portNext ) {
		var nextPortItem = document.createElement('a');
		nextPortItem.setAttribute('href', '#');
		nextPortItem.setAttribute('id', 'next-portfolio');
		nextPortItem.setAttribute('data-id', portNext);
		nextPortItem.innerHTML = '<i class="bi-arrow-right"></i>';
		portNav.insertBefore( nextPortItem, document.getElementById('close-portfolio'));
	}
};

const CanvasPortfolioLoadItem = (portPostId, prevPostPortId, getIt) => {
	const core = SEMICOLON.Core;
	if(!getIt) { getIt = false; }
	let portNext = CanvasPortfolioGetNextItem(portPostId);
	let portPrev = CanvasPortfolioGetPrevItem(portPostId);
	if(getIt == false) {
		CanvasPortfolioCloseItem();
		core.getVars.elBody.classList.add('portfolio-ajax-loading');
		// core.getVars.portfolioAjax.loader.classList.add('loader-overlay-display');
		let portfolioDataLoader = document.getElementById(portPostId).getAttribute('data-loader');

		fetch( portfolioDataLoader ).then( response => {
			return response.text();
		}).then( html => {
			core.getVars.portfolioAjax.container.innerHTML = html;

			let nextPortfolio = document.getElementById('next-portfolio'),
				prevPortfolio = document.getElementById('prev-portfolio');

			nextPortfolio.classList.add('d-none');
			prevPortfolio.classList.add('d-none');

			if( portNext ) {
				nextPortfolio.setAttribute('data-id', portNext);
				nextPortfolio.classList.remove('d-none');
			}

			if( portPrev ) {
				prevPortfolio.setAttribute('data-id', portPrev);
				prevPortfolio.classList.remove('d-none');
			}

			CanvasPortfolioInitializeAjax(portPostId);
			CanvasPortfolioOpenItem();
			core.getVars.portfolioAjax.items.forEach( item => {
				item.classList.remove('portfolio-active');
			});
			document.getElementById(portPostId).classList.add('portfolio-active');
		}).catch( error => {
			console.warn('Something went wrong.', error);
		});
	}
};

const CanvasPortfolioCloseItem = () => {
	const core = SEMICOLON.Core;
	if( core.getVars.portfolioAjax.wrapper && core.getVars.portfolioAjax.wrapper.offsetHeight > 32 ) {
		core.getVars.elBody.classList.remove('portfolio-ajax-loading');
		// core.getVars.portfolioAjax.loader.classList.add('loader-overlay-display');
		core.getVars.portfolioAjax.wrapper.classList.remove('portfolio-ajax-opened');
		core.getVars.portfolioAjax.wrapper.querySelector('#portfolio-ajax-single').ontransitionend = () => {
			core.getVars.portfolioAjax.wrapper.querySelector('#portfolio-ajax-single').remove();
		};

		core.getVars.portfolioAjax.items.forEach( item => {
			item.classList.remove('portfolio-active');
		});
	}
};

const CanvasPortfolioOpenItem = () => {
	const core = SEMICOLON.Core;
	let countImages = core.getVars.portfolioAjax.container.querySelectorAll('img').length;

	if( countImages < 1 ) {
		CanvasPortfolioDisplayItem();
	} else {
		core.imagesLoaded(core.getVars.portfolioAjax.container);
		core.getVars.portfolioAjax.container.addEventListener( 'CanvasImagesLoaded', () => {
			CanvasPortfolioDisplayItem();
		});
	}
};

const CanvasPortfolioDisplayItem = () => {
	const core = SEMICOLON.Core;

	core.getVars.portfolioAjax.container.style.display = 'block';
	core.getVars.portfolioAjax.wrapper.classList.add('portfolio-ajax-opened');
	core.getVars.elBody.classList.remove('portfolio-ajax-loading');
	// core.getVars.portfolioAjax.loader.classList.remove('loader-overlay-display');
	setTimeout( () => {
		core.runContainerModules( core.getVars.portfolioAjax.wrapper );
		window.scrollTo({
			top: core.getVars.portfolioAjax.wrapperOffset - core.getVars.topScrollOffset - 60,
			behavior: 'smooth'
		});
	}, 500);
}

const CanvasPortfolioGetNextItem = portPostId => {
	let portNext = false;
	let hasNext = document.getElementById(portPostId).nextElementSibling;
	if( hasNext ) {
		portNext = hasNext.getAttribute('id');
	}
	return portNext;
};

const CanvasPortfolioGetPrevItem = portPostId => {
	let portPrev = false;
	let hasPrev = document.getElementById(portPostId).previousElementSibling;
	if( hasPrev ) {
		portPrev = hasPrev.getAttribute('id');
	}
	return portPrev;
};

const CanvasPortfolioInitializeAjax = portPostId => {
	const core = SEMICOLON.Core;
	core.getVars.portfolioAjax.prevItem = document.getElementById(portPostId);

	CanvasPortfolioNewNextPrev(portPostId);

	document.querySelectorAll('#next-portfolio, #prev-portfolio').forEach( el => {
		el.onclick = e => {
			CanvasPortfolioCloseItem();

			let portPostId = el.getAttribute('data-id');
			document.getElementById(portPostId).classList.add('portfolio-active');
			CanvasPortfolioLoadItem(portPostId, core.getVars.portfolioAjax.prevItem);
			e.preventDefault();
		};
	})

	document.getElementById('close-portfolio').onclick = e => {
		CanvasPortfolioCloseItem();
		e.preventDefault();
	};
};

