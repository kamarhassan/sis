export default function( selector ) {
	const core = SEMICOLON.Core;
	core.initFunction({ class: 'has-plugin-navtree', event: 'pluginNavTreeReady' });

    selector = core.getSelector( selector );
	if( selector.length < 1 ){
		return true;
	}

	selector.each( function(){
		let element = jQuery(this),
			elSpeed = element.attr('data-speed') || 250,
			elEasing = element.attr('data-easing') || 'swing';

		element.find( 'ul li:has(ul)' ).addClass('sub-menu');
		element.find( 'ul li:has(ul) > a' ).filter(':not(:has(.fa-caret-right))').append( '<i class="fa-solid fa-caret-right"></i>' );

		if( element.hasClass('on-hover') ){
			element.find( 'ul li:has(ul):not(.active)' ).hover( function(e){
				jQuery(this).children('ul').stop(true, true).slideDown( Number(elSpeed), elEasing);
			}, function(){
				jQuery(this).children('ul').delay(250).slideUp( Number(elSpeed), elEasing);
			});
		} else {
			element.find( 'ul li:has(ul) > a' ).off( 'click' ).on( 'click', function(e){
				let childElement = jQuery(this);
				element.find( 'ul li' ).not(childElement.parents()).removeClass('active');
				childElement.parent().children('ul').slideToggle( Number(elSpeed), elEasing, function(){
					jQuery(this).find('ul').hide();
					jQuery(this).find('li.active').removeClass('active');
				});
				element.find( 'ul li > ul' ).not(childElement.parent().children('ul')).not(childElement.parents('ul')).slideUp( Number(elSpeed), elEasing );
				childElement.parent('li:has(ul)').toggleClass('active');
				e.preventDefault();
			});
		}
	});
};
