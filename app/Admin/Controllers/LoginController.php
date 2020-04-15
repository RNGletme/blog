<?php

namespace App\Admin\Controllers;

use Illuminate\Support\Facades\Auth;

class LoginController extends Controller {

	public function index(){
		if(auth::guard('admin')->user()) return redirect('/admin/home');
		return view('admin/login/index');
	}

	public function login(){
		$this->validate(request(), [
			'name'=>'required',
			'password'=>'required|min:6|max:20',
			'is_remember'=>'integer'
		]);

		$user = request(['name', 'password']);
		$is_remember = boolval(request('is_remember'));

		if(Auth::guard('admin')->attempt($user, $is_remember)){
			return redirect('/admin/home');
		}else{
			return redirect()->back()->withErrors('用户名或密码输入错误');
		}
	}

	public function logout(){
		Auth::guard('admin')->logout();

		return redirect('/admin/login');
	}
}