<div class="row col-md-12">
    <div class="form-group col-md-4">
        <label for="email-addr">@lang('site.global image for gategories')</label>
        <fieldset class="form-group">
            <div class="custom-file">
                <input type="file" name="global_image" class="custom-file-input" id="global_image_file_id"
                    onchange="readURL(this,'global_image_prev','global_image_id');">
                <label class="custom-file-label" for="global_image_id">Choose file</label>

            </div>
        </fieldset>
        @isset($categorie['global_image'])
        <div class="img_cont" id="global_image_view" >
            <img id="global_image" src="{{asset($categorie['global_image'])}}" alt="your image" width="150px" height="150px" />
            <a onclick="delete_from_callery_by_id('{{ route('admin.categories.delete.image') }}',{{ $categorie['id'] }},'','global_image_view','{{ csrf_token() }}','{{ json_encode(swal_fire_msg()) }}');" class="btn_remove"><i
                    class="la la-close"></i></a>
        </div>
        @endisset   
        <div class="img_cont" id="global_image_id" hidden>
            <img id="global_image_prev" src="" alt="your image" width="150px" height="150px" />
            <a onclick="resetInput('global_image_file_id','global_image_id')" class="btn_remove"><i
                    class="la la-close"></i></a>
        </div>
        <span class="text-danger" id="global_image_"></span>
    </div>

    <div class="form-group col-md-4">
        <label for="email-addr">@lang('site.attache for gategories')</label>
        <fieldset class="form-group">
            <div class="custom-file">
                <input type="file" name="attache" id="inputGroupFile01">
                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>

                <img id="attac" src="" alt="your image" width="150" height="150" hidden />
            </div>
        </fieldset>
        <span class="text-danger" id="attache_"></span>
    </div>

    <div class="form-group col-md-4">
        <label for="email-addr">@lang('site.url video imbedded')</label>
        <fieldset class="form-group">
            <div class="custom-file">
                <input type="url" name="url_video_imbed" class="form-control"
                @isset($categorie['url_vid_imbeded'] )
                  value="{{$categorie['url_vid_imbeded']}}"  
                @endisset
                >

            </div>
        </fieldset>
        <span class="text-danger" id="url_video_imbed_"></span>
    </div>
    <div id="spinner_loading"   hidden>
        <div class="loader-wrapper">
            <div class="loader-container">
                <div class="ball-clip-rotate-multiple loader-success">
                    <div>  </div>
                    <div></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12" id="for_callery">
        <label for="email-addr">@lang('site.gallery for gategories')</label>
        <fieldset class="form-group">
            <div class="custom-file">

                <input type="file"  name="callery[]" multiple onchange="previewMultiple(event,'calleries')" id="calleries">
                
                <label class="custom-file-label" for="calleries">Choose file</label>

                {{-- <img id="callery" src="" alt="your image" width="150" height="150" hidden /> --}}
            </div>
        </fieldset>
        <div class="row col-md-12" id="all_img_callery_">
            @isset($categorie['callery'])
          @foreach ($categorie['callery'] as $key=> $item) 
              <div class="img_cont" id="global_image_{{$key}}" >
                  <img id="global_image_" src="{{asset($item)}}" alt="your image" width="150px" height="150px" />
                  <a onclick="delete_from_callery_by_id('{{ route('admin.categories.delete.image_from_callery') }}',{{ $categorie['id'] }},'{{$item}}','global_image_{{$key}}','{{ csrf_token() }}','{{ json_encode(swal_fire_msg()) }}');" class="btn_remove">
                    <i class="la la-close"></i></a>
              </div>
          @endforeach
            @endisset 
        <div class="row col-md-12" id="all_img_callery">
           
        </div>
       
       
        <span class="text-danger" id="callery_"></span>
    </div>

</div>
