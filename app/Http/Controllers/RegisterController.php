<?php

namespace App\Http\Controllers;

use App\BlogUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function index(){
    	if(Auth::check()) return redirect('/article');
			return view('register.register');
    }

    public function register(){
    	//校验数据
			$this->validate(request(),
				['name'=>'required|min:3|max:10|unique:blog_users,name',
				'email'=>'required|unique:blog_users,email|email',
				'password'=>'required|min:6|max:20|confirmed'],
				[],
				['name'=>'用户名','password'=>'密码', 'email'=>'邮箱']);
			//入库
			BlogUser::create([
				'name'=>request('name'),
				'password'=>bcrypt(request('password')),
				'email'=>request('email'),
				'phone'=>request('email')]);
			//渲染
	    return redirect('/login');
    }
    //第一步校验数据，第二步数据处理及入库， 第三步跳转或渲染页面
}
