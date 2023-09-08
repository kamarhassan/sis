class HtmlWidget extends Widget {
    getHtmlId() {
        return "HtmlWidget";
    }

    name() {
        return getI18n('html');
    }

    icon() {
        return 'fal fa-file-code';
    }
    // get HTML to insert into content
    init() {
        super.init();

        var html = $('#HtmlWidgetContent').html();
        var id = this.id;

        var div = $('<div>').html(html);
        div.find('.html-container').attr('id', id);

        this.contentHtml = div.html();
    }

    events() {
        var id = this.id;

        // Event click element html
        $("#builder_iframe").contents().find("body").on('click', '#'+id+' .description', function() {
            //set editor with ace js
            //editor.viewSourceHtml();
        });

    }
}

window.HtmlWidget = HtmlWidget;