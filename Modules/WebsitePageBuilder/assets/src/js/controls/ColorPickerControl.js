class ColorPickerControl extends Control {
    groupId() {
        return 'general';
    }

    renderHtml() {
        var thisControl = this;

        var color_text = this.value;
        color_text = rgb2hex(this.value);

        var html = $('#ColorPickerControl').html();
        var input_id = 'P_color_input_' + this.id;

        html = html.replace("[TITLE]", this.title);
        html = html.replace(/\[PVALUE\]/g, color_text);
        html = html.replace(/\[PINPUT_ID\]/g, input_id);

        var div = $('<DIV>').html(html);
        div.find('.text-color-element .color').attr('value', color_text);
        div.find('.text-color-element .text-color-input').attr('value', color_text);

        $(document).on('change', '#' + input_id, function() {
            var color_text = $(this).val();

            // something else
            $('#P-text-color').val(color_text);

            thisControl.callback(color_text);
        });

        return div.html();
    }
}

window.ColorPickerControl = ColorPickerControl;