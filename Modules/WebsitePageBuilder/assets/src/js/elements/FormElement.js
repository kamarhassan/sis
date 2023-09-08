class FormElement extends SuperElement {
    constructor(obj) {
        super(obj);

    }

    name() {
        return getI18n('block_container');
    }

    getControls() {
        var element = this;

        return [
            new SectionTitleControl(getI18n('form_options')),

            new CaptchaToggleControl(getI18n('captcha'), element.obj.attr('data-captcha'), function(captcha) {
                element.obj.attr('data-captcha', captcha);
            }),

            new FormControl(getI18n('captcha'), {
                method: element.obj.attr('method') ? element.obj.attr('method') : 'GET',
                autocomplete: element.obj.attr('autocomplete') ? element.obj.attr('autocomplete') : 'on',
                accept_charset: element.obj.attr('accept-charset') ? element.obj.attr('accept-charset') : '',
                enctype: element.obj.attr('enctype') ? element.obj.attr('enctype') : '',
            }, function(options) {
                element.obj.attr('method', options.method);
                element.obj.attr('autocomplete', options.autocomplete);
                element.obj.attr('accept-charset', options.accept_charset);
                element.obj.attr('enctype', options.enctype);
            }),

            new BackgroundControl(getI18n('background'), {color: element.obj.css('background-color')}, function(options) {
                element.obj.css('background-color', options.color)

                // if is wrapper
                if (element.isWrapper()) {
                    element.obj.closest('body').css('background-color', options.color);
                }
            }),

            new ColorPickerControl(getI18n('text_color'), element.obj.css('color'), function(color_text) {
                element.obj.css('color', color_text);
            }),
            new LineHeightControl(getI18n('line_height'), element.obj.css('line-height'), function(line_height) {
                element.obj.css('line-height', line_height);
                element.select();
            }),            
            new TextSizeControl(getI18n('text_size'), element.obj.css('font-size'), function(text_size) {
                element.obj.css('font-size', text_size);
                element.obj.find('*').css('font-size', text_size);
                element.select();
            }),
            new TextStyleControl(getI18n('text_style'), {
                font_weight: element.obj.css('font-weight'),
                text_decoration: element.obj.css('text-decoration'),
                font_style: element.obj.css('font-style'),
            }, function(value) {
                element.obj.css('font-weight', value.font_weight);
                element.obj.css('font-style', value.font_style);
                element.obj.css('text-decoration', value.text_decoration);
                element.select();
            }),
            new FontFamilyControl(getI18n('font_family'), element.obj.css('font-family'), function(font_family) {
                element.obj.css('font-family', font_family);
                element.select();
            }),
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

window.FormElement = FormElement;