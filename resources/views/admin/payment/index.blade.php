@extends('admin.layouts.master')
@section('title')
@endsection
@section('css')
@endsection


@section('content')
    <div class="box">
        <div class="box-header with-border">
            {{-- <h3 class="box-title">Individual column searching</h3> --}}
        </div>
        {{-- @if ((new \Jenssegers\Agent\Agent())->isDesktop()) --}}
        <div class="box-body">
            <div class="table-responsive ">
                {{-- <div id="spiner_loading"     class="spinner-grow text-primary @if (LaravelLocalization::getCurrentLocaleDirection() == 'rtl') float-left
                @else float-right @endif " role="status">
                    <span class="sr-only">Loading...</span>
                </div> --}}
                <table id="example1" class="table table-hover">
                    <thead>

                        <tr>
                            <th>@lang('site.options')</th>
                            <th>@lang('site.students id')</th>
                            <th>@lang('site.student name')</th>
                            <th>@lang('site.E-mail')</th>
                            {{-- <th>@lang('site.id')</th> --}}
                            <th>@lang('site.nbumber of cours')</th>
                            <th>@lang('site.students photo')</th>
                        </tr>

                    </thead>
                    <tbody>
                        @isset($std_registartion)
                            @foreach ($std_registartion as $stduents)
                                <tr id="Row{{ $stduents->user_id }}" class="bg-light mb-10 p-10 cursor_pointer hover-success">
                                    <td>
                                        <ul>
                                            <li class="list-unstyled">
                                                <a data-toggle="modal" data-target="#modal-center"
                                                    onclick="get_cours_of_std({{ $stduents->user_id }},'{{ route('admin.students.get_cours_std', $stduents->user_id) }}','{{ csrf_token() }}');"
                                                    class="btn fa fa-credit-card hover-warning text-light"
                                                    title="@lang('site.save')"> @lang('site.pay')</a>
                                            </li>

                                        </ul>
                                        {{-- <a class="btn glyphicon glyphicon-arrow-left hover-danger text-danger text-light"
                                        title="@lang('site.save')"></a>
                                     <a class="btn glyphicon glyphicon-arrow-left hover-danger text-danger text-light"
                                        title="@lang('site.save')"></a> --}}

                                    </td>
                                    <td class="col-sm-1">{{ $stduents->user_id }}</td>
                                    <td class="col-sm-2">{{ $stduents['student'][0]['name'] }} </td>
                                    <td class="col-md-3">{{ $stduents['student'][0]['email'] }}</td>
                                    <td class="col-md-3">{{ $stduents->total }}</td>
                                    <td class="col-md-3">
                                        <img class="avatar avatar-xl avatar-1" {{-- src="{{ photos_dir($stduents->photo) }}" --}} alt="">
                                    </td>
                                </tr>
                            @endforeach
                        @endisset

                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="text-center">
                    {{ $std_registartion->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
        </div>


    </div>
@endsection
@include('admin.payment.cours_std')
@section('script')
    <script>
        // window.addEventListener('load', (event) => {
        //     $('body').css('webkit-filter', 'blur(50px)');
        // });
        // window.addEventListener('load', function() {
        //     // alert("It's loaded!")
        //     // $("#spinner_").css("display", "none");

        //     $('#example1').show();
        //     $('#spiner_loading').css("display", "none");
        // })
        // $(window).on('load', function() {
        //     $('body').css('webkit-filter', 'blur(50px)');

        // });

        $(document).ready(function() {
            // var table = $('#example1').DataTable({
            //     "processing": true,
            //     "serverSide": false,
            // });
            var table = $('#example1').DataTable({
                scrollY: "400px",
                // scrollX: true,
                scrollCollapse: true,
                paging: false,
                // ajax: '/test/0',

            });
        });
    </script>
    <script src="{{ URL::asset('assets/assets/vendor_components/datatable/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/app-assets/js/pages/data-table.js') }}"></script>
    <script src="{{ URL::asset('assets/app-assets/js/fixed_column_datatable.js') }}"></script>
    <script src="{{ URL::asset('assets\custome_js\get_cours_cours_std.js') }}"></script>
@endsection
