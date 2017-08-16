<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlansTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('plans', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->float('value');
            $table->smallInteger('duration')->default(\CodeFlix\Models\Plan::DURATION_MONTHLY);
            $table->integer('paypal_web_profile_id')->unsigned();
            $table->foreign('paypal_web_profile_id')->references('id')->on('paypal_web_profiles');
            $table->softDeletes();
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
		Schema::dropIfExists('plans');
	}

}
