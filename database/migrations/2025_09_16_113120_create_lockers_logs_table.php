<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLockersLogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('lockers_logs', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('locker');
			$table->string('number');
			$table->string('place');
			$table->string('r_number')->nullable();
			$table->string('employee')->nullable();

			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('lockers_logs');
	}

}
