@extends('layouts.master')
@section('content')
    <div class="main">
        <div class="page-wrapper chiller-theme toggled" id="dashboard_sidebar">
            <a id="show-sidebar" class="btn btn-sm">
                <i class="fa fa-chevron-right" aria-hidden="true"></i>
            </a>
        @include('includes.student-menu')
            <main class="page-content">
                <div class="container-fluid" id="main_dashboard">
                    <div class="prof_notes">
                        <div class="notes_title">
                            <div class="notes">My Notes</div>
                        </div>
                        <form id="filter_study_materials" action="" method="GET" >
                            <div class="select_options">
                                <select name="course" id="course" class="col-lg-2 col-md-4 col-sm-12">
                                    <option value="" disabled selected>Course</option>
                                    @foreach ($courses as $course)
                                        <option value="{{ $course['id'] }}" @if (request()->has('course')) @if ($course['id'] == request()->input('course')) selected @endif @endif>{{ $course['name'] }}</option>
                                    @endforeach
                                </select>
                                <select name="language" id="language" class="col-lg-2 col-md-4 col-sm-12">
                                    <option value="" disabled selected>Language</option>
                                    @foreach ($languages as $language)
                                        <option value="{{ $language['id'] }}" @if (request()->has('language')) @if ($language['id'] == request()->input('language')) selected @endif @endif>{{ $language['name'] }}</option>
                                    @endforeach
                                </select>
                                <select name="subject" class="col-lg-2 col-md-4 col-sm-12" id="subject">
                                    <option value="" disabled selected>Subject</option>
                                    @foreach ($subjects as $subject)
                                        <option value="{{ $subject['id'] }}" @if (request()->has('subject')) @if ($subject['id'] == request()->input('subject')) selected @endif @endif>{{ $subject['name'] }}</option>
                                    @endforeach
                                </select>
                                <select name="chapter" id="chapter" class="col-lg-2 col-md-4 col-sm-12">
                                    <option value="" selected>Chapter</option>
                                    @foreach ($chapters as $chapter)
                                        <option value="{{ $chapter['id'] }}" @if (request()->has('chapter')) @if ($chapter['id'] == request()->input('chapter')) selected @endif @endif>{{ $chapter['name'] }}</option>
                                    @endforeach
                                </select>
                                <a href="{{ url('student-notes') }}" class="btn btn-primary">Clear</a>

{{--                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>--}}
{{--                                <a href="{{url('student-notes')}}"><button type="button" class="btn btn-primary">Clear</button></a>--}}
                            </div>
                        </form>
                        <div class="student_notes">
                            <div class="row">
                                @if(count($studentNotes)>0)
                                    @foreach($studentNotes as $subject)
                                        @foreach($subject as $note)
                                            <div class="col-lg-6 col-md-12 co-sm-12">
                                                <div class="student_note_details">
                                                    <h1> {{ $note['name'] }} </h1>
                                                    
                                                    <input type="text" id="notename" class="notename"/>
                                                    <h2> {{ $note['description'] }} </h2>
                                                    <textarea name="" id="notedescrip" class="notedescrip" cols="100%" rows="10"></textarea>
                                                    <div class="row">
                                                        <div class="col-md-6 col-sm-12">
                                                            <div class="student_notes_details_inner">
                                                                <h6>subject</h6>
                                                                <p> {{ $subject['0']['video']['subject']['name'] }} </p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-sm-12">
                                                            <div class="student_notes_details_inner">
                                                                <h6>Chapter</h6>
                                                                <p>{{ $subject['0']['video']['chapter']['name'] }} </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a href="{{ url('videos/' . $note['video_id'] . '?tab=notes&package=' . $note['package_id']) . '&order_item=' . $note['order_item_id'] . '&position=' . $note['time']}}">
                                                        <button><i class="fa fa-play" aria-hidden="true"></i>Play Video</button>
                                                    </a>
                                                    <div class="clear"></div>
                                                    <div class="notes_footer">
                                                        <div class="notes_footer_inner">
                                                            <ul>
                                                                <li>Created at: {{ \Carbon\Carbon::parse($note['created_at'])->format('d-M-Y') }}</li>
                                                                <li><span></span></li>
                                                                <li>{{ \Carbon\Carbon::parse($note['created_at'])->format('H:i') }}</li>
                                                            </ul>
                                                            <div class="footer_icons">
                                                                <img class="edit_notes" src="{{ asset('assets/new_ui_assets/images/dashboard/Edit.svg') }}"  alt="">
                                                                <button class="update-student-note-button btn btn-primary" data-id="n{{ $note['id'] }}">Update</button>
                                                                <img class="delete-student-note" src="{{ asset('assets/new_ui_assets/images/dashboard/delete.svg') }}" alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(function() {
            $('#course').on('change', function (e) {
                $("#filter_study_materials").submit();
            });
            $('#language').on('change', function (e) {
                $("#filter_study_materials").submit();
            });
            $('#subject').on('change', function (e) {
                $("#filter_study_materials").submit();
            });
            $('#chapter').on('change', function (e) {
                $("#filter_study_materials").submit();
            });
            $('#professor').on('change', function (e) {
                $("#filter_study_materials").submit();
            });

            $(".edit_notes").on("click", function() {

                var closestVariables = $(this).closest('.student_note_details');
                var note = closestVariables.find("h1").text();
                var descrip = closestVariables.find("h2").text();
                closestVariables.find("#notename").val(note);
                closestVariables.find("#notedescrip").val(descrip);

                closestVariables.find(".edit_notes").hide();
                closestVariables.find("button").show();
                closestVariables.find("#notename").show();
                closestVariables.find("#notedescrip").show();
                closestVariables.find("#notedescrip").show();
                closestVariables.find("h1").hide();
                closestVariables.find("h2").hide();

            });

            $(".update-student-note-button").click(function (e){
                var responseButton = $(this);
                e.preventDefault();
                var noteId = $(this).attr("data-id"); 
                noteId = noteId.replace('n','');
                //var noteId = $(this).closest('.student_note_details').find(".note-id").val();
                var noteName = $(this).closest('.student_note_details').find(".notename").val();
                var noteDesc = $(this).closest('.student_note_details').find(".notedescrip").val();
                //var videoId = $(this).closest('.student_note_details').find(".video-id").val();
                //var packageId = $(this).closest('.student_note_details').find(".package-id").val();

                $.ajax({
                    url: '{{ url('put-video-note') }}' + '/' + noteId,
                    data: {
                       // video_id: videoId,
                       // package_id: packageId,
                        name: noteName,
                        description: noteDesc,
                    },
                    async: false
                }).done(function(response) {
                    responseButton.hide();
                    var closestVariables = responseButton.closest('.student_note_details');

                    closestVariables.find('h1').text(response.name);
                    closestVariables.find('h2').text(response.description);
                    if(response){
                    toastr.success('Notes Updated Successfully');
                    }
                    else{
                        toastr.error('Something went wrong');  
                    }
                    closestVariables.find('.notename').hide();
                    closestVariables.find('.notedescrip').hide();
                    closestVariables.find('h1').show();
                    closestVariables.find('h2').show();
                    closestVariables.find('.edit_notes').show();
                    closestVariables.find('.delete-student-note').show();
                });
            });

            $(".delete-student-note").click(function (e){
                e.preventDefault();
                let confirmation = confirm('Delete this note?');
                var noteId = $(this).closest('.student_note_details').find(".note-id").val();
                if (confirmation) {
                    $.ajax({
                        url: '{{ url('delete-video-note') }}' + '/' + noteId,
                    }).done(function(response) {
                        if(response){
                        toastr.success('Notes Deleted Successfully');
                    }
                    else{
                        toastr.error('Something went wrong');  
                    }
                        location.reload();
                    });
                }
            })

        });
    </script>
@endpush
