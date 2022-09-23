
function get_user_info( route_, token_) {
    // $('.content').css('webkit-filter', 'blur(50px)');
    $.ajax({
        type: 'POST',
        url: route_,
        data: {
            '_token': token_,
            // 'id': id,
        },
        success: function (data) {
            console.table(data)
            set_cours_info_into_modal(data[0],data[1])

        }, error: function reject() {

        }
    })
}

function set_cours_info_into_modal(data,route_) {
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
