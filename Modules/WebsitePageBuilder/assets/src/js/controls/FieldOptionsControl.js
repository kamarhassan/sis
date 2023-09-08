class FieldOptionsControl extends Control {
    renderHtml() {
        var thisControl = this;
        var html = $('#FieldOptionsControl').html();
        thisControl.selector = ".control-" + thisControl.id;

        html = html.replace("[ID]", thisControl.id);

        // options content
        var lines = '';
        thisControl.value.options.forEach(function(option) {
            lines = lines + `
                <div class="field-option">
                    <div class="row">
                        <div class="col-md-5 d-flex align-items-center pr-1">
                            <label class="small m-0">` + getI18n('field.option.value') + `</label>
                            <input disabled class="disabled" type="text" name="value" value="` + option.value + `" />
                        </div>
                        <div class="col-md-7 d-flex align-items-center pl-1">
                            <label class="small m-0">` + getI18n('field.option.text') + `</label>
                            <input class="" type="text" name="text" value="` + option.text + `" />
                        </div>
                    </div>
                </div>
            `;
        });
        html = html.replace("[OPTIONS]", lines);

        var div = $('<DIV>').html(html);
        
        return div.html();
    }

    update() {
        var thisControl = this;

        thisControl.callback({
            options: $(thisControl.selector).find('.field-option').map(function() {
                return {
                    value: $(this).find('[name=value]').val().trim(),
                    text: $(this).find('[name=text]').val().trim(),
                    checked:  $(this).find('[name=checkbox]').is(':checked'),
                };
            }).get(),
        });
    }

    afterRender() {
        var thisControl = this;

        // method
        $(thisControl.selector).find('input').on('change keyup', function() {
            thisControl.update();            
        });
    }
}

window.FieldOptionsControl = FieldOptionsControl;