class Table4Widget extends Widget {
    getHtmlId() {
        return "Table4Widget";
    }

    name() {
        return getI18n('table');
    }

    icon() {
        return 'fal fa-table';
    }
    init() {
        super.init();
    }
}

window.Table4Widget = Table4Widget;