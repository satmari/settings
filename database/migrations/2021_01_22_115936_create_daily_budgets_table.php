<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDailyBudgetsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('daily_budgets', function(Blueprint $table)
		{
		// 	$table->increments('id');

		// 	$table->string('plant_date')->unique();
		// 	$table->string('plant_year_month_week');
		// 	$table->string('plant');
		// 	$table->string('year');
		// 	$table->string('month');
		// 	$table->string('week');
		// 	$table->string('week_day');
		// 	$table->date('date');

		// 	$table->string('working_day');
		// 	$table->integer('total_lines')->nullable();
		// 	$table->integer('total_operators')->nullable();

		// 	$table->double('absenteeism')->nullable();
		// 	$table->double('turnover')->nullable();

		// 	$table->integer('available_min')->nullable();
		// 	$table->double('average_eff')->nullable();
		// 	$table->integer('worked_min')->nullable();
		// 	$table->integer('average_smv_per_garment')->nullable();
		// 	$table->integer('pieces_produced')->nullable();

		// 	$table->timestamps();
		// });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('daily_budgets');
	}

}
