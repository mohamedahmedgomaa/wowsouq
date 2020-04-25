<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSellersTable extends Migration {

	public function up()
	{
		Schema::create('sellers', function(Blueprint $table) {
			$table->increments('id');
            $table->string('name');
            $table->string('email');
            $table->string('image');
            $table->string('password');
            $table->string('phone');
            $table->decimal('wallet', 10,2)->default(0)->nullable();
            $table->string('address')->nullable();
            $table->decimal('longitude', 10,8)->nullable();
            $table->decimal('latitude', 10,8)->nullable();
            $table->enum('status', array('activated', 'not_activated', 'forbidden'));
            $table->string('pin_code')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
	}

	public function down()
	{
		Schema::drop('sellers');
	}
}
