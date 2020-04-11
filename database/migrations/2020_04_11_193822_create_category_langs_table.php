<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoryLangsTable extends Migration {

	public function up()
	{
		Schema::create('category_langs', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
			$table->longText('description');
			$table->string('code_lang');
			$table->integer('category_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('category_langs');
	}
}