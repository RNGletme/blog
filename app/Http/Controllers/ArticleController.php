<?php

namespace App\Http\Controllers;

use App\Article;
use App\BlogUser;
use App\Comment;
use App\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Builder;
use function Sodium\compare;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$list = Article::orderBy('created_at', 'desc')->withCount(['comment', 'likes'])->paginate(10);
	    return view('article/index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //创建文章页面
	    return view('article/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//    	$article = new Article();
//    	$article->title = request('title');
//    	$article->content = request('content');
//    	$rs = $article->save();
//    	dd($rs);

	    $this->validate($request, ['title'=>'required|max:60|min:3', 'content'=>'required']);

	    $blog_user_id = Auth::id();
	    $params = array_merge(request(['title', 'content']), compact('blog_user_id'));
	    Article::create($params);

	    return redirect('/article');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    	$article = Article::find($id);
    	$article->load('comment');

	    return view('article/show', compact('article', 'showLike'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    	$article = Article::find($id);
	    return view('article/edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
    	$this->authorize('update', $article);
	    $this->validate($request, ['title'=>'required|max:60|min:3', 'content'=>'required']);

//			$article = Article::find($id);
			$article->title = request('title');
			$article->content = request('content');
			$article->save();

			return redirect("/article/$article->id");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    	Article::find($id)->delete();
    	return redirect('article');
    }

    public function imageUpload(Request $request){
    	$path = $request->file('wangEditorH5File')->storePublicly(md5(rand(1,10)));

    	//asset返回一个前端资源URL
			return asset('storage/'.$path);
    }

    public function comment($articleID){
	    $this->validate(request(), [
		    'content'=>'required|min:3'
	    ]);

			$article = Article::find($articleID);
	    if(!$article) back()->withErrors('系统错误');
	    $comment = new Comment();
	    $comment->blog_user_id = Auth::id();
	    $comment->content = \request('content');
	    $article->comment()->save($comment);

	    return back();
    }

    public function like($articleID){
	    $article = Article::find($articleID);
	    if(!$article) back()->withErrors('系统错误');

	    $rs = $article->like(Auth::id())->exists();
	    if($rs)  back()->withErrors('系统错误');

	    $like = new Like();
	    $like->blog_user_id = Auth::id();
	    $article->likes()->save($like);

	    return back();
    }

    public function unlike($articleID){
	    $article = Article::find($articleID);
	    if(!$article) back()->withErrors('系统错误');

	    $article->like(Auth::id())->delete();

	    return back();
    }

    public function search(){
    	$content = \request('content');

	    $list = Article::orderBy('created_at', 'desc')->where('content', 'like', '%'.$content.'%')->orwhere('title', 'like', '%'.$content.'%')->withCount(['comment', 'likes'])->paginate(10);

	    return view('article/index', compact('list'));
    }

}