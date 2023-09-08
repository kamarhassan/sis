class TextStyleControl extends Control {
    groupId() {
        return 'general';
    }

    renderHtml() {
        var thisControl = this;
        var value = this.value;
        var html = $('#TextStyleControl').html();
        
        html = html.replace("[TITLE]", this.title);
        html = html.replace("[ID]", this.id);
        
        var div = $('<DIV>').html(html);
        
        // BOLD
        if (value.font_weight < 800 || value.font_weight != 'bold') {
            $(this).removeClass('active');
        } else {
            $(this).addClass('active');
        }
        $(document).on('click', '.control-' + this.id + ' .text-style-bold', function() {
            if (value.font_weight < 800 || value.font_weight != 'bold') {
                value.font_weight = 'bold';
                
                $(this).addClass('active');
            } else {
                value.font_weight = 400;
                
                $(this).removeClass('active');
            }
            
            thisControl.callback(value);
        });
        
        // ITALIC
        if (value.font_style < 800 || value.font_style != 'bold') {
            $(this).removeClass('active');
        } else {
            $(this).addClass('active');
        }
        $(document).on('click', '.control-' + this.id + ' .text-style-italic', function() {
            if (value.font_style != 'italic') {
                value.font_style = 'italic';
                
                $(this).addClass('active');
            } else {
                value.font_style = 'normal';
                
                $(this).removeClass('active');
            }
            
            thisControl.callback(value);
        });
        
        // UNDERLINE
        if (value.text_decoration.split(' ')[0] != 'underline') {
            $(this).removeClass('active');
        } else {
            $(this).addClass('active');
        }
        $(document).on('click', '.control-' + this.id + ' .text-style-underline', function() {
            $('.control-' + thisControl.id + ' .text-style-strikethrough').removeClass('active');
            
            if (value.text_decoration.split(' ')[0] != 'underline') {
                value.text_decoration = 'underline';
                
                $(this).addClass('active');
            } else {
                value.text_decoration = 'none';
                
                $(this).removeClass('active');
            }
            
            thisControl.callback(value);
        });
        
        // UNDERLINE
        if (value.text_decoration.split(' ')[0] != 'line-through') {
            $(this).removeClass('active');
        } else {
            $(this).addClass('active');
        }
        $(document).on('click', '.control-' + this.id + ' .text-style-strikethrough', function() {
            $('.control-' + thisControl.id + ' .text-style-underline').removeClass('active');
            
            if (value.text_decoration.split(' ')[0] != 'line-through') {
                value.text_decoration = 'line-through';
                
                $(this).addClass('active');
            } else {
                value.text_decoration = 'none';
                
                $(this).removeClass('active');
            }
            
            thisControl.callback(value);
        });
        
        
        return div.html();
    }
}

window.TextStyleControl = TextStyleControl;