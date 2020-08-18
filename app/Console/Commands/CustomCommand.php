<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use DateTime;
use Mail;
use App\Facade\SCT;

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
        $date1 =date("Y-m-d");
        $date2 =$session->date;
        // dd($date1,$date2);
        if ($date1 == $date2) {
          $duration = $session->duration;

          // dd(date("h:i a"));
          // date_default_timezone_set("Asia/Karachi");
          $time1 = date("h:i a");
          // $time2 = date("h:i a", strtotime('+2 hour +30 minutes',strtotime($session->time)));
          if ($duration == '0:30') {
            $time2 = date("h:i a", strtotime('+30 minutes',strtotime($session->time)));
          }elseif ($duration == '1:00') {
            $time2 = date("h:i a", strtotime('+1 hour',strtotime($session->time)));
          }elseif ($duration == '1:30') {
            $time2 = date("h:i a", strtotime('+1 hour +30 minutes',strtotime($session->time)));
          }elseif ($duration == '2:00') {
            $time2 = date("h:i a", strtotime('+2 hours',strtotime($session->time)));
          }
          // dd($time1,$time2);
          // $time2 = date("h:i a", strtotime('+3 hour',strtotime($session->time)));
          // dd($session->session_id,$time1,$time2);
          if ($time1 >= $time2) {
            $input['status'] = 'End';
            DB::table('sessions')->where('session_id',$session->session_id)->update($input);

          }
        }
      }

    }
}
