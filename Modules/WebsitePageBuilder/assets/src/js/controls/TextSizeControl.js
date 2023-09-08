class TextSizeControl extends Control {
    groupId() {
        return 'general';
    }

    renderHtml() {
        var thisControl = this;
        var value = this.value;
        var html = $('#TextSizeControl').html();
        
        html = html.replace("[TITLE]", this.title);
        html = html.replace("[ID]", this.id);
        
        var div = $('<DIV>').html(html);
        
        // check if options has selected value
        if (this.value) {
            var exists = 0 != div.find('.control-' + this.id + '.text-size select option[value="'+value+'"]').length;
            if (exists) {
                div.find('.control-' + this.id + '.text-size select option').attr('selected', false);
                div.find('.control-' + this.id + '.text-size select option[value="'+value+'"]').attr('selected', true);
            }
        }
            
        
        $(document).on('change', '.control-' + this.id + ' select', function() {
            thisControl.callback($(this).val());
        });
        
        return div.html();
    }
}

window.TextSizeControl = TextSizeControl;