function change_pay_type(paytype) {
       switch (paytype) {
        case "pay_check_":
            $('#div_pay_check').removeAttr('hidden');
            break;
        default:
            $('#div_pay_check').prop("hidden", !this.checked);
            break;
    }
}


function get_pay_type() {
    if ($('#pay_cache_').is(':checked'))
        return "pay_cache_"
    else return "pay_check_"
}


function savepayment(route_, token_, user_id, cours_id) {
    // console.log($("#payment_data")[0])
    $.ajax({
        type: 'POST',
        url: route_,
        data: {
            '_token': token_,
            'user_id': user_id,
            'cours_id': cours_id,
            'amount_to_paid': $('#amount_to_paid').val(),
            'description': $('#receipt_description').val(),
            'pay_type': get_pay_type(),
            'check_number':  $('#check_number').val(),
            'bank_': $('#bank_').val(),

        },
        success: function (data) {
            if (data[1].status == 'success') {
                toastr.success(data[1].message)
            }
            window.location.replace(data[0]);
            // window.location
            // location.href(data[0]);
            //  console.table(data)
            // set_cours_info_into_modal(data,route_)

        }, error: function reject(reject) {

            var response = $.parseJSON(reject.responseText).errors.amount_to_paid;
            // console.table(response[0]);
            // var response = $.parseJSON(reject.responseText).errors.level;
            $('#amount_to_paid_').text(response[0]).html;
            // $('#pay_by_check_').text(response[0]).html;

         }
    })
}
