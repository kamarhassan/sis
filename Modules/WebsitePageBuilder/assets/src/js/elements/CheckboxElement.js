class CheckboxElement extends SuperElement {
    name() {
        return getI18n('checbox');
    }

    getControls() {
        var element = this;

        return [
            new CheckboxAssociateControl(getI18n('associate_checbox'), {name: element.obj.attr('name')}, function(options) {
               element.obj.attr('name', options.name);
            }),

            new ColorPickerControl(getI18n('text_color'), element.obj.css('color'), function(color_text) {
                element.obj.css('color', color_text);
            }),

            new LineHeightControl(getI18n('line_height'), element.obj.css('line-height'), function(line_height) {
                element.obj.css('line-height', line_height);
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

window.CheckboxElement = CheckboxElement;