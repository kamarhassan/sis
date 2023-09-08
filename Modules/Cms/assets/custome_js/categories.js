function readURL(input, prev_id, block_id_contaner) {
   //  console.log(input);
    // console.log(prev_id);
    $('#' + block_id_contaner).attr("hidden", false);
    $('#global_image_view').attr("hidden", true);
   
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        $('#' + prev_id).attr("hidden", false);
        reader.onload = function(e) {
            $('#' + prev_id)
                .attr('src', e.target.result)
                .width(150)
                .height(150);
        };

        reader.readAsDataURL(input.files[0]);
    }

}


function resetInput(input, block_id_contaner) {
    // console.log(prev_id);
    $('#' + input).val(null);
    //  document.getElementById("'"+input+"'").value = '';
    $('#' + block_id_contaner).attr("hidden", true);
}



function previewMultiple(event, file_id) {
    $('#all_img_callery').replaceWith('<div class="row col-md-12" id="all_img_callery">');

    var saida = document.getElementById(file_id);
    var quantos = saida.files.length;
    var i = 0;
    for (; i < quantos; i++) {
        var urls = URL.createObjectURL(event.target.files[i]);


        html = '<div id="callery_' + i + '_" class="img_cont">';
        html += '<img id="calery_' + i + '" src="' + urls + '" alt="your image" width="150px" height="150px" />';
        html += '<a onclick="reset(\'event\',' + i + ',\'calleries\')" class="btn_remove">';
        html += '<i class="la la-close"></i></a></div>';
        document.getElementById("all_img_callery").innerHTML += html;
        html = "";
    }
}

function FileListItems(files) {
    var b = new ClipboardEvent("").clipboardData || new DataTransfer()
    for (var i = 0, len = files.length; i < len; i++) b.items.add(files[i])
    return b.files
}

function reset(event, img_id, input_file_id) {
    
   $('#for_callery').prop("hidden",true);
   $('#spinner_loading').prop("hidden",false);

    var saida = document.getElementById(input_file_id);
    var quantos = saida.files.length;
  
    const new_file = new Array();
    for (i = 0; i < quantos; i++) {
        if (i == img_id){

            new_file.push(saida.files[i]);
        }
    }
    
    
    saida.files = new FileListItems(new_file);
    
    $('#callery_' + img_id + '_').remove();  
 
    $('#for_callery').prop("hidden",false);
   $('#spinner_loading').prop("hidden",true);
}


