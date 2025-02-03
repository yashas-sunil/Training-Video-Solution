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
<!-- End Google Tag Manager (noscript) -->
<header class="">
    <div class="row no-gutters align-items-stretch">
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


            </nav>
        </div>
        <div class="col-md d-flex">
            <nav
                class="navbar navbar-expand-md navbar-dark bg-primary text-light border-bottom border-md-navbar border-white py-0 align-self-stretch flex-fill">
                <div class="collapse navbar-collapse py-2 py-md-0" id="navbarCollapse" data-hover="dropdown">

                </div>
            </nav>
        </div>
    </div>
</header>

@push('script')
    <script id="script-modal-signup">
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

            var updateCartCount = function () {
                var url = '{{ url('cart') }}';

                $.get({
                    url: url,
                    cache: false,
                    dataType: 'json'
                }).done(function (response) {
                    var count = 0;

                    if (response.data != null) {
                        if (Array.isArray(response.data.items)) {
                            count = response.data.items.length;
                        }

                        $notificationBadge.text(count);

                        if (count > 0) {
                            $notificationBadge.show();
                        } else {
                            $notificationBadge.hide();
                        }
                    }
                }).fail(function () {

                });
            };

            updateCartCount();

            $('body').on('change.cart', function () {
                updateCartCount();
            });
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
    </script>
@endpush
