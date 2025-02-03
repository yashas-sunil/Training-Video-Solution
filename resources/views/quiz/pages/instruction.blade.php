@extends('layouts.master')

@section('title', 'Start Test')

@section('content')
    <main role="main" class="main-section">
        <section class="reeachplatform">
            <div class="container">
                <br>
                <div class="row">
                    <div class="col-sm-12 section-title text-center">
                        <h2>Reach of the Platform</h2>
                    </div>
                </div>
                <div class="platform-sec text-center">
                    <div class="row">
                        {!! $test->getInstruction->description !!}
                    </div>
                    <br>
                    <br>
                    <a href="{{ route('quiz.start-test', ['ID' => encrypt($test->id)]) }}" class="btn btn-primary btn-lg">Start Test</a>
                </div>
            </div>
            <br>
        </section>
    </main>
@endsection

@push('scripts')
    <script>
        MathJax = {
            tex: {
                inlineMath: [['$', '$'], ['\\(', '\\)']]
            },
            svg: {
                fontCache: 'global'
            }
        };
    </script>
    <script type="text/javascript" id="MathJax-script" async
            src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-svg.js">
    </script>
@endpush
