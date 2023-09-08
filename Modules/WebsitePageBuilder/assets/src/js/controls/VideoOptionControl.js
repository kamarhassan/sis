class VideoOptionControl extends Control {
    groupId() {
        return 'general';
    }

    renderHtml() {
        var thisControl = this;
        var link_video = this.value.src;

        var html = $('#VideoOptionControl').html();
        html = html.replace("[TITLE]", this.title);

        var div = $('<div>').html(html);

        var input = 'input-url-link-video' + this.id;
        div.find('.action-video .input-url-link-video').attr('id', input);

        div.find('.action-video .input-url-link-video').val(link_video);

        $(document).on('change', '#'+ input, function() {
            var link = $(this).val();

            thisControl.callback({src: link});
        });

        return div.html();
    }
}

window.VideoOptionControl = VideoOptionControl;