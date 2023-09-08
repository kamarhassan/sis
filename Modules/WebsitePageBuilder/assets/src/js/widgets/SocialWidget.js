class SocialWidget extends Widget {
    getHtmlId() {
        return "SocialWidget";
    }

    name() {
        return getI18n('social');
    }

    icon() {
        return 'fal fa-share-alt';
    }
}

window.SocialWidget = SocialWidget;