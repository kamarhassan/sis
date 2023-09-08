class ButtonElement extends SuperElement {
    name() {
        return getI18n('button');
    }

    icon() {
        return 'fal fa-minus-square';
    }

    getControls() {
        var element = this;
        var link = element.obj.parent().length && element.obj.parent().is("a") ? element.obj.parent().attr('href') : '';

        return [            
            new TextControl(getI18n('text'), element.obj.html(), function(text) {
                element.obj.html(text);
            }),
            new ButtonControl(getI18n('button_style'), element.obj.attr('data-style'), function(thisControl, style) {
                element.obj.attr('data-style', style);
                thisControl.applyStyle(element.obj, style);
            }),
            new ActionButtonControl(getI18n('action'), {name: element.obj.attr('name'), data_action: element.obj.attr('href')}, function(options) {
                element.obj.attr('name', options.name);
                if (element.obj.parent().is("a")) {
                    // element.obj.attr('onclick', 'window.location=`' + options.url + '`');
                    element.obj.parent().attr('href', options.data_action);
                } else if (element.obj.is("a")) {
                    element.obj.attr('href', options.data_action);
                } else {
                    element.obj.wrap( "<a href='" + options.data_action + "'></a>" );
                }
                element.obj.attr('type', 'submit');
            }),
            new ButtonOptionControl(
                getI18n('button_actions'),
                {
                    background_color: element.obj.css('background-color'),
                    text_color: element.obj.css('color'),
                    align: element.obj.css('float'),
                    line_height: element.obj.css('line-height'),
                    border_radius: element.obj.css('border-radius'),
                    border_style: element.obj.css('border-style'),
                    border_width: element.obj.css('border-width'),
                    border_color: element.obj.css('border-color'),
                    border_top_style: element.obj.css('border-top-style'),
                    border_top_width: element.obj.css('border-top-width'),
                    border_top_color: element.obj.css('border-top-color'),
                    border_right_style: element.obj.css('border-right-style'),
                    border_right_width: element.obj.css('border-right-width'),
                    border_right_color: element.obj.css('border-right-color'),
                    border_bottom_style: element.obj.css('border-bottom-style'),
                    border_bottom_width: element.obj.css('border-bottom-width'),
                    border_bottom_color: element.obj.css('border-bottom-color'),
                    border_left_style: element.obj.css('border-left-style'),
                    border_left_width: element.obj.css('border-left-width'),
                    border_left_color: element.obj.css('border-left-color'),
                    width_button: element.obj.css('width')
                },
                function(options) {
                    if (typeof(options.background_color) !== 'undefined') {
                        element.obj.css('background-color', options.background_color);
                    }

                    if (typeof(options.text_color) !== 'undefined') {
                        element.obj.css('color', options.text_color);
                    }
                    
                    if (typeof(options.align) !== 'undefined') {
                        element.obj.parent().removeClass('text-center'); element.obj.parent().css('text-align', options.align).css('display', 'block');
                    }

                    if (typeof(options.line_height) !== 'undefined') {
                        element.obj.css('line-height', options.line_height);
                    }

                    if (typeof(options.border_radius) !== 'undefined') {
                        element.obj.css('border-radius', options.border_radius);
                    }

                    if (typeof(options.border_style) !== 'undefined') {
                        element.obj.css('border-style', options.border_style);
                    }

                    if (typeof(options.border_width) !== 'undefined') {
                        element.obj.css('border-width', options.border_width);
                    }

                    if (typeof(options.border_color) !== 'undefined') {
                        element.obj.css('border-color', options.border_color);
                    }

                    if (typeof(options.border_top_style) !== 'undefined') {
                        element.obj.css('border-top-style', options.border_top_style);
                    }

                    if (typeof(options.border_top_width) !== 'undefined') {
                        element.obj.css('border-top-width', options.border_top_width);
                    }

                    if (typeof(options.border_top_color) !== 'undefined') {
                        element.obj.css('border-top-color', options.border_top_color);
                    }

                    if (typeof(options.border_right_style) !== 'undefined') {
                        element.obj.css('border-right-style', options.border_right_style);
                    }

                    if (typeof(options.border_right_width) !== 'undefined') {
                        element.obj.css('border-right-width', options.border_right_width);
                    }

                    if (typeof(options.border_right_color) !== 'undefined') {
                        element.obj.css('border-right-color', options.border_right_color);
                    }

                    if (typeof(options.border_bottom_style) !== 'undefined') {
                        element.obj.css('border-bottom-style', options.border_bottom_style);
                    }

                    if (typeof(options.border_bottom_width) !== 'undefined') {
                        element.obj.css('border-bottom-width', options.border_bottom_width);
                    }

                    if (typeof(options.border_bottom_color) !== 'undefined') {
                        element.obj.css('border-bottom-color', options.border_bottom_color);
                    }

                    if (typeof(options.border_left_style) !== 'undefined') {
                        element.obj.css('border-left-style', options.border_left_style);
                    }

                    if (typeof(options.border_left_width) !== 'undefined') {
                        element.obj.css('border-left-width', options.border_left_width);
                    }

                    if (typeof(options.border_left_color) !== 'undefined') {
                        element.obj.css('border-left-color', options.border_left_color);
                    }

                    if (typeof(options.width_button) !== 'undefined') {
                        element.obj.css('width', options.width_button);
                    }
                    element.select();
                }
            ),
            new BackgroundImageControl(getI18n('background_image'), {
                image: element.obj.css('background-image'),
                color: element.obj.css('background-color'),
                repeat: element.obj.css('background-repeat'),
                position: element.obj.css('background-position'),
                size: element.obj.css('background-size'),
            }, {
                setBackgroundImage: function (image) {
                    element.obj.css('background-image', image);
                },
                setBackgroundColor: function (color) {
                    element.obj.css('background-color', color);
                },
                setBackgroundRepeat: function (repeat) {
                    element.obj.css('background-repeat', repeat);
                },
                setBackgroundPosition: function (position) {
                    element.obj.css('background-position', position);
                },
                setBackgroundSize: function (size) {
                    element.obj.css('background-size', size);
                },
            }),
            new MobileDesktopToggleControl(getI18n('toogle'), {
                type: element.obj.attr('data-hide-on')
            }, function(type) {
                element.obj.attr('data-hide-on', type);
                setTimeout(function() {
                    currentEditor.select(element);
                }, 100);
            }),
        ];
    }
}

window.ButtonElement = ButtonElement;