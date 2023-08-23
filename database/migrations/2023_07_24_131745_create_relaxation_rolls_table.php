<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelaxationRollsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('relaxation_rolls', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('su')->unique();

			$table->string('material')->nullable();
			$table->string('material_desc')->nullable();
			$table->string('batch')->nullable();
			$table->float('qty');
			$table->string('uom')->nullable();

			$table->string('ses')->nullable();
			$table->string('rnumber')->nullable();

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
		Schema::drop('relaxation_rolls');
	}

}
