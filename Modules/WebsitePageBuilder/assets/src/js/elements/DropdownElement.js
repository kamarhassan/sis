class DropdownElement extends SuperElement {
    getControls() {
        var element = this;

        return [
            new DropdownAssociateControl(getI18n('associate_tag'), {name: element.obj.attr('name')} , function(options) {
                element.obj.attr('name', '{GENDER}');
                element.obj.attr('value', options.name);
            }),

            new PlaceholderControl(getI18n('placeholder'), {placeholder: element.obj.attr('placeholder')}, function(options) {
                var option = element.obj.find('option:first-child');
                option.css('display', 'none');
                option.html(options.placeholder);
            }),

            new LineHeightControl(getI18n('line_height'), element.obj.css('line-height'), function(line_height) {
                element.obj.css('line-height', line_height);
                element.select();
            }),
            
            new TextSizeControl(getI18n('text_size'), element.obj.css('font-size'), function(text_size) {
                element.obj.css('font-size', text_size);
                element.obj.find('*').css('font-size', text_size);
                element.select();
            }),
            
            new TextStyleControl(getI18n('text_style'), {
                    font_weight: element.obj.css('font-weight'),
                    text_decoration: element.obj.css('text-decoration'),
                    font_style: element.obj.css('font-style'),
            }, function(value) {
                element.obj.css('font-weight', value.font_weight);
                element.obj.css('font-style', value.font_style);
                element.obj.css('text-decoration', value.text_decoration);
                element.select();
            }),
            
            new FontFamilyControl(getI18n('font_family'), element.obj.css('font-family'), function(font_family) {
                element.obj.css('font-family', font_family);
                element.select();
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

window.DropdownElement = DropdownElement;