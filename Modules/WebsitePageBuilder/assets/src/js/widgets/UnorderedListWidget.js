class UnorderedListWidget extends Widget {
    getHtmlId() {
        return "UnorderedListWidget";
    }

    name() {
        return getI18n('unordered_list');
    }

    icon() {
        return 'fal fa-list-ul';
    }
    init() {
        super.init();
    }
}

window.UnorderedListWidget = UnorderedListWidget;