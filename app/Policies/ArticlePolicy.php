<?php

namespace App\Policies;

use App\Article;
use App\BlogUser;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function update(BlogUser $blogUser, Article $article){
    	return $article->blog_user_id == $blogUser->id;
    }

		public function delete(BlogUser $blogUser, Article $article){
			return $article->blog_user_id == $blogUser->id;
	}
}
