let header_token = $('#header_token').val();
$(document).on('click', '.editBtn', function (event) {
   if (!checkDemo()) {
      return false;
   }

   let form = $(this).closest("form");
   let data = form.serialize();

   // let id = $(this).closest("form").find('.id').val();
   // let type = $(this).closest("form").find('.type').val();
   // let title = $(this).closest("form").find($('input[name="title"]')).val();
   // let link = $(this).closest("form").find('.link').val();
   // let is_newtab = $(this).closest("form").find($('[name$="is_newtab"]:checked')).val();
   // let from_bank_name = $(this).closest("form").find($('[name$="from_bank_name"]:checked')).val();
   let url = $('#headermenu_edit_url').val();
   // let data = {
   //     'id': id,
   //     'type': type,
   //     'title': title,
   //     'link': link,
   //     'is_newtab': is_newtab,
   //     'from_bank_name': from_bank_name,
   //     '_token': header_token
   // }
   $.post(url, data, function (data) {
      if (data) {
         blankData();
         toastr.success("Operation successful", "Successful", { timeOut: 5000, });
         reloadWithData(data);
      } else {
         toastr.error("Operation failed", "Error", { timeOut: 5000, });
      }
   });


});


$(document).ready(function () {

   addMenu('Dynamic Page', '#add_page_btn', $('#pagess'));
   addMenu('Static Page', '#add_static_page_btn', $('#staticPagesInput'));
   addMenu('Category', '#add_category_page_btn', $('#categoryInput'));
   addMenu('Sub Category', '#add_sub_category_page_btn', $('#subCategoryInput'));
   addMenu('Course', '#add_course_page_btn', $('#courseInput'));
   addMenu('Quiz', '#add_quiz_page_btn', $('#quizInput'));
   addMenu('Class', '#add_class_page_btn', $('#classInput'));

});

function addMenu(type, btn, input) {
   $(document).on('click', btn, function (event) {
      if (!checkDemo()) {
         return false;
      }

      let dPages = input.val();
      let url = $('#headermenu_add_url').val();

      // if (dPages.length > 0) {

      let data = {
         'type': type,
         'element_id': dPages,
         '_token': header_token
      }
      $.post(url, data, function (data) {
         if (data) {
            blankData();
            toastr.success("Operation successful", "Successful", { timeOut: 5000, });
            reloadWithData(data);
            input.val('').trigger('change')
         } else {
            toastr.error("Operation failed", "Error", { timeOut: 5000, });
         }
      });


   });
}


$(document).ready(function () {
   $(document).on('click', '#add_custom_link_btn', function (event) {
      if (!checkDemo()) {
         return false;
      }
      console.log(1)
      wait(5000);
      let tTitle = $('#tTitle').val();
      let tLink = $('#tLink').val();
      console.log(2)
      let url = $('#headermenu_add_url').val();
      wait(5000);
      let data = {
         'type': 'Custom Link',
         'title': tTitle,
         'link': tLink,
         '_token': header_token,
      }

      $.post(url, data, function (data) {
         if (data) {
            blankData();
            console.log(3)
            wait(5000);
            toastr.success("Operation successful", "Successful");
            console.log(4)
            wait(5000);
            reloadWithData(data);
         } else {
            toastr.error("Operation failed", "Error");
         }
      });
   });

   $(document).on('click', '.mega_menu', function (event) {
      if (!checkDemo()) {
         return false;
      }
      let element = $(this);
      let status = element.val();
      if (status == 1) {
         element.closest('.accordion_card').find('.no-mega-menu').addClass('d-none')
         element.closest('.accordion_card').find('.yes-mega-menu').removeClass('d-none')
      } else {
         element.closest('.accordion_card').find('.yes-mega-menu').addClass('d-none')
         element.closest('.accordion_card').find('.no-mega-menu').removeClass('d-none')
      }


   });
});

$(document).ready(function () {
   let url = $('#headermenu_reordering_url').val();
   $(document).on('mouseover', 'body', function () {
      let demoMode = $('#demoMode').val();

      if (demoMode) {
         return false;
      }

      $('.dd').nestable({
         maxDepth: 10,
         callback: function (l, e) {
            let order = JSON.stringify($('.dd').nestable('serialize'));
            let data = {
               'order': order,
               '_token': header_token
            }
            $.post(url, data, function (data) {
               if (data != 1) {
                  toastr.error("Element is Not Moved. Error ocurred", "Error", { timeOut: 5000, });
               }
            });
         }
      });
   });
});

function elementDelete(id) {
   alert('status delete');
   if (!checkDemo()) {
      return false;
   }

   $('#deleteSubmenuItem').modal('show');
   $('#item-delete').val(id);


}

function delete_by_id(id_,swal_fire_msg) {
   let route_ = $('#headermenu_delete_url').val();
   let token = $('#header_token').val();
   
   var msg = JSON.parse(swal_fire_msg);
   // console.table(msg);
   Swal.fire({
      //    showCloseButton: true,
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

         var id_delet = id_;
         // var token = token_;
         $.ajax({
            type: 'POST',
            url: route_,
            data: {
               '_token': token,
               'id': id_delet
            },
            success: function (data) {
               reloadWithData(data);
               Swal.fire(
                  msg['deleted_msg'],
                  msg['succes_msj'],
                  'success'
               )


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
}


$(document).on('click', '#delete-item', function (event) {
   event.preventDefault();

   if (!checkDemo()) {
      return false;
   }
   let url = $('#headermenu_delete_url').val();
   $('#deleteSubmenuItem').modal('hide');
   let id = $('#item-delete').val();
   let data = {
      'id': id,
      '_token': header_token,
   }
   $.post(url, data,
      function (data) {
         reloadWithData(data);
      });
});


function reloadWithData(response) {
   $('#menuList').empty();
   $('#menuList').html(response);
}

function blankData() {
   $('#tTitle').val('');
   $('#tLink').val('');
   $('#dNewsCategory').val('');
   $('#dNews').val('');
   $('#sPages').val('');
   $('#dPages').val('');
   $('.primary-input').removeClass('has-content');
}

function checkDemo() {
   let demoMode = $('#demoMode').val();

   if (demoMode) {
      toastr.warning("For the demo version, you cannot change this", "Warning");
      return false;
   } else {
      return true;
   }
}


