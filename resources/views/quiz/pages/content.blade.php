<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iqurius Library page </title>

    <!-- Custom CSS  -->
    <link rel="stylesheet" href="{{ asset('dist/css/style.css') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />

    <!-- Bootstrap CDN  -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Slick CDN  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css"/>
</head>
<body>

<!-- Navbar Section Start  -->
<section class="header">
    <h2>Content Library</h2>
</section>
<!-- Navbar Section End  -->

<!-- Main Display Section  -->
<section class="container main  slider-for">

    <!-- Slide 1 -->

        @foreach($contents as $content)
            @if($content->content_type == 'Image')
                <div class="main-container">

                    <!-- Floating Circle Start -->
                    <div class="numberCircle">
                        <span class="num-now">{{ $loop->iteration }}</span><span class="num-slash">/</span><span class="num-total">{{ $loop->count }}</span>
                    </div>
                    <!-- Floating Circle End -->
                    <!-- Top Heading -->
                    <div class="main-div-header-top center" >
                        <div>
                            {{ $content->name }}
                        </div>
                    </div>
                    <!-- Top Heading End -->
                    <!-- Display Image Start  -->
                    <img src="{{ asset($content->url) }}" class="center img-fluid" alt="Display Image">
                    <!-- Display Image End  -->
                </div>
            @elseif($content->content_type == 'Video')
            <!-- Video  -->
                <div class="main-container" id="style-1">
                    <!-- Floating Circle Start -->
                    <div class="numberCircle">
                        <span class="num-now">{{ $loop->iteration }}</span><span class="num-slash">/</span><span class="num-total">{{ $loop->count }}</span>
                    </div>
                    <!-- Floating Circle End -->
                    <!-- Top Heading -->
                    <div class="main-div-header-top center" >
                        <div>
                            {{ $content->name }}
                        </div>
                    </div>
                    <!-- Top Heading End -->
                    <!-- Main Div Start -->

                    <div class="main-div center">
                        <video width="320" height="240" controls>
                            <source src="{{asset($content->url)}}" type="video/mp4">
                            <source src="{{asset($content->url)}}" type="video/ogg">
                            Your browser does not support the video tag.
                        </video>
{{--                        <div id="playerContainer">--}}
{{--                            <!-- Scripts for player attched to bottom of the file  -->--}}
{{--                        </div>--}}
                    </div>

                    <!-- Main Div End -->
                </div>
            @elseif($content->content_type == 'Audio')
            <!-- Audio  -->
                <div class="main-container " id="style-1">
                    <!-- Floating Circle Start -->
                    <div class="numberCircle">
                        <span class="num-now">{{ $loop->iteration }}</span><span class="num-slash">/</span><span class="num-total">{{ $loop->count }}</span>
                    </div>
                    <!-- Floating Circle End -->

                    <!-- Top Heading -->
                    <div class="main-div-header-top center" >
                        <div>
                            {{ $content->name }}
                        </div>
                    </div>
                    <!-- Top Heading End -->

                    <!-- Main Div Start -->
                    <div class="main-div center">
                        <!-- Audio Player Start -->
                        <div class="audio-player center">
                            <audio controls>
                                <source src="{{asset($content->url)}}" type="audio/mp3">
                                Your browser does not support the audio element.
                            </audio>
                        </div>
                        <!-- Audio Player End -->

                        <div class="main-div-content-audio">
                            <h6 class="main-div-content--audio-header">Lorem Ipsum</h6>
                            <p class="main-div-content-audio-paragraph">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Corporis, totam repudiandae minus ipsum enim maiores asperiores nostrum, saepe nihil, ab rerum sint fugiat commodi. Vitae dicta ut voluptate ipsam tenetur!</p>
                        </div>

                    </div>
                    <!-- Main Div End -->

                </div>
            @elseif($content->content_type == 'Document')
            <!-- Paragraph  -->
                <div class="main-container " id="style-1">
                    <!-- Floating Circle Start -->
                    <div class="numberCircle">
                        <span class="num-now">{{ $loop->iteration }}</span><span class="num-slash">/</span><span class="num-total">{{ $loop->count }}</span>
                    </div>
                    <!-- Floating Circle End -->

                    <!-- Main Div Inner Heading -->
                    <div class="main-div-header center" >
                        <div style="text-align: left; position: absolute;">
                            {{ $content->name }}
                        </div>

                        <!-- Download Icon -->
                        <div style="text-align: right; font-size: 25px;">
                            <a href="{{asset($content->url)}}" target="_blank"><i class="fa fa-download" aria-hidden="true" style="color: #00a850!important;"></i></a>
                        </div>
                    </div>
                    <!-- Main Div Inner Heading End -->

                    <!-- Main Paragraph Start -->
                    <div class="main-paragraph center">
                        <div class="main-div-content">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat veritatis aspernatur adipisci exercitationem repudiandae repellat, dolorem dolores mollitia minima unde minus vel. Asperiores fugit cupiditate error consequuntur nam dolores necessitatibus! <br>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat veritatis aspernatur adipisci exercitationem repudiandae repellat, dolorem dolores mollitia minima unde minus vel. Asperiores fugit cupiditate error consequuntur nam dolores necessitatibus! <br>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat veritatis aspernatur adipisci exercitationem repudiandae repellat, dolorem dolores mollitia minima unde minus vel. Asperiores fugit cupiditate error consequuntur nam dolores necessitatibus!<br>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat veritatis aspernatur adipisci exercitationem repudiandae repellat, dolorem dolores mollitia minima unde minus vel. Asperiores fugit cupiditate error consequuntur nam dolores necessitatibus!<br>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat veritatis aspernatur adipisci exercitationem repudiandae repellat, dolorem dolores mollitia minima unde minus vel. Asperiores fugit cupiditate error consequuntur nam dolores necessitatibus!<br>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat veritatis aspernatur adipisci exercitationem repudiandae repellat, dolorem dolores mollitia minima unde minus vel. Asperiores fugit cupiditate error consequuntur nam dolores necessitatibus!<br>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat veritatis aspernatur adipisci exercitationem repudiandae repellat, dolorem dolores mollitia minima unde minus vel. Asperiores fugit cupiditate error consequuntur nam dolores necessitatibus!</p>
                        </div>
                    </div>
                    <!-- Floating Circle End -->

                </div>
            @endif
        @endforeach

</section>

<!-- Main Display Section End -->

<!-- Slider Starts  -->
<section class="slider-track">
    <div class="container">
        <div class="slider-nav">
            @foreach($contents as $content)
                <div class="item"><a href="#"> <img src="{{ asset($content->thumbnail) }}" alt=""> </a></div>
            @endforeach
        </div>
    </div>
</section>
<!-- Slider Ends  -->

<!-- Footer Buttons Start -->
<section class="footer">
    <div class="container">
        <a href="{{ route('frontend.practice') }}"><button class="footer-btn">  Skip </button></a>
        <a href="{{ route('frontend.test', ['ID' => encrypt($event->id)]) }}"><button class="footer-btn">Start Test</button></a>
    </div>
</section>
<!-- Footer Buttons Ends -->


<!-- Bootstrap JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Slick Js  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
<script src="{{ asset('dist/js/slider.js') }}"></script>
<!-- Indigo Player JS  -->
<script src="https://cdn.jsdelivr.net/npm/indigo-player@1/lib/indigo-player.js"></script>
<script src="{{ asset('dist/js/indigo-config.js') }}"></script>
</body>
</html>
