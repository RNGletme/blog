<?php

namespace App;


class Topic extends BaseModel
{
    public function articles(){
    	return $this->belongsToMany(Article::class,'article_topics', 'topic_id', 'article_id');
    }

    //用于统计某一专题的文章的数量
    public function articleTopic(){
    	return $this->hasMany(ArticleTopic::class, 'topic_id');
    }

}
