class TableBlockElement extends SuperElement  {
    name() {
        return getI18n('block');
    }

    getControls() {
        var element = this;

        return [
            new TableBlockControl(getI18n('theme'), element.obj.attr('data-theme'), function(theme) {
                element.obj.find("table").removeClass (function (index, className) {
                    return (className.match (/(^|\s)table-\S+/g) || []).join(' ');
                });

                element.obj.find("table").addClass(theme);
                element.obj.find("table").attr('data-theme', theme);

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

window.TableBlockElement = TableBlockElement;