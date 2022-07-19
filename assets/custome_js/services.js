function services(route_) {
    var formdata = $("#services_form").serializeArray();
    // console.table(formdata);

    $.ajax({
        type: 'POST',
        url: route_,
        data: formdata,
        success: function (data) {
            // console.table(data);
            if (data[0].status == 'success') {
                // console.table(data);
                // window.location.replace(data[0]);
                toastr.success(data[0].message)
                // var services_table = $('#example').DataTable();

                // for (var i = 0; i < data[1].length; i++) {
                //     services_table.row.add([]).draw(false);

                // }
            } else {
                if (data[0].status == 'error') {
                    // window.location.replace(data[0]);
                    toastr.error(data[0].message);
                }
            }
        }, error: function reject(reject) {
            var response = $.parseJSON(reject.responseText);
            $.each(response.errors, function (key, val) {
                let t = key.replace('.', '_');
                // console.log("key = " + t+"\n"+"val = "+val[0]);
                //  console.log(val[0]);
                $('#' + t + '_').text(val[0]).html;
            })
        }
    });
}
