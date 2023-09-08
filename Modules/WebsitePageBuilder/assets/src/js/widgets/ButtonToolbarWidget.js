class ButtonToolbarWidget extends Widget {
    getHtmlId() {
        return "ButtonToolbarWidget";
    }

    name() {
        return getI18n('button_toolbar');
    }

    icon() {
        return 'fal fa-grip-horizontal';
    }
    init() {
        super.init();
    }
}

window.ButtonToolbarWidget = ButtonToolbarWidget;