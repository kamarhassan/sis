<div class="row">
   <div class="col-lg-3 mt-30">
      <div class="col-lg-12">
       
         <form method="POST" action="" accept-charset="UTF-8"
               class="form-horizontal" enctype="multipart/form-data" id="footer_section_two_title">

            @csrf
            <input type="hidden" name="key" value="footer_section_two_title">
            <div class=" bg-gradient-warning">
               <div class="main-title">
                  <h3 class="mb-30">
                     {{ __('common.Update') }}
                  </h3>
               </div>
               <div class="add-visitor">
               
                  <div class="row pt-0">
                  </div>
                  <div class="tab-content pt-3">
                     <input type="text" name="setting_value" class="form-control" value="{{$footer['footersectionsetting'][2]['value']}}">

                  </div>
                  <div class="row mt-40">

                     <div class="col-lg-12 text-center tooltip-wrapper"
                          data-title="" data-original-title="" title="">
                        <a  onclick="submit_rediret('{{ route('footerSetting.footer.content-update') }}','footer_section_two_title')" class="btn btn-rounded btn-primary float-right" data-original-title="" title=""><i
                              class="ti-check"></i>@lang('site.save')
                        </a>
                     </div>
                  </div>

               </div>
            </div>
         </form>
      </div>
   </div>
   <div class="col-lg-9 mt-50">
      @if (true)

         <div class="row" class=""">

         <a type="button" class="btn btn-rounded btn-default  hover-success" data-toggle="modal"
                 data-target="#modal-center" onclick="edit_category(2);">
            @lang('site.add new page')
         </a>
   </div>
   @endif
   <div class="QA_section QA_section_heading_custom check_box_table">
      <div class="QA_table">
         <!-- table-responsive -->
         <div class="table-responsive">
            <table id="section-two" class="table table-hover">
               <thead>
               <tr>
                  <th scope="col">{{ __('common.SL') }}</th>
                  <th scope="col">{{ __('common.Name') }}</th>
                  <th scope="col">{{ __('common.Status') }}</th>
                  <th scope="col">{{ __('common.Action') }}</th>
               </tr>
               </thead>
               <tbody>
               @foreach ($SectionTwoPages as $key => $page)
                  <tr>
                     <td>{{ $key + 1 }}</td>
                     <td>{{ $page->name }}</td>
                     <td>
                        @if (true/*permissionCheck('footerSetting.footer.widget-status')*/)
                           <label class="switch_toggle"
                                  for="active_checkbox{{ @$page->id }}">
                              <input type="checkbox"
                                     onchange="statusChange({{ $page }})"
                                     class=""
                                     id="active_checkbox{{ @$page->id }}"
                                     @if (@$page->status == 1) checked @endif
                                     value="{{ @$page->id }}">
                              <i class="slider round"></i>
                           </label>
                        @else
                           {{ $page->status == 1 ? trans('common.Active') : trans('common.Inactive') }}
                        @endif
                     </td>
                     <td>


                        <a token="{{ csrf_token() }}" class="btn  glyphicon glyphicon-trash hover-danger"
                           title="@lang('site.delete')"
                           onclick="delete_by_id('{{ route('footerSetting.footer.widget-delete') }}',{{ @$page->id }},'{{ csrf_token() }}','{{ json_encode(swal_fire_msg_cms()) }}');">
                        </a>
                        {{--                              @endcan--}}
                        {{-- @can('delete cours')--}}
                        <a href="javascript:void(0)"
                           data-toggle="modal"
                           data-target="#editModal"
                           class="btn fa fa-edit"
                           onclick="showEditModal({{ $page }})"></a>
                        {{--   @endcan--}}


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


