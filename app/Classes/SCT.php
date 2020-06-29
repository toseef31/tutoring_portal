<?php
namespace App\Classes;
use DB;
use Session;
use Carbon\Carbon;

class SCT {
  public function checkAggrementSend($aggrement_id,$user_id)
  {
    $aggreement = DB::table('signed_aggreements')->where('aggreement_id',$aggrement_id)->where('user_id',$user_id)->first();
    return $aggreement;
    // dd($aggreement);
  }
  public function GetUser($user_id)
  {
    $user = DB::table('users')->where('id',$user_id)->first();
    return $user;
  }
  public function checkCredit($user_id)
  {
    $user = DB::table('credits')->where('user_id',$user_id)->first();
    return $user;
  }
}

?>
