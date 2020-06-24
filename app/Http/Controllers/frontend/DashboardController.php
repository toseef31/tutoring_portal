<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use DB;
use Session;
use Hash;
use Mail;
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
