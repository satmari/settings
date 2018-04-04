<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBudgetsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('budgets', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('ymw')->unique();
			$table->integer('year');
			$table->integer('month');
			$table->integer('week');
			$table->integer('worked_days');
			$table->double('new_modules');
			$table->double('modules_total');
			$table->integer('operators');
			$table->integer('available_minutes');
			$table->double('absenteeism');
			$table->double('turnover_gap');
			$table->integer('available_minutes_abs_gap');
			$table->double('budget_eff');
			$table->double('worked_minutes');
			$table->double('pieces_produced');
			$table->double('prod_cap_new_modules');
			$table->double('prod_cap_flash');
			$table->double('prod_cap_fashion');
			$table->double('prod_cap_basic');
			$table->double('eff_new_modules');
			$table->double('eff_flash');
			$table->double('eff_fashion');
			$table->double('eff_basic');
			// $table->date('first_work_day')->nullable();


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
		Schema::drop('budgets');
	}

}
