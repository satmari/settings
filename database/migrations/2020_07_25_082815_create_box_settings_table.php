<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoxSettingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('box_settings', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('material')->unique();
			$table->string('style');
			$table->string('color');
			$table->string('size');
			$table->string('brand')->nullable();

			$table->integer('pcs_per_polybag')->nullable();

			$table->float('weight_of_polybag')->nullable();
			$table->float('weight_of_pcs')->nullable();
			$table->integer('pcs_per_box')->nullable();
			$table->integer('pcs_per_box_2')->nullable(); // Added

			$table->string('status')->nullable();

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
		Schema::drop('box_settings');
	}

}
