<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlertBlogUserNoticeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::table('blog_user_notice', function (Blueprint $table){
		    $table->unique(['blog_user_id', 'notice_id']);
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::table('blog_user_notice', function (Blueprint $table){
		    $table->dropUnique(['blog_user_id', 'notice_id']);
	    });
    }
}
