<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogUserNoticeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_user_notice', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('blog_user_id')->nullable(false)->default(0)->comment('blog_users.id');
            $table->integer('notice_id')->nullable(false)->default(0)->comment('notices.id');
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
        Schema::dropIfExists('blog_user_notice');
    }
}
