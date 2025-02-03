@extends('layouts.master')
@section('content')
    <div class="main">
        <div class="page-wrapper chiller-theme toggled" id="dashboard_sidebar">
            <a id="show-sidebar" class="btn btn-sm">
                <i class="fa fa-chevron-right" aria-hidden="true"></i>
            </a>
            @include('includes.student-menu')
            <main class="page-content">
                <div class="container-fluid" id="main_dashboard">
                    <div class="mb-5">
                        <h6 class="performance-title">
                            Performance & Scores
                        </h6>
                    </div>
                    <div class="container-fluid p-0">
                        <div class="performace">
                            <div class="row">
                                <div class="col-lg-5 col-md-5 col-sm-12">
                                    <div class="performances">
                                        <h6 class="perform_title">Performance</h6>

                                        <hr class="hr-1">

                                        <div class="performance-content mb-4">

                                            <div class="performance-inner">
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <h6 class="progress-title">Financial Reporting</h6>
                                                    </div>
                                                    <div>
                                                        <h6 class="progress-number">25%</h6>
                                                    </div>
                                                </div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-orange" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>


                                            <hr>


                                            <div class="d-flex justify-content-between ">
                                                <div>
                                                    <h6 class="progress-title">Financial Reporting</h6>
                                                </div>
                                                <div>
                                                    <h6 class="progress-number">45%</h6>
                                                </div>
                                            </div>
                                            <div class="progress">
                                                <div class="progress-bar bg-blue" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>


                                            <hr>


                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <h6 class="progress-title">Advanced Auditing and Professional Ethics</h6>
                                                </div>
                                                <div>
                                                    <h6 class="progress-number">20%</h6>
                                                </div>
                                            </div>
                                            <div class="progress">
                                                <div class="progress-bar bg-red" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>


                                            <hr>


                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <h6 class="progress-title">Corporate Laws and Economic Laws Part I</h6>
                                                </div>
                                                <div>
                                                    <h6 class="progress-number">80%</h6>
                                                </div>
                                            </div>
                                            <div class="progress">
                                                <div class="progress-bar bg-green" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>


                                            <hr>


                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <h6 class="progress-title">Financial Reporting</h6>
                                                </div>
                                                <div>
                                                    <h6 class="progress-number">25%</h6>
                                                </div>
                                            </div>
                                            <div class="progress">
                                                <div class="progress-bar bg-orange" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>


                                            <hr>


                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <h6 class="progress-title">Financial Reporting</h6>
                                                </div>
                                                <div>
                                                    <h6 class="progress-number">45%</h6>
                                                </div>
                                            </div>
                                            <div class="progress">
                                                <div class="progress-bar bg-blue" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>


                                            <hr>


                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <h6 class="progress-title">Advanced Auditing and Professional Ethics</h6>
                                                </div>
                                                <div>
                                                    <h6 class="progress-number">20%</h6>
                                                </div>
                                            </div>
                                            <div class="progress">
                                                <div class="progress-bar bg-red" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>


                                            <hr>


                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <h6 class="progress-title">Corporate Laws and Economic Laws Part I</h6>
                                                </div>
                                                <div>
                                                    <h6 class="progress-number">80%</h6>
                                                </div>
                                            </div>
                                            <div class="progress">
                                                <div class="progress-bar bg-green" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>

                                        </div>
                                    </div>
                                </div>


                                <div class="col-lg-7 col-md-7 col-sm-12">
                                    <div class="average_scores">
                                        <h6 class="avg_title">Average Subject Scores</h6>

                                        <hr class="hr">

                                        <div class="row col-right-content mt-5 p-2">

                                            <div class="col-lg-4 col-md-6 col-6">
                                                <div class="ldBar label-center mb-2" data-value="100" data-preset="circle">
                                                </div>
                                                <p class="progress-label">
                                                    Financial Reporting
                                                </p>
                                            </div>

                                            <div class="col-lg-4 col-md-6 col-6">
                                                <div class="ldBar label-center mb-2" data-value="50" data-preset="circle"> </div>
                                                <p class="progress-label">
                                                    Stratagic Financial Management
                                                </p>
                                            </div>

                                            <div class="col-lg-4 col-md-6 col-6">
                                                <div class="ldBar label-center" data-value="60" data-preset="circle"></div>
                                                <p class="progress-label">
                                                    Advanced Auditing and Professional Ethics
                                                </p>
                                            </div>


                                            <div class="col-lg-4 col-md-6 col-6">
                                                <div class="ldBar label-center mb-2" data-value="80" data-preset="circle">
                                                </div>
                                                <p class="progress-label">
                                                    Financial Reporting
                                                </p>
                                            </div>

                                            <div class="col-lg-4 col-md-6 col-6">
                                                <div class="ldBar label-center mb-2" data-value="50" data-preset="circle"> </div>
                                                <p class="progress-label">
                                                    Stratagic Financial Management
                                                </p>
                                            </div>

                                            <div class="col-lg-4 col-md-6 col-6">
                                                <div class="ldBar label-center" data-value="60" data-preset="circle"></div>
                                                <p class="progress-label">
                                                    Advanced Auditing and Professional Ethics
                                                </p>
                                            </div>


                                            <div class="col-lg-4 col-md-6 col-6">
                                                <div class="ldBar label-center mb-2" data-value="80" data-preset="circle">
                                                </div>
                                                <p class="progress-label">
                                                    Financial Reporting
                                                </p>
                                            </div>

                                            <div class="col-lg-4 col-md-6 col-6">
                                                <div class="ldBar label-center mb-2" data-value="50" data-preset="circle"> </div>
                                                <p class="progress-label">
                                                    Stratagic Financial Management
                                                </p>
                                            </div>

                                            <div class="col-lg-4 col-md-6 col-6">
                                                <div class="ldBar label-center" data-value="60" data-preset="circle"></div>
                                                <p class="progress-label">
                                                    Advanced Auditing and Professional Ethics
                                                </p>
                                            </div>
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
@endsection
@push('script')
    <script>

        $(function() {

        });
    </script>
@endpush
