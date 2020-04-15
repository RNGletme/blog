<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlertNoticesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::table('notices', function (Blueprint $table){
		    $table->integer('status')->nullable(false)->default(0)->after('content')->index()->comment('0:未发送；1:已发送');
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::table('notices', function(Blueprint $table){
		    $table->dropColumn('status');
	    });
    }
}
