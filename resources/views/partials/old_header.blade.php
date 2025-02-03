<!-- Google Tag Manager (noscript) -->
<noscript><iframe
src="https://www.googletagmanager.com/ns.html?id=GTM-NG6VFD77"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<!-- Google Tag Manager (noscript) -->
<!-- <noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TMP8SN9"
            height="0" width="0" style="display:none;visibility:hidden">
    </iframe>
</noscript> -->

<!-- Site Navigation Schema -->
<script type="application/ld+json">
{
		"@context": "https://schema.org",
		"@type": "SiteNavigationElement",
		"name": "Website",
		"url": "https://online.jkshahclasses.com/"
	},
{
		"@context": "https://schema.org",
		"@type": "SiteNavigationElement",
		"name": "Privacy policy",
		"url": "https://online.jkshahclasses.com/privacy"
	},
{
		"@context": "https://schema.org",
		"@type": "SiteNavigationElement",
		"name": "Terms of use",
		"url": "https://online.jkshahclasses.com/terms"
	},
	{
		"@context": "https://schema.org",
		"@type": "SiteNavigationElement",
		"name": "About Us",
		"url": "https://online.jkshahclasses.com/about-us"
	},
	{
		"@context": "https://schema.org",
		"@type": "SiteNavigationElement",
		"name": "Free Resources",
		"url": "https://online.jkshahclasses.com/ca-demo-lectures-online"
	},
	{
		"@context": "https://schema.org",
		"@type": "SiteNavigationElement",
		"name": "Professors",
		"url": "https://online.jkshahclasses.com/ca-faculty"
	},
	{
		"@context": "https://schema.org",
		"@type": "SiteNavigationElement",
		"name": "Contact Us",
		"url": "https://online.jkshahclasses.com/contact-us"
	}
</script>

<!-- Video Schema -->
<script type="application/ld+json">
{"@context":"http://schema.org",
"@type":"VideoObject",
"name":"Our Students' Experience on Our ONLINE Lectures | Thank You Dear Students!",
"description":"Hear from our students across our 61 branches in India about their experience studying ONLINE on J.K. Shah Classes' own Learning Platform since April 2020 due to the global pandemic. Your feedback only motivates us to push further and deliver nothing but the best to all you dear students. For any Inquiries or Admissions, give a MISSED CALL on 9757 111 333",
"thumbnailUrl":"http://i3.ytimg.com/vi/INOmyr9E7fs/maxresdefault.jpg",
"uploadDate":"2020-07-09T11:53:04",
"duration":"PT11M00S",
"contentUrl":"https://www.youtube.com/watch?v=INOmyr9E7fs&feature=emb_logo&ab_channel=J.K.ShahClasses",
"url":"https://www.youtube.com/watch?v=INOmyr9E7fs&feature=emb_logo&ab_channel=J.K.ShahClasses"}
</script>
<!-- Organization Schema -->
<script type="application/ld+json">
 { "@context": "http://schema.org",
 "@type": "Organization",
 "name": "JkShah Classes",
 "legalName" : "JkShah Classes",
 "url": "https://online.jkshahclasses.com/",
 "logo": "https://online.jkshahclasses.com/assets/images/logo.png",
 "address": {
 "@type": "PostalAddress",
"streetAddress": "Shraddha, 4th floor, near Chinai college, Old nagardas road, Andheri (E), Mumbai 400069,",
 "addressLocality": "Mumbai",
 "addressRegion": "MUM",
 "postalCode": "400069",
 "addressCountry": "IND"
 },
"brand": {
    "@type": "Brand",
    "name": "JkShah Classes"
  },
"contactPoint": {
 "@type": "ContactPoint",
 "contactType": "Inquiries",
 "telephone": "+ 91 8070400900",
 "contactOption" : "TollFree",
 "email": "helpdesk@jkshahclasses.com"
 },
 "sameAs": [
 "https://www.facebook.com/officialjksc",
 "https://www.instagram.com/officialjksc/",
  "https://www.youtube.com/c/JKShahClassesOnline"
]}
</script>



<!-- End Google Tag Manager (noscript) -->
@if ($notification)
    <div class="bg-secondary p-2 position-fixed notification-container" style="z-index: 2; width: 100%">
        <div class="mt-1">
            @if (strlen($notification['content']) > 40)
                <div style="width: 97%; float: left">
                    <marquee onmouseover="this.stop();" onmouseout="this.start();" scrollamount="3">
                        <div class="text-white">
                            {{ $notification['content'] }}
                        </div>
                    </marquee>
                </div>
                <div style="width: 3%; float: right">
                    <div class="text-center">
                        <a class="text-white close-notification" href="" data-notification-id="{{ $notification['id'] }}"><i class="fas fa-times"></i></a>
                    </div>
                </div>
            @else
                <div style="width: 97%; float: left">
                    <div class="text-white text-center">
                        {{ $notification['content'] }}
                    </div>
                </div>
                <div style="width: 3%; float: right">
                    <div class="text-center">
                        <a class="text-white close-notification" href="" data-notification-id="{{ $notification['id'] }}"><i class="fas fa-times"></i></a>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endif
<header class="">
    <div class="row no-gutters align-items-stretch navbar-top" @if ($notification) style="padding-top: 40px" @endif>
        <div class="col-md">
            <nav class="navbar navbar-expand-md navbar-light bg-white border-bottom border-navbar border-primary">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ url('assets/images/logo.png') }}" width="137" height="62" alt="JK Shah Classes Online" title="JK Shah Classes Online">
                </a>

                <button class="navbar-toggler order-sm-2" type="button" data-toggle="collapse"
                        data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                        aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="search-container flex-fill order-sm-1 mr-sm-2">
                    <div class="form-group m-0">
                        <div class="input-group " style="border-radius: 10px; !important;">
                            <input  type="text" class="search form-control border" placeholder="Search..."
                                    id="search-input" aria-label="Search..." aria-describedby="basic-addon2"
                                    @if (request()->filled('search')) value="{{ request()->input('search') }}" @endif>
                            <div class="input-group-append">
                                <span class="input-group-text bg-white text-primary search-btn" id="basic-addon2"><i
                                        class="fa fa-search"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <div class="col-md d-flex">
            <nav
                class="navbar navbar-expand-md navbar-dark bg-primary text-light border-bottom border-md-navbar border-white py-0 align-self-stretch flex-fill">
                <div class="collapse navbar-collapse py-2 py-md-0" id="navbarCollapse" data-hover="dropdown">
                    <ul class="navbar-nav mr-auto">
                        @if(! isset($user['role']) || (isset($user['role']) && $user['role'] != 6))
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="dropdown-courses" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Courses
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- Level two dropdown-->
                                    @foreach($courses as $course)
                                        @if(empty($course['levels']))
                                            <li><a href="{{ url('packages?course=' . $course['id'] . '&course_text=' . $course['name']) }}" class="dropdown-item px-3">{{ $course['name'] }}</a></li>
                                        @else
                                            <li class="dropdown-submenu">
                                                <a href="{{ url('packages?course=' . $course['id'] . '&course_text=' . $course['name']) }}" aria-haspopup="true"
                                                   aria-expanded="false" class="dropdown-item dropdown-toggle px-3 mr-4">{{ $course['name'] }}</a>
                                                <ul aria-labelledby="course-01" class="dropdown-menu border-0 shadow">
                                                    @foreach($course['levels'] as $level)
                                                        @if(empty($level['subjects']))
                                                            <li><a href="{{ url('packages?course=' . $course['id'] . '&course_text=' . $course['name'] . '&level=' . $level['id'] . '&level_text=' . $level['name']) }}" class="dropdown-item px-3">{{ $level['name'] }}</a></li>
                                                        @else
                                                            <li class="dropdown-submenu">
                                                                <a id="level-01" href="{{ url('packages?course=' . $course['id'] . '&course_text=' . $course['name'] . '&level=' . $level['id'] . '&level_text=' . $level['name']) }}"
                                                                   aria-haspopup="true" aria-expanded="false"
                                                                   class="dropdown-item dropdown-toggle px-3 mr-4">{{ \Illuminate\Support\Str::limit($level['name'],env('TRIM_SIZE'), $end='...') }}</a>
                                                                <ul aria-labelledby="level-01" class="dropdown-menu border-0 shadow">
                                                                    @foreach($level['subjects'] as $subject)
                                                                        <li><a href="{{ url('packages?course=' . $course['id'] . '&course_text=' . $course['name'] . '&level=' . $level['id'] . '&level_text=' . $level['name'] . '&subject=' . $subject['id'] . '&subject_text=' . $subject['name']) }}" class="dropdown-item">{{ \Illuminate\Support\Str::limit($subject['name'],env('TRIM_SIZE'), $end='...') }}</a></li>
                                                                    @endforeach
                                                                </ul>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </li>
                                    @endif
                                @endforeach
                                <!-- End Level two -->
                                </ul>
                            </li>
                            {{--<li class="nav-item dropdown">--}}
                            {{--<a class="nav-link dropdown-toggle" href="#" id="dropdown-professors" role="button"--}}
                            {{--data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
                            {{--Professors--}}
                            {{--</a>--}}
                            {{--<ul class="dropdown-menu">--}}
                            {{--<li>--}}
                            {{--<div class="form-group mx-3 mt-3">--}}
                            {{--<input id="search" type="text" class="form-control dropdown-toggle" placeholder="Search...">--}}
                            {{--</div>--}}
                            {{--</li>--}}
                            {{--<!-- Level two dropdown-->--}}
                            {{--<div id="professors-container">--}}
                            {{--@foreach($professors as $professor)--}}
                            {{--<li>--}}
                            {{--<a class="dropdown-item px-3" href="{{ route('professors.show', $professor['id']) }}">--}}
                            {{--<div class=" media">--}}
                            {{--<img id="{{$professor['id']}}"  src="{{$professor['image'] ?? '/assets/images/avatar.png' }}" class="align-self-center mr-3" alt="{{ $professor['id'] }}"--}}
                            {{--width="30" height="30">--}}
                            {{--<div class="media-body align-self-center">--}}
                            {{--<span class="mt-0 mb-1">{{ $professor['name']}}</span>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--</a>--}}
                            {{--</li>--}}
                            {{--@endforeach--}}
                            {{--</div>--}}

                            {{--<!-- End Level two -->--}}
                            {{--</ul>--}}
                            {{--</li>--}}

                            <li class="nav-item">
                                <a class="nav-link" id="btn-refer-and-earn" href="{{ url('ca-faculty') }}" >Professors</a>
                            </li>
                            <li class="nav-item">
                                @if (! request()->session()->has('access_token'))
                                    <a class="nav-link" id="btn-refer-and-earn" href="#" data-toggle="modal" data-target="#modal-login">Refer & Earn</a>
                                @else
                                    <a class="nav-link" href="#" id="refer-and-earn">Refer & Earn</a>
                                @endif
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="btn-refer-and-earn" href="{{ url('ca-demo-lectures-online') }}" >Demos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-blog" href="{{ route('blogs.index', ['order' => 'featured']) }}" ><strong>Blogs</strong> <small><span class="badge badge-secondary" style="vertical-align: top">New</span></small></a>
                            </li>
                        @endif
                    </ul>
                    <ul class="navbar-nav">
                        @if(! isset($user['role']) || (isset($user['role']) && $user['role'] != 6))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('cart') }}" style="position: relative;">
                                    <i class="fas fa-shopping-cart"></i>
                                    <span class="notification_badge" style="position: absolute; top: -1px; right: -1px; background-color: white; color: black; font-size: 10px; padding: 1px 2px; border-radius: 12px; height: 18px; min-width: 18px; text-align: center; line-height: 14px; border: 1px solid var(--primary); display: none;">0</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('save-for-later.index') }}" style="position: relative;">
                                    <i class="fas fa-heart"></i>
                                    <span class="wishlist_notification_badge" style="position: absolute; top: -1px; right: -1px; background-color: white; color: black; font-size: 10px; padding: 1px 2px; border-radius: 12px; height: 18px; min-width: 18px; text-align: center; line-height: 14px; border: 1px solid var(--primary); display: none;">0</span>
                                </a>
                            </li>
                        @endif
                        @if (! request()->session()->has('access_token'))
                            <li class="nav-item">
                                <a data-toggle="modal" data-target="#modal-login" data-whatever="@mdo" class="nav-link" href="#">Login</a>
                            </li>
                            <li class="nav-item">
                                <a data-toggle="modal" data-target="#modal-signup" class="nav-link" href="#">Sign Up</a>
                            </li>
                            @else (request()->session()->has('access_token'))
                            <li class="nav-item dropdown">
                                <a class="nav-link" id="button-notification" href="#" style="position: relative;"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-bell"></i>
                                    <span class="notifications-badge" style="position: absolute; top: -1px; right: -1px; background-color: white; color: black; font-size: 10px; padding: 1px 2px; border-radius: 12px; height: 18px; min-width: 18px; text-align: center; line-height: 14px; border: 1px solid var(--primary); display: none;">0</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right p-4"
                                     aria-labelledby="button-notification" style="width: 400px;">

                                    @if (count($userNotifications) > 0)
                                        @foreach ($userNotifications as $userNotification)
                                            {{ $userNotification['notification']['title'] ?? '-' }}
                                            @if (! $loop->last)
                                                <hr />
                                            @endif
                                        @endforeach
                                    @else
                                        <div class="text-center">You have no new notifications.</div>
                                    @endif
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="dropdown-professors" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="{{ $user['student']['image'] ?? $user['professor']['image'] ?? url('assets/images/avatar.png') }}" class="rounded-circle" width="30" height="30" align="middle" />
                                    <span class="d-md-none ml-2" style="vertical-align: middle;">{{ $user['student']['name'] ?? $user['professor']['name'] ?? null }}</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <!-- Level two dropdown-->
                                    <li>
                                        @if ($user['role'] == 5)
                                            <a class="dropdown-item" href="{{ url('/contents') }}">Dashboard</a>
                                        @endif
                                        @if ($user['role'] == 6)
                                            <a class="dropdown-item" href="{{ url('professor/profile') }}">Dashboard</a>
                                        @endif
                                        @if ($user['role'] == 7)
                                            <a class="dropdown-item" href="{{ url('associate/dashboard') }}">Dashboard</a>
                                        @endif
                                        @if ($user['role'] == 11)
                                            <a class="dropdown-item" href="{{ url('branch-managers/profile') }}">Dashboard</a>
                                        @endif
                                    </li>
                                    <li>
                                        @if ($user['role'] == 5)
                                            <a class="dropdown-item" href="{{ url('profile') }}">Profile</a>
                                        @endif
                                    </li>
                                    @if ($user['role'] == 5)
                                        <li>
                                            <a class="dropdown-item" href="{{ url('j-money') }}">J-Money</a>
                                        </li>
                                    @endif
                                    <li class="dropdown-divider"></li>
                                    <li>
                                        <form id="logout" method="POST" action="{{ url('/logout') }}">
                                            @csrf
                                            <a onclick="document.getElementById('logout').submit();" class="dropdown-item" href="#">Logout</a>
                                        </form>
                                    </li>

                                    <!-- End Level two -->
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</header>


<style>
    .menu-blog {
        font-family: 'Josefin Sans', sans-serif;
    }
</style>


@push('script')
    <script id="script-modal-signup">

        $(document).on("keypress", "#search-input", function(e){
            if(e.which == 13){
                var search = $('#search-input').val();
                var url = '{{ url('packages?search=') }}'+search;
                window.location.href = url;
            }
        });

        $(document).on("keypress", "#search-input-home", function(e){
            if(e.which == 13){
                var search = $('#search-input-home').val();
                var url = '{{ url('packages?search=') }}'+search;
                window.location.href = url;
            }
        });

        $(function () {
            'use strict';
//        $(window).scroll(function() {
//            var scroll = $(window).scrollTop();
//            if (scroll >= 310) {
//                $('.search-container').removeClass("d-md-none");
//            }else{
//                $('.search-container').addClass("d-md-none");
//            }
//        });

            var $notificationBadge = $('header').find('.notification_badge');
            $notificationBadge.hide();
            var $wishlistNotificationBadge = $('header').find('.wishlist_notification_badge');
            $wishlistNotificationBadge.hide();

            var updateCartCount = function () {
                var url = '{{ url('cart') }}';

                $.get({
                    url: url,
                    cache: false,
                    dataType: 'json'
                }).done(function (response) {
                    var count = 0;

                    if (response.data != null) {
                        if (Array.isArray(response.data.cart.items)) {
                            count = response.data.cart.items.length;
                        }

                        $notificationBadge.text(count);

                        if (count > 0) {
                            $notificationBadge.show();
                        } else {
                            $notificationBadge.hide();
                        }
                        if (Array.isArray(response.data.wishlist)) {
                            count = response.data.wishlist.length;
                        }

                        $wishlistNotificationBadge.text(count);

                        if (count > 0) {
                            $wishlistNotificationBadge.show();
                        } else {
                            $wishlistNotificationBadge.hide();
                        }
                    }

                }).fail(function () {

                });
            };

            updateCartCount();

            $('body').on('change.cart', function () {
                updateCartCount();
            });


            /*$('.cart-save-for-later').click( function () {
                updateCartCount();
                location.reload();
            });*/


            {{--var $wishlistNotificationBadge = $('header').find('.wishlist_notification_badge');--}}
            {{--$wishlistNotificationBadge.hide();--}}

            {{--var updateWishListCount = function () {--}}
            {{--    var url = '{{ url('wishlist') }}';--}}

            {{--    $.get({--}}
            {{--        url: url,--}}
            {{--        cache: false,--}}
            {{--        dataType: 'json'--}}
            {{--    }).done(function (response) {--}}
            {{--        var count = 0;--}}

            {{--        console.log(response);--}}
            {{--        console.log(1111);--}}
            {{--        --}}
            {{--    }).fail(function () {--}}

            {{--    });--}}
            {{--};--}}

            {{--updateWishListCount();--}}

            {{--$('.cart-save-for-later').click( function () {--}}
            {{--    updateWishListCount();--}}
            {{--});--}}
        });

        $(function () {
            'use strict';

            if('ontouchstart' in document) return this; // don't want to affect chaining

            $('[data-hover="dropdown"]').find('.nav-item.dropdown').hover(function () {
                $(this).children('.dropdown-toggle').dropdown('show');
            }, function () {
                $(this).children('.dropdown-toggle').dropdown('hide');
            })
        });

        $('.search-btn').click(function (e) {
            var search = $('#search-input').val();
            var url = '{{ url('packages?search=') }}'+search;
            window.location.href = url;
        });

        $('#btn-refer-and-earn').click(function() {
            $('#location').val('refer_and_earn');
        });

        @if (request()->has('refer-and-earn'))
        $('#modal-refer-and-earn').modal('toggle');
        @endif

        $(function() {
            let $notificationsBadge = $('header').find('.notifications-badge');
            $notificationsBadge.hide();

            let notifications = [];

            $.ajax({
                type: 'GET',
                url: '{{ url('user-notifications') }}',
                async: false
            }).done(function(response) {
                notifications = response;
            });

            if (notifications.length > 0) {
                $notificationsBadge.show();
                $notificationsBadge.text(notifications.length);
            }

            $('#button-notification').click(function() {
                if (notifications.length > 0) {
                    $.ajax({
                        type: 'POST',
                        url: '{{ url('user-notifications/mark-as-read') }}'
                    }).done(function(response) {
                        $notificationsBadge.hide();
                        $notificationsBadge.text(0);
                        notifications = [];
                    });
                }
            });
        });

        $(function () {
            $('.close-notification').click(function (e) {
                e.preventDefault();
                $('.notification-container').addClass('d-none');
                $('.navbar-top').css('padding-top', '0px');

                let notificationID = $(this).data('notification-id');

                $.ajax({
                    url: '{{ route('close-notification') }}',
                    type: 'POST',
                    data: {
                        notification_id: notificationID
                    }
                });
            });
        });
    </script>
@endpush
