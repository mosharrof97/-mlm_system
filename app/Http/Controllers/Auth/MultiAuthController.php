<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MultiAuthController extends Controller
{
    public function multiAuth(){

        if (auth()->user()->role_id== 1) {
            return redirect('/dashboard');
        }
        elseif(auth()->user()->role == 3){
            return redirect('/userDashboard');
        }
        else{
            return auth()->logout();
        }
    }
}
