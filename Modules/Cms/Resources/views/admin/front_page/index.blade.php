@extends('admin.layouts.master')
@section('title')
   @lang('site.front page')
@endsection
@php
   $table_name='front_pages'
@endphp
@section('table')
   {{$table_name}}
@stop
@section('css')
   
   <link rel="stylesheet" type="text/css"
         href="{{ URL::asset('Modules/Cms/assets/datatable/datatables.css') }}">
   @endsection
@section('content')
   <div class="box">
      {{--   <section class="sms-breadcrumb mb-20 white-box">--}}
      {{--      <div class="container-fluid">--}}
      {{--         <div class="row justify-content-between">--}}
      {{--            <h1>{{__('site.Pages')}}</h1>--}}
      {{--            <div class="bc-pages">--}}
      {{--               <a href="{{url('dashboard')}}">{{__('dashboard.Dashboard')}}</a>--}}
      {{--               <a href="#">{{__('site.Frontend CMS')}}</a>--}}
      {{--               <a href="{{ route('frontend.page.index')}}">{{__('site.Pages')}}</a>--}}
      {{--            </div>--}}
      {{--         </div>--}}
      {{--      </div>--}}
      {{--   </section>--}}
      <section class="admin-visitor-area up_st_admin_visitor">
         <div class="container-fluid p-0">

            <h4 class="pl-4 mb-3">
               <div class="row justify-content-start  pr-4">
                  @can('create page')
                     <a href="{{ route('cms.admin.page.create') }}" class="btn small fix-gr-bg">
                        <span class="ti-plus"></span>


                        @lang('site.add page')
                     </a>
                  @endcan
               </div>
            </h4>
            <div class="col-lg-12">
               <div class="QA_section QA_section_heading_custom check_box_table">
                  <div class="QA_table">
                     <!--  -->
                     <div class="table-responsive">
                        <table id="example1" class="table table-hover">
                           <thead>backend.status

                           <tr>
                              <th width="15%">{{__('site.page title')}}</th>
                              <th width="15%">{{__('site.slug')}}</th>

{{--                              <th width="15%">{{__('site.status')}}</th>--}}
                              <th width="15%">{{__('site.options')}}</th>
                           </tr>
                           </thead>


                           <tbody>
                           @foreach($frontPages as $value)

                              <tr id="Row{{$value->id}}">

                                 <td> {{ Str::limit($value->title,30) }}
{{--                                    @if($value->homepage==1)--}}
{{--                                       <b>--}}
{{--                                          <small>--}}
{{--                                             ({{__('site.Homepage')}})--}}
{{--                                          </small>--}}
{{--                                       </b>--}}
{{--                                    @endif--}}
                                 </td>
                               
                                 <td> {{ Str::limit($value->slug,30) }}</td>
{{--                                 <td>--}}

{{--                                    --}}{{--@can('')--}}

{{--                                    <div class="box-controls pull-left">--}}
{{--                                       <label class="switch switch-border switch-success">--}}
{{--                                          <input type="checkbox" value="1" name="active" id="active"--}}
{{--                                                 onchange="change_status('{{ route('admin.edit.status.attendance', [$datas['cours_id'], $datas['date']]) }}','{{ 'attendance_' . $datas['cours_id'] }}');"--}}
{{--                                                 @if ($value->status == 1) checked @endif />--}}
{{--                                          <span class="switch-indicator"></span>--}}
{{--                                    --}}

{{--                                       </label>--}}
{{--                                       <span class="text-danger" id="active_"> </span>--}}
{{--                                    </div>--}}


{{--                                 </td>--}}
                                 <td>


                                    <div class="dropdown CRM_dropdown">
                                       <a class="btn btn-rounded btn-outline btn-success dropdown-toggle"
                                               type="button"
                                               id="dropdownMenu2" data-toggle="dropdown"
                                               aria-haspopup="true" aria-expanded="false">
                                          {{ __('site.select') }}

                                       </a>
                                       <div class="dropdown-menu dropdown-menu-right"
                                            aria-labelledby="dropdownMenu2">
                                          <a class="dropdown-item" target="_blank"
                                             href="{{ $value->is_static!=1?url($value->slug):url($value->slug)}}"> {{__('site.view')}}</a>
                                          @if(true/*permissionCheck('frontend.page.edit')*/)
                                             <a class="dropdown-item"
                                                href="{{ route('cms.admin.page.edit',$value->id)}}"> {{__('site.edit')}}</a>
                                             @if(hasDynamicPage())
                                                <a class="dropdown-item" target="_blank"
                                                   href="{{ route('cms.admin.page.show',$value->id)}}"> {{__('site.design')}}</a>
                                             @endif
                                          @endif
                                          @if(true/*permissionCheck('frontend.page.delete')*/)
                                             @if($value->is_static!=1)


                                                <a class="dropdown-item"  class="btn   hover-danger"
                                                   title="@lang('site.delete')"
                                                   onclick="delete_by_id('{{ route('cms.admin.page.destroy') }}',{{$value->id }},'{{ csrf_token() }}','{{ json_encode(swal_fire_msg_cms()) }}');">{{__('site.delete')}}
                                                </a>
                                              
                                              
                                             @endif
                                          @endif

{{--                                          @if(true/*permissionCheck('frontend.page.changeHomepage')*/)--}}
{{--                                             @if($value->homepage!=1)--}}
{{--                                                <a href="--}}{{--{{route('frontend.page.changeHomepage',$value->id)}}--}}{{--"--}}
{{--                                                   class="dropdown-item ">{{__('site.Make It Homepage')}}</a>--}}
{{--                                             @endif--}}
{{--                                          @endif--}}
                                       </div>
                                    </div>


                                 </td>


                              </tr>

                           @endforeach
                           </tbody>


                        </table>

                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <div class="modal fade admin-query" id="deleteItem">
         <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
               <div class="modal-header">
                  <h4 class="modal-title">{{__('site.Delete')}} {{__('site.Page')}}</h4>
                  <button type="button" class="close"
                          data-dismiss="modal" style="color: #000">
                     &times;
                  </button>
               </div>
               <div class="modal-body">
                  <div class="text-center">
                     <h4>{{__('footer.Are you sure')}}?</h4>
                  </div>
                  <div class="mt-40 d-flex justify-content-between">
                     <button type="button" class="primary-btn tr-bg"
                             data-dismiss="modal">{{__('footer.Cancel')}}
                     </button>
                     <form action=""
                           method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit" class="primary-btn fix-gr-bg"
                               value="Delete"/>
                     </form>
                  </div>
               </div>

            </div>
         </div>
      </div>


      {{--   @include('cms::admin.front_page.add-page')--}}
   </div>
@endsection

@section('script')


  
   
   
   <script>
       $(document).ready(function () {
           
       $('#example1').DataTable({
           // "order": [ 0, 'asc' ]
           "order": ['0', 'desc'], // nb four is column status,
           responsive: true,
           scrollY: "400px",
           // searching: false,
           scrollX: true,
           scrollCollapse: false,
           paging: false,
       });
       });
      
      
      
       $(document).on("click", ".deleteBtn", function (e) {
           e.preventDefault();
           let url = $(this).data('url');
           console.log(url);
           $('#deleteItem').find('form').attr('action', url);
       });


       function convertToSlug(Text) {
           return Text
               .toLowerCase()
               .replace(/ /g, '-')
               .replace(/[^\w-]+/g, '')
               ;
       }
   </script>
   <script src="{{ URL::asset('assets/assets/vendor_components/datatable/datatables.min.js') }}"></script>
   <script src="{{ URL::asset('assets/app-assets/js/pages/data-table.js') }}"></script>
   <script src="{{ URL::asset('Modules/Cms/assets/custome_js/delete.js') }}"></script>
@endsection
