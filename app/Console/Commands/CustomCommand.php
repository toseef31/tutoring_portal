<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use DateTime;
use Mail;
class CustomCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'endsession';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send latest jobs to partner on daily base related to his field';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
    // Check cron job by sending email
    // $get_user = DB::table('users')->where('id',2)->first();
    //   $toemail=$get_user->email;
    //   $name = 'waqas';
    //   $agreement_id = 1;
    //   Mail::send('mail.check_cronjob_email',['user' =>$get_user,'agreement_id'=>$agreement_id],
    //   function ($message) use ($toemail)
    //   {
    //
    //     $message->subject('Smart Cookie Tutors.com - Cron Job Email');
    //     $message->from('admin@SmartCookieTutors.com', 'Smart Cookie Tutors');
    //     $message->to($toemail);
    //   });

      $sessions = DB::table('sessions')->where('status','Confirm')->get();
      foreach ($sessions as $session) {
        $session_date = $session->date;
        $date1 =date("Y-m-d");
        $date2 =$session->date;
        if ($date1 == $date2) {
          // date_default_timezone_set("America/New_York");
          date_default_timezone_set("Asia/Karachi");
          $time1 = date("h:i");
          $time2 = date("h:i", strtotime('+2 hour +30 minutes',strtotime($session->time)));
          // $time2 = date('h:i', strtotime($session->time));
          // $new_time = date("h:i", strtotime('+2 hour +30 minutes'));
          // $new_time2 = date("h:i", strtotime('+2 hour +30 minutes',strtotime($session->time)));

          if ($time1 >= $time2) {
            $input['status'] = 'End';
            DB::table('sessions')->where('session_id',$session->session_id)->update($input);

            // $duration = $session->duration;
            // $credit_data = DB::table('credits')->where('user_id',$session->user_id)->first();
            // $credit_balance = $credit_data->credit_balance;
            // if ($duration == '0:30') {
            //   $credit_balance = $credit_balance-0.5;
            // }elseif ($duration == '1:00') {
            //   $credit_balance = $credit_balance-1;
            // }elseif ($duration == '1:30') {
            //   $credit_balance = $credit_balance-1.5;
            // }elseif ($duration == '2:00') {
            //   $credit_balance = $credit_balance-2;
            // }
            // $input2['credit_balance'] = $credit_balance;
            // DB::table('credits')->where('user_id',$session->user_id)->update($input2);
          }
        }
      }

    }
}
