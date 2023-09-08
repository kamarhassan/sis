class TableWidget extends Widget {
    getHtmlId() {
        return "TableWidget";
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

window.TableWidget = TableWidget;