class VideoWidget extends Widget {
    getHtmlId() {
        return "VideoWidget";
    }

    name() {
        return getI18n('video');
    }

    icon() {
        return 'fal fa-film';
    }
    // get HTML to insert into content
    init() {
        super.init();

        var html = $('#VideoWidgetContent').html();
        var id = this.id;

        var div = $('<div>').html(html);
        div.find('.video-container').attr('id', id);

        this.contentHtml = div.html();
    }

    events() {
        var id = this.id;

        function showVideoPopup(tab = "upload") {
            var imagePopup = new PopUp(getI18n('upload_video'), 'auto');
            var contentPopup = '<div id="video-popup-'+id+'">' + $('#VideoToolbox').html() + '</div>';

            if ( tab == "upload") {
                imagePopup.loadHtml(contentPopup);
                setTimeout(function() {
                    $('.nav-content').removeClass('active');
                    $('.nav-tab').removeClass('active');
                    $('#home').addClass('active show');
                    $('.home').addClass('active');
                }, 1000);
            }
            else if ( tab == "url") {
                imagePopup.loadHtml(contentPopup);
                $('.nav-content').removeClass('active');
                $('.nav-tab').removeClass('active');
                $('#menu1').addClass('active show');
                $('.menu1').addClass('active');
            }
        }

        function saveVideoUpload() {
            var image = $('input[name="file_upload_video"]')[0].files[0];
            var type = 'upload';
            var idContent = $("#builder_iframe")[0].contentWindow.$('#'+id);
            var formData = new FormData();
            formData.append('file', image);
            formData.append('_token', CSRF_TOKEN);
            formData.append('assetType', type);

            if (currentEditor.data !== null) {
                for ( var key in currentEditor.data ) {
                   formData.append(key, currentEditor.data[key]);
               }
            }

            var requestMethod = editor.uploadAssetMethod;
            var notSupportedMethods = [ 'PUT', 'PATCH', 'TRACE', 'OPTIONS', 'DELETE', 'HEAD', 'CONNECT' ];
            if (notSupportedMethods.includes( requestMethod.toUpperCase())) {
                requestMethod = 'POST';
            }
            formData.append('_method', requestMethod);

            idContent.html('<div class="loader"></div>');

            $.ajax({
                url: editor.uploadAssetUrl,
                type: editor.uploadAssetMethod,
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
            }).done(function(data, textStatus, jqXHR) { // jqXHR.status == 200
                if (jqXHR.status == 200) {
                    var src = data.url;
                    idContent.after('<video id="v-'+id+'" class="video-after-change" width="100%" height="240" controls src="'+ src +'"></video>');
                    idContent.remove();
                    var popup = new PopUp();
                    popup.hide();
                    $('p.file-upload-input-title span.des-upload').text(getI18n('drag_click'));
                } else {
                    // Tr ve form voi error messaqge ==> thanh cong 200!
                    alert(jqXHR.responseText);
                }
            }).fail(function(jqXHR, textStatus, errorThrown) { // jqXHR.status = 5xx hoac 4xx
                var json = $.parseJSON(jqXHR.responseText);
                alert(getI18n('error_upload_file') + json.error.file[0]);
                idContent.html(html);
            });
        }

        // Event click brower image
        $("#builder_iframe").contents().find("body").on('click', '#'+id+' .button-add-video', function() {
            showVideoPopup("upload");
        });

        $(document).on('change', 'input[name="file_upload_video"]', function(e){
            var fileName = e.target.files[0].name;
            $('p.file-upload-input-title span.des-upload').text(fileName);
        });

        // .... form submit
        $(document).on('click', '#video-popup-'+id+' button.buttonSaveUpload', function(e) {
            e.preventDefault();

            saveVideoUpload();
        });

        //get link video
        $(document).on('click', '#video-popup-'+id+' button.buttonSaveUrl', function() {
            var url = $('input.url-video').val();
            var type = 'url';
            var idContent = $("#builder_iframe")[0].contentWindow.$('#'+id);
            var formData = new FormData();
            formData.append('url', url);
            formData.append('_token', CSRF_TOKEN);
            formData.append('assetType', type);

            if (currentEditor.data !== null) {
                for ( var key in currentEditor.data ) {
                   formData.append(key, currentEditor.data[key]);
               }
            }

            var requestMethod = editor.uploadAssetMethod;
            var notSupportedMethods = [ 'PUT', 'PATCH', 'TRACE', 'OPTIONS', 'DELETE', 'HEAD', 'CONNECT' ];
            if (notSupportedMethods.includes( requestMethod.toUpperCase())) {
                requestMethod = 'POST';
            }
            formData.append('_method', requestMethod);

            idContent.html('<div class="loader"></div>');

            // check if url is youtube link
            if (url.includes('youtube')) {
                idContent.after(`
                    <p builder-element class="text-center"><iframe width="560" height="315" src="https://www.youtube.com/embed/`+url.split(/(\?v=|&)/)[1]+`" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></p>
                `);
                idContent.remove();
                var popup = new PopUp();
                popup.hide();

                return;
            }

            $.ajax({
                url: editor.uploadAssetUrl,
                type: editor.uploadAssetMethod,
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
            }).done(function(data, textStatus, jqXHR) { // jqXHR.status == 200
                if (jqXHR.status == 200) {
                    var src = data.url;
                    idContent.after('<video id="v-'+id+'" class="video-after-change" width="100%" height="240" controls src="'+ src +'"></video>');
                    idContent.remove();
                    var popup = new PopUp();
                    popup.hide();
                } else {
                    // Tr ve form voi error messaqge ==> thanh cong 200!
                    alert(jqXHR.responseText);
                }
            }).fail(function(jqXHR, textStatus, errorThrown) { // jqXHR.status = 5xx hoac 4xx
                alert(jqXHR.responseText);
            });

            return false;
        });

        $("#builder_iframe").contents().find("body").on('click', '#'+id+' a.remove-content-widget', function() {
            $("#builder_iframe")[0].contentWindow.$('#'+id).remove();
        });
    }
}

window.VideoWidget = VideoWidget;