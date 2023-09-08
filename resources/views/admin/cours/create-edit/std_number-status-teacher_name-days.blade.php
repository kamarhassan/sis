<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>@lang('site.max number of students') </label>
            <input name="max_std_number" class="form-control" type="number"
                @isset($cours->maxStd) 
                value="{{ $cours->maxStd }}"
            @endisset
                id="example-date-input">
            
                <span class="text-danger" id="max_std_number_"></span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            @isset($status_od_cours)
                <label>@lang('site.status of cours') <span class="text-danger">*</span> </label>
                <select name="status" class="selectize-multiple" style="width: 100%;">
                    @isset($cours->status)
                        <option selected="selected" value="{{ $cours->status }}">

                            {{ $cours->status }}</option>
                           @else <option value="">-------------</option>
                    @endisset
                    @foreach ($status_od_cours as $status_od_cour)
                        <option value="{{ $status_od_cour->name }}">
                            {{ $status_od_cour->name }}
                        </option>
                    @endforeach
                </select>
             
                <span class="text-danger" id="status_"></span>
            @endisset
        </div>
    </div>
</div>


<div class="row">
    @isset($teacher)
        <div class="col-md-6">
            <div class="form-group">
                <div class="form-group">
                    <label>@lang('site.teacher name') <span class="text-danger">*</span> </label>
                    <select name="teacher_name" class="selectize-multiple" style="width: 100%;">
                      <option value="">-------------</option>
                        @foreach ($teacher as $teachers)
                            <option value="{{ $teachers->name }}"
                                @isset($cours->teacher_id)   @if ($teachers->id == $cours->teacher_id) selected="selected" @endif @endisset>
                                {{ $teachers->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
          
            
            <span class="text-danger" id="teacher_name_"></span>
        </div>
    @endisset

    {{-- <div class="col-md-2">
        <div class="form-group">
            <div class="form-group">
                <label>@lang('site.can teacher add students') </label>
                <div class="demo-checkbox">
                    <fieldset>
                        <div class="float-left">
                            <input type="checkbox" name="teacher_can_add_std" value='1'
                                class="switchBootstrap fee_"
                                 @isset($cours['teacher_can_add_students'])
                                    @if ($cours['teacher_can_add_students'] ==1)
                                        checked
                                    @endif
                                @endisset id="md_checkbox_" data-on-text="@lang('site.yes')"
                                data-off-text="@lang('site.NO')" />
                        </div>
                        <label for="md_checkbox_" class="font-medium-2 text-bold-600 mr-1 text-success"></label>
                        <label for="md_checkbox_"></label>
                     
                        <span class="text-danger" id="teacher_can_add_std_"></span>
                    </fieldset>
                </div>
            </div>
        </div>
    </div> --}}


    <div class="col-md-6">
        <div class="form-group">
            <label>@lang('site.all days') <span class="text-danger">*</span> </label>
            <select name="days[]" id="choose_day_of_cours" multiple class="selectize-multiple" style="width: 100%;">

                @foreach (days_of_week() as $key => $days)
                  
                    <option value={{ $key }}  @isset($cours['days'])  @if (Str::contains($cours['days'], $days)) selected @endif  @endisset>
                        {{ $days }}
                    </option>
                  
                @endforeach

            </select>
        
            <span class="text-danger" id="days_"></span>
        </div>
    </div>

</div>
<div class="row">

{{--    <div class="col-md-6">--}}
{{--        <div class="form-group">--}}
{{--            <label>@lang('site.categories') </label>--}}

{{--            <select name="categories[]" class="selectize-multiple" multiple style="width: 100%;">--}}
{{--                <option value="">-------------------------</option>--}}
{{--                @isset($categories)--}}
{{--                    @foreach ($categories as $category)--}}
{{--                        <option value="{{ $category['id'] }}"--}}
{{--                            @isset($cours['categories_id'])--}}
{{--                            @foreach ($cours['categories_id'] as $categorie)--}}
{{--                                @if ($categorie['id'] == $category['id'])--}}
{{--                                    selected--}}
{{--                                @endif--}}
{{--                            @endforeach--}}
{{--                        @endisset>--}}
{{--                            {{ $category['name'] }}</option>--}}
{{--                    @endforeach--}}
{{--                @endisset--}}
{{--            </select>--}}
{{--           --}}
{{--            --}}
{{--            <span class="text-danger" id="categories_"></span>--}}
{{--        </div>--}}
{{--    </div>--}}
    <div class="col-md-6">
        <div class="form-group">
            <label>@lang('site.institue branch') </label>

            <select name="institue_informations[]" class="selectize-multiple" multiple style="width: 100%;">
                <option value="">-------------------------</option>
                @isset($institue_informations)
                    @foreach ($institue_informations as $institue_information)
                        <option value="{{ $institue_information['id'] }}"
                            @isset($cours['institue_information_id'])
                            @foreach ($cours['institue_information_id'] as $institue)
                                @if ($institue['id'] == $institue_information['id'])
                                    selected
                                @endif
                            @endforeach
                        @endisset>
                            {{ $institue_information['name'] }}</option>
                    @endforeach
                @endisset

            </select>
       
            <span class="text-danger" id="institue_informations_"></span>
        </div>
    </div>
</div>
