class DropdownAssociateControl extends Control {
    groupId() {
        return 'general';
    }

    renderHtml() {
        var thisControl = this;

        var html = $('#DropdownAssociateControl').html();
        var dropdown = 'dropdown_' + this.id;

        html = html.replace("[TITLE]", this.title);
        html = html.replace(/\[dropdown_ID]/g, dropdown);

        var div = $('<div>').html(html);
        //add tag with action
        editor.tags.forEach(function(tag) {
            if (tag.type == 'dropdown') {
                div.find('.associate-dropdown').append('<option class="gender" value="'+ tag.tag +'">'+ tag.text + '</option>');
            }
        });

        var placeholder_id = 'placeholder_' + this.id;
        div.find('.placeholder-input-control .placeholder-input').attr('id', placeholder_id);
        var option_placeholder = div.find('.placeholder-option');

        $(document).on('keyup change', '#' + placeholder_id, function() {
            var placeholder = $(this).val();
            option_placeholder.html(placeholder);
            thisControl.callback({placeholder: placeholder});
        });

        $(document).on('change', '#' +dropdown, function() {
            var name_select = $(this).val();

            thisControl.callback({name: name_select});
        });

        return div.html();
    }
}

window.DropdownAssociateControl = DropdownAssociateControl;