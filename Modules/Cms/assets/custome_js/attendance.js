function get_students_by_date(route_, form_id) {
    var formdata = $("#" + form_id).serializeArray();
    // console.log(formdata);
    initialize_();
    $.ajax({
        type: 'POST',
        url: route_,
        data: formdata,
        success: function (data) {
            // console.log(data);
            remove_loading_showing_table();
            if (data['notification'].status == 'success') {

                customize_data_table(attendance_column(), data.dataset)
                if (data.attendance_info != false)
                    $('#total_hours').val(data.attendance_info[0].total_hours);

                initialize_btn_submit(data.bnt_submit_attendance);
            } else {
                if (data['notification'].status == 'error') {
                    // toastr.error(data['notification'].message);
                }
            }
        }, error: function reject(reject) {
            var response = $.parseJSON(reject.responseText);
            $.each(response.errors, function (key, val) {
                $('#' + key + '_').text(val[0]).html;
            })

        }
    })
}

function submit(route_, form_id) {
    $('#attendance_date_new_or_update').val($("#attendance_date").val());
    $('#total_hours_details').val($("#total_hours").val());
    var formdata = $("#" + form_id).serializeArray();
    // console.log(formdata);
    $.ajax({
        type: 'POST',
        url: route_,
        data: formdata,
        success: function (data) {
            if (data.status == 'success') {
                toastr.success(data.message)

            } else {
                if (data.status == 'error') {
                    toastr.error(data.message);
                }
            }
        }, error: function reject(reject) {
            var response = $.parseJSON(reject.responseText);
            // console.log(response.errors)
            $.each(response.errors, function (key, val) {
                let t = key.replace('.', '_');
                console.log(t);
                $('#' + t + '_').text(val[0]).html;
            })
        }
    });
}


function customize_data_table(columns, dataSet) {

    // $(document).ready(function () {
    var table = $('#data_attendance').DataTable();
    // alert(1);
    table.destroy();
    $('#data_attendance').empty(); // empty in case the columns change
    table = $('#data_attendance').DataTable({
        // dom: 'Bfrtip',
        // buttons: [
        //     'copy', 'csv', 'excel', 'pdf', 'print'
        // ],

        "paging": false,
        "autoWidth": false,
        "lengthChange": true,
        "scrollY": "400px",
        "processing": true,
        // "responsive": true,
        "retrieve": true,
        "scrollCollapse": false,
        "ordering": false,
        "scrollX": false,
        "data": dataSet,
        "searching": false,
        "columns": columns,
        "info": false,
        // 'createdRow': function (row, data, dataIndex) {
        //     // Use empty value in the "Office" column
        //     // as an indication that grouping with COLSPAN is needed
        //     if (data[first_column_data] == '' /* and not contain  data['id'] it is abbr */) {
        //         // Add COLSPAN attribute
        //         // console.log(columns.length);

        //         // $('td:eq(1)', row).attr('colspan', columns.length);
        //         for (var i = 0; i < columns.length; i++) {
        //             // if(data[i] !='') 
        //             // console.log($('td:eq(' + i + ')', row));

        //             // $('td:eq(0)', row).css('color', '#f89406')
        //             $('td:eq(' + i + ')', row).css('color', '#f89406')
        //         }
        // }
        //  this.api().cell($('td:eq(0)', row)).data(data['id']);
        // }


    });

    // });
}



function initialize_() {
    $('#data_attendance_box').removeAttr('hidden');
    $('#data_attendance').removeAttr('hidden');
    $('#attendance_date_new_or_update').val($("#attendance_date").val());
    loading_showing_table();
    $('#total_hours').val('');
}
function initialize_btn_submit(btn_sumbit_form) {
    $("#btn_submit").replaceWith(btn_sumbit_form);
}


function remove_loading_showing_table() {
    $('#spinner_loading').attr("hidden", true);
    $('#data_attendance').removeAttr('hidden');
}

function loading_showing_table() {
    $('#spinner_loading').removeAttr('hidden');
    $('#data_attendance').attr("hidden", true);
}

function attendance_column() {
    return [
        { data: 'id', title: 'id', "defaultContent": "", "width": "5%", 'visible': false },
        { data: 'Name', title: 'Name', "defaultContent": "", "width": "30%" },
        { data: 'attendance', title: 'attendance', "defaultContent": "", "width": "30%" },

    ];
}




function attendance_report(dataset, header, header_name) {
    const container = document.getElementById('example');
    const hyperformulaInstance = HyperFormula.buildEmpty({
        // to use an external HyperFormula instance,
        // initialize it with the `'internal-use-in-handsontable'` license key
        licenseKey: 'internal-use-in-handsontable',
    });
    const hot = new Handsontable(container, {
        data: dataset,
        rowHeaders: true,
        colHeaders: true,
        colHeaders: header_name,
        height: 'auto',
        fixedColumnsStart: 1,
        formulas: {
            engine: hyperformulaInstance,
            sheetName: 'Sheet1'
        },
        readOnly: true,
        licenseKey: 'non-commercial-and-evaluation' // for non-commercial use only
    });
}


function reset_attendance(route_, form_id, array_of_msg) {
    var msg = JSON.parse(array_of_msg);
    var formdata = $("#" + form_id).serializeArray();
    // console.log(formdata)
    if (formdata.length > 1) {
        Swal.fire({
            title: msg['title'] + "?",
            text: msg['text_of_delet'] + "?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: msg['confirmButtonTextof'] + "!",
            cancelButtonText: msg['cancelButton'],
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: route_,
                    data: formdata,
                    success: function (data) {
                        if (data.status == 'success') {
                            $('#attendance_hours_' + data.date).remove();
                            Swal.fire(
                                msg['deleted_msg'],
                                data.message,
                                'success'
                            )
                        } else {
                            Swal.fire(
                                msg['failed_delete'],
                                data.message,
                                'error'
                            )
                        }
                    }, error: function reject() {

                        Swal.fire(
                            msg['failed_delete'],
                            msg[7],
                            'error'
                        )
                    }
                });

            }
        })
    } else {
        Swal.fire({
            title: msg['title'] + "?",
            text: msg['not_any_selection'] + "?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: msg['confirmButtonTextof'] + "!",
            cancelButtonText: msg['cancelButton'],
        })
    }
}

function reset_attendance_all(route_, form_id, array_of_msg) {
    var msg = JSON.parse(array_of_msg);
    var formdata = $("#" + form_id).serializeArray();
    // console.log(formdata)
    if (formdata.length > 1) {
        Swal.fire({
            title: msg['title'] + "?",
            text: msg['text_of_delet'] + "?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: msg['confirmButtonTextof'] + "!",
            cancelButtonText: msg['cancelButton'],
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: route_,
                    data: formdata,
                    success: function (data) {
                        if (data.status == 'success') {
                            window.location.href = data.route;

                            Swal.fire(
                                msg['deleted_msg'],
                                data.message,
                                'success'
                            )
                        } else {
                            Swal.fire(
                                msg['failed_delete'],
                                data.message,
                                'error'
                            )
                        }
                    }, error: function reject() {

                        Swal.fire(
                            msg['failed_delete'],
                            msg[7],
                            'error'
                        )
                    }
                });

            }
        })
    } else {
        Swal.fire({
            title: msg['title'] + "?",
            text: msg['not_any_selection'] + "?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: msg['confirmButtonTextof'] + "!",
            cancelButtonText: msg['cancelButton'],
        })
    }
}




function change_status(route_, form_id) {

    var formdata = $("#" + form_id).serializeArray();
    console.log(formdata)
    $.ajax({
        type: 'POST',
        url: route_,
        data: formdata,
        success: function (data) {
            if (data.status == 'success') {
                toastr.success(data.message)
            } else {
                if (data.status == 'error') {
                    toastr.error(data.message);
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

function change_status_all(route_, form_id) {

    var formdata = $("#" + form_id).serializeArray();
    console.log(formdata)
    $.ajax({
        type: 'POST',
        url: route_,
        data: formdata,
        success: function (data) {
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
                $('#' + t + '_').text(val[0]).html;
            })
        }
    });

}
