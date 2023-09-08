class TableBlockControl extends Control {
    renderHtml() {
        var thisControl = this;
        var html = $('#TableBlockControl').html();
        thisControl.selector = ".control-" + thisControl.id;

        html = html.replace("[ID]", thisControl.id);
        html = html.replace("[TITLE]", thisControl.title);

        var div = $('<DIV>').html(html);
        
        return div.html();
    }

    getValues() {
        var thisControl = this;

        $(thisControl.selector).find('.theme').val(thisControl.value);
    }

    update() {
        var thisControl = this;

        thisControl.callback($(thisControl.selector).find('.theme').val());
    }

    afterRender() {
        var thisControl = this;

        // get value
        thisControl.getValues();

        // change style
        $(thisControl.selector).find('.theme').on('change', function(e) {
            e.preventDefault();

            thisControl.update();
        });
    }
}

window.TableBlockControl = TableBlockControl;