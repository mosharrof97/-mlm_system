<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoleTable;
use Illuminate\View\View;

class roleController extends Controller
{
    // *** User Registered ***//

    public function create(): View
    {
        return view('dashboard.page.roll.add_roll');
    }

    
    public function newroll(Request $request)
    {
       
        $request->validate([
            'name' => ['required', 'string','max:30'],
        ]);

        $role = new RoleTable();
        
        $role->role_name = $request->input('name');
        $role->save();
        return back()->with('success', 'Your Registration has been Successfull!');
    }
}
