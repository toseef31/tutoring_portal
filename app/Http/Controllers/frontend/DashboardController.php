<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Cashier\Cashier;
use App\Facade\SCT;
use App\User;
use DB;
use Session;
use Hash;
use Mail;
use Storage;
use Response;
class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(Request $request)
     {
        $user=User::find(auth()->user()->id);
          $user2 = auth()->user();
          // dd($user2);
         return view('frontend.dashboard.index',compact('user'));
     }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function show(Request $request)
     {
         if($request->isMethod('post')){
           // dd($request->all());
             $post =User::find($request->user()->id);
             $post->first_name = $request->input('first_name');

             $post->last_name = $request->input('last_name');
             $post->phone = $request->input('phone');
             $post->address = $request->input('address');
             $post->city = $request->input('city');
             $post->state = $request->input('state');
             $post->zip = $request->input('zip');
             if ($request->input('password') !=null) {
               $post->password =Hash::make(trim($request->input('password')));
             }
             $post->save();
         }
          $user = User::findOrFail($request->user()->id);
          // dd($user);
          return view('frontend.dashboard.profile',compact('user'));
     }

     public function show_tutor(Request $request)
     {
         if($request->isMethod('post')){
           // dd($request->all());
             $post =User::find($request->user()->id);
             $post->first_name = $request->input('first_name');

             $post->last_name = $request->input('last_name');
             $post->phone = $request->input('phone');
             $post->description = $request->input('description');
             // $post->address = $request->input('address');
             if ($request->input('password') !=null) {
               $post->password =Hash::make(trim($request->input('password')));
             }
             $post->save();
         }
          $user = User::findOrFail($request->user()->id);
          // dd($user);
          return view('frontend.dashboard.profile-tutor',compact('user'));
     }

     public function profilePicture(Request $request){

       if(!$request->ajax()){
         exit('Directory access is forbidden');
       }

       $userinfo=auth()->user();
       if($request->file('user_image') != ''){

         $fName = $_FILES['user_image']['name'];
         $ext = @end(@explode('.', $fName));
         if(!in_array(strtolower($ext), array('png','jpg','jpeg'))){
           exit('1');
         }

         $user = User::find($userinfo->id);

         $image = $request->file('user_image');
         $profilePicture = 'profile-'.time().'-'.rand(000000,999999).'.'.$image->getClientOriginalExtension();
         $destinationPath = public_path('/frontend-assets/images/dashboard/profile-photos');
         $image->move($destinationPath, $profilePicture);
         $user_old_image = $user->image;
         User::where('id',$userinfo->id)->update(array('image' => $profilePicture));
         if($user_old_image != ''){
           @unlink(public_path('/frontend-assets/images/dashboard/profile-photos/'.$user_old_image));
         }
         echo url('/frontend-assets/images/dashboard/profile-photos/'.$profilePicture);
       }

     }

     public function getAgreements(Request $request)
     {
       $user_id = auth()->user()->id;
       $agreements = DB::table('signed_aggreements')->where('user_id',$user_id)->get();
       return view('frontend.dashboard.all_aggreements',compact('agreements'));
     }

     public function ViewAgreementDetails(Request $request ,$id)
     {
        $agreement=DB::table('signed_aggreements')->where('aggreement_id',$id)->where('user_id',auth()->user()->id)->first();
        return view('frontend.dashboard.view-aggreement',compact('agreement'));

     }

     public function showAgreement(Request $request ,$id)
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

     public function SignAgreement(Request $request)
     {
       // dd($request->all());
       $agreement_id =$request->input('aggreement_id');
       $input['user_name'] = $request->input('user_name');
       $input['date'] = $request->input('date');
       $input['status'] = 'Signed';
       $agreement =DB::table('signed_aggreements')->where('aggreement_id',$agreement_id)->where('user_id',auth()->user()->id)->update($input);
       $request->session()->flash('message',"Agreement Signed Successfull");
       return redirect('/user-portal/agreements');
     }

    public function faqs(Request $request)
    {
      $faq = DB::table('faqs')->first();
      return view('frontend.dashboard.view-faqs',compact('faq'));
    }

    public function credits(Request $request)
    {
      $credit = DB::table('credits')->where('user_id',auth()->user()->id)->first();
      return view('frontend.dashboard.view-credits',compact('credit'));
    }

    public function buyCredit(Request $request)
       {
          // dd($request->all());
          $credit_id = $request->input('credit_id');
          $credit_cost = $request->input('credit_cost');
          $credit_balance = $request->input('credit_balance');
          $total = $credit_cost*$credit_balance;
          // dd($total);
           return view('frontend.dashboard.show', compact('credit_id','credit_cost','credit_balance','total'));
       }

       public function subscribe_process(Request $request)
       {
         // dd($request->all());
         try {
           $stripe = \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
           $userId=auth()->user()->id;
           $user = User::find($userId);
           $tokenId= $request->stripeToken;
           $total = $request->total*100;
           $credit_id = $request->input('credit_id');
           $credit_balance = $request->input('credit_balance');
           $credit_cost = $request->input('credit_cost');
           $get_credit = DB::table('credits')->where('credit_id',$credit_id)->first();

           // dd($get_credit);
           $customer = $user->createAsStripeCustomer($tokenId,[
             'email' => $user->email,
           ]);
           $stripeCharge = $user->charge($total);
           $new_credit_balance = $get_credit->credit_balance+$credit_balance;
           $status = $get_credit->status;
           $data['stripeToken'] = $tokenId;
           DB::table('users')->where('id',$userId)->update($data);

           $receipt =$stripeCharge['receipt_url'];
           $input['credit_balance'] = $new_credit_balance;
           $input['status'] = 'Purchased Before';
           $input['receipt_url'] = $receipt;
           DB::table('credits')->where('credit_id',$credit_id)->update($input);
           $new_credit = DB::table('credits')->where('credit_id',$credit_id)->first();

           $toemail =  $user->email;
           // dd($send);
           Mail::send('mail.purchase_credit_email',['user' =>$user,'credit'=>$new_credit],
           function ($message) use ($toemail)
           {

             $message->subject('Smart Cookie Tutors.com - New Credit Purchased');
             $message->from('admin@SmartCookieTutors.com', 'Smart Cookie Tutors');
             $message->to($toemail);
           });

           $admins = User::where('role','admin')->get();
          if ($status == 'First Purchase') {
           foreach ($admins as $admin) {
             $toemail =  $admin->email;
             // dd($send);
             Mail::send('mail.new_user_credit_email',['user' =>$user,'credit'=>$new_credit],
             function ($message) use ($toemail)
             {

               $message->subject('Smart Cookie Tutors.com - New Credit Purchased');
               $message->from('admin@SmartCookieTutors.com', 'Smart Cookie Tutors');
               $message->to($toemail);
             });
           }
         }

           // dd($stripeCharge);

           $request->session()->flash('message', 'Credits Purchased successfully');
           return redirect('/user-portal/credits');
         } catch (\Exception $ex) {
           return $ex->getMessage();
         }

       }

       public function studentTutor(Request $request)
       {
         $tutors = DB::table('tutor_assign')
                  ->join('users','users.id','=','tutor_assign.tutor_id')
                  ->where('tutor_assign.user_id','=',auth()->user()->id)->get();
                  // dd($tutor);
        return view('frontend.dashboard.tutors',compact('tutors'));
       }

       public function TutorStudents(Request $request)
       {
         $students = DB::table('tutor_assign')
                  ->join('students','students.student_id','=','tutor_assign.student_id')
                  ->where('tutor_assign.tutor_id','=',auth()->user()->id)->get();
                  // dd($students);
        return view('frontend.dashboard.tutor-students',compact('students'));
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
