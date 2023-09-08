class HeadingElement extends SuperElement {
    name() {
        return getI18n('Heading');
    }

    icon() {
        return 'fal fa-font';
    }

    getControls() {
        var element = this;

        return [            
            new TextControl(getI18n('text'), element.obj.html(), function(text) {
                element.obj.html(text);
            }),
            new HeadingControl(getI18n('heading'), element.obj.prop('tagName').toLowerCase(), function(tag) {
                // element.obj.html(text);
                var replace1 = '^\<'+element.obj.prop('tagName');
                var replace2 = '\<\/'+element.obj.prop('tagName')+'\>$';
                var re1 = new RegExp(replace1,"i");
                var re2 = new RegExp(replace1,"i");

                var newE = $(element.obj[0].outerHTML.replace(re1, '<'+tag).replace(re2, '</'+tag+'>'));
                element.obj.replaceWith(newE);
                element.obj = newE;
                element.select();
            }),
            new ColorPickerControl(getI18n('text_color'), element.obj.css('color'), function(color_text) {
                element.obj.css('color', color_text);
            }),
            // new LinkColorControl(getI18n('link_color'), element.obj.css('color'), function(color_link) {
            //     element.obj.css('color', color_link);
            // }),
            new LineHeightControl(getI18n('line_height'), element.obj.css('line-height'), function(line_height) {
                element.obj.css('line-height', line_height);
                element.select();
            }),
            new TextSizeControl(getI18n('text_size'), element.obj.css('font-size'), function(text_size) {
                element.obj.css('font-size', text_size);
                element.obj.find('*').css('font-size', text_size);
                element.select();
            }),
            new AlignmentControl('alignment', { align: element.obj.css('text-align') }, {
                setAlign: function(pos) {
                    console.log(pos);
                    element.obj.css('text-align', pos);
                }
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

window.HeadingElement = HeadingElement;