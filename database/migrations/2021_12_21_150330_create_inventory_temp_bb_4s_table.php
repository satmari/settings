<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoryTempBb4sTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('inventory_temp_bb_4s', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('material')->nullable();
			$table->string('material_desc')->nullable();
			$table->string('su');
			$table->string('batch')->nullable();

			$table->string('bin')->nullable();
			$table->string('bin_actual')->nullable();
			
			$table->float('qty');
			$table->float('qty_actual')->nullable();

			$table->string('uom')->nullable();

			$table->integer('counter')->nullable(); // Added
			$table->string('ses')->nullable();
			
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
		Schema::drop('inventory_temp_bb_4s');
	}

}
