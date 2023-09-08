class MeterialWidget extends Widget {
    getHtmlId() {
        return "MeterialWidget";
    }

    name() {
        return getI18n('meterial');
    }

    icon() {
        return 'fal fa-archive';
    }
    init() {
        super.init();
    }
}

window.MeterialWidget = MeterialWidget;