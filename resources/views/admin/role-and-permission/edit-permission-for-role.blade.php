{{-- <div class="modal center-modal fade bs-example-modal-lg" id="modal-center" tabindex="-1"> --}}
    <div class="modal bs-examplemodal-lg  center-modal  " id="modal-center" tabindex="-1" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            {{-- <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> --}}
            <div class="modal-body">

                {{-- <p id="cours_details">@lang('site.please wait to load service')</p> --}}
                <div class="box-body">
                    <div class="row">
                        <div class="col-12">
                            <form id='update_permission_for_role'>
                                @csrf
<input type="hidden" name="role_id" id="role_id" value="">
                                 <div class="add_item">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>@lang('site.services') <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" id="role_name" name="role_name"
                                                        class="form-control">
                                                    <span class="text-danger" id="role_name_"> </span>
                                                </div>
                                            </div>
                                        </div>

                                    {{-- </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>@lang('site.currency name') <span class="text-danger">*</span></h5>
                                                    <div class="controls">

                                                        <span class="text-danger" id="currency_"> </span>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <h5>@lang('site.language is active') <span class="text-danger"></span></h5>
                                                <div class="form-group">
                                                    <div class="box-controls pull-left">
                                                        <label class="switch switch-border switch-success">
                                                            <input type="checkbox" value="1"
                                                                name="active" id="active"  />
                                                            <span class="switch-indicator"></span>
                                                            <label for="switcheryColor4"
                                                                class="card-title ml-1">@lang('site.language is active') </label>

                                                            <span class="text-danger" id="active_"> </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                @include('admin.role-and-permission.all-permission')
                            </form>
                            <div class="row">
                                <div class="text-xs-right">
                                    <a class="btn  glyphicon glyphicon-ok hover-success "
                                        title="@lang('site.save')"
                                         onclick="update_permission_for_role('{{ route('admin.setting.update.permission.for.role')}}')";
                                        ><span class=""> @lang('site.next step')</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
