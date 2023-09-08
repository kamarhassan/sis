class LineHeightControl extends Control {
    groupId() {
        return 'general';
    }

    renderHtml() {
        var thisControl = this;

        var line_height = this.value;

        var html = $('#LineHeightControl').html();
        html = html.replace("[TITLE]", this.title);

        $(document).on('click', '.icon-line-height', function() {
            var line_height = $(this).attr("line-height");

            $('.icon-line-height').removeClass('active');
            $(this).addClass('active');

            thisControl.callback(line_height);
        });

        return html;

    }
}

window.LineHeightControl = LineHeightControl;