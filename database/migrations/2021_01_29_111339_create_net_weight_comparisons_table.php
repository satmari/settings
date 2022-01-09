<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNetWeightComparisonsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('net_weight_comparisons', function(Blueprint $table)
		{
			// $table->increments('id');

			// $table->string('int_sku')->unique();
			// $table->float('int_weight')->nullable();

			// $table->string('sap_sku')->nullable();
			// $table->float('sap_weight')->nullable();

			// $table->string('box_sku')->nullable();
			// $table->float('box_weight')->nullable();
			// $table->float('box_weight_poly')->nullable();

			// $table->string('brand')->nullable();

			// $table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('net_weight_comparisons');
	}

}
