<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
	    if(Auth::check()) return redirect('/article');
			return view('login.login');
    }

    public function login(){
			$this->validate(request(), [
				'email'=>'required|email',
				'password'=>'required|min:6|max:20',
				'is_remember'=>'integer'
			]);

			$user = request(['email', 'password']);
			$is_remember = boolval(request('is_remember'));

			if(Auth::attempt($user, $is_remember)){
				return redirect('/article');
			}else{
				return redirect()->back()->withErrors('邮箱或密码输入错误');
			}
    }

    public function logout(){
			Auth::logout();
			return redirect('/article');
    }
}
