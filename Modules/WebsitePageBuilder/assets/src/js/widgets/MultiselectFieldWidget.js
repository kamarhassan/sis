// Multiselect widget
class MultiselectFieldWidget extends FieldWidget {
    getHtmlId() {
        return "MultiselectFieldWidget";
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

window.MultiselectFieldWidget = MultiselectFieldWidget;