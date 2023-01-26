@extends('admin.layouts.master')

@section('content')
    {{-- <div class="wrapper"></div>z --}}

    <div class="row">
        <div class="col-lg-12 col-12">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title"></h4>
                </div>
                <!-- /.box-header -->
                <form class="form" id="edit_supervaisor">
                    @csrf
                    <input type="hidden" id="id" name="id" value="{{ $admin_logged['id'] }}">
                    <div class="box-body">
                        <h4 class="box-title text-info"><i class="ti-user mr-15"></i>
                            @lang('site.personal information')</h4>
                        <hr class="my-15">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>@lang('site.First Name')<span class="text-danger">*</span></label>
                                    <input type="text" name="first_name" class="form-control"
                                        placeholder="@lang('site.First Name')"    disabled readonly  value="{{ $admin_logged['first_name'] }}">
                                </div>
                                <span class="text-danger" id="first_name_"> </span>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>@lang('site.Middle Name')<span class="text-danger">*</span> </label>
                                    <input type="text" name="middle_name" class="form-control"
                                        placeholder="@lang('site.Middle Name')"   disabled readonly  value="{{ $admin_logged['middle_name'] }}">
                                </div>
                                <span class="text-danger" id="middle_name_"> </span>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>@lang('site.Last Name')<span class="text-danger">*</span></label>
                                    <input type="text" name="last_name" class="form-control"
                                        placeholder="@lang('site.Last Name')"    disabled readonly value="{{ $admin_logged['last_name'] }}">
                                </div>
                                <span class="text-danger" id="last_name_"> </span>
                            </div>


                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>@lang('site.E-mail')<span class="text-danger">*</span></label>
                                    <input type="text" name="email" class="form-control"
                                        placeholder="@lang('site.E-mail') "   disabled readonly value="{{ $admin_logged['email'] }}">
                                </div>
                                <span class="text-danger" id="email_"> </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('site.retype password')<span class="text-danger">*</span></label>
                                    <input type="password" id="password" name="password" class="form-control"
                                        placeholder="@lang('site.retype password')" >

                                    <span class="text-danger" id="password_"> </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('site.password')<span class="text-danger">*</span></label>
                                    <input type="password" name="re_password" class="form-control"
                                        placeholder="@lang('site.password')" >
                                </div>
                                <span class="text-danger" id="re_password_"> </span>
                            </div>
                            {{-- <div class="col-md-3">
                                <div class="form-group">
                                    <div class="demo-checkbox">
                                        <input type="checkbox" id="show_password" class="chk-col-primary" checked
                                            onclick='showpassword();' />
                                        <label for="show_password">@lang('site.show password')</label>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>


                    <div class="box-footer">
     
                        <a onclick="submit('{{ route('admin.edit.password.first.logged') }}' ,'edit_supervaisor');" type="submit"
                            class="btn btn-rounded btn-primary btn-outline">
                            <i class="ti-save-alt"></i> Save
                        </a>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection


@section('script')
<script type="text/javascript">
//   password
// re_password
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
    <script src="{{ URL::asset('assets/assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js') }}">
    </script>
    <script src="{{ URL::asset('assets/app-assets/js/pages/advanced-form-element.js') }}"></script>
    {{-- <script src="{{ URL::asset('assets/assets/vendor_plugins/input-mask/jquery.inputmask.js') }}"></script>
    <script src="{{ URL::asset('assets/assets/vendor_plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
    <script src="{{ URL::asset('assets/assets/vendor_plugins/input-mask/jquery.inputmask.extensions.js') }}"></script> --}}
@endsection
