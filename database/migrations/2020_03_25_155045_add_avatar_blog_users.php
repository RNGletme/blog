<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAvatarBlogUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blog_users', function (Blueprint $table){
        	$table->string('avatar', 255)->default('')->nullabled(false)->after('email')->comment('头像');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::table('blog_users', function (Blueprint $table){
		    $table->dropColumn('avatar');
	    });
    }
}
