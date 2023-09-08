@extends('frontend.layouts.master')
@section('title')
    @lang('site.blog')
@endsection
@section('css')
@endsection

@section('content')
    <section id="content">
        <div class="content-wrap">
            <div class="container">
                <div class="row gx-5 col-mb-80">
                    <main class="postcontent col-lg-9">
                        <div class="single-post mb-0">
                            <div class="entry">
                                <div class="entry-title">
                                    <h2>{{ $blog['title'] }}</h2>
                                </div>
                                <div class="entry-meta">
                                    <ul>
                                        <li><i class="uil uil-schedule"></i>{{ $blog['created_at'] }}</li>
                                        <li><a href="#"><i class="uil uil-user"></i> admin</a></li>
                                        {{-- <li><i class="uil uil-folder-open"></i> <a href="#">General</a>, <a href="#">Media</a></li> --}}
                                        <li><a href="#"><i class="uil uil-comments-alt"></i> </a></li>
                                        {{-- <li><a href="#"><i class="uil uil-camera"></i></a></li> --}}
                                    </ul>
                                </div>
                                <div class="entry-image">
                                    <a href="#"><img src="{{ asset($blog['thumbnail']) }}" alt="Blog Single"></a>
                                </div>

                                <div class="entry-content mt-0">
                                    <p>{!! $blog['description'] !!}</p>
                                    <div class="tagcloud mb-5">
                                        @isset($blog['tags'])
                                            @foreach ($blog['tags'] as $tag)
                                                <a href="#">{{ $tag }}</a>
                                            @endforeach
                                        @endisset

                                    </div>

                                    <div class="card border-default my-4">
                                        <div class="card-body p-3">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h6 class="fs-6 fw-semibold mb-0">Share:</h6>
                                                <div class="d-flex">
                                                    <a href="#"
                                                        class="social-icon si-small text-white border-transparent rounded-circle bg-facebook"
                                                        title="Facebook">
                                                        <i class="fa-brands fa-facebook-f"></i>
                                                        <i class="fa-brands fa-facebook-f"></i>
                                                    </a>

                                                    <a href="#"
                                                        class="social-icon si-small text-white border-transparent rounded-circle bg-twitter"
                                                        title="Twitter">
                                                        <i class="fa-brands fa-twitter"></i>
                                                        <i class="fa-brands fa-twitter"></i>
                                                    </a>

                                                    <a href="#"
                                                        class="social-icon si-small text-white border-transparent rounded-circle bg-pinterest"
                                                        title="Pinterest">
                                                        <i class="fa-brands fa-pinterest-p"></i>
                                                        <i class="fa-brands fa-pinterest-p"></i>
                                                    </a>

                                                    <a href="#"
                                                        class="social-icon si-small text-white border-transparent rounded-circle bg-whatsapp"
                                                        title="Whatsapp">
                                                        <i class="fa-brands fa-whatsapp"></i>
                                                        <i class="fa-brands fa-whatsapp"></i>
                                                    </a>

                                                    <a href="#"
                                                        class="social-icon si-small text-white border-transparent rounded-circle bg-rss"
                                                        title="RSS">
                                                        <i class="fa-solid fa-rss"></i>
                                                        <i class="fa-solid fa-rss"></i>
                                                    </a>

                                                    <a href="#"
                                                        class="social-icon si-small text-white border-transparent rounded-circle bg-email3 me-0"
                                                        title="Mail">
                                                        <i class="fa-solid fa-envelope"></i>
                                                        <i class="fa-solid fa-envelope"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          
                        </div>

                    </main>

                </div>

            </div>
        </div>
    </section>
    <section id="content">
        <div class="content-wrap">
            <div class="container">
                <h2>@lang('site.write comment here')</h2>
                <form id="comment">
                   
                    <div class="row">

                        <div class="col-md-8 ">
                            <div class="primary_input mb-25">
                                <label class="form-section">@lang('site.name') </label> <span class="text-danger">*</span>
                                <textarea class="form-control" name="comment" id="comment" autocomplete="off"></textarea>

                                <span id="comment_" class="text-danger"></span>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-4">

                            @guest
                                <div class="btn btn-outline-primary">
                                    <a href="{{ route('login') }}">@lang('site.you must be login to write comment')</a>
                                </div>
                            @else
                                @csrf


                                <input type="hidden" name="slug" value="{{ $blog['slug'] }}">

                                <input type="hidden" name=" blog_id" value="{{ $blog['id'] }}">

                                <div class="btn btn-outline-primary">
                                    <a
                                        onclick="submit('{{ route('cms.web.front.comment.post') }}','comment')">@lang('site.write comment')</a>
                                </div>

                            @endguest
                        </div>
                    </div>

                </form>




                <div id="comments">

                    <h3 id="comments-title"><span></span> Comments</h3>

                    <ol class="commentlist">
                        {{ render_comment($comments) }}
                    </ol>

                    <div class="clear"></div>




                </div>

            </div>
        </div>
    </section>


  
    @include('cms::frontend.blog.post-details-and-comment.replay')
    @include('cms::frontend.blog.post-details-and-comment.edit-comment')
  

    </div>
@endsection
@section('script')
{{-- --}}
    <script src="{{ URL::asset('Modules/Cms/assets/custome_js/save_and_redirect.js') }}"></script>
    <script src="{{ URL::asset('Modules/Cms/assets/custome_js/delete.js') }}"></script>
    <script src="{{ URL::asset('Modules/Cms/assets/custome_js/comment.js') }}"></script>
@endsection
