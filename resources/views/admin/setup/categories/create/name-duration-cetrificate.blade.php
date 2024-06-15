<div class="row col-md-12">

</div>
<div class="row col-md-12">
   <div class="form-group col-md-4">
      <label for="email-addr">@lang('site.cours name')</label> <span class="text-danger">*</span>
      <br>
      <input type="text" name="categorie" class="form-control" id="email-addr"
             @isset($categorie['name'])
             value="{{ $categorie['name'] }}"
         @endisset>
      <span class="text-danger" id="categorie_"></span>
   </div>
   @isset($grade)
      <div class="col-md-4">
         <div class="form-group">

            <div class="form-group">
               <label>@lang('site.grades') <span class="text-danger">*</span> </label>
               <select name="grade" id="garde_select" class="selectize-multiple">
                  <option value="">-------------------------------</option>
                  @foreach ($grade as $grades)
                     <option
                        @isset($categorie->grade_id)
                        @if ($categorie->grade_id == $grades->id) selected="selected" @endif
                        @endisset
                        value="{{ $grades->id }}">
                        {{ $grades->grade }}
                     </option>
                  @endforeach
               </select>
            </div>
         </div>

         <span class="text-danger" id="grade_"> </span>
      </div>
   @endisset
   @isset($level)
      <div class="col-md-4">
         <div class="form-group">

            <div class="form-group">
               <label>@lang('site.level')<span class="text-danger">*</span> </label>
               <select name="level" class="selectize-multiple" style="width: 100%;">
                  <option value="">-------------------------------</option>
                  @foreach ($level as $levels)
                     <option
                        @isset($categorie->level_id)
                        @if ($categorie->level_id == $levels->id) selected="selected" @endif
                        @endisset
                        value="{{ $levels->id }}">
                        {{ $levels->level }}
                     </option>
                  @endforeach
               </select>
            </div>
         </div>

         <span class="text-danger" id="level_"> </span>
      </div>
   @endisset
   <div class="form-group  col-md-4">
      <label for="profession">@lang('site.certificate')</label>

      @isset($certificates)
         <select name="certificate[]" class="selectize-multiple" multiple>
            <option value="" selected>------------------</option>
            @foreach ($certificates as $certificate)
               <option value="{{ $certificate['id'] }}"
                       @isset($categorie['certificate_id'])
                       @foreach ($categorie['certificate_id'] as $certificate_id)
                       
                         @if ($certificate_id == $certificate['id'])  selected @endif
                     
                        @endforeach
                  @endisset>
                  {{ $certificate['name'] }}
               </option>
            @endforeach
         </select>
      @endisset
      <span id="certificate_" class="text-danger"></span>
   </div>


   @isset($grade)
      <div class="col-md-4">
         <div class="form-group">

            <div class="form-group">
               <label>@lang('site.tag') </label>
               <select name="tag[]" id="tag" class="selectize-multiple" multiple>
                  <option value="">-------------------------------</option>
                  @foreach ($grade as $grades)
                     <option
                        @isset($categorie['tag'])

                        @foreach ($categorie['tag'] as $tag)
                        @if ($grades['id'] ==  $tag)  selected @endif
                        @endforeach
                           
                           
                        
                        @endisset
                        value="{{ $grades->id }}">
                        {{ $grades->grade }}
                     </option>
                  @endforeach
               </select>
            </div>
         </div>

         <span class="text-danger" id="grade_"> </span>
      </div>
   @endisset


   <div class="form-group col-md-4">
      <label for="email-addr">@lang('site.nb of hours total for cours')</label><span class="text-danger">*</span>
      <br>
      <input type="text" name="nb_total_hours" class="form-control" id="email-addr"
             @isset($categorie['total_hours'])
             value="{{ $categorie['total_hours'] }}"
           
         @endisset>
      <span class="text-danger" id="nb_total_hours_"></span>
   </div>


   <div class="col-md-4">
      <div class="form-group">
         <label>@lang('site.duration') </label><span class="text-danger">*</span>
         <input name="duration" class="form-control" type="number" id="duration"
                @isset($categorie['duration'])
                value="{{ $categorie['duration'] }}"
            @endisset>

         <span class="text-danger" id="duration_"> </span>
      </div>
   </div>
</div>
