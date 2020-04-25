<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCommentsTable extends Migration {

	public function up()
	{
		Schema::create('comments', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->longText('comment');
			$table->integer('product_id')->unsigned();
			$table->integer('client_id')->unsigned()->nullable();
		});
	}

	public function down()
	{
		Schema::drop('comments');
	}
}
