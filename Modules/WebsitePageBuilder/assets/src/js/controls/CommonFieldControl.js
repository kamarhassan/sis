class CommonFieldControl extends Control {
    renderHtml() {
        var thisControl = this;
        var html = $('#CommonFieldControl').html();
        thisControl.selector = ".control-" + thisControl.id;

        html = html.replace("[ID]", thisControl.id);
        html = html.replace("[TITLE]", thisControl.title);
        html = html.replace("[FIELD_ID]", thisControl.value.id);
        html = html.replace(/\[FIELD_NAME\]/g, thisControl.value.fieldName);
        html = html.replace(/\[ICON\]/g, thisControl.value.icon);
        html = html.replace("[LABEL]", thisControl.value.label);
        var div = $('<DIV>').html(html);
        
        return div.html();
    }

    getLabelSwitch() {
        var thisControl = this;
        
        return $(thisControl.selector).find('.label-switch');
    }

    labelShowed() {
        var thisControl = this;

        return thisControl.getLabelSwitch().attr('data-checked') == 'true';
    }

    hideLabel() {
        var thisControl = this;

        thisControl.getLabelSwitch().attr('data-checked', 'false');
        thisControl.getLabelSwitch().find('.material-icons').html('toggle_off');
        thisControl.getLabelSwitch().find('.material-icons').addClass('text-secondary');
        thisControl.getLabelSwitch().find('.material-icons').removeClass('text-primary');

        $(thisControl.selector).find('.field-label-line').addClass('force-hide');

        thisControl.update();
    }

    showLabel() {
        var thisControl = this;

        thisControl.getLabelSwitch().attr('data-checked', 'true');
        thisControl.getLabelSwitch().find('.material-icons').html('toggle_on');
        thisControl.getLabelSwitch().find('.material-icons').removeClass('text-secondary');
        thisControl.getLabelSwitch().find('.material-icons').addClass('text-primary');

        $(thisControl.selector).find('.field-label-line').removeClass('force-hide');

        $(thisControl.selector).find('.field-label-line').show();

        thisControl.update();
    }

    toggleLabel() {
        var thisControl = this;

        if (thisControl.labelShowed()) {
            thisControl.hideLabel();
        } else {
            thisControl.showLabel();
        }
    }

    update() {
        var thisControl = this;

        thisControl.callback({
            fieldName: $(thisControl.selector).find('.field-name').val().trim(),
            label: $(thisControl.selector).find('.field-label').val().trim(),
            labelShowed: thisControl.labelShowed(),
            id: $(thisControl.selector).find('.field-id').val().trim()
        });
    }

    afterRender() {
        var thisControl = this;

        // field name change
        $(thisControl.selector).find('.field-name, .field-label, .field-id').on('change keyup', function() {
            thisControl.update();
        });

        // label on/off
        $(thisControl.selector).find('.label-switch').click(function() {
            thisControl.toggleLabel();            
        });

        // check if label is showed
        if (!thisControl.value.labelShowed) {
            thisControl.hideLabel();
        }
    }
}

window.CommonFieldControl = CommonFieldControl;