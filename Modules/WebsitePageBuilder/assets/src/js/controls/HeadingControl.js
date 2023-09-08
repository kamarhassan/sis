class HeadingControl extends Control {
    groupId() {
        return 'general';
    }

    renderHtml() {
        var thisControl = this;
        var tag = this.value;
        var html = $('#HeadingControl').html();
        
        html = html.replace("[TITLE]", this.title);
        html = html.replace("[ID]", this.id);
        
        var div = $('<DIV>').html(html);
        
        // check if options has selected value
        div.find('.control-' + this.id + ' select option').attr('selected', false);
        div.find('.control-' + this.id + ' select option[value="'+tag+'"]').attr('selected', true);
        
        $(document).on('change', '.control-' + this.id + ' select', function() {
            thisControl.callback($(this).val());
        });
        
        return div.html();
    }
}

window.HeadingControl = HeadingControl;