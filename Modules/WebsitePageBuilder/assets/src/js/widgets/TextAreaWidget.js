class TextAreaWidget extends Widget {
    getHtmlId() {
        return "TextAreaWidget";
    }

    name() {
        return getI18n('text_area');
    }

    icon() {
        return 'fal fa-rectangle-wide';
    }
    init() {
        super.init();
    }
}

window.TextAreaWidget = TextAreaWidget;