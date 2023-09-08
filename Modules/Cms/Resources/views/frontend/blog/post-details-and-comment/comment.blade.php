<li class="comment even thread-even depth-1" id="li-comment-1">
   <div id="comment-1" class="comment-wrap">
       <div class="comment-meta">
           <div class="comment-author vcard">
               <span class="comment-avatar">
                   <img alt='Image' src='https://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=60'
                       class='avatar avatar-60 photo avatar-default' height='60' width='60'></span>
           </div>
       </div>
       <div class="comment-content">
           <div class="comment-author">{{ $item['user']['name'] }}  #  {{ $item['id'] }} # parent_id-> {{$parent_id}} ,comment_id-> {{$comment_id}}<span>
              <a href="#" title="Permalink to this comment">
                       {{ $item['create_at'] }}</a></span></div>
           <p id="comment_p_{{ $item['id'] }}"> {{ $item['comment'] }}</p>

           <a class='comment-reply-link'  href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-scrollable" onclick="setBlogReplyItem({{$parent_id}} ,{{ $comment_id }},{{ $item['id'] }})">
               <i class="bi-reply-fill"></i>
           </a>
           <div class="comment-reply-title">
               @isset($item['user'])
                   @if (Auth::check() && $item['user']['id'] == Auth::id())
                       <a class="btn bi-trash text-danger" title="@lang('site.info')"
                           onclick="delete_by_id('{{ route('cms.web.front.comment.delete') }}',{{ $item['id'] }},'{{ csrf_token() }}','{{ json_encode(swal_fire_msg_cms()) }}');">
                       </a>
                   
                       <a class="btn uil-edit-alt text-danger"  href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-edit-scrollable" onclick="setBlogEditItem({{ $item['id'] }})">
                        {{-- <i class="bi-reply-fill"></i> --}}
                    </a>
                   @endif
               @endisset
           </div>
       </div>
       <div class="clear"></div>
   </div>
</li>
