class FieldListHeaderControl extends Control {
    renderHtml() {
        var thisControl = this;
        var html = $('#FieldListHeaderControl').html();
        html = html.replace("[TITLE]", thisControl.title);
        html = html.replace("[LIST_NAME]", thisControl.value);
        var div = $('<DIV>').html(html);
        
        return div.html();
    }
}

window.FieldListHeaderControl = FieldListHeaderControl;