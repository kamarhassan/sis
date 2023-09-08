class ButtonGroupWidget extends Widget {
    getHtmlId() {
        return "ButtonGroupWidget";
    }

    name() {
        return getI18n('button_group');
    }

    icon() {
        return 'fal fa-th-large';
    }
    init() {
        super.init();
    }
}

window.ButtonGroupWidget = ButtonGroupWidget;