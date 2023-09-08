( function (global, factory) {

	typeof exports === 'object' && typeof module !== 'undefined' ? module.exports = factory() :
	typeof define === 'function' && define.amd ? define(factory) :
	( global = typeof globalThis !== 'undefined' ? globalThis : global || self, global.SEMICOLON = factory() );

} ( this, ( () => {

	// USE STRICT
	"use strict";

	const options = {
		pageTransition: false,
		cursor: false,
		headerSticky: true,
		headerMobileSticky: false,
		menuBreakpoint: 992,
		pageMenuBreakpoint: 992,
		gmapAPI: '',
		scrollOffset: 60,
		scrollExternalLinks: true,
		jsFolder: '/assets/Canvas/js/',
		cssFolder: '/assets/Canvas/css/',
		jsLoadType: false,
	};
   
	const vars = {
		baseEl: document,
		elRoot: document.documentElement,
		elHead: document.head,
		elBody: document.body,
		hash: window.location.hash,
		topScrollOffset: 0,
		elWrapper: document.getElementById('wrapper'),
		elHeader: document.getElementById('header'),
		headerClasses: '',
		elHeaderWrap: document.getElementById('header-wrap'),
		headerWrapClasses: '',
		headerHeight: 0,
		headerOffset: 0,
		headerWrapHeight: 0,
		headerWrapOffset: 0,
		elPrimaryMenus: document.querySelectorAll('.primary-menu'),
		elPrimaryMenuTriggers: document.querySelectorAll('.primary-menu-trigger'),
		elPageMenu: document.getElementById('page-menu'),
		pageMenuOffset: 0,
		elSlider: document.getElementById('slider'),
		elFooter: document.getElementById('footer'),
		portfolioAjax: {},
		sliderParallax: {
			el: document.querySelector('.slider-parallax'),
			caption: document.querySelector('.slider-parallax .slider-caption'),
			inner: document.querySelector('.slider-inner'),
			offset: 0,
		},
		get menuBreakpoint() {
			return this.elBody.getAttribute('data-menu-breakpoint') || options.menuBreakpoint;
		},
		get pageMenuBreakpoint() {
			return this.elBody.getAttribute('data-pagemenu-breakpoint') || options.pageMenuBreakpoint;
		},
		get customCursor() {
			let value = this.elBody.getAttribute('data-custom-cursor') || options.cursor;
			return value == 'true' || value === true ? true : false;
		},
		get pageTransition() {
			let value = this.elBody.classList.contains('page-transition') || options.pageTransition;
			return value == 'true' || value === true ? true : false;
		},
		scrollPos: {
			x: 0,
			y: 0,
		},
		$jq: typeof jQuery !== "undefined" ? jQuery.noConflict() : '',
		resizers: {},
		recalls: {},
		debounced: false,
		events: {},
		modules: {},
		fn: {},
		required: {
			jQuery: {
				plugin: 'jquery',
				fn: () => typeof jQuery !== 'undefined',
				file: options.jsFolder+'jquery.js',
				id: 'canvas-jquery',
			}
		},
		fnInit: () => {
			DocumentOnReady.init();
			DocumentOnLoad.init();
			DocumentOnResize.init();
		}
	};

	const Core = function() {
		return {
			getOptions: options,
			getVars: vars,

			run: obj => {
				Object.values(obj).map(fn => typeof fn === 'function' && fn.call() );
			},

			runBase: () => {
				Core.run( Base );
			},

			runModules: () => {
				Core.run( Modules );
			},

			runContainerModules: parent => {
				if( typeof parent === 'undefined' ) {
					return false;
				}

				Core.getVars.baseEl = parent;
				Core.runModules();
				Core.getVars.baseEl = document;
			},

			breakpoints: () => {
				let viewWidth = Core.viewport().width;

				const breakpoint = {
					xxl: {
						enter: 1400,
						exit: 99999
					},
					xl: {
						enter: 1200,
						exit: 1399
					},
					lg: {
						enter: 992,
						exit: 1199.98
					},
					md: {
						enter: 768,
						exit: 991.98
					},
					sm: {
						enter: 576,
						exit: 767.98
					},
					xs: {
						enter: 0,
						exit: 575.98
					}
				};

				let previous = '';

				Object.keys( breakpoint ).forEach( key => {
					if ( (viewWidth > breakpoint[key].enter) && (viewWidth <= breakpoint[key].exit) ) {
						vars.elBody.classList.add( 'device-'+key );
					} else {
						vars.elBody.classList.remove( 'device-'+key );
						if( previous != '' ) {
							vars.elBody.classList.remove( 'device-down-'+previous );
						}
					}

					if ( viewWidth <= breakpoint[key].exit ) {
						if( previous != '' ) {
							vars.elBody.classList.add( 'device-down-'+previous );
						}
					}

					previous = key;

					if ( viewWidth > breakpoint[key].enter ) {
						vars.elBody.classList.add( 'device-up-'+key );
						return;
					} else {
						vars.elBody.classList.remove( 'device-up-'+key );
					}
				});
			},

			colorScheme: () => {
				if( vars.elBody.classList.contains('adaptive-color-scheme') ) {
					window.matchMedia('(prefers-color-scheme: dark)').matches ? vars.elBody.classList.add( 'dark' ) : vars.elBody.classList.remove('dark');
				}

				const bodyColorScheme = localStorage.getItem('cnvsBodyColorScheme');

				if( bodyColorScheme && bodyColorScheme != '' ) {
					bodyColorScheme.split(" ").includes('dark') ? vars.elBody.classList.add( 'dark' ) : vars.elBody.classList.remove( 'dark' );
				}
			},

			throttle: (callback, delay) => {
				let throttle = false;
				if (throttle) {
					return;
				}

				callback();
				throttle = true;

				setTimeout(function () {
					throttle = false;
				}, delay);
			},

			debounce: (callback, delay) => {
				clearTimeout(vars.debounced);
				vars.debounced = setTimeout(callback, delay);
			},

			debouncedResize: (func, delay) => {
				let timeoutId;
				return function () {
					const context = this;
					const args = arguments;
					clearTimeout(timeoutId);
					timeoutId = setTimeout(() => {
						func.apply(context, args);
					}, delay);
				};
			},

			addEvent: ( el, event, args = {} ) => {
				if( typeof el === "undefined" || typeof event === "undefined" ) {
					return;
				}

				var createEvent = new CustomEvent( event, {
					detail: args
				});

				el.dispatchEvent( createEvent );
				vars.events[event] = true;
			},

			scrollEnd: (callback, refresh = 199) => {
				if (!callback || typeof callback !== 'function') return;

				window.addEventListener( 'scroll', () => {
					Core.debounce( callback, refresh );
				}, { passive: true });
			},

			viewport: () => {
				const viewport = {
					width: window.innerWidth || vars.elRoot.clientWidth,
					height: window.innerHeight || vars.elRoot.clientHeight
				};

				return viewport;
			},

			getSelector: ( selector, jquery = true, customjs = true ) => {
				if( jquery ) {
					if( Core.getVars.baseEl !== document ) {
						selector = jQuery(Core.getVars.baseEl).find(selector);
					} else {
						selector = jQuery(selector);
					}

					if( customjs ) {
						if( typeof customjs == 'string' ) {
							selector = selector.filter(':not('+ customjs +')');
						} else {
							selector = selector.filter(':not(.customjs)');
						}
					}
				} else {
					if( customjs ) {
						if( typeof customjs == 'string' ) {
							selector = Core.getVars.baseEl.querySelectorAll(selector+':not('+customjs+')');
						} else {
							selector = Core.getVars.baseEl.querySelectorAll(selector+':not(.customjs)');
						}
					} else {
						selector = Core.getVars.baseEl.querySelectorAll(selector);
					}
				}

				return selector;
			},

			onResize: (callback, refresh = 333) => {
				if (!callback || typeof callback !== 'function') return;

				window.onresize = () => {
					Core.debounce( callback, refresh );
				};
			},

			imagesLoaded: el => {
				let imgs = el.getElementsByTagName('img') || document.images,
					len = imgs.length,
					counter = 0;

				if( len < 1 ) {
					Core.addEvent( el, 'CanvasImagesLoaded' );
				}

				const incrementCounter = async function() {
					counter++;
					if ( counter === len ) {
						Core.addEvent( el, 'CanvasImagesLoaded' );
					}
				};

				[].forEach.call( imgs, function( img ) {
					if( img.complete ) {
						incrementCounter();
					} else {
						img.addEventListener( 'load', incrementCounter, false );
					}
				});
			},

			contains: (classes, selector) => {
				let classArray = classes.split(" ");
				let hasClass = false;

				classArray.forEach( classTxt => {
					if( vars.elBody.classList.contains(classTxt) ) {
						hasClass = true;
					}
				});

				return hasClass;
			},

			has: (nodeList, selector) => {
				return [...nodeList]?.filter(e => e.querySelector(selector));
			},

			filtered: (nodeList, selector) => {
				return [...nodeList]?.filter(e => e.matches(selector));
			},

			parents: (elem, selector) => {
				if (!Element.prototype.matches) {
					Element.prototype.matches =
						Element.prototype.matchesSelector ||
						Element.prototype.mozMatchesSelector ||
						Element.prototype.msMatchesSelector ||
						Element.prototype.oMatchesSelector ||
						Element.prototype.webkitMatchesSelector ||
						function(s) {
							let matches = (this.document || this.ownerDocument).querySelectorAll(s),
								i = matches.length;
							while (--i >= 0 && matches.item(i) !== this) {}
							return i > -1;
						};
				}

				let parents = [];

				for ( ; elem && elem !== document; elem = elem.parentNode ) {
					if (selector) {
						if (elem.matches(selector)) {
							parents.push(elem);
						}
						continue;
					}
					parents.push(elem);
				}

				return parents;
			},

			siblings: (elem, nodes = false) => {
				if( nodes ) {
					return [...nodes].filter( sibling => {
						return sibling !== elem;
					});
				} else {
					return [...elem.parentNode.children].filter( sibling => {
						return sibling !== elem;
					});
				}
			},

			getNext: (elem, selector) => {
				let nextElem = elem.nextElementSibling;

				if( !selector ) {
					return nextElem;
				}

				if( nextElem && nextElem.matches(selector) ) {
					return nextElem;
				}

				return null;
			},

			offset: el => {
				let rect = el.getBoundingClientRect(),
					scrollLeft = window.pageXOffset || document.documentElement.scrollLeft,
					scrollTop = window.pageYOffset || document.documentElement.scrollTop;

				return { top: rect.top + scrollTop, left: rect.left + scrollLeft }
			},

			isHidden: el => {
				return (el.offsetParent === null);
			},

			classesFn: (func, classes, selector) => {
				let classArray = classes.split(" ");
				classArray.forEach( classTxt => {
					if( func == 'add' ) {
						selector.classList.add(classTxt);
					} else if( func == 'toggle' ) {
						selector.classList.toggle(classTxt);
					} else {
						selector.classList.remove(classTxt);
					}
				});
			},

			loadCSS: params => {
				const file = params.file;
				const htmlID = params.id || false;
				const cssFolder = params.cssFolder || false;

				if( !file ) {
					return false;
				}

				if( htmlID && document.getElementById(htmlID) ) {
					return false;
				}

				const htmlStyle = document.createElement('link');

				htmlStyle.id = htmlID;
				htmlStyle.href = cssFolder ? options.cssFolder+file : file;
				htmlStyle.rel = 'stylesheet';
				htmlStyle.type = 'text/css';

				vars.elHead.appendChild(htmlStyle);
				return true;
			},

			loadJS: params => {
				const file = params.file;
				const htmlID = params.id || false;
				const type = params.type || false;
				const callback = params.callback;
				const async = params.async || true;
				const defer = params.defer || true;
				const jsFolder = params.jsFolder || false;

				if( ! file ) {
					return false;
				}

				if( htmlID && document.getElementById(htmlID) ) {
					return false;
				}

				const htmlScript = document.createElement('script');

				if ( typeof callback !== 'undefined' ) {
					if( typeof callback != 'function' ) {
						throw new Error('Not a valid callback!');
					} else {
						htmlScript.onload = callback;
					}
				}

				htmlScript.id = htmlID;
				htmlScript.src = jsFolder ? options.jsFolder+file : file;
			// 	console.table({
			// 	   'htmlScript.src = jsFolder' :htmlScript.src = jsFolder,
         //       'options.jsFolder+file' :options.jsFolder+file,
         //       'file' : file
         // });
				if( type ) {
					htmlScript.type = type;
				}
				htmlScript.async = async ? true : false;
				htmlScript.defer = defer ? true : false;

				vars.elBody.appendChild(htmlScript);
				return true;
			},

			isFuncTrue: async fn => {
				if( 'function' !== typeof fn ) {
					return false;
				}

				var counter = 0;

				return new Promise((resolve, reject) => {
					if( fn() ) {
						resolve(true);
					} else {
						var int = setInterval( () => {
							if( fn() ) {
								clearInterval( int );
								resolve(true);
							} else {
								if( counter > 30 ) {
									clearInterval( int );
									reject(true);
								}
							}
							counter++;
						}, 333);
					}
				}).catch( error => console.log('Function does not exist: ' + fn) );
			},

			initFunction: params => {
				vars.elBody.classList.add( params.class );
				Core.addEvent( window, params.event );
				vars.events[params.event] = true;
			},

			runModule: params => {
				let type = (window.location.protocol == 'http:' || window.location.protocol == 'https:') ? 'module' : 'fn';

				if( options.jsLoadType && (options.jsLoadType == 'fn' || options.jsLoadType == 'module') ) {
					type = options.jsLoadType;
				}

				let moduleFile = (type == 'fn' ? options.jsFolder : './')+ type +'.' + params.plugin + '.js';

				if( params.file ) {
					moduleFile = params.file;
				}

				if( type == 'module' ) {
					import( moduleFile )
					.then( module => module.default(params.selector))
					.catch( error => {
						console.log( params.plugin + ': Module could not be loaded' );
						console.log( error );
					});
				} else {
					let pluginCheck = () => typeof Core.getVars.fn[params.plugin] !== 'undefined';
					if( !pluginCheck() ) {
						Core.loadJS({ file: moduleFile, id: 'canvas-'+params.plugin+'-fn' });
						Core.isFuncTrue(pluginCheck).then( cond => {
							if( !cond ) {
								return false;
							}
							Core.getVars.fn[params.plugin](params.selector);
						});
					} else {
						Core.getVars.fn[params.plugin](params.selector);
					}
				}

				return true;
			},

			initModule: params => {
				if( 'dependent' != params.selector ) {
					if( typeof params.selector === 'object' ) {
						if( params.selector instanceof jQuery ){
							params.selector = params.selector[0];
						}

						var _el = params.selector;
					} else {
						var _el = Core.getVars.baseEl.querySelectorAll( params.selector );
					}

					if( _el.length < 1 ) {
						return false;
					}
				}

				var required = true;
				var dependentActive = true;

				if( params.required && Array.isArray( params.required ) ) {
					var requireAll = {};
					params.required.forEach( req => requireAll[req.plugin] = !req.fn() ? false : true );

					params.required.forEach( req => {
						if( !req.fn() ) {
							required = false;
							const getjQuery = async function() {
								Core.loadJS({ file: req.file, id: req.id });

								var funcAvailable = new Promise( resolve => {
									var int = setInterval( () => {
										if( req.fn() ) {
											requireAll[req.plugin] = true;
											const allTrue = Object.values(requireAll).every( value => value === true );
											if( allTrue ) {
												clearInterval(int);
												resolve(true);
											}
										}
									}, 333);
								});

								required = await funcAvailable;
								Core.runModule( params );
							}();
						}
					});
				}

				if( typeof params.dependency !== 'undefined' && typeof params.dependency === 'function' ) {
					dependentActive = false;
					const runDependent = async function() {
						let depAvailable = new Promise( resolve => {
							if( params.dependency.call( params, 'dependent' ) == true ) {
								resolve(true);
							}
						});
						return await depAvailable;
					};
					dependentActive = runDependent();
				}

				if( required && dependentActive ) {
					Core.runModule( params );
				}

				return true;
			},

			topScrollOffset: () =>  {
				let topOffsetScroll = 0;
				let pageMenuOffset = vars.elPageMenu?.querySelector('#page-menu-wrap')?.offsetHeight || 0;

				if( vars.elBody.classList.contains('is-expanded-menu') ) {
					if( vars.elHeader?.classList.contains('sticky-header') ) {
						topOffsetScroll = vars.elHeaderWrap.offsetHeight;
					}

					if( vars.elPageMenu?.classList.contains('dots-menu') ) {
						pageMenuOffset = 0;
					}
				}

				topOffsetScroll = topOffsetScroll + pageMenuOffset;

				Core.getVars.topScrollOffset = topOffsetScroll + options.scrollOffset;
			},
		};
	}();

	const Base = function() {
		return {
			init: () => {
				SEMICOLON.Mobile.any() && vars.elBody.classList.add('device-touch');
			},

			menuBreakpoint: () => {
				if( Core.getVars.menuBreakpoint <= Core.viewport().width ) {
					vars.elBody.classList.add( 'is-expanded-menu' );
				} else {
					vars.elBody.classList.remove( 'is-expanded-menu' );
				}

				if( vars.elPageMenu ) {
					if( typeof Core.getVars.pageMenuBreakpoint === 'undefined' ) {
						Core.getVars.pageMenuBreakpoint = Core.getVars.menuBreakpoint;
					}

					if( Core.getVars.pageMenuBreakpoint <= Core.viewport().width ) {
						vars.elBody.classList.add( 'is-expanded-pagemenu' );
					} else {
						vars.elBody.classList.remove( 'is-expanded-pagemenu' );
					}
				}
			},

			goToTop: () => {
				return Core.initModule({ selector: '#gotoTop', plugin: 'gototop' });
			},

			stickFooterOnSmall: () => {
				return Core.initModule({ selector: '#footer', plugin: 'stickfooteronsmall' });
			},

			logo: () => {
				return Core.initModule({ selector: '#logo', plugin: 'logo' });
			},

			setHeaderClasses: () => {
				Core.getVars.headerClasses = vars.elHeader?.className || '';
				Core.getVars.headerWrapClasses = vars.elHeaderWrap?.className || '';
			},

			headers: () => {
				return Core.initModule({ selector: '#header', plugin: 'headers' });
			},

			menus: () => {
				return Core.initModule({ selector: '#header', plugin: 'menus' });
			},

			pageMenu: () => {
				return Core.initModule({ selector: '#page-menu', plugin: 'pagemenu' });
			},

			sliderDimensions: () => {
				return Core.initModule({ selector: '.slider-element', plugin: 'sliderdimensions' });
			},

			sliderMenuClass: () => {
				return Core.initModule({ selector: '.transparent-header + .swiper_wrapper,.swiper_wrapper + .transparent-header,.transparent-header + .revslider-wrap,.revslider-wrap + .transparent-header', plugin: 'slidermenuclass' });
			},

			topSearch: () => {
				return Core.initModule({ selector: '#top-search-trigger', plugin: 'search' });
			},

			topCart: () => {
				return Core.initModule({ selector: '#top-cart', plugin: 'topcart' });
			},

			sidePanel: () => {
				return Core.initModule({ selector: '#side-panel', plugin: 'sidepanel' });
			},

			adaptiveColorScheme: () => {
				return Core.initModule({ selector: '.adaptive-color-scheme', plugin: 'adaptivecolorscheme' });
			},

			portfolioAjax: () => {
				return Core.initModule({ selector: '.portfolio-ajax', plugin: 'ajaxportfolio' });
			},

			cursor: () => {
				if( vars.customCursor ) {
					return Core.initModule({ selector: 'body', plugin: 'cursor' });
				}
			},

			setBSTheme: () => {
				if( vars.elBody.classList.contains('dark') ) {
					document.querySelector('html').setAttribute('data-bs-theme', 'dark');
				} else {
					document.querySelector('html').removeAttribute('data-bs-theme');
					document.querySelectorAll('.dark')?.forEach(el => el.setAttribute('data-bs-theme', 'dark'));
				}

				vars.elBody.querySelectorAll('.not-dark')?.forEach(el => el.setAttribute('data-bs-theme', 'light'));
			}
		}
	}();

	const Modules = function() {
		return {
			easing: () => {
				return Core.initModule({ selector: '[data-easing]', plugin: 'easing', required: [ vars.required.jQuery ] });
			},

			bootstrap: () => {
				let notExec = true;
				document.querySelectorAll('*').forEach( el => notExec && el.getAttributeNames().some( text => {
					if( text.includes('data-bs') ) {
						notExec = false;
						return Core.initModule({ selector: 'body', plugin: 'bootstrap' });
					}
				}));
			},

			resizeVideos: element => {
				return Core.initModule({ selector: element ? element : 'iframe[src*="youtube"],iframe[src*="vimeo"],iframe[src*="dailymotion"],iframe[src*="maps.google.com"],iframe[src*="google.com/maps"]', plugin: 'fitvids', required: [ vars.required.jQuery ] });
			},

			pageTransition: () => {
				if( vars.pageTransition ) {
					return Core.initModule({ selector: 'body', plugin: 'pagetransition' });
				}
			},

			lazyLoad: element => {
				return Core.initModule({ selector: element ? element : '.lazy:not(.lazy-loaded)', plugin: 'lazyload' });
			},

			dataClasses: () => {
				return Core.initModule({ selector: '[data-class]', plugin: 'dataclasses' });
			},

			dataHeights: () => {
				return Core.initModule({ selector: '[data-height-xxl],[data-height-xl],[data-height-lg],[data-height-md],[data-height-sm],[data-height-xs]', plugin: 'dataheights' });
			},

			lightbox: element => {
				return Core.initModule({ selector: element ? element : '[data-lightbox]', plugin: 'lightbox', required: [ vars.required.jQuery ] });
			},

			modal: element => {
				return Core.initModule({ selector: element ? element : '.modal-on-load', plugin: 'modal', required: [ vars.required.jQuery ] });
			},

			parallax: element => {
				return Core.initModule({ selector: element ? element : '.parallax .parallax-bg,.parallax .parallax-element', plugin: 'parallax' });
			},

			animations: element => {
				return Core.initModule({ selector: element ? element : '[data-animate]', plugin: 'animations' });
			},

			hoverAnimations: element => {
				return Core.initModule({ selector: element ? element : '[data-hover-animate]', plugin: 'hoveranimation' });
			},

			gridInit: element => {
				return Core.initModule({ selector: element ? element : '.grid-container', plugin: 'isotope', required: [ vars.required.jQuery ] });
			},

			filterInit: element => {
				return Core.initModule({ selector: element ? element : '.grid-filter,.custom-filter', plugin: 'gridfilter', required: [ vars.required.jQuery ] });
			},

			canvasSlider: element => {
				return Core.initModule({ selector: element ? element : '.swiper_wrapper', plugin: 'swiper' });
			},

			sliderParallax: () => {
				return Core.initModule({ selector: '.slider-parallax', plugin: 'sliderparallax' });
			},

			flexSlider: element => {
				return Core.initModule({ selector: element ? element : '.fslider', plugin: 'flexslider', required: [ vars.required.jQuery ] });
			},

			html5Video: element => {
				return Core.initModule({ selector: element ? element : '.video-wrap', plugin: 'html5video' });
			},

			youtubeBgVideo: element => {
				return Core.initModule({ selector: element ? element : '.yt-bg-player', plugin: 'youtube', required: [ vars.required.jQuery ] });
			},

			toggle: element => {
				return Core.initModule({ selector: element ? element : '.toggle', plugin: 'toggles' });
			},

			accordion: element => {
				return Core.initModule({ selector: element ? element : '.accordion', plugin: 'accordions', required: [ vars.required.jQuery ] });
			},

			counter: element => {
				return Core.initModule({ selector: element ? element : '.counter', plugin: 'counter', required: [ vars.required.jQuery ] });
			},

			countdown: element => {
				return Core.initModule({ selector: element ? element : '.countdown', plugin: 'countdown', required: [ vars.required.jQuery ] });
			},

			gmap: element => {
				return Core.initModule({ selector: element ? element : '.gmap', plugin: 'gmap', required: [ vars.required.jQuery ] });
			},

			roundedSkill: element => {
				return Core.initModule({ selector: element ? element : '.rounded-skill', plugin: 'piechart', required: [ vars.required.jQuery ] });
			},

			progress: element => {
				return Core.initModule({ selector: element ? element : '.skill-progress', plugin: 'progress' });
			},

			twitterFeed: element => {
				return Core.initModule({ selector: element ? element : '.twitter-feed', plugin: 'twitter', required: [ vars.required.jQuery ] });
			},

			flickrFeed: element => {
				return Core.initModule({ selector: element ? element : '.flickr-feed', plugin: 'flickrfeed', required: [ vars.required.jQuery ] });
			},

			instagram: element => {
				return Core.initModule({ selector: element ? element : '.instagram-photos', plugin: 'instagram' });
			},

			// Dribbble Pending

			navTree: element => {
				return Core.initModule({ selector: element ? element : '.nav-tree', plugin: 'navtree', required: [ vars.required.jQuery ] });
			},

			carousel: element => {
				return Core.initModule({ selector: element ? element : '.carousel-widget', plugin: 'carousel', required: [ vars.required.jQuery ] });
			},

			masonryThumbs: element => {
				return Core.initModule({ selector: element ? element : '.masonry-thumbs', plugin: 'masonrythumbs', required: [ vars.required.jQuery ] });
			},

			notifications: element => {
				return Core.initModule({ selector: element ? element : false, plugin: 'notify', required: [ vars.required.jQuery ] });
			},

			textRotator: element => {
				return Core.initModule({ selector: element ? element : '.text-rotater', plugin: 'textrotator', required: [ vars.required.jQuery ] });
			},

			onePage: element => {
				return Core.initModule({ selector: element ? element : '[data-scrollto],.one-page-menu', plugin: 'onepage' });
			},

			ajaxForm: element => {
				return Core.initModule({ selector: element ? element : '.form-widget', plugin: 'ajaxform', required: [ vars.required.jQuery ] });
			},

			subscribe: element => {
				return Core.initModule({ selector: element ? element : '.subscribe-widget', plugin: 'subscribe', required: [ vars.required.jQuery ] });
			},

			conditional: element => {
				return Core.initModule({ selector: element ? element : '.form-group[data-condition],.form-group[data-conditions]', plugin: 'conditional' });
			},

			shapeDivider: element => {
				return Core.initModule({ selector: element ? element : '.shape-divider', plugin: 'shapedivider' });
			},

			stickySidebar: element => {
				return Core.initModule({ selector: element ? element : '.sticky-sidebar-wrap', plugin: 'stickysidebar', required: [ vars.required.jQuery ] });
			},

			cookies: element => {
				return Core.initModule({ selector: element ? element : '.gdpr-settings,[data-cookies]', plugin: 'cookie' });
			},

			quantity: element => {
				return Core.initModule({ selector: element ? element : '.quantity', plugin: 'quantity' });
			},

			readmore: element => {
				return Core.initModule({ selector: element ? element : '[data-readmore]', plugin: 'readmore' });
			},

			pricingSwitcher: element => {
				return Core.initModule({ selector: element ? element : '.pts-switcher', plugin: 'pricingswitcher' });
			},

			ajaxButton: element => {
				return Core.initModule({ selector: element ? element : '[data-ajax-loader]', plugin: 'ajaxbutton' });
			},

			videoFacade: element => {
				return Core.initModule({ selector: element ? element : '.video-facade', plugin: 'videofacade' });
			},

			schemeToggler: element => {
				return Core.initModule({ selector: element ? element : '.body-scheme-toggle', plugin: 'schemetoggler' });
			},

			clipboardCopy: element => {
				return Core.initModule({ selector: element ? element : '.clipboard-copy', plugin: 'clipboard' });
			},

			codeHighlight: element => {
				return Core.initModule({ selector: element ? element : '.code-highlight', plugin: 'codehighlight' });
			},

			viewportDetect: element => {
				return Core.initModule({ selector: element ? element : '.viewport-detect', plugin: 'viewportdetect' });
			},

			bsComponents: element => {
				return Core.initModule({ selector: element ? element : '[data-bs-toggle="tooltip"],[data-bs-toggle="popover"],[data-bs-toggle="tab"],[data-bs-toggle="pill"],.style-msg', plugin: 'bscomponents' });
			}
		};
	}();

	const Mobile = function() {
		return {
			Android: () =>  {
				return navigator.userAgent.match(/Android/i);
			},
			BlackBerry: () =>  {
				return navigator.userAgent.match(/BlackBerry/i);
			},
			iOS: () =>  {
				return navigator.userAgent.match(/iPhone|iPad|iPod/i);
			},
			Opera: () =>  {
				return navigator.userAgent.match(/Opera Mini/i);
			},
			Windows: () =>  {
				return navigator.userAgent.match(/IEMobile/i);
			},
			any: () =>  {
				return (Mobile.Android() || Mobile.BlackBerry() || Mobile.iOS() || Mobile.Opera() || Mobile.Windows());
			}
		}
	}();

	// Add your Custom JS Codes here
	const Custom = function() {
		return {
			onReady: () => {
				// Add JS Codes here to Run on Document Ready
			},

			onLoad: () => {
				// Add JS Codes here to Run on Window Load
			},

			onResize: () => {
				// Add JS Codes here to Run on Window Resize
			}
		}
	}();

	const DocumentOnResize = function() {
		return {
			init: () => {
				Core.viewport();
				Core.breakpoints();
				Base.menuBreakpoint();

				Core.run( vars.resizers );

				Custom.onResize();

				Core.addEvent( window, 'cnvsResize' );
			}
		}
	}();

	const DocumentOnReady = function() {
		return {
			init: () => {
				Core.breakpoints();
				Core.colorScheme();
				Core.runBase();
				Core.runModules();
				Core.topScrollOffset();

				DocumentOnReady.windowscroll();

				Custom.onReady();
			},

			windowscroll: () => {
				Core.scrollEnd( () => {
					Base.pageMenu();
				});
			}
		}
	}();

	const DocumentOnLoad = function() {
		return {
			init: () => {
				Custom.onLoad();
			}
		};
	}();

	document.addEventListener( 'DOMContentLoaded', () => {
		DocumentOnReady.init();
	});

	window.onload = () => {
		DocumentOnLoad.init();
	};

	const resizeFunctions = Core.debouncedResize(() => {
		DocumentOnResize.init();
	}, 250);

	window.addEventListener('resize', () => {
		resizeFunctions();
	});

	const canvas_umd = {
		Core,
		Base,
		Modules,
		Mobile,
		Custom,
	};

	return canvas_umd;
})));
