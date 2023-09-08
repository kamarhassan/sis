class ImageHeaderWidget extends Widget {
    getHtmlId() {
        return "ImageHeaderWidget";
    }

    name() {
        return getI18n('image_header');
    }

    icon() {
        return 'fal fa-file-image';
    }
    init() {
        super.init();
    }
}

window.ImageHeaderWidget = ImageHeaderWidget;