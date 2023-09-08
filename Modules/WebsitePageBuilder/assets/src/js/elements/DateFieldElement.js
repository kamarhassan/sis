class DateFieldElement extends SuperElement {
    constructor(obj) {
        super(obj);

    }

    name() {
        return getI18n('date_field');
    }

    getControls() {
        var element = this;

        return [
            new FieldListHeaderControl(element.obj.find('label').html(), currentEditor.listName ? currentEditor.listName : 'Select List'),

            new CommonFieldControl(getI18n('common_field'), {
                fieldName: element.obj.find('input').attr('name'),
                label: element.obj.find('label').html(),
                labelShowed: element.obj.find('label').is(':visible'),
                id: element.obj.find('input').attr('id'),
                icon: 'today',
            }, function(options) {
                element.obj.find('input').attr('name', options.fieldName);
                element.obj.find('label').html(options.label);

                if (options.labelShowed) {
                    element.obj.find('label').fadeIn(100, function() {element.select();});
                } else {
                    element.obj.find('label').fadeOut(100, function() {element.select();});
                }

                element.obj.find('input').attr('id', options.id);
            }),

            new PlaceholderControl(getI18n('placeholder'), {placeholder: element.obj.find('input').attr('placeholder')}, function(options) {
                element.obj.find('input').attr('placeholder', options.placeholder);
            }),

            new ValidationControl(getI18n('validation'), {
                required: element.obj.find('input').attr('required'),
                minLength: element.obj.find('input').attr('data-min-length') ? element.obj.find('input').attr('data-min-length') : 1,
                maxLength: element.obj.find('input').attr('data-max-length') ? element.obj.find('input').attr('data-max-length') : '',
                regexp: element.obj.find('input').attr('data-regexp') ? element.obj.find('input').attr('data-regexp') : ''
            }, function(options) {
                if (options.required) {
                    element.obj.find('input').prop('required', true);
                } else {
                    element.obj.find('input').removeAttr('required');
                }

                //
                element.obj.find('input').attr('data-min-length', options.minLength);
                element.obj.find('input').attr('data-max-length', options.maxLength);
                element.obj.find('input').attr('data-regexp', options.regexp);
            }),
            
            new ColorPickerControl(getI18n('text_color'), element.obj.css('color'), function(color_text) {
                element.obj.css('color', color_text);
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

window.DateFieldElement = DateFieldElement;