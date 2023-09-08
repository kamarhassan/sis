SEMICOLON.Core.getVars.fn.subscribe = selector => {
	const core = SEMICOLON.Core;
	core.loadJS({ file: 'plugins.form.js', id: 'canvas-form-js', jsFolder: true });
	core.isFuncTrue( () => jQuery().validate && jQuery().ajaxSubmit ).then( cond => {
		if( !cond ) {
			return false;
		}

		core.initFunction({ class: 'has-plugin-form', event: 'pluginFormReady' });

		selector = core.getSelector( selector );
		if( selector.length < 1 ){
			return true;
		}

		selector.each( function(){
			let element = jQuery(this),
				elAlert = element.attr('data-alert-type'),
				elLoader = element.attr('data-loader'),
				elResult = element.find('.widget-subscribe-form-result'),
				elRedirect = element.attr('data-redirect'),
				defButton, defButtonText, alertType;

			element.find('form').validate({
				submitHandler: function(form) {

					elResult.hide();

					if( elLoader == 'button' ) {
						defButton = jQuery(form).find('button');
						defButtonText = defButton.html();

						defButton.html('<i class="bi-arrow-repeat icon-spin nomargin"></i>');
					} else {
						jQuery(form).find('.bi-envelope-plus').removeClass('bi-envelope-plus').addClass('bi-arrow-repeat icon-spin');
					}

					jQuery(form).ajaxSubmit({
						target: elResult,
						dataType: 'json',
						resetForm: true,
						success: function( data ) {
							if( elLoader == 'button' ) {
								defButton.html( defButtonText );
							} else {
								jQuery(form).find('.bi-arrow-repeat').removeClass('bi-arrow-repeat icon-spin').addClass('bi-envelope-plus');
							}
							if( data.alert != 'error' && elRedirect ){
								window.location.replace( elRedirect );
								return true;
							}
							if( elAlert == 'inline' ) {
								if( data.alert == 'error' ) {
									alertType = 'alert-danger';
								} else {
									alertType = 'alert-success';
								}

								elResult.addClass( 'alert ' + alertType ).html( data.message ).slideDown( 400 );
							} else {
								elResult.attr( 'data-notify-type', data.alert ).attr( 'data-notify-msg', data.message ).html('');
								SEMICOLON.Modules.notifications(elResult);
							}
						}
					});
				}
			});

		});
	});
};
