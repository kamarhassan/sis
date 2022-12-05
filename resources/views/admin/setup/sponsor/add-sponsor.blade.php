{{-- @can('create fee type') --}}
<div class="box box-slided-up">
    <div class="box-header with-border">
        <div class="box-header with-border">
            <h4 class="box-title">@lang('site.add sponsor')</h4>
        </div>
        <ul class="box-controls pull-right">
            <li><a class="box-btn-close" href="#"></a></li>
            <li><a class="box-btn-slide text-warning" href="#"></a></li>
            {{-- <li><a class="box-btn-fullscreen" href="#"></a></li> --}}
        </ul>
    </div>


    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div cظlass="col-12">
                <form id='sponsor_form'>
                    @csrf
                    <div class="add_item">
                        <div class="form-row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <h5>@lang('site.sponsor type') <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" id="sponsor_type_0" name="sponsor_type[]"
                                            class="form-control">
                                        <span class="text-danger" id="sponsor_type_0_"> </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <h5>@lang('site.sponsor name') <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" id="sponsor_name_0" name="sponsor_name[]"
                                            class="form-control">
                                        <span class="text-danger" id="sponsor_name_0_"> </span>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-md-1">
                                <h5>@lang('site.is active') <span class="text-danger"></span></h5>
                                <div class="form-group">
                                    <div class="box-controls pull-left">
                                        <label class="switch switch-border switch-success">
                                            <input type="checkbox" id="sponsor_active_0" value="1"
                                                name="sponsor_active[]" id="active" checked />
                                            <span class="switch-indicator"></span>
                                            <label for="switcheryColor4" class="card-title ml-1">@lang('site.is active')
                                            </label>
                                            <span class="text-danger" id="sponsor_active_0_"> </span>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="col-md-2">
                                <div class="form-group">
                                    <h5>@lang('site.sponsor limit budget') <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" id="sponsor_limit_0" name="sponsor_limit[]"
                                            class="form-control">
                                        <span class="text-danger" id="sponsor_limit_0_"> </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <h5>@lang('site.sponsor limit students') <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" id="sponsor_students_limit_0"
                                            name="sponsor_students_limit[]" class="form-control">
                                        <span class="text-danger" id="sponsor_students_limit_0_"> </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <h5>@lang('site.sponsor default %') <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text"  name="sponsor_default_percent[]"
                                            class="form-control">
                                        <span class="text-danger" id="sponsor_default_percent_0_"> </span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-1" style="padding-top: 25px;">
                                <span class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="text-xs-right">
                        <a class="btn  glyphicon glyphicon-arrow-left hover-success " title="@lang('site.save')"
                            onclick="submit('{{ route('admin.sponsor.store.sponsor') }}','sponsor_form')">
                            <span class=""> @lang('site.next step')</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- @endcan --}}
