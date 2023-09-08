<div class="row">

   <div class="col-md-6">
      <div class="form-group">
         <label>@lang('site.categories') </label>

         <select name="main_categories" id="categories_select" class="selectize-multiple" style="width: 100%;"
                 onchange="set_hours_and_duration({{$categories}},'categories_select')">
            <option value="">-------------------------</option>
            @isset($categories)
               @foreach ($categories as $category)
                  <option value="{{ $category['id'] }}"
                          @isset ($cours['categorie_id']) 
                           @if ($cours['categorie_id'] == $category['id'])
                           selected
                      @endif
                          @endisset
                  >
                     {{ $category['name'] }}</option>
               @endforeach
            @endisset
         </select>


         <span class="text-danger" id="categories_"></span>
      </div>
   </div>

   <div class="col-md-3" id="grade_col" @isset ($cours)  @else hidden @endisset >
      <div class="col-md-6"><span class="text-warning bb-1">@lang('site.grade')</span></div>
      <div class="col-md-6"><span class="text-warning bb-1" id="grade">@isset ($cours['categorie_id'])   @endisset  </span></div>
   </div>
   <div class="col-md-3" id="level_col" @isset ($cours) @else hidden @endisset>
      <div class="col-md-6"><span class="text-warning bb-1">@lang('site.level')</span></div>
      <div class="col-md-6"><span class="text-warning bb-1" id="level">@isset ($cours['categorie_id'])    @endisset  </span></div>

   </div>

</div>
{{--<div class="row">--}}
{{--    @isset($grade)--}}
{{--        <div class="col-md-6">--}}
{{--            <div class="form-group">--}}

{{--                <div class="form-group">--}}
{{--                    <label>@lang('site.cours') <span class="text-danger">*</span> </label>--}}
{{--                    <select name="grade" id="garde_select" class="selectize-multiple" onchange="set_hours_and_duration({{$grade}})">--}}
{{--                        <option value="">-------------------------------</option>--}}
{{--                        @foreach ($grade as $grades)--}}
{{--                            <option--}}
{{--                                @isset($grade_cours->grade) --}}
{{--                             @if ($grade_cours->grade == $grades->grade) selected="selected" @endif--}}
{{--                           @endisset--}}
{{--                                value="{{ $grades->grade }}">--}}
{{--                                {{ $grades->grade }}--}}
{{--                            </option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--           --}}
{{--            <span class="text-danger" id="grade_"> </span>--}}
{{--        </div>--}}
{{--    @endisset--}}
{{--    @isset($level)--}}
{{--        <div class="col-md-6">--}}
{{--            <div class="form-group">--}}

{{--                <div class="form-group">--}}
{{--                    <label>@lang('site.level')<span class="text-danger">*</span> </label>--}}
{{--                    <select name="level" class="selectize-multiple" style="width: 100%;">--}}
{{--                        <option value="">-------------------------------</option>--}}
{{--                        @foreach ($level as $levels)--}}
{{--                            <option--}}
{{--                                @isset($level_cours->level) --}}
{{--                                @if ($level_cours->level == $levels->level) selected="selected" @endif--}}
{{--                            @endisset--}}
{{--                                value="{{ $levels->level }}">--}}
{{--                                {{ $levels->level }}--}}
{{--                            </option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--          --}}
{{--            <span class="text-danger" id="level_"> </span>--}}
{{--        </div>--}}
{{--    @endisset--}}
{{--</div>--}}{{-- end of row level and grade --}}
<div class="row">
   <div class="col-md-6">
      <div class="form-group">
         <label>@lang('site.nb of hours total for cours') </label>
         <input name="total_hours" class="form-control" type="number"
                @isset($cours->total_hours)
                value="{{ $cours->total_hours }}"
                @endisset
                id="total_hours">

         <span class="text-danger" id="total_hours_"> </span>
      </div>
   </div>
   <div class="col-md-6">
      <div class="form-group">
         <label>@lang('site.duration') </label>
         <input name="duration" class="form-control" type="number" id="duration"
                @isset($cours->duration)
                value="{{ $cours->duration }}"
            @endisset>

         <span class="text-danger" id="duration_"> </span>
      </div>
   </div>

</div>
