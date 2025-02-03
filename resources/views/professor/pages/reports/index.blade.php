@extends('layouts.master')

@section('title', 'Professor Profile')

@section('content')
    <main class="professor-profile" role="main">
        <div class="container-fluid py-4 px-5">
            <h3 class="text-secondary"><b>{{ $professor['name'] }}</b></h3>
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
                            <!-- <li class="list-group-item"><a href="{{ route('professor.questions.index') . '?questions=1&answers=1' }}">Ask A Question</a></li> -->
                            <li class='sub-menu list-group-item'><a href='#settings'>Ask A Question <div class='pl-2 fa fa-caret-down right'></div></a>
                            
                            <ul class="list-group text-secondary">
                                <li  class="list-group-item"><a href="{{ route('professor.questions.index') . '?questions=1&answers=1' }}">Pending Question</a></li>
                                <li  class="list-group-item"><a href="{{ url('professor/answerd_question')}}">Answerd Question</a></li>
                            </ul>
                            </li>
                            <li class="list-group-item"><a href="{{ route('professor.notes.index') }}">Notes</a></li>
                            <li class="list-group-item"><a href="{{ route('professor.reports.index') }}">Reports</a></li>
                            <li class="list-group-item"><a href="{{ route('professor.packages.index') }}">Packages</a></li>
                            <li class="list-group-item"><a href="{{ route('professor.revenues.index') }}">Revenue</a></li>
                            <li class="list-group-item"><a href="#" data-toggle="modal" data-target="#modal-change-password">Change Password</a></li>
                            <form id="logout" method="POST" action="{{ url('/logout') }}">
                                @csrf
                                <li class="list-group-item"><a href="#" onclick="document.getElementById('logout').submit();">Logout</a></li>
                            </form>
                        </ul>
                    </div>
                </div>
                <div class="col-md">
                    <div class="border shadow mt-4 mt-md-0">
                        <div class="p-4">
                            <h5>Reports</h5>
                            <form id="form-filter" method="GET" action="{{ route('professor.reports.index') }}">
                                <div class="row mt-5">
                                    <div class="col-md-3">
                                        <div class="form-group row">
                                            <label class="col-md-4 col-form-label">From Date</label>
                                            <div class="col-md-8">
                                                <input class="form-control" id="from-date" name="from_date" placeholder="From Date" autocomplete="off" value="{{ request()->input('from_date') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">To Date</label>
                                            <div class="col-md-9">
                                                <input class="form-control" id="to-date" name="to_date" placeholder="To Date" autocomplete="off" value="{{ request()->input('to_date') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <button type="submit" class="btn btn-primary">Filter</button>
                                        <a href="{{ route('professor.reports.index') }}" class="btn btn-primary">Clear</a>
                                    </div>
                                </div>
                            </form>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table mt-3">
                                            <thead class="bg-primary">
                                            <tr>
                                                <th class="text-light border-0 font-weight-normal" scope="col">Package</th>
                                                <th class="text-light border-0 font-weight-normal" scope="col">Date of Purchase</th>
                                                <th class="text-light border-0 font-weight-normal" scope="col">Price</th>
                                                <th class="text-light border-0 font-weight-normal" scope="col">Student</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($orderItems['data'] as $orderItem)
                                                <tr>
                                                    <td class="pt-4">{{ $orderItem['package'] ? $orderItem['package']['name'] : '-' }}</td>
                                                    <td class="pt-4">{{ \Carbon\Carbon::parse($orderItem['created_at'])->toDayDateTimeString() }}</td>
                                                    <td class="pt-4">₹ {{ $orderItem['price'] }}</td>
                                                    <td class="pt-4">{{ $orderItem['user'] ? $orderItem['user']['name'] : '-' }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>

                                        <div>
                                            @if ($orderItems)
                                                <nav aria-label="...">
                                                    <ul class="pagination">
                                                        <li class="page-item">
                                                            <a class="page-link" href="?page=1{{ request()->filled('from_date') && request()->filled('to_date') ? '&from_date=' . request()->input('from_date') . '&to_date=' . request()->input('to_date') : '' }}">First</a>
                                                        </li>
                                                        <li class="page-item @if (! $orderItems['prev_page_url']) disabled @endif">
                                                            <a class="page-link" href="?page={{ $orderItems['current_page'] - 1 }}{{ request()->filled('from_date') && request()->filled('to_date') ? '&from_date=' . request()->input('from_date') . '&to_date=' . request()->input('to_date') : '' }}">Previous</a>
                                                        </li>
                                                        <li class="page-item @if (! $orderItems['next_page_url']) disabled @endif">
                                                            <a class="page-link" href="?page={{ $orderItems['current_page'] + 1 }}{{ request()->filled('from_date') && request()->filled('to_date') ? '&from_date=' . request()->input('from_date') . '&to_date=' . request()->input('to_date') : '' }}">Next</a>
                                                        </li>
                                                        <li class="page-item">
                                                            <a class="page-link" href="?page={{ $orderItems['last_page'] }}{{ request()->filled('from_date') && request()->filled('to_date') ? '&from_date=' . request()->input('from_date') . '&to_date=' . request()->input('to_date') : '' }}">Last</a>
                                                        </li>
                                                    </ul>
                                                </nav>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('professor.pages.includes.change-password')
    </main>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('.sub-menu ul').hide();
            $(".sub-menu a").click(function () {
                $(this).parent(".sub-menu").children("ul").slideToggle("100");
                $(this).find(".right").toggleClass("fa-caret-up fa-caret-down");
            });
            setCurrentDate();

            function setCurrentDate()
            {
                var now = new Date();
                var day = ("0" + now.getDate()).slice(-2);
                var month = ("0" + (now.getMonth() + 1)).slice(-2);
                var today = now.getFullYear() + "-" + (month) + "-" + (day);
                $('#to-date').val(today);

                var firstDay = now.getFullYear() + "-" + (month) + "-" + '01';

                $('#from-date').val(firstDay);
            }

            $("#from-date").datepicker({
                format: "yyyy/mm/dd",
                todayHighlight: true,
                autoclose: true,
                clearBtn: true
            });
            $("#to-date").datepicker({
                format: "yyyy/mm/dd",
                todayHighlight: true,
                autoclose: true,
                clearBtn: true
            });
        });
        $(function() {

            $("#upload").click(function(){
                $("#image").click();
            });

        });
        $('#form-change-password').validate({
            rules: {
                password: {
                    required: true,
                    maxlength: 191,
                    minlength: 5
                },
                confirm_password: {
                    required: true,
                    equalTo: "#password"
                }
            }
        });


        @if (session()->has('message'))
        alert('Password successfully changed');
        @endif
    </script>
@endpush
