<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Change extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//

		Schema::table('fabrics', function(Blueprint $table)
		{
			// $table->integer('pcs_per_polybag_2')->nullable();
			// $table->string('style_2')->nullable();
			// $table->string('color_2')->nullable();
			// $table->string('size_2')->nullable();
			// $table->string('col_desc_2')->nullable(); // Added
			// $table->string('ean_2')->nullable(); // Added
			// $table->string('sku')->nullable(); // Added

			// $table->string('supervisor')->nullable(); // added later

			// $table->string('fg_family')->nullable();
			// $table->string('spreading_method')->nullable();
			// $table->integer('standard_bb_qty')->nullable();
			// $table->string('pad_print')->nullable();
			// $table->string('bansek')->nullable();
			// $table->string('adeziv')->nullable();

			// $table->string('status')->nullable();

			// $table->string('fabric_family')->nullable(); // Added
			
		});

		Schema::table('modules', function(Blueprint $table)
		{
			// $table->integer('pcs_per_polybag_2')->nullable();
			// $table->string('style_2')->nullable();
			// $table->string('color_2')->nullable();
			// $table->string('size_2')->nullable();
			// $table->string('col_desc_2')->nullable(); // Added
			// $table->string('ean_2')->nullable(); // Added
			// $table->string('sku')->nullable(); // Added

			// $table->string('workstudy_r')->nullable(); // added later
			// $table->string('line_leader_r')->nullable(); // added later
			// $table->string('supervisor_r')->nullable(); // added later1
			
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
