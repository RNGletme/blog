<?php

namespace App\Admin\Controllers;

use App\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TopicController extends Controller
{
    public function index(){
    	$topics = Topic::all();
    	return view('admin/topic/index', compact('topics'));
    }

    public function create(){
			return view('admin/topic/create');
    }

    public function store(){
			$this->validate(request(),[
				'name'=>'required|min:2|max:30'
			]);

			Topic::create(request(['name']));

			return redirect('/admin/topics');

    }

    public function delete(Topic $topic){
			$rows = $topic->delete();

			if($rows > 0) return ['code'=>200, 'error'=>''];
			else return ['code'=>100, 'error'=>'Delete Failed'];
    }
}
