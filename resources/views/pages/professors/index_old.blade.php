@extends('layouts.master')

@section('title', 'Professor')

@section('content')
    <main class="Professors px-md-2 px-sm-2 py-4 " role="main">
        <div class="container-fluid ">

            <div class="row mt-3">
                <div class="col-md-10 offset-md-1">
                    <h1 class="text-secondary">Professors / CA Faculty At JK Shah Online Classes</h1>
                    <div class="border shadow p-5">
                        <div class="row row-cols-1 row-cols-md-3">
                            @if($professors)
                                @foreach($professors as $professor)
                                    <div class="col mb-4">
                                        <a href="{{route('ca-faculty.show', $professor['id'])}}" class="text-decoration-none text-dark">
                                            <div class="card h-100">
                                                <img src="{{$professor['image']}}" class="card-img-top" title="{{$professor['title_tag']}}" alt="{{ $professor['alt'] }}">
                                                <div class="card-body">
                                                    <h5 class="card-title mb-0">{{ucfirst($professor['name'])}}</h5>
                                                    <small class="text-muted">{{ $professor['experience'] }} Years Experience</small>

                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
