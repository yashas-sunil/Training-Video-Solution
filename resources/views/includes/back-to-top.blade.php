<div id="back-to-top" class="call-rotate back-to-top">
    <a href="#up" class="up-btn">
        <span class="fa fa-chevron-up arrow-up"></span>
    </a>
</div>

@push('script')
<script>
    $(function () {
        'use strict';
            $('#back-to-top').hide();
            $(window).scroll(function () {
                if ($(this).scrollTop() > 50) {
                    $('#back-to-top').fadeIn();
                } else {
                    $('#back-to-top').fadeOut();
                }
            });

            // scroll body to 0px on click
            $('#back-to-top').click(function () {
            $('body,html').animate({
            scrollTop: 0
        }, 400);
            return false;
        });
    });
</script>
@endpush
