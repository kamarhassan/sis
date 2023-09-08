class Button2Widget extends Widget {
    getHtmlId() {
        return "Button2Widget";
    }

    name() {
        return getI18n('button');
    }

    icon() {
        return 'fal fa-minus-square';
    }
}

window.Button2Widget = Button2Widget;