<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCliptextTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cliptext', function(Blueprint $table)
		{
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->text('text_content');
            $table->text('html_content');

            $table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.d
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('cliptext');
	}
}
