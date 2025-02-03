@extends('layouts.master')

@section('content')
<style>
    #demo_video {
        position: absolute;
        z-index: 9;
        top: 30%;
        right: 40%;
        font-size: 7rem;
        opacity: 0.5;
        color: #000000;
    }
    @keyframes blinker {  
  50% { opacity: 0; }
}
</style>
<div class="main">
<div class="back"></div>
<div class="fix-top">
<div class="container">
            <div id="facebookPixelNoScriptContainer" style="display: none;"></div>
            <div id="facebookPixelNoScriptViewContentContainer" style="display: none;"></div>
            <div id="facebookPixelNoScriptAddToCartContainer" style="display: none;"></div>
            <div class="row">
                    <div class="col-lg-7 col-md-12 col-sm-12">
                    <div class="c-details">
                        <nav aria-label="breadcrumb">
                            <div class=" py-3 text-white">
                                <span class="">
                                    <a href="/" class="text-white">Home</a>
                                    <i class="fa fa-chevron-right px-1 text-warning" aria-hidden="true"></i>
                                    <a href="{{ url("packages?course=".$package['course']['id']."&course_text=".$package['course']['name']."&price=high") }}" class="text-white">{{$package['course']['name']}}</a>
                                    <i class="fa fa-chevron-right px-1 text-warning" aria-hidden="true"></i>
                                    <a href="{{ url("packages?level=".$package['level']['id']."&level_text=".$package['level']['name']."&price=high") }}" class="text-white">{{$package['level']['name']}}</a>
                                    <i class="fa fa-chevron-right px-1 text-warning" aria-hidden="true"></i>{{ $package['name'] }}</span>
                            </div>
                        </nav>
                    </div>
                <!-- </div>
            </div>
</div> -->

    <div class="c-image">
        <div class="container p-0">

            <!-- <div class="row">
                <div class="col-lg-7 col-md-12 col-sm-12"> -->

                    <!-- @if($demo_video)

                    <a title="test" class="popup-iframe" href="http://www.youtube.com/watch?v={{$demo_video['free_resource']['youtube_id']}}?autoplay=1&rel=0">
                        <img src="{{ $package['image_url'] ?? asset('assets/images/placeholder.png') }}" alt="{{ $package['alt'] }}" title="{{ $package['title_tag'] }}">
                        @if( !isset($user['role']))
                        <i class="fa fa-play-circle demo_video" id="demo_video" aria-hidden="true"></i>
                        @else
                        <i class="fa fa-play-circle " id="demo_video" aria-hidden="true"></i>
                        @endif


                    </a>
                    @else
                    <img src="{{ $package['image_url'] ?? asset('assets/images/placeholder.png') }}" alt="{{ $package['alt'] }}" title="{{ $package['title_tag'] }}">
                    @endif -->
                   
                    <!-- @if(!empty($package['video']))
                    <div id="jw-player">
                    <img src="{{ $package['image_url'] ?? asset('assets/images/placeholder.png') }}" alt="{{ $package['alt'] }}" title="{{ $package['title_tag'] }}">
                    <a class="popup-iframe " href="{{ route('get_video', @$package['video']['id']) }}">
                    @if( !isset($user['role']))
                    <i class="fa fa-play-circle demo_video" id="demo_video" aria-hidden="true"></i>
                    @else
                    <i class="fa fa-play-circle " id="demo_video" aria-hidden="true"></i>
                    @endif
                    </a>
                    @else
                    <img src="{{ $package['image_url'] ?? asset('assets/images/placeholder.png') }}" alt="{{ $package['alt'] }}" title="{{ $package['title_tag'] }}">
                    @endif
                    </div> -->

                    <div id="jw-player">
                    @if($course_video['type'] == 1)
                    <img src="{{ $package['image_url'] ?? asset('assets/images/placeholder.png') }}" alt="{{ $package['alt'] }}" title="{{ $package['title_tag'] }}">
                    <a title="test" class="popup-iframe" href="http://www.youtube.com/watch?v={{$course_video['data']['free_resource']['youtube_id']}}?autoplay=1&rel=0">
                        @if( !isset($user['role']))
                            <i class="fa fa-play-circle demo_video" id="demo_video" aria-hidden="true"></i>
                        @else
                            <i class="fa fa-play-circle " id="demo_video" aria-hidden="true"></i>
                        @endif
                    </a>
                    @else
                    <img src="{{ $package['image_url'] ?? asset('assets/images/placeholder.png') }}" alt="{{ $package['alt'] }}" title="{{ $package['title_tag'] }}">
                    @if(!empty($course_video['data']))
                        <a class="popup-iframe " href="{{ route('get_video', @$course_video['encryptedString']) }}">
                        @if( !isset($user['role']))
                            <i class="fa fa-play-circle demo_video" id="demo_video" aria-hidden="true"></i>
                        @else
                            <i class="fa fa-play-circle " id="demo_video" aria-hidden="true"></i>
                        @endif
                        </a>
                    @else
                    
                    @endif
                    
                    @endif
                    </div>



                <!-- </div>
            </div> -->
                    </div>
                    </div>
      

    <div class="c-what-learn">
        <div class="container p-0">
            <!-- <div class="row">
                <div class="col-lg-7 col-md-12 col-sm-12"> -->
                    <div class="ref_menus" id="ref_menus">
                        <ol>
                            @if(count($packageFeatures['data'])>0)
                                <li><a href="#ref_menus"> What you'll learn</a></li>
                            @endif
                            <li><a href="#course-content"> Course Content</a></li>
                            <li><a href="#ratings"> Ratings</a></li>
                            <li><a href="#customer-review"> Reviews</a></li>
                        </ol>
                    </div>
                    <div class="learn-inner" id="learn-inner">
                        <p class="topic-info">{!! nl2br($package['description']) !!}</p>
                        @if(count($packageFeatures['data'])>0)
                        <div>
                            <h4>What you’ll learn</h4>
                            <ul>
                                @foreach($packageFeatures['data'] as $packageFeature)
                                    <li>
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                        <span>{{ $packageFeature['feature'] }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </div>
                <!-- </div>
            </div> -->
        </div>
    </div>
    <div class="course-content" id="course-content">
        <div class="container p-0">
            <!-- <div class="row">
                <div class="col-lg-7 col-md-12 col-sm-12"> -->
                    <div class="content-details">
                        <h4>Course Content</h4>
                        <p><span>{{$package['total_videos']}} Lectures. {{ $package['total_duration_formatted'] }} hrs</span> </p>
                    </div>
                    <!-- Accordion -->
                    <div id="accordion" class="py-2">
                        @if (!$package['is_prebook'] || $package['is_prebook_package_launched'] || $package['is_prebook_content_ready'])
                            @foreach($package['subjects'] as $key => $subject)
                                <div class="card border-0">
                                    <div class="card-header p-0 border-0" id="acoordion-div">
                                    <button class="btn btn-link accordion-title border-0 @if($key==0)collapse @else collapsed @endif" data-toggle="collapse" data-target="#acoordion-{{$key}}" aria-expanded="true" aria-controls="#acoordion"><i class="fa fa-chevron-down text-center d-flex align-items-center justify-content-center h-100"></i>{{ $subject['name'] }}
                                </button>
                                    </div>
                                    <div id="acoordion-{{$key}}" class="collapse @if(count($package['subjects'])==1) show @endif" aria-labelledby="acoordion-div" data-parent="#accordion">
                                        <div class="card-body accordion-body">
                                            <ul>
                                                @if($subject['chapters'])
                                                    @foreach($subject['chapters'] as $chapter)
                                                        <li>
                                                            <h6>
                                                            @if(isset($user['role']))
                                                                    @if (((isset($user['role']) && $user['role'] != 6) || !isset($user['role']))&& (!$package['is_prebook'] && $package['is_prebook_package_launched']))
                                                                        @if ($package['is_purchased'] && $chapter['first_video_id'])
                                                                          
                                                                            <a href="#!">{{ $chapter['name'] }}</a>
                                                                        @else
                                                                            <a class="a-chapter-name" href="#!" data-toggle="modal" data-target="#modal-purchase">{{ $chapter['name'] }}</a>
                                                                        @endif
                                                                    @else
                                                                        
                                                                        <a class="a-chapter-name" href="#!">{{ $chapter['name'] }}</a>
                                                                    @endif
                                                                @else
                                                                        <p>{{ $chapter['name'] }}</p>
                                                                @endif
                                                            </h6>
                                                            <div class="demo_number">
                                                            <i class="fa fa-play" aria-hidden="true"></i> {{ $chapter['videos_count'] }}
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div id="ratings">
                    <div class="riv-ratings">
                        <h3>Rating & reviews</h3>
                        <div class="d-flex align-items-baseline justify-content-between">
                        <h1><span>{{ round($package['average_rating']) ?? 0 }}</span>/<span>5</span></h1>
                        <div class="avg">
                            <div class="c-ratings">
                                @for($i=0;$i<round($package['average_rating']);$i++) <img class="star" src="{{asset('assets/new_ui_assets/images/star.png')}}" alt="">
                                @endfor
                                <div id="rating">Avg <span>{{ round($package['average_rating']) ?? 0 }}</span> out of 5</div>
                            </div>
                        </div>
                        </div>
                        </div>
                    </div>
                    @if( count($package['order_items']) !=0)
                        <div class="student-reviews" id="customer-review">
                            <h3>Customer Reviews ({{ count($package['order_items']) ?? 0}})</h3>
                                <div class="review-inner">
                                    <ul>
                                        @foreach($package['order_items'] as $item)
                                            @if($item['review'] && $item['user'])
                                                <li>
                                                    <div class="head">
                                                        <div class="student-img"><img src="{{ $item['user']['student']['image'] ?? url('assets/images/avatar.png') }}" width="60" alt=""></div>
                                                        {{--<img src="https://picsum.photos/100/100" alt="">--}}
                                                        <h4>{{ $item['user']['name'] }}</h4>
                                                    </div>
                                                    <div class="head-content">
                                                        <h6>{{ $item['review_title'] }}</h6>
                                                        <p>{{ $item['review'] }}</p>
                                                        @if(\Illuminate\Support\Carbon::parse($item['reviewed_at'])->format('d-m-y') == \Illuminate\Support\Carbon::today()->format('d-m-y'))

                                                            <span>Posted today</span>
                                                        @else
                                                            <?php
                                                                $diffDate = \Illuminate\Support\Carbon::parse($item['reviewed_at'])->diffInDays(\Illuminate\Support\Carbon::today())
                                                            ?>
                                                            <span>Posted {{$diffDate + 1 }} @if($diffDate + 1 == 1) day @else days @endif ago</span>
                                                        @endif
                                                    </div>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                        </div>
                    @endif
            <!-- </div>
            </div> -->
                            </div>
    </div>
    </div><!-- col-7 -->
            <div class="col-lg-5 col-md-12 col-sm-12 d-flex">
            <div class="container p-0 mb-md-4">
        <div class="course-info-detail">
            <h2>{{ $package['name'] }}</h2>
          
            <div class="c-review">
                <div class="c-ratings">
                    {{--<span>{{ round($package['rating']) }}</span>--}}
                    @for($i=0;$i<round($package['average_rating']);$i++) <img class="star" src="{{asset('assets/new_ui_assets/images/star.png')}}" alt="">
                    @endfor
                </div>
                <h6 class="rev"><?= count($package['order_items']) > 0 ? count($package['order_items']) . ' Review(s)' : '' ?></h6>
                <!-- <h6 class="students">{{$totalStudents}} Students</h6> -->
            </div>
            <!-- <p class="topic-info">This covers all accounting standards. This is applicable for May/Nov 21 exams.</p> -->

            {{-- <div class="created">--}}

{{-- <div class="row">--}}
{{-- @foreach($package['professors'] as $professor)--}}
{{-- <div class="col-6">--}}
{{-- <div class="row align-items-center mb-2">--}}
{{-- <div class="col-4 pr-0">--}}
{{-- <img  data-toggle="tooltip" data-placement="top" title="{{ $professor['name']}}"src="{{ $professor['image'] ?? '/assets/images/avatar.png' }}"--}}
{{-- alt="{{ $professor['alt'] }}"--}}
{{-- class="rounded-circle p-0"--}}
{{-- style="width: 50px !important; height: 50px !important; display: inline;object-fit:cover;">--}}
{{-- </div>--}}
{{-- <div class="col-8 p-0">--}}
{{-- <h5><span>{{$professor['name']}}</span></h5>--}}
{{-- </div>--}}
{{-- </div>--}}
{{-- </div>--}}
{{-- @endforeach--}}
{{-- </div>--}}
{{-- <h5><span>{{$professor['name']}}</span></h5>--}}

{{-- </div>--}}

{{-- <div class="multiple_created">--}}
{{-- <a target="_blank" href="{{ url("ca-faculty/".$package['professors'][0]['id']) }}"><img data-toggle="tooltip" data-placement="top" title="Name of professor" src="{{ $package['professors'][0]['image'] ?? '/assets/images/avatar.png' }}" --}} {{--                                 alt="{{ $package['professors'][0]['alt'] }}"></a>--}}
{{-- <h5>Created by: <a target="_blank" href="{{ url("ca-faculty/".$package['professors'][0]['id']) }}"><span>{{$package['professors'][0]['name']}}</span></a>--}}
{{-- </h5>--}}
{{-- </div>--}}
            <!-- For multiple professors -->
            <div class="multiple_created">
                @foreach($package['professors'] as $professor)
                    <a href="{{ url("ca-faculty/".$professor['id']) }}" target="_blank">
                        <img src="{{ $professor['image'] ?? '/assets/images/avatar.png' }}" alt="" title="{{$professor['name']}}">
                    </a>
                @endforeach
            </div>

            <div class="d-flex flex-column">
           <div class="c-price">    
                <div class="current">
                    <i class="fa fa-inr" aria-hidden="true"></i>
                    <p>{{ number_format($package['selling_price'],2) }}</p>
                </div>
                <div class="discount">
                    @foreach ($package['strike_prices'] as $price)
                    <i class="fa fa-inr" aria-hidden="true"></i>
                    <p>
                        <del>{{ number_format($price,2) }}</del>
                    </p>
                    @endforeach
                </div>
                @if($package['discount_percentage']!=0)
                    <span class="off">{{ $package['discount_percentage'] }}%</span>
                @endif
                @if($package['special_price']>0)
                        <button class="deal_flash mb-3 ml-0">J-Deals</button>
            @endif
            </div>
            <div>
            @if(!empty($cart_items))
                @if(in_array($package['id'],$cart_items))

                    <a href="#" class="add-cart btn-add-to-cart" style="background-color: #999a9a;" data-id="{{ $package['id'] }}" disabled>Added to Cart</a>                                

                @else
                    @if(in_array($package['id'],$validPackages))
                        <a href="#" id="addCart" class="add-cart btn-add-to-cart" data-id="{{ $package['id'] }}" disabled style="background-color : #e78c60;">Add to Cart</a>
                       
                    @else
                        <a href="#" id="addCart" class="add-cart btn-add-to-cart" data-id="{{ $package['id'] }}">Add to Cart</a>
                        
                    @endif
                @endif
            @endif


            
            @if (! request()->session()->has('access_token'))
                <a href="#" class="buy-now buy-now-login" data-package="{{ $package['id'] }}">Buy Now</a>
            @else
                <a href="{{ url('/cart/checkout?package=' . $package['id']) }}" class="buy-now" id="add-cart-analytics-meta">Buy Now</a>
            @endif
            </div>
            <ul>
                <li>
                    <img src="{{asset('assets/new_ui_assets/images/course-icons/play_circle.png')}}" alt="">
                    <span>{{$package['total_videos']}} Lectures</span>
                </li>
                <li>
                    <img src="{{asset('assets/new_ui_assets/images/course-icons/time.png')}}" alt="">
                    <span>{{ $package['total_duration_formatted'] }} hrs  @if($package['bonus_duration_formatted']) 
                                                                   + {{  $package['bonus_duration_formatted']}} Bonus Hours
                                                                    @endif on-demand video</span>
                </li>
                <li>
                    <img src="{{asset('assets/new_ui_assets/images/course-icons/time.png')}}" alt="">
                    <span>Valid Upto : <b><?= $package['expiry_type'] == '1' ? $package['expiry_month'] . ' Months' : ($package['expiry_type'] == '2' ? date('d M Y', strtotime($package['expire_at'])) : ' 9 Months'); ?></b></span>
                </li>
                @if(count($package['package_study_materials'])>0)
                    <li>
                        <img src="{{asset('assets/new_ui_assets/images/course-icons/cloud.png')}}" alt="">
                        <span>{{ count($package['package_study_materials']) }} downloadable resources</span>
                    </li>
                @endif
                <li>
                    <img src="{{asset('assets/new_ui_assets/images/course-icons/cloud.png')}}" alt="">
                    <span>{{ $package['duration'] }} Times Views</span>
                </li>
                @php
                if(!empty($package['total_duration'])){
                    $durationInSeconds = $package['total_duration'];
                    $durationInHour = $durationInSeconds / 3600;
                    $d = floor($durationInHour);
                    if($d != 0){
                        $rs_per_hr = $package['selling_price'] / $d;
                    }else{
                        $rs_per_hr = $package['selling_price'] / $durationInHour;
                    }  
                }else{
                    $rs_per_hr = $package['selling_price'];
                }
                @endphp
                <li>
                    <img src="{{asset('assets/new_ui_assets/images/course-icons/time.png')}}" alt="">
                    <span>₹{{ number_format($rs_per_hr,2) }} / Hour</span>
                </li>
                <li>
                    <img src="{{asset('assets/new_ui_assets/images/course-icons/world.png')}}" alt="">
                    <span class="mr-2">{{$package['language']['name']}}</span>  | <span class="ml-2"><b>{{$package['packagetype']['name']}}</b></span>
                </li>
            </ul>
        </div>

    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal" id="demoVideoModal"  role="dialog" aria-labelledby="demoVideoModalLabel"  >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="demoVideoModalLabel">Demo Video</h3>
                <button type="button" class="close mr-1" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div id="demo-video-player-div">
                            <div id="video-play-container" class="position-relative">
                                <div id="video-player" class="video-player-container bg-dark shadow-lg" style="min-height:500px;">
                                </div>
                            </div>

{{--                            <script type='text/javascript' src='{{ $signedUrl }}'></script>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="timer">
@endsection
    @push('script')
    <!-- <script>
        // JavaScript to hide the button
        document.addEventListener("DOMContentLoaded", function() {
            const button = document.querySelector(".btn-add-to-cart");
            if (button) {
                button.style.display = "block";
            }
        });
    </script> -->
    <script>
        document.getElementById("addCart").addEventListener("click", function() {
            this.disabled = true;
            location.reload();
        });
    </script>
    <script>
        $('#add-cart-analytics-meta').click(function(e) {
                    $.ajax({
                            url: '{{ route('returnScript') }}',
                            type: 'GET',
                            data: { parameter: "AddToCart"},
                            success: function(response) {
                                var script_execute = $(response).filter('script').html();
                                if (script_execute) {
                                    eval(script_execute);
                                }
                            },
                            error: function(xhr, status, error) {
                                console.log("Script not executed");
                            }
                        });
                    
                        var container = document.getElementById("facebookPixelNoScriptAddToCartContainer");
                        var noscriptTag = document.createElement("noscript");
                        noscriptTag.setAttribute("id", "facebookPixelNoScript");

                        var imgElement = document.createElement("img");
                        imgElement.setAttribute("height", "1");
                        imgElement.setAttribute("width", "1");
                        imgElement.setAttribute("style", "display:none");
                        imgElement.setAttribute("src", "https://www.facebook.com/tr?id=772927708313682&ev=AddToCart&noscript=1");
                        noscriptTag.appendChild(imgElement);
                        container.appendChild(noscriptTag);
                });
    </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
            $.ajax({
                            url: '{{ route('returnScript') }}',
                            type: 'GET',
                            data: { parameter: "ViewContent"},
                            success: function(response) {
                                var script_execute = $(response).filter('script').html();
                                if (script_execute) {
                                    eval(script_execute);
                                }
                            },
                            error: function(xhr, status, error) {
                                console.log("Script not executed");
                            }
                        });

                        var container = document.getElementById("facebookPixelNoScriptViewContentContainer");
                        var noscriptTag = document.createElement("noscript");
                        noscriptTag.setAttribute("id", "facebookPixelNoScript");

                        var imgElement = document.createElement("img");
                        imgElement.setAttribute("height", "1");
                        imgElement.setAttribute("width", "1");
                        imgElement.setAttribute("style", "display:none");
                        imgElement.setAttribute("src", "https://www.facebook.com/tr?id=772927708313682&ev=ViewContent&noscript=1");
                        noscriptTag.appendChild(imgElement);
                        container.appendChild(noscriptTag);
            });
            $(document).ready(function() {

                $('.btn-add-to-cart').click(function(e) {
                    e.preventDefault();

                    var url = "{{ url('cart') }}";
                    var packageId = $(this).data('id');

                    $.post(url, {
                        package_id: packageId
                    }).done(function(data) {

                        if (!data.data) {
                            $('#toast-already-exist').toast('show');
                        } else {
                            $('#toast-added-to-cart').toast('show');
                        }

                        $('body').trigger('change.cart');
                    }).fail(function() {
                        alert("Error while adding to cart");
                    });
                });

                $('#analytics-meta').click(function(e) {
                    $.ajax({
                            url: '{{ route('returnScript') }}',
                            type: 'GET',
                            data: { parameter: "InitiateCheckout"},
                            success: function(response) {
                                var script_execute = $(response).filter('script').html();
                                if (script_execute) {
                                    eval(script_execute);
                                }
                            },
                            error: function(xhr, status, error) {
                                console.log("Script not executed");
                            }
                        });
                    
                        var container = document.getElementById("facebookPixelNoScriptContainer");
                        var noscriptTag = document.createElement("noscript");
                        noscriptTag.setAttribute("id", "facebookPixelNoScript");

                        var imgElement = document.createElement("img");
                        imgElement.setAttribute("height", "1");
                        imgElement.setAttribute("width", "1");
                        imgElement.setAttribute("style", "display:none");
                        imgElement.setAttribute("src", "https://www.facebook.com/tr?id=772927708313682&ev=InitiateCheckout&noscript=1");
                        noscriptTag.appendChild(imgElement);
                        container.appendChild(noscriptTag);
                });

                $('.buy-now-login').click(function(e) {
                    e.preventDefault();
                    var packageID = $(this).attr('data-package');
                    $("#package-id").val(packageID);
                    $("#login-modal").show();
                });
            });
        </script>
        
        <!-- <script src="https://cdn.jwplayer.com/libraries/rVFAIHjQ.js?exp=1652534100&sig=2766a9f6b5e527e3d9368aa58e343a1c"></script> -->
    <script>
        $(function() {

            if ($(".popup-youtube, .popup-vimeo, .popup-gmaps, .popup-iframe").length) {
                $('.popup-youtube, .popup-vimeo, .popup-gmaps, .popup-iframe').magnificPopup({
                    disableOn: 700,
                    type: 'iframe',
                    mainClass: 'mfp-fade',
                    removalDelay: 3,
                    preloader: false,
                    closeOnBgClick: false,
                    fixedContentPos: false,
                    iframe: {
                        markup: '<style>.mfp-iframe-holder .mfp-content {max-width: 900px;height:500px}</style>' +
                            '<div class="mfp-iframe-scaler" ><div class="mfp-title"></div>' +
                            '<div class="mfp-close"></div>' +
                            '<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>' +
                            '</div></div>'
                    },
                });
            }
            var i = 0;
            $(".demo_video").click(function() {

            //    if (i == 0) {
                    var timesRun = 0;
                    var timerID = setInterval(function() {

                        timesRun += 1;
                        $("#timer").val(timerID);
                        if (timesRun === 300) {
                           
                            $.magnificPopup.close();
                            $("#modal-signup").modal('show');
                            clearInterval(timerID);
                            i++;
                        }else{
                            i=0;
                            
                        }
                    }, 1000);

            //    }

               
            });

            $.magnificPopup.instance.close = function () {
                var timerID=$("#timer").val();
                clearInterval(timerID);

            $.magnificPopup.proto.close.call(this);
        };
    });
    </script>

    <script>
        $(function () {
            if ($('.popup-iframe').length) {
                $('.popup-iframe').magnificPopup({
                    disableOn: 700,
                    type: 'iframe',
                    mainClass: 'mfp-fade',
                    removalDelay: 160,
                    preloader: false,
                    fixedContentPos: false
                });
            }
        });
    </script>

@endpush
