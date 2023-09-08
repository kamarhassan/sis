export default function( selector ) {
    const core = SEMICOLON.Core;
    core.loadJS({ file: 'plugins.isotope.js', id: 'canvas-isotope-js', jsFolder: true });
    core.isFuncTrue( () => typeof Isotope !== 'undefined' ).then( cond => {
        if( !cond ) {
            return false;
        }

        core.initFunction({ class: 'has-plugin-isotope', event: 'pluginIsotopeReady' });

    	selector = core.getSelector( selector );
    	if( selector.length < 1 ){
    		return true;
    	}

    	selector.each( function(){
    		let element = jQuery(this),
    			elTransition = element.attr('data-transition') || '0.65s',
    			elLayoutMode = element.attr('data-layout') || 'masonry',
    			elStagger = element.attr('data-stagger') || 0,
    			elBase = element.attr('data-basewidth') || '.portfolio-item:not(.wide):eq(0)',
    			elOriginLeft = true,
    			elGrid;

    		if( jQuery('body').hasClass('rtl') ) {
                elOriginLeft = false;
            }

    		if( element.hasClass('portfolio') || element.hasClass('post-timeline') ){
    			elGrid = element.isotope({
    				layoutMode: elLayoutMode,
    				isOriginLeft: elOriginLeft,
    				transitionDuration: elTransition,
    				stagger: Number( elStagger ),
    				percentPosition: true,
    				masonry: {
    					columnWidth: element.find( elBase )[0]
    				}
    			});
    		} else {
    			elGrid = element.isotope({
    				layoutMode: elLayoutMode,
    				isOriginLeft: elOriginLeft,
    				transitionDuration: elTransition,
    				stagger: Number( elStagger ),
    				percentPosition: true,
    			});
    		}

    		if( element.data('isotope') ) {
    			element.addClass('has-init-isotope');
    		}

    		let elementInterval = setInterval( function(){
    			if( element.find('.lazy.lazy-loaded').length == element.find('.lazy').length ) {
    				setTimeout( function(){
    					element.filter('.has-init-isotope').isotope('layout');
    				}, 800 );
    				clearInterval( elementInterval );
    			}
    		}, 1000);

    		jQuery(window).on( 'lazyLoadLoaded', function(){
    			element.filter('.has-init-isotope').isotope('layout');
    		});

			core.getVars.resizers.isotope = () => {
				element.filter('.has-init-isotope').isotope('layout');
			};
    	});
    });
};
