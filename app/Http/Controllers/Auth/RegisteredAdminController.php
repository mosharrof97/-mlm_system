<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\RoleTable;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredAdminController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    { 
        $roles= RoleTable::All();
        // dd($roles->All());
        return view('auth\register',compact('roles'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // dd($request->All()); 
        $request->validate([
            'name' => ['required', 'string', 'max:30'],
            'username' => ['required', 'string', 'max:30', 'unique:'.User::class],
            'role_name'=>['required'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);


        $userData = [
            'name' => $request->name,
            'username' => $request->username,
            'role_id' => $request->role_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        if ($request->hasFile('image')) {
            $fileName = time() . '_' . mt_rand(100000, 20000000) . '.' . $request->file('image')->extension();
            $userData['image'] = $fileName;
            $request->image->move('upload/BlogImage', $fileName);
         }

        // dd($userData);
        $user = User::create($userData);

        return back();
        // event(new Registered($user));

        // Auth::login($user);

        // return redirect('/login');
    }

    
}
