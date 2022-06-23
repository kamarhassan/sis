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
    var formdata = $("#payment_data").serializeArray();
    // console.table(formdata)
    $.ajax({
        type: 'POST',
        url: route_,
        data: formdata,
        // data: {
        //     '_token': token_,
        //     'user_id': user_id,
        //     'cours_id': cours_id,
        //     'amount_to_paid': $('#amount_to_paid').val(),
        //     'description': $('#receipt_description').val(),
        //     'pay_type': get_pay_type(),
        //     'check_number': $('#check_number').val(),
        //     'bank_': $('#bank_').val(),
        //     // 'data':data,

        // },
        
        success: function (data) {
            if (data[1].status == 'success') {
                window.location.replace(data[0]);
                toastr.success(data[1].message)
            }
            // window.location
            // location.href(data[0]);
            //  console.table(data)
            // set_cours_info_into_modal(data,route_)

        }, error: function reject(reject) {

            var response = $.parseJSON(reject.responseText);
            $.each(response.errors, function (key, val) {
            //  console.log(key);
            //  console.log(val[0]);
                $('#' + key+'_').text(val[0]).html;
            })
            // console.table(response[0]);
            // var response = $.parseJSON(reject.responseText).errors.level;
            // $('#amount_to_paid_').text(response[0]).html;
            // $('#pay_by_check_').text(response[0]).html;

        }
    })
}


function change_payment_methode() {
    if ($('#payment_methode').is(':checked')) {
        $('#normal_pament').prop("hidden", !this.checked);
        $('#Other_payment').removeAttr('hidden');
    } else {
        $('#Other_payment').prop("hidden", !this.checked);
        $('#normal_pament').removeAttr('hidden');
    }
}
