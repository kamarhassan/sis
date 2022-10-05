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
                <form id="new_supervaisor">
                    @csrf
                    <div class="box-body">
                        <h4 class="box-title text-info"><i class="ti-user mr-15"></i>
                            @lang('site.personal information')</h4>
                        <hr class="my-15">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>@lang('site.First Name')<span class="text-danger">*</span></label>
                                    <input type="text" name="first_name" class="form-control"
                                        placeholder="@lang('site.First Name')">
                                </div>
                                <span class="text-danger" id="first_name_"> </span>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>@lang('site.Middle Name')<span class="text-danger">*</span> </label>
                                    <input type="text" name="middle_name" class="form-control"
                                        placeholder="@lang('site.Middle Name')">
                                </div>
                                <span class="text-danger" id="middle_name_"> </span>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>@lang('site.Last Name')<span class="text-danger">*</span></label>
                                    <input type="text" name="last_name" class="form-control"
                                        placeholder="@lang('site.Last Name')">
                                </div>
                                <span class="text-danger" id="last_name_"> </span>
                            </div>


                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>@lang('site.E-mail')<span class="text-danger">*</span></label>
                                    <input type="text" name="email" class="form-control"
                                        placeholder="@lang('site.E-mail')">
                                </div>
                                <span class="text-danger" id="email_"> </span>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('site.retype password')<span class="text-danger">*</span></label>
                                    <input type="password" name="password" class="form-control"
                                        placeholder="@lang('site.retype password')">
                                </div>
                                <span class="text-danger" id="password_"> </span>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('site.password')<span class="text-danger">*</span></label>
                                    <input type="password" name="re_password" class="form-control"
                                        placeholder="@lang('site.password')">
                                </div>
                                <span class="text-danger" id="re_password_"> </span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>@lang('site.role and permission') </label>
                                <select name="role" class="form-control select2" style="width: 100%;">

                                    @foreach ($roles as $key => $role)
                                        <option selected value="{{ $role['name'] }}">
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
                        <div class="col-md-4">

                            <img id="admin_image_" src="#" alt="your image" hidden />
                        </div>
                    </div>

                    <div class="box-footer">
                        {{-- <a  type="button"
                            class="btn btn-rounded btn-warning btn-outline mr-1">
                            <i class="ti-trash"></i> Cancel
                        </a> --}}
                        <a onclick="submit('{{ route('admin.supervisor.store') }}' ,'new_supervaisor');" type="submit"
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
    <script>
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
    </script>
    <script src="{{ URL::asset('assets/custome_js/save_and_redirect.js') }}"></script>
    <script src="{{ URL::asset('assets/assets/vendor_components/select2/dist/js/select2.full.js') }}"></script>
    <script src="{{ URL::asset('assets/assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js') }}"></script>
    <script src="{{ URL::asset('assets/app-assets/js/pages/advanced-form-element.js') }}"></script>
    <script src="{{ URL::asset('assets/assets/vendor_plugins/input-mask/jquery.inputmask.js') }}"></script>
    <script src="{{ URL::asset('assets/assets/vendor_plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
    <script src="{{ URL::asset('assets/assets/vendor_plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
@endsection
