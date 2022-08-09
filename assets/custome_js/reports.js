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
                set_data_by_mode(data['mode'], JSON.parse(data['dataset']))

                toastr.success(data['notification'].message)
            } else {
                if (data['notification'].status == 'error') {
                    toastr.error(data['notification'].message);
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



function set_data_by_mode(mode, dataSet) {
    switch (mode) {
        case 'daily':
            customize_data_table(columns_daily_reports(), dataSet);
            // set_daily_reports(data);
            break;
        case 'distrubtion':
            customize_data_table(columns_distrubion_reports(), dataset_distrubion_reports(dataSet));
            // data_reports(data);
            break;

        default:
            break;
    }
}





function customize_data_table(columns, dataSet) {

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
        "autoWidth": true,
        "lengthChange": true,
        "scrollY": "400px",
        "processing": true,
        "scrollCollapse": true,
        "ordering": false,
        "data": dataSet,
        "columns": columns,
        'createdRow': function (row, data, dataIndex) {
            // Use empty value in the "Office" column
            // as an indication that grouping with COLSPAN is needed
            if ( isNaN(data['id'])  /* and not contain  data['id'] it is abbr */ ) {
                // Add COLSPAN attribute

                $('td:eq(0)', row).attr('colspan', columns.length ).css('color','#f89406')
                for (var i = 1; i < columns.length ; i++)
                    $('td:eq(' + i + ')', row).attr("hidden", true);
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
        { data: 'id', title: 'id', "defaultContent": "" },
        { data: 'Name', title: 'Name', "defaultContent": "" },
        { data: 'Amount', title: 'Amount', "defaultContent": "" },
        { data: 'Payment date', title: 'Payment date', "defaultContent": "" },
        { data: 'Description', title: 'Description', "defaultContent": "" },
    ];
}


function columns_distrubion_reports() {
    return [
        { data: 'Course', title: 'Course', "defaultContent": "" },
        { data: 'Name', title: 'Name', "defaultContent": "" },
        { data: 'Level', title: 'Level', "defaultContent": "" },
        { data: 'Status', title: 'Status', "defaultContent": "" },
        { data: 'Start Date', title: 'Start Date', "defaultContent": "" },
        { data: 'End Date', title: 'End Date', "defaultContent": "" },
        { data: 'Receipt Number', title: 'Receipt Number', "defaultContent": "" },
        { data: 'First Name', title: 'First Name', "defaultContent": "" },
        { data: 'Father Name', title: 'Father Name', "defaultContent": "" },
        { data: 'Last Name', title: 'Last Name', "defaultContent": "" },
        { data: 'Amount Amount', title: 'Amount Amount', "defaultContent": "" },
        { data: 'Date', title: 'Date', "defaultContent": "" },
        { data: 'Payment Type', title: 'Payment Type', "defaultContent": "" },
    ];
}

function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();
    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;
    return [year, month, day].join('/');
}
