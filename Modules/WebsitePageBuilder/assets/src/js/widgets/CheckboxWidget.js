class CheckboxWidget extends Widget {
    getHtmlId() {
        return "CheckboxWidget";
    }

    name() {
        return getI18n('checkbox');
    }

    icon() {
        return 'fal fa-check-square';
    }
    init() {
        super.init();
    }
}

window.CheckboxWidget = CheckboxWidget;