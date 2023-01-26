<div class="box">
    <div class="box-body">
        <div class="row">

            <form action="{{ route('admin.export.file.to.import.students') }}" method="POST" id="FillStdNew">
                {{-- <form action="{{ route('admin.add.students.form1', 14) }}" method="POST" id="FillStdNew"> --}}
                @csrf
                {{-- <input type="text" name="tst" value="14"> --}}

                <div class="text-xs-right">

                    <button class="btn  fa fa-download hover-success" title="@lang('site.save')" type="submit">
                        @lang('site.download file to import new students')
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>

<div class="box">
    <div class="box-body">
        <form id="imoprt_students_file" enctype="multipart/form-data">
            <div class="row">
                @csrf
                @isset($cours)
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('site.cours') </label>
                            <select name="cours_id"class="form-control select2" id="cours_id">
                                <option value="">---------</option>
                                @foreach ($cours as $item)
                                    <option value="{{ $item['id'] }}">
                                        {{-- teacher_name --}}
                                        {{ $item['id'] }} #
                                        {{ $item['grade']['grade'] }} . {{ $item['level']['level'] }} .
                                        {{ $item['teacher_name']['name'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <span id="cours_id_" class="text-danger"></span>

                    </div>
                @endisset
                @isset($sponsore)
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('site.fee corevered by sponsor') </label>
                            <select name="sponsore_id"class="form-control select2" id="sponsore_id">
                                <option value="">---------</option>
                                @foreach ($sponsore as $item)
                                    <option value="{{ $item['id'] }}">
                                        {{ $item['name'] }} # {{ $item['type'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <span id="sponsore_id_" class="text-danger"></span>
                    </div>
                @endisset
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label> </label>
                        <input type="file" name="std_import" class="form-control">
                    </div>
                    <span id="std_import_" class="text-danger"></span>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>@lang('site.note write') </label>
                        <input type="text" name="fee_note" class="form-control">
                    </div>
                    <span id="fee_note_" class="text-danger"></span>
                </div>
            </div>
            <div class="row">
                <div class="text-xs-right">
                    <a class="btn  fa fa-upload hover-success " title="@lang('site.save')" type="submit"
                        onclick="submit('{{ route('admin.import.file.students') }}','imoprt_students_file','user_have_error','@lang('site.you have error in line when import excel')');">
                        <span class=""> @lang('site.save')</span>
                    </a>
                </div>

            </div>

        </form>
        <div id="btn_dowload_error">
            <div class="row">

                <form action="{{ route('admin.export.file.have.error.students') }}" method="POST" id="FillStderror">
                    {{-- <form action="{{ route('admin.add.students.form1', 14) }}" method="POST" id="FillStdNew"> --}}
                    @csrf
                    <input type="text" name="error_std_file_name" id='error_std_file_name' hidden>

                    <div class="text-xs-right" id='btn_erro_list' hidden>
                        <button class="btn  fa fa-download hover-success" title="@lang('site.save')" type="submit">
                            @lang('site.download file have error after import')
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <div id="user_have_error"></div>
</div>
</div>
{{-- <div id="overlay">
    <div class="cv-spinner">
        <span class="spinner">
        </span>
    </div>
</div> --}}
<div class="overlay"></div>
<div class="spanner">
    <div class="loader"></div>
    {{-- <p>Uploading music file, please be patient.</p> --}}
    <h1 class="text-danger">@lang('site.please wait to valdate the data')</h1>
</div>