<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NetWeightTrigger extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('net_weight_trigger', function(Blueprint $table)
		{
			$table->string('int_sku')->nullable();
			$table->float('int_weight')->nullable();
			$table->float('int_weight_old')->nullable();
			$table->string('trigger')->nullable();
			
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
		//
	}

}
