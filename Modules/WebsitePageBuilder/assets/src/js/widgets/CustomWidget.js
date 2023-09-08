class CustomWidget extends Widget {
    getHtmlId() {
        return "CustomWidget";
    }

    name() {
        return getI18n('custom_widget');
    }

    icon() {
        return 'fal fa-code';
    }
    init() {
        super.init();
    }
}

window.CustomWidget = CustomWidget;