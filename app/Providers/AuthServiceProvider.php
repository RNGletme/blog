<?php

namespace App\Providers;

use App\AdminPermission;
use App\AdminUser;
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


        /**
         * 后台权限控制
         */

	      Gate::before(function ($admin){
	      	if($admin->table == 'admin_users'){
			      return $admin->isSupperAdmin();
		      }
	      });

        $permissions = AdminPermission::withOutGlobalScope('exceptSystem')->get();

        foreach ($permissions as $permission){
        	Gate::define($permission->name, function ($admin) use ($permission){
        		return $admin->hasPermission($permission);
	        });
        }

	    /**
	     *  导航栏通知消息红点
	     */
        Gate::define('hasNotice', function ($user) {
        	return $user->hasNotices();
        });
    }
}
