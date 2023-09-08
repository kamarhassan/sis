// sau day la ham khoi tao (Constructor)
// duoc goi khi new PopUp
var PopUp = function(title = '', size = 'full', position = 'default') {
    
    $('#builderModal .modal-dialog').contents().find("*").removeClass (function (index, className) {
        return (className.match (/modal-size-[a-zA-Z0-9\_\-]+/g) || []).join(' ');
    });

    if (size == 'auto' && position == 'default') {
        $('#builderModal .modal-dialog').addClass('modal-size-default');
        $('#builderModal .modal-dialog').css('max-width', 'none');
        $('#builderModal').removeClass('content-width');
        $('.PopUpContent').css('height', 'auto');
        $('#builderModal .default-popup').show();
        $('#builderModal .right-popup').hide();
    } else if (size == 'xright' && position == 'right') {
        $('#builderModal .modal-dialog').addClass('modal-size-xright');
        $('#builderModal .modal-dialog').css('max-width', 'none');
        $('#builderModal').addClass('content-width');
        $('#builderModal .default-popup').hide();
        $('#builderModal .right-popup').show();
    } else if (size == 'small') {
        $('#builderModal .modal-dialog').addClass('modal-size-small');
        $('#builderModal .modal-dialog').css('max-width', '650px');
        $('.PopUpContent').css('height', 'auto');
        $('#builderModal .default-popup').show();
        $('#builderModal .right-popup').hide();
    } else {
        $('#builderModal .modal-dialog').addClass('modal-size-default');
        $('#builderModal .modal-dialog').css('max-width', 'none');
        $('#builderModal').removeClass('content-width');
        $('.PopUpContent').css('height', 481+'px');
        $('#builderModal .default-popup').show();
        $('#builderModal .right-popup').hide();
    }
    
    $('.PopUpCloseButton').click(function() {
        var popup = new PopUp('');
        popup.hide();
        $('span.des-upload').text('Drag your files here or click in this area.');
    });

    $('#popupTitle').html(title);
};

// gan them function cho popup
PopUp.prototype = {
    close: function() {
        $('#builderModal').hide();
    },
    show: function() {
        $('body').append('<div class="modal-backdrop show"></div>');
        $('#builderModal').addClass('show');
        $('#builderModal').show();
    },
    hide: function() {
        $('.modal-backdrop').remove();
        $('#builderModal').removeClass('show');
        $('#builderModal').hide();
    },
    load: function(url, callback = function() {} ) {
        var thisPopup = this;

        $.ajax({
            url: url,
            type: 'GET',
            data: {

            },
        }).done(function(resp) {
            thisPopup.remove();
            thisPopup.loadHtml(resp);
            callback();
        });
    },
    remove: function() {
        $('.PopUpContent').html();
    },
    loadHtml: function(html) {
        this.remove();
        $('.PopUpContent').html(html);
        this.show();
        //$('#builderModal').show();
    },
    loadHtmlXright: function() {
        this.remove();
        this.getContainer('xright');
        //$('#builderModal').addClass('show-right');
        //$('#builderModal').show();
    },
    getContainer: function(position = 'default') {
        if (position == 'xright') {
            return $('.right-box').html();
        } else {
            return;
        }
    }
};

export {
  PopUp
};