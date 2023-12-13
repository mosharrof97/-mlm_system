<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Balance;
use App\Models\Notice;
use App\Models\Blog;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function myProfile(Request $request): View 
    {
        $user = auth()->user();
        $userId = $user->id;
        $referUserId = $user->refer_id;
        $myOwnRef = $user->referral_code;

        $blog = Blog::join('users','users.id','=','blogs.user_id')->where('user_id', $userId)->orderBy('blog_id', 'DESC')->get();
        $refUser = User::find($referUserId);
        $count = User::where('refer_code', $myOwnRef)->get()->count();
        $Balance = Balance::where('user_id',$userId)->first();
        
        

        return view('userDashboard\page\profile\my-profile',compact(['blog','refUser', 'user','count','Balance']));
    }


    public function edit(Request $request): View 
    {
        return view('userDashboard.page.profile.manage-profile', ['user' => $request->user()]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');  
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }


    public function Referral(){

        $userId = auth()->user()->id;
        $refUser = User::where('refer_id', $userId)->get();
        return view('userDashboard\page\profile\referrals', compact(['refUser']));
    }

    
    public function profileAllNotice(){
        
        $notices = Notice::paginate(5);
        // $notices = Notice::orderBy('notice_id')->cursorPaginate(3);
        return view('userDashboard.page.profile.notice', compact('notices'));
    }

    public function SingleNotice($id){
        
        $notice = Notice::where('notice_id',$id)->first();
        // $notices = Notice::orderBy('notice_id')->cursorPaginate(3);
        return view('userDashboard\page\profile\singleNotice', compact('notice'));
    }

  
}
