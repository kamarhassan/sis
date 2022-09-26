
function delete_notification_admin_selected(route_, form_id, token_, array_of_msg) {
    var msg = JSON.parse(array_of_msg);
    // console.table(msg);
    var formdata = $("#" + form_id).serializeArray();
    console.log(formdata.length)
    if (formdata.length > 1) {


        Swal.fire({
            //    showCloseButton: true,
            title: msg['title'] + "?",
            text: msg['text_of_delet'] + "?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: msg['confirmButtonTextof'] + "!",
            cancelButtonText: msg['cancelButton'],
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    type: 'POST',
                    url: route_,
                    data: formdata,
                    success: function (data) {
                        if (data.status == 'success') {
                            $('.Row' + id_delet).remove();
                            Swal.fire(
                                msg['deleted_msg'],
                                msg['succes_msj'],
                                'success'
                            )
                        } else {
                            Swal.fire(
                                msg['failed_delete'],
                                data.message,
                                'error'
                            )
                        }
                    }, error: function reject() {

                        Swal.fire(
                            msg['failed_delete'],
                            msg[7],
                            'error'
                        )
                    }
                });

            }
        })
    } else {
        Swal.fire({
            title: msg['title'] + "?",
            text: msg['not_any_selection'] + "?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: msg['confirmButtonTextof'] + "!",
            cancelButtonText: msg['cancelButton'],
        })
    }
}





function delete_by_id(route_, id_, token_, array_of_msg) {
    var msg = JSON.parse(array_of_msg);
    // console.table(msg);
    Swal.fire({
        //    showCloseButton: true,
        title: msg['title'] + "?",
        text: msg['text_of_delet'] + "?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: msg['confirmButtonTextof'] + "!",
        cancelButtonText: msg['cancelButton'],
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
                    // console.log('Row' + id_delet)
                    // console.table(data); // toast.success(data.message);
                    if (data.status == 'success') {
                        $('.Row' + id_delet).remove();

                        Swal.fire(
                            msg['deleted_msg'],
                            msg['succes_msj'],
                            'success'
                        )
                    } else {
                        Swal.fire(
                            msg['failed_delete'],
                            data.message,
                            'error'
                        )
                    }

                }, error: function reject() {

                    Swal.fire(
                        msg['failed_delete'],
                        msg[7],
                        'error'
                    )
                }
            });

        }
    })
}





