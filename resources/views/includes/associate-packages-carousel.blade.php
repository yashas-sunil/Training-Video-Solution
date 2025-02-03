<div id="carousel-courses" class="owl-carousel owl-theme clearfix">
    @foreach ($packages['data'] as $package)
        <div class="item mt-3 mb-4 w-100 popup-trigger" data-popover-id="course-popover-{{ $package['id'] }}">
            <div class="w-100 course-popover-trigger">
                <a href="{{ url('packages/' . ($package['slug'] ?? $package['id'])) }}" class="text-dark text-decoration-none w-100">
                    <div class="card shadow">
                        <img src="{{ $package['image_url'] ?? asset('assets/images/placeholder.png') }}" class="card-img-top"
                             alt="{{ $package['name'] }}" title="{{ $package['title_tag'] }}">
                        <div class="card-body d-flex flex-column">
                            <div class="card-title">
                                <h5 class="mb-0 text-truncate">{{ $package['name'] }}</h5>
                                <small class="text-muted">{{$package['language']['name']}}</small>
                            </div>
                            <div class="d-flex flex-row-reverse justify-content-center flex-nowrap py-1">
                                @php
                                    $max_count = 3;
                                    $count = count($package['professors']);
                                    $professors = $package['professors'];
                                    $professors = collect($package['professors'])->take($max_count);
                                @endphp
                                @foreach($professors as $professor)
                                    <div class="position-relative" style="margin-left: -8px;">
                                        <img src="{{ $professor['image'] ?? '/assets/images/avatar.png' }}"
                                             alt="..."
                                             class="img-thumbnail rounded-circle border-0"
                                             style="width: 40px !important; height: 40px !important; display: inline; padding: 2px" title="{{ $professor['title_tag'] }}">
                                        @if ($loop->first && $count > $max_count)
                                            <div class="position-absolute d-flex text-center rounded-circle" style="margin: 2px; left: 0; right: 0; top: 0; bottom: 0; background: rgba(0, 0, 0, .5);">
                                                <small class="text-light flex-fill rounded-circle" style="line-height: 36px;">+{{ $count - $max_count }}</small>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                            <div class="flex-fill"></div>
                            <span class="text-muted mt-2">
                            <small>
                                @foreach ($package['strike_prices'] as $price)
                                    <del>₹ {{number_format($price,2)}} </del>
                                @endforeach
                            </small>
                        </span>
                            <div class="d-flex align-items-center text-center">
                                <div class="flex-fill">
                                    <strong>₹ {{ number_format($package['selling_price'],2) }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <div id="course-popover-{{ $package['id'] }}"
                     class="popup w-100">
                    <div class="arrow" data-popper-arrow></div>
                    <!--<div class="popover-title"><span class="close pull-right" data-dismiss="popover-x">&times;</span>Title</div>-->
                    <div class="popup-content">
                        <div class="popup-body p-3">
                            <h4 class="mb-0"><a href="{{ url('packages/' . ($package['slug'] ?? $package['id'])) }}" class="text-dark">{{ $package['name'] }}</a> </h4>
                            <div>
                                <small class="text-muted">{{ $package['course']['name'] }} | {{ $package['level']['name'] }}</small>
                            </div>
                            <div class="text-muted">

                            </div>
                            <hr class="my-2"/>
                            <div class="text-muted mt-2" style="font-size: .8rem; max-height: 306px; min-height: 240px; overflow: hidden;">
                                @if (count($package['subjects_and_chapters']) > 1)
                                    <strong><u>Subjects</u></strong>
                                @endif
                                @foreach ($package['subjects_and_chapters'] as $subject)
                                    @if (isset($subject['chapters']))
                                        <span>{{ $subject['name'] }}</span><br/>
                                        <ul class="m-0">
                                            <strong><u>Chapters</u></strong>
                                            @foreach($subject['chapters'] as $chapter)
                                                <li>{{ $chapter['name'] }}</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <ul class="m-0">
                                            <li>{{ $subject['name'] }}</li>
                                        </ul>
                                    @endif
                                @endforeach
                            </div>
                            <hr class="my-2"/>
                            <div class="text-muted">
                                {{--                                <small><i class="fa fa-question-circle mr-1"></i>25 Questions</small>--}}
                                {{--                                <small class="ml-2"><i class="fa fa-clipboard-check mr-1"></i>12 Chapter test</small>--}}
                                {{--                                <small class="ml-2"><i class="fa fa-question-circle mr-1"></i>3 Quiz's</small>--}}
                                <small> @if ($package['total_videos']) <i class="fa fa-play-circle mr-1"></i>{{ $package['total_videos'] }} Lectures @endif </small>
                                <small class="ml-2"> @if ($package['total_duration_formatted']) <i class="fa fa-clock mr-1"></i>{{ $package['total_duration_formatted'] }} @endif </small>
                                <small alt="View time" class="ml-2"> @if ($package['duration_formatted']) <i class="fa fa-eye mr-1"></i>{{ $package['duration_formatted'] }}  @endif </small>
                                {{--                                <small class="ml-2"> @if ($package['enrolled_count']) <i class="fa fa-user-circle mr-1"></i>{{ $package['enrolled_count'] }} Enrolled @endif </small>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
        @if(count($packages['data']) >= 11 && !isset($professor_id) )
    <div class="item mx-2 mt-3 mb-4 popup-trigger" data-popover-id="mini-course-popover-1000">
        <div class="course-popover-trigger">
            <a href="{{ isset($professor_id) ? url('packages?professor='.$professor_id): url('packages') }}" class="text-dark text-decoration-none">
                <div class="card shadow">
                    <div class="card-body d-flex flex-column">

                        <img src="{{ url('assets/images/view-more.png') }}" alt="JK Shah Online" title="JK Shah Online">
                        <h5 class=" text-secondary text-center">View More</h5>
                    </div>
                </div>
            </a>

        </div>
    </div>
    @endif
        @if(count($packages['data']) >= 3 && isset($professor_id) )
            <div class="item mx-2 mt-3 mb-4 popup-trigger" data-popover-id="mini-course-popover-1000">
                <div class="course-popover-trigger">
                    <a href="{{ isset($professor_id) ? url('packages?professor='.$professor_id): url('packages') }}" class="text-dark text-decoration-none">
                        <div class="card shadow">
                            <div class="card-body d-flex flex-column">

                                <img src="{{ url('assets/images/view-more.png') }}" alt="JK Shah Online" title="JK Shah Online">
                                <h5 class=" text-secondary text-center">View More</h5>
                            </div>
                        </div>
                    </a>

                </div>
            </div>
        @endif
</div>


@push('script')
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

            {{--$('.cart-save-for-later').click(function () {--}}
            {{--let packageID = $(this).data('id');--}}

            {{--$.ajax({--}}
            {{--type:'POST',--}}
            {{--url:'{{ route('save-for-later.store') }}',--}}
            {{--data: {--}}
            {{--'_token': '{{ csrf_token() }}',--}}
            {{--'package_id': packageID--}}
            {{--},--}}
            {{--success:function() {--}}
            {{--$('#toast-added-to-save-for-later').toast('show');--}}
            {{--}--}}
            {{--});--}}
            {{--});--}}

            $('#carousel-courses .buy-now-login').click(function () {
                $(".modal-body #package-id").val($(this).data(('package')));
            });
        });
    </script>
@endpush
@include('includes.package-carousel-popover-scripts')
