
 

function export_file(route_,form_id,methode) {
    
    var formdata = $("#"+form_id).serializeArray();
    // console.log(formdata);
    open_link(route_);
    // $.ajax({
    //     type: methode,
    //     url: route_,
    //     data: formdata,
    //     success: function (data) {
    //         if (data.status == 'success') {
    //             toastr.success(data.message) 
    //         } else {
    //             if (data.status == 'error') {
    //                 toastr.error(data.message);
    //             }
    //         }
    //     }, error: function reject(reject) {
    //         var response = $.parseJSON(reject.responseText);
    //         // console.log(response.errors)
    //     //   hanging
    //     }
    // });
}
