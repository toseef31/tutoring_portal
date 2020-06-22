<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Student;
use Hash;
use DB;
use Mail;
use Session;

class AdminController extends Controller
{

    use AuthenticatesUsers;
    protected $redirectTo = '/dashboard';

    public function __construct()
    {
        $this->middleware('admin')->except('logout');
    }

    public function accountLogin(Request $request){
       return view('frontend.login');
    }

    public function username(){
        return 'email';
    }

    public function admin_login(Request $request)
    {
    if($request->isMethod('post')){
      // dd($request->all());
      $this->validate($request, [
        'email' => 'required',
        'password' => 'required',
      ]);

      $user_data = array(
        'email'  => $request->get('email'),
        'password' => $request->get('password'),
        'role' => 'admin'
      );

      if(!Auth::attempt($user_data)){
        // $fNotice = 'Please check your mobile for verification code';
        $request->session()->flash('loginAlert', 'Invalid Email & Password');
        return redirect('admin/login');
      }
      if ( Auth::check() ) {
        // dd(Auth::user());
      }
      return redirect('dashboard');
      }
      return view('admin.login-page');
    }

    public function all_admin(Request $request)
    {
      $all_admin = User::where('role','admin')->orderBy('id','desc')->get();
       return view('admin.view_admin',compact('all_admin'));
    }

    public function addEditAdmin(Request $request){
      // dd($request->all());
      $adminId = 0;
        $rPath = $request->segment(3);
        if($request->isMethod('post')){
            $adminId = $request->input('admin_id');
            $this->validate($request, [
                'first_name' => 'required|max:100',
                'email' => 'required|email|max:255',
            ]);
            if($adminId == 0 || $adminId ==null){

                $this->validate($request, [
                    'password' => 'required|min:6|max:16',
                    'email' => 'required|email|max:255|unique:users',
                    'password' => 'required',
                    // 'password' => 'required|min:6|regex:/[a-z]/|regex:/[0-9]/',
                  ],[
                    // 'password.regex'=> 'Password must contain 1 character from a-z, 1 digit from 0-9',
                  ]);
            }
            $admin =new User;
            $admin->first_name = $request->input('first_name');
            $admin->email = $request->input('email');
            $admin->role = $request->input('role');
            $admin->status = 'active';

            if($request->input('password') != '' && $request->input('password') != NULL){
                $admin->password =Hash::make(trim($request->input('password')));
            }
            if($adminId == ''){
                $adminId = $admin->save();
                $sMsg = 'New Admin Added';
            }else{
              $admin='';
              $admin = User::findOrFail($adminId);
              $admin->first_name = $request->input('first_name');
              $admin->email = $request->input('email');
              $admin->role = $request->input('role');
              $admin->status = 'active';
              $admin->save();
                $sMsg = 'Admin Updated';
            }
            $request->session()->flash('alert',['message' => $sMsg, 'type' => 'success']);
            return redirect('dashboard/view_admins');
        }else{
            $admin = array();
            $adminId = '0';
            if($rPath == 'edit'){
                $adminId = $request->segment(4);
                $admin = User::findOrFail($adminId);
                // dd($user);
                if($admin == null){
                    $request->session()->flash('alert',['message' => 'No Record Found', 'type' => 'danger']);
                    return redirect('dashboard/view_admins');
                }
            }
            return view('admin.add-edit-admins',compact('admin','rPath','adminId'));
        }
    }

    public function deleteAdmin(Request $request)
    {
      if($request->isMethod('delete')){
    		$admin_id = trim($request->input('admin_id'));
        $admin = User::find($admin_id);
        $admin->delete();
    		$request->session()->flash('message' , 'Admin Deleted Successfully');
    	}
    	return redirect(url()->previous());
    }

    public function all_customers(Request $request)
    {
      $all_customer = User::where('role','customer')->orderBy('id','desc')->get();
       return view('admin.view_customers',compact('all_customer'));
    }


    public function addEditCustomer(Request $request){
      // dd($request->all());
      $customerId = 0;
        $rPath = $request->segment(3);
        if($request->isMethod('post')){
            $customerId = $request->input('customer_id');
            $this->validate($request, [
                'first_name' => 'required|max:100',
                'email' => 'required|email|max:255',
            ]);
            if($customerId == 0 || $customerId ==null){

                $this->validate($request, [
                    'password' => 'required|min:6|max:16',
                    'email' => 'required|email|max:255|unique:users',
                    'password' => 'required',
                    // 'password' => 'required|min:6|regex:/[a-z]/|regex:/[0-9]/',
                  ],[
                    // 'password.regex'=> 'Password must contain 1 character from a-z, 1 digit from 0-9',
                  ]);
            }
            $customer =new User;
            $customer->first_name = $request->input('first_name');
            $customer->last_name = $request->input('last_name');
            $customer->email = $request->input('email');
            $customer->phone = $request->input('phone');
            $customer->address = $request->input('address');
            $customer->role = 'customer';
            $customer->status = 'active';

            if($request->input('password') != '' && $request->input('password') != NULL){
                $customer->password =Hash::make(trim($request->input('password')));
            }
            if($customerId == ''){
                $customerId = $customer->save();
                $sMsg = 'New Customer Added';
            }else{
              $customer='';
              $customer = User::findOrFail($customerId);
              $customer->first_name = $request->input('first_name');
              $customer->last_name = $request->input('last_name');
              $customer->email = $request->input('email');
              $customer->phone = $request->input('phone');
              $customer->address = $request->input('address');
              $customer->role = 'customer';
              $customer->status = 'active';
              if($request->input('password') != '' && $request->input('password') != NULL){
                  $customer->password =Hash::make(trim($request->input('password')));
              }
              $customer->save();
                $sMsg = 'Customer Updated';
            }
            $request->session()->flash('alert',['message' => $sMsg, 'type' => 'success']);
            return redirect('dashboard/view_customers');
        }else{
            $customer = array();
            $customerId = '0';
            if($rPath == 'edit'){
                $customerId = $request->segment(4);
                $customer = User::findOrFail($customerId);
                // dd($user);
                if($customer == null){
                    $request->session()->flash('alert',['message' => 'No Record Found', 'type' => 'danger']);
                    return redirect('dashboard/view_customers');
                }
            }
            return view('admin.add-edit-customers',compact('customer','rPath','customerId'));
        }
    }

    public function deleteCustomer(Request $request)
    {
      if($request->isMethod('delete')){
        $customer_id = trim($request->input('customer_id'));
        $customer = User::find($customer_id);
        $customer->delete();
        $request->session()->flash('message' , 'Customer Deleted Successfully');
      }
      return redirect(url()->previous());
    }

    public function all_students(Request $request)
    {
      $all_student = Student::orderBy('student_id','desc')->get();
       return view('admin.view_students',compact('all_student'));
    }


    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function destroy($id)
    {
        //
    }
}
