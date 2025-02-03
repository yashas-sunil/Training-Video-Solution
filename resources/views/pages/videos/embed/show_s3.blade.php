@php

@endphp
<body style="margin: 0; padding: 0;">
    <link href="{{ asset('dist/css/video-js.min.css') }}" rel="stylesheet">
    <div id="videoContainer" style="position: relative; height: 100vh;">
        <video id="s3Video" class="video-js vjs-default-skin" controls style="width: 100%; height: 100%;">
            <source src="{{ $url }}" <?php if($extension == "m3u8") { ?>type="application/x-mpegURL"<?php } else { ?>type="video/mp4"<?php } ?>>
        </video>
    </div>

    <script src="{{ asset('dist/js/video.min.js') }}"></script>
    <script src="{{ asset('dist/js/videojs-contrib-hls.js') }}"></script>
    <script src="{{ asset('dist/js/videojs-resolution-switcher.js') }}"></script>

    <script>
        $(document).ready(function() {
            var video = videojs('s3Video',{
                plugins: {
                    videoJsResolutionSwitcher: {
                        default: 'auto',
                        dynamicLabel: true
                    }
                },
                <?php if(!empty($res_src)){?>
                sources: <?php echo $res_src; ?>
                <?php } ?>
            });
        });
    </script>
</body>
