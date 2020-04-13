<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFilesTable extends Migration {

	public function up()
	{
		Schema::create('files', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
            $table->integer('product_id')->unsigned()->nullable();
            $table->integer('seller_id')->unsigned()->nullable();
			$table->string('path');
			$table->string('file');
			$table->string('size');
			$table->string('file_name');
		});
	}

	public function down()
	{
		Schema::drop('files');
	}
}
