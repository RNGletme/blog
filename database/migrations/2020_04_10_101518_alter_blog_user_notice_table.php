<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterBlogUserNoticeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blog_user_notice', function (Blueprint $table){
        	$table->integer('status')->nullable(false)->default(0)->after('notice_id')->index()->comment('0:未读；1:已读');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blog_user_notice', function(Blueprint $table){
        	$table->dropColumn('status');
        });
    }
}
