class ImageControl extends Control {
    afterRender() {
        var thisControl = this;

        // events
        if (thisControl.value.auto_width) {
            $('.control-' + thisControl.id).find('.slider.disable').trigger('click');
        }

        // readonly
        if (thisControl.value.readonly != null && thisControl.value.readonly === true) {
            $('.control-'+ thisControl.id+' .button').remove();
            $('.control-'+ thisControl.id+' .link-image').remove();
            $('.control-'+ thisControl.id+' .image-selected').css('pointer-events', 'none');
        }
        
        // get align value
        var align = thisControl.value.align == '50%' ? 'center' : thisControl.value.align;
        var align = align == '0%' ? 'left' : align;
        var align = align == '100%' ? 'right' : align;
        thisControl.box().find('[align="'+align+'"]').addClass('active');
    }

    box() {
        return $('.control-' + this.id);
    }

    autoHeightOn() {
        var _this = this;

        _this.box().find('.image-height-auto').prop('checked', true);
        _this.box().find('.image-height').prop('disabled', true);
    }

    autoHeightOff() {
        var _this = this;

        _this.box().find('.image-height-auto').prop('checked', false);
        _this.box().find('.image-height').prop('disabled', false);
    }

    applyValue() {
        var _this = this;

        // width
        var width = this.value.width;
        _this.box().find('.image-width').val(width);
        _this.box().find('.image-width-text').html(Math.round(width) + '%');

        // height
        var height = _this.value.height;
        _this.box().find('.image-height').val(height.toString().replace('px', ''));
        _this.box().find('.image-height-text').html(Math.round(height).toString() + 'px');

        // auto height
        if (_this.value.autoHeight) {
            _this.autoHeightOn();
        } else {
            _this.autoHeightOff();
        }
    }

    afterRender() {
        var _this = this;
        
        _this.applyValue();

        // change width
        _this.box().find('.image-width').on('change', function() {
            var width = $(this).val();

            _this.box().find('.image-width-text').html(Math.round(width) + '%');
            _this.callback.setWidth(width + '%');
        });

        // auto height
        _this.box().find('.image-height-auto').on('change', function() {
            if ($(this).is(':checked')) {
                _this.autoHeightOn();
                _this.callback.setHeight('auto');
            } else {
                _this.autoHeightOff();
                _this.callback.setHeight(_this.box().find('.image-height').val() + 'px');
            }
        });

        // change height
        _this.box().find('.image-height').on('change', function() {
            var height = $(this).val();

            _this.box().find('.image-height-text').html(Math.round(height) + 'px');
            _this.callback.setHeight(height + 'px');
        });
    }

    renderHtml() {
        var thisControl = this;

        var html = $('#imageControl').html(); /*id cua element*/

        var src = this.value.src;
        //link show image selected
        var url_image_selected_href = $("#builder_iframe").get(0).contentWindow.location.href;
        var url_image_selected_origin = $("#builder_iframe").get(0).contentWindow.location.origin;
        var url_image_selected_pathname = $("#builder_iframe").get(0).contentWindow.location.pathname;
        
        var alt = this.value.alt;
        var filename = src.replace(/^.*[\\\/]/, '');

        var input_id = 'img_url_' + this.id; /*input src image*/
        var alt_id = 'img_alt_' + this.id; /*input alt image*/
        var myRanges = 'myRanges_' + this.id; /*input range image*/
        var thongsos = 'thongsos_' + this.id; /*value range image*/
        var input_upload = 'changeImg-' + this.id; /*input upload image*/
        var button_upload = 'uploadImage-' + this.id; /*button upload image*/
        var form_upload = 'change-img-' + this.id; /*form upload image*/
        var image_selected = 'image_selected_' + this.id; /*image selected*/
        
        html = html.replace("[TITLE]", this.title);
        html = html.replace(/\[ID]/g, this.id);
        html = html.replace(/\[img_url_ID]/g, input_id);
        html = html.replace(/\[img_alt_ID]/g, alt_id);
        html = html.replace(/\[myRanges_ID]/g, myRanges);
        html = html.replace(/\[thongsos_ID]/g, thongsos);
        html = html.replace(/\[changeImg-ID]/g, input_upload);
        html = html.replace(/\[uploadImage-ID]/g, button_upload);
        html = html.replace(/\[change-img-ID]/g, form_upload);
        html = html.replace(/\[image_selected_ID]/g, image_selected);

        var div = $('<DIV>').html(html);

        div.find('.image-name .src').attr('value', src);
        div.find('#'+input_id).attr('value', src);
        div.find('.image-name span#name-image').html(filename);
        div.find('.alternate-text .name-img').attr('value', alt);
        
        //show image selected
        // if image from tmp
        if (src.indexOf('/tmp') !== -1) {
            div.find('#'+image_selected).attr('src', url_image_selected_origin + src);
        
        // if image is from local
        } else if(src[0] == '/') {
            div.find('#'+image_selected).attr('src', src);
        
        // if image is outside link
        } else if(/^((http|https|ftp):\/\/)/.test(src)) {
            div.find('#'+image_selected).attr('src', src);

        // if other
        } else {
            div.find('#'+image_selected).attr('src', url_image_selected_pathname + src);
        }
        
        if (src.indexOf('data:') !== -1) {
            div.find('#'+image_selected).attr('src', src);
        }

        //change align image (position)
        $(document).on('click', '.icon-align', function() {
            var align = $(this).attr("align");

            $('.icon-align').removeClass('active');
            $(this).addClass('active');

            thisControl.callback.setAlign(align);
        });

        var id = makeid();
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
                thisControl.callback.setUrl(url);
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

            var requestMethod = editor.uploadAssetMethod;
            var notSupportedMethods = [ 'PUT', 'PATCH', 'TRACE', 'OPTIONS', 'DELETE', 'HEAD', 'CONNECT' ];
            if (notSupportedMethods.includes( requestMethod.toUpperCase())) {
                requestMethod = 'POST';
            }
            formData.append('_method', requestMethod);

            var elementControl = $("#builder_iframe")[0].contentWindow.$('img.element-selected');
            $(elementControl).html('<div class="loader"></div>');

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
                    var filename = src.replace(/^.*[\\\/]/, '');
                    $('span#name-image').html(filename);
                    
                    thisControl.callback.setUrl(src);
                    var popup = new PopUp();
                    popup.hide();
                    $('p.file-upload-input-title span.des-upload').text(getI18n('drag_click'));
                    
                    $('#'+image_selected).attr('src', '');
                    $('#'+image_selected).attr('src', url_image_selected_origin + src);
                    
                } else {
                    // Tr ve form voi error messaqge ==> thanh cong 200!
                    alert(jqXHR.responseText);
                }
            }).fail(function(jqXHR, textStatus, errorThrown) { // jqXHR.status = 5xx hoac 4xx
                var json = $.parseJSON(jqXHR.responseText);
                alert(getI18n('error_upload_file') + json.error.file[0]);
                $(elementControl).html(elementControl);
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

            var requestMethod = editor.uploadAssetMethod;
            var notSupportedMethods = [ 'PUT', 'PATCH', 'TRACE', 'OPTIONS', 'DELETE', 'HEAD', 'CONNECT' ];
            if (notSupportedMethods.includes( requestMethod.toUpperCase())) {
                requestMethod = 'POST';
            }
            formData.append('_method', requestMethod);

            var elementControl = $("#builder_iframe")[0].contentWindow.$('img.element-selected');
            $(elementControl).html('<div class="loader"></div>');

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
                    var filename = src.replace(/^.*[\\\/]/, '');
                    $('span#name-image').html(filename);

                    thisControl.callback.setUrl(src);
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

            var requestMethod = editor.uploadAssetMethod;
            var notSupportedMethods = [ 'PUT', 'PATCH', 'TRACE', 'OPTIONS', 'DELETE', 'HEAD', 'CONNECT' ];
            if (notSupportedMethods.includes( requestMethod.toUpperCase())) {
                requestMethod = 'POST';
            }
            formData.append('_method', requestMethod);

            var elementControl = $("#builder_iframe")[0].contentWindow.$('img.element-selected');
            $(elementControl).html('<div class="loader"></div>');

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
                    var filename = src.replace(/^.*[\\\/]/, '');
                    $('span#name-image').html(filename);

                    thisControl.callback.setUrl(src);
                    var popup = new PopUp();
                    popup.hide();
                } else {
                    // Tr ve form voi error messaqge ==> thanh cong 200!
                    alert(jqXHR.responseText);
                }
            }).fail(function(jqXHR, textStatus, errorThrown) { // jqXHR.status = 5xx hoac 4xx
                var json = $.parseJSON(jqXHR.responseText);
                alert(getI18n('error_upload_base64') + json.error.url_base64[0]);
                $(elementControl).html(elementControl);
            });
        }

        //change/ upload image
        $(document).on('click', '#'+ button_upload, function() {
            showImagePopup("upload");
            return false;
        });

        // change/ upload image
        $(document).on('click', '#'+ image_selected, function() {
            showImagePopup("upload");
            return false;
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

        $(document).on('click', '#image-popup-'+id+' button.buttonSaveUrl', function(e) {
            e.preventDefault();
            saveImageUrl();
        });
        
        $(document).on('keyup change', '#' + alt_id, function(e) {
            e.preventDefault();

            thisControl.callback.setAlt($(this).val());
        });

        $(document).on('click', '#image-popup-'+id+' button.buttonSaveBase64', function(e) {
            e.preventDefault();

            saveImageBase64();
        });

        return div.html();
    }
}

window.ImageControl = ImageControl;