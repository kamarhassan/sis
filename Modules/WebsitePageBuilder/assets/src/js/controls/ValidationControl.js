class ValidationControl extends Control {
    groupId() {
        return 'validation';
    }

    renderHtml() {
        var thisControl = this;
        var html = $('#ValidationControl').html();
        thisControl.selector = ".control-" + thisControl.id;

        html = html.replace("[ID]", thisControl.id);
        html = html.replace("[TITLE]", thisControl.title);
        html = html.replace("[MIN_LENGTH]", thisControl.value.minLength);
        html = html.replace("[MAX_LENGTH]", thisControl.value.maxLength);
        html = html.replace("[REGEXP]", thisControl.value.regexp);
        var div = $('<DIV>').html(html);
        
        return div.html();
    }

    getRequiredSwitch() {
        var thisControl = this;
        
        return $(thisControl.selector).find('.required-switch');
    }

    requiredChecked() {
        var thisControl = this;

        return thisControl.getRequiredSwitch().attr('data-checked') == 'true';
    }

    requiredOff() {
        var thisControl = this;

        thisControl.getRequiredSwitch().attr('data-checked', 'false');
        thisControl.getRequiredSwitch().find('.material-icons').html('toggle_off');
        thisControl.getRequiredSwitch().find('.material-icons').addClass('text-secondary');
        thisControl.getRequiredSwitch().find('.material-icons').removeClass('text-primary');

        $(thisControl.selector).find('.validation-rules').hide();

        thisControl.update();
    }

    requiredOn() {
        var thisControl = this;

        thisControl.getRequiredSwitch().attr('data-checked', 'true');
        thisControl.getRequiredSwitch().find('.material-icons').html('toggle_on');
        thisControl.getRequiredSwitch().find('.material-icons').removeClass('text-secondary');
        thisControl.getRequiredSwitch().find('.material-icons').addClass('text-primary');

        $(thisControl.selector).find('.validation-rules').show();

        thisControl.update();
    }

    requiredToogle() {
        var thisControl = this;

        if (thisControl.requiredChecked()) {
            thisControl.requiredOff();            
        } else {
            thisControl.requiredOn();            
        }
    }

    update() {
        var thisControl = this;

        thisControl.callback({
            required: thisControl.requiredChecked(),
            minLength: $(thisControl.selector).find('.min-length').val(),
            maxLength: $(thisControl.selector).find('.max-length').val(),
            regexp: $(thisControl.selector).find('.regexp').val(),
        });
    }

    import() {
        var thisControl = this;

        // is required
        if (!thisControl.value.required) {
            thisControl.requiredOff();
        }
    }

    afterRender() {
        var thisControl = this;

        // import value
        thisControl.import();

        // required switch
        thisControl.getRequiredSwitch().click(function() {
            thisControl.requiredToogle();
        });
        
        // keyup change
        $(thisControl.selector).find('.min-length, .max-length, .regexp').on('change keyup', function() {
            thisControl.update();
        });
    }
}

window.ValidationControl = ValidationControl;