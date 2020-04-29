<?php

namespace App\Http\Controllers;

use App\BlogUser;
use App\Fan;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

	public function index($id){
		/*
		 * 获取当前用户的 最近十篇文章|文章数|粉丝数|关注数
		 */

		$blogUser = BlogUser::withCount(['articles', 'fans', 'stars'])->find($id);
		$articles = $blogUser->articles()->orderBy('created_at', 'desc')->take(10)->get();
//  $articles = $blogUser->article;

		/*
    * 获取粉丝用户，以及粉丝用户的 文章数|粉丝数|关注数
    */
		$fans = $blogUser->fans;
		$fansInfo = BlogUser::whereIn('id', $fans->pluck('fans_id'))->withCount('articles', 'fans', 'stars')->get();

		/*
		 * 获取关注用户，以及关注用户的 文章数|粉丝数|关注数
		 */
		$stars = $blogUser->stars;
		$starsInfo = BlogUser::whereIn('id', $stars->pluck('star_id'))->withCount('articles', 'fans', 'stars')->get();

		return view('user.index', compact('blogUser', 'articles', 'fansInfo', 'starsInfo'));
	}

	public function setting(){
		$user = Auth::user();
		return view('user.setting',compact('user'));
	}

	public function settingStore(){
		$this->validate(request(), ['name'=>'required|min:3|max:30']);

		$user = Auth::user();
		$name = request('name');
		if($name != $user->name){
			if(BlogUser::where('name', $name)->count()>0){
				return redirect()->back()->withErrors('用户名已存在');
			}else{
				$user->name = $name;
			}
		}
		if(request('avatar')){
			$image = request('avatar');
			if(preg_match('/^(data:\s*image\/(\w+);base64,)/', $image, $result)){
				$type = $result[2];
				if(in_array($type,array('jpeg','jpg','gif','bmp','png'))){
					$up_dir = 'storage/'.$user->id.'/';
					$new_file = $up_dir.date('YmdHis').'.'.$type;
					file_put_contents($new_file, base64_decode(str_replace($result[1],'', $image)));
					$user->avatar = '/'.$new_file;
				}
			}
		}

//		$file = request()->file('avatar') ?? '';
//		if($file){
//			$rs = $this->validateImg($file);
//			if($rs['code'] != 200) return back()->withErrors('图片上传错误');
//			$path = $file->storePublicly($user->id);
//			$user->avatar = '/storage/' . $path;
//		}
		$user->save();

		return back();
	}

	public function validateImg($file){
		$mimeType = $file->getMimeType();
		$size = $file->getSize();

		$allowMimeType = ['image/jpeg', 'image/png', 'image/gif'];
		$maxSize = 8*1024*1024;


		if(!in_array($mimeType, $allowMimeType)){
			return ['code'=>100];
		}
		if($size>$maxSize){
			return ['code'=>101];
		}
		return ['code'=>200];
	}

	public function fan($id){
		if(!BlogUser::find($id)->exists()){
			return ['code'=>100, 'msg'=>'InvalidID'];
		}
		$user = BlogUser::find(Auth::id());
		$star = new Fan();
		$star->star_id = $id;
		$id = $user->stars()->save($star);
		if($id){
			$msg = ['code'=>200, 'error'=>''];
		}else{
			$msg = ['code'=>500, 'error'=>'意料之外的错误'];
		}
		return $msg;
	}

	public function unfan($id){
		$user = BlogUser::find(Auth::id());
		$row = $user->star($id)->delete();

		if($row > 0){
			$msg = ['code'=>200, 'error'=>''];
		}else{
			$msg = ['code'=>500, 'error'=>'意料之外的错误'];
		}

		return $msg;
	}

}
