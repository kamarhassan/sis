@php

    $footer = render_footer_front();
    $institueInformation = \App\Models\InstitueInformation::first();
@endphp


<footer id="footer" class="dark">

    <div class="container">

        <div class="footer-widgets-wrap">

            <div class="row widget widget_links">
                <div class="col-6 col-md" {{-- style="background: url('assets/Canvas/images/world-map.png') no-repeat center center; background-size: 100%;" --}}>
{{--                    <p class="d-block mb-4 ">ِ{{ env('app_name') }}</p>--}}

                 

                    <address>
                        <strong>@lang('site.Online') @lang('site.Offline') @lang('site.Hybride Course')</strong><br>
                        {{-- {{ config('social_media.Facebook') }}  /bi-facebook --}}

                        @foreach (Config::get('social_media') as $platform => $url)
                            @isset($url)
                                <a href="{{ config('social_media.' . $platform) }}"
                                    class="social-icon si-small bg-dark h-bg-{{ Str::lower($platform) }}">
                                    <i class="fa-brands fa-{{ Str::lower($platform) }}"></i>
                                    <i class="fa-brands fa-{{ Str::lower($platform) }}"></i>
                                </a>
                            @endisset
                        @endforeach

                        <br>
                        <br>
                        <br>
                        <br>

                    </address>


                    @isset($institueInformation->phone)
                        <a href="#" class="mb-2 d-block"><i class="bi-telephone-inbound me-2"></i>
                            {{ $institueInformation->phone }}</a>
                    @endisset
                    @isset($institueInformation->email)
                        <a href="mailto:>{{ $institueInformation->email }}"><i
                                class="bi-envelope me-2"></i>{{ $institueInformation->email }}</a>
                    @endisset
                </div>

                <div class="col-6 col-md">
                    <h4 class="text-uppercase ls-2 fw-normal">{{ $footer['footersectionsetting'][1]['value'] }}</h4>
                    <ul class="list-unstyled mb-0">

                        @foreach ($footer['section1'] as $page)
                            <li>
                                <h5 class="mb-0"><a
                                        href="{{ route('cms.web.front.page.show', $page['slug']) }}">{{ $page['name'] }}</a>
                                </h5>
                            </li>
                        @endforeach

                    </ul>
                </div>
                <div class="col-6 col-md col-sm mt-4 mt-md-0 mt-lg-0 mt-xl-0">
                    <h4 class="text-uppercase ls-2 fw-normal">{{ $footer['footersectionsetting'][2]['value'] }}</h4>
                    <ul class="list-unstyled mb-0">


                        @foreach ($footer['section2'] as $page)
                            <li>
                                <h5 class="mb-2 fw-normal"><a
                                        href="{{ route('cms.web.front.page.show', $page['slug']) }}">{{ $page['name'] }}</a>
                                </h5>
                            </li>
                        @endforeach


                    </ul>
                </div>
                <div class="col-6 col-md col-sm mt-4 mt-md-0 mt-lg-0 mt-xl-0">
                    <h4 class="text-uppercase ls-2 fw-normal"> {{ $footer['footersectionsetting'][3]['value'] }}</h4>
                    <ul class="list-unstyled mb-0">


                        @foreach ($footer['section3'] as $page)
                            <li>
                                <h5 class="mb-2 fw-normal"><a
                                        href="{{ route('cms.web.front.page.show', $page['slug']) }}">{{ $page['name'] }}</a>
                                </h5>
                            </li>
                        @endforeach


                    </ul>
                </div>


            </div>

        </div><!-- .footer-widgets-wrap end -->

    </div>
    <!-- Copyrights
============================================= -->
    <div id="copyrights">

        <div class="container">

            <div class="row align-items-center justify-content-between">
                <div class="col-md-6">
                    {!! $footer['footersectionsetting'][0]['value'] !!}
                    {{-- <div class="copyright-links"><a href="#">Terms of Use</a> / <a href="#">Privacy
                       Policy</a></div> --}}
                </div>

                {{-- <div class="col-md-6 d-flex justify-content-md-end mt-4 mt-md-0">
                <div class="copyrights-menu copyright-links mb-0">
                    <a href="#">Home</a>/<a href="#">About Us</a>/<a href="#">Price</a>/<a
                        href="#">Contact</a>
                </div>
            </div> --}}
            </div>

        </div>

    </div><!-- #copyrights end -->

</footer><!-- #footer end -->
{{-- @php
dd(\App\Models\InstitueInformation::first());

@endphp --}}
