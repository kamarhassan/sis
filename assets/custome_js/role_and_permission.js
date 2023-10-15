function get_permission(route_, token_) {
    $.ajax({
        type: 'POST',
        url: route_,
        data: {
            '_token': token_,
            // 'id': id,
        },
        success: function (data) {
            // console.log(data['status'])
            if (data['status'] == 'success') {
                $('#modal-center').modal('show');
                // set_tab_name(data.tab_name, data.permission);
                set_permission_info_into_modal(data['permissions_for_role'], data['role_id'], data['role_name'], data['all_permissions_id'])
                //    set_services_info_into_modal(data)
                //    $('#modal-center').modal('show')
            } else {
                $('#modal-center').modal('hide')
                toastr.error(data['message']);
            }
        }, error: function reject() {

        }
    })

}


function update_permission_for_role(route_, formdata_id,all_permisssion) {
    // alert(1);
    var formdata = $('#' + formdata_id).serializeArray();
   //  console.log(formdata);

    $.ajax({
        type: 'POST',
        url: route_,
        data: formdata,
        success: function (data) {
            console.table(data);
            if (data.status == 'success') {
               //  toastr.success(data.message)
                toaster(data.message, data.status);
                $('#modal-center').modal('hide')
                reset_permission(all_permisssion);
            } else {
                if (data.status == 'error') {
                  toaster(data.message, data.status)
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


function set_permission_info_into_modal(data, role_id, role_name, all_permissions_id) {

    $("#role_id").val(role_id);
    $("#role_name").val(role_name);

    $("#update_role").attr("hidden", false);
    $("#new_role").attr("hidden", true);

    $.each(all_permissions_id, function (key, val) {
        $('#md_checkbox_' + val['id']).prop('checked', false);
    })
    $.each(data, function (key, val) {
        $('#md_checkbox_' + val['id']).prop('checked', true);
    })

}

function reset_input(all_permissions_id) {
    $.each(all_permissions_id, function (key, val) {
        $('#md_checkbox_' + val['id']).prop('checked', false);
    })
    $("#role_id").val('');
    $("#role_name").val('');
    $("#update_role").attr("hidden", true);
    $("#new_role").attr("hidden", false);
}

function reset_permission(all_permissions_id) {
    $.each(all_permissions_id, function (key, val) {
        $('#md_checkbox_' + val['id']).prop('checked', false);
    })
}

function toaster(message, status) {
   $.toast({
      // heading: 'Welcome to my Sunny Admin',
      text: message,
      position: 'top-right',
      loaderBg: '#ff6849',
      icon: status,
      hideAfter: 5000,
      stack: 6
   });
}