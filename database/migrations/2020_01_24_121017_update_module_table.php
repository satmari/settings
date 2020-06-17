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
		Schema::table('modules', function(Blueprint $table)
		{
			
    		// $table->string('team')->nullable();
    		// $table->string('linekey')->nullable();
    		// $table->renameColumn('modulekey', 'line');
    		// $table->dropColumn('modulekey');
    		

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
