class PricingTableControl extends Control {
    renderHtml() {
        var thisControl = this;
        var html = $('#PricingTableControl').html();
        thisControl.selector = function() {
            return $(".control-" + thisControl.id);
        };

        html = html.replace("[ID]", thisControl.id);
        html = html.replace("[TITLE]", thisControl.title);

        var div = $('<DIV>').html(html);
        
        return div.html();
    }

    afterRender() {
        var thisControl = this;

        // get value
        thisControl.selector().find('.pricing-preview').attr('data-style', thisControl.value);

        // change style
        thisControl.selector().find('.pricing-preview').on('click', function(e) {
            e.preventDefault();

            thisControl.selector().find('.pricing_styles').toggle();
        });

        // change style
        thisControl.selector().find('.pricing_styles button').on('click', function(e) {
            e.preventDefault();
            var style = $(this).attr('data-style');

            thisControl.selector().find('.pricing-preview').attr('data-style', style);

            // 
            thisControl.callback(style);
        });

        $(document).on('click', function(event) { 
            var $target = $(event.target);
            if(!$target.closest('.pricing-styles-select').length && 
            thisControl.selector().find('.pricing_styles').is(":visible")) {
                thisControl.selector().find('.pricing_styles').hide();
            }        
        });
    }
}

window.PricingTableControl = PricingTableControl;