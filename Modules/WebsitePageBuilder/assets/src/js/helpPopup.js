// sau day la ham khoi tao (Constructor)
// duoc goi khi new PopUp
function helpPopUp() {
    
    $('.helpPopUpCloseButton').click(function() {
        $('.helpPopUp').hide();
    });
}

// gan them function cho popup
helpPopUp.prototype = {
    close: function() {
        $('.helpPopUp').hide();
    },
    load: function(url) {
        $('.helpPopUp').find('iframe#iframeLoad').attr('src', url);
        $('.helpPopUp').addClass('display-right');
        $('.helpPopUp .flex').removeClass('left-right--0');
        $('.helpPopUp').show();
        
        //if (size == "full") {
        //    //do something
        //    $('.helpPopUp').removeClass('display-right');
        //    $('.helpPopUp .flex').addClass('left-right--0');
        //} else {
        //    //do something
        //    $('.helpPopUp').addClass('display-right');
        //    $('.helpPopUp .flex').removeClass('left-right--0');
        //}
    },
    remove: function() {
        $('.helpPopUpContent').html();
    },
    loadHtml: function(html) {
        this.remove();
        $('.helpPopUpContent').html(html);
        this.show();
    }
};

export {
  helpPopUp
};
