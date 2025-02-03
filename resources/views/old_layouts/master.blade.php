<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.head')
</head>
<body  @if(env('APP_ENV')!="local") oncopy="return false" oncut="return false" onpaste="return false" @endif>
@include('partials.header')
{{--Uncomment below line when use fixed header--}}
{{--<div class="d-md-none my-5"></div>--}}
@yield('content')


@if( !Request::is('videos/*'))
@include('includes.call-me')
@endif

@include('includes.back-to-top')
{{--<!-- LOGIN MODAL-->--}}
@include('pages.auth.signin-modal')
<!---- END LOGIN MODAL ------->

<!-- SUGNUP MODAL-->
@include('pages.auth.signup-modal')
<!---- END SUGNUP MODAL ------->

@include('includes.referandearn')

@include('pages.auth.otp-modal')

@include('pages.auth.otpcontactus-modal')
<div style="position: fixed; top: 20px; right: 20px; z-index: 9999;">
    <div id="toast-added-to-cart" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000" style="display: none;">
        <div class="toast-body">
            Added to cart
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
</div>

@include('partials.footer')

@include('partials.scripts')

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
