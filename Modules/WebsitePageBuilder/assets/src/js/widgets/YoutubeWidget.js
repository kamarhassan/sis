class YoutubeWidget extends Widget {
    getHtmlId() {
        return "YoutubeWidget";
    }

    // get HTML to insert into content
    init() {
        super.init();

        var html = $('#YoutubeWidgetContent').html();
        var id = this.id;

        var div = $('<div>').html(html);
        div.find('.video-container').attr('id', id);

        this.contentHtml = div.html();
        this.innerHtml = div.find('.container').html();
    }

    events() {
        var _this = this;
        var loadYoutubeModal = function() {
            _this.youtubePopup = new PopUp(getI18n('youtube'), 'small');
            _this.youtubePopup.loadHtml(`
                <div id="popup-`+_this.id+`" class="container pb-3 youtube-popup">
                    <p class="py-2">`+getI18n('youtube.enter_youtube_url')+`:</p>
                    <input type="text" name="youtube_url" class="youtube_url mb-3">
                    <button class="btn btn-secondary youtube_save_button">`+getI18n('youtube.save')+`</button>
                </div>
            `);
        };

        $("#builder_iframe").contents().find("body").on('click', '#'+_this.id+' .button-add-youtube', function(e){
            loadYoutubeModal();
        });

        $(document).on('click', '#popup-'+_this.id+' .youtube_save_button', function(e){
            var url = $(this).closest('.youtube-popup').find('[name=youtube_url]').val();

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

            $("#builder_iframe").contents().find("#" + _this.id).html(`
                <div builder-element="YoutubeElement" data-code="`+code+`" class="position-relative" style="width:100%;
                    margin: -20px; padding: 20px;width: calc(100% + 40px);text-align:center;
                ">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/`+code+`" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            `);
            _this.youtubePopup.hide();

            setTimeout(function() {
                currentEditor.selected.unselect()
            }, 100);
        });

        $("#builder_iframe").contents().find("body").on('click', '#'+_this.id+' a.remove-content-widget', function() {
            $(this).closest('[builder-element="BlockElement"]').remove();
        });
    }
}

window.YoutubeWidget = YoutubeWidget;