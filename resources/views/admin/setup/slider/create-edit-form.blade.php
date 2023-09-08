@isset($slider['id'])
    <input type="hidden" name="id" value="{{ $slider['id'] }}">
@endisset

<div class="form-group mt-1">
    <label for="switcherySize13" class="font-medium-2 text-bold-600 mr-1 text-success">@lang('site.activate')</label>
    <input type="checkbox" id="switcherySize13" checked
        @isset($slider['status'])
        @if ($slider['status'] == 1)
        checked                
        @endif
    value="{{ $slider['status'] }}"
       @endisset
        value="1" name="status" class="switchery" data-size="sm" />
    <label for="switcherySize13" class="font-medium-2 text-bold-600 ml-1 text-danger">@lang('site.disactivate')</label>
</div>
<span id="status_" class="text-danger"></span>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <h5>@lang('site.link label') </h5>
            <div class="controls">
                <input type="text" name="link_label" id="link_label" class="form-control"
                    @isset($slider['link_label'])
                                  value="{{ $slider['link_label'] }}" 
                               @endisset>
            </div>
        </div>
        <span class="text-danger" id="link_label_"> </span>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <h5>@lang('site.url link') </h5>
            <div class="controls">
                <input type="url" name="link" id="link" class="form-control"
                    @isset($slider['link'])
                               value="{{ $slider['link'] }}" 
                               @endisset>
            </div>
        </div>
        <span class="text-danger" id="link_"> </span>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <h5>@lang('site.slider image') <span class="text-danger">*</span></h5>
            <div class="controls">
                <div class="custom-file">
                    <input type="file" onchange=" readURL(this);" name="image" id="image_id" class="form-control"
                        @isset($slider['image'])
                               value="{{ $slider['image'] }}" 
                               @endisset>
                    <label class="custom-file-label" for="image_id">Choose file</label>
                </div>
            </div>

            <img id="image_slide"  alt="your image" 
                @isset($slider['image'])
              src="{{asset($slider['image'])}}"
              width="150px" height="150px"
                @else 
                hidden
            @endisset />
        </div>
        <span class="text-danger" id="image_"> </span>
    </div>
   
    <div class="col-md-6">
        <div class="form-group">
            <h5>@lang('site.short desciprtion') </h5>
            <div class="controls">
                <textarea col="3" type="text" name="description" id="description" class="form-control">
               @isset($slider['description'])    {{ $slider['description'] }}  @endisset
                </textarea>
            </div>
        </div>
        <span class="text-danger" id="description_"> </span>
    </div>


</div>


<div class="row">
    <label class="label-control" for="googlemaplocation"></label>
</div>
