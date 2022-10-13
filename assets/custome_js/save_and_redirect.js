function submit(route_, form_id) {
    // var formdata = $("#" + form_id).serializeArray();
    var formdata = new FormData($("#" + form_id)[0]);

    console.log(formdata);
    $.ajax({
        enctype: 'multipart/form-data',
        type: 'POST',
        url: route_,
    
        data: formdata,
        processData: false,
        contentType: false,
        cache: false,
        success: function (data) {
            // console.log(data)
            if (data.status == 'success') {
                toastr.success(data.message)
                window.location.href = data.route;
            } else {
                if (data.status == 'error') {
                    toastr.error(data.message);
                }
            }
        }, error: function reject(reject) {
            var response = $.parseJSON(reject.responseText);
            $.each(response.errors, function (key, val) {
                let t = key.replace('.', '_');
                // console.log(t);
                $('#' + t + '_').text(val[0]).html;
            })
        }
    });
}
