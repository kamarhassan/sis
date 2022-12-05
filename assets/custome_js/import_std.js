function submit(route_, form_id, error_id, msg_you_have_error_in_line) {
    // var formdata = $("#" + form_id).serializeArray();
    var formdata = new FormData($("#" + form_id)[0]);
    // spinner_show();
    // console.log(formdata);
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

            switch (data.status) {
                case 'success_have_error':
                    //  toastr.error(data.message)
                    //  toastr.success(data.message)
                    spinner_hide();
                    var html = '<div id="user_have_error"><span class="text-danger">' + msg_you_have_error_in_line + '</span>';
                    var user_error = data.user_data_error;
                    var index = 1

                    $.each(user_error, function (key, arry_of_user_have_error) {

                        // index = Number(key) + Number(1);
                        // console.log(arry_of_user_have_error);
                        html += '<div class="row">';
                        html += '<p><span class="text-danger">' + arry_of_user_have_error.index + ' => </span>';
                        $.each(arry_of_user_have_error.error, function (key, val) {
                            //  console.log(val);
                            // if (val === null)
                            html += '<span class="text-danger"><br>' + '-> ' + val + ' </span>';
                        })
                        html += '</p></div><br><br>';

                    })
                    html += '</div>';
                    $("#" + error_id).replaceWith(html);
                    // console.log(data.user_erro_file_name);
                    $("#error_std_file_name").val(data.user_erro_file_name);
                    $("#btn_erro_list").attr('hidden', false);

                    break;
                case 'success':
                    toastr.success(data.message)
                    spinner_hide();
                    window.location.href = data.route;
                    break;

                default:
                    toastr.error(data.message);
                    spinner_hide();
                    break;
            }


        }, error: function reject(reject) {
            var response = $.parseJSON(reject.responseText);
            $.each(response.errors, function (key, val) {
                spinner_hide();
                let t = key.replace('.', '_');
                // console.log(key);
                $('#' + t + '_').text(val[0]).html;
            })
        }
    });
}




function spinner_show() {
    $("#overlay").fadeIn(300);
}
function spinner_hide() {
    setTimeout(function () {
        $("#overlay").fadeOut(300);
    }, 100);
}