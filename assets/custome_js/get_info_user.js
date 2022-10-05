
function get_user_info(route_, token_) {
    // $('.content').css('webkit-filter', 'blur(50px)'); 
    // $('#cours_fee').empty();
    $.ajax({
        type: 'POST',
        url: route_,
        data: {
            '_token': token_,
            // 'id': id,
        },

        success: function (data) {
            // console.table(data)
            if (data.status == 'success')
                set_user_and_cours_info_into_modal(data.user_info, data.cours_details, data.cours_fee, data.total_cours_fee, data.order_id)

        }, error: function reject() {

        }
    })
}

function set_user_and_cours_info_into_modal(user_info, cours_details, cours_fee, total_cours_fee, order_id) {



    $('#img_profile').text(user_info['img_profile']);
     
    $('#full_name').text(user_info['full_name']);
    $('#user_mail').text(user_info['user_mail']);
    $('#user_Phone').text(user_info['user_Phone']);

    $('#cours_grade_level').text(cours_details['']);
    $('#start_date').text(cours_details['start_date']);
    $('#end_date').text(cours_details['end_date']);
    $('#days').text(cours_details['days']);
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
