class CheckboxFieldWidget extends FieldWidget {
    getHtmlId() {
        return "CheckboxFieldWidget";
    }

    replaceTag(html) {
        html = super.replaceTag(html);
        
        var thisWidget = this;

        if (thisWidget.field.options.length) {
            var optionsHtml = '';
            var index = 0;
            thisWidget.field.options.forEach(function(option) {
                optionsHtml = optionsHtml + `
                    <span class="mr-4 checkbox-option d-block">
                        <input type="checkbox" name="` + thisWidget.field.name + `[]" value="`+option.value+`" autocomplete="off">
                        <span class="text">`+option.text+`</span>
                    </span>
                `;
                index += 1;
            });
            html = html.replace(/\[FIELD_OPTIONS\]/g, optionsHtml);
        }

        return html;
    }
}

window.CheckboxFieldWidget = CheckboxFieldWidget;