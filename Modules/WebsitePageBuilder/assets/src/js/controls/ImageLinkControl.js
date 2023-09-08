class ImageLinkControl extends Control {
    renderHtml() {
        var thisControl = this;
        var html = $('#ImageLinkControl').html();
        thisControl.selector = ".control-" + thisControl.id;

        html = html.replace("[ID]", thisControl.id);
        html = html.replace("[TITLE]", thisControl.title);

        var div = $('<DIV>').html(html);
        
        return div.html();
    }

    getValues() {
        var thisControl = this;
        var url = thisControl.value.url;

        $(thisControl.selector).find('.image-link').val(url);
    }

    update() {
        var thisControl = this;

        thisControl.callback({
            url: $(thisControl.selector).find('.image-link').val(),
        });
    }

    afterRender() {
        var thisControl = this;

        // copy url
        $(thisControl.selector).find('.copy-url').on('click', function(e) {
            e.preventDefault();

            $(thisControl.selector).find('.image-link')[0].select();
            document.execCommand('copy');

            var content = getI18n('copy_url_success'); //'Copy url successfully!';

            currentEditor.notificationArea(content);
        });
        $(thisControl.selector).find('.image-link').on('change', function(e) {
            thisControl.update();
        });

        // get values
        thisControl.getValues();

        // readonly
        if (thisControl.value.readonly != null && thisControl.value.readonly === true) {
            $('.control-'+ thisControl.id+' input').prop('readonly', true);
        }
    }
}

window.ImageLinkControl = ImageLinkControl;