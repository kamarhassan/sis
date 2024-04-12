
function slider(url, img_id) {
   $.ajax({
      url: url,
      type: "GET",
      cache: false,

      success: function (data) {
         var slider = data.slider
         var count = slider.length;
         remove_empty_div('slider_element', count)
         // console.log(slider);
         var i = 0;
         slider.forEach(element => {
            ImageToSlide(element, i, img_id);
            TaretToSlide("image_target", i);
            i++;
         });

         return false;
      }, error: function reject() {
         remove_empty_div('slider_element', 0)
      }

   });
}

function ImageToSlide(data, i, img_id) {
   var img = data['image'];

   var link_label = data['link_label'];
   var link = data['link'];

   var description = data['description'];

   data['link_label'] != null ? link_label = data['link_label'] : link_label = ''
   data['link'] != null ? link = data['link'] : link = '#'
   data['description'] != null ? description = data['description'] : description = ''

   i === 0 ? html = '<div class="carousel-item active">' : html = '<div class="carousel-item ">'

   html += '<img src="' + img + '  " alt="First slide">'
   html += '<div class="carousel-caption">'

   if (link != '#')
      html += '<a href="' + link + '" target="_blank"  ><h3 class="btn btn-outline-success">' + link_label + '</h3></a>'
   html += '<p>' + description + '</p>'
   html += '</div>'
   html += '</div>'

   $("#" + img_id).append(html).html();
   html = "";
}

function TaretToSlide(image_target, i) {
   i === 0 ? html = '<li data-target="#carousel-example-caption" data-slide-to="' + i + '" class="active"></li>' : html = '<li data-target="#carousel-example-caption" data-slide-to="' + i + '" ></li>'

   $("#" + image_target).append(html);
}


function remove_empty_div(element_id, count) {
   if (count == 0)
      $('#' + element_id).remove();
}


function ProductSlider(url, img_id) {

   $.ajax({
      url: url,
      type: "GET",
      cache: false,
      success: function (data) {
         var categories = data.categories;
         // ImgProductSlider(categories, img_id);
         $("#" + img_id).append(categories).html();
         $("#" + img_id).owlCarousel({
            autoPlay: 3000, //Set AutoPlay to 3 seconds
            navigation: true,
            navigationText: ["<", ">"],
            pagination: true,
            items: 4,
            itemsDesktop: [1199, 3],
            itemsDesktopSmall: [979, 3]

         });
         return false;
      }, error: function reject() {
         remove_empty_div('slider_element', 0)
      }

   });
}



function allcours(url, coursdivid) {
   var html = '';
   $.ajax({
      url: url,
      type: "GET",
      cache: false,
      success: function (data) {
         var cours = data.cours;
         var opentoread = data.cours_details
         cours.forEach(element => {
            console.log(element);

            // html += '<div class="col-md-4">';
            // html += '<div class="card pull-up" style="text-align: center">';
            // html += '<div class="card-header bg-hexagons">';
            // html += '<h4 class="card-title">' + element['name'] + '\t<span class="warning">' + element['duration'] + ' : hours</span></h4>';
            // html += '<a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>';
            // html += '</div>';
            // html += '<div style="text-align: center">';
            // html += '<img src="' + element['global_image'] + '" width="250px" alt="">';
            // html += '</div>';
            // html += '<p>' + element['shorte_description'] + '</p>';
            // html += '<a href="' + element['route'] + '">';
            // html += '<i class="icon-book-open">' + opentoread + '</i>';
            // html += '</a>';
            // html += '</div>';
            // html += '</div>';





            html += '<div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">';
            html += '<div class="courses-bx-2 m-b30">';
            html += '<img src="' + element['global_image'] + '" alt="">';
            html += '<div class="info">';
            html += '<h2 class="title"> ' + element['name'] + '\t</h2><h5><span class="text-warning">' + element['duration'] + ' : hours</span></h5>';
            html += '<a href="' + element['route'] + '"</a>';

            html += '<p>' + element['shorte_description'] + '</p>';
            html += '<i class="icon-book-open">' + opentoread + '</i>';
            html += '</div>';
            html += '</div>';
            html += '</div>';












            $('#' + coursdivid).append(html).html();
            html = '';
         });
      }, error: function reject() {
         // remove_empty_div('slider_element', 0)
      }

   });
}




function searche_by_barcode(route_, form_id) {
   // var formdata = $("#" + form_id).serializeArray();
   var formdata = new FormData($("#" + form_id)[0]);

   // console.log(formdata);
   clear_searche_by_barcode();
   $.ajax({
      enctype: 'multipart/form-data',
      type: 'POST',
      url: route_,
      data: formdata,
      processData: false,
      contentType: false,
      cache: false,
      success: function (data) {
         if (data.status == 'success') {
            $("#certificate").append(data.final_template).html();
            $(".mark_table").append(data.mark).html();
         } else {
            if (data.status == 'error') {
               $("#certificate").append('<span class="text-danger">' + data.message + '</span>').html();
            }
         }
      }, error: function reject(reject) {
         var response = $.parseJSON(reject.responseText);
         $.each(response.errors, function (key, val) {
            let t = key.replace('.', '_');
            console.log(t + '_');
            $('#' + t + '_').text(val[0]).html;
         })
      }
   });
}


function clear_searche_by_barcode() {
   $('#certificate').replaceWith('<div id="certificate"></div>')
}


function submit(route_, form_id) {

   var formdata = $("#" + form_id).serializeArray();
   //  console.log(formdata);
   $.ajax({
      type: 'POST',
      url: route_,
      data: formdata,
      success: function (data) {
         if (data.status == 'success') {
           
            toastr.success(data.message)
            $('#btn_register').replaceWith(data.btn);
         } else {
            if (data.status == 'error') {
               toastr.error(data.message);
            }
         }
         
         if (data.hasOwnProperty('route')) {
            // Redirect to the route specified in data
            window.location.href = data.route;
         console.log(data.route);
           // Prevent further execution of code after redirection
        }
    
      }, error: function reject(reject) {
         var response = $.parseJSON(reject.responseText);
         $.each(response.errors, function (key, val) {
            let t = key.replace('.', '_');
            console.log(t);
            if(t == "teach_type"){
               $('.teach_type').removeClass('btn-outline-secondary').addClass('btn-outline-danger');
            }
            $('#' + t + '_').text(val[0]).html;
         })
      }
   });
}




function submit_redirect(route_, form_id) {
  
   var formdata = new FormData($("#" + form_id)[0]);

    
   spinner_show()
  
   $.ajax({
      enctype: 'multipart/form-data',
      type: 'POST',
      url: route_,
      data: formdata,
      processData: false,
      contentType: false,
      cache: false,
      success: function (data) {
         spinner_hide();
         if (data.status == 'success') {
            toastr.success(data.message)
            window.location.href = data.route;
         } else {
            if (data.status == 'error') {
               toastr.error(data.message);
            }
         }
      }, error: function reject(reject) {
         spinner_hide();
         var response = $.parseJSON(reject.responseText);
         $.each(response.errors, function (key, val) {

            let t = key.replace('.', '_');
            console.log(t + '_');
            $('#' + t + '_').text(val[0]).html;
         })
      }
   });
}

function spinner_show() {
 
   $("div.spanner").addClass("show");
   $("div.overlay").addClass("show");
}

function spinner_hide() {
   $("div.spanner").removeClass("show");
   $("div.overlay").removeClass("show");

}