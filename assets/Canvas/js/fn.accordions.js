SEMICOLON.Core.getVars.fn.accordions = selector => {
	const core = SEMICOLON.Core;
	core.initFunction({ class: 'has-plugin-accordions', event: 'pluginAccordionsReady' });

	selector = core.getSelector( selector );
	if( selector.length < 1 ){
		return true;
	}

	selector.each( function(){
		let element = jQuery(this),
			elState = element.attr('data-state'),
			elActive = element.attr('data-active') || 1,
			elActiveClass = element.attr('data-active-class') || '',
			elCollapsible = element.attr('data-collapsible') || 'false',
			windowHash = location.hash,
			accActive;

		elActive = Number( elActive ) - 1;

		if( typeof windowHash !== 'undefined' && windowHash != '' ) {
			accActive = element.find('.accordion-header'+ windowHash);
			if( accActive.length > 0 ) {
				elActive = accActive.index() / 2;
			}
		}

		element.find('.accordion-content').hide();

		if( elState != 'closed' ) {
			element.find('.accordion-header:eq('+ Number(elActive) +')').addClass('accordion-active ' + elActiveClass).next().show();
		}

		element.find('.accordion-header').off( 'click' ).on( 'click', function(){
			let clickTarget = jQuery(this);
			if( clickTarget.next().is(':hidden') ) {
				element.find('.accordion-header').removeClass('accordion-active ' + elActiveClass).next().slideUp("normal");
				clickTarget.toggleClass('accordion-active ' + elActiveClass, true).next().stop(true,true).slideDown("normal", function(){
					if( ( jQuery('body').hasClass('device-sm') || jQuery('body').hasClass('device-xs') ) && element.hasClass('scroll-on-open') ) {
						jQuery('html,body').stop(true,true).animate({
							'scrollTop': clickTarget.offset().top - ( SEMICOLON.initialize.topScrollOffset() - 40 )
						}, 800, 'easeOutQuad' );
					}

					core.runContainerModules( clickTarget.next()[0] );
				});
			} else {
				if( elCollapsible == 'true' ) {
					clickTarget.toggleClass('accordion-active ' + elActiveClass, false).next().stop(true,true).slideUp("normal");
				}
			}
			return false;
		});
	});
};
