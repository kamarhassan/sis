function setBlogReplyItem(parent_id, comment_id,id) {
 let parentid , commentid = null;
   parent_id === "undefined" ? parentid = "" : parentid = parent_id;
   comment_id === "undefined" ? commentid = "" : commentid = comment_id;


// console.log(parentid +'\n'+commentid);

   $('#parent_id' ).val(parentid);
   $('#comment_id').val(commentid);
   $('#id').val(id);
}
function setBlogEditItem(id) {

   var commentText = $('#comment_p_'+id).text();
   
   $('#comment_edit').val(commentText);
    
   $('#coment_id').val(id);
 
 
}