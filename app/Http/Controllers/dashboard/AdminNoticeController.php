<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notice;

class AdminNoticeController extends Controller
{
    public function AllNotice(){
        
        $notices = Notice::paginate(5);
        return view('dashboard.page.Notice.AllNotice', compact('notices'));
    }


    public function AddNotice(){


        return view('dashboard.page.Notice.AddNotice');
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

    public function SingleNotice($id){
        
        $notice = Notice::where('notice_id',$id)->first();
        return view('dashboard.page.Notice.singleNotice', compact('notice'));
    }
}
