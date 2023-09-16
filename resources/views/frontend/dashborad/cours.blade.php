@extends('frontend.layouts.User.user-daschoard-master')
@section('title')
@endsection
@section('css')
    <style>
        .dropdown-menu {
            max-height: 280px;
            overflow-y: auto;
        }
    </style>
@endsection
@section('content') 
 <div class="card">
    <div class="row col-md-12">

        <div class="box-body">
            <div class="table-responsive">
                <table id="user_cours" class="table table-hover" >

                    <thead>

                        <tr>
                            <th>#</th>
                            <th>@lang('site.cours')</th>
                            <th>@lang('site.cours fees')</th>
                            <th>@lang('site.remaining')</th>
                            <th>@lang('site.teacher_name')</th>
                            <th>@lang('site.options')</th>
                        </tr>

                    </thead>
                    <tbody>
                        @isset($student_courss)
                            @foreach ($student_courss as $student_cours)
                                <tr>
                                    <td></td>
                                    <td>{{ $student_cours['grade'] }} # {{ $student_cours['level'] }}</td>
                                    <td>{{ $student_cours['cours_fee_total'] }}</td>
                                    <td>{{ $student_cours['remaining'] }}</td>
                                    <td>{{ $student_cours['teacher_name'] }}</td>
                                    <td>

                                        <a type="button" class="btn btn-outline-success " data-toggle="modal"
                                            data-target="#modal-center-{{ $student_cours['id'] }}">
                                            {{-- <i class="fa fa-plus-circle"></i> --}}
                                            @lang('site.options')
                                        </a>
                                    </td>
                                </tr>


                                <div class="modal   fade" data-backdrop="false" id="modal-center-{{ $student_cours['id'] }}"
                                    tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">@lang('site.choose as you want')</h5>
                                                <a type="button" class="close" data-dismiss="modal">
                                                    <span aria-hidden="true">&times;</span>
                                                </a>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">


                                                    <div class="col-md-6 col-12">
                                                       <span> @lang('site.certificates or statement')</span>
                                                        <div class="box">
                                                            <div class="box-body">
                                                                <div class="inner-content-div">
                                                                    @foreach ($certificate as $cert)
                                                                        <div>

                                                                            @if ($student_cours['remaining'] != 0 && $student_cours['isenable'] == 0)
                                                                                <a href="#"> <span class="text-danger"><i
                                                                                            class="mdi mdi-certificate"></i>
                                                                                        @lang('site.The remaining amount must be paid') 
                                                                                    </span></a>
                                                                            @else
                                                                                <a
                                                                                    href="{{ route('web.user.cours.get.certificate', [$student_cours['id'], $cert['id']]) }}"><i
                                                                                        class="mdi mdi-certificate"></i>{{ $cert['name'] }}</a>
                                                                            @endif
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
{{--                                                    <div class="col-md-6 col-12">--}}
{{--                                                      <span> @lang('site.certificates or statement')</span>--}}
{{--                                                        <div class="box">--}}
{{--                                                            <div class="box-body">--}}
{{--                                                                <div class="inner-content-div">--}}
{{--                                                                    @isset($certificate)--}}
{{--                                                                        @foreach ($certificate as $certi)--}}
{{--                                                                            {{ $certi['name'] }} <br>--}}
{{--                                                                        @endforeach--}}
{{--                                                                    @endisset--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
                                                </div>
                                            </div>
                                            <div class="modal-footer modal-footer-uniform">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endisset



                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>



@endsection


@section('script')
    <script>
        $(document).ready(function() {
            var table = $('#user_cours').DataTable({
                scrollY: "400px",
                searching: true,
                scrollX: true,
                responsive: true,
                scrollCollapse: true,
                paging: false,
            });
        });
    </script>
    <script src="{{ URL::asset('assets/assets/vendor_components/datatable/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/app-assets/js/pages/data-table.js') }}"></script>
@endsection
