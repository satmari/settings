<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;		// for scaning
// use Request;						// for import db 
use Illuminate\Support\Facades\Redirect;

use Maatwebsite\Excel\Facades\Excel;

use App\Inventory_pal;
use App\inventory_temp_pal;
use DB;
// use Carbon;

use Session;

class sap_inventoryController_pal extends Controller {

	public function index()
	{
		//
		$data = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM inventory_pals ORDER BY id asc"));
		return view('Inventory_pal.index', compact('data'));
	}

	public function index_scan()
	{
		//
		$session = Session::getId();
		$data = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM inventory_temp_pals WHERE ses = '".$session."' order by id desc"));
		$msg = "Please scan CB or PAL";
		return view('Inventory_pal.scan', compact('data','msg'));
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

				$data = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM inventory_temp_pals WHERE ses = '".$session."' order by id desc"));
				// return redirect('/inventory_scan_wh');
				$msge = 'CB must have 20 characters';
				return view('Inventory_pal.scan', compact('data','msge'));
			}
		}

		// save to main
		$data_temp = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM inventory_temp_pals WHERE ses = '".$session."' order by id desc"));
		// dd($data_temp);

		$last_bin = '';
		$last_bin_actual = '';

		if (isset($data_temp[0]->id)) {
			// var_dump("exist in temp");

			$check = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM inventory_pals WHERE su = '".$data_temp[0]->su."' "));

			if (isset($check[0]->id)) {
				// var_dump(" and exist in main");	

				$table1 = Inventory_pal::findOrFail($check[0]->id);

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

					$data = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM inventory_temp_pals WHERE ses = '".$session."' order by id desc"));
					$msge = 'New SU must have saved Bin and Qty !';
					return view('Inventory_pal.scan', compact('data','msge'));
				} 

				$table = new Inventory_pal;
				$table->material = $data_temp[0]->material;
				$table->material_desc = $data_temp[0]->material_desc;
				$table->su = $data_temp[0]->su;
				$table->bin = "";
				$table->bin_actual = $data_temp[0]->bin_actual;
				$table->batch = $data_temp[0]->batch;
				$table->qty = 0.000;
				$table->qty_actual = round((float)$data_temp[0]->qty_actual,3);
				$table->uom = $data_temp[0]->uom;
				$table->ses =  Session::getId();
				$table->counter = $data_temp[0]->counter; //new
				$table->save();

				$last_bin = $data_temp[0]->bin;
				$last_bin_actual = $data_temp[0]->bin_actual;
			}
		}

		// save to temp
		$data1= DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM inventory_pals WHERE su = '".$input['su_temp']."' "));
		// dd($data);

		if (isset($data1[0]->id)) {
			// var_dump("new su found in main");
			// SU IN LIST
			// new
			$top_counter = DB::connection('sqlsrv')->select(DB::raw("SELECT TOP 1 counter FROM inventory_pals ORDER BY counter desc"));
			if (isset($top_counter[0]->counter)) {
				$counter = $top_counter[0]->counter + 1;
			} else {
				$counter = 1;
			}
			
			// DB::table('inventory_temp_pals')->truncate();
			DB::connection('sqlsrv')->delete(DB::raw("DELETE FROM inventory_temp_pals WHERE ses = '".$session."' "));

			$table = new inventory_temp_pal;
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

			$data = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM inventory_temp_pals WHERE ses = '".$session."' order by id desc"));
			$msg = 'SU succesfuly found in table';
			$msgs = 1;
			return view('Inventory_pal.scan', compact('data','msg','msgs','msgbin'));

		} else {
			// var_dump("new not found in main");
			// SU OUT OF LIST

			$top_counter = DB::connection('sqlsrv')->select(DB::raw("SELECT TOP 1 counter FROM inventory_pals ORDER BY counter desc"));
			if (isset($top_counter[0]->counter)) {
				$counter = $top_counter[0]->counter + 1;
			} else {
				$counter = 1;
			}

			// DB::table('inventory_temp_pals')->truncate();
			DB::connection('sqlsrv')->delete(DB::raw("DELETE FROM inventory_temp_pals WHERE ses = '".$session."' "));

			$table = new inventory_temp_pal;
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

			$data = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM inventory_temp_pals WHERE ses = '".$session."' order by id desc"));
			$msg = 'SU not found but please add bin and quantity';
			$msgs = 1;
			return view('Inventory_pal.scan', compact('data','msg','msgs'));
		}
	}

	public function update_su($su, Request $request) {

		$input = $request->all();
		// dd($input['su_temp']);
		// dd($su);

		$table1 = inventory_temp_p::findOrFail($su);
		// $table1->qty = (int)($input['qty']);
		$table1->qty_actual = round((float)$input['qty'],3);
		// $table1->bin = $input['bin'];
		$table1->bin_actual = strtoupper($input['bin']);
		$table1->save();

		$session = Session::getId();
		$data = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM inventory_temp_pals WHERE ses = '".$session."' order by id desc"));
		$msg = 'New values are saved';
		$msgs = 1;
		return view('Inventory_pal.scan', compact('data','msg','msgs'));

	}

	public function inventory_stop() {

		// save to main
		$session = Session::getId();
		$data_temp = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM inventory_temp_pals WHERE ses = '".$session."' order by id desc"));

		if (isset($data_temp[0]->id)) {
			
			$check = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM inventory_pals WHERE su = '".$data_temp[0]->su."' "));	

			if (isset($check[0]->id)) {
				
				$table1 = Inventory_pal::findOrFail($check[0]->id);	
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

				// DB::table('inventory_temps')->truncate();
				DB::connection('sqlsrv')->delete(DB::raw("DELETE FROM inventory_temp_pals WHERE ses = '".$session."' "));

			} else {

				// new
				$top_counter = DB::connection('sqlsrv')->select(DB::raw("SELECT TOP 1 counter FROM inventory_pals ORDER BY counter desc"));
				if (isset($top_counter[0]->counter)) {
					$counter = $top_counter[0]->counter + 1;
				} else {
					$counter = 1;
				}

				if (($data_temp[0]->bin_actual == "") || ($data_temp[0]->qty_actual == "0")) {
					// dd("1");

					$data = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM inventory_temp_pals WHERE ses = '".$session."' order by id desc"));
					$msge = 'New SU must have saved Bin and Qty !';
					return view('Inventory_pal.scan', compact('data','msge'));
				}				

				$table = new Inventory_pal;
				$table->material = $data_temp[0]->material;
				$table->material_desc = $data_temp[0]->material_desc;
				$table->su = $data_temp[0]->su;
				$table->bin = "";
				$table->bin_actual = $data_temp[0]->bin_actual;
				$table->batch = $data_temp[0]->batch;
				$table->qty = 0.000;
				$table->qty_actual = round((float)$data_temp[0]->qty_actual,3);
				$table->uom = $data_temp[0]->uom;
				$table->ses =  Session::getId();
				$table->counter = $counter; //new
				$table->save();

				// DB::table('inventory_temps')->truncate();
				DB::connection('sqlsrv')->delete(DB::raw("DELETE FROM inventory_temp_pals WHERE ses = '".$session."' "));
			}
		}

		$data = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM inventory_temp_pals WHERE ses = '".$session."' order by id desc"));
		$msg = 'Last scaned role was saved';
		$msgs = 1;
		return view('Inventory_pal.scan', compact('data','msg','msgs'));
	}

	public function inventory_cancel() {

		// cancel last scaned su
		$session = Session::getId();
		$data_temp = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM inventory_temp_pals WHERE ses = '".$session."' order by id desc"));

		// DB::table('inventory_temps')->truncate();
		DB::connection('sqlsrv')->delete(DB::raw("DELETE FROM inventory_temp_pals WHERE ses = '".$session."' "));

		$data = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM inventory_temp_pals WHERE ses = '".$session."' order by id desc"));
		$msg = 'Last scaned role was canceled';
		return view('Inventory_pal.scan', compact('data','msg'));

	}

	public function import()
	{
		//
		return view('Inventory.import');
	}
}
