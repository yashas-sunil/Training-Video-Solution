{{--<script src="{{ asset('assets/new_ui_assets/js/jquery.min.js') }}"></script>--}}
<script src="{{ url('vendor/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('assets/new_ui_assets/js/bootstrap.bundle.js') }}"></script>
<script src="{{ asset('assets/new_ui_assets/js/owl.carousel.2.3.4.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('assets/new_ui_assets/js/custom.js') }}"></script>

<!-- <script src="js/all.js"></script> -->

<script src="{{ url('vendor/winwheel/Winwheel.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/latest/TweenMax.min.js"></script>
<script src="{{ url('vendor/@popperjs/core/dist/umd/popper.min.js?v=1.0.1') }}"></script>
{{--<script src="{{ url('vendor/bootstrap/dist/js/bootstrap.bundle.min.js?v=1.0.1') }}"></script>--}}
{{--<script src="{{ url('vendor/owl.carousel/dist/owl.carousel.min.js') }}"></script>--}}
<script src="{{ url('vendor/breakpoints-js/dist/breakpoints.min.js?v=1.0.1') }}"></script>
<script src="{{ url('vendor/bootstrap-hover-dropdown/bootstrap-hover-dropdown.js') }}"></script>
<script src="{{ url('vendor/select2/js/select2.min.js') }}"></script>
<script src="{{ url('vendor/jquery-magnific-popup/jquery.magnific-popup.min.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/additional-methods.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
<script src="{{ url('vendor/jquery-bar-rating/jquery.barrating.min.js') }}"></script>
<script src="{{ url('assets/js/app.js?v=1.0.1') }}"></script>
<script src="{{ asset('/vendor/toastr/toastr.js') }}"></script>
<script src="{{  asset('assets/new_ui_assets/js/loadingBar.js') }}"></script>
@stack('script')
<script>
    (function (document, window, $) {
        'use strict';

        <?php
            $alerts = ['success', 'info', 'warning', 'error'];
            ?>

            @foreach($alerts as $alert)
            @if(session()->has($alert))
            toastr['{{ $alert }}']('{{ session()->get($alert) }}');
        @endif
        @endforeach

        <?php
        session()->forget($alerts);
        ?>

    })(document, window, jQuery);
</script>
