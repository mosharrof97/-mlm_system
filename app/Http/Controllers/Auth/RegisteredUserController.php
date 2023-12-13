<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\RoleTable;
use App\Models\Balance;
use App\Models\Refer_bonus;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail; 
use DB;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('userDashboard.auth.register');
    }


    public function referRegister(Request $request){
        if(isset($request->ref)){
            $refer_code = $request->ref;
            $userData = User::where('referral_code', $refer_code)->get();
            if(count($userData) > 0){
                return view('userDashboard.auth.referral_register',compact('refer_code'));
            }else{
                return view('404');
            }
        }else{ 
            return redirect('/user_register'); 
        }
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:30'],
            'username' => ['required', 'string', 'max:30', 'unique:'.User::class],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $roles= RoleTable::where('role_id', 3);
        $refer_code =Str::random(10);
        $token = Str::random(60);

        if(isset($request->referral_code)){
            $userData = User::where('referral_code', $request->referral_code)->get();
            if(count($userData) > 0){
                try {
                    // Begin a database transaction.
                    DB::beginTransaction();
                
                    // Create user data array.
                    $user_inputData = [
                        'name' => $request->name,
                        'username' => $request->username,
                        'role_id' => 3,
                        'referral_code' => $refer_code,
                        'refer_id' => $userData[0]['id'],
                        'refer_code' => $request->referral_code,
                        'email' => $request->email,
                        'password' => Hash::make($request->password),
                        'remember_token' => $token,
                    ];

                    if ($request->hasFile('image')) {
                        $fileName = time() . '_' . mt_rand(100000, 20000000) . '.' . $request->file('image')->extension();
                        $user_inputData['image'] = $fileName;
                         $request->image->move('upload/BlogImage', $fileName);
                     }

                    // Create a new user and get the user ID.
                    $userId = User::create($user_inputData)->id;

                    // Create a new balance record for the user.
                    Balance::create([
                        'user_id' => $userId,
                        'balance_amount' => 100,
                    ]);

                    Refer_bonus::create([
                        'user_id' => $userId,
                        'bonus_amount' => 100,
                    ]);

                 
                    
                    // Create a new refer bonus record for the user.
                    $userIdMatch = User::where('referral_code', $request->referral_code)->first();
                    $rak = Balance::where('user_id', $userIdMatch->id)->first();

                    $data = [
                        'balance_amount' => $rak->balance_amount + 100,
                    ];
                    Balance::where('user_id', $userIdMatch->id)->update($data);
                  
                    Refer_bonus::create([
                        'user_id' => $userIdMatch->id,
                        'bonus_amount' => 100,
                    ]);

                    function referBonus($referCode){
                        if($referCode=2){

                        }
                    }

                    //  function tree()
                    // {
                    //     $Allusers = User::get();
                    //     $rootUsers = $Allusers->whereNull('refer_id');
                    //     foreach( $rootUsers as $rootUser ){
                    //         $rootUser->children = $Allusers->where('refer_id', $rootUser->id);
                    //     }
                
                    //     return $rootUsers;
                    // }
                    // dd( tree());

                    
                    // Second Refer, Create a new refer bonus record for the user.
                    $secondRefer  = User::where('referral_code', $userIdMatch->refer_code)->first();
                    // dd($userIdMatch->refer_code);
                    if($userIdMatch->refer_code !== null){
                        $secondReferBonus = Balance::where('user_id', $secondRefer->id)->first();
                        $data = [
                            'balance_amount' => $secondReferBonus->balance_amount + 50,
                        ];
                        Balance::where('user_id', $secondRefer->id)->update($data);
                      
                        Refer_bonus::create([
                            'user_id' => $secondRefer->id,
                            'bonus_amount' => 50,
                        ]);
                    }
                
                    // Commit the transaction if all operations are successful.
                    DB::commit();
                
                } catch (Exception $e) {
                    // Rollback the transaction if an exception occurs.
                    DB::rollback();
                    throw $e; // Rethrow the exception after rolling back.
                }
                
            }else{
                return back()->with('error', 'Please enter valid Referral code');
            }
        }else{
            DB::beginTransaction();
            try {
                $userData = [ 
                    'name' => $request-> name,
                    'username' => $request-> username,
                    'referral_code' => $refer_code,
                    'role_id' => 3,
                    'email' => $request-> email,
                    'password' => Hash::make($request->password),
                    'remember_token' => $token,  
                ];
                if ($request->hasFile('image')) {
                    $fileName = time() . '_' . mt_rand(100000, 20000000) . '.' . $request->file('image')->extension();
                    $userData['image'] = $fileName;
                     $request->image->move('upload/BlogImage', $fileName);
                 }

                //  dd($userData);

                $userId = User::create($userData)->id;

                Balance::create([
                    'user_id' => $userId,
                    'balance_amount' => 100,
                ]);

                Refer_bonus::create([
                    'user_id' => $userId,
                    'bonus_amount' => 100,
                ]);
                
                DB::commit();

            } catch (Exception $e) {
                DB::rollback();
                throw $e;
            }
        }

        // Refferral ID & URL  send Email

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
        // dd($data);
        Mail::send('userDashboard.auth.emails.registerSuccess',['data' => $data],function($message) use($data){
            $message->to($data['email'])->subject($data['title']);
        });


         //verification Email
         $verifyUrl = $domin.'/email_verification/'.$token ;
         $data=[
             'verifyUrl' => $verifyUrl ,
             'title' => 'Email verification',
             'name' => $request-> name,
             'username' => $request-> username,
             'email' => $request-> email,
         ];
         Mail::send('userDashboard.auth.emails.email_is_verifide',['data' => $data],function($message) use($data){
             $message->to($data['email'])->subject($data['title']);
         });
   
        return back()->with('success', 'Your Registration has been Successfull! & Please Verify Your Email....');
    }

    public function emailVerification($token){

        // $userData = User::where('remember_token',$token)->first();
        // return dd($token);
        $userData = User::where('remember_token',$token)->first();
        // dd($userData[0]['is_verified']);
        if($userData){
            if($userData['is_verified'] == 1){
                return view('userDashboard.auth.emails.verified',['message'=> 'Your Mail is already Verifide!']);
            }else{
                User::find($userData->id)->update([
                    'is_verified' => 1,
                    'email_verified_at' => date('Y-m-d  H:i:s'),                    
                ]);
                return view('userDashboard.auth.emails.verified',['message'=> 'Your '.$userData['email'].' mail is Verify Successfully! Hello' ]);
            }
        }else{
            return view('userDashboard.auth.emails.verified',['message'=> '404 | Page Not Found! ok' ]);
        }
    }

}
