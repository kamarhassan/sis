class MarkedTextWidget extends Widget {
    getHtmlId() {
        return "MarkedTextWidget";
    }

    name() {
        return getI18n('paragraph');
    }

    icon() {
        return 'fal fa-info-circle';
    }
    init() {
        super.init();
    }
}

window.MarkedTextWidget = MarkedTextWidget;