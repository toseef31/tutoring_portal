<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use DateTime;
use Mail;
class RecursWeeklyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'recursweekly';

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

      // $sessions = DB::table('sessions')->where('recurs_weekly','Yes')->get();
      $sessions = DB::table('sessions')->where('recurs_weekly','Yes')->where('status','End')->get();
      foreach ($sessions as $session) {
        $date1 =date("Y-m-d");
        $date2 = date("Y-m-d", strtotime('+5 days',strtotime($session->date)));
        if ($date1 == $date2) {
          $session_data = DB::table('sessions')->where('session_id',$session->session_id)->first();
          $input['tutor_id'] = $session_data->tutor_id;
          $input['student_id'] = $session_data->student_id;
          $input['user_id'] = $session_data->user_id;
          $input['subject'] = $session_data->subject;
          $input['duration'] = $session_data->duration;
          $input['date'] = date("Y-m-d", strtotime('+7 days',strtotime($session->date)));
          $input['time'] = $session_data->time;
          $input['location'] = $session_data->location;
          $input['session_type'] = $session_data->session_type;
          $input['recurs_weekly'] = $session_data->recurs_weekly;
          $input['status'] = 'Confirm';
          $new_session = DB::table('sessions')->insert($input);
          // dd($session->date,$input);

          // date_default_timezone_set("America/New_York");
          // date_default_timezone_set("Asia/Karachi");

        }
      }


    }
}
