// Dropdown field widget
class DropdownFieldWidget extends FieldWidget {
    getHtmlId() {
        return "DropdownFieldWidget";
    }

    replaceTag(html) {
        html = super.replaceTag(html);
        
        var thisWidget = this;

        if (thisWidget.field.options.length) {
            var optionsHtml = '';
            thisWidget.field.options.forEach(function(option) {
                optionsHtml = optionsHtml + '<option value="' + option.value + '">' +option.text+ '</option>';
            });
            html = html.replace(/\[FIELD_OPTIONS\]/g, optionsHtml);
        }

        return html;
    }
}

window.DropdownFieldWidget = DropdownFieldWidget;