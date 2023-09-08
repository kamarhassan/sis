class BackgroundImageControl extends Control {
    groupId() {
        return 'background';
    }

    renderHtml() {
        var thisControl = this;
        var html = $('#BackgroundImageControl').html();
        thisControl.selector = ".control-" + thisControl.id;

        html = html.replace("[ID]", thisControl.id);
        html = html.replace("[TITLE]", thisControl.title);
        
        return html;
    }

    setValues() {
        var thisControl = this;
    }

    rgb2hex(rgb) { 
        rgb = rgb.match(/^rgba?[\s+]?\([\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?/i);
        return (rgb && rgb.length === 4) ? "#" +
            ("0" + parseInt(rgb[1],10).toString(16)).slice(-2) +
            ("0" + parseInt(rgb[2],10).toString(16)).slice(-2) +
            ("0" + parseInt(rgb[3],10).toString(16)).slice(-2) : '';
    }

    afterRender() {
        var thisControl = this;

        // default values
        if (thisControl.value.image && thisControl.value.image != 'none') {
            $(thisControl.selector).find('.background-image').attr('src', thisControl.value.image.split(/"/)[1].replace(/"/g, ''));
        }

        $(thisControl.selector).find('.background-color').val(thisControl.rgb2hex(thisControl.value.color));
        $(thisControl.selector).find('.background-repeat').val(thisControl.value.repeat);
        $(thisControl.selector).find('.background-position').val(thisControl.value.position);
        $(thisControl.selector).find('.background-size').val(thisControl.value.size);

        // events
        $(thisControl.selector).find('.background-color').on('change keyup', function(e) {
            thisControl.callback.setBackgroundColor($(this).val());
        });
        $(thisControl.selector).find('.background-repeat').on('change keyup', function(e) {
            thisControl.callback.setBackgroundRepeat($(this).val());
        });
        $(thisControl.selector).find('.background-position').on('change keyup', function(e) {
            thisControl.callback.setBackgroundPosition($(this).val());
        });
        $(thisControl.selector).find('.background-size').on('change keyup', function(e) {
            thisControl.callback.setBackgroundSize($(this).val());
        });

        // Upload funcs
        var url_image_selected_origin = $("#builder_iframe").get(0).contentWindow.location.origin;
        
        function showImagePopup(tab = "upload") {
            var imagePopup = new PopUp(getI18n('change_image'), 'auto');
            var contentPopup = '<div id="image-popup-'+thisControl.id+'">' + $('#ImageToolbox').html() + '</div>';

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
                $(thisControl.selector).find('.background-image').attr('src', url);
                thisControl.callback.setBackgroundImage('url('+url+')');

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
            var formData = new FormData();
            formData.append('file', image);
            formData.append('_token', CSRF_TOKEN);
            formData.append('assetType', type);

            if (currentEditor.data !== null) {
                for ( var key in currentEditor.data ) {
                   formData.append(key, currentEditor.data[key]);
               }
            }

            // check file selected
            if (!$('input[name="file_upload_image"]').val()) {
                Swal.fire({
                    title: getI18n('error_job'),
                    text: getI18n('no_file_selected'),
                    type: "error",
                }).then((result) => {
                });
                return;
            }

            var requestMethod = currentEditor.uploadAssetMethod;
            var notSupportedMethods = [ 'PUT', 'PATCH', 'TRACE', 'OPTIONS', 'DELETE', 'HEAD', 'CONNECT' ];
            if (notSupportedMethods.includes( requestMethod.toUpperCase())) {
                requestMethod = 'POST';
            }
            formData.append('_method', requestMethod);

            $.ajax({
                url: currentEditor.uploadAssetUrl,
                type: currentEditor.uploadAssetMethod,
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
            }).done(function(data, textStatus, jqXHR) { // jqXHR.status == 200
                if (jqXHR.status == 200) {
                    var src = data.url;
                    var filename = src.replace(/^.*[\\\/]/, '');
                    
                    $(thisControl.selector).find('.background-image').attr('src', url_image_selected_origin + src.replace(url_image_selected_origin, ''));
                    thisControl.callback.setBackgroundImage('url('+src+')');

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
            });
        }

        function saveImageUrl() {
            var url = $('input[name="url_image"]').val();
            var type = 'url';
            var formData = new FormData();
            formData.append('url', url);
            formData.append('_token', CSRF_TOKEN);
            formData.append('assetType', type);

            if (currentEditor.data !== null) {
                for ( var key in currentEditor.data ) {
                   formData.append(key, currentEditor.data[key]);
               }
            }

            var requestMethod = currentEditor.uploadAssetMethod;
            var notSupportedMethods = [ 'PUT', 'PATCH', 'TRACE', 'OPTIONS', 'DELETE', 'HEAD', 'CONNECT' ];
            if (notSupportedMethods.includes( requestMethod.toUpperCase())) {
                requestMethod = 'POST';
            }
            formData.append('_method', requestMethod);

            $.ajax({
                url: currentEditor.uploadAssetUrl,
                type: currentEditor.uploadAssetMethod,
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
            }).done(function(data, textStatus, jqXHR) { // jqXHR.status == 200
                if (jqXHR.status == 200) {
                    var src = data.url;
                    var filename = src.replace(/^.*[\\\/]/, '');
                    $('span#name-image').html(filename);

                    $(thisControl.selector).find('.background-image').attr('src', url_image_selected_origin + src.replace(url_image_selected_origin, ''));
                    thisControl.callback.setBackgroundImage('url('+src+')');

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
            var formData = new FormData();
            formData.append('url_base64', url);
            formData.append('_token', CSRF_TOKEN);
            formData.append('assetType', type);

            if (currentEditor.data !== null) {
                for ( var key in currentEditor.data ) {
                   formData.append(key, currentEditor.data[key]);
               }
            }

            var requestMethod = currentEditor.uploadAssetMethod;
            var notSupportedMethods = [ 'PUT', 'PATCH', 'TRACE', 'OPTIONS', 'DELETE', 'HEAD', 'CONNECT' ];
            if (notSupportedMethods.includes( requestMethod.toUpperCase())) {
                requestMethod = 'POST';
            }
            formData.append('_method', requestMethod);

            $.ajax({
                url: currentEditor.uploadAssetUrl,
                type: currentEditor.uploadAssetMethod,
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
            }).done(function(data, textStatus, jqXHR) { // jqXHR.status == 200
                if (jqXHR.status == 200) {
                    var src = data.url;
                    var filename = src.replace(/^.*[\\\/]/, '');
                    $('span#name-image').html(filename);

                    $(thisControl.selector).find('.background-image').attr('src', url_image_selected_origin + src.replace(url_image_selected_origin, ''));
                    thisControl.callback.setBackgroundImage('url('+src+')');
                    
                    var popup = new PopUp();
                    popup.hide();
                } else {
                    // Tr ve form voi error messaqge ==> thanh cong 200!
                    alert(jqXHR.responseText);
                }
            }).fail(function(jqXHR, textStatus, errorThrown) { // jqXHR.status = 5xx hoac 4xx
                var json = $.parseJSON(jqXHR.responseText);
                alert(getI18n('error_upload_base64') + json.error.url_base64[0]);
            });
        }

        $(document).on('change', 'input[name="file_upload_image"]', function(e){
            var fileName = e.target.files[0].name;
            $('p.file-upload-input-title span.des-upload').text(fileName);
        });

        //change image, video
        $(document).on('click', '#image-popup-'+thisControl.id+' button.buttonSaveUpload', function(e) {
            e.preventDefault();
            saveImageUpload();
        });

        $(document).on('click', '#image-popup-'+thisControl.id+' button.buttonSaveUrl', function(e) {
            e.preventDefault();
            saveImageUrl();
        });

        $(document).on('click', '#image-popup-'+thisControl.id+' button.buttonSaveBase64', function(e) {
            e.preventDefault();
            saveImageBase64();
        });

        // click change button
        $(thisControl.selector).find('.change-image, .background-image').on('click', function() {
            showImagePopup("upload");
            return false;
        });

        // click change button
        $(thisControl.selector).find('.clear-image').on('click', function() {
            thisControl.callback.setBackgroundImage('none');
            $(thisControl.selector).find('.background-image').attr('src', 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzNDAgMzI4LjIyIj48ZGVmcz48c3R5bGU+LmNscy0xe2ZpbGw6IzRjYTRkNTt9LmNscy0ye2ZpbGw6I2ZmZjt9PC9zdHlsZT48L2RlZnM+PGcgaWQ9IkxheWVyXzIiIGRhdGEtbmFtZT0iTGF5ZXIgMiI+PGcgaWQ9ImNvbnRlbnQtcGxhY2Vob2xkZXIiPjxyZWN0IGNsYXNzPSJjbHMtMSIgd2lkdGg9IjM0MCIgaGVpZ2h0PSIzMjguMjIiIHJ4PSIxNCIvPjxjaXJjbGUgY2xhc3M9ImNscy0yIiBjeD0iMTI3LjY0IiBjeT0iMTMyLjg0IiByPSIxNS45MSIvPjxwYXRoIGNsYXNzPSJjbHMtMiIgZD0iTTY1LDgzLjExdjE2MkgyNzV2LTE2MlptMTk4LDE1MEg3N3YtMTM4SDI2M1oiLz48cG9seWdvbiBjbGFzcz0iY2xzLTIiIHBvaW50cz0iODcgMjE5LjExIDEyNS45NyAxODAuMTEgMTM4LjIgMTg2Ljk5IDE4MS43NSAxNDEuMTEgMTk4LjU3IDE2MC45OSAyMDYuOTcgMTU1LjY0IDI0OSAyMTkuMTEgODcgMjE5LjExIi8+PC9nPjwvZz48L3N2Zz4=');
            return false;
        });
    }
}

window.BackgroundImageControl = BackgroundImageControl;