<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateModuleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		// Schema::table('inventories', function(Blueprint $table)
		// {
  //   		// $table->string('ses')->nullable();
		// });

		// Schema::table('inventory_whs', function(Blueprint $table)
		// {
  //   		// $table->string('ses')->nullable();
		// });

		// Schema::table('inventory_cuts', function(Blueprint $table)
		// {
		// 	// $table->string('ses')->nullable();
		// });

		// Schema::table('inventory_ps', function(Blueprint $table)
		// {
		// 	// $table->string('ses')->nullable();
		// });

		// Schema::table('inventory_bbs', function(Blueprint $table)
		// {
		// 	// $table->string('ses')->nullable();
		// });box_settings

		// Schema::table('box_settings', function(Blueprint $table)
		// {
		// 	$table->integer('pcs_per_polybag_2')->nullable();
		// 	$table->string('style_2')->nullable();
		// 	$table->string('color_2')->nullable();
		// 	$table->string('size_2')->nullable();
		// 	$table->string('col_desc_2')->nullable(); // Added
		// 	$table->string('ean_2')->nullable(); // Added
		// });


	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
