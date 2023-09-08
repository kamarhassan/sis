// Block option control
class BlockOptionControl extends Control {
    groupId() {
        return 'block_options';
    }

    afterRender() {
        var _this = this;

        var top_value = parseInt(this.value.top.replace('px', ''));
        var bottom_value = parseInt(this.value.bottom.replace('px', ''));
        var right_value = parseInt(this.value.right.replace('px', ''));
        var left_value = parseInt(this.value.left.replace('px', ''));

        if (top_value != bottom_value || bottom_value != right_value || right_value != left_value) {
            this.showAll();
        }
    }

    showAll() {
        $('.control-' + this.id).find('label.check-all-padding').addClass('andi');
        $('.control-' + this.id).find('label.check-4-padding').addClass('hienthi');
        $('.control-' + this.id).find('.all-padding-section').addClass('andi');
        $('.control-' + this.id).find('.four-padding-section').addClass('hienlen');
    }

    renderHtml() {
        var thisControl = this;

        var maxValue = 1000;
        var top_value = parseInt(this.value.top.replace('px', ''));
        var bottom_value = parseInt(this.value.bottom.replace('px', ''));
        var right_value = parseInt(this.value.right.replace('px', ''));
        var left_value = parseInt(this.value.left.replace('px', ''));
        var padding_value = parseInt(this.value.padding.replace('px', ''));
        $('#square-block').css('padding', (padding_value >= 30 ? 30 : padding_value) +'px');

        var html = $('#BlockOptionControl').html();
        html = html.replace("[ID]", this.id);
        html = html.replace("[TITLE]", this.title);
        html = html.replace("[PADDING]", padding_value);
        html = html.replace("[TOP]", top_value);
        html = html.replace("[BOTTOM]", bottom_value);
        html = html.replace("[RIGHT]", right_value);
        html = html.replace("[LEFT]", left_value);

        var minus_all = 'minus-all_' + this.id;
        var plus_all = 'plus-all_' + this.id;
        var minus_top = 'minus-top_' + this.id;
        var plus_top = 'plus-top_' + this.id;
        var minus_bottom = 'minus-bottom_' + this.id;
        var plus_bottom = 'plus-bottom_' + this.id;
        var minus_right = 'minus-right_' + this.id;
        var plus_right = 'plus-right_' + this.id;
        var minus_left = 'minus-left_' + this.id;
        var plus_left = 'plus-left_' + this.id;
        var all_padding = 'all-padding_' + this.id;
        var _4_padding = '_4-padding_' + this.id;

        var div = $('<DIV>').html(html);
        div.find('.block-option-control .plus-all').attr('id', plus_all);
        div.find('.block-option-control .minus-all').attr('id', minus_all);
        div.find('.block-option-control .plus-top').attr('id', plus_top);
        div.find('.block-option-control .minus-top').attr('id', minus_top);
        div.find('.block-option-control .plus-bottom').attr('id', plus_bottom);
        div.find('.block-option-control .minus-bottom').attr('id', minus_bottom);
        div.find('.block-option-control .plus-right').attr('id', plus_right);
        div.find('.block-option-control .minus-right').attr('id', minus_right);
        div.find('.block-option-control .plus-left').attr('id', plus_left);
        div.find('.block-option-control .minus-left').attr('id', minus_left);
        div.find('.block-option-control .all-padding').attr('id', all_padding);
        div.find('.block-option-control ._4-padding').attr('id', _4_padding);


        //click all padding button
        $(document).on('click', '#' + all_padding, function() {
            var giatri = $('#giatri').val();
            var value_top = $('#value-top').val(giatri);
            var value_bottom = $('#value-bottom').val(giatri);
            var value_right = $('#value-right').val(giatri);
            var value_left = $('#value-left').val(giatri);

            $('#square-block').css('padding', (giatri >= 30 ? 30 : giatri) +'px');

            thisControl.callback({top: value_top, bottom: value_bottom, right: value_right, left: value_left});
        });

        var _this = this;
        var setValue = function(pos, value) {
            var max = 999;
            if (value <= 0) {
                value = 0;
            }

            if(value >= max) {
                value = max;
            }

            $('.control-' + _this.id + ' .value-' + pos).val(value);
            thisControl.callback(JSON.parse('{"'+pos+'":'+value+'}'));

            var css;
            if (pos == 'padding') {
                css = 'padding';
            } else {
                css = 'padding-'+pos;
            }

            if (value >= 30) {
                $('.control-' + _this.id + ' #square-block').css(css, 30 +'px');
            } else {
                $('.control-' + _this.id + ' #square-block').css(css, value +'px');
            }
        };

        //click all padding button
        $(document).on('click', '#' + _4_padding, function() {
            var value_top = div.find('.block-option-control #value-top');

            var top_value = $('#value-top').val();
            var bottom_value = $('#value-bottom').val();
            var right_value = $('#value-right').val();
            var left_value = $('#value-left').val();

            var max_padding = top_value;

            if(max_padding < bottom_value) {
                max_padding = bottom_value;
            } else if(max_padding < right_value){
                max_padding = right_value;
            } else if(max_padding < left_value) {
                max_padding = left_value;
            }

            setValue('padding', max_padding);
       });

        $(document).on('change', '.control-' + _this.id + ' .value-left', function() {
            var value = $(this).val();

            setValue('left', value);
        });

        $(document).on('change', '.control-' + _this.id + ' .value-right', function() {
            var value = $(this).val();

            setValue('right', value);
        });

        $(document).on('change', '.control-' + _this.id + ' .value-top', function() {
            var value = $(this).val();

            setValue('top', value);
        });

        $(document).on('change', '.control-' + _this.id + ' .value-bottom', function() {
            var value = $(this).val();

            setValue('bottom', value);
        });

        $(document).on('change', '.control-' + _this.id + ' .value-padding', function() {
            var value = $(this).val();

            setValue('padding', value);
        });

        //padding all plus
        $(document).on('click', '#' + plus_all, function() {
            var value = $('.control-' + _this.id + ' .value-padding').val();
            var value = parseInt(value);
            var value = value += 5 ;

            setValue('padding', value);
        });

        //padding add minus
        $(document).on('click', '#' + minus_all, function() {
            var value = $('.control-' + _this.id + ' .value-padding').val();
            var value = parseInt(value);
            var value = value -= 5 ;

            setValue('padding', value);
        });

        //padding top plus
        $(document).on('click', '#' + plus_top, function() {
            var value = $('.control-' + _this.id + ' .value-top').val();
            var value = parseInt(value);
            var value = value += 5 ;

            setValue('top', value);
        });

        //padding top minus
        $(document).on('click', '#' + minus_top, function() {
            var value = $('.control-' + _this.id + ' .value-top').val();
            var value = parseInt(value);
            var value = value -= 5 ;

            setValue('top', value);
        });

        //padding bottom plus
        $(document).on('click', '#' + plus_bottom, function() {
            var value = $('.control-' + _this.id + ' .value-bottom').val();
            var value = parseInt(value);
            var value = value += 5 ;

            setValue('bottom', value);
        });

        //padding bottom minus
        $(document).on('click', '#' + minus_bottom, function() {
            var value = $('.control-' + _this.id + ' .value-bottom').val();
            var value = parseInt(value);
            var value = value -= 5 ;

            setValue('bottom', value);
        });

        //padding right plus
        $(document).on('click', '#' + plus_right, function() {
            var value = $('.control-' + _this.id + ' .value-right').val();
            var value = parseInt(value);
            var value = value += 5 ;

            setValue('right', value);
        });

        //padding right minus
        $(document).on('click', '#' + minus_right, function() {
            var value = $('.control-' + _this.id + ' .value-right').val();
            var value = parseInt(value);
            var value = value -= 5 ;

            setValue('right', value);
        });

        //padding left plus
        $(document).on('click', '#' + plus_left, function() {
            var value = $('.control-' + _this.id + ' .value-left').val();
            var value = parseInt(value);
            var value = value += 5 ;

            setValue('left', value);
        });

        //padding left minus
        $(document).on('click', '#' + minus_left, function() {
            var value = $('.control-' + _this.id + ' .value-left').val();
            var value = parseInt(value);
            var value = value -= 5 ;

            setValue('left', value);
        });

        return div.html();

    }
}

window.BlockOptionControl = BlockOptionControl;