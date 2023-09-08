class SectionTitleControl extends Control {
    renderHtml() {
        var thisControl = this;
        var html = $('#SectionTitleControl').html();
        html = html.replace("[TITLE]", thisControl.title);
        var div = $('<DIV>').html(html);
        
        return div.html();
    }
}

window.SectionTitleControl = SectionTitleControl;