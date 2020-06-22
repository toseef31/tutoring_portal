<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Carbon;
use App\Facade\FA;
use Mail;
use DateTime;

class JobManageController extends Controller
{
  public function admin_dashboard(Request $request)
  {
      $total_admin = DB::table('fa_admin')->get()->count();
      $total_partner = DB::table('fa_partner')->get()->count();
      $actvice_partner = DB::table('fa_partner')->where('status','Online')->get()->count();
      $quote_won = DB::table('fa_quote')->where('status','Won')->get()->count();
      $quote_pending = DB::table('fa_quote')->where('status','Pending')->get()->count();
      $daily_earning = DB::table('fa_payments')->where('created_at',Carbon\Carbon::now())->sum('amount');
      // dd($daily_earning);
      return view('admin.index',compact('total_admin','total_partner','actvice_partner','quote_won','quote_pending','daily_earning'));
  }

    public function index()
    {
       $alljobs = DB::table('fa_jobpost')->where('job_status','=', 'open')->orderBy('id','desc')->get();
       return view('/admin.job_management',compact('alljobs'));
    }
    public function closed_jobs()
    {
      // $date=date('Y-m-d H:i:s', strtotime('-5 days'));
       // $alljobs = DB::table('fa_jobpost')->where('quote_time','<', $date)->orderBy('id','desc')->get();
       $alljobs = DB::table('fa_jobpost')->where('job_status','=', 'closed')->orderBy('id','desc')->get();
       // dd($alljobs);
       return view('/admin.closed_jobs',compact('alljobs'));
    }
    public function repost_job($id)
    {
      $datetime1 = new DateTime();
      $date=date('Y-m-d H:i:s');
      $input['quote_time'] =$date;
      $input['job_status'] ='open';
      // dd($input);
      $job = DB::table('fa_jobpost')->where('id',$id)->update($input);
      echo $job;
    }
    public function all_admin()
    {
       $all_admin = DB::table('fa_admin')->where('role','<>','admin')->orderBy('id','desc')->get();
       // dd($all_admin);
       return view('/admin.view_admin',compact('all_admin'));
    }
    public function view_certification()
    {
       $certifications = DB::table('fa_partner_cv')->orderBy('cv_id','desc')->get();
       // dd($certifications);
       return view('/admin.certifications',compact('certifications'));
    }
    public function addEditAdmin(Request $request){
      // dd($request->all());
      $userId = 0;
        $rPath = $request->segment(3);
        if($request->isMethod('post')){
            // dd($request->all());
            $userId = $request->input('user_Id');
            $this->validate($request, [
                'name' => 'required|max:100',
                'email' => 'required|email|max:255',
            ]);
            if($userId == '0'){
                $this->validate($request, [
                    'password' => 'required|min:6|max:16',
                    'email' => 'required|email|max:255|unique:fa_admin',
                ]);
            }else{

                $isEmailExist = FA::isEmailExist($request->input('user_email'),$userId);
                if($isEmailExist){
                    $request->session()->flash('alert',['message' => 'The email has already been taken.', 'type' => 'danger']);
                    return redirect(url()->previous());
                }
            }
            $input = array();


            $input['name'] = $request->input('name');
            $input['email'] = $request->input('email');
            if($request->input('password') != '' && $request->input('password') != NULL){
                $input['password'] = md5($request->input('password'));
            }
            $input['role'] = $request->input('role');
            // $input['updated_at'] = date('Y-m-d H:i:s');
            // dd($userId);
            if($userId == ''){
                $input['created_at'] = date('Y-m-d H:i:s');

                $userId = DB::table('fa_admin')->insertGetId($input);
                $sMsg = 'New Admin Added';
            }else{
              // dd($input);
                DB::table('fa_admin')->where('id', $userId)->update($input);
                $sMsg = 'Admin Updated';
            }
            $request->session()->flash('alert',['message' => $sMsg, 'type' => 'success']);
            return redirect('dashboard/view_admin');
        }else{
            $user = array();
            $userId = '0';
            if($rPath == 'edit'){
                $userId = $request->segment(4);
                $user = FA::getAdmin($userId);
                // dd($user);
                if(count($user) == 0){
                    $request->session()->flash('alert',['message' => 'No Record Found', 'type' => 'danger']);
                    return redirect('dashboard/view_admin');
                }
                $user = (array) $user;
            }
            return view('admin.add-edit-admins',compact('user','rPath','userId'));
        }
    }
    public function deleteAdmin($id)
    {
      // dd($id);
      $admin = DB::table('fa_admin')->where('id',$id)->delete();
      return redirect('/dashboard/view_admin');
    }
    public function blogs()
    {
       $alljobs = DB::table('fa_jobpost')->orderBy('id','desc')->get();
       $allblogs = DB::table('fa_blogs')->orderBy('id','desc')->get();
       return view('/admin.blogs',compact('alljobs','allblogs'));
    }

     public function admin_login(Request $request)
    {
         if ($request->session()->exists('fa_admin')) {
            return redirect('/dashboard');
        }


		if($request->isMethod('post')){
//dd($request->all());
//            $user_type = $request->input('user_type');


           $email = $request->input('email');
            $password = md5(trim($request->input('password')));


            // /dd($password);

			$user = $this->doLogin($email,$password);
			if($user == 'invalid'){
				$request->session()->flash('loginAlert', 'Invalid Email & Password');

					return redirect('admin/login');

			}
			else{

				$request->session()->put('fa_admin', $user);
				setcookie('cc_data', $user->id, time() + (86400 * 30), "/");



					return redirect('dashboard');

			}


		}
        return view('/admin.login-page');
    }

    public function doLogin($email,$password){
        /* do login */
        //dd($password);
        $user = DB::table('fa_admin')->where('email','=',$email)->where('password','=',$password)->first();

        if(empty($user)){
            return 'invalid';
        }else{
            return $user;
        }
		/* end */
	}

 public function logout(Request $request){
         //Session::flush();
         Session::forget('fa_admin');
         return redirect('admin/login');
        }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
public function template(Request $request, $id)
    {
      // dd($request->all());
        if($request->isMethod('post')){
            $this->validate($request, [
                'phone_number' => 'required',
                'email' => 'required',
                'location'=>'required',
                'mbl_number' => 'required|digits_between:10,12',
                'business_address' => 'required',
                'phone_number' => 'required',
                'company_name' => 'required'

            ],[
                'phone_number.required'=>'Enter your phone number',
                'email.required' => 'Enter valid email',
                'location.required' => 'Enter your location',
                'mbl_number.required' =>'Enter Your Mobile Number',
                'business_address.required' => 'Enter business address ',
                'phone_number.required'=>'Enter mobile number',
                'mbl_number.digits_between' => 'mobile Number must be contain 10,12 digits',
                'company_name' => 'Enter company name',
            ]);

            $request->merge(['job_id' => $id]);
            $request->merge(['service_needed' => @json_encode($request->input('service_needed'))]);
            $request->merge(['service_required' => @json_encode($request->input('service_required'))]);
           // dd($data);
           $res= DB::table('fa_user_template')->where('job_id',$id)->first();
          // dd($request->all());
            if(empty($res))
            {
                $temp = DB::table('fa_user_template')->insert($request->all());
            }
            else
            {
                $temp = DB::table('fa_user_template')->where('job_id',$id)->update($request->all());
            }

        DB::table('fa_jobpost')->where('id',$id)->update(['status'=>'1']);
       //dd($request->all());
            $request->session()->flash('message','Detail added successfully');
            return redirect()->back();
        }

          $autofil=DB::table('fa_jobpost')->where('id',$id)->first();
        $template=DB::table('fa_user_template')->where('job_id',$id)->first();
          // dd($template);
        $job = DB::table('fa_jobpost')->where('id',$id)->first();
        // dd($job);
       return view('/admin.add_template',compact('job','template','autofil'));
    }
    public function visit(Request $request)
    {
        $id=$request->all();

        $allquote1=DB::table('fa_jobpost')->where('id',$id['visit_id'])->update(['visited'=>'visited']);

		$allquote = DB::table('fa_jobpost')->select('fa_quote.*','fa_jobpost.services','fa_jobpost.city','fa_jobpost.job_title','fa_jobpost.customer_name','fa_jobpost.mobilenumber','fa_jobpost.city','fa_jobpost.job_case','fa_jobpost.job_type')->join('fa_quote','fa_quote.job_id','=','fa_jobpost.id')->orderBy('fa_quote.id','desc')->paginate(15);
       foreach($allquote as &$ser){

            $ser->partner = DB::table('fa_partner')->where('p_id','=',$ser->p_id)->first();
         }

        return $allquote;

    }
     public function showtemplate()
    {
        $template=DB::table('fa_template')
        ->join('fa_jobpost','fa_jobpost.id','=','fa_template.job_id')
        ->orderBy('fa_template.temp_id','desc')->get();
       // dd($template);
        return view('/admin.make_template',compact('template'));
    }

    public function quotes()
    {
       $allquote = DB::table('fa_jobpost')->select('fa_jobpost.id','fa_jobpost.services','fa_jobpost.visited','fa_jobpost.city','fa_jobpost.job_title','fa_jobpost.customer_name','fa_jobpost.mobilenumber','fa_jobpost.city','fa_jobpost.job_case','fa_jobpost.job_type','fa_jobpost.status_from_admin','fa_jobpost.outcome','fa_jobpost.admin_comment','fa_jobpost.admin_update','fa_jobpost.admin_id')->where('quote_status','1')->orderBy('fa_jobpost.id','desc')->groupBy('fa_jobpost.id')->paginate(15);
       foreach($allquote as &$ser){

            $ser->qoutes = DB::table('fa_quote')->where('job_id','=',$ser->id)->orderBy('id','desc')->get();

	   foreach($ser->qoutes  as &$qoute){

            $qoute->partner = DB::table('fa_partner')->where('p_id','=',$qoute->p_id)->first();
         }

         }
       // dd( $allquote);
        return view('/admin.quotes',compact('allquote'));
    }
    public function pending_quotes()
    {
       $allquote = DB::table('fa_jobpost')->select('fa_jobpost.id','fa_jobpost.services','fa_jobpost.visited','fa_jobpost.city','fa_jobpost.job_title','fa_jobpost.customer_name','fa_jobpost.mobilenumber','fa_jobpost.city','fa_jobpost.job_case','fa_jobpost.job_type','fa_jobpost.status_from_admin','fa_jobpost.outcome','fa_jobpost.admin_comment','fa_jobpost.admin_update','fa_jobpost.admin_id')->where('quote_status','1')->orderBy('fa_jobpost.id','desc')->groupBy('fa_jobpost.id')->paginate(15);

            $quotes = DB::table('fa_quote')->where('count_status','=','In Active')->orderBy('id','desc')->get();

	   foreach($quotes  as &$qoute){

            $qoute->partner = DB::table('fa_partner')->where('p_id','=',$qoute->p_id)->first();
         }

       // dd($quotes);
        return view('admin.pending_quotes',compact('quotes'));
    }
    public function change_quote_satus($id)
    {
      $quote = DB::table('fa_quote')->where('id',$id)->first();
      $input['count_status'] = 'Active';
      $getemail= DB::table('fa_jobpost')->where('id',$quote->job_id)->first();
      $toemail=$getemail->job_email;
      // dd($quote,$getemail);
      $update_quote = DB::table('fa_quote')->where('id',$id)->update($input);

      Mail::send('mail.sendmailtocustomer',['parnter'=>$quote->p_id,'q_id'=>$quote->id,'job_id'=>$quote->job_id,'u_name' =>$getemail->customer_name,'quote'=>$quote->quote,'services'=> $quote->q_services,'payment_frquency'=> $quote->payment_frquency,'quote_price' => $quote->quote_price],

    function ($message) use ($toemail)
    {

      $message->subject('Experlu.com - Welcome To Experlu');
      $message->from('searchbysearchs@gmail.com', 'Experlu');
      $message->to($toemail);
    });
    echo $update_quote;

    }


    public function post_portal(Request $request)
    {
        $id=$request->input('job_id');
        $value=$request->input('value');
       // dd($request->all());
        $allquote = DB::table('fa_jobpost')->where('id',$id)->update(['post_portal'=>$value]);
        return $allquote;
    }
  public function mark(Request $request)
    {
        $id=$request->input('id');
        $value=$request->input('value');

         $quotedata= DB::table('fa_quote')->where('id',$id)->update(['mark'=>$value]);
  return $quotedata;
   }
   public function jobstatus_update(Request $request,$id)
    {
        $admin_data=$request->session()->get('fa_admin')->name;
        //dd($admin_data);
        if ($request->isMethod('post')) {
            $request->merge(['admin_id' => $admin_data]);
            $request->merge(['admin_update' => date("Y-m-d h:i")]);
           // dd($request->all());
            $allquote = DB::table('fa_jobpost')->where('id',$id)->update($request->all());
            return redirect('dashboard/quotes');
    }
    $update = DB::table('fa_jobpost')->select('outcome','status_from_admin','admin_comment')->where('id',$id)->first();
//dd($update);
        return view('/admin.job_update',compact('update'));
   }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        DB::table('fa_jobpost')->where('id',$id)->delete();
        DB::table('fa_template')->where('job_id',$id)->delete();
        $request->session()->flash('message','Job deleted successfully');
        return redirect()->back();
    }
    public function get_quote_status(Request $request)
    {
      $pending = DB::table('fa_quote')->where('status','Pending')->get()->count();
      $won = DB::table('fa_quote')->where('status','Won')->get()->count();
      $rejected = DB::table('fa_quote')->where('status','Loss')->get()->count();
      $obj = array(
        "pending" => $pending,
        "won"=> $won,
        "rejected"=> $rejected
      );
      // dd($obj);

      echo json_encode($obj);
    }
    public function get_partners(Request $request)
    {
      $nov = DB::table('fa_partner')->where('created_at','>=','2019-10-31')->where('created_at','<=','2019-11-30')->get()->count();
      $dec = DB::table('fa_partner')->where('created_at','>=','2019-11-30')->where('created_at','<=','2019-12-31')->get()->count();
      $jan = DB::table('fa_partner')->where('created_at','>=','2019-12-31')->where('created_at','<=','2020-01-31')->get()->count();
      $feb = DB::table('fa_partner')->where('created_at','>=','2020-01-31')->where('created_at','<=','2020-02-29')->get()->count();
      $mar = DB::table('fa_partner')->where('created_at','>=','2020-02-29')->where('created_at','<=','2020-03-31')->get()->count();
      $apr = DB::table('fa_partner')->where('created_at','>=','2020-03-31')->where('created_at','<=','2020-04-30')->get()->count();
      $may = DB::table('fa_partner')->where('created_at','>=','2020-04-30')->where('created_at','<=','2020-05-31')->get()->count();
      $jun = DB::table('fa_partner')->where('created_at','>=','2020-05-31')->where('created_at','<=','2020-06-30')->get()->count();
      $jul = DB::table('fa_partner')->where('created_at','>=','2020-06-30')->where('created_at','<=','2020-07-31')->get()->count();
      $aug = DB::table('fa_partner')->where('created_at','>=','2020-07-31')->where('created_at','<=','2020-08-31')->get()->count();
      $sep = DB::table('fa_partner')->where('created_at','>=','2020-08-31')->where('created_at','<=','2020-09-30')->get()->count();
      $oct = DB::table('fa_partner')->where('created_at','>=','2020-09-30')->where('created_at','<=','2020-10-31')->get()->count();
      // dd($dec);
      $obj = array(
        "nov" => $nov,
        "dec" => $dec,
        "jan" => $jan,
        "feb"=> $feb,
        "mar"=> $mar,
        "apr"=> $apr,
        "may"=> $may,
        "jun"=> $jun,
        "jul"=> $jul,
        "aug"=> $aug,
        "sep"=> $sep,
        "oct"=> $oct
      );
      // dd($obj);

      echo json_encode($obj);
    }

    public function get_payments(Request $request)
    {
      // Quotation Charges
      $jan = DB::table('fa_payments')->where('payment_type','Quotation')->where('created_at','>=','2019-12-31')->where('created_at','<=','2020-01-31')->sum('amount');
      $feb = DB::table('fa_payments')->where('payment_type','Quotation')->where('created_at','>=','2020-01-31')->where('created_at','<=','2020-02-29')->sum('amount');
      $mar = DB::table('fa_payments')->where('payment_type','Quotation')->where('created_at','>=','2020-02-29')->where('created_at','<=','2020-03-31')->sum('amount');
      $apr = DB::table('fa_payments')->where('payment_type','Quotation')->where('created_at','>=','2020-03-31')->where('created_at','<=','2020-04-30')->sum('amount');
      $may = DB::table('fa_payments')->where('payment_type','Quotation')->where('created_at','>=','2020-04-30')->where('created_at','<=','2020-05-31')->sum('amount');
      $jun = DB::table('fa_payments')->where('payment_type','Quotation')->where('created_at','>=','2020-05-31')->where('created_at','<=','2020-06-30')->sum('amount');
      $jul = DB::table('fa_payments')->where('payment_type','Quotation')->where('created_at','>=','2020-06-30')->where('created_at','<=','2020-07-31')->sum('amount');
      $aug = DB::table('fa_payments')->where('payment_type','Quotation')->where('created_at','>=','2020-07-31')->where('created_at','<=','2020-08-31')->sum('amount');
      $sep = DB::table('fa_payments')->where('payment_type','Quotation')->where('created_at','>=','2020-08-31')->where('created_at','<=','2020-09-30')->sum('amount');
      $oct = DB::table('fa_payments')->where('payment_type','Quotation')->where('created_at','>=','2020-09-30')->where('created_at','<=','2020-10-31')->sum('amount');
      $nov = DB::table('fa_payments')->where('payment_type','Quotation')->where('created_at','>=','2020-10-31')->where('created_at','<=','2020-11-30')->sum('amount');
      $dec = DB::table('fa_payments')->where('payment_type','Quotation')->where('created_at','>=','2020-11-30')->where('created_at','<=','2020-12-31')->sum('amount');

      // Memeber ship
      $jans = DB::table('fa_payments')->where('payment_type','Membership')->where('created_at','>=','2019-12-31')->where('created_at','<=','2020-01-31')->sum('amount');
      $febs = DB::table('fa_payments')->where('payment_type','Membership')->where('created_at','>=','2020-01-31')->where('created_at','<=','2020-02-29')->sum('amount');
      $mars = DB::table('fa_payments')->where('payment_type','Membership')->where('created_at','>=','2020-02-29')->where('created_at','<=','2020-03-31')->sum('amount');
      $aprs = DB::table('fa_payments')->where('payment_type','Membership')->where('created_at','>=','2020-03-31')->where('created_at','<=','2020-04-30')->sum('amount');
      $mays = DB::table('fa_payments')->where('payment_type','Membership')->where('created_at','>=','2020-04-30')->where('created_at','<=','2020-05-31')->sum('amount');
      $juns = DB::table('fa_payments')->where('payment_type','Membership')->where('created_at','>=','2020-05-31')->where('created_at','<=','2020-06-30')->sum('amount');
      $juls = DB::table('fa_payments')->where('payment_type','Membership')->where('created_at','>=','2020-06-30')->where('created_at','<=','2020-07-31')->sum('amount');
      $augs = DB::table('fa_payments')->where('payment_type','Membership')->where('created_at','>=','2020-07-31')->where('created_at','<=','2020-08-31')->sum('amount');
      $seps = DB::table('fa_payments')->where('payment_type','Membership')->where('created_at','>=','2020-08-31')->where('created_at','<=','2020-09-30')->sum('amount');
      $octs = DB::table('fa_payments')->where('payment_type','Membership')->where('created_at','>=','2020-09-30')->where('created_at','<=','2020-10-31')->sum('amount');
      $novs = DB::table('fa_payments')->where('payment_type','Membership')->where('created_at','>=','2020-10-31')->where('created_at','<=','2020-11-30')->sum('amount');
      $decs = DB::table('fa_payments')->where('payment_type','Membership')->where('created_at','>=','2020-11-30')->where('created_at','<=','2020-12-31')->sum('amount');

      // dd($dec);
      $obj = array(
        "jan" => $jan,
        "feb"=> $feb,
        "mar"=> $mar,
        "apr"=> $apr,
        "may"=> $may,
        "jun"=> $jun,
        "jul"=> $jul,
        "aug"=> $aug,
        "sep"=> $sep,
        "oct"=> $oct,
        "nov" => $nov,
        "dec" => $dec,
        "jans" => $jans,
        "febs"=> $febs,
        "mars"=> $mars,
        "aprs"=> $aprs,
        "mays"=> $mays,
        "juns"=> $juns,
        "juls"=> $juls,
        "augs"=> $augs,
        "seps"=> $seps,
        "octs"=> $octs,
        "novs" => $novs,
        "decs" => $decs,
      );
      // dd($obj);

      echo json_encode($obj);
      // echo $data2;
    }
}
