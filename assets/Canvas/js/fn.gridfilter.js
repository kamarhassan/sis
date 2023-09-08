SEMICOLON.Core.getVars.fn.gridfilter = selector => {
	const core = SEMICOLON.Core;
	core.isFuncTrue( () => typeof Isotope !== 'undefined' ).then( cond => {
		if( !cond ) {
			return false;
		}

		core.initFunction({ class: 'has-plugin-isotope-filter', event: 'pluginGridFilterReady' });

		selector = core.getSelector( selector );
		if( selector.length < 1 ){
			return true;
		}

		selector.each( function(){
			let element = jQuery(this),
				elCon = element.attr('data-container'),
				elActClass = element.attr('data-active-class'),
				elDefFilter = element.attr('data-default');

			if( !elActClass ) {
				elActClass = 'activeFilter';
			}

			if( !jQuery(elCon).hasClass('grid-container') ) {
				return false;
			}

			element.find('a').off( 'click' ).on( 'click', function(){
				element.find('li').removeClass( elActClass );
				jQuery(this).parent('li').addClass( elActClass );
				let selector = jQuery(this).attr('data-filter');
				jQuery(elCon).isotope({ filter: selector });
				return false;
			});

			if( elDefFilter ) {
				element.find('li').removeClass( elActClass );
				element.find('[data-filter="'+ elDefFilter +'"]').parent('li').addClass( elActClass );
				jQuery(elCon).isotope({ filter: elDefFilter });
			}

			jQuery(elCon).on( 'arrangeComplete layoutComplete', function(event, filteredItems) {
				jQuery(elCon).addClass('grid-container-filterable');
				if( jQuery(elCon).attr('data-lightbox') == 'gallery' ) {
					jQuery(elCon).find("[data-lightbox]").removeClass('grid-lightbox-filtered');
					filteredItems.forEach(item => jQuery(item.element).find("[data-lightbox]").addClass('grid-lightbox-filtered'));
				}
				SEMICOLON.Modules.lightbox();
			});
		});

		jQuery('.grid-shuffle').off( 'click' ).on( 'click', function(){
			let element = jQuery(this),
				elCon = element.attr('data-container');

			if( !jQuery(elCon).hasClass('grid-container') ) {
				return false;
			}

			jQuery(elCon).isotope('shuffle');
		});
	});
};
