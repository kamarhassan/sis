class HeadingWidget extends Widget {
    getHtmlId() {
        return "HeadingWidget";
    }

    name() {
        return getI18n('heading');
    }

    icon() {
        return 'fal fa-h2';
    }
    init() {
        super.init();
    }
}

window.HeadingWidget = HeadingWidget;