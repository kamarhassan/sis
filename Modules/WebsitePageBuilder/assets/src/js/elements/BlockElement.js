class BlockElement extends SuperElement  {
    name() {
        return getI18n('block');
    }
    icon() {
        return 'fal fa-font';
    }

    isDraggable() {
        return true;
    }

    getControls() {
        var element = this;

        return [
            new FontFamilyControl(getI18n('font_family'), element.obj.css('font-family'), function(font_family) {
                element.obj.css('font-family', font_family);
                currentEditor.selected.select();
            }),
            new AlignmentControl('alignment', { align: element.obj.css('text-align') }, {
                setAlign: function(pos) {
                    console.log(pos);
                    element.obj.css('text-align', pos);
                }
            }),
            new BackgroundImageControl(getI18n('background_image'), {
                image: element.obj.css('background-image'),
                color: element.obj.css('background-color'),
                repeat: element.obj.css('background-repeat'),
                position: element.obj.css('background-position'),
                size: element.obj.css('background-size'),
            }, {
                setBackgroundImage: function (image) {
                    // if is wrapper
                    if (element.isWrapper()) {
                        element.obj.closest('body').css('background-image', image);
                    } else {
                        element.obj.css('background-image', image);
                    }
                },
                setBackgroundColor: function (color) {
                    // if is wrapper
                    if (element.isWrapper()) {
                        element.obj.closest('body').css('background-color', color);
                    } else {
                        element.obj.css('background-color', color);
                    }
                },
                setBackgroundRepeat: function (repeat) {
                    // if is wrapper
                    if (element.isWrapper()) {
                        element.obj.closest('body').css('background-repeat', repeat);
                    } else {
                        element.obj.css('background-repeat', repeat);
                    }
                },
                setBackgroundPosition: function (position) {
                    // if is wrapper
                    if (element.isWrapper()) {
                        element.obj.closest('body').css('background-position', position);
                    } else {
                        element.obj.css('background-position', position);
                    }
                },
                setBackgroundSize: function (size) {
                    // if is wrapper
                    if (element.isWrapper()) {
                        element.obj.closest('body').css('background-size', size);
                    } else {
                        element.obj.css('background-size', size);
                    }
                },
            }),
            new BlockOptionControl(getI18n('padding'), {
                padding: element.obj.css('padding'),
                top: element.obj.css('padding-top'),
                bottom: element.obj.css('padding-bottom'),
                right: element.obj.css('padding-right'),
                left: element.obj.css('padding-left')
            }, function(options) {
                element.obj.css('padding', options.padding);
                element.obj.css('padding-top', options.top);
                element.obj.css('padding-bottom', options.bottom);
                element.obj.css('padding-right', options.right);
                element.obj.css('padding-left', options.left);
                setTimeout(function() {
                    currentEditor.selected.select();
                }, 100);
            }),
            new MobileDesktopToggleControl(getI18n('toogle'), {
                type: element.obj.attr('data-hide-on')
            }, function(type) {
                element.obj.attr('data-hide-on', type);
                setTimeout(function() {
                    currentEditor.selected.select();
                }, 100);
            }),
        ];
    }
}

window.BlockElement = BlockElement;