<?php

namespace App;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ApiOnlineService
{
    function http()
    {
        return Http::withHeaders([
            'Accept' => 'application/json',
            'X-Api-Key' => env('API_KEY'),
            'Authorization' => 'Bearer '.session()->get("access_token")
              ])->baseUrl(env('JKSHAH_QUIZ_API'));
           
        }
  function getProfile()
  {
   $data['platform']=2;
    return $data= $this->http()->get( 'testList',$data);

//   $response = Http::withHeaders([
    
//     'Accept' => 'application/json',
//     'X-Api-Key' => 'KB5fQKyxvtJgoSlWqGWx1ic8nUx04LKu',
//     'Authorization' => 'Bearer '.session()->get("access_token")
// ])->get('localhost/jkshah_quiz/public/api/testListapi', [
//     'platform' => '2',
// ]);
//      return $response;
  }
  function getinstruction($id) {
    $data['platform']=2;
    $data['test_id']=$id;
    return $data= $this->http()->get( 'instructionByTestId',$data);

  }
  function getQuestion($id)
  {
    $data["test_id"]=$id;
      $data["platform"]=2;
    $data=$this->http()->get('questionByTestId',$data);
    return json_decode($data);
  }
  function checkAnswer($data)
  {
    $data['platform']=2;
    $optionStat=$this->http()->post('checkAnswer',$data);
    return json_decode($optionStat);
  }
  function submitQuestion($data)
  {
    $data['platform']=2;
   $q_submit=$this->http()->post('SubmitQuestion',$data);
    return json_decode($q_submit);
  }
  function skipQuestion($data){
    $data['platform']=2;
     $q_skip=$this->http()->post('SkipQuestion',$data);

    return json_decode($q_skip);
  }
  function testresult($id){
    $data['platform']=2;
    $data['user_test_id']=$id;
    $data = $this->http()->get('SummaryOfTest',$data);
    return json_decode($data);
}

function totalscore($id){
  $data['platform']=2;
  $data['user_test_id']=$id;
    $data = $this->http()->get('Totalpoints',$data);
  //echo "<pre>";print_r(json_decode($data));exit;
    return json_decode($data);
}

}