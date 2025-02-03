<?php

namespace App\Http\Controllers\Quiz;

use App\Http\Controllers\Controller;
use App\Models\Quiz\Answer;
use App\Models\Quiz\Question;
use App\Models\Quiz\Test;
use App\Models\Quiz\UserQuestions;
use App\Models\Quiz\UserTests;
use App\Models\Quiz\Grade;
use App\Models\Quiz\Board;
use App\Models\Quiz\Subject;
use App\Models\Quiz\Student;
use App\Models\Quiz\UserAnswers;
use App\Models\Quiz\Olympiad;
use App\Models\Quiz\Event;
use App\Models\Quiz\UserTestPower;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Password;
use Illuminate\Notifications\Notifiable;
use Laravel\Socialite\Facades\Socialite;
use DB;
use Validator;
use Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Mail\Welcome;
use App\ApiService;
use Artesaos\SEOTools\Facades\SEOMeta;
class IndexController extends Controller
{
    private $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function index() {
        // dd(Auth::guard('user')->user()->id);
        return view('quiz.pages.index');
    }


    public function Test($id) {
        // $test = Event::find(decrypt($id));
        $test = Event::find($id);
        return view('quiz.pages.instruction')->with(['test' => $test]);
    }

    public function StartTest($id) {
        $user_api = $this->apiService->getProfile() ?? null;
        $user_json = json_decode($user_api);
        if(!isset($user_json->data)){
               return redirect('/');
           }else{
        // dd($status);
        $user = $user_json->data;
        $event = Event::find(decrypt($id));
        // dd($event);
        $round = $event->getEventRound;
        $test = $event->getEventRound->getTest;
//        $test = Test::find(decrypt($id));
        $tid = substr(md5(time()), 0, 8);
        if($test->ques_selection_type === 'manual'){
                foreach($test->getModules as $module){
                    $qids = $module->getQuestions->pluck('question_id')->toArray();
                    if($test->ques_ordered == 1){
                        $questions = Question::whereIn('id', $qids)->orderBy('order_by', 'ASC')->get();
                    }else{
                        $questions = Question::whereIn('id', $qids)->inRandomOrder()->get();
                    }
//                    dd($questions);
                    $ut = $this->CreateTest($event , $round, $test, $questions, $module, $tid);
                }
        }elseif($test->ques_selection_type === 'auto'){
            foreach($test->getModules as $module) {
                $sids = $module->getSelections;
                $questions = [];
                $n = 0;
                foreach ($sids as $sid) {
                    if ($test->is_difficulty == 1) {
                        $diffs = json_decode($sid->difficulty);
                        if ($test->auto_selection_type == 'subject') {
                            if ($diffs->easy > 0) {
                                $questions[$n] = Question::where('board_id', $test->board_id)->where('grade_id', $test->grade_id)->where('subject_id', $sid->selection_id)->where('difficulty', 'Easy')->inRandomOrder()->limit($diffs->easy)->get();
                            } elseif ($diffs->medium > 0) {
                                $questions[$n] = Question::where('board_id', $test->board_id)->where('grade_id', $test->grade_id)->where('subject_id', $sid->selection_id)->where('difficulty', 'Medium')->inRandomOrder()->limit($diffs->medium)->get();
                            } elseif ($diffs->hard > 0) {
                                $questions[$n] = Question::where('board_id', $test->board_id)->where('grade_id', $test->grade_id)->where('subject_id', $sid->selection_id)->where('difficulty', 'Hard')->inRandomOrder()->limit($diffs->hard)->get();
                            }
                        } elseif ($test->auto_selection_type == 'chapter') {
                            if ($diffs->easy > 0) {
                                $questions[$n] = Question::where('board_id', $test->board_id)->where('grade_id', $test->grade_id)->where('chapter_id', $sid->selection_id)->where('difficulty', 'Easy')->inRandomOrder()->limit($diffs->easy)->get();
                            } elseif ($diffs->medium > 0) {
                                $questions[$n] = Question::where('board_id', $test->board_id)->where('grade_id', $test->grade_id)->where('chapter_id', $sid->selection_id)->where('difficulty', 'Medium')->inRandomOrder()->limit($diffs->medium)->get();
                            } elseif ($diffs->hard > 0) {
                                $questions[$n] = Question::where('board_id', $test->board_id)->where('grade_id', $test->grade_id)->where('chapter_id', $sid->selection_id)->where('difficulty', 'Hard')->inRandomOrder()->limit($diffs->hard)->get();
                            }
                        } elseif ($test->auto_selection_type == 'concept') {
                            if ($diffs->easy > 0) {
                                $questions[$n] = Question::where('board_id', $test->board_id)->where('grade_id', $test->grade_id)->where('concept_id', $sid->selection_id)->where('difficulty', 'Easy')->inRandomOrder()->limit($diffs->easy)->get();
                            } elseif ($diffs->medium > 0) {
                                $questions[$n] = Question::where('board_id', $test->board_id)->where('grade_id', $test->grade_id)->where('concept_id', $sid->selection_id)->where('difficulty', 'Medium')->inRandomOrder()->limit($diffs->medium)->get();
                            } elseif ($diffs->hard > 0) {
                                $questions[$n] = Question::where('board_id', $test->board_id)->where('grade_id', $test->grade_id)->where('concept_id', $sid->selection_id)->where('difficulty', 'Hard')->inRandomOrder()->limit($diffs->hard)->get();
                            }
                        }
                    } else {
                        if ($sid->questions > 0) {
                            if ($test->auto_selection_type == 'subject') {
                                $questions[$n] = Question::where('board_id', $test->board_id)->where('grade_id', $test->grade_id)->where('subject_id', $sid->selection_id)->inRandomOrder()->limit($sid->questions)->get();
                            } elseif ($test->auto_selection_type == 'chapter') {
                                $questions[$n] = Question::where('board_id', $test->board_id)->where('grade_id', $test->grade_id)->where('chapter_id', $sid->selection_id)->inRandomOrder()->limit($sid->questions)->get();
                            } elseif ($test->auto_selection_type == 'concept') {
                                $questions[$n] = Question::where('board_id', $test->board_id)->where('grade_id', $test->grade_id)->where('concept_id', $sid->selection_id)->inRandomOrder()->limit($sid->questions)->get();
                            }
                        }
                    }
                    $n++;
                }
                $ut = $this->CreateTest($event, $round, $test, $questions, $module, $tid);
            }
        }
        return redirect(route('quiz.question', ['ID' => encrypt($event->id)]));
    }
    }

    public function Question($id) {
        $user_api = $this->apiService->getProfile() ?? null;
        $user_json = json_decode($user_api);
        if(!isset($user_json->data)){
               return redirect('/');
           }else{
        $user = $user_json->data;
        $event = Event::find(decrypt($id));
        $round = $event->getEventRound;
        $test = $event->getEventRound->getTest;

        $userTest = UserTests::where('user_id', $user->id)->where('test_id', $test->id)->where('is_completed', 0)->first();
        $userQuestion = UserQuestions::where('user_id', $user->id)->where('user_test_id', $userTest->id)->where('is_attempted', 0)->where('is_skipped', 0)->first();
        // dd($userQuestion->getQuestion->getRandomOptions);
        $Attempted = UserQuestions::where('user_id', $user->id)
            ->where('user_test_id', $userTest->id)
            ->where(function ($query) {
                $query->where('is_attempted', 1)
                    ->orWhere('is_skipped', 1);
            })
            ->count();
        $pscore = UserQuestions::where('user_id', $user->id)->where('user_test_id', $userTest->id)->where('is_attempted', 1)->where('is_correct', 1)->sum('score');
        $powerscore = UserTestPower::where('user_id', $user->id)->where('user_test_id', $userTest->id)->distinct('user_question_id')->pluck('user_question_id');
        $nscore = UserQuestions::where('user_id', $user->id)->where('user_test_id', $userTest->id)->where('is_attempted', 1)->where('is_correct', 0)->whereNotIN('id',$powerscore)->sum(DB::raw('MOD(score, '.$test->negative.')'));

        if($nscore > $pscore){
            $score = 0;
        }else{
            $score = round($pscore - $nscore);
        }
//        dd($userQuestion);
        if(!empty($userQuestion)){
            return view('quiz.pages.question')->with(['event' => $event,'user' => $user, 'userQuestion' => $userQuestion, 'Attempted' => $Attempted, 'test' => $test, 'score' => $score, 'userTest' => $userTest]);
        }else{
            $userTest = UserTests::where('user_id', $user->id)->where('test_id', $test->id)->where('is_completed', 0)->first();
            $pscore = UserQuestions::where('user_id', $user->id)->where('user_test_id', $userTest->id)->where('is_attempted', 1)->where('is_correct', 1)->sum('score');
            $powerscore = UserTestPower::where('user_id', $user->id)->where('user_test_id', $userTest->id)->distinct('user_question_id')->pluck('user_question_id');
            $nscore = UserQuestions::where('user_id', $user->id)->where('user_test_id', $userTest->id)->where('is_attempted', 1)->where('is_correct', 0)->whereNotIn('id',$powerscore)->sum(DB::raw('MOD(score, '.$test->negative.')'));

            if($nscore > $pscore){
                $score = 0;
            }else{
                $score = round($pscore - $nscore);
            }
            $userTest->is_completed = 1;
            $userTest->score = $score;
            $userTest->save();

            return redirect(route('quiz.complete-test', ['ID' => encrypt($event->id)]));
        }
    }

    }

    public function SubmitQuestion(Request  $request, $id) {
        $user_api = $this->apiService->getProfile() ?? null;
        $user_json = json_decode($user_api);
        if(!isset($user_json->data)){
               return redirect('/');
           }else{
        $user = $user_json->data;
        $event = Event::find(decrypt($id));
        $round = $event->getEventRound;
        $test = $event->getEventRound->getTest;
        $option = Answer::find($request->option_id);

        // if($request->power_ids != NULL){
        // foreach(json_decode($request->power_slugs) as $power_slug){
        //     Session::push('power_slug', $power_slug);
        // }
        // foreach(json_decode($request->power_ids) as $key=>$power_id){
        //     $powers = explode('-',$power_id);

        //     $UTP = new UserTestPower;
        //     $UTP->user_id = $user->id;
        //     $UTP->user_test_id = $request->utest_id;
        //     $UTP->question_id = $request->q_id;
        //     $UTP->user_question_id = $request->uq_id;
        //     $UTP->power_id = $powers[1];
        //     $UTP->created_by = 1;
        //     $UTP->updated_by = 1;
        //     $UTP->save();

        //     if (in_array("extra-life", json_decode($request->power_slugs))) {
        //         if($option->is_correct != 1){
        //             return redirect(route('quiz.question', ['ID' => encrypt($event->id)]));
        //         }
        //     }
        //  }
        // }

        $data = new UserAnswers();
        $data->user_test_id = $request->utest_id;
        $data->user_question_id = $request->uq_id;
        $data->user_id = $user->id;
        $data->question_id = $request->q_id;
        $data->option_id = $request->option_id;
        if($option->is_correct == 1){
            $data->is_correct = 1;
        }

        $data->esec = $request->etime;
        $data->rsec = $request->rtime;
        $data->mil = $request->mil;
        $data->status = 1;
        $data->created_by = 1;
        $data->updated_by = 1;
        $data->save();

        $userQuestion = UserQuestions::find($request->uq_id);
        $userQuestion->is_attempted = 1;
        if($request->power_slugs != NULL){
            if (in_array("double", json_decode($request->power_slugs))) {
                $userQuestion->score = $userQuestion->score*2;
            }
        }
        if($option->is_correct == 1){
            $userQuestion->is_correct = 1;
        }
        $userQuestion->save();

        return redirect(route('quiz.question', ['ID' => encrypt($event->id)]));
    }
    }

    public function SkipQuestion(Request $request, $id) {
//        dd($request->all());
        $user_api = $this->apiService->getProfile() ?? null;
        $user_json = json_decode($user_api);
        if(!isset($user_json->data)){
               return redirect('/');
           }else{
        $user = $user_json->data;
        $event = Event::find(decrypt($id));
        $round = $event->getEventRound;
        $test = $event->getEventRound->getTest;
        if($request->power_ids != NULL){
            foreach(json_decode($request->power_slugs) as $power_slug){
                Session::push('power_slug', $power_slug);
            }
            foreach(json_decode($request->power_ids) as $key=>$power_id){
                $powers = explode('-',$power_id);

                $UTP = new UserTestPower;
                $UTP->user_id = $user->id;
                $UTP->user_test_id = $request->utest_id;
                $UTP->question_id = $request->q_id;
                $UTP->user_question_id = $request->uq_id;
                $UTP->power_id = $powers[1];
                $UTP->created_by = 1;
                $UTP->updated_by = 1;
                $UTP->save();

                if (in_array("extra-life", json_decode($request->power_slugs))) {
                    return redirect(route('quiz.question', ['ID' => encrypt($event->id)]));
                }
            }
        }
        $userQuestion = UserQuestions::find($request->uq_id);
        $userQuestion->is_skipped = 1;
        if($request->power_slugs != NULL){
            if (in_array("double", json_decode($request->power_slugs))) {
                $userQuestion->score = $userQuestion->score*2;
            }
        }
        $userQuestion->save();

        return redirect(route('quiz.question', ['ID' => encrypt($event->id)]));
    }
    }

    public function CompleteTest($id) {
        Session::forget('power_slug');
        $user_api = $this->apiService->getProfile() ?? null;
        $user_json = json_decode($user_api);
        if(!isset($user_json->data)){
               return redirect('/');
           }else{
        $user = $user_json->data;
        $event = Event::find(decrypt($id));
        $round = $event->getEventRound;
        $test = $event->getEventRound->getTest;
        $userTest = UserTests::where('user_id', $user->id)->where('test_id', $test->id)->where('is_completed', 1)->orderBy('id','desc')->first();
        $userQuestion = UserQuestions::where('user_id', $user->id)->where('user_test_id', $userTest->id)->get();
        $qids = UserQuestions::where('user_id', $user->id)->where('user_test_id', $userTest->id)->pluck('question_id')->toArray();
        $questions = Question::whereIn('id', $qids)->get();
//        $rank = UserTests::where('test_id', $test->id)->where('is_completed', 1)->orderBy('id','desc')->distinct('user_id');
//        $ranking = UserTests::select('score','user_id','test_id','created_by')->where('test_id', $test->id)->latest('created_by')->groupby('user_id')->orderBy('score', 'desc')->get();
//        $user_rank = UserTests::orderBy('scoe', 'desc')->latest('created_by')->groupby('user_id')->pluck('id')->toArray();
        $total = UserQuestions::where('user_id', $user->id)->where('user_test_id', $userTest->id)->sum('score');
        $ranks = UserTests::select('user_test.*')
        ->join(DB::raw('(SELECT MAX(id) as id FROM user_test GROUP BY user_id) last_updates '),
            function($join)
            {
                $join->on('last_updates.id', '=', 'user_test.id');
            })
        ->where('user_test.event_id', $event->id)
        ->orderBy('user_test.score', 'DESC');
        $ranking = $ranks->get();
        $rank = $ranks->pluck('user_id')->toArray();

        return view('quiz.pages.review')->with(['user' => $user, 'event' => $event, 'test' => $test, 'total' => $total, 'question'=>$questions,'userQuestion'=>$userQuestion,'score'=>$userTest->score,'rank'=>$rank,'ranking'=>$ranking]);
    }
    }

    public function hide5050(Request $request){
//        dd($request->all());
        $question = Question::find($request->qid);
        $result = $question->getRandomOptionsLimits;
        return json_encode($result);
    }

    public function practice($grade = null,$board = null)
    {
        $grade_data = Grade::get();
        $board_data = Board::get();
        $subject = Subject::get();

        $user_api =  $this->apiService->getProfile() ?? null;
        $user_json = json_decode($user_api);
        if(!isset($user_json->data)){
               return redirect('/');
           }else{
        $user = $user_json->data;
       // dd(json_decode($user));
        if($user != null)
        {
            $board_id = $user['data']['student']['course_id'] ?? null;
            $grade_id = $user['data']['student']['level_id'] ?? null;
            // $std = Student::where('user_id',$user->id)->first();
            $gd = Grade::find($grade_id);
            $grade_val = $gd->name;
            $query = Event::where('access_type','public')->where('event_type','Competition')->where('board_id',$board_id)->where('grade_id',$grade_id)->where('is_published',1);
            $total = $query->count();
            $complete = DB::table('user_test')
                        ->select('event.id')
                        ->join('event','event.id','user_test.event_id')
                        ->where('user_test.use', json_decode($user))
                        ->distinct('event.id')
                        ->count();
            $test=  $query->get();

        }else
        {
            return redirect('/');
            // if($grade != null){
            //     $gd = Grade::find($grade);
            //     $grade_val = $gd->name;
            // }else{
            //     $grade_val = 0;
            // }

            // $complete = 0;
            // $query = Event::where('access_type','public')->where('event_type','Practice')->where('board_id',$board)->where('grade_id',$grade)->where('is_published',1);
            // $total = $query->count();
            // $test =  $query->get();
        }
                    // dd($test);
        SEOMeta::setTitle("CA Professor - Best CA Faculty in India | JK Shah Online");
        SEOMeta::setDescription("We have hired some of the best and experienced professors to coach our students with proven methods. JK Shah is renowned for its best faculty in the country.");
        SEOMeta::setCanonical("https://online.jkshahclasses.com/ca-faculty");
        return view('quiz.pages.practice',compact('grade_data','subject','board_data','test','total','complete','grade_val'));
    }

    }

    public function ContentLibrary($id) {
        $event = Event::find(decrypt($id));
        $round = $event->getEventRound;
        $test = $event->getEventRound->getTest;
//        $test = Test::find(decrypt($id));
        $contents = $test->getContent;
//dd($contents);
        return view('quiz.pages.content')->with(['event' => $event, 'test' => $test, 'contents' => $contents]);
    }

    public function CreateTest($event, $round, $test, $questions, $module, $tid){

        $user_api = $this->apiService->getProfile() ?? null;
        $user_json = json_decode($user_api);
        if(!isset($user_json->data)){
               return redirect('/');
           }else{
        $user = $user_json->data;
//        $test = Test::find(decrypt($id));

        $data = new UserTests();
        $data->temp_id = $tid;
        $data->user_id = $user->id;
        $data->event_id = $event->id;
        $data->round_id = $round->id;
        $data->test_id = $test->id;
        $data->module_id = $module->id;
        $data->status = 1;
        $data->created_by = 1;
        $data->updated_by = 1;
        $data->save();

        foreach($questions as $question) {
//            foreach ($question1 as $question) {
//                dd($question->id);
                $data1 = new UserQuestions();
                $data1->user_test_id = $data->id;
                $data1->user_id = $user->id;
                $data1->question_id = $question->id;
                $data1->score = $question->score;
                $data1->status = 1;
                $data1->created_by = 1;
                $data1->updated_by = 1;
                $data1->save();
//            }
        }

        return $data->id;
    }
    }
    public function olympiad()
    {
        $data = '';
        if(Auth::guard('user')->user() != null)
        {
            $user_api =$this->apiService->getProfile() ?? null;
            $user_json = json_decode($user_api);
            if(!isset($user_json->data)){
               return redirect('/');
           }else{
            $data = $user_json->data;
            // dd($data->getStudent->getParent);
        }
        $subject=Subject::getAllSubject();
        return view('quiz.pages.inquiry',compact('data','subject'));
       }
    }
    public function save_olympiad(Request $request)
    {
    try {
            $validator = Validator::make($request->all(), [
                'attachment' => 'required',
                'subject' => 'required',
                ]);

            if ($validator->fails()) {
                return Redirect::back()
                    ->withErrors($validator)
                    ->withInput();
            }
            if(Auth::guard('user')->user() == null){
                $request['school_id'] =1;
        $password = Str::random(10);
        $request['password'] = Hash::make($password);

        if($request['user_type'] == "student"){
            $user = new User;
            $user->first_name =  $request['fname'];
            $user->last_name =  $request['lname'];
            $user->email =  $request['email'];
            $user->mobile =  $request['mobile'];
            $user->password =  $request['password'];
            $user->user_type =  $request['user_type'];
            $user->remember_token =  $request['_token'];
            $user->save();

            Mail::to($user)->send(new Welcome($user, $password));
            $student = new Student;
            $student->first_name =  $request['fname'];
            $student->last_name  =  $request['lname'];
            $student->user_id    =  $user->id;
            $student->board_id   =  $request['board'];
            $student->grade_id   =  $request['grade'];
            $student->dob        =  $request['dob'];
            $student->school_id  =  $request['school_id'];
            $student->email      =  $request['email'];
            $student->mobile_no  =  $request['mobile'];
            $student->registered_by =  'self';

            $parent = User::where('user_type', 'parent')->where('email', $request['p_email'])->orWhere('mobile', $request['p_mobile'])->get();
            if(isset($parent->id)){
                $parent = $parent->id;
                $student->parent_id = $parent->id;
            }else{

                $ppassword = Str::random(10);
                $request['ppassword'] = Hash::make($ppassword);

                $user1 = new User;
                $user1->first_name =  $request['p_fname'];
                $user1->last_name =  $request['p_lname'];
                $user1->email =  $request['p_email'];
                $user1->mobile =  $request['p_mobile'];
                $user1->password =  $request['ppassword'];
                $user1->user_type =  "parent";
                $user1->save();
//                \Mail::to($user->email)->send(new VerificationEmail($user));
                $student->parent_id = $user->id;
                $parent = $user->id;
            }
            $student->save();

            Mail::to($user1)->send(new Welcome($user1, $ppassword));
            $data = new Olympiad();
                $data->user_id = $user->id;
                $data->parent_id = $parent;
                $data->subject_id = $request->subject;
                $file =$request->attachment;
                $filename   =  time().$file->getClientOriginalName();
                $file->move("dist/olympiad", $filename);
                $data->attachment = $filename;
                $data->save();

            // dd($student)
                }else{
                $user_api = $this->apiService->getProfile() ?? null;
                $user_json = json_decode($user_api);
                if(!isset($user_json->data)){
                return redirect('/');
                }else{
                $user = $user_json->data;
                $data = new Olympiad();
                $data->user_id = $user->id;
                $data->parent_id =$stu->getStudent->getParent->id ;
                $data->subject_id = $request->subject;
                $file =$request->attachment;
                $filename   =  time().$file->getClientOriginalName();
                $file->move("dist/olympiad", $filename);
                $data->attachment = $filename;
                $data->save();

            }
            // dd("2");
            return redirect('olympiad');
        }
            // return $this->redirectToIndex('grade', config('constants.message.save'));
        }
        }catch (\Exception $e) {
            return Redirect::back()
                ->withErrors('Something went wrong. Please try again!')
                ->withInput();
        }

    }

    public function testing(){
        $user_api =  $this->apiService->getProfile() ?? null;
        $user_json = json_decode($user_api);
        if(!isset($user_json->data)){
               return redirect('/');
           }else{
        $user = $user_json->data;
        dd($user);
    }
}

    public function error(){
        return view('errors.error');
    }

}
