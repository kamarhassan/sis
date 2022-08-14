function get_permission(route_, token_) {
    $.ajax({
        type: 'POST',
        url: route_,
        data: {
            '_token': token_,
            // 'id': id,
        },
        success: function (data) {
            console.log(data['status'])
           if(data['status']=='success'){
               $('#modal-center').modal('show');
               set_permission_info_into_modal(data['permissions'],data['role_id'],data['role_name'])
                              //    set_services_info_into_modal(data)
            //    $('#modal-center').modal('show')
            }else {
                $('#modal-center').modal('hide')
                toastr.error(data['message']);
            }
        }, error: function reject() {

        }
    })

}


function update_permission_for_role(route_){

        var formdata = $("#update_permission_for_role").serializeArray();
        // console.table(formdata);
        $.ajax({
            type: 'POST',
            url: route_,
            data: formdata,
            success: function (data) {

                console.table(data);
                // if (data.status == 'success') {
                //     toastr.success(data.message)
                //     $('#modal-center').modal('hide')
                // } else {
                //     if (data.status == 'error') {
                //         toastr.error(data.message);
                //     }
                // }
            }, error: function reject(reject) {
                var response = $.parseJSON(reject.responseText);
                $.each(response.errors, function (key, val) {
                    let t = key.replace('.', '_');
                    $('#' + t + '_').text(val[0]).html;
                })
            }
        });


}


function set_permission_info_into_modal(data,role_id,role_name){
    var permision;
    $("#role_id").val(role_id);
    $("#role_name").val(role_name);
    $.each(data, function (key, val) {

           permision = val['name'];
        //  if(permision.indexOf('levels') > 0)
         $('#'+permision).prop('checked', true);
        // $('#' + key + '_').text(val[0]).html;
    })

}
function reset_permission_info_into_modal(data){

    $.each(data, function (key, val) {

           permision = val['name'];
        //  if(permision.indexOf('levels') > 0)
         $('#'+permision).prop('checked', false);
        // $('#' + key + '_').text(val[0]).html;
    })

}
