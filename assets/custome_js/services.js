function services(route_, form_id) {
    var formdata = $("#" + form_id).serializeArray();
    // console.table(formdata);
    $.ajax({
        type: 'POST',
        url: route_,
        data: formdata,
        success: function (data) {

            if (data.status == 'success') {
                console.log(1);
                toastr.success(data.message)
                $('#modal-center').modal('hide')
            } else {
                if (data.status == 'error') {
                    toastr.error(data.message);
                }
            }
        }, error: function reject(reject) {
            var response = $.parseJSON(reject.responseText);
            $.each(response.errors, function (key, val) {
                let t = key.replace('.', '_');
                $('#' + t + '_').text(val[0]).html;
            })
        }
    });
}



function get_service(route_, token_) {
    $.ajax({
        type: 'POST',
        url: route_,
        data: {
            '_token': token_,
            // 'id': id,
        },
        success: function (data) {
            if (data) {
               $('#modal-center').replaceWith(data);
               $("#currency").select2();
               // $('#modal-center').modal('show')
               //  set_services_info_into_modal(data)
                $('#modal-center').modal('show')
            }
        }, error: function reject() {

        }
    })
}

function set_services_info_into_modal(data) {
    $('#service_id').val(data['id']);
    $('#service').val(data['service']);
    $('#fee').val(data['fee']);
    if (data['active'] == 1) {
        $('#active').attr('checked', true);
    } else {
        $('#active').attr('checked', false);
    }
    $('#active').val(data['active']);
    $('#currency').val(data['currency']['id']).change();

}
