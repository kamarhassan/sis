{{-- <div class="modal fade text-start bs-example-modal-scrollable" tabindex="-1" role="dialog"
    aria-labelledby="scrollableModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">

            <div class="modal-body">
                
                adasdasd
                sdasd
                asd
                as
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>--}}

<div class="modal fade text-start bs-example-modal-scrollable" tabindex="-1" role="dialog" aria-labelledby="scrollableModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
         <div class="modal-header">
            {{-- <h4 class="modal-title" id="myModalLabel">Modal Heading</h4> --}}
            <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-hidden="true"></button>
         </div>
         <div class="modal-body">
            <form id="reply_comment">
               @csrf
               <div class="text-center" style="padding: 50px;">
                   <textarea class="form-control" name="comment_replay" id="comment_replay" autocomplete="off" spellcheck="false"></textarea>
               </div>
               <input type="hidden" name="parent_id" id="parent_id">
               <input type="hidden" name="comment_id" id="comment_id">
               <input type="hidden" name="blog_id" id="blog_id" value="{{ $blog['id'] }}">
               <input type="hidden" name="id" id="id" value="">

              
               <span id="comment_replay_" class="text-danger"></span>
           </form>
         </div>
         <div class="modal-footer">
            {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button> --}}


            @if (Auth::check())       
                
                <a class="button" type="button" class="btn btn-primary"
                    onclick="reply_comment('{{ route('cms.web.front.comment.replay') }}','reply_comment')">@lang('site.write comment')</a>
            
        @else 
               
                <a class="button" href="{{ route('login') }}">@lang('site.you must be login to write comment')</a>
            
        @endif
         </div>
      </div>
   </div>
</div>