<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleTopicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_topics', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('article_id')->nullable(false)->default(0)->comment('article.id');
            $table->integer('topic_id')->nullable(false)->default(0)->comment('topic.id');
            $table->unique(['article_id', 'topic_id']);
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
        Schema::dropIfExists('article_topics');
    }
}
