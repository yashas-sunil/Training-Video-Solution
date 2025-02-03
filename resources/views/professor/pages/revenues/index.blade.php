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
                    <div class="border shadow mt-4 mt-md-0">
                        <div class="p-4">
                            <h5>Revenue</h5>
                            <form method="GET" action="{{ route('professor.revenues.index') }}">
                                <div class="row mt-3">
                                    <div class="col-6">
                                        <input type="text" id="search" name="search" class="form-control" placeholder="Search Packages" @if (request()->filled('search')) value="{{ request()->input('search') }}" @endif>
                                    </div>
{{--                                    <div class="col-3">--}}
{{--                                        <input type="date" id="date" name="date" class="form-control" @if (request()->filled('date')) value="{{ request()->input('date') }}" @endif>--}}
{{--                                    </div>--}}
                                    <div class="col-3">
                                        <button id="btn-search" class="btn btn-primary">Search</button>
                                        <a href="{{ route('professor.revenues.index')}}" id="btn-reset" class="btn btn-primary border-left">Clear</a>
                                    </div>
                                </div>
                            </form>
                            <form id="form-filter" method="GET" action="{{ route('professor.revenues.index') }}">
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
                                        <a href="{{ route('professor.revenues.index') }}" class="btn btn-primary">Clear</a>
                                    </div>
                                </div>
                            </form>
                            <div class="table-responsive">
                                <table class="table mt-3">
                                    <thead class="bg-primary">
                                    <tr>
                                        <th class="text-light border-0  font-weight-normal" scope="col">Package</th>
                                        <th class="text-light border-0  font-weight-normal" scope="col">#Invoice</th>
                                        <th class="text-light border-0  font-weight-normal" scope="col">Package Amount</th>
                                        <th class="text-light border-0  font-weight-normal" scope="col">Student</th>
                                        <th class="text-light border-0  font-weight-normal" scope="col">Package Contribution(%)</th>
                                        <th class="text-light border-0  font-weight-normal" scope="col">Professor Contribution(%)</th>
                                        <th class="text-light border-0  font-weight-normal" scope="col">Revenue Amount</th>
                                        <th class="text-light border-0  font-weight-normal" scope="col">Invoice Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($professor_revenues['data'] as $data)
                                        <tr>
                                            <td class="pt-4">{{ $data['package']['name'] }}</td>
                                            <td class="pt-4">{{ $data['invoice_id']}}</td>
                                            <td class="pt-4">{{ $data['package_total']}}</td>
                                            <td class="pt-4">{{ $data['payment']['user']['name']}}</td>
                                            <td class="pt-4">{{ $data['package_revenue_percentage'] }}</td>
                                            <td class="pt-4">{{ $data['professor_contribution_percentage']}}</td>
                                            <td class="pt-4">{{ $data['revenue_amount']}}</td>
                                            <td class="pt-4">@if($data['invoice_date']==true) {{  \Carbon\Carbon::parse($data['invoice_date'])->format('d/m/Y')}}@endif</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                                <div>
                                    <nav aria-label="...">
                                        <ul class="pagination">
                                            <li class="page-item">
                                                <a class="page-link" href="?page=1">First</a>
                                            </li>
                                            <li class="page-item @if (!$professor_revenues['prev_page_url']) disabled @endif">
                                                <a class="page-link" href="?page={{$professor_revenues['current_page']-1}}">Previous</a>
                                            </li>
                                            <li class="page-item @if (!$professor_revenues['next_page_url']) disabled @endif">
                                                <a class="page-link" href="?page={{$professor_revenues['current_page']+1}}">Next</a>
                                            </li>
                                            <li class="page-item">
                                                <a class="page-link" href="?page={{$professor_revenues['last_page']}}">Last</a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('script')
    <script>

        $(document).ready(function() {
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

            // $('#from-date').datepicker({
            //     autoclose: true,
            //     format: 'dd-mm-yyyy'
            // });
            //
            // $('#to-date').datepicker({
            //     autoclose: true,
            //     format: 'dd-mm-yyyy'
            // });
        });
    </script>
@endpush
