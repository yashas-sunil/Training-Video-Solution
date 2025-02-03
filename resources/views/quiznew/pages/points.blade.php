<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/quiz/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/quiz/css/stye.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/quiz/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/quiz/css/responsive.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <!-- <link rel="stylesheet" href="css/fontawesome.min.css"> -->
    <title>J K SHAH</title>
</head>

<body>


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
                                <div id=""></div>
                                <span></span>
                                <div class="points_earned">
                                    <h4>Points Earned</h4>
                                    <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.12831 1.26671C9.17275 1.21008 9.22948 1.16429 9.29421 1.13281C9.35895 1.10132 9.42999 1.08496 9.50197 1.08496C9.57396 1.08496 9.645 1.10132 9.70974 1.13281C9.77447 1.16429 9.8312 1.21008 9.87564 1.26671L11.3078 3.08754C11.3659 3.1616 11.4447 3.21671 11.5342 3.24589C11.6237 3.27507 11.7199 3.27699 11.8105 3.25141L14.039 2.61966C14.1082 2.59994 14.181 2.5962 14.2518 2.60872C14.3227 2.62124 14.3898 2.6497 14.448 2.69194C14.5063 2.73418 14.5542 2.7891 14.5881 2.85256C14.622 2.91601 14.6411 2.98635 14.6439 3.05825L14.7309 5.37387C14.7346 5.46794 14.7661 5.5588 14.8215 5.63491C14.8769 5.71103 14.9537 5.76897 15.0421 5.80137L17.2168 6.60096C17.2843 6.62572 17.3453 6.6655 17.3952 6.71727C17.4451 6.76905 17.4826 6.83149 17.5048 6.89987C17.5271 6.96825 17.5336 7.04079 17.5237 7.11202C17.5138 7.18325 17.4879 7.25132 17.4479 7.31108L16.1575 9.23562C16.1051 9.31385 16.0771 9.40588 16.0771 9.50004C16.0771 9.5942 16.1051 9.68623 16.1575 9.76446L17.4479 11.689C17.4879 11.7488 17.5138 11.8168 17.5237 11.8881C17.5336 11.9593 17.5271 12.0318 17.5048 12.1002C17.4826 12.1686 17.4451 12.231 17.3952 12.2828C17.3453 12.3346 17.2843 12.3744 17.2168 12.3991L15.0421 13.1987C14.9538 13.2312 14.8772 13.2892 14.822 13.3653C14.7667 13.4414 14.7353 13.5322 14.7317 13.6262L14.6439 15.9418C14.6411 16.0137 14.622 16.0841 14.5881 16.1475C14.5542 16.211 14.5063 16.2659 14.448 16.3081C14.3898 16.3504 14.3227 16.3788 14.2518 16.3914C14.181 16.4039 14.1082 16.4001 14.039 16.3804L11.8105 15.7487C11.7198 15.7228 11.6236 15.7245 11.5339 15.7536C11.4442 15.7826 11.3653 15.8377 11.307 15.9118L9.87643 17.7334C9.83199 17.79 9.77526 17.8358 9.71053 17.8673C9.64579 17.8988 9.57475 17.9151 9.50277 17.9151C9.43078 17.9151 9.35974 17.8988 9.29501 17.8673C9.23027 17.8358 9.17354 17.79 9.1291 17.7334L7.69697 15.9125C7.63885 15.8385 7.56004 15.7834 7.47053 15.7542C7.38102 15.725 7.28487 15.7231 7.19427 15.7487L4.96572 16.3804C4.89652 16.4001 4.82375 16.4039 4.75289 16.3914C4.68204 16.3788 4.61495 16.3504 4.5567 16.3081C4.49845 16.2659 4.45055 16.211 4.41663 16.1475C4.38271 16.0841 4.36365 16.0137 4.36089 15.9418L4.27381 13.6262C4.27015 13.5321 4.23862 13.4413 4.18322 13.3652C4.12783 13.2891 4.05107 13.2311 3.96268 13.1987L1.78797 12.3991C1.72046 12.3744 1.65945 12.3346 1.60955 12.2828C1.55965 12.231 1.52215 12.1686 1.49989 12.1002C1.47763 12.0318 1.47119 11.9593 1.48105 11.8881C1.49091 11.8168 1.51681 11.7488 1.55681 11.689L2.84722 9.76446C2.89964 9.68623 2.92762 9.5942 2.92762 9.50004C2.92762 9.40588 2.89964 9.31385 2.84722 9.23562L1.55681 7.31108C1.51681 7.25132 1.49091 7.18325 1.48105 7.11202C1.47119 7.04079 1.47763 6.96825 1.49989 6.89987C1.52215 6.83149 1.55965 6.76905 1.60955 6.71727C1.65945 6.6655 1.72046 6.62572 1.78797 6.60096L3.96268 5.80137C4.05092 5.76884 4.12751 5.71085 4.18276 5.63474C4.23801 5.55864 4.26942 5.46785 4.27302 5.37387L4.36089 3.05825C4.36365 2.98635 4.38271 2.91601 4.41663 2.85256C4.45055 2.7891 4.49845 2.73418 4.5567 2.69194C4.61495 2.6497 4.68204 2.62124 4.75289 2.60872C4.82375 2.5962 4.89652 2.59994 4.96572 2.61966L7.19427 3.25141C7.28487 3.27699 7.38102 3.27507 7.47053 3.24589C7.56004 3.21671 7.63885 3.1616 7.69697 3.08754L9.12989 1.26671H9.12831Z" fill="#F9A268" stroke="#F9A268" stroke-width="1.5"/>
                                    <path d="M7.125 9.49984L8.70833 11.0832L11.875 7.9165" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>

                                    <h6>{{$userpoints}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="quiz-questions">
                <div class="container">
                    <div class="total_points">
                       <h3>Total Points Earned</h3>
                       <div class="points">
                        <svg viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M26.8963 3.73342C27.0272 3.56652 27.1945 3.43157 27.3852 3.33877C27.576 3.24598 27.7854 3.19775 27.9976 3.19775C28.2098 3.19775 28.4191 3.24598 28.6099 3.33877C28.8007 3.43157 28.9679 3.56652 29.0989 3.73342L33.3199 9.10009C33.4912 9.31837 33.7235 9.48081 33.9873 9.56681C34.2512 9.65281 34.5346 9.65847 34.8016 9.58309L41.3699 7.72109C41.5739 7.66297 41.7884 7.65194 41.9972 7.68884C42.2061 7.72574 42.4038 7.80961 42.5755 7.9341C42.7472 8.0586 42.8883 8.22047 42.9883 8.40751C43.0883 8.59454 43.1445 8.80184 43.1526 9.01376L43.4093 15.8388C43.42 16.116 43.513 16.3838 43.6762 16.6081C43.8395 16.8325 44.0658 17.0032 44.3263 17.0988L50.7359 19.4554C50.9349 19.5284 51.1147 19.6456 51.2618 19.7983C51.4089 19.9509 51.5194 20.1349 51.585 20.3364C51.6506 20.538 51.6696 20.7518 51.6406 20.9617C51.6115 21.1717 51.5351 21.3723 51.4173 21.5484L47.6139 27.2208C47.4594 27.4513 47.377 27.7226 47.377 28.0001C47.377 28.2776 47.4594 28.5489 47.6139 28.7794L51.4173 34.4518C51.5351 34.6279 51.6115 34.8285 51.6406 35.0385C51.6696 35.2484 51.6506 35.4622 51.585 35.6638C51.5194 35.8653 51.4089 36.0493 51.2618 36.2019C51.1147 36.3545 50.9349 36.4718 50.7359 36.5448L44.3263 38.9014C44.0662 38.9973 43.8404 39.1682 43.6776 39.3926C43.5148 39.6169 43.4222 39.8845 43.4116 40.1614L43.1526 46.9864C43.1445 47.1984 43.0883 47.4057 42.9883 47.5927C42.8883 47.7797 42.7472 47.9416 42.5755 48.0661C42.4038 48.1906 42.2061 48.2745 41.9972 48.3114C41.7884 48.3483 41.5739 48.3372 41.3699 48.2791L34.8016 46.4171C34.5345 46.341 34.2507 46.346 33.9864 46.4316C33.7222 46.5172 33.4894 46.6795 33.3176 46.8978L29.1013 52.2668C28.9703 52.4337 28.8031 52.5686 28.6123 52.6614C28.4215 52.7542 28.2121 52.8024 27.9999 52.8024C27.7878 52.8024 27.5784 52.7542 27.3876 52.6614C27.1968 52.5686 27.0296 52.4337 26.8986 52.2668L22.6776 46.9001C22.5063 46.6818 22.274 46.5194 22.0102 46.4334C21.7464 46.3474 21.463 46.3417 21.1959 46.4171L14.6276 48.2791C14.4236 48.3372 14.2091 48.3483 14.0003 48.3114C13.7915 48.2745 13.5937 48.1906 13.422 48.0661C13.2504 47.9416 13.1092 47.7797 13.0092 47.5927C12.9092 47.4057 12.8531 47.1984 12.8449 46.9864L12.5883 40.1614C12.5775 39.8842 12.4845 39.6164 12.3213 39.3921C12.158 39.1677 11.9318 38.9969 11.6713 38.9014L5.26159 36.5448C5.06261 36.4718 4.8828 36.3545 4.73571 36.2019C4.58863 36.0493 4.47812 35.8653 4.41251 35.6638C4.3469 35.4622 4.32791 35.2484 4.35697 35.0385C4.38603 34.8285 4.46238 34.6279 4.58026 34.4518L8.38359 28.7794C8.53808 28.5489 8.62056 28.2776 8.62056 28.0001C8.62056 27.7226 8.53808 27.4513 8.38359 27.2208L4.58026 21.5484C4.46238 21.3723 4.38603 21.1717 4.35697 20.9617C4.32791 20.7518 4.3469 20.538 4.41251 20.3364C4.47812 20.1349 4.58863 19.9509 4.73571 19.7983C4.8828 19.6456 5.06261 19.5284 5.26159 19.4554L11.6713 17.0988C11.9313 17.0029 12.1571 16.832 12.3199 16.6076C12.4827 16.3833 12.5753 16.1157 12.5859 15.8388L12.8449 9.01376C12.8531 8.80184 12.9092 8.59454 13.0092 8.40751C13.1092 8.22047 13.2504 8.0586 13.422 7.9341C13.5937 7.80961 13.7915 7.72574 14.0003 7.68884C14.2091 7.65194 14.4236 7.66297 14.6276 7.72109L21.1959 9.58309C21.463 9.65847 21.7464 9.65281 22.0102 9.56681C22.274 9.48081 22.5063 9.31837 22.6776 9.10009L26.9009 3.73342H26.8963Z" fill="#5C31BE" stroke="#5C31BE" stroke-width="1.5"/>
                            <path d="M21 27.9999L25.6667 32.6666L35 23.3333" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <h1>{{$userpoints}}</h1>
                       </div>
                    </div>
                    <div class="correct_ans">
                        <div class="correct">Correct Answers:</div>
                        <span>{{$correct_answers}}/{{$total_questions}}</span>
                    </div>
                    <div class="linkings">
                        <a href="{{url('/test-summary/'.$id)}}" class="see_score">See Scores in Details</a>
                        <a href="{{url('/testList')}}" class="home">Back to Website</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/quiz/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/quiz/js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('assets/quiz/js/owl.carousel.2.3.4.min.js') }}"></script>
    <script src="{{ asset('assets/quiz/js/custom.js') }}"></script>
    <script src="{{ asset('assets/quiz/js/counter.js') }}"></script><script type="text/javascript">
        function preventBack() { window.history.forward(); }
        setTimeout("preventBack()", 0);
        // window.onunload = function () { null };
    </script>
</body>

</html>