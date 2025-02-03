@extends('layouts.master')
@section('content')
    <div class="main">
        <div class="container-fluid">
            <div class="container my-5">
                <div class="blog_body">
                    <div class="blog_header d-flex flex-column">
                        <h1>{{ $blog['title'] }}</h1>
                        <div class="posted_date">Posted On <span>{{ \Carbon\Carbon::parse($blog['published_at'])->toFormattedDateString() }}</span></div>
                        <img class="blog_banner" src="{{ $blog['image_url'] }}" alt="" loading="lazy">
                        <div class="blog_views mb-3 d-flex align-items-center">
                            <div class="bl_views">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                                <span> {{ $blog['views'] }} views</span>
                            </div>
                            <div class="bl_likes user-response-container">
                                <a href="{{ route('blogs.like', $blog['id']) }}"
                                   class="blog-like">
                                <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                                </a>
                                <span>
                                    <span class="blog-like-count">{{ $blog['total_likes'] }}</span>
                                    Likes
                                </span>
                            </div>
                        </div>
                        <div class="blog_inner_details">
                            <p>{!! $blog['body'] !!}</p>
                            <hr>
                            <div class="social_counter">
                                <a href="{{ route('blogs.like', $blog['id']) }}"
                                   class="likes">
                                    <div>
                                        <i class="fa fa-thumbs-o-up @if(count($blogUserIds)>0 && request()->session()->has('access_token'))
                                                @if(in_array($userId, $blogUserIds))
                                                    d-none @else d-inline
                                                @endif
                                            @else
                                            d-inline
                                            @endif" aria-hidden="true"></i>
                                        <i class="fa fa-thumbs-up @if(count($blogUserIds)>0 && request()->session()->has('access_token'))
                                        @if(in_array($userId, $blogUserIds))
                                            d-inline @else d-none
                                                @endif
                                        @else
                                            d-none
                                            @endif" aria-hidden="true"></i>
                                        <span class="like-Unlike">
                                            @if(count($blogUserIds)>0 && request()->session()->has('access_token'))
                                                @if(in_array($userId, $blogUserIds))
                                                    Unlike
                                                @else
                                                    Like
                                                @endif
                                            @else
                                                Like
                                            @endif
                                        </span>
                                    </div>
                                </a>
                                <div class="social_share">
                                    <a href="https://twitter.com/intent/tweet?text={{ route('blogs.show', $blog['id']) }}">  <i class="fa fa-twitter" aria-hidden="true"></i></a>
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('blogs.show', $blog['slug']) }}">  <i class="fa fa-facebook" aria-hidden="true"></i></a>
                                    <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{ route('blogs.show', $blog['slug']) }}&amp;summary=&amp;source=">  <i class="fa fa-linkedin" aria-hidden="true"></i></a>
                                    <a id="copyToClipboard" href="#">  <img src="{{ asset('assets/new_ui_assets/images/share-link.svg') }}" alt=""></a>
                                </div>
                            </div>
                            <div class="topics mt-5">
                                <ul>
                                    <li>
                                        <h6 class="m-0"><b>Topics:</b></h6>
                                    </li>
                                    @foreach ($blog['blog_tags'] as $tag)
                                        <li>
                                            <a href="{{ route('blogs.index') . '?tag_id=' . $tag['id'] }}">
                                                <span>{{ $tag['name'] }}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                @if (count($blog['related_blogs']) > 0)
                    <div class="articles">
                        <h6 class="article_title">Related Articles</h6>
                            <div class="row">
                                @foreach ($blog['related_blogs'] as $blog)
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="related_blogs">
                                            <div class="row">
                                                <div class="col-md-5 pr-0">
                                                    <div class="rel_img">
                                                        <a href="{{ route('blogs.show', $blog['slug']) }}">
                                                            <img class="w-100" src="{{ $blog['image_url'] }}" alt="">
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-md-7">
                                                    <div class="rel_details">
                                                        <a href="">
                                                            <h5>{{ $blog['title'] }}</h5>
                                                        </a>
                                                        <a href="">
                                                            <p>{{ $blog['author'] }}</p>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        <a href="" class="btn view_all mt-3">View All</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(function () {

            $(".likes").click(function(e) {
                e.preventDefault();
                let blogLikeElement = $('.like-Unlike');
                let URL = $(this).attr('href');
                let isLiked;
                blogLikeUnlike(blogLikeElement,URL,isLiked);

            });

            function blogLikeUnlike(blogLikeElement,URL,isLiked ){
                // if ($('.like-Unlike').html() == "Like") {
                //     $('.like-Unlike').html('Unlike');
                //     $('.likes .fa-thumbs-up').show();
                //     $('.likes .fa-thumbs-o-up').hide();
                // } else {
                //     $('.like-Unlike').html('Like');
                //     $('.likes .fa-thumbs-up').hide();
                //     $('.likes .fa-thumbs-o-up').show();
                // }
                @if (! request()->session()->has('access_token'))
                    $("#login-modal").show();
                    return;
                @endif

                $.ajax({
                    url: URL,
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    async: false
                }).done(function (response) {
                    isLiked = response.is_liked;
                    if(isLiked == true){
                        $('.like-Unlike').html('Unlike');
                        $('.likes .fa-thumbs-up').removeClass('d-none');
                        $('.likes .fa-thumbs-up').addClass('d-inline');
                        $('.likes .fa-thumbs-o-up').addClass('d-none');
                        $('.likes .fa-thumbs-o-up').removeClass('d-inline');
                    }
                    else {
                        $('.like-Unlike').html('Like');
                        $('.likes .fa-thumbs-up').addClass('d-none');
                        $('.likes .fa-thumbs-up').removeClass('d-inline');
                        $('.likes .fa-thumbs-o-up').removeClass('d-none');
                        $('.likes .fa-thumbs-o-up').addClass('d-inline');
                    }
                });

            }

            $('#copyToClipboard').click(function (e) {
                e.preventDefault();
//                var $temp = $("<input>");
//                var $url = $(this).attr("href");
//                $("body").append($temp);
//                $temp.val($url).select();
//                document.execCommand("copy");
//                $temp.remove();
//                alert("URL Copied.");

                var $url = $(this).attr("href");
                var textArea = document.createElement("textarea");
                textArea.value = $url
                document.body.appendChild(textArea);
                textArea.focus();
                textArea.select();

                try {
                    var successful = document.execCommand('copy');
                    var msg = successful ? 'successful' : 'unsuccessful';
                    console.log('Copying text command was ' + msg);
                } catch (err) {
                    console.log('Oops, unable to copy');
                }

                document.body.removeChild(textArea);

            });





            $('.owl-carousel').owlCarousel({
                loop: true,
                margin: 10,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 1,
                        loop: false
                    },
                    600: {
                        items: 3,
                        loop: false
                    },
                    1000: {
                        items: 3,
                        loop: false
                    }
                }
            });

            $('#order').select2({
                allowClear: true,
                placeholder: 'Order'
            });

            $('#order').change(function () {
                $(this).closest('form').submit();
            });

            $('.blog-like').click(function (e) {
                e.preventDefault();

                @if (! request()->session()->has('access_token'))
                    $("#login-modal").show();
                    return;
                @endif

                let blogLikeElement = $(this).closest('.user-response-container').find('.blog-like-count');
                let URL = $(this).attr('href');
                let totalLikes;
                let isLiked;

                $.ajax({
                    url: URL,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    async: false
                }).done(function (response) {
                    isLiked = response.is_liked;
                    totalLikes = response.total_likes;
                    if(isLiked == true){
                        $('.like-Unlike').html('Unlike');
                        $('.likes .fa-thumbs-up').removeClass('d-none');
                        $('.likes .fa-thumbs-up').addClass('d-inline');
                        $('.likes .fa-thumbs-o-up').addClass('d-none');
                        $('.likes .fa-thumbs-o-up').removeClass('d-inline');
                    }
                    else {
                        $('.like-Unlike').html('Like');
                        $('.likes .fa-thumbs-up').addClass('d-none');
                        $('.likes .fa-thumbs-up').removeClass('d-inline');
                        $('.likes .fa-thumbs-o-up').removeClass('d-none');
                        $('.likes .fa-thumbs-o-up').addClass('d-inline');
                    }
                });

                blogLikeElement.text(totalLikes);
            });

            $('.blog-share').click(function (e) {
                e.preventDefault();
                if (navigator.share) {
                    navigator.share({
                        title: document.title,
                        text: document.title,
                        url: window.location.href
                    })
                        .then(() => console.log('Share success'))
                        .catch(error => console.log('Share error:', error));
                }
            });




        });
    </script>
@endpush
