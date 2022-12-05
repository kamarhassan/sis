<div class="row">
    <div class="col-lg-12 col-12">
        <div class="box">

            <form class="form" id="add_students_by_profile">
                @csrf
                <div class="box-body">
                    <h4 class="box-title text-info"><i class="ti-user mr-15"></i>
                        @lang('site.personal information for student')</h4>
                    <hr class="my-15">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>@lang('site.First Name')<span class="text-danger">*</span></label>
                                <input id="name" type="text"
                                    class="form-control @error('firstname') is-invalid @enderror" name="firstname"
                                    autocomplete="firstname" placeholder="@lang('site.lang name')" autofocus>
                                <span id="firstname_" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>@lang('site.Middle Name')<span class="text-danger">*</span> </label>
                                <input type="text" class="form-control" name="midname"
                                    placeholder="@lang('site.Middle Name')">
                            </div>
                            <span id="midname_" class="text-danger"></span>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>@lang('site.Last Name')<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="lastname"
                                    placeholder="@lang('site.Last Name')">
                            </div>
                            <span id="lastname_" class="text-danger"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>@lang('site.E-mail')<span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email"
                                    placeholder="@lang('site.E-mail')">
                            </div>
                            <span id="email_" class="text-danger"></span>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>@lang('site.password')<span class="text-danger">*</span></label>
                                <input type="password" class="form-control" name="password"
                                    placeholder="@lang('site.password')">
                            </div>
                            <span id="password_" class="text-danger"></span>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>@lang('site.phone number')<span class="text-danger">*</span></label>
                                <input type="tel" class="form-control" name="phonenumber"
                                    placeholder="@lang('site.phone number')">
                            </div>
                            <span id="phonenumber_" class="text-danger"></span>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>@lang('site.students birthday')<span class="text-danger">*</span></label>
                                <input type="Date" class="form-control" name="birthday"
                                    placeholder="@lang('site.students birthday')">
                            </div>
                            <span id="birthday_" class="text-danger"></span>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>@lang('site.location born')<span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="born_place"
                                    placeholder=@lang('site.location born')>
                            </div>
                            <span id="born_place_" class="text-danger"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>@lang('site.profile image')</label>
                        <label class="file">
                            <input type="file" name="photo" id="file">
                        </label>
                    </div>
                </div>

                <div class="box-footer">
                    <a onclick="submit('{{ route('admin.add.students.form') }}','add_students_by_profile') ;"
                        class="btn btn-rounded btn-primary btn-outline">
                        <i class="ti-save-alt"></i> Save
                    </a>
                </div>
            </form>
        </div>

    </div>
</div>
