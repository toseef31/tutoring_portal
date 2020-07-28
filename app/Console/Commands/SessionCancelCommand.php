<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use DateTime;
use Mail;
use URL;
use App\Facade\SCT;

class SessionCancelCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sessioncancel';

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
    // sadasd
      $sessions = DB::table('sessions')->where('status','Confirm')->groupby('tutor_id')->get();
      foreach ($sessions as $session) {
        $tutor_timezone = SCT::getClientName($session->tutor_id)->time_zone;
        if ($tutor_timezone == 'Pacific Time') {
          date_default_timezone_set("America/Los_Angeles");
        }elseif ($tutor_timezone == 'Mountain Time') {
          date_default_timezone_set("America/Denver");
        }elseif ($tutor_timezone == 'Central Time') {
          date_default_timezone_set("America/Chicago");
        }elseif ($tutor_timezone == 'Eastern Time') {
          date_default_timezone_set("America/New_York");
        }
        $client_sessions = DB::table('sessions')->where('user_id',$session->user_id)->where('status','Confirm')->get();
        foreach ($client_sessions as $csession) {
          $combinedDT = date('Y-m-d H:i:s', strtotime("$csession->date $csession->time"));
          $date1 =date("Y-m-d H:i");
          $date2 = date("Y-m-d H:i", strtotime('-24 hours',strtotime($combinedDT)));
          // dd($date1,$date2);
          if ($date1 >= $date2) {
            // dd($date1,$date2);
            $user_credit = DB::table('credits')->where('user_id',$csession->user_id)->first();
            if ($user_credit->credit_balance <= 0) {
              // dd("no credit");
              $input['status'] = 'Insufficient Credit';
              $input['cancel_status'] = 'send';
              DB::table('sessions')->where('session_id',$csession->session_id)->update($input);
          }
        }
      }
      $session_data = DB::table('sessions')->where('tutor_id',$session->tutor_id)->where('date','>=',date("Y-m-d"))->where('status','Insufficient Credit')->where('cancel_status','=',null)->get();
        // dd(count($session_data));

        // date_default_timezone_set("Asia/Karachi");

        // dd($session->session_id,$date1,$date2,$session->date);
        if (count($session_data) > 0) {
          // dd($date1,$date2);
          $user = DB::table('users')->where('id',$session->user_id)->first();
          $tutor = DB::table('users')->where('id',$session->tutor_id)->first();
          $student = DB::table('students')->where('student_id',$session->student_id)->first();
          $user_credit = DB::table('credits')->where('user_id',$session->user_id)->first();
          $toemail=$tutor->email;
            Mail::send('mail.insufficient_credit_email',['user' =>$user,'credit'=>$user_credit,'tutor'=>$tutor,'student'=>$student,'sessions'=>$session_data],
            function ($message) use ($toemail)
            {

              $message->subject('Smart Cookie Tutors.com - Session Cancel Email');
              $message->from('admin@SmartCookieTutors.com', 'Smart Cookie Tutors');
              $message->to($toemail);
            });

      }
     }
    }
}
