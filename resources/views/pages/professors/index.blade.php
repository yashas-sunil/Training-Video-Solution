@extends('layouts.master')
@section('content')
<div class="main">
    <div class="container">
        <div class="prof-list-title">
            <h1>Learn From the Best Professors</h1>
            <p>J. K. Shah Online is a platform which brings a new knowledge in ecosystem which helps students prepare for various professional and competitive exams like CA, CS, CMA, CFA, F.Y.J.C, S.Y.J.C Anytime, Anywhere, on Any Device.</p>
        </div>
        @if($professors)
        <div class="row">
            @foreach($professors as $professor)
                <div class="col-lg-4 col-md-4 col-sm-12 mb-5">
                    <div class="professors">
                        <a href="{{ route('ca-faculty.show', $professor['id']) }}">
                            <img src="{{$professor['image']}}" loading="lazy" title="{{$professor['title_tag']}}" alt="{{ $professor['alt'] }}">
                        </a>
                        <div class="prof-details">
                            <a href="{{ route('ca-faculty.show', $professor['id']) }}" id="proff">
                            <h2>{{$professor['name']}}</h2>
                            </a>
{{--                            <p>Professor Since: <span>2010</span></p>--}}
                            <p>Experience: <span>{{
    \Carbon\Carbon::parse($professor['career_start_at'])->diffInYears(\Carbon\Carbon::now())
    }} Years</span></p>
                            <a href="{{ route('ca-faculty.show', $professor['id']) }}" class="btn more">View More</a>
                        </div>
                    </div>
                </div>
            @endforeach
{{--            <div class="col-lg-4 col-md-4 col-sm-12 mb-5">--}}
{{--                <div class="professors">--}}
{{--                    <img src="https://picsum.photos/300/300" alt="">--}}
{{--                    <div class="prof-details">--}}
{{--                        <h2>Bhavin Gandhi</h2>--}}
{{--                        <p>Professor Since: <span>2010</span></p>--}}
{{--                        <p>Experince: <span>8 Years</span></p>--}}
{{--                        <a href="" class="btn more">View More</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-lg-4 col-md-4 col-sm-12 mb-5">--}}
{{--                <div class="professors">--}}
{{--                    <img src="https://picsum.photos/300/300" alt="">--}}
{{--                    <div class="prof-details">--}}
{{--                        <h2>Bhavin Gandhi</h2>--}}
{{--                        <p>Professor Since: <span>2010</span></p>--}}
{{--                        <p>Experince: <span>8 Years</span></p>--}}
{{--                        <a href="" class="btn more">View More</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-lg-4 col-md-4 col-sm-12 mb-5">--}}
{{--                <div class="professors">--}}
{{--                    <img src="https://picsum.photos/300/300" alt="">--}}
{{--                    <div class="prof-details">--}}
{{--                        <h2>Bhavin Gandhi</h2>--}}
{{--                        <p>Professor Since: <span>2010</span></p>--}}
{{--                        <p>Experince: <span>8 Years</span></p>--}}
{{--                        <a href="" class="btn more">View More</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-lg-4 col-md-4 col-sm-12 mb-5">--}}
{{--                <div class="professors">--}}
{{--                    <img src="https://picsum.photos/300/300" alt="">--}}
{{--                    <div class="prof-details">--}}
{{--                        <h2>Bhavin Gandhi</h2>--}}
{{--                        <p>Professor Since: <span>2010</span></p>--}}
{{--                        <p>Experince: <span>8 Years</span></p>--}}
{{--                        <a href="" class="btn more">View More</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-lg-4 col-md-4 col-sm-12 mb-5">--}}
{{--                <div class="professors">--}}
{{--                    <img src="https://picsum.photos/300/300" alt="">--}}
{{--                    <div class="prof-details">--}}
{{--                        <h2>Bhavin Gandhi</h2>--}}
{{--                        <p>Professor Since: <span>2010</span></p>--}}
{{--                        <p>Experince: <span>8 Years</span></p>--}}
{{--                        <a href="" class="btn more">View More</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-lg-4 col-md-4 col-sm-12 mb-5">--}}
{{--                <div class="professors">--}}
{{--                    <img src="https://picsum.photos/300/300" alt="">--}}
{{--                    <div class="prof-details">--}}
{{--                        <h2>Bhavin Gandhi</h2>--}}
{{--                        <p>Professor Since: <span>2010</span></p>--}}
{{--                        <p>Experince: <span>8 Years</span></p>--}}
{{--                        <a href="" class="btn more">View More</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
        @endif
    </div>
</div>
@endsection
