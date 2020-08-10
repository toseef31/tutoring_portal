<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use DateTime;
use Mail;
use URL;
use App\Facade\SCT;

class SessionReminderCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clientreminder';

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
        // $session_date = $session->date;
        $tutor_timezone = SCT::getClientName($session->tutor_id)->time_zone;
        // dd($tutor_timezone);
        if ($tutor_timezone == 'Pacific Time') {
          date_default_timezone_set("America/Los_Angeles");
        }elseif ($tutor_timezone == 'Mountain Time') {
          date_default_timezone_set("America/Denver");
        }elseif ($tutor_timezone == 'Central Time') {
          date_default_timezone_set("America/Chicago");
        }elseif ($tutor_timezone == 'Eastern Time') {
          date_default_timezone_set("America/New_York");
        }
        // date_default_timezone_set("Asia/Karachi");
        $combinedDT = date('Y-m-d H:i:s', strtotime("$session->date $session->time"));
        $date1 =date("Y-m-d H:i");
        $date2 = date("Y-m-d H:i", strtotime('-30 hours',strtotime($combinedDT)));
        // dd($session->session_id,$date1,$date2);
        if ($date1 == $date2) {
          // dd($date1,$date2);
          $user = DB::table('users')->where('id',$session->user_id)->first();
          $tutor = DB::table('users')->where('id',$session->tutor_id)->first();
          $student = DB::table('students')->where('student_id',$session->student_id)->first();
          $user_credit = DB::table('credits')->where('user_id',$session->user_id)->first();
          $session_data = DB::table('sessions')->where('session_id',$session->session_id)->first();
          // date_default_timezone_set("America/New_York");
          if ($user->automated_email == 'Subscribe') {
          $toemail=$user->email;
            Mail::send('mail.client_session_reminder_email',['user' =>$user,'credit'=>$user_credit,'tutor'=>$tutor,'student'=>$student,'session'=>$session_data],
            function ($message) use ($toemail)
            {

              // $message->subject('Smart Cookie Tutors.com - Session Reminder Email '.date('H:i:s'));
              $message->subject('Smart Cookie Tutors.com - Session Reminder Email');
              $message->from('admin@SmartCookieTutors.com', 'Smart Cookie Tutors');
              $message->to($toemail);
            });
        }
      }
    }
  }
}
