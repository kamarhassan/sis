class ImgElement extends SuperElement {
    name() {
        return getI18n('image');
    }
    icon() {
        return 'fal fa-image';
    }

    getControls() {
        var element = this;

        var link = element.obj.parent().length && element.obj.parent().is("a") ? element.obj.parent().attr('href') : '';

        return [
            new ImageControl(getI18n('align'), {
                width: element.obj.width() / element.obj.parent().width() * 100,
                height: element.obj.height(),
                autoHeight: element.obj.prop('style').height == '' || element.obj.prop('style').height == 'auto',
                src: element.obj.attr('src'),
                alt: element.obj.attr('alt'),
                auto_width: element.obj.attr('width') == '100%' || element.obj[0].style.width == '100%'
            }, {
                setWidth: function(width) {
                    element.obj.css('width', width);

                    currentEditor.select(element);
                    currentEditor.handleSelect();
                },
                setHeight: function(height) {
                    console.log(height);
                    element.obj.css('height', height);

                    currentEditor.select(element);
                    currentEditor.handleSelect();
                },
                setUrl: function(url) {
                    element.obj.attr('src', url);
                    element.obj.addClass('image-after-change');

                    element.obj.one('load', function() { 
                        currentEditor.select(element);
                        currentEditor.handleSelect();
                    })
                },
                setAlign: function(align) {
                    element.obj.parent().css('text-align', align);
                    setTimeout(function() {
                        currentEditor.select(element);
                    }, 100);
                },
                setAlt: function(alt) {
                    element.obj.attr('alt', alt);
                    setTimeout(function() {
                        currentEditor.select(element);
                    }, 100);
                },
                setAutoWidth: function(auto_width) {
                    if (auto_width) {
                        element.obj.css('width', '100%');
                    } else {
                        // element.obj.css('width', '100%');
                    }
                    setTimeout(function() {
                        currentEditor.select(element);
                    }, 100);
                }
            }),
            new ImageSizeControl(getI18n('image_size'), {
                width: element.obj[0].style.width !== '' ? element.obj[0].style.width : element.obj.attr('width') ? element.obj.attr('width') : 'auto',
                height: element.obj[0].style.height !== '' ? element.obj[0].style.height : element.obj.attr('height') ? element.obj.attr('height') : 'auto'
            }, function(options) {
                element.obj.width(options.width);
                element.obj.height(options.height);
            }),

            //            
            new ImageLinkControl(getI18n('image_link'), {
                url: link
            }, function(options) {
                if (element.obj.parent().is("a")) {
                    // element.obj.attr('onclick', 'window.location=`' + options.url + '`');
                    element.obj.parent().attr('href', options.url);
                } else {
                    element.obj.wrap( "<a href='" + options.url + "'></a>" );
                }
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

window.ImgElement = ImgElement;