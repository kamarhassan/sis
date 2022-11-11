
function change_to_update(id, name_, route_, token_) {

    var id = id, name = name_, route = route_, token = token_;

    var labelgrade = $('#label_grade' + id).text()
    // console.log(labelgrade);
    var labelhours = $('#label_hours' + id).text()
    var labelduration = $('#label_duration' + id).text()

    var html_grade = '<div class="row"><input type="text" name="grade" id="grade_' + id + '" value="' + labelgrade.trim() + '"></div><div class="row"><span class="text-danger" id="grades_' + id + '__"> </span></div>';
    var html_hours = '<div class="row"><input type="text" name="total_hours" id="total_hours_' + id + '" value="' + labelhours.trim() + '"></div><div class="row"><span class="text-danger" id="total_hours_' + id + '__"> </span></div>';
    var html_duration = '<div class="row"><input type="text" name="period_by_mounth" id="period_by_mounth_' + id + '" value="' + labelduration.trim() + '"></div><div class="row"><span class="text-danger" id="period_by_mounth_' + id + '__"> </span></div>';

    $('#label_grade' + id).replaceWith(html_grade).html;
    $('#label_hours' + id).replaceWith(html_hours).html;
    $('#label_duration' + id).replaceWith(html_duration).html;
    var html = '<button id="btn_edit_' + id + '" token="' + token_ + '" ';
    html += 'class="btn"><i class="glyphicon glyphicon-ok"></i></button>  '
    $('#btn_editable_' + id).replaceWith(html).html;
    $(document).on('click', "#btn_edit_" + id, function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: route_,
            data: {
                '_token': token_,
                'id': id,
                'grades[]': document.getElementById('grade_' + id).value,
                'total_hours[]': document.getElementById('total_hours_' + id).value,
                'period_by_mounth[]': document.getElementById('period_by_mounth_' + id).value,
            },
            success: function (data) {
                if (data.status == 'success') {
                    toastr.success(data.message)
                }
            }, error: function reject(reject) {
                var response = $.parseJSON(reject.responseText);
                // console.log(response.errors)
                $.each(response.errors, function (key, val) {
                    let t = key.replace('.0','_'+id);
             
                    $('#' + t +'__').text(val[0]).html;
                })
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
                // console.table(response[0]);
                var response = $.parseJSON(reject.responseText).errors.level;
                $('#error_' + id).text(response[0]);
            }
        });






    })


}


