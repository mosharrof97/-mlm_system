<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Blog;

class BlogController extends Controller
{
      // Blog Start
    //   public function addbloge(){
       
    //     return view('userDashboard\page\blods\blogs', );
    // }

    public function allBlog(){
        $user= Auth()->user();
        $userId = $user->id;
         $public = Blog::join('users', 'users.id', '=', 'blogs.user_id')->orderBy('blog_id', 'DESC')->get();
         $private = Blog::where('user_id', $userId)->orderBy('blog_id', 'DESC')->get();
         return view('userDashboard\page\blods\blogs', compact(['user','public','private']));
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





    
    // public function store(Request $request){

    //     $userId = Auth()->user()->id;
    //     $request->validate=([
    //         'blog_desc'=> ['required', 'string', 'max:1500'],
    //         'blog_img'=> ['image', 'max:10240'],
    //     ]);

    //     Blog::create([
    //         'user_id'=>$userId,
    //         'blog_desc'=>$request->blog_desc,
    //         'blog_img'=>$request->blog_img,
    //         'blog_condition'=>$request->blog_condition,
    //     ]);

    //     return back();
    // }

  

       // Blog End
}
