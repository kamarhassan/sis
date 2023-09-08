class ImageSizeControl extends Control {
    renderHtml() {
        var thisControl = this;
        var html = $('#ImageSizeControl').html();
        thisControl.selector = ".control-" + thisControl.id;

        html = html.replace("[ID]", thisControl.id);
        html = html.replace("[TITLE]", thisControl.title);

        var div = $('<DIV>').html(html);
        
        return div.html();
    }

    getValues() {
        var thisControl = this;
        var width = thisControl.value.width;
        var height = thisControl.value.height;

        var selectedOption = $(thisControl.selector).find('[value="' + width + 'x' + height + '"]');
        
        $(thisControl.selector).find('.custom-width').val(width);
        $(thisControl.selector).find('.custom-height').val(height);

        if (!selectedOption.length) {
            $(thisControl.selector).find('select.image-sizes').val('custom').change();
        } else {
            $(thisControl.selector).find('select.image-sizes').val(selectedOption.attr('value'));
        }
    }

    update() {
        var thisControl = this;
        var width;
        var height;

        if ($(thisControl.selector).find('select.image-sizes').val() != 'custom') {
            $(thisControl.selector).find('.custom-width').val($(thisControl.selector).find('select.image-sizes').val().split('x')[0]);
            $(thisControl.selector).find('.custom-height').val($(thisControl.selector).find('select.image-sizes').val().split('x')[1]);
        }

        width = $(thisControl.selector).find('.custom-width').val();
        height = $(thisControl.selector).find('.custom-height').val();

        thisControl.callback({
            width: width,
            height: height,
        });
    }

    afterRender() {
        var thisControl = this;

        // method
        $(thisControl.selector).find('select.image-sizes').on('change', function() {
            if ($(this).val() == 'custom') {
                $(thisControl.selector).find('.custom-size').show();
            } else {
                $(thisControl.selector).find('.custom-size').hide();
            }

            thisControl.update();
        });
        $(thisControl.selector).find('.custom-size input').on('change', function() {
            thisControl.update();
        });

        // get values
        thisControl.getValues();
    }
}

window.ImageSizeControl = ImageSizeControl;