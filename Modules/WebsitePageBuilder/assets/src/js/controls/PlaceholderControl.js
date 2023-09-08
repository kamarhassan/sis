class PlaceholderControl extends Control {
    renderHtml() {
        var thisControl = this;

        var placeholder_value = this.value.placeholder;

        var html = $('#PlaceholderControl').html();

        html = html.replace("[TITLE]", this.title);

        var div = $('<div>').html(html);

        var placeholder_id = 'placeholder_' + this.id;
        div.find('.placeholder-input-control .placeholder-input').attr('id', placeholder_id);
        div.find('.placeholder-input-control .placeholder-input').attr('value', placeholder_value);

        $(document).on('keyup change', '#' + placeholder_id, function() {
            var placeholder = $(this).val();

            thisControl.callback({placeholder: placeholder});
        });

        return div.html();
    }
}

window.PlaceholderControl = PlaceholderControl;