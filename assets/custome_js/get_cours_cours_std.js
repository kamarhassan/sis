
function get_cours_of_std(id, route_, token_) {
    $('.content').css('webkit-filter', 'blur(50px)');
    $.ajax({
        type: 'POST',
        url: route_,
        data: {
            '_token': token_,
            // 'id': id,
        },
        success: function (data) {
            console.table(data)

        }, error: function reject() { }
    })
}


// table.search('Tokyo').row({search: 'applied'}).data()
$(document).on('keydown', "#example1_filter" , function (e) {
    // console.log($('#example1').DataTable().rows({selected:true}).data());
    // console.log($('#example1').DataTable().row({search: 'applied'}).data());
    console.log($('#example1').DataTable().row({search: 'applied'}).count());
    // console.log("tr count "+$("#example1 tr").length);
    // var rowCount = $("#example1 tr").length;
})
