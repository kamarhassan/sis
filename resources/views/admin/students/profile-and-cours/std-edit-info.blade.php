@extends('admin.layouts.master')
@section('css')
   <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/selectize/css/selects/selectize.css') }}">
   <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/selectize/css/selects/selectize.default.css') }}">
   <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/selectize/css/selectize/selectize.css') }}">

   <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/switcher/css/bootstrap-switch.min.css') }}">
   <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/switcher/css/switchery.min.css') }}">
@endsection
@section('content')
   {{-- <div class="wrapper"></div>z --}}

   <div class="row">
      <div class="col-lg-12 col-12">
         <div class="box">
            <div class="box-header with-border">
               <h4 class="box-title"></h4>
            </div>
            <!-- /.box-header -->
            <form class="form" id="user_profile">
               @csrf
               <input type="hidden" id="id" name="id"
                      value="@isset($user['id']){{ $user['id'] }} @endisset">
               <div class="box-body">
                  <h4 class="box-title text-info"><i class="ti-user mr-15"></i>
                     @lang('site.personal information')</h4>
                 

                  <hr class="my-15">

                  <div class="row">
                     <div class="col-md-4">
                        <div class="form-group">
                           <label>@lang('site.First Name')<span class="text-danger">*</span></label>
                           <input type="text" name="first_name" class="form-control"
                                  placeholder="@lang('site.First Name')"
                                  value="@isset($user['firstname']) {{ $user['firstname'] }} @endisset">
                        </div>
                        <span class="text-danger" id="first_name_"> </span>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group">
                           <label>@lang('site.Middle Name')<span class="text-danger">*</span> </label>
                           <input type="text" name="middle_name" class="form-control"
                                  placeholder="@lang('site.Middle Name')"
                                  value="@isset($user['midname']){{ $user['midname'] }}  @endisset">
                        </div>
                        <span class="text-danger" id="middle_name_"> </span>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group">
                           <label>@lang('site.Last Name')<span class="text-danger">*</span></label>
                           <input type="text" name="last_name" class="form-control"
                                  placeholder="@lang('site.Last Name')"
                                  value="@isset($user['lastname']) {{ $user['lastname'] }} @endisset">
                        </div>
                        <span class="text-danger" id="last_name_"> </span>
                     </div>
                  </div>


                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>@lang('site.E-mail')<span class="text-danger">*</span></label>
                           <input type="text" name="email" class="form-control"
                                  placeholder="@lang('site.E-mail') "
                                  value="@isset($user['email']) {{ $user['email'] }}  @endisset">
                        </div>
                        <span class="text-danger" id="email_"> </span>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>@lang('site.phone')<span class="text-danger">*</span></label>
                           <input type="text" name="phonenumber" class="form-control"
                                  placeholder="@lang('site.phone') "
                                  value="@isset($user['phonenumber']) {{ $user['phonenumber'] }} @endisset">
                        </div>
                        <span class="text-danger" id="phonenumber_"> </span>
                     </div>
                     {{-- <div class="col-md-4">
                  <div class="form-group">
                      <label>@lang('site.password')<span class="text-danger"></span></label>
                      <input type="password" id="password" name="password" class="form-control"
                         placeholder="@lang('site.password')">

                      <span class="text-danger" id="password_"> </span>
                  </div>
              </div> --}}
                  </div>

                  <div class="row">
                     <div class="col-md-3">
                        <div class="form-group">
                           <label>@lang('site.students birthday')<span class="text-danger">*</span></label>
                           <input type="date" id="birthday" name="birthday" class="form-control"
                                  placeholder="@lang('site.birthday')" {{-- {{dd($user->birthday)}} --}}
                                  @isset($user['birthday'])  value="{{ $user->birthday }}" @endisset>

                           <span class="text-danger" id="birthday_"> </span>
                        </div>
                     </div>

                     <div class="col-md-3">
                        <div class="form-group">
                           <label>@lang('site.birthday place') : @lang('site.country') <span class="text-danger">*</span></label>
                           <select type="text" id="birthday_place_country"
                                   onchange="area('@lang('site.birthday place')');" name="birthday_place[country]"
                                   class="selectize-multiple">
                              <option value="">----------------</option>
                              @isset($countries)
                                 @foreach ($countries as $country)
                                    @php $country_emoji = json_decode($country['emoji']); @endphp
                                    <option
                                       value="{{ $country['id'] }}" {{-- @if ($country['id'] == $user['birthday_place']['country']) selected @endif --}}>
                                       {{ $country['name'] }}
                                    </option>
                                 @endforeach
                              @endisset
                           </select>
                           <span class="text-danger" id="birthday_place_country_"> </span>
                        </div>
                     </div>
                     <div class="col-md-3" id="area">
                      
                           <div class="form-group">
                              <label>@lang('site.birthday place') <span class="text-danger">*</span></label>

                              <input type="text" id="birthday_place_area" name="birthday_place[area]"
                                     class="form-control" placeholder=""
                                     @isset($user['birthday_place']['area'])  value="{{ $user['birthday_place']['area'] }}"   @endisset>
                              <span class="text-danger" id="birthday_place_area_"> </span>
                           
                           </div>

                     </div>
                  </div>
               <hr class="my-15">

                  @isset($user['teams_info'])
                     <h4 class="box-title text-info"><i class="ti-email mr-15"></i>
                        @lang('site.Your Teams Account') :  </h4>

                     <input type="text" id="teams_account" name="teams_account"
                            class="form-control" placeholder=""
                            value="{{ $user['teams_info']['username']}}">
                     <span class="text-danger" id="teams_account_"> </span>
          
               @endisset
               <hr class="my-15">

                  <div class="row">


                     <span class="text-danger" id="role_"> </span>
                     <div class="col-md-4">
                        <div class="form-group">
                           <label>@lang('site.admin photo') </label>
                      
                           <input type='file' name="photo" onchange="readURL(this);"/>
                        
                        </div>
                     </div>
                     <span class="text-danger" id="photo_"> </span>
                     <div class="col-md-4">
                        @isset( $user['photo'])
                          
                        <img id="admin_image_" src="{{asset($user['photo'])}}" alt="your image" width="150" height="150" />
                        @endisset
                     </div>

                  </div>

              

               @isset($user['id'])
               <div class="box-footer">
                 
                  <a onclick="submit('{{ route('admin.students.post-edit.information') }}' ,'user_profile');" type="submit"
                     class="btn btn-rounded btn-primary btn-outline">
                     <i class="ti-save-alt"></i> Save
                  </a>
               </div>
           
                  <div class="col-md-3">
                     <a type="button" class="btn btn-rounded btn-danger" data-toggle="modal"
                        data-target="#modal-center">
                        @lang('site.change password only')
                     </a>

                  </div>
               @endisset
            </form>
         </div>

      </div>
   </div>
   @isset($user['id'])
      @include('admin.students.profile-and-cours.change-password')
   @endisset
@endsection


@section('script')
   <script type="text/javascript">
       $(document).ready(function () {
           $(`#birthday_place_country option[value='${2}']`).prop('selected', true);
       });


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


       function area(birthplace) {

           // var v = $('#birthday_place').selectize().val();
           html = '<div class="col-md-3" id="area">'
           html = '<div class="form-group">'
           html += '<label>' + birthplace + '<span class="text-danger">*</span></label>'

           html += '<input type="text" id="birthday_place_area" name="birthday_place[area]" class="form-control"'
           html += 'placeholder=>'
           html += '<span class="text-danger" id="birthday_place_area_"> </span>'


           html += '</div></div> '

           $('#area').replaceWith(html).html();
       }
   </script>


   <script src="{{ URL::asset('assets/selectize/js/vendor/select/selectize.min.js') }}"></script>
   <script src="{{ URL::asset('assets/selectize/js/select/form-selectize.min.js') }}"></script>
   <script src="{{ URL::asset('assets/app-assets/js/moment.min.js') }}"></script>
   <script src="{{ URL::asset('assets/custome_js/cours_.js') }}"></script>
   <script src="{{ URL::asset('assets/custome_js/front.js') }}"></script>

   {{-- <script src="{{ URL::asset('assets/assets/vendor_components/select2/dist/js/select2.full.js') }}"></script>
<script src="{{ URL::asset('assets/assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js') }}">
</script> --}}
   <script src="{{ URL::asset('assets/app-assets/js/pages/advanced-form-element.js') }}"></script>




   <script src="{{ URL::asset('assets/switcher/js/bootstrap-switch.min.js') }}" type="text/javascript"></script>
   <script src="{{ URL::asset('assets/switcher/js/bootstrap-checkbox.min.js') }}" type="text/javascript"></script>
   <script src="{{ URL::asset('assets/switcher/js/switchery.min.js') }}" type="text/javascript"></script>
   <script src="{{ URL::asset('assets/switcher/js/switch.js') }}" type="text/javascript"></script>

   <script src="{{ URL::asset('assets/custome_js/save_and_redirect.js') }}"></script>
   <script src="{{ URL::asset('assets/assets/vendor_components/select2/dist/js/select2.full.js') }}"></script>
   <script src="{{ URL::asset('assets/assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js') }}">
   </script>
   <script src="{{ URL::asset('assets/app-assets/js/pages/advanced-form-element.js') }}"></script>
   {{-- <script src="{{ URL::asset('assets/assets/vendor_plugins/input-mask/jquery.inputmask.js') }}"></script>
  <script src="{{ URL::asset('assets/assets/vendor_plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
  <script src="{{ URL::asset('assets/assets/vendor_plugins/input-mask/jquery.inputmask.extensions.js') }}"></script> --}}
@endsection
