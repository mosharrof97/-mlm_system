<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notice;

class NoticeController extends Controller
{
    public function AllNotice(){
        
        $notices = Notice::get();
        return view('userDashboard.page.Notice.AllNotice', compact('notices'));
    }


    public function AddNotice(){


        return view('userDashboard.page.Notice.AddNotice');
    }

    public function store(Request $request){

        // dd($request->All());
        $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'notice_desc' => ['required', 'string', 'max:1500'],
            'notice_img' => ['required', 'image', 'max:10240'], // Assuming it's an image upload, adjust 'image' and 'max' accordingly
        ]);

        $fileName = time() . '_' . mt_rand(100000, 20000000) . '.' . $request->notice_img->extension();
        $data = [
            'notice_name'=> $request->title,
            'notice_desc'=> $request->notice_desc,
            'notice_img'=> $fileName,
           
        ];

        $request->notice_img->move('upload/noticeImage', $fileName);

        Notice::create($data);


        return back();
    }
}
