function replaceClass(id, oldClass, newClass) {
    var elem = $(`#${id}`);
    if (elem.hasClass(oldClass)) {
        elem.remove(oldClass,newClass);
    }
    elem.addClass(newClass);
}



function changetheme() {



    // alert("asdsdadsa");
    var color_theme = $("#body_master").attr('class');
    if (color_theme.indexOf("dark") >= 0){

       var   new_color = color_theme.replace( "dark", "light");
       $("#body_master").attr('class',new_color) ;

    }
    else{
        var   new_color = color_theme.replace( "light", "dark");
        $("#body_master").attr('class',new_color) ;
        replaceClass("body_master",'light','dark');
    }

    //    replaceClass("body_master", "light", "dark");
    // $("#darkmode").click(function () {
    //     replaceClass("container", "light", "dark");
    // });

    // $("#lightmode").click(function () {
    //     replaceClass("container", "dark", "light");
    // });
}
