/* Editor
* + init()
* + elementFactory(htmlObj)
* + select(Element)
* + unselect()
* + duplicate()
*
* Sidebar
* + load
* + renderAttribute
*
*/

import { NoneElement } from "./elements";

function createElementFromHTML(htmlString) {
  var div = document.createElement('div');
  div.innerHTML = htmlString.trim();

  // Change this to div.childNodes to support multiple top-level nodes
  return div.childNodes;
}

function simulateClick(x,y){
    var ev = document.createEvent("MouseEvent");
    var el = document.elementFromPoint(x,y);
    ev.initMouseEvent(
        "click",
        true /* bubble */, true /* cancelable */,
        window, null,
        x, y, 0, 0, /* coordinates */
        false, false, false, false, /* modifier keys */
        0 /*left*/, null
    );
    el.dispatchEvent(ev);
}

function makeid() {
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    for (var i = 0; i < 5; i++)
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
}

var Editor = function(options) {
    var thisEditor = this;
    window.currentEditor = thisEditor;

    // ifram contents
    thisEditor.getIframeContent = function() {
        return $("#builder_iframe").contents();
    };

    // default strict
    thisEditor.strict = true;

    // default help button
    thisEditor.showHelp = true;

    // before save events
    thisEditor.beforeSaveEvents = [];

    // Set params cho object tu options
    // Vi du: editor.saveAssetUrl
    var keys =  Object.keys(options);
    for (var i = 0; i < keys.length; i += 1) {
        var key = keys[i];
        var value = options[key];
        this[key] = value;
    }

    // fix root path
    thisEditor.root = thisEditor.root.trim();
    if (thisEditor.root.slice(-1) !== '/') {
        thisEditor.root = thisEditor.root + '/';
    }

    if (typeof(window.CSRF_TOKEN) == 'undefined') {
        window.CSRF_TOKEN = '';
    }

    // check language
    if(typeof(this.language) == 'undefined') {
        this.language = 'en';
    }

    // save check anchor
    this.saveAchor = 0;
};

Editor.prototype = {

    addBeforeSaveEvent: function(event) {
        this.beforeSaveEvents.push(event);
    },

    runBeforeSaveEvents: function(event) {
        this.beforeSaveEvents.forEach(function(event) {
            event();
        });
    },

    // change loading message
    loadingSetMessage: function (data) {
        $('.loading-page-overlay label').html(data);
    },

    // hide loading effect when done
    done: function () {
        var thisEditor = this;

        $('.loading-page-overlay').remove();

        // loaded callback
        if (thisEditor.loaded) {
            thisEditor.loaded();
        }
    },

    historyGoto: function(achor) {
        var thisEditor = this;

        // move record postion -1
        thisEditor.currentRecordAchor = achor;

        // get old content
        var content = thisEditor.history()[thisEditor.currentRecordAchor].contents;
        //var content = thisEditor.history()[thisEditor.currentRecordAchor];

        // change content
        $("#builder_iframe").contents().find("body").html(content);

        //check undo hide
        thisEditor.historyToggleButton();

        // update history list
        thisEditor.listHistory();

        // check empty
        thisEditor.checkEmpty();
    },

    undo: function() {
        var thisEditor = this;

        // check if has no old record
        if (thisEditor.currentRecordAchor <= 0) {
            return;
        }

        // got to history node
        thisEditor.historyGoto(thisEditor.currentRecordAchor - 1);
    },

    redo: function() {
        var thisEditor = this;

        // check if has no new record
        if (thisEditor.currentRecordAchor >= thisEditor.history().length - 1) {
            return;
        }

        // got to history node
        thisEditor.historyGoto(thisEditor.currentRecordAchor + 1);
    },

    history: function() {
        var thisEditor = this;

        // init history records
        if (typeof(thisEditor.historyRecords) == 'undefined') {
            thisEditor.historyRecords = [];

            // toggle button
            thisEditor.historyToggleButton();

            // HISTORY LIST BUTTON EVENT
            // got to history event
            $(document).on('click', 'li.history_add, .history-item', function() {
                var id = $(this).attr('data-achor');
                thisEditor.historyGoto(id);
            });
        }

        return thisEditor.historyRecords;
    },

    historyToggleButton: function() {
        var thisEditor = this;
        var canUndo = thisEditor.currentRecordAchor > 0;
        var canRedo = thisEditor.currentRecordAchor < thisEditor.history().length - 1;

        // can redo
        if (canRedo == true) {
            $('.undo-redo-action-redo').removeClass('disable-redo');
            $('.action.redo').removeClass('disabled');
        } else {
            $('.undo-redo-action-redo').addClass('disable-redo');
            $('.action.redo').addClass('disabled');
        }

        // can undo
        if (canUndo == true) {
            $('.undo-redo-action-undo').removeClass('disable-undo');
            $('.action.undo').removeClass('disabled');
        } else {
            $('.undo-redo-action-undo').addClass('disable-undo');
            $('.action.undo').addClass('disabled');
        }

        //can not undo-redo
        if (canRedo == false && canUndo == false) {
            $('.undo-redo').hide();
        } else {
            $('.undo-redo').show();
        }
    },

    formatDate: function(date) {
        var hours = date.getHours();
        var minutes = date.getMinutes();
        var seconds = date.getSeconds();
        var ampm = hours >= 12 ? 'PM' : 'AM';
        hours = hours % 12;
        hours = hours ? hours : 12; // the hour '0' should be '12'
        minutes = minutes < 10 ? '0'+minutes : minutes;
        seconds = seconds < 10 ? '0'+seconds : seconds;
        var strTime = hours + ':' + minutes + ':' + seconds + ' ' + ampm;
        return date.getMonth()+1 + "/" + date.getDate() + "/" + date.getFullYear() + " - " + strTime;
    },

    recordState: function(title = getI18n('mess_open'), icon = 'fa fa-list-alt') {
        var thisEditor = this;
        var content = $("#builder_iframe").contents().find("html").html();

        // // remove inline edit
        // if (thisEditor.selected != null) {
        //     // editor
        //     thisEditor.removeInlineEdit(thisEditor.selected.obj);
        // }

        //get datatime now
        var dt = new Date();
        var time = thisEditor.formatDate(dt);

        // gioi han mang records
        if (thisEditor.history().length == 10) {
            thisEditor.history().shift();
        }

        // check if history is not empty and content has no change
        if (typeof(thisEditor.currentRecordAchor) != 'undefined' && content == thisEditor.history()[thisEditor.currentRecordAchor]) {
            return;
        }

        // remove after state
        thisEditor.historyRecords = thisEditor.historyRecords.slice(0, thisEditor.currentRecordAchor+1);

        thisEditor.history().push({contents: content, title: title, icon: icon, time: time});

        // set history current position to the last record
        thisEditor.currentRecordAchor = thisEditor.history().length - 1;

        // toggle button
        thisEditor.historyToggleButton();

        // update history list
        thisEditor.listHistory();
    },

    mask: function() {
        $('div.loadding-indicator').show();
    },

    unmask: function() {
        $('div.loadding-indicator').hide();
    },

    closePreview: function () {
        $('div.showPreview').hide();
        $('#modal-preview-desktop').show();
        $('.click-active-preview').removeClass('active-preview');
    },

    cleanUpContent: function() {
        // unselect
        this.unselect();

        // remove additional classes
        $("#builder_iframe").contents().find("*").removeClass (function (index, className) {
            return (className.match (/builder-class[a-zA-Z0-9\_\-]+/g) || []).join(' ');
        });

        // remove builder-tool
        $("#builder_iframe").contents().find('.builder-tool').remove();

        // remove notebook editor
        $("#builder_iframe").contents().find("[id^=jquery-notebook-content-]").remove();

        // remove inline edit
        this.removeInlineEdit();
    },

    cleanupHtml: function(html) {
        html = html.replace(/element-selected/g, '').replace(/builder-outline-move-hook/g, '').replace(/builder-outline-selected-controls/g, '');
        html = html.replace(/(<link([^>]+)builder\-helper([^>]+)>)/ig,"").replace(/(<script([^>]+)builder\-helper([^>]+)>\<\/script>)/ig,"");

        return html;
    },

    getContent: function() {
        var thisEditor = this;

        // cleanup content
        var content = $("#builder_iframe").contents().find("html")[0].outerHTML;
        content = this.cleanupHtml(content);

        // standard mode fix
        if (!content.toLowerCase().includes('DOCTYPE html'.toLowerCase())) {
            content = '<!DOCTYPE html>' + content;
        }

        return content;
    },

    save: function(callback) {
        var thisEditor = this;
        var url = thisEditor.saveUrl;

        // before save events
        thisEditor.runBeforeSaveEvents();

        // cleanup content before save
        thisEditor.cleanUpContent();

        // save saveAchor
        thisEditor.saveAchor = thisEditor.currentRecordAchor;

        // get save content
        var content = thisEditor.getContent();

        var requestMethod = thisEditor.uploadAssetMethod;
        var notSupportedMethods = [ 'PUT', 'PATCH', 'TRACE', 'OPTIONS', 'DELETE', 'HEAD', 'CONNECT' ];
        if (typeof(requestMethod) == 'undefined' || notSupportedMethods.includes( requestMethod.toUpperCase())) {
            requestMethod = 'POST';
        } 

        $('button.btn-save').attr("disabled", 'disabled');
        $('button.btn-save').html('<div class="loader-save"></div>');
        thisEditor.mask();
        setTimeout(function() {
            thisEditor.unmask();
            $('button.btn-save').removeAttr("disabled", 'disabled');
            $('button.btn-save').html(getI18n('save'));

            var data = {
                _token: CSRF_TOKEN,
                content: content,
                _method: requestMethod
            }

            if (thisEditor.data !== null) {
                data = $.extend({}, data, thisEditor.data);
            }

            $.ajax({
                url: url,
                type: requestMethod,
                dataType: 'json',
                data: data,
            }).done(function(data, textStatus, jqXHR) { // jqXHR.status == 200
                if (jqXHR.status == 200) {
                    // Okie, done, redirect to index
                    //var time = 'Last saved at '+ data['last_updated'];
                    //var html = '<span style="font-size: 13px;height: 100%;display: flex;align-items: center;justify-content: flex-end;">'+time+'</span>';
                    var content = getI18n('update_content');
                    editor.notificationArea(content);
                    //$('.footer .footer-right').html(html);
                    //$('.footer .footer-right span').show();
                    $('button.btn-save').removeAttr("disabled", 'disabled');
                    $('button.btn-save').html('Save');
                    
                    // callback
                    if (typeof(callback) !== 'undefined') {
                        callback();
                    }

                    // after save callback
                    if (typeof(thisEditor.callbacks) !== 'undefined') {
                        if (typeof(thisEditor.callbacks.afterSave) !== 'undefined') {
                            thisEditor.callbacks.afterSave();
                        }
                    }
                } else {
                    alert('Failed to save');
                    $('button.btn-save').removeAttr("disabled", 'disabled');
                    $('button.btn-save').html('Save');
                    // Tr ve form voi error messaqge ==> thanh cong 200!
                }

                // save current content
                thisEditor.initContent = thisEditor.getContent();
            }).fail(function(jqXHR, textStatus, errorThrown) { // jqXHR.status = 5xx hoac 4xx
                try {
                    $.parseJSON(jqXHR.responseText);
                }
                catch(err) {
                    Swal.fire({
                        title: getI18n('error_job'),
                        text: jqXHR.responseText,
                        type: "error",
                    });
                    return;
                }
                Swal.fire({
                    title: getI18n('error_job'),
                    text: ($.parseJSON(jqXHR.responseText).message),
                    type: "error",
                });
            });
        }, 500);
    },

    uploadTemplate: function(url) {
        var thisEditor = this;
        var callback = thisEditor.url;
        var requestMethod = thisEditor.uploadAssetMethod;

        var notSupportedMethods = [ 'PUT', 'PATCH', 'TRACE', 'OPTIONS', 'DELETE', 'HEAD', 'CONNECT' ];
        if (notSupportedMethods.includes( requestMethod.toUpperCase())) {
            requestMethod = 'POST';
        }

        //var file = $('.file-upload-template')[0].files[0];
        var file = $('.file-upload-template').prop('files')[0];
        var formData = new FormData();
        formData.append('file', file);
        formData.append('action', 'upload');

        if (thisEditor.data !== null) {
            for ( var key in thisEditor.data ) {
               formData.append(key, thisEditor.data[key]);
           }
        }

        $.ajax({
            url: url,
            type: requestMethod,
            dataType: 'json',
            contentType: false,
            processData: false,
            data : formData,
        }).done(function(data, textStatus, jqXHR) { // jqXHR.status == 200
            if (jqXHR.status == 200) {
                // Okie, done, redirect to index
                var popup = new PopUp();
                popup.hide();
                //alert('Upload template success!');
                Swal.fire({
                      title: getI18n('good_job'),
                      text: getI18n('upload_success'),
                      type: "success",
                }).then((result) => {
                    // window.location = window.location.origin + '/design.php?id=' + data.url + '&type=other';
                    if (thisEditor.uploadTemplateCallback) {
                        thisEditor.uploadTemplateCallback(data);
                    }
                });
            } else {
                alert(jqXHR.responseText);
            }
        }).fail(function(jqXHR, textStatus, errorThrown) { // jqXHR.status = 5xx hoac 4xx
            //var json = $.parseJSON(jqXHR.responseText);
            alert('Error while upload file:' + jqXHR.responseText.error);
        });
    },

    changeTemplate: function(url) {
        var thisEditor = this;

        // checl if has callback for changing template
        if (typeof(thisEditor.changeTemplateCallback) != 'undefined') {
          Swal.fire({
              title: getI18n('are_you_sure'),
              text: getI18n('text_are_you'),
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: getI18n('confirm_apply')
          }).then((result) => {
              if (result.value) {
                  Swal.fire({
                      title: getI18n('good_job'),
                      text: getI18n('success_aplly'),
                      type: "success",
                  }).then((result) => {
                      thisEditor.changeTemplateCallback(url);
                  });
              }
          });
          return;
        }

        var data = {
            _token: CSRF_TOKEN
        }

        if (thisEditor.data !== null) {
            data = $.extend({}, data, thisEditor.data);
        }

        $.ajax({
            url: url,
            type: 'GET',
            data: {
                _token: CSRF_TOKEN
            },
        }).done(function(data, textStatus, jqXHR) { // jqXHR.status == 200
            if (jqXHR.status == 200) {
                // Okie, done, redirect to index
                Swal.fire({
                    title: getI18n('good_job'),
                    text: getI18n('success_aplly'),
                    type: "success",
                }).then((result) => {
                    location.reload();
                });
            } else {
                alert('Failed choose');
                // Tr ve form voi error messaqge ==> thanh cong 200!
            }
        }).fail(function(jqXHR, textStatus, errorThrown) { // jqXHR.status = 5xx hoac 4xx
            alert(getI18n('error_save') + errorThrown);
        });
    },

    back: function() {
        var thisEditor = this;
        
        var changed = (thisEditor.saveAchor != thisEditor.currentRecordAchor);

        if (changed) {
            Swal.fire({
                title: getI18n('are_you_sure'),
                text: getI18n('text_back'),
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: getI18n('ok')
            }).then((result) => {
                if (result.value) {
                    // check if builder has backCallback
                    if (typeof(thisEditor.backCallback) !== 'undefined') {
                        thisEditor.backCallback();
                    } else {
                        window.location.href = this.urlBack;
                    }
                }
            });
        } else {
            // check if builder has backCallback
            if (typeof(thisEditor.backCallback) !== 'undefined') {
                thisEditor.backCallback();
            } else {
                window.location.href = this.urlBack;
            }
        }
    },

    synchronization: function(data) {
        var sync = $(data).attr('data-sync');
        $('button.btn-sync').find('i').removeClass('fab fa-google');
        $('button.btn-sync').find('i').removeClass('fab fa-dropbox');
        $('button.btn-sync').find('i').removeClass('fab fa-google-drive');

        if ( sync == 'google-driver' ) {
            $('button.btn-sync').find('i').addClass('fab fa-google');
        } else if ( sync == 'dropbox' ) {
            $('button.btn-sync').find('i').addClass('fab fa-dropbox');
        } else if ( sync == 'one-driver' ) {
            $('button.btn-sync').find('i').addClass('fab fa-google-drive');
        }
        $('ul.action-sync').removeClass('show-action');
    },

    settingSync: function() {
        $('ul.action-sync').removeClass('show-action');
        Swal.fire({
            title: getI18n('setting_title'),
            text: getI18n('setting_text'),
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: getI18n('ok')
          }).then((result) => {
            if (result.value) {

            }
        });
    },

    addDragShadow(shadow_html) {
        var thisEditor = this;

        // init shadow box
        thisEditor.dragShadow = $('.drag-shadow');
        if (!thisEditor.dragShadow.length) {
            var html = '<div class="drag-shadow"></div>';
            $('body').append(html);

            thisEditor.dragShadow = $('.drag-shadow');
        }

        // css drag shadow
        thisEditor.dragShadow.css('position', 'fixed');
        thisEditor.dragShadow.css('z-index', '10000');
        thisEditor.dragShadow.css('top', '0');
        thisEditor.dragShadow.css('left', '0');
        thisEditor.dragShadow.css('pointer-events', 'none');
        thisEditor.dragShadow.hide();

        // insert html shadow
        thisEditor.dragShadow.html(shadow_html);

        // move outside content
        $(document).on('mousemove', '*', function(e) {
            if (thisEditor.isDragging) {
                thisEditor.dragShadow.show();

                // posistion
                thisEditor.dragShadow.css('left', e.pageX + 5);
                thisEditor.dragShadow.css('top', e.pageY + 5);
            }
        });

        // mouse move in content, trigger drag shadow
        $("#builder_iframe").contents().on('mousemove', '*', function(e) {
            if (thisEditor.isDragging) {
                thisEditor.dragShadow.show();

                // find mouse posistion in iframe
                thisEditor.dragShadow.css('left', e.pageX + $("#builder_iframe").offset().left + 5);
                thisEditor.dragShadow.css('top', e.pageY + $("#builder_iframe").offset().top + 5);
            }
        });
    },

    drag: function(draggableItem, options) {
        var thisEditor = this;
        thisEditor.draggableItem = draggableItem;

        // unselect
        thisEditor.unselect();

        // set as dragging
        thisEditor.isDragging = true;

        // drag options
        if (typeof(options) !== 'undefined') {
            thisEditor.dragOptions = options;
        } else {
            thisEditor.dragOptions = {};
        }

        // set dropHtml
        thisEditor.dropHtml = thisEditor.transformHtml(draggableItem.dropHtml());

        // add drag shadow and mouse events
        thisEditor.addDragShadow(thisEditor.transformHtml(draggableItem.dragHtml()));
    },

    canDropInside: function(element) {
        var hasCell = this.dropHtml.includes('CellElement');
        var containerIsCell = element.obj.attr('builder-element') == 'CellElement';
        
        return element.isContainer() && !(hasCell && containerIsCell);
    },

    canDropBeside: function(element) {
        var hasCell = this.dropHtml.includes('CellElement');
        var insideCell = element.obj.closest('[builder-element="CellElement"]').length > 0;
        
        return !this.strict || (element.isDraggable() && !(hasCell && insideCell));
    },

    findClosestDraggableOrDroppableElement: function(target) {
        // check not strict
        if (!this.strict) {
            return this.elementFactory(target);
        }

        target = target.closest('[builder-element]');
        var element = this.elementFactory(target);

        // not inside any builder element
        if (element == null) {
            return element;
        }

        // look through parents element until found or null
        while(
            element.obj.parents('[builder-element]').length &&
            !this.canDropBeside(element) &&
            !this.canDropInside(element)
        ) {
            element = this.elementFactory(element.obj.parents('[builder-element]').first());
        }

        return element;
    },

    dragging: function (e) {
        var thisEditor = this;

        // remove all selection
        $("#builder_iframe")[0].contentWindow.getSelection().removeAllRanges();

        // find closest droppable|draggable element
        var element = thisEditor.findClosestDraggableOrDroppableElement($(e.target));

        // return if not found draggable | droppable element
        if (element == null) {
            return;
        }

        // CASE 1: element is container | droppable
        if (thisEditor.canDropInside(element)) {
            if (!element.obj.children().length) {
                element.dropInsideHighlight();
            }
        }

        // CASE 2: element is not container | draggable
        else if (thisEditor.canDropBeside(element)) {
            var pos = element.checkTargetPosition(e);

            if (pos == 'before') {
                element.beforeHighlight();
            } else if (pos == 'after')  {
                element.afterHighlight();
            }
        } else {
            return false;
        }
    },

    checkEmpty() {
        var thisEditor = this;

        $("#builder_iframe").contents().find("[builder-element='PageElement']").each(function() {
            if ($(this).html().trim() == '') {
                $(this).addClass('container-_blank');
                $(this).html('');
            } else {
                $(this).removeClass('container-_blank');
            }
        });

        // remove all space inside cells to make sure :empty css works
        $("#builder_iframe").contents().find("[builder-element='CellElement']").each(function() {
            if ($(this).html().trim() == '') {
                $(this).html('');
            }
        });

        // js auto height iframe
        thisEditor.adjustIframeSize();
    },

    drop: function(e) {
        var thisEditor = this;

        // check is dragging
        if (!thisEditor.isDragging) {
            return;
        }

        // remove effect
        thisEditor.dragShadow.remove();
        thisEditor.isDragging = false;

        // check if e present?
        if (typeof(e) == 'undefined') {
            return;
        }

        // init
        var element = thisEditor.findClosestDraggableOrDroppableElement($(e.target));

        if (element == null) {
            return;
        }

        // items before drop
        var items = $('<div>').html(thisEditor.dropHtml).children();

        // add block container
        if (!thisEditor.draggableItem.hasBlockContainer()) {
            var pItem = $(`
                <div builder-element="BlockElement" style="padding-top:15px;padding-bottom:15px">
                    <div class="container">
                    </div>
                </div>
            `);
            pItem.find('.container').eq(0).append(items);
            items = pItem;
        }

        // hide effects
        items.css('opacity', 0);        

        // CASE 1: element is container
        if (thisEditor.canDropInside(element)) {            
            // find postion vs element
            var pos = element.checkTargetPosition(e);

            if (pos == 'before') {
                // insert element
                element.obj.prepend(items);
            } else if (pos == 'after')  {
                // insert element
                element.obj.append(items);
            }
        }

        // CASE 2: element is not container
        else if (thisEditor.canDropBeside(element)) {
            // find postion vs element
            var pos = element.checkTargetPosition(e);

            if (pos == 'before') {
                // insert element
                element.obj.before(items);
            } else if (pos == 'after')  {
                // insert element
                element.obj.after(items);
            }
        } else {
            return false;
        }

        // items fater drop
        items.fadeTo(500, 1, function() {
            // unselect current
            thisEditor.unselect();
            thisEditor.hideControls();

            // save history
            thisEditor.recordState(getI18n('dropped'));

            // check empty
            thisEditor.checkEmpty();

            // after action
            if (typeof(thisEditor.dragOptions.drop) !== 'undefined') {
                thisEditor.dragOptions.drop();
            }
        });
    },

    // find mouse over element
    findMouseOverElement: function(e) {
        var elem = $($("#builder_iframe")[0].contentWindow.document.elementFromPoint(
            e.pageX + $("#builder_iframe").offset().left - $("#builder_iframe").contents().find("body").scrollLeft(),
            e.pageY + $("#builder_iframe").offset().top - $("#builder_iframe").contents().find("html").scrollTop()
        ));
        return elem.closest('[class*="col-"]');
    },

    initDrag: function() {
        var thisEditor = this;
        thisEditor.isDragging = false;

        // Click on widget
        $(document).on('mousedown', '.widget-item', function(e) {
            // click on remove widget
            if ($(e.target).closest('.remove-widget-button').length) {
                return;
            }

            var widget_id = $(this).attr('id');
            var widget_class = $(this).attr('class-name');
            var widget;
            
            // try to create new widget with new id
            if(widget_class == 'CustomWidget' || widget_class.endsWith("FieldWidget")) {
                widget = thisEditor.widgets[widget_id];
            } else {
                widget = eval(`new ${widget_class}()`);
            }

            thisEditor.drag(widget, {
                drop: function() {
                    if (typeof(widget.drop) !== 'undefined') {
                        widget.drop();
                    }
                }
            });
        });

        // drag over elements in content
        $("#builder_iframe").contents().find("body").on('mousemove', '*', function(e) {
            if(!thisEditor.isDragging) {
                return;
            }

            thisEditor.dragging(e);
        });

        // drop widget in content
        $("#builder_iframe").contents().find("html").on('mouseup', '*', function(e) {
            if(!thisEditor.isDragging) {
                return;
            }

            thisEditor.drop(e);

            // select again
            if (thisEditor.selected != null) {
                thisEditor.selected.select();
            }
        });

        // mouse up outside content
        $(document).on('mouseup', '*', function() {
            //// drop id has anything dragging
            thisEditor.drop();

            // select again
            if (thisEditor.selected != null) {
                thisEditor.selected.select();
            }
        });

        // mouse up outside content
        $("#builder_iframe").contents().find("body").on('mouseout', '*', function() {
            // remove all drop after effect
            $("#builder_iframe").contents().find('.drop-element-after-highlight').removeClass('drop-element-after-highlight');
            $("#builder_iframe").contents().find('.drop-element-after-hover').remove();
            $("#builder_iframe").contents().find('.builder-drop-after-element').removeClass('builder-drop-after-element');
            $("#builder_iframe").contents().find('.drop-element-before-hover').remove();
            $("#builder_iframe").contents().find('.builder-drop-before-element').removeClass('builder-drop-before-element');
            $("#builder_iframe").contents().find('.builder-class-drop-element-highlight').removeClass('builder-class-drop-element-highlight');
            $("#builder_iframe").contents().find('.builder-drop-outline').remove();
            $("#builder_iframe").contents().find('.drop-inside-label-hover').remove();
            $("#builder_iframe").contents().find('.builder-drop-inside-outline').remove();

            // other
            $("#builder_iframe").contents().find('.drop-row-after-highlight').removeClass('drop-row-after-highlight');
            $("#builder_iframe").contents().find('.col-hightlight').removeClass('col-hightlight');
        });

        // mouse up in content
        $("#builder_iframe").contents().find("body").on('mouseup', '*', function() {
            // remove all drop after effect
            $("#builder_iframe").contents().find('.drop-element-after-highlight').removeClass('drop-element-after-highlight');
            $("#builder_iframe").contents().find('.drop-element-after-hover').remove();
            $("#builder_iframe").contents().find('.builder-drop-after-element').removeClass('builder-drop-after-element');
            $("#builder_iframe").contents().find('.drop-element-before-hover').remove();
            $("#builder_iframe").contents().find('.builder-drop-before-element').removeClass('builder-drop-before-element');
            $("#builder_iframe").contents().find('.builder-class-drop-element-highlight').removeClass('builder-class-drop-element-highlight');
            $("#builder_iframe").contents().find('.builder-drop-outline').remove();
            $("#builder_iframe").contents().find('.drop-inside-label-hover').remove();
            $("#builder_iframe").contents().find('.builder-drop-inside-outline').remove();

            // other
            $("#builder_iframe").contents().find('.drop-row-after-highlight').removeClass('drop-row-after-highlight');
            $("#builder_iframe").contents().find('.col-hightlight').removeClass('col-hightlight');
        });

        // init moving element inside content
        $("#builder_iframe").contents().find("body").on('mousedown', '.builder-outline-move-hook', function(e) {
            var old = thisEditor.selected;

            // remove inline edit
            thisEditor.removeInlineEdit(thisEditor.selected.obj);

            // unselect effects
            thisEditor.selected.unselect();

            thisEditor.drag(
                thisEditor.selected,
                {
                    drop: function() {
                        old.obj.remove();
                    }
                }
            );
        });
    },

    inlineEdit: function(container) {
        var thisEditor = this; 

        // custom inline edit
        if (thisEditor.customInlineEdit) {
            thisEditor.customInlineEdit(container);
            return;
        }

        var types = 'li, p, h1, h2, h3, h4, h5, h6, a, span';

        // set true always check editor type
        if (thisEditor.inlineEditor == 'default') {
            // if (true || container.is(types)) {
            if (!container[0].hasAttribute('builder-no-inline-edit')) {
                container.notebook({
                    modifiers: ['bold', 'italic', 'underline', 'anchor']
                });
            }

            //if (container.is('div')) {
            //    if (container.children().length == 0) {
            //        container.notebook({
            //            modifiers: ['bold', 'italic', 'underline', 'anchor']
            //        });
            //    }
            //}
        } else if (thisEditor.inlineEditor == 'tinymce') {
            var toolbar = [
                'undo redo | bold italic underline fontsizeselect | link | menuDateButton',
                // 'forecolor backcolor | alignleft aligncenter alignright alignfull | numlist bullist outdent indent'
            ];
            if (typeof(thisEditor.showInlineToolbar) !== 'undefined' && thisEditor.showInlineToolbar == false) {
                toolbar = [];
            }
            var tinyconfig = {
                skin: 'oxide-dark',
                valid_elements: '*[*]',
                valid_children: '+h1[div],+h2[div],+h3[div],+h4[div],+h5[div],+h6[div],+a[div],*[*]',
                allow_html_in_named_anchor: true,
                inline: true,
                menubar: false,
                force_br_newlines : false,
                force_p_newlines : false,
                forced_root_block : '',
                relative_urls: false,
                convert_urls: false,
                remove_script_host : false,
                inline_boundaries: false,
                plugins: 'link lists autolink',
                //toolbar: 'undo redo | bold italic underline | fontselect fontsizeselect | forecolor backcolor | alignleft aligncenter alignright alignfull | numlist bullist outdent indent',
                toolbar: toolbar,
                setup: function (editor) {
                
                    /* Menu button that has a simple "insert date" menu item, and a submenu containing other formats. */
                    /* Clicking the first menu item or one of the submenu items inserts the date in the selected format. */
                    editor.ui.registry.addMenuButton('menuDateButton', {
                      text: getI18n('editor.insert_tag'),
                      fetch: function (callback) {
                        var items = [];

                        thisEditor.tags.forEach(function(tag) {
                            if ( tag.type == 'label') {
                                items.push({
                                    type: 'menuitem',
                                    text: tag.tag.replace("{", "").replace("}", ""),
                                    onAction: function (_) {
                                        if (tag.text) {
                                            editor.insertContent(tag.text);
                                        } else {
                                            editor.insertContent(tag.tag);
                                        }                                            
                                    }
                                });
                            }
                        });
                        
                        callback(items);
                      }
                    });

                    editor.on("change keyup", function(e){
                        if (typeof(thisEditor.inlineEditCallback) != 'undefined') {
                            thisEditor.inlineEditCallback(editor.getContent());
                        }
                    });
                }
            };

            var unsupported_types = 'td, table, img, body';
            if (!container.is(unsupported_types) && (container.is('[builder-inline-edit]') || !thisEditor.strict)) {
                container.addClass('builder-class-tinymce');
                tinyconfig.selector = '.builder-class-tinymce';
                thisEditor.tinymce = $("#builder_iframe")[0].contentWindow.tinymce.init(tinyconfig);

                container.removeClass('builder-class-tinymce');
            }

            // fixing td tinymce
            if (container.is('td')) {
                if (!container.find('.tinymce-td-fix').length) {
                    var span = $('<div class="tinymce-td-fix builder-class-tinymce">');
                    span.html(container.html());

                    container.html('');
                    container.append(span);

                    span.click();
                }
            }
        }
    },

    removeInlineEdit: function(container) {
        // remove tinymce instant
        $("#builder_iframe")[0].contentWindow.tinymce.remove();
    },

    loadIframeJs: function(jss, callback) {
        var thisEditor = this;

        if (jss.length > 0) {
            var s = document.createElement("script");
            var url = jss.shift();

            console.log("loading: " + url);

            s.type = "text/javascript";
            s.src = url;
            s.setAttribute('builder-helper', 'true')
            s.onload = function () {
                //
                thisEditor.loadIframeJs(jss, callback);
            };
            $("#builder_iframe")[0].contentWindow.document.head.appendChild(s);
        } else {
            if (typeof(callback) !== 'undefined') {
                callback();
            }
        }
    },

    includeIframeJs: function(jss, callback) {
        var thisEditor = this;

        if (jss.length > 0) {
            var s = document.createElement("script");
            var url = jss.shift();
            console.log("loading: " + url);
            s.type = "text/javascript";
            s.src = url;
            s.onload = function () {
                if (typeof(callback) !== 'undefined') {
                    callback();
                }

                //
                thisEditor.loadIframeJs(jss, callback);
            };
            $("#builder_iframe")[0].contentWindow.document.head.appendChild(s);
        }
    },

    loadPageJs: function(jss, callback) {
        var thisEditor = this;

        if (jss.length > 0) {
            var s = document.createElement("script");
            var url = jss.shift();

            console.log("loading: " + url);

            s.type = "text/javascript";
            s.src = url;
            s.setAttribute('builder-helper', 'true');
            s.onload = function () {
                //
                thisEditor.loadIframeJs(jss, callback);
            };
            window.document.head.appendChild(s);
        } else {
            if (typeof(callback) !== 'undefined') {
                callback();
            }
        }
    },

    setupIframe: function(callback) {
        var thisEditor = this;

        // code will run after iframe has finished loading        
        $("#builder_iframe").contents().find('head').append('<link builder-helper="true" rel="stylesheet" href="'+thisEditor.root+'iframe/builder-frame.css">');
        $("#builder_iframe").contents().find('head').append('<link builder-helper="true" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">');
        $("#builder_iframe").contents().find('head').append('<link builder-helper="true" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined">');
        if (thisEditor.iconStyle == 'default') {
            $("#builder_iframe").contents().find('head').append('<link builder-helper="true" rel="stylesheet" href="'+thisEditor.root+'iframe/fontawesome-free/css/fontawesome.min.css">');
            $("#builder_iframe").contents().find('head').append('<link builder-helper="true" rel="stylesheet" href="'+thisEditor.root+'iframe/fontawesome-free/css/brands.min.css">');
            $("#builder_iframe").contents().find('head').append('<link builder-helper="true" rel="stylesheet" href="'+thisEditor.root+'iframe/fontawesome-free/css/solid.min.css">');
        } else if (thisEditor.iconStyle == 'fontawesome') {
            $("#builder_iframe").contents().find('head').append('<link builder-helper="true" rel="stylesheet" href="'+thisEditor.root+'iframe/fontawesome/css/fontawesome.min.css">');
            $("#builder_iframe").contents().find('head').append('<link builder-helper="true" rel="stylesheet" href="'+thisEditor.root+'iframe/fontawesome/css/light.min.css">');
            $("#builder_iframe").contents().find('head').append('<link builder-helper="true" rel="stylesheet" href="'+thisEditor.root+'iframe/fontawesome/css/brands.min.css">');
        }
        $("#builder_iframe").contents().find('head').append('<link builder-helper="true" rel="stylesheet" href="'+thisEditor.root+'iframe/autocomplete.css">');

        // Default js
        var jss = [thisEditor.root+'iframe/events.js', thisEditor.root+'iframe/jquery.min.js'];

        // Editor
        if (thisEditor.inlineEditor == 'default') {
            $("#builder_iframe").contents().find('head').append('<link builder-helper="true" rel="stylesheet" href="'+thisEditor.root+'iframe/editor-notebook/src/js/jquery.notebook.css">');
            jss.push(thisEditor.root+'iframe/editor-notebook/src/js/jquery.notebook.js');
        } else if (thisEditor.inlineEditor == 'tinymce') {
            jss.push(thisEditor.root+'iframe/tinymce/tinymce.min.js');
        }

        // load js
        thisEditor.loadIframeJs(jss, function () {
            thisEditor.loadingSetMessage('Scripts were loaded...');

            if (typeof(callback) !== 'undefined') {
                callback();
            }
        });
    },

    initIframe: function() {
        var thisEditor = this;
        
        // content iframe after loaded listening
        thisEditor.iframe.on('load', function() {
            thisEditor.setupIframe(function() {
                thisEditor.loadingSetMessage('Finalizing...');

                // after iframe header loaded (all loaded)
                thisEditor.afterIframeLoaded();

                // callback
                if (typeof(thisEditor.iframeLoadedCallback) !== 'undefined') {
                    thisEditor.iframeLoadedCallback();
                }

                // 
                thisEditor.adjustIframeSize();

                // all done
                thisEditor.done();
            });
        });

        if (!thisEditor.url) {            
            var html = '<!DOCTYPE html><html lang="en"><head>' +
                '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">' +
                    '<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">' +
                    '<meta name="description" content="">' +
                    '<meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">' +
                    '<meta name="generator" content="AcelleSystemLayouts">' +
                    '<title>Blank</title>' +
                '</head>' +
                '<body class="" style="width:auto">' +
                    '<div builder-element="PageElement">' +
                    '</div>' +
                '</body>' +
                '</html>';
            thisEditor.iframe.attr('srcdoc', html);
        } else {
            thisEditor.loadingSetMessage('Loading template...');
            thisEditor.loadUrl(thisEditor.url);
        }
    },

    loadHtml: function(html) {
        var thisEditor = this;

        // unselect
        thisEditor.unselect();
        thisEditor.hideControls();

        thisEditor.iframe.contents().find("body").html(html);

        // js auto height iframe
        thisEditor.adjustIframeSize();
    },

    loadUrl: function(url, callback) {
        var thisEditor = this;

        thisEditor.url = url;
        
        thisEditor.iframe.attr('src', thisEditor.url);

        if (typeof(callback) !== 'undefined') {
            thisEditor.iframeLoadedCallback = function() {
                callback();
            }
        };
    },

    load: function(html) {
        var thisEditor = this;

        thisEditor.iframeLoadedCallback = function() {
            thisEditor.loadHtml(html).html();
        };
    },

    handleAutocomplete: function() {
        var thisEditor = this;
        var tags = [];

        if (!thisEditor.tags) {
            return false;
        }

        thisEditor.tags.forEach(function(tag) {
            if ( tag.type == 'label') {
                tags.push(tag.tag);
            }
        });

        // init autocomplete input
        acpAutocomplete (thisEditor, tags);
    },
    
    isNotElement: function (obj) {
        if (obj[0].hasAttribute('builder-no-select')) {
            return true;
        } else {
            return false;
        }
    },

    isHelperTarget: function (obj) {
        if (// obj.closest('.mce-content-body').length > 0 ||
            obj.closest('.tox').length > 0 ||
            obj.closest('.tox-tinymce').length > 0 ||
            obj.closest('.builder-outline-move-hook').length > 0 ||
            obj.closest('.builder-outline-selected-controls').length > 0 ||
            obj.closest('[f-role=placeholder]').length > 0 ||
            obj.closest('.tox-editor-container').length > 0 ||
            obj.closest('.bubble').length > 0
        ) {
            return true;
        } else {
            return false;
        }
    },
    
    showEditCode: function () {
        var thisEditor = this;
        
        thisEditor.editHtmlPopup = new PopUp(getI18n('edit_html_code'), 'auto');
        var content = $('#EditHtmlModal').html();
        
        content = window.beautify.html(content, {
            indent_size: '2',
            indent_char: ' ',
            max_preserve_newlines: '5',
            preserve_newlines: true,
            keep_array_indentation: false,
            break_chained_methods: false,
            indent_scripts: 'normal',
            brace_style: 'expand',
            space_before_conditional: true,
            unescape_strings: false,
            jslint_happy: false,
            end_with_newline: false,
            wrap_line_length: '80',
            indent_inner_html: true,
            comma_first: false,
            e4x: false
        });
        
        thisEditor.editHtmlPopup.loadHtml(content);
        
        //set editor with ace js
        thisEditor.edit_html = ace.edit("EditHtml");
        thisEditor.edit_html.setTheme("ace/theme/monokai");
        thisEditor.edit_html.session.setMode("ace/mode/html");
        thisEditor.edit_html.session.setTabSize(4);
        thisEditor.edit_html.setValue(thisEditor.selected.obj[0].outerHTML);
        thisEditor.edit_html.session.setUseWrapMode(true);
        
        thisEditor.edit_html.setOptions({
            maxLines: (window.innerHeight - 260)/15,
            minLines: (window.innerHeight - 260)/15
        });
    },

    // after iframe and all new js css files embeded loaded
    afterIframeLoaded: function() {
        var thisEditor = this;

        thisEditor.initDrag();

        // include js
        if (typeof($("#builder_iframe")[0].contentWindow.beeFormLoaded) == 'undefined') {
            $("#builder_iframe").contents().find('head').append('<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">');
            $("#builder_iframe").contents().find('head').append('<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">');
            $("#builder_iframe").contents().find('head').append(thisEditor.transformHtml(`
                <style builder-helper="true" class="builder-tool">
                    [builder-element=CellElement]:empty::after {
                        content: "{language.drag_items_here}";
                    }
                </style>
            `));
            thisEditor.loading += 1;
        }

        // click on content (content)
        $("#builder_iframe").contents().click(function(e) {
            if ($(e.target).hasClass('builder-outline-move-hook') || $(e.target).parents('.builder-outline-move-hook').length) {
                return;
            }

            // save current click pos
            thisEditor.clickX = e.offsetX;
            thisEditor.clickY = e.offsetY;

            var obj = $(e.target);
            var element = thisEditor.elementFactory(obj);

            while (element != null && !element.canSelect() && obj.parents('[builder-element]').length) {
                obj = obj.parents('[builder-element]').first();
                element = thisEditor.elementFactory(obj);
            }

            if (!element.canSelect()) {
                return this.elementFactory(element.obj.parents('[builder-element]').first());
            }

            if (element != null) {
                e.preventDefault();

                $('a.nav-item').removeClass('active show');
                $('.tab-pane').removeClass('active show');
                $('#nav-home-tab').addClass('active show');
                $('#nav-home').addClass('active show');

                // select elment
                var old = thisEditor.selected;
                thisEditor.select(element);
                if(old == null || !old.equals(thisEditor.selected)) {
                    thisEditor.handleSelect();
                }
            } else if (!thisEditor.isHelperTarget($(e.target))) {

                thisEditor.unselect();
                thisEditor.hideControls();
            }

            // trigger iframe content click
            clickIframe();
        });

        // Click on duplicate action on left content (khi nhan chuot phai no duplicate)
        $("#builder_iframe").contents().find("body").on('mouseup', '.builder-duplicate-selected-button', function() {
            thisEditor.duplicate();
        });
        
        // Click on code action on left content (khi nhan chuot phai no duplicate)
        $("#builder_iframe").contents().find("body").on('mouseup', '.builder-code-selected-button', function() {
            thisEditor.showEditCode();
        });

        // Click on remove action on left content (khi nhan chuot phai no delete)
        $("#builder_iframe").contents().find("body").on('mouseup', '.builder-remove-selected-button', function() {
            thisEditor.remove();
        });

        // Add content element to custom widgets
        $("#builder_iframe").contents().find("body").on('mouseup', '.builder-add-widget-button', function() {
            thisEditor.addCustomWidget(thisEditor.selected, thisEditor.selected.obj);
        });

        // select parent element
        $("#builder_iframe").contents().find("body").on('mouseup', '.builder-select-parent-button', function() {
            thisEditor.selectParent(thisEditor.selected);
        });

        $("#builder_iframe").contents().find("body").keydown(function(e){
            if( e.which === 90 && e.ctrlKey ){
                thisEditor.undo();

                return;
            }

            if( e.which === 89 && e.ctrlKey ){
                thisEditor.redo();

                return;
            }

            if( !e.ctrlKey ){
                // save history
                thisEditor.recordState();
            }
        });

        // hover on elements of content
        $("#builder_iframe").contents().find("body").on('mouseover', '*', function(e) {
            if(thisEditor.isDragging) {
                return;
            }

            // find hover element
            var obj = $(e.target);
            var element = thisEditor.elementFactory(obj);

            while (element != null && !element.canSelect() && obj.parents('[builder-element]').length) {
                obj = obj.parents('[builder-element]').first();
                element = thisEditor.elementFactory(obj);
            }

            if (element != null) {
               if (element.equals(thisEditor.selected)) {
                    // do not highlight selected element
                    return true;
               }
               element.highlight();
            }
        });

        // this.content.find('*').mouseout(function(e) {
        $("#builder_iframe").contents().find("body").on('mouseout', '*', function(e) {
            var element = thisEditor.elementFactory($(e.target));

            if (element != null) {
                if (element.equals(thisEditor.selected)) {
                    return true;
                }
                element.unhighlight();
            }
        });

        // this.content.find('*').mouseout(function(e) {
        $("#builder_iframe").contents().find("body").on('keyup', '*', function() {
            if (thisEditor.selected != null) {
                thisEditor.selected.adjustSelectOutlinePosition();
                thisEditor.selected.adjustSelectControlsPosition();
                thisEditor.selected.adjustSelectMoveButtonPosition();
            }
        });

        $("#builder_iframe").contents().find("body").on('click', '*', function() {
            $('.template-thumbnail').hide();
            $('ul.action-sync').removeClass('show-action');
            $('ul.action-lang').removeClass('show-action');
            //remove preview
            $('.action-preview').removeClass('add-background-color');
            $('ul.display').removeClass('hienlen');
            //remove view source
            $('.view-mode').removeClass('add-background-color');
            $('ul.display-view-mode').removeClass('hienlen');
            //remove design
            $('.design-menu').removeClass('add-background-design');
            $('ul.design').removeClass('display-menu');
            //remove choose
            $('.action-choose-template').removeClass('add-background-choose');
            $('ul.display-template').removeClass('display-choose-template');
        });

        // js auto height iframe
        thisEditor.adjustIframeSize();

        // handle autocomplete
        thisEditor.handleAutocomplete();

        // save first history state
        thisEditor.recordState();

        // load widgets
        thisEditor.loadWidgets();

        // init content
        thisEditor.initContent = thisEditor.getContent();

        // check empty
        thisEditor.checkEmpty();

        // prevent form element clickable
        thisEditor.preventFormElementEvents();

        // iframe resize event
        var iframeWin = document.getElementById('builder_iframe').contentWindow;
        iframeWin.addEventListener('resize', function(){ 
            if (thisEditor.selected != null) {
                thisEditor.selected.select();
            }
        });

        // disable link
        // hover on elements of content
        $("#builder_iframe").contents().find("body").on('click', 'a', function(e) {
            e.preventDefault();
        });

        // go to home tab
        thisEditor.goToHomeTab();

        $(document.getElementById('builder_iframe').contentWindow.document).ready(function() {
            thisEditor.adjustIframeSize();

            // make sure it works
            setTimeout(function() {
                thisEditor.adjustIframeSize();
            }, 500);
        })
    },

    goToHomeTab: function() {
        var thisEditor = this;

        // beepro default tab
        // default page after load
        if (thisEditor.defaultTab && thisEditor.defaultTab == 'FieldsList') {
            goToListFieldsPage();
        } else {
            goToHtmlWidgetsPage();
        }
    },

    preventFormElementEvents: function() {
        $("#builder_iframe").contents().find('select,input,textarea').on('mousedown', function(e) {
            e.preventDefault();
            this.blur();
            window.focus();
        });
    },

    adjustIframeSize: function() {
        var my_frame = document.getElementById('builder_iframe');
        var content_height = my_frame.contentWindow.document.body.scrollHeight;
        var padding = parseInt($(document.getElementById('builder_iframe').contentWindow.document.documentElement).css('padding-top')) +
            parseInt($(document.getElementById('builder_iframe').contentWindow.document.documentElement).css('padding-bottom'));

        if (content_height < 200) {
            content_height = 200;
        }

        my_frame.style.height = (content_height + padding) + 'px';

        // adjust selected hover
        if (this.selected != null) {
            this.selected.select();
        }
    },

    loadWidgets: function() {
        var thisEditor = this;
        thisEditor.widgets = {};

        // content position
        thisEditor.content_widgets_bar = $('#builder_sidebar').find('.content_widget_container');
        thisEditor.content_widgets_bar.html('');

        // row position
        thisEditor.row_widgets_bar = $('#builder_sidebar').find('.row_widget_container');
        thisEditor.row_widgets_bar.html('');

        // row position
        thisEditor.form_widgets_bar = $('.fields-container');
        thisEditor.form_widgets_bar.html('');

        // Form elements
        if (thisEditor.formFields && thisEditor.formFields.length) {
            // Form field widgets
            thisEditor.formFields.forEach(function(field) {
                var className = field.type.charAt(0).toUpperCase() + field.type.slice(1) + 'FieldWidget';
                var widget = eval('new ' + className + '(field)');
                thisEditor.addWidget(widget, 'form');
            });              
            
            // Add submit button
            thisEditor.addWidget(new SubmitButtonWidget(), 'form');
            // add form class
            $('.content-left').addClass('content-form-mode');
        } else {
            // hide forms section
            $('.widgets-section.widgets-form').hide();
        }

        // check strict
        if (this.strict) {
            // thisEditor.addWidget(new OneRowWidget(), 'row');
            // thisEditor.addWidget(new TwoRow48Widget(), 'row');
            // thisEditor.addWidget(new TwoRow66Widget(), 'row');
            // thisEditor.addWidget(new TwoRow84Widget(), 'row');
            // thisEditor.addWidget(new ThreeRow444Widget(), 'row');
            // thisEditor.addWidget(new FourRow3333Widget(), 'row');
            
            thisEditor.addWidget(new TwoColumnsWidget(), 'content');
            thisEditor.addWidget(new ThreeColumnsWidget(), 'content');

            thisEditor.addWidget(new CenterLogoWidget(), 'content');
            thisEditor.addWidget(new TextWidget(), 'content');
            thisEditor.addWidget(new ImageWidget(), 'content');
            thisEditor.addWidget(new IntroBlockWidget(), 'content');
            
            
            thisEditor.addWidget(new OneColumnBlockWidget(), 'content');
            thisEditor.addWidget(new TwoColumnsBlockWidget(), 'content');
            thisEditor.addWidget(new ThreeColumnsBlockWidget(), 'content');

            thisEditor.addWidget(new YoutubeWidget(), 'content');

            thisEditor.addWidget(new SocialLinksBlockWidget(), 'content');
            thisEditor.addWidget(new PricingTableWidget(), 'content');
            thisEditor.addWidget(new DividerWidget(), 'content');

            thisEditor.addWidget(new BoxedTextWidget(), 'content');
            thisEditor.addWidget(new HeaderBlockWidget(), 'content');
            thisEditor.addWidget(new HeroImageWidget(), 'content');

            
            thisEditor.addWidget(new TwoArticlesBlockWidget(), 'content');
            thisEditor.addWidget(new TwoArticlesRTLBlockWidget(), 'content');
            thisEditor.addWidget(new FooterBlockWidget(), 'content');
            
            
            
            thisEditor.addWidget(new ButtonWidget(), 'content');
            thisEditor.addWidget(new Button2Widget(), 'content');
            thisEditor.addWidget(new VideoWidget(), 'content');
            thisEditor.addWidget(new TableWidget(), 'content');
            thisEditor.addWidget(new Table4Widget(), 'content');
            thisEditor.addWidget(new Table5Widget(), 'content');            
            // thisEditor.addWidget(new ButtonWidget(), 'content');
            // thisEditor.addWidget(new SocialWidget(), 'content');
            // thisEditor.addWidget(new HtmlWidget(), 'content');
            // thisEditor.addWidget(new ImageCaptionWidget(), 'content');
            // thisEditor.addWidget(new FooterWidget(), 'content');
            // thisEditor.addWidget(new HeaderWidget(), 'content');            
            // thisEditor.addWidget(new ListImageWidget(), 'content');
            // thisEditor.addWidget(new ProgressBarWidget(), 'content');
            // thisEditor.addWidget(new ListGroupWidget(), 'content');
            // thisEditor.addWidget(new PanelWidget(), 'content');
            // thisEditor.addWidget(new ImageHeaderWidget(), 'content');
            // thisEditor.addWidget(new JumbotronWidget(), 'content');
            // thisEditor.addWidget(new MeterialWidget(), 'content');
            // thisEditor.addWidget(new NavbarWidget(), 'content');
            // thisEditor.addWidget(new PricingTableWidget(), 'content');
            // thisEditor.addWidget(new ServicesListWidget(), 'content');
            // thisEditor.addWidget(new ImageGridWidget(), 'content');
            // thisEditor.addWidget(new UserProfileWidget(), 'content');
            // thisEditor.addWidget(new DivContainerWidget(), 'content');
            // thisEditor.addWidget(new ContainerWidget(), 'content');
            // thisEditor.addWidget(new WellWidget(), 'content');
            // thisEditor.addWidget(new MediaObjectWidget(), 'content');
            // thisEditor.addWidget(new ParagraphWidget(), 'content');
            // thisEditor.addWidget(new MarkedTextWidget(), 'content');
            // thisEditor.addWidget(new DefinitionListWidget(), 'content');
            // thisEditor.addWidget(new BlockqouteWidget(), 'content');
            // thisEditor.addWidget(new UnorderedListWidget(), 'content');
            // thisEditor.addWidget(new HeadingWidget(), 'content');
            // thisEditor.addWidget(new LinkWidget(), 'content');
            // thisEditor.addWidget(new ButtonGroupWidget(), 'content');
            // thisEditor.addWidget(new ButtonToolbarWidget(), 'content');
            // thisEditor.addWidget(new InputFieldWidget(), 'content');
            // thisEditor.addWidget(new TextAreaWidget(), 'content');
            // thisEditor.addWidget(new CheckboxWidget(), 'content');
            // thisEditor.addWidget(new InputGroupWidget(), 'content');
            // thisEditor.addWidget(new FormGroupWidget(), 'content');
            // thisEditor.addWidget(new SelectWidget(), 'content');
            // thisEditor.addWidget(new FormWidget(), 'content');
        }

        if (!this.strict) {
            thisEditor.addWidget(new OneRowWidget(), 'row');
            thisEditor.addWidget(new TwoRow48Widget(), 'row');
            thisEditor.addWidget(new TwoRow66Widget(), 'row');
            thisEditor.addWidget(new TwoRow84Widget(), 'row');
            thisEditor.addWidget(new ThreeRow444Widget(), 'row');
            thisEditor.addWidget(new FourRow3333Widget(), 'row');
            
            // thisEditor.addWidget(new HeaderBlockWidget(), 'content');
            // thisEditor.addWidget(new HeroImageWidget(), 'content');
            // thisEditor.addWidget(new IntroBlockWidget(), 'content');
            // thisEditor.addWidget(new OneColumnBlockWidget(), 'content');
            // thisEditor.addWidget(new TwoColumnsBlockWidget(), 'content');
            // thisEditor.addWidget(new ThreeColumnsBlockWidget(), 'content');
            // thisEditor.addWidget(new TwoArticlesBlockWidget(), 'content');
            // thisEditor.addWidget(new TwoArticlesRTLBlockWidget(), 'content');
            // thisEditor.addWidget(new FooterBlockWidget(), 'content');
            // thisEditor.addWidget(new SocialLinksBlockWidget(), 'content');
            // thisEditor.addWidget(new PricingTableWidget(), 'content');
            
            // thisEditor.addWidget(new ImageWidget(), 'content');
            thisEditor.addWidget(new TextWidget(), 'content');
            thisEditor.addWidget(new DividerWidget(), 'content');
            thisEditor.addWidget(new ButtonWidget(), 'content');
            thisEditor.addWidget(new ImageWidget(), 'content');
            // thisEditor.addWidget(new TableWidget(), 'content');
            // thisEditor.addWidget(new Table4Widget(), 'content');
            // thisEditor.addWidget(new Table5Widget(), 'content');
            thisEditor.addWidget(new VideoWidget(), 'content');
            // thisEditor.addWidget(new ButtonWidget(), 'content');
            // thisEditor.addWidget(new SocialWidget(), 'content');
            thisEditor.addWidget(new HtmlWidget(), 'content');
            thisEditor.addWidget(new ImageCaptionWidget(), 'content');
            thisEditor.addWidget(new FooterWidget(), 'content');
            thisEditor.addWidget(new HeaderWidget(), 'content');            
            thisEditor.addWidget(new ListImageWidget(), 'content');
            thisEditor.addWidget(new ProgressBarWidget(), 'content');
            thisEditor.addWidget(new ListGroupWidget(), 'content');
            thisEditor.addWidget(new PanelWidget(), 'content');
            // thisEditor.addWidget(new ImageHeaderWidget(), 'content');
            thisEditor.addWidget(new JumbotronWidget(), 'content');
            thisEditor.addWidget(new MeterialWidget(), 'content');
            thisEditor.addWidget(new NavbarWidget(), 'content');
            thisEditor.addWidget(new PricingTableWidget(), 'content');
            thisEditor.addWidget(new ServicesListWidget(), 'content');
            thisEditor.addWidget(new ImageGridWidget(), 'content');
            // thisEditor.addWidget(new UserProfileWidget(), 'content');
            // thisEditor.addWidget(new DivContainerWidget(), 'content');
            // thisEditor.addWidget(new ContainerWidget(), 'content');
            // thisEditor.addWidget(new WellWidget(), 'content');
            // thisEditor.addWidget(new MediaObjectWidget(), 'content');
            thisEditor.addWidget(new ParagraphWidget(), 'content');
            thisEditor.addWidget(new MarkedTextWidget(), 'content');
            thisEditor.addWidget(new DefinitionListWidget(), 'content');
            thisEditor.addWidget(new BlockqouteWidget(), 'content');
            thisEditor.addWidget(new UnorderedListWidget(), 'content');
            // thisEditor.addWidget(new HeadingWidget(), 'content');
            thisEditor.addWidget(new LinkWidget(), 'content');
            thisEditor.addWidget(new ButtonGroupWidget(), 'content');
            thisEditor.addWidget(new ButtonToolbarWidget(), 'content');
            thisEditor.addWidget(new InputFieldWidget(), 'content');
            thisEditor.addWidget(new TextAreaWidget(), 'content');
            thisEditor.addWidget(new CheckboxWidget(), 'content');
            thisEditor.addWidget(new InputGroupWidget(), 'content');
            thisEditor.addWidget(new FormGroupWidget(), 'content');
            thisEditor.addWidget(new SelectWidget(), 'content');
            thisEditor.addWidget(new FormWidget(), 'content');
        }

        var widgets = $('#builder_sidebar').find('.content_widget_container .widget-item');
        var slideing = 18;
        // hide > 9th widget
        //dem widget > 10 thi addClass hide
        widgets.slice(slideing).addClass('hide');

        $('#builder_sidebar').find('a.link-show_more').click(function() {
            var widgets = $('#builder_sidebar').find('.content_widget_container .widget-item');
            widgets.slice(slideing).removeClass('hide');
            $(this).hide();
            $('a.link-hide_less').show();
        });

        $('#builder_sidebar').find('a.link-hide_less').click(function() {
            var widgets = $('#builder_sidebar').find('.content_widget_container .widget-item');
            widgets.slice(slideing).addClass('hide');
            $(this).hide();
            $('a.link-show_more').show();
        });
    },

    selectParent: function(element) {
        var thisEditor = this;

        var obj = element.obj.parent();
        var element = thisEditor.elementFactory(obj);

        while (element != null && !element.canSelect() && obj.parents('[builder-element]').length) {
            obj = obj.parents('[builder-element]').first();
            element = thisEditor.elementFactory(obj);
        }

        if (element != null) {
            thisEditor.select(element);
            thisEditor.handleSelect();
        } else {
            thisEditor.unselect();
            thisEditor.hideControls();
        }
    },

    transformHtml: function(html) {
        return this.setIcons(this.updateLanguage(this.prepairUrls(html)));
    },

    addWidget: function(widget, position, index) {
        var thisEditor = this;
        thisEditor.widgets[widget.id] = widget;

        // disabled widget
        if (thisEditor.disableWidgets != null && thisEditor.disableWidgets.includes(widget.getHtmlId())) {
            return;
        }

        var html = '<div class="widget-item" id="' + widget.id + '" class-name="'+widget.getHtmlId()+'" f-library="true">' +
            thisEditor.transformHtml(widget.getButtonHtml()) +
       '</div>';

        var new_w = $(html);

        if (position == 'content') {
            if (index !== null && thisEditor.content_widgets_bar.children().eq(index).length) {
                var posItem = thisEditor.content_widgets_bar.children().eq(index);                 
                posItem.before(new_w);
            } else {
                thisEditor.content_widgets_bar.append(new_w);
            }
            
            // bee pro
            $('.widgets-container').append(new_w);
        }

        if (position == 'row') {
            thisEditor.row_widgets_bar.append(new_w);
        }

        if (position == 'form') {
            thisEditor.form_widgets_bar.append(new_w);
        }

        return new_w;
    },

    addContentWidget: function(widget, index, group) {
        var thisEditor = this;
        thisEditor.widgets[widget.id] = widget;

        var html = '<div class="widget-item content-widget" id="' + widget.id + '" class-name="'+widget.getHtmlId()+'" f-library="true">' +
            widget.getButtonHtml() +
        '</div>';

        var container = thisEditor.content_widgets_bar;

        // group
        if (group !== null) {
            if (!$('[widgets-group="'+group+'"]').length) {
                // add new group
                $('.widgets-sections').prepend(`
                    <div class="widgets-section widgets-other mb-4" widgets-group="`+group+`">
                        <label class="block-title">`+group+`</label>
                        <div class="widget-list">                  
                        </div>
                    </div>
                `);
            }

            container = $('[widgets-group="'+group+'"] .widget-list');
        }

        var new_w = $(html);
        var posItem;
        if (index !== null && container.children().eq(index).length) {
            posItem = container.children().eq(index); 
            
            posItem.before(new_w);
        } else {
            posItem = container.append(new_w);
        }

        
        
        return new_w;
    },

    addCustomCss: function(url) {
        // add custom css
        $("#builder_iframe").contents().find('head').append('<link builder-helper="true" rel="stylesheet" href="'+url+'">');
    },

    addCustomWidget: function(element, item) {
        var thisEditor = this;

        var w = new CustomWidget();
        w.contentHtml = element.obj[0].outerHTML;

        // thisEditor.addWidget(w, 'content');
        thisEditor.addingWidget = w;

        // show name popup
        var p = new PopUp(getI18n('add_widget'), 'auto');
        p.loadHtml($('#WidgetNameToolbox').html().replace('[ID]', w.id));

        $(document).on('click', '.btn-add-custom-widget-'+w.id, function() {
            var name = '';
            if ($('#CustomWidgetName').val().trim() != '') {
                name = $('#CustomWidgetName').val().trim();
            } else {
                name = getI18n('my_widget');
            }

            thisEditor.addingWidget.buttonHtml = thisEditor.addingWidget.buttonHtml.replace(/\[NAME\]/g, name);
            thisEditor.addingWidget.draggingHtml = thisEditor.addingWidget.buttonHtml.replace(/\[NAME\]/g, name);

            var new_w = thisEditor.addWidget(thisEditor.addingWidget, 'content');

            p.hide();

            //
            // We mainly want to work with the <li> here so lets store it in a variable
            //var parent = item.clone();
            var parent = $('<div class="widget-moving-box">' + $('#CustomWidget').html().replace(/\[NAME\]/g, name) + '</div>');

            $('.detail-content').removeClass('dilen');
            $('.tab-content').removeClass('hide-scroll-bar');
            // Effect show/hide
            new_w.css({opacity: 0});
            $("#nav-tabContent").animate({scrollTop: $("#nav-tabContent")[0].scrollHeight}, 300, function() {
                // let's assume we have our cart with id #cart and let's get it's offset too
                var d_top = new_w.offset().top;
                var d_left = new_w.offset().left;

                parent
                // apend it to the body so that the `<body>` is our relative element
                .appendTo("body")

                // Set the product to absolute, and (hopefully) clone its' position
                .css({
                    'position': 'fixed',
                    'top': item.offset().top + $("#builder_iframe").offset().top - $("#builder_iframe").contents().find("body").scrollTop() + thisEditor.selected.obj.outerHeight()/2 - parent.outerHeight()/2,
                    'left': item.offset().left + thisEditor.selected.obj.outerWidth()/2 - parent.outerWidth()/2,
                })

                // we're now ready to animate it, supplying the coordinates from the #cart
                .animate({
                    'top': d_top,
                    'left': d_left,
                    //'height': new_w.height(),
                    'opacity': 0.2
                }, 1000, function() {
                    // Animation complete.
                    new_w.animate({
                        'opacity': 1
                    }, 300);
                })

                // Then fade it out perhaps?
                .fadeOut(300);

                thisEditor.notificationArea(getI18n('widget_success'));
            });
        });
    },

    doExport: function() {
        var thisEditor = this;

        // cleanup content before save
        thisEditor.cleanUpContent();

        // get save content
        var content = thisEditor.getContent();

        // add ddata
        var data = '';
        if(thisEditor.data != null) {
            for(var key in thisEditor.data){
                // Check if the property really exists
                if(thisEditor.data.hasOwnProperty(key)){
                    var value = thisEditor.data[key];
                    // Do something with the item :
                    data = data + '<input type="hiden" name="'+key+'" value="'+value+'" />';
                }
            }
        }

        var form = $(`
            <form style="display:none" action="`+thisEditor.export.url+`" method="POST" target="_blank">
                `+data+`
                <textarea name="content"></textarea>
            </form>`
        ).appendTo('body');
        form.find('textarea[name=content]').val(content);

        setTimeout(function() {
            form.submit();
        }, 100);
    },

    loadEvents: function() {
        var thisEditor = this;

        $(document).on('click', '.pr-desktop', function() {
            thisEditor.showPreview('desktop');
        });

        $(document).on('click', '.pr-mobile', function() {
            thisEditor.showPreview('mobile');
        });

        //js modal preview design builder desktop
        $(document).on('click', '.close-preview', function() {
            thisEditor.closePreview();
        });

        $(document).on('click', '.click-active-preview', function() {
            $('.click-active-preview').removeClass('active-preview');
            $(this).addClass('active-preview');
        });

        $('#btnClone').click(function() {
            thisEditor.duplicate();	// selected.clone()
        });

        $(document).on('click', 'a.save-design, .bp-save', function(e) {
            e.preventDefault();
            thisEditor.save();
        });
        
        $(document).on('click', '.menu-bar-action.btn-save-and-close', function(e) {
            e.preventDefault();
            
            thisEditor.save(function() {
              // check if builder has backCallback
              if (typeof(thisEditor.backCallback) !== 'undefined') {
                thisEditor.backCallback();
              } else {
                window.location.href = thisEditor.urlBack;
              }                
            });
        });
        
        $(document).on('click', '.menu-bar-action.btn-export', function(e) {
            e.preventDefault();

            Swal.fire({
                title: getI18n('are_you_sure'),
                text: getI18n('export_template_confirm'),
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: getI18n('ok')
            }).then((result) => {
                if (result.value) {
                    if (thisEditor.export != null) {
                        thisEditor.doExport();
                    }
                }
            });
        });

        //js click button preview design desktop
        $(document).on('click', '.preview-design-desktop', function() {
            thisEditor.showPreview('desktop');
        });

        //js click button preview design mobile
        $(document).on('click', '.preview-design-mobile', function() {
            thisEditor.showPreview('mobile');
        });

        //click button show on design
        $(document).on('click', '.view-mode-design', function() {
            thisEditor.viewDesign();
            return false;
        });

        //click button show on source
        $(document).on('click', '.view-mode-source, .bp-view-source', function() {
            thisEditor.viewSource();
            return false;
        });

        //js click change template
        $(document).on('click', '.hover-name-template', function(e) {
            e.preventDefault();

            var template_url = $(this).attr('template-url');
            thisEditor.changeTemplate(template_url);
        });
        
        //js click change template
        $(document).on('click', '.new-from-template-select', function(e) {
            e.preventDefault();

            var template_url = $(this).attr('href');
            thisEditor.changeTemplate(template_url);
        });

        $(document).on('click', 'img.img-template', function(e) {
            e.preventDefault();

            var template_url = $(this).attr('template-url');
            thisEditor.changeTemplate(template_url);
        });

        //js nut back in builder
        $(document).on('click', 'a.back', function(e){
            e.preventDefault();

            thisEditor.back();
        });
        
        // click on close button in top menu bar
        $(document).on('click', '.menu-bar-action.btn-close, .bp-exit', function(e){
            e.preventDefault();

            thisEditor.back();
        });

        //
        $(document).on('click', '.builder-duplicate-selected-button, .bp-duplicate', function() {
            thisEditor.duplicate();
        });

        //
        $(document).on('click', '.builder-remove-selected-button, .bp-delete', function() {
            thisEditor.remove();
        });

        //click button hide on desktop
        $('#builder_sidebar').on('click', '.desktop', function() {
           thisEditor.hideOnDesktop();
        });

        //click button hide on mobile
        $('#builder_sidebar').on('click', '.mobile', function() {
            thisEditor.hideOnMobile();
        });

        //click button hide on desktop and mobile
        $('#builder_sidebar').on('click', '.icon-remove-two-screen', function() {
           thisEditor.removeHideOnTowScreen();
        });

        $('.chonfont').click(function() {
            $('div.language').toggleClass('bangchon');
            //$('.thongso').toggleClass('doimau');
            $('.arrows-button').toggleClass('doimau');
        });
        //hieu ung sidebar content di len
        $('.click-chon').click(function() {
            thisEditor.showControls();
        });

        $('a.move').click(function() {
            thisEditor.unselect();
            thisEditor.hideControls();

            return false;
        });

        //js click not button choose-sync
        $('*:not(.choose-sync)').click(function() {
            $('ul.action-sync').removeClass('show-action');
            return;
        });
        
        //js click not button choose-lang
        $('*:not(.choose-lang)').click(function() {
            $('ul.action-lang').removeClass('show-action');
            return;
        });

        //js choose template builder
        $('*:not(.menu-bar)').click(function(e) {
            if ($(e.target).closest('.action-preview, ul.display, .view-mode, ul.display-view-mode, .design-menu, ul.design, .action-choose-template, ul.display-template').length) {
                $('div.template-thumbnail').hide();
                return;
            }

            $('div.template-thumbnail').hide();

            $('.action-choose-template').removeClass('add-background-choose');
            $('ul.display-template').removeClass('display-choose-template');
            //remove view source
            $('.view-mode').removeClass('add-background-color');
            $('ul.display-view-mode').removeClass('hienlen');
            //remove design
            $('.design-menu').removeClass('add-background-design');
            $('ul.design').removeClass('display-menu');

            $('.preview-page').removeClass('add-background-color');
            $('.preview-page').find('ul.display').removeClass('hienlen');
        });

        //js nut chon design menu
        $('.design-menu').click(function() {
            $(this).toggleClass('add-background-design');
            $(this).find('ul.design').toggleClass('display-menu');

            //remove choose
            $('.action-choose-template').removeClass('add-background-choose');
            $('ul.display-template').removeClass('display-choose-template');

            //remove view source
            $('.view-mode').removeClass('add-background-color');
            $('ul.display-view-mode').removeClass('hienlen');

            //remove preview
            $('.action-preview').removeClass('add-background-color');
            $('ul.display').removeClass('hienlen');
        });

        //js nut chon action hien preview design
        $('.preview-page').click(function() {
            $(this).toggleClass('add-background-color');
            $(this).find('ul.display').toggleClass('hienlen');

            //remove choose
            $('.action-choose-template').removeClass('add-background-choose');
            $('ul.display-template').removeClass('display-choose-template');
            //remove view source
            $('.view-mode').removeClass('add-background-color');
            $('ul.display-view-mode').removeClass('hienlen');
            //remove design
            $('.design-menu').removeClass('add-background-design');
            $('ul.design').removeClass('display-menu');
        });

        //js nut chon action view mode design, source
        $('.view-mode').click(function() {
            $(this).toggleClass('add-background-color');
            $(this).find('ul.display-view-mode').toggleClass('hienlen');

            //remove choose
            $('.action-choose-template').removeClass('add-background-choose');
            $('ul.display-template').removeClass('display-choose-template');
            //remove preview
            $('.action-preview').removeClass('add-background-color');
            $('ul.display').removeClass('hienlen');
            //remove design
            $('.design-menu').removeClass('add-background-design');
            $('ul.design').removeClass('display-menu');
        });

        //js choose template builder
        $('.action-choose-template').click(function() {
            $(this).toggleClass('add-background-choose');
            $(this).find('ul.display-template').toggleClass('display-choose-template');
            //remove preview
            $('.action-preview').removeClass('add-background-color');
            $('ul.display').removeClass('hienlen');
            //remove view source
            $('.view-mode').removeClass('add-background-color');
            $('ul.display-view-mode').removeClass('hienlen');
            //remove design
            $('.design-menu').removeClass('add-background-design');
            $('ul.design').removeClass('display-menu');

            $('div.template-thumbnail').hide();
        });

        //hover li template show image thumbnail
        $(document).on('mouseover', 'li.hover-name-template', function() {
            var thumbnail = $(this).attr('data-thumbnail');
            var url = $(this).attr('template-url');
            $('.template-thumbnail img.img-template').attr('template-url', url);
            $('.template-thumbnail img.img-template').attr('src', thumbnail);
            $('.template-thumbnail').show();
        });

        //js click action mode preview design
        $(document).on('click', 'li.device', function() {
            $('.icon-mode').css('color', 'rgb(150, 150, 150)');
            $(this).find('.icon-mode').css('color', 'white');
            $('.content-background').removeClass('mode-mobile');
            $('.content-background').removeClass('mode-tablet');
            $('.content-background').removeClass('mode-desktop');
            
            var mode = $(this).attr('data-mode');
            $('img.bg-image').attr('data-mode', mode);
            $('li.change-background').attr('data-mode', mode);
        });

        $(document).on('click', 'li.mode-mobile', function() {
            thisEditor.backgroundModeMobile();
        });
        
        $(document).on('click', 'li.box-mode-mobile', function() {
            thisEditor.backgroundModeMobile();
        });

        $(document).on('click', 'li.mode-tablet', function() {
            thisEditor.backgroundModeTablet();
        });
        
        $(document).on('click', 'li.box-mode-tablet', function() {
            thisEditor.backgroundModeTablet();
        });

        $(document).on('click', 'li.mode-desktop', function() {
            thisEditor.backgroundModeDesktop();
        });
        
        $(document).on('click', 'li.box-mode-desktop', function() {
            thisEditor.backgroundModeDesktop();
        });
        
        $(document).on('click', '.group-device li.device-screen', function() {
            $('.content-background').removeClass('mode-mobile-320 mode-mobile-360 mode-mobile-375 mode-mobile-414 mode-tablet-768 mode-tablet-1024 mode-desktop-1280 mode-desktop-1360 mode-desktop-1920 mode-mobile mode-tablet mode-desktop');

            if ($(this).hasClass('_320')) {
                $('.content-background').addClass('mode-mobile-320');
            } else if ($(this).hasClass('_360')) {
                $('.content-background').addClass('mode-mobile-360');
            } else if ($(this).hasClass('_375')) {
                $('.content-background').addClass('mode-mobile-375');
            } else if ($(this).hasClass('_414')) {
                $('.content-background').addClass('mode-mobile-414');
            } else if ($(this).hasClass('_768')) {
                $('.content-background').addClass('mode-tablet-768');
            } else if ($(this).hasClass('_1024')) {
                $('.content-background').addClass('mode-tablet-1024');
            } else if ($(this).hasClass('_1280')) {
                $('.content-background').addClass('mode-desktop-1280');
            } else if ($(this).hasClass('_1360')) {
                $('.content-background').addClass('mode-desktop-1360');
            } else if ($(this).hasClass('_1920')) {
                $('.content-background').addClass('mode-desktop-1920');
            }
        });

        $('span.padding-img').click(function() {
            $('.padding-img').toggleClass('hienlen');
            $('._1_minus-plus.img').toggleClass('andi');
        });
        
        //js click hien slide range detail img
        $(document).on('click', 'span.slider.disable', function() {
            $('input.myRanges').prop("disabled", true);
            $('label.check-disable').addClass('andi');
            $('label.check-enable').addClass('hienthi');
            $('input.color-default').addClass('color-blue');
        });

        $(document).on('click', 'span.slider.enable', function() {
            $('input.myRanges').prop("disabled", false);
            $('label.check-disable').removeClass('andi');
            $('label.check-enable').removeClass('hienthi');
            $('input.color-default').removeClass('color-blue');
        });

        //js click hien slide padding all
        $(document).on('click', 'span.slider.all-padding', function() {
            $('label.check-all-padding').addClass('andi');
            $('label.check-4-padding').addClass('hienthi');
            $('.all-padding-section').addClass('andi');
            $('.four-padding-section').addClass('hienlen');
        });

        $(document).on('click', 'span.slider._4-padding', function() {
            $('label.check-all-padding').removeClass('andi');
            $('label.check-4-padding').removeClass('hienthi');
            $('.all-padding-section').removeClass('andi');
            $('.four-padding-section').removeClass('hienlen');
        });

        //hieu ung dropdown-menu hien
        $('button.owp').click(function() {
            $('ul.down-menu').toggleClass('hienlen');
            $('.owp').toggleClass('change-background');
        });

        $('.spacing').click(function() {
            $('ul.select-down').toggleClass('hienlen');
            $('input.spacing').toggleClass('change-background');
        });

        $('._4icon').click(function() {
            $('.display-icon').toggleClass('box-icon-display');
        });

        //xu ly click thay doi trang thai active
        $(".thongso ul li span.icon-align").click(function() {
            $('span.icon-align').removeClass('active');
            $(this).addClass("active");
        });

        $("li img.icon-line-height").click(function() {
            $('.icon-line-height').removeClass('active');
            $(this).addClass("active");
        });

        $(document).on('click', 'span.dijitDialogCloseIcon', function() {
            $('.dijitDialogShow.dijitDialog').remove();
            $('.dijitDialogUnderlayWrapper').remove();
        });

        //js click nav-bar
        $(document).on('click', '#nav-home-tab', function() {
            $('.detail-content').removeClass('dilen');
            $('.tab-content').removeClass('hide-scroll-bar');

            thisEditor.unselect();
            thisEditor.hideControls();
        });

        $(document).on('click', '#nav-profile-tab, .bp-setting', function() {
            $("#builder_iframe").contents().find("[builder-element='PageElement']").click();
        });

        $(document).on('click', '#nav-contact-tab', function() {
            $('.tab-content').addClass('hide-scroll-bar');
        });

        //js action setting builder
        $(document).on('change', '#myRange', function() {
            var width = $(this).val();
            var content_builder = $('#builder_iframe').contents().find('body');
            content_builder.css('width', width);
            content_builder.css('margin', 'auto');
        });

        $(document).on('change', '#background-color', function(){
            var color = $(this).val();
            $('#text-bg-color').val(color);
            var content_body = $('#builder_iframe').contents().find('body');
            content_body.css('background-color', color);
        });

        $(document).on('change', '#content-background-color', function(){
            var color = $(this).val();
            $('#text-content-bg-color').val(color);
            var content_body = $('#builder_iframe').contents().find('body');
            var element = content_body.find('*');
            element.css('background-color', color);
        });

        $(document).on('click', 'a.font-family', function(){
            var font = $(this).attr('data-font');
            $('button.chonfont').html(font);
            var content_body = $('#builder_iframe').contents().find('body');
            content_body.css('font-family', font);
            $('.language').removeClass('bangchon');
        });

        $(document).on('change', '#link-color', function(){
            var color = $(this).val();
            $('#text-link-color').val(color);
            var content_body = $('#builder_iframe').contents().find('a');
            content_body.css('color', color);
        });

        //js action by modal change video builder
        $(document).on('click', '.action-tab', function() {
            $('.action-tab').removeClass('tab-active');
            $(this).addClass('tab-active');
            $('.tab-bg-active').removeClass('tab-bg-active');
        });

        $(document).on('click', '.video-container-modal li.tab-url', function() {
            $('.content-tab-url').show();
            $('.content-tab-upload').hide();
        });

        $(document).on('click', '.video-container-modal li.tab-upload', function() {
            $('.content-tab-url').hide();
            $('.content-tab-upload').show();
        });

        $(document).on('change', 'input.file-upload-url', function(e) {
            var fileName = e.target.files[0].name;
            $('span.des-upload-video').text(fileName);
        });

        // copy clipboard
        $(document).on('click', '.btn-tag-copy', function() {
            $(this).closest('li.tags').find('input')[0].select();
            document.execCommand('copy');

            var content = getI18n('copy_tag');
            thisEditor.notificationArea(content);
        });

        // copy tag clipboard
        $(document).on('click', '.tag-item', function() {
            $(this).find('input')[0].select();
            document.execCommand('copy');

            var content = getI18n('copy_tag');
            thisEditor.notificationArea(content);
        });

        // click new design
        $(document).on('click', '.design-new', function() {
            thisEditor.newDesign();
        });

        // click clear design
        $(document).on('click', '.design-clear', function() {
            thisEditor.clearDesign();
        });

        // click new from template
        $(document).on('click', '.design-from-template', function() {
            thisEditor.showTemplatePopup();
        });

        //copy url link image
        $(document).on('click', 'a.copy-url', function(e) {
            e.preventDefault();

            $(this).closest('.link-image').find('input.url-image')[0].select();
            document.execCommand('copy');

            var content = getI18n('copy_url_success'); //'Copy url successfully!';

            thisEditor.notificationArea(content);
        });

        // click history
        $(document).on('click', '.undo-redo-action-history', function() {
            $('.undo-redo__history--wrapper').toggleClass('show-history');
        });

        // click undo
        $(document).on('click', '.undo-redo-action-undo, .action.undo', function() {
            thisEditor.undo();
        });

        // click redo
        $(document).on('click', '.undo-redo-action-redo, .action.redo', function() {
            thisEditor.redo();
        });

        // remove widget event
        $(document).on('click', '.remove-widget-button', function() {
            $(this).closest('.widget-item').fadeOut(300, function() {
                $(this).remove();
            });
        });

        //click help modal
        $(document).on('click', '.ask-help', function(e) {
            e.preventDefault();

            var Popup = new helpPopUp();
            var url = thisEditor.root + '../manual?v=4';
            Popup.load(url);
        });

        //click button change language
        $(document).on('click', '.choose-lang', function(e) {
            e.preventDefault();
            $('ul.action-lang').toggleClass('show-action');
        });
        
        //click button sync
        $(document).on('click', '.choose-sync', function(e) {
            e.preventDefault();
            $('ul.action-sync').toggleClass('show-action');
        });

        //click span action sync
        $(document).on('click', '.btn-sync', function(e) {
            e.preventDefault();
            thisEditor.save();
        });

        //click action sync
        $(document).on('click', 'li.synchronization', function(e) {
            e.preventDefault();
            var sync = $(this).attr('data-title');
            thisEditor.synchronization($(this));
            var content = getI18n('syn_with') +sync;
            thisEditor.notificationArea(content);
        });

        $(document).on('click', 'li.setting', function(e) {
            e.preventDefault();
            thisEditor.settingSync();
        });

        //load js action box right
        $(document).on('mouseover', '.box-popup-right', function() {
            $(this).addClass('box-over');
            $(this).removeClass('box-out');
        });

        $(document).on('mouseout', '.box-popup-right', function() {
            $(this).addClass('box-out');
            $(this).removeClass('box-over');
        });

        $(document).on('click', '.box-popup-right', function() {
            $('.right-box').toggleClass('show');
            $('i.icon-box').toggleClass('change-icon');
            $(this).toggleClass('distance-right');
            $('#builderModal').toggleClass('show-popup-right');

            if ($(this).hasClass('distance-right')) {
                $('.box-popup-right.distance-right').attr('title', 'Hide apps');
                $('.box-popup-right .icon').html('chevron_right');
            } else {
                $('.box-popup-right').attr('title', 'Show apps');
                $('.box-popup-right .icon').html('chevron_left');
            }

            var popup = new PopUp('', 'xright', 'right');
            popup.loadHtmlXright();
        });

        $("li#box-mode-mobile").hover(
            function () {
                $('ul.group-mobile').addClass('show');
            },
            function () {
                $('ul.group-mobile').removeClass('show');
            }
        );

        $("li#box-mode-tablet").hover(
            function () {
                $('ul.group-tablet').addClass('show');
            },
            function () {
                $('ul.group-tablet').removeClass('show');
            }
        );

        $("li#box-mode-desktop").hover(
            function () {
                $('ul.group-desktop').addClass('show');
            },
            function () {
                $('ul.group-desktop').removeClass('show');
            }
        );

        $("li#background-option").hover(
            function () {
                $('ul.group-background').addClass('show');
            },
            function () {
                $('ul.group-background').removeClass('show');
            }
        );

        $('li.box-device').hover(function() {
            $('li.box-device').removeClass('background-active');
            $(this).addClass('background-active');
        });

        $(document).on('click', 'li.box-device', function() {
            $('.box-device.active').removeClass('active');
            $(this).addClass('active');
        });

        //js change background
        $(document).on('click', 'li.device-bg img.bg-image', function(e) {
            e.preventDefault();

            var mode = $(this).attr('data-mode');
            var bg = $(this).attr('src');
            $('#editable').css('background-image','url('+ bg + ')');
            $('#editable').css('background-size','contain');
            $('#editable').css('background-position','inherit');
            $('.content-background').attr('class').addClass(mode);
        });

        $(document).on('click', 'li.change-background', function() {
            var mode = $(this).attr('data-mode');
            $('.content-background').attr('class').addClass(mode);
        });

        //js upload template for builder
        $(document).on('click', 'a.design-upload-template', function(e) {
            e.preventDefault();

            var html = $('#uploadTemplate').html();
            var popup = new PopUp('Upload Template', 'auto');
            popup.loadHtml(html);
        });

        $(document).on('change', 'input.file-upload-template', function() {
            var fileName = this.files[0].name;
            $('span.des-upload').text(fileName);
        });

        $(document).on('click', '#buttonUploadTemplate', function(e){
            e.preventDefault();

            var url = thisEditor.uploadTemplateUrl;
            thisEditor.uploadTemplate(url);
        });
        
        // click save edit html
        $(document).on('click', '.edit-html-save-button', function(e){
            e.preventDefault();
            
            var cur = thisEditor.selected;
            
            var html = thisEditor.edit_html.getValue();
            
            var newObj = $(html);

            thisEditor.selected.obj.replaceWith(newObj);
            
            var element = thisEditor.elementFactory(newObj);
            if (element !== null) {
                thisEditor.select(element);
                thisEditor.handleSelect();
            }
            
            thisEditor.editHtmlPopup.hide();
        });

        // click outside grey background content
        $(".content-left, .beepro-content, .content-background").click(function(){
            thisEditor.unselect();
            thisEditor.hideControls();
        }).children().click(function(e) {
            return false;
        });
    },
    
    changeActiveDevice: function() {
        $('.box-mode-mobile').removeClass('active');
        $('.box-mode-tablet').removeClass('active');
        $('.box-mode-desktop').removeClass('active');
        $('.box-mode-mobile').removeClass('background-active');
        $('.box-mode-tablet').removeClass('background-active');
        $('.box-mode-desktop').removeClass('background-active');
    },
    
    backgroundModeMobile: function() {
        var thisEditor = this;
        $('.content-background').addClass('mode-mobile');
        $('.content-background').removeClass('mode-tablet mode-tablet-768 mode-tablet-1024');
        $('.content-background').removeClass('mode-desktop mode-desktop-1280 mode-desktop-1360 mode-desktop-1920');
        $('li.mode-mobile').find('i.icon-mode').css('color', 'white');
        $('li.mode-tablet').find('i.icon-mode').css('color', 'rgb(150, 150, 150)');
        $('li.mode-desktop').find('i.icon-mode').css('color', 'rgb(150, 150, 150)');
        
        thisEditor.changeActiveDevice();
        $('ul.box-mode li#box-mode-mobile').addClass('active');
        $('ul.box-mode li#box-mode-mobile').addClass('background-active');
        
        var my_frame = document.getElementById('builder_iframe');
        var width = $('.content-background.mode-mobile').width();
        my_frame.style.width = width + 'px';

        // body css
        $("#builder_iframe").contents().find("body").removeClass (function (index, className) {
            return (className.match (/(^|\s)builder-class-mode-\S+/g) || []).join(' ');
        });
        $("#builder_iframe").contents().find("body").addClass('builder-class-mode-mobile');

        thisEditor.adjustIframeSize();
    },
    
    backgroundModeTablet: function() {
        var thisEditor = this;
        $('.content-background').addClass('mode-tablet');
        $('.content-background').removeClass('mode-mobile');
        $('.content-background').removeClass('mode-desktop mode-desktop-1280 mode-desktop-1360 mode-desktop-1920');
        $('li.mode-tablet').find('i.icon-mode').css('color', 'white');
        $('li.mode-mobile').find('i.icon-mode').css('color', 'rgb(150, 150, 150)');
        $('li.mode-desktop').find('i.icon-mode').css('color', 'rgb(150, 150, 150)');
        
        thisEditor.changeActiveDevice();
        $('ul.box-mode li#box-mode-tablet').addClass('active');
        $('ul.box-mode li#box-mode-tablet').addClass('background-active');
        
        var my_frame = document.getElementById('builder_iframe');
        var width = $('.content-background.mode-tablet').width();
        my_frame.style.width = width + 'px';

        // body css
        $("#builder_iframe").contents().find("body").removeClass (function (index, className) {
            return (className.match (/(^|\s)builder-class-mode-\S+/g) || []).join(' ');
        });
        $("#builder_iframe").contents().find("body").addClass('builder-class-mode-tablet');

        thisEditor.adjustIframeSize();
    },
    
    backgroundModeDesktop: function() {
        var thisEditor = this;
        $('.content-background').addClass('mode-desktop');
        $('.content-background').removeClass('mode-mobile');
        $('.content-background').removeClass('mode-tablet');
        $('li.mode-desktop').find('i.icon-mode').css('color', 'white');
        $('li.mode-mobile').find('i.icon-mode').css('color', 'rgb(150, 150, 150)');
        $('li.mode-tablet').find('i.icon-mode').css('color', 'rgb(150, 150, 150)');
        
        thisEditor.changeActiveDevice();
        $('ul.box-mode li#box-mode-desktop').addClass('active');
        $('ul.box-mode li#box-mode-desktop').addClass('background-active');
        
        var my_frame = document.getElementById('builder_iframe');
        var width = $('.content-background.mode-desktop').width();
        my_frame.style.width = width + 'px';

        // body css
        $("#builder_iframe").contents().find("body").removeClass (function (index, className) {
            return (className.match (/(^|\s)builder-class-mode-\S+/g) || []).join(' ');
        });
        $("#builder_iframe").contents().find("body").addClass('builder-class-mode-desktop');

        thisEditor.adjustIframeSize();
    },

    notificationArea: function(content) {
        bootstrapGrowl(content ,{
            type: 'success',
            delay: 3000,
        });
    },

    newDesign: function() {
        var thisEditor = this;

        if (thisEditor.strict) {
            $("#builder_iframe").contents().find("[builder-element='PageElement']").html('');
            thisEditor.checkEmpty();
        }
    },

    clearDesign: function() {
        var thisEditor = this;

        Swal.fire({
            title: getI18n('are_you_sure'),
            text: getI18n('clear_while'),
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: getI18n('ok')
        }).then((result) => {
            if (result.value) {
                thisEditor.unselect();
                thisEditor.hideControls();

                Swal.fire({
                    title: getI18n('good_job'),
                    text: getI18n('clear_success'),
                    type: "success",
                }).then((result) => {
                    // clear callback
                    if (thisEditor.clear) {
                        thisEditor.clear();
                        return;
                    }

                    if (thisEditor.strict) {
                        $("#builder_iframe").contents().find("[builder-element='PageElement']").html('');
                        thisEditor.checkEmpty();
                    }                    
                });
            }
        });
    },

    showTemplatePopup: function() {
        var templatePopup = new PopUp(getI18n('choose_template'));
        var contentPopup = '<div>' + $('#templateToolbox').html() + '</div>';

        templatePopup.loadHtml(contentPopup);
        $('.nav-content').removeClass('active');
        $('.nav-tab').removeClass('active');
        $('#home').addClass('active show');
    },

    viewSource: function() {
        var thisEditor = this;
        thisEditor.editing = false;

        // bee pro
        $('body').addClass('bp-source-mode');
        hideMainMenuDropdown();

        $('.content-left').removeClass('col-md-8');
        $('.content-left').addClass('col-md-6');
        $('#show-mode').html(getI18n('mode_source'));
        $('.content-right').hide();
        $('.view-source').show();

        var content = $("#builder_iframe").contents().find("body").html();

        //set editor with ace js
        var source_code = ace.edit("editor");
        source_code.setTheme("ace/theme/monokai");
        source_code.session.setMode("ace/mode/html");
        source_code.session.setTabSize(4);
        source_code.setValue(content);

        if (thisEditor.editing == false) {
            thisEditor.editing = true;

            source_code.session.on('change', function() {
                thisEditor.editing = false;
                setTimeout(function() {thisEditor.updateFromSource('source');}, 5000);
            });
        }

        thisEditor.cleanUpContent();
        thisEditor.adjustIframeSize();
    },

    updateFromSource: function(mode = 'design') {
        if (mode == 'source') {
            var source_code = ace.edit("editor");
            var content = source_code.getValue();
            $('iframe#builder_iframe').contents().find('body').html(content);
        } else {
            //return;
            $('.tab-content').removeClass('hide-scroll-bar');
            $('.content-left').addClass('animation');
            setTimeout(function (){
                $('.content-left').removeClass('animation');
            },100);
        }
    },

    viewDesign: function() {
        var thisEditor = this;

        $('body').removeClass('bp-source-mode');

        thisEditor.updateFromSource('design');

        $('.detail-content.dilen').removeClass('dilen');
        $('.content-left').removeClass('col-md-6');
        $('.content-left').addClass('col-md-8');
        $('#show-mode').html(getI18n('mode_design'));
        $('.content-right').show();
        $('.view-source').hide();

        thisEditor.adjustIframeSize();
    },

    showControls: function() {
        $('.detail-content').addClass('dilen');
        $('#nav-home-tab').removeClass('active');
    },

    toogleChooseTemplateMenu: function() {
        var thisEditor = this;

        if(typeof(thisEditor.templates) == 'undefined' || thisEditor.templates == '' || thisEditor.templates.length == 0) {
          $('.choose-template-menu').remove();
        }
    },

    showPreview: function(device = 'desktop') {
        // show popup
        var thisBuilder = this;
        //clean element hieu ung
        thisBuilder.cleanUpContent();
        var latestContent = $('#builder_iframe').contents().find('html').html();

        $('div.showPreview').show("fast", function() {
            $('#modal-preview-desktop .modal-body-preview').hide();
            $('#modal-preview-desktop .modal-body-preview-mobile').hide();
            
            thisBuilder.hideControls();


            $('#previewIframeMobile').attr('src', thisBuilder.url);
            $('#previewIframeDesktop').attr('src', thisBuilder.url);
            // load iframe
            if (device == 'mobile') {
                //$('#previewIframeMobile').attr("srcdoc", content);

                $('#modal-preview-desktop .modal-body-preview-mobile').show("fast", function() {
                    $('.pr-mobile').addClass('active-preview');
                    $('#previewIframeMobile').contents().find('body').html(latestContent);
                    $('#previewIframeMobile').contents().find('body').find('.Hide-on-mobile').css('display', 'none');
                });
                thisBuilder.setAdjustFrame('mobile');

            } else { // desktop
                //$('#previewIframeDesktop').attr("srcdoc", content);

                $('#modal-preview-desktop .modal-body-preview').show("fast", function() {
                    $('.pr-desktop').addClass('active-preview');
                    $('#previewIframeDesktop').contents().find('body').html(latestContent);
                    $('#previewIframeDesktop').contents().find('body').find('.Hide-on-desktop').css('display', 'none');
                });
                thisBuilder.setAdjustFrame('desktop');
            }
        });
    },

    setAdjustFrame: function(mode = 'desktop') {
        if (mode == 'mobile') {
            var my_frameM = document.getElementById('previewIframeMobile');
            var content_heightM = my_frameM.contentWindow.document.body.scrollHeight;
            my_frameM.style.height = content_heightM + 'px';
        } else {
            var my_frameD = document.getElementById('previewIframeDesktop');
            var content_heightD = my_frameD.contentWindow.document.body.scrollHeight;
            my_frameD.style.height = content_heightD + 'px';
        }
    },

    loadTags: function() {
        var thisEditor = this;

        if (typeof(thisEditor.tags) != 'undefined') {
            thisEditor.tags.forEach(function(tag) {
                if ( tag.type == 'label') {
                    $('ul.tags-value').append('<li class="tags" title="'+tag.tag+'">'+
                                                '<div class="float-left">'+
                                                   '<div class="tag">'+
                                                      '<input class="copy-tags builder-tag-text" value="'+ tag.tag +'" data-value="" style="outline: none;border: none;background-color: #f5f5f5;"/>'+
                                                   '</div>'+
                                                '</div>'+
                                                '<div class="float-right insert">'+
                                                   '<button class="btn btn-tag-copy" data-clipboard-target=".copy-tags" style="cursor: pointer;padding: 5px 20px;color: #241c15;background-color: #fff;">Copy</button>'+
                                                '</div>'+
                                            '</li>');

                    // bee pro tags                    
                    $('.tags-container').append(`
                        <div class="tag-item ml-2 mb-2" title="`+tag.tag+`">
                            <span class="tag-icon">
                                <i style="height: 23px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" width="1em" height="1em" style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);" preserveAspectRatio="xMidYMid meet" viewBox="0 0 16 16"><g fill="#626262"><path fill-rule="evenodd" d="M5 2a.5.5 0 0 1 .5-.5c.862 0 1.573.287 2.06.566c.174.099.321.198.44.286c.119-.088.266-.187.44-.286A4.165 4.165 0 0 1 10.5 1.5a.5.5 0 0 1 0 1c-.638 0-1.177.213-1.564.434a3.49 3.49 0 0 0-.436.294V7.5H9a.5.5 0 0 1 0 1h-.5v4.272c.1.08.248.187.436.294c.387.221.926.434 1.564.434a.5.5 0 0 1 0 1a4.165 4.165 0 0 1-2.06-.566A4.561 4.561 0 0 1 8 13.65a4.561 4.561 0 0 1-.44.285a4.165 4.165 0 0 1-2.06.566a.5.5 0 0 1 0-1c.638 0 1.177-.213 1.564-.434c.188-.107.335-.214.436-.294V8.5H7a.5.5 0 0 1 0-1h.5V3.228a3.49 3.49 0 0 0-.436-.294A3.166 3.166 0 0 0 5.5 2.5A.5.5 0 0 1 5 2zm3.352 1.355zm-.704 9.29z"/><path d="M10 5h4a1 1 0 0 1 1 1v4a1 1 0 0 1-1 1h-4v1h4a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-4v1zM6 5V4H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h4v-1H2a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h4z"/></g></svg>
                                </i>
                            </span>
                            <span class="tag-title">
                                <input value="`+ tag.tag +`" type="text" style=""/>
                            </span>
                        </div>
                    `);
                }
            });
        }
    },

    listTemplate: function() {
        var thisEditor = this;

        if (typeof(thisEditor.templates) !== 'undefined') {
            thisEditor.templates.forEach(function(template) {
                $('.show-list-template ul.display-template').append('<li class="hover-name-template" data-thumbnail="'+ template.thumbnail +'" template-url="' + template.url +'">'+
                                                                '<a class="template-change" href="#"> '+ template.name +' </a>'+
                                                            '</li>');

                $('ul.list-new-template').append('<li class="c-templateSelection_item c-choiceCard c-choiceCard--thick pb-4">'+
                                                    '<div class="c-choiceCard_innerContainer">'+
                                                        '<a aria-label="button" title="'+ getI18n('selected_template') +'" style="background-position: center;background-size: 151px;background-repeat: no-repeat;background-image: url('+ template.thumbnail +');" href="'+ template.url +'" class="newTemplate new-from-template-select c-choiceCard_label overflow--visible background-size--cover background-position--center-top border-gray border-radius--lv1 v-aspectRatio--square margin-bottom--lv1"></a>'+
                                                        '<p title="'+ template.name +'" class="text-align--center margin-bottom--lv0 font-weight--bold ">'+ template.name +'</p>'+
                                                        
                                                    '</div>'+
                                                '</li>');

                // bee pro
                $('.templates-container').append('<li class="c-templateSelection_item c-choiceCard c-choiceCard--thick pb-4">'+
                    '<div class="c-choiceCard_innerContainer">'+
                        '<a aria-label="button" title="'+ getI18n('selected_template') +'" style="background-position: center;background-size: 151px;background-repeat: no-repeat;background-image: url('+ template.thumbnail +');" href="'+ template.url +'" class="newTemplate new-from-template-select c-choiceCard_label overflow--visible background-size--cover background-position--center-top border-gray border-radius--lv1 v-aspectRatio--square margin-bottom--lv1"></a>'+
                        '<p title="'+ template.name +'" class="text-align--center margin-bottom--lv0 font-weight--bold ">'+ template.name +'</p>'+
                          
                    '</div>'+
                '</li>');
            });
        }
    },

    listHistory: function() {
        var thisEditor = this;
        $('ul#undo-redo__history').html('');
        if (typeof(thisEditor.historyRecords) !== 'undefined') {
            for (var i = 0; i < thisEditor.historyRecords.length; i++) {
                var list = thisEditor.historyRecords[i];
                var current_class = 'history_item_current';

                if (i != thisEditor.currentRecordAchor) {
                    current_class = '';
                }

                $('ul#undo-redo__history').prepend('<li data-achor="'+i+'" class="history_add '+current_class+' history__step ng-scope history__step--active">'+
                    '<div class="step__icon ng-binding" ng-bind-html="::icon(event.icon)">'+
                        '<i id="text" class="'+ list.icon +'" style="font-size:28px;display:inline-block"></i>'+
                    '</div>'+
                    '<div class="step__body">'+
                        '<div class="step__title ng-binding">'+ list.title +'</div>'+
                        '<div class="step__time ng-binding">'+ list.time +'</div>'+
                    '</div>'+
                '</li>');


                // new hidtory bee pro
                $('.history-container').html('');
                $('.history-container').prepend('<div data-achor="'+i+'" class="history_add history-item '+current_class+' history__step ng-scope history__step--active">'+
                    '<div class="history-icon ng-binding" ng-bind-html="::icon(event.icon)">'+
                        '<i id="text" class="'+ list.icon +'" style="font-size:28px;display:inline-block"></i>'+
                    '</div>'+
                    '<div class="history-body">'+
                        '<div class="step__title ng-binding">'+ list.title +'</div>'+
                        '<div class="step__time time ng-binding">'+ list.time +'</div>'+
                    '</div>'+
                '</div>');
            }
        }
    },

    setLogo: function() {
        // logo
        if (typeof(this.logo) !== 'undefined') {
            $('.logo .logo-img').attr('src', this.logo);
        }        
    },

    init: function() {
        var thisEditor = this;

        // load required js
        thisEditor.loadPageJs([thisEditor.root+'language/all.js'], function() {
            // set language
            thisEditor.setLanguage();

            // load editor
            thisEditor.run();
        });
    },

    setLanguage: function() {
        var thisEditor = this;

        thisEditor.I18n = LANGUAGE[this.language];

        // merge custom language
        if (thisEditor.lang) {
            thisEditor.I18n = $.extend(thisEditor.I18n, thisEditor.lang);
        }

        window.getI18n = function (phrase) {
            if (typeof(thisEditor.I18n[phrase]) !== 'undefined') {
                return thisEditor.I18n[phrase];
            } else {
                return phrase;
            }
        };
    },

    run: function () {
        var thisEditor = this;

        // prepair HTML
        thisEditor.prepairHtml(thisEditor.theme);

        // prepair body html
        thisEditor.build();

        // init vars
        thisEditor.iframe = $('#builder_iframe');
        thisEditor.content = this.iframe.contents().find('body');
        thisEditor.window = this.iframe.contents().find("html");
        thisEditor.selected = null;
        
        // 
        thisEditor.initIframe();

        // load tags buttons
        thisEditor.loadTags();

        // load event listensers
        thisEditor.loadEvents();

        // check if change template enu available
        thisEditor.toogleChooseTemplateMenu();

        // list template
        thisEditor.listTemplate();

        // set logo
        thisEditor.setLogo();
        
        // set backgrounds
        thisEditor.setBackgrounds();

        // load tinymce
        thisEditor.loadPageJs([thisEditor.root+'iframe/tinymce/tinymce.min.js']);

        // strict layout fix
        thisEditor.checkStrict();        

        // check export button
        if (thisEditor.export == null) {
            $('.export-button').remove();
        }

        // iframe no makeup
        if(thisEditor.frameBoxStyle && thisEditor.frameBoxStyle == 'none') {
            thisEditor.iframe.addClass('no_style');
        }

        // hide help button
        if (!thisEditor.showHelp) {
            $('li.ask-help').remove();
        }

        // disable features
        thisEditor.checkDisableFeatures();

        // file manager
        if (!thisEditor.filemanager) {
            $('.filemanager-item').remove();
        }
    },

    checkDisableFeatures: function() {
        var thisEditor = this;
        
        if (thisEditor.disableFeatures == null) {
            return;
        }
        // disable change template
        if (thisEditor.disableFeatures.includes('change_template')) {
            $('.choose-template-menu').hide();
        }

        // disable export
        if (thisEditor.disableFeatures.includes('export')) {
            $('.export-button').hide();
        }

        // disable save & close
        if (thisEditor.disableFeatures.includes('save_close')) {
            $('.btn-save-and-close').remove();
        }

        // disable footer exit
        if (thisEditor.disableFeatures.includes('footer_exit')) {
            $('.footer-exit-without-save').remove();
        }

        // disable help
        if (thisEditor.disableFeatures.includes('help')) {
            $('.ask-help').remove();
        }
    },

    checkStrict: function() {
        var thisEditor = this;

        if(!thisEditor.strict) {
            $('#nav-profile-tab').remove();            
            $('.design .design-new').parent().hide();
            $('.design .design-clear').parent().hide();
            if (!thisEditor.strict) {
                $('#nav-layouts-tab').show();
            } else {
                $('.content-right nav #nav-tab a').css('width', '50%');
            }
        }

        // close
        $('.build-mode-warning-close').on('click', function() {
            $('body').removeClass('build-mode-disabled');
            $('.build-mode-warning').remove();
        });
    },

    setBackgrounds: function() {
        if(typeof(this.backgrounds) != 'undefined') {
            this.backgrounds.forEach(function(url) {
                $('.builder-backgrounds').append(`
                    <li class="device-bg bg-default">
                        <img alt="image" class="bg-image" src="`+url+`" />
                    </li>
                `);
            });
        }
    },

    //fix loi
    select: function(element) {
        if (!element.equals(this.selected)) {
            this.unselect();

            this.selected = element;
            this.selected.select();

            // editor
            this.inlineEdit($("#builder_iframe")[0].contentWindow.$(element.obj[0]));
        }

        // js auto height iframe
        this.adjustIframeSize();

        // is warpper
        if (element.isWrapper()) {
            $('#nav-profile-tab').addClass('active');
        }
    },

    unselect: function() {
        if (this.selected != null) {
            this.selected.unhighlight();
            this.selected.unselect();

            // editor
            this.removeInlineEdit(this.selected.obj);
        }
        this.selected = null;

        // js auto height iframe
        this.adjustIframeSize();

        // is warpper
        $('#nav-profile-tab').removeClass('active');
    },

    duplicate: function() {
        var thisEditor = this;

        // bee pro
        if (!thisEditor.selected) {
            beeAlert('Duplicate', 'Please choose a field from your form design first!');
            return;
        }

        var obj = this.selected.obj;
        this.unselect();
        var html = obj.clone();

        var new_item = $(html);

        obj.after(new_item);
        new_item.css('display', 'none');
        new_item.fadeIn(200, function() {
            // select new element
            var element = thisEditor.elementFactory(new_item);
            if (element !== null) {
                thisEditor.select(element);
                thisEditor.handleSelect();
            }

            // save history
            thisEditor.recordState(element.name() + getI18n('duplicated_element'), element.icon());

            // js auto height iframe
            thisEditor.adjustIframeSize();

            // notify
            thisEditor.notificationArea(getI18n('duplicate'));
        });
    },

    remove: function() {
        var thisEditor = this;
        // bee pro
        if (!thisEditor.selected) {
            beeAlert('Remove', 'Please choose a field from your form design first!');
            return;
        }
        var obj = this.selected.obj;
        var removed = this.selected;
        this.unselect();

        obj.fadeOut(200,function(){
            // find empty parent element
            var parents = obj.parents('[builder-element]');

            obj.remove();

            // check parent if empty then remove
            if (parents.length &&
                !parents.first().find('[builder-element]').length &&
                !parents.first().is("[builder-element='PageElement']") &&
                !parents.first().is("[builder-element='CellElement']")
            ) {
                    parents.first().remove();
            }

            // save history
            thisEditor.recordState(removed.name() + getI18n('deleted_element'), removed.icon());

            // js auto height iframe
            thisEditor.adjustIframeSize();

            // check empty
            thisEditor.checkEmpty();

            // notify
            thisEditor.notificationArea(getI18n('remove'));
        });

        // hide controls
        this.hideControls();
    },

    hideOnDesktop: function() {
        var obj = this.selected.obj;
        obj.addClass('Hide-on-desktop');
        obj.removeClass('Hide-on-mobile');
        $('.icon-remove-two-screen').removeClass('hide');
    },

    hideOnMobile: function() {
        var obj = this.selected.obj;
        obj.addClass('Hide-on-mobile');
        obj.removeClass('Hide-on-desktop');
        $('.icon-remove-two-screen').removeClass('hide');
    },

    removeHideOnTowScreen: function() {
        var obj = this.selected.obj;
        obj.removeClass('Hide-on-mobile');
        obj.removeClass('Hide-on-desktop');
        $('.icon-remove-two-screen').addClass('hide');
        $('.hide-all.desktop').removeClass('change-bgcolor');
        $('.hide-all.mobile').removeClass('change-bgcolor');
    },

    getElementByTagName: function(obj) {
        var tagName = obj.prop('tagName').toLowerCase();
        var element = null;

        // get element by class name (bootstrap)
        if (obj.hasClass('btn')) {
            element = new ButtonElement(obj);
        }
       
        switch(tagName) {
            case 'p':
                element = new PElement(obj);
                break;
            case 'a':
                element = new AElement(obj);
                break;
            case 'img':
                element = new ImgElement(obj);
                break;
            case 'video':
                element = new VideoElement(obj);
                break;
            case 'h1':
            case 'h2':
            case 'h3':
            case 'h4':
            case 'h5':
            case 'h6':
                element = new HeadingElement(obj);
                break;
            case 'span':
                element = new SpanElement(obj);
                break;
            case 'button':
                element = new ButtonElement(obj);
                break;
            case 'select':
                element = new DropdownElement(obj);
                break;
            case 'td':
            case 'label':
                element = new TextElement(obj);
                break;
            case 'input':
                if (obj.attr('type') == 'checkbox') {
                    element = new CheckboxElement(obj);
                } else if (obj.attr('type') == 'text') {
                    element = new TextFieldElement(obj);
                } else if (obj.attr('type') == 'email') {
                    element = new EmailFieldElement(obj);
                } else {
                    element = new TextElement(obj);
                }
                break;
            default:
                element = new OtherElement(obj);
        }

        return element;
    },

    elementFactory: function(obj) {
        var element = null;

        // check if obj is null
        if (typeof(obj) == 'undefined') {
            return null;
        }

        // STRICT MODE
        if (this.strict) {
            // if obj is OR is inside element
            if (obj.closest('[builder-element]').length) {
                obj = obj.closest('[builder-element]');
            } else {
                return null;
            }

            // Get element by builder-element value
            if (typeof(obj.attr('builder-element')) != 'undefined' && obj.attr('builder-element') != '') {
                element = eval('new ' + obj.attr('builder-element') + '(obj)');
            }

            // OR get element by tag name
            else {
                element = this.getElementByTagName(obj);
            }

            return element;

        // NOT STRICT MODE
        } else {
            // check if inside helper
            if (this.isHelperTarget(obj)) {
                return null;
            }
            
            // check if is not element
            if (this.isNotElement(obj)) {
                return null;
            }

            return this.getElementByTagName(obj);
        }

        
    },

    handleSelect: function() {
        var thisEditor = this;
        
        setTimeout(function() {
            thisEditor.loadControls();
        }, 100);
    },

    loadControls: function() {
        var thisEditor = this;
        var element_bar = $('#builder_sidebar').find('.detail-content');

        // if no selected
        if (this.selected == null) {
            return;
        }

        // top delete button toggle
        if (!this.selected.canDelete()) {
            $('.builder-remove-selected-button').hide();
        } else {
            $('.builder-remove-selected-button').show();
        }

        // top duplicate button toggle
        if (!this.selected.canDuplicate()) {
            $('.builder-duplicate-selected-button').hide();
        } else {
            $('.builder-duplicate-selected-button').show();
        }

        // Get controls from selected
        var controls = this.selected.getControls();

        // Get controls from container
        var containerControls = [];
        if (this.selected.getContainer() != null) {
            containerControls = this.selected.getContainer().getControls();
        }

        // Get controls from cell container
        var cellControls = [];
        if (this.selected.getCellContainer() != null) {
            cellControls = this.selected.getCellContainer().getControls();
        }

        // return if has no controls
        if (controls.length == 0) {
            return;
        }

        // Load element controls bar
        $('#builder_sidebar').find('.tab-content').addClass('hide-scroll-bar');
        thisEditor.showControls();

        // insert controls to sidebar
        $('.attributes-container').html('');

        // Selected controls
        controls.forEach(function(control) {
            var group = $('.attributes[group-id="'+control.groupId()+'"]');

            // create group controls html container if not exists
            if (!group.length) {
                $('.attributes-container').append(thisEditor.transformHtml(`<div class="attributes-group mb-1">
                    <div class="attribute-header">
                        <label>{language.`+control.groupId()+`}</label>
                        <span class="toggle-caret-icon ag-toogle-button open">
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" width="0.3em" height="1em" style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);" preserveAspectRatio="xMidYMid meet" viewBox="0 0 210 700"><path d="M23 44q10 0 16 6l163 162q7 8 7 17t-7 16L39 407q-7 7-16 7t-16-7t-7-16t7-16l146-146L7 83q-7-7-7-17t6.5-16T23 44z" fill="#626262"/></svg>
                            </i>
                        </span>
                    </div>
                    <div class="attributes" group-id="`+control.groupId()+`">
                    </div>
                </div>`));

                group = $('.attributes[group-id="'+control.groupId()+'"]');
            }

            group.append('<div>' + thisEditor.transformHtml(control.renderHtml()) + '</div>');
            
            // after render control
            if (typeof(control.afterRender) != 'undefined') {
                control.afterRender();
            }
        });

        // Cell container controls
        if (cellControls.length) {
            $('.attributes-container').append(thisEditor.transformHtml(`<div class="cell-container-controls"><h3 class="title-bar">{language.cell_options}</h3></div>`));
            cellControls.forEach(function(control) {
                var group = $('.attributes[group-id="cell-container-'+control.groupId()+'"]');

                // create group controls html container if not exists
                if (!group.length) {
                    $('.attributes-container .cell-container-controls').append(thisEditor.transformHtml(`<div class="attributes-group mb-1">
                        <div class="attribute-header">
                            <label>{language.`+control.groupId()+`}</label>
                            <span class="toggle-caret-icon ag-toogle-button open">
                                <i>
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" width="0.3em" height="1em" style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);" preserveAspectRatio="xMidYMid meet" viewBox="0 0 210 700"><path d="M23 44q10 0 16 6l163 162q7 8 7 17t-7 16L39 407q-7 7-16 7t-16-7t-7-16t7-16l146-146L7 83q-7-7-7-17t6.5-16T23 44z" fill="#626262"/></svg>
                                </i>
                            </span>
                        </div>
                        <div class="attributes" group-id="cell-container-`+control.groupId()+`">
                        </div>
                    </div>`));
                    
                    group = $('.attributes[group-id="cell-container-'+control.groupId()+'"]');
                }

                group.append('<div>' + thisEditor.transformHtml(control.renderHtml()) + '</div>');
                
                // after render control
                if (typeof(control.afterRender) != 'undefined') {
                    control.afterRender();
                }
            });
        }

        // Container controls
        if (containerControls.length) {
            $('.attributes-container').append(thisEditor.transformHtml(`<div class="container-controls"><h3 class="title-bar">{language.container_options}</h3></div>`));
            containerControls.forEach(function(control) {
                var group = $('.attributes[group-id="container-'+control.groupId()+'"]');

                // create group controls html container if not exists
                if (!group.length) {
                    $('.attributes-container .container-controls').append(thisEditor.transformHtml(`<div class="attributes-group mb-1">
                        <div class="attribute-header">
                            <label>{language.`+control.groupId()+`}</label>
                            <span class="toggle-caret-icon ag-toogle-button open">
                                <i>
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" width="0.3em" height="1em" style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);" preserveAspectRatio="xMidYMid meet" viewBox="0 0 210 700"><path d="M23 44q10 0 16 6l163 162q7 8 7 17t-7 16L39 407q-7 7-16 7t-16-7t-7-16t7-16l146-146L7 83q-7-7-7-17t6.5-16T23 44z" fill="#626262"/></svg>
                                </i>
                            </span>
                        </div>
                        <div class="attributes" group-id="container-`+control.groupId()+`">
                        </div>
                    </div>`));
                    
                    group = $('.attributes[group-id="container-'+control.groupId()+'"]');
                }

                group.append('<div>' + thisEditor.transformHtml(control.renderHtml()) + '</div>');
                
                // after render control
                if (typeof(control.afterRender) != 'undefined') {
                    control.afterRender();
                }
            });
        }

        // hide empty group
        $('.attributes[group-id]').each(function() {
            if ($(this).children().length) {
                $(this).closest('.attributes-group').show();
            } else {
                $(this).closest('.attributes-group').hide();
            }
        });

        // show element name in header
        $('.element-attributes .element-name').html(thisEditor.selected.name());

        // go to third page
        goToThirdPage();
    },

    hideControls: function() {
        var thisEditor = this;

        // Load element controls bar
        var element_bar = $('#builder_sidebar').find('.detail-content');
        element_bar.removeClass('dilen');
        // element_bar.find('.properties-pannel-content').html('');
        $('#builder_sidebar').find('.tab-content').removeClass('hide-scroll-bar');

        $('#nav-home-tab').addClass('active');

        // beepro go back
        goToMainPage();
    }
};

export {
  createElementFromHTML,
  makeid,
  Editor,
  simulateClick
};
