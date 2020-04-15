<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEmailBlogUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blog_users', function (Blueprint $table){
        	$table->string('email', 100)->nullabled(false)->default('')->unique()->after('phone')->comment('邮箱');
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
	      $table->dropColumn('email');
	    });
    }
}
