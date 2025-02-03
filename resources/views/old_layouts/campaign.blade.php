<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.head')
</head>
<body>
@include('partials.campaign')
{{--Uncomment below line when use fixed header--}}
{{--<div class="d-md-none my-5"></div>--}}
@include('pages.auth.otp-modal')
@yield('content')
<div style="position: fixed; top: 20px; right: 20px; z-index: 9999;">
    <div id="toast-added-to-cart" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000" style="display: none;">
        <div class="toast-body">
            Added to cart
        </div>
    </div>
    <div id="toast-already-exist" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000" style="display: none;">
        <div class="toast-body">
            Package already purchased or exist in the cart
        </div>
    </div>
    <div id="toast-thanks-for-request" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000" style="display: none;">
        <div class="toast-body">
            Thank you for your request, we will contact you soon.
        </div>
    </div>
    <div id="toast-professor-answer-saved" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000" style="display: none;">
        <div class="toast-body">
            Professor answer saved.
        </div>
    </div>
</div>

@include('partials.footer')

@include('partials.scripts')

<script>
    $(function () {
        $('.toast').on('show.bs.toast', function () {
            $(this).show();
        }).on('hidden.bs.toast', function () {
            $(this).hide();
        });
    });
</script>
</body>
</html>
