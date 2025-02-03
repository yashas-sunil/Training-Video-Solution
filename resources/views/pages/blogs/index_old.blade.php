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
                            <div class="col-md-4 my-auto">
                                <select class="form-control" id="order" name="order">
                                    <option></option>
                                    <option value="featured" @if (request()->input('order') == 'featured') selected @endif>Sort By: Featured</option>
                                    <option value="des" @if (request()->input('order') == 'des') selected @endif>Sort By: Popular</option>
                                    <option value="latest" @if (request()->input('order') == 'latest') selected @endif>Sort By: Latest</option>
                                    <option value="oldest" @if (request()->input('order') == 'oldest') selected @endif>Sort By: Oldest</option>
                                </select>
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
                    <div class="col-sm-3 my-3">
                        <a href="{{ route('blogs.index') . '?tag_id=' . $blogTag['id'] }}">{{ $blogTag['name'] }}</a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <main class="course-list">
        <div class="container mt-3">
            <div class="row mb-5">
                @if (count($blogs['data']) > 0)
                    @foreach ($blogs['data'] as $blog)
                        @if ($loop->index <= 1)
                            <div class="col-md-6 mb-5">
                                <a class="text-dark text-decoration-none" href="{{ route('blogs.show', $blog['slug']) }}">
                                    <div class="card rounded h-100">
                                        <img class="card-img" src="{{ $blog['image_url'] }}" alt="">
                                        <div class="card-img-overlay d-flex flex-column justify-content-end" style="background: rgba(255, 255, 255, 0.7); top: auto">
                                            <div class="row" >
                                                <div class="col-md-12">
                                                    <p class="card-text">{{ $blog['category']['name'] ?? '' }}</p>
                                                    <h5 class="card-title" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;">{{ $blog['title'] }}</h5>
                                                    <div class="row">
                                                        <div class="col">
                                                            <small><span><i class="fas fa-eye"></i> {{ $blog['views'] }}</span></small> | <small><span><i class="fas fa-thumbs-up"></i> {{ $blog['total_likes'] }}</span></small>
                                                        </div>
                                                        <div class="col-auto text-right">
                                                            <small>{{ \Carbon\Carbon::parse($blog['published_at'])->toFormattedDateString() }}</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @else
                            <div class="col-md-4 mb-5">
                                <a class="text-dark text-decoration-none" href="{{ route('blogs.show', $blog['slug']) }}">
                                    <div class="card rounded h-100">
                                        <img class="card-img" src="{{ $blog['image_url'] }}" alt="">
                                        <div class="card-img-overlay d-flex flex-column justify-content-end" style="background: rgba(255, 255, 255, 0.7); top: auto">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p class="card-text">{{ $blog['category']['name'] ?? '' }}</p>
                                                    <h5 class="card-title" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;">{{ $blog['title'] }}</h5>
                                                    <div class="row">
                                                        <div class="col">
                                                            <small><span><i class="fas fa-eye"></i> {{ $blog['views'] }}</span></small> | <small><span><i class="fas fa-thumbs-up"></i> {{ $blog['total_likes'] }}</span></small>
                                                        </div>
                                                        <div class="col-auto text-right">
                                                            <small>{{ \Carbon\Carbon::parse($blog['published_at'])->toFormattedDateString() }}</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif
                    @endforeach
                @else
                    <div class="col-md-12">
                        <div class="text-center">
                            <h5>NO DATA</h5>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </main>
@endsection

@push('script')
    <script>
        $(function () {
            $('#order').select2({
                allowClear: true,
                placeholder: 'Sort By'
            });

            $('#order').change(function () {
                $(this).closest('form').submit();
            });
        });
    </script>
@endpush
