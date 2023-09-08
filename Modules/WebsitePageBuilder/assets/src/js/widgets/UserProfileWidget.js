class UserProfileWidget extends Widget {
    getHtmlId() {
        return "UserProfileWidget";
    }

    name() {
        return getI18n('user_profile');
    }

    icon() {
        return 'fal fa-user';
    }
    init() {
        super.init();
    }
}

window.UserProfileWidget = UserProfileWidget;