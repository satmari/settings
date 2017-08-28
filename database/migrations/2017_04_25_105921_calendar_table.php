<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CalendarTable extends Migration {

	public function up()
	{
		//
		Schema::create('calendar', function(Blueprint $table) {

			$table->string('Date');
			$table->string('Week_Day');
			$table->string('Week');
			$table->string('Month');
			$table->string('Year');
		});
	}

	public function down()
	{
		//
	}

}


/*
Date	Week Day	Week	Month	Year
*/