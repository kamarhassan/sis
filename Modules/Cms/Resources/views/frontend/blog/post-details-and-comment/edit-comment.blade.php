<div class="modal fade text-start bs-example-modal-edit-scrollable modal_tohide" tabindex="-1" role="dialog"
    aria-labelledby="scrollableModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                {{-- <h4 class="modal-title" id="myModalLabel">Modal Heading</h4> --}}
                <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <form id="edit_comment">
                    @csrf
                    <input type="hidden" name="id" id="coment_id">
                    <div class="text-center" style="padding: 50px;">

                        <div class="primary_input mb-25">
                            <label class="form-section">@lang('site.name') </label> <span class="text-danger">*</span>
                            <textarea class="form-control" name="comment" id="comment_edit"></textarea>

                            <span id="comment_" class="text-danger"></span>
                        </div>

                    </div>


         

                    {{-- <input type="hidden" name="comment_id" id="comment_id"> --}}



                </form>
            </div>
            <div class="modal-footer">
                <a class="button" type="button" class="btn btn-primary"
                    onclick="reply_comment('{{ route('cms.web.front.comment.post.edit') }}','edit_comment')">@lang('site.write comment')</a>

            </div>
        </div>
    </div>
</div>
