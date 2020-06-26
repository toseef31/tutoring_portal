<?php
namespace App\Classes;
use DB;
use Session;
use Carbon\Carbon;

class SCT {
  public function getParnterName($userId){
    return DB::table('fa_partner')->where('p_id','=',$userId)->first()->name;
  }
  public function checkAggrementSend($aggrement_id,$user_id)
  {
    $aggreement = DB::table('signed_aggreements')->where('aggreement_id',$aggrement_id)->where('user_id',$user_id)->first();
    return $aggreement;
    // dd($aggreement);
  }
}

?>
