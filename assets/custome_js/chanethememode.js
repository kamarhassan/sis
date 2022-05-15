function changemodetheme(route_, token_) {

    $.ajax({
        type: 'GET',
        url: route_,
        '_token': token_,
        success: function (data) {
            location.reload();

        }, error: function reject() { }
    })
    // changetheme();
    // $.ajax({
    //     type: 'post',
    //     url: "{{route('admin.dashborad.changemode')}}",
    //     // data: 'somevar=' + somevar,
    //     // dataType: 'json',
    //     success: function (data) {
    //         $.each(data, function (index, item) {
    //             alert(item.dogname);
    //             // loop and do whatever with data
    //         });
    //     },
    //     error: function (err) {
    //         alert(err);
    //     }
    // });

}



function replaceClass(id, oldClass, newClass) {
    var elem = $(`#${id}`);
    if (elem.hasClass(oldClass)) {
        elem.remove(oldClass, newClass);
    }
    elem.addClass(newClass);
}



function changetheme() {
    // alert("asdsdadsa");
    var color_theme = $("#body_master").attr('class');
    if (color_theme.indexOf("dark") >= 0) {

        var new_color = color_theme.replace("dark", "light");
        $("#body_master").attr('class', new_color);

    }
    else {
        var new_color = color_theme.replace("light", "dark");
        $("#body_master").attr('class', new_color);
        replaceClass("body_master", 'light', 'dark');
    }
}
