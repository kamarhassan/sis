<div class="box box-slided-up">
    <div class="box-header with-border">
        <h4 class="box-title">custome link</h4>
        <ul class="box-controls pull-right">
            <li><a class="box-btn-slide" href="#"></a></li>
        </ul>
    </div>
    <div class="box-body">
        <label class="primary_input_label" for="pagess">
            @lang('site.Pages')
            <span class="text-danger">*</span></label>
        <form id="custom-link">
            @csrf
            <input type="hidden" name="type" id="type" value="Custom Link" class="form-control">
            <div class="row">
                <div class="col-lg-12">
                    <div class='input-effect'>
                        <input class='primary-input form-control' type='text' id="tTitle" name='title'
                            autocomplete='off'>
                        <label>@lang('site.Title')<span>*</span></label>
                        <span class='focus-border'></span>
                    </div>
                    <span class="text-danger" id="titleError"></span>
                </div>
                <div class="col-lg-12 mt-30 mb-30">
                    <div class='input-effect'>
                        <input class='primary-input form-control' type='text' id="tLink" name='link'
                            autocomplete='off'>
                        <label>@lang('site.Link')</label>
                        <span class='focus-border'></span>
                    </div>
                    <span class="text-danger" id="linkError"></span>
                </div>
                <div class="col-lg-12 text-center mt-10">



                    <a onclick="submit('{{ route('cms.admin.post.menu') }}' ,'custom-link');" type="submit"
                        class="btn btn-rounded btn-primary btn-outline">
                        <i class="ti-save-alt"></i> @lang('site.save')
                    </a>


                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
