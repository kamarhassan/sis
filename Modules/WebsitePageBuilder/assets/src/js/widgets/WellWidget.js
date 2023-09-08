class WellWidget extends Widget {
    getHtmlId() {
        return "WellWidget";
    }

    name() {
        return getI18n('well');
    }

    icon() {
        return 'fal fa-hexagon';
    }
    init() {
        super.init();
    }
}

window.WellWidget = WellWidget;