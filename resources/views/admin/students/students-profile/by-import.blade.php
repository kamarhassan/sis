<div class="box">
    <div class="box-body">
        <div class="row">

            <form action="{{ route('admin.export.file.to.import.students') }}" method="GET">
                @csrf
                <div class="text-xs-right">
                    <a class="btn  fa fa-download hover-success " title="@lang('site.save')" type="submit"
                        href="{{ route('admin.export.file.to.import.students') }}">
                        <span class=""> @lang('site.download file to import new students')</span>
                    </a>
                </div>
            </form>
        </div>

    </div>
</div>
<div class="box">
    <div class="box-body">

        <div class="col-md-12" id="imoprt_students_file">

            <form>
                @csrf
                <div class="form-group row">
                    {{-- <label class="col-form-label col-lg-2"></label> --}}
                    <div class="col-lg-10">
                        <input type="file" class="form-control">
                    </div>
                </div>

        </div>
        <div class="row">

            <div class="text-xs-right">
                <a class="btn  fa fa-download hover-success " title="@lang('site.save')" type="submit"
                onclick="submit('{{route('admin.import.file.students')}}','imoprt_students_file');"
                >
                    <span class=""> @lang('site.save')</span>
                </a>
            </div>
            </form>
        </div>

    </div>
</div>
