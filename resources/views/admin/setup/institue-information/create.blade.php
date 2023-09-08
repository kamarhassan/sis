@extends('admin.layouts.master')
@section('title')
   @lang('site.institue information')
@endsection
@section('css')
    @livewireStyles()
@endsection

@section('content')
    <section id="html">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"></h4>
                        <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collpase show">
                        <div class="card-body card-dashboard">
                            <form id="create_new_branch">
                                @csrf

                                @include('admin.setup.institue-information.create-edit-form')
                                                           
                             
                            </form>
                            <a onclick="submit('{{ route('admin.InstitueInformation.store.InstitueInformation') }}' ,'create_new_branch');"
                                type="submit" class="btn btn-rounded  btn-outline-success">
                                <i class="ti-save-alt"></i> @lang('site.save')
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script src="{{ URL::asset('assets/custome_js/save_and_redirect.js') }}"></script>
@endsection
