class BlockqouteWidget extends Widget {
    getHtmlId() {
        return "BlockqouteWidget";
    }

    name() {
        return getI18n('blockqoute');
    }

    icon() {
        return 'fal fa-quote-right';
    }
    init() {
        super.init();
    }
}

window.BlockqouteWidget = BlockqouteWidget;