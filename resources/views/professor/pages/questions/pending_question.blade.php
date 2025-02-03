@extends('layouts.master')

@section('title', 'Professor - Ask A Question')
@section('css')
<link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">
<style>
  .dataTables_wrapper .dataTables_filter input [type="search"]{
    border-radius: 5px !important;
    border: 1px solid #ccc !important;
} 

</style>
@stop

@section('content')
    <main class="professor-profile" role="main" style="max-width: 1700px;margin:0 auto;">
        <div class="container-fluid py-4 px-5">
            <h3 class="text-secondary"><b>{{ $professor['name'] }}</b></h3>
            <div class="row mt-3" id="flex_div">
                <div class="col-lg-3 col-md-4 col-sm-12 mb-5 professor-profile-menu">
                    <div class="professor-profile-menu-content border shadow bg-white">
                        <div class="professor-profile-menu-image-container">
                            <img src="{{ $professor['image'] ?? url('assets/images/avatar.png') }}" alt="..." class="img-thumbnail">
                        </div>
                        <div class="text-center p-2"><a href="#" id="upload"><i class="fa fa-camera p-2 text-muted"></i></a></div>
                        <form id="form-update-image" method="POST" action="{{ route('professor.profile.store') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="file" id="image" name="image" style="display: none;" onchange="this.form.submit();"/>
                        </form>
                        <ul class="list-group text-secondary pb-4">
                            <li class="list-group-item"><a href="{{ route('professor.dashboard.index') }}">Dashboard</a></li>
                            <li class="list-group-item"><a href="{{ route('professor.profile.index') }}">Profile</a></li>
                            <li class='sub-menu list-group-item'><a href='#settings'>Ask A Question <div class='pl-2 fa fa-caret-down right'></div></a>
                            
                            <ul class="list-group text-secondary">
                                <li  class="list-group-item"><a href="{{ route('professor.questions.index') . '?questions=1&answers=1' }}">Pending Question</a></li>
                                <li  class="list-group-item"><a href="{{ url('professor/answerd_question')}}">Answerd Question</a></li>
                            </ul>
                            </li>
                          
                            <li class="list-group-item"><a href="{{ route('professor.notes.index') }}">Notes</a></li>
                            <li class="list-group-item"><a href="{{ route('professor.reports.index') }}">Reports</a></li>
                            <li class="list-group-item"><a href="{{ route('professor.revenues.index') }}">Revenue</a></li>
                            <li class="list-group-item"><a href="{{ route('professor.packages.index') }}">Packages</a></li>
                            <li class="list-group-item"><a href="#" data-toggle="modal" data-target="#modal-change-password">Change Password</a></li>
                            <form id="logout" method="POST" action="{{ url('/logout') }}">
                                @csrf
                                <li class="list-group-item"><a href="#" onclick="document.getElementById('logout').submit();">Logout</a></li>
                            </form>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8 col-sm-12">

               
                    <div class="border shadow mt-4 mt-md-0">
                        <div class="p-4">
                            <h5>Pending Questions</h5>
                            <div class="table-responsive">
                            <table class="table table-striped"  id="example">
                                    <thead class="bg-primary-50 p-2">
                                    <tr class="">
                                        <th class="border-0 font-weight-normal" scope="col">Video</th>
                                        <th class="border-0 font-weight-normal" scope="col">Course</th>
                                        <th class="border-0 font-weight-normal" scope="col">Level</th>
                                        <th class="border-0 font-weight-normal" scope="col">Subject</th>
                                        <th class="border-0 font-weight-normal" scope="col">Chapter</th>
                                        <th class="border-0 font-weight-normal" scope="col">Package </th>
                                        <th class="border-0 font-weight-normal" scope="col">Student</th>
                                        <th class="border-0 font-weight-normal" scope="col">Question</th>
                                        <th class="border-0 font-weight-normal" scope="col">Asked on</th>
                                        <th class="border-0 font-weight-normal" scope="col"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @if(@$questions)
                                        @foreach(@$questions as $question)
                                        @if(@$question_id==$question["id"])
                                        <tr style="background-color: #a1cdab;">
                                            @else
                                            <tr>

                                            @endif
                                        <td> 
                                        @if(!empty(@$question['time']))
                                        <a class="popup-iframe " href="{{ route('get_question_video',['id'=> @$question['video']['id'], 'time'=>@$question['time']]) }}">  
                                        @endif
                                        <img src="https://cdn.jwplayer.com/v2/media/{{@$question['video']['media_id']}}/poster.jpg?width=320"
                                                width="120" class="p-2"><br>{{ @$question['video']['title'] }}
                                                @if(!empty(@$question['time']))
                                            </a>
                                            @endif
                                        </td>
                                        <td><?=  @$question['package']['course']['name'] ?></td>
                                        <td><?=  @$question['package']['level']['name'] ?></td>
                                        <td><?=  @$question['package']['subject']['name'] ?></td>
                                        <td><?=  @$question['package']['chapter']['name'] ?></td>
                                        <td><?=  @$question['package']['name'] ?></td>
                                        <td><span title="{{@$question['user']['id']}}"><?=  @$question['user']['name'] ?></span></td>
                                        <?php $q = nl2br(strip_tags(@$question['question'])); ?>
                                        <td><?=  substr(@$q , 0, 100); ?>
                                        @if(strlen($q)>'100')
                                        <a href="javascript:void(0)" onclick='view(<?=@$question["id"]?>)' class="signup"> Read more</a>
                                        @endif
                                    </td>
                                    <td><?= date("d-m-Y ",strtotime( @$question['created_at']) )?></td>
                                        <td> <a href="javascript:void(0)" onclick="answer(<?=@$question["id"]?>)" class="signup">Answer</a>
                                        
                                    </td>
</tr>


                                        @endforeach
                                        @endif
                                   
                                    </tbody>
                                </table>

                               
                            </div>
                        </div>
                    </div>
                </div>



            
            </div>
        </div>
        @include('professor.pages.includes.change-password')
    </main>
    <div style="position: fixed; top: 20px; right: 20px; z-index: 9999;">
        <div id="created" class="toast d-none" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000">
            <div class="toast-body">
                Answer successfully added
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-signupp" tabindex="-1" role="dialog" aria-modal="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content ">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <div class="row p-0">

                <form id="form-answer" method="POST" action="{{ route('professor.answers.store') }}" style="width:100%;">
                                                            @csrf
                                                            <input type="hidden" name="question_id" id="question_id" value="">
                                                            <div class="form-group">
                                                                <label for="answer">Answer:</label>
                                                                <textarea onkeypress="return isAlfa(event)" style="    height: 299px;" class="form-control" id="answer" name="answer" rows="3"></textarea>
                                                                <p id="charNum"></p>
                                                            </div>
                                                             <button type="submit" class="btn btn-sm btn-primary float-right" id="btn-answer">Save</button>
                                                        </form>
</div>
</div>
</div>
</div>
</div>

<div class="modal fade" id="modal-question" tabindex="-1" role="dialog" aria-modal="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content ">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <div class="row p-0">

               <p id="qstn"></p>
</div>
</div>
</div>
</div>
</div>
@endsection

@push('script')

	<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
	<script>
        function isWhiteSpace(char) {
  return (/\s/).test(char);
}
function willCreateWhitespaceSequence(evt) {
  var willCreateWSS = false;
  if (isWhiteSpace(evt.key)) {
  
    var elmInput = evt.currentTarget;
    var content = elmInput.value;

    var posStart = elmInput.selectionStart;
    var posEnd = elmInput.selectionEnd;

    willCreateWSS = (
         isWhiteSpace(content[posStart - 1] || '')
      || isWhiteSpace(content[posEnd] || '')
    );
  }
  return willCreateWSS;
}

function isAlfa(evt) {
    if (event.target.value.substr(-1) === ' ' && event.code === 'Space') {
    return false;
  }
}
	$(document).ready(function () {
    $('#example').DataTable({
        "aaSorting": []
    });
    $('.sub-menu ul').hide();
$(".sub-menu a").click(function () {
	$(this).parent(".sub-menu").children("ul").slideToggle("100");
	$(this).find(".right").toggleClass("fa-caret-up fa-caret-down");
});
    
   
});
function answer(id){
    $("#question_id").val(id);
    $("#answer").val('');
    document.getElementById("charNum").innerHTML='';
    $("#modal-signupp").modal('show');
}
function view(id){
 
    $.ajax({
                    url: '{{ url('professor/get_question_details') }}',
                    method:'post',
                    data: {
                       
                        question:id
                    },
                    async: false
                }).done(function(response) {
                    $("#modal-question").modal('show');
                    $("#qstn").html(response);
                });
    //$("#modal-signupp").modal('show');
}
</script>
<script>
        $(function () {
            if ($('.popup-iframe').length) {
                $('.popup-iframe').magnificPopup({
                    disableOn: 700,
                    type: 'iframe',
                    mainClass: 'mfp-fade',
                    removalDelay: 160,
                    preloader: false,
                    fixedContentPos: false
                });
            }
        });
    </script>
<script>
        $(function() {
            $('#answer').keyup(function(){
            var word = $(this).val().trim();
            var counts = word.split(' ');
            var maxLength = counts.length;
            var remaining = 500 - maxLength;
            //remaining = Math.max(0, remaining);
            if(word == '' && maxLength == 1){
                document.getElementById("charNum").innerHTML = '<span style="color: red;font-size: 80%;float: right;">500 words remaining</span>';
            }
            else if(remaining > 0 ){
                document.getElementById("charNum").innerHTML = '<span style="color: red;font-size: 80%;float: right;">'+remaining+' words remaining</span>';
            }else{
                document.getElementById("charNum").innerHTML = '<span style="color: red;font-size: 80%;float: right;">'+maxLength+' words </span>';
    
            }
            });

            // $('#btn-answer').on('click',function(){
            // $("#btn-answer").html("Saving  <i class='fa fa-spinner fa-spin'>");
            // });
            $("#btn-answer").click(function (e) {
            e.preventDefault();
            let isValid = $('#form-answer').valid();
            if (isValid)
            { 
                $("#btn-answer").html("Saving <i class='fa fa-spinner fa-spin'>");
                $('#form-answer').submit();
            }
            });

            jQuery.validator.addMethod("validate_question", function(value, element) {
            var reg =/<(.|\n)*?>/g;
            if (reg.test(value)) {
                return false;
            } else {
                return true;
            }
            }, "HTML tags are not allowed");

            jQuery.validator.addMethod("validate_answer", function(value, element) {
            var text=value.trim();
            var words = text.split(' ');
            if (words.length > 500) {
                return false;
            }else if(value.trim()<1){
                return false;
            } else {
                return true;
            }
            }, "Maximum 500 words are allowed");

            $('#form-answer').validate({
                rules: {
                    answer: {
                        required: true,
                        validate_question:true,
                        validate_answer:true,
                    }
                }
            });

            $('.toggle-btn').click(function() {
                $(this).find('i').toggleClass('fas fa-plus fas fa-minus');
            });

            $("#upload").click(function(){
                $("#image").click();
            });

            $('.toggle-btn').click(function() {
                $(this).find('i').toggleClass('fas fa-plus fas fa-minus');
            });

            @if (session()->has('success'))
                $('#created').toast('show');
                $('#created').removeClass('d-none');
            @endif

            @if (request()->has('answered'))
                $('#pills-answered-tab').trigger('click');
            @endif

            $('#form-change-password').validate({
                rules: {
                    password: {
                        required: true,
                        maxlength: 191,
                        minlength: 5
                    },
                    confirm_password: {
                        required: true,
                        equalTo: "#password"
                    }
                }
            });


            @if (session()->has('message'))
            alert('Password successfully changed');
            @endif
        });
    </script>
@endpush
