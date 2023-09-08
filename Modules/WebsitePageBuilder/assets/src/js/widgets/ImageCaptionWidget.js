class ImageCaptionWidget extends Widget {
    getHtmlId() {
        return "ImageCaptionWidget";
    }

    name() {
        return getI18n('block');
    }

    icon() {
        return 'fal fa-newspaper';
    }
    // get HTML to insert into content
    init() {
        super.init();

        var html = $('#ImageCaptionWidgetContent').html();
        var id = this.id;

        var div = $('<div>').html(html);
        div.find('.image-caption-container').attr('id', id);

        this.contentHtml = div.html();
    }

    events() {
        var id = this.id;

        function showImagePopup(tab = "upload") {
            var imagePopup = new PopUp(getI18n('change_image'), 'auto');
            var contentPopup = '<div id="image-popup-'+id+'">' + $('#ImageToolbox').html() + '</div>';

            if ( tab == "upload") {
                imagePopup.loadHtml(contentPopup);
                $('.nav-content').removeClass('active');
                $('.nav-tab').removeClass('active');
                $('#home').addClass('active show');
                $('.home').addClass('active');
            }
            else if ( tab == "url") {
                imagePopup.loadHtml(contentPopup);
                $('.nav-content').removeClass('active');
                $('.nav-tab').removeClass('active');
                $('#menu1').addClass('active show');
                $('.menu1').addClass('active');
            }
            else if ( tab == "base64") {
                imagePopup.loadHtml(contentPopup);
                $('.nav-content').removeClass('active');
                $('.nav-tab').removeClass('active');
                $('#menu2').addClass('active show');
                $('.menu2').addClass('active');
            }
            else if ( tab == "filemanager") {
                imagePopup.loadHtml(contentPopup);
                $('.nav-content').removeClass('active');
                $('.nav-tab').removeClass('active');
                $('#menu3').addClass('active show');
                $('.menu3').addClass('active');
            }

            // filemanager callback
            window.filemanager_callback = function(url) {
                var idContent = $("#builder_iframe")[0].contentWindow.$('#'+id);
                idContent.after('<img id="'+id+'" builder-element class="image-after-change" src="'+ url +'" style="width: auto;"/>');
                idContent.remove();
                var popup = new PopUp();
                popup.hide();
            };

            // file manager
            if (typeof($('.modal-content .filemanager-iframe').attr('src')) == 'undefined' && currentEditor.filemanager) {
                $('.modal-content .filemanager-iframe').prop('src', currentEditor.filemanager);
            }
        }

        function saveImageUpload() {
            var image = $('input[name="file_upload_image"]')[0].files[0];
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

            idContent.find('.image-caption-placeholder').html('<div class="loader"></div>');

            $.ajax({
                url: editor.uploadAssetUrl,
                type: editor.uploadAssetMethod,
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
            }).done(function(data, textStatus, jqXHR) { // jqXHR.status == 200
                if (jqXHR.status == 200) {
                    idContent.find('.image-caption-placeholder').after('<img id="'+id+'" builder-element class="image-after-change" src="'+ data.url +'" style="width: auto;"/>');
                    idContent.find('.image-caption-placeholder').remove();
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

        function saveImageUrl() {
            var url = $('input[name="url_image"]').val();
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

            idContent.find('.image-caption-placeholder').html('<div class="loader"></div>');

            $.ajax({
                url: editor.uploadAssetUrl,
                type: editor.uploadAssetMethod,
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
            }).done(function(data, textStatus, jqXHR) { // jqXHR.status == 200
                if (jqXHR.status == 200) {
                    idContent.find('.image-caption-placeholder').after('<img id="'+id+'" builder-element class="image-after-change" src="'+ data.url +'" style="width: auto;"/>');
                    idContent.find('.image-caption-placeholder').remove();
                    var popup = new PopUp();
                    popup.hide();
                } else {
                    // Tr ve form voi error messaqge ==> thanh cong 200!
                    alert(jqXHR.responseText);
                }
            }).fail(function(jqXHR, textStatus, errorThrown) { // jqXHR.status = 5xx hoac 4xx
                alert(jqXHR.responseText);
            });
        }

        function saveImageBase64() {
            var url = $('[name="base64_image"]').val();
            var type = 'base64';
            var idContent = $("#builder_iframe")[0].contentWindow.$('#'+id);
            var formData = new FormData();
            formData.append('url_base64', url);
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

            idContent.find('.image-caption-placeholder').html('<div class="loader"></div>');

            $.ajax({
                url: editor.uploadAssetUrl,
                type: editor.uploadAssetMethod,
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
            }).done(function(data, textStatus, jqXHR) { // jqXHR.status == 200
                if (jqXHR.status == 200) {
                    idContent.find('.image-caption-placeholder').after('<img id="'+id+'" builder-element class="image-after-change" src="'+ data.url +'" style="width: auto;"/>');
                    idContent.find('.image-caption-placeholder').remove();
                    var popup = new PopUp();
                    popup.hide();
                } else {
                    // Tr ve form voi error messaqge ==> thanh cong 200!
                    alert(jqXHR.responseText);
                }
            }).fail(function(jqXHR, textStatus, errorThrown) { // jqXHR.status = 5xx hoac 4xx
                var json = $.parseJSON(jqXHR.responseText);
                alert(getI18n('error_upload_base64') + json.error.url_base64[0]);
                idContent.html(html);
            });
        }

        // Event click brower image
        $("#builder_iframe").contents().find("body").on('click', '#'+id+' .button-add-image-caption', function() {
            showImagePopup("upload");
        });

        $(document).on('change', 'input[name="file_upload_image"]', function(e){
            var fileName = e.target.files[0].name;
            $('p.file-upload-input-title span.des-upload').text(fileName);
        });

        //change image, video
        $(document).on('click', '#image-popup-'+id+' button.buttonSaveUpload', function(e) {
            e.preventDefault();

            saveImageUpload();
        });

        // .... form submit
        $(document).on('click', '#image-popup-'+id+' button.buttonSaveUrl', function(e) {
            e.preventDefault();

            saveImageUrl();
        });

        // .... form submit
        $(document).on('click', '#image-popup-'+id+' button.buttonSaveBase64', function(e) {
            e.preventDefault();

            saveImageBase64();
        });

        $("#builder_iframe").contents().find("body").on('click', '#'+id+' a.remove-content-widget', function() {
            $("#builder_iframe")[0].contentWindow.$('#'+id).remove();
        });
    }
}

window.ImageCaptionWidget = ImageCaptionWidget;