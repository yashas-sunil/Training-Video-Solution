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

    <!-- <nav class="navbar navbar-expand-lg navbar-top" data-aos="fade-down">
        <a class="navbar-brand" href="#"><img src="images/logo.png" alt=""></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarScroll"
            aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">

            <ul class="navbar-nav mr-auto my-2 my-lg-0 navbar-nav-scroll" style="max-height: 100px;">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button"
                        data-toggle="dropdown" aria-expanded="false">
                        Courses
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Professors</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Demo</a>
                </li>

            </ul>
            <form class="d-flex">
                <div class="search-box">
                    <input type="text" class="search-txt" name="" placeholder="Search here...">
                    <a href="#" class="search-btn">
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </a>
                </div>
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                <a href="" class="login">Login</a>
                <a href="" class="signup">Signup</a>
            </form>
        </div>
    </nav> -->
    <div class="main">
        <div class="demo-info quiz">
            <h1>Quiz</h1>
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
                            <i class="fa fa-times text-secondary" aria-hidden="true"></i>
                        </div>
                    </div>
                    <div class="filter-container pt-0 pb-5 pl-5">
                        <div id="accordion" class="accordion">
                            <div class="card mb-0">
                                <div class="card-header collapsed" data-toggle="collapse" href="#collapseOne">
                                    <a class="card-title">
                                        Levels
                                    </a>
                                </div>
                                <div id="collapseOne" class="card-body collapse" data-parent="#accordion">
                                    <div class="course-name d-flex align-items-center justify-content-start">
                                        <input type="checkbox" id="one" name="one">
                                        <label for="one">CA Foundation (100)</label>
                                    </div>
                                    <div class="course-name d-flex align-items-center justify-content-start">
                                        <input type="checkbox" id="two" name="two">
                                        <label for="two">CA Inter Fast Track(50)</label>
                                    </div>
                                    <div class="course-name d-flex align-items-center justify-content-start">
                                        <input type="checkbox" id="four" name="four">
                                        <label for="four">CA Final (50)</label>
                                    </div>
                                    <div class="course-name d-flex align-items-center justify-content-start">
                                        <input type="checkbox" id="five" name="five">
                                        <label for="five">CA Full Course (50)</label>
                                    </div>
                                    <div class="course-name d-flex align-items-center justify-content-start">
                                        <input type="checkbox" id="six" name="six">
                                        <label for="six">CA Chapter Wise</label>
                                    </div>
                                    <div class="course-name d-flex align-items-center justify-content-start">
                                        <input type="checkbox" id="seven" name="seven">
                                        <label for="seven">CA CPT</label>
                                    </div>
                                    <div class="course-name d-flex align-items-center justify-content-start">
                                        <input type="checkbox" id="eight" name="eight">
                                        <label for="eight">CA Final Fast Track</label>
                                    </div>
                                    <div class="course-name d-flex align-items-center justify-content-start">
                                        <input type="checkbox" id="nine" name="nine">
                                        <label for="nine">FYJC</label>
                                    </div>
                                    <div class="course-name d-flex align-items-center justify-content-start">
                                        <input type="checkbox" id="ten" name="ten">
                                        <label for="ten">SYJC</label>
                                    </div>
                                </div>
                                <hr>
                                <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                    <a class="card-title">
                                        Course Language
                                    </a>
                                </div>
                                <div id="collapseTwo" class="card-body collapse" data-parent="#accordion">
                                    <div class="language-name d-flex align-items-center justify-content-start">
                                        <input type="checkbox" id="eleven" name="eleven">
                                        <label for="eleven">Hindi & English</label>
                                    </div>
                                    <div class="language-name d-flex align-items-center justify-content-start">
                                        <input type="checkbox" id="twelve" name="twelve">
                                        <label for="twelve">Hindi</label>
                                    </div>
                                    <div class="language-name d-flex align-items-center justify-content-start">
                                        <input type="checkbox" id="thirteen" name="thirteen">
                                        <label for="thirteen">English</label>
                                    </div>

                                </div>
                                <hr>
                                <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                    <a class="card-title">
                                        Subjects
                                    </a>
                                </div>
                                <div id="collapseThree" class=" card-body collapse" data-parent="#accordion">
                                    <div class="subject-name d-flex align-items-center justify-content-start">
                                        <input type="checkbox" id="fourteen" name="fourteen">
                                        <label for="fourteen">Mathemetics & Statistics</label>
                                    </div>
                                    <div class="subject-name d-flex align-items-center justify-content-start">
                                        <input type="checkbox" id="fifteen" name="fifteen">
                                        <label for="fifteen">Book Keeping</label>
                                    </div>
                                    <div class="subject-name d-flex align-items-center justify-content-start">
                                        <input type="checkbox" id="sixteen" name="sixteen">
                                        <label for="sixteen">Secretarial Practice</label>
                                    </div>
                                    <div class="subject-name d-flex align-items-center justify-content-start">
                                        <input type="checkbox" id="seventeen" name="seventeen">
                                        <label for="seventeen">Organisational Commerce & Managment</label>
                                    </div>
                                    <div class="subject-name d-flex align-items-center justify-content-start">
                                        <input type="checkbox" id="eighteen" name="eighteen">
                                        <label for="eighteen">Economics</label>
                                    </div>
                                    <div class="subject-name d-flex align-items-center justify-content-start">
                                        <input type="checkbox" id="nineteen" name="nineteen">
                                        <label for="nineteen">Information Techonology</label>
                                    </div>

                                </div>
                                <hr>
                                <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                                    <a class="card-title">
                                        Chapter
                                    </a>
                                </div>
                                <div id="collapseFour" class=" card-body collapse" data-parent="#accordion">
                                    <div class="subject-name d-flex align-items-center justify-content-start">
                                        <input type="checkbox" id="even" name="even">
                                        <label for="even">Economics</label>
                                    </div>
                                    <div class="subject-name d-flex align-items-center justify-content-start">
                                        <input type="checkbox" id="odd" name="odd">
                                        <label for="odd">Information Techonology</label>
                                    </div>

                                </div>
                                <hr>
                                <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFive">
                                    <a class="card-title">
                                        Professor
                                    </a>
                                </div>
                                <div id="collapseFive" class=" card-body collapse" data-parent="#accordion">

                                </div>
                                <hr>
                                <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseSix">
                                    <a class="card-title">
                                        Rating
                                    </a>
                                </div>
                                <div id="collapseSix" class=" card-body collapse" data-parent="#accordion">

                                </div>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- sidebar-wrapper  -->
            <main class="page-content">
                <div class="container-fluid demo-list">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-white p-md-0">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Quiz</li>
                        </ol>
                    </nav>
                    <div class="row justify-content-center m-md-0">
                        <form id="search-demo">
                            <i class="fa fa-search" aria-hidden="true"></i>
                            <input type="text" placeholder="search for quizzes by name here" id="text" name="text">

                        </form>

                    </div>  @if($testlist)
                    <div class="results d-flex">
                        <p class="m-0">Showing</p>
                        <span class="pl-3 font-weight-bold">1500 results</span>
                    </div>
                  
                    <div class="sub-topics">
                        <h3>Mathemetics & Statistics:</h3>
                        <div class="row">
                            @foreach ($testlist as $key => $value)
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="sub-quiz">
                                    <a href="#quiz-modal" data-toggle="modal" data-target="#quiz-modal" onclick="instruction({{$value->id}})">
                                        <img src="{{ asset('assets/quiz/images/quiz/sub-quiz-1.png')}}" alt="">
                                        <div class="quiz-info">
                                            <h4>{{$value->name}}</h4>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                            <!-- <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="sub-quiz">
                                    <a href="#quiz-modal" data-toggle="modal" data-target="#quiz-modal">
                                        <img src="{{ asset('assets/quiz/images/quiz/sub-quiz-3.png')}}" alt="">
                                        <div class="quiz-info">
                                            <h4>Branch Accounts</h4>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="sub-quiz">
                                    <a href="#quiz-modal" data-toggle="modal" data-target="#quiz-modal">
                                        <img src="{{ asset('assets/quiz/images/quiz/sub-quiz-2.png')}}" alt="">
                                        <div class="quiz-info">
                                            <h4>Branch Accounts</h4>
                                        </div>
                                    </a>
                                </div>
                            </div> -->
                        </div>
                    </div>
                    <hr>
                   
@else
<div class="results d-flex">
                        <p class="m-0">Test not found</p>
                    
                    </div>
@endif
                </div>

            </main>
            <!-- Modal -->
            <div class="modal fade" id="quiz-modal" tabindex="-1" role="dialog" aria-labelledby="quiz-modalTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div class="modal-info" id="instruction">
                               
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Modal Ends -->
            <!-- page-content" -->
        </div>
        <!-- page-wrapper -->
        <!-- Footer -->
        <!-- <div class="footer" id="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="ft-info">
                            <h4>J.K.Shah Classes</h4>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</p>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-12">
                        <div class="ft-courses">
                            <h4>Courses</h4>
                            <ul>
                                <li>Link 1</li>
                                <li>Link 2</li>
                                <li>Link 3</li>
                                <li>Link 4</li>
                                <li>Link 5</li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-3 col-sm-12">
                        <div class="ft-courses">
                            <h4>Courses</h4>
                            <ul>
                                <li>Link 1</li>
                                <li>Link 2</li>
                                <li>Link 3</li>
                                <li>Link 4</li>
                                <li>Link 5</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-12">
                        <div class="ft-classes">
                            <h4>Casses</h4>
                            <ul>
                                <li>Link 1</li>
                                <li>Link 2</li>
                                <li>Link 3</li>
                                <li>Link 4</li>
                                <li>Link 5</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="ft-contact">
                            <h4>Locate Us</h4>
                            <ul class="address">
                                <li><span><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                    </p>
                                </li>
                                <li><span><i class="fa fa-phone" aria-hidden="true"></i></span>
                                    <p>8070400900</p>
                                </li>
                            </ul>
                            <div class="social-icons">
                                <h5>Connect With us</h5>
                                <ul>
                                    <li><a href=""><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
                                    <li><a href=""><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                    <li><a href=""><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="container copyright">Copyright &copy; J.K.ShahClasses . All rights reserved</div>
        </div> -->
        <!-- End Footer -->
    </div>
    <script src="{{ asset('assets/quiz/js/jquery.min.js')}}"></script>
    <script src="{{ asset('assets/quiz/js/bootstrap.bundle.js')}}"></script>
    <script src="{{ asset('assets/quiz/js/owl.carousel.2.3.4.min.js')}}"></script>
    <script src="{{ asset('assets/quiz/js/custom.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function instruction(id) {
//alert(id);
            $.ajax({
                        type:'POST',
                        header:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url: "{{ route('quiz.instruction') }}",
                
                        dataType:"json",
                        data:{"_token": "{{ csrf_token() }}",
                             'id':id,
                             },  
                            success:function(data){
                                var url = '{{ route("quiz.question", ":id") }}';
url = url.replace(':id',id);

                            $("#instruction").html(' <h3>Instructions</h3><p>'+data.data.name+'</p><a href="'+url+'">start quiz</a>');
                            }
                    });
        }
    </script>
    <script type="text/javascript">
        function preventBack() { window.history.forward(); }
        setTimeout("preventBack()", 0);
        // window.onunload = function () { null };
    </script>
</body>

</html>