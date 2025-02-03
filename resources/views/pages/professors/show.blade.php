@extends('layouts.master')
@section('content')



<div class="main">
    <div class="container-fluid">
        <div class="professor-details">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <div class="basic">
                        <img src="{{ $professor['image'] ?? url('/assets/images/avatar.png') }}" alt="{{ $professor['alt'] }}" title="{{ $professor['title_tag'] }}">
                        <h5>{{ $professor['title'] }}</h5>
                        <span>Teacher</span>
                        <p>({{ $professor['experience'] }} Years Exp)</p>
{{--                        <div class="basic-review">--}}
{{--                            <ul>--}}
{{--                                <li>--}}
{{--                                    <i class="fa fa-star" aria-hidden="true"></i>--}}
{{--                                    <h6>25 Reviews</h6>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <i class="fa fa-user" aria-hidden="true"></i>--}}
{{--                                    <h6>150 Students</h6>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <i class="fa fa-book" aria-hidden="true"></i>--}}
{{--                                    <h6>10 Courses</h6>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
                    </div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 column-two">
                    <div class="info">
                        <h2>About Me</h2>
                        <p>{{ $professor['introduction'] }}</p>

                    </div>

                    @if($packages['data'])
                        <div class="proff_courses mr-md-5" >
                            <div class="row" id="results">
                            <div class="ajax-loading">Loading..</div>
                            </div>
							 <div class="no-more-data"></div>
                        <!-- <a href="{{ url('/packages?professor='.$professor['id']) }}" class="btn view_more">View More<i class="fa fa-arrow-right" aria-hidden="true"></i></a> -->
                        </div>
                    @endif
    <div class="scroll-limit"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('script')
    <script>
        $(document).ready(function () {

            $('.buy-now-login').click(function (e) {
                e.preventDefault();
                var packageID = $(this).attr('data-package');
                $(this).removeClass('is-active');
                $("#package-id").val(packageID);
                $("#login-modal").show();
            });

            $('.cart-save-for-later').click(function () {
                let packageID = $(this).attr('data-id');

                if( $(this).hasClass("is-active")){
                    $.ajax({
                        type:'POST',
                        url:'{{ route('save-for-later.store') }}',
                        data: {
                            '_token': '{{ csrf_token() }}',
                            'package_id': packageID
                        },
                        success:function(response) {
                            if(response.exist == 1){
                                $("#toast-exist-in-wishlist").toast('show');
                            }
                            else{
                                $('#toast-save-for-later').toast('show');
                            }
                        }
                    });
                }
                else {
                    $.ajax({
                        type:'GET',
                        url:'{{ route('save-for-later.remove') }}',
                        data: {
                            '_token': '{{ csrf_token() }}',
                            'package_id': packageID
                        },
                        success:function(response) {
                            if(response){
                                $("#toast-remove-wishlist").toast('show');
                            }
                        }
                    });
                }
            });
        });
    </script>

    <script>
        
         var SITEURL = "{{ route('ca-faculty.show',$professor['id'] ) }}";
       
         console.log(SITEURL);
         var page = 1; //track user scroll as page number, right now page number is 1
         load_more(page); //initial content load

         $(window).scroll(function() { //detect page scroll
           if ($(window).scrollTop() >= $(
              '.scroll-limit').offset().top + $('.scroll-limit').
                outerHeight() - window.innerHeight){ //if user scrolled from top to bottom of the page
                page++; //page number increment
                load_more(page); //load content   
            }
        }); 

    function load_more(page){
        $.ajax({
           url: SITEURL + "posts?page=" + page,
           type: "get",
           datatype: "html",
           beforeSend: function()
           {
             // $('.ajax-loading').show();
            }
        })
        .done(function(data)
        {
            if(data.length == 0){
            console.log(data.length);
            //notify user if nothing to load
            $('.no-more-data').html("No more records!");
            $('.ajax-loading').hide();
            return;
          }
          $('.ajax-loading').hide(); //hide loading animation once data is received
          $("#results").append(data); //append data into #results element          
           console.log('data.length');
       })
       .fail(function(jqXHR, ajaxOptions, thrownError)
       {
          //alert('No response from server');
       });
    }
	$(document).ready(function(){
 if($(window).scrollTop() + $(window).height() >= $(document).height()) { //if user scrolled from top to bottom of the page
                page++; //page number increment
                load_more(page); //load content   
            }
});
    </script>

   
@endpush
