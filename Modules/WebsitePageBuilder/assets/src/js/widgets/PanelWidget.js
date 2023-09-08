class PanelWidget extends Widget {
    getHtmlId() {
        return "PanelWidget";
    }

    name() {
        return getI18n('panel');
    }

    icon() {
        return 'fal fa-columns';
    }
    init() {
        super.init();
    }
}

window.PanelWidget = PanelWidget;