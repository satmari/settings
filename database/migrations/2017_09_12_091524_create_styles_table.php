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

			$table->string('image')->nullable(); //added

			$table->string('spreading_method')->nullable();
			$table->integer('standard_bb_qty')->nullable();
			$table->string('pad_print')->nullable();
			$table->string('bansek')->nullable();
			$table->string('adeziv')->nullable();

			$table->string('status')->nullable();

			$table->string('paspul')->nullable();
			$table->string('material_2nd')->nullable();
			$table->string('bonding')->nullable();
			$table->string('preproduction')->nullable();
			
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
