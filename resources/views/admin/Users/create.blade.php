@extends('admin.layouts.master')
@section('title')
   @lang('site.create user')
@endsection
@section('content')
    {{-- <div class="wrapper"></div>z --}}

            <div class="row">
                <div class="col-lg-12 col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h4 class="box-title"></h4>
                        </div>
                        <!-- /.box-header -->
                        <form class="form">
                            <div class="box-body">
                                <h4 class="box-title text-info"><i class="ti-user mr-15"></i>
                                    @lang('site.personal information')</h4>
                                <hr class="my-15">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>@lang('site.First Name')<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control"
                                                placeholder="@lang('site.First Name')">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>@lang('site.Middle Name')<span class="text-danger">*</span> </label>
                                            <input type="text" class="form-control"
                                                placeholder="@lang('site.Middle Name')">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>@lang('site.Last Name')<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" placeholder="@lang('site.Last Name')">
                                        </div>
                                    </div>


                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>@lang('site.E-mail')<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" placeholder="@lang('site.E-mail')">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>@lang('site.retype password')<span
                                                    class="text-danger">*</span></label>
                                            <input type="password" class="form-control"
                                                placeholder="@lang('site.retype password')">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>@lang('site.password')<span class="text-danger">*</span></label>
                                            <input type="password" class="form-control"
                                                placeholder="@lang('site.password')">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>@lang('site.Mather Name')</label>
                                            <input type="Text" class="form-control"
                                                placeholder="@lang('site.Mather Name')">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Interested in</label>
                                            <select class="form-control">
                                                <option value="Mr">@lang('site.Mr')</option>
                                                <option value="Ms">@lang('site.Ms')</option>
                                                <option value="Mrs">@lang('site.Mrs')</option>
                                            </select>
                                        </div>
                                    </div>




                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>@lang('site.BirthDay')<span class="text-danger">*</span></label>
                                            <input type="Date" class="form-control"
                                                placeholder="@lang('site.BirthDay')">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>@lang('site.BirthDay place')<span class="text-danger">*</span></label>
                                            <select class="form-control"
                                                placeholder=@lang('site.BirthDay place')>

                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Budget</label>
                                            <select class="form-control">
                                                <option>Budget</option>
                                                <option>less than 5000$</option>
                                                <option>5000$ - 10000$</option>
                                                <option>10000$ - 20000$</option>
                                                <option>more than 20000$</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Select File</label>
                                    <label class="file">
                                        <input type="file" id="file">
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>About Project</label>
                                    <textarea rows="5" class="form-control" placeholder="About Project"></textarea>
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
                    <!-- /.box -->
                </div>
            </div>
        </div>
    @endsection

