<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class BlogUser extends Authenticatable
{
	protected $fillable = ['name', 'password', 'email', 'phone'];



	public function articles(){
		return $this->hasMany(Article::class);
	}

	public function comment(){
		return $this->hasMany(Comment::class);
	}

	//某一用户粉丝对象
	public function fans(){
		return $this->hasMany(Fan::class, 'star_id', 'id');
	}

	//某一用户关注对象
	public function stars(){
		return $this->hasMany(Fan::class, 'fans_id', 'id');
	}

	public function star($starID) {
		return $this->hasOne(Fan::class, 'fans_id', 'id')->where('star_id', $starID);
	}

	public function notices(){
		return $this->belongsToMany(Notice::class, 'blog_user_notice', 'blog_user_id', 'notice_id');
	}

	public function getAllID(){
		$users = self::all()->toArray();
		$id = [];
		foreach ($users as $user){
			$id[] = $user['id'];
		}

		return $id;
	}

	public function hasNotices(){
		return $this->notices()->where('blog_user_notice.status',0)->count();
	}
}
