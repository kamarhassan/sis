<div class="modal center-modal fade" id="modal-center" tabindex="-1">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">@lang('site.change password only')</h5>
            <button type="button" class="close" data-dismiss="modal">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form id="change_password">
               @csrf
               <input type="hidden" id="id" name="id"
                      value="@isset($user['id']){{ $user['id'] }} @endisset">

               <div class="col-md-6">
                  <div class="form-group">
                     <label>@lang('site.password')<span class="text-danger">*</span></label>
                     <input type="text" name="password" class="form-control">
                  </div>
                  <span class="text-danger" id="password_"> </span>
               </div>

               <div class="col-md-6">
                  <div class="form-group">
                     <label>@lang('site.retype password')<span class="text-danger">*</span></label>
                     <input type="text" name="retype_password" class="form-control">
                  </div>
                  <span class="text-danger" id="retype_password_"> </span>
               </div>


            </form>
         </div>
         <div class="modal-footer modal-footer-uniform">
            <button type="button" class="btn btn-rounded btn-primary float-right"
                    onclick="submit('{{route('admin.students.post-edit.password.information')}}','change_password')">{{__('site.save')}}</button>
         </div>
      </div>
   </div>
</div>