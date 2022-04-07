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
                <form class="form" action="{{ route('admin.supervisor.store') }}" method="POST">
                    @csrf
                    <div class="box-body">
                        <h4 class="box-title text-info"><i class="ti-user mr-15"></i>
                            @lang('site.personal information')</h4>
                        <hr class="my-15">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>@lang('site.First Name')<span class="text-danger">*</span></label>
                                    <input type="text" name="firs_name" class="form-control"
                                        placeholder="@lang('site.First Name')">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>@lang('site.Middle Name')<span class="text-danger">*</span> </label>
                                    <input type="text" name="Middle_name" class="form-control"
                                        placeholder="@lang('site.Middle Name')">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>@lang('site.Last Name')<span class="text-danger">*</span></label>
                                    <input type="text" name="Last_name" class="form-control"
                                        placeholder="@lang('site.Last Name')">
                                </div>
                            </div>


                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>@lang('site.E-mail')<span class="text-danger">*</span></label>
                                    <input type="text" name="Email" class="form-control"
                                        placeholder="@lang('site.E-mail')">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('site.retype password')<span class="text-danger">*</span></label>
                                    <input type="password" name="Passwor" class="form-control"
                                        placeholder="@lang('site.retype password')">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('site.password')<span class="text-danger">*</span></label>
                                    <input type="password" name="re_password" class="form-control"
                                        placeholder="@lang('site.password')">



                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-body">

                        <div class="demo-checkbox">

                            @foreach ($permission as    $key => $per  )


                                <input type="checkbox" class="chk-col-success" id="{{ $per->name }}" name="role[]" value="{{ $per->name }}" />
                                <label for="{{ $per->name }}">{{ $per->name }} </label>

                                {{-- <input name="role[]" type="checkbox"  value="{{ $per->name }}">{{ $per->name }}<br> --}}
                                {{-- <input name="role[]" type="checkbox"> --}}
                            @endforeach
                        </div>

                    </div>

                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="button" class="btn btn-rounded btn-warning btn-outline mr-1">
                            <i class="ti-trash"></i> Cancel
                        </button>
                        <button type="submit" class="btn btn-rounded btn-primary btn-outline">
                            <i class="ti-save-alt"></i> Save
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection


@section('script')
    <script src="{{ URL::asset('assets/assets/vendor_plugins/input-mask/jquery.inputmask.js') }}"></script>
    <script src="{{ URL::asset('assets/assets/vendor_plugins/input-mask/jquery.inputmask.date.extensions.js') }}">
    </script>
    <script src="{{ URL::asset('assets/assets/vendor_plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
@endsection
