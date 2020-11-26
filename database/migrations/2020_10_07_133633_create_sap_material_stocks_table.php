<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSapMaterialStocksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sap_material_stocks', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('material');

			// $table->string('material_type')->nullable();
			// $table->string('material_desc')->nullable();
			// $table->string('material_res')->nullable();
			// $table->string('material_old')->nullable();

			$table->string('storage_loc')->nullable();
			// $table->string('uom')->nullable();
			$table->float('qty')->nullable();

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
		Schema::drop('sap_material_stocks');
	}

}
