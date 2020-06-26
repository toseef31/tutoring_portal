<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Facade\SCT;
use App\User;
use App\Student;
use Hash;
use DB;
use Mail;
use Session;
use Storage;
use Response;

class AdminController extends Controller
{

    use AuthenticatesUsers;
    protected $redirectTo = '/dashboard';

    // public function __construct()
    // {
    //     $this->middleware('admin')->except('logout');
    // }

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
      return redirect('dashboard/view_customers');
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
                'phone' => 'required',
                'address' => 'required',
                'city' => 'required',
                'state' => 'required',
                'zip' => 'required',
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
              $customer->city = $request->input('city');
              $customer->state = $request->input('state');
              $customer->zip = $request->input('zip');
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

    public function addEditStudent(Request $request){
      // dd($request->all());
      $studentId = 0;
        $rPath = $request->segment(3);
        if($request->isMethod('post')){
            $studentId = $request->input('student_id');
            $this->validate($request, [
                'student_name' => 'required|max:100',
                'college' => 'required',
                'subject' => 'required',
                'grade' => 'required',
                // 'email' => 'required|email|max:255',
            ],[
              'college.required' =>'School/College field is required',
              'subject.required' =>'Subject field is required',
              'grade.required' =>'Grade/Level field is required',
            ]);

            $student =new Student;
            $student->student_name = $request->input('student_name');
            $student->user_id = $request->input('user_id');
            $student->email = $request->input('email');
            $student->college = $request->input('college');
            $student->grade = $request->input('grade');
            $student->subject = $request->input('subject');
            $student->goal = $request->input('goal');
            if($studentId == ''){
                $studentId = $student->save();
                $sMsg = 'New Student Added';
            }else{
              $student='';
              $student = Student::findOrFail($studentId);
              $student->student_name = $request->input('student_name');
              $student->user_id = $request->input('user_id');
              $student->email = $request->input('email');
              $student->college = $request->input('college');
              $student->grade = $request->input('grade');
              $student->subject = $request->input('subject');
              $student->goal = $request->input('goal');
              $student->save();
                $sMsg = 'Student Updated';
            }
            $request->session()->flash('alert',['message' => $sMsg, 'type' => 'success']);
            return redirect('dashboard/view_students');
        }else{
            $student = array();
            $studentId = '0';
            if($rPath == 'edit'){
                $studentId = $request->segment(4);
                $student = Student::findOrFail($studentId);
                // dd($student);
                if($student == null){
                    $request->session()->flash('alert',['message' => 'No Record Found', 'type' => 'danger']);
                    return redirect('dashboard/view_students');
                }
                // dd($student);
            }
            $users = User::get();
            return view('admin.add-edit-students',compact('student','rPath','studentId','users'));
        }
    }

    public function deleteStudent(Request $request)
    {
      if($request->isMethod('delete')){
        $student_id = trim($request->input('student_id'));
        $student = Student::find($student_id);
        $student->delete();
        $request->session()->flash('message' , 'Student Deleted Successfully');
      }
      return redirect(url()->previous());
    }

    public function all_tutors(Request $request)
    {
      $all_tutor = User::where('role','tutor')->orderBy('id','desc')->get();
       return view('admin.view_teachers',compact('all_tutor'));
    }

    public function addEditTutor(Request $request){
      // dd($request->all());
      $tutorId = 0;
        $rPath = $request->segment(3);
        if($request->isMethod('post')){
            $tutorId = $request->input('tutor_id');
            $this->validate($request, [
                'first_name' => 'required|max:100',
                'email' => 'required|email|max:255',
            ]);
            if($tutorId == 0 || $tutorId ==null){

                $this->validate($request, [
                    'password' => 'required|min:6|max:16',
                    'email' => 'required|email|max:255|unique:users',
                    'password' => 'required',
                    // 'password' => 'required|min:6|regex:/[a-z]/|regex:/[0-9]/',
                  ],[
                    // 'password.regex'=> 'Password must contain 1 character from a-z, 1 digit from 0-9',
                  ]);
            }
            $tutor =new User;
            $tutor->first_name = $request->input('first_name');
            $tutor->email = $request->input('email');
            $tutor->role = $request->input('role');
            $tutor->status = 'active';

            if($request->input('password') != '' && $request->input('password') != NULL){
                $tutor->password =Hash::make(trim($request->input('password')));
            }
            if($tutorId == ''){
                $tutorId = $tutor->save();
                $sMsg = 'New Tutor Added';
            }else{
              $tutor='';
              $tutor = User::findOrFail($tutorId);
              $tutor->first_name = $request->input('first_name');
              $tutor->email = $request->input('email');
              $tutor->role = $request->input('role');
              $tutor->phone = $request->input('phone');
              $tutor->status = 'active';
              $tutor->description = $request->input('description');
              if($request->hasFile('profilePhoto')){
                  $image = $request->file('profilePhoto');

                  $tutor->image = 'profile-'.time().'-'.rand(000000,999999).'.'.$image->getClientOriginalExtension();
                  $destinationPath = public_path('/frontend-assets/images/dashboard/profile-photos/');
                  $image->move($destinationPath, $tutor->image);
                  if($request->input('prevLogo') != ''){
                      @unlink(public_path('/frontend-assets/images/dashboard/profile-photos/'.$request->input('prevLogo')));
                  }

              }else{
                  $tutor->image = $request->input('prevLogo');
              }
              if($request->input('password') != '' && $request->input('password') != NULL){
                  $tutor->password =Hash::make(trim($request->input('password')));
              }
              $tutor->save();
                $sMsg = 'Tutor Updated';
            }
            $request->session()->flash('alert',['message' => $sMsg, 'type' => 'success']);
            return redirect('dashboard/view_tutors');
        }else{
            $tutor = array();
            $tutorId = '0';
            if($rPath == 'edit'){
                $tutorId = $request->segment(4);
                $tutor = User::findOrFail($tutorId);
                // dd($user);
                if($tutor == null){
                    $request->session()->flash('alert',['message' => 'No Record Found', 'type' => 'danger']);
                    return redirect('dashboard/view_tutors');
                }
            }
            return view('admin.add-edit-tutors',compact('tutor','rPath','tutorId'));
        }
    }

    public function deleteTutor(Request $request)
    {
      if($request->isMethod('delete')){
        $tutor_id = trim($request->input('tutor_id'));
        $tutor = User::find($tutor_id);
        $tutor->delete();
        $request->session()->flash('message' , 'Tutor Deleted Successfully');
      }
      return redirect(url()->previous());
    }

    public function all_aggreement(Request $request)
    {
      $all_aggreement = DB::table('aggreements')->orderBy('aggreement_id','desc')->get();
      // dd($all_aggreement);
       return view('admin.view_aggreements',compact('all_aggreement'));
    }

    public function addEditAggreement(Request $request){
      // dd($request->all());
      $aggreementId = 0;
        $rPath = $request->segment(3);
        if($request->isMethod('post')){
            $aggreementId = $request->input('aggreement_id');
            $this->validate($request, [
                'aggrement_name' => 'required|max:100',
            ]);
            if($aggreementId == 0 || $aggreementId ==null){

                $this->validate($request, [
                    'agrreement_file' => 'required|mimes:pdf|max:10000',
                  ],[
                    'agrreement_file.required' => 'Please Upload PDF File',
                  ]);
            }
            $input['aggreement_name'] = $request->input('aggrement_name');
            if($request->file('agrreement_file') != ''){
               $agrreement_file = $request->file('agrreement_file');
               // dd($agrreement_file);
              $upload = $request->file('agrreement_file')->store('agrreement_file');
              $input['file'] = $upload;
            }

            if($aggreementId == ''){

                DB::table('aggreements')->insert($input);
                $sMsg = 'New Aggreement Added';
            }else{

              DB::table('aggreements')->where('aggreement_id',$aggreementId)->update($input);
                $sMsg = 'Aggreement Updated';
            }
            $request->session()->flash('alert',['message' => $sMsg, 'type' => 'success']);
            return redirect('dashboard/view_aggreements');
        }else{
            $aggreement = array();
            $aggreementId = '0';
            if($rPath == 'edit'){
                $aggreementId = $request->segment(4);
                $aggreement = DB::table('aggreements')->where('aggreement_id',$aggreementId)->first();
                // dd($user);
                if($request->has('download')){
                  $pdf = PDF::loadView('pdfview');
                  return $pdf->download('pdfview.pdf');
                }
                if($aggreement == null){
                    $request->session()->flash('alert',['message' => 'No Record Found', 'type' => 'danger']);
                    return redirect('dashboard/view_aggreements');
                }
            }
            return view('admin.add-edit-aggreements',compact('aggreement','rPath','aggreementId'));
        }
    }

    public function showAggreement(Request $request ,$id)
    {
       // dd('hello');
       $document=DB::table('aggreements')->where('aggreement_id',$id)->first();
        $filePath = $document->file;
        $type = Storage::mimeType($filePath);
        // dd($type);
        if( ! Storage::exists($filePath) ) {
        abort(404);
        }
        $pdfContent = Storage::get($filePath);
        return Response::make($pdfContent, 200, [
        'Content-Type'        => $type,
        'Content-Disposition' => 'inline; filename="'.$filePath.'"'
        ]);
    }

    public function deleteAggreement(Request $request)
    {
      if($request->isMethod('delete')){
        $aggreement_id = trim($request->input('aggreement_id'));
        $tutor = DB::table('aggreements')->where('aggreement_id',$aggreement_id)->delete();
        $request->session()->flash('message' , 'Agreement Deleted Successfully');
      }
      return redirect(url()->previous());
    }

    public function getUserList(Request $request,$id)
    {
      $clients = User::where('role','customer')->get();
      $tutors = User::where('role','tutor')->get();
      $users = User::where('role','<>','admin')->get();
      // dd($tutor);
      // return $user;
      return view('admin.ajax-users-list',compact('clients','tutors','id'));
    }

    public function sendAggreement(Request $request,$aggreement_id,$user_id)
    {
      $get_aggreement = DB::table('aggreements')->where('aggreement_id',$aggreement_id)->first();
      $aggreement_name = $get_aggreement->aggreement_name;
      $aggreement_file= $get_aggreement->file;
      $input['aggreement_id'] = $aggreement_id;
      $input['user_id'] = $user_id;
      $input['aggreement_name'] = $aggreement_name;
      $input['aggreement_file'] = $aggreement_file;
      $input['status'] = 'Awaiting Signature';
      $send = DB::table('signed_aggreements')->insertGetId($input);
      echo $send;
    }

    public function logout(Request $request){
          Auth::logout();
          return redirect('admin/login');
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
