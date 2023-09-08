class ListImageWidget extends Widget {
    getHtmlId() {
        return "ListImageWidget";
    }

    name() {
        return getI18n('list_image');
    }

    icon() {
        return 'fal fa-images';
    }
    init() {
        super.init();
    }
}

window.ListImageWidget = ListImageWidget;