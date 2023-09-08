class FontFamilyControl extends Control {
    groupId() {
        return 'general';
    }

    renderHtml() {
        var thisControl = this;
        var fullValue = this.value;
        var value = fullValue.split(',')[0].trim().toLowerCase().replace(/\"/g, '');
        var html = $('#FontFamilyControl').html();
        
        html = html.replace("[TITLE]", this.title);
        html = html.replace("[ID]", this.id);
        
        var div = $('<DIV>').html(html);
        
        // check if options has selected value
        var exists = 0 != div.find('.control-' + this.id + '.font-family select option[value="'+value+'"]').length;
        if (exists) {
            div.find('.control-' + this.id + '.font-family select option').attr('selected', false);
            div.find('.control-' + this.id + '.font-family select option[value="'+value+'"]').attr('selected', true);
        }
        
        $(document).on('change', '.control-' + this.id + ' select', function() {
            thisControl.callback('"' + $(this).val() + '", ' + fullValue);
        });
        
        return div.html();
    }
}

window.FontFamilyControl = FontFamilyControl;