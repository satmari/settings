<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoxSettingsOldWaysTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('box_settings_old_ways', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('key')->unique();
			$table->string('style');
			$table->string('color');
			$table->string('size');

			$table->string('style_2')->nullable();
			$table->string('col_desc_2')->nullable();

			$table->float('weight_of_polybag')->nullable();
			$table->float('weight_of_pcs')->nullable();
			
			$table->integer('pcs_per_polybag_2')->nullable(); // Added
			$table->integer('pcs_per_box_2')->nullable(); // Added
			
			$table->string('updated')->nullable();


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
		Schema::drop('box_settings_old_ways');
	}

}
