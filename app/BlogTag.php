<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogTag extends Model
{
    public function article(){
	    return $this->belongsToMany(Article::class,'article_tag', 'tag_id', 'article_id');
    }
}
