<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFabricsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fabrics', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('fabric')->unique();
			$table->string('supplier')->nullable();
			$table->string('material_description')->nullable();
			$table->string('mat1')->nullable();
			$table->double('mat1_p')->nullable();
			$table->string('mat2')->nullable();
			$table->double('mat2_p')->nullable();
			$table->string('mat3')->nullable();
			$table->double('mat3_p')->nullable();
			$table->string('mat4')->nullable();
			$table->double('mat4_p')->nullable();
			$table->double('tot_width')->nullable();
			$table->double('usable_width')->nullable();
			$table->double('shrinkage_dry_o')->nullable();
			$table->double('shrinkage_dry_w')->nullable();
			$table->string('shrinkage_dry_tol')->nullable();
			$table->double('shrinkage_steam_o')->nullable();
			$table->double('shrinkage_steam_w')->nullable();
			$table->string('shrinkage_steam_tol')->nullable();
			$table->string('relaxation')->nullable();
			$table->double('to_be_checked_on_qc_p')->nullable();
			$table->date('date_of_update_qc_p')->nullable();
			$table->string('supplier_truck')->nullable();
			$table->string('labels_to_genetate')->nullable();	

			// $table->string('mat1_description')->nullable();
    		// $table->string('mat2_description')->nullable();
    		// $table->string('mat3_description')->nullable();
    		// $table->string('mat4_description')->nullable();

			// $table->string('composition')->nullable();
    		// $table->string('main_material')->nullable();
    		// $table->string('daying_type')->nullable();

    		// $table->string('fabric_type')->nullable();
    		// $table->string('mq_weight')->nullable();
    		
			// $table->string('sample')->nullable();

			$table->string('sp_parameter')->nullable(); // Added
			$table->string('info_for_sp_and_cut')->nullable(); // Added
    		
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
		Schema::drop('fabrics');
	}

}



/*

fabric_code	string
supplier	string
material_description	string
mat1_p	double
mat1	string
mat2_p	double
mat2	string
mat3_p	double
mat3	string
mat4_p	double
mat4	string
tot_width	double
usable_width	double
shrinkage_dry_o	double
shrinkage_dry_w	double
shrinkage_dry_tol	string
shrinkage_steam_o	double
shrinkage_steam_w	double
shrinkage_steam_tol	string
relaxation	string (YES, NO)
to_be_checked_on_qc_p	double
date_of_update_qc_p	date
supplier_truck	string
labels_to_genetate	string

*/