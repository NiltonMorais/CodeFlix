<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('videos', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('description');
            $table->integer('duration')->nullable();
            $table->string('file')->nullable();
            $table->string('thumb')->nullable();
            $table->boolean('completed')->default(0);
            $table->boolean('published')->default(0);

            $table->integer('serie_id')->unsigned()->nullable();
            $table->foreign('serie_id')->references('id')->on('series');

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
		Schema::drop('videos');
	}

}
