<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

	public function up()
	{
		Schema::create('orders', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('order_number')->nullable();
			$table->longText('note')->nullable();
			$table->enum('status', array('pending','accepted','rejected','delivered','declined'))->default('pending')->nullable();
			$table->integer('client_id')->unsigned()->nullable();
			$table->decimal('price')->nullable();
			$table->decimal('delivery')->nullable();
			$table->decimal('commission')->nullable();
			$table->decimal('total')->nullable();
			$table->string('address')->nullable();
            $table->decimal('longitude', 10,8)->nullable();
            $table->decimal('latitude', 10,8)->nullable();
			$table->integer('payment_method_id')->unsigned();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('orders');
	}
}
