<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration {

	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('name');
			$table->string('email');
			$table->string('phone');
			$table->string('image');
			$table->string('password');
			$table->integer('age');
			$table->enum('type', array('male', 'female'));
			$table->string('address');
			$table->decimal('longitude', 10,2);
			$table->decimal('latitude', 10,2);
			$table->enum('status', array('0', '1'))->nullable();
			$table->string('pin_code')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('clients');
	}
}