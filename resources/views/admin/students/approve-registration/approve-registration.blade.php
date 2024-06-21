@extends('admin.layouts.master')
@section('title')
   @lang('site.new registration')
@endsection
@section('css')
   <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/selectize/css/selects/selectize.css') }}">
   <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/selectize/css/selects/selectize.default.css') }}">
   <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/selectize/css/selectize/selectize.css') }}">

   {{-- <link rel="stylesheet" type="text/css"
       href="{{ URL::asset('assets/app-assets/vendors/css/forms/selects/selectize.css') }}">
   <link rel="stylesheet" type="text/css"
       href="{{ URL::asset('assets/app-assets/vendors/css/forms/selects/selectize.default.css') }}">
   <link rel="stylesheet" type="text/css"
       href="{{ URL::asset('assets/app-assets/css/plugins/forms/selectize/selectize.css') }}"> --}}
@endsection

@section('content')
   <section id="html">
      <div class="row">
         <div class="col-12">
            <div class="card">
               <div class="card-header">
                  <h4 class="card-title"></h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                  <div class="heading-elements">
                     <ul class="list-inline mb-0">
                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                     </ul>
                  </div>
               </div>
               <div class="card-content collpase show">
                  <div class="card-body card-dashboard">
                     <h1 class="text-capitalize text-warning text-uppercase text-center  ">
                        <span>@lang('site.registration std step 2')</span>
                     </h1>

                     <form id='registartion_form'>
                        @csrf

                        <input type="hidden" name="teach_type" value="@isset($teach_type['key'] ){{$teach_type['key']}}@endisset">
                                <div class=" box-body">
                        <div class="row">
                           <div class="col-md-3 bb-1 border-success">
                                            <span>
                                                @lang('site.student name') : <span class="">
                                                    @isset($user_info)
                                                     {{ $user_info['name'] }}
                                                  @endisset
                                                </span>
                                            </span>
                              <input type="hidden" name="user_id" id=""
                                     value="{{ $user_info['id'] }}">
                           </div>
                           <div class="col-md-6 bb-1 border-success">
                                            <span>
                                                @lang('site.cours info') :
                                                <span class="">
                                                    @isset($cours_info)
                                                      @if (
                                                          $cours_info['category_grade_level']['grade']['grade'] != '' &&
                                                              $cours_info['category_grade_level']['level']['level'] != '' &&
                                                              $cours_info['teacher_name']['name'] != '')
                                                         {{$cours_info['category_grade_level']['name']}}

                                                       [  {{ $cours_info['category_grade_level']['grade']['grade'] }} - {{ $cours_info['category_grade_level']['level']['level'] }} -
                                                         {{ $cours_info['teacher_name']['name'] }}]
                                                      @endif
                                                      <input type="hidden" name="cours_id" id=""
                                                             value="{{ $cours_info['id'] }}">
                                                   @endisset
                                                </span>
                                            </span>
                           </div>
                           <div class="col-md-3 bb-1 border-success">
                                            <span>
                                                @lang('site.registration date') : <span
                                                  class=" ">{{ date('Y-m-d') }}</span>
                                            </span>
                           </div>
                        </div>
                  </div>
                  <div class="row">
                     <div class="col-md-6 bb-1 border-success text-warning">
                        @isset($teach_type['key'] )
                           <span>@lang('site.teach type')</span>
                           <span>{{$teach_type['key']}}</span>
                        @endisset
                     </div>
                  </div>

                  <div class="row">

                     <div class="col-md-6">
                        <span>Teams Account</span>
                        <input type="text" class="form-control" name="teams_user"
                               @isset($user_info['teams_info']['username'])
                                  value="{{ $user_info['teams_info']['username'] }}"
                           @endisset>
                        <span class="text-danger" id="teams_user_"></span>
                     </div>

                     <div class="col-md-6">
                        <span>@lang('site.note write') </span>
                        <div class="controls">
                           <textarea name="textarea" id="textarea" class="form-control"
                                     placeholder="@lang('site.note write')" aria-invalid="false"> </textarea>
                        </div>
                     </div>

                  </div>


                  <div class="">
                     <div class="box-body">
                        <ul class="nav nav-pills customtab justify-content-center" role="tablist">
                           <li class="nav-item">
                              <a class="nav-link active" data-toggle="tab" href="#fee_no_discount"
                                 onclick="hide_covered_by_sponsore({{ $cours_fee }});"
                                 role="tab">

                                                    <span class="hidden-sm-up">
                                                        <i class="ion-home"></i></span>
                                 <span class="hidden-xs-down">@lang('site.fee no discount')</span>
                              </a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" data-toggle="tab" href="#fee_with_discount"
                                 onclick="show_covered_by_sponsore({{ $cours_fee }});"
                                 role="tab">
                                                    <span class="hidden-sm-up">
                                                        <i class="ion-person"></i></span>
                                 <span class="hidden-xs-down">@lang('site.sponsor/ discount') </span>
                              </a>
                           </li>
                        </ul>

                        <div class="tab-content">
                           <div class="tab-pane active" id="fee_no_discount" role="tabpanel">
                           </div>
                           <div class="tab-pane" id="fee_with_discount" role="tabpanel">
                              <div class="row">

                                 <div class="col-md-3">sponsor:
                                    @isset($sponsor)
                                       <select name="sponsor_id" class="selectize-multiple">
                                          <option value="">------------</option>
                                          @foreach ($sponsor as $sponsors)
                                             <option value="{{ $sponsors['id'] }}">
                                                {{ $sponsors['name'] }}
                                             </option>
                                          @endforeach
                                       </select>
                                    @endisset
                                    <span id="sponsor_id_" class="text-danger"></span>
                                 </div>
                                 <div class="col-md-3">sponsor:
                                    @isset($sponsore_fee_types)
                                       <select name="sponsore_fee_type_id" class="selectize-multiple">
                                          <option value="">------------</option>
                                          @foreach ($sponsore_fee_types as $sponsore_fee_type)
                                             <option value="{{ $sponsore_fee_type['id'] }}">
                                                {{ $sponsore_fee_type['type'] }}
                                             </option>
                                          @endforeach
                                       </select>
                                    @endisset
                                    <span id="sponsore_fee_type_id_" class="text-danger"></span>
                                 </div>


                              </div>
                           </div>

                        </div>
                     </div>
                     <input type="hidden" name="it_has_discount" id="it_has_discount">

                     <br>
                     <br>
                     <div id="select_one_of_fee_1" hidden><span
                           class="text-danger">@lang('site.select one of fees at least')</span>
                     </div>
                     @include('admin.students.approve-registration.cours-fee')


                     <div class="col-md-3">
                        <a class="btn  glyphicon glyphicon-arrow-left hover-success"
                           title="@lang('site.save')"
                           onclick="Issponsored('fee_no_discount','fee_with_discount'),submit('{{ route('admin.approve.new.register') }}','registartion_form');">
                           <span> @lang('site.next step')</span>
                        </a>

                     </div>


                     </form>

                  </div>
               </div>
            </div>
         </div>
      </div>

   </section>
@endsection

@section('script')
   <script src="{{ URL::asset('assets/selectize/js/vendor/select/selectize.min.js') }}"></script>
   <script src="{{ URL::asset('assets/selectize/js/select/form-selectize.min.js') }}"></script>
   <script src="{{ URL::asset('assets/custome_js/sponsor.js') }}"></script>
   <script src="{{ URL::asset('assets/custome_js/save_and_redirect.js') }}"></script>
   {{-- <script src="{{ URL::asset('assets/app-assets/vendors/js/forms/select/selectize.min.js') }}" type="text/javascript">
   </script>
   <script src="{{ URL::asset('assets/app-assets/js/core/libraries/jquery_ui/jquery-ui.min.js') }}"
       type="text/javascript"></script>
   <script src="{{ URL::asset('assets/app-assets/js/scripts/forms/select/form-selectize.js') }}" type="text/javascript">
   </script> --}}
@endsection
