class ActionControl extends Control {
    groupId() {
        return 'action';
    }

    renderHtml() {
        var thisControl = this;

        var html = $('#ActionControl').html();
        html = html.replace("[TITLE]", this.title);

        $(document).on('click', '#builder_iframe', function() {

            // something else

            //thisControl.callback({top: new_top, bottom: new_bottom});
            //thisControl.callback(padding);
        });

    return html;

    }
}

window.ActionControl = ActionControl;