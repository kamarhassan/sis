class BoxedTextWidget extends Widget {
    getHtmlId() {
        return "BoxedTextWidget";
    }
    name() {
        return getI18n('text');
    }
    icon() {
        return 'fal fa-font';
    }
}

window.BoxedTextWidget = BoxedTextWidget;