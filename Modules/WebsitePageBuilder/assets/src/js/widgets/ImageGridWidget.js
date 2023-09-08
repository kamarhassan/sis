class ImageGridWidget extends Widget {
    getHtmlId() {
        return "ImageGridWidget";
    }

    name() {
        return getI18n('image_grid');
    }

    icon() {
        return 'fal fa-th';
    }
    init() {
        super.init();
    }
}

window.ImageGridWidget = ImageGridWidget;