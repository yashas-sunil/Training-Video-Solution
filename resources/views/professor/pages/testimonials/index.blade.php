@extends('layouts.master')

@section('title', 'Associate Profile')

@section('content')
    <main class="professor-profile" role="main">
        <div class="container-fluid py-4 px-5">
            <h3 class="text-secondary">{{ $professor['name'] }}</h3>
            <div class="row mt-3">
                <div class="col-md-auto mb-5 professor-profile-menu">
                    <div class="professor-profile-menu-content border shadow bg-white">
                        <div class="professor-profile-menu-image-container">
                            <img src="{{ $professor['image'] ?? url('assets/images/avatar.png') }}" alt="..." class="img-thumbnail">
                        </div>
                        <div class="text-center p-2"><a href="#" id="upload"><i class="fa fa-camera p-2 text-muted"></i></a></div>
                        <form id="form-update-image" method="POST" action="{{ route('professor.profile.store') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="file" id="image" name="image" style="display: none;" onchange="this.form.submit();"/>
                        </form>
                        <ul class="list-group text-secondary pb-4">
                            <li class="list-group-item"><a href="{{ route('professor.dashboard.index') }}">Dashboard</a></li>
                            <li class="list-group-item"><a href="{{ route('professor.profile.index') }}">Profile</a></li>
                            <li class="list-group-item"><a href="{{ route('professor.questions.index') . '?questions=1&answers=1' }}">Ask A Question</a></li>
                            <li class="list-group-item"><a href="{{ route('professor.notes.index') }}">Notes</a></li>
                            <li class="list-group-item"><a href="{{ route('professor.reports.index') }}">Reports</a></li>
                            <li class="list-group-item"><a href="{{ route('professor.revenues.index') }}">Revenue</a></li>
                            <li class="list-group-item"><a href="{{ route('professor.packages.index') }}">Packages</a></li>
                            <li class="list-group-item"><a href="#" data-toggle="modal" data-target="#modal-change-password">Change Password</a></li>
                            <form id="logout" method="POST" action="{{ url('/logout') }}">
                                @csrf
                                <li class="list-group-item"><a href="#" onclick="document.getElementById('logout').submit();">Logout</a></li>
                            </form>
                        </ul>
                    </div>
                </div>
                <div class="col-md">
                    <div class="border shadow mt-4 mt-md-0 p-5">
                        <h3 class="text-primary mb-4"> Testimonials</h3>
                        @if($testimonials)
                        @foreach($testimonials as $testimonial)
                            <div class="row mb-4 border-bottom border-primary pb-3">
                                <div class="media">
                                    <div class="professor-profile-image align-self-start mr-4">
                                    <img src="{{ $testimonial['student']['image'] ?? url('assets/images/avatar.png' ) }}" class="" alt="...">
                                    </div>
                                    <div class="media-body">
                                        <h6 class="mt-0"><b>{{ $testimonial['student']['name'] }}</b></h6>
                                        <p>{{ $testimonial['testimonial'] }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @else
                            <div class="mt-4">
                                <p>Currently you have no testimonials !</p>
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
        $(function() {
            $("#upload").click(function(){
                $("#image").click();
            });

            @if (session()->has('success'))
                alert('{{ session()->get('success') }}');
            @endif
        });
    </script>
@endpush
