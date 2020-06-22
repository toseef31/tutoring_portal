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
        // dd($user);
         // $userdata=DB::table('users')->where('user_id',$request->user()->user_id)->where('users.stripe_id','=', null)->first();
         // $userplan=DB::table('users')
         // ->join('subscriptions','subscriptions.user_user_id','=','users.user_id')
         // ->join('plans','plans.stripe_plan','=','subscriptions.stripe_plan')
         // ->where('users.user_id',$request->user()->user_id)->where('users.stripe_id','!=', null)->first();

          //dd($userdata);
          // if($userdata != null){
          // $date = Carbon::parse($userdata->updated_at);
          //    $now = Carbon::now();
          //
          //    $diff = $date->diffInDays($now);
          //    //dd($diff);
          //    if($diff > 1){
          //        // $numbers = Number::where('num_id',$userdata->choice_number)->update(['status'=>'0']);
          //        $number =User::find($request->user()->user_id);
          //
          //        $number->choice_number = '';
          //        $number->save();
          //    }
          // }


          // $unavailnumbers = Number::where('status','3')->get();

          // foreach($unavailnumbers as $unavail){
          //     $undate = Carbon::parse($unavail->updated_at);
          //     $unnow = Carbon::now();
          //     $undiff = $undate->diffInDays($unnow);
          //
          //     if($undiff > 90){
          //         Number::where('num_id',$unavail->num_id)->update(['status'=>'0']);
          //
          //    }
          // }
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
             // $post->phone = $request->input('phone');
             $post->address = $request->input('address');
             if ($request->input('password') !=null) {
               $post->password =Hash::make(trim($request->input('password')));
             }
             $post->save();
         }
          $user = User::findOrFail($request->user()->id);
          // dd($user);
          return view('frontend.dashboard.profile',compact('user'));
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
