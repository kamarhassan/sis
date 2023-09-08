class IconSelectControl extends Control {
    groupId() {
        return 'action';
    }

    renderHtml() {
        var thisControl = this;
        var options = this.value;
        var value = options.src;
        var html = $('#IconSelectControl').html();
        
        html = html.replace("[TITLE]", this.title);
        html = html.replace("[ID]", this.id);
        
        var div = $('<DIV>').html(html);

        // set control icon
        div.find('.control-' + this.id + ' .icon').html('<img height="100%" src="'+value+'" />');

        div.find('.control-' + this.id + ' .url').attr('value', this.value.url);
        
        $(document).on('change', '.control-' + this.id + ' select', function() {
            // set icon
            $('.control-' + thisControl.id + ' .icon').html('<img height="100%" src="'+$(this).val()+'" />');

            thisControl.callback.setSrc($(this).val());
        });

        $(document).on('change keyup', '.control-' + this.id + ' .url', function() {
            thisControl.callback.setUrl($(this).val());
        });

        $(document).on('click', '.control-' + this.id + ' .but-dup', function() {
            $('.builder-duplicate-selected-button').trigger('click');
        });

        $(document).on('click', '.control-' + this.id + ' .but-remove', function() {
            $('.builder-remove-selected-button').trigger('click');
        });
        
        return div.html();
    }

    afterRender() {
        // check if options has selected value
        $('.control-' + this.id + ' select option').attr('selected', false);
        $('.control-' + this.id + ' select option[value="'+this.value.src+'"]').attr('selected', true);
    }
}

window.IconSelectControl = IconSelectControl;