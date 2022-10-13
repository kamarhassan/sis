function get_report(route_) {
    var formdata = $("#report").serializeArray();
    // $('#data-report').addAttr('hidden');
    $('#data-report').removeAttr('hidden');
    loading_showing_table();
    // customize_data_table();
    $.ajax({
        type: 'POST',
        url: route_,
        data: formdata,
        success: function (data) {
            //   remove_loading_showing_table();
            if (data['notification'].status == 'success') {

                remove_loading_showing_table();
                set_data_by_mode(data['mode'], JSON.parse(data['dataset']), data['title'])

                // toastr.success(data['notification'].message)
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



function set_data_by_mode(mode, dataSet, title) {
    switch (mode) {
        case 'daily':
            document.title = title;
            customize_data_table(columns_daily_reports(), dataSet, 'id');

            break;
        case 'distrubtion':
            // customize_data_table(columns_distrubion_reports()();
            // data_reports(data);
            break;
        case 'service_by_type':
            document.title = title;
            customize_data_table(columns_service_by_reports(), dataSet, 'id');
            break;
        case 'unpaid_account_summary':
            document.title = title;
            customize_data_table(columns_unpaid_account_summary(), dataSet, 'Course # Level');
            break;
        case 'unpaid_account_details':
            document.title = title;
            customize_data_table(columns_unpaid_account_details(), dataSet, 'Course # Level');
            break;
        case 'cours_account_summary':
            document.title = title;
            customize_data_table(columns_cours_account_summary(), dataSet, 'Course # Level');
            break;
        case 'cours_account_details':
            document.title = title;
            customize_data_table(columns_cours_account_details(), dataSet, 'Course # Level');
            break;

        default:
            break;
    }
}





function customize_data_table(columns, dataSet, first_column_data) {

    // $(document).ready(function () {
    var table = $('#custome_data_table').DataTable();
    table.destroy();
    $('#custome_data_table').empty(); // empty in case the columns change
    table = $('#custome_data_table').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],

        "paging": false,
        "autoWidth": false,
        "lengthChange": true,
        "scrollY": "600px",
        "processing": true,
        // "responsive": true,
        "retrieve": true,
        "scrollCollapse": false,
        "ordering": false,
        "scrollX": false,
        "data": dataSet,

        "columns": columns,
        "info": false,
        'createdRow': function (row, data, dataIndex) {
            // Use empty value in the "Office" column
            // as an indication that grouping with COLSPAN is needed
            if (data[first_column_data] == '' /* and not contain  data['id'] it is abbr */) {
                // Add COLSPAN attribute
                // console.log(columns.length);

                // $('td:eq(1)', row).attr('colspan', columns.length);
                for (var i = 0; i < columns.length; i++) {
                    // if(data[i] !='') 
                    // console.log($('td:eq(' + i + ')', row));

                    // $('td:eq(0)', row).css('color', '#f89406')
                    $('td:eq(' + i + ')', row).css('color', '#f89406')
                }
            }
            //  this.api().cell($('td:eq(0)', row)).data(data['id']);
        }


    });

    // });
}
function remove_loading_showing_table() {
    $('#spinner_loading').attr("hidden", true);
    $('#data-report-table').removeAttr('hidden');
}
function loading_showing_table() {
    $('#spinner_loading').removeAttr('hidden');
    $('#data-report-table').attr("hidden", true);
}



function columns_daily_reports() {
    return [
        { data: 'id', title: 'id', "defaultContent": "", "width": "5%" },
        { data: 'Name', title: 'Name', "defaultContent": "", "width": "30%" },
        { data: 'Amount', title: 'Amount', "defaultContent": "", "width": "20" },
        { data: 'Payment date', title: 'Payment date', "defaultContent": "", "width": "20" },
        { data: 'Description', title: 'Description', "defaultContent": "", "width": "20" },
    ];
}


function columns_distrubion_reports() {
    return [
        { data: 'Course', title: 'Course', "defaultContent": "", class: "text-wrap text-small" },
        { data: 'Name', title: 'Name', "defaultContent": "", class: "text-wrap text-small" },
        { data: 'Level', title: 'Level', "defaultContent": "", class: "text-wrap text-small" },
        { data: 'Status', title: 'Status', "defaultContent": "", class: "text-wrap text-small" },
        { data: 'Start Date', title: 'Start Date', "defaultContent": "", class: "text-wrap text-small" },
        { data: 'End Date', title: 'End Date', "defaultContent": "", class: "text-wrap text-small" },
        { data: 'Receipt Number', title: 'Receipt Number', "defaultContent": "", class: "text-wrap text-small" },
        { data: 'Name', title: 'Name', "defaultContent": "", class: "text-wrap text-small" },
        { data: 'Amount Amount', title: 'Amount Amount', "defaultContent": "", class: "text-wrap text-small" },
        { data: 'Date', title: 'Date', "defaultContent": "", class: "text-wrap text-small" },
        { data: 'Payment Type', title: 'Payment Type', "defaultContent": "", class: "text-wrap text-small" },
    ];
}
function columns_service_by_reports() {
    return [
        { data: 'id', title: 'id', "defaultContent": "", "width": "5%", class: "text-wrap text-small" },
        { data: 'Name', title: 'Name', "defaultContent": "", "width": "30%", class: "text-wrap text-small" },
        { data: 'Amount', title: 'Amount', "defaultContent": "", "width": "20", class: "text-wrap text-small" },
        { data: 'Payment date', title: 'Payment date', "defaultContent": "", "width": "20", class: "text-wrap text-small" },
        { data: 'Description', title: 'Description', "defaultContent": "", "width": "20", class: "text-wrap text-small" },
    ];
}

function columns_unpaid_account_summary() {
    return [

        { data: "Course # Level", title: "Course # Level", "defaultContent": "", "width": "5%" },
        { data: "Status", title: "Status", "defaultContent": "", "width": "5%", class: "text-wrap text-small" },
        { data: "Teacher", title: "Teacher", "defaultContent": "", "width": "5%", class: "text-wrap text-small" },
        { data: "Start Date", title: "Start Date", "defaultContent": "", "width": "5%", },
        { data: "End Date", title: "End Date", "defaultContent": "", "width": "5%", },
        { data: "Start Time", title: "Start Time", "defaultContent": "", "width": "5%", class: "text-wrap text-small" },
        { data: "End Time", title: "End Time", "defaultContent": "", "width": "5%", class: "text-wrap text-small" },
        { data: "Reamining", title: "Reamining", "defaultContent": "", "width": "5%", class: "text-wrap text-small" },
    ];
}

function columns_unpaid_account_details() {
    return [

        { data: "Course # Level", title: "Course # Level", "defaultContent": "", class: "text-wrap text-small", "width": "5%" },
        { data: "Status", title: "Status", "defaultContent": "", class: "text-wrap text-small", "width": "5%" },
        { data: "Teacher", title: "Teacher", "defaultContent": "", class: "text-wrap text-small", "width": "5%" },
        { data: "Start Date", title: "Start Date", "defaultContent": "", "width": "5%" },
        { data: "End Date", title: "End Date", "defaultContent": "", "width": "5%" },
        { data: "Start Time", title: "Start Time", "defaultContent": "", class: "text-wrap text-small", "width": "5%" },
        { data: "End Time", title: "End Time", "defaultContent": "", class: "text-wrap text-small", "width": "5%" },
        { data: "Student Info", title: "Student Info", "defaultContent": "", class: "text-wrap text-small", "width": "5%" },
        { data: "Reamining", title: "Reamining", "defaultContent": "", class: "text-wrap text-small", "width": "5%" },
    ];
}


function columns_cours_account_summary() {
    return [

        { data: "Course # Level", title: "Course # Level", "defaultContent": "", "width": "5%" },
        { data: "Status", title: "Status", "defaultContent": "", "width": "5%", class: "text-wrap text-small" },
        { data: "Teacher", title: "Teacher", "defaultContent": "", "width": "5%", class: "text-wrap text-small" },
        { data: "Start Date", title: "Start Date", "defaultContent": "", "width": "5%", },
        { data: "End Date", title: "End Date", "defaultContent": "", "width": "5%", },
        { data: "Start Time", title: "Start Time", "defaultContent": "", "width": "5%", class: "text-wrap text-small" },
        { data: "End Time", title: "End Time", "defaultContent": "", "width": "5%", class: "text-wrap text-small" },
        { data: "Due Amount", title: "Due Amount", "defaultContent": "", "width": "5%", class: "text-wrap text-small" },
        { data: "Payed Amount", title: "Due Amount", "defaultContent": "", "width": "5%", class: "text-wrap text-small" },
        { data: "Reamining", title: "Reamining", "defaultContent": "", class: "text-wrap text-small", "width": "5%" },
    ];
}
function columns_cours_account_details() {
    return [

        { data: "Course # Level", title: "Course # Level", "defaultContent": "", "width": "4%", class: "text-wrap text-small" },
        { data: "Status", title: "Status", "defaultContent": "", "width": "4%", class: "text-wrap text-small" },
        { data: "Teacher", title: "Teacher", "defaultContent": "", "width": "5%", class: "text-wrap text-small" },
        { data: "Start Date", title: "Start Date", "defaultContent": "", "width": "5%", },
        { data: "End Date", title: "End Date", "defaultContent": "", "width": "5%", },
        { data: "Start Time", title: "Start Time", "defaultContent": "", "width": "5%", class: "text-wrap text-small" },
        { data: "End Time", title: "End Time", "defaultContent": "", "width": "5%", class: "text-wrap text-small" },
        { data: "Student Info", title: "Student Info", "defaultContent": "", class: "text-wrap text-small col-sm-3", "width": "4%" },
        { data: "Due Amount", title: "Due Amount", "defaultContent": "", "width": "5%", class: "text-wrap text-small" },
        { data: "Payed Amount", title: "Due Amount", "defaultContent": "", "width": "5%", class: "text-wrap text-small" },
        { data: "Reamining", title: "Reamining", "defaultContent": "", class: "text-wrap text-small", "width": "5%" },
    ];
}



// function formatDate(date) {
//     var d = new Date(date),
//         month = '' + (d.getMonth() + 1),
//         day = '' + d.getDate(),
//         year = d.getFullYear();
//     if (month.length < 2) month = '0' + month;
//     if (day.length < 2) day = '0' + day;
//     return [year, month, day].join('/');
// }
