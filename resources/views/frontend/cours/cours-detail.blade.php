@extends('frontend.layouts.master')
@section('title')
@endsection
@section('css')
@endsection
@section('content')
    <section id="blog" class="blog">
        <div class="container">
            <div class="row">
                <div class="entries">
                    <article class="entry" data-aos="fade-up">
                        <div class="entry-img">
                            <img src="assets/img/blog-1.jpg" alt="" class="img-fluid">
                        </div>
                        <h2 class="entry-title">
                            <a>
                                @isset($cours)
                                    {{ $cours['grade']['grade'] }} -- {{ $cours['level']['level'] }}
                                @endisset
                            </a>
                        </h2>
                        <div class="entry-meta">
                            <ul>
                                <li class="d-flex align-items-center"><i class="icofont-user"></i><a>
                                        @isset($teacher_name)
                                        @lang('site.teacher name') :     {{ $teacher_name['name'] }}
                                        @endisset
                                    </a></li>

                                <li class="d-flex align-items-center"><i class="icofont-wall-clock"></i> <a><time
                                            datetime="2020-01-01">@lang('site.start date') : @isset($cours['act_StartDa'])
                                                {{ $cours['act_StartDa'] }}
                                            @endisset
                                        </time></a></li>
                                <li class="d-flex align-items-center"><i class="icofont-wall-clock"></i> <a><time
                                            datetime="2020-01-01">@lang('site.end date') : @isset($cours['act_EndDa'])
                                                {{ $cours['act_EndDa'] }}
                                            @endisset
                                        </time></a></li>


                            </ul>
                        </div>
                        <div class="entry-content">
                            <p>
                                {{-- {{day_of_week_for_cours($cours['days'])}} --}}
                            </p>
                            <p>

                                <li class="d-flex align-items-center"><i class="icofont-book"></i> <a>
                                        @lang('site.description cours')
                                    </a></li>
                                @isset($cours['description'])
                                    {{ $cours['description'] }}
                                @endisset
                            </p>

                            @isset($fee)
                                <div class="box">
                                    <div class="box-header with-border">
                                        <h4 class="box-title">@lang('site.fee amount')</h4>
                                        {{-- <div class="box-controls pull-right">
                                            <div class="lookup lookup-circle lookup-right">
                                                <input type="text" name="s">
                                            </div>
                                        </div> --}}
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body no-padding">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <tbody>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>@lang('site.fee type')</th>
                                                        <th>@lang('site.fee amount')</th>
                                                        {{-- <th>Amount</th>
                                                        <th>Status</th>
                                                        <th>Country</th> --}}
                                                    </tr>

                                                    @foreach ($fee as $key=> $fee_cours)
                                                        <tr>
                                                            <td>{{ $key }}</td>
                                                            <td>{{ $fee_cours['fee_type']['fee'] }}</td>
                                                            <td>{{ $fee_cours['value'] }} # {{ $fee_cours['currency']['symbol'] }} - {{ $fee_cours['currency']['abbr'] }}</td> 


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


                            <div class="">

                                @guest
                                    <div class="read-more">
                                        <a> @lang('site.you must be login to register in this cours')</a>
                                    </div>
                                    {{-- @lang('site.you must be login to register in this cours') --}}
                                @else
                                    @auth

                                        <form id="reserve_cours">
                                            @csrf
                                            <input type="hidden" name="user_id" id="" value="{{ Auth::user()->id }}">
                                            <input type="hidden" name="order_id" id="" value="{{ $cours['id'] }}">
                                            <input type="hidden" name="order_type" id="" value="{{ Crypt::encryptString ('registration') }}">
                                            
                                            <div class="read-more">
                                                <a onclick="submit('{{ route('web.registerCours') }}','reserve_cours')">@lang('site.reserve cours')</a>
                                            </div>
                                        </form>
                                    @endauth

                                @endguest



                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>
@endsection


@section('script')
<script src="{{ URL::asset('assets/custome_js/save.js') }}"></script>
@endsection
