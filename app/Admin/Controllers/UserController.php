<?php

namespace App\Admin\Controllers;

use App\AdminRole;
use App\AdminUser;
use Illuminate\Support\Facades\DB;

class UserController extends Controller {

	public function index(){
		$users = AdminUser::orderBy('id')->get();
		return view('admin/user/index',compact('users'));
	}

	public function create(){
		return view('admin/user/create');
	}

	public function store(){
		$this->validate(request(), [
			'name' => 'required|min:3|max:20|unique:admin_users,name',
			'password' => 'required|min:6|max:20'
		]);

		$name = request('name');
		$password = bcrypt(request('password'));
		$phone = time();

		AdminUser::create(compact('name', 'password', 'phone'));

		return redirect('/admin/users');

	}

	public function role(AdminUser $user){
		$roles = AdminRole::exceptRoot()->get();
		$hasRoles = $user->roles;

		return view('admin/user/role',compact('user','roles','hasRoles'));
	}

	public function updateRole(AdminUser $user){
		$this->validate(request(),[
			'roles' => 'required|array'
		]);
		$upRoles = request('roles');
		$roles = AdminRole::exceptRoot()->get()->toArray();
		$idArr = [];
		foreach ($roles as $role){
			$idArr[] = $role['id'];
		}

		foreach ($upRoles as $upRole){
			if(!in_array($upRole, $idArr)) return back()->withErrors('InvalidRole');
		}

		$user->roles()->detach();
		$user->roles()->attach($upRoles);

		return redirect('/admin/users');
	}

}