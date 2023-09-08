function changemodetheme(route_, token_) {

   $.ajax({
      type: 'GET',
      url: route_,
      '_token': token_,
      success: function (data) {
         console.log(data)
         ChangeModeThemeIcon(mode)
         changetheme()

      }, error: function reject() {

      }
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
      var new_color = color_theme.replace("dark-skin", "light-skin");
      $("#body_master").attr('class', new_color);

      // $("#icon_theme").toggleClass("wi-moon-waxing-crescent-2");

   }
   else {
      var new_color = color_theme.replace("light-skin", "dark-skin");
      $("#body_master").attr('class', new_color);
      replaceClass("body_master", 'light-skin', 'dark-skin');

      // $("#icon_theme").toggleClass("icon-circle-arrow-up icon-circle-arrow-down");
   }
}



function ChangeModeThemeIcon(mode) {
   mode == 'dark-skin' ? $("#icon_theme").removeClass("wi wi-moon-1").addClass("wi wi-day-sunny")
      : $("#icon_theme").removeClass("wi wi-day-sunny").addClass("wi wi-moon-1");
}