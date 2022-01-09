<?php namespace App\Http\Controllers;

use App\Http\Requests;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

use Maatwebsite\Excel\Facades\Excel;

use Request; // for import
// use Illuminate\Http\Request; // for image

use App\daily_budget;

use DB;

class ImportBudget extends Controller {

	public function index()
	{
		// dd("Test");
		return view('atila.import_budget');
	}

	public function table()
	{
		$data = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM daily_budgets ORDER BY id asc"));
		return view('Budget.daily_budget_table', compact('data'));
	}

	public function postImportBudget(Request $request) {
	    $getSheetName = Excel::load(Request::file('file'))->getSheetNames();
	    
	    foreach($getSheetName as $sheetName)
	    {
	        //if ($sheetName === 'Product-General-Table')  {
	    	//selectSheetsByIndex(0)
	           	// DB::statement('SET FOREIGN_KEY_CHECKS=0;');
	            // DB::table('users')->truncate();
				// DB::statement('SET FOREIGN_KEY_CHECKS=1;');

	            //Excel::selectSheets($sheetName)->load($request->file('file'), function ($reader)
	            //Excel::selectSheets($sheetName)->load(Input::file('file'), function ($reader)
	            //Excel::filter('chunk')->selectSheetsByIndex(0)->load(Request::file('file'))->chunk(50, function ($reader)
	            Excel::filter('chunk')->selectSheets($sheetName)->load(Request::file('file'))->chunk(50, function ($reader)
	            
	            {
	                $readerarray = $reader->toArray();
	                //var_dump($readerarray);

	                foreach($readerarray as $row)
	                {

	                	// dd($row);
	                	/*
	                	"plant_year_month_week" => "Subotica-2021-m01-w01"
						  "plant" => "Subotica"
						  "year" => 2021.0
						  "month" => 1.0
						  "week" => 1.0
						  "week_day" => 5.0
						  "date" => 44197.0
						  "working_day" => "NO"
						  "tot_lines" => null
						  "tot_operators_op" => null
						  "absenteeism" => null
						  "turnover_gap" => null
						  "available_minutes_min" => 0.0
						  "average_efficiency" => 0.0
						  "worked_minutes_min" => 0.0
						  "pieces_produced_pcs" => 0.0
						
						$unix_date = ($delivery_date - 25569) * 86400;
	                	$excel_date = 25569 + ($unix_date / 86400);
						$unix_date = ($excel_date - 25569) * 86400;
						// echo gmdate("Y-m-d", $unix_date);
						$delivery_date = gmdate("Y-m-d", $unix_date);

						*/

						$plant = $row['plant'];
						$date = $row['date'];
						$unix_date = ($date - 25569) * 86400;
	                	$excel_date = 25569 + ($unix_date / 86400);
						$unix_date = ($excel_date - 25569) * 86400;
						// echo gmdate("Y-m-d", $unix_date);
						$date = gmdate("Y-m-d", $unix_date);
						// dd($date);

						$plant_date = $row['plant']."-".$date;

						$data = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM daily_budgets WHERE plant_date = '".$plant_date."' "));
						// dd($data);

						if (isset($data[0]->id)) {
							// dd('exist');
							// continue;
							// Update
							// Insert
							$plant_year_month_week = $row['plant_year_month_week'];
						
							// dd($plant_date);

							$year = strval($row['year']);
							$month = strval($row['month']);
							$week = strval($row['week']);
							$week_day = strval($row['week_day']);
							// dd($year);
							$working_day = $row['working_day'];
							
							if (is_null($row['tot_lines'])) {
								$tot_lines = 0;	
							} else {
								$tot_lines = $row['tot_lines'];
							}
							// dd($tot_lines);

							if (is_null($row['tot_operators_op'])) {
								$tot_operators_op = 0;	
							} else {
								$tot_operators_op = $row['tot_operators_op'];
							}
							// dd($tot_operators_op);

							if (is_null($row['absenteeism'])) {
								$absenteeism = 0;	
							} else {
								$absenteeism = round($row['absenteeism'],3);
							}
							// dd($absenteeism);

							if (is_null($row['turnover_gap'])) {
								$turnover_gap = 0;	
							} else {
								$turnover_gap = round($row['turnover_gap'],3);
							}
							// dd($turnover_gap);

							if (is_null($row['available_minutes_min'])) {
								$available_minutes_min = 0;	
							} else {
								$available_minutes_min = round($row['available_minutes_min'],0);
							}
							// dd($available_minutes_min);

							if (is_null($row['average_efficiency'])) {
								$average_efficiency = 0;	
							} else {
								$average_efficiency = round($row['average_efficiency'],3);
							}
							// dd($average_efficiency);
							
							if (is_null($row['worked_minutes_min'])) {
								$worked_minutes_min = 0;	
							} else {
								$worked_minutes_min = round($row['worked_minutes_min'],0);
							}
							// dd($worked_minutes_min);

							if (is_null($row['average_smv_per_garment_minpcs'])) {
								$average_smv_per_garment_minpcs = 0;	
							} else {
								$average_smv_per_garment_minpcs = round($row['average_smv_per_garment_minpcs'],0);
							}
							// dd($average_smv_per_garment_minpcs);

							if (is_null($row['pieces_produced_pcs'])) {
								$pieces_produced_pcs = 0;	
							} else {
								$pieces_produced_pcs = round($row['pieces_produced_pcs'],0);
							}
							

							// $table = new daily_budget;	
							$id = $data[0]->id;

							$table = daily_budget::findOrFail($id);	
							$table->plant_date = $plant_date;
							$table->plant_year_month_week = $plant_year_month_week;
							$table->plant = $plant;
							$table->year = $year;
							$table->month = $month;
							$table->week = $week;
							$table->week_day = $week_day;
							$table->date = $date;
							$table->working_day = $working_day;
							$table->total_lines = $tot_lines;
							$table->total_operators = $tot_operators_op;
							$table->absenteeism = $absenteeism;
							$table->turnover = $turnover_gap;
							$table->available_min = $available_minutes_min;
							$table->average_eff = $average_efficiency;
							$table->worked_min = $worked_minutes_min;
							$table->average_smv_per_garment = $average_smv_per_garment_minpcs;
							$table->pieces_produced = $pieces_produced_pcs;
													
							$table->save();



						} else {
							// Insert
							$plant_year_month_week = $row['plant_year_month_week'];
						
							// dd($plant_date);

							$year = strval($row['year']);
							$month = strval($row['month']);
							$week = strval($row['week']);
							$week_day = strval($row['week_day']);
							// dd($year);
							$working_day = $row['working_day'];
							
							if (is_null($row['tot_lines'])) {
								$tot_lines = 0;	
							} else {
								$tot_lines = $row['tot_lines'];
							}
							// dd($tot_lines);

							if (is_null($row['tot_operators_op'])) {
								$tot_operators_op = 0;	
							} else {
								$tot_operators_op = $row['tot_operators_op'];
							}
							// dd($tot_operators_op);

							if (is_null($row['absenteeism'])) {
								$absenteeism = 0;	
							} else {
								$absenteeism = round($row['absenteeism'],3);
							}
							// dd($absenteeism);

							if (is_null($row['turnover_gap'])) {
								$turnover_gap = 0;	
							} else {
								$turnover_gap = round($row['turnover_gap'],3);
							}
							// dd($turnover_gap);

							if (is_null($row['available_minutes_min'])) {
								$available_minutes_min = 0;	
							} else {
								$available_minutes_min = round($row['available_minutes_min'],0);
							}
							// dd($available_minutes_min);

							if (is_null($row['average_efficiency'])) {
								$average_efficiency = 0;	
							} else {
								$average_efficiency = round($row['average_efficiency'],3);
							}
							// dd($average_efficiency);
							
							if (is_null($row['worked_minutes_min'])) {
								$worked_minutes_min = 0;	
							} else {
								$worked_minutes_min = round($row['worked_minutes_min'],0);
							}
							// dd($worked_minutes_min);

							if (is_null($row['average_smv_per_garment_minpcs'])) {
								$average_smv_per_garment_minpcs = 0;	
							} else {
								$average_smv_per_garment_minpcs = round($row['average_smv_per_garment_minpcs'],0);
							}
							// dd($average_smv_per_garment_minpcs);
							
							if (is_null($row['pieces_produced_pcs'])) {
								$pieces_produced_pcs = 0;	
							} else {
								$pieces_produced_pcs = round($row['pieces_produced_pcs'],0);
							}
							

							$table = new daily_budget;	
							$table->plant_date = $plant_date;
							$table->plant_year_month_week = $plant_year_month_week;
							$table->plant = $plant;
							$table->year = $year;
							$table->month = $month;
							$table->week = $week;
							$table->week_day = $week_day;
							$table->date = $date;
							$table->working_day = $working_day;
							$table->total_lines = $tot_lines;
							$table->total_operators = $tot_operators_op;
							$table->absenteeism = $absenteeism;
							$table->turnover = $turnover_gap;
							$table->available_min = $available_minutes_min;
							$table->average_eff = $average_efficiency;
							$table->worked_min = $worked_minutes_min;
							$table->average_smv_per_garment = $average_smv_per_garment_minpcs;
							$table->pieces_produced = $pieces_produced_pcs;
													
							$table->save();


						}

		
	                }
	            });
	    }
		return redirect('daily_budget');
	}

	
}
