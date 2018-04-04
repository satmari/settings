<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFRPlansTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fr_plan', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('plan_key')->unique();
			
			$table->string('module')->nullable();
			$table->string('order')->nullable();
			$table->string('sku')->nullable();
			$table->date('plan_date')->nullable();
			$table->integer('qty')->nullable();

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
		Schema::drop('fr_plan');
	}

}

