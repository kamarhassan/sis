class IconLinkElement extends SuperElement  {
    name() {
        return getI18n('icon');
    }
    icon() {
        return 'fal fa-font';
    }

    getControls() {
        var element = this;

        return [
            new IconSelectControl(getI18n('icon'), {src: element.obj.find('img').attr('src'), url: element.obj.attr('href')}, {
                setSrc: function(src) {
                    element.obj.find('img').attr('src', src);
                },
                setUrl: function(url) {
                    element.obj.attr('href', url);
                }
            })
        ];
    }
}

window.IconLinkElement = IconLinkElement;