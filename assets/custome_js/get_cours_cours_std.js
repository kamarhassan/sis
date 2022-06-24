
function get_cours_of_std(id, route_, token_) {
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
            set_cours_info_into_modal(data,route_)

        }, error: function reject() { }
    })
}

function set_cours_info_into_modal(data,route_) {
    var html = '<div class="text-center" id="cours_details">';
    for (let i = 0; i < data.length; i++) {
        html += '<a href="'+route_.split('Students')[0]+'Students/Payment/'+data[i]['cours_id'] + '/'+ data[i]['user_id']+'" class="text-white hover-warning text-center align-center"><span class="text-center align-center">';
        html += data[i]['created_at'].split('T')[0] + ' - #';
        html += data[i]['cours_id'] + '#'+ data[i]['user_id'] + '#';
        html += data[i]['cours']['grade']['grade'] + ' - ';
        html += data[i]['cours']['level']['level'];
        html += '[cours_fee_total ' + data[i]['cours_fee_total'] + ' -' + data[i]['remaining'] + ' -     remainig ]';
        html += '</span></a><br><br>';
    }
    html += '</div>';
    $('.content').css('webkit-filter', 'blur()');
    $('#cours_details').replaceWith(html).html;



}

// table.search('Tokyo').row({search: 'applied'}).data()
$(document).on('keydown', "#example1_filter", function (e) {
    // console.log($('#example1').DataTable().rows({selected:true}).data());
    // console.log($('#example1').DataTable().row({search: 'applied'}).data());
    console.log($('#example1').DataTable().row({ search: 'applied' }).count());
    // console.log("tr count "+$("#example1 tr").length);
    // var rowCount = $("#example1 tr").length;
})



