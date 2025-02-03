<style>
    .proffesor-scroll{
        overflow-y: auto;
        min-height: 1px;
        max-height: 200px;


    }</style>
<div class="filter-container pt-0 pb-5 pl-5">
    <div id="accordion" class="accordion">
        <div class="card mb-0">
        <div class="card-header collapsed" data-toggle="collapse" href="#collapse_One">
                <a class="card-title">
                    Courses
                </a>
            </div>
            <div id="collapse_One" class="card-body collapse" data-parent="#accordion">
                @foreach($courses as $courses)
                    <div class="course-name  d-flex align-items-center justify-content-start">
                        <input type="hidden" class="course_id" value="{{ $courses['id'] }}">
                        <input type="checkbox" class="courses" id="courses-{{$courses['id']}}" name="courses_ids" value="{{ $courses['id'] }}" @if($courses['id']==$course_id) checked @endif>
                        <label for="courses-{{$courses['id']}}">{{ $courses['name'] }}</label>
                    </div>
                @endforeach
            </div>
            <hr>
            <div class="card-header collapsed" data-toggle="collapse" href="#collapseOne">
                <a class="card-title">
                    Levels
                </a>
            </div>
            <div id="collapseOne" class="card-body collapse" data-parent="#accordion">
              
                <div id="no_courses_selected" class="d-none">
                    <p>No Course selected</p>
                </div>
                <div id="no_levels_available" class="d-none">
                    <p>No Levels available</p>
                </div>
                <div id="level-container" class="level-container d-none">

                </div>
            </div>
            <hr>
            <div class="card-header collapsed" data-toggle="collapse" href="#collapse">
                <a class="card-title">
                    Types
                </a>
            </div>
            <div id="collapse" class="card-body collapse" data-parent="#accordion">
            <div id="no_level_selected" >
                    <p>No Level selected</p>
                </div>
                <div id="no_type_available" class="d-none">
                    <p>Not Applicable</p>
                </div>
            <div id="type-container" class="type-container d-none " style="font-weight: 500;font-size: 13px">
               
</div>
            </div>
            
            <hr>
           
            <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                <a class="card-title">
                    Subjects
                </a>
            </div>
            <div id="collapseThree" class=" card-body collapse" data-parent="#accordion">
                <div id="no_levelt_selected" >
                    <p>No Level selected</p>
                </div>
                <div id="no_subjects_available" class="d-none">
                    <p>No Subjects available</p>
                </div>
                <div id="subject-container" class="subject-container d-none">
{{--                    @foreach($subjects as $subject)--}}
{{--                        <div class="subject-name d-flex align-items-center justify-content-start">--}}
{{--                            <input type="hidden" class="subject_ids" value="{{ $subject['name'] }}">--}}
{{--                            <input type="checkbox" id="fourteen-{{$subject['id']}}" class="subject-ids subject-checkbox" @if(in_array( $subject['id'], $subjectIds)) checked @endif name="subject_ids[]" value="{{ $subject['id'] }}">--}}
{{--                            <label for="fourteen-{{$subject['id']}}">{{ $subject['name'] }}</label>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
                </div>
            </div>
            <hr>
            <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                <a class="card-title">
                    Chapters
                </a>
            </div>
            <div id="collapseFour" class=" card-body collapse" data-parent="#accordion">
                <div id="no_chapter_selected">
                    <p>No subject selected</p>
                </div>
                <div id="no_chapter_available" class="d-none">
                    <p>No Chapters available</p>
                </div>
                <div id="chapter-container" class="chapter-container d-none">

                </div>
            </div>
            <hr>
            <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                <a class="card-title">
                    Language
                </a>
            </div>
            <div id="collapseTwo" class="card-body collapse" data-parent="#accordion">
                @foreach($languages as $language)
                    <div class="language-name d-flex align-items-center justify-content-start">
                        <input type="hidden" class="languages_ids" value="{{ $language['id'] }}">
                        <input type="checkbox" id="eleven-{{$language['id']}}" class="languages-checkbox" @if(in_array( $language['id'], $languageIds)) checked @endif name="language_ids[]" value="{{ $language['id'] }}">
                        <label for="eleven-{{$language['id']}}">{{ $language['name'] }}</label>
                    </div>
                @endforeach
            </div>
            <hr>
            <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFive">
                <a class="card-title">
                    Professor
                </a>
            </div>
            <div id="collapseFive" class=" card-body collapse proffesor-scroll" data-parent="#accordion">
                <div id="no_professor_selected" class="d-none">
                    <p>Please select atleast one subject</p>
                </div>
                <div id="no_professor_available" class="d-none">
                    <p>No Professors available</p>
                </div>

                <div id="professor-container" class="professor-container" style="font-weight: 500;font-size: 13px">
              @foreach($professors as $professor)
                        <div class="professor-name d-flex align-items-center justify-content-start">
                           <input type="checkbox" id="professor-{{$professor['id']}}" class="professor-ids"
                                   @if(in_array( $professor['id'], $professorIds)) checked @endif name="professor_ids[]" value="{{ $professor['id'] }}">
                            <label for="professor-{{$professor['id']}}">{{ $professor['name'] }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
            <hr>
            <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseSix">
                <a class="card-title">
                    Ratings
                </a>
            </div>
            <div id="collapseSix" class=" card-body collapse" data-parent="#accordion">
                <div class="language-name d-flex align-items-center justify-content-start">
                    <input type="checkbox" id="four_star_above" class="package-rating" name="ratings[]" @if(in_array(4, $ratings)) checked @endif value="4">
                    <label for="four_star_above"> 4<i class="fa fa-star" aria-hidden="true"></i> & Above</label>
                </div>
                <div class="language-name d-flex align-items-center justify-content-start">
                    <input type="checkbox" id="three_star_above" class="package-rating" name="ratings[]" @if(in_array(3, $ratings)) checked @endif value="3">
                    <label for="three_star_above"> 3<i class="fa fa-star" aria-hidden="true"></i> & Above</label>
                </div>
                <div class="language-name d-flex align-items-center justify-content-start">
                    <input type="checkbox" id="two_star_above" class="package-rating" name="ratings[]" @if(in_array(2, $ratings)) checked @endif value="2">
                    <label for="two_star_above"> 2<i class="fa fa-star" aria-hidden="true"></i> & Above</label>
                </div>
                <div class="language-name d-flex align-items-center justify-content-start">
                    <input type="checkbox" id="one_star_above" class="package-rating" name="ratings[]" @if(in_array(1, $ratings)) checked @endif value="1">
                    <label for="one_star_above"> 1<i class="fa fa-star" aria-hidden="true"></i> & Above</label>
                </div>
            </div>
            <hr>
        </div>
    </div>
</div>
