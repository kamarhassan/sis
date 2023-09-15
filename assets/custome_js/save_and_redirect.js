function submit(route_, form_id) {
   // var formdata = $("#" + form_id).serializeArray();
   var formdata = new FormData($("#" + form_id)[0]);

   // console.log(formdata);
   spinner_show()
   $.ajax({
      enctype: 'multipart/form-data',
      type: 'POST',
      url: route_,
      data: formdata,
      processData: false,
      contentType: false,
      cache: false,
      success: function (data) {
         spinner_hide();
         if (data.status == 'success') {
            toaster(data.message, data.status)
            window.location.href = data.route;
         } else {
            if (data.status == 'error') {
               toaster(data.message, data.status)
            }
         }
      }, error: function reject(reject) {
         spinner_hide();
         var response = $.parseJSON(reject.responseText);
         $.each(response.errors, function (key, val) {

            let t = key.replace('.', '_');
            console.log(t + '_');
            $('#' + t + '_').text(val[0]).html;
         })
      }
   });
}

function submit_reload_data(route_, form_id, id_to_replace) {
   var formdata = new FormData($("#" + form_id)[0]);

   // console.log(formdata);
   spinner_show()
   $.ajax({
      enctype: 'multipart/form-data',
      type: 'POST',
      url: route_,
      data: formdata,
      processData: false,
      contentType: false,
      cache: false,
      success: function (data) {
         // console.log(data)
         spinner_hide();
         if (data.status == 'success') {
            // $.toast({data.message});           
            // window.location.href = data.route;
         } else {
            if (data.status == 'error') {
               toastr.error(data.message);
            }
         }
      }, error: function reject(reject) {
         spinner_hide();
         var response = $.parseJSON(reject.responseText);
         $.each(response.errors, function (key, val) {

            let t = key.replace('.', '_');
            console.log(t + '_');
            $('#' + t + '_').text(val[0]).html;
         })
      }
   });
}


function submit_categories(route_, form_id) {


   var formdata = new FormData($("#" + form_id)[0]);
   tinyMCE.triggerSave();


   var desc = tinyMCE.get("desc").getContent();
   if (desc != '<div>&nbsp;</div>')
      formdata.append('desc', desc);

   var details = tinyMCE.get("details").getContent();
   if (details != '<div>&nbsp;</div>')
      formdata.append('details', details);

   var prerequests = tinyMCE.get("prerequests").getContent();
   if (prerequests != '<div>&nbsp;</div>')
      formdata.append('prerequests', prerequests);

   var requireKnwoledge = tinyMCE.get("requireKnwoledge").getContent();
   if (requireKnwoledge != '<div>&nbsp;</div>')
      formdata.append('requireKnwoledge', requireKnwoledge);

   var target_students = tinyMCE.get("target_students").getContent();
   if (target_students != '<div>&nbsp;</div>')
      formdata.append('target_students', target_students);

   var short_desc = tinyMCE.get("short_desc").getContent();
   if (short_desc != '<div>&nbsp;</div>')
      formdata.append('short_desc', short_desc);

   spinner_show()
   $.ajax({
      enctype: 'multipart/form-data',
      type: 'POST',
      url: route_,
      data: formdata,
      processData: false,
      contentType: false,
      cache: false,
      success: function (data) {
         // console.log(data)
         spinner_hide();
         if (data.status == 'success') {
            $.toast({
               // heading: 'Welcome to my Sunny Admin',
               text: data.message,
               position: 'top-right',
               loaderBg: '#ff6849',
               icon: 'success',
               hideAfter: 5000,
               stack: 6
            });
            window.location.href = data.route;
         } else {
            if (data.status == 'error') {
               $.toast({
                  // heading: 'Welcome to my Sunny Admin',
                  text: data.message,
                  position: 'top-right',
                  loaderBg: '#ff6849',
                  icon: 'error',
                  hideAfter: 5000,
                  stack: 6
               });

            }
         }
      }, error: function reject(reject) {
         spinner_hide();
         var response = $.parseJSON(reject.responseText);
         $.each(response.errors, function (key, val) {
            let t = key.replace('.', '_');
            console.log(t + '_');
            $('#' + t + '_').text(val[0]).html;
         })
      }
   });
}


function SubmitHandsonTable(url, data_, token_, cours_id) {


   spinner_show()

   $.ajax({
      type: 'POST',
      url: url,
      headers: {
         'X-CSRF-TOKEN': token_
      },
      data: {
         '_token': token_,
         data: data_,
         cours_id: cours_id
      },

      success: function (data) {
         spinner_hide();
         // console.log(data)
         if (data.status == 'success') {
            $.toast({
               // heading: 'Welcome to my Sunny Admin',
               text: data.message,
               position: 'top-right',
               loaderBg: '#ff6849',
               icon: 'success',
               hideAfter: 5000,
               stack: 6
            });

         } else {
            if (data.status == 'error') {
               show_error(data.error_index);

               $.toast({
                  // heading: 'Welcome to my Sunny Admin',
                  text: data.message,
                  position: 'top-right',
                  loaderBg: '#ff6849',
                  icon: 'error',
                  hideAfter: 5000,
                  stack: 6
               });
            }
         }
      },
      error: function reject(reject) {
         spinner_hide();

         var response = $.parseJSON(reject.responseText);
         $.each(response.errors, function (key, val) {

            let t = key.replace('.', '_');
            console.log(t + '_');
            $('#' + t + '_').text(val[0]).html;
         })
      }
   });
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


function show_error(array_data_error) {
   var html = "";
   $("#erro_show").remove();
   html += '<div id="erro_show" >';
   array_data_error.forEach(element => {
      console.log(element)
      html += ' <label for="col">column : ' + element.col + '</label>  =>  <label for= "row"> line : ' + element.row + '</label ><br>';

   });
   html += '</div>';
   $("#error_marks").append(html).html();
}


function toaster(message, status) {
   $.toast({
      // heading: 'Welcome to my Sunny Admin',
      text: message,
      position: 'top-right',
      loaderBg: '#ff6849',
      icon: status,
      hideAfter: 5000,
      stack: 6
   });
}


function submit_certeficate(route_, form_id) {


   var formdata = new FormData($("#" + form_id)[0]);
   tinyMCE.triggerSave();


   var certeficate_template = tinyMCE.get("certeficate_template_editor").getContent();
   formdata.append('certeficate_template', certeficate_template);


   spinner_show()
   $.ajax({
      enctype: 'multipart/form-data',
      type: 'POST',
      url: route_,
      data: formdata,
      processData: false,
      contentType: false,
      cache: false,
      success: function (data) {
         // console.log(data)
         spinner_hide();
         if (data.status == 'success') {
            $.toast({
               // heading: 'Welcome to my Sunny Admin',
               text: data.message,
               position: 'top-right',
               loaderBg: '#ff6849',
               icon: 'success',
               hideAfter: 5000,
               stack: 6
            });
            window.location.href = data.route;
         } else {
            if (data.status == 'error') {
               $.toast({
                  // heading: 'Welcome to my Sunny Admin',
                  text: data.message,
                  position: 'top-right',
                  loaderBg: '#ff6849',
                  icon: 'error',
                  hideAfter: 5000,
                  stack: 6
               });
            }
         }
      }, error: function reject(reject) {
         spinner_hide();
         var response = $.parseJSON(reject.responseText);
         $.each(response.errors, function (key, val) {

            let t = key.replace('.', '_');
            console.log(t + '_');
            $('#' + t + '_').text(val[0]).html;
         })
      }
   });
}

function chnage_school_years(route_, form_id, array_of_msg) {
   var msg = JSON.parse(array_of_msg);
   var formdata = new FormData($("#" + form_id)[0]);
 
   Swal.fire({
       title: msg['title'] + "?",
       text: msg['text_of_confirmation_change'] + "?",
       icon: 'warning',
       showCancelButton: true,
       confirmButtonColor: '#3085d6',
       cancelButtonColor: '#d33',
       confirmButtonText: msg['confirmButtonTextof'] + "!",
       cancelButtonText: msg['cancelButton'],
   }).then((result) => {
       if (result.isConfirmed) {
         spinner_show();
           $.ajax({
            type: 'POST',
            url: route_,
            data: formdata,
            processData: false,
            contentType: false,
            cache: false,
               success: function(data) {
                  spinner_hide();
                  if (data.status == 'success') {
                     toaster(data.message, data.status)
                     window.location.href = data.route;
                  } else {
                     if (data.status == 'error') {
                        toaster(data.message, data.status)
                     }
                  }
               },
               error: function() { // Removed the "reject" function
                  spinner_hide();
                   Swal.fire(
                       msg['failed_delete'],
                       msg[7],
                       'error'
                   )
               }
           });
       }
   });
}



function getschoolyear(route_) {
   $.ajax({
       type: 'Get',
       url: route_,

       success: function(data) {

           if (data.status == 'success') {
               $('#start_date_edit').val(data.schoolyear['start'])
               $('#end_date_edit').val(data.schoolyear['end'])
               $('#schoolyearid').val(data.schoolyear['id'])
               $('#finally_school_year_edit').text(data.schoolyear['year'])

               $('#modal-center').modal('show');
           }


       },
       error: function reject(reject) {
           var response = $.parseJSON(reject.responseText);
           $.each(response.errors, function(key, val) {
               let t = key.replace('.0', '_' + id);
               $('#' + t + '__').text(val[0]).html;
           })
       }
   });



}

function setschoolyear(finally_school_year_id_label, start_date_id, end_date_id) {
   $('#' + finally_school_year_id_label).text($('#' + start_date_id).val().split('-')[0] + ' - ' + $('#' +
       end_date_id).val().split('-')[
       0]);
}