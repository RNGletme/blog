<?php

namespace App\Providers;

use App\AdminPermission;
use function foo\func;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
	      'App\Article' => 'App\Policies\ArticlePolicy'
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();


        //后台权限控制
        $permissions = AdminPermission::withOutGlobalScope('exceptSystem')->get();

        foreach ($permissions as $permission){
        	Gate::define($permission->name, function ($user) use ($permission){
        		return $user->hasPermission($permission);
	        });
        }

        Gate::define('hasNotice', function ($user) {
        	/*return $user->whereHas('notices', function ($q){
        		$q->where('status', 0);
	        })->count();*/
        	$rs = $user->hasNotices();
        	if($rs > 0){
        		return true;
	        }else{
        		return false;
	        }
        });
        //
    }
}
