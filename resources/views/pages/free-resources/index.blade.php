@extends('layouts.master')
@section('content')
<style>
      .appliedFilter li {
    background: #e9f3fd;
    padding: 10px 2px 10px 10px;
    border-radius: 20px;
    margin-right: 10px;
    color: #000;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    display: inline-block;
    margin-bottom: 5px;
    align-items: center;
    vertical-align: middle;
}
.filterCross {
    width: 18px;
    height: 15px;
    background: url(//jsak.mmtcdn.com/flights/assets/media/filterCross.645df612.png) no-repeat 0 -1px;
    display: inline-block;
    border-radius: 40px;
    margin-left: 5px;
    background-size: 100%;
    cursor: pointer;
}
    .buy-pack {
    position: relative;
    color: #000;
    top: 2rem;
    background: #e78c60;
    padding: 10px 20px;
    border-radius: 7px;
    left: 41%;
    text-decoration:none !important;
}
.mfp-iframe-scaler {
    width: 100%;
    height: 0;
    overflow: inherit;
    padding-top: 56.25%;
}
.demo-info {
    background: #3c3881;
    padding: 1% 0 !important;
}
.sidebar-content{
    background-color: #f8fbfb;
}
    </style>
    <div class="main">
        <div class="demo-info">
            <h1>Demo Lectures</h1>
        </div>
        <div class="page-wrapper chiller-theme toggled">
            <a id="show-sidebar" class="btn btn-sm">
                <i class="fa fa-chevron-right" aria-hidden="true"></i>
            </a>
            <nav id="sidebar" class="sidebar-wrapper">
                <div class="sidebar-content">
                    <div class="sidebar-brand">
                        <h5>Filters</h5>
                        <div id="close-sidebar">
                            <i class="fa fa-times text-secondary " aria-hidden="true"></i>
                        </div>
                    </div>
                    <form id="filter-form" method="GET" action="">
                        @include('includes.demo_filter')
                        <input type="hidden" name="sort" id="sort" @if(request()->input('sort')) value="{{ request()->input('sort') }}" @endif>
                        {{--                            <input type="hidden" name="level_ids[]" id="level_ids">--}}
                        {{--                            <input type="hidden" name="language_ids[]" id="language_ids">--}}
                        {{--                            <input type="hidden" name="subject_ids[]" id="subject_ids">--}}
                    </form>
                </div>
                <div class="apply_filter">
                <button class="apply">Apply</button>
                <a href="{{ url('ca-demo-lectures-online') }}" class="btn reset" >Reset</a>
            </div>
            </nav>
           
            <main class="page-content">
                <div class="container-fluid demo-list">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-white p-md-0">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Demo</li>
                        </ol>
                    </nav>
                    <div class="row justify-content-center m-md-0">
                        <form id="search-demo" method="GET" action="{{ route('ca-demo-lectures-online.index', array_merge(request()->all(), ['resource_type' => $tab,'page' => 1])) }}">
                            <i class="fa fa-search" aria-hidden="true"></i>
                            <input type="search" id="search" name="search" class="form-control"
                                   @if(isset($_GET['search']))  value="{{ $_GET['search'] }}" @endif
                                   placeholder="Search for demos here">
                            <input type="hidden" id="search_tab" name="search_tab" value="{{ $tab }}">
                            <button type="submit" class="btn btn-primary mr-2">Filter</button>
                            <a href="{{ route('ca-demo-lectures-online.index', array_merge(['resource_type' => request()->input('search_tab'),'page' => 1])) }}" id="clear-button" class="btn btn-primary">Clear</a>
                        </form>
                    </div>
                    <div class="filter">
    <ul class="appliedFilter mb-0">
    @foreach($levels as $level)
        @if(in_array( $level['id'],$levelIds))
                 
                        <!-- <input type="hidden" class="level_id" value="{{ $level['id'] }}"> -->
                        <li id="level_{{$level['id']}}">{{ $level['name'] }}<span class="filterCross" id="levels_{{$level['id']}}"></span></li>
              
                    @endif
                @endforeach
                @if(!empty($professors))
                @foreach(@$professors as $professor)
        @if(in_array( $professor['id'],$professorIds))
                  
                        <!-- <input type="hidden" class="level_id" value="{{ $level['id'] }}"> -->
                        <li id="professor_{{$professor['id']}}">{{ $professor['name'] }}<span class="filterCross" id="professors_{{$professor['id']}}"></span></li>
                   
                    @endif
                @endforeach
                @endif
</ul>
</div>

                    <div class="switch-tabs">
                        <div class="row multi-tabs m-md-0" data-aos="fade-up">
                            <ul class="nav" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link {{ $tab == 'videos' ? 'active' : '' }}" id="videos-tab" href="{{ route('ca-demo-lectures-online.index', array_merge(['resource_type' => 'videos','page' => 1])) }}" role="tab"
                                       aria-controls="all" aria-selected="true">Videos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ $tab == 'documents' ? 'active' : '' }}" id="documents-tab" href="{{ route('ca-demo-lectures-online.index',  array_merge(['resource_type' => 'documents','page' => 1])) }}" role="tab"
                                       aria-controls="crash_course" aria-selected="false">Documents</a>
                                </li>
                            </ul>
                            <div class="sorting d-flex align-items-baseline justify-content-between ">
                                <label for="abc">Sort By:</label>
                                <form>
{{--                                    <input type="hidden" name="tab" value="{{ $tab }}">--}}
                                    <select id="order_by_filter" name="sort_value">
                                        <option class="sel-opt" disabled="disabled" selected="selected">Select option
                                        </option>
                                        <option class="sel-opt" value="">Default Sorting</option>
                                        <option class="sel-opt" value="1">A-Z</option>
                                        <option class="sel-opt" value="2">Z-A</option>
                                    </select>
                                </form>
                            </div>
                        </div>

                        <div class="container-fluid" data-aos="fade-up">
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade @if($tab == 'videos') show active @endif" id="videos" role="tabpanel"
                                     aria-labelledby="videos-tab">
                                    <div id="demo">
                                    <div class="row" id="results">

                                      
<div class="ajax-loading">Loading..</div>


                                        <!-- @if($freeResourcesVideos)
                                                @if(count($freeResourcesVideos)>0)
                                                @foreach($freeResourcesVideos as $free_resource)
                                                    @if($free_resource['type'] == 5 )
                                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                                            <div class="course-demo">
                                                                <a class="popup-iframe" href="{{ url("embed/videos/".$free_resource['media_id']) }}">
                                                                    <img src="https://cdn.jwplayer.com/v2/media/{{$free_resource['media_id']}}/poster.jpg?width=320" loading="lazy">
                                                                    <i class="fa fa-play-circle" aria-hidden="true"></i>
                                                                </a>
                                                                <div class="demo-details p-md-3">
                                                                    <h4>{{$free_resource['title']}}</h4>
                                                                    {{--                                                                <p>Prof. Gaurav Thaker</p>--}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @elseif($free_resource['type'] == 1 )
                                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                                            <div class="course-demo">
                                                                <a title="test" rev="{{ url('packages/' .$free_resource['demo_package_id']) }}" class="popup-iframe" href="http://www.youtube.com/watch?v={{$free_resource['youtube_id']}}">
                                                                    <img src="https://img.youtube.com/vi/{{$free_resource['youtube_id']}}/mqdefault.jpg">
                                                                    <i class="fa fa-play-circle" aria-hidden="true"></i>
                                                                </a>
                                                                <div class="demo-details p-md-3">
                                                                    <h4>{{$free_resource['title']}}</h4>
                                                                    {{--   <p>Prof. Gaurav Thaker</p>--}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @else
                                                <p><b>No Data Available!</b></p>
                                            @endif
                                            @else
                                                <p><b>No Data Available!</b></p>
                                            @endif -->
                                        </div>
                                        <div class="no-more-data"></div>
                                        <div class="scroll-limit"></div>
                                    </div>
                                    @if($freeResourcesVideos)
                                    <!-- {{ $freeResourcesVideos->links() }} -->
                                    @endif
                                </div>
                                <div class="tab-pane fade @if($tab == 'documents') show active @endif" id="documents" role="tabpanel" aria-labelledby="documents">
                                    <div id="doc">
                                    <div class="row" id="resultss">

                                        <div class="ajax-loadings">Loading..</div>

                                        
                                            <!-- @if($freeResourcesDocuments)
                                                @foreach($freeResourcesDocuments as $freeResourcesDocument)
                                                    @if($freeResourcesDocument['type'] == 3 )
                                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                                            <div class="doc-demo">
                                                                <embed name="plugin" src="{{$freeResourcesDocument['file_url']}}" type="application/pdf">
                                                                <a class="text-decoration-none" target="_blank" download="{{$freeResourcesDocument['file']}}" href="{{$freeResourcesDocument['file_url']}}">
                                                                    <div class="demo-details p-md-3">
{{--                                                                        <p>Prof. Gaurav Thaker</p>--}}
                                                                        <h4>{{$freeResourcesDocument['title']}}</h4>
                                                                        <span>new</span>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @endif -->
                                        </div>
                                        <div class="no-more-data"></div>
                                        <div class="scroll-limit"></div>
                                    </div>
                                    @if($freeResourcesDocuments)
                                        <!-- {{ $freeResourcesDocuments->links() }} -->
{{--                                        <nav aria-label="Page navigation example">--}}
{{--                                            <ul class="pagination pagination-circle pg-blue">--}}
{{--                                                <li class="page-item"><a class="page-link" href="{{ route('ca-demo-lectures-online.index', ['tab' => 'documents', 'page' => 1]) }}">First</a></li>--}}
{{--                                                <li class="page-item">--}}
{{--                                                    @if($page <=1)--}}
{{--                                                        <a class="page-link" disabled>Previous</a>--}}
{{--                                                    @else--}}
{{--                                                        <a class="page-link" href="{{ route('ca-demo-lectures-online.index', ['tab' => 'documents', 'page' => $page - 1]) }}" aria-label="Previous">--}}
{{--                                                            <span aria-hidden="true">&laquo;</span>--}}
{{--                                                            <span class="sr-only">Previous</span>--}}
{{--                                                        </a>--}}
{{--                                                    @endif--}}
{{--                                                </li>--}}
{{--    --}}{{--                                            <li class="page-item active"><a class="page-link">1</a></li>--}}
{{--    --}}{{--                                            <li class="page-item"><a class="page-link">2</a></li>--}}
{{--    --}}{{--                                            <li class="page-item"><a class="page-link">3</a></li>--}}
{{--    --}}{{--                                            <li class="page-item"><a class="page-link">4</a></li>--}}
{{--    --}}{{--                                            <li class="page-item"><a class="page-link">5</a></li>--}}
{{--                                                <li class="page-item">--}}
{{--                                                    @if($page >= $freeResourcesDocuments['last_page'])--}}
{{--                                                        <a disabled class="page-link" >Next</a>--}}
{{--                                                    @else--}}
{{--                                                        <a class="page-link" href="{{  route('ca-demo-lectures-online.index', ['tab' => 'documents', 'page' => $page + 1]) }}" aria-label="Next">--}}
{{--                                                            <span aria-hidden="true">&raquo;</span>--}}
{{--                                                            <span class="sr-only">Next</span>--}}
{{--                                                        </a>--}}
{{--                                                    @endif--}}
{{--                                                </li>--}}
{{--                                                <li class="page-item"><a href="{{  route('ca-demo-lectures-online.index', ['tab' => 'documents', 'page' => $freeResourcesDocuments['last_page']]) }}" class="page-link">Last</a></li>--}}
{{--                                            </ul>--}}
{{--                                        </nav>--}}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <!-- page-content" -->
        </div>
@endsection
@push('js')
    <script>
        $(function (){

            $('.filterCross').click(function (e) {
                e.preventDefault();
               var id=$(this).attr('id');
              level_id=id.split('_');
              LevelId=level_id[1];
              filterArea=level_id[0];
         
              if(filterArea=='levels'){ 
               // checksubject(LevelId);
                   $('#level-'+LevelId).prop('checked', false);
              $("#level_"+LevelId).hide();
              }else if (filterArea == 'professors') {

$('#professor_ids_' + LevelId).prop('checked', false);
$("#professor_" + LevelId).hide();
}
             
          $("#filter-form").submit();
          $('.applys').html('<i class="fa fa-spinner fa-pulse fa-1x fa-fw"></i>');
            });
            var levelIds = @json($levelIds) ?? [];
            var levelId;

            if(levelIds.length>0){
                $(".apply_filter").css('display', 'block');
            }

            var profIds = @json($professorIds) ?? [];

            if(profIds.length>0){
                $(".apply_filter").css('display', 'block');
            }

            $(".levels").change(function (){
                if(this.checked) {
                    levelId = $(this).closest('.level-name').find('.level_id').val();
                    levelIds.push(levelId);
                    $("#no_course_selected").addClass('d-none');
                }
                else {
                    levelId = $(this).closest('.level-name').find('.level_id').val();
                    levelIds = jQuery.grep(levelIds, function(value) {
                        return value != levelId;
                    });
                }
            });

            $(".professors").change(function (){
                if(this.checked) {
                    $(".apply_filter").css('display', 'block');
                }
            });

            $(".apply").click(function (e){
                e.preventDefault();
                $(this).attr('disabled', true);
                $(this).html('<i class="fa fa-spinner fa-pulse fa-1x fa-fw"></i> Searching');
                $("#filter-form").submit();
            });

            $("#order_by_filter").change(function (){
                $("#sort").val($(this).val());
                $("#filter-form").submit();
            });

        });
        function activatePopup() {

            if ($(".popup-youtube, .popup-vimeo, .popup-gmaps, .popup-iframe").length) {
        $('.popup-youtube, .popup-vimeo, .popup-gmaps, .popup-iframe').magnificPopup({
            disableOn: 700,
            type: 'iframe',
            mainClass: 'mfp-fade',
            removalDelay: 160,
            preloader: false,
            closeOnBgClick: false,
            fixedContentPos: false,
            iframe: {
                markup: '<style>.mfp-iframe-holder .mfp-content {max-width: 900px;height:500px}</style>'+ 
                '<div class="mfp-iframe-scaler" ><div class="mfp-title"></div>'+
                '<div class="mfp-close"></div>'+
                '<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>'+
                '</div></div>'
            } ,
            callbacks: {
    markupParse: function(template, values, item) {
        var hl=item.el.attr('rev');
     values.title= '<a class="buy-pack" href="'+hl +'">Buy this Course Now</a>';
    }
  }  
        });
    }
	}

    </script>




<script>
         activatePopup();
        var SITEURL = "{{ route('ca-demo-lectures-online.index') }}";
      
        console.log(SITEURL);
        var page = 1; //track user scroll as page number, right now page number is 1
        load_more(page); //initial content load

     

       $(window).on('scroll', function() {
        activatePopup();
            if ($(window).scrollTop() >= $('.scroll-limit').offset().top + $('.scroll-limit').outerHeight() - window.innerHeight) {
                
                page++; //page number increment
                load_more(page); //load content   
            }
        });

   function load_more(page){
      
    var tab;
       if($(".nav a.active").attr("id") == 'videos-tab'){
            tab = 'videos'
       }else{
            tab = 'documents'
       }  

    // var tab= '?tab=videos' ;
    // var pages = '&page=' ;
       var sort_v = $('#sort').val();
       var search_v = $('#search').val();
       var levels = []; 
       var proff  = [];
        
        $('input[name="level_ids[]"]:checked').each(function () {
            levels.push(this.value);
        }); 

        $('input[name="professor_ids[]"]:checked').each(function () {
            proff.push(this.value);
        }); 
       
       
      
       $.ajax({
          url: SITEURL,
          type: "get",
          datatype: "html",
          data: { sort: sort_v,search : search_v,level_ids :levels ,professor_ids:proff,tab:tab,page:page },
          beforeSend: function()
          {
           //   $('.ajax-loading').show();
           }
       })
       .done(function(data)
       {
           if(data.length == 0){
           console.log(data.length);
           //notify user if nothing to load
          // $('.no-more-data').html("No more records!");
          //$('.ajax-loading').hide();
           return;
         }
         if(tab == 'videos'){
            $('.ajax-loading').hide(); //hide loading animation once data is received
            $("#results").append(data); //append data into #results element          
            console.log('data.length');
         }
         if(tab == 'documents'){
            
            $('.ajax-loadings').hide(); //hide loading animation once data is received
            $("#resultss").append(data); //append data into #results element          
            console.log('data.length');
     
         }
        
      })

      .fail(function(jqXHR, ajaxOptions, thrownError)
      {
        // alert('No response from server');
      });
   }
   
        $(document).ready(function(){
            activatePopup();
            if($(window).scrollTop() + $(window).height() >= $(document).height()) { //if user scrolled from top to bottom of the page
               page++; //page number increment
               load_more(page); //load content   
           }
        });
        $(window).load(function() {
            activatePopup();
        });
    </script>
@endpush
