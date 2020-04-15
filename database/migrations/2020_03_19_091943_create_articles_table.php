<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('articles', function (Blueprint $table) {
			$table->increments('id');
			$table->string('title', 100)->default('')->nullabled(false)->index()->comment('标题');
			$table->text('content')->comment('内容');
			$table->integer('user_id')->nullabled(false)->default(0)->index()->comment('blog_users.id');
			$table->integer('kind_id')->default(0)->nullabled(false)->index()->comment('blog_kinds.id');
			$table->integer('tag_id')->default(0)->nullabled(false)->comment('blog_tags.id');
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
		Schema::dropIfExists('articles');
	}
}
