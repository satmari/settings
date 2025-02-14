<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;		// for scaning
// use Request;						// for import db 
use Illuminate\Support\Facades\Redirect;

use Maatwebsite\Excel\Facades\Excel;

use App\inspection_roll;
use App\inspection_roll_log;
use App\relaxation_roll;
use App\relaxation_roll_log;
use DB;
// use Carbon;

use Session;

class paspul_roll_controller extends Controller {

	public function index_scan_r() {

		$rnumber = 'PASPUL';
		// dd($rnumber);

		$msg = "Please scan SU";
		return view('paspul_rolls.scan', compact('msg','rnumber'));
		
	}

	public function insert_paspul_roll(Request $request) {

		$input = $request->all();
		// dd($input);
		
		$session = Session::getId();
		$su = trim($input['su']);
		$rnumber = $input['rnumber'];
		// dd($su);
		$msg = '';

		$data_r = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM relaxation_rolls WHERE su = '".$su."' order by id desc"));
		
		if (isset($data_r[0]->id)) {
			
			$table = new relaxation_roll_log;
			$table->su = $data_r[0]->su;
			$table->material = $data_r[0]->material;
			$table->material_desc = $data_r[0]->material_desc;
			$table->batch = $data_r[0]->batch;
			$table->qty = round((float)$data_r[0]->qty,3);
			$table->uom = $data_r[0]->uom;
			$table->rnumber = $rnumber;
			$table->ses = $session;
			$table->save();

			DB::connection('sqlsrv')->delete(DB::raw("DELETE FROM relaxation_rolls WHERE su  = '".$data_r[0]->su."' "));
			$msg_r = 'Found and removed from relaxation table';
		} else {
			// var_dump('not in relax');
			$msg_r = 'Not in relaxation table.';
		}

		$data_i = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM inspection_rolls WHERE su = '".$su."' order by id desc"));
		
		if (isset($data_i[0]->su)) {
			
			$table2 = new inspection_roll_log;
			$table2->su = $data_i[0]->su;
			$table2->material = $data_i[0]->material;
			$table2->material_desc = $data_i[0]->material_desc;
			$table2->batch = $data_i[0]->batch;
			$table2->qty = round((float)$data_i[0]->qty,3);
			$table2->uom = $data_i[0]->uom;
			$table2->rnumber = $rnumber;
			$table2->ses = $session;
			$table2->save();

			DB::connection('sqlsrv')->delete(DB::raw("DELETE FROM inspection_rolls WHERE su = '".$data_i[0]->su."' "));
			$msg_i = 'Found and removed from inspection table';
		} else {
			// var_dump('not in inspe');
			$msg_i = 'Not in inspection table.';
		}

		return view('paspul_rolls.scan', compact('msg_r','msg_i','rnumber'));

	}

}
