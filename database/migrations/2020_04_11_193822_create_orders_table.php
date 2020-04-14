<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

	public function up()
	{
		Schema::create('orders', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->longText('note');
			$table->enum('status', array('pending','accepted','rejected','delivered','declined'));
			$table->integer('seller_id')->unsigned()->nullable();
			$table->integer('client_id')->unsigned()->nullable();
			$table->decimal('price');
			$table->decimal('delivery');
			$table->decimal('commission');
			$table->decimal('total');
			$table->string('address');
			$table->integer('payment_method_id')->unsigned();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('orders');
	}
}
