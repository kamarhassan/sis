
function change_to_update(id, name_, route_, token_) {

    var id = id, name = name_, route = route_, token = token_;

    var html = '<div class="row">';
    html += '<input type="text" name="grade" id="grade_' + id + '"';
    html += 'value="' + name_ + '">     ';
    html += '<button id="btn_edit_' + id + '" token="' + token_ + '" ';
    html += 'class="btn"><i class="glyphicon glyphicon-ok"></i></button>  '
    html += ' <div class="row"><span class="text-danger" id="error_' + id + '" > </span>';
    html += '  </div></div>';
    $('#label_' + id).replaceWith(html).html;
    $('#btn_editable_' + id).remove();

    $(document).on('click', "#btn_edit_" + id, function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: route_,
            data: {
                '_token': token_,
                'id': id,
                'grade': document.getElementById('grade_' + id).value
            },
            success: function (data) {
                if (data.status == 'success') {
                    toastr.success(data.message)
                }
            }, error: function reject(reject) {
                // var response = $.parseJSON(reject.responseText).errors.grade;
                // console.table(response[0]);
                var response = $.parseJSON(reject.responseText).errors.grade;
                $('#error_' + id).text(response[0]);
            }
        });






    })


}



function change_to_update_level(id, name_, route_, token_) {



    var html = '<div class="row">';
    html += '<input type="text" name="level" id="level_' + id + '"';
    html += 'value="' + name_ + '">     ';
    html += '<button id="btn_edit_' + id + '" token="' + token_ + '" ';
    html += 'class="btn"><i class="glyphicon glyphicon-ok"></i></button>  '
    html += ' <div class="row"><span class="text-danger" id="error_' + id + '" > </span>';
    html += '  </div></div>';
    $('#label_' + id).replaceWith(html).html;
    $('#btn_editable_' + id).remove();

    $(document).on('click', "#btn_edit_" + id, function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: route_,
            data: {
                '_token': token_,
                'id': id,
                'level': document.getElementById('level_' + id).value
            },
            success: function (data) {
                if (data.status == 'success') {
                    toastr.success(data.message)
                }
            }, error: function reject(reject) {
                var response = $.parseJSON(reject.responseText).errors.level;
                console.table(response[0]);
                var response = $.parseJSON(reject.responseText).errors.level;
                $('#error_' + id).text(response[0]);
            }
        });






    })


}


