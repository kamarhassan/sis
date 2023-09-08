

function activate_cuurency(route_, id_, token_) {


    var id_currency = id_;
    var token = token_;
    $.ajax({
        type: 'POST',
        url: route_,
        data: {
            '_token': token,
            'id': id_currency
        },
        success: function (data) {

            if (data.status == 'success') {
                toastr.success(data.message) 
            } else {
                if (data.status == 'error') {
                    toastr.error(data.message);
                }
            }

        }, error: function reject() {


        }
    });

}
