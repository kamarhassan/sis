function services(route_) {
    var formdata = $("#services_form").serializeArray();
    console.table(formdata);

    $.ajax({
        type: 'POST',
        url: route_,
        data: formdata,
        success: function (data) {
            if (data[1].status == 'success') {
                console.table(data);
                // window.location.replace(data[0]);
                // toastr.success(data[1].message)
            } else {
                if (data[1].status == 'error') {
                    // window.location.replace(data[0]);
                    // toastr.error(data[1].message);
                }
            }
        },  error: function reject(reject) {

            var response = $.parseJSON(reject.responseText);
            $.each(response.errors, function (key, val) {
                console.log("key = " + key+"\n"+"val = "+val[0]);
                //  console.log(val[0]);
                $('#'+key ).text(val[0]).html;
            })
        }
    });
}
