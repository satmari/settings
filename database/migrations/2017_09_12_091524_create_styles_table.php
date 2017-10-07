<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStylesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('styles', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('style')->unique();
			$table->string('brand')->nullable();
			$table->double('cutting_smv', 2, 3)->nullable();
			$table->string('cluster')->nullable();
			$table->string('order_type')->nullable();
			
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
		Schema::drop('styles');
	}

}


/*

style	string
brand	string
cutting_smv	double
cluster	string

*/
