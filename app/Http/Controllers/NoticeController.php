<?php

namespace App\Http\Controllers;

use App\BlogUser;
use App\BlogUserNotice;
use App\Notice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoticeController extends Controller
{
    public function index(){
    	$blogUser = BlogUser::find(Auth::id());
    	$notices = $blogUser->notices()->orderBy('created_at', 'desc')->get();

    	BlogUserNotice::where([['blog_user_id', '=', Auth::id()], ['status', '=', 0]])->update(['status'=>1]);

    	return view('notice/index', compact('notices'));
    }
}
