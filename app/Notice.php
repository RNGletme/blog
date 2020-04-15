<?php

namespace App;

class Notice extends BaseModel
{
    //
	protected $table = 'notices';

	public function blogUser(){
		return $this->belongsToMany(BlogUser::class, 'blog_user_notice', 'notice_id', 'blog_user_id');
	}
}
