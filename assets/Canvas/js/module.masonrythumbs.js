export default function( selector ) {
	const core = SEMICOLON.Core;
    core.isFuncTrue( () => typeof Isotope !== 'undefined' ).then( cond => {
        if( !cond ) {
            return false;
        }

		core.initFunction({ class: 'has-plugin-masonrythumbs', event: 'pluginMasonryThumbsReady' });

		selector = core.getSelector( selector );
		if( selector.length < 1 ){
			return true;
		}

		let $body = jQuery('body');

		selector.each( function() {
			let element = jQuery(this),
				elChildren = element.children(),
				elBig = element.attr('data-big');

			if( elChildren.length < 1 ) {
				return false;
			}

			elChildren.removeClass('grid-item-big').css({ 'width': '' });

			let compStyle = window.getComputedStyle( elChildren.eq(0)[0] );
			let firstElementWidth = Number(compStyle.getPropertyValue('width').split('px')[0]);

			if( element.filter('.has-init-isotope').length > 0 ) {
				element.isotope({
					masonry: {
						columnWidth: firstElementWidth
					}
				});
			}

			if( elBig ) {
				elBig = elBig.split(",");

				let elBigNum = '',
					bigi = '';

				for( bigi = 0; bigi < elBig.length; bigi++ ){
					elBigNum = Number(elBig[bigi]) - 1;
					elChildren.eq(elBigNum).addClass('grid-item-big');
				}
			}

			setTimeout( () => {
				element.find('.grid-item-big').css({ width: (firstElementWidth * 2) + 'px' });
			}, 500);

			setTimeout( () => {
				element.filter('.has-init-isotope').isotope( 'layout' );
			}, 1000);

			element[0].addEventListener( 'transitionend', () => {
				SEMICOLON.Modules.readmore();
			});
		});

		core.getVars.resizers.masonryThumbs = () => SEMICOLON.Modules.masonryThumbs();
	});
};
