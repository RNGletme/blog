<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogKind extends Model
{
	public function Article(){
		return $this->hasMany(Article::class);
	}
}
