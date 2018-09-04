<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

use Maatwebsite\Excel\Facades\Excel;

use Request;
use App\Ecommerce;
use App\Sizeset;
use App\User;
use App\Budget;
use App\FR_plan;
use DB;
// use Carbon;

class ImportController extends Controller {
	
	public function index()
	{
		//
		return view('import.index');
	}
	
	public function postImportUser(Request $request) {
	    $getSheetName = Excel::load(Request::file('file2'))->getSheetNames();
	    
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
	            Excel::filter('chunk')->selectSheets($sheetName)->load(Request::file('file2'))->chunk(50, function ($reader)
	            
	            {
	                $readerarray = $reader->toArray();
	                //var_dump($readerarray);

	                foreach($readerarray as $row)
	                {

						$userbulk = new User;
						$userbulk->name = $row['hu'];
						$userbulk->email = $row['email'];
						$userbulk->password = bcrypt($row['pass']);
						$userbulk->username = $row['username'];
						$userbulk->name_id = $row['name_id'];
						//$userbulk->created_at = date(2015-12-22);
						//$userbulk->updated_at = date(2015-12-22);
												
						$userbulk->save();
	                }
	            });
	    }
		return redirect('/');
	}

	public function postImportRoll(Request $request) {
	    $getSheetName = Excel::load(Request::file('file3'))->getSheetNames();
	    
	    foreach($getSheetName as $sheetName)
	    {
	        //if ($sheetName === 'Product-General-Table')  {
	    	//selectSheetsByIndex(0)
	           	//DB::statement('SET FOREIGN_KEY_CHECKS=0;');
	            //DB::table('users')->truncate();
	
	            //Excel::selectSheets($sheetName)->load($request->file('file'), function ($reader)
	            //Excel::selectSheets($sheetName)->load(Input::file('file'), function ($reader)
	            //Excel::filter('chunk')->selectSheetsByIndex(0)->load(Request::file('file'))->chunk(50, function ($reader)
	            Excel::filter('chunk')->selectSheets($sheetName)->load(Request::file('file3'))->chunk(50, function ($reader)
	            
	            {
	                $readerarray = $reader->toArray();
	                //var_dump($readerarray);

	                foreach($readerarray as $row)
	                {
	                	/*
						$userbulk = new User;
						$userbulk->name = $row['user'];;
						$userbulk->email = $row['email'];
						$userbulk->password = bcrypt($row['pass']);
						//$userbulk->created_at = date(2015-12-22);
						//$userbulk->updated_at = date(2015-12-22);
												
						$userbulk->save();
						*/
	                }
	            });
	    }
		return redirect('/');
	}

	public function postImportUserRole(Request $request) {
	    $getSheetName = Excel::load(Request::file('file4'))->getSheetNames();
	    
	    foreach($getSheetName as $sheetName)
	    {
	        //if ($sheetName === 'Product-General-Table')  {
	    	//selectSheetsByIndex(0)
	           	//DB::statement('SET FOREIGN_KEY_CHECKS=0;');
	            //DB::table('users')->truncate();
	
	            //Excel::selectSheets($sheetName)->load($request->file('file'), function ($reader)
	            //Excel::selectSheets($sheetName)->load(Input::file('file'), function ($reader)
	            //Excel::filter('chunk')->selectSheetsByIndex(0)->load(Request::file('file'))->chunk(50, function ($reader)
	            Excel::filter('chunk')->selectSheets($sheetName)->load(Request::file('file4'))->chunk(50, function ($reader)
	            
	            {
	                $readerarray = $reader->toArray();
	                //var_dump($readerarray);

	                foreach($readerarray as $row)
	                {
	                	/*
						$userbulk = new User;
						$userbulk->name = $row['user'];;
						$userbulk->email = $row['email'];
						$userbulk->password = bcrypt($row['pass']);
						//$userbulk->created_at = date(2015-12-22);
						//$userbulk->updated_at = date(2015-12-22);
												
						$userbulk->save();
						*/
	                }
	            });
	    }
		return redirect('/');
	}

	public function postImportEcommerce(Request $request) {
	    $getSheetName = Excel::load(Request::file('file5'))->getSheetNames();
	    
	    foreach($getSheetName as $sheetName)
	    {
	        //if ($sheetName === 'Product-General-Table')  {
	    	//selectSheetsByIndex(0)
	           	//DB::statement('SET FOREIGN_KEY_CHECKS=0;');
	            //DB::table('ecommerce')->truncate();
	
	            //Excel::selectSheets($sheetName)->load($request->file('file'), function ($reader)
	            //Excel::selectSheets($sheetName)->load(Input::file('file'), function ($reader)
	            //Excel::filter('chunk')->selectSheetsByIndex(0)->load(Request::file('file'))->chunk(50, function ($reader)
	            Excel::filter('chunk')->selectSheets($sheetName)->load(Request::file('file5'))->chunk(50, function ($reader)
	            
	            {
	                $readerarray = $reader->toArray();
	                //var_dump($readerarray);

	                foreach($readerarray as $row)
	                {
	                	// try {
	                	
							$bulk = new Ecommerce;

		                	$sku = $row['style'].' '.$row['color'].'-'.$row['size'];
							$bulk->sku = $sku;

							$bulk->style = $row['style'];
							$bulk->color = $row['color'];
							$bulk->size = $row['size'];
							$bulk->color_desc = $row['color_description'];

							$bulk->scanned = 'NO';
							$bulk->collected = 'NO';
							$bulk->shipped = 'NO';

							$bulk->save();
						
						// } catch (\Illuminate\Database\QueryException $e) {
	                			
	     //            	}

	                }
	            });
	    }
		return redirect('/ecommerce');
	}

	public function postImportSizeset(Request $request) {
	    $getSheetName = Excel::load(Request::file('file6'))->getSheetNames();
	    
	    foreach($getSheetName as $sheetName)
	    {
	        //if ($sheetName === 'Product-General-Table')  {
	    	//selectSheetsByIndex(0)
	           	//DB::statement('SET FOREIGN_KEY_CHECKS=0;');
	            // DB::table('sizeset')->truncate();
	
	            //Excel::selectSheets($sheetName)->load($request->file('file'), function ($reader)
	            //Excel::selectSheets($sheetName)->load(Input::file('file'), function ($reader)
	            //Excel::filter('chunk')->selectSheetsByIndex(0)->load(Request::file('file'))->chunk(50, function ($reader)
	            Excel::filter('chunk')->selectSheets($sheetName)->load(Request::file('file6'))->chunk(50, function ($reader)
	            
	            {
	                $readerarray = $reader->toArray();
	                //var_dump($readerarray);

	                foreach($readerarray as $row)
	                {

	                	try {

	                	$bulk = new Sizeset;

	                	$sku = $row['style'].'-'.$row['size'];
						$bulk->sku = $sku;

						$bulk->style = $row['style'];
						//$bulk->color = ''; // not exist in imput file
						$bulk->size = $row['size'];
						//$bulk->color_desc = $row['color_description'];

						$bulk->scanned = 'NO';
						$bulk->collected = 'NO';
						$bulk->shipped = 'NO';

						$bulk->save();

						} catch (\Illuminate\Database\QueryException $e) {
	                			
	                	}
	                }
	            });
	    }
		return redirect('/sizeset');
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

	                	$ymw = $row['ymw'];
	                	// dd($ymw);

	                	$data = DB::connection('sqlsrv')->select(DB::raw("SELECT id,ymw FROM budgets WHERE ymw = '".$ymw."'"));
	                	// dd($data[0]->id);

	                	if (isset($data[0]->id)) {
	                		// dd("already exist ymw in db");
	                		// dd($data);


	                		$table = Budget::findOrFail($data[0]->id);

							try {

								$table->ymw = $row['ymw'];
								$table->year = $row['year'];
								$table->month = $row['month'];
								$table->week = $row['week'];
								$table->worked_days = $row['worked_days'];
								$table->new_modules = $row['new_modules'];
								$table->modules_total = $row['modules_total'];
								$table->operators = $row['operators'];
								$table->available_minutes = $row['available_minutes'];
								$table->absenteeism = $row['absenteeism'];
								$table->turnover_gap = $row['turnover_gap'];
								$table->available_minutes_abs_gap = $row['available_minutes_abs_gap'];
								$table->budget_eff = $row['budget_eff'];
								$table->worked_minutes = $row['worked_minutes'];
								$table->pieces_produced = $row['pieces_produced'];
								$table->prod_cap_new_modules = $row['prod_cap_new_modules'];
								$table->prod_cap_flash = $row['prod_cap_flash'];
								$table->prod_cap_fashion = $row['prod_cap_fashion'];
								$table->prod_cap_basic = $row['prod_cap_basic'];
								$table->eff_new_modules = $row['eff_new_modules'];
								$table->eff_flash = $row['eff_flash'];
								$table->eff_fashion = $row['eff_fashion'];
								$table->eff_basic = $row['eff_basic'];

								$test = $row['first_work_day'];
								// dd(date("Y-m-d\TH:i:s\Z", $test));
								// $t = ($test + date("1970-1-1"))*86400;
								$t = date("Y-m-d\TH:i:s\Z" , ($test - 25569)* 86400);
								// dd(date("Y-m-d\TH:i:s\Z", $t));
								// dd($t);
								$table->first_work_day = $t;

								$table->save();
							}
							catch (\Illuminate\Database\QueryException $e) {
								$msg = "Problem to update budget table";
								return view('Budget.error',compact('msg'));
							}
	                		
							
	                	} else {
	                		// dd("not exist ymw in db");

	                		try {

		                	$table = new Budget;
							$table->ymw = $row['ymw'];
							$table->year = $row['year'];
							$table->month = $row['month'];
							$table->week = $row['week'];
							$table->worked_days = $row['worked_days'];
							$table->new_modules = $row['new_modules'];
							$table->modules_total = $row['modules_total'];
							$table->operators = $row['operators'];
							$table->available_minutes = $row['available_minutes'];
							$table->absenteeism = $row['absenteeism'];
							$table->turnover_gap = $row['turnover_gap'];
							$table->available_minutes_abs_gap = $row['available_minutes_abs_gap'];
							$table->budget_eff = $row['budget_eff'];
							$table->worked_minutes = $row['worked_minutes'];
							$table->pieces_produced = $row['pieces_produced'];
							$table->prod_cap_new_modules = $row['prod_cap_new_modules'];
							$table->prod_cap_flash = $row['prod_cap_flash'];
							$table->prod_cap_fashion = $row['prod_cap_fashion'];
							$table->prod_cap_basic = $row['prod_cap_basic'];
							$table->eff_new_modules = $row['eff_new_modules'];
							$table->eff_flash = $row['eff_flash'];
							$table->eff_fashion = $row['eff_fashion'];
							$table->eff_basic = $row['eff_basic'];
							// $table->first_work_day = $row['first_work_day'];

							$test = $row['first_work_day'];
							// dd(date("Y-m-d\TH:i:s\Z", $test));
							// $t = ($test + date("1970-1-1"))*86400;
							$t = date("Y-m-d\TH:i:s\Z" , ($test - 25569)* 86400);
							// dd(date("Y-m-d\TH:i:s\Z", $t));
							// dd($t);
							$table->first_work_day = $t;


							
							
							$table->save();
				
							}
							catch (\Illuminate\Database\QueryException $e) {
								$msg = "Problem to insert in bugdet table";
								return view('WMS.error',compact('msg'));
							}
	                	}

	                	// try {

	                	// $datadb = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM budgets WHERE key = '".$row['key']."'"));
	                	// dd($datadb);
	                	// dd(is_null($datadb));

				        //}
						// catch (\Illuminate\Database\QueryException $e) {
						// 	$msg = "Problem";
						// 	return view('Budget.error',compact('msg'));
						// }

	                	/*
	                	if (isset($data[0])) {
	                		// dd("key found");
						} else {
		                	// dd("key not found");
	                	}
						*/

	                	/*
	                	
						*/
	                }
	            });
			
			
	    }
		return redirect('/budget');
	}

	public function postImportFR_plan(Request $request) {

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
	                // var_dump($readerarray);

	                foreach($readerarray as $row)
	                {	

	                	$test = $row['plan_date'];
	                	$tnew = date("Y-m-d" , ($test - 25569)* 86400);

	                	// dd($tnew);


	                	// dd($row);
	                	$plan_key = $row['module']." ".$row['order']." ".$row['sku']." ".$tnew;
	                	// dd($plan_key);

	                	$data = DB::connection('sqlsrv')->select(DB::raw("SELECT id,plan_key FROM fr_plan WHERE plan_key = '".$plan_key."'"));
	                	// dd($data[0]->id);

	                	if (isset($data[0]->id)) {
	                		// dd("already exist ymw in db");
	                		// dd($data);


	                		$table = FR_plan::findOrFail($data[0]->id);

							try {

								// $table->plan_key = $row['plan_key'];
								// $table->module = $row['module'];
								// $table->order = $row['order'];
								// $table->sku = $row['sku'];
								// $table->plan_date = $row['plan_date'];
								$table->qty = intval($row['qty']);
								
								$table->save();
							}
							catch (\Illuminate\Database\QueryException $e) {
								$msg = "Problem to update fr_plan table";
								return view('FR_plan.error',compact('msg'));
							}
	                		
							
	                	} else {
	                		// dd("not exist ymw in db");

	                		try {

		                	$table = new FR_plan;

							// $table->plan_key = $row['plan_key'];
							$table->plan_key = $row['module']." ".$row['order']." ".$row['sku']." ".$tnew;
							$table->module = $row['module'];
							$table->order = $row['order'];
							$table->sku = $row['sku'];
							// $table->plan_date = $row['plan_date'];

							$test = $row['plan_date'];
							// dd(date("Y-m-d\TH:i:s\Z", $test));
							// $t = ($test + date("1970-1-1"))*86400;
							$t = date("Y-m-d\TH:i:s\Z" , ($test - 25569)* 86400);
							// dd(date("Y-m-d\TH:i:s\Z", $t));
							// dd($t);
							$table->plan_date = $t;


							$table->qty = intval($row['qty']);
							
							$table->save();
				
							}
							catch (\Illuminate\Database\QueryException $e) {
								$msg = "Problem to insert in fr_plan table, probably key alredy exist in table.";
								return view('FR_plan.error',compact('msg'));
							}
	                	}
	                }
	            });
			
	    }
		return redirect('/fr_plan');
	}

}