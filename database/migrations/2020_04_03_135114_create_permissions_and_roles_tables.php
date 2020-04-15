<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsAndRolesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	//权限表
    	  Schema::create('admin_permissions', function (Blueprint $table){
    	  	$table->increments('id');
    	  	$table->string('name')->nullable(false)->default('')->unique()->comment('权限名');
    	  	$table->string('description')->nullable(false)->default('')->comment('描述');
    	  	$table->timestamps();
	      });

    	  //角色表
	    Schema::create('admin_roles', function (Blueprint $table){
		    $table->increments('id');
		    $table->string('name')->nullable(false)->default('')->unique()->comment('角色名');
		    $table->string('description')->nullable(false)->default('')->comment('描述');
		    $table->timestamps();
	    });

	    //角色权限表
	    Schema::create('admin_role_permission', function (Blueprint $table){
		    $table->increments('id');
		    $table->integer('admin_role_id')->nullable(false)->default(0)->comment('admin_roles.id');
		    $table->integer('admin_permission_id')->nullable(false)->default(0)->comment('admin_permissions.id');
		    $table->timestamps();
		    $table->unique(['admin_role_id', 'admin_permission_id']);
	    });

	    //用户角色表
	    Schema::create('admin_user_role', function (Blueprint $table){
		    $table->increments('id');
		    $table->integer('admin_user_id')->nullable(false)->default(0)->comment('admin_users.id');
		    $table->integer('admin_role_id')->nullable(false)->default(0)->comment('admin_roles.id');
		    $table->timestamps();
		    $table->unique(['admin_user_id', 'admin_role_id']);
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_permissions');
        Schema::dropIfExists('admin_roles');
        Schema::dropIfExists('admin_role_permissions');
        Schema::dropIfExists('admin_user_role');
    }
}
