<?php

namespace App\Http\Controllers\Quiz;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ApiOnlineService;

class QuizController extends Controller
{
   private $apiService;

    public function __construct(ApiOnlineService $apiService)
    {
        $this->apiService = $apiService;
    }
   public function index(){
     
    // echo session()->get('access_token');exit;
         $user_det_api =  $this->apiService->getProfile() ;
        $test=json_decode($user_det_api);
       
        $testlist=array();
        if(@$test->data && @$test->code==200 ){ 
     $testlist=$test->data;
    
     


	    return view('quiznew.pages.index',compact('testlist'));
        }elseif(@$test->code==404){ 
          
          return view('quiznew.pages.index',compact('testlist'));
    
        }
           else{
             echo $test->message;
        }
   }
   public function question($id){
     
      $platform=2;
      $questions=$this->apiService->getQuestion($id);
      $questions=$questions->data;
     //echo "<pre>";print_r($questions);exit;
     if($questions){ 
      return view('quiznew.pages.question',compact('questions','id'));
     }else{
      echo $questions->message;
     }
    
   }
   public function SubmitQuestion(Request  $request){
      $data['option_id']=$request->option_id;
      $data['test_id']=$request->test_id;
      $data['user_question_id']=$request->uq_id;
      $data['question_id']=$request->q_id;
      $data['etime']=$request->etime;
      $data['rtime']=$request->rtime;
      $data['mil']=$request->mil;
      $id=$request->test_id;
      $data['user_test_id']=$request->user_test_id;
      
      $user_test_id=$request->user_test_id;
      $submitQ=$this->apiService->submitQuestion($data);
       if(@$submitQ->data)
      {
      $questions=$submitQ->data;
     
         return view('quiznew.pages.questionajax',compact('questions','id'));
      }
      else
      return false;

   }
   public function CheckAnswer(Request $request )
   {
      $data['question_id']=$request->q_id;
      $data['option_id']=$request->option_id;
      $optionStatus=$this->apiService->checkAnswer($data);
      $answer_stat=$optionStatus->data;
if($answer_stat->answer_status=='correct'){
   return true;
}
else{
   return false;
}

   }
   public function instruction(Request $request){
     
      $id=$request->id;
     echo  $testinstruction =  $this->apiService->getinstruction($id) ;
   }
   public function SkipQuestion(Request $request){
    
      $data['test_id']=$request->test_id;
      $data['user_question_id']=$request->uq_id;
      $data['question_id']=$request->q_id;
      $data['status']=$request->status;;
      $id=$request->test_id;
      $data['user_test_id']=$request->user_test_id;
 
      $skipQ=$this->apiService->skipQuestion($data);
      //print_r($skipQ);exit;
 
      $user_test_id=$request->user_test_id;
       if(@$skipQ->data)
      {
      $questions=$skipQ->data;
     
     
         return view('quiznew.pages.questionajax',compact('questions','id'));
      }
      else
 //     return redirect(route('quiz.test-summary', ['ID' => $user_test_id]));
 return false;
      
   }
   public function points($id){
   
      $score = $this->apiService->totalscore($id);
     
      $total_score = $score->data->score;
      $correct_answers= $score->data->correct_answers;
      $total_questions= $score->data->total_questions;
      $userpoints = $score->data->userpoints;
      return view('quiznew.pages.points',compact('total_score','correct_answers','total_questions','id','userpoints'));
}

public function testsummary($id){
     
     $score =$this->apiService->totalscore($id);
    
     $total_score = $score->data->score;
     $total_questions= $score->data->total_questions;
     $correct_answers= $score->data->correct_answers;
     $result = $this->apiService->testresult($id);
     $test_summary = $result->data;
     $userpoints = $score->data->userpoints;
    // echo "<pre>";
    // print_r($test_summary);exit;
     return view('quiznew.pages.testsummary',compact('test_summary','total_score','total_questions','correct_answers','userpoints'));
}
}
