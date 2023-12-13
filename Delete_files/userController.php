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

class userController extends Controller
{
    public function loadRegister(){
        return view('userDashboard\auth\register'); 
    }
 
    public function registered(Request $request){
        $refer_users = new refer_users;
        $refer_code =Str::random(10);
        $token = Str::random(60);
        $inputData = [
            'user_name' => $request-> name,
            'user_username' => $request-> username,
            'user_email' => $request-> email,
            'user_pass' => Hash::make($request->password),
            'user_referral_code' => $refer_code,
            'remember_token' => $token,    
        ];
        $refer_users::insert($inputData);
    }


    // *** User Registered ***//

    public function usercreate(): View
    {
        return view('userDashboard\auth\register');
    }

    
    public function newuser(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
