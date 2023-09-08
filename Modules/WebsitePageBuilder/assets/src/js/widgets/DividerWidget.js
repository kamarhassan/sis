class DividerWidget extends Widget {
    getHtmlId() {
        return "DividerWidget";
    }

    name() {
        return getI18n('divider');
    }

    icon() {
        return 'fal fa-ruler-horizontal';
    }
}

window.DividerWidget = DividerWidget;