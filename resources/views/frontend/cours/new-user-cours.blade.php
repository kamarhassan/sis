@extends('frontend.layouts.User.user-daschoard-master')
@section('title')
@endsection
@section('css')
<style>
   
    .wordwrap {
      width:150px;
      word-wrap: break-word;
    }
    </style>
@endsection
@section('content')
    <section id="blog" class="blog">
        <div class="container">
            <div class="row">
                <div class="entries">

                    @isset($user_cours)
                        <div class="box">
                            <div class="box-header with-border">
                                <h4 class="box-title">@lang('site.fee amount')</h4>
                    
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body no-padding">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-hover">
                                        <tbody>
                                            <tr>
                                                <th>#</th>
                                                <th>@lang('site.grade')</th>
                                                <th>@lang('site.level')</th>
                                                <th>@lang('site.actually start date')</th>
                                                <th>@lang('site.actually end date')</th>
                                                <th>@lang('site.options')</th>
                                            </tr>

                                            @foreach ($user_cours as $key => $user_courss)
                                                <tr class="Row{{ $user_courss['id'] }} " id="Row{{ $user_courss['id'] }} ">
                                                    <td>{{ $key }}</td>
                                                    {{-- <td>{{ $user_courss['cours_reserved']['id'] }}</td> --}}
                                                    <td>{{ $user_courss['category']['grade']['grade'] }}</td>
                                                    <td>{{ $user_courss['category']['level']['level'] }}</td>
                                                    {{-- <td>{{ $user_courss['category']['description'] }}</td> --}}
                                                    <td>{{ $user_courss['category']['act_StartDa'] }}</td>
                                                    <td>{{ $user_courss['category']['act_EndDa'] }}</td>
                                                    {{-- <td>{{ $fee_cours['value'] }} # {{ $fee_cours['currency']['symbol'] }} - {{ $fee_cours['currency']['abbr'] }}</td> --}}
                                                    <td>
                                                        <a class="btn text-danger  glyphicon glyphicon-trash hover  hover-primary"
                                                            title="@lang('site.delete')"
                                                            onclick="delete_by_id('{{ route('web.delete.cours.reserved') }}',{{ $user_courss['id'] }},'{{ csrf_token() }}','{{ json_encode(swal_fire_msg()) }}');">
                                                        </a>
                                                    </td>

                                                </tr>
                                                {{-- <tr>
                                                <td><a href="javascript:void(0)">Order #123456</a></td>
                                                <td>Lorem Ipsum</td>
                                                <td><span class="text-muted"><i class="fa fa-clock-o"></i> Oct 16,
                                                        2017</span> </td>
                                                <td>$158.00</td>
                                                <td><span class="badge badge-pill badge-danger">Pending</span></td>
                                                <td>CH</td>
                                            </tr> --}}
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    @endisset

                </div>
            </div>
        </div>
    </section>
@endsection


@section('script')
    {{-- <script src="{{ URL::asset('assets/custome_js/save.js') }}"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{ URL::asset('assets/custome_js/delete.js') }}"></script>
@endsection
