export default function( selector ) {
	const core = SEMICOLON.Core;
	core.loadJS({ file: 'plugins.piechart.js', id: 'canvas-piechart-js', jsFolder: true });
	core.isFuncTrue( () => jQuery().easyPieChart ).then( cond => {
		if( !cond ) {
			return false;
		}

		core.initFunction({ class: 'has-plugin-piechart', event: 'pluginRoundedSkillReady' });

		selector = core.getSelector( selector );
		if( selector.length < 1 ){
			return true;
		}

		selector.each(function(){
			let element = jQuery(this),
				elSize = element.attr('data-size') || 140,
				elSpeed = element.attr('data-speed') || 2000,
				elWidth = element.attr('data-width') || 4,
				elColor = element.attr('data-color') || '#0093BF',
				elTrackColor = element.attr('data-trackcolor') || 'rgba(0,0,0,0.04)';

			let properties = {
				size: Number( elSize ),
				speed: Number( elSpeed ),
				width: Number( elWidth ),
				color: elColor,
				trackcolor:	elTrackColor
			};

			element.css({ 'width': elSize+'px', 'height': elSize+'px', 'line-height': elSize+'px' });

			if( jQuery('body').hasClass('device-xl') || jQuery('body').hasClass('device-lg') ){
				element.animate({opacity:0}, 10);
				let observer = new IntersectionObserver( function(entries, observer){
					entries.forEach( function(entry){
						if (entry.isIntersecting) {
							if (!element.hasClass('skills-animated')) {
								var t = setTimeout( function(){ element.css({opacity: 1}); }, 100 );
								CanvasRunSkills( element, properties );
								element.addClass('skills-animated');
							}
							observer.unobserve( entry.target );
						}
					});
				}, {rootMargin: '-50px'});
				observer.observe( element[0] );
			} else {
				CanvasRunSkills( element, properties );
			}
		});
	});
};

const CanvasRunSkills = ( element, properties ) => {
	element.easyPieChart({
		size: properties.size,
		animate: properties.speed,
		scaleColor: false,
		trackColor: properties.trackcolor,
		lineWidth: properties.width,
		lineCap: 'square',
		barColor: properties.color
	});
};
