@extends('layouts.master')

@section('title', 'Contents')

@section('content')
    <main class="student-dashboard" role="main">
        <div class="container-fluid py-4 px-5">
            <h3 class="text-secondary"><b>Welcome {{ $user['student']['name']}}</b></h3>
            <div class="row mt-3">
                @include('includes.student-menu')
                <div class="col-md">
                    <div class="border shadow mt-4 mt-md-0">
                        <div class="students-contents p-4">
                            <form id="form-filter-content" method="GET" action="{{ url('contents') }}">
                                <input type="hidden" id="order-item" name="order_item">
                                <div class="row justify-content-center mt-4">
                                    <div class="col-sm col-md-3">
                                        <select id="package" name="package" class="custom-select custom-select-sm">
                                            <option value="" selected disabled hidden>Package</option>
                                            @foreach ($orderItems as $orderItem)
                                                <option value="{{ $orderItem['package']['id'] }}" @if ($orderItem['id'] == $orderItemId) selected @endif data-order-item-id="{{ $orderItem['id'] }}">{{ $orderItem['package']['name'] }} @if($orderItem['is_completed']) {{ '(Completed)' }} @endif </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm col-md-3">
                                        <select id="subject" name="subject" class="custom-select custom-select-sm">
                                            <option  value="" selected>All</option>
                                            @foreach ($subjects as $subject)
                                                <option value="{{ $subject['id'] }}" @if (request()->has('subject')) @if ($subject['id'] == request()->input('subject')) selected @endif @endif>{{ $subject['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </form>
                            <div class="row justify-content-center mt-md-4">
                                <div class="col-sm col-md-6 col-lg-5 col-xl-3 mb-4 mb-md-0">
                                    <span class="d-block bg-primary-100 rounded-lg p-2">Total Chapters: <strong>{{ $totalChapters }}</strong><span class="float-right px-2"></span></span>
                                </div>
                                <div class="col-sm col-md-6 col-lg-5 col-xl-3 mb-4 mb-md-0">
                                    <span class="d-block bg-primary-100 rounded-lg p-2">Chapters Bought: <strong>{{ $totalChaptersBought }}</strong><span class="float-right px-2"></span></span>
                                </div>
                            </div>
                            @if (session()->has('success'))
                                <div class="row justify-content-center mt-5">
                                    <div class="col-md-6">
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            Your payment was successfully placed!
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="mt-5">
                                @if ($order)
                                    @if ($order['is_prebook'] && $order['payment_status'] == 1)
                                        @if (!$order['package']['is_prebook_package_launched'])
                                            <div class="row text-center justify-content-center">
                                                <div class="col-sm-6">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h5 class="card-title">Content will be available on <strong>{{ \Carbon\Carbon::create($order['package']['prebook_launch_date'])->toFormattedDateString() }}</strong></h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="row text-center justify-content-center">
                                                <div class="col-sm-6">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h5 class="card-title">Pay your Balance</h5>
                                                            <p class="card-text">You need to pay the balance amount to access this content!</p>
                                                            <form method="POST" action="{{ route('balance-orders.store') }}">
                                                                @csrf
                                                                <input type="hidden" name="order_id" value="{{ $order['id'] }}">
                                                                <button class="btn btn-primary">Pay ₹{{ $order['balance_amount'] }}</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @else
                                        @if($contents)
                                            <div class="row my-3">
                                                <div class="col-md-12 text-center">
                                                    <h5><strong>{{ $order['package'] ? $order['package']['name'] : '' }}</strong></h5>
                                                </div>
                                            </div>
                                            <div class="row my-3">
                                                <div class="col-md-12 text-center">
                                                    <span><i class="far fa-clock"></i> Remaining Duration: <b><span>{{ $remainingDuration }}</span> / <span>{{ $totalDuration }}</span></b></span>
                                                </div>
                                            </div>
                                            <div class="row my-3">
                                                <div class="col-md-12 text-right">
                                                    @if($feedBackOrderItem['review'])
                                                        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#feedbackModalShow">View Feedback</button>
                                                    @else
                                                        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#feedbackModal">Feedback</button>
                                                    @endif
                                                </div>
                                            </div>

                                            @foreach ($contents as $content)
                                                <span><b>{{ $content['name'] }}</b></span>
                                                @foreach($content['chapters'] as $chapter)
                                                    <div class="accordion student-chapters-accordion mt-1 mb-4" id="student-chapters-accordion">
                                                        <div class="card mt-1">
                                                            <div class="bg-primary-50 shadow-sm d-flex flex-wrap align-items-center" id="heading">
                                                                <span class="flex-fill py-2 px-2">{{ $chapter['name'] }}</span>
                                                                {{--                                                    <div class="px-4">--}}
                                                                {{--                                                        <i class="fas fa-edit text-muted"></i>--}}
                                                                {{--                                                    </div>--}}
                                                                {{--                                                    <div class="px-4 border-left">--}}
                                                                {{--                                                        <i class="fas fa-check-circle text-success"></i>--}}
                                                                {{--                                                    </div>--}}
                                                                <div class="px-4">
                                                                    <i class="fab fa-youtube mr-1 text-danger"></i>
                                                                    <span>{{ $chapter['videos_count'] }}</span>
                                                                </div>
                                                                <div class="w-100 d-lg-none"></div>
                                                                <div class="flex-grow-1 flex-lg-grow-0 px-4 border-left">
                                                                    <i class="fa fa-clock mr-1 text-muted"></i>
                                                                    <span>{{ $chapter['videos_total_duration'] }}</span>
                                                                </div>
                                                                {{--                                                    <div class="flex-grow-1 flex-lg-grow-0 px-4 border-left">--}}
                                                                {{--                                                        @if ($chapter['is_purchased'])--}}
                                                                {{--                                                            <i class="fa fa-calendar mr-1 text-muted"></i>--}}
                                                                {{--                                                            <span>{{ date("d-m-Y", strtotime($chapter['created_at'])) }}</span>--}}
                                                                {{--                                                        @else--}}
                                                                {{--                                                            <a href="{{ url('/packages?course=' . $chapter['course_id'] . '&level=' . $chapter['level_id'] . '&subject=' . $chapter['subject_id'] . '') }}" class="btn btn-primary btn-sm text-white">Explore for Buy</a>--}}
                                                                {{--                                                        @endif--}}
                                                                {{--                                                    </div>--}}
                                                                <button class="btn btn-primary py-2 rounded-0" type="button" data-toggle="collapse" data-target="#collapse-{{ $chapter['id'] }}" aria-expanded="true" aria-controls="collapse-{{ $chapter['id'] }}">
                                                                    <i class="fas fa-plus"></i>
                                                                </button>
                                                            </div>
                                                            <div id="collapse-{{ $chapter['id'] }}" class="collapse" aria-labelledby="heading" data-parent="#student-chapters-accordion">
                                                                <div class="table-responsive">
                                                                    <table class="table table-hover mb-0">
                                                                        <tbody>
                                                                        @foreach($chapter['modules'] as $module)
                                                                            <tr>
                                                                                <td colspan="3" class="bg-secondary-10">
                                                                                    <h6 class="m-2">Module: {{ $module['name'] }}</h6>
                                                                                </td>
                                                                            </tr>
                                                                            @foreach($module['videos'] as $video)
                                                                                <tr>
                                                                                    <td class="col pl-5 pr-4">
                                                                                        <a href="{{ url('videos') . '/' . $video['id'] . '?package=' . $packageId . '&order_item=' . $orderItemId ?? '' }}">{{ $video['title'] }}</a>
                                                                                    </td>
                                                                                    {{--                                                                        <td class="col-auto px-4 py-2">--}}
                                                                                    {{--                                                                        <span class="fa-stack">--}}
                                                                                    {{--                                                                          <i class="fas fa-circle fa-stack-1x text-warning" style="font-size: 1.4rem;"></i>--}}
                                                                                    {{--                                                                          <i class="fas fa-ellipsis-h fa-stack-1x text-white"></i>--}}
                                                                                    {{--                                                                        </span>--}}
                                                                                    {{--                                                                        </td>--}}
                                                                                    <td class="col-auto px-4 text-nowrap">
                                                                                        <i class="fa fa-eye mr-1 text-muted" title="Watched duration"></i>
                                                                                        <span>{{ gmdate('H:i:s', $video['video_histories'][0]['duration'] ?? 0)  }}</span>
                                                                                    </td>
                                                                                    <td class="col-auto px-4 text-nowrap">
                                                                                        <i class="fa fa-clock mr-1 text-muted" title="Total duration"></i>
                                                                                        <span>{{ $video['formatted_duration'] }}</span>
                                                                                    </td>
                                                                                    {{--                                                                        <td class="col-auto px-4 text-nowrap">--}}
                                                                                    {{--                                                                            <i class="fa fa-calendar mr-1 text-muted"></i>--}}
                                                                                    {{--                                                                            <span>{{ date("d-m-Y", strtotime($video['created_at'])) }}</span>--}}
                                                                                    {{--                                                                        </td>--}}
                                                                                    <td class="col-auto px-0">
                                                                                        <div style="width: 40px;"></div>
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endforeach
                                        @else
                                            <div class="mt-4 text-center">
                                                <p>Currently no data available !</p>
                                            </div>
                                        @endif
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div class="modal fade" id="feedbackModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('feedback.store') }}" method="post" id="form-feedback-rating">
                @csrf
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <div class="row">
                            <div class="col-12">How helpful was it?</div>
                            <input type="hidden" name="order_item_id" value="{{ $orderItemId }}">
                            <div class="col-12">
                                <select id="example" name="rating_value">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                            <div class="col-12"><textarea class="form-control" placeholder="Drop your feedback here" name="rating_comment"></textarea></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Send Feedback</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="feedbackModalShow" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Feedback</h3>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <select id="feedback-show" name="rating_value" disabled>
                                <option @if($feedBackOrderItem['rating'] == 1) selected @endif>1</option>
                                <option @if($feedBackOrderItem['rating'] == 2) selected @endif>2</option>
                                <option @if($feedBackOrderItem['rating'] == 3) selected @endif>3</option>
                                <option @if($feedBackOrderItem['rating'] == 4) selected @endif>4</option>
                                <option @if($feedBackOrderItem['rating'] == 5) selected @endif>5</option>
                            </select>
                        </div>
                        <div class="col-12"><p>{{ $feedBackOrderItem['review'] }}</p></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach ($orderItems as $orderItem)
        @if (! $orderItem['review'])
            <div class="modal fade" id="review-modal-{{ $orderItem['id'] }}" tabindex="-1" role="dialog" aria-labelledby="review-modal-{{ $orderItem['id'] }}-label" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form method="POST" action="{{ route('feedback.store') }}">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-body text-center">
                                <button type="button" class="close float-right" data-dismiss="modal">&times;</button>
                                <div class="row my-3">
                                    <div class="col-md-12">
                                        <h5><strong>{{ $orderItem['package']['name'] }}</strong></h5>
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-md-12">
                                        How helpful was it?
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-md-12">
                                        <input type="hidden" name="order_item_id" value="{{ $orderItem['id'] }}">
                                        <select class="review-rating" name="rating_value">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-md-12">
                                        <textarea class="form-control" placeholder="Drop your feedback here" name="rating_comment" required></textarea>
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary">Send Feedback</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    @endforeach
@endsection

@push('script')
    <script>
        $(function () {
            @if (! request()->filled('package') && !request()->filled('order_item'))
            @foreach ($orderItems as $orderItem)
            @if (! $orderItem['review'])
            $('.review-rating').barrating({
                theme: 'fontawesome-stars'
            });

            $('#review-modal-{{ $orderItem['id'] }}').modal('toggle');
            @endif
            @endforeach
            @endif

            $('[data-toggle="tooltip"]').tooltip();

            $('.collapse').on('hide.bs.collapse', function () {
                var id = $(this).attr('id');
                var $btn = $(this).closest('.card').find('[data-target="#'+id+'"] i');

                $btn.removeClass('fa-minus');
                $btn.addClass('fa-plus');
            });

            $('.collapse').on('show.bs.collapse', function () {
                var id = $(this).attr('id');
                var $btn = $(this).closest('.card').find('[data-target="#'+id+'"] i');

                $btn.removeClass('fa-plus');
                $btn.addClass('fa-minus');
            });

            $('#package').change(function(e) {
                e.preventDefault();
                $('#order-item').val($(this).find(':selected').data('order-item-id'));
                $('#form-filter-content').submit();
            });

            $('#subject').change(function(e) {
                e.preventDefault();
                $('#order-item').val($('#package').find(':selected').data('order-item-id'));
                $('#form-filter-content').submit();
            });

            $('#form-feedback-rating').validate({
                rules: {
                    rating_comment:{
                        required: true
                    },
                }
            });
        });
    </script>
    <script type="text/javascript">
        $(function() {
            $('#example').barrating({
                theme: 'fontawesome-stars'
            });

            $('#feedback-show').barrating({
                theme: 'fontawesome-stars',
                deselectable: false,
                hoverState: false,
                readonly: true,
                triggerChange: false
            });
        });
    </script>
@endpush
