<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Student;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Hash;
use Mail;
use Redirect;

class RegisterController extends Controller
{
      use AuthenticatesUsers;
      protected $redirectTo = '/user-portal';

      // public function __construct()
      // {
      //     $this->middleware('guest')->except('logout');
      // }

      public function accountLogin(Request $request){
         return view('frontend.login');
     }

      public function username(){
          return 'email';
      }


      public function register(Request $request){

        // dd($request->all());

          if($request->session()->has('User')){
        return redirect('user-portal');
      }

          if($request->isMethod('post')){
        // dd($request->all());

          $mobile = str_replace(' ', '', $request->input('phone'));
             // dd($mobile);

          // $numbers = Number::where('num_id',$request->input('choice_number'))->first();



        $this->validate($request,[
          'first_name' => 'required|min:1|max:50',
          'last_name' => 'required|min:2|max:32',
          'email' => 'required|email|unique:users,email',
          'phone' => 'required',
          'address' => 'required',
          'captcha' => 'required|captcha',
          'password' => 'required|min:5|max:50'

        ],[

          'first_name.required' =>'Enter First Name',
          'email.unique' => 'Email must be unique',
          'email.required' => 'Enter Email',
          'last_name.required' => 'Enter Last Name',
          'address.required' => 'Enter Address',
          'password.required' => 'Enter password',
          'phone.required' => 'Enter Phone Number',
          // 'captcha.captcha' => 'Invalid Captcha',
          'phone.digits_between' => 'Phone Number must be contain 10,17 digits',
              ]);
              $string = rand(1, 1000000);

              $input['first_name'] = trim($request->input('first_name'));
              $input['last_name'] = trim($request->input('last_name'));
              $input['email'] = trim($request->input('email'));

              $input['password'] =Hash::make(trim($request->input('password')));
              $input['phone'] = trim($mobile);
              $input['address'] = trim($request->input('address'));
              $input['city'] = trim($request->input('city'));
              $input['state'] = trim($request->input('state'));
              $input['zip'] = trim($request->input('zip'));
              $input['status'] ='active';
              $input['role'] ='customer';
              // $input['verify_code'] =$string;
             $userId = DB::table('users')->insertGetId($input);
             // save student
             $student = new Student;
             $input2['student_name'] = trim($request->input('student_name'));
             $input2['user_id'] = $userId;
             $input2['email'] = trim($request->input('student_email'));
             $input2['college'] = trim($request->input('college'));
             $input2['college'] = trim($request->input('college'));
             $input2['subject'] = trim($request->input('subject'));
             $input2['grade'] = trim($request->input('grade'));
             $input2['goal'] = trim($request->input('goal'));
             $student_id = DB::table('students')->insertGetId($input2);

             $admins = User::where('role','admin')->get();
             $new_user = User::find($userId);
             $new_student = Student::find($student_id);
             foreach ($admins as $admin) {
               $toemail =  $admin->email;
               // dd($toemail);
               Mail::send('mail.new_user_email',['user' =>$new_user, 'student'=> $new_student],
               function ($message) use ($toemail)
               {

                 $message->subject('Smart Cookie Tutors.com - New User Registered');
                 $message->from('admin@SmartCookieTutors.com', 'Smart Cookie Tutors');
                 $message->to($toemail);
               });
             }
             $request->session()->flash('registerSuccess',"Registration Successfull");

              // setcookie('cc_data', $userId, time() + (86400 * 30), "/");
              // $fNotice = 'Please check your mobile for verification code';
        // $request->session()->flash('fNotice',$fNotice);
              return redirect('login');
          }
          // $numbers = Number::where('status','0')->get();
          $numbers = '';
      return view('frontend.register',compact('numbers'));
      }

      function checklogin(Request $request){

         $this->validate($request, [
             'email' => 'required',
             'password' => 'required',
         ]);
         $user_data = array(
             'email'  => $request->get('email'),
             'password' => $request->get('password'),
             'status' => 'active'
         );

         if(!Auth::attempt($user_data)){
             // $fNotice = 'Please check your mobile for verification code';
 			$request->session()->flash('loginAlert', 'Invalid Email & Password');
             return redirect('login');
         }

         if ( Auth::check() ) {
           if ($request->session()->has('previous_url')) {
             $url =$request->session()->get('previous_url');
             session()->forget('previous_url');
             return redirect($url);
           } else {
             if (Auth::user()->role == 'tutor') {
               return redirect('user-portal/manage-profile-tutor');
             }else {
               return redirect('user-portal/manage-profile');
             }
           }
         }
     }

     public function refreshCaptcha($value='')
     {
       return captcha_img('math');
     }

     function logout(){
            Auth::logout();
            return redirect('login');
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
    public function destroy($id)
    {
        //
    }
}
