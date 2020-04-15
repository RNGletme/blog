<?php

namespace App\Providers;

use App\Topic;
use function foo\func;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    	Schema::defaultStringLength(191);

    	\View::composer('layout.sidebar', function ($view){
    		$topics = Topic::all();
    		$view->with(compact('topics'));
	    });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
