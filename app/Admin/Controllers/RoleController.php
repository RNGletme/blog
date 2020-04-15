<?php

namespace App\Admin\Controllers;

use App\AdminPermission;
use App\AdminRole;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    public function index(){
    	$roles = AdminRole::exceptRoot()->get();
			return view('admin/role/index', compact('roles'));
    }

    public function create(){
			return view('admin/role/create');
    }

    public function store(){
			$this->validate(request(),[
				'name' => 'required|min:3|max:30|unique:admin_roles,name',
				'description' => 'required|min:3'
			]);

			AdminRole::create(request(['name', 'description']));

			return redirect('/admin/roles');
    }

    public function permission(AdminRole $role){
    	$permissions = AdminPermission::all();
    	$hasPermissions = $role->permissions;

			return view('admin/role/permission', compact('role', 'permissions', 'hasPermissions'));
    }

    public function updatePermission(AdminRole $role){
	    $this->validate(request(),[
		    'permissions' => 'required|array'
	    ]);
	    $upPermissions = request('permissions');
	    $permissions = AdminPermission::all()->toArray();
	    $idArr = [];
	    foreach ($permissions as $permission){
		    $idArr[] = $permission['id'];
	    }

	    foreach ($upPermissions as $upPermission){
		    if(!in_array($upPermission, $idArr)) return back()->withErrors('InvalidPermission');
	    }

	    $role->permissions()->detach();
	    $role->permissions()->attach($upPermissions);

	    return redirect('/admin/roles');
    }
}
