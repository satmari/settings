<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateBudget extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */

    		// $table->date('first_work_day')->nullable();
    		// $table->integer('pcs_per_polybag_2')->nullable(); // Added
    		// $table->integer('pcs_per_box_2')->nullable(); // Added
    		// $table->dropColumn('pcs_per_polybag_2');

	public function up()
	{
		// Schema::table('inventories', function($table)
		// {
		// 	$table->integer('counter')->nullable(); // Added
		// });

		// Schema::table('inventory_temps', function($table)
		// {
  //   		$table->integer('counter')->nullable(); // Added
		// });

		// Schema::table('inventory_whs', function($table)
		// {
  //   		$table->integer('counter')->nullable(); // Added
		// });

		// Schema::table('inventory_temp_whs', function($table)
		// {
  //   		$table->integer('counter')->nullable(); // Added
		// });

		// Schema::table('inventory_cuts', function($table)
		// {
  //   		$table->integer('counter')->nullable(); // Added
		// });

		// Schema::table('inventory_temp_cuts', function($table)
		// {
  //   		$table->integer('counter')->nullable(); // Added
		// });

		// Schema::table('inventory_ps', function($table)
		// {
  //   		$table->integer('counter')->nullable(); // Added
		// });

		// Schema::table('inventory_temp_ps', function($table)
		// {
  //   		$table->integer('counter')->nullable(); // Added
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
