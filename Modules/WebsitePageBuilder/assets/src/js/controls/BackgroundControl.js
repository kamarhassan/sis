class BackgroundControl extends Control {
    groupId() {
        return 'general';
    }

    renderHtml() {
        var thisControl = this;

        var color_link = this.value.color;

        color_link = rgb2hex(color_link);

        var html = $('#BackgroundControl').html(); /*id cua element*/
        var input_id = 'A_color_input_' + this.id;

        html = html.replace("[TITLE]", this.title);
        html = html.replace(/\[AVALUE\]/g, color_link);
        html = html.replace(/\[AINPUT_ID\]/g, input_id);

        var div = $('<DIV>').html(html);
        div.find('.link-color-element .link-color').attr('value', color_link);
        div.find('.link-color-element .link-color-input').attr('value', color_link);
        div.find('#' + input_id).attr('value', color_link);

        $(document).on('change', '#' + input_id, function() {
            var color_link = $(this).val();

            // something else
            $('#A-bg-color-' + this.id).val(color_link);

            thisControl.callback({color: color_link});
        });

        return div.html();
    }
}

window.BackgroundControl = BackgroundControl;