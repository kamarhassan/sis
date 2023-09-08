@extends('frontend.layouts.master')
@section('title')
    @lang('site.blog')
@endsection
@section('css')
    {{-- <link rel="stylesheet" href="{{URL::asset('Modules/Cms/assets/blog/modern-blog.css')}}"> --}}
    <style>
        .limited {
            display: -webkit-box;
            /* Use old flexbox syntax for WebKit compatibility */
            -webkit-box-orient: vertical;
            /* Set the flexbox orientation to vertical */
            overflow: hidden;
            /* Hide the content that exceeds the container's height */
            -webkit-line-clamp: 1;
            /* Limit the content to 3 lines */
            text-overflow: ellipsis;
        }
    </style>
@endsection

@section('content')

    <section id="content">
        <div class="content-wrap">
            <div class="container">

                <div class="row gx-5 col-mb-80">

                    <main class="postcontent col-lg-12">


                        <div id="posts" class="row grid-container gutter-30">
                            @isset($blog_post)
                                @foreach ($blog_post as $post)
                                    <div class="col-md-4 mb-5">
                                        <div class="card course-card hover-effect border-0">

                                            <a href="{{route('cms.web.blog.post.detail',$post['slug'])}}"><img class="card-img-top" src="{{ asset($post['thumbnail']) }}"
                                                    alt="Card image cap">
                                            </a>
                                            <div class="card-body">
                                                <h4 class="card-title fw-bold mb-2"><a href="">{{ $post['title'] }}</a>
                                                </h4>
                                                <div class="limited">

                                                    <p>{!! $post['description'] !!}...</p>
                                                </div>
                                                <a href="{{route('cms.web.blog.post.detail',$post['slug'])}}"
                                                    class="button button-border button-rounded button-green">@lang('site.read more')</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endisset
                        </div>
                    </main>
                </div>
            </div>
        </div>
    </section>
@endsection


@section('script')
    {{-- <script src="js/plugins.infinitescroll.js"></script> --}}
    <script>
        // Infinity Scroll
        jQuery(window).on('load', function() {
            var $container = jQuery('.infinity-wrapper');

            $container.infiniteScroll({
                path: '.load-next-posts',
                history: false,
                status: '.page-load-status',
            });

            $container.on('load.infiniteScroll', function(event, response, path) {
                var $items = jQuery(response).find('.infinity-loader');
                // append items after images loaded
                $items.imagesLoaded(function() {
                    $container.append($items);
                    $container.isotope('insert', $items);
                    setTimeout(function() {
                        SEMICOLON.Modules.resizeVideos();
                        SEMICOLON.Modules.lightbox();
                        SEMICOLON.Modules.flexSlider();
                    }, 1000);
                });
            });
        });
    </script>
@endsection
