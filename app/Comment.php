<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends BaseModel
{
    public function article(){
    	return $this->belongsTo(Article::class);
    }

    public function blogUser(){
    	return $this->belongsTo(BlogUser::class);
    }
}
