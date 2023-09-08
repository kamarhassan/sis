class TextWidget extends Widget {
    getHtmlId() {
        return "TextWidget";
    }
    name() {
        return getI18n('text');
    }
    icon() {
        return 'fal fa-font';
    }
}

window.TextWidget = TextWidget;