@extends('layouts.master')

@section('title', 'Notes')

@section('content')
    <main class="consumption px-md-2 px-sm-2 py-4 " role="main">
        <div class="container-fluid ">
            <h5 class="text-secondary"><b>{{ $video['course']['name'] }} > {{ $video['level']['name'] }} > {{ $video['subject']['name'] }} > {{ $video['chapter']['name'] }}</b></h5>
            <div class="row mt-3">
                <div class="col-md-8">
                    <div class="video-player-container bg-dark shadow-lg" style="min-height:  100px;">
                        <script type='text/javascript' src='{{ $video['player_url'] }}'></script>
                    </div>
                    <h3 class="mt-3">{{ $video['title'] }}</h3>
                    <div class="row">

                        <div class="col-md-10 offset-md-1 offset-sm-0">
                            <div class="tab-content container" id="myTabContent">
                                <div class="tab-pane fade show active" id="my-notes" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="row" id="professor-notes-container">
                                        <div class="col p-0">
                                            <a id="btn-add-note" href="#" class="btn btn-sm btn-primary my-4 rounded-0">Add Note</a>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table mt-3">
                                                <thead class="bg-primary">
                                                <tr>
                                                    <th class="text-light border-0 font-weight-normal" width="80%" scope="col">Notes</th>
                                                    <th class="text-light border-0 font-weight-normal" scope="col">Time</th>
                                                    <th class="text-light border-0 font-weight-normal" scope="col">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody class="professor-note">
                                                @if($professor_notes)
                                                    @foreach($professor_notes as $professor_note)
                                                        <tr id="note-row-{{$professor_note['id']}}">
                                                            <td><b id="note-tile-{{$professor_note['id']}}">{{ $professor_note['name']  }}</b> <p id="note-description-{{$professor_note['id']}}">{{ $professor_note['description'] }}</p></td>
                                                            <td>{{$professor_note['formatted_duration']}}</td>
                                                            <td>
    {{--                                                            <i id="{{$professor_note['id']}}" data-note="{{$professor_note['name']}}"--}}
    {{--                                                               data-description="{{ $professor_note['description'] }}" class="fa fa-edit edit-btn p-1" data-toggle="modal"--}}
    {{--                                                               data-target="#edit-note-modal" >--}}
    {{--                                                            </i>--}}
                                                                 <span><i data-id="{{$professor_note['id']}}" class="fa fa-trash p-1 delete-btn"></i></span>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                <tr>
                                                    <td>No Data Available!</td>
                                                </tr>
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div class="modal fade" id="add-notes" tabindex="-1" role="dialog" aria-labelledby="add-notes" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="">My Note</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <input type="hidden" id="note-time">
                        <div class="form-group">
                            <label for="note-name" class="col-form-label">Title</label>
                            <input type="text" class="form-control" id="note-name">
                        </div>
                        <div class="form-group">
                            <label for="note-description" class="col-form-label">Detailed Note</label>
                            <textarea class="form-control" id="note-description"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-primary" id="note-save">Save</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="edit-note-modal" tabindex="-1" role="dialog" aria-labelledby="add-notes" aria-hidden="true">

        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="">Edit Note</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <input type="hidden" id="edit_note_id">
                        <div class="form-group">
                            <label for="note-name" class="col-form-label">Title</label>
                            <input type="text" class="form-control" id="edit_note_title">
                        </div>
                        <div class="form-group">
                            <label for="note-description" class="col-form-label">Detailed Note</label>
                            <textarea class="form-control"  id="edit_note_description"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-primary note-update" id="note-update">Update</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script')
    <script>
        $(function() {

            var pad = function(number, size) {
                var s = String(number);
                while (s.length < (size || 2)) {s = "0" + s;}
                return s;
            };

            var formatDuration = function (durationInSeconds) {
                var hours = Math.floor(durationInSeconds / 3600);
                durationInSeconds %= 3600;
                var minutes = Math.floor(durationInSeconds / 60);
                var seconds = durationInSeconds % 60;

                var durations = [pad(minutes), pad(seconds)];

                if (hours > 0) durations.unshift(pad(hours));

                return durations.join(':');
            };

            var showAddNoteModal = function () {
                jwplayer().pause();
                var position = jwplayer().getPosition();
                position = parseInt(position, 10);

                $('#note-time').val(position);
                $('#add-notes').modal('show');
            };

            jwplayer().on('ready', function(event){
                console.log('Player ready');
                jwplayer().addButton(
                    '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="18px" height="18px"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M11 18h2v-2h-2v2zm1-16C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm0-14c-2.21 0-4 1.79-4 4h2c0-1.1.9-2 2-2s2 .9 2 2c0 2-3 1.75-3 5h2c0-2.25 3-2.5 3-5 0-2.21-1.79-4-4-4z"/></svg>',
                    'Ask a question',
                    function () {
                        $('#add-question').modal('show');
                    },
                    'jwp-btn-ask-a-question',
                    'jwp-btn-ask-a-question'
                );

                jwplayer().addButton(
                    '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="18px" height="18px"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M13 11h-2v3H8v2h3v3h2v-3h3v-2h-3zm1-9H6c-1.1 0-2 .9-2 2v16c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm4 18H6V4h7v5h5v11z"/></svg>',
                    'Add note',
                    function () {
                        showAddNoteModal();
                    },
                    'jwp-btn-add-note',
                    'jwp-btn-add-note'
                );

                @if (request()->filled('position'))
                    let seekPosition = '{{ request()->input('position') }}';
                    jwplayer().seek(parseInt(seekPosition));
                @endif
            });


            $('#btn-add-note').click(function (e) {
                e.preventDefault();
                showAddNoteModal();
            });


            $('.remove-note').click(function () {
                $.ajax({
                    type:'POST',
                    url:'{{ url('delete-note') }}' + '/' + $(this).data('id'),
                    success:function(id) {
                        $('#note-' + id).remove();
                    }
                });
            });

            //EDIT NOTE
            $(".professor-note").on("click", "i.edit-btn", function(){
                var id = $(this).attr("id");
                var note = $(this).data("note");
                var description = $(this).data("description");
                $('#edit_note_id').val(id);
                $('#edit_note_title').val(note);
                $('#edit_note_description').val(description);

                $(".note-update").click(function () {
                    var id =  $('#edit_note_id').val();
                    var title =  $('#edit_note_title').val();
                    var description =  $('#edit_note_description').val();
                    $.ajax({
                        url: "{{ url('professor/update-professor-note') }}",
                        type: "POST",
                        data: {
                            id: id,
                            title: title,
                            description: description,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(result) {
                            $('.professor-note#note-tile-'+id).html(title);
                            $('.professor-note#note-description-'+id).html(description);
                            $('#edit-note-modal').modal('hide');
                        }
                    });
                });
            });

            //DELETE NOTE

            $(".professor-note").on("click", "i.delete-btn", function(){
                var id = $(this).data("id");
                let confirmation = confirm("Delete this Note?");

                if (confirmation) {
                    $.ajax({
                        url: "{{ url('professor/delete-professor-note') }}",
                        type: "POST",
                        data: {
                            id: id,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(result) {
                          $('#note-row-'+id).fadeOut();
                        }
                    });
                }
            });


            $('#note-save').click(function () {
                let noteName = $('#note-name').val();
                let noteDescription = $('#note-description').val();
                let noteTime = $('#note-time').val();

                $('#add-notes').modal('toggle');

                $.ajax({
                    type:'POST',
                    url:'{{ route('professor.notes.store') }}',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'video_id': '{{ $video['id'] }}',
                        'name': noteName,
                        'description': noteDescription,
                        'time': noteTime
                    },
                    success:function(response) {
                        let date = new Date(response.created_at);
                        let createdAt = date.getDate() + '-' +  ("0" + (date.getMonth() + 1)).slice(-2) + '-' + date.getFullYear();

                        var notePosition = formatDuration(parseInt(response.time || 0));

                        $('.professor-note').append(
                            ` <tr>
                                <td><b>${response.name}</b> <p>${response.description}</p></td>
                                <td>${response.formatted_duration}</td>
                                <td>
                                   <i data-id="${response.id}" id="delete-btn" class="fa fa-trash p-1 delete-btn"></i>
                                </td>
                            </tr>`
                        );

                        // <i id="${response.id}" data-note="${response.name}"
                        //                                data-description="${response.description}" class="fa fa-edit edit-btn p-1" data-toggle="modal"
                        //                                data-target="#edit-note-modal" >
                        //                             </i>
                        $('#note-name').val('');
                        $('#note-description').val('');
                        $('#note-time').val('');
                    }
                });
            });
        });
    </script>
@endpush
