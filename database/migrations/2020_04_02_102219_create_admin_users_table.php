<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_users', function (Blueprint $table) {
	        $table->increments('id');
	        $table->string('name')->nullabled(false)->default('')->index()->comment('姓名');
	        $table->string('password')->nulladled(false)->default('')->comment('密码');
	        $table->string('phone')->nullabled(false)->default('')->unique()->comment('手机号码');
	        $table->string('remember_token', 100)->default('')->comment('是否记住登录信息');
	        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_users');
    }
}
