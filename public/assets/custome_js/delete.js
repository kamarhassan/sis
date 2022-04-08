
function delete_by_id(route_, id_, token_, array_of_msg,) {
    var msg = JSON.parse(array_of_msg);
    console.table(msg);
    Swal.fire({





//    showCloseButton: true,
        title: msg[0] + "?",
        text: msg[1] + "?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: msg[2] + "!",
        cancelButtonText: msg[3] ,
    }).then((result) => {
        if (result.isConfirmed) {

            var id_delet = id_;
            var token = token_;
            $.ajax({
                type: 'POST',
                url: route_,
                data: {
                    '_token': token,
                    'id': id_delet
                },
                success: function (data) {
                    if (data.status == 'success') {
                        toaster.success(data.message);
                    }
                    $('.Row' + id_delet).remove();

                }, error: function reject() { }
            });

            Swal.fire(
                msg[4],
                msg[5],
                'success'
            )
        }
    })
}





