@extends('layouts.master')

@section('title', 'Blogs')

@section('content')
    <div class="bg-light">
        <div class="container">
            <form method="GET" action="{{ route('blogs.index') }}">
                <div class="row py-3">
                    <div class="col-md-2 my-auto">
                        <h3 class="text-secondary">Blogs</h3>
                    </div>
                    <div class="col-md-8 my-auto">
                        <div class="row justify-content-center">
                            <div class="col-md-8 my-auto">
                                <div class="input-group">
                                    <input class="form-control" name="search" type="text" placeholder="Search" value="{{ request()->input('search')  }}" autocomplete="off">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 my-auto">
                        <a class="btn btn-sm btn-primary rounded-pill text-white float-right" data-toggle="collapse" href="#categoriesCollapse" >Topics <i class="fas fa-chevron-down"></i></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="collapse bg-light" id="categoriesCollapse" style="position: absolute; z-index: 1000; width: 100%;">
        <div class="container">
            <div class="row">
                @foreach ($blogTags as $blogTag)
                    <div class="col-md-3 my-3">
                        <a href="{{ route('blogs.index') . '?tag_id=' . $blogTag['id'] }}">{{ $blogTag['name'] }}</a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <main class="course-list">
        <div class="container">
            <div class="row mt-5 justify-content-center">
                <div class="col-md-7">
                    <h1 class="text-secondary my-3">{{ $blog['title'] }}</h1>
                    <div class="row my-3">
                        <div class="col-md-12">
                            <span class="text-muted small"><i class="fas fa-calendar"></i> {{ \Carbon\Carbon::parse($blog['published_at'])->toFormattedDateString() }} | <i class="fas fa-user"></i> {{ $blog['author'] }} | <i class="fas fa-eye"></i> {{ $blog['views'] }}</span>
                        </div>
                    </div>
                    <hr class="my-5" />
                    <div class="row my-3">
                        <div class="col-md-12">
                            <img class="img-fluid" src="{{ $blog['image_url'] }}" alt="">
                        </div>
                    </div>
                    <div class="row mt-5 mb-3">
                        <div class="col-md-12">
                            <div id="body">{!! $blog['body'] !!}</div>
                        </div>
                    </div>
                    <hr class="my-3" />
                    <div class="row">
                        <div class="col-md-12">
                            <div class="user-response-container">
                                <span>
                                    <span class="blog-like-count">
                                        {{ $blog['total_likes'] }}
                                    </span> Likes
                                </span>
                                <span>
                                   <a href="{{ route('blogs.like', $blog['id']) }}"
                                      class="text-secondary p-2 blog-like"><i class="far fa-thumbs-up"></i>
                                   </a>
                                </span>
                                <span class="d-md-none">
                                   <a href=""
                                      class="text-secondary p-2 blog-share"><i class="far fa-share-square"></i>
                                   </a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row d-none d-md-block">
                        <div class="col-md-12 text-center my-3">
                            Share:
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('blogs.show', $blog['slug']) }}" target="_blank" class="btn-round-md bg-facebook">
                                <img class="mx-1" src="{{ asset('assets/images/facebook.png') }}" width="32px">
                            </a>
                            <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{ route('blogs.show', $blog['slug']) }}&amp;summary=&amp;source=" target="_blank" class="btn-round-md bg-linkedin">
                                <img class="mx-1" src="{{ asset('assets/images/linkedin.png') }}" width="32px">
                            </a>
                            <a href="https://twitter.com/intent/tweet?text={{ route('blogs.show', $blog['id']) }}" target="_blank"><img class="mx-1" src="{{ asset('assets/images/twitter.png') }}" width="32px"></a>
                            {{--Copy Link:--}}

                            {{--<a id="copyToClipboard" href="{{ route('blogs.show', $blog['slug']) }}" ><img class="mx-1" src="{{ asset('assets/images/copy.png') }}" width="32px"></a>--}}

                        </div>



                    </div>

                    <div class="row my-3">
                        <div class="col-md-12">
                            <span class="text-muted"><i class="fas fa-tag"></i> Topics: </span>
                            @foreach ($blog['blog_tags'] as $tag)
                                <a href="{{ route('blogs.index') . '?tag_id=' . $tag['id'] }}" class="btn btn-sm btn-primary rounded-pill text-white">{{ $tag['name'] }}</a>
                            @endforeach
                        </div>
                    </div>
                    <div class="my-5">
                        @if (count($blog['related_blogs']) > 0)
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Related Articles</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="owl-carousel owl-theme">
                                        @foreach ($blog['related_blogs'] as $blog)
                                            <a href="{{ route('blogs.show', $blog['slug']) }}">
                                                <img class="w-100" src="{{ $blog['image_url'] }}" alt="">
                                                <div><strong>{{ $blog['title'] }}</strong></div>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('script')
    <script>
        $(function () {

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
                $('#modal-login').modal('toggle');
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
