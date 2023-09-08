class CheckboxAssociateControl extends Control {
    groupId() {
        return 'general';
    }

    renderHtml() {
        var thisControl = this;

        var html = $('#CheckboxAssociateControl').html();
        html = html.replace("[TITLE]", this.title);

        var div = $('<div>').html(html);
        div.find('.associate-checkbox').append('<option class="" value="">'+getI18n('select_option')+'</option>');

        var associate_checkbox = 'associate-checkbox' + this.id;
        div.find('.widget-associate .associate-checkbox').attr('id', associate_checkbox);

        editor.tags.forEach(function(tag) {
            if (tag.type == 'checkbox') {
                div.find('.associate-checkbox').append('<option class="" value="'+tag.tag+'">'+tag.text+'</option>');
            }
        });

        //change select options
        $(document).on('change', '#' + associate_checkbox, function() {
            var name = $(this).val();

            thisControl.callback({name: name});
        });

        return div.html();
    }
}

window.CheckboxAssociateControl = CheckboxAssociateControl;