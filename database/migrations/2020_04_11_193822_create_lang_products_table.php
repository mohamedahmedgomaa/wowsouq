<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLangProductsTable extends Migration {

	public function up()
	{
		Schema::create('lang_products', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
			$table->longText('description');
			$table->enum('code_lang', array('ar', 'en'));
			$table->integer('product_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('lang_products');
	}
}