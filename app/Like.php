<?php

namespace App;

class Like extends BaseModel
{
	public function article(){
		return $this->belongsTo(Article::class);
	}
}
