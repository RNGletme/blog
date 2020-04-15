<?php

namespace App\Admin\Controllers;

use App\BlogUser;
use App\Notice;
use Illuminate\Support\Facades\Auth;
use Mockery\Matcher\Not;

class NoticeController extends Controller {

	public function index(){
		$notices = Notice::orderBy('id')->get();
		return view('admin/notice/index', compact('notices'));
	}

	public function create(){
		return view('admin/notice/create');
	}

	public function store(){
		$this->validate(request(),[
			'title'=>'required|min:2',
			'content'=>'required|min:3'
		]);

		$admin_user_id = Auth::id();
		$params = array_merge(request(['title', 'content'], compact('admin_user_id')));
		Notice::create($params);

		return redirect('/admin/notices');
	}

	public function send(Notice $notice) {
		if($notice->status != 0){
			return ['code'=>100, 'error'=>'已发送'];
		}

		$blogUser = new BlogUser();
		$id = $blogUser->getAllID();
		$notice->blogUser()->attach($id);

		$notice->status = 1;
		$notice->save();

		return ['code' => 200, 'error' => ''];
	}


	public function delete(Notice $notice){
		$notice->blogUser()->detach();
		$notice->delete();

		return ['code'=>200, 'error'=>''];
	}

}