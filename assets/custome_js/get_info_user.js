
function get_user_info(route_, token_) {
    // $('.content').css('webkit-filter', 'blur(50px)');
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
                set_user_and_cours_info_into_modal(data.user_info,data.cours_details,data.cours_fee,data.total_cours_fee)

        }, error: function reject() {

        }
    })
}

function set_user_and_cours_info_into_modal(user_info,cours_details,cours_fee,total_cours_fee) {

   


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
     

    $('#total_cours_fee').text(total_cours_fee);
    
    $('#cours_fee').text();
  
  
  
    var html = '<div class="text-center" id="user_info">';
    html += 'hello user' + ' - #';

    // for (let i = 0; i < data.length; i++) {
    //     html += '<a href="'+route_+'" class="text-white hover-warning text-center align-center"><span class="text-center align-center">';
    //     html += data[i]['cours_id'] + '#'+ data[i]['user_id'] + '#';
    //     html += data[i]['cours']['grade']['grade'] + ' - ';
    //     html += data[i]['cours']['level']['level'];
    //     html += '[cours_fee_total ' + data[i]['cours_fee_total'] + ' -' + data[i]['remaining'] + ' -     remainig ]';
    //     html += '</span></a><br><br>';
    // }
    html += '</div>';
    $('.content').css('webkit-filter', 'blur()');
    $('#user_info').replaceWith(html).html;



}
