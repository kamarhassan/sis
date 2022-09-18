function submit(route_,form_id) {
    var formdata = $("#"+form_id).serializeArray();
    $.ajax({
        type: 'POST',
        url: route_,
        data: formdata,
        success: function (data) {
            if (data.status == 'success') {
                toastr.success(data.message) 
            } else {
                if (data.status == 'error') {
                    toastr.error(data.message);
                }
            }
        }, error: function reject(reject) {
            var response = $.parseJSON(reject.responseText);
            $.each(response.errors, function (key, val) {
                let t = key.replace('.', '_');
                console.log(t);
                $('#' + t + '_').text(val[0]).html;
            })
        }
    });
}
