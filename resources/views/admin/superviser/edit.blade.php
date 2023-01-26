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
                    <input type="hidden" id="id" name="id" value="{{ $admin_info['id'] }}">
                    <div class="box-body">
                        <h4 class="box-title text-info"><i class="ti-user mr-15"></i>
                            @lang('site.personal information')</h4>
                        <hr class="my-15">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>@lang('site.First Name')<span class="text-danger">*</span></label>
                                    <input type="text" name="first_name" class="form-control"
                                        placeholder="@lang('site.First Name')" value="{{ $admin_info['first_name'] }}">
                                </div>
                                <span class="text-danger" id="first_name_"> </span>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>@lang('site.Middle Name')<span class="text-danger">*</span> </label>
                                    <input type="text" name="middle_name" class="form-control"
                                        placeholder="@lang('site.Middle Name')" value="{{ $admin_info['middle_name'] }}">
                                </div>
                                <span class="text-danger" id="middle_name_"> </span>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>@lang('site.Last Name')<span class="text-danger">*</span></label>
                                    <input type="text" name="last_name" class="form-control"
                                        placeholder="@lang('site.Last Name')" value="{{ $admin_info['last_name'] }}">
                                </div>
                                <span class="text-danger" id="last_name_"> </span>
                            </div>


                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>@lang('site.E-mail')<span class="text-danger">*</span></label>
                                    <input type="text" name="email" class="form-control"
                                        placeholder="@lang('site.E-mail') " value="{{ $admin_info['email'] }}">
                                </div>
                                <span class="text-danger" id="email_"> </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>@lang('site.password')<span class="text-danger">*</span></label>
                                    <input type="password" id="password" name="password" class="form-control"
                                        {{-- {{dd(show_real_pass($admin_info['password']))}} --}} placeholder="@lang('site.password')" value=''>

                                    <span class="text-danger" id="password_"> </span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="demo-checkbox">
                                        <label for=""></label>
                                        <input type="checkbox" id="show_password" class="chk-col-primary"
                                            onclick='showpassword();' />
                                        <label for="show_password">@lang('site.show password')</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <h5>{{ $admin_info->getActive() }} <span class="text-danger"></span></h5>
                                <div class="form-group">
                                    <div class="box-controls pull-left">
                                        <label class="switch switch-border switch-success">
                                            <input type="checkbox" value="1" name="admin_status" id="active"
                                                @if ($admin_info['admin_status'] == 1) checked @endif />
                                            <span class="switch-indicator"></span>
                                            <label for="switcheryColor4"
                                                class="card-title ml-1">{{ $admin_info->getActive() }}</label>

                                            <span class="text-danger" id="active_"> </span>
                                    </div>
                                </div>
                            </div>




                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>@lang('site.role and permission') </label>
                                    <select name="role" class="form-control select2" style="width: 100%;">

                                        @foreach ($roles as $key => $role)
                                            <option
                                                @if ($admin_role->count() > 0) @if ($role['name'] == $admin_role[0]) selected @endif
                                                @endif
                                                value="{{ $role['name'] }}">
                                                {{ $role['name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <span class="text-danger" id="role_"> </span>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>@lang('site.admin photo') </label>
                                    <input type='file' name="photo" onchange="readURL(this);" />
                                </div>
                            </div>
                            <span class="text-danger" id="photo_"> </span>
                            <div class="col-md-4">

                                <img id="admin_image_" src="{{ photos_dir($admin_info['photo']) }}" alt="your image"
                                    width="150" height="150" />
                            </div>

                        </div>

                    </div>


                    <div class="box-footer">

                        <a onclick="submit('{{ route('admin.supervisor.update.info') }}' ,'edit_supervaisor');"
                            type="submit" class="btn btn-rounded btn-primary btn-outline">
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
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                $("#admin_image_").attr("hidden", false);
                reader.onload = function(e) {
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
