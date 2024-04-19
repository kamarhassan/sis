@extends('frontend.layouts.master')
@section('title')
@endsection
@section('css')
@endsection

@section('content')
    <section id="content">
        <div class="content-wrap">
            <div class="container">

                <div class="row gx-5 col-mb-80">
                    <!-- Postcontent
                            ============================================= -->
                    <main class="postcontent col-lg-9">

                        <h3>Send us an Email</h3>

                        <div class="form-widget">

                            <div class="form-result"></div>

                            <form class="mb-0" id="contactform" name="template-contactform">
                                @csrf
                                <div class="form-process">
                                    <div class="css3-spinner">
                                        <div class="css3-spinner-scaler"></div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <label for="name">@lang('site.name') <small>*</small></label>
                                        <input type="text" id="name" name="name" value=""
                                            class="form-control required">
                                        <span class="text-danger" id="name_"></span>
                                    </div>

                                    <div class="col-md-4 form-group">
                                        <label for="email">@lang('site.email') <small>*</small></label>
                                        <input type="email" id="email" name="email" value=""
                                            class="required email form-control">
                                        <span class="text-danger" id="email_"></span>
                                    </div>

                                    <div class="col-md-4 form-group">
                                        <label for="phone">@lang('site.phone')</label>
                                        <input type="text" id="phone" name="phone" value=""
                                            class="form-control">
                                        <span class="text-danger" id="phone_"></span>
                                    </div>

                                    <div class="w-100"></div>

                                    <div class="col-md-12 form-group">
                                        <label for="subject">@lang('site.subject') <small>*</small></label>
                                        <input type="text" id="subject" name="subject" value=""
                                            class="required form-control">
                                        <span class="text-danger" id="subject_"></span>
                                    </div>



                                    <div class="w-100"></div>

                                    <div class="col-12 form-group">
                                        <label for="message">@lang('site.message') <small>*</small></label>
                                        <textarea class="required form-control" id="message" name="message" rows="6" cols="30"></textarea>
                                        <span class="text-danger" id="message_"></span>
                                    </div>



                                    <div class="col-12 form-group">
                                        <a onclick="submit_redirect('{{ route('web.post.contact-us') }}' ,'contactform');"
                                            class="button button-3d m-0">
                                            <i class="ft-check"></i> @lang('site.send message')
                                        </a>

                                    </div>
                                </div>



                            </form>
                        </div>

                    </main><!-- .postcontent end -->

                    <!-- Sidebar
                            ============================================= -->
                    <aside class="sidebar col-lg-3">

                        @isset($institueInformation)
                        @endisset
                        <abbr title="Phone Number"><strong>Phone:</strong> @isset($institueInformation->phone)
                            </abbr> <a href="tel:{{ $institueInformation->phone }}" class="h-bg-call"><span class="ts-icon"><i
                                        class="fa-solid fa-phone"></i></span><span
                                    class="ts-text">{{ $institueInformation->phone }}</span></a>
                        @endisset
                        <br>

                        <abbr title="Email Address"><strong>Email:</strong></abbr> @isset($institueInformation->email)
                            <a href="mailto:{{ $institueInformation->email }}" class="h-bg-email3"><span class="ts-icon"><i
                                        class="bi-envelope-fill"></i></span><span class="ts-text">
                                    {{ $institueInformation->email }}</span></a>
                        @endisset
                        <div class="widget border-0 pt-0">
                            @foreach ($socialMedia as $platform => $url)
                                @isset($url)
                                    
                                    <a href="{{ config('social_media.'.$platform) }}"
                                        class="social-icon si-small bg-dark h-bg-{{Str::lower($platform) }}">
                                        <i class="fa-brands fa-{{Str::lower($platform) }}"></i>
                                        <i class="fa-brands fa-{{Str::lower($platform) }}"></i>
                                    </a>
                                @endisset
                            @endforeach

                        </div>

                    </aside><!-- .sidebar end -->
                </div>

            </div>
        </div>
    </section>
@endsection


@section('script')
    {{-- <script src="{{ URL::asset('assets/custome_js/save_and_redirect.js') }}"></script> --}}
@endsection
