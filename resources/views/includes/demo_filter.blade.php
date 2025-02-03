
<style>
    .proffesor-scroll{
        overflow-y: auto;
        min-height: 1px;
        max-height: 200px;


    }</style>
    <div class="filter-container pt-0 pb-5 pl-5">
    <div id="accordion" class="accordion">
        <div class="card mb-0">
            <input type="hidden" name="filter_type" value="{{ $tab }}">
            <div class="card-header collapsed" data-toggle="collapse" href="#collapseOne">
                <a class="card-title">
                    Levels
                </a>
            </div>
            <div id="collapseOne" class="card-body collapse" data-parent="#accordion">
                @foreach($levels as $level)
                    <div class="course-name level-name d-flex align-items-center justify-content-start">
                        <input type="hidden" class="level_id" value="{{ $level['id'] }}">
                        <input type="checkbox" class="levels" id="level-{{$level['id']}}" name="level_ids[]" value="{{ $level['id'] }}" @if(in_array( $level['id'],$levelIds)) checked @endif>
                        <label for="level-{{$level['id']}}">{{ $level['name'] }}</label>
                    </div>
                @endforeach
            </div>
            <hr>
{{--            <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">--}}
{{--                <a class="card-title">--}}
{{--                    Course Language--}}
{{--                </a>--}}
{{--            </div>--}}
{{--            <div id="collapseTwo" class="card-body collapse" data-parent="#accordion">--}}
{{--                @foreach($languages as $language)--}}
{{--                    <div class="language-name d-flex align-items-center justify-content-start">--}}
{{--                        <input type="hidden" class="languages_ids" value="{{ $language['id'] }}">--}}
{{--                        <input type="checkbox" id="eleven-{{$language['id']}}" class="languages-checkbox" name="language_ids[]" value="{{ $language['id'] }}">--}}
{{--                        <label for="eleven-{{$language['id']}}">{{ $language['name'] }}</label>--}}
{{--                    </div>--}}
{{--                @endforeach--}}
{{--            </div>--}}
            <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFive">
                <a class="card-title">
                    Professor
                </a>
            </div>
            <div id="collapseFive" class=" card-body collapse proffesor-scroll" data-parent="#accordion">
                @foreach($professors as $professor)
                    <div class="language-name d-flex align-items-center justify-content-start">
                        <input type="checkbox" class="professors" id="professor_ids_{{$professor['id']}}" name="professor_ids[]" value="{{ $professor['id'] }}" @if(in_array( $professor['id'],$professorIds)) checked @endif>
                        <label for="professor_ids_{{$professor['id']}}"> {{ $professor['name'] }}</label>
                    </div>
                @endforeach
            </div>
            <hr>
        </div>
    </div>
</div>
