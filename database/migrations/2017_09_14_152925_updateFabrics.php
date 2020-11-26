<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateFabrics extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		//
		
		Schema::table('styles', function($table)
		{
			
    		// $table->string('mat1_description')->nullable();
    		// $table->string('mat2_description')->nullable();
    		// $table->string('mat3_description')->nullable();
    		// $table->string('mat4_description')->nullable();

    		// $table->string('composition')->nullable();
    		// $table->string('main_material')->nullable();
    		// $table->string('daying_type')->nullable();

    		// $table->string('fabric_type')->nullable();
    		// $table->integer('mq_weight')->nullable();

    		// $table->date('first_work_day')->nullable();

    		// $table->renameColumn('labels_to_genetate', 'sample'); //NO 

    		// $table->string('sample')->nullable();

    		// $table->string('image')->nullable(); //added

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
