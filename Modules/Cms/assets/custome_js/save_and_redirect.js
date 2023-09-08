function set_image_to_preview(input,prev_id, block_id_contaner =null) {

   $('#'+block_id_contaner).attr("hidden", false);
   // $('#' + prev_id).attr("hidden", false);

   if (input.files && input.files[0]) {
      var reader = new FileReader();

      $('#' + prev_id).attr("hidden", false);
      reader.onload = function (e) {
         $('#' + prev_id)
            .attr('src', e.target.result)
            .width(150)
            .height(150);
      };
 
      reader.readAsDataURL(input.files[0]);
   }

}

function previewMultipleImage(event, file_id,all_img_callery_id_to_previo) {
   $('#'+all_img_callery_id_to_previo).replaceWith('<div class="row col-md-12" id="'+all_img_callery_id_to_previo+'">');

   var saida = document.getElementById(file_id);
   var quantos = saida.files.length;
   var i = 0;
   for (; i < quantos; i++) {
       var urls = URL.createObjectURL(event.target.files[i]);

       html = '<div id="callery_' + i + '_" class="img_cont">';
       html += '<img id="calery_' + i + '" src="' + urls + '" alt="your image" width="150px" height="150px" />';
       html += '<a onclick="reset(\'event\',' + i + ','+file_id+')" class="btn_remove"><i class="fa fa-close"></i></a>';
       html += '</div>';
       document.getElementById(all_img_callery_id_to_previo).innerHTML += html;
       html = "";
   }
}



function resetInput(input, block_id_contaner) {
   // console.log(prev_id);
   $('#' + input).val(null);
   //  document.getElementById("'"+input+"'").value = '';
   $('#' + block_id_contaner).attr("hidden", true);
}



function reset(event, img_id, input_file_id) {
    
   // $('#for_callery').prop("hidden",true);
   // $('#spinner_loading').prop("hidden",false);

   //  var saida = document.getElementById(input_file_id);
   //  var quantos = saida.files.length;
  
   //  const new_file = new Array();
   //  for (i = 0; i < quantos; i++) {
   //      if (i == img_id){

   //          new_file.push(saida.files[i]);
   //      }
   //  }
    
    
   //  saida.files = new FileListItems(new_file);
    
    $('#callery_' + img_id + '_').remove();  
 
   //  $('#for_callery').prop("hidden",false);
   // $('#spinner_loading').prop("hidden",true);
}






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
         console.log(data)
         spinner_hide();

         reloadWithData(data, 'menuList');
         // toastr.success(data)

         // window.location.href = data.route;

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


function reloadWithData(response, id_template) {
   $('#' + id_template).empty();
   $('#' + id_template).html(response);

}


function submit_rediret(route_, form_id) {
   // var formdata = $("#" + form_id).serializeArray();
   var formdata = new FormData($("#" + form_id)[0]);

   // console.log(formdata);
   spinner_show()
   $('#editModal').hide();
   $('#modal-center').hide();
   $.ajax({
      enctype: 'multipart/form-data',
      type: 'POST',
      url: route_,
      data: formdata,
      processData: false,
      contentType: false,
      cache: false,
      success: function (data) {

         console.log(data)

         if (data.status == 'success') {
            spinner_hide();


            toaster(data.message, data.status)


            window.location.href = data.route;
         } else {
            if (data.status == 'error') {
               toaster(data.message, data.status)
               $('#editModal').show();
               $('#modal-center').show();
               // toastr.error(data.message);
            }
         }
      }, error: function reject(reject) {
         spinner_hide();
         var response = $.parseJSON(reject.responseText);
         $('#editModal').show();
         $('#modal-center').show();
         $.each(response.errors, function (key, val) {

            let t = key.replace('.', '_');
            console.log(t + '_');
            $('#' + t + '_').text(val[0]).html;
         })
      }
   });
}


function submit_copyright(route_, form_id) {


   var formdata = new FormData($("#" + form_id)[0]);
   tinyMCE.triggerSave();


   var setting_value = tinyMCE.get("setting_value").getContent();
   formdata.append('setting_value', setting_value);


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

function toaster(message, type) {
   $.toast({
      // heading: 'Welcome to my Sunny Admin',
      text: message,
      position: 'top-right',
      loaderBg: '#ff6849',
      icon: type,
      hideAfter: 5000,
      stack: 6
   });
}




function submit_blogs(route_, form_id) {


   var formdata = new FormData($("#" + form_id)[0]);
   tinyMCE.triggerSave();


   var description = tinyMCE.get("description").getContent();
   formdata.append('description', description);


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



function reply_comment(route_,form_id) {
    
   var formdata = $("#"+form_id).serializeArray();
   //  console.log(formdata);
   $('.modal_tohide').hide();
   $.ajax({
       type: 'POST',
       url: route_,
       data: formdata,
       success: function (data) {
           if (data.status == 'success') {
               toastr.success(data.message) 
               window.location.href = data.route;

           } else {
               if (data.status == 'error') {
                   toastr.error(data.message);
                   window.location.href = data.route;
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




