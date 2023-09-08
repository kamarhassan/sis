@extends('admin.layouts.master')
@section('title')
   @lang('site.certificate edit')
@endsection
@section('css')

   <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/selectize/css/selects/selectize.css')}}">
   <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/selectize/css/selects/selectize.default.css')}}">
   <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/selectize/css/selectize/selectize.css')}}">
@endsection
@section('content')


   <section id="form-repeater">
      <div class="row">
         <div class="col-12">
            <div class="card">
               <div class="card-header">
                  <h4 class="card-title" id="repeat-form"></h4>
                  <a class="heading-elements-toggle"><i class="fa fa-ellipsis-h font-medium-3"></i></a>
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
                              <form id="certificate" class="form row">
                                 @csrf
                                 <input type="hidden" name="certificate_id" value="{{$certificate['id']}}">
                                 <div class="form-group col-md-4">
                                    <label for="email-addr">@lang('site.certificate name')</label>
                                    <br>
                                    <input type="text" name="certificate" class="form-control"
                                           value="{{ $certificate['name'] }}" id="email-addr">

                                    <span class="text-danger" id="certificate_"></span>

                                 </div>

                                 <div class="form-group  col-md-4">
                                    <label for="profession">@lang('site.categories')</label>
                                    <br>
                                    @isset ($categories)
                                       <select name="categories[]" class="selectize-multiple" value="{{old('grade')}}"
                                               multiple>
                                          <option value="" selected>------------------</option>
                                          @foreach ( $categories as $category )
                                             <option value="{{$category['id']}}"

                                                     @isset($categorie['certificate_id'])
                                                     @foreach ($categorie['certificate_id'] as $certificate_id)

                                                     @if ($certificate_id == $certificate['id'])  selected @endif

                                                   @endforeach
                                                @endisset


                                             > {{$category['name']}} [ {{$category['grade']['grade']}} # {{$category['level']['level']}}]
                                             </option>





                                          @endforeach
                                       </select>
                                    @endisset


                                    <span id="categories_" class="text-danger"></span>

                                 </div>

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

   <a onclick="submit('{{ route('admin.certificate.save.edit.certificate') }}', 'certificate') "
      class="btn btn-outline-success no-border"><i class="fa fa-check">@lang('site.save')</i></a>

@endsection


@section('script')
   <script src="{{ URL::asset('assets/selectize/js/vendor/select/selectize.min.js') }}"></script>
   <script src="{{ URL::asset('assets/selectize/js/select/form-selectize.min.js') }}"></script>
   <script src="{{ URL::asset('assets/custome_js/save_and_redirect.js') }}"></script>
@endsection
