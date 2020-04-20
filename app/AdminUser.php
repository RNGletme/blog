<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminUser extends Authenticatable
{
	protected $table = 'admin_users';

	protected $rememberTokenName = '';

	protected $guarded = [];

	//用户对应的角色, 第三个参数为本表的外键，第四个参数为第一个参数表的id
	public function roles(){
		return $this->belongsToMany(AdminRole::class, 'admin_user_role', 'admin_user_id', 'admin_role_id')->withPivot(['admin_user_id', 'admin_role_id']);
	}

	//用户是否有某个角色
	public function isInRoles($roles){
		return !!$roles->intersect($this->roles)->count();
	}

	//用户增加某个角色
	public function assignRole($role){
		return $this->roles()->attach($role);
	}

	//用户删除某个角色
	public function detachRole($role){
		return $this->roles()->detach($role);
	}

	//用户是否有某个权限
	public function hasPermission($permission){
		return $this->isInRoles($permission->roles);
	}

	//用户是否是超级管理员
	public function isSupperAdmin(){
		if($this->name == 'demo'){
			return true;
		}else{
			return false;
		}
	}



}
