class FormControl extends Control {
    renderHtml() {
        var thisControl = this;
        var html = $('#FormControl').html();
        thisControl.selector = ".control-" + thisControl.id;

        html = html.replace("[ID]", thisControl.id);
        // html = html.replace("[METHOD]", thisControl.value.method);
        html = html.replace("[ENCTYPE]", thisControl.value.enctype ? thisControl.value.enctype : 'application/x-www-form-urlencoded');
        html = html.replace("[ACCEPT_CHARSET]", thisControl.value.accept_charset ? thisControl.value.accept_charset : 'UTF-8');

        var div = $('<DIV>').html(html);
        
        return div.html();
    }

    update() {
        var thisControl = this;

        thisControl.callback({
            method: $(thisControl.selector).find('.method').val(),
            autocomplete: thisControl.autocompleteShowed() ? 'on' : 'off',
            accept_charset: $(thisControl.selector).find('.accept_charset').val(),
            enctype: $(thisControl.selector).find('.enctype').val(),
        });
    }

    afterRender() {
        var thisControl = this

        // method
        $(thisControl.selector).find('.method, .enctype, .accept_charset').on('change keyup', function() {
            thisControl.update();            
        });

        // captcha on/off
        $(thisControl.selector).find('.autocomplete-switch').click(function() {
            thisControl.toggleAutocomplete();            
        });

        // check if autocomplete is on
        if (thisControl.value.autocomplete != 'on') {
            thisControl.hideAutocomplete();
        }

        // set method
        $(thisControl.selector).find('.method').val(thisControl.value.method);
        $(thisControl.selector).find('.enctype').val((thisControl.value.enctype ? thisControl.value.enctype : 'application/x-www-form-urlencoded'));
        $(thisControl.selector).find('.accept_charset').val((thisControl.value.accept_charset ? thisControl.value.accept_charset : 'UTF-8'));
    }

    getAutocompleteSwitch() {
        var thisControl = this;
        
        return $(thisControl.selector).find('.autocomplete-switch');
    }

    autocompleteShowed() {
        var thisControl = this;

        return thisControl.getAutocompleteSwitch().attr('data-checked') == 'true';
    }

    hideAutocomplete() {
        var thisControl = this;

        thisControl.getAutocompleteSwitch().attr('data-checked', 'false');
        thisControl.getAutocompleteSwitch().find('.material-icons').html('toggle_off');
        thisControl.getAutocompleteSwitch().find('.material-icons').addClass('text-secondary');
        thisControl.getAutocompleteSwitch().find('.material-icons').removeClass('text-primary');

        thisControl.update();
    }

    showAutocomplete() {
        var thisControl = this;

        thisControl.getAutocompleteSwitch().attr('data-checked', 'true');
        thisControl.getAutocompleteSwitch().find('.material-icons').html('toggle_on');
        thisControl.getAutocompleteSwitch().find('.material-icons').removeClass('text-secondary');
        thisControl.getAutocompleteSwitch().find('.material-icons').addClass('text-primary');

        thisControl.update();
    }

    toggleAutocomplete() {
        var thisControl = this;

        if (thisControl.autocompleteShowed()) {
            thisControl.hideAutocomplete();
        } else {
            thisControl.showAutocomplete();
        }
    }
}

window.FormControl = FormControl;