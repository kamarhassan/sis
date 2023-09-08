class DivOptionControl extends Control {
    groupId() {
        return 'general';
    }

    renderHtml() {
        var thisControl = this;

        var html = $('#DivOptionControl').html();

        var minus_div = 'minus-div_' + this.id;
        var plus_div = 'plus-div_' + this.id;

        var div = $('<DIV>').html(html);

        div.find('.divider-mode-container .minus-div').attr('id', minus_div);
        div.find('.divider-mode-container .plus-div').attr('id', plus_div);

        //padding all plus
        $(document).on('click', '#' + plus_div, function() {
            var height_value = $('#height-div').val();

            if (height_value < 100) {
                var height1 = parseInt(height_value);
                var height = height1 += 5 ;

                var giatri = $('#height-div').val(height);

                // something else
                if (height >= 100) {
                    giatri.val(100);
                }

                thisControl.callback({height: height});
            }
        });

        //padding add minus
        $(document).on('click', '#' + minus_div, function() {
            var height_value = $('#height-div').val();

            if (height_value > 0) {
                var height = height_value -= 5;

                var giatri = $('#height-div').val(height);

                // something else
                if (height <= 0) {
                    giatri.val(0);
                }

                thisControl.callback({height: height});
            }
        });

        return div.html();

    }
}

window.DivOptionControl = DivOptionControl;