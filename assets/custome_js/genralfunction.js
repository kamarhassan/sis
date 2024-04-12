function changemodetheme(route_, token_) {
   $.ajax({
      type: 'GET',
      url: route_,
      '_token': token_,
      success: function (data) {
         // console.log(data)
         ChangeModeThemeIcon(data.value)
         changetheme()

      }, error: function reject() {

      }
   })
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

   } else {
      var new_color = color_theme.replace("light-skin", "dark-skin");
      $("#body_master").attr('class', new_color);
      replaceClass("body_master", 'light-skin', 'dark-skin');

      // $("#icon_theme").toggleClass("icon-circle-arrow-up icon-circle-arrow-down");
   }
}


function ChangeModeThemeIcon(mode) {
   // console.log(mode)
   // mode == 'dark-skin' ? $('#icon_theme').removeClass("wi wi-moon-1").addClass("wi wi-day-sunny")
   //    : $("#icon_theme").removeClass("wi wi-day-sunny").addClass("wi wi-moon-1");
   var html = null;
   // replaceClass('icon_theme', 'wi wi-day-sunny', 'wi wi-moon-1')
   mode == 1 ? html = '<i id="icon_theme" class="wi wi-moon-1"> </i>' : html = '<i id="icon_theme" class="wi wi-day-sunny"> </i>'
   // mode == 1 ?replaceClass('icon_theme', 'wi wi-moon-1', 'wi wi-day-sunny') :replaceClass('icon_theme', 'wi wi-day-sunny', 'wi wi-moon-1')
   $('#icon_theme').replaceWith(html);

   // console.log(mode.indexOf('dark-skin'));

}



function changeyear(route_, form_id) {
   var formdata = $("#"+form_id).serializeArray();
    
   $.ajax({
      type: 'POST',
      url: route_,
      data: formdata,
      success: function (data) {
         if (data.status == 'success') {
            toastr.success(data.message)
            
            location.reload();
            
         } else {
            if (data.status == 'error') {
               toastr.error(data.message);
            }
         }
      }, error: function reject(reject) {
         var response = $.parseJSON(reject.responseText);
         $.each(response.errors, function (key, val) {
            let t = key.replace('.', '_');
            console.log(t);
            $('#' + t + '_').text(val[0]).html;
         })
      }
   });
}



function Set_Month_ToEndDate(start_date_input_id, end_date_input_id) {
   
   var date = new Date($('#' + start_date_input_id).val());
   // alert(addMonths(date, 12))
   $('#' + end_date_input_id).val(addMonths(date, 12));

}

function addMonths(start_date, months) {

   var newDate = moment(start_date, "YYYY-MM-DD").add(months, 'months').format("YYYY-MM-DD");
   return newDate
}



function spinner_show() {
   // $("#overlay").fadeIn(300);
   $("div.spanner").addClass("show");
   $("div.overlay").addClass("show");
}

function spinner_hide() {
   $("div.spanner").removeClass("show");
   $("div.overlay").removeClass("show");

}



function checkInternetConnection() {
   return $.ajax({
       url: 'https://www.google.com/favicon.ico', // Use any URL that you expect to be accessible when online
       type: 'GET',
       timeout: 5000 // Set a timeout to handle cases where the request takes too long
   });
}

function checkNetworkConnection() {
   const connection = navigator.connection || navigator.mozConnection || navigator.webkitConnection;
   if (connection && connection.type) {
       return connection.type !== "none"; // Connection type is not "none"
   } else {
       return false; // Cannot determine connection status
   }
}

function checkNetworkStatus() {
   const isConnectedToNetwork = checkNetworkConnection();
   if (isConnectedToNetwork) {
       checkInternetConnection()
           .done(function() {
               console.log("Connected to both network and internet.");
           })
           .fail(function() {
            toaster('You don\'t have Internet Connection 1', 'error')
           });
   } else {
      toaster('You don\'t have Internet Connection', 'error')
   }
}






function checkInternetConnectio() {
   // checkNetworkStatus()
    !navigator.onLine ? toaster('You don\'t have Internet Connection', 'error') : '';


}