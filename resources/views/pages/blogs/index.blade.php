@extends('layouts.master')
@section('content')
<div class="main">

    <div class="b-lists">
        <div class="blog-info">
            <div class="b-head">
                <h1>J. K. Shah Blog</h1>
                <p>J. K. Shah Online is the top hub for students prepare for various professional and competitive
                    exams
                    like CA, CA Foundation, F.Y.J.C & S.Y.J.C.

                </p>
                <div class="row justify-content-center m-md-0">
                    <form id="search-demo">
                        <i class="fa fa-search" aria-hidden="true"></i>
                        <input type="text" placeholder="What are you looking for?" id="text" name="text">
                    </form>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="list-of-blogs">
                <div class="row">
                    @if (count($blogs['data']) > 0)
                        @foreach ($blogs['data'] as $key => $blog)
{{--                            @if ($loop->index <= 1)--}}
                            @if ($loop->index == 5)
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="list-ad">
                                        <div class="inner-details p-md-3">
                                            <h4>Guide to understand the stages of CA</h4>

                                            <a href="" class="btn signup">Signup</a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="list-inner user-response-container">
                                        <a  href="{{ route('blogs.show', $blog['slug']) }}">
                                        <img src="{{ $blog['image_url'] }}" alt="" />
                                        </a>
                                        <div class="inner-details p-md-3">
                                        <a  href="{{ route('blogs.show', $blog['slug']) }}">
                                            <h4>{{ \Illuminate\Support\Str::limit($blog['title'], env('TRIM_SIZE'), $end='...') }}</h4>
                                            </a>
                                            <h6>{{ \Carbon\Carbon::parse($blog['published_at'])->toFormattedDateString() }}</h6>
                                            <ul>
                                                <li>
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                    <span>{{ $blog['views'] }}</span>
                                                </li>
                                                <li>
                                                    <a href="{{ route('blogs.like', $blog['id']) }}"
                                                       class="blog-like">
                                                    <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                                                    </a>
                                                    <span class="blog-like-count">{{ $blog['total_likes'] }}</span>
                                                </li>
                                            </ul>
                                            <p></p>
                                        </div>
                                    </div>
                                </div>

{{--                            @endif--}}
                        @endforeach
                    @endif


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
    <script>
        $(function () {

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
                });

                blogLikeElement.text(totalLikes);
            });

        });
    </script>
@endpush
