// $( document ).ready(function(e) {
//     // e.preverDefault();
//     console.clear();
//     console.log( "ready!" );
//     let sum = 0;
//     for (var i = 0; i < count; i++) {
//         if (document.getElementById('md_checkbox_' + id).checked) {
//             sum += document.getElementById('md_checkbox_' + id).value;
//         }
//     }

//     console.log(sum);


// });


function total_coust(count) {

    var sum = 0;
    for (var i = 0; i < count; i++) {
        if (document.getElementById('md_checkbox_' + i).checked ) {
            // fee_value[i]
             var s= document.getElementById('fee_value['+i+']').value*1;
             var st= document.getElementById('md_checkbox_' + i).value = s;
console.log(st);
            sum += s;
        }
    }
 document.getElementById('total_coust_fee').innerText=sum;
//    return ;
}






// function total_coust(id, count) {
//     let sum = 0;
//     for (var i = 0; i < count; i++) {
//         if (document.getElementById('md_checkbox_' + id).checked) {
//             sum += document.getElementById('md_checkbox_' + id).value;
//         }
//     }
// }
