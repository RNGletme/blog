<?php

namespace App;



use Illuminate\Database\Eloquent\Builder;

class AdminPermission extends BaseModel
{
	protected $table = 'admin_permissions';
	//权限属于哪些角色
	public function roles(){
		return $this->belongsToMany(AdminRole::class, 'admin_role_permission', 'admin_permission_id', 'admin_role_id')->withPivot(['admin_permission_id', 'admin_role_id']);
	}

	protected static function boot(){
		parent::boot();

		static::addGlobalScope('exceptSystem', function (Builder $builder){
			$builder->where('name', '!=', 'system');
		});
	}
}
