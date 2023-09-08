<div class="row">
   <div class="col-lg-4 text-center">
      @isset($category['tag'])
         <div>
            @foreach ($category['tag'] as $tag)
               
               <a href="{{route('show.related.category.of.tag',$tag['grade'])}}" class="badge bg-color bg h-bg-dark h-text-light all-ts py-2 px-3"
                  style="background-color:#83B341 ">{{ $tag['grade'] }}
               </a>
            @endforeach
         </div>
      @endisset
   </div>
</div>
