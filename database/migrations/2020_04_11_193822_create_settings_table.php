<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration {

	public function up()
	{
		Schema::create('settings', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('phone')->nullable();
			$table->string('email')->nullable();
            $table->text('text')->nullable();
            $table->string('image')->nullable();
            $table->string('whats_app')->nullable();
            $table->string('instagram')->nullable();
            $table->string('you_tube')->nullable();
            $table->string('facebook')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('settings');
	}
}
