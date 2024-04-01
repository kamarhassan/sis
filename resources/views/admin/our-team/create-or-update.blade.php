@extends('admin.layouts.master')
@section('title')
@endsection
@section('css')
@endsection
@section('content')
   <div class="box">
      @can('add team')
         <div class="row">
            <div class="col-lg-12 col-12">
               <div class="box">
                  <div class="box-header with-border">
                     <h4 class="box-title"></h4>
                  </div>
                  <!-- /.box-header -->
                  <form class="form" id="add_or_update_team">
                     @csrf
                    
                     <div class="box-body">
                        <h4 class="box-title text-info"><i class="ti-user mr-15"></i>
                          {{-- @lang('site.information')--}}</h4>
                        <hr class="my-15">

                        <div class="row">


                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>@lang('site.employee')<span class="text-danger">*</span></label>
                                 <select class="form-control select2" name="instructor" id="instructor"
                                         class="form-control select2" style="width: 100%;">
                                    <option>----------</option>
                                    @isset($admin)
                                       @foreach ($admin as $admin_to_add)
                                          <option value="{{ $admin_to_add['id'] }}"
                                                  @isset($team['instructor'])  @if ($team['instructor'] == $admin_to_add['id']) selected @endif @endisset>
                                             {{ $admin_to_add['name'] }} </option>
                                       @endforeach
                                    @endisset

                                 </select>
                                 <span class="text-danger" id="instructor_"></span>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>@lang('site.role')<span class="text-danger">*</span></label>
                                 <input type="text" class="form-control" name="role" id="role"
                                          style="width: 100%;">
                                    
                              </div>
                              <span class="text-danger" id="role_"></span>
                           </div>

                           <div class="col-md-9">
                              <div class="form-group">
                                 <h5>@lang('site.short desciprtion') <span class="text-danger">*</span></h5>
                                 <div class="controls">
                                                <textarea name="shortdescription" id="shortdescription"
                                                          class="form-control" required="" placeholder="Textarea text"
                                                          aria-invalid="false" style="height: 69px;">@isset($team)
                                                      {{ $team['shortdescription'] }}
                                                   @endisset </textarea>

                                    <div class="help-block"></div>
                                 </div>
                              </div>
                              <span class="text-danger" id="shortdescription_"></span>
                           </div>


                        </div>

                        <div class="row">
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>@lang('site.employee photo') </label>
                                 <input type='file' name="photo" onchange="readURL(this);"/>
                              </div>
                           </div>
                           <span class="text-danger" id="photo_"> </span>
                           <div class="col-md-4">
                              <img id="admin_image_" src="@isset ($team['photo']) 
                                 {{asset($team['photo'])}}
                              @endisset" alt="your image" width="150" height="150"/>
                           </div>
                        </div>
                        <div class="box-footer">
                           <a onclick="submit('{{ route('admin.manage.team.save') }}' ,'add_or_update_team');"
                              type="submit" class="btn btn-rounded btn-primary btn-outline">
                              <i class="ti-save-alt"></i> Save
                           </a>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      @endcan
   </div>
@endsection


@section('script')
   <script type="text/javascript">
       function readURL(input) {
           if (input.files && input.files[0]) {
               var reader = new FileReader();

               $("#admin_image_").attr("hidden", false);
               reader.onload = function (e) {
                   $('#admin_image_')
                       .attr('src', e.target.result)
                       .width(150)
                       .height(150);
               };

               reader.readAsDataURL(input.files[0]);
           }
       }


       function showpassword() {
           var passInput = $("#password");
           if (passInput.attr('type') === 'password') {
               passInput.attr('type', 'text');
           } else {
               passInput.attr('type', 'password');
           }

       }
   </script>


   <script src="{{ URL::asset('assets/custome_js/save_and_redirect.js') }}"></script>
   <script src="{{ URL::asset('assets/assets/vendor_components/select2/dist/js/select2.full.js') }}"></script>
   <script
      src="{{ URL::asset('assets/assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js') }}"></script>
@endsection
