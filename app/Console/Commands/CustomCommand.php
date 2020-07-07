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
    $get_user = DB::table('users')->where('id',2)->first();
      $toemail=$get_user->email;
      $name = 'waqas';
      $agreement_id = 1;
      Mail::send('mail.check_cronjob_email',['user' =>$get_user,'agreement_id'=>$agreement_id],
      function ($message) use ($toemail)
      {

        $message->subject('Smart Cookie Tutors.com - New Agreement Available for Review');
        $message->from('admin@SmartCookieTutors.com', 'Smart Cookie Tutors');
        $message->to($toemail);
      });

      // \Log::info('waqas is here');
      // $jobs = DB::table('fa_jobpost')->where('id','=','103')->where('status','1')->where('post_portal','Yes')->where('quote_time','<>',null)->first();
      // $datetime1 = new DateTime();
      // $datetime2 = new DateTime($jobs->quote_time);
      // $interval = $datetime1->diff($datetime2);
      // dd($interval);


    }
}
