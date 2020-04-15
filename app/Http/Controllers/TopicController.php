<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Article;
use App\Topic;
use Illuminate\Http\Request;
use PhpParser\Builder;

class TopicController extends Controller
{
	public function show($id){
		$topic = Topic::withCount('articleTopic')->find($id);
		$articles = $topic->articles;
		$articlesNoByTopic = Article::authorBy(Auth::id())->noTopicBy($id)->get();

		return view('topic/topic',compact('topic', 'articles', 'articlesNoByTopic'));
	}

	public function submit(Topic $topic){
		$this->validate(request(), [
			'article_id'=>'required|array'
		]);

		$article_id = \request('article_id');
		$topic->articles()->attach($article_id);

		return back();

	}
}
