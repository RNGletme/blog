<?php

namespace App;


use Illuminate\Database\Eloquent\Builder;

class AdminRole extends BaseModel
{
	protected $table = 'admin_roles';

	//角色有哪些权限
	public function permissions(){
		return $this->belongsToMany(AdminPermission::class, 'admin_role_permission', 'admin_role_id', 'admin_permission_id')->withPivot(['admin_role_id', 'admin_permission_id']);
	}

	//角色是否有某一权限
	public function isHasPermission($permission){
		return $this->permissions->contains($permission);
	}

	//赋予某个权限
	public function givPermission($permission){
		return $this->permissions()->attach($permission);
	}

	//撤销某个权限
	public function removePermission($permission){
		return $this->permissions()->detach($permission);
	}

	protected static function boot(){
		parent::boot();
	}

	public function scopeExceptRoot(Builder $builder){
		$builder->where('name', '!=', 'root');
	}
}
