<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/quiz/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/quiz/css/stye.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/quiz/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/quiz/css/responsive.css')}}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <!-- <link rel="stylesheet" href="css/fontawesome.min.css"> -->
    <title>J K SHAH</title>
</head>

<body>

<span id="question_ajax">
    <div class="main">
        <div class="student-quiz">
            <div class="quiz-test">
                <div class="quiz_main_head">
                    <div class="container">
                        <div class="quiz_header">
                            <div class="quiz-title">
                                <img src="images/logo.png" class="logo" alt="">
                                <h2>Branch Accounts</h2>
                            </div>
                            <div class="quiz-timer">
                                <div id="timer"></div>
                                <span></span>
                                <div class="points_earned">
                                    <h4>Points Earned</h4>
                                    <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.12831 1.26671C9.17275 1.21008 9.22948 1.16429 9.29421 1.13281C9.35895 1.10132 9.42999 1.08496 9.50197 1.08496C9.57396 1.08496 9.645 1.10132 9.70974 1.13281C9.77447 1.16429 9.8312 1.21008 9.87564 1.26671L11.3078 3.08754C11.3659 3.1616 11.4447 3.21671 11.5342 3.24589C11.6237 3.27507 11.7199 3.27699 11.8105 3.25141L14.039 2.61966C14.1082 2.59994 14.181 2.5962 14.2518 2.60872C14.3227 2.62124 14.3898 2.6497 14.448 2.69194C14.5063 2.73418 14.5542 2.7891 14.5881 2.85256C14.622 2.91601 14.6411 2.98635 14.6439 3.05825L14.7309 5.37387C14.7346 5.46794 14.7661 5.5588 14.8215 5.63491C14.8769 5.71103 14.9537 5.76897 15.0421 5.80137L17.2168 6.60096C17.2843 6.62572 17.3453 6.6655 17.3952 6.71727C17.4451 6.76905 17.4826 6.83149 17.5048 6.89987C17.5271 6.96825 17.5336 7.04079 17.5237 7.11202C17.5138 7.18325 17.4879 7.25132 17.4479 7.31108L16.1575 9.23562C16.1051 9.31385 16.0771 9.40588 16.0771 9.50004C16.0771 9.5942 16.1051 9.68623 16.1575 9.76446L17.4479 11.689C17.4879 11.7488 17.5138 11.8168 17.5237 11.8881C17.5336 11.9593 17.5271 12.0318 17.5048 12.1002C17.4826 12.1686 17.4451 12.231 17.3952 12.2828C17.3453 12.3346 17.2843 12.3744 17.2168 12.3991L15.0421 13.1987C14.9538 13.2312 14.8772 13.2892 14.822 13.3653C14.7667 13.4414 14.7353 13.5322 14.7317 13.6262L14.6439 15.9418C14.6411 16.0137 14.622 16.0841 14.5881 16.1475C14.5542 16.211 14.5063 16.2659 14.448 16.3081C14.3898 16.3504 14.3227 16.3788 14.2518 16.3914C14.181 16.4039 14.1082 16.4001 14.039 16.3804L11.8105 15.7487C11.7198 15.7228 11.6236 15.7245 11.5339 15.7536C11.4442 15.7826 11.3653 15.8377 11.307 15.9118L9.87643 17.7334C9.83199 17.79 9.77526 17.8358 9.71053 17.8673C9.64579 17.8988 9.57475 17.9151 9.50277 17.9151C9.43078 17.9151 9.35974 17.8988 9.29501 17.8673C9.23027 17.8358 9.17354 17.79 9.1291 17.7334L7.69697 15.9125C7.63885 15.8385 7.56004 15.7834 7.47053 15.7542C7.38102 15.725 7.28487 15.7231 7.19427 15.7487L4.96572 16.3804C4.89652 16.4001 4.82375 16.4039 4.75289 16.3914C4.68204 16.3788 4.61495 16.3504 4.5567 16.3081C4.49845 16.2659 4.45055 16.211 4.41663 16.1475C4.38271 16.0841 4.36365 16.0137 4.36089 15.9418L4.27381 13.6262C4.27015 13.5321 4.23862 13.4413 4.18322 13.3652C4.12783 13.2891 4.05107 13.2311 3.96268 13.1987L1.78797 12.3991C1.72046 12.3744 1.65945 12.3346 1.60955 12.2828C1.55965 12.231 1.52215 12.1686 1.49989 12.1002C1.47763 12.0318 1.47119 11.9593 1.48105 11.8881C1.49091 11.8168 1.51681 11.7488 1.55681 11.689L2.84722 9.76446C2.89964 9.68623 2.92762 9.5942 2.92762 9.50004C2.92762 9.40588 2.89964 9.31385 2.84722 9.23562L1.55681 7.31108C1.51681 7.25132 1.49091 7.18325 1.48105 7.11202C1.47119 7.04079 1.47763 6.96825 1.49989 6.89987C1.52215 6.83149 1.55965 6.76905 1.60955 6.71727C1.65945 6.6655 1.72046 6.62572 1.78797 6.60096L3.96268 5.80137C4.05092 5.76884 4.12751 5.71085 4.18276 5.63474C4.23801 5.55864 4.26942 5.46785 4.27302 5.37387L4.36089 3.05825C4.36365 2.98635 4.38271 2.91601 4.41663 2.85256C4.45055 2.7891 4.49845 2.73418 4.5567 2.69194C4.61495 2.6497 4.68204 2.62124 4.75289 2.60872C4.82375 2.5962 4.89652 2.59994 4.96572 2.61966L7.19427 3.25141C7.28487 3.27699 7.38102 3.27507 7.47053 3.24589C7.56004 3.21671 7.63885 3.1616 7.69697 3.08754L9.12989 1.26671H9.12831Z" fill="#F9A268" stroke="#F9A268" stroke-width="1.5"/>
                                    <path d="M7.125 9.49984L8.70833 11.0832L11.875 7.9165" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>

                                    <h6>0</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="quiz-questions">
                <div class="container">
                    <div class="quest_counter">
                        <h4>Question:</h4>
                        <span>{{ $questions->Attempted + 1 }}/{{$questions->total_q}}</span>
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14.4543 3.4049L14.4618 3.39734L14.4604 3.3959C14.5061 3.34664 14.531 3.28162 14.5299 3.21443C14.5288 3.14724 14.5018 3.08308 14.4545 3.03536L14.0849 2.66582C14.0372 2.61851 13.973 2.59147 13.9058 2.59037C13.8387 2.58926 13.7736 2.61417 13.7244 2.65988L13.7228 2.65826L12.1312 4.25C12.0822 4.29901 12.0547 4.36547 12.0547 4.43477C12.0547 4.50406 12.0822 4.57052 12.1312 4.61954L12.5007 4.98926H12.5009C12.5499 5.03825 12.6164 5.06577 12.6857 5.06577C12.755 5.06577 12.8214 5.03825 12.8705 4.98926L14.4543 3.4049V3.4049Z" fill="white"/>
                            <path d="M8.73792 3.46954V3.46972H9.26046V3.46954C9.40122 3.46954 9.51516 3.35812 9.52074 3.2188H9.52182V0.968263C9.52182 0.823903 9.40482 0.706903 9.26046 0.706903V0.706543H8.73792V0.706723C8.59356 0.706723 8.47656 0.823723 8.47656 0.968083V3.2188H8.47764C8.48025 3.28612 8.5088 3.34982 8.55731 3.39656C8.60583 3.4433 8.67055 3.46945 8.73792 3.46954Z" fill="white"/>
                            <path d="M16.4894 7.19935C16.4894 7.05841 16.378 6.94465 16.2386 6.93907V6.93799H13.9879C13.8436 6.93799 13.7266 7.05481 13.7266 7.19935V7.72189C13.7266 7.86643 13.8436 7.98343 13.9879 7.98343H16.2386V7.98235C16.306 7.9797 16.3697 7.95111 16.4164 7.90256C16.4631 7.85402 16.4893 7.78927 16.4894 7.72189V7.19935Z" fill="white"/>
                            <path d="M8.99927 4.35596C6.88319 4.35596 5.16797 6.07118 5.16797 8.18726C5.1676 8.98451 5.41741 9.76179 5.88221 10.4095H5.88077C6.45209 11.3009 6.80903 12.4817 6.83531 13.7826C6.88121 13.858 6.96329 13.9091 7.05797 13.9091C7.06805 13.9091 7.07759 13.9073 7.08731 13.906V13.9091H10.8983V13.906C10.908 13.9071 10.9175 13.9091 10.9274 13.9091C10.9765 13.909 11.0245 13.895 11.066 13.8688C11.1075 13.8427 11.1407 13.8053 11.162 13.7611C11.1935 12.396 11.5887 11.1639 12.2137 10.2621C12.6014 9.6638 12.8306 8.95352 12.8306 8.18744C12.8306 6.07118 11.1153 4.35596 8.99927 4.35596V4.35596Z" fill="white"/>
                            <path d="M10.9277 16.1616C10.9176 16.1616 10.9083 16.1634 10.8985 16.1647V16.1616H7.08757V16.1647C7.07785 16.1636 7.06831 16.1616 7.05823 16.1616C6.91405 16.1616 6.79688 16.2784 6.79688 16.423V17.0321C6.79688 17.1765 6.91387 17.2935 7.05823 17.2935C7.06831 17.2935 7.07785 17.2917 7.08757 17.2904V17.2935H10.8985V17.2906C10.9083 17.2917 10.9178 17.2935 10.9277 17.2935C11.0721 17.2935 11.1891 17.1765 11.1891 17.0321V16.423C11.1891 16.2784 11.0721 16.1616 10.9277 16.1616V16.1616Z" fill="white"/>
                            <path d="M10.9277 14.4624C10.9176 14.4624 10.9083 14.4642 10.8985 14.4655V14.4624H7.08757V14.4655C7.07785 14.4644 7.06831 14.4624 7.05823 14.4624C6.99055 14.4625 6.92555 14.4889 6.87695 14.536C6.82836 14.5831 6.79997 14.6473 6.79778 14.7149L6.79688 14.7252V15.3329C6.79688 15.4772 6.91387 15.5942 7.05823 15.5942C7.06831 15.5942 7.07785 15.5924 7.08757 15.5912V15.5942H10.8985V15.5914C10.9083 15.5924 10.9178 15.5944 10.9277 15.5944C11.0721 15.5944 11.1891 15.4774 11.1891 15.3331V14.7238C11.1891 14.5792 11.0721 14.4624 10.9277 14.4624V14.4624Z" fill="white"/>
                            <path d="M4.02398 7.14317V7.14209H1.77308C1.62872 7.14209 1.51172 7.25909 1.51172 7.40327V7.92599C1.51172 8.07017 1.62872 8.18717 1.77308 8.18717H4.02398V8.18627C4.09125 8.18362 4.1549 8.15509 4.20162 8.10662C4.24835 8.05815 4.27454 7.99349 4.27472 7.92617V7.40327C4.27454 7.33595 4.24835 7.27129 4.20162 7.22282C4.1549 7.17436 4.09125 7.14582 4.02398 7.14317V7.14317Z" fill="white"/>
                            <path d="M3.63512 3.31472L5.22668 4.90646L5.2283 4.90484C5.33072 4.99898 5.4893 4.99826 5.58866 4.8989H5.58884L5.95838 4.52918C6.00573 4.48148 6.03279 4.41731 6.0339 4.35011C6.03501 4.2829 6.01007 4.21788 5.96432 4.16864L5.96594 4.16702L4.3742 2.57546C4.32517 2.52651 4.25871 2.49902 4.18943 2.49902C4.12015 2.49902 4.0537 2.52651 4.00466 2.57546L3.63512 2.945C3.58612 2.99404 3.55859 3.06053 3.55859 3.12986C3.55859 3.19919 3.58612 3.26568 3.63512 3.31472V3.31472Z" fill="white"/>
                            </svg>
                            
                    </div>
                    <div class="question_container">
                        <div class="question-box">
                            <h2>{{$questions->question}}</h2>
                        
                        </div>
                    </div>
                    <input id="attQ" type="hidden" value="{{$questions->Attempted + 1}}"/>
                        <input id="remQ" type="hidden" value="{{$questions->total_q}}"/>
                        <input id="q_time" type="hidden" value="{{$questions->q_time}}"/>
                    <div class="quiz-answer quiz-answer-{{ $questions->question_id }}">
                        <div class="row">
                            @php
                            $i=65;
                            @endphp
                        @foreach($questions->option as $optn)
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="ans ans1" id="{{$optn->option_id}}" data="li-option-{{$optn->option_id}}" option-data = "{{ $optn->option_id }}" >
                                    <input id="{{$optn->option_id}}" type="hidden" value="{{$optn->option_id}}"/>
                                    <span class="li-option">{{chr($i).'.'}}</span>
                                    <p>{{$optn->answers}}</p>
                                </div>
                            </div>
                           @php $i++;
                           @endphp

                            @endforeach
                        </div>
                    </div>
                    <div class="pagination">
                        <div class="next-box">
                            <button id="next" class="next">next</button>
                            <i class="fa fa-pause" aria-hidden="true"></i>
                        </div>
                        <button class="end">end quiz</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</span>
<form action="{{ route('quiz.submit-question') }}" method="POST" class="question-submit">
    @csrf
    <input type="hidden" name="option_id" id="option_id">
    <input type="hidden" name="q_id" id="q_id" value="{{ $questions->question_id }}">
    <input type="hidden" name="uq_id" id="uq_id" value="{{ $questions->user_question_id }}">
    <input type="hidden" name="test_id" id="test_id" value="{{ $questions->test_id }}">
    <input type="hidden" name="user_test_id" id="user_test_id" value="{{ $questions->user_test_id }}">
    <input type="hidden" name="rtime" id="rtime">
    <input type="hidden" name="etime" id="etime">
    <input type="hidden" name="mil" id="mil"  >
</form>
<form action="{{ route('quiz.skip-question')}}" method="POST" class="question-skip">
  
    <input type="hidden" name="q_id" id="q_id"  value="{{ $questions->question_id }}">
    <input type="hidden" name="user_test_id" id="user_test_id" value="{{ $questions->user_test_id }}">
    <input type="hidden" name="uq_id" id="uq_id"  value="{{ $questions->user_question_id }}">
    <input type="hidden" name="test_id" id="test_id"  value="{{ $questions->test_id }}">
  
    
</form>
    <script src="{{ asset('assets/quiz/js/jquery.min.js')}}"></script>
    <script src="{{ asset('assets/quiz/js/bootstrap.bundle.js')}}"></script>
    <script src="{{ asset('assets/quiz/js/owl.carousel.2.3.4.min.js')}}"></script>
    <script src="{{ asset('assets/quiz/js/custom.js')}}"></script>
    <script src="{{ asset('assets/quiz/js/counter.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
   /*$(document).ready(function(){
    $(".ans").click(function(){        
        id=$(this).attr('id');        
       $("#option_id").val(id);
    });
});*/


if (parseInt($("#question_ajax_answer_count").val()) < 2) {
            $(document.body).on('click', '.ans-'+qID, function (){
               
            });
        }else{ 
var option_correct = 0;
            var option_selected = '';
            var li_click = 0;
        
                $('#question_ajax').on("click", ".ans1", function(){
                li_click = li_click + 1;
                 if (li_click > 1) {
                  return false;
                 }
                var d=new Date();

            
                 var q_status = false;
                 var qu_status = false;
                // if(option_selected == ''){
                     option_selected = $(this).attr('option-data');
                //  }else{
                //     option_selected = option_selected+','+$(this).attr('option-data');
                //  }
                 $('#'+$(this).attr('option-data')).addClass('li-answer');
                 $('#option_id').val(option_selected);
                 qid=$('#q_id').val();
                 $(".quiz-answer-"+qid).children().prop("disabled",true);
                 $('#mil').val(d.getMilliseconds());
                 $.ajax({
                  url:"{{ route('quiz.check-answer') }}",
                  method:"POST",
                  data:{_token:'{{ csrf_token() }}',q_id:$('#q_id').val(),option_id:$(this).attr('option-data')},
                  success:function(data){
                      ans_id=$(this).attr('option-data');
                    if (data) {
                       
                    //     $(".skip").css("z-index", "-1");
                    //     $(".cont-rate").css("z-index", "-1");
                    //     $('#right_div').show();
                        $(".li-answer").css("background-color", "#4ea53e");
                        
                    } else {
                       
                    //     $(".skip").css("z-index", "-1");
                    //     $(".cont-rate").css("z-index", "-1");
                    //     $('#wrong_div').show();
                    $(".li-answer").css("background-color", "#ff0000");
                     }
                  }
                });
                $('.ans').removeClass('ans1');
                        submitQuestion();
                   
            });
        }
            function submitQuestion()
            {
              
                li_click = 0;
                idd=$('.question-submit #user_test_id').val();
                var fd = JSON.parse(JSON.stringify($('.question-submit').serializeArray()));
        $.ajax({
            url: "{{ route('quiz.submit-question') }}",
            // dataType:'json',
            data: {_token:'{{ csrf_token() }}',
                option_id:$('.question-submit #option_id').val(),
                q_id:$('.question-submit #q_id').val(),
                uq_id:$('.question-submit #uq_id').val(),
                test_id:$('.question-submit #test_id').val(),
                rtime:$('.question-submit #rtime').val(),
                etime:$('.question-submit #etime').val(),
                mil:$('.question-submit #mil').val(),
                user_test_id:$('.question-submit #user_test_id').val(),
                },
            type: 'POST',
            success: function (data) {
                if (data == false) {
                    var url = '{{ route("quiz.test-points", ":id") }}';
                    url = url.replace(':id', idd);
                    window.location = url;
                } else {
                    $('#question_ajax').html(data);
                    clearInterval(timerInterval);
                    timeCountdown();
                }
                

            }
        });


            }
            function timeCountdown(){
                const full_array = 283;
const WARNING_AT = 10;
const ALERT_AT = 5;

const COLOR_CODES = {
  info: {
    color: "green"
  },
  warning: {
    color: "orange",
    threshold: WARNING_AT
  },
  alert: {
    color: "red",
    threshold: ALERT_AT
  }
};

                const TIME_LIMIT = $('#q_time').val();

let timePassed = 0;
let timeLeft = TIME_LIMIT;
let timerInterval = null;
                timerInterval = setInterval(() => {
    timePassed = timePassed += 1;
    timeLeft = TIME_LIMIT - timePassed;
    $('#rtime').val(timeLeft);
    $('#etime').val(timePassed);
    document.getElementById("base-timer-label").innerHTML = formatTime(
      timeLeft
    );
    setCircleDasharray();
    setRemainingPathColor(timeLeft);
//alert(timeLeft);
    if (timeLeft === 0) {
        clearInterval(timerInterval);
      skipQuestion('skip');
    }
    
  }, 1000);
  document.getElementById("timer").innerHTML = `
<div class="timing">
  <svg class="timing_svg" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
    <g class="timing_circle">
      <circle class="timing_path-elapsed" cx="50" cy="50" r="45"></circle>
      <path
        id="base-timer-path-remaining"
        stroke-dasharray="283"
        class="timing_path-remaining ${remainingPathColor}"
        d="
          M 50, 50
          m -45, 0
          a 45,45 0 1,0 90,0
          a 45,45 0 1,0 -90,0
        "
      ></path>
    </g>
  </svg>
  <p id="base-timer-label" class="timing_label">${formatTime(
    timeLeft
  )}</p>
</div>
`;
       
            }
            $('#question_ajax').on('click','.next',function(){
           var status='skip';
            skipQuestion(status);
        });
        $('#question_ajax').on("click", ".end", function(){
            //$('#end_quize').val('yes');
                var attQ= $('#attQ').val();
                var totQ= $('#remQ').val();
                if(attQ<totQ){
                    if(confirm("Are you sure you want to end this?")){
                alert("you have questions remaining");
                skipQuestion('end');
                    }
                    else{
                        return false;
                    }
                }
                else
                skipQuestion('end');
        });
        function skipQuestion(status){
            
            var idd=$('.question-submit #user_test_id').val();
            $.ajax({
            url: "{{ route('quiz.skip-question')}}",
            data:  {_token:'{{ csrf_token() }}',
                q_id:$('.question-submit #q_id').val(),
              
                uq_id:$('.question-submit #uq_id').val(),
                test_id:$('.question-submit #test_id').val(),
                user_test_id:$('.question-submit #user_test_id').val(),
                status:status,
              
                },
            type: 'POST',
             success: function (data) {
                if (data == false) {
                    var url = '{{ route("quiz.test-points", ":id") }}';
                    url = url.replace(':id', idd);
                    window.location = url;
                    
                } else {
                    
                    $('#question_ajax').html(data);
                    clearInterval(timerInterval);
                    timeCountdown();
                   
                    
                }
              
            }
        });


}

function formatTime(time) {
  const minutes = Math.floor(time / 60);
  let seconds = time % 60;

  if (seconds < 10) {
    seconds = `0${seconds}`;
  }

  return `${minutes}:${seconds}`;
}

function setRemainingPathColor(timeLeft) {
  const { alert, warning, info } = COLOR_CODES;
  if (timeLeft <= alert.threshold) {
    document
      .getElementById("base-timer-path-remaining")
      .classList.remove(warning.color);
    document
      .getElementById("base-timer-path-remaining")
      .classList.add(alert.color);
  } else if (timeLeft <= warning.threshold) {
    document
      .getElementById("base-timer-path-remaining")
      .classList.remove(info.color);
    document
      .getElementById("base-timer-path-remaining")
      .classList.add(warning.color);
  }
}

function calculateTimeFraction() {
  const rawTimeFraction = timeLeft / TIME_LIMIT;
  return rawTimeFraction - (1 / TIME_LIMIT) * (1 - rawTimeFraction);
}

function setCircleDasharray() {
  const circleDasharray = `${(
    calculateTimeFraction() * full_array
  ).toFixed(0)} 283`;
  document
    .getElementById("base-timer-path-remaining")
    .setAttribute("stroke-dasharray", circleDasharray);
}
       
    </script>
    <script type="text/javascript">
        function preventBack() { window.history.forward(); }
        setTimeout("preventBack()", 0);
        // window.onunload = function () { null };
    </script>
</body>

</html>