//Function to convert hex format to a rgb color
function rgb2hex(rgb){
 rgb = rgb.match(/^rgba?[\s+]?\([\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?/i);
 return (rgb && rgb.length === 4) ? "#" +
  ("0" + parseInt(rgb[1],10).toString(16)).slice(-2) +
  ("0" + parseInt(rgb[2],10).toString(16)).slice(-2) +
  ("0" + parseInt(rgb[3],10).toString(16)).slice(-2) : '';
}

//js action by modal change video builder
function removeModalGetLinkVideo() {
    $('.container-content').remove();
    //$('.dijitDialogUnderlayWrapper').remove();
}

function modal_display() {
    $('.dijitDialogShow.dijitDialog').remove();
    $('.dijitDialogUnderlayWrapper').remove();
}

function htmlLoader() {
    var khoi =  '<div class="sk-fading-circle">'+
                '<div class="sk-circle1 sk-circle"></div>'+
                '<div class="sk-circle2 sk-circle"></div>'+
                '<div class="sk-circle3 sk-circle"></div>'+
                '<div class="sk-circle4 sk-circle"></div>'+
                '<div class="sk-circle5 sk-circle"></div>'+
                '<div class="sk-circle6 sk-circle"></div>'+
                '<div class="sk-circle7 sk-circle"></div>'+
                '<div class="sk-circle8 sk-circle"></div>'+
                '<div class="sk-circle9 sk-circle"></div>'+
                '<div class="sk-circle10 sk-circle"></div>'+
                '<div class="sk-circle11 sk-circle"></div>'+
                '<div class="sk-circle12 sk-circle"></div>'+
          '</div>';
    return khoi;
}

export {
   rgb2hex,
   removeModalGetLinkVideo,
   modal_display,
   htmlLoader
};