class InputGroupWidget extends Widget {
    getHtmlId() {
        return "InputGroupWidget";
    }

    name() {
        return getI18n('input_group');
    }

    icon() {
        return 'fal fa-ballot';
    }
    init() {
        super.init();
    }
}

window.InputGroupWidget = InputGroupWidget;