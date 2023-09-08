class FormWidget extends Widget {
    getHtmlId() {
        return "FormWidget";
    }

    name() {
        return getI18n('form');
    }

    icon() {
        return 'fal fa-clipboard-list';
    }
    init() {
        super.init();
    }
}

window.FormWidget = FormWidget;