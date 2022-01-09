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
			$table->string('sku')->nullable();
			$table->string('style');
			$table->string('color');
			$table->string('size');
			$table->string('brand')->nullable();

			$table->integer('pcs_per_polybag')->nullable();
			$table->integer('pcs_per_box')->nullable();

			$table->float('weight_of_polybag')->nullable();
			$table->float('weight_of_pcs')->nullable();
			
			$table->integer('pcs_per_polybag_2')->nullable(); // Added
			$table->integer('pcs_per_box_2')->nullable(); // Added

			$table->string('style_2')->nullable(); // Added
			$table->string('color_2')->nullable(); // Added
			$table->string('size_2')->nullable(); // Added

			$table->string('col_desc_2')->nullable(); // Added
			$table->string('ean_2')->nullable(); // Added
			$table->string('sku')->nullable(); // Added

			$table->string('barcode_type')->nullable(); // Added

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
