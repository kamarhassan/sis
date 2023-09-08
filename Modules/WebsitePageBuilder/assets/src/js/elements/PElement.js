class PElement extends SuperElement {
    name() {
        return getI18n('text');
    }

    icon() {
        return 'fal fa-font';
    }

    unselect() {
        super.unselect();

        // # tmp tinymce fix which div inside p removing
        var firstChild = this.obj.children().first();
        if (typeof(firstChild) !== 'undefined' && firstChild.prop("tagName") == 'DIV') {
            var parentClass = this.obj[0].style.cssText;
            var childClass = firstChild[0].style.cssText;

            this.obj[0].style.cssText = parentClass+childClass;

            console.log(parentClass+childClass);
        }
    }

    getControls() {
        var element = this;

        return [            
            new TextControl(getI18n('text'), element.obj.html(), function(text) {
                element.obj.html(text);
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
            new AlignmentControl('alignment', { align: element.obj.css('text-align') }, {
                setAlign: function(pos) {
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
            new BlockOptionControl(getI18n('margin'), { padding: element.obj.css('margin'), top: element.obj.css('margin-top'), bottom: element.obj.css('margin-bottom'), right: element.obj.css('margin-right'), left: element.obj.css('margin-left') }, function(options) {
                element.obj.css('margin', options.padding);
                element.obj.css('margin-top', options.top);
                element.obj.css('margin-bottom', options.bottom);
                element.obj.css('margin-right', options.right);
                element.obj.css('margin-left', options.left);
                element.select();
            }),
        ];
    }
}

window.PElement = PElement;