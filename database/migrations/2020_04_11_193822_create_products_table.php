<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration {

	public function up()
	{
		Schema::create('products', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->decimal('price');
			$table->decimal('offer')->default('0');
			$table->string('image');
			$table->integer('category_id')->unsigned()->nullable();
			$table->integer('seller_id')->unsigned()->nullable();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('products');
	}
}