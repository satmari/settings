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
		Schema::table('inventories', function(Blueprint $table)
		{
    		// $table->string('ses')->nullable();
		});

		Schema::table('inventory_whs', function(Blueprint $table)
		{
    		// $table->string('ses')->nullable();
		});

		Schema::table('inventory_cuts', function(Blueprint $table)
		{
			// $table->string('ses')->nullable();
		});

		Schema::table('inventory_ps', function(Blueprint $table)
		{
			// $table->string('ses')->nullable();
		});

		Schema::table('inventory_bbs', function(Blueprint $table)
		{
			// $table->string('ses')->nullable();
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
