class LinkWidget extends Widget {
    getHtmlId() {
        return "LinkWidget";
    }

    name() {
        return getI18n('link');
    }

    icon() {
        return 'fal fa-link';
    }
    init() {
        super.init();
    }
}

window.LinkWidget = LinkWidget;