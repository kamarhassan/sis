class YoutubeControl extends Control {
    renderHtml() {
        var thisControl = this;
        var html = $('#YoutubeControl').html();
        thisControl.selector = function() {
            return $(".control-" + thisControl.id);
        };

        html = html.replace("[ID]", thisControl.id);
        html = html.replace("[CODE]", 'https://youtu.be/' + thisControl.value.code);
        html = html.replace("[WIDTH]", thisControl.value.width);
        html = html.replace("[HEIGHT]", thisControl.value.height);

        var div = $('<DIV>').html(html);
        
        return div.html();
    }

    afterRender() {
        var thisControl = this;

        //
        thisControl.selector().find('.alignment').val(thisControl.value.alignment);

        // change code
        thisControl.selector().find('.youtube_url').on('change', function(e) {
            var url = $(this).val();

            if (url == '') {
                alert(getI18n('youtube.please_enter_url'));
                return;
            }
            
            var p = /^(?:https?:\/\/)?(?:m\.|www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/;
            if(!url.match(p)){
                alert(getI18n('youtube.entered_url_not_valid'));
                return;
            }

            var code = url.match(p)[1];

            thisControl.callback.setCode(code);
        });

        // change width
        thisControl.selector().find('.youtube_width').on('change', function(e) {
            var width = $(this).val();

            thisControl.callback.setWidth(width);
        });

        // change height
        thisControl.selector().find('.youtube_height').on('change', function(e) {
            var height = $(this).val();

            thisControl.callback.setHeight(height);
        });
        
        //alignment
        thisControl.selector().find('.alignment').on('change', function(e) {
            var alignment = $(this).val();

            thisControl.callback.setAlignment(alignment);
        });
    }
}

window.YoutubeControl = YoutubeControl;