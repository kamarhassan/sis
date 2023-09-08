class ButtonControl extends Control {
    renderHtml() {
        var thisControl = this;
        var html = $('#ButtonControl').html();
        thisControl.selector = function() {
            return $(".control-" + thisControl.id);
        };

        html = html.replace("[ID]", thisControl.id);
        html = html.replace("[TITLE]", thisControl.title);

        var div = $('<DIV>').html(html);
        
        return div.html();
    }

    styles() {
        return {
            'style_1': {
                'border': '1.5px solid rgb(33, 150, 243)',
                'background': 'rgb(33, 150, 243)',
                'border-radius': '3px',
                'color': '#fff',
            },
            'style_2': {
                'border': '1.5px solid #353634',
                'background': '#353634',
                'border-radius': '3px',
                'color': '#fff',
            },
            'style_3': {
                'border': '1.5px solid #e4894f',
                'background': '#e4894f',
                'border-radius': '3px',
                'color': '#fff',
            },
            'style_4': {
                'border': '1.5px solid #ababab',
                'background': '#ababab',
                'border-radius': '3px',
                'color': '#fff',
            },
            'style_5': {
                'border': '1.5px solid #f7c94e',
                'background': '#f7c94e',
                'border-radius': '3px',
                'color': '#fff',
            },
            'style_6': {
                'border': '1.5px solid #5d7cc5',
                'background': '#5d7cc5',
                'border-radius': '3px',
                'color': '#fff',
            },
            'style_7': {
                'border': '1.5px solid #84b35d',
                'background': '#84b35d',
                'border-radius': '3px',
                'color': '#fff',
            },
            'style_8': {
                'border': '1.5px solid #82a3cb',
                'background': '#a7bfe1',
                'border-radius': '3px',
                'color': '#2a3048',
            },
            'style_9': {
                'border': '1.5px solid #404041',
                'background': '#818281',
                'border-radius': '3px',
                'color': '#2a3048',
            },
            'style_10': {
                'border': '1.5px solid #cd936c',
                'background': '#ebaf90',
                'border-radius': '3px',
                'color': '#2a3048',
            },
            'style_11': {
                'border': '1.5px solid #afafb0',
                'background': '#c3c3c3',
                'border-radius': '3px',
                'color': '#2a3048',
            },
            'style_12': {
                'border': '1.5px solid #e5ce86',
                'background': '#f8d78e',
                'border-radius': '3px',
                'color': '#2a3048',
            },
            'style_13': {
                'border': '1.5px solid #6780b8',
                'background': '#93a2d3',
                'border-radius': '3px',
                'color': '#2a3048',
            },
            'style_14': {
                'border': '1.5px solid #9fb98d',
                'background': '#aacb95',
                'border-radius': '3px',
                'color': '#2a3048',
            },
        }
    }

    applyStyle(element, style) {
        var thisControl = this;        
        if (!style) {
            style = 'style_1';
            
        }

        var css = thisControl.styles()[style];

        for (const [key, value] of Object.entries(css)) {
            element.css(key, value);
        }
    }

    afterRender() {
        var thisControl = this;

        // get value
        thisControl.applyStyle(thisControl.selector().find('.button-preview'), thisControl.value);
        thisControl.selector().find('.button_styles button').each(function(button) {
            thisControl.applyStyle($(this), $(this).attr('data-style'));
        });

        // change style
        thisControl.selector().find('.button-preview').on('click', function(e) {
            e.preventDefault();

            thisControl.selector().find('.button_styles').toggle();
        });

        // change style
        thisControl.selector().find('.button_styles button').on('click', function(e) {
            e.preventDefault();
            var style = $(this).attr('data-style');

            thisControl.applyStyle(thisControl.selector().find('.button-preview'), style);
            thisControl.selector().find('.button_styles').hide();

            thisControl.callback(thisControl, style);
        });

        $(document).on('click', function(event) { 
            var $target = $(event.target);
            if(!$target.closest('.button-styles-select').length && 
            $('.button_styles').is(":visible")) {
              $('.button_styles').hide();
            }        
        });
    }
}

window.ButtonControl = ButtonControl;