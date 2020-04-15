<?php

namespace App\Admin\Controllers;

use App\AdminPermission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    public function index(){
    	$permissions = AdminPermission::all();
			return view('admin/permission/index', compact('permissions'));
    }

    public function create(){
			return view('admin/permission/create');
    }

    public function store(){
			$this->validate(\request(), [
				'name' => 'required|min:2|max:30|unique:admin_permissions,name',
				'description' => 'required'
			]);

			AdminPermission::create(\request(['name', 'description']));

			return redirect('/admin/permissions');
    }
}
