class MediaObjectWidget extends Widget {
    getHtmlId() {
        return "MediaObjectWidget";
    }

    name() {
        return getI18n('media_object');
    }

    icon() {
        return 'fal fa-play';
    }
    init() {
        super.init();
    }
}

window.MediaObjectWidget = MediaObjectWidget;