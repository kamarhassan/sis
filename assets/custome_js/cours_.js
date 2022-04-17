
function total_coust(fee_types_id) {
console.table(fee_types_id)
    var sum = 0;
    $.each(fee_types_id, function (key, value) {
        if ($('#md_checkbox_' + fee_types_id[key].id).is(":checked")) {
            if (!($('#fee_value_' + fee_types_id[key].id).val() == '')) {
                var fee_value = $('#fee_value_' + fee_types_id[key].id).val() * 1;
                $('#md_checkbox_' + fee_types_id[key].id).val(fee_value);
                sum += fee_value;
            }
        }
        $('#total_coust_fee').text(sum);

    });


}


function change_fee_cours(cours_fee) {
    var sum = 0;

    for (var i = 0; i < cours_fee.length; i++) {


        $('.fee_' + cours_fee[i].fee_types_id).prop('checked', true);
        $('.fee_value_' + cours_fee[i].fee_types_id).val(cours_fee[i].value);
        $('#md_checkbox_' + cours_fee[i].fee_types_id).val(cours_fee[i].value);
        sum += cours_fee[i].value;

    }

    $('#total_coust_fee').text(sum);



}
function select_day_of_cours(day_of_cours) {
 $.each(day_of_cours, function (key, value) {
        // $("select option[value='B']").attr("selected","selected");
        $('#choose_day_of_cours option:eq('+key+')').prop('selected', 'selected');
    });
}

