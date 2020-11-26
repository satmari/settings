<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStylesExtrasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('styles_extras', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('style_extra')->unique();

			$table->string('style');
			$table->string('color');
			$table->string('size');

			$table->string('brand')->nullable();
			$table->double('cutting_smv', 2, 3)->nullable();
			$table->string('cluster')->nullable();
			$table->string('order_type')->nullable();

			$table->string('image')->nullable(); //added

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
		Schema::drop('styles_extras');
	}

}
