
function get_product(route_, token_) {
   $.ajax({
       type: 'POST',
       url: route_,
       data: {
           '_token': token_,
           // 'id': id,
       },
       success: function(data) {
           if (data) {

              console.log(data);
               $('#modal-center').replaceWith(data);
               $("#product").select2();
               $('#modal-center').modal('show')
           }
       },
       error: function reject() {

       }
   })
}