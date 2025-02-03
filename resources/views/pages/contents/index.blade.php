@extends('layouts.master')
@section('content')
    <div class="main">
        <div class="page-wrapper chiller-theme toggled" id="dashboard_sidebar">
            <a id="show-sidebar" class="btn btn-sm">
                <i class="fa fa-chevron-right" aria-hidden="true"></i>
            </a>
            @include('includes.student-menu')
            <!-- sidebar-wrapper  -->
            <main class="page-content">
                <div class="container-fluid" id="main_dashboard">
                    <div class="total_course_purchased">
                        <h1 class="total_purchased_title">My Courses</h1>
                        <div class="total-info">
                            <div class="row">
                                <div class="col-md-4 col-sm-12">
                                    <div class="total_list purchased">
                                        <h2>Total Courses Purchased</h2>
                                        <div class="total_list_number">
                                            <h4>{{ $purchasedPackageCount['total_purchased']  ?? 0 }}</h4>
                                            <img src="{{asset('assets/new_ui_assets/images/dashboard/total_purchased.svg')}}" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="total_list completed">
                                        <h2>Completed Courses</h2>
                                        <div class="total_list_number">
                                            <h4>{{ $purchasedPackageCount['total_completed_courses']?? 0}}</h4>
                                            <img src="{{asset('assets/new_ui_assets/images/dashboard/completed_courses.svg')}}" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="total_list purchased">
                                        <h2>Total Trial Course</h2>
                                        <div class="total_list_number">
                                            
                                                <h4><a class="text-dark" href="?freeOrPurchased=trial"> {{ $purchasedPackageCount['total_user_freemium']?? 0}} </a></h4>
                                                <a href="?freeOrPurchased=trial"><img src="{{asset('assets/new_ui_assets/images/dashboard/total_purchased.svg')}}" alt=""></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="inner_search">
                            <form id="filter_courses" action="" method="GET" style="display: contents">
                                <div id="search-demo">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                    <input type="search" placeholder="search for courses / chapters by name" id="filter" name="filter"
                                           value="@if (request()->has('filter')) {{ request()->input('filter') }} @endif">
                                </div>
                                <select id="subject" name="subject">
                                    <option value="" disabled selected>Subject</option>
                                    @foreach($purchasedSubjects as $purchasedSubject)
                                        <option value="{{ $purchasedSubject['id'] }}" @if (request()->has('subject')) @if ($purchasedSubject['id'] == request()->input('subject')) selected @endif @endif>{{ $purchasedSubject['name'] }}</option>
                                    @endforeach
                                </select>
                                <select id="recent_view" name="recent_view">
                                    <option value="1" @if (request()->has('recent_view')) @if (1 == request()->input('recent_view')) selected @endif @endif>Recently Viewed</option>
                                    <option value="2" @if (request()->has('recent_view')) @if (2 == request()->input('recent_view')) selected @endif @endif>1 week</option>
                                    <option value="3" @if (request()->has('recent_view')) @if (3 == request()->input('recent_view')) selected @endif @endif>1 Month</option>
                                    <option value="4" @if (request()->has('recent_view')) @if (4 == request()->input('recent_view')) selected @endif @endif>All</option>
                                </select>
                                <select id="professor" name="professor">
                                    <option value="" disabled selected>Professor</option>
                                    @foreach($professors as $professor)
                                        <option value="{{ $professor['id'] }}" @if (request()->has('professor')) @if ($professor['id'] == request()->input('professor')) selected @endif @endif>{{ $professor['name'] }}</option>
                                    @endforeach
                                </select>
                                <select id="freeOrPurchased" name="freeOrPurchased">
                                    <option value="purchased" @if (request()->has('freeOrPurchased')) @if ('purchased' == request()->input('freeOrPurchased')) selected @endif @endif >Purchased</option>
                                    <option value="trial" @if (request()->has('freeOrPurchased')) @if ('trial' == request()->input('freeOrPurchased')) selected @endif @endif>Free Trial</option>
                                </select>
                                
                                <a href="{{ url('contents') }}" class="btn btn-secondary">Clear</a>
                            </form>
                        </div>
                        <div id="my_courses_lists">
                            @if(!empty($userFreemiumItems))
                            <div class="row">
                                @foreach ($userFreemiumItems as $freemiumItem)
                                    <div class="col-lg-3 col-md-6 col-sm-12 review-row freeTrial_card_container">
                                        <input type="hidden" value="{{ $freemiumItem['id'] }}" class="order_item_id">
                                        <input type="hidden" value="{{ $freemiumItem['package']['id'] }}" class="package_id">
                                        <div class="dash_courses freeTrial_card_banner">
                                            <div class="ribbon"><span>Free Trial</span></div>
                                            <a href="{{ url('freemium-video-contents') . '/?freemiumId=' . $freemiumItem['id'] . '&package=' . $freemiumItem['package']['id'] ?? '' }}">
                                                <img src="{{$freemiumItem['package']['image_url']}}" loading="lazy" alt="">
                                            </a>
                                            <div class="dash_courses_details">
                                                <h4>
                                                    @php 
                                                        $exp = date('Y-m-d', strtotime(@$freemiumItem['expire_at']));
                                                        $current = date('Y-m-d');
                                                    @endphp

{{--                                                   @if( $freemiumItem['package']['videos'])--}}
                                                        @if($current < $exp)
                                                        <a href="{{ url('freemium-video-contents') . '/?freemiumId=' . $freemiumItem['id'] . '&package=' . $freemiumItem['package']['id'] ?? '' }}">
                                                        {{$freemiumItem['package']['name']}}
                                                        </a>
                                                        @else
                                                        <a href="{{ url('freemium-video-contents') . '/?freemiumId=' . $freemiumItem['id'] . '&package=' . $freemiumItem['package']['id'] ?? '' }}">
                                                        {{$freemiumItem['package']['name']}}
                                                        </a>
                                                        @endif
                                                </h4>
                                                <h6>{{$freemiumItem['package']['professors'][0]['name'] ?? null}}</h6>
                                                <div class="dash_inner_timing">
                                                <div class="language_display">
                                                                <i class="fa fa-language" aria-hidden="true"></i>
                                                      @if($freemiumItem['package']['language_id'] == 1)
                                                        <span class="english">{{$freemiumItem['package']['language']['name']}}</span>
                                                    @elseif($freemiumItem['package']['language_id'] == 2)
                                                        <span class="hindi">{{@$freemiumItem['package']['language']['name']}}</span>
                                                    @else
                                                        <span class="both">{{@$freemiumItem['package']['language']['name']}}</span>
                                                    @endif


                                                    </div>
                                                    <div class="content_list mt-2">
                                                    <h6>
                                                Valid till :&nbsp;{{ date('d F Y',strtotime($freemiumItem['created_at'] . "+10 days")) }} </h6>
                                                <span></span>
                                                <h6></h6>
                                                    </div>
                                                    <ul>
                                                        <li>
                                                            <img src="{{asset('assets/new_ui_assets/images/dashboard/play-circle-fill.svg')}}" alt="">
                                                            <p>
                                                                {{$freemiumItem['package']['total_videos']}}
                                                            </p>
                                                        </li>
                                                        <li><span></span></li>
                                                        <li>
                                                            <img src="{{asset('assets/new_ui_assets/images/dashboard/time.svg')}}" alt="">
                                                            <p>
                                                            {{$freemiumItem['package']['total_duration_formatted'] ?? '00:00:00'}} @if($freemiumItem['package']['bonus_duration_formatted']) 
                                                                   + {{  $freemiumItem['package']['bonus_duration_formatted']}} Bonus Hours
                                                                    @endif 
                                                            </p>
                                                        </li>
                                                    </ul>
                                                    <div class="progress">
                                                        <div class="progress-bar progress-bar-striped" role="progressbar" style="width: {{ $freemiumItem['progress_percentage'] }}%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <div class="progress_label">@if($freemiumItem['progress_percentage']>=100) 100% Completed @else {{ round($freemiumItem['progress_percentage']) }}% Completed @endif</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @endif
                            @if(!empty($orderItems))
                            <div class="row">
                                @foreach ($orderItems as $orderItem)
                                    <div class="col-lg-3 col-md-6 col-sm-12 review-row">
                                        <input type="hidden" value="{{ $orderItem['id'] }}" class="order_item_id">
                                        <input type="hidden" value="{{ $orderItem['package']['id'] }}" class="package_id">
                                        <div class="dash_courses">
                                            <a href="{{ url('video-contents') . '/?order_item=' . $orderItem['id'] . '&package=' . $orderItem['package']['id'] ?? '' }}">
                                                <img src="{{$orderItem['package']['image_url']}}" loading="lazy" alt="">
                                            </a>
                                            <div class="dash_courses_details">
                                                <h4>
                                                    @php 
                                                        $exp = date('Y-m-d', strtotime(@$orderItem['expire_at']));
                                                        $current = date('Y-m-d');
                                                    @endphp

{{--                                                   @if( $orderItem['package']['videos'])--}}
                                                        @if($current < $exp)
                                                        <a href="{{ url('video-contents') . '/?order_item=' . $orderItem['id'] . '&package=' . $orderItem['package']['id'] ?? '' }}">
                                                        {{$orderItem['package']['name']}}
                                                        </a>
                                                        @else
                                                        <a href="#">
                                                        {{$orderItem['package']['name']}}
                                                        </a>
                                                        @endif
                                                </h4>
                                                <h6>{{$orderItem['package']['professors'][0]['name'] ?? null}}</h6>
                                                <div class="dash_inner_timing">
                                                <div class="language_display">
                                                                <i class="fa fa-language" aria-hidden="true"></i>
                                                      @if($orderItem['package']['language_id'] == 1)
                                                        <span class="english">{{$orderItem['package']['language']['name']}}</span>
                                                    @elseif($orderItem['package']['language_id'] == 2)
                                                        <span class="hindi">{{@$orderItem['package']['language']['name']}}</span>
                                                    @else
                                                        <span class="both">{{@$orderItem['package']['language']['name']}}</span>
                                                    @endif


                                                    </div>
                                                    <div class="content_list mt-2">
                                                    <h6>
                                            
                                                Valid till :&nbsp;<?php echo !empty($orderItem['expire_at']) ? date('d F Y',strtotime($orderItem['expire_at'])) : ' '; ?> </h6>
                                                <span></span>
                                                <h6></h6>
                                                    </div>
                                                    <ul>
                                                        <li>
                                                            <img src="{{asset('assets/new_ui_assets/images/dashboard/play-circle-fill.svg')}}" alt="">
                                                            <p>
                                                                {{$orderItem['package']['total_videos']}}
                                                            </p>
                                                        </li>
                                                        <li><span></span></li>
                                                        <li>
                                                            <img src="{{asset('assets/new_ui_assets/images/dashboard/time.svg')}}" alt="">
                                                            <p>
                                                            {{$orderItem['package']['total_duration_formatted'] ?? '00:00:00'}} @if($orderItem['package']['bonus_duration_formatted']) 
                                                                   + {{  $orderItem['package']['bonus_duration_formatted']}} Bonus Hours
                                                                    @endif 
                                                            </p>
                                                        </li>
                                                    </ul>
                                                    <div class="progress">
                                                        <div class="progress-bar progress-bar-striped" role="progressbar" style="width: {{ $orderItem['progress_percentage'] }}%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <div class="progress_label">@if($orderItem['progress_percentage']>=100) 100% Completed @else {{ round($orderItem['progress_percentage']) }}% Completed @endif</div>
                                                    @if($orderItem['rating'] || $orderItem['review'])
                                                        <div class="write_review">
                                                            <button class="btn btn-secondary btn-review">Reviewed</button>
                                                        </div>
                                                    @else
                                                        <div class="write_review">
                                                            <button id="review-{{$orderItem['id']}}" class="btn btn-secondary btn-review">Write a review</button>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

            </main>
            <!-- page-content" -->
        </div>
        <!-- page-wrapper -->

        <!-- Review Modal -->
<div class="modal fade" tabindex="-1" id="review_modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="form-feedback-rating">
                @csrf
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h1 class="modal-title" id="modal-title">Rate your overall experience of this Course </h1>
                    <input type="hidden" id="modal_order_item_id" name="modal_order_item_id">
                    <div class="feedback">
                        <div class="ratings">
                            <input type="radio" name="rating_value" id="rate-5" value="5">
                            <label for="rate-5"></label>
                            <input type="radio" name="rating_value" id="rate-4" value="4">
                            <label for="rate-4"></label>
                            <input type="radio" name="rating_value" id="rate-3" value="3">
                            <label for="rate-3"></label>
                            <input type="radio" name="rating_value" id="rate-2" value="2">
                            <label for="rate-2"></label>
                            <input type="radio" name="rating_value" checked id="rate-1" value="1">
                            <label for="rate-1"></label>
                        </div>
                    </div>
                    <div>
                        <input type="text" required name="review_title" id="review_title" placeholder="Title of the review">
                    </div>
                    <div>
                        <textarea  rows="5" name="rating_comment" id="rating_comment" placeholder="Your detailed review"></textarea>
                    </div>

                </div>
                <div class="p-3">
                    <button id="review-submit-button" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('script')
    <script>
        $(function() {

            $('#form-feedback-rating').validate({
                rules: {
                    rating_comment:{
                        required: true
                    }
                }
            });

            $('#filter').on('keyup', function (e) {
                // alert('up')
                var length = $('#filter').val().length;
                if (length > 4) {
                    $("#filter_courses").submit();
                }
            });
            $('#subject').on('change', function (e) {
                $("#filter_courses").submit();
            });
            $('#professor').on('change', function (e) {
                $("#filter_courses").submit();
            });
            $('#freeOrPurchased').on('change', function (e) {
                var freeOrPurchased = e.target.value;
                recentSelectVal = $('#recent_view').val();
                console.log(freeOrPurchased);
                if(freeOrPurchased == 'trial'){
                    $('#recent_view').prop('selected', false).val('');
                    $('#recent_view option:contains("All")').prop('selected', true).val(4);
                }
                /* else if( $('#recent_view').val() == 4 ){
                    $('#recent_view').prop('selected', false).val('');
                    $('#recent_view option:contains("Recently Viewed")').prop('selected', true).val(1);
                } */
                $("#filter_courses").submit();
            });
            $('#recent_view').on('change', function (e) {
                $("#filter_courses").submit();
            });

            var rated = 0;
            var ratingValue;
            var ratingTitle;
            var ratingComment;

            $(".btn-review").click(function (){

                var orderItemId = $(this).closest('.review-row').find(".order_item_id").val();
                $.ajax({
                    url: '{{ env('API_URL').'/feedback/index' }}',

                    beforeSend: function(request) {
                        request.setRequestHeader('X-Api-Key', '{{ env('API_KEY') }}');
                    },
                    type: 'GET',
                    data: {
                        order_item_id: orderItemId
                    }

                }).done(function (response, textStatus, jqXHR) {
                    if(response['data']){
                         ratingValue = response['data']['rating'];
                         ratingTitle = response['data']['review_title'];
                         ratingComment = response['data']['review'];
                        $("#rate-"+ratingValue).attr('checked', true);
                        $("#modal_order_item_id").val(orderItemId);
                        $("#review_title").val(ratingTitle);
                        $("#rating_comment").val(ratingComment);

                        if(ratingTitle){
                            $('input[name="rating_value"]').attr('disabled', 'disabled');
                            $("#modal-title").text('Your overall experience of this Course')
                            $("#review_title").attr('disabled', 'disabled');
                            $("#rating_comment").attr('disabled', 'disabled');
                            $("#review-submit-button").addClass('d-none');
                        }
                        else {
                            $("#rate-1").attr('checked', true);
                            $("#review_title").attr('disabled', false);
                            $("#rating_comment").attr('disabled', false);
                        }
                    }
                    $("#review_modal").modal('show');
                });
            });

            $('#review_modal').on('hidden.bs.modal', function () {

                $('input[name="rating_value"]').removeAttr('disabled');
                $('input[name="rating_value"]').removeAttr('checked');
                $("#modal-title").text('Rate your overall experience of this Course')
                $("#review-submit-button").removeClass('d-none');
                $("#review-submit-button").attr('disabled', false);
                $("#review-submit-button").text('Submit');
            });

            $("#review-submit-button").click(function (event){
                event.preventDefault();
                if($("#form-feedback-rating").valid()){
                    var orderItemId = $("#modal_order_item_id").val();
                    $("#review-submit-button").attr('disabled', true);
                    $("#review-submit-button").html('<i class="fa fa-spinner fa-pulse fa-1x fa-fw"></i> Submitting');
                    $.ajax({
                        url: '{{ env('API_URL').'/feedback/store' }}',
                        beforeSend: function(request) {
                            request.setRequestHeader('X-Api-Key', '{{ env('API_KEY') }}');
                        },
                        method: 'POST',
                        data: {
                            modal_order_item_id: $("#modal_order_item_id").val(),
                            rating_comment: $("#rating_comment").val(),
                            rating_value: $('input[name="rating_value"]:checked').val(),
                            review_title: $("#review_title").val(),
                        }

                    }).done(function (response, textStatus, jqXHR) {
                        if(response['data']){
                            $("#review-"+orderItemId).text('Reviewed');
                            $("#review_modal").modal('hide');
                        }
                    });
                }
            });

            // $('.l-submit').click(function () {
            //     $(this).attr('disabled', true);
            //     $(this).html('<i class="fa fa-spinner fa-pulse fa-1x fa-fw"></i> Logging In');
            //     $('.login-container')[0].submit();
            // });

        });
    </script>
@endpush
