<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fans_id')->nullable(false)->default(0)->comment('article.id,粉丝');
            $table->integer('star_id')->nullable(false)->default(0)->comment('article.id,被关注作者');
            $table->timestamps();
            $table->unique(['fans_id', 'star_id'], 'fans_star');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fans');
    }
}
