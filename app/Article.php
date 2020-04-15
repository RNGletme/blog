<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;

class Article extends BaseModel
{
	public function blogKind(){
		return $this->belongsTo(BlogKind::class);
	}

	public function blogUser(){
		return$this->belongsTo(BlogUser::class);
	}

	public function blogTag(){
		return $this->belongsToMany(BlogTag::class,'article_tag', 'article_id', 'tag_id');
	}

	public function comment(){
		return $this->hasMany(Comment::class)->orderBy('created_at','desc');
	}

	public function like($user_id){
		return $this->hasOne(Like::class)->where('blog_user_id', $user_id);
	}

	public function likes(){
		return $this->hasMany(Like::class)->orderBy('created_at', 'desc');
	}

	public function topic(){
		return $this->belongsToMany(Topic::class, 'article_topics', 'article_id', 'topic_id');
	}

	//属于某个用户的文章
	public function scopeAuthorBy(Builder $query, $user_id){
		return $query->where('blog_user_id', $user_id);
	}

	//不属于某个专题的文章
	public function articleTopic(){
		return $this->hasMany(ArticleTopic::class, 'article_id', 'id');
	}

	public function scopeNoTopicBy(Builder $query, $topic_id){
		return $query->doesntHave('articleTopic','and', function ($q) use ($topic_id){
			$q->where('topic_id', $topic_id);
		});
	}

	protected static function boot(){
		parent::boot();
		static::addGlobalScope('status', function (Builder $builder){
			$builder->whereIn('status', [0,1]);
		});
	}
}
