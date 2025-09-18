<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoryBinToLocsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('inventory_bin_to_locs', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('bin');
			$table->string('location');

			$table->string('bin_type')->nullable();
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
		Schema::drop('inventory_bin_to_locs');
	}

}
