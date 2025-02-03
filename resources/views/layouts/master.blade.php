<!DOCTYPE html>
<html lang="en">
@include('partials.head')
<body>

@include('partials.header')

@yield('content')
<!-- Google Tag Manager (noscript) -->
<noscript><iframe
src="https://www.googletagmanager.com/ns.html?id=GTM-NG6VFD77"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->


<!-- Google Tag Manager (noscript) -->
<!-- <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KB6KS2FC"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript> -->
<!-- End Google Tag Manager (noscript) -->
    


{{--@include('includes.back-to-top')--}}
{{--@include('pages.auth.signin-modal')--}}
{{--@include('pages.auth.signup-modal')--}}
@include('includes.referandearn')
{{--@include('pages.auth.otp-modal')--}}
@include('pages.auth.otpcontactus-modal')
<div style="position: fixed; top: 55px; right: 20px; z-index: 9999;">
    <div id="toast-added-to-cart" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000" style="display: none;">
        <div class="toast-body">
            Added to cart
        </div>
    </div>
    <div id="toast-remove-wishlist" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000" style="display: none;">
        <div class="toast-body">
            Package removed from wishlist.
        </div>
    </div>
    <div id="toast-exist-in-wishlist" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000" style="display: none;">
        <div class="toast-body">
            Package already purchased or exist in the wishlist.
        </div>
    </div>
    <div id="toast-save-for-later" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000" style="display: none;">
        <div class="toast-body">
            Package saved for later.
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
    <div id="toast-email-updated" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000" style="display: none;">
        <div class="toast-body">
            Email updated successfully.
        </div>
    </div>
    <div id="toast-verification-failed" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000" style="display: none;">
        <div class="toast-body">
            OTP verification failed. Please try again.
        </div>
    </div>
    <div id="toast-testi-feedback" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000" style="display: none;">
        <div class="toast-body">
           Feedback submitted successfully.
        </div>
    </div>
    <div id="toast-techsupport" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000" style="display: none;">
        <div class="toast-body">
           Query submitted successfully.
        </div>
    </div>
    <div id="toast-cseet" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000" style="display: none;">
        <div class="toast-body">
           Enrollment certificate uploaded successfully
        </div>
    </div>
     <div id="toast_enquire_form_id" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000" style="display: none;">
        <div class="toast-body">
           Enquiry has submitted successfully.
        </div>
    </div>
</div>
@include('includes.back-to-top')
@include('partials.site_footer')
<!-- End Footer -->
@include('partials.site_javascript')

@stack('js')
<script>

    @if(env('APP_ENV')!="local")

    document.addEventListener('contextmenu', event => event.preventDefault());

    $(document).keydown(function (event) {
        if (event.keyCode == 123) { // Prevent F12
            return false;
        } else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) { // Prevent Ctrl+Shift+I
            return false;
        }
        else if (event.ctrlKey && event.shiftKey && event.keyCode == 74) { // Prevent Ctrl+Shift+J
            return false;
        }
        else if (event.ctrlKey && event.shiftKey && event.keyCode == 67) { // Prevent Ctrl+Shift+C
            return false;
        }
    });

    @endif

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
