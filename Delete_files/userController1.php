<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str; 
use App\Models\refer_users;
use App\Models\Networks;
use Illuminate\View\View;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail; 

class userController1 extends Controller
{
    public function loadRegister(){
        return view('userDashboard\auth\register');
    }

    // public function referRegister(Request $request){
    //     if(isset($request->ref)){
    //         $refer_code = $request->ref;
    //         $userData = refer_users::where('user_referral_code', $refer_code)->get();
    //         if(count($userData) > 0){
    //             return view('dashboard.page.user.referral_register',compact('refer_code'));
    //         }else{
    //             return view('404');
    //         }
    //     }else{
    //         return redirect('/referral-register');
    //     }
    // }

    public function registered(Request $request){
        // $request->validate([
        //     'name' => 'required|string|min:2',
        //     ' username' =>'required|string|min:5|unique:refer_users,user_username',
        //     'email' => 'required|string|email|max:100|unique:refer_users,user_email',
        //     'password' => 'required|min:3|confirmed',
        // ]) ;

        $refer_code =Str::random(10);
        $token = Str::random(60);
        // if(isset($request->referral_code)){
        //     $userData = refer_users::where('user_referral_code', $request->referral_code)->get();
        //     if(count($userData) > 0){
        //         $user_inputData = [
        //             'user_name' => $request-> name,
        //             'user_username' => $request-> username,
        //             'user_email' => $request-> email,
        //             'user_pass' => Hash::make($request->password),
        //             'user_referral_code' => $refer_code,
        //             'remember_token' => $token,
        //         ];
        //         $referral_user_id = refer_users::insertGetId($user_inputData);

        //          $inputData = [
        //             'referral_code' => $request->referral_code,
        //             'referral_user_id' => $referral_user_id,
        //             'user_id' => $userData[0]['user_id'],
        //         ];
        //         Networks::insert($inputData);
        //     }else{
        //         return back()->with('error', 'Please enter valid Referral code');
        //     }
        // }else{
            $inputData1 = [
                'user_name' => $request-> name,
                'user_username' => $request-> username,
                'user_email' => $request-> email,
                'user_pass' => Hash::make($request->password),
                'user_referral_code' => $refer_code,
                'remember_token' => $token,            
            ];
            
            refer_users::insert($inputData1);
        // }

        $domin = URL::to('/');
        $url = $domin.'/referral-user-register?ref='.$refer_code ;
        // $url = $domin.'/referral-user-register/'.$refer_code ;
        $data=[
            'url' => $url,
            'title' => 'User Registered',
            'name' => $request-> name,
            'username' => $request-> username,
            'email' => $request-> email,
            'pass' => $request-> password,
        ];
        Mail::send('dashboard.page.emails.registerSuccess',['data' => $data],function($message) use($data){
            $message->to($data['email'])->subject($data['title']);
        });

        //verification Email
        $verifyUrl = $domin.'/email_verification?ref='.$token ;
        // $verifyUrl = $domin.'/email_verification/'.$token ;
        $data=[
            'verifyUrl' => $verifyUrl ,
            'title' => 'Email verification',
            'name' => $request-> name,
            'username' => $request-> username,
            'email' => $request-> email,
        ];
        Mail::send('dashboard.page.emails.email_is_verifide',['data' => $data],function($message) use($data){
            $message->to($data['email'])->subject($data['title']);

        });
        return back()->with('success', 'Your Registration has been Successfull! & Please Verify Your Email....');
        
    }

    public function emailVerification($token){

        // $userData = refer_users::where('remember_token',$token)->first();
        // return dd($token);
        $userData = refer_users::where('remember_token',$token)->get();
        if(count($userData) >0){
            if($userData[0]['is_verified'] == 1){
                return view('dashboard.page.emails.verified',['message'=> 'Your Mail is already Verifide!']);
            }else{
                refer_users::where('user_id',$userData[0]['is_verified'] )->update([
                    'is_verified' => 1,
                    'user_email_verified_at' => date('Y-m-d  H:i:s'),                    
                ]);
                return view('dashboard.page.emails.verified',['message'=> 'Your '.$userData[0]['user_email'].' mail is Verify Successfully!' ]);
            }
        }else{
            return view('dashboard.page.emails.verified',['message'=> '404 | Page Not Found! ok' ]);
        }
    }


  
    // public function emailVerification($token) {
    //     $verifiedUser = refer_users::where('remember_token',$token)->first();
    //     if(isset($verifiedUser)) {
    //         $user = $verifiedUser->user_email;
    //         if(!$user->user_email_verified_at) {
    //             $user->user_email_verified_at = Carbon::now();
    //             $user->save();
    //             return \redirect(route('login'))->with('Success', 'Your email has been verified, please login');

    //         }
    //         else {
    //             return \redirect()->back()->with('info', 'Your email has already been verified');
    //         }
    //     }

    //     else {
    //         return \redirect(route('login'))->with('error', 'Something went wrong');
    //     }
    // }
  


}

