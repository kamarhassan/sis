class CellElement extends SuperElement  {
    name() {
        return getI18n('cell');
    }
    icon() {
        return 'fal fa-font';
    }

    isContainer() {
        return true;
    }

    canSelect() {
        return false;
    }

    canDelete() {
        return false;
    }

    canDuplicate() {
        return false;
    }

    getControls() {
        var element = this;
        var container = currentEditor.elementFactory(element.obj.closest('[builder-element="CellContainerElement"]'));

        return [
            new CellOptionControl(getI18n('cell_options'),
                {
                    count: container.obj.children().length,
                    layout: container.obj.attr('data-layout')
                },
                {
                    setLayout: function(layout) {
                        container.setLayout(layout);
                        setTimeout(function() {
                            currentEditor.select(container);
                            currentEditor.handleSelect();
                        }, 300)                            
                    }
                }
            ),
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

window.CellElement = CellElement;