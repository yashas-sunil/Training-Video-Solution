@extends('layouts.master')
@section('content')
<style>
    .popup_modal_container{
        width: 100%;
        height: 100%;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 9;
        display: none;
        justify-content: center;
        align-items: center;
    }
    .popup_modal_container.active{
        display: flex;
    }
    .popup_modal_overlay{
        position: absolute;
        width: 100%;
        height: 100%;
        background-color: #000;
        opacity: 0.3;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
    }
    .popup_modal_body_conatiner{
        width: 500px;
        padding: 20px;
        box-sizing: border-box;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0px 0px 10px 1px #0000006e;
        position: relative;
    }
    .discription_cont p{
        margin-top: 0px;
    }
    .btn_cont{
        text-align: center;
    }
    .common_btn{
        font-family: 'GT Walsheim Pro';
        font-style: normal;
        font-weight: 500;
        font-size: 16px;
        line-height: 18px;
        color: #fff;
        border: 1px solid #6C757D;
        background-color: #6C757D;
        border-radius: 3px;
        padding: 5px 20px;
        box-sizing: border-box;
        cursor: pointer;
    }
    .common_btn:first-child{
        margin-right: 10px;
    }
    .common_btn:last-child{
        margin-left: 10px;
    }
</style>
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
.filter{
    margin-top: 15px;
}
@keyframes blinker {  
  50% { opacity: 0; }
}
.sidebar-content{
    background-color: #f8fbfb;
}
.page-wrapper {
    height: auto !important;
    position: relative;
    display: flex; 
}
</style>
    <div class="main">
    <div id="facebookPixelNoScriptAddToCartContainer" style="display: none;"></div>


        <div class="course-lists">
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
                                @include('includes.course_filter')
                                <input type="hidden" name="course_id"  value="{{$course_id}}" id="course_id">  
<input type="hidden" name="price" id="price" @if(request()->input('price')) value="{{ request()->input('price') }}" @endif>
<input type="hidden" name="offer" id="offer" @if(request()->input('offer')) value="{{ request()->input('offer') }}" @endif>
{{--                            <input type="hidden" name="language_ids[]" id="language_ids">--}}
{{--                            <input type="hidden" name="subject_ids[]" id="subject_ids">--}}
                        </form>
                        <div class="apply_filter">
                            <button class="apply">Apply</button>
                            <a href="{{ url('packages') }}" class="btn reset" >Reset</a>
                        </div>
                </div>
                </nav>
                

                <main class="page-content pt-0 mt-2">
                    <div class="container-fluid demo-list">
                        <div class="sticky-top" id="background">
                        <div class="course_stick mt-2">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-white mb-0">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">@if( request()->query('offer')=='new') New Releases @elseif(request()->query('offer')=='special') J-Deals @else Courses @endif</li>
                        </ol>
                    </nav>
                    <div class="head d-flex align-items-center justify-content-between">
                                <div class="results d-flex px-3">
                                    <p class="m-0">Showing</p>
                                    <span class="pl-3 font-weight-bold">{{ $totalNumberOfPackages }} results</span>
                                </div>
                                <form>
                                    <div class="sorting d-flex align-items-baseline justify-content-between ">
                                        <label for="abc">Sort By:</label>
                                        <select id="sort-by" name="price_value">
                                            <option class="sel-opt" disabled="disabled" selected="selected">Select option
                                            </option>
                                            <option class="sel-opt" value="default" <?php if(request()->input('price')=='default') echo "selected" ?>>Default Sorting</option>
                                            <option class="sel-opt" value="high" <?php if(request()->input('price')=='high') echo "selected" ?>>Price High</option>
                                            <option class="sel-opt" value="low" <?php if(request()->input('price')=='low') echo "selected" ?>>Price Low</option>
                                            <option class="sel-opt" value="oldest" <?php if(request()->input('price')=='oldest') echo "selected" ?>>Oldest First</option>
                                            <option class="sel-opt" value="newest" <?php if(request()->input('price')=='newest') echo "selected" ?>>Newest First</option>
                                            <option class="sel-opt" value="popular" <?php if(request()->input('price')=='popular') echo "selected" ?>>Popularity High</option>
                                            <option class="sel-opt" value="low_popular" <?php if(request()->input('price')=='low_popular') echo "selected" ?>>Popularity Low</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                            </div>
                            @if(!empty($levelIds) || !empty($languageIds) || !empty($subjectIds) || !empty($chapterIds) || !empty($professorIds))
                            <div class="filter">
    <ul class="appliedFilter mb-0">

        @foreach($levels as $level)
        @if(in_array( $level['id'],$levelIds))
                 
                        <!-- <input type="hidden" class="level_id" value="{{ $level['id'] }}"> -->
                        <li id="level_{{$level['id']}}">{{ $level['name'] }}<span class="filterCross" id="levels_{{$level['id']}}"></span></li>
              
                    @endif
                @endforeach
            

                @foreach($languages as $language)
        @if(in_array( $language['id'],$languageIds))
                   
                        <!-- <input type="hidden" class="level_id" value="{{ $level['id'] }}"> -->
                        <li id="language_{{$level['id']}}">{{ $language['name'] }}<span class="filterCross" id="languages_{{$language['id']}}"></span></li>
                   
                    @endif
                @endforeach

                @foreach($subjects as $subject)
        @if(in_array( $subject['id'],$subjectIds))
                    
                        <!-- <input type="hidden" class="level_id" value="{{ $level['id'] }}"> -->
                        <li id="subject_{{$subject['id']}}">{{ $subject['name'] }}<span class="filterCross" id="subjects_{{$subject['id']}}"></span></li>
                  
                    @endif
                @endforeach
                @if(!empty($chapter))
                @foreach(@$chapter as $chapter)
        @if(in_array( $chapter['id'],$chapterIds))
                 
                        <!-- <input type="hidden" class="level_id" value="{{ $level['id'] }}"> -->
                        <li id="chapter_{{$chapter['id']}}">{{ $chapter['name'] }}<span class="filterCross" id="chapters_{{$chapter['id']}}"></span></li>
                    
                    @endif
                @endforeach
                @endif

                @if(!empty($professors))
                @foreach(@$professors as $professor)
        @if(in_array( $professor['id'],$professorIds))
                  
                        <!-- <input type="hidden" class="level_id" value="{{ $level['id'] }}"> -->
                        <li id="professor_{{$professor['id']}}">{{ $professor['name'] }}<span class="filterCross" id="professors_{{$professor['id']}}"></span></li>
                        
                        @endif
                @endforeach
                @endif

                @if(!empty(@$package_types))
                @foreach(@$package_types as $package_type)
                @if(in_array( $package_type['id'],$packagetypes))
                <li id="type_{{$package_type['id']}}">{{ $package_type['name'] }}<span class="filterCross" id="type_{{$package_type['id']}}"></span></li>                 
                    @endif
                @endforeach
                @endif
                <li id="ratings_4" style="@if(in_array(4, $ratings)) display:inline-block;@else display:none; @endif" >4<i class="fa fa-star" aria-hidden="true"></i> & above<span class="filterCross" id="rating_4"></span></li>
                <li id="ratings_4" style="@if(in_array(3, $ratings)) display:inline-block;@else display:none; @endif" >3<i class="fa fa-star" aria-hidden="true"></i> & above<span class="filterCross" id="rating_3"></span></li>
                <li id="ratings_4" style="@if(in_array(2, $ratings)) display:inline-block;@else display:none; @endif" >2<i class="fa fa-star" aria-hidden="true"></i> & above<span class="filterCross" id="rating_2"></span></li>
                <li id="ratings_4" style="@if(in_array(1, $ratings)) display:inline-block;@else display:none; @endif" >1<i class="fa fa-star" aria-hidden="true"></i> & above<span class="filterCross" id="rating_1"></span></li>
               <li style="background: #fff;"><div class="applys" style="background: #fff;"></div></li>
</ul>
</div>
@endif
                <input type="hidden" name="price_id"  value="{{$price_id}}" id="price_id">  
                <input type="hidden" name="search_inputs"  value="{{$search}}" id="search_inputs">  
                            </div>
                        <div class="all-courses">
                           
                           
               
               
<div class="ajax-loading">Loading..</div>
<div  id="results">

                           

</div>
<div class="no-more-data"></div>
<div class="scroll-limit"></div>
                            
{{--                        <nav aria-label="Page navigation example">--}}
{{--                            <ul class="pagination pagination-circle pg-blue">--}}
{{--                                <li class="page-item disabled"><a class="page-link">First</a></li>--}}
{{--                                <li class="page-item disabled">--}}
{{--                                    <a class="page-link" aria-label="Previous">--}}
{{--                                        <span aria-hidden="true">&laquo;</span>--}}
{{--                                        <span class="sr-only">Previous</span>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li class="page-item active"><a class="page-link">1</a></li>--}}
{{--                                <li class="page-item"><a class="page-link">2</a></li>--}}
{{--                                <li class="page-item"><a class="page-link">3</a></li>--}}
{{--                                <li class="page-item"><a class="page-link">4</a></li>--}}
{{--                                <li class="page-item"><a class="page-link">5</a></li>--}}
{{--                                <li class="page-item">--}}
{{--                                    <a class="page-link" aria-label="Next">--}}
{{--                                        <span aria-hidden="true">&raquo;</span>--}}
{{--                                        <span class="sr-only">Next</span>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li class="page-item"><a class="page-link">Last</a></li>--}}
{{--                            </ul>--}}
{{--                        </nav>--}}
                    </div>
                </main>
            </div>
        </div>
    </div>

<!-- <div class="modal fade" id="btn-start-free-trial-modal" tabindex="-1" role="dialog" aria-modal="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{url('/start-free-trial')}}">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="package_id" id="modal-trial-package-id">
                    Please Confirm start the Free Trial
                    <p>
                        Remaining Days {{$freemiumDaysMax}} and Hours  and Percentage
                        
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Send</button>
                </div>
            </form>
        </div>
    </div>
</div> -->
<div class="popup_modal_container">
    <div class="popup_modal_overlay"></div>
    <div class="popup_modal_body_conatiner">
        <div class="discription_cont">
            <p>Course will be assigned to you for {{$freemiumDaysMax}} days or {{$freemiumHoursMax}} hours or <span id="freemiumPercentage"></span> percentage of total course content, whichever is earlier. Please purchase the course to continue further</p>
        </div>
        <div class="btn_cont">
            <form method="POST" action="{{url('/start-free-trial')}}">
            @csrf
                <input type="hidden" name="package_id" id="modal-trial-package-id">
                <button type="submit" class="common_btn">Start Free Trial</button>
                <button class="common_btn" onclick="closePopup()">Discard</button>
            </form>
        </div>
    </div>
</div>
    
@endsection
@push('script')
    <script>
        $('#sidebar').parents().css("overflow", "visible");
        $(function () {
            $('.filterCross').click(function (e) {
                e.preventDefault();
                var id=$(this).attr('id');
                level_id=id.split('_');
                LevelId=level_id[1];
                filterArea=level_id[0];
         
               if(filterArea=='levels'){ 
                checksubject(LevelId);
                $('#level-'+LevelId).prop('checked', false);
                $("#level_"+LevelId).hide();
              }else if(filterArea =='type'){
                
                $('#type-'+LevelId).prop('checked', false);
                $("#type"+LevelId).hide();
              }else if(filterArea=='languages'){ 
                
                $('#eleven-'+LevelId).prop('checked', false);
                $("#language_"+LevelId).hide();
           }else if(filterArea=='subjects'){ 
                checkchapter(LevelId);
                $('#fourteen-'+LevelId).prop('checked', false);
                $("#subject_"+LevelId).hide();
           }else if(filterArea=='chapters'){ 
                
                $('#chapter_id-'+LevelId).prop('checked', false);
                $("#chapter_"+LevelId).hide();
           }else if (filterArea == 'professors') {

                $('#professor-' + LevelId).prop('checked', false);
                $("#professor_" + LevelId).hide();
                }else if (filterArea == 'rating') {
                    if(LevelId==4){ 
  
                        $('#four_star_above').prop('checked', false);
                        $("#ratings_" + LevelId).hide();
                    }else if(LevelId==3){
                        $('#three_star_above').prop('checked', false);
                        $("#ratings_" + LevelId).hide();
                    }else if(LevelId==2){
                        $('#two_star_above').prop('checked', false);
                        $("#ratings_" + LevelId).hide();
                    }else if(LevelId==1){
                        $('#one_star_above').prop('checked', false);
                        $("#ratings_" + LevelId).hide();
                    }
                }
             
                $("#filter-form").submit();
                $('.applys').html('<i class="fa fa-spinner fa-pulse fa-1x fa-fw"></i>');
            });
           // $('.btn-add-to-cart').click(function (e) {
            $(document).on('click', '.btn-add-to-cart', function (e) {
                
                e.preventDefault();

                var url = '{{ url('cart') }}';
                var packageId = $(this).data('id');

                $.post(url, {
                    package_id: packageId
                }).done(function (data) {

                    if (!data.data) {
                        $('#toast-already-exist').toast('show');                        
                    } else {


                        $.ajax({
                            url: '{{ route('returnScript') }}',
                            type: 'GET',
                            data: { parameter: "AddToCart"},
                            success: function(response) {
                                var script_execute = $(response).filter('script').html();
                                if (script_execute) {
                                    eval(script_execute);
                                }
                            },
                            error: function(xhr, status, error) {
                                console.log("Script not executed");
                            }
                        });

                        var container = document.getElementById("facebookPixelNoScriptAddToCartContainer");
                        var noscriptTag = document.createElement("noscript");
                        noscriptTag.setAttribute("id", "facebookPixelNoScriptAddToCart");

                        var imgElement = document.createElement("img");
                        imgElement.setAttribute("height", "1");
                        imgElement.setAttribute("width", "1");
                        imgElement.setAttribute("style", "display:none");
                        imgElement.setAttribute("src", "https://www.facebook.com/tr?id=772927708313682&ev=AddToCart&noscript=1");
                        noscriptTag.appendChild(imgElement);
                        container.appendChild(noscriptTag);

                        $('#toast-added-to-cart').toast('show');
                        $('#cart_'+packageId).attr('disabled',true);
                        $('#cart_'+packageId).html('Added to cart');
                        $('#cart_'+packageId).css('background-color', '#999a9a');
                    }

                    $('body').trigger('change.cart');
                }).fail(function () {
                    alert("Error while adding to cart");
                });
            });

            $(document).on('click', '.btn-start-free-trial', function (e) {
                e.preventDefault();
                var packageId = $(this).data('id');
                var freemiumPercentage = $(this).data('percentage')
                $('#modal-trial-package-id').val(packageId);
                $('#freemiumPercentage').html(freemiumPercentage);
                $(".popup_modal_container").addClass("active");
            });

            function closePopup (){
                $(".popup_modal_container").removeClass("active");
            }

            $('.buy-now-login').click(function (e) {
                e.preventDefault();
                var packageID = $(this).attr('data-package');
                $(this).removeClass('is-active');
                $("#package-id").val(packageID);
                $("#login-modal").show();
            });

            $('#sort-by').on('change', function (e) {
                var priceValue = $(this).val();
                $("#price").val(priceValue);
                $("#filter-form").submit();
            });

            var levelIds = @json($levelIds) ?? [];
            var level_Ids = [];

            var typeIds = @json($packagetypes) ?? [];
            var type_Ids = [];
            if(typeIds.length>0){
                $.each(typeIds, function( index, element ){
                    var item = parseInt(element);
                    type_Ids.push(item)
                });
            }

            var subjectsArray = @json($subjects) ?? [];

            var courseIds;
            courseIds = {{$course_id}};
            getLevels(courseIds);


            if(levelIds.length>0){
               
                $("#no_course_selected").addClass('d-none');
                $(".apply_filter").css('display', 'block');
                $.each(levelIds, function( index, element ){
                    var item = parseInt(element);
                    level_Ids.push(item)
                });
                getSubjects(level_Ids,type_Ids);
                getTypes(level_Ids);
            }

            var languageIds = [];
            var languageId;



            var subject_ids = @json($subjectIds) ?? [];
            var subjectIds = [];
            var subjectId;
            if(subject_ids.length>0){
                $.each(subject_ids, function( index, element ){
                    var item = parseInt(element);
                    subjectIds.push(item)
                });
                $("#no_professor_selected").addClass('d-none');
                $("#no_chapter_selected").addClass('d-none');

                getChapters(subjectIds);
                getProfessorsbySubject(subjectIds);
            }


            var chapter_ids = @json($chapterIds) ?? [];
            var chapterIds = [];
            var chapterId;
            if(chapter_ids.length>0){
                $.each(chapter_ids, function( index, element ){
                    var item = parseInt(element);
                    chapterIds.push(item)
                });

                $("#no_professor_selected").addClass('d-none');
                getProfessors(chapterIds);
            }

            var professor_ids = @json($professorIds) ?? [];
            var professorIds = [];
            if(professor_ids.length>0){
                $.each(professor_ids, function( index, element ){
                    var item = parseInt(element);
                    professorIds.push(item)
                });
            }
            $(".courses").change(function() {
                $(".courses").prop('checked', false);
                $(this).prop('checked', true);
                courseIds = $(this).val();
                $("#course_id").val(courseIds);
                getLevels(courseIds);
                levelIds = [];
                getTypes(levelIds);
                getSubjects(levelIds);
                subjectIds = [];
                getChapters(subjectIds);
                chapterIds = [];
                getProfessors(chapterIds);
                
            });
            $('#type-container').on('change', '.type-checkbox', function() {
               
                if(this.checked) {
                typeId = $(this).closest('.type-name').find('.types').val();
                typeIds.push(typeId);
                       
                getSubjects(levelIds,typeId);
                }else{
                    typeId = $(this).closest('.type-name').find('.types').val();
                    typeIds = jQuery.grep(typeIds, function(value) {
                        return value != typeId;
                    });
                    getSubjects(levelIds,typeIds);

                }
              

            });

            function getLevels(courseIds){
                
               if(courseIds == 0){
                   levelIds = [];
                   getSubjects(levelIds);
                   subjectIds = [];
                   getChapters(subjectIds);
                   chapterIds = [];
                   getProfessors(chapterIds);
                   $(".apply_filter").css('display', 'none');
                   $("#no_courses_selected").removeClass('d-none');
                   $("#subject-container").addClass('d-none');
                   $("#subject-container").empty();
                   $("#no_subjects_available").addClass('d-none');
               }
               else {
                
                   let url = '{{ url('get-levels-by-course') }}';

                   $.ajax({
                       url: url,
                       type: "GET",
                       dataType: 'json',
                       data: {
                           "_token": "{{ csrf_token() }}",
                           "course_ids" : courseIds ,
                       }
                   }).done(function (response) {
                       if(response.length>0){
                           $("#no_levels_available").addClass('d-none');
                           $("#no_subjects_available").addClass('d-none');
                           $("#level-container").removeClass('d-none');
                           $(".apply_filter").css('display', 'block');
                         //  $("#no_courses_selected").removeClass('d-none');
                           $("#level-container").empty();
                           $.each(response, function( index, value ) {
                               
                               var item = value.id
                               let exist = level_Ids.includes(item);
                             
                               

                               $(".level-container").append('<div class="level-name language-name d-flex align-items-center justify-content-start">'+
                                   '<input type="hidden" class="level_id" value="'+ value.id +'">'+
                                   '<input type="checkbox" class="level-ids level-checkbox" id="level-'+value.id+'" name="level_ids[]" value="'+value.id+'" ' + ( exist ? 'checked':'') + ' >'+
                                   '<label for="level-'+value.id+'">'+value.name+'</label>'+
                                   '</div>');

                           });
                          
                       }
                       else{
                           // if(subjectsArray.length==0){
                               $("#level-container").empty();
                               $("#no_levels_available").removeClass('d-none');
                              // $("#no_type_available").removeClass('d-none');
                               $("#no_course_selected").addClass('d-none');
                               $(".apply_filter").css('display', 'block');
                               $("#type-container").empty();
                           // }
                       }

                   });
               }
           }



           $('#level-container').on('change', '.level-checkbox', function() {
                if(this.checked) {
                        levelId = $(this).closest('.level-name').find('.level-ids').val();
                        if(levelIds.length =='0'){ 
                            levelIds=[];
                      
                        }

                        levelIds.push(levelId);
                        $("#no_chapter_selected").addClass('d-none');
                        $("#no_professor_selected").addClass('d-none');
                        $("#no_course_selected").addClass('d-none');
                        getSubjects(levelIds);
                        getTypes(levelIds);
                        
                    }
                else {
                    levelId = $(this).closest('.level-name').find('.level-ids').val();
                    levelIds = jQuery.grep(levelIds, function(value) {
                        return value != levelId;
                    });
                    getSubjects(levelIds);
                    getTypes(levelIds);
                    
                }
            });
            function getTypes(levelIds)
            {
                
                if(levelIds.length == 0){
                  
                   //$(".apply_filter").css('display', 'none');
                    $("#type-container").addClass('d-none');
                    $("#type-container").empty();
                   $("#no_level_selected").removeClass('d-none');
                   $("#no_type_available").addClass('d-none');
                }else{
                    $("#type-container").empty();
                     
                    $("#no_level_selected").addClass('d-none');
                    $("#no_type_available").removeClass('d-none');
                    let url = '{{ url('get-types-by-level') }}';

                    $.ajax({
                        url: url,
                        type: "GET",
                        dataType: 'json',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "level_ids" : levelIds ,
                            
                        }
                    }).done(function (response) {
                       
                        
                        if(response.length>0){
                            $("#type-container").empty();
                            $("#no_type_available").addClass('d-none');
                            $("#type-container").removeClass('d-none');
                            $("#no_level_selected").addClass('d-none');
                            $(".apply_filter").css('display', 'block');
                            $.each(response, function( index, value ) {
                              
                                var item = value.id
                                let exist = type_Ids.includes(item);
                               

                                $(".type-container").append('<div class="type-name d-flex align-items-center justify-content-start">' +
                                '<input type="checkbox" id="type-'+value.id+'" name="p_type_ids[]" value="'+value.id+'" class="types type-checkbox" ' + ( exist ? 'checked':'') + ' >' +
                                    '<label for="type-'+value.id+'">'+ value.name  + '</label>'+
                                    '</div>');
                            });
                            
                        }
                        else{
                            // if(subjectsArray.length==0){
                                $("#type-container").empty();
                                $("#no_level_selected").addClass('d-none');
                                $("#no_type_available").removeClass('d-none');
                                
                            // }
                        }

                    });
                    

                }
            }

            function getSubjects(levelIds,typeIds)
            {
                
               
                if(levelIds.length == 0){
                    subjectIds = [];
                    getChapters(subjectIds);
                    chapterIds = [];
                    getProfessors(chapterIds);
                   //$(".apply_filter").css('display', 'none');
                    $("#no_levelt_selected").removeClass('d-none');
                    $("#subject-container").addClass('d-none');
                    $("#subject-container").empty();
                    $("#no_subjects_available").addClass('d-none');
                }
                else {
                    let url = '{{ url('get-subjects-by-level') }}';

                    $.ajax({
                        url: url,
                        type: "GET",
                        dataType: 'json',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "level_ids" : levelIds ,
                            "type_id"  : typeIds   ,
                        }
                    }).done(function (response) {
                        if(response.length>0){
                            $("#no_subjects_available").addClass('d-none');
                            $("#no_levelt_selected").addClass('d-none');
                            $("#subject-container").removeClass('d-none');
                            $("#subject-container").empty();
                            $(".apply_filter").css('display', 'block');
                            $.each(response, function( index, value ) {
                                var item = value.id
                                let exist = subjectIds.includes(item);
                                if(jQuery.isEmptyObject(value.package_type)!=true){

                                $(".subject-container").append('<div class="subject-name d-flex align-items-center justify-content-start">' +
                                '<input type="checkbox" id="fourteen-'+value.id+'" name="subject_ids[]" value="'+value.id+'" class="subject-ids subject-checkbox" ' + ( exist ? 'checked':'') + ' >' +
                                    '<label for="fourteen-'+value.id+'">'+ value.name + '(' + value.level.name + '-'+value.package_type.name+')' + '</label>'+
                                    '</div>');
                                }else{
                                    $(".subject-container").append('<div class="subject-name d-flex align-items-center justify-content-start">' +
                                '<input type="checkbox" id="fourteen-'+value.id+'" name="subject_ids[]" value="'+value.id+'" class="subject-ids subject-checkbox" ' + ( exist ? 'checked':'') + ' >' +
                                    '<label for="fourteen-'+value.id+'">'+ value.name + '(' + value.level.name + ')' + '</label>'+
                                    '</div>');
                                }
                            });
                            // $("#no_subjects_available").addClass('d-none');
                        }
                        else{
                            // if(subjectsArray.length==0){
                                $("#subject-container").empty();
                                $("#no_levelt_selected").addClass('d-none');
                                $("#no_subjects_available").removeClass('d-none');
                            // }
                        }

                    });
                }
            }

            $('#subject-container').on('change', '.subject-checkbox', function() {
                if(this.checked) {
                        subjectId = $(this).closest('.subject-name').find('.subject-ids').val();
                        subjectIds.push(subjectId);
                        $("#no_chapter_selected").addClass('d-none');
                        $("#no_professor_selected").addClass('d-none');
                        getChapters(subjectIds);
                        getProfessorsbySubject(subjectIds);
                    }
                else {
                    subjectId = $(this).closest('.subject-name').find('.subject-ids').val();
                    subjectIds = jQuery.grep(subjectIds, function(value) {
                        return value != subjectId;
                    });
                    getChapters(subjectIds);
                    getProfessorsbySubject(subjectIds);
                }
            });
            function  checkchapter(subjectIds){
                var matches = [];
                $(".subject-ids:checked").each(function() {
                
                    matches.push(this.value);
                });
                matches = $.grep(matches, function(value) {
                return value != subjectIds;
                });
                getChapters(matches)
            }

             function  checksubject(subjectIds){
                                var matches = [];
                $(".levels:checked").each(function() {
                
                    matches.push(this.value);
                });
                matches = $.grep(matches, function(value) {
                return value != subjectIds;
                });
                getSubjects(matches)
            }


            function getChapters(subjectIds)
            {
                if(subjectIds.length == 0){
                    $("#no_chapter_selected").removeClass('d-none');
                    $("#chapter-container").addClass('d-none');
                    $("#chapter-container").empty();
                }
                else {
                    let url = '{{ url('get-chapter-by-subject') }}';

                    $.ajax({
                        url: url,
                        type: "GET",
                        dataType: 'json',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "subject_ids" : subjectIds ,
                        }
                    }).done(function (response) {
                        if(response.length>0){
                            $("#chapter-container").removeClass('d-none');
                            $("#chapter-container").empty();
                            $.each(response, function( index, value ) {
                                var item = value.id
                                let exist = chapterIds.includes(item);
                                $(".chapter-container").append('<div class="subject-name chapter-name d-flex align-items-center justify-content-start">' +
                                '<input type="checkbox" id="chapter_id-'+value.id+'" name="chapter_ids[]" value="'+value.id+'" class="chapter-ids chapter-checkbox" ' + ( exist ? 'checked':'') + ' >' +
                                    '<label for="chapter_id-'+value.id+'">'+value.name+'</label>' +
                                    '</div>');
                            });
                        }
                        else{
                            $("#no_chapter_available").removeClass('d-none');
                        }

                    });
                }
            }

            $('#chapter-container').on('change', '.chapter-checkbox', function() {
                if(this.checked) {
                    chapterId = $(this).closest('.chapter-name').find('.chapter-ids').val();
                    chapterIds.push(chapterId);
                    $("#no_professor_selected").addClass('d-none');
                    getProfessors(chapterIds);
                }
                else {
                    chapterId = $(this).closest('.chapter-name').find('.chapter-ids').val();
                    chapterIds = jQuery.grep(chapterIds, function(value) {
                        return value != chapterId;
                    });
                    if(chapterIds.length == 0){
                        getProfessorsbySubject(subjectIds);
                    }else{
                        getProfessors(chapterIds);
                    }

                }
            });

                function getProfessors(chapterIds)
            {
                if(chapterIds.length == 0){
                    // $("#no_professor_selected").removeClass('d-none');
                    // $("#professor-container").addClass('d-none');
                     //$("#professor-container").show();
                }
                else {
                    let url = '{{ url('get-professor-by-chapter') }}';

                    $.ajax({
                        url: url,
                        type: "GET",
                        dataType: 'json',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "chapter_ids" :  chapterIds,
                        }
                    }).done(function (response) {
                        $("#professor-container").removeClass('d-none');
                        $("#professor-container").empty();
                        $.each(response, function( index, value ) {
                            var item = value.id
                            let exist = professorIds.includes(item);
                            $(".professor-container").append('<div class="professor-name d-flex align-items-center justify-content-start">' +
                                '<input type="checkbox" id="professor-'+value.id+'" name="professor_ids[]" value="'+value.id+'" class="professor-ids" ' + ( exist ? 'checked':'') + ' >' +
                                '<label for="professor-'+value.id+'">'+value.name+'</label>' +
                                '</div>');
                        });
                    });
                }
            }

            function getProfessorsbySubject(subjectIds){

                if(subjectIds.length == 0){
                   // $("#no_professor_selected").removeClass('d-none');
                    $("#professor-container").addClass('d-none');
                   // $("#professor-container").empty();
                }
                else {
                    let url = '{{ url('get-professor-by-subject') }}';

                    $.ajax({
                        url: url,
                        type: "GET",
                        dataType: 'json',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "subject_ids" :  subjectIds,
                        }
                    }).done(function (response) {
                        $("#professor-container").removeClass('d-none');
                        $("#professor-container").empty();
                        $.each(response, function( index, value ) {
                            var item = value.id
                            let exist = professorIds.includes(item);
                            $(".professor-container").append('<div class="professor-name d-flex align-items-center justify-content-start">' +
                                '<input type="checkbox" id="professor-'+value.id+'" name="professor_ids[]" value="'+value.id+'" class="professor-ids" ' + ( exist ? 'checked':'') + ' >' +
                                '<label for="professor-'+value.id+'">'+value.name+'</label>' +
                                '</div>');
                        });
                    });
                }
            }

            $(".languages-checkbox").change(function (){
                if(this.checked) {
                    $(".apply_filter").css('display', 'block');
                }
            });

            $(".package-rating").change(function (){
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


        $(document).on("click",'.cart-save-for-later' ,function () {

                let packageID = $(this).attr('data-id');
                if( $(this).hasClass("is-active")){
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
                                $('#package_'+packageID).removeClass("is-active");
                            }
                        }
                    });
                   
                }
                else {
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
                                $('#package_'+packageID).addClass("is-active");
                            }
                        }
                    });
                }
            });
            $(".apply_filter").css('display', 'block');
        });
    </script>
    

    
<script>
        
        var SITEURL = "{{ route('packages.loader') }}";
        var page = 1;//track user scroll as page number, right now page number is 1
        load_more(0); //initial content load
        //load_more(1);

     
flagscroll=true;
       $(window).on('scroll', function() {
           if ($(window).scrollTop() >= $('.scroll-limit').offset().top + $('.scroll-limit').outerHeight() - window.innerHeight) {
                page++; //page number increment
                load_more(page); //load content  
            }
        });

   function load_more(page){
      
       var price = $("#price").val();
       var search_v = $('#search_inputs').val();
       var levels = @json($levelIds); 
       var professor_ids  = @json($professorIds);
       var language_ids = @json($languageIds);; 
       var subject_ids =   @json($subjectIds);
       var ratings = @json($ratings); 
       var course_id=$("#course_id").val();
       var price_id=$("#price_id").val();
       var offer=$("#offer").val();
       var chapter_ids = @json($chapterIds);
       var packagetypes = @json($packagetypes);
       var course = $('.courses:checked').val(); 

       flagscroll=false;
      
       $.ajax({
          url: SITEURL,
          type: "get",
          async:false,
          datatype: "html",
          data: { page:page,course:course_id,price:price_id,level_ids:levels,language_ids:language_ids,subject_ids:subject_ids,chapter_ids:chapter_ids,professor_ids:professor_ids,ratings:ratings,p_type_ids:packagetypes,search:search_v,offer:offer},
          beforeSend: function()
          {
           //   $('.ajax-loading').show();
           }
       })
       .done(function(data)
       {
           if(data.length == 0){
         
           //notify user if nothing to load
          // $('.no-more-data').html("No more records!");
           $('.ajax-loading').hide();

           flagscroll=true;
           return;
         }
        
            $('.ajax-loading').hide(); //hide loading animation once data is received
            $("#results").append(data); //append data into #results element          
           
        
        
      })

      .fail(function(jqXHR, ajaxOptions, thrownError)
      {
        // alert('No response from server');
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
