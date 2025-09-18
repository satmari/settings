<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLockersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('lockers', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('locker')->unique();
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
		Schema::drop('lockers');
	}

}
