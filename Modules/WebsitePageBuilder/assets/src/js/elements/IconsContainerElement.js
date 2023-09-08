class IconsContainerElement extends SuperElement {
    name() {
        return getI18n('container');
    }

    getControls() {
        var element = this;

        return [
            new IconsContainerControl(getI18n('icons_container'), { }, {
                addIcon: function() {
                    var icon = $(currentEditor.transformHtml(`
                        <a builder-element="IconLinkElement" href="" class="mr-3 me-3">
                            <img src="{{root}}image/icon-none.png" style="width:40px;height:40px;display:block;border-radius:100%;background-color:#fff">
                        </a>
                    `));

                    // add new icon
                    element.obj.find('[builder-element=IconLinkElement]').last().after(icon);

                    // select new icon
                    var e = currentEditor.elementFactory(element.obj.find('[builder-element=IconLinkElement]').last());
                    currentEditor.select(e);
                    currentEditor.handleSelect();
                }
            }),
            new MobileDesktopToggleControl(getI18n('toogle'), {
                type: element.obj.attr('data-hide-on')
            }, function(type) {
                element.obj.attr('data-hide-on', type);
                setTimeout(function() {
                    currentEditor.select(element);
                }, 100);
            }),
        ];
    }
}

window.IconsContainerElement = IconsContainerElement;