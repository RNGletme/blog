<?php

namespace App\Admin\Controllers;

use App\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    public function index(){
    	$articles = Article::withOutGlobalScope('status')->where('status', 0)->orderBy('id')->get();
    	return view('admin.article.index', compact('articles'));
    }

    public function status(Article $article){
			$this->validate(request(), [
				'status'=>'required|in:1,2'
			]);
			
			$article->status = request('status');
			$rows = $article->save();
			if($rows>0) $msg = ['code'=>200, 'error'=>''];
			else $msg = ['code'=>101, 'error'=>'系统错误,请重试'];

			return $msg;
    }
}
