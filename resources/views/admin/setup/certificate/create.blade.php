@extends('admin.layouts.master')
@section('title')

@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/app-assets/vendors/css/forms/selects/selectize.css')}}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/app-assets/vendors/css/forms/selects/selectize.default.css')}}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/app-assets/css/plugins/forms/selectize/selectize.css')}}">

@endsection
@section('content')


<section id="form-repeater">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title" id="repeat-form"></h4>
            <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
            <div class="heading-elements">
              <ul class="list-inline mb-0">
                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                {{-- <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li> --}}
                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                {{-- <li><a data-action="close"><i class="ft-x"></i></a></li> --}}
              </ul>
            </div>
          </div>
          <div class="card-content collapse show">
            <div class="card-body">
              <div class="repeater-default">
                <div data-repeater-list="car">
                  <div data-repeater-item>
                    <form id="certificate"    class="form row">
                      @csrf
                      <div class="form-group col-md-4">
                        <label for="email-addr">@lang('site.certificate name')</label>
                        <br>
                        <input type="text" name="certificate" class="form-control" value="{{old('certificate')}}" id="email-addr" >
                    
                        <span class="text-danger" id="certificate_"></span>
                  
                      </div>
                                         
                      <div class="form-group  col-md-4">
                        <label for="profession">@lang('site.grade')</label>
                        <br>
                        @isset ($grades) 
                          <select name="grade" class="selectize-multiple" value="{{old('grade')}}" >
                            <option value="" selected>------------------</option>
                          @foreach ( $grades as $grade )
                              <option value="{{$grade['id']}}" >{{$grade['grade']}}</option>
                          @endforeach
                          </select>
                        @endisset
                    
                   
                   <span id="grade_" class="text-danger"></span>
                   
                      </div>
                      <div class="form-group  col-md-3">
                        <label for="profession">@lang('site.level')</label>
                        <br>
                        @isset ($levels) 
                          <select  name="level[]" class="selectize-multiple" multiple>
                            <option value="" selected>------------------</option>
                           
                          @foreach ($levels as $level)
                              <option value="{{$level['id']}}" >{{$level['level']}}</option>
                          @endforeach
                                 
                          </select>
                        @endisset
                       
                        <span id="level_" class="text-danger"></span>
                     
                      </div>
                      
                      {{-- <div class="form-group col-sm-12 col-md-2 text-center mt-2">
                        <button type="button" class="btn btn-danger" data-repeater-delete> <i class="ft-x"></i> Delete</button>
                      </div> --}}
                     
                    </form>
                    <hr>
                  </div>
                </div>
               
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
 
 {{-- <a href="{{route('admin.certificate.store.certificate')}}" class="la-check">sdc</a> --}}
 <a onclick="submit('{{route('admin.certificate.store.certificate')}}', 'certificate') " class="btn btn-outline-success no-border"><i class="la la-check">@lang('site.save')</i></a>

 @endsection


@section('script')
{{-- <script src="../../../app-assets/vendors/js/forms/select/selectize.min.js" type="text/javascript"></script>
<script src="../../../app-assets/js/core/libraries/jquery_ui/jquery-ui.min.js" type="text/javascript"></script> --}}

<script src="{{ URL::asset('assets/app-assets/vendors/js/forms/select/selectize.min.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/app-assets/js/core/libraries/jquery_ui/jquery-ui.min.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/app-assets/js/scripts/forms/select/form-selectize.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/custome_js/save_and_redirect.js') }}"></script>
{{-- <script src="{{ URL::asset('assets/app-assets/js/scripts/forms/select/form-selectize.js')}}" type="text/javascript"></script> --}}

{{-- <script src="{{ URL::asset('assets/app-assets/vendors/js/forms/repeater/jquery.repeater.min.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/app-assets/js/scripts/forms/form-repeater.js')}}" type="text/javascript"></script> --}}
@endsection
