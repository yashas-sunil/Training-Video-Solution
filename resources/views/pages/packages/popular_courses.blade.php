
            
                    @foreach($sectionPackages as $key => $sectionPackage)
                        @if($loop->first)
                            <div class="tab-pane show active" id="showall" role="tabpanel" aria-labelledby="showall-tab">
                                <div class="courses">
                                    <div class="row">
                                        @foreach($sectionPackage['data'] as $caFoundationPackage)
                                            {{--                                        @if(count($caFoundationPackage['videos'])>0)--}}
                                            <div class="col-lg-3 col-md-4 col-sm-12">
                                                <div class="course">
                                                    <div class="course-img">
                                                        <a style="text-decoration:none" href="{{ url('packages/' . ($caFoundationPackage['slug'] ?? $caFoundationPackage['id'])) }}">
                                                            <img src="{{ $caFoundationPackage['image_url'] ?? asset('assets/images/placeholder.png') }}" loading="lazy" alt="">
                                                        </a>
                                                        @if (! request()->session()->has('access_token'))
                                                            <div class="stage">
                                                                <div class="heart buy-now-login" data-id="{{ $caFoundationPackage['id'] }}"></div>
                                                            </div>
                                                        @else
                                                            <div class="stage">
                                                                <div class="heart cart-save-for-later @if(in_array($caFoundationPackage['id'], $wishlist)) is-active @endif" data-id="{{ $caFoundationPackage['id'] }}"></div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <a style="text-decoration:none" href="{{ url('packages/' . ($caFoundationPackage['slug'] ?? $caFoundationPackage['id'])) }}">
                                                        <div class="course-content p-3">
                                                            <h3 style="min-height: 50px; max-height: 50px;">{{ \Illuminate\Support\Str::limit($caFoundationPackage['name'], env('TRIM_SIZE'), $end='...')}}</h3>


                                                            <div class="ratings">
                                                                @for($i=0.4;$i<round($caFoundationPackage['average_rating']);$i++)
                                                                    <span>
                                                                        <img class="star" src="{{asset('assets/new_ui_assets/images/star.png')}}" alt="">
                                                                    </span>
                                                                @endfor
                                                                <p><?= count($caFoundationPackage['order_items'])>0 ? count($caFoundationPackage['order_items']).' Review(s)' :'&nbsp;' ?></p>
                                                            </div>
                                                            <hr>
                                                            <p class="language_display">
                                                                <i class="fa fa-language" aria-hidden="true"></i>
                                                                 @if($caFoundationPackage['language']['name'] == 'English')
                                                                    <span class="english">{{$caFoundationPackage['language']['name']}}</span>
                                                                @elseif($caFoundationPackage['language']['name'] == 'Hindi')
                                                                    <span class="hindi">{{$caFoundationPackage['language']['name']}}</span>
                                                                @else
                                                                    <span class="both">{{$caFoundationPackage['language']['name']}}</span>
                                                                @endif
                                                            </p>
                                                            <p class="lecture">
                                                                <i class="fa fa-play-circle" aria-hidden="true"></i>
                                                                <span>{{ $caFoundationPackage['total_videos'] }} Lectures</span>
                                                            </p>
                                                            <p class="time">
                                                                <i class="fa fa-clock-o" aria-hidden="true"></i>
                                                                <span class="dur-time">
                                                                    @if (!$caFoundationPackage['is_prebook'] || $caFoundationPackage['is_prebook_package_launched'] || $caFoundationPackage['is_prebook_content_ready'])
                                                                        <small>
                                                                            @if ($caFoundationPackage['total_duration_formatted'])
                                                                            {{ $caFoundationPackage['total_duration_formatted'] }} hrs @if($caFoundationPackage['bonus_duration_formatted']) 
                                                                   + {{  $caFoundationPackage['bonus_duration_formatted']}} Bonus Hours
                                                                    @endif
                                                                            @endif
                                                                        </small>
                                                                    @else
                                                                        <small>
                                                                            @if ($caFoundationPackage['prebook_total_duration'])
                                                                                {{ $caFoundationPackage['prebook_total_duration'] }} hrs
                                                                            @endif
                                                                        </small>
                                                                    @endif
                                                                </span>
                                                            </p>
                                                            <div class="course-amount">
                                                                <h5>
                                                                    <i class="fa fa-inr" aria-hidden="true"></i>{{ number_format($caFoundationPackage['selling_price'],2) }}</h5>
                                                                <h6>
                                                                    @foreach ($caFoundationPackage['strike_prices'] as $price)
                                                                        <i class="fa fa-inr" aria-hidden="true"></i>
                                                                        <p>
                                                                            <del>{{ number_format($price,2) }}</del>
                                                                        </p>
                                                                    @endforeach
                                                                </h6>
                                                                @if($caFoundationPackage['discount_percentage']!=0)
                                                                    <span>{{ $caFoundationPackage['discount_percentage'] }}%</span>
                                                                @endif
                                                            </div>
                                                            <div class="bottom_btns d-flex align-items-center justify-content-between">
                                                                <a href="{{ url('packages/' . ($caFoundationPackage['slug'] ?? $caFoundationPackage['id'])) }}" class="btn more">Know More</a>
                                                                @if (! request()->session()->has('access_token'))
                                                                    <a href="#" class="btn enroll buy-now-login" data-toggle="modal" data-target="#modal-login" data-package="{{ $caFoundationPackage['id'] }}">Enroll Now</a>
                                                                @else
                                                                    <a href="{{ url('cart/checkout?package=' . $caFoundationPackage['id']) }}" class="btn enroll">Enroll Now</a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                            {{--                                        @endif--}}
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @else
                        @endif
                        <div class="targetDiv" id="div{{$key+1}}">
                            <div class="courses">
                                <div class="row">
                                    @foreach($sectionPackage['data'] as $caFoundationPackage)
{{--                                        @if(count($caFoundationPackage['videos'])>0)--}}
                                        <div class="col-lg-3 col-md-4 col-sm-12">
                                            <div class="course">
                                                <div class="course-img">
                                                    <a style="text-decoration:none" href="{{ url('packages/' . ($caFoundationPackage['slug'] ?? $caFoundationPackage['id'])) }}">
                                                        <img src="{{ $caFoundationPackage['image_url'] ?? asset('assets/images/placeholder.png') }}" loading="lazy" alt="">
                                                    </a>
                                                    @if (! request()->session()->has('access_token'))
                                                        <div class="stage">
                                                            <div class="heart buy-now-login" data-id="{{ $caFoundationPackage['id'] }}"></div>
                                                        </div>
                                                    @else
                                                        <div class="stage">
                                                            <div class="heart cart-save-for-later @if(in_array($caFoundationPackage['id'], $wishlist)) is-active @endif" data-id="{{ $caFoundationPackage['id'] }}"></div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <a style="text-decoration:none" href="{{ url('packages/' . ($caFoundationPackage['slug'] ?? $caFoundationPackage['id'])) }}">
                                                <div class="course-content p-3">
                                                        <h3 style="min-height: 50px; max-height: 50px;">{{ \Illuminate\Support\Str::limit($caFoundationPackage['name'], env('TRIM_SIZE'), $end='...')}}</h3>


                                                    <div class="ratings">
                                                        @for($i=0.4;$i<round($caFoundationPackage['average_rating']);$i++)
                                                            <span>
                                                                        <img class="star" src="{{asset('assets/new_ui_assets/images/star.png')}}" alt="">
                                                                    </span>
                                                        @endfor
                                                        <p><?= count($caFoundationPackage['order_items'])>0 ? count($caFoundationPackage['order_items']).' Review(s)' :'&nbsp;' ?></p>
                                                    </div>
                                                    <hr>
                                                    <p class="language_display">
                                                        <i class="fa fa-language" aria-hidden="true"></i>
                                                        @if($caFoundationPackage['language']['name'] == 'English')
                                                                    <span class="english">{{$caFoundationPackage['language']['name']}}</span>
                                                                @elseif($caFoundationPackage['language']['name'] == 'Hindi')
                                                                    <span class="hindi">{{$caFoundationPackage['language']['name']}}</span>
                                                                @else
                                                                    <span class="both">{{$caFoundationPackage['language']['name']}}</span>
                                                                @endif
                                                    </p>
                                                    <p class="lecture">
                                                        <i class="fa fa-play-circle" aria-hidden="true"></i>
                                                        <span>{{ $caFoundationPackage['total_videos'] }} Lectures</span>
                                                    </p>
                                                    <p class="time">
                                                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                                                        <span class="dur-time">
                                                                    @if (!$caFoundationPackage['is_prebook'] || $caFoundationPackage['is_prebook_package_launched'] || $caFoundationPackage['is_prebook_content_ready'])
                                                                <small>
                                                                            @if ($caFoundationPackage['total_duration_formatted'])
                                                                            {{ $caFoundationPackage['total_duration_formatted'] }} hrs @if($caFoundationPackage['bonus_duration_formatted']) 
                                                                   + {{  $caFoundationPackage['bonus_duration_formatted']}} Bonus Hours
                                                                    @endif
                                                                    @endif
                                                                        </small>
                                                            @else
                                                                <small>
                                                                            @if ($caFoundationPackage['prebook_total_duration'])
                                                                        {{ $caFoundationPackage['prebook_total_duration'] }} hrs
                                                                    @endif
                                                                        </small>
                                                            @endif
                                                                </span>
                                                    </p>
                                                    <div class="course-amount">
                                                        <h5>
                                                            <i class="fa fa-inr" aria-hidden="true"></i>{{ number_format($caFoundationPackage['selling_price'],2) }}</h5>
                                                        <h6>
                                                            @foreach ($caFoundationPackage['strike_prices'] as $price)
                                                                <i class="fa fa-inr" aria-hidden="true"></i>
                                                                <p>
                                                                    <del>{{ number_format($price,2) }}</del>
                                                                </p>
                                                            @endforeach
                                                        </h6>
                                                        @if($caFoundationPackage['discount_percentage']!=0)
                                                            <span>{{ $caFoundationPackage['discount_percentage'] }}%</span>
                                                        @endif
                                                    </div>
                                                    <div class="bottom_btns d-flex align-items-center justify-content-between">
                                                        <a href="{{ url('packages/' . ($caFoundationPackage['slug'] ?? $caFoundationPackage['id'])) }}" class="btn more">Know More</a>
                                                        @if (! request()->session()->has('access_token'))
                                                            <a href="#" class="btn enroll buy-now-login" data-toggle="modal" data-target="#modal-login" data-package="{{ $caFoundationPackage['id'] }}">Enroll Now</a>
                                                        @else
                                                            <a href="{{ url('cart/checkout?package=' . $caFoundationPackage['id']) }}" class="btn enroll">Enroll Now</a>
                                                        @endif
                                                    </div>
                                                </div>
                                                </a>
                                            </div>
                                        </div>
{{--                                        @endif--}}
                                    @endforeach
                               </div>
                            </div>
                        </div>
                    @endforeach