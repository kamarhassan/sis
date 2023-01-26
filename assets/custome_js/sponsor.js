function get_sponsor_shipe(route, form_id) {
    var formdata = $("#" + form_id).serializeArray();
    // console.log(formdata);
    $('#error_and_edit_route').attr("hidden", true);
    $.ajax({
        type: 'POST',
        url: route,
        data: formdata,
        success: function (data) {
            // console.log(data.sponsore_ship);
            reset_select();
            // loading_showing_table();
            $('#data_sponsored').attr("hidden", true);
            if (data.status == 'success') {
                // if (data.sponsor_id != null)
                if (data.sponsore_ship != "") {
                    set_cours(data.sponsore_ship);
                    // $('#sponsore_id').val(data.sponsorships_id)
                }
                //  console.log(1); sponsore_ship
                // toastr.success(data.message)
                // $('#modal-center').modal('hide')
            } else {
                if (data.status == 'error') {
                    // toastr.error(data.message);
                    set_edit_link(data.message, data.route)
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

function get_students_sponsor(route, form_id) {
    var formdata = $("#" + form_id).serializeArray();
    // console.log(formdata);
    initialize_();
    $.ajax({
        type: 'POST',
        url: route,
        data: formdata,
        success: function (data) {
            // console.log(data.sponsore_ship);
            // reset_select();
            if (data.status == 'success') {

                remove_loading_showing_table();
                customize_data_table(discount_column(), data.dataset);
            
                $('#cours_fee_total').text(data.cours_fee_total);
                $('#cours_id').val(data.cours_id);
                $('#sponsor_id').val(data.sponsor_id);
             
                $('#first_row').replaceWith(data.first_row);
                $('#btn_submit').replaceWith(data.button);

                // switch (data.discount_is) {
                //     case 'same_discount':
                //         break;
                //     case 'diff_discount':
                //         $('#cours_fee_total').text(data.cours_fee_total);
                //         $('#cours_id').val(data.cours_id);
                //         $('#sponsor_id').val(data.sponsor_id);
                //         break;

                //     default:
                //         break;
                // }

            } else {
                if (data.status == 'error') {
                    // toastr.error(data.message);
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




function reset_select() {
    var dropdown = $("#cours");
    dropdown.empty();

    // dropdown.find('option')
    // .remove()
}

function set_cours(data_cours) {
    var dropdown = $("#cours");
    dropdown.append($("<option />").val('').text('------------------------------------------------'));
    $.each(data_cours, function () {
        dropdown.append($("<option />").val(this.cours_id + "," + this.sponsorships_id).text(this.grade + " # " + this.level + " # start: " + this.start_date + " # end: " + this.end_date));
    });
    // cours_form
    $("#cours_form_col").prop("hidden", false);
}



function customize_data_table(columns, dataSet) {

    // $(document).ready(function () {
    var table = $('#data_students_sponsored').DataTable();
    // alert(1);
    table.destroy();
    $('#data_students_sponsored').empty(); // empty in case the columns change
    table = $('#data_students_sponsored').DataTable({
        // dom: 'Bfrtip',
        // buttons: [
        //     'copy', 'csv', 'excel', 'pdf', 'print'
        // ],

        "paging": false,
        "autoWidth": true,
        "lengthChange": false,
        "scrollY": "400px",
        "processing": true,
        "responsive": false,
        "retrieve": true,
        "scrollCollapse": false,
        "ordering": false,
        "scrollX": false,
        "data": dataSet,
        "columns": columns,
        "info": false,
        "searching": false
    });

    // table.columns( [ 0, 1 ] ).visible( false, false );
    // table.columns.adjust().draw( false ); // adjust column sizing and redraw



    // });
}


function initialize_() {

    $('#data_sponsored').removeAttr('hidden');
    $('#data_students_sponsored').removeAttr('hidden');
    // $('#attendance_date_new_or_update').val($("#attendance_date").val());
    loading_showing_table();
    // $('#total_hours').val('');
}
function initialize_btn_submit(btn_sumbit_form) {
    $("#btn_submit").replaceWith(btn_sumbit_form);
}

function remove_loading_showing_table() {
    $('#spinner_loading').attr("hidden", true);
    $('#data_sponsored').removeAttr('hidden');
}

function loading_showing_table() {
    $('#spinner_loading').removeAttr('hidden');
    $('#data_sponsored').attr("hidden", true);
}

function discount_column() {
    return [
        // { data: 'register_id', title: 'register_id', "defaultContent": "", 'visible': false*/ },
        { data: 'student_id', title: 'student_id', "defaultContent": "", 'visible': false },
        { data: 'student_name', title: 'Student Name', "defaultContent": "", "width": "20%", class: "text-wrap text-small" },
        // { data: 'fee_type', title: 'Fee Type Discount', "defaultContent": "", "width": "20%", },
        { data: 'student_percent', title: 'Percent', "defaultContent": "", "width": "20%", },
        { data: 'student_discount', title: 'Discount', "defaultContent": "", "width": "20%", },
        { data: 'remaining', title: 'Remaining', "defaultContent": "", "width": "10%", },

    ];
}

function get_fee_selected(array_cours_fees) {

    var t = 0;
    array_cours_fees.forEach(element => {
        // console.table(element)
        
        if ($('#cours_fee' + element.id).prop('checked'))
        //  var id_checkbox  = element.val().split("_")[0];
        t += parseInt($('#cours_fee' +element.id).val());
    });
    return t;

}

function calculate_discount(input_id, cours_fees) {
    var fee_selected = get_fee_selected(cours_fees);
    var cours_fee_total_ =cours_fee_total(cours_fees);
    if(fee_selected ===0 ){
        // select_one_of_fee
        $('#select_one_of_fee_' + input_id).prop('hidden', false);
    }
    if (validate($('#percent_' + input_id), $('#remaining_' + input_id), 0, 100, 'error') == true) {

        var percent = $('#percent_' + input_id).val();
        var discount_calcuated = fee_selected * (percent / 100);
        $('#discount_' + input_id).val(discount_calcuated.toFixed(2));
        $('#remaining_' + input_id).text((cours_fee_total_ - discount_calcuated).toFixed(2));
        $('#discount_' + input_id).css("border", " solid green");
    }
    //   var discount_calcuate = 
    // percent_
    // discount_
}

function calculate_percent(input_id, cours_fees) {
    var fee_selected = get_fee_selected(cours_fees);
   var cours_fee_total_ =cours_fee_total(cours_fees);
    if(fee_selected ===0 ){
        // select_one_of_fee
        $('#select_one_of_fee_' + input_id).prop('hidden', false);
    }
    if (validate($('#discount_' + input_id), $('#remaining_' + input_id), 0, fee_selected, 'error') == true) {
        var discount = $('#discount_' + input_id).val();
        //  = $("#userInputID").val();
        var percent_calcuated = (discount * 100) / fee_selected;
        $('#percent_' + input_id).val(percent_calcuated.toFixed(2));
        $('#remaining_' + input_id).text((cours_fee_total_ - discount).toFixed(2));
        $('#percent_' + input_id).css("border", " solid green");
    }
}

function validate(input_id, input_id_err, min_, max_, msg) {
    var value_input = $(input_id).val();

    if (value_input < min_ || value_input > max_) {
        $(input_id).css("border", "solid red");
        // input_id_err.css("color", "solid red").text('msg');
        input_id_err.removeClass('text-warning').addClass('text-danger').text(msg)
        return false;
    }

    $(input_id).css("border", " solid green");
    if (input_id_err.attr('class') == 'text-danger')
        input_id_err.removeClass('text-danger').addClass('text-warning')

    return true

    /*
    
     percent_XXXXXX_err span error of percent field 
     discount_XXXXXX_err span error of discount field 

    */
}


function set_edit_link(msg, route) {

    $('#error_and_edit_route').attr("hidden", false);
    $('#error').text(msg);
    $('#edit_route').attr("href", route);
}

// function cours_fee_total
function cours_fee_total(array_cours_fees) {

    var t = 0;
    array_cours_fees.forEach(element => {
        // console.table(element)
        
       
        //  var id_checkbox  = element.val().split("_")[0];
        t += parseInt($('#cours_fee' +element.id).val());
    });
    return t;

}

