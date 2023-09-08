class VideoElement extends SuperElement {
    name() {
        return getI18n('video');
    }
    icon() {
        return 'fal fa-film';
    }

    getControls() {
        var element = this;

        return [
            new VideoOptionControl(getI18n('video_url'), { src: element.obj.attr('src')}, function(options) {
               element.obj.attr('src', options.src);
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

window.VideoElement = VideoElement;