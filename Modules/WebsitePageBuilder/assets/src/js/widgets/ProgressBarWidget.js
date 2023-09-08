class ProgressBarWidget extends Widget {
    getHtmlId() {
        return "ProgressBarWidget";
    }

    name() {
        return getI18n('progress_bar');
    }

    icon() {
        return 'fal fa-percent';
    }
    init() {
        super.init();
    }
}

window.ProgressBarWidget = ProgressBarWidget;