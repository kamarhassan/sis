class TextAssociateControl extends Control {
    groupId() {
        return 'general';
    }

    renderHtml() {
        var thisControl = this;

        var html = $('#TextAssociateControl').html();
        html = html.replace("[TITLE]", this.title);

        var div = $('<div>').html(html);
        div.find('.associate-text').append('<option class="tag-first" value="" style="display:none;">'+getI18n('select_option')+'</option>');

        var associate_text = 'associate-text_' + this.id;
        div.find('.widget-associate .associate-text').attr('id', associate_text);

        editor.tags.forEach(function(tag) {
            if (tag.type == 'text' || tag.type == 'email') {
                div.find('.associate-text').append('<option class="" value="'+tag.tag+'">'+tag.text+'</option>');
            }
        });

        var name = this.value.name;
        //truong hop input name la email
        if (name == '{CONTACT[EMAIL]}') {
            div.find('.associate-text').html('<option class="" value="'+name+'">Email</option>');
            editor.tags.forEach(function(tag) {
                if (tag.type == 'text') {
                    div.find('.associate-text').append('<option class="" value="'+tag.tag+'">'+tag.text+'</option>');
                }
            });
        }
        //truong hop input name la firstname
        if (name == '{CONTACT[FIRST_NAME]}') {
            div.find('.associate-text').html('<option class="" value="'+name+'">'+getI18n('first_name')+'</option>');
            div.find('.associate-text').append('<option class="" value="{CONTACT[EMAIL]}">'+getI18n('email')+'</option>');
            div.find('.associate-text').append('<option class="" value="{CONTACT[LAST_NAME]}">'+getI18n('last_name')+'</option>');
        }
        //truong hop input name la lastname
        if (name == '{CONTACT[LAST_NAME]}') {
            div.find('.associate-text').html('<option class="" value="'+name+'">'+getI18n('last_name')+'</option>');
            div.find('.associate-text').append('<option class="" value="{CONTACT[EMAIL]}">'+getI18n('email')+'</option>');
            div.find('.associate-text').append('<option class="" value="{CONTACT[FIRST_NAME]}">'+getI18n('first_name')+'</option>');
        }

        //change select options
        $(document).on('change', '#' + associate_text, function() {
            var name = $(this).val();

            thisControl.callback({name: name});
        });

        return div.html();
    }
}

window.TextAssociateControl = TextAssociateControl;