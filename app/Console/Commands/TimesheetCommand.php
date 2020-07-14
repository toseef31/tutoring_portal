<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use DateTime;
use Mail;
class TimesheetCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sendtimesheets';

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

      $timesheets = DB::table('timesheets')->where('created_at','Like',date('Y-m').'%')->groupby('tutor_id')->get();
      dd($timesheets);
      foreach ($timesheets as $timesheet) {
        $tutor = DB::table('users')->where('id',$timesheet->tutor_id)->first();
        $tutor_timesheets = DB::table('timesheets')
        ->join('sessions','sessions.session_id','=','timesheets.session_id')
        ->where('timesheets.tutor_id',$timesheet->tutor_id)->where('timesheets.created_at','Like',date('Y-m').'%')->get();
        foreach ($tutor_timesheets as &$student) {
          $student->student_name = DB::table('students')->where('student_id',$student->student_id)->first()->student_name;
        }
        // dd($tutor_timesheets);
        $toemail=$tutor->email;
          Mail::send('mail.timesheet_email',['tutor'=>$tutor,'timesheets'=>$tutor_timesheets],
          function ($message) use ($toemail)
          {

            $message->subject('Smart Cookie Tutors.com - Timesheets Email');
            $message->from('admin@SmartCookieTutors.com', 'Smart Cookie Tutors');
            $message->to($toemail);
          });
      }


    }
}
