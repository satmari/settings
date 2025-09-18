<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\lockers;
use App\lockers_log;

use DB;

use Session;

class lockersController extends Controller {

	public function lockers()
	{
		//
		$data = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM lockers ORDER BY id asc"));
		return view('Lockers.index', compact('data'));
	}

	public function lockers_scan() {

		$session = Session::getId();

		$operators = DB::connection('sqlsrv2')->select(DB::raw("SELECT [BadgeNum] as r_number,[Name] as employee
		  FROM [BdkCLZG].[dbo].[WEA_PersData]
		  WHERE [FlgAct] = '1' and [BadgeNum] like 'R%'
		  ORDER BY BadgeNum asc "));

		return view('Lockers.lockers_scan', compact('operators'));

	}
	
	public function locker_scan_rnumber(Request $request) {
		
		//
		$session = Session::getId();
		$input = $request->all();
		
		// $input_employee = $input['r_number'];
		// $parts = explode("-", $input_employee);

		// $r_number  = trim($parts[0]);
		// $employee  = trim($parts[1]);

		$r_number = $input['r_number'];

		$operator = DB::connection('sqlsrv2')->select(DB::raw("SELECT [BadgeNum] as r_number,[Name] as employee
		  FROM [BdkCLZG].[dbo].[WEA_PersData]
		  WHERE [FlgAct] = '1' and [BadgeNum] = '".$r_number."'
		  ORDER BY BadgeNum asc "));
		// dd($operator);

		if (isset($operator[0]->r_number)) {
			$r_number = $r_number;	
			$employee = $operator[0]->employee;	
		} else {

			$operators = DB::connection('sqlsrv2')->select(DB::raw("SELECT [BadgeNum] as r_number,[Name] as employee
				  FROM [BdkCLZG].[dbo].[WEA_PersData]
				  WHERE [FlgAct] = '1' and [BadgeNum] like 'R%'
				  ORDER BY BadgeNum asc "));

			$msge = 'Operator not found with this r number.';
			return view('Lockers.lockers_scan', compact('operators','msge'));
		}
		// dd($employee);

		

		$locker_number = DB::connection('sqlsrv')->select(DB::raw("SELECT DISTINCT number
		  FROM lockers
		  ORDER BY number asc "));

		$locker_place = DB::connection('sqlsrv')->select(DB::raw("SELECT DISTINCT place
		  FROM lockers
		  ORDER BY place asc "));

		return view('Lockers.locker_scan_rnumber', compact('r_number','employee','locker_number','locker_place'));

	}

	public function locker_scan_locker(Request $request) {
		
		//
		$session = Session::getId();
		$input = $request->all();
		// dd($input);
		
		$r_number = strtoupper($input['r_number']);
		$employee = $input['employee'];

		$number = $input['number'];
		$place = $input['place'];
		

		$locker = $input['place'].'-'.$input['number'];

		$check = DB::connection('sqlsrv')->select(DB::raw("SELECT *
		  FROM lockers
		  WHERE locker = '".$locker."' AND (r_number != '' AND r_number is not null) "));
		// dd($check);

		if (isset($check[0]->id)) {
			// dd('employee already asigned to this locker');

			$lockers_double = [
			    "ZENSKA SVLACIONICA GORE-619",
			    "ZENSKA SVLACIONICA GORE-620",
			    "ZENSKA SVLACIONICA GORE-621",
			    "ZENSKA SVLACIONICA GORE-622",
			    "ZENSKA SVLACIONICA GORE-623",
			    "ZENSKA SVLACIONICA GORE-624",
			    "ZENSKA SVLACIONICA GORE-625",
			    "ZENSKA SVLACIONICA GORE-626",
			    "ZENSKA SVLACIONICA GORE-627",
			    "ZENSKA SVLACIONICA GORE-628",
			    "ZENSKA SVLACIONICA GORE-629",
			    "ZENSKA SVLACIONICA GORE-630",
			    "ZENSKA SVLACIONICA GORE-635",
			    "ZENSKA SVLACIONICA GORE-636",
			    "ZENSKA SVLACIONICA GORE-634",
			    "ZENSKA SVLACIONICA GORE-631",
			    "ZENSKA SVLACIONICA GORE-632"
			];

			if (in_array($check[0]->locker, $lockers_double)) {
			    // dd('save in log - success saved');

			    $table = new lockers_log;
			    $table->locker = $locker;
			    $table->number = $number;
			    $table->place = $place;

			    $table->r_number = $r_number;
				$table->employee = $employee;
				$table->save();


				$operators = DB::connection('sqlsrv2')->select(DB::raw("SELECT [BadgeNum] as r_number,[Name] as employee
					  FROM [BdkCLZG].[dbo].[WEA_PersData]
					  WHERE [FlgAct] = '1' and [BadgeNum] like 'R%'
					  ORDER BY BadgeNum asc "));

				$msg = 'Succesfuly saved in log';
				$msgs = 1;
				return view('Lockers.lockers_scan', compact('operators','msgs','msg'));


			} else {
				// dd('without save - error');

				$locker_number = DB::connection('sqlsrv')->select(DB::raw("SELECT DISTINCT number
				  	FROM lockers
				 	 ORDER BY number asc "));

				$locker_place = DB::connection('sqlsrv')->select(DB::raw("SELECT DISTINCT place
				  	FROM lockers
				 	ORDER BY place asc "));

				$msge = 'Error: Locker already assigned !!! Choose correct locker for employee '.$employee;
				return view('Lockers.locker_scan_rnumber', compact('r_number','employee','locker_number','locker_place','msge'));
			    
			}

			
		} else {
			// dd('ready to asign employee  - success saved');

			$table = Lockers::where('locker', $locker)->first();

			if (!$table) {

			    // Not found → return custom error message

			    $locker_number = DB::connection('sqlsrv')->select(DB::raw("SELECT DISTINCT number
				  	FROM lockers
				 	 ORDER BY number asc "));

				$locker_place = DB::connection('sqlsrv')->select(DB::raw("SELECT DISTINCT place
				  	FROM lockers
				 	ORDER BY place asc "));
				
			    $msge = 'Error: Locker does not exist in table !!!';

			    return view('Lockers.locker_scan_rnumber', compact('r_number','employee','locker_number','locker_place','msge'));
			}

			$table->r_number = $r_number;
			$table->employee = $employee;
			$table->save();


			$operators = DB::connection('sqlsrv2')->select(DB::raw("SELECT [BadgeNum] as r_number,[Name] as employee
			  FROM [BdkCLZG].[dbo].[WEA_PersData]
			  WHERE [FlgAct] = '1' and [BadgeNum] like 'R%'
			  ORDER BY BadgeNum asc "));

			$msg = 'Succesfuly saved';
			$msgs = 1;
			return view('Lockers.lockers_scan', compact('operators','msgs','msg'));

		}
		

	}


	public function lockers_add () {

		return view('Lockers.lockers_add');

	}

	public function lockers_add_post (Request $request) {
		
		//
		$session = Session::getId();
		$input = $request->all();
		// dd($input);
		
		$number = $input['number'];
		$place = $input['place'];
		$locker = $input['place'].'-'.$input['number'];

		$check = DB::connection('sqlsrv')->select(DB::raw("SELECT *
		  FROM lockers
		  WHERE locker = '".$locker."' "));


		if (isset($check[0]->id)) {
			
			$msge = 'Locker already exist in table';
			return view('Lockers.lockers_add', compact('msge'));
		}


	    $table = new lockers;
	    $table->locker = $locker;
	    $table->number = $number;
	    $table->place = $place;
	    $table->r_number = '';
		$table->employee = '';
		$table->save();


		return redirect('lockers');
	}


	public function locker_edit($id) {

		// dd($id);
		$locker_info = DB::connection('sqlsrv')->select(DB::raw("SELECT *
			  FROM lockers
			  WHERE id = '".$id."' "));
		// dd($locker_info);

		$number = $locker_info[0]->number;
		$place = $locker_info[0]->place;



		$data = DB::table('lockers')->where('id', $id)->first();

	    $operators = DB::connection('sqlsrv2')->select(DB::raw("SELECT [BadgeNum] as r_number,[Name] as employee
		  FROM [BdkCLZG].[dbo].[WEA_PersData]
		  WHERE [FlgAct] = '1' and [BadgeNum] like 'R%'
		  ORDER BY BadgeNum asc "));

	    return view('Lockers.locker_edit', compact('data','operators','id'));
	}

	public function locker_edit_post(Request $request) {
		
		//
		$input = $request->all();
		// dd($input);
		
		$id = $input['id'];
		$input_employee = $input['r_number'];
		$parts = explode("-", $input_employee);

		$r_number  = trim($parts[0]);
		$employee  = trim($parts[1]);

		// dd($employee);

		$table = lockers::where('id', $id)->firstOrFail();
		$table->r_number = $r_number;
		$table->employee = $employee;
		$table->save();

		return redirect('lockers');

	}

	public function remove_employee($id) {

		// dd($id);

		$table = lockers::where('id', $id)->firstOrFail();
		$table->r_number = '';
		$table->employee = '';
		$table->save();

		return redirect('lockers');
	}
	
}
