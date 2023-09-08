@extends('admin.layouts.master')
@section('title')
   @lang('site.categories')
@endsection
@section('css')
@endsection


@section('content')
   <div id="spinner_loading">
      <div class="loader-wrapper">
         <div class="loader-container">
            <div class="ball-clip-rotate-multiple loader-success">
               <div></div>
               <div></div>
            </div>
         </div>
      </div>
   </div>

   <div id="admin_table" hidden>
      <section id="html">
         <div class="row">
            <div class="col-12">
               <div class="card">

                  <div class="card-content collpase show">
                     <div class="card-body card-dashboard">
                        <p class="card-text">
                           {{-- @can('create certificate')  --}}
                           <a href="{{ route('admin.categories.new') }}" class="btn fa fa-plus">
                              @lang('site.add category')</a>
                           {{-- @endcan --}}
                        </p>
                        <table id="example1" class="table table-striped table-bordered sourced-data">
                           <thead>
                           <tr>
                              <th>@lang('site.categorie name')</th>
                              <th>@lang('site.ralated')</th>
                              <th>@lang('site.nb of hours total for cours')</th>
                              <th>@lang('site.duration')</th>
                              <th>@lang('site.global_image')</th>
                              <th>@lang('site.options')</th>
                           </tr>
                           </thead>
                           <tbody>

                           @isset($categories)
                              @foreach ($categories as $categorie)
                              
                                 <tr id="Row{{ $categorie['id'] }}">
                                    <td>{{ $categorie['name'] }}</td>
                                    <td>
                                       <span class="badge badge-success-light badge-lg" >@lang('site.grade') : {{ $categorie['grade']['grade'] }} </span> 
                                       <span class="badge badge-success-light badge-lg" >@lang('site.level') : {{ $categorie['level']['level'] }} </span> 
{{--                                       @isset ( $categorie['tag']) --}}
{{--                                      @foreach($categorie['tag'] as $key => $value)--}}
{{--                                       <span class="badge badge-success-light badge-lg" > {{   $value['grade']}}</span> <br>--}}
{{--                                      @endforeach--}}
{{--                                    @endisset--}}
                                    </td>
                                    
                                    <td> {{ $categorie['total_hours'] }} </td>
                                    <td>{{ $categorie['duration'] }}</td>
 
                                    <td><img src="{{ URL::asset($categorie['global_image']) }}" alt="" style="width: 100px;height: 100px;"></td>
                                    <td>
                                       @can('edit certificate')
                                          <a href="{{ route('admin.categories.edit.categories', $categorie['id']) }}"
                                             class="btn fa fa-edit" title="@lang('site.edit')">
                                          </a>
                                       @endcan
                                       @can('delete certificate')
                                          <a title="@lang('site.delete')"
                                             class="btn fa fa-trash  hover-danger"
                                             onclick="delete_by_id('{{ route('admin.categories.delete.categories') }}',{{ $categorie['id'] }},'{{ csrf_token() }}','{{ json_encode(swal_fire_msg()) }}');">
                                          </a>
                                       @endcan
                                    </td>

                                 </tr>
                                 {{-- {!! html_entity_decode($str) !!} --}}
                              @endforeach
                           @endisset
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      {{-- <div class="text-center"> --}}

      {{ $categories->links() }}
      {{-- </div> --}}
   </div>
@endsection
{{-- @include('admin.payment.cours_std') --}}
@section('script')
   <script>
       $(document).ready(function () {
           $('#spinner_loading').css("display", "none");

           $('#admin_table').removeAttr('hidden');

           var table = $('#example1').DataTable({
               scrollY: "400px",
               // searching: false,
               // scrollX: true,
               scrollCollapse: true,
               paging: false,
               info: false,
               responsive: true,
               // ajax: '/test/0',

           });
       });
   </script>
   <script src="{{ URL::asset('assets/custome_js/delete.js') }}"></script>
   <script src="{{ URL::asset('assets/assets/vendor_components/datatable/datatables.min.js') }}"></script>
   <script src="{{ URL::asset('assets/app-assets/js/pages/data-table.js') }}"></script>
   <script src="{{ URL::asset('assets/app-assets/js/fixed_column_datatable.js') }}"></script>

   {{-- <script src="{{ URL::asset('assets/app-assets/js/pages/data-table.js') }}"></script>
   <script src="{{ URL::asset('assets/app-assets/js/fixed_column_datatable.js') }}"></script> --}}
@endsection
