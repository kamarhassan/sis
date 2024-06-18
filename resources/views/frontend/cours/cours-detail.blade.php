@extends('frontend.layouts.master')
@section('title')
@endsection
@section('css')
@endsection
@section('content')

    <div class="content-block">
        <div class="section-full  content-inner">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-12 col-sm-12 m-b15">
                        <div class="classes-details">

                            <div class="class-info">
                                <div class="dlab-post-title ">
                                    <h2 class="post-title m-t0"><a href="#"> @isset($cours)
                                                {{ $cours['category_grade_level']['grade']['grade'] }} --
                                                {{ $cours['category_grade_level']['level']['level'] }}
                                            @endisset
                                        </a>
                                    </h2>
                                </div>

                                @isset($fee)
                                    <div class="box">
                                        <div class="box-header with-border">
                                            <h4 class="box-title">@lang('site.fee amount')</h4>

                                        </div>
                                        <div class="box-body no-padding">
                                            <div class="table-responsive">
                                                <table class="table table-hover">
                                                    <tbody>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>@lang('site.fee type')</th>
                                                            <th>@lang('site.fee amount')</th>

                                                        </tr>

                                                        @foreach ($fee as $key => $fee_cours)
                                                            <tr>
                                                                <td>{{ $key }}</td>
                                                                <td>{{ $fee_cours['fee_type']['fee'] }}</td>
                                                                <td>{{ $fee_cours['value'] }} #
                                                                    {{ $fee_cours['currency']['symbol'] }} -
                                                                    {{ $fee_cours['currency']['abbr'] }}</td>


                                                            </tr>
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
                    <div class="col-lg-4 col-md-12 col-sm-12">

                        <ul class="iconlist iconlist-lg">
                            <li class="bg-success bg-opacity-10 py-2 px-3 rounded"></i><span>Start Date</span><i
                                    class="bi-calendar2-date-fill"></i><span> @isset($cours['act_StartDa'])
                                        {{ $cours['act_StartDa'] }}
                                    @endisset
                                </span>
                            </li>

                            <li class="bg-success-subtle bg-opacity-10 py-2 px-3 rounded"></i><span>End Date</span><i
                                    class="bi-calendar2-date-fill"></i><span>
                                    @isset($cours['act_EndDa'])
                                        {{ $cours['act_EndDa'] }}
                                    @endisset
                                </span>
                            </li>
                            <li class="bg-success bg-opacity-10 py-2 px-3 rounded"></i><span>Class Time</span><i
                                    class="bi-clock"></i><span>{{ $cours['startTime'] }}-{{ $cours['endTime'] }}</span>
                            </li>
                            <li class="bg-success bg-opacity-10 py-2 px-3 rounded"></i><span>@lang('site.teacher name')</span><i
                                    class="fa-solid fa-chalkboard-teacher"></i><span> @isset($teacher_name)
                                        {{ $teacher_name['name'] }}
                                    @endisset
                                </span>
                            </li>

                        </ul>

                        <form id="reserve_cours">
                            <div class="col-12 form-group mb-4 ">
                                <label for="website-cost-type" class="mb-3">@lang('site.teach type')</label><br>
                                <div class="btn-group flex-wrap">
                                    <input type="radio" class="btn-check required " name="teach_type"
                                        id="website-cost-type-corporate" autocomplete="off" data-price="200" value="0">
                                    <label for="website-cost-type-corporate"
                                        class="teach_type btn btn-outline-secondary px-3 fw-semibold ls-0 text-transform-none">@lang('site.online')</label>
                                    <input type="radio" class="btn-check required " name="teach_type"
                                        id="website-cost-type-ecommerce" autocomplete="off" data-price="400" value="1">
                                    <label for="website-cost-type-ecommerce"
                                        class="teach_type btn btn-outline-secondary px-3 fw-semibold ls-0 text-transform-none">@lang('site.on class')</label>
                                </div>
                            </div>
                            <span class="text-danger" id="teach_type_"></span>
                            @guest
                                <div class="btn btn-primary">
                                    <a href="{{ route('login') }}">
                                        <span class="text-white">

                                            @lang('site.you must be login to register in this cours') </a>
                                    </span>


                                </div>
                            @elseif (!auth()->user()->hasVerifiedEmail())
                            <div class="btn btn-primary">
                                    <a href="{{ route('verification.notice') }}">
                                        <span class="text-white">

                                            @lang('site.you need verfie  your email') </a>
                                </div>
                            @else
                                @auth


                                    @csrf
                                    <input type="hidden" name="user_id" id="" value="{{ Auth::user()->id }}">
                                    <input type="hidden" name="order_id" id="" value="{{ $cours['id'] }}">
                                    <input type="hidden" name="order_type" id=""
                                        value="{{ Crypt::encryptString('registration') }}">
                                    @php
                                        \App\Models\NotificationAdmin::where([
                                            'user_id' => Auth::user()->id,
                                            'order_id' => $cours['id'],
                                        ])
                                            ->get()
                                            ->count() > 0
                                            ? ($is_old_register = 1)
                                            : ($is_old_register = 0);
                                    @endphp

                                    @isset($is_old_register)
                                        @if ($is_old_register == 1)
                                            <div class="btn btn-primary">
                                                <a>@lang('site.you already reserved this cours')</a>
                                            </div>
                                        @else
                                            <div class="btn btn-primary">
                                                <a onclick="submit('{{ route('web.registerCours') }}','reserve_cours')"
                                                    id="btn_register">@lang('site.reserve cours')</a>
                                            </div>
                                        @endif
                                    @endisset
                                @endauth
                            @endguest
                        </form>
                    </div>
                </div>
            </div>

        @endsection


        @section('script')
            {{-- <script src="{{ URL::asset('assets/custome_js/front.js') }}"></script> --}}
        @endsection
