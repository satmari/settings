<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZradnicesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('zradnices', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('z_number');
			$table->string('z_name');
			$table->string('z_status');
			$table->string('r_number')->nullable();
			$table->string('r_name')->nullable();
			$table->string('r_status')->nullable();

			$table->string('comment')->nullable();

			$table->dateTime('fromDate')->nullable();
			$table->dateTime('toDate')->nullable();

			$table->string('final_status')->nullable();
			
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
		Schema::drop('zradnices');
	}

}

