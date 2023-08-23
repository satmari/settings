<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;		// for scaning
// use Request;						// for import db 
use Illuminate\Support\Facades\Redirect;

use Maatwebsite\Excel\Facades\Excel;

use App\inventory_log;
use App\inventory_temp_log;
use DB;
// use Carbon;

use Session;

class sap_inventoryController_log extends Controller {

	public function index()
	{
		//
		$data = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM inventory_logs ORDER BY id asc"));
		return view('inventory_log.index', compact('data'));
	}

	public function index_scan()
	{
		//
		// $session = Session::getId();
		// $data = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM inventory_temp_logs WHERE ses = '".$session."' order by id desc"));
		$msg = "Please scan SU";
		return view('inventory_log.scan', compact(/*'data',*/'msg'));
	}

	public function insert_temp_su(Request $request) {
		//
		// $this->validate($request, ['su_temp'=>'required|min:19|max:21']);
		$session = Session::getId();
		$input = $request->all();
		// dd($input['su_temp']);

		if (isset($input['su_temp'])) {
			// dd($input['su_temp']);

			
			if (strlen($input['su_temp']) == 20) {
				// dd($input['su_temp']);
			} else {

				// $data = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM inventory_temp_logs WHERE ses = '".$session."' order by id desc"));
				// return redirect('/inventory_scan_wh');
				$msge = 'SU must have 20 characters';
				return view('inventory_log.scan', compact(/*'data',*/'msge'));
			}
			
		}

		// PREVIOUS SU
		// save to main
		// $data_temp = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM inventory_temp_logs WHERE ses = '".$session."' order by id desc"));
		// dd($data_temp);

		/*
		$last_bin = '';
		$last_bin_actual = '';

		if (isset($data_temp[0]->id)) {
			// var_dump("exist in temp previous su");

			$check = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM inventory_logs WHERE su = '".$data_temp[0]->su."' "));

			if (isset($check[0]->id)) {
				// var_dump(" and exist in main");	

				$table1 = inventory_log::findOrFail($check[0]->id);

				if ($data_temp[0]->bin_actual == "") {
					$table1->bin_actual = $data_temp[0]->bin;
				} else {
					$table1->bin_actual = $data_temp[0]->bin_actual;
				}

				if ($data_temp[0]->qty_actual == 0) {
					$table1->qty_actual = round((float)$data_temp[0]->qty,3);
				} else {
					$table1->qty_actual = round((float)$data_temp[0]->qty_actual,3);
				}

				$table1->ses =  Session::getId();
				$table1->counter = $data_temp[0]->counter; //new
				$table1->save();

				$last_bin = $data_temp[0]->bin;
				$last_bin_actual = $data_temp[0]->bin_actual;
				
			} else {
				// var_dump(" and not exist in main");

				if (($data_temp[0]->bin_actual == "") || ($data_temp[0]->qty_actual == "0")) {
					// dd("1");

					$data = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM inventory_temp_logs WHERE ses = '".$session."' order by id desc"));
					$msge = 'New SU must have saved Bin and Qty !';
					return view('inventory_log.scan', compact('data','msge'));
				} 

				$table = new inventory_log;
				$table->material = $data_temp[0]->material;
				$table->material_desc = $data_temp[0]->material_desc;
				$table->su = $data_temp[0]->su;
				$table->bin = "";
				$table->bin_actual = $data_temp[0]->bin_actual;
				$table->batch = $data_temp[0]->batch;
				$table->qty = 0.000;
				$table->qty_actual = round((float)$data_temp[0]->qty_actual,3);
				$table->uom = $data_temp[0]->uom;
				$table->counter = $data_temp[0]->counter; //new
				$table->ses =  Session::getId();
				$table->save();

				$last_bin = $data_temp[0]->bin;
				$last_bin_actual = $data_temp[0]->bin_actual;
			}
		}
		*/


		// NEW SU
		// save to temp
		// $data1 = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM inventory_logs WHERE su = '".$input['su_temp']."' "));
		// dd($data);

		/*
		if (isset($data1[0]->id)) {
			// var_dump("new su found in main");
			// SU IN LIST
			// new
			$top_counter = DB::connection('sqlsrv')->select(DB::raw("SELECT TOP 1 counter FROM inventory_logs ORDER BY counter desc"));
			if (isset($top_counter[0]->counter)) {
				$counter = $top_counter[0]->counter + 1;
			} else {
				$counter = 1;
			}
			
			DB::connection('sqlsrv')->delete(DB::raw("DELETE FROM inventory_temp_logs WHERE ses = '".$session."' "));

			$table = new inventory_temp_log;
			$table->material = $data1[0]->material;
			$table->material_desc = $data1[0]->material_desc;
			$table->su = $data1[0]->su;
			$table->bin = $data1[0]->bin;
			$table->bin_actual = $data1[0]->bin_actual;
			$table->batch = $data1[0]->batch;
			$table->qty = round((float)$data1[0]->qty,3);
			$table->qty_actual = round((float)$data1[0]->qty_actual,3);
			$table->uom = $data1[0]->uom;
			$table->counter = $counter; //new
			$table->ses = Session::getId(); //new
			$table->save();

			$new_bin = $data1[0]->bin;
			$new_bin_actual = $data1[0]->bin_actual;

			//if (($new_bin_actual != $last_bin_actual) OR ($new_bin_actual != $last_bin)) {
			if  ((($new_bin != $last_bin) AND ($new_bin != '') AND ($last_bin != '')) OR
				 (($new_bin != $last_bin_actual) AND ($new_bin != '') AND ($last_bin_actual != '')) OR
				 (($new_bin_actual != $last_bin) AND ($new_bin_actual != '') AND ($last_bin != '')) OR
				 (($new_bin_actual != $last_bin_actual) AND ($new_bin_actual != '') AND ($last_bin_actual != ''))
				){
				$msgbin = 1;
			}

            $data = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM
			inventory_temp_logs WHERE ses = '".$session."' order by id desc"));
			$msg = 'SU succesfuly found in table';
			$msgs = 1;
			return view('inventory_log.scan', compact('data','msg','msgs','msgbin'));

		} else {
			// var_dump("new not found in main");
			// SU OUT OF LIST

			$top_counter = DB::connection('sqlsrv')->select(DB::raw("SELECT TOP 1 counter FROM inventory_logs ORDER BY counter desc"));
			if (isset($top_counter[0]->counter)) {
				$counter = $top_counter[0]->counter + 1;
			} else {
				$counter = 1;
			}

			// DB::table('inventory_temp_logs')->truncate();
			DB::connection('sqlsrv')->delete(DB::raw("DELETE FROM inventory_temp_logs WHERE ses = '".$session."' "));

			$table = new inventory_temp_log;
			$table->material = "";
			$table->material_desc = "";
			$table->su = $input['su_temp'];
			$table->bin = "";
			$table->bin_actual = "";
			$table->batch = "";
			$table->qty = 0.000;
			$table->qty_actual = 0.000;
			$table->uom = "";
			$table->counter = $counter; //new
			$table->ses = Session::getId(); //new
			$table->save();

			$data = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM inventory_temp_logs WHERE ses = '".$session."' order by id desc"));
			$msg = 'SU not found but please add bin and quantity';
			$msgs = 1;
			return view('inventory_log.scan', compact('data','msg','msgs'));
		}
		*/

		$data = DB::connection('sqlsrv')->select(DB::raw("SELECT *  ,
			(SELECT SUM(qty) as qty_sum FROM inventory_logs WHERE su = '".$input['su_temp']."' ) as sum_qty
			FROM inventory_logs WHERE su = '".$input['su_temp']."' "));
		// dd($data);

		$msg = 'SU succesfuly found in table';
		$msgs = 1;
		return view('inventory_log.scan', compact('data','msg','msgs','msgbin'));

	}

	public function inventory_issue($su) {
		// dd($id);

		// $data = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM inventory_logs WHERE id = '".$id."' "));
		$data = DB::connection('sqlsrv')->select(DB::raw("SELECT *  ,
			(SELECT SUM(qty) as qty_sum FROM inventory_logs WHERE su = '".$su."' ) as sum_qty
			FROM inventory_logs WHERE su = '".$su."' "));
		// dd($data);

		$msg = 'Please scan new location barcode';
		$msgs = 1;
		return view('inventory_log.scan_location', compact('data','msg','msgs'));

	}

	public function inventory_issue_next(Request $request) {

		$input = $request->all();
		// dd($input);

		$su = $input['su'];
		$su_new_location = $input['su_new_location'];

		$data = DB::connection('sqlsrv')->select(DB::raw("SELECT *  ,
			(SELECT SUM(qty) as qty_sum FROM inventory_logs WHERE su = '".$su."' ) as sum_qty
			FROM inventory_logs WHERE su = '".$su."' "));

		$msg = 'Please insert qty to issue';
		$msgs = 1;

		return view('inventory_log.scan_qty', compact('data','msg','msgs','su_new_location'));
	}

	public function inventory_issue_qty(Request $request) {

		$input = $request->all();
		// dd($input);

		$su = $input['su'];
		$su_new_location = $input['su_new_location'];
		$issue_qty = round((float)$input['issue_qty'],3);

		$data1 = DB::connection('sqlsrv')->select(DB::raw("SELECT * ,
			(SELECT SUM(qty) as qty_sum FROM inventory_logs WHERE su = '".$su."' ) as sum_qty
			FROM inventory_logs WHERE su = '".$su."' "));

		// dd($data1[0]->sum_qty);
		// dd($issue_qty);

		if (round((float)$data1[0]->sum_qty,3) < $issue_qty) {
			
			$data = DB::connection('sqlsrv')->select(DB::raw("SELECT *  ,
			(SELECT SUM(qty) as qty_sum FROM inventory_logs WHERE su = '".$su."' ) as sum_qty
			FROM inventory_logs WHERE su = '".$su."' "));

			$msg = 'Please insert qty that is less or equal to remaining qty';
			$msgs = 1;

			return view('inventory_log.scan_qty', compact('data','msg','msgs','su_new_location'));
		}

		$table = new inventory_log;
		$table->material = $data1[0]->material;
		$table->material_desc = $data1[0]->material_desc;
		$table->su = $data1[0]->su;
		$table->bin = $data1[0]->bin;
		$table->bin_actual = $su_new_location;
		$table->batch = $data1[0]->batch;
		$table->qty = $issue_qty*-1;
		$table->qty_actual = NULL;
		$table->uom = $data1[0]->uom;
		$table->counter = NULL; //new
		$table->ses = Session::getId(); //new
		$table->save();

		$msg = "SU saved succesfuly";
		return view('inventory_log.scan', compact(/*'data',*/'msg'));

	}

	public function inventory_cancel() {

	}

	public function import()
	{
		//
		return view('Inventory.import');
	}

}
