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

		Schema::table('modules', function(Blueprint $table)
		{
			// $table->integer('pcs_per_polybag_2')->nullable();
			// $table->string('style_2')->nullable();
			// $table->string('color_2')->nullable();
			// $table->string('size_2')->nullable();
			// $table->string('col_desc_2')->nullable(); // Added
			// $table->string('ean_2')->nullable(); // Added
			// $table->string('sku')->nullable(); // Added

			// $table->string('supervisor')->nullable(); // added later
			
		});

		Schema::table('box_settings', function(Blueprint $table)
		{
			// $table->string('barcode_type')->nullable(); // Added
		});

		Schema::table('fabrics', function(Blueprint $table)
		{
			// $table->string('sp_parameter')->nullable(); // Added
			// $table->string('info_for_sp_and_cut')->nullable(); // Added
		});


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
