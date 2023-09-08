class PricingTableElement extends SuperElement  {
    name() {
        return getI18n('pricing_table');
    }

    getControls() {
        var element = this;

        return [
            new PricingTableControl(getI18n('theme'), element.obj.attr('data-style'), function(style) {
                element.obj.attr('data-style', style);
                if (style == 'dark') {
                    element.obj.find('.col-12').css('background', '#007c89');
                    element.obj.children().css('color', '#fff');
                    element.obj.children().css('border-left', 'none');
                    element.obj.find('.btn').css('border', 'none');
                    element.obj.find('.btn').css('background', '#fff');
                    element.obj.find('.btn').css('color', '#333');
                    element.obj.children().first().children().css('border', 'solid 1px #fff');
                    element.obj.children().first().children().css('border-width', '0px 1px 0px 0px');
                    element.obj.children().first().children().last().css('border-width', '0px 0px 0px 0px');
                } else if (style == 'light') {
                    element.obj.find('.col-12').css('background', 'transparent');
                    element.obj.children().css('color', '#333');
                    element.obj.children().css('border-left', 'none');
                    element.obj.find('.btn').css('border', 'none');
                    element.obj.find('.btn').css('background', '#007c89');
                    element.obj.find('.btn').css('color', '#fff');
                    element.obj.children().first().children().css('border', 'solid 1px #ccc');
                    element.obj.children().first().children().css('border-width', '0px 1px 0px 0px');
                    element.obj.children().first().children().last().css('border-width', '0px 0px 0px 0px');
                } else {
                    element.obj.find('.col-12').css('background', 'transparent');
                    element.obj.children().css('color', '#333');
                    element.obj.children().css('border-left', 'solid 1px #ccc');
                    element.obj.find('.btn').css('border', 'none');
                    element.obj.find('.btn').css('background', '#007c89');
                    element.obj.find('.btn').css('color', '#fff');
                    element.obj.children().first().children().css('border', 'solid 1px #ccc');
                    element.obj.children().first().children().css('border-width', '1px 1px 1px 0px');
                    element.obj.children().first().children().last().css('border-width', '1px 1px 1px 0px');
                }
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

window.PricingTableElement = PricingTableElement;