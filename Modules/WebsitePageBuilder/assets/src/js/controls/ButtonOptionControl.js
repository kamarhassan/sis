class ButtonOptionControl extends Control {
    groupId() {
        return 'action';
    }

    renderHtml() {
        var thisControl = this;

        var background_value = this.value;
        background_value = rgb2hex(this.value.background_color);
        var color_value = this.value;
        color_value = rgb2hex(this.value.text_color);
        var align_value = this.value;
        var line_height = this.value;
        var border_radius_value = parseInt(this.value.border_radius.replace('px', ''));

        var border_style_value = this.value.border_style;
        var border_width_value = parseInt(this.value.border_width.replace('px', ''));
        var border_color_value = this.value;
        border_color_value = rgb2hex(this.value.border_color);

        var border_top_style_value = this.value.border_top_style;
        var border_top_width_value = parseInt(this.value.border_top_width.replace('px', ''));
        var border_top_color_value = this.value;
        border_top_color_value = rgb2hex(this.value.border_top_color);

        var border_right_style_value = this.value.border_right_style;
        var border_right_width_value = parseInt(this.value.border_right_width.replace('px', ''));
        var border_right_color_value = this.value;
        border_right_color_value = rgb2hex(this.value.border_right_color);

        var border_bottom_style_value = this.value.border_bottom_style;
        var border_bottom_width_value = parseInt(this.value.border_bottom_width.replace('px', ''));
        var border_bottom_color_value = this.value;
        border_bottom_color_value = rgb2hex(this.value.border_bottom_color);

        var border_left_style_value = this.value.border_left_style;
        var border_left_width_value = parseInt(this.value.border_left_width.replace('px', ''));
        var border_left_color_value = this.value;
        border_left_color_value = rgb2hex(this.value.border_left_color);

        var width_button_value = parseInt(this.value.width_button);
        var width_button_valuepx = parseInt(this.value.width_button) + 'px';

        var html = $('#ButtonOptionControl').html();
        var input_id = 'background-color_' + this.id;
        var text_input_id = 'text_color_input_' + this.id;
        var border_color_id = 'border_color_input_' + this.id;
        var border_top_color_id = 'border_top_color_input_' + this.id;
        var border_right_color_id = 'border_right_color_input_' + this.id;
        var border_bottom_color_id = 'border_bottom_color_input_' + this.id;
        var border_left_color_id = 'border_left_color_input_' + this.id;
        var ng_binding_solid = 'ng_binding_solid_' + this.id;
        var ng_binding_dotted = 'ng_binding_dotted' + this.id;
        var ng_binding_dashed = 'ng_binding_dashed_' + this.id;

        var ng_binding_solid_top = 'ng_binding_solid_top_' + this.id;
        var ng_binding_dotted_top = 'ng_binding_dotted_top_' + this.id;
        var ng_binding_dashed_top = 'ng_binding_dashed_top_' + this.id;

        var ng_binding_solid_right = 'ng_binding_solid_right_' + this.id;
        var ng_binding_dotted_right = 'ng_binding_dotted_right_' + this.id;
        var ng_binding_dashed_right = 'ng_binding_dashed_right_' + this.id;

        var ng_binding_solid_bottom = 'ng_binding_solid_bottom_' + this.id;
        var ng_binding_dotted_bottom = 'ng_binding_dotted_bottom_' + this.id;
        var ng_binding_dashed_bottom ='ng_binding_dashed_bottom_' + this.id;

        var ng_binding_solid_left = 'ng_binding_solid_left_' + this.id;
        var ng_binding_dotted_left = 'ng_binding_dotted_left_' + this.id;
        var ng_binding_dashed_left = 'ng_binding_dashed_left_' + this.id;

        var input_width_button = 'input_width_button_' + this.id;

        var plus_border_width = 'plus-border-width' + this.id;
        var minus_border_width = 'minus-border-width' + this.id;
        var plus_border_top = 'plus-border-top' + this.id;
        var minus_border_top = 'minus-border-top' + this.id;
        var plus_border_right = 'plus-border-right' + this.id;
        var minus_border_right = 'minus-border-right' + this.id;
        var plus_border_bottom = 'plus-border-bottom' + this.id;
        var minus_border_bottom = 'minus-border-bottom' + this.id;
        var plus_border_left = 'plus-border-left' + this.id;
        var minus_border_left = 'minus-border-left' + this.id;


        var all_border = 'all-border_' + this.id;
        var four_border = 'four-border_' + this.id;

        html = html.replace("[TITLE]", this.title);
        html = html.replace(/\[BACKGROUNDVALUE\]/g, background_value);
        html = html.replace(/\[BACKINPUT_ID\]/g, input_id);

        var div = $('<DIV>').html(html);
        div.find('.button-option-control .background-color-input').attr('value', background_value);
        div.find('.button-option-control .background-color').attr('id', input_id);
        div.find('.button-option-control .background-color').attr('value', background_value);

        div.find('.button-option-control .input-text-color').attr('value', color_value);
        div.find('.button-option-control .text-color').attr('id', text_input_id);
        div.find('.button-option-control .text-color').attr('value', color_value);
        div.find('.button-option-control .border-button').attr('value', border_radius_value);

        div.find('.button-option-control .border-style').html(border_style_value);
        div.find('.button-option-control .border-width-input').attr('value', border_width_value);
        div.find('.button-option-control .border_color_input').attr('value', border_color_value);
        div.find('.button-option-control .border-color').attr('id', border_color_id);
        div.find('.button-option-control .border-color').attr('value', border_color_value);
        div.find('.button-option-control .square-border').css({'border-color': border_color_value, 'border-width': border_width_value, 'border-style': border_style_value});
        div.find('.button-option-control .ng-binding-solid').attr('id', ng_binding_solid);
        div.find('.button-option-control .ng-binding-dotted').attr('id', ng_binding_dotted);
        div.find('.button-option-control .ng-binding-dashed').attr('id', ng_binding_dashed);

        div.find('.button-option-control .border-style-top').html(border_top_style_value);
        div.find('.button-option-control .border-top-width-input').attr('value', border_top_width_value);
        div.find('.button-option-control .border_top_color_input').attr('value', border_top_color_value);
        div.find('.button-option-control .border-color-top').attr('id', border_top_color_id);
        div.find('.button-option-control .border-color-top').attr('value', border_top_color_value);
        div.find('.button-option-control .ng-binding-solid-top').attr('id', ng_binding_solid_top);
        div.find('.button-option-control .ng-binding-dotted-top').attr('id', ng_binding_dotted_top);
        div.find('.button-option-control .ng-binding-dashed-top').attr('id', ng_binding_dashed_top);

        div.find('.button-option-control .border-style-right').html(border_right_style_value);
        div.find('.button-option-control .border-right-width-input').attr('value', border_right_width_value);
        div.find('.button-option-control .border_right_color_input').attr('value', border_right_color_value);
        div.find('.button-option-control .border-color-right').attr('id', border_right_color_id);
        div.find('.button-option-control .border-color-right').attr('value', border_right_color_value);
        div.find('.button-option-control .ng-binding-solid-right').attr('id', ng_binding_solid_right);
        div.find('.button-option-control .ng-binding-dotted-right').attr('id', ng_binding_dotted_right);
        div.find('.button-option-control .ng-binding-dashed-right').attr('id', ng_binding_dashed_right);

        div.find('.button-option-control .border-style-bottom').html(border_bottom_style_value);
        div.find('.button-option-control .border-bottom-width-input').attr('value', border_bottom_width_value);
        div.find('.button-option-control .border_bottom_color_input').attr('value', border_bottom_color_value);
        div.find('.button-option-control .border-color-bottom').attr('id', border_bottom_color_id);
        div.find('.button-option-control .border-color-bottom').attr('value', border_bottom_color_value);
        div.find('.button-option-control .ng-binding-solid-bottom').attr('id', ng_binding_solid_bottom);
        div.find('.button-option-control .ng-binding-dotted-bottom').attr('id', ng_binding_dotted_bottom);
        div.find('.button-option-control .ng-binding-dashed-bottom').attr('id', ng_binding_dashed_bottom);

        div.find('.button-option-control .border-style-left').html(border_right_style_value);
        div.find('.button-option-control .border-left-width-input').attr('value', border_left_width_value);
        div.find('.button-option-control .border_left_color_input').attr('value', border_left_color_value);
        div.find('.button-option-control .border-color-left').attr('id', border_left_color_id);
        div.find('.button-option-control .border-color-left').attr('value', border_left_color_value);
        div.find('.button-option-control .ng-binding-solid-left').attr('id', ng_binding_solid_left);
        div.find('.button-option-control .ng-binding-dotted-left').attr('id', ng_binding_dotted_left);
        div.find('.button-option-control .ng-binding-dashed-left').attr('id', ng_binding_dashed_left);

        div.find('.button-option-control .width-button').html(width_button_valuepx);
        div.find('.button-option-control .color-default-button').attr('value', width_button_value);
        div.find('.button-option-control .color-default-button').attr('id', input_width_button);

        div.find('.button-option-control #plus-border-width').attr('id', plus_border_width);
        div.find('.button-option-control #minus-border-width').attr('id', minus_border_width);
        div.find('.button-option-control #plus-border-top').attr('id', plus_border_top);
        div.find('.button-option-control #minus-border-top').attr('id', minus_border_top);
        div.find('.button-option-control #plus-border-right').attr('id', plus_border_right);
        div.find('.button-option-control #minus-border-right').attr('id', minus_border_right);
        div.find('.button-option-control #plus-border-bottom').attr('id', plus_border_bottom);
        div.find('.button-option-control #minus-border-bottom').attr('id', minus_border_bottom);
        div.find('.button-option-control #plus-border-left').attr('id', plus_border_left);
        div.find('.button-option-control #minus-border-left').attr('id', minus_border_left);

        div.find('.button-option-control .all-border').attr('id', all_border);
        div.find('.button-option-control .four-border').attr('id', four_border);

        //change input range apply image
        $(document).on('change', '#' + input_width_button, function() {
            var width_button = this.value + 'px';
            $('#thongsos').html(width_button);


            thisControl.callback({width_button: width_button});
        });

        //Background color
        $(document).on('change', '#' + input_id, function() {
            var background_color = $(this).val();
            $('#background-color').val(background_color);

            thisControl.callback({background_color: background_color});
        });

        //Text color
        $(document).on('change', '#' + text_input_id, function() {
            var text_color = $(this).val();
            if (text_color != '') {
                $('#text_color_input').val(text_color);
                thisControl.callback({text_color: text_color});
            }
        });

        //Text align
        $(document).on('click', '.align', function() {
            var align = $(this).attr("float");

            $('.align').removeClass('active');
            $(this).addClass('active');

            thisControl.callback({align: align});
        });

        //line height
        $(document).on('click', '.icon-line-height', function() {
            var line_height = $(this).attr("line-height");

            $('.icon-line-height').removeClass('active');
            $(this).addClass('active');

            thisControl.callback({line_height: line_height});
        });

         //Border radius plus
        $(document).on('click', '#plus-border', function() {
            if (border_radius_value < 60) {
                var border_radius = border_radius_value += 1 ;
                var giatri = $('#border-radius').val(border_radius);

                // something else
                if (border_radius >= 60) {
                    giatri.val(60);
                }

                thisControl.callback({border_radius: border_radius});
            }
        });

        //Border radius minus
        $(document).on('click', '#minus-border', function() {
            if (border_radius_value > 0) {
                var border_radius = border_radius_value -= 1;
                var giatri = $('#border-radius').val(border_radius);

                // something else
                if (border_radius <= 0) {
                    giatri.val(0);
                }

                thisControl.callback({border_radius: border_radius});
            }
        });

        //code border color all
        //border color plus
        $(document).on('click', '#' +plus_border_width, function() {
            var input = $(this).closest('.minus-plus-border');
            var giatriborder = $(this).closest('.minus-plus-border').find('#giatriborder').val();

            if (giatriborder < 30) {
                var border_width1 = parseInt(giatriborder);
                var border_width = border_width1 += 1 ;
                var giatri = input.find('#giatriborder').val(border_width);

                $('#square-border').css('border-width', border_width +'px');

                // something else
                if (border_width >= 30) {
                    giatri.val(30);
                    $('#square-border').css('border-width', 30 +'px');
                }

                thisControl.callback({border_width: border_width});
            }
        });

        // border color minus
        $(document).on('click', '#'+ minus_border_width, function() {
            var input = $(this).closest('.minus-plus-border');
            var giatriborder = $(this).closest('.minus-plus-border').find('#giatriborder').val();

            if (giatriborder > 0) {
                var border_width1 = parseInt(giatriborder);
                var border_width = border_width1 -= 1;
                var giatri = input.find('#giatriborder').val(border_width);

                $('#square-border').css('border-width', border_width+'px');

                // something else
                if (border_width <= 0) {
                    giatri.val(0);
                    $('#square-border').css('border-width', 0 +'px');
                }

                thisControl.callback({border_width: border_width});
            }
        });

        //border color click input color
        $(document).on('change', '#' + border_color_id, function() {
            var border_color = $(this).val();

            // something else
            $('#border-color').val(border_color);
            $('#square-border').css('border-color', border_color);


            thisControl.callback({border_color: border_color});
        });

        //change border style dropdown solid
        $(document).on('click', '#' + ng_binding_solid, function() {
            var border_style = $(this).attr('data-value');

            $('.border-style').html(getI18n('solid'));
            $('.border-style').attr('data-style', 'solid');
            $('#square-border').css('border-style', border_style);

            thisControl.callback({border_style: border_style});
        });

        //change border style dropdown dotted
        $(document).on('click', '#' + ng_binding_dotted, function() {
            var border_style = $(this).attr('data-value');

            $('.border-style').html(getI18n('dotted'));
            $('.border-style').attr('data-style', 'dotted');
            $('#square-border').css('border-style', border_style);

            thisControl.callback({border_style: border_style});
        });

        //change border style dropdown dashed
        $(document).on('click', '#' + ng_binding_dashed, function() {
            var border_style = $(this).attr('data-value');

            $('.border-style').html(getI18n('dashed'));
            $('.border-style').attr('data-style', 'dashed');
            $('#square-border').css('border-style', border_style);

            thisControl.callback({border_style: border_style});
        });
        //end border color all

        //code border color top
        //border top color plus
        $(document).on('click', '#'+ plus_border_top, function() {
            var input = $(this).closest('.minus-plus-border');
            var giatribordertop = $(this).closest('.minus-plus-border').find('#giatribordertop').val();

            if (giatribordertop < 30) {
                var border_top_width1 = parseInt(giatribordertop);
                var border_top_width = border_top_width1 += 1 ;
                var giatri = input.find('#giatribordertop').val(border_top_width);

                $('#square-border').css('border-top-width', border_top_width +'px');

                // something else
                if (border_top_width >= 30) {
                    giatri.val(30);
                    $('#square-border').css('border-top-width', 30 +'px');
                }

                thisControl.callback({border_top_width: border_top_width});
            }
        });

        // border top color minus
        $(document).on('click', '#' + minus_border_top, function() {
            var input = $(this).closest('.minus-plus-border');
            var giatribordertop = $(this).closest('.minus-plus-border').find('#giatribordertop').val();

            if (giatribordertop > 0) {
                var border_top_width1 = parseInt(giatribordertop);
                var border_top_width = border_top_width1 -= 1;
                var giatri = input.find('#giatribordertop').val(border_top_width);

                $('#square-border').css('border-top-width', border_top_width+'px');

                // something else
                if (border_top_width <= 0) {
                    giatri.val(0);
                    $('#square-border').css('border-top-width', 0 +'px');
                }

                thisControl.callback({border_top_width: border_top_width});
            }
        });

        //border top color click input color
        $(document).on('change', '#' + border_top_color_id, function() {
            var border_top_color = $(this).val();

            // something else
            $('#border-color-top').val(border_top_color);
            $('#square-border').css('border-top-color', border_top_color);


            thisControl.callback({border_top_color: border_top_color});
        });

        //change border style dropdown solid
        $(document).on('click', '#' + ng_binding_solid_top, function() {
            var border_top_style = $(this).attr('data-value');

            $('.border-style-top').html('Solid');
            $('#square-border').css('border-top-style', border_top_style);

            thisControl.callback({border_top_style: border_top_style});
        });

        //change border style dropdown dotted
        $(document).on('click', '#' + ng_binding_dotted_top, function() {
            var border_top_style = $(this).attr('data-value');

            $('.border-style-top').html('Dotted');
            $('#square-border').css('border-top-style', border_top_style);

            thisControl.callback({border_top_style: border_top_style});
        });

        //change border style dropdown dashed
        $(document).on('click', '#' + ng_binding_dashed_top, function() {
            var border_top_style = $(this).attr('data-value');

            $('.border-style-top').html('Dashed');
            $('#square-border').css('border-top-style', border_top_style);

            thisControl.callback({border_top_style: border_top_style});
        });
        //end border color top

        //code border color right
        //border right color plus
         $(document).on('click', '#'+ plus_border_right, function() {
            var input = $(this).closest('.minus-plus-border');
            var giatriborderright = $(this).closest('.minus-plus-border').find('#giatriborderright').val();

            if (giatriborderright < 30) {
                var border_right_width1 = parseInt(giatriborderright);
                var border_right_width = border_right_width1 += 1 ;
                var giatri = input.find('#giatriborderright').val(border_right_width);

                $('#square-border').css('border-right-width', border_right_width +'px');

                // something else
                if (border_right_width >= 30) {
                    giatri.val(30);
                    $('#square-border').css('border-right-width', 30 +'px');
                }

                thisControl.callback({border_right_width: border_right_width});
            }
        });

        // border right color minus
        $(document).on('click', '#'+ minus_border_right, function() {
            var input = $(this).closest('.minus-plus-border');
            var giatriborderright = $(this).closest('.minus-plus-border').find('#giatriborderright').val();

            if (giatriborderright > 0) {
                var border_right_width1 = parseInt(giatriborderright);
                var border_right_width = border_right_width1 -= 1;
                var giatri = input.find('#giatriborderright').val(border_right_width);

                $('#square-border').css('border-right-width', border_right_width+'px');

                // something else
                if (border_right_width <= 0) {
                    giatri.val(0);
                    $('#square-border').css('border-right-width', 0 +'px');
                }

                thisControl.callback({border_right_width: border_right_width});
            }
        });

        //border right color click input color
        $(document).on('change', '#' + border_right_color_id, function() {
            var border_right_color = $(this).val();

            // something else
            $('#border-color-right').val(border_right_color);
            $('#square-border').css('border-right-color', border_right_color);


            thisControl.callback({border_right_color: border_right_color});
        });

        //change border style dropdown solid
        $(document).on('click', '#' + ng_binding_solid_right, function() {
            var border_right_style = $(this).attr('data-value');

            $('.border-style-right').html(getI18n('solid'));
            $('#square-border').css('border-right-style', border_right_style);

            thisControl.callback({border_right_style: border_right_style});
        });

        //change border style dropdown dotted
        $(document).on('click', '#' + ng_binding_dotted_right, function() {
            var border_right_style = $(this).attr('data-value');

            $('.border-style-right').html(getI18n('dotted'));
            $('#square-border').css('border-right-style', border_right_style);

            thisControl.callback({border_right_style: border_right_style});
        });

        //change border style dropdown dashed
        $(document).on('click', '#' + ng_binding_dashed_right, function() {
            var border_right_style = $(this).attr('data-value');

            $('.border-style-right').html(getI18n('dashed'));
            $('#square-border').css('border-right-style', border_right_style);

            thisControl.callback({border_right_style: border_right_style});
        });
        //end border color right

        //code border color bottom
        //border bottom color plus
         $(document).on('click', '#' + plus_border_bottom, function() {
            var input = $(this).closest('.minus-plus-border');
            var giatriborderbottom = $(this).closest('.minus-plus-border').find('#giatriborderbottom').val();

            if (giatriborderbottom < 30) {
                var border_bottom_width1 = parseInt(giatriborderbottom);
                var border_bottom_width = border_bottom_width1 += 1 ;
                var giatri = input.find('#giatriborderbottom').val(border_bottom_width);

                $('#square-border').css('border-bottom-width', border_bottom_width +'px');

                // something else
                if (border_bottom_width >= 30) {
                    giatri.val(30);
                    $('#square-border').css('border-bottom-width', 30 +'px');
                }

                thisControl.callback({border_bottom_width: border_bottom_width});
            }
        });

        // border bottom color minus
        $(document).on('click', '#' + minus_border_bottom, function() {
            var input = $(this).closest('.minus-plus-border');
            var giatriborderbottom = $(this).closest('.minus-plus-border').find('#giatriborderbottom').val();

            if (giatriborderbottom > 0) {
                var border_bottom_width1 = parseInt(giatriborderbottom);
                var border_bottom_width = border_bottom_width1 -= 1;
                var giatri = input.find('#giatriborderbottom').val(border_bottom_width);

                $('#square-border').css('border-bottom-width', border_bottom_width+'px');

                // something else
                if (border_bottom_width <= 0) {
                    giatri.val(0);
                    $('#square-border').css('border-bottom-width', 0 +'px');
                }

                thisControl.callback({border_bottom_width: border_bottom_width});
            }
        });

        //border bottom color click input color
        $(document).on('change', '#' + border_bottom_color_id, function() {
            var border_bottom_color = $(this).val();

            // something else
            $('#border-color-bottom').val(border_bottom_color);
            $('#square-border').css('border-bottom-color', border_bottom_color);


            thisControl.callback({border_bottom_color: border_bottom_color});
        });

        //change border style dropdown solid
        $(document).on('click', '#' + ng_binding_solid_bottom, function() {
            var border_bottom_style = $(this).attr('data-value');

            $('.border-style-bottom').html(getI18n('solid'));
            $('#square-border').css('border-bottom-style', border_bottom_style);

            thisControl.callback({border_bottom_style: border_bottom_style});
        });

        //change border style dropdown dotted
        $(document).on('click', '#' + ng_binding_dotted_bottom, function() {
            var border_bottom_style = $(this).attr('data-value');

            $('.border-style-bottom').html(getI18n('dotted'));
            $('#square-border').css('border-bottom-style', border_bottom_style);

            thisControl.callback({border_bottom_style: border_bottom_style});
        });

        //change border style dropdown dashed
        $(document).on('click', '#' + ng_binding_dashed_bottom, function() {
            var border_bottom_style = $(this).attr('data-value');

            $('.border-style-bottom').html(getI18n('dashed'));
            $('#square-border').css('border-bottom-style', border_bottom_style);

            thisControl.callback({border_bottom_style: border_bottom_style});
        });
        //end border color bottom

        //code border color left
        //border left color plus
         $(document).on('click', '#' + plus_border_left, function() {
            var input = $(this).closest('.minus-plus-border');
            var giatriborderleft = $(this).closest('.minus-plus-border').find('#giatriborderleft').val();

            if (giatriborderleft < 30) {
                var border_left_width1 = parseInt(giatriborderleft);
                var border_left_width = border_left_width1 += 1 ;
                var giatri = input.find('#giatriborderleft').val(border_left_width);

                $('#square-border').css('border-left-width', border_left_width +'px');

                // something else
                if (border_left_width >= 30) {
                    giatri.val(30);
                    $('#square-border').css('border-left-width', 30 +'px');
                }

                thisControl.callback({border_left_width: border_left_width});
            }
        });

        // border left color minus
        $(document).on('click', '#' + minus_border_left, function() {
            var input = $(this).closest('.minus-plus-border');
            var giatriborderleft = $(this).closest('.minus-plus-border').find('#giatriborderleft').val();

            if (giatriborderleft > 0) {
                var border_left_width1 = parseInt(giatriborderleft);
                var border_left_width = border_left_width1 -= 1;
                var giatri = input.find('#giatriborderleft').val(border_left_width);

                $('#square-border').css('border-left-width', border_left_width+'px');

                // something else
                if (border_left_width <= 0) {
                    giatri.val(0);
                    $('#square-border').css('border-left-width', 0 +'px');
                }

                thisControl.callback({border_left_width: border_left_width});
            }
        });

        //border left color click input color
        $(document).on('change', '#' + border_left_color_id, function() {
            var border_left_color = $(this).val();

            // something else
            $('#border-color-left').val(border_left_color);
            $('#square-border').css('border-left-color', border_left_color);


            thisControl.callback({border_left_color: border_left_color});
        });

        //change border style dropdown solid
        $(document).on('click', '#' + ng_binding_solid_left, function() {
            var border_left_style = $(this).attr('data-value');

            $('.border-style-left').html(getI18n('solid'));
            $('#square-border').css('border-left-style', border_left_style);

            thisControl.callback({border_left_style: border_left_style});
        });

        //change border style dropdown dotted
        $(document).on('click', '#' + ng_binding_dotted_left, function() {
            var border_left_style = $(this).attr('data-value');

            $('.border-style-left').html(getI18n('dotted'));
            $('#square-border').css('border-left-style', border_left_style);

            thisControl.callback({border_left_style: border_left_style});
        });

        //change border style dropdown dashed
        $(document).on('click', '#' + ng_binding_dashed_left, function() {
            var border_left_style = $(this).attr('data-value');

            $('.border-style-left').html(getI18n('dashed'));
            $('#square-border').css('border-left-style', border_left_style);

            thisControl.callback({border_left_style: border_left_style});
        });
        //end border color left
        //click all border
        $(document).on('click', '#' + all_border, function() {
            var border_style = $('.border-style').attr('data-style');
            var giatri = $('#giatriborder').val();
            var border_color = $('#border-color').val();
            //top
            $('.border-style-top').html(border_style);
            $('.border-style-top').attr('data-style', border_style);
            $('#giatribordertop').val(giatri);
            $('#border-top-color').val(border_color);
            $('.border-color-top').val(border_color);

            //bottom
            $('.border-style-bottom').html(border_style);
            $('.border-style-bottom').attr('data-style', border_style);
            $('#giatriborderbottom').val(giatri);
            $('#border-bottom-color').val(border_color);
            $('.border-color-bottom').val(border_color);

            //right
            $('.border-style-right').html(border_style);
            $('.border-style-right').attr('data-style', border_style);
            $('#giatriborderright').val(giatri);
            $('#border-right-color').val(border_color);
            $('.border-color-right').val(border_color);
            //left
            $('.border-style-left').html(border_style);
            $('.border-style-left').attr('data-style', border_style);
            $('#giatriborderleft').val(giatri);
            $('#border-left-color').val(border_color);
            $('.border-color-left').val(border_color);
        });

        //click four border
        $(document).on('click', '#' + four_border, function() {
            $('.border-style').html(getI18n('solid'));
            $('.border-style').attr('data-style', 'solid');
            $('#giatriborder').val(0);
            $('#border-color').val('#ffffff');
            $('.border-color').val('#ffffff');

            $('#square-border').css('border-style', 'solid');
            $('#square-border').css('border-width', 0 +'px');

            thisControl.callback({border_style: 'solid', border_width: 0, border_color: '#ffffff'});
        });

        return div.html();
    }
}

window.ButtonOptionControl = ButtonOptionControl;