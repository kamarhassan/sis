class ContainerWidget extends Widget {
    getHtmlId() {
        return "ContainerWidget";
    }

    name() {
        return getI18n('container');
    }

    icon() {
        return 'fal fa-rectangle-landscape';
    }
    init() {
        super.init();
    }
}

window.ContainerWidget = ContainerWidget;