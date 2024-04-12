
function get_notification_details(route_, token_,modal_id) {
   // $('.content').css('webkit-filter', 'blur(50px)'); 
   // $('#cours_fee').empty();

   checkInternetConnectio()
   spinner_show()
   $.ajax({
      type: 'POST',
      url: route_,
      data: {
         '_token': token_,
         // 'id': id,
      },

      success: function (data) {
         $('#'+modal_id).replaceWith(data);
         $('#'+modal_id).modal('show');
         // if (data.status == 'success')
         spinner_hide()
         //  set_user_and_cours_info_into_modal(data.user_info, data.cours_details, data.cours_fee, data.total_cours_fee, data.order_id,data.teach_type)

      }, error: function reject() {
         spinner_hide()
      }
   })
}

function set_user_and_cours_info_into_modal(user_info, cours_details, cours_fee, total_cours_fee, order_id, teach_type) {



   $('#img_profile').text(user_info['img_profile']);

   $('#full_name').text(user_info['full_name']);
   $('#user_mail').text(user_info['user_mail']);
   $('#user_Phone').text(user_info['user_Phone']);

   $('#cours_grade_level').text(cours_details['']);
   $('#start_date').text(cours_details['start_date']);
   $('#end_date').text(cours_details['end_date']);
   $('#days').text(cours_details['days']);
   $('#teach_type').text(teach_type);
   $('#teacher_name').text(cours_details['teacher_name']);
   $('#grade').text(cours_details['grade']['grade']);
   $('#level').text(cours_details['level']['level']);

   var html = "";
   for (let i = 0; i < cours_fee.length; i++) {
      html += cours_fee[i]['fee_type']['fee'] + " : " + cours_fee[i]['value'];
      html += '<br>';

   }
   // console.log(html);

   $('#cours_fee').html(html);

   $('#order_id').val(order_id);
   $('#user_id').val(user_info['id']);
   $('#cours_id').val(order_id);

   $('#total_cours_fee').text(total_cours_fee);

}



function userlist(input, route_) {
   // console.log(input.value);
   checkInternetConnectio()
   $.ajax({
      type: 'POST',
      url: route_,

      success: function (data) {
         console.table(data)
         if (data.status == 'success') {

         }
         // console.log(data      );

      },
      error: function reject() {

      }
   })
}