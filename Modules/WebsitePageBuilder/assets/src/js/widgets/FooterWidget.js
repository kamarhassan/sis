class FooterWidget extends Widget {
    getHtmlId() {
        return "FooterWidget";
    }

    name() {
        return getI18n('footer');
    }

    icon() {
        return 'fal fa-receipt';
    }
    init() {
        super.init();

        var html = $('#FooterWidgetContent').html();
        var id = this.id;

        var div = $('<div>').html(html);
        div.find('.footer-container').attr('id', id);

        this.contentHtml = div.html();
    }

    events() {
        var id = this.id;

        $("#builder_iframe").contents().find("body").on('click', '#'+id+' a.remove-content-widget', function() {
            $("#builder_iframe")[0].contentWindow.$('#'+id).remove();
        });
    }
}

window.FooterWidget = FooterWidget;