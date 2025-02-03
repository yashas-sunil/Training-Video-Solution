@foreach ($packages['data'] as $package)
    <div class="col-lg-12 col-md-6 col-sm-12">
        <div class="course">
            <!-- <img src="{{ $package['image_url'] ?? asset('assets/images/placeholder.png') }}"
                 alt="{{ $package['alt'] }}" title="{{ $package['title_tag'] }}" loading="lazy"> -->
                 <div class="course-img">
                                                            <a style="text-decoration:none" href="{{ url('packages/' . ($package['slug'] ?? $package['id'])) }}">
                                                                <img src="{{ $package['image_url'] ?? asset('assets/images/placeholder.png') }}" loading="lazy" alt="">
                                                            </a>

                                                        </div>
            <div class="course-content p-3">
                <!-- <h3>{{ $package['name'] }}</h3> -->
                <a style="text-decoration:none" href="{{ url('packages/' . ($package['slug'] ?? $package['id'])) }}">
                                                                <h3>{{ \Illuminate\Support\Str::limit($package['name'], env('TRIM_SIZE'), $end='...')}}</h3>
                                                            </a>
                <div class="ratings">
                    @if($package['rating'])
                    <span>
                         @for($i=0; $i<$package['rating']; $i++)
                        <i class="fa fa-star" aria-hidden="true"></i>
                             @endfor
                    </span>
                    @endif
                    <p><?= count($package['order_items'])>0 ? count($package['order_items']).' Review(s)' :'&nbsp;' ?></p>
                </div>
                <p class="language_display">
                                                                <i class="fa fa-language" aria-hidden="true"></i>
                                                                @if($package['language']['name'] == 'English')
                                                            <span class="english">English</span>
                                                        @elseif($package['language']['name'] == 'Hindi')
                                                            <span class="hindi">Hindi</span>
                                                        @else
                                                            <span class="both">English + Hindi</span>
                                                        @endif
                                                </p>
                                                <div class="course-amount">
                                                <h5>
                                                    <i class="fa fa-inr" aria-hidden="true"></i>{{ number_format($package['selling_price'],2) }}</h5>
                                                <h6>
                                                    @foreach ($package['strike_prices'] as $price)
                                                        <i class="fa fa-inr" aria-hidden="true"></i>
                                                        <p>
                                                            <del>{{ number_format($price,2) }}</del>
                                                        </p>
                                                    @endforeach
                                                </h6>
                                                @if($package['discount_percentage']!=0)
                                                    <span>{{ $package['discount_percentage'] }}%</span>
                                                @endif
                                                 </div>
                <button class="btn btn-add-to-cart" data-id="{{ $package['id'] }}">Move to Cart</button>
            </div>
        </div>
    </div>
@endforeach

@push('js')
    <script>
        $(document).ready(function () {
            $('#carousel-courses').owlCarousel({
                margin: 20,
                loop: false,
                nav: {{ $nav ?? 'true' }},
                dots: {{ $nav ?? 'false' }},
                navText: [
                    '<i class="fa fa-chevron-left">',
                    '<i class="fa fa-chevron-right">'
                ],
                responsive: {
                    0: {
                        items: 1
                    },
                    768: {
                        items: 2
                    },
                    992: {
                        items: 3
                    },
                    1200: {
                        items: 4
                    }
                }
            });

            $('#carousel-courses .buy-now-login').click(function () {
                $(".modal-body #package-id").val($(this).data(('package')));
            });
        });
    </script>
@endpush
@include('includes.package-carousel-popover-scripts')
