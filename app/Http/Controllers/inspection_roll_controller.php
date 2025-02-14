<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;		// for scaning
// use Request;						// for import db 
use Illuminate\Support\Facades\Redirect;

use Maatwebsite\Excel\Facades\Excel;

use App\inspection_roll;
use App\inspection_roll_log;
use DB;
// use Carbon;

use Session;


class inspection_roll_controller extends Controller {

	public function index()
	{
		//
		$data = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM inspection_rolls ORDER BY id asc"));
		return view('inspection_rolls.index', compact('data'));
	}

	public function inspection_rolls_history()
	{
		//
		$data = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM [inspection_roll_logs] 
			 WHERE created_at > DATEADD(day, -7, GETDATE())
			 ORDER BY created_at desc"));

		return view('inspection_rolls.inspection_rolls_history', compact('data'));
	}


	public function index_scan_r() {

		$rnumber = Session::get('rnumber');
		$session = Session::getId();
		// dd($rnumber);

		if (is_null($rnumber)) {
			return view('inspection_rolls.scan_r');
		} else {
			
			$data = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM inspection_rolls WHERE ses = '".$session."' order by id desc"));
			$msg = "Please scan SU";
			return view('inspection_rolls.scan', compact('data','msg','session','rnumber'));
		}
		
	}

	public function insert_inspection_roll_r(Request $request) {

		$input = $request->all();
		// dd($input);
		$rnumber = $input['rnumber'];
		$session = Session::getId();

		$op = DB::connection('sqlsrv5')->select(DB::raw("SELECT * FROM operator_others WHERE rnumber = '".$rnumber."' "));
		// dd($op);

		if (!isset($op[0]->operator)) {
			
			Session::set('rnumber', NULL );
			$msge = "Operator ne postoji, ili niste skenirali R broj";
			return view('inspection_rolls.scan_r', compact('msge'));

		} else {
			Session::set('rnumber', $op[0]->rnumber );
		}
		
		$data = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM inspection_rolls WHERE ses = '".$session."' order by id desc"));
		$msg = "Please scan SU";

		return view('inspection_rolls.scan', compact('data','msg','session','rnumber'));

	}

	public function index_scan() {
		//
		$session = Session::getId();
		$rnumber = Session::get('rnumber');

		$data = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM inspection_rolls WHERE ses = '".$session."' order by id desc"));
		$msg = "Please scan SU";
		return view('inspection_rolls.scan', compact('data','msg','session','rnumber'));
	}

	public function insert_inspection_roll(Request $request) {

		$input = $request->all();
		$session = Session::getId();
		$rnumber = Session::get('rnumber');
		// dd($input);

		$su_temp = $input['su_temp'];
		$data_temp = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM inspection_rolls WHERE su = '".$su_temp."' order by id desc"));


		if (isset($data_temp[0]->id)) {
				// var_dump(" and exist in main");	

				$table1 = inspection_roll::findOrFail($data_temp[0]->id);
				$table1->ses =  Session::getId();
				$table1->rnumber = $rnumber;
				$table1->save();

				$data = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM inspection_rolls WHERE ses = '".$session."' order by id desc"));
				$msg = 'SU succesfuly found in table';
				return view('inspection_rolls.scan', compact('data','msg','session','rnumber'));
				
		} else {
				// var_dump(" and not exist in main");

				$data = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM inspection_rolls WHERE ses = '".$session."' order by id desc"));
				$msge = "Scanned roll doesnt exist in inspection list";
				return view('inspection_rolls.scan', compact('data','msge','session','rnumber'));
		}

	}

	public function confirm_inspection_roll(Request $request) {

		$input = $request->all();
		// dd($input);
		$session = $input['session'];
		$rnumber = Session::get('rnumber');

		$data = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM inspection_rolls WHERE ses = '".$session."' order by id desc"));

		foreach ($data as $line) {
			// dd($line);
			$id = $line->id;

			$table = new inspection_roll_log;

			$table->su = $line->su;
			$table->material = $line->material;
			$table->material_desc = $line->material_desc;
			$table->batch = $line->batch;
			$table->qty = round((float)$line->qty,3);
			$table->uom = $line->uom;
			$table->rnumber = $rnumber;
			$table->ses = $session;
									
			$table->save();
		
		}
		DB::connection('sqlsrv')->delete(DB::raw("DELETE FROM inspection_rolls WHERE ses = '".$session."' "));


		$data = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM inspection_rolls WHERE ses = '".$session."' order by id desc"));
		$msg = "Scanned rolls succesfuly confirmed";
		return view('inspection_rolls.scan', compact('data','msg','session','rnumber'));
	}

	public function remove_inspection_roll($id, $session) {

		$rnumber = Session::get('rnumber');

		// dd($session);
		DB::connection('sqlsrv')->update(DB::raw("UPDATE inspection_rolls SET ses = NULL, rnumber = NULL WHERE id = '".$id."' AND ses = '".$session."'  "));

		$data = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM inspection_rolls WHERE ses = '".$session."' order by id desc"));
		$msg = "Roll succesfuly removed";
		return view('inspection_rolls.scan', compact('data','msg','session','rnumber'));

	}

	public function log_out_i () {

		Session::set('rnumber', NULL );
		return view('inspection_rolls.scan_r');	

	}

}
