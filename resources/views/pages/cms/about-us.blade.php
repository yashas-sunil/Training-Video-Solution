@extends('layouts.master')
@section('content')
<div class="main">
    <div class="container">
        <div class="about-title">
            <h1>J. K. Shah Classes Provides The Education That Regular Classes Forgot</h1>
        </div>
        <div class="ranking">
            <div class="ranking-box">
                <h1>1</h1>
                <div class="ranking-content">
                    <h3>India's No.1 </h3>
                    <h2>CA Coaching Classes</h2>
                    <h6>Since 1983</h6>
                </div>
            </div>
        </div>
        {{--<div class="about-info py-5">
            <p>J. K. Shah Classes has led the commerce and CA coaching segment for more than 37 years
                now. It is a name renowned for the country's best faculty, comprehensive study material,
                proven teaching methodology, and excellent results year after year after year, for
                years.</p>
            <p>
                As an institute with a large face-to-face network of centers across India, we stand
                committed to give our students the best in coaching to help them perform at their
                highest potential.

            </p>
        </div>
        <div class="quotes my-5">
            <h3>“Spreadheading the online CA Coaching Revolution”</h3>
            <p>- Prof. J. K. Shah, CA. Founder, J. K. Shah Classes</p>
        </div>
        <div class="strength my-5 py-5">
            <h1>Our Strength’s</h1>
            <div class="row pt-5">
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="strength-list">
                        <img src="{{ asset('assets/new_ui_assets/images/coach.png') }}" alt="">
                        <h4>India’s Best coaching Faculty</h4>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="strength-list">
                        <img src="{{ asset('assets/new_ui_assets/images/timetable.png') }}" alt="">
                        <h4>Study Timetable</h4>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="strength-list">
                        <img src="{{ asset('assets/new_ui_assets/images/test.png') }}" alt="">
                        <h4>Accurate test series</h4>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="strength-list">
                        <img src="{{ asset('assets/new_ui_assets/images/bulding.png') }}" alt="">
                        <h4>Extensive Infrastructure</h4>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="strength-list">
                        <img src="{{ asset('assets/new_ui_assets/images/book.png') }}" alt="">
                        <h4>comphrensive study material</h4>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="strength-list">
                        <img src="{{ asset('assets/new_ui_assets/images/data-analytics.png') }}" alt="">
                        <h4>Consistent Results</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="quotes my-5">
            <h3>“The Next Gen Ca Coaching: Online. Flexible. At Home”</h3>
            <p>- Vishal Shah, CA. CEO, J. K. Shah Classes</p>
        </div>
        <div class="why-us py-5">
            <h1>Why Choose us</h1>
            <p></p>
            <ul>
                <li>
                    <div class="inner">
                        <img src="{{ asset('assets/new_ui_assets/images/wcu-1.png') }}" alt="">
                        <span>Stream On Any Device</span>
                        <p>An industry first, the J. K. Shah Online portal lets stream the lecture videos on your mobile, just as you do with you tube. The streaming works across devices, so you can log in to your J. K. Shah Online account from any device, anywhere.</p>
                    </div>
                </li>
                <li>
                    <div class="inner">
                        <img src="{{ asset('assets/new_ui_assets/images/wcu-2.png') }}" alt="">
                        <span>Complete Freedom of Choice</span>
                        <p>For the first time in the industry, J. K. Shah Online portal lets you enroll for the entire course / any group / any subject(s) / any chapter. Study what you want at your own pace, and yes, you only pay for what you opt for.</p>
                    </div>
                </li>
                <li>
                    <div class="inner">
                        <img src="{{ asset('assets/new_ui_assets/images/wcu-3.png') }}" alt="">
                        <span>All Subject Under One Roof</span>
                        <p>Yet another first - you can avail of all subject content that is of the same quality, with the same standard of excellence.While each subject is taught by a different faculty, all lectures have been tailored to meet the high standards of J. K. Shah Classes. The notes, study material, doubt solving sessions all follow a single format, making it easier for the students to access content, and interact with the faculty.</p>
                    </div>
                </li>
                <li>
                    <div class="inner">
                        <img src="{{ asset('assets/new_ui_assets/images/wcu-4.png') }}" alt="">
                        <span>Personalised Study Plan</span>
                        <p>When a student purchases a course, the student receives a dedicated study plan. This guides the student on hours to be spent on viewing lectures, time to be allotted for self study, and a clear outline for attempting tests given.
                            In case the student has signed up for multiple subjects, a mentor will chart out a personalized study plan, and will regularly monitor the student&#039;s progress.</p>
                    </div>
                </li>
                <li>
                    <div class="inner">
                        <img src="{{ asset('assets/new_ui_assets/images/wcu-5.png') }}" alt="">
                        <span>Doubt Solving By Faculties</span>
                        <p>Our Doubt Solving Sessions are conducted by professors that teach the subject. No assistants, no articles, no junior teachers! All doubts cleared within 48 hours.</p>
                    </div>
                </li>
                <li>
                    <div class="inner">
                        <img src="{{ asset('assets/new_ui_assets/images/wcu-5.png') }}" alt="">
                        <span>Choice of Language</span>
                        <p>At this point, our recordings for all subjects are ready in English. The Hindi + English recordings will also be available shortly. So you will be able to choose your preferred language for thorough understanding.</p>
                    </div>
                </li>
                <li>
                    <div class="inner">
                        <img src="{{ asset('assets/new_ui_assets/images/wcu-5.png') }}" alt="">
                        <span>Unique Lecture Format</span>
                        <p>All lectures have been recorded question-wise and concept-wise. That means you do not need to scrub through hours of lectures to find the 5 minute clip where the professor has explained the problem you need to revise. Each problem and its solution have been recorded as a separate video.</p>
                    </div>
                </li>
               <li>
                    <div class="inner">
                        <img src="{{ asset('assets/new_ui_assets/images/wcu-5.png') }}" alt="">
                        <span>Regular Tests</span>
                        <p>The institute provides regular tests as part of lecture package, along with solutions. These tests are discussed in detail by professors to clear up any doubts the students may have.</p>
                    </div>
                </li>  
            </ul>
        </div>--}}
        <div class="my-2 py-3">
        <div class="choose-us w-100" id="about_choose">
            <h1>Why Choose Us</h1>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12">
                   <a href="javascript:void(0)" class="text-decoration-none">
                    <div class="inner">
                        <img src="{{ asset('assets/new_ui_assets/images/whychooseusicons/ALL SUBJECTS UNDER ONE ROOF.png') }}" alt="">
                        <span>All Subjects Under One Roof</span>
                    </div>
                   </a>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <a href="javascript:void(0)" class="text-decoration-none">
                        <div class="inner">
                            <img src="{{ asset('assets/new_ui_assets/images/whychooseusicons/HD STUDIO RECORDED LECTURES.png') }}" alt="">
                            <span>HD Studio Recorded Lectures</span>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <a href="javascript:void(0)" class="text-decoration-none">
                        <div class="inner">
                            <img src="{{ asset('assets/new_ui_assets/images/whychooseusicons/CHOICE OF PROFESSOR.png') }}" alt="">
                            <span>Choice Of Professor</span>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <a href="javascript:void(0)" class="text-decoration-none">
                        <div class="inner">
                            <img src="{{ asset('assets/new_ui_assets/images/whychooseusicons/CHOICE OF LANGUAGE.png') }}" alt="">
                            <span>Choice Of Language</span>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <a href="javascript:void(0)" class="text-decoration-none">
                        <div class="inner">
                            <img src="{{ asset('assets/new_ui_assets/images/whychooseusicons/SEAMLESS STREAMING ACROSS ALL DEVICES.png') }}" alt="">
                            <span>Seamless Streaming Across All Devices</span>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <a href="javascript:void(0)" class="text-decoration-none">
                        <div class="inner">
                            <img src="{{ asset('assets/new_ui_assets/images/whychooseusicons/OPT ANY CHAPTER, SUBJECT.png') }}" alt="">
                            <span>Opt Any Chapter, Subject</span>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <a href="javascript:void(0)" class="text-decoration-none">
                        <div class="inner">
                            <img src="{{ asset('assets/new_ui_assets/images/whychooseusicons/UNIQUE LECTURE FORMAT.png') }}" alt="">
                            <span>Unique Lecture Format</span>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <a href="javascript:void(0)" class="text-decoration-none">
                        <div class="inner">
                            <img src="{{ asset('assets/new_ui_assets/images/whychooseusicons/UNIFIED SYSTEM FOR DOUBT SOLVING.png') }}" alt="">
                            <span>Unified System for Doubt Solving</span>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <a href="javascript:void(0)" class="text-decoration-none">
                        <div class="inner">
                            <img src="{{ asset('assets/new_ui_assets/images/whychooseusicons/PERSONALISED STUDY PLAN.png') }}" alt="">
                            <span>Personalised Study Plan</span>
                        </div>
                    </a>
                </div>           
            </div>
        </div>
    </div>
        <div class="leaders my-2">
            <h1 class="pb-5">Meet our Leaders</h1>
            <ul>
                <li>
                    <div class="leader_image_sec">
                    <img src="{{asset('assets/new_ui_assets/images/jk_shah_sir.png')}}" alt="">
                    <p class="font-weight-bold text-center mt-2 mb-2">Prof. J. K. Shah, CA</p>
                    <p class="text-center">Founder, J. K. Shah Classes</p>
                    </div>
                    <div class="leader-info">
                        <p>
                        J. K. Shah Classes prides itself in leading the commerce coaching segment by setting new trends in coaching. We believe every generation has its own set of needs when it comes to studying. With studies and businesses at large increasingly shifting online, J. K. Shah Classes felt the time was right to offer CA students an online coaching platform. </p>
                        <p>
                        J. K. Shah Online is a platform dedicatedly developed to enable students from all parts of India to access the best in CA coaching. From hi-quality studio recorded lectures, to live doubt solving sessions to personalised study plans, our online platform has everything a student needs to prepare for the CA exams and excel.</p>

                    </div>
                    <div class="quotes my-2">
                        <h3>“Spreadheading the Online CA Coaching Revolution”</h3>
                        <p>- Prof. J. K. Shah, CA</p>
                        <p>Founder, J. K. Shah Classes</p>
                    </div>
                </li>
                 <li>
                 <div class="leader_image_sec">
                 <img src="{{asset('assets/new_ui_assets/images/vishal_shah_sir.png')}}" alt="">
                    <p class="font-weight-bold text-center mt-2 mb-2">Vishal Shah, CA</p>
                    <p class="text-center">CEO, J. K. Shah Online</p>
                    </div>
                    <div class="leader-info">
                        <p>J. K. Shah Online offers students an online learning platform that is a great time saver and an excellent mode of study. The platform has been developed to ensure students have ready access to what they want to study, whenever they want and wherever they want to study it.</p>
                       
                        <p> J. K. Shah Online is the brainchild of CA Vishal Shah, who has a thorough understanding of the needs of CA students, and a keen sense of e-learning technology. Under his guidance and supervision, the platform has been designed to offer students hi-quality audio and video content, along with a rich and enjoyable learning experience.</p>
                    </div>
                    <div class="quotes my-2">
                        <h3>“The Next Gen CA Coaching: Online. Flexible. At Home”</h3>
                        <p>- Vishal Shah, CA</p>
                        <p>CEO, J. K. Shah Classes</p>
                    </div>
                </li>
            </ul>
        </div>
        <div class="about-info py-2">
            <p>J. K. Shah Classes has led the Commerce and CA, CS coaching segment for more than 40 years now. It is a name renowned for the country's Best Faculties, Comprehensive Study Material, Proven Teaching Methodology and Excellent Results year after year after year, for years.</p>
            <p>
            J. K. Shah Online is a platform which brings a new knowledge in ecosystem which helps students prepare for various professional and competitive exams like CA, CS, CMA, CFA, F.Y.J.C, S.Y.J.C Anytime, Anywhere, on Any Device.
            </p>
            <p>J. K. Shah Online Classes are conducted using a virtual portal through which students can view pre-recorded lectures at their own Pace from Anywhere, Anytime. Online classes have become a part of the new normal and have become an integral part of our lives. Education is a dynamic field that experiences great innovations with every passing day. Digital transformations and the arrival of novel technologies in the Ed-tech sector have acted as a great catalyst collectively because the student outcomes have witnessed
tremendous growth. Ed-tech is simplifying things both for the teachers and the students. It has emerged as a highly popular way of imparting education. Similarly, the use of technology is going to enrich the academic development of the students by providing education with the much-needed digital infrastructure.</p>
<p>This type of class got a boost during the pandemic. With the global spread of the disease COVID-19, all
the educational institutes had to shut down and were forced to conduct classes via the internet. But to avail
the benefits of these classes it is recommended to have a good stable internet connection. It is also
important to choose the right online teaching app to conduct your online classes. We have already answered
the question of what online classes are, let us take a look at a few of the advantages that it offers. The
flexibility and convenience that these classes provide cannot be stressed enough. Geographical barriers are
no longer an issue. These classes also help to save time, money, and effort. Education is being democratized
because of online classes. More and more people have access to quality education, and they have a chance
to study the course that they want without having to worry about distance or accessibility.</p>
<p>Like traditional classes, online classes can have a varied workload depending on the course's difficulty. Online
classes also allow the user to take up more than one course at a time. It allows them to maximize their
productivity. This way, the user can plan their time that will enable them to balance work and family.
Moreover, these classes can be accessed from Anywhere, Anytime by the students. As a result, it enhances
the teaching-learning process and makes the class interactive for students. When students are more involved
in the learning process, they are more likely to perform better. Also, they grasp the content better which
adds more to their existing knowledge base. These classes have emerged as the new face of education and
are redefining the meaning of traditional classrooms.</p>
<p>As an Institute with a large face-to-face network of centers across India, we stand committed to give our
students the best in coaching to help them perform at their highest potential.</p>
<p>We, at J. K. Shah Classes, would like to Wish All The Best to All the students for their Future.</p>
        </div>
    </div>
</div>
@endsection
