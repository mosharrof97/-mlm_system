<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Blog;

class AdminBlogController extends Controller
{
    
      // Blog Start
    //   public function addbloge(){
       
    //     return view('userDashboard\page\blods\blogs', );
    // }

    public function allBlog(){
        $user = Auth()->user();
        $userId = $user ->id;
         $public = Blog::orderBy('blog_id', 'DESC')->get();
         $private = Blog::where('user_id', $userId)->orderBy('blog_id', 'DESC')->get();
         return view('dashboard\page\blogs\blogs', compact(['user','public','private']));
     }

     public function store(Request $request)
     {
         $userId = auth()->user()->id;
     
         $request->validate([
             'blog_desc' => ['required', 'string', 'max:1500'],
             'blog_img' => ['image', 'max:10240'],
         ]);
     
         $blogData = [
             'user_id' => $userId,
             'blog_desc' => $request->blog_desc,
             'blog_condition' => $request->blog_condition,
         ];
         if ($request->hasFile('blog_img')) {
            $fileName = time() . '_' . mt_rand(100000, 20000000) . '.' . $request->file('blog_img')->extension();
             $blogData['blog_img'] = $fileName;
             $request->blog_img->move('upload/BlogImage', $fileName);
         }
         Blog::create($blogData);
     
         return back();
     }

     public function delete($id)
     {
        
         $blog = Blog::findOrFail($id);
         $blog->delete();
         return back();
     }
    
}
