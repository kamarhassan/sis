class HtmlOptionControl extends Control {
    groupId() {
        return 'general';
    }

    renderHtml() {
        var thisControl = this;
        var html = $('#HtmlOptionControl').html();
        thisControl.selector = ".control-" + thisControl.id;
        

        html = html.replace("[ID]", thisControl.id);
        html = html.replace("[TITLE]", thisControl.title);
        html = html.replace("[HTML]", thisControl.value);

        return html;
    }

    afterRender() {
        var thisControl = this;

        // events
        $(thisControl.selector).find('.html-input').on('change keyup', function(e) {
            thisControl.callback($(this).val());
        });
    }
}

window.HtmlOptionControl = HtmlOptionControl;