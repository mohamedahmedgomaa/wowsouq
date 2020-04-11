<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotificationsTable extends Migration {

	public function up()
	{
		Schema::create('notifications', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('title');
			$table->longText('body');
			$table->enum('action', array('accepted', 'rejected', 'delivered', 'new'));
			$table->integer('order_id')->unsigned()->nullable();
			$table->integer('notifiiable_id');
			$table->string('notifiiable_type');
		});
	}

	public function down()
	{
		Schema::drop('notifications');
	}
}