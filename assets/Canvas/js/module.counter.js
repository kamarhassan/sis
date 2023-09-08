export default function( selector ) {
	const core = SEMICOLON.Core;
	core.loadJS({ file: 'plugins.counter.js', id: 'canvas-counter-js', jsFolder: true });
	core.isFuncTrue( () => jQuery().countTo ).then( cond => {
		if( !cond ) {
			return false;
		}

		core.initFunction({ class: 'has-plugin-counter', event: 'pluginCounterReady' });

		selector = core.getSelector( selector );
		if( selector.length < 1 ){
			return true;
		}

		selector.each(function(){
			let element = jQuery(this),
				elComma = element.find('span').attr('data-comma'),
				elSep = element.find('span').attr('data-sep') || ',',
				elPlaces = element.find('span').attr('data-places') || 3;

			let elCommaObj = {
				comma: elComma,
				sep: elSep,
				places: Number( elPlaces )
			}

			if( element.hasClass('counter-instant') ) {
				CanvasRunCounter( element, elCommaObj );
				return;
			}

			let observer = new IntersectionObserver( (entries, observer) => {
				entries.forEach( entry => {
					if (entry.isIntersecting) {
						CanvasRunCounter( element, elCommaObj );
						observer.unobserve( entry.target );
					}
				});
			}, {rootMargin: '-50px'});
			observer.observe( element[0] );
		});
	});
};

const CanvasRunCounter = ( elCounter, elFormat ) => {
	if( elFormat.comma == 'true' ) {

		let reFormat = '\\B(?=(\\d{'+ elFormat.places +'})+(?!\\d))',
			regExp = new RegExp( reFormat, "g" );

		elCounter.find('span').countTo({
			formatter: (value, options) => {
				value = value.toFixed( options.decimals );
				value = value.replace( regExp, elFormat.sep );
				return value;
			}
		});
	} else {
		elCounter.find('span').countTo();
	}
};

