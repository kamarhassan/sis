class YoutubeElement extends SuperElement  {
    name() {
        return getI18n('block');
    }

    getControls() {
        var element = this;

        return [
            new YoutubeControl(getI18n('youtube'), {
                code: element.obj.attr('data-code'),
                width: element.obj.find('iframe').attr('width'),
                height: element.obj.find('iframe').attr('height'),
                alignment: element.obj.css('text-align')
            }, {
                setCode: function(code) {
                    element.obj.html(`
                        <iframe width="`+element.obj.find('iframe').attr('width')+`" height="`+element.obj.find('iframe').attr('height')+`" src="https://www.youtube.com/embed/`+code+`" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    `);
                },
                setWidth: function(width) {
                    element.obj.find('iframe').attr('width', width);
                },
                setHeight: function(height) {
                    element.obj.find('iframe').attr('height', height);
                },
                setAlignment: function(alignment) {
                    element.obj.css('text-align', alignment);
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

window.YoutubeElement = YoutubeElement;