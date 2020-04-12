<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration {

	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('email');
			$table->string('phone');
			$table->string('image');
			$table->string('password');
			$table->integer('age');
			$table->enum('gender', array('male', 'female'));
			$table->string('address');
			$table->decimal('longitude', 10,8);
			$table->decimal('latitude', 10,8);
			$table->enum('status', array('0', '1'))->nullable();
			$table->string('pin_code')->nullable();
            $table->timestamps();
            $table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('clients');
	}
}
